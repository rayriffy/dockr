<?
    require_once('../../script/config.php');
    $container=$_REQUEST['CON'];
    $usr_id=$_COOKIE['usr_id'];
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
    shell_exec("sudo docker rm ".$container);
    mysql_close();
    header('Location: ./');
?>
