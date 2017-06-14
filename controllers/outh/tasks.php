<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 18:37
 */

class Tasks extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header('Location: ../start');
    }

    public function show($game)
    {
        if ($game == NULL)
            $this->index();
        else {
            $find = RedBeanPHP\R::findOne('tasks', 'id = ?', [$game]);
            if ($find) {
                $this->view->game = $game;
                $this->view->render('outh/tasks/index', true);
            } else $this->index();
        }
    }

    public function save() {
        if ( $_POST['gameid'] ) {
            $game = RedBeanPHP\R::load('games', $_POST['gameid']);
            $game->code = $_POST['code'];
            RedBeanPHP\R::store($game);
            print('Обновлено!');
        } else {
            $game = RedBeanPHP\R::dispense( 'games' );
            $game->task_id = $_POST['task'];
            $game->user_id = $_SESSION['loggedIn']['id'];
            $game->status = 0;
            $game->code = $_POST['code'];
            RedBeanPHP\R::store($game);
            print('Сохранено!');
        }
    }

    public function test() {
        if ($_POST['userresult'] == $_POST['resultzd']) {
            $user = RedBeanPHP\R::load('users', $_SESSION['loggedIn']['id']);
            $user->coins += 50;
            RedBeanPHP\R::store($user);

            if ($_POST['gameid']) {
                $game = RedBeanPHP\R::load('games', $_POST['gameid']);
                $game->code = $_POST['code'];
                $game->status = 1;
                RedBeanPHP\R::store($game);
                print('Тест успешно пройден!');
            } else {
                $game = RedBeanPHP\R::dispense('games');
                $game->task_id = $_POST['task'];
                $game->user_id = $_SESSION['loggedIn']['id'];
                $game->status = 1;
                $game->code = $_POST['code'];
                RedBeanPHP\R::store($game);
                print('Тест успешно пройден!');
            }
        } else print('Тест не пройден! Проверьте работоспособность кода!\n'.$_POST['userresult']." ".$_POST['resultzd']);
    }
}