<?php

/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 12.03.2017
 * Time: 18:41
 */
class Confirm extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
            $this->view->render('guest/confirm/index');
    }

    public function request() {

        $code = RedBeanPHP\R::findOne('codes', 'code = ?', [ $_POST['code'] ]);
        if (!$code) exit('Неверный код!');
        $user = RedBeanPHP\R::load('users', $code['user_id']);

        if( $code['type'] == 'register') {
            $user->status_id = '2';
            RedBeanPHP\R::store( $user );
        } else if ( $code['type'] == 'recovery') {
            $pass = $this->random_str(10);
            $user->password = md5($pass);
            mail($user->email, 'Подтверждение', "Ваш новый пароль: <b>$pass</b>");
            RedBeanPHP\R::store( $user );
        }

        RedBeanPHP\R::trash( $code );
        exit('go');

    }

    public function random_str($num = 30) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVWXYZ'), 0, $num);
    }
}