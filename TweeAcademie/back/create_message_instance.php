<?php
session_start();
$pdo = require("database.php");
if (!isset($_SESSION['user_id'])) {
    header("Location : ../front/login.php");
}else{
    $userId = $_SESSION['user_id'];

    $otherUserAt = $_GET["otherUserAt"];
    $stmt = $pdo->prepare("SELECT id FROM user WHERE at_user_name = ?");
    $stmt->execute([$otherUserAt]);
    $otherUserId = $stmt->fetchColumn();

    $users = [$userId, $otherUserId];

        $stmt = $pdo->prepare("SELECT username FROM user WHERE id IN (?, ?)");
        $stmt->execute($users);
        $usernames = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $convoName = 'conversation de ' . implode(', ', $usernames);

    $stmt = $pdo->prepare("INSERT INTO convo (name, picture) VALUES (?, NULL)");
    $stmt->execute([$convoName]);

    $convoId = $pdo->lastInsertId();

    foreach ($users as $userId) {
        $stmt = $pdo->prepare("INSERT INTO convo_users (id_convo, id_user) VALUES (?, ?)");
        $stmt->execute([$convoId, $userId]);
    }

    header("Location: ../front/message.php?otherUserAt=" . urlencode($otherUserAt));
    exit;
}
?>