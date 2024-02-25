<?php

  class Dao {

    public $filename;

    private $host = "localhost";
    private $db = "mytasks";
    private $user = "root";
    private $pass = "";

    public function getConnection () {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
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

    public function getUser($username) {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM users WHERE username = :username")->fetchAll(PDO::FETCH_ASSOC);
    }

    /* task stuff */
    public function getTodoTasks() {
        $conn = $this->getConnection();
        return $conn->query("SELECT task_name, task_desc, task_date, task_color, task_status 
                            FROM tasks 
                            WHERE task_status !='Completed'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompletedTasks() {
        $conn = $this->getConnection();
        return $conn->query("SELECT task_name, task_desc, task_date, task_color, task_status 
                            FROM tasks 
                            WHERE task_status =='Completed'")->fetchAll(PDO::FETCH_ASSOC);
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