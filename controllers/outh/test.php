<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 21.05.2017
 * Time: 16:26
 */

class Test extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($_POST['code'] == NULL)
            exit('error');
        else {
            $this->view->code = $_POST['code'];
            $this->view->render('outh/test/index', true);
        }
    }

}