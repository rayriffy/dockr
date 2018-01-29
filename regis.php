<?
    require_once('script/config.php');
    include('script/function.php');
    $user=$_REQUEST['u'];
    $pass=hashplz($_REQUEST['p']);
    $mail=$_REQUEST['m'];
    $sql="INSERT INTO `userdata`(`usr_id`, `usrname`, `password`, `email`) VALUES (1,'rayriffy','".$pass."','rayriffy@gmail.com')";
    $query=mysql_query($sql);
    mysql_close();
    echo 'DONE';
?>