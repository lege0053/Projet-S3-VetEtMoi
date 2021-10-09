<?php

class Session
{
    static public function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            if (headers_sent()) {
                throw new SessionException("Impossible de modifier les entêtes HTTP");
            }
            if (session_status() == PHP_SESSION_DISABLED) {
                throw new SessionException("La session est désactivée");
            }
            session_start();
        }
    }
}
