<?php
session_start();
$pdo = require("database.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$convoId = $_GET['convoId'];

$stmt = $pdo->prepare("SELECT * FROM messages WHERE id_convo = ? ORDER BY time ASC");
$stmt->execute([$convoId]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
?>