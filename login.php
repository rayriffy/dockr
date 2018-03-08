<?
    require_once('script/config.php');
    include('script/function.php');
    $user=$_REQUEST['u'];
    $pass=hashplz($_REQUEST['p']);
    $sql="SELECT * FROM `userdata` WHERE `usrname` LIKE '".$user."' AND `password` LIKE '".$pass."'";
    $query=mysql_query($sql);
    echo $sql;
    $login_suc=0;
    while($row=mysql_fetch_array($query))
    {
      $login_suc=2;
      $user_id=$row[0];
    }
    mysql_close();
    if($login_suc!=2)
    {
      //FAIL
      setcookie('login_stat',7700,time()+6000,'/');
      header('Location: ./');
      die('X.X');
    }
    else
    {
      setcookie('login_stat',null,time()-7200,'/');
      setcookie('token',hash('fnv164', "t7Rd4XTi".$user_id, false),time()+7200,'/');
      setcookie('usr_id',$user_id,time()+7200,'/');
      header('Location: dashboard/');
    }
?>