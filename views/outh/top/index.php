<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 21:58
 */
$users = RedBeanPHP\R::findAll( 'users', 'ORDER BY `coins` DESC LIMIT 50' );
$status = RedBeanPHP\R::findAll( 'status' );

echo $template->render(array(
    'URL' => URL,
    'users' => $users,
    'showmore' => $_SESSION['loggedIn']['status_id'],
    'status' => $status,
));