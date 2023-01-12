<?php

namespace Core;


class Router
{
    protected array $routes = [], $params = [];
    protected array $convertTypes = [
        'd' => 'int',
        'w' => 'string'
    ];


    public function add(string $route, array $params = [])
    {
//        d('init', $route);
        $route = preg_replace('/\//', '\\/', $route);
//        d('1', $route);
//        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
//        d('2', $route);
        $route = preg_replace('/\{([a-z_]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
//        d('3', $route);

        $route = "/^{$route}$/i";
        $this->routes[$route] = $params;

//        d($this->routes);
    }

    public function dispatch(string $url)
    {
        $url = trim($url, '/');
//        d($url);
        $url = $this->removeQueryVariables($url);
//        d($url);
//        d('params before match():',$this->params);
        if ($this->match($url)) {
            $this->checkRequestMethod();
            $controller = $this->getController();
            $action = $this->getAction($controller);
            d($this->params, $controller, $action);

            if ($controller->before($action)) {
                call_user_func_array([$controller, $action], $this->params);
                $controller->after($action);
            } else {
                d('error');
            }
        }

    }


    protected function getController(): Controller
    {
        $controller = $this->params['controller'] ?? null;
        if (!class_exists($controller)) {
            throw new \Exception("Controller " . "$controller::class" . " doesn't exist");
        }
        unset($this->params['controller']);
        return new $controller;
    }

    protected function getAction(Controller $controller): string
    {
        $action = $this->params['action'] ?? null;
        if (!method_exists($controller, $action)) {
            throw new \Exception("Action $action in $controller doesn't exist");
        }
        unset($this->params['action']);
        return $action;
    }

    protected function checkRequestMethod()
    {
        if (array_key_exists('method', $this->params)) {
            $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
            if ($requestMethod !== strtolower($this->params['method'])) {
                throw new \Exception("Method $requestMethod not allowed for this route");
            }
            unset($this->params['method']);
        }

    }

    protected function match(string $url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $this->setParams($route, $matches, $params);
                return true;
            }
        }

        return false;
    }

    protected function setParams(string $route, array $matches, array $params): array
    {
        preg_match_all('/\(\?P<[\w]+>\\\\(\w[\+])\)/', $route, $types);
        $matches = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

        if (!empty($types)) {
            $step = 0;
            $lastKey = array_key_last($types);

            foreach ($matches as $key => $match) {
                $types[$lastKey] = str_replace('+', '', $types[$lastKey]);
                settype($match, $this->convertTypes[$types[$lastKey][$step]]);
                $params[$key] = $match;
                $step++;
            }
        }

        return $params;
    }

    protected function removeQueryVariables(string $url)
    {
        return preg_replace('/([\w\/]+)\?([\w\/=\d]+)/i', '$1', $url);
    }
}


