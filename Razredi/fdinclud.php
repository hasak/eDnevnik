<a href="../default.php"><div id="hed" ><center><img src="logo1.png" /></a></center></div>		
		
		<div id="mg">
		
			
			<ul id="navigacija">
				<li><a href="../default.php">NASLOVNA</a></li>
				<li><a href="../dnevnik.php">DNEVNIK</a></li>
				<?php
				if($_SESSION['prof']==true){
				$gdje123=mysql_query("select * from Profesori where username ='". $_SESSION['user']."'");
					$red1233=mysql_fetch_array($gdje123);
				echo "
				<li><a href='../upload.php'>UPLOAD</a></li>";}
				else echo "<li><a href='../upload'>DOWNLOAD</a></li>";?>
				<li><a href="../ucenici.php">UČENICI</a></li>
				<li><a href="../onama.php">O NAMA</a></li>
				
				<?php
					include('admin.php');
					if(isset($_SESSION['user']) && $admin==true) echo"
				<a href='../ap.php' id='ap'>ADMIN PANEL</a>";
					if(isset($_SESSION['user']) && $direktor==true) echo"
					<a href='../ap.php' id='ap'>DIREKTOR PANEL</a>";
					if(isset($_SESSION['user']) && $red1233['Razrednik']!=0) echo"
					<a href='../dnevnici.php' id='ap' target='_blank'>RAZREDNIK ".$red1233['Razrednik']."</a>";?>
			</ul>


			<div id="nav">
				<div id="login">
					<?php
					mysql_set_charset('utf8');
					if(isset($_SESSION['user'])){
						$jel_profa=$_SESSION['prof'];
						if($jel_profa==true)
						$jelpr="Profesori";
						else $jelpr="users";
						$gdje=mysql_query("select * from ".$jelpr." where username ='". $_SESSION['user']."'");
					$red=mysql_fetch_array($gdje);
					if($jel_profa==true){
					$za_fec=mysql_query("select * from Predmeti where RnBr='".$red['Predmet']."'");
					$fecovano=mysql_fetch_array($za_fec);
					$sacira=$fecovano['Predmet'];}
					$avatar=$red['Img'];
						echo "
						<div id='logovan_kao'><font color='#282828'><b>Logovan kao: </b></font><font color='white'>".$_SESSION['user']."</font><br></div>
						<br>
						<div id='logovan'>
						<br>
						<div id='fadeout'>
						<center><a href='ca.php'><img src='".$avatar."' width='200px' alt='Change avatar'/></a></center>
						</div><br>
						<center><table style='color:#ffffff; width:200px; font-size:12pt;'>
						<tr><td style='color:#282828;'>Ime:</td><td>".$red['Ime']."</td></tr>
						<tr><td style='color:#282828;'>Prezime:</td><td>".$red['Prezime']."</td></tr>";if($_SESSION['prof']==false) echo"
						<tr><td style='color:#282828;'>Razred:</td><td>".$red['Razred']."</td></tr>
						<tr><td style='color:#282828;'>Broj:</td><td>".$red['BrDn']."</td></tr>";
						else { 
						if($red['Razrednik']!='0')
						echo"<tr><td style='color:#282828;'>Razrednik:</td><td>".$red['Razrednik']."</td></tr>";
						echo "<tr><td style='color:#282828;'>Predmet:</td><td>".$sacira."</td></tr>";}
						echo "</table><br></center>
						</div>
						<br><center><form action='../logaut.php' method='post'>
						<input class='button2' type='submit' value='Odjavi se'></form></center>
						";	}
					else
					{
					echo "
					<form action='../greeting.php' method='post'>
						<font style='color:#282828;'><b>Username:</b></font>
						<input type='text' id='user' name='user' style='color: #000000; background-color: #b5b5b5; border-color: #0096ff;/>
						<b id='us'></b><br>
						<font style='color:#282828;'><b>Password:</b></font><br>
						<input type='password' id='pass' name='pass' style='color: #000000; background-color: #b5b5b5; border-color: #0096ff;/>
						<b id='pw'></b>
						<p></p>
						<input class='button2' type='submit' value='Login' onClick='return clickk()'/>
						<button class='button2' type='button' id='opener'>Registruj Se</button>
					</form>
					<div id='license'><br><center>
						<a rel='license' href='http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en_US'><img alt='Creative Commons License' style='border-width:0' src='http://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png' /></a><br /><span xmlns:dct='http://purl.org/dc/terms/' property='dct:title'>Online Dnevnik</span> by <a xmlns:cc='http://creativecommons.org/ns#' href='http://www.social3d.tk/' property='cc:attributionName' rel='cc:attributionURL'>Osmić Venan & Hasak Himzo</a> is licensed under a <a rel='license' href='http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en_US'>Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>.<br />Based on a work at <a xmlns:dct='http://purl.org/dc/terms/' href='http://www.social3d.tk/' rel='dct:source'>http://www.social3d.tk/</a>.</center><br>
						</div>
					
					<div id='registracija_popup' title='Registracija'>
					<center><h2>Registracija</h2>
			<form action='../register.php' method='post'>
			<table style='color:#808080;'>
				<tr><td>Username:</td><td><input type='text' name='user' size='17'/></td></tr>
				<tr><td>Ime:</td><td><input type='text' name='ime' size='17'/></td></tr>
				<tr><td>Prezime:</td><td><input type='text' name='prezime' size='17'/></td></tr>
				<tr><td>Password:</td><td><input type='password' name='pw' size='17'/></td></tr>
				<tr><td>Broj u dnevniku:</td><td><input type='text' name='BrDn' size='17'/></td></tr>
				<tr><td><input type='radio' name='pred' value='0' checked>Njem<br>
				<input type='radio' name='pred' value='1'>Fran</td><td><input type='radio' name='vjet' value='0' checked>Vjero<br>
				<input type='radio' name='vjet' value='1'>Etika</td></tr>
				<tr><td>Razred:</td><td></td></tr>
				<tr><td><input type='radio' name='razred' value='1'>I<br>
				<input type='radio' name='razred' value='2'>II<br>
				<input type='radio' name='razred' value='3'>III<br>
				<input type='radio' name='razred' value='4'>IV
				</td><td>
				<input type='radio' name='odjeljenje' value='a'>A<br>
				<input type='radio' name='odjeljenje' value='b'>B<br>
				<input type='radio' name='odjeljenje' value='c'>C<br>
				<input type='radio' name='odjeljenje' value='d'>D</td></tr>
				
				<tr><td></td><td align='right'><input class='regbutton' type='submit' value='Registruj Se' onClick='return clickk()'/></td></tr>
			</table>
			
			</form></center>
					</div>
								";
									}
									?>
				</div>
			</div>
			
			<div id="con">