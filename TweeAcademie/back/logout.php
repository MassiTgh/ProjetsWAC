<?php
    session_start(); 
    if (!isset($_SESSION['user_id'])) {
        header("Location : ../front/register.php");
    }else{
        session_unset();
        session_destroy();
        header("Location: ../front/login.php");
        exit;
    }
