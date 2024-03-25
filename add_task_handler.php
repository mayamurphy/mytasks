<?php
    require_once 'Dao.php';

    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $task_due = $_POST['task_due'];
    $task_color = $_POST['task_color'];
    $task_status = $_POST['task_status'];

    if ("Completed" === $task_status) {
        $_SESSION['todays_progress'] = $dao->getTodaysProgress();
    }

    $dao = new Dao();
    $dao->saveTask($task_name, $task_desc, $task_due, $task_color, $task_status);

    header('Location: todo.php');
    exit;