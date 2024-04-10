<!DOCTYPE html>
    <head>
        <title>Update Password</title>
    </head>
    <?php
        require_once 'settings_header.php'
    ?>
    <div class='update-content'>
        <h2>Update Password</h2>    
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
        <div class='update-password'>
            <form method='post' action='update_password_handler.php'>
                <div>
                    <label for="old-pw">Old Password:</label>
                    <input type="password" placeholder="Enter Password" id="old-pw" name="old-pw">
                </div>
                <div>
                    <label for="new-pw">New Password:</label>
                    <input type="password" placeholder="Enter New Password (7+ characters)" id="new-pw" name="new-pw">
                </div>
                <div>
                    <label for="reenter-new-pw">Re-enter Password:</label>
                    <input type="password" placeholder="Re-enter Password" id="reenter-new-pw" name="reenter-new-pw">
                </div>
                <div class='update-password-button'><button type="submit">Update Password</button></div>
            </form>
        </div>
    </div>

    <?php require_once 'settings_footer.php'?>

