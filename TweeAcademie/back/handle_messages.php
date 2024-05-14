<?php
session_start();
$pdo = require("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location : ../front/login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$convoId = $_POST['id_convo'];
$content = $_POST['content'];

$stmt = $pdo->prepare("INSERT INTO messages (id_convo, id_user, content) VALUES (?, ?, ?)");
$stmt->execute([$convoId, $userId, $content]);

header("Location: ../front/message.php?convoId=$convoId");
exit();