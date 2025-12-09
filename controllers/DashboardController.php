<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\exception\ForbiddenException;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

/**
 * Class DashboardController
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\controllers
 */
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->is_logged_in() ? '' : throw new ForbiddenException();
        $this->set_layout('dashboard');
    }

    public function dashboard()
    {
        return $this->render('dashboard/index', [
            'title' => 'Dasboard',
        ]);
    }

    public function profile()
    {
        return $this->render('dashboard/profile', [
            'title' => 'Profile'
        ]);
    }
}