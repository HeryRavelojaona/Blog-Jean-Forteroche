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

    /**
    * @param int $start sql DESC LIMIT start
    * @param int $limit sql DESC LIMIT end
    */
    public function showArticles($start, $limit)
    {
        //articles for one admin
        $sql = 'SELECT article.id , article.title, article.content, article.created_at, article.status, article.user_id FROM article INNER JOIN user ON user.id = article.user_id ORDER BY article.created_at DESC LIMIT '.$start.','.$limit.'';
        //for all admins
        //$sql = 'SELECT * FROM article ORDER BY article.created_at DESC';
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



}