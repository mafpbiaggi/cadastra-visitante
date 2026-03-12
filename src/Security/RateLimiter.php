<?php

namespace App\Security;

class RateLimiter {

    private const SESSION_KEY = 'last_submit';
    private const INTERVAL = 30;

    public static function check(): bool
    {
        $lastSubmit = $_SESSION[self::SESSION_KEY] ?? 0;

        if ((time() - $lastSubmit) < self::INTERVAL) {
            return false;
        }

        return true;
    }

    public static function register(): void
    {
        $_SESSION[self::SESSION_KEY] = time();
    }
}
