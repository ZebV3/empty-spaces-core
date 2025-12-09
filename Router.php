<?php
namespace zebv3\EmptySpacesCore;

use zebv3\EmptySpacesCore\exception\NotFoundException;

/**
 * Class Router
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */
class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router Class Constructor
     * @param \zebv3\EmptySpacesCore\Request $request
     * @param \zebv3\EmptySpacesCore\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->request->get_path();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            throw new NotFoundException();
        }
        if (is_string($callback))
            return Application::$application->view->render_view($callback);

        if (is_int($callback)) {
            return Application::$application->view->render_view('404');
        }

        if (is_array($callback)) {
            /** @var \zebv3\EmptySpacesCore\Controller $controller */
            $controller = new $callback[0]();
            Application::$application->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->get_middlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}