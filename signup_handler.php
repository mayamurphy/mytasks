<?php
    session_start();
    require_once 'Dao.php';

    $email = $_POST['signup-email'];
    $username = $_POST['signup-un'];
    $password = $_POST['signup-pw'];
    $reenter_password = $_POST['signup-reenter-pw'];

    $messages = array();

    $dao = new Dao();

    // check if email is an email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages[] = "Please enter a valid email.";
    }

    // check if username is unique
    if (0 == strlen($username)) {   // No username entered
        $messages[] = "Please enter a username.";
    }
    else if ($dao->usernameExists($username)) {
        $messages[] = "Username taken. Try again.";
    }

    // No password entered
    if (0 == strlen($password)) {
        $messages[] = "Please enter a password.";
    }
    else if ($password !== $reenter_password) {
        $messages[] = "Passwords do not match.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: signup.php");
        exit();
    }
    else {
        $dao->addUser($username, $email, $password);
        header('Location: todo.php');
        exit();
    }

    