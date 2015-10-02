<div id="stranica">
			<div id="drzac_logo_i_navigacija">
				<div id="logo"><img src="logo.png"></div>
				<div id="navigacijaa">
				<ul id="nav">

				<li><a href="default.php">NASLOVNA</a></li>
				<li><a href="dnevnik.php">DNEVNIK</a></li>
				<?php
				if(isset($_SESSION['user']))
				{
				if($_SESSION['prof']==true){
				$gdje123=mysql_query("select * from Profesori where username ='". $_SESSION['user']."'");
					$red1233=mysql_fetch_array($gdje123);
				echo "
				<li><a href='upload.php'>UPLOAD</a></li>
				<li><a href='statistika.php'>STATISTIKA</a></li>";}
				else echo "<li><a href='/upload'>DOWNLOAD</a></li>
				<li><a href='ucenici.php'>UČENICI</a></li>";}
				else echo "<li><a href='dnevnik.php'>DOWNLOAD</a></li>
				<li><a href='ucenici.php'>UČENICI</a></li>";?>
				
				<li><a href="onama.php">O NAMA</a></li>
				<?php
					include('admin.php');
					if(isset($_SESSION['user']) && $admin==true)
					echo"<li><a href='ap.php'>ADMIN PANEL</a></li>";
					if(isset($_SESSION['user']) && $direktor==true) 
					echo"<li><a href='ap.php'>DIREKTOR PANEL</a></li>";
					//echo $red1233['Razrednik'].$red1233['Razrednik'].$red1233['Razrednik'];
					if(isset($_SESSION['user']) && $red1233['Razrednik']!=0) 
					echo"<li><a href='razrednik.php'>RAZREDNIK ".$red1233['Razrednik']."</a></li>";
					?>
				
			</ul>

</div>
			</div>
	<div id="sve">
	<div id="sidebar">

	<?php
	mysql_set_charset('utf8');
	date_default_timezone_set('Europe/Sarajevo');
	if(isset($_SESSION['user']))
	{
		$jel_profa=$_SESSION['prof'];
		if($jel_profa==true)
		$jelpr="Profesori";
		else $jelpr="users";
		$boolean=false;
		$poruk=mysql_query("select * from Poruke where Zakoga='".$_SESSION['user']."' and Procitana='0'");
		if(mysql_num_rows($poruk)!=0)
		$boolean=true;
		$gdje=mysql_query("select * from ".$jelpr." where username ='". $_SESSION['user']."'");
		$red=mysql_fetch_array($gdje);
	
		if($jel_profa==false)
		{
		//$red332=mysql_fetch_array(mysql_query("select * from Ucenici where Broj ='".$red['BrDn']."' and Razred = '".$red['Razred']."'"));
		$gth=mysql_query("select * from Vladanja where BrUc='".$red['BrDn']."' and Razz='".$red['Razred']."' order by ID desc");
		if(mysql_num_rows($gth)!=0)
		{
				$zzt=mysql_fetch_array($gth);
				$kojev=$zzt['Ocjena'];
		}else $kojev=5;
		
		if($kojev=='5')
		$vlad="Primjerno";
		if($kojev=='4')
		$vlad="Vrlodobro";
		if($kojev=='3')
		$vlad="Dobro";
		if($kojev=='2')
		$vlad="Zadovoljavajuće";
		if($kojev=='1')
		$vlad="Nezadovoljavajuće";}
		if($jel_profa==true){
		$za_fec=mysql_query("select * from Predmeti where RnBr='".$red['Predmet']."'");
		$fecovano=mysql_fetch_array($za_fec);
	
		$sacira=$fecovano['Predmet'];}
		$avatar=$red['Img'];
		
		if($boolean==false)
		$divid="poruke"; else $divid="porukeprocitano";
		echo "
	<div id='drzac_buttona'>
		<a href='default.php'><div id='homebutton'></div></a>
					
					<a href='ucenik.php'><div id='profil'></div></a>
					<a href='poruke.php'><div id='".$divid."'></div></a>
					<a href='postavke.php'><div id='postavke'></div></a>
					<a href='logaut.php'><div id='odjava'></div></a>
</div>
<div id='drzac_info'>
					<div id='slika'><img src='".$avatar."' style='width:200px; height:auto;'></div>
					<div id='informacije'><table id='uctbl'>
					<tr><td>Ime:</td><td class='jeea'>".$red['Ime']."</td></tr>
					<tr><td>Prezime:</td><td class='jeea'>".$red['Prezime']."</td></tr>";
					if($jel_profa==false)
					echo"
					<tr><td>Broj:</td><td class='jeea'>".$red['BrDn']."</td></tr>
					<tr><td>Razred:</td><td class='jeea'>".$red['Razred']."</td></tr>
					<tr><td>Vladanje:</td><td class='jeea'>".$vlad."</td></tr>";
					else {
					echo "
					<tr><td>Predmet:</td><td class='jeea'>".$sacira."</td></tr>";
					if($red['Razrednik']!=0)
					echo"
					<tr><td>Razrednik:</td><td class='jeea'>".$red['Razrednik']."</td></tr>";
					}
					
					echo"
					</table> </div>
					</div>

		";
	}
	else
	{
		echo"<div id='login'><center>
					<form action='greeting.php' method='post'>
					<table>
					<tr>
					<td style='font-size:15px;'>Username:</td>
					<td><input type='text' name='user'></td>
					</tr>
					<tr>
					<td style='font-size:15px;'>Password:</td>
					<td><input type='password' name='pass'></td>
					</tr></table><br>
					<button class='button' style='float:left;'>Registruj Se</button></td>
					<button class='button' style='float:right;' value='Prijavi Se'>Prijavi Se</button></td>
					
					</form></center>
					</div>
					
					<div id='license'><br><center>
						<a rel='license' href='http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en_US'>
						<img alt='Creative Commons License' style='border-width:0' src='http://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png' /></a><br /><span xmlns:dct='http://purl.org/dc/terms/' property='dct:title'>Online Dnevnik</span> by <a xmlns:cc='http://creativecommons.org/ns#' href='http://social3d.tk' property='cc:attributionName' rel='cc:attributionURL'>Hasak Himzo & Osmić Venan</a> is licensed under a <a rel='license' href='http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en_US'>Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>.<br />Permissions beyond the scope of this license may be available at <a xmlns:cc='http://creativecommons.org/ns#' href='http://social3d.webege.com/licenca.html' rel='cc:morePermissions'>Proširena Licenca</a></center><br>
						</div>
";
	}
					?>
				
			</div>
			<div id="content">
