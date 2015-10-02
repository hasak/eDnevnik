<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<?php include('ink.php'); 
		if(isset($_GET['uceni']))
		{
				$sql=mysql_query("select * from users where UserID='".$_GET['uceni']."'");
				if(mysql_num_rows($sql)!=0)
				{
				$ko=mysql_fetch_array($sql);
				
				$_SESSION['post']=$ko['Razred'];
				$_SESSION['post2']=$ko['BrDn'];}
				else echo"<script> location.replace('http://".$_SERVER['HTTP_HOST']."/404'); </script>";
		}
		
		if(isset($_GET['ucenik']))
		{
				$sql=mysql_query("select * from users where Username='".$_GET['ucenik']."'");
				if(mysql_num_rows($sql)!=0)
				{
				$ko=mysql_fetch_array($sql);
				$_SESSION['post']=$ko['Razred'];
				$_SESSION['post2']=$ko['BrDn'];}
				else echo"<script> location.replace('http://".$_SERVER['HTTP_HOST']."/404'); </script>";
		}
		
		
		if(isset($_GET['ucen'])and isset($_GET['rzz']))
		{
				$_SESSION['post']=$_GET['rzz'];
				$_SESSION['post2']=$_GET['ucen'];
		}
		
		
		if(isset($_SESSION['post']) and isset($_SESSION['post2']))
				{
				$razz=$_SESSION['post'];
				$ucen=$_SESSION['post2'];
				unset($_SESSION['post']); unset($_SESSION['post2']);
				}
				else{$ko=mysql_query("select * from users where Username='".$_SESSION['user']."'");
						$rred=mysql_fetch_array($ko);
						//$qe=mysql_query("select * from users where BrDn = '".$rred['BrDn']."' and Razred = '".$rred['Razred']."'");
						$razz=$rred['Razred'];
						$ucen=$rred['BrDn'];
				}
				/*if(isset($_POST['uuu']))
				{
					$ko2=mysql_query("select * from users where UserID='".$_POST['uuu']."'");
					$sf=mysql_fetch_array($ko2);
					$razz=$sf['Razred'];
					$ucen=$sf['BrDn'];
				}*/
		if(isset($_SESSION['user']))
		{$my=mysql_fetch_array(mysql_query("select * from Spisak where Broj ='".$ucen."'"));
		echo"<title>".$my[$razz]." - eDnevnik</title>";}else echo"<title>Profil - eDnevnik</title>";
		?>
		<script type="text/javascript">
		function prva()
		{
				var predmet=document.getElementById("prdm").value;
				var ocjena=document.getElementById("oce").value;
				var broj_ucenika=<?php echo $ucen;?>;
				var razred="<?php echo $razz;?>";
				var cust="<?php if(isset($_GET['rucno'])) echo $_GET['rucno']; else echo"";?>";
				var unix=document.getElementById("datun").value;
				var vrsta=<?php if(isset($_GET['rucno'])) echo "3"; else echo "0";?>;
				var zak;
				
				var x=document.getElementById("zako").value;
				if(x!="")
				{
						var r=confirm("Jeste li sigurni da želite ZAKLJUČITI ocjenu?");
						if(r==true)
						{
							zak=1; ocjena=x;
						}
						else
						{
							document.getElementById("zako").value="";
							alert("Veliki kvadrat služi za zaključivanje ocjena dok se u mali kvadrat pored datuma unose obične ocjene");
						}
				} 
				else zak=0;
				
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById("ocjene_ucenik2").innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("GET","http://<?php echo $_SERVER['HTTP_HOST'];?>/new2.php?prdm="+predmet+"&oc="+ocjena+"&bruc="+broj_ucenika+"&rzz="+razred+"&zak="+zak+"&unix="+unix+"&vrta="+vrsta+"&ruka="+cust,true);
				xmlhttp.send();
		}
		</script>
		<script type="text/javascript">
		function nekaja()
		{
				var predmet=document.getElementById("prdm").value;
				var broj_ucenika=<?php echo $ucen;?>;
				var razred="<?php echo $razz;?>";
				document.getElementById("ocjene_ucenik2").innerHTML="<br><br><center><h3><i>Učitavanje</i></h3></center>"
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById("ocjene_ucenik2").innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("GET","http://<?php echo $_SERVER['HTTP_HOST'];?>/new2.php?prprd="+predmet+"&bruc="+broj_ucenika+"&rzz="+razred,true);
				xmlhttp.send();
		}
		function deletee(n){
			var predmet=document.getElementById("prdm").value;
				var broj_ucenika=<?php echo $ucen;?>;
				var razred="<?php echo $razz;?>";
			xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById("ocjene_ucenik2").innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("GET","http://<?php echo $_SERVER['HTTP_HOST'];?>/new2.php?brisi="+n+"&prprd="+predmet+"&bruc="+broj_ucenika+"&rzz="+razred,true);
				xmlhttp.send();
		}
		function npm(){
			var nap=document.getElementById("npmen").value;
				var broj_ucenika=<?php echo $ucen;?>;
				var razred="<?php echo $razz;?>";
			document.getElementById("butzanm").style.display="none";
			xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById('napomena_ucenik').innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("GET","http://<?php echo $_SERVER['HTTP_HOST'];?>/ajax3.php?npmn="+nap+"&boj="+broj_ucenika+"&razze="+razred,true);
				xmlhttp.send();
		}
		</script>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		if(isset($_SESSION['user']))
		{
				
				//Pocetak prikupljanja informacija//
				//if(!isset($_POST['rzz']) or !isset($_POST['ucen']) and $_SESSION['prof']==true)
				//echo"<center><br><h2>Odaberite učenika</h2></center>";
				//else{
				//if(isset($_POST['rzz']) and isset($_POST['ucen']))
				$ko=mysql_query("select * from users where Brdn = '".$ucen."' and Razred = '".$razz."'");
				
				$num=mysql_num_rows($ko);
				if($num!=0){
				$vr=mysql_fetch_array($ko);
				$slika=$vr['Img'];
				$ime=$vr['Ime'];
				$prezime=$vr['Prezime'];
				$razred=$vr['Razred'];
				$broj=$vr['Broj'];
				$ime_o=$vr['Ime_oca'];
				$datumr=$vr['Datumr'].".".$vr['Mjesecr'].".".$vr['Godinar'];
				$adresa=$vr['Adresa'];
				$mjesto=$vr['Mjesto'];
				$mjestor=$vr['Mjestor'];}
				//$tel=$vr['Brojmob'];
				
				//Kraj prikupljanja informacija//
				//if($num==0)
				//{
						$broj=$ucen;
						$razred=$razz;
				
				//}
				
				//Prikupljanje informacija za ocjene//
				if($_SESSION['prof']==true){
				
				$tm="";
				$qu=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
				$ve=mysql_fetch_array($qu);  //Stavljanje u niz sve informacije o profesoru
				
				$id=$ve['RnBr'];
				$id_pred=$ve['Predmet'];
				
				$ztr=mysql_query("select * from Razredi where ID='".$id."'");
				$ssd=mysql_fetch_array($ztr);
				if($ssd[$razz]==1)
				$prikoc=true; else $prikoc=false;
				
				if(isset($_SESSION['prd']))
				{
					$id_pred=$_SESSION['prd'];
					unset($_SESSION['prd']);
					$zacek=$id_pred;
				}
				
				if(isset($_POST['predbro']))
				$id_pred=$_POST['predbro'];
				
				
				
				if(isset($_POST['sett']))
				{
					$date=date("d.m");
					$npm=$_POST['npm'];
					$ee="insert into Napomene (ID,Prof,Broj,Razz,Napomena,Datum)
					values(null,'$id','$ucen','$razz','$npm','$date')";
					if(mysql_query($ee)==false)
					die(mysql_error());
				}
				
				$qw=mysql_query("select * from Predmeti where RnBr ='".$id_pred."'");
				$vx=mysql_fetch_array($qw);//U ove 3 linije se izvlaci ime predmeta;
				$predmet=$vx['Predmet'];
				
				$qr=mysql_query("select * from Izmjene where Razred ='".$razred."' and Brojuc='".$broj."' and Predmet ='".$id_pred."' and Zakljucna=0 ");
				$qrz=mysql_query("select * from Izmjene where Razred ='".$razred."' and Brojuc='".$broj."' and Predmet ='".$id_pred."' and Zakljucna=1 Order by RnBr desc");
				}else $tm="style='max-height:500px;'";
				
				
				echo"
				<div id='drzac_profila'> 
					<div id='slika_ucenik'>
						<img src='".$slika."' ".$tm.">
					</div>
					<div id='info_ucenik'>
						<div id='naslov'>Informacije o učeniku</div><center><h2 style='font-family:gothic;'>";
						//if($num!=0) echo
						//$prezime." ".$ime;
						//else
						//{
								$my=mysql_fetch_array(mysql_query("select * from Spisak where Broj ='".$ucen."'"));
								$imee=$my[$razz];
								echo $imee;
						//}
						echo"</h2><br>
						<table id='ucenik_tabela'>
						
						<tr><td style='font-weight:bold;'>Razred</td>    <td>".$razz."</td></tr>
						<tr><td style='font-weight:bold;'>Broj</td>         <td>".$ucen."</td></tr>";
						if($num!=0)
						echo"
						<tr><td style='font-weight:bold;'>Ime oca</td>   <td>".$ime_o."</td></tr>
						 <tr><td style='font-weight:bold;'>Datum rođenja</td>   <td>".$datumr."</td></tr>
						<tr><td style='font-weight:bold;'>Mjesto rođenja</td>   <td>".$mjestor."</td></tr>
						<tr><td style='font-weight:bold;'>Adresa stanovanja</td>     <td>".$adresa."</td></tr>
						<tr><td style='font-weight:bold;'>Mjesto stanovanja</td>	    <td>".$mjesto."</td></tr>
						";
						else echo"<tr><td><br><br><b><h4>Nedovoljno informacija</h4></b></td></tr>";
						
						echo"</table></center>
					</div>
					<div id='napomena_ucenik'>
					<div id='naslov' class='naslovmargina'>Napomene</div>";
					
					$ssd=mysql_query("select * from Napomene where Broj='".$ucen."' and Razz='".$razz."'");
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
					
					
					echo"</table>";
					
					if($_SESSION['prof']==true and $prikoc==true)
					echo"
					
					<center><input type='text' style='width:391px; height:20px; margin-top:10px; font-size:15px;' name='npm' id='npmen'>
					<input type='hidden' name='ucen' value='".$ucen."'>
					<input type='hidden' name='rzz' value='".$razz."'></center>
					<button style='margin-top:10px; float:right;' class='button2' name='sett' onClick='npm();' id='butzanm'>Unesi Novu Napomenu</button>
					";
					
					
					echo"</div>";
					if($_SESSION['prof']==true and $prikoc==true){
					
					echo"<div id='ocjene_ucenik'><div id='ocjene_ucenik2'>
					<div id='naslov' class='naslovmargina'>Ocjene (";
					
					
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
						if($id_pred==$zacek)
							$ckec="selected";
						else $ckec="";
					echo"<select onchange='nekaja()' name='prdm' id='prdm' style='/* height: 23px; */
background: none;
font-family:gothic;
margin-left: 5px;
/* width: 45px; */
-webkit-appearance: none;
font-size: 14;'><option value='".$id_pred."' ".$ckec.">".$predmet."</option>";
					while($b=mysql_fetch_array($zut))
					{
							$bb=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
							$imevp=$bb['Predmet'];
							if($b['Pred']==$zacek)
							$ckec2="selected";
						else $ckec2="";
							echo"<option value='".$b['Pred']."' ".$ckec2.">".$imevp."</option>";
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
							echo"</td></tr>
							";
							$oc=$oc+$c['Ocjena'];
							$inc=$inc+1;
					}
					if($inc!=0) $prosjek=number_format($oc/$inc,2);
					else $prosjek=0;
					$obuc=-$ucen;
					if($prosjek-floor($prosjek/1)<0.5) $zko=floor($prosjek/1); else $zko=floor($prosjek/1)+1;
					echo "<tr>
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
					<select class='datun' name='".$ucen."' id='oce' style='width:25px;'><option value='0'></option>";
					for($i=1;$i<6;$i=$i+1)
					echo"<option value='".$i."'>".$i."</option>";
					echo"</select></td></tr>
					<input type='hidden' name='rzz' value='".$razz."'>
					<tr><td></td></tr>
					</table></div><div id='zklj_oc'>
					<table><tr><td>Prosjek</td></tr>
					<tr><td id='stil_ocjene'>".$prosjek." (<b>".$zko."</b>)</td></tr>
					<tr><td style='text-align:right;'>
					<input type='text' name='".$obuc."' id='zako' maxlength='1' style='width:70px; height:40px; text-align:center; font-family:Lucida Handwriting; font-size:18pt; background-color:#ccc;'/></td></tr>
					
					<input type='hidden' name='rzz' value='".$razz."'>
					<tr><td></td></tr>
					</table></div><br>
					<div id='drzacbuttona'>
						<button  id='prvib' class='button' style='display:inline;width:70px;' onclick='prva()'>Unesi</button>
						<a href='http://".$_SERVER['HTTP_HOST']."/dnevnik/".$razz."'><button style='width:70px; min-width:60px; display:inline; float:right; margin-right: 9px; padding-left:17px;' class='button2'>Razz</button></a>";
						//echo"<label for='prvib'><input type='submit' class='unosnaprofilu' value='Zaključi' style=' float:right; margin-right:10px;'/></label></form>";
						echo"
						</div>";
						}
				
						
						echo"</div>
					";if(isset($_GET['rucno']))
					echo"<br><br><div style='display:inline-block;'><br><br><p style='font-size:14pt;'><i style='color: #555;'>Ručni unos: </i><b>".$_GET['rucno']."</b></p>
				<br><p>
				<a href='http://".$_SERVER['HTTP_HOST']."/dnevnik/".$razz."/".$ucen."' style='text-decoration:underline;'>Za običnu ocjenu kliknite ovdje</a></p></div><br><br>";
						
					/*	echo"<div id='unesi_ocjenu'>
							
						</div>
						<div id='zakljuci_ocjenu'>
							
						</div>";*/
						
						
					echo"</div>";
					echo"</div>";
		//}
		}
		else echo"<p><center><h2>Morate biti prijavljeni</h2><center></p>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>