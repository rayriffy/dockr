<?
    require_once('../../script/config.php');
    //GET REQUIRED INFORMATION
    $name = $_REQUEST['concre_name'];
    $usr_id = $_COOKIE['usr_id'];
    $image = $_REQUEST['concre_image'];
    $time = time()+rand(10,40);
    $ip = rand(0,255).".".rand(0,255).".".rand(0,255).".".rand(0,255);

    #OPERATION AND DONE
    $sql = "INSERT INTO `".$usr_id."`(`con_name`, `con_image`, `con_time`, `con_ip`) VALUES ('".$name."','".$image."',".$time.",'".$ip."')";
    $query = mysql_query($sql);
    mysql_close();
    header('Location: ./');
?>