<?php

/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 12.03.2017
 * Time: 18:12
 */
class Registration extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->render('guest/registration/index');
    }

    public function request() {
        $this->login_valid();
        $this->email_valid();
        $this->password_valid();
        $this->repass_valid();

        $res = RedBeanPHP\R::find('users', 'login = ?', [ $_POST['login'] ]);
        if($res) exit('Логин уже используеться!');

        $res = RedBeanPHP\R::find('users', 'email = ?', [ $_POST['email'] ]);
        if($res) exit('Email уже зарегистрирован!');

        $code = $this->random_str(5);

        $user = RedBeanPHP\R::dispense( 'users' );
        $user->login = $_POST['login'];
        $user->password = $_POST['pass'];
        $user->email = $_POST['email'];
        $user->data = date("Y-m-d H:i:s");
        RedBeanPHP\R::store($user);

        $codes = RedBeanPHP\R::dispense( 'codes' );
        $codes->code = $code;
        $codes->type = 'register';
        $codes->user = $user;
        RedBeanPHP\R::store( $codes );

        mail($_POST['email'], 'Подтверждение', "Ваш код подтверждения регистрации: <b>$code</b>");

        exit('go');
    }

    public function login_valid() {
        if( !preg_match('/^[A-z0-9]{5,30}$/', $_POST['login']) )
            exit('Логин указан неверно!!');
    }

    public function email_valid() {
        if( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) )
            exit('Email указан неверно!');
    }

    public function password_valid() {
        if( !preg_match('/^[A-z0-9]{6,30}$/', $_POST['pass']) )
            exit('Пароль указан неверно!');

        $_POST['pass'] = md5($_POST['pass']);
    }

    public function repass_valid() {
        if( $_POST['pass'] != md5($_POST['repass']))
            exit('Пароли не совпадают!');
    }

    public function random_str($num = 30) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVWXYZ'), 0, $num);
    }
}