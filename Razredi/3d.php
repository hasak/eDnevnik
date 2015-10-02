<?php session_start();
include('../db.php');?>
<html>
	<head>
		<title>Social 3D</title>
		<meta charset="utf-8">
		<?php include('fdink.php'); ?>
	</head>
	<body bgcolor="#b5b5b5">
		<?php include("fdinclud.php");?>
		<?php
		if($_SESSION['prof']==true)
		{
		$query=mysql_query("select * from 3d");
		$pred=$_SESSION['pred'];
		$query2=mysql_query("select * from Predmeti where RnBr = '".$pred."'");
				$fec=mysql_fetch_array($query2);
				$pred2=$fec['Predmet'];
				//$proba="'".$pred."'";
		echo"
		<p><center><h2>".$pred2."</h2><center></p>
		<center><form action='unos.php' method='post'>
		<table border='1' width='500px'>
		<tr><td>Broj</td><td>Učenik</td><td>Ocjene</td><td>Unesi</td></tr>
		";
		while($b=mysql_fetch_array($query))
		{		
		if($b['Broj']!=0)
		{
		$aa=$b['Broj'];
		$vv=$b[$pred];
		$q=mysql_query("select * from Spisak where Broj='".$aa."'");
		$cc=mysql_fetch_array($q);
		echo"<tr><td>".$aa."</td><td>".$cc['3d']."</td><td>".$vv."</td><td><input type='text' name='".$aa."'></td></tr>";
		}}
		echo"
		</table><input type='submit' value='Unesi'></form>
		</center>		
		";
		}
		else echo"<p><center><h1>Niste profesor !</h1><center></p>";
		?>
		<?php include("fdftincld.php");?>
	</body>
</html>