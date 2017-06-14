<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 14.03.2017
 * Time: 15:04
 */

$likes = RedBeanPHP\R::count( 'likes', 'like_id = ? AND type = "like"', [ $this->user['id'] ]);
$dislike = RedBeanPHP\R::count( 'likes', 'like_id = ? AND type = "dislike"', [ $this->user['id']]);

$strStart = date("Y-m-d H:i:s");
$strEnd   = $this->user['data'];

$dteStart = new DateTime($strStart);
$dteEnd   = new DateTime($strEnd);

$dteDiff  = $dteStart->diff($dteEnd);


echo $template->render(array(
    'name' => $this->user['login'],
    'avatar' => $this->user['avatar'],
    'data' => $dteDiff->days,
    'itsme' => $this->itsme,
    'showmore' => $_SESSION['loggedIn']['status_id'],
    'comments' => 5,
    'likes' => $likes,
    'dislikes' => $dislike
));