<?php
    require_once 'KLogger.php';

    class Dao {

    private $host = "localhost";
    private $db = "mytasks";
    private $user = "root";
    private $pass = "";
    protected $logger;

    public function getConnection () {
        return
        new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
            $this->pass);
    }

    public function __construct() {
        $this->logger = new KLogger ( "log.txt" , KLogger::DEBUG );
    }

    /* user stuff */
    public function addUser($username, $email, $password) {
        $conn = $this->getConnection();
        $saveQuery = 
            "INSERT INTO users (username, email, password)
            VALUE (:username, :email, :password)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":username",$username);
        $q->bindParam(":email",$email);
        $q->bindParam(":password",$password);
        $q->execute();

        $this->logger->LogInfo("addUser: [{$username}], [{$email}], [{$password}]");
    }

    public function usernameExists($username) {
        $this->logger->LogInfo("usernameExists: [{$username}]");
        $conn = $this->getConnection();
        $res = $conn->query("SELECT username FROM users WHERE username = '{$username}';")->fetchAll(PDO::FETCH_ASSOC);
        return $res ? true : false;
    }

    public function validUserPassword($username, $password) {
        $this->logger->LogInfo("validUserPassword: [{$username}], [{$password}]");
        $conn = $this->getConnection();
        $res = $conn->query("SELECT password FROM users WHERE username = '{$username}';")->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['password'] === $password ? true : false;;
    }

    /* get tasks */
    public function getTodoTasks() {
        $this->logger->LogInfo("getTodoTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE task_status !='Completed'
                            ORDER BY task_due ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompletedTasks() {
        $this->logger->LogInfo("getCompletedTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE task_status ='Completed'
                            ORDER BY task_due ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTasks() {
        $this->logger->LogInfo("getAllTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);
    }

    /* calculates today's progress */
    public function getTodaysProgress() {
        $conn = $this->getConnection();
        $date = date('Y-m-d');

        // completed today / due today
        $completed_today = count($conn->query("SELECT *
                                FROM tasks 
                                WHERE task_status ='Completed'
                                and task_completed_date = '{$date}'")->fetchAll(PDO::FETCH_ASSOC));
        
        $due_today = count($conn->query("SELECT *
                                FROM tasks 
                                WHERE task_due = '{$date}'")->fetchAll(PDO::FETCH_ASSOC));
        if (0 == $due_today) {
            return 0;
        }
        else {
            return ($completed_today / $due_today) * 100;
        }
    }

    /* update tasks */
    public function updateTaskName($task_id, $new_task_name) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_name = :new_task_name
                        WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->execute();
        $this->logger->LogInfo("updateTaskName: [{$task_id}], [{$new_task_name}]");
    }

    public function updateTaskDesc($task_id, $new_task_desc) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_desc = :new_task_desc
                        WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":new_task_desc",$new_task_desc);
        $q->execute();
        $this->logger->LogInfo("updateTaskDesc: [{$task_id}], [{$new_task_desc}]");
    }

    public function updateTaskDueDate($task_id, $new_task_due_date) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_due_date = :new_task_due_date
                        WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":new_task_due_date",$new_task_due_date);
        $q->execute();
        $this->logger->LogInfo("updateTaskDueDate: [{$task_id}], [{$new_task_due_date}]");
    }

    public function updateTaskColor($task_id, $new_task_color) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_color = :new_task_color
                        WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":new_task_color",$new_task_color);
        $q->execute();
        $this->logger->LogInfo("updateTaskColor: [{$task_id}], [{$new_task_color}]");
    }

    public function updateTaskStatus($task_id, $new_task_status, $task_completed_date) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_status = :new_task_status,
                            task_completed_date = :task_completed_date
                        WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":new_task_status",$new_task_status);
        $q->bindParam(":task_completed_date", $task_completed_date);
        $q->execute();
        $this->logger->LogInfo("updateTaskStatus: [{$task_id}], [{$new_task_status}], [{$task_completed_date}]");
    }

    public function saveTask($task_name, $task_desc, $task_due, $task_color, $task_status, $task_completed_date) {
        $conn = $this->getConnection();

        $task_id = 0;
        $task_added_date = date("Y-m-d");
        $saveQuery = "INSERT INTO tasks
            (task_id, task_name, task_desc, task_due, task_color, task_status, task_added_date, task_completed_date)
            VALUES
            (:task_id, :task_name, :task_desc, :task_due, :task_color, :task_status, :task_added_date, :task_completed_date);";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":task_name",$task_name);
        $q->bindParam(":task_desc",$task_desc);
        $q->bindParam(":task_due",$task_due);
        $q->bindParam(":task_color",$task_color);
        $q->bindParam(":task_status",$task_status);
        $q->bindParam(":task_added_date",$task_added_date);
        $q->bindParam(":task_completed_date", $task_completed_date);
        $q->execute();

        $this->logger->LogInfo("saveTask: [{$task_id}], [{$task_name}], [{$task_desc}], [{$task_due}], [{$task_color}], [{$task_status}], [{$task_added_date}], [{$task_completed_date}]");
    }
  }