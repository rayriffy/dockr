<?
  require_once('../script/config.php');
  if(!isset($_COOKIE['token']) || !isset($_COOKIE['usr_id']))
  {
    header('Location: ../');
  }
?>
<!DOCTYPE html>
<script src="/js/jquery.min.js"></script>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard | Dockr</title>
  <noscript>
    <META HTTP-EQUIV="Refresh" CONTENT="0;URL=js_err.html">
  </noscript>

  <!-- CSS -->
  <link rel="stylesheet" href="/css/critical.css" lazyload="1">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit:400,400i,700,700i|Material+Icons&amp;subset=thai" rel="stylesheet">


  <!-- Detail -->
  <meta name="Title" content="Dockr">
  <meta name="Keywords" content="dockr,mwit">
  <meta name="Description" content="Dockr by Mahidol Wittayanusorn School">

  <!-- Theme Color -->
  <meta name="theme-color" content="#0d47a1">
  <meta name="msapplication-navbutton-color" content="#0d47a1">
  <meta name="apple-mobile-web-app-status-bar-style" content="#0d47a1">

  <!-- MASSIVE ICONS -->
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/ico/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/ico/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/ico/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/ico/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/ico/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/ico/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/img/ico/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/ico/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="/img/ico/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="/img/ico/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="/img/ico/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="/img/ico/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="/img/ico/favicon-128.png" sizes="128x128" />

  <!-- PWA Standard -->
  <script src="/js/companion.js" data-service-worker="/sw.js"></script>
  <link rel="icon" type="image/png" href="/img/ico.png">
  <link rel="manifest" href="/manifest.json">

  <!-- Styling test -->
  <style>
  .side-nav .user-view .name, .side-nav .userView .name
  {
    margin-top: 16px;
    font-weight: 500;
  }
  .side-nav .user-view .permit, .side-nav .userView .permit
  {
    padding-bottom: 16px;
    font-weight: 400;
  }
  .side-nav .user-view .name, .side-nav .user-view .permit, .side-nav .userView .name, .side-nav .userView .permit
  {
    font-size: 14px;
    line-height: 24px;
  }
  .thai
  {
    font-family: 'Kanit', sans-serif;
  }
  header, main, footer, .container, nav {
  padding-left: 300px;
  }
  @media only screen and (max-width : 992px) {
    header, main, footer, .container, nav {
      padding-left: 0;
    }
  }
  </style>
</head>

<noscript>
  ERROR: JavaScript disabled! For full functionality of this site it is necessary to enable JavaScript.
  Here are the <a href="http://www.enable-javascript.com/" target="_blank">
  instructions how to enable JavaScript in your web browser</a>.
</noscript>

<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
<script type="text/javascript">
  $(window).on('load', function() { // SHOW PRELOAD UNTIL PAGE IS COMPLETELY LOADED
    $('#status').fadeOut();
    $('#preloader').delay(500).fadeOut('slow');
    $('body').delay(350).css({'overflow':'visible'});
  })
</script>

<body>
  <nav class="blue darken-2">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center">Docker Laboratory System</a>
      <ul id="nav-mobile" class="left hide-on-large-only">
        <li><a href="#" data-activates="slide-out" class="button-collapse left"><i class="material-icons">menu</i></a></li>
      </ul>
    </div>
  </nav>
  <ul id="slide-out" class="side-nav fixed">
    <li><div class="user-view">
       <div class="background">
         <img src="/img/bg.jpg">
       </div>
       <svg xmlns="http://www.w3.org/2000/svg" width="64px" height="64px" viewBox="0 0 48 48" fill="#ffffff" aria-hidden="true"><path d="M24,0C10.74,0 0,10.74 0,24C0,37.26 10.74,48 24,48C37.26,48 48,37.26 48,24C48,10.74 37.26,0 24,0ZM24,41.28C17.988,41.28 12.708,38.208 9.6,33.552C9.66,28.788 19.212,26.16 24,26.16C28.788,26.16 38.328,28.788 38.4,33.552C35.292,38.208 30.012,41.28 24,41.28ZM24,7.2C27.972,7.2 31.2,10.428 31.2,14.4C31.2,18.384 27.972,21.6 24,21.6C20.028,21.6 16.8,18.384 16.8,14.4C16.8,10.428 20.028,7.2 24,7.2Z"></path><path d="M0 0h48v48H0z" fill="none"></path></svg>
       <span class="white-text name"><b>Phumrapee Limpianchop</b></span>
       <span class="white-text permit">Student</span>
     </div></li>
     <li class="active"><a href="#!" class="thai">หน้าหลัก</a></li>
     <li><a href="conmanage" class="thai">จัดการ container</a></li>
    <li><a href="/logout.php" class="thai red-text">ออกจากระบบ</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">© <? if(date("Y")>2017){ echo '2017-'; } echo date("Y"); ?> Phumrapee Limpianchop</a></li>
  </ul>

  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title thai">สถานะ</span>
            <div class="row">
              <table class="striped">
                <thead>
                  <tr>
                    <th>Container</th>
                    <th>สถานะ</th>
                  </tr>
                </thead>
                <tbody>
                <?
                  $sql="SELECT `con_name` FROM `".$_COOKIE['usr_id']."` WHERE 1";
                  $query=mysql_query($sql);
                  while($row=mysql_fetch_array($query))
                  {
                ?>
                  <tr>
                    <td><? echo $row[0]; ?></td>
                    <td class="green-text thai">ปกติ</td>
                  </tr>
                <?
                  }
                  mysql_close();
                ?>
                </tbody>
              </table>
            </div>
            &nbsp;
          </div>
        </div>
      </div>
      <div class="col l6 s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title thai">เมนูด่วน</span>
            <div class="row">
              <a href="conmanage" class="btn waves-effect waves-light blue thai">ระบบจัดการ container</a>
              <a href="#" class="btn waves-effect waves-light orange thai">แจ้งปัญหาการใช้งาน</a>
            </div>
            &nbsp;
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="/js/materialize.js"></script>
  <script src="/js/init.js" async></script>
  <script>
    $(document).ready(function() {
      Materialize.updateTextFields();
    });
  </script>
</body>
</html>
