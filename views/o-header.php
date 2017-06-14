<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 23:43
 */

$template = $twig->load('o-header.html');
Session::init();
echo $template->render(array(
    'site' => URL,
));