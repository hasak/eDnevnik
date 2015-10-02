<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Just spam - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");
		$selec=mysql_query("select * from users where Admin='0'");
        while($b=mysql_fetch_array($selec))
        {
			echo"Ime: ".$b['Ime']."<br>Prezime: ".$b['Prezime']."<br>Username: ".$b['Username']."<br>";
			$ch="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			$len=strlen($ch);
			$random="";
			for ($i=0;$i<6;$i++) 
			$random.=$ch[rand(0,$len-1)];
			mysql_query("update users set Pass='".md5($random)."' where UserID='".$b['UserID']."'");
			echo "Password: ".$random."<br><br>";
        }
		include("ftincld.php");?>
	</body>
</html>