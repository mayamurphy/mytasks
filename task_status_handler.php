<?php
    session_start();
    require_once 'Dao.php';

    $location = $_POST['location'];
    $task_id = $_POST['task_id'];
    $new_task_status = $_POST['new_task_status'];

    $dao = new Dao();

    if ($new_task_status !== 'Completed' & $new_task_status !== 'In Progress' & $new_task_status !== 'Not Started') {
        $new_task_status = 'Not Started';
    }

    if ("Completed" == $new_task_status) {
        $task_completed_date = date('Y-m-d');
    }
    else {
        $task_completed_date = 0; 
    }

    $dao->updateTaskStatus($_SESSION['user_id'], $task_id, $new_task_status, $task_completed_date);
    $_SESSION['todays_progress'] = $dao->getTodaysProgress($_SESSION['user_id']);

    header('Location: ' . $location);
    exit;