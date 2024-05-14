<?php
    function is_login(): array | false{
        session_start(); 
        $pdo = require_once("database.php");
        if (!isset($_SESSION['user_id'])) {
            header("Location : ../front/login.php");
        }else{
            $id = $_SESSION['user_id'];
            $statement_user = $pdo->prepare("SELECT * FROM user WHERE id = ?;");
            $statement_user->execute([$id]);
            $user = $statement_user->fetchAll(PDO::FETCH_ASSOC);
        }
        return $user ?? false;
    }