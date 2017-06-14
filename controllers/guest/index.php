<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 08.03.2017
 * Time: 18:37
 */

class Index extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->render('guest/index/index');
    }

}