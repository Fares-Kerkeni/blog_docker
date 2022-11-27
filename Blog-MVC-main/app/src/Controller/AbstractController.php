<?php

namespace App\Controller;
use App\Manager\UserManager;
use App\Factory\PDOFactory;


abstract class AbstractController
{
    public function render(string $view, array $args = [], string $name = "Document")
    {   
        $view = dirname(__DIR__, 2) . '/src/views/' . $view;
        $base = dirname(__DIR__, 2) . '/src/views/base.php';

        $userManager = new UserManager(new PDOFactory());
   
        ob_start();
        foreach ($args as $key => $value) {
            $$key = $value;
        }

        require_once $view;
        $_pageContent = ob_get_clean();
        $_pageTitle = $name;

        require_once $base;
    }

    public function deconnexion(){
        if (isset($_POST['deco'])) {
            $_SESSION = [];
            session_destroy();
            unset($_SESSION);
            header('Location: /connexion');
        }
    }

    public function redirection(){
        if($_SESSION == []){
            header('Location: /connexion');
        }
    }
}