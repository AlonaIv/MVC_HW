<?php

namespace App\Helpers;

class Session
{
    public static function setUserData($id, ...$args)
    {
        $options = array_merge(
            ['id' => $id],
            $args
        );

        $_SESSION['user_data'] = array_merge(
            $_SESSION['user_data'] ?? [],
            $options
        );
    }

    public static function destroy()
    {
        if (session_id()) {
            session_destroy();
        }
    }

    public static function id()
    {
        return $_SESSION['user_data']['id'] ?? null;
    }

    public static function check(): bool
    {
        return !empty($_SESSION['user_data']);
    }

    public static function isUser(): bool
    {
        d($_SESSION['user_data']);
        return $_SESSION['user_data']['is_user'] ?? false;
    }
}