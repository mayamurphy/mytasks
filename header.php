<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    } else {
      header("Location: login.php");
      exit();
    }
    
    require_once 'Dao.php';
    $dao = new Dao();
    $_SESSION['todays_progress'] = $dao->getTodaysProgress();
?>
<html>
    <head>
        <link rel="stylesheet" href="header.css"/>
        <link rel="stylesheet" href="todo.css"/>
        <link rel="stylesheet" href="tasks-table.css"/>
        <link rel="stylesheet" href="progress-bar-style.php"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
        <link id="header-pfp" rel="icon" type="image/png" href="images/mytasks.png"/>
    </head>
    <body>
      <div class="header">
          <div class="header-logo"><img src="images/mytasks logo.png"/></div>
          <div class="welcome-username">
              <p>Welcome <?php echo $_SESSION['username'] ?>!</p>
          </div>
          <div class="user-dropdown">
              <img src="images/Default_pfp.png" alt="default profile picture">
              <div class="dropdown-content">
                  <a href="settings.php">Settings</a>
                  <a href="logout.php">Log out</a>
              </div>
          </div>
      </div>
      <hr>