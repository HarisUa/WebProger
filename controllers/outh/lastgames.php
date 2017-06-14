<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 21.05.2017
 * Time: 18:45
 */
class Lastgames extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('outh/lastgames/index');
    }
}