<?php session_start();
session_destroy();
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
				<center><h2>Uspjesan logout</h2><center>
				<p align="center"><h3><a href="default.php" style="color:#ffffff; text-decoration:none;">Klikni</a> za nazad</h3></p>
				<script type="text/javascript">
						window.location = "default.php"
				</script>
		<?php include("ftincld.php");?>
	</body>
</html>