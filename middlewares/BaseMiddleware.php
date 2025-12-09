<?php
namespace app\core\middlewares;

/**
 * Class BaseMiddleware
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

abstract class BaseMiddleware
{
    abstract public function execute();
}