<?php

namespace Blog\config;
use Blog\src\controller\FrontController;
use Blog\src\controller\BackController;
use Blog\src\controller\ErrorController;

use Exception;

class Router
{
    private $frontController;
    private $errorController;
    private $backController;
    private $request;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
        $this->backController = new BackController();
        $this->request = new Request();
    }

    public function run()
    {  
        $route = $this->request->getGet()->get('route');
        try{
            if(isset($route))
            {
                if($route === 'register'){
                    $this->frontController->register($this->request->getPost());
                }
                
                elseif($route === 'validateAccount'){
                    $this->frontController->validateAccount($this->request->getGet());
                }
                elseif($route === 'login'){
                    $this->frontController->login($this->request->getPost());
                }
                elseif($route === 'profile'){
                    $this->backController->profile();
                }
                elseif($route === 'updatePassword'){
                    $this->backController->updatePassword($this->request->getPost());
                }
                elseif($route === 'logout'){
                    $this->backController->logout();
                }
                elseif($route === 'forgotpass'){
                    $this->backController->forgotPassword($this->request->getPost());
                }
                elseif($route === 'changepass'){
                    $this->backController->changePassword($this->request->getGet());
                }
                elseif($route === 'deleteAccount'){
                    $this->backController->deleteAccount();
                }

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