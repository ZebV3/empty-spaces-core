<?php
namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        return $this->render('pages/home', [
            'title' => 'Home',
        ]);
    }

    public function about()
    {
        return $this->render('pages/about', [
            'title' => 'About'
        ]);
    }

    public function contact(Request $request, Response $response)
    {
        $contact_model = new ContactForm();
        if ($request->is_post()) {
            $contact_model->load_data($request->get_body());
            if ($contact_model->validate() && $contact_model->send($request->get_body())) {
                Application::$application->session->set_flash('success', 'Thanks for contacting');
                $response->redirect('/contact');
            }
        }

        return $this->render('pages/contact', [
            'title' => 'Contact Us',
            'contact_model' => $contact_model
        ]);
    }
}