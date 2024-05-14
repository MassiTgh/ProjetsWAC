<?php
$pdo = require_once("database.php");
if(!empty($_POST["email"])&&!empty($_POST["password"])){  
    $email = $_POST["email"];   
    $password = $_POST["password"];
    if(!empty($email)&&!empty($password)){
        $statement_check = $pdo->prepare("SELECT * FROM user WHERE mail LIKE ? ;");
        $statement_check->execute([$email]);
        $resultat_check = $statement_check->fetchAll(PDO::FETCH_ASSOC);
        if(empty($resultat_check)){
            header("Location: ../front/login_error.php");
            exit;
        }else{
            $hash_enter = hash('ripemd160', $password);
            if($hash_enter == $resultat_check[0]["password"]){
                session_start();
                $_SESSION['user_id'] = $resultat_check[0]["id"];
                header('Location: ../front/profil.php');
                exit;
            }else{
                header("Location: ../front/login_error.php");
                exit;
            }
        }
    }
}
