<?php
session_start();
$id_user = $_SESSION['user_id'];
$id_user_to_follow = $_GET["id_user_to_follow"];
$pdo = require_once("database.php");
$statement_follow = $pdo->prepare("INSERT INTO follow(id_user, id_follow) VALUES(?, ?);");
$statement_follow->execute([$id_user, $id_user_to_follow]);
header("Location: ../front/profil_search_user.php?pseudo_id=".$id_user_to_follow);