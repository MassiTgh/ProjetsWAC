<?php
    $dsn = 'mysql:host=localhost;dbname=twitter';
    $user = 'alice';
    $password = 'AliceZheng';
    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Erreur : ".$e->getMessage();
    }
    return $pdo;