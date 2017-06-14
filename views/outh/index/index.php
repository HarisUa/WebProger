<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 21:58
 */
$user = RedBeanPHP\R::load( 'users', $_SESSION['loggedIn']['id']);
$tasks = RedBeanPHP\R::findAll( 'tasks' );


echo $template->render(array(
    'message' => 'Index',
    'showmore' => $user['status_id'],
    'tasks' => $tasks,
));