<!-- check login creds & redirect to todo.php -->
<?php
    session_start();
    require_once 'Dao.php';
    
    $username = $_POST['un'];
    $password = $_POST['pw'];

    $messages = array();
    $_SESSION['messages'] = $messages;

    $dao = new Dao();
    // verify username & password
    if (0 == strlen($username)) {
        $messages[] = "Please enter a username.";
    }

    if (0 == strlen($password)) {
        $messages[] = "Please enter a password.";
    }

    if ($dao->getUserPassword($username)['password'] !== $password) {
        // notify user that username-password combo don't match
        $messages[] = "Invalid username or password. Please try again.";
    }

    if (0 < count($messages)) {
        /* print out messages */
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: index.php");
        exit();
    }
    else {
        $_SESSION['authenticated'] = "authenticated";
        header('Location: todo.php');
        exit();
    }