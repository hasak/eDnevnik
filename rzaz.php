<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Test - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
		<style>
		#onamt{
		font-family:gothic;
		border-collapse:collapse;
		font-color:#2e2e2e;
		font-size:14pt;
		width:600px;
		text-align:center;
		}
		#onamt td{
		padding:5px 5px 5px 5px;
		}
		#prvir td{
		background-color:#052f61;
		color:white;
		font-weight:bold;
		}
		#npr{
		background-color:#e7e7e7;
		}
		#pr{
		background-color:#fff;
		}
		#prvac{
		font-weight:bold;
		font-color:#000;
		}
		</style>
	</head>
	<body>
		<?php include("includ.php");?>
				<?php
				if(isset($_POST['trigerjoj']))
				{
					$var=true;
					$q=mysql_query("select * from Spisak");
					$kol=mysql_num_rows($q);
					$akol=mysql_num_fields($q);
					for($i=1;$i<=$kol;$i++)
					{
						for($j=1;$j<$akol;$j++)
						{
							$onojedno="imm".$i.$j;
							$post=$_POST[$onojedno];
							$dod="update Spisak set `".mysql_field_name($q,$j)."`='$post' where Broj='".$i."'";
							if(!mysql_query($dod))
							{
								
								die(mysql_error());
								$var=false;
							}
						}
					}					
					if($var==true)
					echo"<br><br><h1>Usjepšno dodani</h1>";
				else
					echo"<br><br><h1>Desila se greška</h1><br><h2>Neki možda nisu dodani</h2><br>";
				}
				
				
				
				//////////////////////////
				$q=mysql_query("select * from Spisak");
				echo"<br><form action='' method='post'><table class='tabela'><tr id='prvi_red'><td>Broj</td>";
				$nu=mysql_num_fields($q);
				for($i=1;$i<$nu;$i++)
				{
					echo"<td>".mysql_field_name($q,$i).". Razred</td>";
				}
				
				echo"</tr>";
				while($b=mysql_fetch_array($q))
				{
					echo"<tr><td id='prva_cell'>".$b[0]."</td>";
					for($i=1;$i<$nu;$i++)
						echo"<td><input style='width:115px;' type='text' name='imm".$b[0].$i."' value='".$b[$i]."'></td>";
					echo"</tr>";
				}
				echo "</table><br><br><center><input type='submit' class='button' name='trigerjoj' value='Izmijeni!'></center></form><br>";
				?>

		<?php include("ftincld.php");?>
	</body>
</html>