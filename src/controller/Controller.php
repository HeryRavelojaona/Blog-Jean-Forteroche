<?php

namespace Blog\src\controller;

use Blog\config\Request;
use Blog\src\model\View;
use Blog\config\Mailing;
use Blog\src\constraint\Validation;
use Blog\src\DAO\UserDAO;
use Blog\src\DAO\ArticleDAO;
use Blog\src\DAO\CommentDAO;


abstract class Controller
{
    
    protected $view;
    protected $userDAO;
    protected $articleDAO;
    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;
    protected $mailing;
    protected $commentDAO;

    public function __construct()
    {   
        $this->request = new Request();
        $this->view = new View();
        $this->userDAO = new UserDAO();
        $this->articleDAO = new ArticleDAO();
        $this->validation = new Validation();
        $this->mailing = new Mailing();
        $this->commentDAO = new CommentDAO();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        
    }
}