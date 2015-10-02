<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>AJAX</title>
	</head>
	<body>
		<?php
		
		
		
		
		
		
			$q=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
			$fetcaraj=mysql_fetch_array($q);
		
		
		
		
		
			
			
			//if(isset($_GET['oc']) and isset($_GET['bruc']) and isset($_GET['rzz']) and isset($_GET['zak'])
	//and isset($_GET['unix']) and isset($_GET['ruka']) and isset($_GET['vrta']) and (isset($_GET['prdm']) or isset($_GET['prprd'])) )
		
			$id=$fetcaraj['RnBr'];
			$pred=$_GET['prdm'];if(isset($_GET['prprd']))
			$pred=$_GET['prprd'];
			$mm=$_GET['oc'];
			$inc=$_GET['bruc'];
			$rzz=$_GET['rzz'];
			$zklj=$_GET['zak'];
			$unix=$_GET['unix'];
			$ruk=$_GET['ruka'];
			//$dat=date("d",$unix);
			//$mesec=date("m",$unix);
			$pv=time();
			$vrta=$_GET['vrta'];
			//$date=date("d");
			//$mjj=date("m");
			//$sat=date("H");
			//$min=date("i");
			$Mm="";
			if(isset($_GET['oc']))
		if(!($mm<6 and $mm>0))
		$Mm="Odaberite ocjenu!";else 
		if(!mysql_query("insert into Izmjene (RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Tajp, Pravi, Custom) value(NULL, '$id', '$pred', '$mm', '$inc', '$rzz', '$zklj', '$unix','$vrta','$pv','$ruk')"))
		die( mysql_error());
	if(isset($_SESSION['user']) and $_SESSION['prof']==true)
		{
				if(isset($_GET['brisi']))
					{
						$sf=mysql_query("select * from Izmjene where RnBr='".$_GET['brisi']."'");
						$few=mysql_fetch_array($sf);
						$rzz=$few['Razred'];
						$inc=$few['Brojuc'];
						$pred=$few['Predmet'];
						if(time()-$few['Pravi']<3600)
							mysql_query("delete from Izmjene where RnBr='".$_GET['brisi']."'");
					}
		{
		
		$qr=mysql_query("select * from Izmjene where Razred ='".$rzz."' and Brojuc='".$inc."' and Predmet ='".$pred."' and Zakljucna=0 ");
		$qrz=mysql_query("select * from Izmjene where Razred ='".$rzz."' and Brojuc='".$inc."' and Predmet ='".$pred."' and Zakljucna=1 Order by RnBr desc ");
		echo"<div id='naslov' class='naslovmargina'>Ocjene (";
					
					$qu=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
					$ve=mysql_fetch_array($qu);
					$id=$ve['RnBr'];
					$id_pred=$ve['Predmet'];
					$zrtz=mysql_query("select * from Predmeti where RnBr='".$id_pred."'");
					$ttea=mysql_fetch_array($zrtz);
					$predmet=$ttea['Predmet'];
					
					$zut=mysql_query("select * from Vise where Profa='".$id."'");
					if(mysql_num_rows($zut)==0)
					echo $predmet."
					<input type='hidden' name='prdm' id='prdm' value=".$id_pred.">";
					else {
					if($id_pred==$pred)
					$chek="selected";
					else $chek="";
					echo"<select onchange='nekaja()' name='prdm' id='prdm'  style='/* height: 23px; */
background: none;
font-family:gothic;
margin-left: 5px;
/* width: 45px; */
-webkit-appearance: none;
font-size: 14;'><option value='".$id_pred."' ".$chek.">".$predmet."</option>";
					while($b=mysql_fetch_array($zut))
					{
					if($b['Pred']==$pred)
					$chek="selected";
					else $chek="";
							$bb=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
							$imevp=$bb['Predmet'];
							echo"<option value='".$b['Pred']."' ".$chek.">".$imevp."</option>";
					}echo"</select>";
					}
					echo")</div><br>";
		if(mysql_num_rows($qrz)!=0) 
					{
					$zklj=mysql_fetch_array($qrz);
					echo "<center><font>Zaključeno: <b style='font-size:15pt;'>".$zklj['Ocjena']."</b></font></center><br>";
					}
					
					//KOD ZA PRIKAZ OCJENA
					
					$inc=0;
					$oc=0;
					//$date=date("d.m");
					echo"<div id='unesi_oc'>";
					//echo"<form action='unos' method='post'>";
					echo"<table id='rifres'>";
					while($c=mysql_fetch_array($qr))
					{
							if($c['Tajp']==3)
							$jojoj=$c['Custom'];
						else if($c['Tajp']==2) $jojoj="Pismena";
						else if($c['Tajp']==1) $jojoj="Test";
						else if($c['Tajp']==0) $jojoj="Obična ocjena";
							echo "<tr><td id='stil_ocjene'><span class='bojaoc".$c['Tajp']."' title='".$jojoj."' style='cursor:help;'>".date("d.m",$c['Datum'])." (<b>".$c['Ocjena']."</b>)</span>";
							if(time()-$c['Pravi']<3600)
							echo"<p style='color:red;cursor:pointer;display:inline;' onClick='deletee(".$c['RnBr'].");'>✖</p>";
							echo"</td></tr>";
							$oc=$oc+$c['Ocjena'];
							$inc=$inc+1;
					}
					if($inc!=0) $prosjek=number_format($oc/$inc,2);
					else $prosjek=0;
					$obuc=-$ucen;
					if($prosjek-floor($prosjek/1)<0.5) $zko=floor($prosjek/1); else $zko=floor($prosjek/1)+1;
					echo "<tr>
					<td>".$Mm."</td></tr>
					<tr>
					<td id='stil_ocjene'><select name='datun' id='datun' class='datun'>";
		//$i=0;
		$c=0;
		
		$unix=time();
		while($c<7)
		//while($unix>=1421622000)
		{
				if(date("N",$unix)<6)
				{
				$pocd=date("j",$unix);
				$pocm=date("n",$unix);
				echo"<option value='".$unix."'>".$pocd.".".$pocm."</option>";
				
				$c=$c+1;
				}
				
				$unix=$unix-86400;
		}
					echo "</select>
					<select class='datun' name='".$inc."' id='oce' style='width:25px;'><option value='0'></option>";
					for($i=1;$i<6;$i=$i+1)
					echo"<option value='".$i."'>".$i."</option>";
					echo"</select></td></tr>
					<input type='hidden' name='rzz' value='".$rzz."'>
					<tr><td></td></tr>
					</table></div><div id='zklj_oc'>
					<table><tr><td>Prosjek</td></tr>
					<tr><td id='stil_ocjene'>".$prosjek." (<b>".$zko."</b>)</td></tr>
					<tr><td style='text-align:right;'>
					<input type='text' name='".$obuc."' id='zako' maxlength='1' style='width:70px; height:40px; text-align:center; font-family:Lucida Handwriting; font-size:18pt; background-color:#ccc;'/></td></tr>
					<input type='hidden' name='rzz' value='".$rzz."'>
					<input type='hidden' name='prdm' id='prdm' value=".$pred.">
					<tr><td></td></tr>
					</table></div>
					<div id='drzacbuttona'>
						<button  id='prvib' class='button' style='display:inline;width:70px;' onclick='prva()'>Unesi</button>
						<a href='http://".$_SERVER['HTTP_HOST']."/dnevnik/".$rzz."'><button style='width:70px;display:inline; min-width:60px; float:right; margin-right: 9px; padding-left:17px;' class='button2'>Razz</button></a>
						";
						echo"</div></div>";
						/*
			$ds=mysql_query("select * from Izmjene where Razred ='".$rzz."' and Brojuc='".$inc."' and Predmet ='".$pred."' and Zakljucna=0");
			while($c=mysql_fetch_array($ds))
			echo "<tr><td id='stil_ocjene'>".$c['Datum'].".".$c['Mj']." (<b>".$c['Ocjena']."</b>)</td></tr>";
			echo"<tr>
					<td id='stil_ocjene'><select name='datun' id='datun' class='datun'>";
		//$i=0;
		$c=0;
		
		$unix=time();
		while($c<7)
		{
				if(date("N",$unix)<6)
				{
				$pocd=date("j",$unix);
				$pocm=date("n",$unix);
				echo"<option value='".$unix."'>".$pocd.".".$pocm."</option>";
				
				$c=$c+1;
				}
				
				$unix=$unix-86400;
		}
					echo "</select>
					<select class='datun' name='".$ucen."' id='oce' style='width:25px;'><option value='0'></option>";
					for($i=1;$i<6;$i=$i+1)
					echo"<option value='".$i."'>".$i."</option>";
					echo"</select></td></tr>";
		*/}
		
		}
		else echo"<p><center><h2>Loguj se !</h2><center></p>";
		?>
	</body>
</html>