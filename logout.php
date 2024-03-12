<html>
    <h1>IMPLEMENT!!!!!!!</h1>
<!-- delete session cookie -->

</html>

<?php
    session_start();
    session_destroy();
    header("Location: index.php");
    exit;
?>