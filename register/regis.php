<?
    require_once('../script/config.php');
    include('../script/function.php');
    $user=$_REQUEST['u'];
    $pass=hashplz($_REQUEST['p']);
    $cpass=hashplz($_REQUEST['cp']);
    $mail=$_REQUEST['m'];

    //CONFIRM PASS CPASS MATCH
    if($pass!=$cpass)
    {
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

    echo 'DONE';
?>