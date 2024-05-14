<?php
$pdo = require_once("database.php");
if(!empty($_POST["email"])&&!empty($_POST["username"])&&!empty($_POST["password"])&&!empty($_POST["birthday"])&&!empty($_POST["city"])&&!empty($_POST["name"])){
    $name = $_POST["name"];    
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];   
    $birthday = $_POST["birthday"];   
    $city = $_POST["city"];
    if(!empty($email)&&!empty($username)&&!empty($password)&&!empty($birthday)&&!empty($city)&&!empty($name)){
        $statement_check = $pdo->prepare("SELECT * FROM user WHERE mail LIKE ? ;");
        $statement_check->execute([$email]);
        $resultat_check = $statement_check->fetchAll(PDO::FETCH_ASSOC);
        if($resultat_check[0]["mail"] == $email || $resultat_check[0]["at_user_name"] == $username){
            header("Location: ../front/register_error.php");
            exit;
        }else{
            $absolute_path_avatar = 'X_logo_2023_(white).png';
            $absolute_path_banner = 'banner.jpg';
            $hash_password = hash("ripemd160", $password);
            $statement_insert = $pdo->prepare("INSERT INTO user(username,at_user_name,profile_picture,banner,mail,password,birthdate,city) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            $statement_insert->execute([$name, $username, $absolute_path_avatar, $absolute_path_banner, $email, $hash_password,$birthday, $city]);
            header("Location: ../front/login.php");
            exit;
        }
    }
}