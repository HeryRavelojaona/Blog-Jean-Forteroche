<?php

namespace Blog\src\controller;

use Blog\config\Parameter;

class BackController extends Controller
{
    public function profile()
    {
        return $this->view->render('profile');
    }

    public function updatePassword(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'updatePassword');
            if(!$errors){
                $this->userDAO->updatePassword($post, $this->session->get('mail'));
                $this->session->set('update_password', 'Le mot de passe a été mis à jour');
                header('Location: ../public/index.php');
                exit(); 
            }

            return $this->view->render('updatePassword',['errors' => $errors['password']]);  
            
        }
        return $this->view->render('updatePassword');
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous êtes déconnecter');
        header('Location: ../public/index.php');
        exit();
    }

    public function forgotPassword(Parameter $post)
    { 
        if($post->get('submit')) {

           if(!$this->userDAO->checkMail($post)){
                $errors = 'compte inexistant';
            };
            if(!$errors){
                $this->session->set('mailforgot', 'Veuillez validez le mail de changement');
                $this->mailing->forgotPassword($post->get('mail'));
                header('Location: ../public/index.php');
                exit();
            }
            return $this->view->render('forgotpass',[
                'post' => $post,
                'errors' => $errors
            ]);  
        }
        return $this->view->render('forgotpass');
    }

    public function ChangePassword(Parameter $get)
    {
        if($get->get('mail')) {
            if($this->userDAO->checkMailToChangepass($get)){
                $this->session->set('mail', $get->get('mail'));
                header('Location: ../public/index.php?route=updatePassword');
                exit();
                };      
        }

        return $this->errorController->errorNotFound();
    }

}