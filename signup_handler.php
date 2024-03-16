<?php
    session_start();
    require_once 'Dao.php';

    $email = $_POST['email'];
    $username = $_POST['un'];
    $password = $_POST['pw'];
    $reenter_password = $_POST['signup-reenter-pw'];

    $messages = array();
    $_SESSION['messages'] = $messages;

    $dao = new Dao();
    // check if email is an email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages[] = "Please enter a valid email.";
    }

    // check if username is unique
    if (0 == strlen($username)) {
        $messages[] = "Please enter a username.";
    }
    else if ($dao->usernameExists($username)) {
        $messages[] = "Username taken. Try again.";
    }

    if (0 == strlen($password)) {
        $messages[] = "Please enter a password.";
    }
    else if ($password !== $reenter_password) {
        $messages[] = "Passwords do not match.";
    }

    if (0 < count($messages)) {
        /* print out messages */
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: index.php");
        exit();
    }
    else {
        $dao->addUser($username, $email, $password);
        header('Location: todo.php');
        exit();
    }

    