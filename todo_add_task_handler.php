<?php
    session_start();
    require_once 'Dao.php';

    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $task_due = $_POST['task_due'];
    $task_color = $_POST['task_color'];
    $task_status = $_POST['task_status'];
    $task_completed_date = 0;

    $messages = array();

    $dao = new Dao();

    if (0 === strlen($task_name)) {
        $messages[] = "Please enter a name.";
    }

    $pieces = explode("-", $task_due);
    if (!(checkdate($pieces[1], $pieces[2],$pieces[0]))) {
        $messages[] = "Enter a valid date.";
    }

    if (!preg_match("/^#([a-fA-F0-9]{6})/", $task_color)) {
        $messages[] = "Enter a valid color.";
    }

    if ("Completed" === $task_status) {
        $task_completed_date = date('Y-m-d');
        $_SESSION['todays_progress'] = $dao->getTodaysProgress($_SESSION['user_id']);
    }
    
    /* print out messages */
    if (0 < count($messages)) {
        $_SESSION['messages'] = $messages;
        $_SESSION['inputs'] = $_POST;
    }
    
    $dao->saveTask($_SESSION['user_id'], $task_name, $task_desc, $task_due, $task_color, $task_status, $task_completed_date);
    header('Location: todo.php');
    exit;