<?php ob_start(); session_start();
include('db.php');

?>
<html>
	<head>
		<title>Greška 404 - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
				<br><center><h2>Stranica nije pronađena</h2><center><br>
				<p align="center"><h3>Već smo 404 puta pretražili ali nismo našli :(</h3></p><br><br>
				<center><h3><a href="<?php echo "http://".$_SERVER['HTTP_HOST'];?>">Klikni</a> za nazad na početnu</h3></center>
			<?php
		 include("ftincld.php");?>
	</body>
</html>