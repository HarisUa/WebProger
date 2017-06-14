<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 21:58
 */
$games = RedBeanPHP\R::findAll( 'games', 'ORDER BY `id` DESC LIMIT 50' );

echo $template->render(array(
    'URL' => URL,
    'games' => $games,
    'showmore' => $_SESSION['loggedIn']['status_id'],
));