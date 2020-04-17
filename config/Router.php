<?php

namespace Blog\config;
use Blog\src\controller\FrontController;
use Blog\src\controller\ErrorController;
use Exception;

class Router
{
    private $frontController;
    private $errorController;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        try{
            if(isset($_GET['route']))
            {
            
            }
            else{
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}