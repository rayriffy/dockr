<?
    require_once('../script/config.php');
    include('../script/function.php');
    $user=$_REQUEST['u'];
    $pass=hashplz($_REQUEST['p']);
    $cpass=hashplz($_REQUEST['cp']);
    $mail=$_REQUEST['m'];

    //CONFIRM NO USERNAME OR EMAIL DUP
    $usermaildup=null;
    $sql="SELECT `usr_id` FROM `userdata` WHERE `usrname` LIKE '".$user."' OR `email` LIKE '".$mail."'";
    $query=mysql_query($sql);
    while($row=mysql_fetch_array($query))
    {
        $usermaildup=$row[0];
    }
    if($usermaildup!=null)
    {
        setcookie('regis_stat',7500,time()+6000,'/');
        header('Location: ./');
        die(':P');
    }

    //CONFIRM PASS CPASS MATCH
    if($pass!=$cpass)
    {
        setcookie('regis_stat',7600,time()+6000,'/');
        header('Location: ./');
        die(':P');
    }

    //COUNT
    $sql="SELECT `usr_id` FROM `userdata` WHERE 1";
    $query=mysql_query($sql);
    $usr_id=mysql_num_rows($result);
    $usr_id++;

    //CREATE SUBNET
    $subn = rand(0,255).".".rand(0,255).".0.0";

    //CHECK IF SUBNET DUPLICATED
    $subndup="212121";
    while($ipdup!=null)
    {
        $subndup=null;
        $sql="SELECT `netmask` FROM `userdata` WHERE `netmask` LIKE '".$subn."'";
        $query=mysql_query($sql);
        while($row=mysql_fetch_array($query))
        {
            $subndup=$row[0];
        }
        $subn = rand(0,255).".".rand(0,255).".0.0";
    }

    //CREATE DOCKER BRIDGE
    $cmd="docker network create --subnet=".$subn."/16 usr".$usr_id;
    $output=shell_exec($cmd);

    //OPERATION AND DONE
    $sql="INSERT INTO `userdata`(`usr_id`, `usrname`, `password`, `email`, `netmask`) VALUES (".$usr_id.",'".$user."','".$pass."','".$mail."','".$subn."')";
    $query=mysql_query($sql);
    $sql="CREATE TABLE `".$usr_id."` (
        `con_name` text NOT NULL,
        `con_image` text NOT NULL,
        `con_time` int(255) NOT NULL,
        `con_ip` text NOT NULL,
        `con_start` int(1) NOT NULL DEFAULT '0'
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $query=mysql_query($sql);
    mysql_close();
    setcookie('regis_stat',4261,time()+6000,'/');
    header('Location: ../');
?>