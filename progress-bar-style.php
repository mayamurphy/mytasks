<?php 
    require_once 'Dao.php';
    $dao = new Dao();
    header("Content-type: text/css"); 
?>

#progress {
    height: 100%;
    width: <?php echo $dao->getTodaysProgress() . "%"?>;

    background-color: #09bb46;
    border-radius: 50px;
    border-style: none;
}