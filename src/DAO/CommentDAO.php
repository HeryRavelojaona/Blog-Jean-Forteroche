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
        $comment->setFlag($row['flag']);
        return $comment;
    }

    public function addComment(Parameter $post, $articleId, $userId)
    {  
        $sql = 'INSERT INTO comment (created_at, content, article_id, user_id, flag) VALUES (NOW(), :content,:article_id, :user_id, :flag)';
        $this->createQuery($sql, 
        ['content'=>$post->get('content'),
         'article_id'=>$articleId,
         'user_id'=>$userId,
         'flag'=>0
         ]);
    }

    public function showComments($articleId)
    {
        $sql = "SELECT comment.id , comment.content, comment.created_at, comment.article_id, comment.user_id, flag  FROM comment INNER JOIN article ON comment.article_id = $articleId ORDER BY comment.id DESC";
        $result = $this->createQuery($sql);
        $comments = [];
        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function flag($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [1, $commentId]);
    }

    public function getFlagComments()
    {
        $sql = 'SELECT id, content, created_at, flag, article_id, user_id FROM comment WHERE flag = ? ORDER BY id DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function deleteFlagComment($commentId)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function unFlagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [0, $commentId]);
    }


}