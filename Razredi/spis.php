<?php session_start();
include('../db.php');?>
<html>
	<head>
		<title>Social 3D</title>
		<?php include('fdink.php'); ?>
	</head>
	<body bgcolor="#b5b5b5">
		<?php include("fdinclud.php");?>
		<?php
		if($_SESSION['prof']==true)
		{
		$razz=$_POST['razz'];
		$query=mysql_query("select * from ".$razz);
		$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
		$pred=$fetcaraj['Predmet'];
		$query2=mysql_query("select * from Predmeti where RnBr = '".$pred."'");
				$fec=mysql_fetch_array($query2);
				$pred2=$fec['Predmet'];
				//$proba="'".$pred."'";
		echo"
		<p><center><h2>".$pred2."</h2><center></p>
		<center><form action='unos.php' method='post'>
		<table border='1' width='500px' style='border-collapse:collapse;'>
		<tr><td>Broj</td><td>Učenik</td><td>Ocjene</td><td>Unesi</td></tr>
		";
		while($b=mysql_fetch_array($query))
		{		
		if($b['Broj']!=0)
		{
		$aa=$b['Broj'];
		if($b[$pred]!='0')
		$vv=$b[$pred];
		else $vv=" ";
		$q=mysql_query("select * from Spisak where Broj='".$aa."'");
		$cc=mysql_fetch_array($q);
		if($cc[$razz]!="")
		echo"<tr><td style='color:#0096ff;'>".$aa."</td><td style='color:#606060;'><i>".$cc[$razz]."</i></td><td>".$vv."</td><td><input type='text' maxlength='12' name='".$aa."' style='width:75px; background-color:#ffffff; border-width:0px;'></td></tr>";
		}}
		echo"
		</table><br><input type=hidden name='rzz' value='".$razz."'><input type='submit' class='button2' value='Unesi'></form>
		</center>		
		";
		}
		else echo"<p><center><h1>Niste profesor !</h1><center></p>";
		?>
		<?php include("fdftincld.php");?>
	</body>
</html>