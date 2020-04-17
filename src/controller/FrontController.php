<?php

namespace Blog\src\controller;

use Blog\src\model\View;

class FrontController
{
    private $view;

    public function __construct()
    {
        
        $this->view = new View();
    }

    public function home()
    {

        return $this->view->render('home', [
        
        ]);
    }
}