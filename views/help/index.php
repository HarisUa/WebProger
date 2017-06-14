<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 22:38
 */

echo $template->render(array(
    'message' => 'Help',
    'args' => $this->args,
));