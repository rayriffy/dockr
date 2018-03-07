<?
    require_once('../../script/config.php');
    $container=$_REQUEST['CON'];
    $usr_id=$_COOKIE['usr_id'];
    $sql="UPDATE `".$usr_id."` SET `con_start`=0 WHERE `con_name` LIKE '".$container."'";
    mysql_query($sql);
    shell_exec("env && sudo docker stop ".$container);
    mysql_close();
    header('Location: ./');
?>
