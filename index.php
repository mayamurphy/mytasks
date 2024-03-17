<?php 
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        header("Loaction: todo.php");
        exit();
    } 
    else {
        header("Location: login.php");
        exit();
    }