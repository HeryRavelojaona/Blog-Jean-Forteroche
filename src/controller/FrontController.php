<?php

namespace Blog\src\controller;

use Blog\config\Parameter;


class FrontController extends Controller
{

    public function home()
    {
        $articles = $this->articleDAO->showArticles();
        return $this->view->render('home', [
            'articles' => $articles
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
                $this->mailing->validateAccount($post->get('mail'), $token);
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
        /*if($this->userDAO->checkAccount($get) == 1){
            $errors = 'Votre compte est déja activé';
        }*/
        if(!$errors){
            $this->userDAO->validateAccount($get);
            $this->session->set('validate', 'Votre compte est bien validé');
            header('Location: ../public/index.php');
            exit();
        }
                
        return $this->view->render('register');
    }

    public function login(Parameter $post)
    {
        if($post->get('submit')) {

            $result = $this->userDAO->login($post);
            if($result && $result['isPasswordValid']) {
                if($result['result']['status'] == 1){
                    $this->session->set('login', 'Bonjour '.$result['result']['pseudo'].'');
                    $this->session->set('id', $result['result']['id']);
                    $this->session->set('pseudo', $result['result']['pseudo']);
                    $this->session->set('mail', $result['result']['mail']);
                    $this->session->set('role', $result['result']['role']);
                    header('Location: ../public/index.php');
                    exit();
                }
            }
            else {
                $errors = 'Le pseudo ou le mot de passe sont incorrects';
                return $this->view->render('login', [
                    'post'=> $post,
                    'errors'=> $errors
                ]);
            }
        }
        return $this->view->render('login');
    }
}