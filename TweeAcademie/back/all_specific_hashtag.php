<?php
// header("")
$pdo = require_once("database.php");
$hashtag = "#".$_GET["hashtag"];
$statement_hashtag = $pdo->query("SELECT tweet.id, time, content, username, at_user_name, profile_picture FROM tweet JOIN user ON tweet.id_user = user.id WHERE content LIKE '%$hashtag%' ORDER BY tweet.time DESC;");
$resultat_hashtag = $statement_hashtag->fetchAll(PDO::FETCH_ASSOC);
if($resultat_hashtag){
    echo json_encode($resultat_hashtag); 
}
