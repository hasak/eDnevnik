<div id="hed"><img src="logo1.png" /></div>		
		
		<div id="mg">
		
			
			<ul id="navigacija">
				<li><a href="default.php">NASLOVNA</a></li>
				<li><a href="dnevnik.php">DNEVNIK</a></li>
				<li><a href="testovi.php">TESTOVI</a></li>
				<li><a href="onama.php">O NAMA</a></li>
				<li><a href="kontakt.php">KONTAKT</a></li>
				<?php
					include('admin.php');
					if(isset($_SESSION['user']) && $admin==true) echo"
				<a href='#' id='ap'>ADMIN PANEL</a>"?>
			</ul>


			<div id="nav">
				<div id="login">
					<?php
					if(isset($_SESSION['user']))
						echo "<font color=#00ff00;><b>Logovan kao: </b></font><font color='white'>".$_SESSION['user']."</font><br><br><a href='logaut.php' style='text-decoration:none; color:#ffffff'>Logout</a>";					
					else
					{
					echo "
					<form action='greeting.php' method='post'>
						<b>Username:</b>
						<input type='text' id='user' name='user' style='color: #00ff00; background-color: #000000; border-color: #00ff00;/>
						<b id='us'></b>
						<b>Password:</b>
						<input type='password' id='pass' name='pass' style='color: #00ff00; background-color: #000000; border-color: #00ff00;/>
						<b id='pw'></b>
						<p></p>
						<input class='button' type='submit' value='Login' onClick='return clickk()'/>
					</form>";
					}
					?>
				</div>
			</div>
			
			<div id="con">