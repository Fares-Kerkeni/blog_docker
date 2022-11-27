<?php

namespace App\Manager;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Interfaces\Database;

class UserManager extends BaseManager
{
    public function getAllUser(): array
    {
        $query = $this->pdo->query("SELECT * FROM User");

        $user = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $user[] = new User($data);
        }

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();

        $user = [];

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new User($data);
    }

    public function getUserByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE username = :username");
        $query->bindValue('username', $username);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new User($data);
    }

    public function getUsernameById(int $id): ?array
    {
        $query = $this->pdo->prepare("SELECT username FROM User WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) return null;

        return $data;
    }

    public function deleteUser(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM User WHERE id = :id");
        $query->bindValue('id', $id);
        $query->execute();
    }

    public function insertUser(User $user): bool
    {
        $query = $this->pdo->prepare("INSERT INTO User (username, password, email) VALUES (:username, :password, :email);");
        $query->bindValue('username', $user->getUsername());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('email', $user->getEmail());
        return (bool)$query->execute();
    }

    public function updateRoleById(int $id, string $role) :bool
    {
        $query = $this->pdo->prepare("UPDATE User SET role =:role WHERE id=:id");
        $query->bindValue('role', $role);
        $query->bindValue('id', $id);
        return (bool)$query->execute();
    }
}
