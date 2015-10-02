<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Registracija - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
				<?php
				$user=$_POST['user'];
				$ime=$_POST['ime'];
				$prezime=$_POST['prezime']; 
				$pw=md5($_POST['pw']); 
				$BrDn=$_POST['BrDn']; 
				$smeer=$_POST['smeer'];
				$razzred=$_POST['razred'];
				$rzz=$razzred;
				$pred=$_POST['pred'];
				//$vjet=$_POST['vjet'];
				$datee=time();
				$trs=false;
				$incc=0;
				
				$l=strlen($user);
				while($incc<$l)
				{
						if($user[$incc]=='<' || $user[$incc]=='>' || $user[$incc]=='(' || $user[$incc]==')')
						$trs=true;
						
						if($ime[$incc]=='<' || $ime[$incc]=='>' || $ime[$incc]=='(' || $ime[$incc]==')')
						$trs=true;
						
						if($prezime[$incc]=='<' || $prezime[$incc]=='>' || $prezime[$incc]=='(' || $prezime[$incc]==')')
						$trs=true;
						
						if($BrDN[$incc]=='<' || $BrDN[$incc]=='>' || $BrDN[$incc]=='(' || $BrDN[$incc]==')')
						$trs=true;
						
						
						$incc=$incc+1;
				
				}
				if($trs==true)
				echo "<center><h2>Greška</h2></center>";
				else 
				if($BrDn<1 || $BrDn>40) echo "<center><h2>Broj u dnevniku može biti od 1 do 40</h2></center>";
				else{
				$gdje=mysql_query("select * from users where username ='". $user."'");
				$gdje6=mysql_query("select * from Profesori where username ='". $user."'");
				$gdje2=mysql_query("select * from users");
				$inc=1;
				$dalije=false;
				while($ajmo=mysql_fetch_array($gdje2))
				{
				if($ajmo['Razred']==$rzz && $ajmo['BrDn']==$BrDn)
				$dalije=true;
				$inc=$inc+1;
				}
				if($dalije==true)
				echo "<center><h2>Već postoji profil pod tim brojem!</h2><br><h3>Ukoliko ste to vi, obratite se administratorima</h3></center>";
				else{
				if(mysql_num_rows($gdje)!=0 || mysql_num_rows($gdje6)!=0)
				echo "<center><h2>Već postoji taj Username!</h2></center>";
				//else if(mysql_num_rows($gdje2)==1)
				//echo "<center><h2>Ne mozes se registovati sa tudjim brojem!</h2></center>";
				//&& $ime!='' && $prezime!='' 
				else if($user!='' && $pw!='' && $BrDn!='' && $rzz!='' && $smeer!='' && $pred!='' && $rzz!=0 && $ime!='' && $prezime!=''){
				$sql="Insert INTO users (Username,Pass,Ime,Prezime,Razred,BrDn,Smjer,Fran,Reg,Akt) value ('$user','$pw','$ime','$prezime','$rzz','$BrDn','$smeer','$pred','$datee',1)"; echo "<center>";
				$sql2="UPDATE Spisak set `".$rzz."`='".$ime." ".$prezime."' where Broj='".$BrDn."'";
				if(!mysql_query($sql) or !mysql_query($sql2))
				die('Greska: ' . mysql_error());
				else
				echo "<h2>Uspješna registracija</h2>";
				echo "</center>";
				mysql_query("UPDATE users SET Ime = CONCAT( UCASE( LEFT( Ime, 1 ) ) , SUBSTRING( Ime, 2 ) )");
				mysql_query("UPDATE users SET Prezime = CONCAT( UCASE( LEFT( Prezime, 1 ) ) , SUBSTRING( Prezime, 2 ) )");}
				else echo "<center><h2>Unesi sva polja!</h2></center>";}}
				?>
		<?php include("ftincld.php");?>
	</body>
</html>