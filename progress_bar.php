<!DOCTYPE html>
            <head>
                <link rel="stylesheet" href="progress-bar-style.php"/>
            </head>
            <div class="progress-bar-and-more">
                <div class="progress-bar-container">
                    <h3>Today's Progress:</h3>
                    <div class="progress-bar">
                        <div id="progress">
                            <div id="progress-percent">
                                <?php echo $_SESSION['todays_progress']; ?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>