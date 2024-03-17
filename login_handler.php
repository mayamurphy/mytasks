<!-- check login creds & redirect to todo.php -->
<?php
    session_start();
    require_once 'Dao.php';
    
    $username = $_POST['login-un'];
    $password = $_POST['login-pw'];

    $messages = array();

    $dao = new Dao();
    $username_exists = $dao->usernameExists($username);

    // verify username & password
    // No username entered
    if (0 == strlen($username)) {
        $messages[] = "Please enter a username.";
    }
    else if (!$username_exists || $dao->getUserPassword($username)['password'] !== $password) {
        // notify user that username-password combo don't match
        $messages[] = "Invalid username or password.";
    }

    // No password entered
    if (0 == strlen($password)) {
        $messages[] = "Please enter a password.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: login.php");
        exit();
    }
    else {
        $_SESSION['authenticated'] = "authenticated";
        header('Location: todo.php');
        exit();
    }