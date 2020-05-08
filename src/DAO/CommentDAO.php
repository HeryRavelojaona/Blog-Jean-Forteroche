<?php

namespace Blog\src\DAO;

use Blog\config\Parameter;
use Blog\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['created_at']);
        $comment->setUserId($row['user_id']);
        $comment->setArticleId($row['article_id']);
        return $comment;
    }

    public function addComment(Parameter $post, $articleId, $userId)
    {  
        $sql = 'INSERT INTO comment (created_at, content, article_id, user_id) VALUES (NOW(), :content,:article_id, :user_id)';
        $this->createQuery($sql, 
        ['content'=>$post->get('content'),
         'article_id'=>$articleId,
         'user_id'=>$userId
         ]);
    }

    public function showComments($articleId)
    {
        $sql = "SELECT comment.id , comment.content, comment.created_at, comment.article_id, comment.user_id  FROM comment INNER JOIN article ON comment.article_id = $articleId ORDER BY comment.created_at DESC";
        $result = $this->createQuery($sql);
        $comments = [];
        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }


}