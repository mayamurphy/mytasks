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
        $this->logger = new KLogger ( "log.txt" , KLogger::WARN );
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
    }

    public function usernameExists($username) {
        $conn = $this->getConnection();
        // $res = $conn->query("SELECT password FROM users WHERE username = :username")->fetchAll(PDO::FETCH_ASSOC);
        $res = $conn->query("SELECT password FROM users WHERE username = {$username}")->fetchAll(PDO::FETCH_ASSOC);
        return $res ? true : false;
    }

    public function getUserPassword($username) {
        $conn = $this->getConnection();
        // return $conn->query("SELECT password FROM users WHERE username = :username")->fetchAll(PDO::FETCH_ASSOC);
        return $conn->query("SELECT password FROM users WHERE username = {$username}")->fetchAll(PDO::FETCH_ASSOC);
    }

    /* get tasks */
    public function getTodoTasks() {
        $conn = $this->getConnection();
        // return $conn->query("SELECT task_name, task_desc, task_date, task_color, task_status 
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE task_status !='Completed'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompletedTasks() {
        $conn = $this->getConnection();
        // return $conn->query("SELECT task_name, task_desc, task_date, task_color, task_status 
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE task_status =='Completed'")->fetchAll(PDO::FETCH_ASSOC);
    }

    /* update tasks */
    public function updateTaskName($task_id, $new_task_name) {
        $conn = $this->getConnection();
        $saveQuery = "";
        
        $q = $conn->prepare($saveQuery);
        $q->execute();
    }

    public function updateTaskDesc($task_id, $new_task_desc) {
        $conn = $this->getConnection();
        $saveQuery = "";
        
        $q = $conn->prepare($saveQuery);
        $q->execute();
    
    }

    public function updateTaskDueDate($task_id, $new_task_due_date) {
        $conn = $this->getConnection();
        $saveQuery = "";
        
        $q = $conn->prepare($saveQuery);
        $q->execute();
    
    }

    public function updateTaskColor($task_id, $new_task_color) {
        $conn = $this->getConnection();
        $saveQuery = "";
        
        $q = $conn->prepare($saveQuery);
        $q->execute();

    }

    public function updateTaskProgress($task_id, $new_task_progress) {
        $conn = $this->getConnection();
        $saveQuery = "";
        
        $q = $conn->prepare($saveQuery);
        $q->execute();

    }

    public function saveTask($task_name, $task_desc, $task_due, $task_color, $task_status) {
        $conn = $this->getConnection();
        $saveQuery = 
            "INSERT INTO tasks
            (task_id, task_name, task_desc, task_date, task_color, task_status)
            VALUES
            (null,:task_name, :task_desc, :task_date, :task_color, :task_status)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_name",$task_name);
        $q->bindParam(":task_desc",$task_desc);
        $q->bindParam(":task_due",$task_due);
        $q->bindParam(":task_color",$task_color);
        $q->bindParam(":task_status",$task_status);
        $q->execute();
    }
  }