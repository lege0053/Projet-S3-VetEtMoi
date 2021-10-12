<?php
declare(strict_types=1);

class Session
{
    public static function start()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            if (headers_sent() || session_status() == PHP_SESSION_DISABLED) {
                throw SessionException('Session incompatible ou déjà active');
            }
            session_start();
        }
    }
}