<?php
    session_start();
    require_once "../Dao.php";

    $new_email = $_POST['new-email'];

    $messages = array();

    $dao = new Dao();

    // check if email is an email
    if (0 == strlen($new_email)) {
        $messages[] = "Please enter an email.";
    }
    else if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $messages[] = "Please enter a valid email.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: update_email.php");
        exit();
    }
    else {
        $dao->updateUserEmail($_SESSION['username'], $new_email);
        header('Location: ../settings.php');
        exit();
    }