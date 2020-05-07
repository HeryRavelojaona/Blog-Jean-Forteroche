<?php

namespace Blog\src\controller;

use Blog\config\Parameter;


class FrontController extends Controller
{

    public function home($get)
    {
        // Pagination
        $count =  (int) $this->articleDAO->countArticles();
        $artPerPage = 4;
        $currentPage = 1;
        $nbPage = ceil($count/$artPerPage);

        if($get->get('page')){
           $page =  $get->get('page');
            if(($page > 0) && ($page <=  $nbPage) )
                $currentPage = $get->get('page');
        }
        /**
        * @param int $start sql DESC LIMIT start
        * @param int $limit sql DESC LIMIT end
        * @param boolean $published if the article is published
        */
        $start = ($currentPage - 1) * $artPerPage;
        $limit = $start + $artPerPage;

        $published = true;
        $articles = $this->articleDAO->showArticles($start, $limit, $published);
        return $this->view->render('home', [
            'articles' => $articles,
            'nbPage' => $nbPage,
            'currentPage' => $currentPage
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

    public function article(Parameter $get)
    {
        if($get->get('articleId')){
            $articleId =  $get->get('articleId');
             if(($articleId > 1))
                $article = $this->articleDAO->showArticle($articleId);
                return $this->view->render('article',[
                    'article' => $article
                ]);
         }
    
           
        return $this->view->render('article');
    }

    public function addComment(Parameter $post, $get)
    {
        if($get->get('articleId')){
                $articleId =  $get->get('articleId');
        }
        if($post->get('submit')){
            $errors = $this->validation->validate($post, 'comment');
            if(!$errors){
                $comment = $this->commentDAO->addComment($post, $articleId, $this->session->get('id'));
                $this->session->set('add_comment',' Commentaire bien ajouté');
                header('Location: ../public/index.php?route=article&articleId='.$articleId.'');
                exit();

            }
            $article = $this->articleDAO->showArticle($articleId);
            return $this->view->render('article',[
                    'article'=>$article,
                    'post' => $post,
                    'errors'=>$errors
                ]);
         }
    
        header('Location: ../public/index.php?route=article&articleId='.$articleId.'');
        exit();
    }
}