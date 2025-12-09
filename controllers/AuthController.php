<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * Class AuthController
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\controllers
 */

class AuthController extends Controller
{
    public Response $response;
    public Request $request;

    public function __construct()
    {
        $this->register_middleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $this->is_logged_in() ? $response->redirect('/dashboard') : '';
        $login_form = new LoginForm();
        $this->set_layout('auth');
        if ($request->is_post()) {
            $login_form->load_data($request->get_body());

            if ($login_form->validate() && $login_form->login()) {
                $response->redirect('/dashboard');
            }
            return $this->render('auth/login', [
                'title' => 'Login',
                'model' => $login_form
            ]);
        }
        return $this->render('auth/login', [
            'title' => 'Login',
            'model' => $login_form
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $this->is_logged_in() ? $response->redirect('/dashboard') : '';
        $user = new User();
        if ($request->is_post()) {
            $user->load_data($request->get_body());

            if ($user->validate() && $user->save()) {
                Application::$application->session->set_flash('success', 'Registration Successful');
                Application::$application->response->redirect('/');
            }
            return $this->render('auth/register', [
                'title' => 'Register',
                'model' => $user
            ]);
        }
        $this->set_layout('auth');
        return $this->render('auth/register', [
            'title' => 'Register',
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$application->logout();
        $response->redirect('/login');
    }
}