<?php 

namespace App\Entity;
use Datetime;

class Post extends BaseEntity
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $content = null;
    private ?int $user_id = null;
    private ?string $image = null;
    private Datetime | string $datetime;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getContent(): ?string
    {
        return $this->content;
    }
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
    
    public function getImage() : ?string
    {
        return $this->image;
    }
    
    public function getDatetime() : Datetime | string
    {
        return $this->datetime;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title): self

    {
        $this->title = $title;
        return $this;
    }

    public function setContent(string $content):self
    {
        $this->content = $content;
        return $this;
    }

    public function setUserId(int $user_id):self
    {
        $this->user_id = $user_id;
        return $this;
    }
    
    public function setImage(string $image):self
    {
        $this->image = $image;
        return $this;
    }
    
    public function setDatetime($datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }



}
?>