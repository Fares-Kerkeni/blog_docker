<?php

namespace App\Controller;


use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Entity\User;

class UserController extends AbstractController
{
    public function afficherUser()
    {   
        session_start();
        $this->deleteUser();
        $this->changeRole();
        $method = new UserManager(new PDOFactory());
        $User = $method->getAllUser();
        $this->render("affiche.php", ["User" => $User], 'afficher users');
    }


    public function register()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $manager = new UserManager(new PDOFactory());
            $user = $manager->getUserByUsername($username);

            if ($user) {
                throw new \Exception('trop ici');
            }

            if ($_POST['password'] !== $_POST['confirmPassword']) {
                throw new \Exception('bad password');
            }

            $newUser = (new User())
                ->setUsername($username)
                ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ->setEmail($email);


            if (!$manager->insertUser($newUser)) {
                throw new \Exception('insert foireux');
            }


            header('Location: /connexion');
            exit;
        }

        $this->render("inscription.php", [], 'inscription');
    }


    public function login()
    {   
        session_start();
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $manager = new UserManager(new PDOFactory());
            $user = $manager->getUserByUsername($username);

            if (!$user) {
                throw new \Exception('WRONG USERNAME OR PASSWORD');
                // throw new \Exception('CET USER EXISTE PAS');
            } else {
                $pw = $user->getPassword();
            }
            
            if (password_verify($password, $pw)) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $user->getId();
                $_SESSION['role'] = $user->getRole();

                header('Location: /home');
            } else {
                throw new \Exception('WRONG USERNAME OR PASSWORD');
            }


            exit;
        }
        $this->render("connexion.php", [], 'login');

    }

    public function deleteUser()
    {
        if(isset($_POST['del']) && isset($_POST['userId']) ) {
            $id = (int)$_POST['userId'];
            if($id === $_SESSION['id']){
                return;
            }
            $manager = new UserManager(new PDOFactory());
            $manager->deleteUser($id);
        }
    }

    public function changeRole()
    {
        if(isset($_POST['chang']) && isset($_POST['chang'])) {
            $id = (int)$_POST['userId'];
            $role = (string)$_POST['chang'];
            $manager = new UserManager(new PDOFactory());
            $manager->updateRoleById($id, $role);
        }
    }
}
