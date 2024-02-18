<?php require_once "header.php"; ?>
<title>TODO ✅</title>
 <div class="left">
    <div id="todo">
        <div class="task-list">
            <?php require_once "tasks.php" ?>
        </div>
    </div>
</div>
<div class="right">
    <div id="progress-bar-container">
        <h3>Today's Progress:</h3>
        <div id="progress-bar"></div>
    </div>
    <div id="calendar-container"> 
        <h3>[Month]</h3>
        <div id="calendar"></div>
    </div>
</div>  
<?php require_once "footer.php"; ?>