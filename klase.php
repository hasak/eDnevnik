<?php ob_start(); session_start();
include('db.php');
include('admin.php');
if($_GET['tip']=="nova")
{$nasl="Nova klasa";
$ono=1;}
else if($_GET['tip']=="izmjena")
{$nasl="Izmijeni klasu";$ono=2;}
else if($_GET['tip']=="brisi")
{$nasl="Briši klasu"; $ono=3;}
else {$nasl="Klase"; $ono=4;}?>
<html>
	<head>
		<title><?php echo $nasl; ?> - eDnevnik</title>
		<?php include('ink.php'); ?>
	</head>
	<body bgcolor="white"><br><br><center>
		<div style="background-color:white;width:900px;opacity:0.8;">
		<?php 
			if($admin or $direktor)
			{
				
				if(isset($_POST['ocub']))
				{
					$idk2=$_POST['ideiz2'];
					if(!mysql_query("delete from Klase where ID='".$idk2."'") or !mysql_query("delete from Ucukl where IDklase='".$idk2."'"))
								echo"Greška pri izmjeni: ".die(mysql_error());
							else echo "<center><br><h2>Klasa uspješno izbrisana!</h2></center><br><br><br>";
							$ono=4;
				}
				
				if(isset($_POST['izm']))
						{
							$idk=$_POST['ideiz'];
							if(!mysql_query("delete from Klase where ID='".$idk."'") or !mysql_query("delete from Ucukl where IDklase='".$idk."'"))
								echo"Greška pri izmjeni: ".die(mysql_error());
							
							
							
							
							
							if($_POST['imekl']=="" or $_POST['kome']=='0' or $_POST['predm']=='0')
					{
						echo"<center><br><br><h2>Pogrešana izmjena</h2><br><h3>Pokušajte ponovo</h3></center>";
					}
					else
					{
						$ime=$_POST['imekl'];
						$prof=$_POST['kome'];
						$predm=$_POST['predm'];
						$gg="insert into Klase (ID,Ime,Prof,Pred) values(null,'$ime','$prof','$predm');";
						if(mysql_query($gg)==false)
						{echo "<h3>Došlo je do greške:".die(mysql_error())."</h3>";}
					else{
						echo "<center><br><h2>Uspješana izmjena klase!</h2></center><br><br><br>";
						$hg=mysql_query("select * from Klase order by ID desc");
						$mys=mysql_fetch_array($hg);
						$ide=$mys['ID'];
					}
					
					$sel=mysql_query("select * from Spisak");
					$num=mysql_num_fields($sel);
					while($b=mysql_fetch_array($sel))
					{
						for($i=1;$i<$num;$i++)
						{
							$bnul=$b[0];
							$mfn=mysql_field_name($sel,$i);
							$zapo=$bnul."ukl".$mfn;
							if($_POST[$zapo])
							{
								if(!mysql_query("insert into Ucukl (ID,IDklase,bruc,ruc) values(null,'$ide','$bnul','$mfn')"))
								{
									echo "<h3>Došlo je do greške:".die(mysql_error())."</h3>";
								}
								else{
									echo"<center>Uspješan unos učenika: <b>".$b[$i]."</b></center>";
								}
							}
						}
					}}
					$ono=4;
							
							
						}
				
				
				
				
				
				
				
				if(isset($_POST['jelpost']))
				{
					if($_POST['imekl']=="" or $_POST['kome']=='0' or $_POST['predm']=='0')
					{
						echo"<center><br><br><h2>Pogrešan unos</h2><br><h3>Pokušajte ponovo</h3></center>";
					}
					else
					{
						$ime=$_POST['imekl'];
						$prof=$_POST['kome'];
						$predm=$_POST['predm'];
						$gg="insert into Klase (ID,Ime,Prof,Pred) values(null,'$ime','$prof','$predm');";
						if(mysql_query($gg)==false)
						{echo "<h3>Došlo je do greške:".die(mysql_error())."</h3>";}
					else{
						echo "<center><br><h2>Uspješan unos klase!</h2></center><br><br><br>";
						$hg=mysql_query("select * from Klase order by ID desc");
						$mys=mysql_fetch_array($hg);
						$ide=$mys['ID'];
					}
					
					$sel=mysql_query("select * from Spisak");
					$num=mysql_num_fields($sel);
					while($b=mysql_fetch_array($sel))
					{
						for($i=1;$i<$num;$i++)
						{
							$bnul=$b[0];
							$mfn=mysql_field_name($sel,$i);
							$zapo=$bnul."ukl".$mfn;
							if($_POST[$zapo])
							{
								if(!mysql_query("insert into Ucukl (ID,IDklase,bruc,ruc) values(null,'$ide','$bnul','$mfn')"))
								{
									echo "<h3>Došlo je do greške:".die(mysql_error())."</h3>";
								}
								else{
									echo"<center>Uspješan unos učenika: <b>".$b[$i]."</b></center>";
								}
							}
						}
					}}
					$ono=4;
				}
				if($ono!=4)
					echo"<center><br><a href='http://".$_SERVER['HTTP_HOST']."/klase'><button class='button2'>Nazad na izbornik</button></a></center><br><br>";
					if($ono==1)
					{
						echo"
						<form action='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."' method='post'>
						<table>
						<tr><td>Ime klase:</td><td><input type='text' name='imekl'></td></tr>
						<tr><td>Profesor:</td><td><select name='kome' style='background: none;
border: 1px solid black;
width: 171px;'><option value='0'></option>
		";
		$selec=mysql_query("select * from Profesori where Radi='1'");
		while($stavi=mysql_fetch_array($selec))
		{
				$selekt=mysql_query("select * from Predmeti where RnBr='".$stavi['Predmet']."'");
				$ru=mysql_fetch_array($selekt);
				$predmetak=$ru['Predmet'];
				echo"<option value='".$stavi['RnBr']."'>".$stavi['Ime']." ".$stavi['Prezime']." (".$predmetak.")</option>";
		
		}
		echo"</select></td></tr><tr><td>Predmet:</td><td><select name='predm'><option value='0'></option>";
		$hu=mysql_query("select * from Predmeti");
		while($b=mysql_fetch_array($hu))
		{
			echo"<option value='".$b['RnBr']."'>".$b['Predmet']."</option>";
		}
		echo"</select></td></tr></table>";
		$tr=mysql_query("select * from Spisak");
		echo"<br><br><table style='min-width:800px;'><tr><td><b>Broj</b></td>";
		$l=mysql_num_fields($tr);
		for($i=1;$i<$l;$i++)
			echo"<td><b>".mysql_field_name($tr,$i).". razred</b></td>";
		echo"</tr>";
		while($b=mysql_fetch_array($tr))
		{
			echo"<tr>";
			for($i=0;$i<$l;$i++)
			{
				$ime=$b[$i];
				$du=strlen($ime);echo"<td style='cursor:pointer;'>";
				if($i!=0 and $b[$i]!="")
				{
					echo"<input type='checkbox' name='".$b[0]."ukl".mysql_field_name($tr,$i)."' style='cursor:pointer;' id='".$b[0]."ukl".mysql_field_name($tr,$i)."'><i><label style='cursor:pointer;' for='".$b[0]."ukl".mysql_field_name($tr,$i)."'>";
					for($j=0;$j<$du;$j++)
					{
						//if($ime[$j]==' ')
							//echo"<br>";
						//else 
							echo $ime[$j];
					}
					echo"</label></i>";
				}
				else echo $ime;
				echo"</td>";
			}
			echo"</tr>";
		}
		echo"</table><br><br><br><center><input type='submit' class='button2' name='jelpost' value='Napravi'></center><br><br>";
		
		echo"
						</form>";
					}
					else if($ono==2)
					{
						
						if(isset($_GET['prom']))
						{
							$idzap=$_GET['prom'];
							$y=mysql_fetch_array(mysql_query("select * from Klase where ID='".$idzap."'"));
							
							
							
							
							echo"
						<form action='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."' method='post'><input type='hidden' name='ideiz' value='".$idzap."'>
						<table>
						<tr><td>Ime klase:</td><td><input type='text' name='imekl' value='".$y['Ime']."'></td></tr>
						<tr><td>Profesor:</td><td><select name='kome' style='background: none;
border: 1px solid black;
width: 171px;'><option value='0'></option>
		";
		$selec=mysql_query("select * from Profesori where Radi='1'");
		while($stavi=mysql_fetch_array($selec))
		{
				$selekt=mysql_query("select * from Predmeti where RnBr='".$stavi['Predmet']."'");
				$ru=mysql_fetch_array($selekt);
				$predmetak=$ru['Predmet'];
				if($stavi['RnBr']==$y['Prof'])
					$jelp="selected";
				else $jelp="";
				echo"<option value='".$stavi['RnBr']."' ".$jelp.">".$stavi['Ime']." ".$stavi['Prezime']." (".$predmetak.")</option>";
		
		}
		echo"</select></td></tr><tr><td>Predmet:</td><td><select name='predm'><option value='0'></option>";
		$hu=mysql_query("select * from Predmeti");
		while($b=mysql_fetch_array($hu))
		{
			if($b['RnBr']==$y['Pred'])
					$jelp2="selected";
				else $jelp2="";
			echo"<option value='".$b['RnBr']."' ".$jelp2.">".$b['Predmet']."</option>";
		}
		echo"</select></td></tr></table>";
		$tr=mysql_query("select * from Spisak");
		echo"<br><br><table style='min-width:800px;'><tr><td><b>Broj</b></td>";
		$l=mysql_num_fields($tr);
		for($i=1;$i<$l;$i++)
			echo"<td><b>".mysql_field_name($tr,$i).". razred</b></td>";
		echo"</tr>";
		while($b=mysql_fetch_array($tr))
		{
			echo"<tr>";
			for($i=0;$i<$l;$i++)
			{
				$ime=$b[$i];
				$du=strlen($ime);echo"<td style='cursor:pointer;'>";
				if($i!=0 and $b[$i]!="")
				{
					$qr=mysql_query("select * from Ucukl where IDklase='".$idzap."' and bruc='".$b[0]."' and ruc='".mysql_field_name($tr,$i)."'");
					if(mysql_num_rows($qr))
						$cek="checked";
					else $cek="";
					echo"<input type='checkbox' name='".$b[0]."ukl".mysql_field_name($tr,$i)."' style='cursor:pointer;' id='".$b[0]."ukl".mysql_field_name($tr,$i)."' ".$cek."><i><label style='cursor:pointer;' for='".$b[0]."ukl".mysql_field_name($tr,$i)."'>";
					for($j=0;$j<$du;$j++)
					{
						//if($ime[$j]==' ')
						//	echo"<br>";
						//else
							echo $ime[$j];
					}
					echo"</label></i>";
				}
				else echo $ime;
				echo"</td>";
			}
			echo"</tr>";
		}
		echo"</table><br><br><br><center><input type='submit' class='button2' name='izm' value='Napravi'></center><br><br>";
		
		echo"
						</form>";
							
							
							
							
							
							
							
							
						}
						else
						{
							echo"<center><br><br><table class='tabela'><tr id='prvi_red'><td>ID</td><td>Ime</td><td>Profesor</td><td>Predmet</td></tr>";
						$mysq=mysql_query("select * from Klase order by ID asc");
						while($b=mysql_fetch_array($mysq))
						{
							echo"<tr onclick='document.location=&#39;http://".$_SERVER['HTTP_HOST']."/klase/izmjena/".$b[0]."&#39;' style='cursor:pointer;'><td id='prva_cell'>".$b[0]."</td><td>".$b[1]."</td><td>";
							$m=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$b[2]."'"));
							echo $m['Ime']." ".$m['Prezime'];
							echo"</td><td>";
							$m2=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b[3]."'"));
							echo $m2['Predmet'];
							echo"</td></tr>";
						}
						echo"</table></center>";
						}
					}
					else if($ono==3)
					{
						if(isset($_GET['brisemo']))
						{
							$idb=$_GET['brisemo'];
							$n=mysql_fetch_array(mysql_query("select * from Klase where ID='".$idb."'"));
							echo"<form action='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."' method='post'>
							<input type='hidden' name='ideiz2' value='".$idb."'>
							<center style='font-size:16pt;'><br>Jeste li sigurni da želite izbrisati <b><i>".$n['Ime']."</i></b> klasu</center>
							<br><br><center><input type='submit' class='button2' name='ocub' value='Briši!' style='display:inline;'><a href='http://".$_SERVER['HTTP_HOST']."/klase/brisi'><button class='button2' style='margin-left:20px;display:inline;'>Ipak ne</button></a></center></form>";
						}
						else
						{
							echo"<center><br><br><table class='tabela'><tr id='prvi_red'><td>ID</td><td>Ime</td><td>Profesor</td><td>Predmet</td></tr>";
						$mysq=mysql_query("select * from Klase order by ID asc");
						while($b=mysql_fetch_array($mysq))
						{
							echo"<tr onclick='document.location=&#39;http://".$_SERVER['HTTP_HOST']."/klase/brisi/".$b[0]."&#39;' style='cursor:pointer;'><td id='prva_cell'>".$b[0]."</td><td>".$b[1]."</td><td>";
							$m=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$b[2]."'"));
							echo $m['Ime']." ".$m['Prezime'];
							echo"</td><td>";
							$m2=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b[3]."'"));
							echo $m2['Predmet'];
							echo"</td></tr>";
						}
						echo"</table></center>";
						}
					}
					else 
					{
						echo"<center><br><br>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/nova'><button class='button2' style='display:inline;'>Nova klasa</button></a>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/izmjena'><button class='button2' style='display:inline;'>Izmijeni klasu</button></a>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/brisi'><button class='button2' style='display:inline;'>Izbriši klasu</button></a>
			</center>";
					}
			}
			else echo "<center><h1>Niste Admin</h1><h2>Ako mislite da je ovo greška, prijavite se na prethodnoj stranici</h2></center>";
		?><br><br><br></div></center>
	</body>
</html>