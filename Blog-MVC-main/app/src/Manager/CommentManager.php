<?php
namespace App\Manager;

use App\Entity\Comment;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class CommentManager extends BaseManager
{
    public function getAllComment(): array
    {
        $query = $this->pdo->query("SELECT * FROM Comment");

        $Comment = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $Comment[] = new Comment($data);
        }
        return $Comment;
    }

    public function getCommentById(int $id): ?
    Comment
    {
        $query = $this->pdo->prepare("SELECT * FROM Comment WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();

        $Comment = [];

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new Comment($data);
    }

    public function deleteComment(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM Comment WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();

        $query = $this->pdo->prepare("DELETE FROM Comment WHERE comId = :id");
        $query->bindValue('id', $id);
        $query->execute();

    }

    public function InsertComment(Comment $comment): void
    {
        $query = $this->pdo->prepare("INSERT INTO Comment (content, userId, postId, comId, datetime ) VALUES (:content,:userId, :postId, :comId, STR_TO_DATE(:datetime, '%d/%m/%Y %H:%i:%s'))");
        $query->bindValue('content', $comment->getContent());
        $query->bindValue('userId', $comment->getUserId());
        $query->bindValue('postId', $comment->getPostId());
        $query->bindValue('comId', $comment->getComId());
        $query->bindValue('datetime', $comment->getDatetime()->format('d/m/Y H:i:s'));
        $query->execute();
    }

    public function editComment(Comment $comment): void
    {
        $query = $this->pdo->prepare("UPDATE Comment SET content = :content WHERE id = :id");
        $query->bindValue('id', $comment->getId());
        $query->bindValue('content', $comment->getContent());
        $query->execute();
    }
}