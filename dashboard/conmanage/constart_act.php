<?
    require_once('../../script/config.php');
    $container=$_REQUEST['CON'];
    $usr_id=$_COOKIE['usr_id'];
    list($usr, $cache) = explode("_",$container);
    $usrv="usr".$usr_id;
    if($usr!=$usrv)
    {
        //PERMISSION DENINED
        setcookie('con_stat',7501,time()+6000,'/');
        header('Location: ./');
        die();
    }
    $sql="UPDATE `".$usr_id."` SET `con_start`=1 WHERE `con_name` LIKE '".$container."'";
    mysql_query($sql);
    shell_exec("sudo docker start ".$container);
    mysql_close();
    header('Location: ./');
?>
