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
				include("novosti/show_news.php");
				?>
		<?php include("ftincld.php");?>
	</body>
</html>