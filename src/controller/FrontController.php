<?php

namespace Blog\src\controller;

use Blog\config\Parameter;


class FrontController extends Controller
{

    public function home()
    {
        
        return $this->view->render('home',[

        ]);
    }

    
    public function register(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Register');

            if($this->userDAO->checkUser($post) || $this->userDAO->checkMail($post)) {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
                $errors['mail'] = $this->userDAO->checkMail($post);
            }
            if($post->get('password')!= $post->get('samePassword') ){
                $errors['password'] = 'Mots de passes non identiques';
                $errors['samePassword'] = 'Mots de passes non identiques';
            }
            if(!$errors){
                $token = password_hash(rand(), PASSWORD_BCRYPT);
                $this->userDAO->register($post, $token);
                $this->mailing->validateAccount($post->get('mail'), $token, $post->get('pseudo'));
                $this->session->set('register', 'Validé votre inscription par mail');
                header('Location: ../public/index.php');
                exit();
            }
            return $this->view->render('register',[
                'post' => $post,
                'errors' => $errors
            ]);  
        }
        return $this->view->render('register');
    }

    public function validateAccount(Parameter $get)
    {
        if($get->get('token')) {
                $this->userDAO->validateAccount($get);
                $this->session->set('validate', 'Votre compte est bien validé');
                header('Location: ../public/index.php');
                exit();

        }
        return $this->view->render('register');
    }
}