<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location : ../front/register.php");
}else {
    $pdo = require_once("database.php");
    $id = $_SESSION['user_id'];
    $tweet = $_POST["tweet"];
    $tweets = $pdo->query("SELECT * FROM tweet");
    $image_path = "";
    if(isset($_FILES['tweet_image']) && $_FILES['tweet_image']['error'] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES['tweet_image']['name'];
        $filetype = $_FILES['tweet_image']['type'];
        $filesize = $_FILES['tweet_image']['size'];
        $length = rand(4, 5);
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newFilename = $randomString . "." . $ext;
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        $maxsize = 25 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype, $allowed)){
            if(file_exists("../front/img/" . $newFilename)){
                echo $newFilename . " is already exists.";
            } else{
                $save = move_uploaded_file($_FILES["tweet_image"]["tmp_name"], "../front/img/" . $newFilename);
                $image_path = "http://" . $_SERVER['HTTP_HOST'] . "/front/img/" . $newFilename;
            }
        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    } else{
        echo "Error: No file uploaded";
    }
    if ($tweet) {
        $tweet .= "\n" . $image_path;
        $statement_tweet = $pdo->prepare("INSERT INTO tweet(id_user, content) VALUES (?, ?);");
        $statement_tweet->execute([$id,$tweet]);
        $arr = explode(" ", $tweet);
        foreach ($arr as $key => $value) {
            if (str_starts_with($value, "#")) {
                $statement_hastag_list = $pdo->prepare("INSERT INTO hashtag_list(hashtag) VALUES (?);");
                $statement_hastag_list->execute([$value]);
            }
        }
        echo json_encode(['image_path' => $image_path]);
    }
    header("Location: ../front/homepage.php");
}