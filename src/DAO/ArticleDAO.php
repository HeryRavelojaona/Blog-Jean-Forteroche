<?php

namespace Blog\src\DAO;

use Blog\config\Parameter;
use Blog\src\model\Article;

class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setCreatedAt($row['created_at']);
        $article->setUserId($row['user_id']);
        $article->setStatus($row['status']);
        return $article;
    }

    public function addArticle(Parameter $post, $userId, $status)
    {  
        $sql = 'INSERT INTO article (title, content, created_at, status, user_id) VALUES (:title, :content, NOW(), :status, :user_id)';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'status'=>$status,
         'user_id'=>$userId
         ]);
    }

    /**
    * @param int $start sql DESC LIMIT start
    * @param int $limit sql DESC LIMIT end
    * @param boolean $published Publish or not
    */
    public function showArticles($start,  $limit, $published = NULL)
    {
        if($published){
            //articles for Front view
            $sql = "SELECT article.id , article.title, article.content, article.created_at, article.status, article.user_id FROM article WHERE article.status =1 ORDER BY article.created_at DESC LIMIT ".$start.",".$limit.""; 
        }else{
            //for admin
            $sql = "SELECT article.id , article.title, article.content, article.created_at, article.status, article.user_id FROM article INNER JOIN user ON user.id = article.user_id ORDER BY article.created_at DESC LIMIT ".$start.",".$limit."";
        }
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    public function countArticles()
    {
        $sql = 'SELECT COUNT(id) FROM article';
        $result = $this->createQuery($sql);
        $countId = $result->fetch();
        $count= $countId['COUNT(id)'];
        $result->closeCursor();
        return $count;
    }


    public function showArticle($articleId)
    {
        $sql = 'SELECT article.id , article.title, article.content, article.created_at, article.status, article.user_id FROM article INNER JOIN user ON user.id = article.user_id WHERE article.id = '.$articleId.'';
        $result = $this->createQuery($sql);
        $article = $result->fetch();
        $article = $this->buildObject($article);
        $result->closeCursor();
        return $article;
    }

    public function updateArticle(Parameter $post, $articleId, $status)
    {                       

       $sql = "UPDATE article SET title=:title, content=:content, status=:status WHERE id=:id";
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'status'=>$status,
         'id'=>$articleId
        ]);
    }

    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }

    public function publishOrnotArticle($articleId, $status)
    {                       
       $sql = "UPDATE article SET status=:status WHERE id=:id";
        $this->createQuery($sql, 
        [
         'status'=>$status,
         'id'=>$articleId
        ]);
    }

    public function getUser()
    {
        $sql = 'SELECT user.id , user.pseudo, user.role, user.status FROM user ORDER BY id';
        $result = $this->createQuery($sql);
        $user = $result->fetch();
        $user = $this->buildObject($user);
        $result->closeCursor();
        return $user;
    }
}