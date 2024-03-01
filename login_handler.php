<!-- check login creds & redirect to todo.php -->
<?php
    require_once 'Dao.php';

    $username = $_POST['un'];
    $password = $_POST['pw'];

    $dao = new Dao();
    // verify username & password
    // if (getUserPassword($username)['password'] != password) {
        // notify user that username-password combo don't match
        // redir to error login page

    // }

    header('Location: todo.php');
    exit;