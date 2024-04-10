<!DOCTYPE html>
    <head>
        <title>Change Profile Picture</title>
    </head>
    <?php
        require_once 'settings_header.php'
    ?>
    <div class='update-pfp-content'>
        <!-- <div class='update-pfp-back'><button>< Back</button></div> -->
        <h2>Change Profile Picture</h2>
        <div class='display-pfp'>
            <img src='../<?php echo $_SESSION['user_pfp_link']?>'>
        </div>
        <div class='update-pfp'>
            <form method='post' action='update_pfp_handler.php'>
                <table>
                    <?php 
                        $pfplinks = scandir("../images/pfp");
                        $count = 0;
                        foreach($pfplinks as $link) {
                            if ('.' != $link && '..' != $link) {
                                $link = 'images/pfp/' . $link;
                                if (0 == ($count % 5)) {
                                    echo '</td><tr>';
                                }
                                
                                echo '<td>
                                        <label>
                                            <input type="radio" id="pfp" name="pfp_link" value=' . $link . '>
                                            <img src=../' . $link . '>
                                        </label>
                                    </td>';
                                $count = $count + 1;
                            }
                        }
                    ?>
                    
                </table>
                <div class='update-pfp-button'><button type="submit">Save Changes</button></div>
            </form>
        </div>
    </div>

    <?php require_once 'settings_footer.php'?>

