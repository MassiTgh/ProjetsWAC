<?php
    // header('Content-Type: application/json');
    session_start(); 
    if (!isset($_SESSION['user_id'])) {
        header("Location : ../front/register.php");
    }else{
        $pdo = require_once("database.php");
        $id = $_SESSION['user_id'];
        $id_tweet = $_GET["id_tweet"];
        $response = $_POST["response"];
        if($response){
            $statement_response = $pdo->prepare("INSERT INTO tweet(id_user, id_response, content) VALUES (?, ?, ?);");
            $statement_response->execute([$id, $id_tweet, $response]);
            $arr = explode(" ", $tweet);
            foreach($arr as $key => $value){
                if(str_starts_with($value, "#")){
                    $statement_hastag_list = $pdo->prepare("INSERT INTO hashtag_list(hashtag) VALUES (?);");
                    $statement_hastag_list->execute([$value]);
                }
            }
            header("Location: ../front/homepage.php");
        }
    }
