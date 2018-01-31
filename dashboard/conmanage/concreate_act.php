<?
    require_once('../../script/config.php');
    //GET REQUIRED INFORMATION
    $name = $_REQUEST['concre_name'];
    $usr_id = $_COOKIE['usr_id'];
    $image = $_REQUEST['concre_image'];
    $time = time()+rand(10,40);
    $ip = "172.18.".rand(0,255).".".rand(0,255);

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
    #OPERATION AND DONE
    $sql = "INSERT INTO `".$usr_id."`(`con_name`, `con_image`, `con_time`, `con_ip`) VALUES ('".$name."','".$imageres."',".$time.",'".$ip."')";
    shell_exec("docker run --name ".$name." --net dockernet --ip ".$ip." -d ".$imageres);
    $query = mysql_query($sql);
    mysql_close();
    header('Location: ./');
?>