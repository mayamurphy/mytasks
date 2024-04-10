<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    } else {
      header("Location: ../login.php");
      exit();
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/header.css"/>
        <link rel="stylesheet" href="../css/footer.css"/>
        <link rel="stylesheet" href="../css/main-content.css"/>
        <link rel="stylesheet" href="../css/settings.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
        <link id="header-pfp" rel="icon" type="image/png" href="../images/mytasks.png"/>
    </head>
    <body>
      <div class="header">
          <div class="header-logo"><img src="../images/mytasks logo.png"/></div>
          <div class="welcome-username">
              <p>Welcome <?php echo $_SESSION['username'] ?>!</p>
          </div>
          <div class="user-dropdown">
              <img src='../<?php echo $_SESSION['user_pfp_link']?>' alt="user profile picture">
              <div class="dropdown-content">
                  <a href="../settings.php">Settings</a>
                  <a href="../logout.php">Log out</a>
              </div>
          </div>
      </div>
      <hr>
        <div class="content">
            <div class="nav-bar">
                <ol>
                    <li><a href="../todo.php">To Do</a></li>
                    <li><a href="../completed.php">Completed</a></li>
                    <li><a href="../all-tasks.php">All</a></li>
                </ol>
            </div>
            <div class="settings">
                <div class='back-to-settings'>
                    <button><a href="../settings.php">< Back</a></button>
                    <h1>ACCOUNT SETTINGS</h1>
                    <hr>
                </div>