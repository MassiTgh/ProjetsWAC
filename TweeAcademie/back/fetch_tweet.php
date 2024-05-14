<?php
header('Content-Type: application/json');
$pdo = require_once("database.php");
$statement = $pdo->query("SELECT tweet.id, id_response, content,username, at_user_name, profile_picture, time FROM tweet JOIN user ON tweet.id_user = user.id ORDER BY time DESC;");
$tweet_all = $statement->fetchAll(PDO::FETCH_ASSOC);
if($tweet_all){
    echo json_encode($tweet_all); 
}
