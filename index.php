<?php 
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        header("Location: todo.php");
        exit();
    } 
    else {
        header("Location: login.php");
        exit();
    }