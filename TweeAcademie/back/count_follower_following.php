<?php
    function count_followings($id_user){
        $pdo = require("database.php");
        $statement =$pdo->query("SELECT COUNT(*) AS 'Count' FROM follow WHERE id_follow = $id_user;");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function count_followers($id_user){
        $pdo = require("database.php");
        $statement =$pdo->query("SELECT COUNT(*) AS 'Count' FROM follow WHERE id_user = $id_user;");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }