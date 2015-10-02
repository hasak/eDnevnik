<?php ob_start(); session_start();
include('../db.php');?>
<html>
	<head>
		<title>Statistika zaključenih ocjena - eDnevnik</title>
		<style>
		@font-face {
		font-family: gothic;
		src: url(../gothic.woff);
		}
		
		body{
		font-family:gothic;
		}
		
		th.rotate {
		transform:rotate(270deg);
		white-space: nowrap;
		width:20px;
		height:195;
		font-weight:normal;
		}
		
		th.rotate div{
		margin-left: -85px;
		width:20px;
		}
		
		table{
		width:900px;
		text-align:center;
		}
		</style>
	</head>
	<body>
		<?php 
			if($_SESSION['prof'])
			{
					$q=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
					$u=mysql_fetch_array($q);
					$id=$u['RnBr'];
					$id_pred=$u['Predmet'];
					$razdn=$u['Razrednik'];
					if($razdn=='0')
					echo"<center><h1>Niste razrednik</h1></center>";
					else
					{
					//if($_GET['sta']==1)
					{
							echo"<table border='1' style='border-collapse:collapse;text-align:center;vertical-align:centered;'><tr>
							<th class='rotate'><div>Redni broj u dnevniku</div></th><th>Prezime i ime učenika</th>";
							$e=mysql_query("select * from PredPoRazz");
							while($b=mysql_fetch_array($e))
							{
									if($b[$razdn]==1)
									{
											$idpr=$b['Predmet'];
											$im=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$idpr."'"));
											$imp=$im['Predmet'];
											echo "<th class='rotate'><div><i>".$imp."</i></div></th>";
											//$c++;
									}
							}
							echo"<th class='rotate' style='border-left-width:2px;'><div><b>VLADANJE</b></div></th>
							<th class='rotate'><div>Opravdanih</div></th>
							<th class='rotate'><div>Neopravdanih</div></th>
							<th class='rotate'><div>Ukupno</div></th>
							<th class='rotate' style='border-left-width:2px;'><div>Broj nedovoljnih ocjena</div></th>
							<th class='rotate'><div style='margin-left:-69px;'>Prosjek</div></th>
							<th class='rotate'><div>Uspjeh</div></th>
							<th class='rotate' style='width:120px;'><div style='margin-left:-25px;'><b>OPŠTI USPJEH</b></div></th></tr>";
							$r=mysql_query("select * from Spisak");
							while($y=mysql_fetch_array($r))
							{
									$c=0;
									$pros=0;
									$ned=0;
									$imeu=$y[$razdn];
									if($imeu!="")
									{
											echo"<tr>";
											echo"<td>".$y['Broj']."</td><td><i>".$imeu."</i></td>";
											
											$er=mysql_query("select * from PredPoRazz");
											while($b=mysql_fetch_array($er))
											{
													if($b[$razdn]==1)
													{
															$idpr=$b['Predmet'];
															$rzoc=mysql_fetch_array(mysql_query("select * from Izmjene where Zakljucna='0' and Brojuc='".$y['Broj']."' and Razred='".$razdn."' and Predmet='".$idpr."'"));
															$proc=$rzoc['Ocjena'];
															echo "<td>".$proc."</td>";
															if($proc==1)
															$ned++;
															if($proc!="")
															{
																	$pros+=$proc;
																	$c++;
															}
													}
											}
											$vlad=5;
											$gf=mysql_query("select * from Vladanja where BrUc='".$y['Broj']."' and Razz='".$razdn."' order by ID desc");
											if(mysql_num_rows($gf)!=0)
											{
													$gt=mysql_fetch_array($gf);
													$vlad=$gt['Ocjena'];
											}
											$nizzv[$vlad]++;
											echo"<td style='border-left-width:2px;'>".$vlad."</td>";
											echo"<td></td><td></td><td></td>";
											if($c!=0)
											{
													$prosk=$pros/$c;
											}
											else $prosk=0;
											if($ned!=0)
											{
													$prosk=1;
											}
											$statned[$ned]++;
											if($prosk-floor($prosk/1)<0.5)
											$npknz=floor($prosk/1);
											else $npknz=floor($prosk/1)+1;
											
											$jjnzu[$npknz]++;
											if($npknz==5)
											$opci="Odličan";
											else if($npknz==4)
											$opci="Vrlo dobar";
											else if($npknz==3)
											$opci="Dobar";
											else if($npknz==2)
											$opci="Dovoljan";
											else if($npknz==1)
											$opci="Nedovoljan";
											else $opci="Neocjenjen";
											$st[$npknz]++;
											echo"<td style='border-left-width:2px;'>".$ned."</td><td>".number_format($prosk,2)."</td><td><b>".$npknz."</b></td><td>".$opci."</td>";
											echo"</tr>";
									}
							}echo"</table>";
					}
					//else if($_GET['sta']==2)
					echo "<br><br>";
					{
							$br=$st[5]+$st[4]+$st[3]+$st[2]+$st[1]+$st[0];
							for($i=1;$i<6;$i++)
							{$pross[$i]=100*$st[$i]/$br;}
							$ukuppo=$st[5]+$st[4]+$st[3]+$st[2];
							$postuk=100*$ukuppo/$br;
							//echo $st[$i]." ".$pross[$i]." ".$i."<br>";
							for($i=1;$i<16;$i++)
							$bv+=$statned[$i];
							$bv=$bv-$statned[1]-$statned[2];
							$poro=($jjnzu[5]*5+$jjnzu[4]*4+$jjnzu[3]*3+$jjnzu[2]*2+$jjnzu[1])/($br-$jjnzu[0]);
							echo"<table border='1' style='border-collapse:collapse;'><tr><th colspan='3'>Opšti uspjeh učenika</th></tr>
							<tr><td>Opšti uspjeh učenika</td><td>Broj</td><td>Postotak</td></tr>
							<tr><td>Svega učenika</td><td>".$br."</td><td></td></tr>
							<tr><td style='border-top-width:2px;'>Odličnih</td><td style='border-top-width:2px;'>".$st[5]."</td><td style='border-top-width:2px;'>".number_format($pross[5],2)."%</td></tr>
							<tr><td>Vrlodobrih</td><td>".$st[4]."</td><td>".number_format($pross[4],2)."%</td></tr>
							<tr><td>Dobrih</td><td>".$st[3]."</td><td>".number_format($pross[3],2)."%</td></tr>
							<tr><td>Dovoljnih</td><td>".$st[2]."</td><td>".number_format($pross[2],2)."%</td></tr>
							<tr><td style='border-top-width:2px;'><b>Svega učenika sa pozitivnom ocjenom</b></td><td style='border-top-width:2px;'><b>".$ukuppo."</b></td><td style='border-top-width:2px;'><b>".number_format($postuk,2)."%</b></td></tr>
							<tr><td style='border-top-width:2px;'>Sa jednom nedovoljnom</td><td style='border-top-width:2px;'>".$statned[1]."</td><td style='border-top-width:2px;'>".number_format(100*$statned[1]/$br,2)."%</td></tr>
							<tr><td>Sa dvije nedovoljne</td><td>".$statned[2]."</td><td>".number_format(100*$statned[2]/$br,2)."%</td></tr>
							<tr><td>Sa tri i više nedovoljnih</td><td>".$bv."</td><td>".number_format(100*$bv/$br,2)."%</td></tr>
							<tr><td>Svega učenika sa negativnom</td><td>".$st[1]."</td><td>".number_format(100*$st[1]/$br,2)."%</td></tr>
							<tr><td style='border-top-width:2px;'>Broj neocjenjenih učenika</td><td style='border-top-width:2px;'>".$st[0]."</td><td style='border-top-width:2px;'>".number_format(100*$st[0]/$br,2)."%</td></tr>
							<tr><td style='border-top-width:2px;'><b>Svega</b></td><td style='border-top-width:2px;'><b>".$br."</b></td><td style='border-top-width:2px;'><b>100.00%</b></td></tr></table><br><br>
							<table border='1' style='border-collapse:collapse;'>
							<tr><td>Izostanci učenika</td><td>Broj</td><td>Po učeniku</td></tr>
							<tr><td style='border-top-width:2px;'>Opravdanih</td><td style='border-top-width:2px;'></td><td style='border-top-width:2px;'></td></tr>
							<tr><td>Neopravdanih</td><td></td><td></td></tr>
							<tr><td>Ukupno</td><td></td><td></td></tr></table>
							<br><br>
							<table border='1' style='border-collapse:collapse;'>
							<tr><td><b>Prosječna ocjena odjeljenja</b></td><td><b>".number_format($poro,2)."</b></td></tr>
							</table><br><br>";$anjt=$nizzv[4]+$nizzv[3]+$nizzv[2]+$nizzv[1];echo"
							<table border='1' style='border-collapse:collapse;'>
							<tr><th colspan='3'>Pohvale i kaznene mjere</th></tr>
							<tr><td>Vladanje učenika</td><td>Broj</td><td>Kaznene mjere</td></tr>
							<tr><td style='border-top-width:2px;'>Primjerno</td><td style='border-top-width:2px;'>".$nizzv[5]."</td><td style='border-top-width:2px;'></td></tr>
							<tr><td>Vrlodobro</td><td>".$nizzv[4]."</td><td>Ukor razrednika</td></tr>
							<tr><td>Dobro</td><td>".$nizzv[3]."</td><td>Ukor odjeljenskog vijeća</td></tr>
							<tr><td>Zadovoljavajuće</td><td>".$nizzv[2]."</td><td>Ukor direktora</td></tr>
							<tr><td>Loše</td><td>".$nizzv[1]."</td><td>Ukor nastavničkog vijeća</td></tr>
							<tr><td style='border-top-width:2px;'></td><td style='border-top-width:2px;'>".$anjt."</td><td style='border-top-width:2px;'>Ukupno izrečenih kaznenih mjera</td></tr>
							</table><br><br><table border='1' style='border-collapse:collapse;'><tr><th>Predmet</th>";
							$e=mysql_query("select * from PredPoRazz");
							while($b=mysql_fetch_array($e))
							{
									if($b[$razdn]==1)
									{
											$idpr=$b['Predmet'];
											$im=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$idpr."'"));
											$imp=$im['Predmet'];
											echo "<th class='rotate'><div><i>".$imp."</i></div></th>";
											//$c++;
									}
							}
							echo"</tr></table>";
							//<tr><td></td><td></td><td></td></tr>
					}
					}
			}
			else echo "<center><h1>Nisi profesor</h1><h2>Ako mislite da je ovo greška, prijavite se na prethodnoj stranici</h2></center>";
		?>
	</body>
</html>