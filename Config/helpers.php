<?php

function url(string $path): string
{
    return SITE_URL . '/' . $path;
}

function currentLink(string $path): bool
{
    return trim($_SERVER['REQUEST_URI'], '/') === $path;
}

function redirect(string $path)
{
    $path = SITE_URL . '/' . $path . '/';
    header("Location: $path");
    exit;
}

function showInputError(string $key, array $errors = [])
{
    return !empty($errors[$key]) ? sprintf('<div class="mb-3 alert alert-danger" role="alert">%s</div>', $errors[$key]) : '';
}