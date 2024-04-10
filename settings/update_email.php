<!DOCTYPE html>
    <head>
        <title>Update Email</title>
    </head>
    <?php
        require_once 'settings_header.php'
    ?>
    <div class='update-content'>
        <h2>Update Email</h2>    
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
        <div class='update-email'>
            <form method='post' action='update_email_handler.php'>
                <div id='display-email'>
                    Current E-mail: 
                    <?php 
                        require_once "../Dao.php";
                        $dao = new Dao();
                        echo htmlspecialchars($dao->getUserInfo($_SESSION['username'])[0]['email']);
                    ?>
                </div>
                <div>
                    <label for="email">New E-Mail:</label>
                    <input type="email" placeholder="Enter new E-Mail" id="new-email" name="new-email"
                        value="<?php echo isset($_SESSION['inputs']['new-email']) ? htmlspecialchars($_SESSION['inputs']['new-email']) : ""; ?>">
                </div>
                <div class='update-email-button'><button type="submit">Update email</button></div>
            </form>
        </div>
    </div>

    <?php require_once 'settings_footer.php'?>

