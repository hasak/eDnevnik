<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Me</title>
		<?
			$str=$_SERVER['PHP_SELF'];
			$okl=$_SERVER['HTTP_REFERER'];
			$ag=$_SERVER['HTTP_USER_AGENT'];
			$ip=$_SERVER['REMOTE_ADDR'];
			$qe="insert into Monitoring (ID,User,Username,Prof,Str,Oklen,IP,Time,Sve,Admin) values(NULL,'$id','$ses','$prof','$str','$okl','$ip','".time()."','$ag','$ad');";
			mysql_query($qe);?>
	</head>
	<body color="white">
		<img src="http://www.sherv.net/cm/emoticons/sleep/yawn.gif">
	</body>
</html>