<?php
    session_start();
    require_once "../Dao.php";

    $messages = array();
    $dao = new Dao();

    $confirm_username = $_POST['delete-username'];

    if (0 == strlen($confirm_username)) {
        $messages[] = "Username not entered.";
    }
    else if ($_SESSION['username'] !== $confirm_username) {
        $messages[] = "Usernames do not match.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        header("Location: delete_account.php");
        exit();
    }
    else {
        $dao->deleteUser($_SESSION['user_id']);
        header('Location: ../logout.php');
        exit();
    }
