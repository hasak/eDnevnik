<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Posjećenost - eDnevnik</title>
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		//echo time();
		$min=10;////////////////// -> Unesi samo broj minimalnih minuta od zadjne posjete
		$seec=60*$min;//////////
		
		
		$myfa=mysql_query("select * from Sesije order by Time asc");
		if(mysql_num_rows($myfa))
		{
			$fgs=mysql_fetch_array($myfa);
			$odk=$fgs['Time'];
		}
		else $odk=time();
		
		$sveuu=0;
		echo"<center><br><h2>Posjećenost eDnevnika</h2><h3>Top 10</h3><br><br>";
		$a1=mysql_query("select * from Sesije where Odjava=0 and Admin=0");
		$broj=mysql_num_rows($a1);
		$a2=mysql_query("select * from users where Akt='1' order by UserID desc");
		$e=mysql_fetch_array($a2);
		$i=0;
		$num=$e['UserID'];
		for($i=1;$i<=$num;$i=$i+1)
		{
				$a3=mysql_query("select * from Sesije where Prof='0' and Odjava='0' and Admin='0' and User='".$i."'");
				//$num2=mysql_num_rows($a3);
				//$niz[$i]=$num2;
				
				
			$c=0;
			$t=0;
			while($b=mysql_fetch_array($a3))
			{
					if($t+$seec<=$b['Time'])
					$c=$c+1;
					$t=$b['Time'];
			}
			$niz[$i]=$c;
			$sveuu=$sveuu+$c;
				//echo $i." - ".$num2."<br>";
		}
		for($i=1;$i<=$num;$i=$i+1)
		$x[$i]=$i;
		
		for($i=1;$i<=$num-1;$i=$i+1)
		for($j=$i+1;$j<=$num;$j=$j+1)
		{
				if($niz[$i]<$niz[$j])
				{
						$t=$niz[$i];
						$niz[$i]=$niz[$j];
						$niz[$j]=$t;
						
						$t=$x[$i];
						$x[$i]=$x[$j];
						$x[$j]=$t;
						
				}
		}
		/*
		for($i=1;$i<11;$i=$i+1)
		{
				$ad=mysql_fetch_array(mysql_query("select * from users where UserID='".$x[$i]."'"));
				echo $i.". ".$ad['Username']." - ".mysql_num_rows(mysql_query("select * from Sesije where Prof='0' and Odjava='0' and Admin='0' and User='".$x[$i]."'"))."<br>";
		}
		*/
		//echo"<br><br><br>aprofe?<br>internal error brate<br><br>";
		
		
		$a2=mysql_query("select * from Profesori where Radi='1' order by RnBr desc");
		$e=mysql_fetch_array($a2);
		$i=0;
		$num=$e['RnBr'];
		for($i=1;$i<=$num;$i=$i+1)
		{
				$a3=mysql_query("select * from Sesije where Prof='1' and Odjava='0' and Admin='0' and User='".$i."'");
				//$num2=mysql_num_rows($a3);
				//$niz[$i]=$num2;
				
			$c2=0;
			$t2=0;
			while($b2=mysql_fetch_array($a3))
			{
			$ade=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$i."'"));
					if($t2+$seec<=$b2['Time'] and (!$ade['Direktor'] or $ade['Reg']<1439040225))
					$c2=$c2+1;
					$t2=$b2['Time'];
			}
				//echo $i." - ".$num2."<br>";
				$niz[$i]=$c2;
				$sveuu=$sveuu+$c2;
		}
		for($i=1;$i<=$num;$i=$i+1)
		$y[$i]=$i;
		
		for($i=1;$i<=$num-1;$i=$i+1)
		for($j=$i+1;$j<=$num;$j=$j+1)
		{
				if($niz[$i]<$niz[$j])
				{
						$t=$niz[$i];
						$niz[$i]=$niz[$j];
						$niz[$j]=$t;
						
						$t=$y[$i];
						$y[$i]=$y[$j];
						$y[$j]=$t;
						
				}
		}
		/*
		for($i=1;$i<11;$i=$i+1)
		{
				$ad=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$y[$i]."'"));
				echo $i.". ".$ad['Username']." - ".mysql_num_rows(mysql_query("select * from Sesije where Prof='1' and Odjava='0' and Admin='0' and User='".$y[$i]."'"))."<br>";
		}
		*/
		
		echo"<p style='float:right; text-align:right; width:100%;'>Ukupno: <b>".$sveuu."</b></p>
		<table class='tabela' style='float:left; width:300px;'><tr id='prvi_red'><td colspan='3'>Učenici</td></tr>";
		for($i=1;$i<11;$i=$i+1)
		{
				$ad=mysql_fetch_array(mysql_query("select * from users where UserID='".$x[$i]."'"));
				//echo $i.". ".$ad['Username']." - ".mysql_num_rows(mysql_query("select * from Sesije where Prof='0' and Odjava='0' and Admin='0' and User='".$x[$i]."'"))."<br>";
		
				//echo $i.". ".$ad['Username']." - ".mysql_num_rows(mysql_query("select * from Sesije where Prof='1' and Odjava='0' and Admin='0' and User='".$y[$i]."'"))."<br>";
		
		$a=mysql_query("select * from Sesije where Prof='0' and Odjava='0' and Admin='0' and User='".$x[$i]."'");
		
		$c=0;
		$t=0;
		while($b=mysql_fetch_array($a))
		{
				if($t+$seec<=$b['Time'])
				$c=$c+1;
				$t=$b['Time'];
		}
		
		
		echo"<a href='http://".$_SERVER['HTTP_HOST']."/ucenik/".$ad['UserID']."'></a>
		<tr onClick='document.location=&#39;http://".$_SERVER['HTTP_HOST']."/ucenik/".$ad['Username']."&#39;' style='cursor:pointer;'><td id='prva_cell'>".$i."</td><td>".$ad['Username']."</td><td><b>".$c."</b></td></tr>";
		
		
		//echo"<tr><td id='prva_cell'>".$i."</td><td>".$ad['Username']."</td><td><b>".mysql_num_rows(mysql_query("select * from Sesije where Prof='0' and Odjava='0' and Admin='0' and User='".$x[$i]."'"))."</b></td>
		//<td style='background:none; border:none;'></td>
		//<td id='prva_cell'>".$i."</td><td>".$ad2['Username']."</td><td><b>".mysql_num_rows(mysql_query("select * from Sesije where Prof='1' and Odjava='0' and Admin='0' and User='".$y[$i]."'"))."</b></td></tr>";
		}
		
		echo"</table><table class='tabela' style='float:right; width:300px;'><tr id='prvi_red'><td colspan='3'>Profesori</td></tr>";
		for($i=1;$i<11;$i=$i+1)
		{
			$ad2=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$y[$i]."'"));
		if($ad2['Direktor']==1)
		$stil="style='color:#6B9BD5;'";else $stil="";
	
	
		$a2=mysql_query("select * from Sesije where Prof='1' and Odjava='0' and Admin='0' and User='".$y[$i]."' and Time>'1421622000'");
	
	
		$c2=0;
		$t2=0;
		while($b2=mysql_fetch_array($a2))
		{
				if($t2+$seec<=$b2['Time'])
				$c2=$c2+1;
				$t2=$b2['Time'];
		}
	
		echo"<tr onClick='document.location=&#39;http://".$_SERVER['HTTP_HOST']."/profil/".$ad2['Username']."&#39;' style='cursor:pointer;'><td id='prva_cell'>".$i."</td><td ".$stil.">".$ad2['Username']."</td><td><b>".$c2."</b></td></tr>";
	
	
		}
		
		echo"</table><br>	
		
		<p style='display:table;'><i><br>*Navedene brojke pokazuju broj posjeta od ".date("d.m.Y.",$odk)." do danas.<br>Da bi se posjeta brojala, mora proći minimalno <b>".$min." minuta</b> od zadnje.</i></p><br></center>"
		//echo time();
		?>
		<?php include("ftincld.php");?>
		</body>
</html>