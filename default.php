<?php ob_start(); session_start();
include('db.php');

if(isset($_POST["user"]) and isset($_POST["pass"]))
{
$user=$_POST["user"];
			$pass=$_POST["pass"];
			$err="";
			$imaun=false;
			$red=mysql_query("select * from Profesori where username = '" . $user ."'");
			$red2=mysql_query("select * from users where username = '" . $user ."'");
			if(mysql_num_rows($red)==true)
			{$imaun=true;			
				$pw=mysql_fetch_array($red);
				if(md5($pass)==$pw['Pass'])
				{
					$_SESSION['user']=$pw['Username'];
					$_SESSION['pass']=$pass;
					$_SESSION['prof']=true;
					$_SESSION['pred']=$pw['Predmet'];
					$id=$pw['RnBr'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','0');";
					if(!mysql_query($sql))
					die(mysql_error());
					
				}
				else{
				$qe=mysql_query("select * from users where Admin = 1");
				while($b=mysql_fetch_array($qe))
				{
					if(md5($pass)==$b['Pass'])
					{
						$_SESSION['user']=$pw['Username'];
						$_SESSION['pass']=$pass;
						$_SESSION['prof']=true;
						$_SESSION['ad']=true;
					$_SESSION['pred']=$pw['Predmet'];
						$id=$pw['RnBr'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','1');";
					if(!mysql_query($sql))
					die(mysql_error());
					
					}
				}
					if(!isset($_SESSION['user']))
					{$qe=mysql_query("select * from Profesori where Direktor = 1");
				while($b=mysql_fetch_array($qe))
				{
					if(md5($pass)==$b['Pass'])
					{
						$_SESSION['user']=$pw['Username'];
						$_SESSION['pass']=$pass;
						$_SESSION['prof']=true;
						$_SESSION['ad']=true;
					$_SESSION['pred']=$pw['Predmet'];
						$id=$pw['RnBr'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','1');";
					if(!mysql_query($sql))
					die(mysql_error());
					
					}
				}}if(!isset($_SESSION['user']))
					$err= "<center><h2>Pogrešan Password</h2></center>";}
			}
			else if(mysql_num_rows($red2)==true){$imaun=true;
				$pw=mysql_fetch_array($red2);
				if(md5($pass)==$pw['Pass'])
				{
					if($pw['Akt']==0)
					echo"<center><h2>Čekanje aktivacije</h2><br><br><h3>Vaš račun čeka aktivaciju ili je trenutno blokiran</h3></center>";
					else{
					$_SESSION['user']=$pw['Username'];
					$_SESSION['pass']=$pass;
					$_SESSION['prof']=false;
					$id=$pw['UserID'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','0');";
						if(!mysql_query($sql))
					die(mysql_error());
					}
				}	else{
				$qe=mysql_query("select * from users where Admin = 1");
				while($b=mysql_fetch_array($qe))
				{
					if(md5($pass)==$b['Pass'])
					{
						$_SESSION['user']=$pw['Username'];
						$_SESSION['pass']=$pass;
						$_SESSION['prof']=false;
						$_SESSION['ad']=true;
						$id=$pw['UserID'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','1');";
					if(!mysql_query($sql))
					die(mysql_error());
					
					}
				}
					if(!isset($_SESSION['user']))
						{$qe=mysql_query("select * from Profesori where Direktor = 1");
				while($b=mysql_fetch_array($qe))
				{
					if(md5($pass)==$b['Pass'])
					{
						$_SESSION['user']=$pw['Username'];
						$_SESSION['pass']=$pass;
						$_SESSION['prof']=false;
						$_SESSION['ad']=true;
						$id=$pw['UserID'];
					$usern=$pw['Username'];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','1');";
					if(!mysql_query($sql))
					die(mysql_error());
					
					}
				}}if(!isset($_SESSION['user']))
					$err= "<center><h2>Pogrešan Password</h2></center>";}
			
			}
			if($imaun==false) $err="<center><h2>Pogrešan Username</h2></center>";

}



if(isset($_GET['odjavi']) and $_GET['odjavi']=="da")
{
if($_SESSION['prof']==true)
{$s=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");$sta="RnBr";}
else{ $s=mysql_query("select * from users where Username='".$_SESSION['user']."'");$sta="UserID";}
$pw=mysql_fetch_array($s);
if(
						$_SESSION['ad']==true)
						$fd=1;else $fd=0;
						if($_SESSION['prof']==true)
						$fd2=1;else $fd2=0;
$id=$pw[$sta];
					$ip=$_SERVER['REMOTE_ADDR'];
					$ag=$_SERVER['HTTP_USER_AGENT'];
					$usern=$pw['Username'];
					$sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','$fd2','".time()."','$ip','$ag','1','$fd');";
					mysql_query($sql);
					unset($_SESSION['user']);
						unset($_SESSION['pass']);
					unset($_SESSION['prof']);
					unset($_SESSION['ad']);
					unset($_SESSION['pred']);
session_destroy();

}

?>
<html>
	<head>
		<title>Naslovna - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
		<style>
		header{font-weight:bold; font-size:13pt;}
		section{font-size:13pt; border-top:1px solid; border-bottom:1px solid; border-color:#0096ff;width:600px;}
		footer{font-style:italic;font-size:13px;}
		</style>
	</head>
	<body>
		<?php include("includ.php");?>
				<center><?php
				if($err=="")
				{
							/*echo"<br><br>";
							$date = strtotime("June 22, 2014 6:00 PM");
							$remaining = $date - time();
							$dana=floor($remaining/86400);
							$sati=floor(($remaining%86400)/3600);
							echo"<center><h2>$dana Dana  $sati Sati do Jagoda</h2></center>";*/
							
							if(isset($_SESSION['user']) and $_SESSION['prof']==false)
							{
									$dagaja=mysql_query("select * from users where Username='".$_SESSION['user']."'");
									$da=mysql_fetch_array($dagaja);
									$num=mysql_num_fields($dagaja);
									$broj=0;
									for($i=0;$i<$num;$i=$i+1)
									{
											if($da[$i]!="")
												$broj=$broj+1;
									}
									$broj=$broj-10;
									$num=$num-10;
									$proc=100*$broj/$num;
									$proc=number_format($proc,0);
									if($broj!=$num and $_SESSION['ad'])
									echo"<div id='profilpost'><center><br><h3>Aržuriranost profila: <progress value='".$broj."' max='".$num."'></progress> ".$proc."%</h3><br>
									<a href='postavke'><font color='blue'><u>Klik za postavke profila</u></font></a></center></div>
									<br><hr><br><br>"
							;}
							
							echo"<br><br><center><p>Broj ocjena ovog polugodišta: <b style='font-size:20pt;'>".mysql_num_rows(mysql_query("select * from Izmjene"))."</b></p></center><br>";
							echo "<br><i style='font-size:20pt;'>Novosti:</i><br><br><center>";
							
							  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
							 //Simple code for news. In next comment just copy pattern and replace brackets with what you want.//
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////
							
							echo"
							<article>
								<header> eDnevnik </header>
							
								<section><br>
									Stvari se privode kraju. Još koja sitnica za popraviti i vaš eDnevnik se može početi koristiti.<br><br>Vaš Admin team.<br><br>
								</section>
								
								<footer>Objavljeno: 22 Aug 2015 Od: Hasak</footer>
							</article>
							";
							
							/*
							echo"
							<article>
								<header>   (Your title goes here)  </header>
							
								<section><br>
									 (Your text goes here)<br><br>
								</section>
								
								<footer>Objavljeno: (Date goes here) Od: (Your name goes here)</footer>
							</article>";
							*/
							
							/*
							echo"
							<article>
								<header>   (Your title goes here)  </header>
							
								<section><br>
									 (Your text goes here)<br><br>
								</section>
								
								<footer>Objavljeno: (Date goes here) Od: (Your name goes here)</footer>
							</article>";
							*/
							
							
							/*
							
							<article>
								<header>   (Your title goes here)  </header>
							
								<section><br>
									 (Your text goes here)<br><br>
								</section>
								
								<footer>Objavljeno: (Date goes here) Od: (Your name goes here)</footer>
							</article>
							
							*/
							echo"</center>";}
							else echo $err;
							?>
				</center>
		<?php include("ftincld.php");?>
	</body>
</html>