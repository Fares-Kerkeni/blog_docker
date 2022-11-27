<?php

namespace App\Manager;

use App\Entity\Post;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class PostManager extends BaseManager
{

    // récupére tous les posts
    public function getAllPost(): array 
    {
        $query = $this->pdo->query("SELECT * FROM Post ORDER BY datetime DESC");

        $posts = [];

        while($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }

        return $posts;
    }


    // récupére un post par son id
    public function getPostById(int $id): ?Post
    {
        $query = $this->pdo->prepare("SELECT * FROM Post WHERE id= :id");
        $query->bindValue('id', $id);
        $query -> execute();

        $post = [];

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new Post($data);
        
    }

    public function editPost(Post $post): void
    {
        $query = $this->pdo->prepare("UPDATE Post SET title = :title, content = :content WHERE id = :id");
        $query->bindValue('id', $post->getId());
        $query->bindValue('title', $post->getTitle());
        $query->bindValue('content', $post->getContent());
        $query->execute();
    }


    // supprime le post avec son id
    public function deletePost(int $id)
    {
        // effacer les réponses
        $query = $this->pdo->prepare("DELETE FROM Comment WHERE postId = :postId");
        $query->bindValue('postId', $id);
        $query->execute();

        // effacer les coms
        $query = $this->pdo->prepare("DELETE FROM Comment WHERE postId = :postId");
        $query->bindValue('postId', $id);
        $query->execute();

        // effacer le post 
        $query = $this->pdo->prepare("DELETE FROM Post WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();


    }

    // ajoute un post
    public function insertPost(Post $post): void
    {
        $query = $this->pdo->prepare("INSERT INTO Post (title, content, image, userId, datetime) VALUES (:title, :content, :image, :user_id, STR_TO_DATE(:datetime, '%d/%m/%Y %H:%i:%s'))");
        $query->bindValue('title', $post->getTitle());
        $query->bindValue('content', $post->getContent());
        $query->bindValue('image', $post->getImage());
        $query->bindValue('datetime', $post->getDatetime()->format('d/m/Y H:i:s'));
        $query->bindValue('user_id', $post->getUserId(), \PDO::PARAM_INT);
        $query->execute();
    }





}