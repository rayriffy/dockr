<?
    require_once('../../script/config.php');

    //GET REQUIRED INFORMATION
    $usr_id = $_COOKIE['usr_id'];
    $image = $_REQUEST['concre_image'];
    $port_con=$_POST['conport'];
    $port_bind=$_POST['bindport'];
    $time = time()+rand(10,40);
    $name = "usr".$usr_id."_".$_REQUEST['concre_name'];

    //CALCULATING IP
    $sql="SELECT `netmask` FROM `userdata` WHERE `usr_id` LIKE '".$usr_id."'";
    $query=mysql_query($sql);
    while($row=mysql_fetch_array($query))
    {
        $mask=$row[0];
    }
    list($m1, $m2, $m3, $m4) = explode(".",$mask);
    $ip = $m1.".".$m2.".".rand(0,255).".".rand(0,255);

    //CHECK IF IP DUPLICATED
    $ipdup="212121";
    while($ipdup!=null)
    {
        $ipdup=null;
        $sql="SELECT * FROM `".$usr_id."` `con_ip` LIKE '".$ip."'";
        $query=mysql_query($sql);
        while($row=mysql_fetch_array($query))
        {
            $ipdup=$row[0];
        }
        $ip = $m1.".".$m2.".".rand(0,255).".".rand(0,255);
    }

    //BIND PORT
    $issqlport=false;
    $sqlport="";
    if($port_bind && $port_con)
    {
        $issqlport=true;
        for($i=0;$i<count($port_con);$i++)
        {
            if($port_bind[$i]!=null && $port_con[$i]!=null)
            {
                $sqlport=$sqlport."-p ".$port_bind[$i].":".$port_con." ";
            }
        }
    }

    //SELECT CONTAINER
    switch ($image) {
        case "centos":
            $imageres="centos:latest";
            break;
        case "ubuntu":
            $imageres="ubuntu:latest";
            break;
        case "mysql":
            $imageres="mysql:8.0.3";
            break;
        case "nginx":
            $imageres="nginx:latest";
            break;
        case "tensorflow":
            $imageres="tensorflow/tensorflow:latest-py3";
            break;
        default:
            $imageres="ubuntu:latest";
    }
    
    //OPERATION AND DONE
    $sql = "INSERT INTO `".$usr_id."`(`con_name`, `con_image`, `con_time`, `con_ip`) VALUES ('".$name."','".$imageres."',".$time.",'".$ip."')";
    $cmd = "sudo docker create --name ".$name." --net usr".$usr_id." --ip ".$ip." ".$sqlport.$imageres;
    if(!$debug || ($debug && $debug_level==2)){ $output=shell_exec($cmd); }
    $query = mysql_query($sql);
    mysql_close();
    if(!$debug){ header('Location: ./'); }
    if($debug){
        echo '-----BEGIN DEBUGING-----';
        echo '<br />IS SQL PORT: '.$issqlport;
        echo '<br />SQL PORT: '.$sqlport;
        echo '<br />SQL CON: '.$sql;
        echo '<br />CMD: '.$cmd;
        echo '<br />CMD OUTPUT: '.$output;
        echo '<br />-----END DEBUGING-----';
    }
?>