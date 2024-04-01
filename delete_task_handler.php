<?php
    session_start();
    require_once 'Dao.php';
    
    $location = $_POST['location'];
    $task_id = $_POST['task_id'];

    $dao = new Dao();

    if ($dao->taskExists($task_id)) {
        $dao->deleteTask($task_id);
    }

    header('Location: ' . $location);
    exit;