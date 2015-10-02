<?php ob_start(); session_start();include('db.php');
if($_SESSION['prof']==true)
{$s=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");$sta="RnBr";}
else{ $s=mysql_query("select * from users where Username='".$_SESSION['user']."'");$sta="UserID";}
$pw=mysql_fetch_array($s);
if(
						$_SESSION['ad']==true)
						$fd=1;else $fd=0;
						if($_SESSION['prof']==true)
						$fd2=1;else $fd2=0;
$id=$pw[$sta];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$usern=$pw['Username'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','$fd2','".time()."','$ip','$ag','1','$fd');";
					mysql_query($sql);
session_destroy();
?>
<html>
	<head>
		<title>Odjava - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
				<center><h2>Uspjesan logout</h2><center>
				<p align="center"><h3><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>" style="text-decoration:none;"><b>Klikni</b></a> za nazad</h3></p>
			<?php
		 include("ftincld.php");?><script> location.replace("http://<?php echo $_SERVER['HTTP_HOST'];?>"); </script>
	</body>
</html>