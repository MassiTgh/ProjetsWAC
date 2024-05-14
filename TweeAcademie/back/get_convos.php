<?php
function getConversationsForUser($userId) {
    $pdo = require("database.php");

    $stmt = $pdo->prepare("SELECT convo_users.*, convo.name as convo_name, convo.picture as convo_picture, user.* FROM convo_users 
                           JOIN convo ON convo_users.id_convo = convo.id 
                           JOIN user ON convo_users.id_user = user.id 
                           WHERE convo_users.id_user = ?");
    $stmt->execute([$userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}