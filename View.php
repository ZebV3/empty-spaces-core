<?php
namespace zebv3\EmptySpacesCore;

/**
 * Class Session
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package zebv3\EmptySpacesCore
 */

class View
{
    public string $title = '';

    public function render_view($view, $params = [])
    {
        $view_content = $this->render_only_view($view, $params);
        $layout_content = $this->layout_content();
        return str_replace('{{content}}', $view_content, $layout_content);
    }

    protected function layout_content()
    {
        $layout = Application::$application->layout;
        if (isset(Application::$application->controller)) {
            $layout = Application::$application->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function render_only_view($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}