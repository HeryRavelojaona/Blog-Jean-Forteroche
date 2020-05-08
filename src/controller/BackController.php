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
            if($post->get('password')!= $post->get('samePassword') ){
                $errors['password'] = 'Mots de passes non identiques';
                $errors['samePassword'] = 'Mots de passes non identiques';
            }
            if(!$errors){
                $this->userDAO->updatePassword($post, $this->session->get('mail'));
                $this->session->set('update_password', 'Le mot de passe a été mis à jour');
                header('Location: ../public/index.php');
                exit(); 
            }

            return $this->view->render('updatePassword',['errors' => $errors]);  
            
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
        $comments = $this->commentDAO->getFlagComments();
                //add user pseudo with his Id
                foreach($comments as $comment){
                    $userId = $comment->getUserId();
                    $pseudo = $this->userDAO->getPseudo($userId);
                }
                if(!empty($pseudo)){
                    $userPseudo = $pseudo;
                }else{
                    $userPseudo = NULL;
                }
        //All Users
        $users = $this->userDAO->getUsers();
                
        $start = 0;
        $limit = 100;
        $articles = $this->articleDAO->showArticles($start, $limit);
        return $this->view->render('administration', [
            'articles' => $articles,
            'comments' => $comments,
            'userPseudo' => $userPseudo,
            'users' => $users
            ]);
   
    }

    public function addArticle(Parameter $post)
    {
        if($post->get('save') || $post->get('submit')){
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

            }/*
            var_dump($_post);
            var_dump($post);
*/
            return $this->view->render('addarticle', [
                'errors'=>$errors,
                'post'=>$post
            ]);
        }
        return $this->view->render('addarticle');
    }

    public function updateArticle(Parameter $post, $get)
    {
        
        if(!$get->get('articleId')){
            $this->errorController->errorNotFound();
        }
        else{
            $articleId = $get->get('articleId');
            $article = $this->articleDAO->showArticle($articleId);
        }
        if($post->get('save') || $post->get('submit')) {
            $errors = $this->validation->validate($post, 'updateArticle');
            if(!$errors){
                if($post->get('save')){
                    $status = 0;
                    $session = 'Article mis à jour et bien enregistrer';
                }
                elseif($post->get('submit')){
                    $status = 1;
                    $session = 'Article mis à jour et publié';
                }
                $this->articleDAO->updateArticle($post,$articleId, $status);
                $this->session->set('updateArticle', $session);
                header('Location: ../public/index.php?route=administration');
                exit(); 
           }
            return $this->view->render('updatearticle', [
                'article'=>$article,
                'errors' => $errors
            ]);
        };

        
        return $this->view->render('updatearticle',[
            'article' => $article
        ]);
    }

    public function deleteArticle(Parameter $get)
    {
        if($get->get('articleId')){
            $articleId = $get->get('articleId');
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('delete_article', 'Votre article a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
            exit();
        }

        $this->session->set('delete_article', 'probleme de suppression');
        header('Location: ../public/index.php?route=administration');
        exit(); 
        
    }

    public function publishOrnotArticle(Parameter $get)
    {
        if($get->get('articleId')){
            $articleId= $get->get('articleId');
            if($get->get('action') === 'retiré'){
                $status = 0;
                $this->articleDAO->publishOrnotArticle($articleId, $status);
                $this->session->set('status_article', 'Votre article a bien été retiré');
            }
            if($get->get('action') === 'publié'){
                $status = 1;
                $this->articleDAO->publishOrnotArticle($articleId, $status);
                $this->session->set('status_article', 'Votre article a bien été publié');
            }
            
            header('Location: ../public/index.php?route=administration');
                    exit();
        
        }
        $this->errorController->errorNotFound(); 
    }

    public function deleteComment(Parameter $get)
    {
        if($get->get('commentId')){
            $commentId = $get->get('commentId');
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
            exit();
        }
        $this->errorController->errorNotFound(); 
    }

    public function unFlagComment($get)
    {
        if($get->get('commentId')){
            $commentId = $get->get('commentId');
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag', 'Le commentaire a bien été désignalé');
            header('Location: ../public/index.php');
        } 
    }

    public function deleteUser(Parameter $get)
    {
        if($get->get('userId')){
            $userId = $get->get('userId');
            $this->userDAO->deleteUser($userId);
            $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
            exit();
        }  
    }
}