<?php session_start();
include('../db.php');?>
<html>
	<head>
		<title>Social 3D</title>
		<?php include('../ink.php'); ?>
	</head>
	<body bgcolor="#b5b5b5">
		<?php include("../includ.php");?>
		<?php include("../admin.php");
			if($admin==false && $direktor==false)
			echo "<center><h2>Nemate adminska prava</h2></center><br><center><h3>Djeciji Bypass</h3></center>"; 
			else{
			$koji=$_POST['razred'];
			$ide="'Location:".$koji.".html'";
			header($ide);
			
			
			}
		?>
		<?php include("../ftincld.php");?>
	</body>
</html>