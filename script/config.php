<?
  date_default_timezone_set("Asia/Bangkok");
  $hostname='localhost';
  $username='dockr';
  $password='fdG2yUbx93DWrXcl';
  $dbname='dockr';
  mysql_connect($hostname, $username, $password) OR DIE('Unable to connect to database! Please try again later.');
  mysql_select_db($dbname);
  mysql_query("SET NAMES UTF8");
  mysql_query("SET character_set_results=utf8");
  mysql_query("SET character_set_client=utf8");
  mysql_query("SET character_set_connection=utf8");
?>