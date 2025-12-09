<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

/**
 * Class AuthMiddleware
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class AuthMiddleware extends BaseMiddleware
{
    public array $actions;

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::is_guest()) {
            if (empty($this->actions) || in_array(Application::$application->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}