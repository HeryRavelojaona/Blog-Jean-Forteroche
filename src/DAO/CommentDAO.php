<?php

namespace Blog\src\DAO;

use Blog\config\Parameter;
use Blog\src\model\Comment;

class CommentDAO extends DAO
{
    public function addComment(Parameter $post, $articleId, $userId)
    {  
        $sql = 'INSERT INTO comment (created_at, content, article_id, user_id) VALUES (NOW(), :content,:article_id, :user_id)';
        $this->createQuery($sql, 
        ['content'=>$post->get('content'),
         'article_id'=>$articleId,
         'user_id'=>$userId
         ]);
    }

}