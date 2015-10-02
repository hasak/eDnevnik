<?php session_start();
include('../db.php');?>
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
				$gdje=mysql_query("select * from users where username ='". $_SESSION['user']."'");
				$red=mysql_fetch_array($gdje);
				$br=$red['BrDn'];
				$br2=mysql_query("select * from Dnevnik where Broj ='". $br."'");
				$red2=mysql_fetch_array($br2);
				
				$bos=$red2['Bos'];
				$eng=$red2['Eng'];
				$nje=$red2['Nje'];
				$lat=0;
				$mat=$red2['Mat'];
				$fiz=$red2['Fiz'];
				$inf=$red2['Inf'];
				$tizo=$red2['Tizo'];
				$vje=$red2['Vje'];
				$soc=$red2['Soc'];
				$dem=$red2['Dem'];
				$psi=$red2['Psi'];
				
				
				
				$sql="REPLACE INTO Dnevnik  (Broj ,Bos, Eng, Nje, Lat, Mat, Fiz, Inf, Tizo, Vje, Soc, Dem, Psi)
		VALUES
		('$br','$bos','$eng','$nje','$lat','$mat','$fiz','$inf','$tizo','$vje','$soc','$dem','$psi')";
		
		
				if(!mysql_query($sql))
					die('greska'.mysql_error());
				else
				header( 'Location:../dnevnik.php' ) ;
				
				?>
		<?php include("ftincld.php");?>
	</body>
</html>