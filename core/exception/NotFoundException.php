<?php
namespace app\core\exception;

use Exception;

/**
 * Class NotFoundException
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class NotFoundException extends Exception
{
    protected $message = 'Page Not Found';
    protected $code = 404;
}