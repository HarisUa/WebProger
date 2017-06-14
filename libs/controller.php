<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 19:07
 */

class Controller {
    public function __construct() {
        $this->view = new View();

    }

    public function loadModel($name) {
        $path = 'models/'.$name.'_model.php';
        if(file_exists($path)) {
            require 'models/'.$name.'_model.php';
            $modelName = $name.'_model';
            $this->model = new $modelName();
        }
    }

}