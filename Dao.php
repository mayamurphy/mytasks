<?php
    require_once 'KLogger.php';

    class Dao {

    private $host = "l9dwvv6j64hlhpul.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db = "rqbdbs0p9aoruwo7";
    private $user = "ebpl0unrvz4jmcmu";
    private $pass = "vuk0katccii0kcge";

    // private $host = "localhost";
    // private $db = "mytasks";
    // private $user = "root";
    // private $pass = "";

    protected $logger;

    public function getConnection () {
        return
        new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
            $this->pass);
    }

    public function __construct() {
        $this->logger = new KLogger ( "log.txt" , KLogger::DEBUG );
        $conn = $this->getConnection();
        $users_table = "CREATE TABLE IF NOT EXISTS 
                        users (user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                        username VARCHAR(64) NOT NULL UNIQUE, 
                        email VARCHAR(256) NOT NULL, 
                        password VARCHAR(128) NOT NULL, 
                        pfp_link VARCHAR(256) NOT NULL);";
        $q = $conn->prepare($users_table);
        $q->execute();

        $tasks_table = "CREATE TABLE IF NOT EXISTS
                        tasks (task_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                        user_id INT NOT NULL, task_name VARCHAR(4096) NOT NULL, 
                        task_desc VARCHAR(4096), task_due DATE NOT NULL, 
                        task_color VARCHAR(7) NOT NULL, 
                        task_status VARCHAR(12) NOT NULL, 
                        task_created_date DATE NOT NULL, 
                        task_completed_date DATE NOT NULL,
                        FOREIGN KEY (user_id) REFERENCES users(user_id));";
        $q = $conn->prepare($tasks_table);
        $q->execute();
    }

    /* used for updating db */
    public function updateDB() {
        $conn = $this->getConnection();
        $saveQuery = "";
        $q = $conn->prepare($saveQuery);
        $q->execute();
    }

    /* user stuff */
    public function addUser($username, $email, $password) {
        $options = ['cost' => 10,];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $conn = $this->getConnection();
        $saveQuery = 
            "INSERT INTO users (username, email, password, pfp_link)
            VALUE (:username, :email, :password, 'images/Default_pfp.png')";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":username",$username);
        $q->bindParam(":email",$email);
        $q->bindParam(":password",$password);
        $q->execute();
    }

    public function deleteUser($user_id) {
        // delete all of user's tasks
        $allTasks = $this->getAllTasks($user_id)[0];
        foreach($allTasks['task_id'] as $task_id) {
            $this->deleteTask($task_id);
        }

        // delete user
        $conn = $this->getConnection();
        $saveQuery = "DELETE FROM users WHERE user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":user_id",$user_id);
        $q->execute();

        $this->logger->LogInfo("deleteUser: [{$user_id}]");
    }

    public function usernameExists($username) {
        $this->logger->LogInfo("usernameExists: [{$username}]");
        $conn = $this->getConnection();
        $res = $conn->query("SELECT username FROM users WHERE username = '{$username}';")->fetchAll(PDO::FETCH_ASSOC);
        return $res ? true : false;
    }

    public function validUserPassword($username, $password) {
        $conn = $this->getConnection();
        $res = $conn->query("SELECT password FROM users WHERE username = '{$username}';")->fetchAll(PDO::FETCH_ASSOC);
        return password_verify($password, $res[0]['password']);
    }

    public function getUserInfo($username) {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM users WHERE username = '{$username}'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserPFP($username, $pfp_link) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE users
                        SET pfp_link = :pfp_link
                        WHERE username = :username";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":username",$username);
        $q->bindParam(":pfp_link",$pfp_link);
        $q->execute();
    }

    /* get tasks */
    public function getTodoTasks($user_id) {
        $this->logger->LogInfo("getTodoTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE user_id = '{$user_id}'
                            AND task_status !='Completed'
                            ORDER BY task_due ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompletedTasks($user_id) {
        $this->logger->LogInfo("getCompletedTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT *
                            FROM tasks 
                            WHERE user_id = '{$user_id}'
                            AND task_status ='Completed'
                            ORDER BY task_due ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTasks($user_id) {
        $this->logger->LogInfo("getAllTasks");
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM tasks WHERE user_id = {$user_id}")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function taskExists($task_id) {
        $this->logger->LogInfo("taskExists: [{$task_id}]");
        $conn = $this->getConnection();
        $res = $conn->query("SELECT task_id FROM tasks WHERE task_id = '{$task_id}';")->fetchAll(PDO::FETCH_ASSOC);
        return $res ? true : false;
    }

    public function getTask($user_id, $task_id) {
        $this->logger->LogInfo("getTask: [{$task_id}], [{$user_id}]");
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM tasks WHERE task_id = '{$task_id}' AND user_id = '{$user_id}';")->fetchAll(PDO::FETCH_ASSOC);
    }

    /* calculates today's progress */
    public function getTodaysProgress($user_id) {
        $conn = $this->getConnection();
        $date = date('Y-m-d');

        // completed today / due today
        $completed_today = count($conn->query("SELECT *
                                FROM tasks 
                                WHERE user_id = '{$user_id}'
                                AND task_status ='Completed'
                                AND task_completed_date = '{$date}'")->fetchAll(PDO::FETCH_ASSOC));
        
        $due_today = count($conn->query("SELECT *
                                FROM tasks 
                                WHERE user_id = '{$user_id}'
                                AND task_due = '{$date}'")->fetchAll(PDO::FETCH_ASSOC));
        if (0 == $due_today) {
            return 0;
        }
        else {
            return round((($completed_today / $due_today) * 100), 0);
        }
    }

    /* update tasks */
    public function updateTaskName($user_id, $task_id, $new_task_name) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_name = :new_task_name
                        WHERE task_id = :task_id AND user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":new_task_name",$new_task_name);
        $q->execute();
        $this->logger->LogInfo("updateTaskName: [{$task_id}], [{$new_task_name}]");
    }

    public function updateTaskDesc($user_id, $task_id, $new_task_desc) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_desc = :new_task_desc
                        WHERE task_id = :task_id AND user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":new_task_desc",$new_task_desc);
        $q->execute();
        $this->logger->LogInfo("updateTaskDesc: [{$task_id}], [{$new_task_desc}]");
    }

    public function updateTaskDueDate($user_id, $task_id, $new_task_due_date) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_due_date = :new_task_due_date
                        WHERE task_id = :task_id AND user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":new_task_due_date",$new_task_due_date);
        $q->execute();
        $this->logger->LogInfo("updateTaskDueDate: [{$task_id}], [{$new_task_due_date}]");
    }

    public function updateTaskColor($user_id, $task_id, $new_task_color) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_color = :new_task_color
                        WHERE task_id = :task_id AND user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":new_task_color",$new_task_color);
        $q->execute();
        $this->logger->LogInfo("updateTaskColor: [{$task_id}], [{$new_task_color}]");
    }

    public function updateTaskStatus($user_id, $task_id, $new_task_status, $task_completed_date) {
        $conn = $this->getConnection();
        $saveQuery = "UPDATE tasks
                        SET task_status = :new_task_status,
                            task_completed_date = :task_completed_date
                        WHERE task_id = :task_id AND user_id = :user_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":new_task_status",$new_task_status);
        $q->bindParam(":task_completed_date", $task_completed_date);
        $q->execute();
        $this->logger->LogInfo("updateTaskStatus: [{$task_id}], [{$new_task_status}], [{$task_completed_date}]");
    }

    public function saveTask($user_id, $task_name, $task_desc, $task_due, $task_color, $task_status, $task_completed_date) {
        $conn = $this->getConnection();

        $task_id = 0;
        $task_created_date = date("Y-m-d");
        $saveQuery = "INSERT INTO tasks
            (task_id, user_id, task_name, task_desc, task_due, task_color, task_status, task_created_date, task_completed_date)
            VALUES
            (:task_id, :user_id, :task_name, :task_desc, :task_due, :task_color, :task_status, :task_created_date, :task_completed_date);";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->bindParam(":user_id",$user_id);
        $q->bindParam(":task_name",$task_name);
        $q->bindParam(":task_desc",$task_desc);
        $q->bindParam(":task_due",$task_due);
        $q->bindParam(":task_color",$task_color);
        $q->bindParam(":task_status",$task_status);
        $q->bindParam(":task_created_date",$task_created_date);
        $q->bindParam(":task_completed_date", $task_completed_date);
        $q->execute();

        $this->logger->LogInfo("saveTask: [{$task_id}], [{$task_name}], [{$task_desc}], [{$task_due}], [{$task_color}], [{$task_status}], [{$task_created_date}], [{$task_completed_date}]");
    }

    public function deleteTask($task_id) {
        $conn = $this->getConnection();
        $saveQuery = "DELETE FROM tasks WHERE task_id = :task_id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":task_id",$task_id);
        $q->execute();
        $this->logger->LogInfo("deleteTask: [{$task_id}]");
    }
  }