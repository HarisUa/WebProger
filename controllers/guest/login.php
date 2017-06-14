<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 22:33
 */

class Login extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->render('guest/login/index');
    }

    public function request() {
        $this->login_valid();
        $this->password_valid();

        $res = RedBeanPHP\R::findOne('users', 'login = ? AND password = ?', [ $_POST['login'], $_POST['pass'] ]);
        if(!$res or $res['status_id'] < 2) exit('Ошибка входа!');

        foreach ($res as $key => $value) {
            $_SESSION['loggedIn'][$key] = $value;
        }

        echo 'go';
    }

    public function login_valid() {
        if( !preg_match('/^[A-z0-9]{5,30}$/', $_POST['login']) )
            exit('Логин указан неверно!');
    }

    public function password_valid() {
        if( !preg_match('/^[A-z0-9]{6,30}$/', $_POST['pass']) )
            exit('Пароль указан неверно!');

        $_POST['pass'] = md5($_POST['pass']);
    }
}