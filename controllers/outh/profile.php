<?php

/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 14.03.2017
 * Time: 12:16
 */
class Profile extends Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {
        $id = RedBeanPHP\R::findOne('users', 'login = ?', [ $_SESSION['loggedIn']['login'] ]);
        $this->view->user = $id;
        $this->view->itsme = true;
        $this->view->render('outh/profile/index');
    }

    public function show($users = false) {
        if ($users == $_SESSION['loggedIn']['login'] || $users == NULL)
            $this->index();
        else {
            $id = RedBeanPHP\R::findOne('users', 'login = ?', [ $users ]);
            if (!$id) $this->index();
            else {
                $this->view->user = $id;
                $this->view->itsme = false;
                $this->view->render('outh/profile/index');
            }
        }
    }

    public function like() {
        $userl = RedBeanPHP\R::findOne( 'users', 'login = ?', [ $_POST['login'] ]);
        $res = RedBeanPHP\R::findOne( 'likes', 'user_id = ? AND like_id = ? AND type = ?', [ $_SESSION['loggedIn']['id'], $userl['id'], $_POST['type'] ]);
        if($res) { RedBeanPHP\R::trash( $res ); print($_POST['likes'] - 1); }
        else if ( $_SESSION['loggedIn']['login'] == $_POST['login'] ) print($_POST['likes']);
        else {
            $likes = RedBeanPHP\R::dispense('likes');
            $likes->user_id = $_SESSION['loggedIn']['id'];
            $likes->type = $_POST['type'];
            $likes->like_id = $userl['id'];
            RedBeanPHP\R::store($likes);
            print($_POST['likes'] + 1);
        }
    }

    public function request() {
        $user = RedBeanPHP\R::load( 'users', $_SESSION['loggedIn']['id']);
        if( empty($_POST['pass']) ) exit('Вам потрібно ввести свій пароль!');
        else if ( md5($_POST['pass']) != $user->password ) exit('Для підтвердження змін введіть правильний пароль!');
        else {
            if ( !empty($_POST['newlogin'])) {
                $this->login_valid();
                $res = RedBeanPHP\R::findOne( 'users', 'login = ?', [ $_POST['newlogin'] ]);
                if($res) exit('Логін занятий! Спробуйте інший!');
                else {
                    $user->login = $_POST['newlogin'];
                    RedBeanPHP\R::store($user);
                }
            }
            if ( !empty($_POST['newpass'])) {
                $this->password_valid();
                $user->password = $_POST['newpass'];
                RedBeanPHP\R::store($user);
            }
            echo 'go';
        }
    }

    public function logout() {
        unset($_SESSION['loggedIn']);
    }

    public function login_valid() {
        if( !preg_match('/^[A-z0-9]{5,30}$/', $_POST['newlogin']) )
            exit('Логин указан неверно!');
    }

    public function password_valid() {
        if( !preg_match('/^[A-z0-9]{6,30}$/', $_POST['newpass']) )
            exit('Пароль указан неверно!');

        $_POST['newpass'] = md5($_POST['newpass']);
    }
}