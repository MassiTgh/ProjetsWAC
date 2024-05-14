<?php
    session_start(); 
    if (!isset($_SESSION['user_id'])) {
        header("Location : ../front/login.php");
    }else{
        $pdo = require_once("database.php");
        $id = $_SESSION['user_id'];
        $statement_user = $pdo->query("SELECT * FROM user WHERE id = $id;");
        $user = $statement_user->fetchAll(PDO::FETCH_ASSOC);

        $file = $_POST["file"] ? $_POST["file"] : $user[0]["profile_picture"];
        $name = $_POST["name"] ? $_POST["name"] : $user[0]["username"];
        $username = $_POST["username"];
        $password = $_POST["password"] ? hash("ripemd160", $_POST["password"]) : $user[0]["password"];
        $city = $_POST["city"] ? $_POST["city"] : $user[0]["city"];
        $bio = $_POST["bio"] ? $_POST["bio"] : ($user[0]["bio"]?$user[0]["bio"]:"non renseigner");
        $campus = $_POST["campus"] ? $_POST["campus"] : ($user[0]["campus"]?$user[0]["campus"]:"non renseigner");
        $private = $_POST["private"];
        if($file && $name && $password && $city && $bio & $campus ){
            if($username){
                $statement_user_pseudo = $pdo->prepare("SELECT at_user_name FROM user WHERE at_user_name LIKE ? ;");
                $statement_user_pseudo->execute([$username]);
                $user_pseudo = $statement_user_pseudo->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($user_pseudo)){
                    header('Location: ../front/edit_account_error.php');
                }else{
                    $statement_username = $pdo->prepare("UPDATE user SET at_user_name=? WHERE id = ? ;");
                    $statement_username->execute([$username, $id]);;
                    $statement_file = $pdo->prepare("UPDATE user SET profile_picture=? WHERE id = ? ;");
                    $statement_file->execute([$file, $id]);
                    $statement_name = $pdo->prepare("UPDATE user SET username=?  WHERE id = ? ;");
                    $statement_name->execute([$name, $id]);
                    $statement_password = $pdo->prepare("UPDATE user SET password=? WHERE id = ? ;");
                    $statement_password->execute([$password, $id]);
                    $statement_city = $pdo->prepare("UPDATE user SET city=? WHERE id = ? ;");
                    $statement_city->execute([$city, $id]);
                    $statement_bio = $pdo->prepare("UPDATE user SET bio=? WHERE id = ? ;");
                    $statement_bio->execute([$bio, $id]);
                    $statement_campus = $pdo->prepare("UPDATE user SET campus=? WHERE id = ? ;");
                    $statement_campus->execute([$campus, $id]);
                    if(isset($_POST['private'])){
                        $statement_private = $pdo->prepare("UPDATE user SET private = 1 WHERE id = ? ;");
                        $statement_private->execute([$id]);
                    }else{
                        $statement_private = $pdo->prepare("UPDATE user SET private = 0 WHERE id = ? ;");
                        $statement_private->execute([$id]);
                    }
                    header('Location: ../front/profil.php');
                }
            }else {
                $statement_file = $pdo->prepare("UPDATE user SET profile_picture=? WHERE id = ? ;");
                $statement_file->execute([$file, $id]);
                $statement_name = $pdo->prepare("UPDATE user SET username=? WHERE id = ? ;");
                $statement_name->execute([$name, $id]);
                $statement_password = $pdo->prepare("UPDATE user SET password=? WHERE id = ? ;");
                $statement_password->execute([$password, $id]);
                $statement_city = $pdo->prepare("UPDATE user SET city=? WHERE id = ? ;");
                $statement_city->execute([$city, $id]);
                $statement_bio = $pdo->prepare("UPDATE user SET bio=? WHERE id = ? ;");
                $statement_bio->execute([$bio, $id]);
                $statement_campus = $pdo->prepare("UPDATE user SET campus=? WHERE id = ? ;");
                $statement_campus->execute([$campus, $id]);
                if(isset($_POST['private'])){
                    $statement_private = $pdo->prepare("UPDATE user SET private = 1 WHERE id = ? ;");
                    $statement_private->execute([$id]);
                }else{
                    $statement_private = $pdo->prepare("UPDATE user SET private = 0 WHERE id = ? ;");
                    $statement_private->execute([$id]);
                }
                header('Location: ../front/profil.php');
            }
        }
    }