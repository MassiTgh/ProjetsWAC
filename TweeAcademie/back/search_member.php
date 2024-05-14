<?php
    $pdo = require_once("database.php");
    $user = $_GET["user"];
    $statement_user = $pdo->query("SELECT * FROM user WHERE at_user_name LIKE '$user%';");
    $resultat_user = $statement_user->fetchAll(PDO::FETCH_ASSOC);
    if($resultat_user){
        echo json_encode($resultat_user); 
    }
