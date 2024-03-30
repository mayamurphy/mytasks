<?php 
    require_once '../Dao.php';
    $dao = new Dao();
    header("Content-type: text/css"); 
?>

#progress {
    height: 100%;
    width: <?php echo $dao->getTodaysProgress() . "%"?>;
    max-width: 100%;

    background-color: #09bb46;
    border-radius: 50px;
    border-style: none;
}