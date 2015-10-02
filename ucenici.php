<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Učenici - eDnevnik</title>
		<?php include('ink.php'); 
		if(isset($_POST['aaaa']))
		{
			if($_POST['nekipost']==0)
				header("Location: http://".$_SERVER['HTTP_HOST']."/ucenici/svi");
			else header("Location: http://".$_SERVER['HTTP_HOST']."/ucenici/".$_POST['nekipost']);
		}?>
	</head>
	<body>
		<?php include("includ.php");?>
				<?php 
				
				if(isset($_GET['nekipost']))
				{
				if($_GET['nekipost']==0)
				{$red=mysql_query("select * from users order by UserID");
				$sa="Svi učenici";
				}
				else
				{$red=mysql_query("select * from users where Razred='".$_GET['nekipost']."'");
				$sa="Učenici ".$_GET['nekipost'].". razreda";
				}
				$vid="<center><h1>".$sa."</h1></center>";
			echo $vid."<center>
			<div class='ScrollbarUceniciPretraga' id='Stil1'>
			<table class='tabela'><tr id='prvi_red'><td>ID</td>
			<td>Username</td><td>Ime i prezime</td><td>Razred</td><td>Smjer</td><td>Registrovan</td></tr>";
			while($rcd=mysql_fetch_array($red)){
			/*if($rcd['Admin']==1)
			$ad="Admin";
			else $ad="";*/
			echo "<tr style='cursor:pointer;' onclick='document.location = &#39;http://".$_SERVER['HTTP_HOST']."/ucenik/".$rcd['UserID']."&#39;;'>
			<td id='prva_cell'>".$rcd['UserID']."</td>
			<td>".$rcd['Username']."</td>
			<td>".$rcd['Ime']." ".$rcd['Prezime']."</td>
			<td>".$rcd['Razred']."</td>
			<td>";
			$mg=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$rcd['Smjer']."'"));
			echo $mg['Ime']."</td>
			<td>".date("d.m.Y",$rcd['Reg'])."</td></tr>
			";}
		
			echo "</table><input type='hidden' name='rzz' value='".$_GET['nekipost']."'></div>";
			} else{ echo"<center><h1>Učenici</h1></center><br><br><center><form action='".$_SERVER['PHP_SELF']."' method='post'>
			
			<table id='razredi'><td colspan='4'><input type='radio' name='nekipost' value='0' id='zer' style='position:absolute; left:-9999px;' checked><label for='zer'>Svi</label></td>
				<tr>";
				$kojimraz=mysql_query("select * from Razredi");
				//$redzaraz=mysql_fetch_array($kojimraz);
				$kolum=mysql_num_fields($kojimraz);
				$cpp=1;
				$cp=0;
				while($cpp<$kolum)
				{
						//$cp=0;
						$imeraz=mysql_field_name($kojimraz,$cpp);
						if($cp%4==0)
						echo"</tr><tr>";
						echo"
								<td><input type='radio' name='nekipost' value='".$imeraz."' id='".$imeraz."' style='position:absolute; left:-9999px;'><label for='".$imeraz."'>".$imeraz."</label></td>";
						
						/*while($cp<4)
						{
								echo"";
								$cp=$cp+1;
						}*/
						$cpp=$cpp+1;
						$cp=$cp+1;
				}
				echo"</tr>
				</table>
			";
					//echo"<select name='nekipost'><option value='0'>Svi</option>'";
				$kuer=mysql_query("select * from Razredi");
				$majf=mysql_fetch_array($kuer);
				/*$brinc=mysql_num_fields($kuer);
				$kre=1;
				while($kre<$brinc)
				{
					$kojir=mysql_field_name($kuer,$kre);
					echo"<option value='".$kojir."'>".$kojir."</option>";
					$kre=$kre+1;
				}
				echo"</select>*/
				echo"<br><br><input type='submit' value='Odaberi' name='aaaa' class='button2'></form></center>";}
			?>
		<?php include("ftincld.php");?>
	</body>
</html>