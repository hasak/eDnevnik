<?php ob_start(); session_start();
include('../db.php');?>
<html>
	<head>
		<title>Šablon frekvencije - eDnevnik</title>
		<style>
		@font-face {
    font-family: gothic;
    src: url(../gothic.woff);
}
		body{
		font-family:gothic;
		}
		th.rotate {
  /* Something you can count on */
  height: 80px;
  white-space: nowrap;
}

th.rotate > div {
  transform: 
    /* Magic Numbers */
    /* 45 is really 360 - 45 */
    rotate(270deg);
  width: 20px;
  margin-top:50px;
}
th.rotate > div > span {
  
}
		</style>
	</head>
	<body>
		<?php 
			if($_SESSION['prof'])
			{
					if(isset($_GET['razz']) and ($_GET['pon']==1 or $_GET['uto']==1 or $_GET['sri']==1 or $_GET['cet']==1 or $_GET['pet']==1))
					{
							$q=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
							$r=mysql_fetch_array($q);
							$idp=$r['RnBr'];
							//$pred=$r['Predmet'];
							$pred=$_GET['pred'];///////////////////////////////////////
							
							$raz=$_GET['razz'];
							$cas=$_GET['cas'];
							
							$poc=$_GET['poc'];
							$brk=$_GET['brk'];
							$vel=$_GET['vel'];
							$prvel=$vel*20;
							$dos=$_GET['dos'];////////////////////////////////////////////
							/*if(isset($_GET['pon']) and $_GET['pon']==1)
							$niz[1]=1;else $niz[1]=0;
							if(isset($_GET['uto']) and $_GET['uto']==1)
							$niz[2]=1;else $niz[2]=0;
							if(isset($_GET['sri']) and $_GET['sri']==1)
							$niz[3]=1;else $niz[3]=0;
							if(isset($_GET['cet']) and $_GET['cet']==1)
							$niz[4]=1;else $niz[4]=0;
							if(isset($_GET['pet']) and $_GET['pet']==1)
							$niz[5]=1;else $niz[5]=0;*/
							$niz[1]=$_GET['pon'];
							$niz[2]=$_GET['uto'];
							$niz[3]=$_GET['sri'];
							$niz[4]=$_GET['cet'];
							$niz[5]=$_GET['pet'];
							//echo $niz[1].$niz[2].$niz[3].$niz[4].$niz[5];
							$c=0;
							$cp=0;
							echo"<table style='border-collapse:collapse;' border='1'><tr><th class='rotate'><div><span>Broj</span></div></th><th>Učenik</th>";
							while($c<$brk)
							{
									$brs=date("N",$poc);
									if($niz[$brs]==1)
									{
										if($cas>99)
										{
												$sty="style='vertical-align:bottom;padding-bottom:5px;height:90px;'";
										}
										else $sty="";
										echo"<th class='rotate' ".$sty."><div><span>".date("d.m",$poc)." - ".$cas."</span></div></th>";
										$cas=$cas+1;$drn[$c]=$poc;
										$c=$c+1;
										
									}
									$poc=$poc+86400;
							}
							//echo"</tr>";
							//echo"<tr><td>Opet nesto</td>";
							//$c=0;
							//while($c<40)
							//{
							//		echo"<td>".date("d.m",$poc)."</td>";
							//		$poc=$poc+86400;
							//		$c=$c+1;
							//}
							echo"</tr>";
							$q=mysql_query("select * from Spisak");
							while($b=mysql_fetch_array($q))
							{
									if($b[$raz]!="")
									{
											$ime=$b[$raz];
											echo"<tr><td style='text-align:center; font-size:11pt; height:".$prvel."px;'><b>".$b['Broj']."</b></td><td style='text-align:center; font-size:11pt; height:".$prvel."px;white-space: nowrap;'><i>";
											for($i=0;$i<strlen($ime);$i++)
											if($ime[$i]==" " and $vel>1)
											echo"<br>";
											else echo $ime[$i];
											echo"</i></td>";
											for($i=0;$i<$brk;$i=$i+1)
											{
													//$drn[$i];
													//mktime(hour,minute,second,month,day,year,is_dst);
													//n=1-12
													//j=1-31
													//$idp
													if($dos==1)
													{
													$p=mktime(0,0,0,date("n",$drn[$i]),date("j",$drn[$i]),date("Y",$drn[$i]));
													$k=mktime(23,59,59,date("n",$drn[$i]),date("j",$drn[$i]),date("Y",$drn[$i]));
													$zm=mysql_query("select * from Izmjene where Prof='".$idp."' and Razred='".$raz."' and Predmet='".$pred."' and Datum>'".$p."' and Datum<'".$k."' and Brojuc='".$b['Broj']."'");
													if(mysql_num_rows($zm)!=0)
													{
													$mz=mysql_fetch_array($zm);
													//if($mz['Zakljucna']==1)
													//$ucell="<b>".$mz['Ocjena']."</b>";
													//else 
													$ucell=$mz['Ocjena'];
													}else $ucell="";}
													else $ucell="";
													echo"<td style='height:".$prvel."px; vertical-align:top; text-align: center;'><b>".$ucell."</b></td>";
											}
											echo"</tr>";
									}
							}
							$cls=$brk+2;
							echo"<tr><td colspan='".$cls."' style='border:none; text-align:right; font-weight:bold;'>Copyright ".date("Y")." © eDnevnik</td></tr></table>";
					}
					else echo "<center>Greška!</center>";
			}
			else echo "<center><h1>Nisi profesor</h1><h2>Ako mislite da je ovo greška, prijavite se na prethodnoj stranici</h2></center>";
		?>
	</body>
</html>