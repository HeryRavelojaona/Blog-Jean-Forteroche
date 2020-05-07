<?php

namespace Blog\src\model;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $articleId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $content;

 
    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param int $id
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $id
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}