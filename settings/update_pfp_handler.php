<?php
    session_start();
    require_once '../Dao.php';

    $new_pfp_link = $_POST['pfp_link'];

    if ($new_pfp_link) {
        $dao = new Dao();

        $dao->updateUserPFP($_SESSION['username'], $new_pfp_link);
        $_SESSION['user_pfp_link'] = $new_pfp_link;
    }


    header('Location: ../settings.php');
    exit();