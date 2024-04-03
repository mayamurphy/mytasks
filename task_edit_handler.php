<?php 
    session_start();
    require_once 'Dao.php';

    $location = $_POST['location'];
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $task_due = $_POST['task_due'];
    $task_color = $_POST['task_color'];
    $task_status = $_POST['task_status'];
    $task_completed_date = 0;

    $user_id = $_SESSION['user_id'];

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

    $oldTask = $dao->getTask($user_id, $task_id)[0];
    if ($oldTask['task_name'] !== $task_name) {
        $dao->updateTaskName($user_id, $task_id, $task_name);
    }

    if ($oldTask['task_desc'] !== $task_desc) {
        $dao->updateTaskDesc($user_id, $task_id, $task_desc);
    }

    if ($oldTask['task_due'] !== $task_due) {
        $dao->updateTaskDueDate($user_id, $task_id, $task_due);
    }

    if ($oldTask['task_color'] !== $task_color) {
        $dao->updateTaskColor($user_id, $task_id, $task_color);
    }

    if ($oldTask['task_status'] !== $task_status) {
        $dao->updateTaskStatus($user_id, $task_id, $task_status, $task_completed_date);
    }

    header('Location: ' . $location);
    exit;