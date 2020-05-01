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

    public function addArticle(Parameter $post, $userId)
    {  
        $sql = 'INSERT INTO article (title, content, created_at, status, user_id) VALUES (:title, :content, NOW(), :status, :user_id)';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'status'=>0,
         'user_id'=>$userId
         ]);
    } 

    public function showArticles()
    {
        //$sql = 'SELECT * FROM article INNER JOIN user ON user.id = article.user_id ORDER BY article.created_at DESC';
        $sql = 'SELECT * FROM article ORDER BY article.created_at DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

}