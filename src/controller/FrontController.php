<?php

namespace Blog\src\controller;

use Blog\config\Parameter;


class FrontController extends Controller
{

    public function home($get)
    {
        // Pagination
        $count =  (int) $this->articleDAO->countArticles();
        $artPerPage = 2;
        $currentPage = 1;
        $nbPage = ceil($count/$artPerPage);

        if(isset($get)){
           $page =  $get->get('page');
            if(($page > 0) && ($page <=  $nbPage) )
                $currentPage = $page;
        }
        /**
        * @param int $start sql DESC LIMIT start
        * @param int $limit sql DESC LIMIT end
        * @param boolean $published if the article is published
        */
        $start = ($currentPage - 1) * $artPerPage;
        $limit = $artPerPage;

        $published = true;
        $articles = $this->articleDAO->showLastArticles($start, $limit, $published);
        //navbar
        $order = 'ASC';
        $episodes = $this->articleDAO->showArticles($published,$order);
        return $this->view->render('home', [
            'articles' => $articles,
            'nbPage' => $nbPage,
            'currentPage' => $currentPage,
            'episodes' => $episodes,
            'count' => $count
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
        //Link for Navbar
        $published = true;
        $order = 'ASC';
        $episodes = $this->articleDAO->showArticles($published,$order);
        return $this->view->render('register',[
            'episodes' => $episodes
        ]);
    }

    //Validation with link in a mail
    public function validateAccount(Parameter $get)
    {
        if(isset($get)){
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
         //Link for Navbar
         $published = true;
         $order = 'ASC';
         $episodes = $this->articleDAO->showArticles($published, $order);
         return $this->view->render('login',[
             'episodes' => $episodes
         ]);
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

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous êtes déconnecter');
        header('Location: ../public/index.php');
        exit();
    }

    public function article(Parameter $get)
    {
        if(isset($get)){
            $articleId =  $get->get('articleId');
            if(($articleId > 1)){
                $article = $this->articleDAO->showArticle($articleId);
                $comments = $this->commentDAO->showComments($articleId);
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

                //Link for Navbar
                $published = true;
                $order = 'ASC';
                $episodes = $this->articleDAO->showArticles($published,$order);
                return $this->view->render('article',[
                    'article' => $article,
                    'comments' => $comments,
                    'userPseudo'=>$userPseudo,
                    'episodes' => $episodes
                ]);
            }
         }
     
         $this->errorController->errorNotFound();
    }

    public function addComment(Parameter $post, $get)
    {
        if(isset($get)){
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

    public function flag($get)
    {
        if(isset($get)){
            $commentId = $get->get('commentId');
            $this->commentDAO->flag($commentId);
            $this->session->set('flag', 'Le commentaire a bien été signalé');
            header('Location: ../public/index.php');
        }
        
    }

    public function contact($post)
    {
        if($post->get('submit')){
            $errors = $this->validation->validate($post, 'contact');
            if(!$errors){
                $this->mailing->contact($post);
                $this->session->set('contact',' Message bien envoyé');
                header('Location: ../public/index.php');
                exit();

            }
            return $this->view->render('contact',[
                    'post' => $post,
                    'errors'=>$errors
                ]);
        } 
    }
}