<?php 
    function get_followers($id_user): array | false{
        $pdo = require("database.php");
        $statement_followers = $pdo->prepare("SELECT * FROM follow JOIN user ON user.id = follow.id_user WHERE id_follow = ?;");
        $statement_followers->execute([$id_user]);
        $resultat_followers = $statement_followers->fetchAll(PDO::FETCH_ASSOC);
        return $resultat_followers ?? false;
    }