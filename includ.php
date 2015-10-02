<div id="ws">
<div class="space20px"></div>

	<div id="drzac-nav-logo">
		<div id="logo">
			<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>"><img src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>Logo.png" alt="Logo"></a>
		</div>
		<div id="nav">
			<div id="drz-navi">
				<ul class="button-navigacija">
					<li><a class="button" href="http://<?php echo $_SERVER['HTTP_HOST'];?>">NASLOVNA</a></li>
				<li><a class="button" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/dnevnik">DNEVNIK</a></li>
				<li><a class="button" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/posjecenost">POSJEĆENOST</a></li>
				<li><a class="button" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/ucenici">UČENICI</a></li>
				<li><a class="button" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/onama">O ŠKOLI</a></li><br>
				<?php
				if(isset($_SESSION['user']))
				{
					echo"<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/download'>DOWNLOAD</a></li>";
				if($_SESSION['prof']==true){
				$gdje123=mysql_query("select * from Profesori where username ='". $_SESSION['user']."'");
					$red1233=mysql_fetch_array($gdje123);
					
					
				echo "<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/upload'>UPLOAD</a></li>
				<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/statistika'>STATISTIKA</a></li>";
				if(isset($_SESSION['user']) && $red1233['Razrednik']!=0) echo"
				<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/razrednik'>RAZREDNIK ".$red1233['Razrednik'].". RAZREDA</a></li>
				";}
				
				}
				else ?>
				<!--<li><a href="http://<?php //echo $_SERVER['HTTP_HOST'];?>/posjecenost">POSJEĆENOST</a></li>-->
				<?php
					include("admin.php");
					if(isset($_SESSION['user']) && $admin==true)
						
					echo"
					<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/upload'>UPLOAD</a></li>
					<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/ap'>ADMIN PANEL</a></li>";
					if(isset($_SESSION['user']) && $direktor==true) 
					echo"
				<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/ap'>PANEL UPRAVE</a></li>";
					//echo $red1233['Razrednik'].$red1233['Razrednik'].$red1233['Razrednik'];
					//if(isset($_SESSION['user']) && $red1233['Razrednik']!=0) 
					//echo"<li style='float:right; margin-top:10px;'><a class='button' href='http://".$_SERVER['HTTP_HOST']."/razrednik'>RAZREDNIK ".$red1233['Razrednik']."</a></li>";
					?>
				</ul>
			</div>
		</div>
	</div>
	
<div class="space20px"></div>	

	<div id="stranica">
	<div id="sadrzaj-stranice">
		<!-- SIDEBAR -->
		<div id="sidebar">
			<!--<div class="sidebar-naslov"><p>GRBOVI</p></div>
			<div class="space20px"></div>			
			<div id="grbovi">
				<div class="grbzepce"><img src="grbzepce.jpg"></img></div>
				<div class="grbbih"><img src="grbbih.jpg"></img></div>
			</div>
			<div class="space20px"></div>
			<div class="sidebar-naslov"><p>Prijava na e-Dnevnik</p></div>			
			<div class="space20px"></div>
			<p> LOGIN: </p><br>
			<p> PASSWORD:</p>
			<div class="space20px"></div>
			<div class="sidebar-naslov"><p>KONTAKT</p></div>
			<div class="space20px"></div>
			<p style="color:#2265a4;"> Zagrebačka bb, 72 230 Žepče </p>
			<p style="color:#2265a4;"> glazbena.zepce@gmail.com </p>
			<br>
			<p style="color:#2265a4;">Tel/fax: +387 32 880 453</p>
			<div class="space20px-b"></div>-->
			<?php
	mysql_set_charset('utf8');
	date_default_timezone_set('Europe/Sarajevo');
	if(isset($_SESSION['user']))
	{
		$jel_profa=$_SESSION['prof'];
		if($jel_profa==true)
		{$jelpr="Profesori"; $staa="profil";}
		else {$jelpr="users"; $staa="ucenik";}
		$boolean=false;
		if($admin==true)
		$pord="or Zakoga='0'";
		else $pord="";
		$poruk=mysql_query("select * from Poruke where (Zakoga='".$_SESSION['user']."' ".$pord.") and Procitana='0'");
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
		$vlad="Uzorno";
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
		<a href='http://".$_SERVER['HTTP_HOST']."'><div id='homebutton'></div></a>
					
					<a href='http://".$_SERVER['HTTP_HOST']."/".$staa."'><div id='profil'></div></a>
					<a href='http://".$_SERVER['HTTP_HOST']."/poruke'><div id='".$divid."'></div></a>
					<a href='http://".$_SERVER['HTTP_HOST']."/postavke'><div id='postavke'></div></a>
					<a href='http://".$_SERVER['HTTP_HOST']."/odjava'><div id='odjava'></div></a>
</div>
<div id='drzac_info'>
					<div id='slika'><img src='".$avatar."' style='width:200px; height:auto;'></div>
					<div id='informacije'><table id='uctbl'>
					<tr><td>Ime:</td><td class='jeea'>".$red['Ime']."</td></tr>
					<tr><td>Prezime:</td><td class='jeea'>".$red['Prezime']."</td></tr>";
					if($jel_profa==false)
					{echo"
					<tr><td>Broj:</td><td class='jeea'>".$red['BrDn']."</td></tr>
					<tr><td>Razred:</td><td class='jeea'>".$red['Razred']."</td></tr>";
					$imsm=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$red['Smjer']."'"));
					echo"
					<tr><td>Smjer:</td><td class='jeea'>".$imsm['Ime']."</td></tr>
					<tr><td>Vladanje:</td><td class='jeea'>".$vlad."</td></tr>";}
					else {
						
						$qer=mysql_query("select * from Vise where Profa='".$red['RnBr']."'");
						if(mysql_num_rows($qer))
						{
							$sacira="<table><tr><td class='jeea' style='border-bottom:0px;'>".$sacira."</td></tr>";
							while($b=mysql_fetch_array($qer))
							{
								$novp=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
								$sacira.="<tr><td class='jeea2' style='border-bottom:0px;'>".$novp['Predmet']."</td></tr>";
							}
							$iii="i";
							$sacira.="</table>";
						}
						else $iii="";
					echo "
					<tr><td>Predmet".$iii.":</td><td class='jeea'>".$sacira."</td></tr>";
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
		echo"
		<div class='sidebar-naslov'><p>Grbovi</p></div>
			<div class='space20px'></div>			
			<div id='grbovi'>
				<div class='grbzepce'><img src='http://".$_SERVER['HTTP_HOST']."/grbzepce.jpg'></img></div>
				<div class='grbbih'><img src='http://".$_SERVER['HTTP_HOST']."/grbbih.jpg'></img></div>
			</div>
			<div class='space20px'></div>
			<div class='sidebar-naslov'><p>Prijava na eDnevnik</p></div>			
			<div class='space20px'></div><center><div id='login'>
					<form action='http://".$_SERVER['HTTP_HOST']."' method='post'>
					<table>
					<tr>
					<td style='font-size:15px;'>Username:</td>
					<td><input type='text' name='user'></td>
					</tr>
					<tr>
					<td style='font-size:15px;'>Password:</td>
					<td><input type='password' name='pass'></td>
					<tr><td id='zabhref' colspan='2' style='text-align:right; font-size:10pt; color:#55f; cursor:pointer;'>Zaboravili ste šifru?</td></tr>
					</tr></table><br>
					
					<input type='submit' class='button' style='float:right;' value='Prijavi se'></form>
					
					</div></center>
					<div class='space20px'></div>
			<div class='sidebar-naslov'><p>Kontakt</p></div>
			<div class='space20px'></div><center><i>
			<p style='color:#2265a4;'> Zagrebačka bb, 72 230 Žepče </p>
			<p style='color:#2265a4;'> glazbena.zepce@gmail.com </p>
			<br>
			<p style='color:#2265a4;'>Tel/fax: +387 32 880 453</p></i></center>
			<div class='space20px-b'></div>
					
					<div id='zabsif' title='Zaboravljena šifra' style='display:none;'><center><h2>Obnova šifre</h2><br>
					<p style='font-size:12pt;'>-Ukoliko ste zaboravili šifru, obratite se Administratorima klikom na žuti button u dnu stranice (footeru).<br>
					-Nemojte zaboraviti navesti podatak kako da vas kontaktiramo kao i vaš Username.<br>
					-Ukoliko ste učenik, poželjno je da navedete razred i broj u dnevniku.</p></center></div>
					
					
					
					
";
	}
					?>
		</div>
		<div id="adminporuka" title="Poruka Adminima" style="display:none;"><center><h3>Pošalji poruku</h3>
			<br><form action="http://<?php echo $_SERVER['HTTP_HOST'];?>/poruke" method="post">
			<table><tr><td>Kako ćemo vam odgovoriti?<br><i style="font-size:9pt;">(Unesite vaš email, fb, ili nešto drugo.<br>Ukoliko niste prijavljeni a ne unesete, mi vam ne možemo odgovoriti)</i></td><td><input type="text" name="cont"></td>
			</tr><tr><td>Vaša poruka:</td><td><textarea name='por' rows='4' style='background: none;
border: 1px solid black;
width: 171px;'></textarea></td></tr></table><br><br>
<input type="hidden" name="jelan" value="<?php if(isset($_SESSION['user'])) echo "0"; else echo "1"; ?>">
<input type="hidden" name="admi" value="1">
<input type="Submit" name="nejm" value="Pošalji Poruku" class="button2"/></form>
			</center>
			</div>
		<!-- KRAJ SIDEBAR-a -->
	
		<!-- CONTENT/SADRŽAJ (NOVOSTI) -->
		<span style="width:630px;display:table;">