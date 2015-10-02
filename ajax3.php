<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>AJAXX</title>
		<?php include('ink.php'); ?>
	</head>
	<body><?php 
if(isset($_GET['kpu'])){
$ra=$_GET['kpu'];
$c=0;
$a=mysql_query("select * from Sesije order by ID desc");
echo"<div class='ScrollbarPosjete' id='Stil1'><center><table class='tabela'>
			<tr id='prvi_red'><td>ID</td><td>Username</td><td>Pr</td><td>Vrijeme</td><td>Datum</td><td>IP</td><td>Od</td><td>Adm</td></tr>"; 
					while($c<350)
					{
				$b=mysql_fetch_array($a);
				echo"<tr alt='".$b['Sve']."'><td id='prva_cell'>".$b['ID']."</td><td>".$b['Username']."</td><td>".$b['Prof']."</td><td>".date("G:i",$b['Time'])."</td><td>".date("d.m.Y",$b['Time'])."</td><td>".$b['IP']."</td><td>".$b['Odjava']."</td><td>".$b['Admin']."</td></tr>";
					$c++;
					}
					
					echo"</table></center></div>";
					
					}
	else if(isset($_GET['brisioc']))
	{if($_SESSION['prof']){mysql_query("delete from Izmjene where RnBr='".$_GET['brisioc']."'");}}		
else if(isset($_GET['npmn']))
{
	if($_SESSION['prof'])
	{
		$ztr=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$re=mysql_fetch_array($ztr);
		$id=$re['RnBr'];
		$rz=$_GET['razze'];
	$inkr=$_GET['boj'];
	$txt=$_GET['npmn'];
	$tajm=time();
	mysql_query("insert into Napomene (ID,Prof,Broj,Razz,Napomena,Datum) values(null,'$id','$inkr','$rz','$txt','$tajm')");
	
	echo"<div id='naslov' class='naslovmargina'>Napomene</div>";
	$ssd=mysql_query("select * from Napomene where Broj='".$inkr."' and Razz='".$rz."'");
					if(mysql_num_rows($ssd)!=0)
					echo"
					<table class='tabela' style='width:100%; margin-top:10px;'><tr id='prvi_red'>
					<td>Profesor</td><td>Napomena</td><td>Datum</td></tr>";
					while($b=mysql_fetch_array($ssd))
					{
						$as=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$b['Prof']."'"));
						$prf=$as['Ime']." ".$as['Prezime'];
						echo"<tr>
						<td><center>".$prf."</td><td class='crveno'>".$b['Napomena']."</td>
						</center>
						<td><center>".date("d.m",$b['Datum'])."</center></td></tr>";
					}
	
	
	
	}
}
else {echo"Neka serverska greška!";}
?></body>
</html>