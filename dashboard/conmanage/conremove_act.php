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
    $sql="SELECT `con_start` FROM `".$usr_id."` WHERE `con_name` LIKE '".$container."'";
    $query=mysql_query($sql);
    while($row=mysql_fetch_array($query))
    {
        if($row[0]==1)
        {
            shell_exec("sudo docker stop ".$container);
        }
    }
    $sql="DELETE FROM `".$usr_id."` WHERE `con_name` LIKE '".$container."'";
    mysql_query($sql);
    $sql="DELETE FROM `portmanager` WHERE `container` LIKE '".$container."'";
    mysql_query($sql);
    shell_exec("sudo docker rm ".$container);
    mysql_close();
    header('Location: ./');
?>
