<?php

namespace Blog\src\controller;

use Blog\config\Request;
use Blog\src\model\View;
use Blog\src\model\Mailing;
use Blog\src\constraint\Validation;
use Blog\src\DAO\UserDAO;


abstract class Controller
{
    
    protected $view;
    protected $userDAO;
    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;
    protected $mailing;

    public function __construct()
    {   
        $this->request = new Request();
        $this->view = new View();
        $this->userDAO = new UserDAO();
        $this->validation = new Validation();
        $this->mailing = new Mailing();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }
}