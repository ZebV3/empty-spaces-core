<?php
namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;
use Exception;

/**
 * Class Application
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'default';
    public string $user_class;
    public Router $router;
    public View $view;
    public Database $db;
    public ?UserModel $user;
    public Request $request;
    public Response $response;
    public Session $session;
    public static Application $application;
    public Controller $controller;

    public function __construct($root_path, array $config)
    {
        $this->user_class = $config['user_class'];
        self::$ROOT_DIR = $root_path;
        self::$application = $this;
        $this->db = new Database($config['db']);
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $primary_value = $this->session->get('user');
        if ($primary_value) {
            $primary_key = $this->user_class::primary_key();
            $this->user = $this->user_class::find_one([$primary_key => $primary_value]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $err) {
            $this->response->set_status_code($err->getCode());
            echo $this->view->render_view('_error', [
                'exception' => $err,
            ]);
        }
    }

    public static function is_guest()
    {
        return !self::$application->user;
    }

    public function get_controller()
    {
        return $this->controller;
    }

    public function set_controller(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primary_key = $user->primary_key();
        $primary_value = $user->{$primary_key};
        $this->session->set('user', $primary_value);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}