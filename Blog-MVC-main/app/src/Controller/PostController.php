<?php
namespace App\Controller;

use Datetime;

use App\Manager\PostManager;
use App\Factory\PDOFactory;
use App\Entity\Post;
use App\Controller\CommentController;

class PostController extends AbstractController {
    
    public function ajouterPost()
    {
        session_start();
        $id = $_SESSION['id'];
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->render("ajouter_post.php", [], 'ajout de posts');
            exit;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $file = $_FILES;

        move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__, 2) . '/uploads/' . $_FILES['file']['name']);
        $datetime = new \DateTime();

        $newPost = (new Post())
                ->setTitle($title)
                ->setContent($content)
                ->setImage( '/uploads/' . $_FILES['file']['name'])
                ->setUserId($_SESSION['id'])
                ->setDatetime($datetime);

        $manager = new PostManager(new PDOFactory());
        $manager->insertPost($newPost);
        header('Location: /home');
    }

    public function homepage()
    {   
        session_start();
        if(isset($_POST['del']) && isset($_POST['postId']) ) {
            $id = (int)$_POST['postId'];
            $manager = new PostManager(new PDOFactory());
            $manager->deletePost($id);
        }
        $this->redirection();
        $postManager = new PostManager(new PDOFactory());
        $Post = $postManager->getAllPost();

        $commentManager = new CommentController();
        $commentManager->deleteComment();
        $Comment = $commentManager->showComment();
        $this->deconnexion();
        $this->render("home.php", ["Post" => $Post, "Comment" => $Comment], 'home');
    }




}