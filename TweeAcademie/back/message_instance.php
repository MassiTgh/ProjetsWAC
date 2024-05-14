<?php
session_start();
$pdo = require("database.php");
if (!isset($_SESSION['user_id'])) {
    header("Location : ../front/login.php");
}else{
    $convoId = $_GET['convoId'];
    $convoName = $_GET['convoName'];
    $userId = $_SESSION['user_id'];

    $otherUserAt = $_GET["otherUserAt"];
    $stmt = $pdo->prepare("SELECT id FROM user WHERE at_user_name = ?");
    $stmt->execute([$otherUserAt]);
    $otherUserId = $stmt->fetchColumn();

    $users = [$userId, $otherUserId];

    $stmt = $pdo->prepare("SELECT username FROM user WHERE id IN (?, ?)");
    $stmt->execute($users);
    $usernames = $stmt->fetchAll(PDO::FETCH_COLUMN);

    header("Location: ../front/message.php?convoId=$convoId&convoName=$convoName&userId=$userId");
    exit();
}