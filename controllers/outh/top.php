<?php

/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 15.04.2017
 * Time: 12:47
 */
class Top extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('outh/top/index');
    }
}