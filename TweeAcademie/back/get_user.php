<?php
    session_start(); 
    $pdo = require_once("./database.php");
    $id = $_SESSION['user_id'];
    $statement = $pdo->prepare("SELECT at_user_name FROM user JOIN follow ON user.id = follow.id_follow WHERE id_user =?;");
    $statement->execute([$id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result); 