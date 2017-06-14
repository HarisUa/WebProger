<?php

/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 19:14
 */
class View {
    public function __construct() {

    }

    public function render($name, $noinclude = false) {
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader, array(
            //'cache' => '/path/to/compilation_cache',
        ));

        if(Session::get('loggedIn')) {
            if ($noinclude == true) {
                $template = $twig->load($name . '.html');
                require 'views/' . $name . '.php';
            }
            else {
                $user = RedBeanPHP\R::load( 'users', $_SESSION['loggedIn']['id']);

                foreach ($user as $key => $value) {
                    $_SESSION['loggedIn'][$key] = $value;
                }

                require 'views/o-header.php';
                $template = $twig->load($name . '.html');
                require 'views/' . $name . '.php';
                require 'views/o-footer.php';
            }
        } else {
            if ($noinclude == true)
                require 'views/' . $name . '.php';
            else {
                require 'views/g-header.php';
                $template = $twig->load($name . '.html');
                require 'views/' . $name . '.php';
                require 'views/g-footer.php';
            }
        }
    }
}