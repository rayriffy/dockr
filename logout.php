<?
    setcookie('login_stat',4010,time()+6000,'/');
    setcookie('token',null,time()-7200,'/');
    setcookie('usr_id',null,time()-7200,'/');
    header('Location: ./');
?>