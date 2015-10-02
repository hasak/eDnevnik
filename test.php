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
				if(isset($_POST['trig23']))
				{
					$var=true;
					for($i=0;$i<20;$i++)
					{
						$grt="predm".$i;
						$impr=$_POST[$grt];
						if($impr!="")
						{
							if(mysql_num_rows(mysql_query("select * from Predmeti where Predmet='".$impr."'")))
							echo "<br><br><h2>Predmet ".$impr." već postoji u bazi</h2>";
						else
						{
							$dod="insert into Predmeti (RnBr,Predmet) values(null,'$impr')";
							if(!mysql_query($dod))
								$var=false;
						}
						}
					}
					if($var==true)
					echo"<br><br><h1>Predmeti usjepšno dodani</h1>";
				else
					echo"<br><br><h1>Desila se greška</h1><br><h2>Neki predmeti možda nisu dodani</h2><br>";
				}
				
				
				
				//////////////////////////
				$q=mysql_query("select * from Predmeti");
				echo"<br><table class='tabela'><tr id='prvi_red'><td>ID</td><td>Ime</td></tr>";
				while($b=mysql_fetch_array($q))
				{
					echo"<tr><td id='prva_cell'>".$b[0]."</td><td>".$b[1]."</td></tr>";
				}
				echo "</table><br><br><br>
				<form action='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."' method='post'>";
				for($i=0;$i<20;$i++)
					echo"<input type='text' name='predm".$i."'><br><br>";
				echo"<br><br><input type='submit' name='trig23' class='button' value='Dodaj'><br></form>";
				?>

		<?php include("ftincld.php");?>
	</body>
</html>