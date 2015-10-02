<?php
$con = mysql_connect("mysql6.000webhost.com","a7069079_un","srbaza1");
if(!$con)
 die('Could not connect: ' . mysql_error());
 mysql_select_db("a7069079_db",$con);

	mysql_set_charset('utf8');

	date_default_timezone_set('Europe/Sarajevo');
	include("php.php");
?>