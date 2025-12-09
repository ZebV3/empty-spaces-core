<?php
namespace zebv3\EmptySpacesCore;

/**
 * Class Session
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

class Session
{
    protected const string FLASH_KEY = 'flash_messages';
    public function __construct()
    {
        session_start();
        $flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$flash_message) {
            $flash_message['removed'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flash_messages;
    }

    public function set_flash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];
    }

    public function get_flash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$flash_message) {
            if ($flash_message['removed']) {
                unset($flash_messages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flash_messages;
    }
}