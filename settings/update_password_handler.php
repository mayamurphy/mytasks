<?php
    session_start();
    require_once '../Dao.php';

    $old_password = $_POST['old-pw'];
    $new_password = $_POST['new-pw'];
    $reenter_new_password = $_POST['reenter-new-pw'];

    $messages = array();
    $dao = new Dao();

    // No password entered
    if (0 == strlen($old_password)) {
        $messages[] = "Please enter your password.";
    }
    else if (!$dao->validUserPassword($_SESSION['username'], $old_password)) {
        $messages[] = "Invalid password.";
    }

    if ($new_password === $old_password) {
        $messages[] = "Please enter a new password.";
    }
    else if (0 == strlen($new_password)) {
        $messages[] = "Please enter a password.";
    }
    else if (7 > strlen($new_password)) {
        $messages[] = "New Password is not long enough.";
    }
    else if ($new_password !== $reenter_new_password) {
        $messages[] = "New Passwords do not match.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        header("Location: update_password.php");
        exit();
    }
    else {
        $dao->updateUserPassword($_SESSION['username'], $new_password);
        header('Location: ../logout.php');
        exit();
    }