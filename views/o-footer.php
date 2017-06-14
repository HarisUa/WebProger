<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 23:43
 */
$template = $twig->load('o-footer.html');
echo $template->render(array(
    'site' => URL,
));