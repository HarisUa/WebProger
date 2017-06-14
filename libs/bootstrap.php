<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 19:01
 */

class Bootstrap {
    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $link = Session::get('loggedIn');
        if ($link) $links = 'outh/';
        else $links = 'guest/';
        $file = 'controllers/' . $links . $url[0] . '.php';
        if (file_exists($file))
            require_once $file;
        else {
            require 'controllers/'. $links .'index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }
        $controller = new $url[0];
        $controller->loadModel($url[0]);
        if (isset($url[2])) {
            if (method_exists($controller, $url[1]))
                $controller->{$url[1]}($url[2]);
            else {
                $controller->index();
            }
        } else {
            if (isset($url[1]) && method_exists($controller, $url[1])) {
                    $controller->$url[1]();
            }
            else {
                $controller->index();
            }
        }
    }
}