<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 21:58
 */
$user = RedBeanPHP\R::load( 'users', $_SESSION['loggedIn']['id']);
$tasks = RedBeanPHP\R::findOne( 'tasks', 'id = ?', [ $this->game ] );
$gameid = RedBeanPHP\R::findOne( 'games', 'task_id = ? AND user_id = ?', [ $this->game, $_SESSION['loggedIn']['id']] );

ob_start();
include('/templates/fortask.php');
$code = ob_get_contents();
ob_end_clean();

echo $template->render(array(
    'message' => 'Index',
    'showmore' => $user['status_id'],
    'tasks' => $tasks,
    'URL' => URL,
    'gameid' => $gameid,
));