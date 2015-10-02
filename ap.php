<?php ob_start(); session_start();
include('db.php');


/*

PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       

PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       

PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       

PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       PROMRAZ!!!       

ono brzo mijenjanje ucenika u razz treba zavrsit !!

ZAVRSENOOO !!! :D
*/


?>
<html>
	<head>
		<title>Panel uprave - eDnevnik</title>
		<?php include('ink.php'); ?>
		<script>
  $(function() {
    $( "#dodaj_profu" ).dialog({
      autoOpen: false,
      show: {
        effect: "scale",
        duration: 350
      },
      hide: {
        effect: "drop",
        duration: 350
      }
    });
 
    $( "#opener3" ).click(function() {
      $( "#dodaj_profu" ).dialog( "open" );
    });
  });
  </script>
  <script>
  function ajaxx(dane,id)
  {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() 
		{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("uc").innerHTML=xmlhttp.responseText;
				}
		}
		xmlhttp.open("GET","ajax.php?dane="+dane+"&id="+id,true);
		xmlhttp.send();
  }
	function liax()
  {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() 
		{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("sviuc").innerHTML=xmlhttp.responseText;
				}
		}
		xmlhttp.open("GET","ajax.php?svi=tru",true);
		xmlhttp.send();
  }
  function funcc()
  {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() 
		{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("upostj").innerHTML=xmlhttp.responseText;
				}
		}
		xmlhttp.open("GET","ajax3.php?kpu=tru",true);
		xmlhttp.send();
  }
  function brisioc(brojoc)
  {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() 
		{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("redz"+brojoc).innerHTML="<td colspan='8'><i style='color:red;'>Izbrisana ocjena!</i></td>";
				}
		}
		xmlhttp.open("GET","ajax3.php?brisioc="+brojoc,true);
		xmlhttp.send();
  }
  </script>
  <?php include("funkcije.php");?>
	</head>
	<body>
		<?php include("includ.php");?>
		<?php include("admin.php");
			if($direktor==false && $admin==false)
				echo "<center><h1>Niste uprava !!</h1></center>";
			else {
			
			
			if($admin==true) $gdee="users"; else $gdee="Profesori";
			$skii=mysql_query("select * from ".$gdee." where Username = '".$_SESSION['user']."'");
			$nnn=mysql_fetch_array($skii);
			$qqq=mysql_query("select * from Profesori ");		
			echo "
			<button id='bbbb' class='button' style='float:right;display:none;' onClick='function3()'>X</button><br>";
			
			
			
			if(isset($_POST['jel']))
			{	
			$id=$_POST['id'];
				//$q76=mysql_query("select * from Profesori where RnBr='".$id."'");
			//$e76=mysql_fetch_array($q76);
			if($_POST['jelradi']==true)
				$ae=1;
			else $ae=0;
			
			$qu76="update Profesori set Radi = '".$ae."' where RnBr='".$id."';";
					if(mysql_query($qu76)==false)
					die(mysql_error());
				
			$r=mysql_query("select * from Razredi where ID='".$id."'");
			//$u=mysql_fetch_array($r);
			$col=mysql_num_fields($r);
			
				for($i=1;$i<$col;$i=$i+1)
				{
					$s="raz".$i;
					if($_POST[$s]==true)
					$dd=1; else $dd=0;
					$ime=mysql_field_name($r,$i);
					
					$qu="UPDATE  `Razredi` SET  `".$ime."` =  '".$dd."' WHERE  `ID` =".$id.";";
					
					
					//$qu="update Razredi set ".$ime." = '".$dd."' where ID='".$id."';";
					if(mysql_query($qu)==false)
					die(mysql_error());
				}
				echo"<form name='salji' action='".$_SERVER['PHP_SELF']."' method='post'>
				<input type='hidden' name='razpr' value='".$id."'>
				</form><script type='text/javascript'>document.salji.submit()</script>";
				
			}
			else if(isset($_POST['razpr']))
			{
				$q=mysql_query("select * from Profesori where RnBr='".$_POST['razpr']."'");
			$e=mysql_fetch_array($q);
			$r=mysql_query("select * from Razredi where ID='".$e['RnBr']."'");
			$u=mysql_fetch_array($r);
			$col=mysql_num_fields($r);
			if($e['Radi'])
				$ckek="checked";
			else $ckek="";
				//$inc=0;
				echo "<br><center><h3>".$e['Ime']." ".$e['Prezime']."</h3><br>
				<form action='".$_SERVER['PHP_SELF']."' method='post'><input type='checkbox' name='jelradi' ".$ckek."> Radi<br>";
				$u42=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$e['Predmet']."'"));
				$imep=$u42['Predmet'];
				echo $imep.": "; $jnu=mysql_fetch_array(mysql_query("select * from PredPoRazz where ID='".$e['Predmet']."'")); echo $jnu[2].$jnu[3].$jnu[4].$jnu[5]."<br>";
				$ququ=mysql_query("select * from Vise where Profa='".$e['RnBr']."'");
				if(mysql_num_rows($ququ))
				{
					while($b=mysql_fetch_array($ququ))
					{
						echo"<br>";
						$u42=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
				$imep=$u42['Predmet'];
				echo $imep.": "; $jnu=mysql_fetch_array(mysql_query("select * from PredPoRazz where ID='".$b['Pred']."'")); echo $jnu[2].$jnu[3].$jnu[4].$jnu[5]."<br>";
					}
				}
				echo"<br><br><table><tr>";
				for($i=1;$i<$col;$i=$i+1)
				{
					$ime=mysql_field_name($r,$i);
					if($i%4==1)
					echo"</tr><tr>";
					echo"<td><input type='checkbox' name='raz".$i."'";
					if($u[$i]==1)
					echo"checked";
					echo">".$ime."</td>";
				}
				echo "</tr></table><br><br>
				<input type='hidden' name='id' value='".$e['RnBr']."'>
				<input type='submit' value='Izmijeni' class='button' name='jel'></form></center>";
			}
			
		
			
			if(isset($_POST['ime']) and isset($_POST['prezime']) and isset($_POST['user']))
			{
			
			$user=$_POST['user'];
			$qver=mysql_query("select * from Profesori where Username = '".$user."'");
			$qver2=mysql_query("select * from users where Username = '".$user."'");
			if(mysql_num_rows($qver)!=0 || mysql_num_rows($qver2)!=0)
			echo "<center><h3>Username postoji</h3></center>";
			else{
			
			
			$ime=$_POST['ime'];
			$prez=$_POST['prezime'];
			$pass=md5($_POST['pw']);
			$pred=$_POST['pred'];
			//$date=date("d.m.Y");
			$date=time();
			//if($_POST['jelraz']==true)
			$rzzz=$_POST['razred'];
			//else $rzzz='0';
			//$niz[]=0;
			if($ime!="" and $prez!="" and $_POST['pw']!="" and $user!=""){
			$majsql="INSERT INTO  Profesori (
RnBr ,
Username ,
Ime ,
Prezime ,
Pass ,
Predmet ,
Razrednik ,
Direktor ,
Img ,
Reg
)
VALUE (
NULL ,  '$user',  '$ime',  '$prez',  '$pass' ,  '$pred', '$rzzz', '0',  'http://www.stealthproducts.com/seatingOF/images/avatars/no-avatar.jpg', '$date'
)";
$asdfg="select * from Profesori where Username = '".$user."'";

$druga="INSERT INTO  Razredi (
`ID` ,
`1` ,
`2` ,
`3` ,
`4` 
)
VALUES (
NULL ,  '0',  '0',  '0',  '0'
);";

$ne_radi=false;

			if(mysql_query($majsql)==true && mysql_query($druga)==true)
			{
			$asdfg=mysql_query("select * from Profesori where Username = '".$user."'");
			$fetchh=mysql_fetch_array($asdfg);
			$id=$fetchh['RnBr'];
			$kuer=mysql_query("select * from Razredi");
				$majf=mysql_fetch_array($kuer);
				$brinc=mysql_num_fields($kuer);
			$kre=1;
			$cp=0;
			while($kre<$brinc)
				{
					$kojir=mysql_field_name($kuer,$kre);
					$inkre=$kre;
					$tmp=$_POST[$inkre];
					//echo $tmp;
					//$niz[$kre]=$tmp;
					if($tmp==true)
					{
						$sikl="UPDATE  `Razredi` SET  `".$kojir."` =  '1' WHERE  `Razredi`.`ID` =".$id." LIMIT 1 ;";
						if(mysql_query($sikl)==false)     {
						$ne_radi=true;mysql_error();}
					}
					
					$kre=$kre+1;
					$cp=$cp+1;
				}
			
			
			
			if($ne_radi==true) echo "greska"; else {
			mysql_query("UPDATE Profesori SET Ime = CONCAT( UCASE( LEFT( Ime, 1 ) ) , SUBSTRING( Ime, 2 ) )");
				mysql_query("UPDATE Profesori SET Prezime = CONCAT( UCASE( LEFT( Prezime, 1 ) ) , SUBSTRING( Prezime, 2 ) )");
			}}
			else die(mysql_error());
			}else echo"<br><center><h3>Unesite sva polja!</h3></center>";	}		}
			
			
			if(isset($_GET['promraz'])){
									echo"<center><br><br><br><form action='".$_SERVER['PHP_SELF']."' method='post'><br><br><select name='ra'>"; 
					$kuer12=mysql_query("select * from Razredi");
				//$majf3=mysql_fetch_array($kuer2);
				$brinc13=mysql_num_fields($kuer12);
				$kre13=1;
				while($kre13<$brinc13)
				{
					$kojir11=mysql_field_name($kuer12,$kre13);
					echo"<option value='".$kojir11."'>".$kojir11."</option>";
					$kre13=$kre13+1;
				}
					echo"</select><br><br><input type='submit' value='Odaberi' class='button'></form></center>";
					
							if(isset($_POST['roz']))
							{
									$s=mysql_query("select * from Spisak");
									$num=mysql_num_rows($s);
									for($i=1;$i<$num+1;$i=$i+1)
									{
											$z="jed".$i;
											$a=$_POST[$z];
											$kue="update Spisak set ".$_POST['roz']."='".$a."' where Broj='".$i."'";
											if(mysql_query($kue)==false)
											die(mysql_error());
									}
							}
							
							
							if(isset($_POST['ra']))

								
								{
										$rz=$_POST['ra'];
										$r=mysql_query("select * from Spisak");
										echo"<br><br>".$rz."<br><br><form action='".$_SERVER['PHP_SELF']."' method='post'>";
										while($b=mysql_fetch_array($r))
										{
												echo $b[0]."  <input type='text' name='jed".$b[0]."' value='".$b[$rz]."'><br>";
										}
										echo"<input type='hidden' name='roz' value='".$rz."'>
										<input type='hidden' name='ra' value='".$rz."'><input type='submit' value='Promeeeeni' class='button'></form>";
								}}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(isset($_POST['post']))
			{
				$ime=$_POST['ime'];
				$pre=$_POST['prezime'];
				$rz=$_POST['razred'];
				$br=$_POST['BrDn'];
				$imo=$_POST['imeo'];
				$ad=$_POST['adresa'];
				$mje=$_POST['mjesto'];
				$datr=$_POST['datumr'];
				$mjesr=$_POST['mjestor'];
				$brmo=$_POST['tel'];
				$vlade=5;
				$ava=$_POST['slika'];
				$datum=date("d.m.Y");
				
				$sd="insert into Ucenici 
				(ID,Ime,Prezime,Razred,Broj,Ime_oca,Adresa,Mjesto,Datumr,Mjestor,Brojmob,Vladanje,Avatar,Datum)
				values(null,'$ime','$pre','$rz','$br','$imo','$ad','$mje','$datr','$mjesr','$brmo','$vlade','$ava','$datum');";
				if(mysql_query($sd)==false)
				die(mysql_error());
			}
			
			if(isset($_POST['drug'])){
		$gdje=mysql_query("select * from Profesori where Username ='". $_SESSION['user']."'");
				$red=mysql_fetch_array($gdje);
				$toje=$red['RnBr'];
				//$prezz=$red['Prezime'];
				$raz=" ";
				//$toje=$imee.$raz.$prezz;
				$msg=$_POST['msg'];
				$rzz=$_POST['razz'];
				$date=date('d.m.Y');
				
				//$sql=mysql_query("update ".$gdjeje."' set 'Img' = '".$url."' where '".$gdjeje."'.'".$staje."' =".$toje." limit 1");
				//$sql=mysql_query("UPDATE  `Obavijesti` SET  `Img` =  '".$url."' WHERE  `".$gdjeje."`.`".$staje."` =".$toje." LIMIT 1");
				$sql=mysql_query("INSERT INTO `Obavijesti` (
				`ID` ,
				`Autor` ,
				`Msg` ,
				`Date`,
				`Razz` 
				)
				VALUES (
				NULL ,  '$toje',  '$msg', '$date', '$rzz'
				)
					");
				if(!$sql)
					die('Greska' . mysql_error());}
			
			
			echo"<div id='content_margine'>
					<div id='drzac_aikona'><br><br>
						<div id='profesori' class='apklasa' onClick='function1()'></div>
						<div id='ucenici' class='apklasa'  onClick='function2()'></div>
						<div id='dnevnici' class='apklasa'  onClick='function4()'></div>
						<div id='ocjene' class='apklasa'  onClick='function5()'></div>
						<div id='obavijesti'  class='apklasa' onClick='function6()'></div>
						<div id='statistika' class='apklasa'  onClick='function8()'></div>
						<div id='vladanje' class='apklasa'  onClick='function7()'></div>
						<a href='http://".$_SERVER['HTTP_HOST']."/backup'><div id='postavkea' class='apklasa'></div></a>
						<span id='opener3'><div id='dodajprof' class='apklasa'></div></span>
						<span id='opener'><div id='dodajucenika' class='apklasa'></div></span>
						<div id='dodajrazred'  class='apklasa' onClick='function18()'></div>
						<div id='prazan' class='apklasa' onclick='funcc(); function19();' style='cursor:pointer;'></div>
					</div>
				</div>

			";
			echo"<div id='klasee' style='display:none;'><center><br><br>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/nova' target='_blank'><button class='button2' style='display:inline;cursor:pointer;'>Nova klasa</button></a>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/izmjena' target='_blank'><button class='button2' style='display:inline;cursor:pointer;'>Izmijeni klasu</button></a>
			<a href='http://".$_SERVER['HTTP_HOST']."/klase/brisi' target='_blank'><button class='button2' style='display:inline;cursor:pointer;'>Izbriši klasu</button></a>
			</center></div>";
			if($admin==false) echo"
			<div id='std'></div>";
			else echo "<div id='std'></div>";
			echo"
			<div id='profe' style='display:none;'>
			<center><div class='ScrollbarProfesoriAP' id='Stil1'><form action='".$_SERVER['PHP_SELF']."' method='post'><table class='tabela'>
			<tr id='prvi_red'><td>ID</td><td>Username</td><td>Ime</td><td>Prezime</td><td>Razrednik</td><td>Predmeti</td><td>Registrovan</td><td>Radi</td></tr>
			";
			while($red=mysql_fetch_array($qqq))
			{if(!$red['Direktor'] or $red['Reg']<1439040225)
				{
			$qqqq=mysql_query("select * from Predmeti where RnBr='".$red['Predmet']."'");	
			$asd=mysql_fetch_array($qqqq);
			if($red['Razrednik']!='0')
			$razzz=$red['Razrednik'];
			else $razzz=" ";
			if($red['Radi'])
				$rad="Da";
			else $rad="Ne";
			echo"<tr style='color:#656565'>
			<td id='prva_cell'><label for='profin".$red['RnBr']."'>".$red['RnBr']."</label></td>
			<td style='color:black;'><label for='profin".$red['RnBr']."'>".$red['Username']."</label></td>
			<td><label for='profin".$red['RnBr']."'>".$red['Ime']."</label></td>
			<td><label for='profin".$red['RnBr']."'>".$red['Prezime']."</label></td>
			<td><label for='profin".$red['RnBr']."'>".$razzz."</label></td>
			<td><label for='profin".$red['RnBr']."'>".$asd['Predmet'];
			$ju=mysql_query("select * from Vise where Profa='".$red['RnBr']."'");
			while ($b=mysql_fetch_array($ju)) {
				$mn=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr='".$b['Pred']."'"));
				echo"<br>".$mn['Predmet'];
			}
			echo"</label></td>
			<td><label for='profin".$red['RnBr']."'>".date("d.m.Y",$red['Reg'])."</label></td>
			<td><label for='profin".$red['RnBr']."'>".$rad."</label></td></tr>
			<button type='submit' id='profin".$red['RnBr']."' name='razpr' value='".$red['RnBr']."' style='position:absolute; left:-9999px;'>aa</button>";}
			}
			echo
			
			"</table></form></div></center>	
			<br><div id='dodaj_profu' title='Dodaj profesora'><center><h2>Dodaj profesora</h2></center><br>
			<form action='".$_SERVER['PHP_SELF']."' method='post'>
			<center><table border='0'>
			<tr><td>Username:</td><td><input type='text' name='user' maxlenght='49' size='14'></td></tr>
			<tr><td>Ime:</td><td><input type='text' name='ime' maxlenght='49' size='14'></td></tr>
			<tr><td>Prezime:</td><td><input type='text' name='prezime' maxlenght='49' size='14'></td></tr>
			<tr><td>Password:</td><td><input type='password' name='pw' maxlenght='99' size='14'></td></tr>
			<tr><td>Predmet:</td><td><select name='pred'>";
			$kveri=mysql_query("select * from Predmeti");
			while($uzimaj=mysql_fetch_array($kveri))
			{
			echo"<option value='".$uzimaj['RnBr']."'>".$uzimaj['Predmet']."</option>";
			}
			echo"</select></td></tr>
			<tr><td>Razredik:</td>
				<td><select name='razred'><option value='0'>Nije</option>";
				$kuer=mysql_query("select * from Razredi");
				$majf=mysql_fetch_array($kuer);
				$brinc=mysql_num_fields($kuer);
				$kre=1;
				while($kre<$brinc)
				{
					$kojir=mysql_field_name($kuer,$kre);
					echo"<option value='".$kojir."'>".$kojir."</option>";
					$kre=$kre+1;
				}
				echo"</select></td></tr>
			</table><br>
			<center><h4>Razredi kojima predaje:</h4></center>
			<center>
			<table width='230px' border='0'>
			<tr>";
			$kre=1;
			$cp=0;
			while($kre<$brinc)
				{
					$kojir=mysql_field_name($kuer,$kre);
					$inkre=$kre;
					if($cp%4==0)
					echo"</tr><tr>";
					echo"<td><input style='cursor:pointer;' id='asd".$inkre."' type='checkbox' name='".$inkre."'><label style='cursor:pointer;' for='asd".$inkre."'>".$kojir."</label></td>";
					$kre=$kre+1;
					$cp=$cp+1;
				}
			
			
			echo"</tr>
			</table>
			</center>
			<br><br>
			<input type='submit' value='Dodaj!' class='button2'><center>
			</form></div>
			</div>		
			";		
						
			echo"
			<div id='msg' style='display:none;'><br>
			<center><h4>Dodaj obavijest:</h4><form action='".$_SERVER['PHP_SELF']."' method='post'>
			<textarea rows='6' cols='40' name='msg'></textarea>
			<br><br>
			<input type='hidden' name='razz' value='0'/>
			<input type='submit' name='drug' class='button2' value='Dodaj'/>
			</form></center>
				<center><div class='ScrollbarObavijestiAP' id='Stil1'>
				<table class='tabela'>
				<tr id='prvi_red'><td>Profesor</td><td>Obavijest</td><td>Datum</td></tr>"; 
				$msg=mysql_query("select * from Obavijesti order by ID desc");
				//$nekinc=0;
				while($uzmi=mysql_fetch_array($msg))
				{
						//if( $nekinc<10){
				$sadds=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$uzmi['Autor']."'"));
						echo"<tr><td>".$sadds['Ime']." ".$sadds['Prezime']."</td><td class='crveno'>".$uzmi['Msg']."</td><td>".$uzmi['Date']."</td></tr>";
						//$nekinc=$nekinc+1;}
				}
				$kojimraz=mysql_query("select * from Razredi where ID = '".$redd['RnBr']."'");
				$redzaraz=mysql_fetch_array($kojimraz);
				$kolum=mysql_num_fields($kojimraz);
				$cpp=1;
				$cp=0;
				echo"
				
				</table></div>
				</center>
				
				
			</div>
						<div id='posjete22' style='display:none;'><center><h2>Posjete</h2></center><center id='upostj'><h3><i>Učitavanje...</i></h3></center></div>
			 <div id='dnev' style='display:none;'><center><h2>Dnevnici</h2></center><center>
			 
				<form action='dnevnici' method='post' target='_blank'>
				<table id='razredi'>
				<tr>";
				
				while($cpp<$kolum)
				{
						//$cp=0;
						$imeraz=mysql_field_name($kojimraz,$cpp);
						if($cp%4==0)
						echo"</tr><tr>";
						echo"
								<td><input type='radio' name='razz' value='".$imeraz."' id='".$imeraz."' style='position:absolute; left:-9999px;'><label for='".$imeraz."'>".$imeraz."</label></td>";
						
						/*while($cp<4)
						{
								echo"";
								$cp=$cp+1;
						}*/
						$cpp=$cpp+1;
						$cp=$cp+1;
				}
				echo"</tr>
				</table>
				<br><br>
				<input type='Submit' class='button2' value='Idi u razred!'>
				</form>
				</center></div>";
			$red=mysql_query("select * from users where Akt=0");
			
			//$dn=mysql_query("select * from Dnevnik ORDER BY Broj ASC");
			echo "<div id='uc' style='display:none;'>";
			echo "<center><div class='ScrollbarUceniciAP' id='Stil1'>";
			////echo"<form action='ucbris.php' method='post'>";
			if(mysql_num_rows($red)==0)
			echo"<center><i style='font-size:19;'>Svi registrovani učenici su aktivirani</i></center>";
			else{
			echo"<form action='ucenik' method='post'><table class='tabela'>
			<tr id='prvi_red'><td>ID</td><td>Username</td>
			<td>Ime i Prezime</td><td>Raz</td><td>Broj</td><td>Smjer</td><td>Nj-Fr</td>
			
			<td>✓ x</td></tr>";
			while($rcd=mysql_fetch_array($red)){
			//if($rcd['Etika']==1)
			$smsm=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$rcd['Smjer']."'"));
			$vjet=$smsm['Ime'];
			if($rcd['Fran']==1)
			$frnj="Fra";
			else $frnj="Nje";
			if($rcd['Admin']==1)
			$ad="Da";
			else $ad="";
			echo "<tr>
			<td id='prva_cell'>".$rcd['UserID']."</td>
			<td>".$rcd['Username']."</td>
			<td>";
			$turi=mysql_fetch_array(mysql_query("select * from Spisak where Broj='".$rcd['BrDn']."'"));
			echo $turi[$rcd['Razred']]."</td>
			<td>".$rcd['Razred']."</td>
			<td>".$rcd['BrDn']."</td>
			<td>".$vjet."</td>
			<td>".$frnj."</td>
			<td id='trfl'><span onclick='ajaxx(1,".$rcd['UserID'].")'>✓</span>&nbsp;<span onclick='ajaxx(0,".$rcd['UserID'].")'>x</span></td>";
/*			echo "
			<td align='center'>
			<input class='button2' type='submit' name='".$rcd['UserID']."' value='X'/></td>";*/
			
			
			}
		
			echo "</table><input type='hidden' name='rzz' value='".$_POST['nekipost']."'></form>";}
			
			echo"<div id='sviuc'><button class='button2' onclick='liax()'>Pregled svih učenika</button></div></div></div>";
			//echo "<center><h2>Dnevnik</h2></center>";
			//echo "<table border='1' style='color:#ffffff; width:550px;'><tr align='center'>
			//<td>Broj</td><td>Bos</td><td>Eng</td><td>Nje</td>
			//<td>Lat</td><td>Mat</td><td>Fiz</td><td>Inf</td><td>Tizo</td><td>Vje</td><td>Soc</td><td>Dem</td><td>Psi</td></tr>";
			//while($uc=mysql_fetch_array($dn))
			//echo "<tr align='center' style='color:#808080;'><td style='color:#00ff00;'>".$uc['Broj']."</td><td>".$uc['Bos']."</td><td>".$uc['Eng']."</td><td>".$uc['Nje']."</td>
			//<td>".$uc['Lat']."</td><td>".$uc['Mat']."</td><td>".$uc['Fiz']."</td><td>".$uc['Inf']."</td><td>".$uc['Tizo']."</td>
			//<td>".$uc['Vje']."</td><td>".$uc['Soc']."</td><td>".$uc['Dem']."</td><td>".$uc['Psi']."</td></tr>";
			
			
			//echo "</table></center>";
			echo"<div id='izmjene' style='display:none;'>
			<center><div class='ScrollbarUneseneOcjeneAP' id='Stil1'><table class='tabela'>
			<tr id='prvi_red'>
			<td>Br.</td><td>Profesor</td><td>Predmet</td><td style='min-width:80px;'>Datum</td><td>Ocjena</td><td>Br.</td><td>Raz</td><td>✖</td></tr>
			";
			$mki=mysql_query("select * from Izmjene order by RnBr desc");$nesto=false;$inkrem=0;
			while($redaa=mysql_fetch_array($mki))
			{
			$proff=mysql_query("select * from Profesori where RnBr='".$redaa['Prof']."'");
			$redaa2=mysql_fetch_array($proff);
			$pred=mysql_query("select * from Predmeti where RnBr='".$redaa['Predmet']."'");
			$redaa23=mysql_fetch_array($pred);
			
			$predmet=$redaa23['Predmet'];
			if($nesto==false)
			{echo"<tr style='text-align:center; color:#555;' id='redz".$redaa['RnBr']."'>";$nesto=true;}
			else
			{echo"<tr style='background-color:#ffe6df; text-align:center; color:#555;' id='redz".$redaa['RnBr']."'>";$nesto=false;}
			if($inkrem<2000)
			{
			echo"
			<td id='prva_cell' >".$redaa['RnBr']."</td><td><i>".$redaa2['Ime']." ".$redaa2['Prezime']."</i></td><td>".$predmet."</td>
			<td id='stil_ocjene'><b>".date("d.m",$redaa['Datum'])."</b><br>".date("d.m G:i",$redaa['Pravi'])."</td><td class='crveno'><b'>".$redaa['Ocjena']."</b></td><td ><i>".$redaa['Brojuc']."</i></td><td>".$redaa['Razred']."</td>
			<td style='color:red;cursor:pointer;' onClick='brisioc(".$redaa['RnBr'].");'>✖</td></tr>
			";$inkrem=$inkrem+1;}}
			echo"
			
			</table></div></center>		
			</div>
			<div id='vladanja' style='display:none;'>
			<center><div class='PromjeneVladanjaAP' id='Stil1'>
			<table class='tabela'>
			<tr id='prvi_red'>
			<td>Učenik</td><td>Razlog</td><td>Oc</td><td>Razz</td><td>Profesor</td><td>Datum</td></tr>
			";
			$vlado=mysql_query("select * from Vladanja order by ID desc");
			while($vlada=mysql_fetch_array($vlado))
			{			
					$josjednapromjenljiva=mysql_query("select * from Spisak where Broj='".$vlada['BrUc']."'");
					$josjed=mysql_fetch_array($josjednapromjenljiva);
					$kojiraz=$vlada['Razz'];
					$ucenjak=$josjed[$kojiraz];
					$josjednapromjenljiva2=mysql_query("select * from Profesori where RnBr='".$vlada['Prof']."'");
					$josjed2=mysql_fetch_array($josjednapromjenljiva2);
					$vasd=$josjed2['Ime']." ".$josjed2['Prezime'];
					echo"<tr>
					
					<td><i>".$ucenjak."</i></td>
					<td class='crveno'><b>".$vlada['Razlog']."</b></td>
					<td><b>".$vlada['Ocjena']."</b></td>
					<td>".$kojiraz."</td>
					<td><i>".$vasd."</i></td>
					<td>".$vlada['Datum']."</td>
					
					</tr>";
			
			}
			
			

			echo"</table></div></center>
			</div><div id='registracija_popup' title='Registracija učenika'>
					
					
					
					
					<center><h2>Registracija</h2><br><form action='http://".$_SERVER['HTTP_HOST']."/register' method='post'>
					<table class='regg'>
					<tr><td>Ime:</td><td><input type='text' name='ime' size='17'/></td></tr>
					<tr><td>Prezime:</td><td><input type='text' name='prezime' size='17'/></td></tr>
					<tr id='space'></tr>
					<tr><td>Username:</td><td><input type='text' name='user' size='17'/></td></tr>
					<tr><td>Password:</td><td><input type='password' name='pw' size='17'/></td></tr>
					<tr id='space'></tr>
					<tr><td>Broj u dnevniku:</td><td><select name='BrDn'><option value='0'></option>";
					for($i=1;$i<41;$i=$i+1)
					echo "<option value='".$i."'>".$i."</option>";
					echo"</select></td></tr>
					<tr><td>Razred:</td><td><select name='razred'><option value='0'></option>"; 
					$kuer2=mysql_query("select * from Razredi");
				//$majf3=mysql_fetch_array($kuer2);
				$brinc3=mysql_num_fields($kuer2);
				$kre3=1;
				while($kre3<$brinc3)
				{
					$kojir1=mysql_field_name($kuer2,$kre3);
					echo"<option value='".$kojir1."'>".$kojir1."</option>";
					$kre3=$kre3+1;
				}
					echo"</select></td></tr>
					<tr id='space'></tr><tr id='space'></tr><tr><td style='text-align:center;'><i style='font-size:14pt;'>Smjer:</i></td><td style='text-align:center;'><i style='font-size:14pt;'>Jezik:</i></td></tr><tr id='space'></tr>";
					$kuer243=mysql_query("select * from Smjerovi");
					$c=0;
					while($b=mysql_fetch_array($kuer243))
						{
							echo"
					<tr><td><input type='radio' name='smeer' value='".$b['ID']."' id='smee".$b['ID']."' style='position:absolute; left:-9999px;'><label for='smee".$b['ID']."'>".$b['Ime']."</label></td>";
					if($c==0)
						echo"<td><input type='radio' name='pred' value='0' id='njema' style='position:absolute; left:-9999px;'><label for='njema'>Njemački</label></td>";
					else if($c==1)
						echo"<td><input type='radio' name='pred' value='1' id='frana' style='position:absolute; left:-9999px;'><label for='frana'>Francuski</label></td>";
					else echo"<td></td>";
					echo"</tr>";
					
					$c++;
						}echo"</table>
					<br><br><input type='submit' class='button2' value='Registruj!'></form>
					</center>
					</div>
					<div id='stats' style='display:none;'><center><div class='StatistikaProfiAP' id='Stil1'>
					<form action='statistika' method='post'><table class='tabela'><tr id='prvi_red'>
					<td>ID</td><td>Ime i prezime</td><td>Danas</td><td>Mjesec</td></tr>";
					$rfd=mysql_query("select * from Profesori where Direktor='0' or Reg<1439040225");
					$mjss=0;
					$dnss=0;
					while($b=mysql_fetch_array($rfd))
					{
						//mktime(hour,minute,second,month,day,year,is_dst);
						$dan=mktime(0,0,0,date("m"),date("d"),date("Y"));//date("d");
						$mje=mktime(0,0,0,date("m"),1,date("Y"));//date("m");
						$y=mysql_query("select * from Izmjene where Prof='".$b['RnBr']."' and Datum>'".$mje."' and Zakljucna='0'");
						$mjes=mysql_num_rows($y);
						$x=mysql_query("select * from Izmjene where Prof='".$b['RnBr']."' and Datum>'".$dan."' and Zakljucna='0'");
						$dans=mysql_num_rows($x);
						
						$mjss=$mjss+$mjes;
						$dnss=$dnss+$dans;
						
						if($mjes==0)
						$mjes="";
						if($dans==0)
						$dans="";
						
						
					
						echo"<tr>
						
						<td id='prva_cell'><label for='zast".$b['RnBr']."'>".$b['RnBr']."</label></td>
						<td><label for='zast".$b['RnBr']."'><i>".$b['Ime']." ".$b['Prezime']."</i></label></td>
						<td class='crveno'><label for='zast".$b['RnBr']."'>".$dans."</label></td>
						<td class='crveno'><label for='zast".$b['RnBr']."'>".$mjes."</label></td>
						</tr>
						
						
						<button type='submit' id='zast".$b['RnBr']."' name='zast' value='".$b['RnBr']."' 
						style='position:absolute; left:-9999px;'>aa</button>";
					}
					echo"
					<tr style='height:10px;'><td colspan='4' style='height:10px; border:none; background:none;'></td></tr>
					<tr><td id='prva_cell'>Σ</td><td>Suma</td><td class='crveno'>".$dnss."</td><td class='crveno'>".$mjss."</td></tr></table></form></div></center></div>";
			echo"<br>";
			}
		?>
		<?php include("ftincld.php");?>
	</body>
</html>