<?php

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $this->checkFlashMessages();
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function setFlash(string $key, string $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = $message;
    }

    public function getFlash(string $key)
    {
        $message = $_SESSION[self::FLASH_KEY][$key] ?? null;
        if ($message) {
            unset($_SESSION[self::FLASH_KEY][$key]);
        }
        return $message;
    }

    protected function checkFlashMessages()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            // این پیام‌ها فقط یک بار در دسترس هستند، پس باید حذف بشن
            unset($_SESSION[self::FLASH_KEY][$key]);
        }
    }
}
