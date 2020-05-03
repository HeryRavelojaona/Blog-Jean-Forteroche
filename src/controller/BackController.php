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

    public function deleteAccount()
    {
        $this->userDAO->deleteAccount($this->session->get('mail'));
        $this->session->stop();
        $this->session->start();
        $this->session->set('delete_account', 'Votre compte a bien été supprimé');
        header('Location: ../public/index.php');
        exit();
    }

    public function administration()
    {
        $start = 0;
        $limit = 100;
    
        $articles = $this->articleDAO->showArticles($start, $limit);
        return $this->view->render('administration', [
            'articles' => $articles,
            ]);
   
    }

    public function addArticle(Parameter $post)
    {
        if($post->get('save') || $post->get('submit') ) {
            $errors = $this->validation->validate($post, 'Article');
            if(!$errors){
                //save article in database
                if($post->get('save')){
                    $status = 0;
                    $this->session->set('addArticle', 'Article bien enregistrer');
                }
                elseif($post->get('submit')){
                    $status = 1;
                    $this->session->set('addArticle', 'Article publié');

                }

                $this->articleDAO->addArticle($post, $this->session->get('id'),$status);
                header('Location: ../public/index.php?route=administration');
                exit();

            }
            return $this->view->render('addarticle', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('addarticle');
    }



}