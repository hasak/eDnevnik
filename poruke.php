<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Poruke - eDnevnik</title>
		<?php include('ink.php');?>
		<script>
			function PrikaziProm(e){
				document.getElementById("prim").style.display="none";
				document.getElementById("pos").style.display="none";
				document.getElementById("nap").style.display="none";
				var t;
				if(e==1)
					t="prim";
				if(e==2)
					t="pos";
				if(e==3)
					t="nap";
				document.getElementById(t).style.display="block";
			}
		</script>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		echo"
		<div id='navpostavke_drzac' style='cursor:pointer;'>
			<ul id='navigacijapostavke'>
				<li><a onClick='PrikaziProm(1)'>PRIMLJENE PORUKE</a></li>
				<li><a onClick='PrikaziProm(2)'>POSLANE PORUKE</a></li>
			</ul>";//if($_SESSION['prof']==false)
			echo"
				<ul class='zadnjiunavpostavke'>
					<li><a onClick='PrikaziProm(3)'>POŠALJI PORUKU</a></li>
				</ul>";echo"
		</div>
		";
		
			if(isset($_POST['nejm'])){
			if($_POST['jelan']==0)
				$e=$_SESSION['user'];
				else $e="Anonimno";
				if(isset($_POST['kome']))
				$a=$_POST['kome'];else $a=0;
				
				$b=$_POST['por'];
				if(isset($_POST['cont']))
				$b=$b."<br> Odg na: ".$_POST['cont'];
				
				
				$f=$_POST['rucno'];
				$g=$_POST['admi'];
			$okl=$_SERVER['HTTP_REFERER'];
			$ag=$_SERVER['HTTP_USER_AGENT'];
			$ip=$_SERVER['REMOTE_ADDR'];
				date_default_timezone_set('Europe/Sarajevo');
				if($f!="")
				$a=$f;
				if(isset($a)==true && isset($b)==true){
				if($b[0]!='<' && $b[0]!='(' && $b[0]!=')' && $b[0]!='>')
				$sql=mysql_query("INSERT INTO  `Poruke` (
`ID` ,
`Odkoga` ,
`Zakoga` ,
`Poruka` ,
`Procitana` ,
`Time` ,
`Oklen` ,
`IP` ,
`Sve` ,
`Adm`
)
VALUES (
NULL ,  '$e',  '$a',  '$b',  '0',  '".time()."',  '$okl','$ip','$ag', '$g'
);");
		
		if(!$sql)
		echo mysql_error();
		else echo "<p><center><h3>Poruka poslana</h3><center></p>";
		}else echo "<p><center><h3>Prvo napiši poruku!</h3><center></p>";}
		
		if(isset($_SESSION['user'])==true)
		{
		
		
		if($admin)
		$qaa=mysql_query("select * from Poruke where Zakoga='".$_SESSION['user']."' or Adm=1 order by ID desc");else
		$qaa=mysql_query("select * from Poruke where Zakoga='".$_SESSION['user']."' and Adm=0 order by ID desc");
		echo"
		<center id='prim' style='display:none'><div class='ScrollbarPoruke' id='Stil1'><table class='tabela'><tr><th>Od</th><th>Poruka</th><th>Vrijeme</th><th>Datum</th></tr>
		";
		while($fecc=mysql_fetch_array($qaa))
		{
				if($fecc['Adm']==1)
				{$acb="class='crveno'";$asdd="or Adm=1";}
		else {$acb="";$asdd="";}
				echo"<tr style='text-align:center;'><td ".$acb."><i>".$fecc['Odkoga']."</i></td><td class='crveno'><b>".$fecc['Poruka']."</b></td><td ".$acb.">".date("G:i",$fecc['Time'])."</td><td ".$acb.">".date("d.m.Y",$fecc['Time'])."</td></tr>";
				if($fecc['Procitano']==0)
				mysql_query("
		UPDATE  `Poruke` SET  `Procitana` =  '1' WHERE  `Zakoga` ='".$_SESSION['user']."' ".$asdd." ;");
		
		}
		echo"</table></div><br><br></center>";
		
		//if($admin)
		{
				echo"<center id='pos' style='display:none'><div class='ScrollbarPoruke' id='Stil1'><table class='tabela'><tr><th>Za</th><th>Poruka</th><th>Vrijeme</th><th>Datum</th></tr>";
				$sd=mysql_query("select * from Poruke where Odkoga='".$_SESSION['user']."' order by Time desc");
				while($b=mysql_fetch_array($sd))
				{
						if($b['Procitana']==0)
						$sdf="class='crveno'"; else $sdf="";
						if($b['Zakoga']=='0')
						$mnb="Admini";
						else $mnb=$b['Zakoga'];
						echo"<tr><td ".$sdf.">".$mnb."</td><td class='crveno'>".$b['Poruka']."</td><td ".$sdf.">".date("G:i",$b['Time'])."</td><td ".$sdf.">".date("d.m.Y",$b['Time'])."</td></tr>";
				}
				echo"</table></div><br><br></center>";
		}
		
		echo"<center id='nap' style='display:none'><form action='".$_SERVER['PHP_SELF']."' method='post'>
		<br><table>
		<tr><td>Za:</td><td><select name='kome' style='background: none;
border: 1px solid black;
width: 171px;'><option value='0'></option>
		";
		$selec=mysql_query("select * from Profesori where Radi='1' and (Direktor='0' or Reg<1439040225)");
		while($stavi=mysql_fetch_array($selec))
		{
				$selekt=mysql_query("select * from Predmeti where RnBr='".$stavi['Predmet']."'");
				$ru=mysql_fetch_array($selekt);
				$predmetak=$ru['Predmet'];
				echo"<option value='".$stavi['Username']."'>".$stavi['Ime']." ".$stavi['Prezime']." (".$predmetak;
					$ju=mysql_query("select * from Vise where Profa='".$stavi['RnBr']."'");
			while ($b=mysql_fetch_array($ju)) {
				$mn=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
				echo", ".$mn['Predmet'];
			}
					echo")</option>";
		
		}
		echo"</select></td></tr>
		<tr><td>Ili Username:</td><td><input type='text' name='rucno'></td></tr>
		<tr><td>Poruka:</td><td><textarea name='por' rows='4' style='background: none;
border: 1px solid black;
width: 171px;'></textarea></td></tr>
		</table><br>
		<input type='hidden' name='admi' value='0'>
		<input type='hidden' name='jelan' value='0'>
		<input type='Submit' name='nejm' value='Pošalji poruku' class='button'/><br><br>
		</form></center>";
		}
		//else echo"<p><center><h1>Niste logovani!</h1><center></p>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>