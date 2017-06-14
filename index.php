<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 18:29
 */

if (file_exists('libs/composer/vendor/autoload.php'))
    require 'libs/composer/vendor/autoload.php';

RedBeanPHP\R::setup('mysql:host=localhost;dbname=mvc', 'root', '');

require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/model.php';
require 'libs/view.php';
require 'config/patch.php';
require 'config/database.php';
require 'libs/session.php';
Session::init();
$app = new Bootstrap();