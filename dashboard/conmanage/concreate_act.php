<?
    require_once('../../script/config.php');
    $debug=false;
    $debug_level=1;

    //GET REQUIRED INFORMATION
    $usr_id = $_COOKIE['usr_id'];
    $image = $_REQUEST['concre_image'];
    $port_con=$_POST['conport'];
    $port_bind=$_POST['bindport'];
    $env_name=$_POST['env_name'];
    $env_var=$_POST['env_var'];
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
    $iscmdport=false;
    $cmdport="";
    if($port_bind && $port_con)
    {
        $iscmdport=true;
        for($i=0;$i<count($port_con);$i++)
        {
            //CHECK IF NOT NULL
            if($port_bind[$i]!=null && $port_con[$i]!=null)
            {
                $cmdport=$cmdport."-p ".$port_bind[$i].":".$port_con[$i]." ";
            }
            //CHECK IF NOT DUP
            $sqlport="SELECT `portbind` FROM `portmanager` WHERE `portbind`=".$port_bind[$i];
            $queryport=mysql_query($sqlport);
            $isportdup=null;
            while($row=mysql_fetch_array($query))
            {
                $isportdup=$row[0];
            }
            if($isportdup!=null)
            {
                die('ERR: PORT DUPLICATED');
            }
        }
        if(!$debug)
        {
            for($i=0;$i<count($port_con);$i++)
            {
                //ADD TO SQL
                if($port_bind[$i]!=null && $port_con[$i]!=null)
                {
                    $sqlport="INSERT INTO `portmanager`(`portbind`, `portcon`, `container`) VALUES (".$port_bind[$i].",".$port_con[$i].",'".$name."')";
                    $queryport=mysql_query($sqlport);
                }
            }
        }
    }

    //ENVIRONMENT VARIABLE
    $isenvar=false;
    $cmdenv="";
    if($env_name && $env_var)
    {
        $isenvar=true;
        for($i=0;$i<count($env_name);$i++)
        {
            //CHECK IF NOT NULL
            if($env_name[$i]!=null && $env_var[$i]!=null)
            {
                $cmdenv=$cmdenv."-e ".$env_name[$i]."=".$env_var[$i]." ";
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
    $cmd = "sudo docker create --name ".$name." --net usr".$usr_id." --ip ".$ip." ".$cmdport.$cmdenv.$imageres;
    if(!$debug || ($debug && $debug_level==2)){ $output=shell_exec($cmd); }
    if(!$debug) { $query = mysql_query($sql); }
    mysql_close();
    if(!$debug){ header('Location: ./'); }
    if($debug){
        echo '-----BEGIN DEBUGING-----';
        echo '<br />IS CMD PORT: '.$iscmdport;
        echo '<br />CMD PORT: '.$cmdport;
        echo '<br />IS ENV VAR: '.$isenvar;
        echo '<br />CMD ENV: '.$cmdenv;
        echo '<br />SQL CON: '.$sql;
        echo '<br />CMD: '.$cmd;
        echo '<br />CMD OUTPUT: '.$output;
        echo '<br />-----END DEBUGING-----';
    }
?>