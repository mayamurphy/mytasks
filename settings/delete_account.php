<!DOCTYPE html>
    <head>
        <title>Delete Account</title>
    </head>
    <?php
        require_once 'settings_header.php'
    ?>
    <div class='update-content'>
        <h2>Delete Account</h2>    
        <div class="error-messages">
            <?php
                if (isset($_SESSION['messages'])) {
                    foreach ($_SESSION['messages'] as $message) {
                        echo "<div class='message'>{$message}</div>";
                    }
                    unset($_SESSION['messages']);
                }
            ?>
        </div>
        <div class="delete-account">
            <form method="post" action="delete_account_handler.php">
                <div id='display-un'>
                    Username: 
                    <?php 
                        require_once "../Dao.php";
                        $dao = new Dao();
                        echo htmlspecialchars($dao->getUserInfo($_SESSION['username'])[0]['username']);
                    ?>
                </div>
                <div>
                    <label for="delete-username">Confirm Username: </label>
                    <input type="text" name="delete-username">
                </div>
                <div class="delete-account-button"><button type="submit">Delete Account</button></div>
            </form>
        </div>
    </div>

    <?php require_once 'settings_footer.php'?>