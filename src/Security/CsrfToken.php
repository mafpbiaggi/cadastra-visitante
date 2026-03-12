<?php

namespace App\Security;

class CsrfToken {
    
    private const SESSION_KEY = 'csrf_token';
    private const SESSION_TIME = 'csrf_token_time';
    private const EXPIRY = 300;

    public static function generate(): string
    {
        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
            $_SESSION[self::SESSION_TIME] = time();
        }

        return $_SESSION[self::SESSION_KEY];
    }

    public static function validate(string $token): bool
    {
        $sessionToken = $_SESSION[self::SESSION_KEY] ?? '';
        $sessionTime = $_SESSION[self::SESSION_TIME] ?? 0;
        
        if (empty($sessionToken) || empty($token)) {
            return false;
        }

        if ((time() - $sessionTime) > self::EXPIRY) {
            self::invalidate();
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    public static function invalidate(): void
    {
        unset($_SESSION[self::SESSION_KEY]);
        unset($_SESSION[self::SESSION_TIME]);
    }

    public static function getHiddenField(): string
    {
        $token = self::generate();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }
}
