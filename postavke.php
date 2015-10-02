<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Postavke profila - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
		<?php include('funkcijednevnik.php'); ?>
	</head>
<body>
	<?php
		include("includ.php");
		include("admin.php");
	if(isset($_SESSION['user']))
	{
		if($_SESSION['prof']==false){
				$gdjeje="users";$staje="UserID";}
				else {$gdjeje="Profesori";$staje="RnBr";}
			 	$gdje=mysql_query("select * from ".$gdjeje." where Username ='". $_SESSION['user']."'");
				$red=mysql_fetch_array($gdje);
		
		if($_POST['url']!="")
		{
		// AVATAAAR
			
				$toje=$red[$staje];
				$url=$_POST['url'];
				
				//$sql=mysql_query("update `eDnevnik'".$gdjeje."' set 'Img' = '".$url."' where '".$gdjeje."'.'".$staje."' =".$toje." limit 1");
				$sql=mysql_query("UPDATE  `".$gdjeje."` SET  `Img` =  '".$url."' WHERE  `".$gdjeje."`.`".$staje."` =".$toje." LIMIT 1");
				if(!$sql)
					$rrt=$rrt. mysql_error();
				else{
					$rrt=$rrt."<center><h2>Avatar promijenjen</h2></center>";
			 }
		//AVATAAAAR
		}
		if($_POST['ns']!="")
		{
		//ZA MIJENJANJE SIFREEE //
		$sadpw=md5($_POST['ss']);
		$ns=$_POST['ns'];
		$asd=md5($ns);
		$ons=$_POST['ons'];
		$sklj=$_SESSION['user'];
		if($_SESSION['prof']==true)
		$gdje="Profesori";
		else $gdje="users";
		$q=mysql_query("select * from ".$gdje." where Username = '".$_SESSION['user']."'");
		$fec=mysql_fetch_array($q);
		if($ns==$ons)
		{
			if($_SESSION['ad'])
		mysql_query("UPDATE  `$gdje` SET  `Pass` = MD5(  '$ons' ) WHERE  `$gdje`.`Username` ='$sklj' LIMIT 1;");
	else if($fec['Pass']==$sadpw)
		mysql_query("UPDATE  `$gdje` SET  `Pass` = MD5(  '$ons' ) WHERE  `$gdje`.`Username` ='$sklj' LIMIT 1;");
		//if(!$a)
		//die(mysql_error());
		//else $rrt=$rrt."<center><p><h2>Šifra promijenjena</h2></p></center>";
		}
		//else $rrt=$rrt."<center><p><h2>Netačni podaci</h2></p></center>";
		//ZA MIJENJANJE SIFREEE //
		}
		if(isset($_POST['jeeeah'])){
		$a1=$_POST['ime'];
		$a2=$_POST['prezime'];
		$a3=$_POST['imeo'];
		$a4=$_POST['adresa'];
		$a5=$_POST['mjesto'];
		$a6=$_POST['dat'];
		$a7=$_POST['mjes'];
		$a8=$_POST['godi'];
		$a9=$_POST['mjestor'];
		$a10=$_POST['tel'];
		
		
		$sssq="UPDATE  `users` SET  `Ime` =  '$a1',
`Prezime` =  '$a2',
`Ime_oca` =  '$a3',
`Adresa` =  '$a4',
`Mjesto` =  '$a5',
`Datumr` =  '$a6',
`Mjesecr` =  '$a7',
`Godinar` =  '$a8',
`Mjestor` =  '$a9',
`Brojmob` =  '$a10' WHERE  Username = '".$_SESSION['user']."';";
		if(!mysql_query($sssq))
		die(mysql_error()); else ?><script>location.replace("postavke");</script>
		<?php;
		}
		//STD
		echo $rrt;
		
		echo"
		<div id='navpostavke_drzac' style='cursor:pointer;'>
			<ul id='navigacijapostavke'>
				<li><a onClick='PrikaziPromjenuAvatara()'>PROMJENA AVATARA</a></li>
				<li><a onClick='PrikaziPromjenuPassworda()'>PROMJENA ŠIFRE</a></li>
			</ul>";if($_SESSION['ad'] and !$_SESSION['prof'])
			echo"
				<ul class='zadnjiunavpostavke'>
					<li><a onClick='PrikaziPromjenuPodataka()'>PROMJENA PODATAKA</a></li>
				</ul>";echo"
		</div>
		";
		
		echo"<br>
		<div id='drzac_promjenaavatara'>
		<center><form action='".$_SERVER['PHP_SELF']."' method='post'><input type='text' style='display:none'>
<input type='password' style='display:none'>
		Url avatara: <input type='text' autocomplete='off' name='url' maxlength='900' style='width:450px;'><br><br>
		<input class='button' type='submit' value='Promijeni'><br><br></div></center>
		<div id='drzac_sifre'>
		<center><table>";if(!$_SESSION['ad']) echo"
				<tr><td>Stara šifra:</td><td><input type='password' name='ss' size='14'/></td></tr>";echo"
				<tr><td>Nova šifra:</td><td><input type='password' name='ns' size='14'/></td></tr>
				<tr><td>Nova šifra:</td><td><input type='password' name='ons' size='14'/></td></tr>
				
				<tr><td></td><td align='right'><input class='button' id='ide' type='submit' value='Promijeni'/></td></tr>
			</table><input type='hidden' name='jeeeah' value=':S'></div></center>";
			//$sikl=mysql_query("select * from users where Razred='".$red['Razred']."' and Broj='".$red['BrDn']."'")
			//
			$dt=$red['Datumr'];
			$dt2=$red['Mjesecr'];
			$dt3=$red['Godinar'];
			if($_SESSION['ad'] and !$_SESSION['prof'])
			{
			echo"
			<div id='drzac_podataka'>
				<center><table>
				<tr><td>Ime:</td><td><input type='text' name='ime' value='".$red['Ime']."'></td></tr>
				<tr><td>Prezime:</td><td><input type='text' name='prezime' value='".$red['Prezime']."'></td></tr>
				<tr><td>Ime oca:</td><td><input type='text' name='imeo' value='".$red['Ime_oca']."'></td></tr>
				<tr><td>Adresa:</td><td><input type='text' name='adresa' value='".$red['Adresa']."'></td></tr>
				<tr><td>Mjesto:</td><td><input type='text' name='mjesto' value='".$red['Mjesto']."'></td></tr>
				<tr><td>Datum rođenja:</td><td>
				
				<select name='dat'>";
				for($i=1;$i<32;$i=$i+1){
				if($i==$dt) $sss="selected"; else $sss="";
				echo "<option value='".$i."' ".$sss.">".$i."</option>";
				}
				echo"</select>
				
				<select name='mjes'>";
				for($i=1;$i<13;$i=$i+1){
				if($i==$dt2) $sss="selected"; else $sss="";
				echo "<option value='".$i."' ".$sss.">".$i."</option>";
				}
				echo"</select>
				
				<select name='godi'>";
				for($i=1996;$i<2002;$i=$i+1){
				if($i==$dt3) $sss="selected"; else $sss="";
				echo "<option value='".$i."' ".$sss.">".$i."</option>";
				}
				echo"</select>
				
				</td></tr>
				
				<tr><td>Mjesto rođenja:</td><td><input type='text' name='mjestor' value='".$red['Mjestor']."'></td></tr>
				<tr><td>Telefon:</td><td><input type='text' name='tel' value='".$red['Brojmob']."'></td></tr></table>
				<input class='button' type='submit' value='Promijeni'>
		</form></center></div>";}
		
		///STD
	}
	else echo "<center><h2>Moras biti logovan</h2></center>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>