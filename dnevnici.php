<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Dnevnik <?php echo $_POST['razz'];?> - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
			<?php if(isset($_SESSION['user']))
			{	
			mysql_set_charset('utf8');
			include('admin.php');
				$dalidir=mysql_query("select * from Profesori where Username = '".$_SESSION['user']."'"); 
				$redd=mysql_fetch_array($dalidir);
				if($redd['Direktor']!=1 && $redd['Razrednik']==0 && $admin==false)
				echo "<center><h1>Niste direktor ni razrednik !</h1></center>";
				else {
					//echo"<button class='button' id='zambut' style='position:absolute; left:20px; top:15px;'>Zamijeni kolone i redove</button>";
					if(isset($_POST['razz']))
						$razz=$_POST['razz'];
					else $razz=$redd['Razrednik'];
				/*if($redd['Razrednik'])
				$razz=$redd['Razrednik'];
				else $razz=$_POST['razz'];*/
				$red1=mysql_query("SELECT * FROM  Spisak ");
				$red2=mysql_query("select * from PredPoRazz");
				//$feccc=mysql_fetch_array($red2);
				//$kolone=mysql_num_fields($red2);
				
				$fecovanooo=mysql_fetch_array(mysql_query("select * from Profesori where Razrednik = '".$razz."'"));
				$queri213=mysql_query("select * from Predmeti where RnBr = '".$fecovanooo['Predmet']."' ");
				$fe123=mysql_fetch_array($queri213);
				$razredniik=$fecovanooo['Ime'] ." " . $fecovanooo['Prezime'] . "  (" . $fe123['Predmet'] . ")";
				
				$nizz[]=0;
				$inc=0;
				$inc2=0;
				$inc3=1;
				echo "<center><p><h2 style='color:black;'>Dnevnik ".$razz."</h2><br>
				<font style='color:black;'><b>Razrednik:</b> </font><font style='color:black;'><b>".$razredniik."</b></font>
				<br> <br> <table class='tabela' style='min-width:1400px; margin-bottom:70px;'>
				<tr id='prvi_red'>
				<td style='max-width:250px;'>Predmet</td>";
				while($b=mysql_fetch_array($red1))
				{
					if($b[$razz]!=""){
					//$nizz[$inc]=$b['Predmet'];
					//$ajba=mysql_query("select * from Predmeti where RnBr='".$b['Predmet']."'");
					//$ss=mysql_fetch_array($ajba);
					//$imepr=$ss['Predmet'];
					echo"<td>".$b[0].". ".$b[$razz]."</td>";
					$inc=$inc+1;}
				}
				
				echo "</tr>";
				//$inc=1;
				while($a=mysql_fetch_array($red2))
				{
				//$queri=mysql_query("select * from Spisak where Broj = '".$inc2."' ");
				//$fecovan=mysql_fetch_array($queri);
				if($inc3%4==1)
				echo"<tr id='space'></tr>";
			$sfd=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$a[0]."'"));
			echo"<tr><td id='prva_cell'>".$sfd['Predmet']."</td>";
			for($i=0;$i<$inc;$i++)
			{
				$brha=$i+1;
				echo"<td id='stil_ocjene'>";
				$rr=mysql_query("select * from Izmjene where Brojuc='".$brha."' and Razred ='".$razz."' and Predmet='".$a[0]."' and Zakljucna = 0");
				while($c=mysql_fetch_array($rr)){
				if($c['Tajp']==3)
							$jojoj=$c['Custom'];
						else if($c['Tajp']==2) $jojoj="Pismena";
						else if($c['Tajp']==1) $jojoj="Test";
						else if($c['Tajp']==0) $jojoj="Obična ocjena";
					echo "<span class='bojaoc".$c['Tajp']."' title='".$jojoj."' style='cursor:help;'>".date("d.m",$c['Datum'])." (<b>".$c['Ocjena']."</b>)</span><br>";}
				echo"</td>";
			}
				/*$ucenik=$a[$razz];
				if($a[$razz]!=0)
				{
					$inc2=0;
					if($ucenik!=""){
					echo"<td>".$a['Broj'].". </td><td style='color:#606060;'><i>".$ucenik."</i></td>";
					while($inc2<$inc)
					{
						$rr=mysql_query("select * from Izmjene where Brojuc='".$inc3."' and Razred ='".$razz."' and Predmet='".$nizz[$inc2]."' and Zakljucna = 0");
						echo "<td>";
						while($c=mysql_fetch_array($rr))
						echo "<span class='bojaoc".$c['Tajp']."'>".date("d.m",$c['Datum'])." (<b>".$c['Ocjena']."</b>)</span><br>";
						echo"</td>";
						$inc2=$inc2+1;
					}
					}}*/
				echo"</tr>"; $inc3=$inc3+1;
				}
				echo "</table>
				</p></center>";
				
				}}?>
	</body>
</html>