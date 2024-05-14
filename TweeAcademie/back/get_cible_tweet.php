<?php
    $id = $_GET["id"];
    $pdo = require_once("database.php");
    $statement = $pdo->prepare("SELECT id FROM user WHERE at_user_name LIKE ?;");
    $statement->execute([$id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $id_cible = $result[0]['id'];
    $path = "../front/profil_search_user.php?pseudo_id=$id_cible";
    header("Location: $path");
    exit;
   