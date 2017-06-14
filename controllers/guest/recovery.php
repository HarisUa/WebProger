<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 09.03.2017
 * Time: 10:15
 */

class Recovery extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->render('guest/recovery/index');
    }

    public function request() {
        $this->email_valid();

        $code = $this->random_str(5);

        $user = RedBeanPHP\R::findOne( 'users', 'email = ?', [ $_POST['email'] ]);
        if (!$user) exit('Пользователь не найден!');

        $codes = RedBeanPHP\R::dispense( 'codes' );
        $codes->code = $code;
        $codes->type = 'recovery';
        $codes->user = $user;
        RedBeanPHP\R::store( $codes );

        mail($_POST['email'], 'Подтверждение', "Ваш код для восстановления: <b>$code</b>");

        exit('go');
    }

    public function email_valid() {
        if( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) )
            exit('Email указан неверно!');
    }

    public function random_str($num = 30) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVWXYZ'), 0, $num);
    }
}
