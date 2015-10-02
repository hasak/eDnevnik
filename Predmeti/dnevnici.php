<?php session_start();
include('db.php');?>
<html>
	<head>
		<title>Social 3D</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body bgcolor="#b5b5b5">
			<?php if(isset($_SESSION['user']))
			{	
			mysql_set_charset('utf8');
				$dalidir=mysql_query("select * from Profesori where Username = '".$_SESSION['user']."'"); 
				$redd=mysql_fetch_array($dalidir);
				if($redd['Direktor']!=1 && $redd['Razrednik']==0)
				echo "<center><h1>Niste direktor ni razrednik !</h1></center>";
				else {
				if($redd['Direktor']==1)
				$razz=$_POST['razz'];
				else $razz=$redd['Razrednik'];
				$red1=mysql_query("SELECT * FROM  `".$razz."` ");
				$red2=mysql_query("select * from ".$razz." where Broj = '0' ");
				$feccc=mysql_fetch_array($red2);
				$kolone=mysql_num_fields($red2);
				$fecovanooo=mysql_fetch_array(mysql_query("select * from Profesori where Razrednik = '".$razz."'"));
				$queri213=mysql_query("select * from Predmeti where RnBr = '".$fecovanooo['Predmet']."' ");
				$fe123=mysql_fetch_array($queri213);
				$razredniik=$fecovanooo['Ime'] ." " . $fecovanooo['Prezime'] . "  (" . $fe123['Predmet'] . ")";
				$inc=1;
				$inc2=1;
				echo "<center><p><h2 style='color:#606060; font-family:Verdana;'>Dnevnik ".$razz."</h2>
				<h4 style='color:#606060; font-family:Verdana;'>Razrednik: </h4><h4 style='color:#0096ff; font-family:Verdana;'>".$razredniik."</h4>
				<table border='1' id='direktor'><tr bgcolor='#95d3ff'><td align='center'>Broj</td><td align='center'>Ime i prezime</td>";
				while($inc<$kolone)
				{
					$prom=$feccc[$inc];
					$queri2=mysql_query("select * from Predmeti where RnBr = '".$prom."' ");
					$fec123=mysql_fetch_array($queri2);
					echo "<td align='center'>".$fec123['Predmet']."</td>";
					$inc=$inc+1;
				}
				echo "</tr>";
				$inc=1;
				while($a=mysql_fetch_array($red1))
				{
				$queri=mysql_query("select * from Spisak where Broj = '".$inc2."' ");
				$fecovan=mysql_fetch_array($queri);
				$ucenik=$fecovan[$razz];
				if($a['Broj']!=0)
				{
					$inc=1;
					echo"<tr><td style='color:#0096ff;'>".$inc2.". </td><td><i>".$ucenik."</i></td>";
					while($inc<$kolone)
					{
					if($a[$inc]!='0')
					$abcc=$a[$inc];
					else $abcc=" ";
					echo "<td>".$abcc."</td>";
					$inc=$inc+1;
				}}
				echo"</tr>"; $inc2=$inc2+1;
				}				
				echo "</table>
				</p></center>";
				
				}}?>
	</body>
</html>