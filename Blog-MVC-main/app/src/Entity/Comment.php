<?php

namespace App\Entity;
use Datetime;

class Comment extends BaseEntity{

    private int $id;
    private string $content;
    private int $userId;
    private int $postId;
    private ?int $comId;
    private Datetime | string $dateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): self
    {
        $this->postId = $postId;
        return $this;
    }

    public function getComId(): ?int
    {
        return $this->comId;
    }

    public function setComId(?int $comId): ?self

    {        
        $this->comId = $comId;
        return $this;
    }


    public function getDateTime(): Datetime | string

    {
        return $this->datetime;
    }

    public function setDatetime($datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }
}
