<?php

namespace Blog\src\controller;

use Blog\config\Parameter;

class BackController extends Controller
{
    public function administration()
    {
        if($this->checkIfAdmin()){
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
            $order = 'DESC';
            $articles = $this->articleDAO->showArticles(NULL,$order);
            //Link for Navbar
            $published = true;
            $orderNav = 'ASC';
            $episodes = $this->articleDAO->showArticles($published,$orderNav);

            return $this->view->render('administration', [
                'articles' => $articles,
                'comments' => $comments,
                'userPseudo' => $userPseudo,
                'users' => $users,
                'episodes' => $episodes
                ]);
        }
   
    }
    
    public function profile()
    {
        //Link for Navbar
        $published = true;
        $order = 'ASC';
        $episodes = $this->articleDAO->showArticles($published,$order);

        return $this->view->render('profile',[
            'episodes' => $episodes
        ]);
    }

    public function updatePassword(Parameter $post)
    {
        if($this->checkIfLoggedIn()){
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
            //Link for Navbar
            $published = true;
            $order = 'ASC';
            $episodes = $this->articleDAO->showArticles($published, $order);

            return $this->view->render('updatePassword',[
                'episodes' => $episodes
            ]);
        }
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
            }
            if($post->get('mail') != $post->get('checkmail')){
                $errors = 'Mail non identique';
            }
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
        //Link for Navbar
        $published = true;
        $order = 'ASC';
        $episodes = $this->articleDAO->showArticles($published, $order);

        return $this->view->render('forgotpass',[
            'episodes' => $episodes
        ]);
    }

    public function ChangePassword(Parameter $get)
    {
        if($this->checkIfLoggedIn()){
            if($get->get('mail')) {
                if($this->userDAO->checkMailToChangepass($get)){
                    $this->session->set('mail', $get->get('mail'));
                    header('Location: ../public/index.php?route=updatePassword');
                    exit();
                    };      
            }
        }

    }

    public function deleteAccount()
    {
        if($this->checkIfLoggedIn()){
            $this->userDAO->deleteAccount($this->session->get('mail'));
            $this->session->stop();
            $this->session->start();
            $this->session->set('delete_account', 'Votre compte a bien été supprimé');
            header('Location: ../public/index.php');
            exit();
        }
    }

    

    public function addArticle(Parameter $post)
    {
        if($this->checkIfAdmin()){
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

                }

                return $this->view->render('addarticle', [
                    'errors'=>$errors,
                    'post'=>$post
                ]);
            }
            //Link for Navbar
            $published = true;
            $order = 'ASC';
            $episodes = $this->articleDAO->showArticles($published, $order);
            return $this->view->render('addarticle',[
                'episodes' => $episodes
            ]);
        }
    }

    public function updateArticle(Parameter $post, $get)
    {
        if($this->checkIfAdmin()){
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

             //Link for Navbar
        $published = true;
        $order = 'ASC';
        $episodes = $this->articleDAO->showArticles($published, $order);

            return $this->view->render('updatearticle',[
                'article' => $article,
                'episodes' => $episodes
            ]);
        }
    }

    public function deleteArticle(Parameter $get)
    {
        if($this->checkIfAdmin()){
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
        
    }

    public function publishOrnotArticle(Parameter $get)
    {
        if($this->checkIfAdmin()){
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
    }

    public function deleteComment(Parameter $get)
    {
        if($this->checkIfAdmin()){
            if($get->get('commentId')){
                $commentId = $get->get('commentId');
                $this->commentDAO->deleteComment($commentId);
                $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
                header('Location: ../public/index.php?route=administration');
                exit();
            }
            $this->errorController->errorNotFound(); 
        }
    }

    public function unFlagComment($get)
    {
        if($this->checkIfAdmin()){
            if($get->get('commentId')){
                $commentId = $get->get('commentId');
                $this->commentDAO->unflagComment($commentId);
                $this->session->set('unflag', 'Le commentaire a bien été désignalé');
                header('Location: ../public/index.php');
            } 
        }
    }

    public function deleteUser(Parameter $get)
    {
        if($this->checkIfAdmin()){
            if($get->get('userId')){
                $userId = $get->get('userId');
                if($get->get('role')=='user'){
                $this->userDAO->deleteUser($userId);
                $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
                header('Location: ../public/index.php?route=administration');
                exit();
                }else{
                    $this->session->set('delete_impossible', 'Impossible de supprimé un administrateur');
                    header('Location: ../public/index.php?route=administration');
                    exit();
                }
            }
        }  
    }

    public function changeRole(Parameter $get)
    {
        if($this->checkIfAdmin()){
            if($get->get('userId')){
                $userId = $get->get('userId');
                if($get->get('role') == 'user'){
                    $this->userDAO->changeRole($userId);
                    $this->session->set('user_role', 'Le role de l\'utilisateur a bien été modifié');
                    header('Location: ../public/index.php?route=administration');
                    exit();
                }
            }
        }  
    }

    private function checkIfLoggedIn()
    {
        if(!$this->session->get('pseudo')) {
            $this->session->set('not_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkIfAdmin()
    {
        $this->checkIfLoggedIn();
        if(!($this->session->get('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas les droits pour accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }

}