<?php

namespace Blog\src\DAO;

use Blog\config\Parameter;
use Blog\src\model\Article;

class ArticleDAO extends DAO
{
    public function addArticle(Parameter $post)
    {  
        $sql = 'INSERT INTO article (title, content, created_at, status, user_id) VALUES (:title, :content, NOW(), :status, :user_id)';
        $this->createQuery($sql, 
        ['title'=>$post->get('title'),
         'content'=>$post->get('content'),
         'status'=>0,
         'user_id'=>$post->get('user_id')
         ]);
    } 

}