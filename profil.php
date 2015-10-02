<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<?php include('ink.php'); 
		if(isset($_SESSION['user']))
		{
			if(isset($_GET['profaa']))
				$ko=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$_GET['profaa']."'"));
				else if(isset($_GET['profaaa']))
					$ko=mysql_fetch_array(mysql_query("select * from Profesori where Username='".$_GET['profaaa']."'"));
			else
		if(isset($_POST['profi']))
		{
				$ko=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$_POST['profi']."'"));
		} else $ko=mysql_fetch_array(mysql_query("select * from Profesori where Username='".$_SESSION['user']."'"));}
		
		if($ko['Razrednik']!=0)
		$razr=$ko['Razrednik'];
		else $razr="Nije";
		$af=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$ko['Predmet']."'"));
		$pred=$af['Predmet'];
		if(isset($_SESSION['user']))
		echo"<title>".$ko['Ime']." ".$ko['Prezime']." - eDnevnik</title>";
	else echo"<title>Profil - eDnevnik</title>";
		?>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		if(isset($_SESSION['user']))
		{
				
				//Pocetak prikupljanja informacija//
				echo"
				<div id='drzac_profila'> 
					<div id='slika_ucenik'>
						<img src='".$ko['Img']."'/>
					</div>
					<div id='info_ucenik'>
						<div id='naslov'>Informacije o Profesoru</div><center><h2>";
						echo "<br>".$ko['Ime']." ".$ko['Prezime'];
						echo"</h2><br>
						<table id='ucenik_tabela'>
						
						<tr><td style='font-weight:bold;'>Predmet</td><td>".$pred."</td></tr>
						<tr><td style='font-weight:bold;'>Razrednik</td><td>".$razr."</td></tr>
						<tr><td style='font-weight:bold;'>Registracija</td>   <td>".date("d.m.Y.",$ko['Reg'])."</td></tr>
						";
						//else echo"<tr><td><br><br><b><h4>Nedovoljno informacija</h4></b></td></tr>";
						
						echo"</table></center>
					</div>
					<div id='napomena_ucenik'>
					<div id='naslov' class='naslovmargina'>Napomene</div>";
					
					/*$ssd=mysql_query("select * from Napomene where Broj='".$ucen."' and Razz='".$razz."'");
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
						<td><center>".$b['Datum']."</center></td></tr>";
					}
					
					
					echo"</table>";
					
					if($_SESSION['prof']==true)
					echo"
					<form action='".$_SERVER['PHP_SELF']."' method='post'>
					<center><input type='text' style='width:391px; height:20px; margin-top:10px; font-size:15px;' name='npm'>
					<input type='hidden' name='ucen' value='".$ucen."'>
					<input type='hidden' name='rzz' value='".$razz."'></center>
					<input type='submit' style='margin-top:10px; float:right;' class='button2' name='sett' value='Unesi Novu Napomenu'></form>
					";
					
					
					*/echo"</div>";/*
					if($_SESSION['prof']==true){
					echo"<div id='ocjene_ucenik'>
					<div id='naslov' class='naslovmargina'>Ocjene (".$predmet.")</div><br>";
					if(mysql_num_rows($qrz)!=0) 
					{
					$zklj=mysql_fetch_array($qrz);
					echo "<center><font>Zaključeno: <b style='font-size:15pt;'>".$zklj['Ocjena']."</b></font></center><br>";
					}
					
					//KOD ZA PRIKAZ OCJENA
					
					$inc=0;
					$oc=0;
					$date=date("d.m");
					echo"<div id='unesi_oc'><form action='unos.php' method='post'><table>";
					while($c=mysql_fetch_array($qr))
					{
							echo "<tr><td id='stil_ocjene'>".$c['Datum'].".".$c['Mj']." (<b>".$c['Ocjena']."</b>)</td></tr>";
							$oc=$oc+$c['Ocjena'];
							$inc=$inc+1;
					}
					if($inc!=0) $prosjek=number_format($oc/$inc,2);
					else $prosjek=0;
					$obuc=-$ucen;
					if($prosjek-floor($prosjek/1)<0.5) $zko=floor($prosjek/1); else $zko=floor($prosjek/1)+1;
					echo "<tr><td id='stil_ocjene'>".$date.".<input type='text' name='".$ucen."' maxlength='1' style='width:25px; font-family:Lucida Handwriting; text-align:center;'></td></tr>
					<input type='hidden' name='rzz' value='".$razz."'>
					<tr><td></td></tr>
					</table></div><div id='zklj_oc'>
					<table><tr><td>Prosjek</td></tr>
					<tr><td id='stil_ocjene'>".$prosjek." (<b>".$zko."</b>)</td></tr>
					<tr><td style='text-align:right;'>
					<input type='text' name='".$obuc."' maxlength='1' style='width:70px; height:40px; text-align:center; font-family:Lucida Handwriting; font-size:18pt; background-color:#ccc;'/></td></tr>
					<input type='hidden' name='rzz' value='".$razz."'>
					<tr><td></td></tr>
					</table></div>
					<div id='drzacbuttona'>
						<label for='prvib'><button class='unosnaprofilu' >Unesi</button></label>
						<input type='submit' id='prvib' class='unosnaprofilu' value='Zaključi' style=' float:right; margin-right:10px;'/>
						</form>
						</div>
					";*/
						
					/*	echo"<div id='unesi_ocjenu'>
							
						</div>
						<div id='zakljuci_ocjenu'>
							
						</div>";*/
						
						
					//echo"</div>";
				echo"</div>";
		//}
		}
		else echo"<p><center><h2>Morate biti prijavljeni</h2><center></p>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>