<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>AJAX - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php 
		
	if($_SESSION['prof'])
	{	
		//echo $_GET['razred']."<br>".$_GET['predmet'];
		$qee=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcarajjj=mysql_fetch_array($qee);
		$idic=$fetcarajjj['RnBr'];
		$pred=$fetcarajjj['prdm'];
		
		if($_GET['unesi'])
		{
			$a=$_GET['broj'];
			$b=$idic;
			$c=$_GET['predmet'];
			$d=$_GET['razred'];
			$e=$_GET['text'];
			$f=$_GET['datum'];
			$g=time();
			$h=$_GET['vrsta'];
			if(mysql_num_rows(mysql_query("select * from Casovi where BrCasa='".$a."' and Pred='".$c."' and Prof='".$b."' and Razz='".$d."'"))){
				$ee="<br><span style='color:#f00;'>Već postoji taj broj časa tog predmeta u tom razredu!</span>";
				//die(mysql_error());
			}
			else {
				
			mysql_query("insert into Casovi (`ID`,`BrCasa`,`Prof`,`Pred`,`Razz`,`Cas`,`Datum`,`Pravi`,`Vrsta`) values(null,'$a','$b','$c','$d','$e','$f','$g','$h');");
		$ee="<br><span style='color:#228B22;'>Uspješno dodadno!</span>";
			}
		}
		
		if($_GET['razred']!="" and $_GET['razred']!="undefined")
		{
			echo"<br><div style='float:left;'>".$ee."<br><table style='width:400px;'><tr><td>Broj:</td><td><select id='brrr'>";
		for($i=1;$i<=150;$i++){
			$aa=mysql_query("select * from Casovi where BrCasa='".$i."' and Prof='".$idic."' and Pred='".$_GET['predmet']."' and Razz='".$_GET['razred']."'");
			if(!mysql_num_rows($aa))
			{
				if($_GET['broj']==$i)
					$sel2="selected";
				else $sel2="";
				echo "<option value='".$i."' ".$sel2.">".$i."</option>";
			}
		}
		echo"</select></td><td>Vrsta:</td><td><select id='vrss' style='float:right;'><option value='0'></option>";
		$select=mysql_query("select * from Vrcasa");
		while($muu=mysql_fetch_array($select))
		{
			if($_GET['vrsta']==$muu['ID'])
				$sel="selected";
			else $sel="";
			echo"<option value='".$muu['ID']."' ".$sel.">".$muu['Vrsta']."</option>";
		}
		if(isset($_GET['text']) and $_GET['text']!="undefined")
		$gee=$_GET['text'];
		else $gee="";
		echo"</select></td></tr><tr><td colspan='2'>Datum:</td><td colspan='2'><select name='datumm' id='datumm' class='datun' style='width:100px;float:right;'>";
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
				echo"<option value='".$unix."'>".$pocd.".".$pocm.".".date("Y",$unix).".</option>";
				
				$c=$c+1;
				}
				
				$unix=$unix-86400;
		}
					echo "</select></td></tr>
		<tr><td colspan='4'><br><br>Čas:<br><textarea id='teksss' style='width:100%;height:100px;'>".$gee."</textarea></td></tr>
		<tr><td colspan='4'><br><center><button class='button' id='trigun'>Unesi</button></center></td></tr></table></div>";
		$acv=mysql_query("select * from Casovi where Prof='".$idic."' and Pred='".$_GET['predmet']."' and Razz='".$_GET['razred']."' order by BrCasa desc");
		if(mysql_num_rows($acv)){
			
			$p=mysql_fetch_array($acv);
		echo"
		<div style='float:right;'><center><i>Prethodni čas:</i></center><br><table style='width:250px;color:#8A2BE2;'><tr><td>Broj časa: <b>".$p['BrCasa']."</b></td><td>".date("j.n.Y",$p['Datum'])."</td></tr>
		<tr><td colspan='2'><br>".$p['Cas']."</td></tr></div>";
		}
		}
		
		
		if(isset($_GET['postaj']))
		{
			$gt=mysql_query("select * from Spisak");
			$raz=$_GET['razzanj2'];
			echo"<form id='formaza'><input type='hidden' name='unizuc' value='daa'/>
			<input type='hidden' name='predmett' value='".$_GET['predzanj2']."'/>
			<input type='hidden' name='rddd' value='".$_GET['razzanj2']."'/><table id='minit' style='font-size:11pt;'><br><tr><td>Datum:</td><td><select name='datumm2' id='datumm2' onchange='prcas()' class='datun' style='width:100px;float:right;'>";
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
				echo"<option value='".$unix."' style='font-size:11pt;'>".$pocd.".".$pocm.".".date("Y",$unix).".</option>";
				
				$c=$c+1;
				}
				
				$unix=$unix-86400;
		}
					echo "</select></td></tr></table><br><br><table id='casovi' class='regg'><tr><td>Čas</td><td>";
					$pocd=mktime(0,0,0,date("n"),date("j"),date("Y"));
				$krajd=mktime(23,59,59,date("n"),date("j"),date("Y"));
			$q=mysql_query("select * from Casovi where Prof='".$idic."' and Datum<'".$krajd."' and Datum>'".$pocd."'");
			if(mysql_num_rows($q))
			{
			echo "<select name='slel'>";
				while($b=mysql_fetch_array($q))
				{
					echo"<option value='".$b['BrCasa']."'>".$b['BrCasa']."</option>";
				}
			echo "</select></td></tr>";
			while($b=mysql_fetch_array($gt))
			{
				echo "<tr><td style='font-size:15pt;' colspan='2'><input type='checkbox' style='position:absolute; left:-9999px;' name='chkek".$b['Broj']."' id='chk".$b['Broj']."'/>
				<label for='chk".$b['Broj']."'>".$b["$raz"]."</label></td></tr>";
			}
			echo "<tr><td colspan='2'>";
			//if($nesto)
				echo"<br><center><button id='trigerrr' class='button'>Zapiši</button></center>";
			echo"</td></tr></table></form>";
			}else echo"Nemate na taj dan upisanih časova u tom razredu tog predmeta!</td></tr></table>";
					echo"<br><br>";
		}
		
		
		
		
		
		
		if(isset($_GET['datuuu']))
		{
			$d=$_GET['datuuu'];
			$raz=$_GET['razredd'];
				///mktime(hour,minute,second,month,day,year,is_dst);
				$pocd=mktime(0,0,0,date("n",$d),date("j",$d),date("Y",$d));
				$krajd=mktime(23,59,59,date("n",$d),date("j",$d),date("Y",$d));
			$q=mysql_query("select * from Casovi where Prof='".$idic."' and Datum<'".$krajd."' and Datum>'".$pocd."'");
			echo"<tr><td>Čas</td><td>";
			if(mysql_num_rows($q))
			{
				$gt2=mysql_query("select * from Spisak");
			echo "<select name='slel'>";
				while($b=mysql_fetch_array($q))
				{
					echo"<option value='".$b['BrCasa']."'>".$b['BrCasa']."</option>";
				}
			echo "</select>";
			while($b=mysql_fetch_array($gt2))
			{
				echo "<tr><td style='font-size:15pt;' colspan='2'><input type='checkbox' style='position:absolute; left:-9999px;' name='chkek".$b['Broj']."' id='chk".$b['Broj']."'/>
				<label for='chk".$b['Broj']."'>".$b["$raz"]."</label></td></tr>";
			}
			echo "<tr><td colspan='2'>";
			//if($nesto)
				echo"<br><center><button id='trigerrr' class='button'>Zapiši</button></center>";
			echo"</td></tr>";
			}else echo"Nemate na taj dan upisanih časova u tom razredu tog predmeta!";
		}
		
		
		if(isset($_POST['unizuc']))
		{
			$qq=mysql_query("select * from Spisak");
			$a=$_POST['slel'];
			$b=$idic;
			$c=$_POST['predmett'];
			$d=$_POST['rddd'];
			//$e=$_POST['text'];
			$f=$_POST['datumm2'];
			$g=time();
			
			while($ng=mysql_fetch_array($qq))
			{
				$pra="chkek".$ng['Broj'];
				$h=$ng['Broj'];
				//echo $_POST[$pra];
			if(isset($_POST[$pra])){
					//$h=$_POST[$pra];
					$aa=mysql_query("INSERT INTO `Izostanci` (`ID`, `Ucen`, `Razz`, `Prof`, `Pred`, `BrCasa`, `Razlog`, `Datum`, `Pravi`, `Opr`) 
			                                                     VALUES (NULL, '$h', '$d', '$b', '$c', '$a', '', '$f', '$g', '0');");
					if(!$aa)
					{
						die(mysql_error());
					}
				}
			
				
			}
																 
			//if(mysql_query())
				echo"<i style='color:#8A2BE2'>Uspješan unos izostanaka</i>";
		}
	}
		else echo"Niste profesor ili niste prijavljeni!";
		?>
	</body>
</html>