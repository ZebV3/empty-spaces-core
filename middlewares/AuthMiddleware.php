<?php
namespace zebv3\EmptySpacesCore\middlewares;

use zebv3\EmptySpacesCore\Application;
use zebv3\EmptySpacesCore\exception\ForbiddenException;

/**
 * Class AuthMiddleware
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
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