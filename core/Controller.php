<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */
class Controller
{
    public string $layout = 'default';
    public string $action = '';
    /**
     * array of middlewares
     * @var array \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function get_middlewares(): array
    {
        return $this->middlewares;
    }

    public function register_middleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function render($view, $params = [])
    {
        return Application::$application->view->render_view($view, $params);
    }

    public function set_layout($layout)
    {
        $this->layout = $layout;
    }

    public function is_logged_in()
    {
        return !Application::is_guest();
    }
}