<!-- check login creds & redirect to todo.php -->
<?php
    require_once 'Dao.php';

    $username = $_POST['un'];
    $password = $_POST['pw'];

    $dao = new Dao();
    // verify username & password

    header('Location: todo.php');
    exit;