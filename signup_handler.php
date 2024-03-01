<?php
    require_once 'Dao.php';

    $email = $_POST['email'];
    $username = $_POST['un'];
    $password = $_POST['pw'];
    // $re-enter-password = $_POST['signup-reenter-pw'];

    $dao = new Dao();
    // check if username is unique
    if (usernameExists($username) == 1) {

    }
    
    // if ($password !== $re-enter-password) { // check if pw are the same
        // re-dir to "passwords don't match page"
        // header('Location: ');
    // }

    $dao->addUser($username, $email, $password);
    // log user in

    header('Location: todo.php');
    exit;