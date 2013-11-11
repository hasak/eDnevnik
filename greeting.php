<?php session_start();
include('db.php');?>
<html>
	<head>
		<title>Social 3D</title>
		<link rel="shortcut icon" href="favicon.ico"/>
		<link rel="stylesheet" type="css/txt" href="style.css"/>
		<script type="text/javascript" src="jav.js"></script>
	</head>
	<body bgcolor="black">
		<?php include("includ.php");?>
		<?php
			$user=$_POST["user"];
			$pass=$_POST["pass"];
			$red=mysql_query("select * from users where username = '" . $user ."'");
			if(mysql_num_rows($red)==true)
			{			
				$pw=mysql_fetch_array($red);
				if(md5($pass)==$pw['Pass'])
				{
					echo "<center><h2>Uspjesno ste logovani</h2><center>";
					$_SESSION['user']=$user;
					$_SESSION['pass']=$pass;
					echo "
					<script type='text/javascript'>
						window.location = 'default.php'
					</script>";
				}
				else
					echo "<center><h2>Pogresan Password</h2><center>";
			}
			else
				echo "<center><h2>Pogresan Username</h2><center>";
		?>
				<p align="center"><h3><a href="default.php" style="color:#ffffff; text-decoration:none;">Klikni</a> za nazad</h3></p>
		<?php include("ftincld.php");?>
	</body>
</html>