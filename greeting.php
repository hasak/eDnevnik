<?php  ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Prijava - eDnevnik</title>
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
			$user=$_POST["user"];
			$pass=$_POST["pass"];
			$red=mysql_query("select * from Profesori where username = '" . $user ."'");
			$red2=mysql_query("select * from users where username = '" . $user ."'");
			if(mysql_num_rows($red)==true)
			{			
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
					else{
						echo"<script>location.replace('http://".$_SERVER['HTTP_HOST']."');</script>";
		}
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
					else{
						echo"<script>location.replace('http://".$_SERVER['HTTP_HOST']."');</script>";
		}
					}
				}
					echo "<center><h2>Pogrešan Password</h2></center>";}
			}
			else if(mysql_num_rows($red2)==true){
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
					else{
						echo"<script>location.replace('http://".$_SERVER['HTTP_HOST']."');</script>";
		}}
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
					else{
						echo"<script>location.replace('http://".$_SERVER['HTTP_HOST']."');</script>";
		}
					}
				}
					echo "<center><h2>Pogrešan Password</h2></center>";}
			
			}
			else echo "<center><h2>Pogrešan Username</h2></center>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>