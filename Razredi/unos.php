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
		$kojee=$_SESSION['user'];
		$q=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($q);
		$pred=$fetcaraj['Predmet'];
		$inc=1;
		$date=date("d.m.Y");
		$rzz=$_POST['rzz'];
		$qq=mysql_query("select * from ".$rzz);
		while($inc<32)
		{
		$a=$_POST[$inc];
		//$ccv=date("d.m") . " (<b>" . $a . "</b>)" ;
		$ccv=$a;
		$fec=mysql_fetch_array($qq);
		if($a!="")
		{
		if($fec[$pred]!='0' && $fec[$pred]!="")
		$pr=$fec[$pred] . "</br>" . $ccv;
		else $pr=$ccv;
		if(mysql_query("UPDATE  `a2312833_a`.`".$rzz."` SET  `".$pred."` =  '".$pr."' WHERE  `".$rzz."`.`Broj` ='".$inc."' LIMIT 1")==false)
		echo mysql_error();
		else if(mysql_query("insert into Izmjene (RnBr, Prof, Ocjena, Brojuc, Razred, Datum) value(NULL, '$kojee', '$a', '$inc', '$rzz', '$date')")==false)
		echo mysql_error();
		}
		else
		?><script type="text/javascript">
window.history.go(-2);
</script><?php
		$inc=$inc+1;
		}
		?>
		<?php include("fdftincld.php");?>
	</body>
</html>