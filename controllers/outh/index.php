<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 18:37
 */

class Index extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->render('outh/index/index');
    }

    public function refresh() {
        $json = json_encode(RedBeanPHP\R::load( 'users', $_SESSION['loggedIn']['id']));
        exit($json);
    }

}