<!-- check login creds & redirect to todo.php -->
<?php
    session_start();
    require_once 'Dao.php';
    
    $username = $_POST['login-un'];
    $password = $_POST['login-pw'];

    $messages = array();

    $dao = new Dao();
    $username_exists = false;
    
    // verify username & password
    // No username entered
    if ($username === "" || 0 == strlen($username)) {
        $messages[] = "Please enter a username.";
    }
    else {
        $username_exists = $dao->usernameExists($username);
    } 

    // No password entered
    if (0 == strlen($password)) {
        $messages[] = "Please enter a password.";
    }

    if (!$username_exists || !$dao->validUserPassword($username, $password)) {
        // notify user that username-password combo don't match
        $messages[] = "Invalid username or password.";
    }

    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
        header("Location: login.php");
        exit();
    }
    else {
        $userinfo = $dao->getUserInfo($username)[0];

        $_SESSION['authenticated'] = "authenticated";
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $userinfo['user_id'];
        $_SESSION['user_pfp_link'] = $userinfo['pfp_link'];
        header('Location: todo.php');
        exit();
    }