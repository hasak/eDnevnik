<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Panel razrednika - eDnevnik</title>
		<?php include('ink.php'); ?>
		<script type="text/javascript">
		function myf1()
		{
				document.getElementById('vladanja').style.display="block";
				document.getElementById('obavijestii').style.display="none";
				document.getElementById('izostan').style.display="none";
				document.getElementById('zapisn').style.display="none";
				document.getElementById('bbaa').style.display="block";
				document.getElementById('drzac_rikona').style.display="none";
		}
		function myf2()
		{
				document.getElementById('vladanja').style.display="none";
				document.getElementById('obavijestii').style.display="block";
				document.getElementById('izostan').style.display="none";
				document.getElementById('zapisn').style.display="none";
				document.getElementById('drzac_rikona').style.display="none";
				document.getElementById('bbaa').style.display="block";
		}
		function myf3()
		{
				document.getElementById('vladanja').style.display="none";
				document.getElementById('obavijestii').style.display="none";
				document.getElementById('izostan').style.display="block";
				document.getElementById('zapisn').style.display="none";
				document.getElementById('drzac_rikona').style.display="none";
				document.getElementById('bbaa').style.display="block";
		}
		function myf4()
		{
				document.getElementById('vladanja').style.display="none";
				document.getElementById('obavijestii').style.display="none";
				document.getElementById('drzac_rikona').style.display="none";
				document.getElementById('izostan').style.display="none";
				document.getElementById('zapisn').style.display="block";
				document.getElementById('bbaa').style.display="block";
		}
		function ponisti()
		{
				document.getElementById('vladanja').style.display="none";
				document.getElementById('obavijestii').style.display="none";
				document.getElementById('bbaa').style.display="none";
				document.getElementById('izostan').style.display="none";
				document.getElementById('zapisn').style.display="none";
				document.getElementById('drzac_rikona').style.display="block";
	}
		</script>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		if($_SESSION['prof']==true)
		{
		if(isset($_POST['vladnj'])){
		$inc=1;
				$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
		$razz=$fetcaraj['Razrednik'];
		$koje=$fetcaraj['RnBr'];
				while($inc<34)
				{
							$a=$_POST[$inc];
							$minc=-$inc;
							$b=$_POST[$minc];
							
							
							$dejt=date("d.m");
							
							
							if($a!="" && $a<6 && $a>0 && $a!="0"){
							//$fec=mysql_fetch_array(mysql_query("select * from ".$razz." where Broj='".$inc."'"));
							//$qu=mysql_query("UPDATE  Ucenici SET  `Vladanje` =  '".$a."' WHERE  `Broj` ='".$inc."' and Razred ='".$razz."' LIMIT 1;");
							$qu2=mysql_query("INSERT INTO  `Vladanja` (
`ID` ,
`Prof` ,
`BrUc` ,
`Razz` ,
`Razlog` ,
`Ocjena` ,
`Datum`
)
VALUES (
NULL ,  '$koje',  '$inc',  '$razz',  '$b',  '$a',  '$dejt'
);");
							if(!$qu2)
							die(mysql_error());}
							
							$inc=$inc+1;}}
		if(isset($_POST['obraz'])){
		$gdje=mysql_query("select * from Profesori where Username ='". $_SESSION['user']."'");
				$red=mysql_fetch_array($gdje);
				$toje=$red['RnBr'];
				//$prezz=$red['Prezime'];
				$raz=" ";
				//$toje=$imee.$raz.$prezz;
				$msg=$_POST['msg'];
				$rzz=$_POST['razz'];
				$date=date('d.m.Y');
				
				//$sql=mysql_query("update `eDnevnik'".$gdjeje."' set 'Img' = '".$url."' where '".$gdjeje."'.'".$staje."' =".$toje." limit 1");
				//$sql=mysql_query("UPDATE  `eDnevnik`Obavijesti` SET  `Img` =  '".$url."' WHERE  `".$gdjeje."`.`".$staje."` =".$toje." LIMIT 1");
				$sql=mysql_query("INSERT INTO `Obavijesti` (
				`ID` ,
				`Autor` ,
				`Msg` ,
				`Date`,
				`Razz` 
				)
				VALUES (
				NULL ,  '$toje',  '$msg', '$date', '$rzz'
				)
					");
				if(!$sql)
					die('Greska' . mysql_error());}
		
		
		
		//$razz=$_POST['razz'];
		//$query=mysql_query("select * from ".$razz);
		$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
		$razz=$fetcaraj['Razrednik'];
		//$rzz="'".$razz."'";
		$query=mysql_query("select * from Spisak");
		$pred=$fetcaraj['Predmet'];
		$query2=mysql_query("select * from Predmeti where RnBr = '".$pred."'");
				$fec=mysql_fetch_array($query2);
				$pred2=$fec['Predmet'];
				//$proba="'".$pred."'";
		echo"
		<button style='float:right; width:30px; height:30px; text-align:center; display:none;' id='bbaa' class='button2' onClick='ponisti()'>X</button>
		<br><br>
		<div id='content_margine'>
					<div id='drzac_rikona'>
						<div id='robavijesti' class='apklasa' onClick='myf2()'></div>
						<div id='rvladanje' class='apklasa' onClick='myf1()'></div>
					<a href='http://".$_SERVER['HTTP_HOST']."/dnevnici' target='_blank'><div id='rdnevnici' class='apklasa'></div></a>
					<button class='button2' onClick='myf3();'>Izostanci</button><br><br><button class='button2' onClick='myf4();'>Zapisnici</button>
					</div>
				</div>
		
		<div id='vladanja' style='display:none;'>
		<center><h2>Vladanja ".$razz."</h2></center>
		<br><form action='".$_SERVER['PHP_SELF']."' method='post'>
		<center>
		<table class='tabela'>
		<tr id='prvi_red'><td>Broj</td><td>Ucenik</td><td>Razlog</td><td>Datum</td><td>Vladanje</td><td>Promijeni</td></tr>
		";
		while($ured=mysql_fetch_array($query))
		{
					//$ime=mysql_query("select * from Spisak where '".$razz."'='".$ured['Broj']."'");
					//$imee=mysql_fetch_array($ime);
					
					$ter=mysql_query("select * from Vladanja where Bruc='".$ured['Broj']."' and Razz='".$razz."' order by ID desc");
					if(mysql_num_rows($ter)!=0)
					{
						$atr=mysql_fetch_array($ter);
						$razlog=$atr['Razlog'];
						$ocjena=$atr['Ocjena'];
						$datum=$atr['Datum'];
						$hztu="class='crveno'";
					} else {
					$razlog="";$datum="";$ocjena=5; $hztu="";
					}
					/*$nekaprom=mysql_fetch_array(mysql_query("select * from Ucenici where Broj ='".$ured['Broj']."' and Razred='".$razz."'"));
					$ocjena=$nekaprom['Vladanje'];
					if(!isset($nekaprom['Vladanje'])){$ocjena=5; $hztu="";} else $hztu="class='crveno'";*/
					$nejm=-$ured['Broj'];
					/*$prrr=mysql_query("select * from Vladanja where BrUc ='".$ured['Broj']."' and Razz ='".$razz."'");
					if(mysql_num_rows($prrr)!=0)
					{			
							while(
							$ajmof=mysql_fetch_array($prrr)){
							$razlog=$ajmof['Razlog'];
							$datum=$ajmof['Datum'];}
					}
					else {$razlog="";$datum="";}*/
					if($ocjena==5)
						$ocjena="Uzorno";
					if($ocjena==4)
						$ocjena="Vrlodobro";
					if($ocjena==3)
						$ocjena="Dobro";
					if($ocjena==2)
						$ocjena="Zadovoljavajuće";
					if($ocjena==1)
						$ocjena="Loše";
					
					if($ured[$razz]!="")
					echo"<tr><td id='prva_cell'>".$ured['Broj']."</td><td><i>".$ured[$razz]."</i></td><td><input type='text' name='".$nejm."' value='".$razlog."' 'style='width:100%;'/></td><td>".$datum."</td>
					<td style='font-weight:bold;'".$hztu.">".$ocjena."</td>
					<td style='width:80px;'><select name='".$ured['Broj']."'>
					
					<option value='0'></option>
					<option value='5'>Uzorno</option>
					<option value='4'>Vrlodobro</option>
					<option value='3'>Dobro</option>
					<option value='2'>Zadovoljavajuće</option>
					<option value='1'>Loše</option>
					
					</select></td></tr>";
		
		}
		echo"</center>
		</table><br>
		<input type='submit' name='vladnj' class='button' value='Promijeni'/>
		</form>
		</div>
		<div id='obavijestii' style='display:none;'>
		<center><h3>Obavijesti</h3></center>
			<br><br>
			<center><h4>Dodaj obavijest:</h4><form action='".$_SERVER['PHP_SELF']."' method='post'>
			<textarea rows='6' cols='40' name='msg'></textarea>
			<br><br>
			<input type='hidden' name='razz' value='".$razz."'/>
			<input type='submit' class='button' name='obraz' value='Dodaj'/>
			</form></center><br><br>
				<center>
				<table class='tabela'>
				<tr id='prvi_red'><td>Profesor</td><td>Obavijest</td><td>Datum</td></tr>"; 
				$msg=mysql_query("select * from Obavijesti order by ID desc");
				//$nekinc=0;
				while($uzmi=mysql_fetch_array($msg))
				{
						//if( $nekinc<10){
						$uzm=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$uzmi['Autor']."'"));
						echo"<tr><td id='prva_cell'>".$uzm['Ime']." ".$uzm['Prezime']."</td><td class='crveno'>".$uzmi['Msg']."</td><td>".$uzmi['Date']."</td></tr>";
						//$nekinc=$nekinc+1;}
				}
				
				echo"
				
				</table>
				</center>
		</div>
		";
		if(isset($_POST['submm']))
		{
			$qf=mysql_query("select * from Spisak");
			while($b=mysql_fetch_array($qf))
			{
				$adg="razl".$b['Broj'];
				$avb="elopr".$b['Broj'];
				$hzt="sec".$b['Broj'];
				$asg=$_POST[$hzt];
				$ec=$_POST[$adg];
				$gbn=$_POST[$avb];
				//echo"--".$asg."--".$ec."--".$gbn."--<br>";
				if(isset($_POST[$avb]) and $_POST[$avb]!=0)
				{
					$abn=mysql_query("update Izostanci set Razlog='".$ec."' , Opr='".$gbn."' where ID='".$asg."'");
					if(!$abn)
						die(mysql_error());
				}
			}
			echo"<br><br><br><br><center><br><h2>Uspješan unos!</h2></center>";
		}
		echo"
		<div id='izostan' style='display:none;'><center><form method='post'><br><h2>Izostanci:</h2>
		<table class='tabela'><tr id='prvi_red'><td>ID</td><td>Ime i prezime</td><td>Broj</td><td>Pred</td><td>Prof</td><td>Datum</td><td>Razlog</td><td>Opravdano</td></tr>";
		$qd=mysql_query("select * from Izostanci where Razz='".$razz."' and Opr='0' order by ID desc");
		if(!mysql_num_rows($qd))
			echo"<tr><td colspan='8'><i style='color:#888;'>Nema izostanaka na čekanju</i></td></tr>";
		else{
			while($b=mysql_fetch_array($qd))
			{
				$av=mysql_fetch_array(mysql_query("select * from Spisak where Broj='".$b['Ucen']."'"));
				$avc=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
				$acc=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$b['Prof']."'"));
				
				echo"<tr><td id='prva_cell'>".$b['ID']."</td>
				<td>".$av[$razz]."</td>
				<td>".$b['Ucen']."</td>
				<td>".$avc['Predmet']."</td>
				<td>".$acc['Ime']." ".$acc['Prezime']."</td>
				<td>".date("j.n.Y",$b['Datum'])."</td>
				<td><input type='text' name='razl".$b['Ucen']."'><input type='hidden' name='sec".$b['Ucen']."' value='".$b['ID']."'/></td>
				<td><select name='elopr".$b['Ucen']."'>
				<option value='0'>Na čekanju</option>
				<option value='1'>Opravdano</option>
				<option value='2'>Neopravdano</option>
				</select></td></tr>";
			}
		}
		echo"		
		</table><br><br><input type='submit' name='submm' class='button' value='Unesi'/></form>
		<br><br><br><u style='cursor:pointer;' onClick='$(\"#daaa\").show();'>Svi izostanci ovog razreda</u><br><br>
		<div id='daaa' style='display:none;'><table class='tabela'><tr id='prvi_red'><td>ID</td><td>Ime i prezime</td><td>Broj</td><td>Pred</td><td>Prof</td><td>Datum</td><td>Razlog</td><td>Opravdano</td></tr>";
		$qd=mysql_query("select * from Izostanci where Razz='".$razz."' order by ID desc");
		if(!mysql_num_rows($qd))
			echo"<tr><td colspan='8'><i style='color:#888;'>Nema izostanaka na čekanju</i></td></tr>";
		else{
			while($b=mysql_fetch_array($qd))
			{
				$av=mysql_fetch_array(mysql_query("select * from Spisak where Broj='".$b['Ucen']."'"));
				$avc=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
				$acc=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$b['Prof']."'"));
				if(!$b['Opr'])
					$prm="-";
				else $prm=$b['Razlog'];
				if($b['Opr']==1)
					$agg="<b style='color:#090;'>da</b>";
				else if($b['Opr']==2)$agg="<b style='color:#f33;'>ne</b>";
				else $agg="<i style='color:#888;'>ne</i>";
				
				echo"<tr><td id='prva_cell'>".$b['ID']."</td>
				<td>".$av[$razz]."</td>
				<td>".$b['Ucen']."</td>
				<td>".$avc['Predmet']."</td>
				<td>".$acc['Ime']." ".$acc['Prezime']."</td>
				<td>".date("j.n.Y",$b['Datum'])."</td>
				<td>".$prm."</td>
				<td>".$agg."</td></tr>";
			}
		}
		echo"		
		</table><br><br><br><table class='tabela'><tr id='prvi_red'><td>Broj</td><td>Učenik</td><td>Opravdanih</td><td>Neopravdanih</td><td>Na čekanju</td><td>Ukupno</td></tr>
		";
		$avv=mysql_query("select * from Spisak");
		while($b=mysql_fetch_array($avv))
		{
			if($b[$razz]!="")
			{
				echo"<tr><td id='prva_cell'>".$b['Broj']."</td><td>".$b[$razz]."</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where Ucen='".$b['Broj']."' and Razz='".$razz."' and Opr='1'"))."</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where Ucen='".$b['Broj']."' and Razz='".$razz."' and Opr='2'"))."</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where Ucen='".$b['Broj']."' and Razz='".$razz."' and Opr='0'"))."</td>
				<td><b>".mysql_num_rows(mysql_query("select * from Izostanci where Ucen='".$b['Broj']."' and Razz='".$razz."'"))."</b></td>
				</tr>";
			}
		}
		echo"<tr><td style='height:5px;' colspan='6'></td></tr>
		<tr style='font-weight:bold;'><td id='prva_cell'>∑</td><td>Suma</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where  Razz='".$razz."' and Opr='1'"))."</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where  Razz='".$razz."' and Opr='2'"))."</td>
				<td>".mysql_num_rows(mysql_query("select * from Izostanci where Razz='".$razz."' and Opr='0'"))."</td>
				<td><b>".mysql_num_rows(mysql_query("select * from Izostanci where Razz='".$razz."'"))."</b></td>
				</tr>
		
		
		</table><br><br></div></center>
		</div>
		
		<div id='zapisn' style='display:none;'>test
		</div>
		
		";
		
		
		}
		else echo"<p><center><h1>Niste profesor !</h1><center></p>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>