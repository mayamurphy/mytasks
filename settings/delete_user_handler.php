<?php
    require_once '../Dao.php';

    $user_id = $_POST['$user_id'];

    $dao = new Dao();
    $dao->deleteUser($user_id);

    header('Location: logout.php');
    exit();
    