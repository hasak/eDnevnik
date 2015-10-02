<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Direktor panel - eDnevnik</title>
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("admin.php");
			if($direktor==false && $admin==false)
				echo "<center><h1>Niste uprava !!</h1></center>";
			else 
			{
					if(isset($_GET['dane']) and isset($_GET['id']))
					{
							$d=$_GET['dane'];
							$id=$_GET['id'];
							if(1)
							{
									if($d==1)
									$sq="update users set Akt=1 where UserID=".$id;
									else $sq="delete from users where UserID=".$id;
									if(!mysql_query($sq))
									die(mysql_error());
									else
									{
										
										$jh=mysql_query("select * from users where Akt=0");
										$ima=mysql_num_rows($jh);
										if($ima!=0)
										{echo"<center><table class='tabela'>
			<tr id='prvi_red'><td>ID</td><td>Username</td>
			<td>Ime i Prezime</td><td>Raz</td><td>Broj</td><td>Smjer</td><td>Nj-Fr</td>
			
			<td>✓ x</td></tr>";
											while($rcd=mysql_fetch_array($jh))
											{
													//if($rcd['Etika']==1)
			$mnmn=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$rcd['Smjer']."'"));
			$vjet=$mnmn['Ime'];
			//else $vjet="Vjer";
			if($rcd['Fran']==1)
			$frnj="Fra";
			else $frnj="Nje";
			if($rcd['Admin']==1)
			$ad="Da";
			else $ad="";
			echo "<tr>
			<td id='prva_cell'>".$rcd['UserID']."</td>
			<td>".$rcd['Username']."</td>
			<td>";
			$turi=mysql_fetch_array(mysql_query("select * from Spisak where Broj='".$rcd['BrDn']."'"));
			echo $turi[$rcd['Razred']]."</td>
			<td>".$rcd['Razred']."</td>
			<td>".$rcd['BrDn']."</td>
			<td>".$vjet."</td>
			<td>".$frnj."</td>
			<td id='trfl'><span onclick='ajaxx(1,".$rcd['UserID'].")'>✓</span>&nbsp;<span onclick='ajaxx(0,".$rcd['UserID'].")'>x</span></td></tr>";
											}
											echo"</table></center>";
										}
										else echo"<center><i style='font-size:19;'>Svi registrovani učenici su aktivirani</i></center>";
									}
							}
							
					}
					
					if(isset($_GET['svi']) and $_GET['svi']=="tru")
					{
							
							$red=mysql_query("select * from users");
							echo"<form action='ucenik' method='post'><table class='tabela'>
			<tr id='prvi_red'><td>ID</td><td>Username</td>
			<td>Ime i Prezime</td><td>Raz</td><td>Broj</td><td>Smjer</td><td>Nj-Fr</td>
			"; if($admin==true)
			echo"
			<td>Admin</td>"; echo "</tr>";
			////echo"<form action='ucbris.php' method='post'>";
			while($rcd=mysql_fetch_array($red)){
			//if($rcd['Etika']==1)
			$mnmn=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$rcd['Smjer']."'"));
			$vjet=$mnmn['Ime'];
			//else $vjet="Vjer";
			if($rcd['Fran']==1)
			$frnj="Fra";
			else $frnj="Nje";
			if($rcd['Admin']==1)
			$ad="Da";
			else $ad="";
			echo "<tr>
			<td id='prva_cell'><label for='ucenick".$rcd['UserID']."'>".$rcd['UserID']."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$rcd['Username']."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$rcd['Ime']." ".$rcd['Prezime']."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$rcd['Razred']."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$rcd['BrDn']."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$vjet."</label></td>
			<td><label for='ucenick".$rcd['UserID']."'>".$frnj."</label></td>
";if($admin==true) echo"
			<td><label for='ucenick".$rcd['UserID']."'>".$ad."</label></td>";
/*			echo "
			<td align='center'>
			<input class='button2' type='submit' name='".$rcd['UserID']."' value='X'/></td>";*/
			echo"</tr><button type='submit' name='uceni' value='".$rcd['UserID']."' id='ucenick".$rcd['UserID']."' 
			style='position:absolute; left:-9999px;'>aa</button>";
			
			
			}
		
			echo "</table><input type='hidden' name='rzz' value='".$_POST['nekipost']."'></form>";
					}
			}
		?>
	</body>
</html>