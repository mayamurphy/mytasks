            <head>
                <link rel="stylesheet" href="progress-bar-style.php"/>
            </head>
            <div class="progress-bar-and-cal">
                <div class="progress-bar-container">
                    <h2>Today's Progress:</h2>
                    <div class="progress-bar">
                        <div id="progress">
                            <div id="progress-percent">
                                <?php echo $_SESSION['todays_progress']; ?>%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calendar-container">
                    <h1><?php echo date("F"); ?></h1>
                    <div class="calendar"></div>
                </div>
            </div>