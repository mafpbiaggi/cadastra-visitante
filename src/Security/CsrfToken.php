<?php

namespace App\Security;

class CsrfToken
{
    private const SESSION_KEY = 'csrf_token';

    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function generate(): string
    {
        self::start();

        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::SESSION_KEY];
    }

    public static function validate(string $token): bool
    {
        self::start();

        $sessionToken = $_SESSION[self::SESSION_KEY] ?? '';

        return hash_equals($sessionToken, $token);
    }

    public static function invalidate(): void
    {
        unset($_SESSION[self::SESSION_KEY]);
    }

    public static function getHiddenField(): string
    {
        $token = self::generate();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }
}
