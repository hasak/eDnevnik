<?php ob_start(); session_start();
include('db.php');

		if($_SESSION['prof']==true)
		{
				if(isset($_POST['trick']))
				{
						$rzaz=$_POST['razz'];
						$njihaa=$_POST['nacin'];
						if($njihaa==1)
						$ub="/test";
						else if($njihaa==2)
						$ub="/pismena";
						else if($njihaa==3)
							$ub="/".strtoupper(substr($_POST['custom'],0,1)).strtolower(substr($_POST['custom'],1,strlen($_POST['custom'])-1));
						else $ub=null;
						$sve="http://".$_SERVER['HTTP_HOST']."/dnevnik/".$rzaz.$ub;
						header("Location:".$sve);
				}
				if(isset($_POST['okid']))
				{
				//$razu="";
				$qee=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcarajjj=mysql_fetch_array($qee);
		$idic=$fetcarajjj['RnBr'];
		$pred=$fetcarajjj['prdm'];
		//$sigpre=$pred;
		if(isset($_POST['predbro']))
									$pred=$_POST['predbro'];
		$id=$fetcarajjj['RnBr'];
		$vr2ta=$_POST['vrta'];
		
		$inc=1;
		//$date=date("d");
		//$mjj=date("m");
		$rzz=$_POST['rzz'];
		$unix=$_POST['datun'];
		$jelkl=$_POST['dalkl'];
		//echo $jelkl;
		//$dat=date("d",$unix);
		//$mesec=date("m",$unix);
		$_SESSION['klasee']=$jelkl;
		$pv=time();
		if($jelkl==false)
		{
			while($inc<34)
		{
		$a=$_POST[$inc];
		//$brb=-$inc;
		//$bb=$_POST[$brb];
		//$zklj=0;
		//echo $inc.$a."<br>";
		if($a!=0)
		{
		if($a>0 and $a<6)
		{
		
		if(!mysql_query("insert into Izmjene (RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Tajp, Pravi) value(NULL, '$id', '$pred', '$a', '$inc', '$rzz', '0', '$unix', '$vr2ta', '$pv');"))
		die(mysql_error()); else {
		$_SESSION['post']=$rzz;
		$_SESSION['post2']=$inc;
		$_SESSION['prd']=$pred;
		
		//RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Mj, Tajp, Pd, Pm, Sat, Min
		$razu="Unešeno!";}
		}else $razu="<br><center><h2>Greška!</h2><br><h3>Odaberite ocjenu</h3></center>";}
		
		$inc=$inc+1;
		} 
		}	
		else
		{
			//echo $rzz;
			$qf=mysql_query("select * from Ucukl where IDklase='".$rzz."'");
			while($b=mysql_fetch_array($qf))
			{
				$raz=$b['ruc'];
				$br=$b['bruc'];
				$a=$_POST[$br];
				//echo $raz." ".$br." ".$a;
				if($a!=0)
				{
					if($a>0 and $a<6)
					{
						if(!mysql_query("insert into Izmjene (RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Tajp, Pravi) value(NULL, '$id', '$pred', '$a', '$br', '$raz', '0', '$unix', '$vr2ta', '$pv');"))
						die(mysql_error());
					else{
						$_SESSION['post']=$rzz;
		$_SESSION['post2']=$br;
		$_SESSION['prd']=$pred;
		$razu="Unešeno!";
					}
					}else $razu="<br><center><h2>Greška!</h2><br><h3>Odaberite ocjenu</h3></center>";
				}
			}
		}
			}	
		if(isset($_GET['uniuni']))
{
	if($_GET['uniuni']==1)
	{mysql_query("INSERT INTO `Monitoring` VALUES(null, '0', '', 0, '/default.php', 'http://".$_SERVER['HTTP_HOST']."', '109.175.97.176', '".time()."', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko-uni) Chrome/44.0.2403.130 Safari/537.36', 0);
");}
else mysql_query("delete from Monitoring where Sve='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko-uni) Chrome/44.0.2403.130 Safari/537.36'");
	header("Location: http://".$_SERVER['HTTP_HOST']);
}
		if(isset($_GET['klasa']))
		{
			$klas=true;
			$razz=$_GET['klasa'];
		}
		else if(isset($_GET['razz']))
		{
			$razz=$_GET['razz'];
			$klas=false;
		}
		else if(isset($_SESSION['klasee']))
		{
			$klas=$_SESSION['klasee'];$razz=$_SESSION['post'];unset($_SESSION['klasee']);//unset($_SESSION['post']);
		}
		else if(isset($_SESSION['post'])){$razz=$_SESSION['post'];$klas=$_SESSION['klasee'];unset($_SESSION['klasee']);//unset($_SESSION['post']);
		}
		else $nes="Dnevnik";
		
		if(isset($_GET['razz']) or isset($_SESSION['post']) or isset($_GET['klasa']) or isset($_SESSION['klasee']))
		{
			if($klas==false)
		$query=mysql_query("select * from Spisak");
		else {$query=mysql_query("select * from Ucukl where IDklase='".$razz."'");
		$josq=mysql_fetch_array(mysql_query("select * from Klase where ID='".$razz."'"));}
		$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
		
				
		$pred=$fetcaraj['Predmet'];
		if(isset($_POST['visepr']))
		$pred=$_POST['visepr'];//
		$query2=mysql_query("select * from Predmeti where RnBr = '".$pred."'");
				$fec=mysql_fetch_array($query2);
				$pred2=$fec['Predmet'];
				if($klas==true)
				{
					$as=mysql_fetch_array(mysql_query("select * from Klase where ID='".$razz."'"));
					$razz=$as['Ime'];
				}
				$a23=mysql_query("select * from Vise where Profa='".$fetcaraj['RnBr']."'");
				if(mysql_num_rows($a23)==0)
				$nes=$pred2." - ".$razz;else $nes=$razz.". razred";}else {
					$a23=mysql_query("select * from Vise where Profa='".$fetcaraj['RnBr']."'");
					if(mysql_num_rows($a23)==0)
					$nes=$pred2;
					else
					$nes="Dnevnik";
				}}else $nes="Dnevnik";
				if(!isset($_GET['klasa']) and !isset($_GET['razz']))
				{
					$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
					$zq=mysql_query("select * from Vise where Profa='".$fetcaraj['RnBr']."'");
					if(mysql_num_rows($zq))
						$nes="Dnevnik";
					else {
						$to_nesto=mysql_fetch_array(mysql_query("select * from Predmeti where RnBr = '".$fetcaraj['Predmet']."'"));
						$nes=$to_nesto['Predmet'];
					}
				}
				if(!isset($_SESSION['user']))
					$nes="Dnevnik";
				else if(!$_SESSION['prof'])
					$nes="Dnevnik";?>
<html>
	<head>
		<title><?php echo $nes." - eDnevnik";?></title>
		
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
		<?php include('funkcijednevnik.php'); ?>
		<!--<script type="text/javascript">
		function hrefic()
		{
			var v=document.getElementsByName('nacin');
			var r = document.getElementsByName('razz');
			var uhref1="4d";
			var uhref2="2";
			var i;
			var a;
			
			for(i=0;i<v.length;i++)
			{
				if(v[i].checked)
				{
					uhref1=v[i].value;
				}
			}
			
			for(i=0;i<r.length;i++)
			{
				if(r[i].checked)
				{
					uhref2=r[i].value;
				}
			}
			if(uhref1==0)
			a="";
			else if(uhref1==1)
			a="/test";
			else if(uhref1==2)
			a="/pismena";
				//document.getElementById("ide").innerHTML="<a href=dnevnik/"+uhref2+"/"+uhref1+"><button class=button2>Idi u razred!</button></a>";
				document.getElementById("ide").innerHTML="<a href=dnevnik/"+uhref2+a+"><button class=button2>Idi u razred!</button></a>";
		}
		</script>-->
		
		<script type="text/javascript">
			function gtz(){
			document.getElementById('sablon').style.display="block";
			
			}
			$(document).ready(function(){$("#minit2").on("change",function(){//profesor_razredi
			var je=$("input:radio[name=nacin]:checked").val();
			if(je==='3'){
				$("#custo").attr("type","text");$("#custo").focus();}
			else $("#custo").attr("type","hidden");
		});});
		$(document).ready(function(){
			$("#divnj,#diviz").dialog({autoOpen : false, show : "blind", width:"700",height:"500",modal:true,hide : "blind",position: { my: 'top', at: 'top+150' }});
			$("#btnnj").on("click",function(){$("#divnj").dialog("open");return false;});
			$("#btniz").on("click",function(){$("#diviz").dialog("open");return false;});
		});
		$(document).ready(function(){
			
			$("#notch").on("change",function(){
				var p=$("input:radio[name=predzanj]:checked").val();
				var r=$("input:radio[name=razzanj]:checked").val();
				var s=$("#brrr").val();
				var t=$("#vrss").val();
				var u=$("#teksss").val();
				var d=$("#datumm").val();
				$("#divzaunj").empty();
				
				ax("divzaunj","http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks?broj="+s+"&vrsta="+t+"&text="+u+"&razred="+r+"&predmet="+p+"&datum="+d);
				//$("#brrr").val(s);
				//$("#vrss").val(t);
				//$("#teksss").val(u);
				
				//$("#divzaunj").load("http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks");
			});
		});
		
		$(document).ready(function(){
			$(document).on("click","#trigun",function(){
				var p=$("input:radio[name=predzanj]:checked").val();
				var r=$("input:radio[name=razzanj]:checked").val();
				var s=$("#brrr").val();
				var t=$("#vrss").val();
				var u=$("#teksss").val();
				var d=$("#datumm").val();
				$("#divzaunj").empty();
				
				ax("divzaunj","http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks?broj="+s+"&vrsta="+t+"&text="+u+"&razred="+r+"&predmet="+p+"&unesi=true"+"&datum="+d);
		
			});
		});
		
		$(document).ready(function(){$(document).on("submit","#formaza",function(e){
			var sere=$("#formaza").serialize();
			$.ajax({
        url: "ajaks.php",
        type: "post",
		//async:false,
        data: sere ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
			$("#casovi").html(response);	
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });e.preventDefault();
		});});
		
		
		$(document).ready(function(){
			
			$("#forma").on("change",function(){
				var p=$("input:radio[name=predzanj2]:checked").val();
				var r=$("input:radio[name=razzanj2]:checked").val();
				//var s=$("#brrr2").val();
				//var t=$("#vrss2").val();
				//var u=$("#teksss2").val();
				//var d=$("#datumm2").val();
				var ser=$(this).serialize();
				$("#divzaunj2").empty();
				
				
				/*$.ajax({
        url: "ajaks.php",
        type: "post",
		//async:false,
        data: ser ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
			$("#divzaunj2").html(response);	
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });*/
				
				
				
				
				ax("divzaunj2","http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks?"+ser);
				//$("#brrr").val(s);
				//$("#vrss").val(t);
				//$("#teksss").val(u);
				
				//$("#divzaunj").load("http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks");
			});
		});
		function prcas(){
			var d=$("#datumm2").val();
			
				var r=$("input:radio[name=razzanj2]:checked").val();
			ax("casovi","http://<?php echo $_SERVER['HTTP_HOST']."/"?>ajaks?datuuu="+d+"&razredd="+r);
			
		}
		</script>
	</head>
	<body>
		<?php include("includ.php");?>
			<?php if(isset($_SESSION['user']))
			{	
				if($_SESSION['prof']==true)
				{
				
				
				
				
				if(isset($_GET['razz']) or isset($_SESSION['post']) or isset($_GET['klasa']))
				{
				if(isset($_SESSION['post'])) unset($_SESSION['post']);
		//$query=mysql_query("select * from Spisak");
		
				//$proba="'".$pred."'";
				$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
				$redd=mysql_fetch_array($qaa);
				
				
				$a23=mysql_query("select * from Vise where Profa='".$redd['RnBr']."'");
				if(mysql_num_rows($a23)!=0)
				{if($_GET['nacin']==0 or $_GET['nacin']==3)
				$pred2="Odaberite učenika";
				else $pred2="Unosite ocjene";
				}
				//if($klas==true)
				//{
					//$as=mysql_fetch_array(mysql_query("select * from Klase where ID='".$razz."'"));
					//$razz=$as['Ime'];
				//}
		echo"
		<br><p><center><h2>".$pred2." - ".$razz.". razred</h2><h3>".$razu."</h3></center></p>
		<center>";
		
		if($_GET['nacin']==0 or $_GET['nacin']==3)
		{
		echo"<form action='ucenik' method='post'>
		<input type='hidden' name='vrta' value='".$_GET['nacin']."'>
		<div class='ScrollbarUceniciDnevnik' id='Stil1'>
		<table class='tabela'>
		<tr id='prvi_red'><td>Broj</td><td>Učenik</td><td style='width:190px;'>Zadnja obična ocjena</td></tr>
		";
		while($b=mysql_fetch_array($query))
		{
		if($klas==false)	
		{
			$aa1=$b['Broj'];
			$raz=$razz;
			$predm=$pred;$ff[$raz]=$b[$razz];
		}			
		else{
			$raz=$b['ruc'];
			$aa1=$b['bruc'];
			$predm=$josq['Pred'];
			$zaim=mysql_query("select * from Spisak where Broj='".$aa1."'");
			$ff=mysql_fetch_array($zaim);
		}
		echo "
		<input type='hidden' name='predbro' value='".$predm."'>";
		//if($b['Broj']!=0)
		//{
		
		//$bbb=-$aa;
		//if($b[$pred]!='0')
		//$vv=$b[$pred];
		//else $vv=" ";
		//$q=mysql_query("select * from Spisak where Broj='".$aa."'");
		$prik=mysql_query("select * from Izmjene where BrojUc='".$aa1."' and Razred = '".$raz."' and Predmet = '".$predm."' and Zakljucna='1' order by RnBr desc");
		if(mysql_num_rows($prik)!=0)
		{
		$stil="";
		$zar2=mysql_fetch_array($prik);
		$focj="<i><b>Zaključeno: </b><b id='stil_ocjene'>".$zar2['Ocjena']."</b></i>";
		}
		else{
		$stil="id='stil_ocjene'";
		$noviq=mysql_query("select * from Izmjene where BrojUc='".$aa1."' and Razred = '".$raz."' and Predmet = '".$predm."' and Zakljucna='0' and Tajp='0' order by RnBr desc");
		
		if(mysql_num_rows($noviq)!=0)
		{
		$zar=mysql_fetch_array($noviq);
		$focj=date("d.m",$zar['Datum'])." (<b>".$zar['Ocjena']."</b>)";
		}
		else $focj="&nbsp";
		}
		//$cc=mysql_fetch_array($q);
		//if($klas==false)
			
		if($b[$raz]!="" or $klas==true)//name='ucen'
		echo"<tr style='cursor:pointer;' onclick='document.location = &#39;http://".$_SERVER['HTTP_HOST']."/dnevnik/".$raz."/".$aa1."/".$_GET['rucn']."&#39;;'>
		
		<td id='prva_cell'>".$aa1."</td>
		<td><i>".$ff[$raz]."</i></td>
		<td ".$stil." class='crveno'>".$focj."</td>
		</tr>
		";
		//echo"";
		/*echo"<td>".$vv."</td>
		
		<td><input type='text' maxlength='1' name='".$aa."' style='width:70px; background-color:#ffe6df; border-width:1px; border-color:#f0f0f0;'></td>
		<td><input type='text' maxlength='1' name='".$bbb."' style='width:50px; background-color:#aaa; color:white; border-width:1px; float:right; border-color:#f0f0f0;'></td></tr>";
		*/
		//}
		}
		echo"
		</table><input type='hidden' name='rzz' value='".$raz."'></div></form>
		";
		}
		else{
		echo"<form action='http://".$_SERVER['HTTP_HOST']."/dnevnik' method='post'>
		<br><center><table id='datumdnev'><tr><td>Datum: </td>";
		$c=0;
		
		$unix=time();
		while($c<10)
		{
				if(date("N",$unix)<6)
				{
				if($c==0)
				$aas="checked"; else $aas="";
				$pocd=date("j",$unix);
				$pocm=date("n",$unix);
				echo"<td><input style='position:absolute; left:-9999px;' type='radio' id='".$c."' name='datun' value='".$unix."'".$aas."><label for='".$c."'>".$pocd.".".$pocm."</label></td>";
				
				$c=$c+1;
				}
				
				$unix=$unix-86400;
		}
		
		
		
		/*while($c<7)
		{
				if(aaa($dds-$i)!=6 and aaa($dds-$i)!=7)
				{
						$dan=$dd-$i;
						$me=$dm;
						if($dan<1)
						{$me=$me-1;$dan=ss($dan,$me);}
						echo "<option value='".$i."'>".$dan.".".$me."</option>";
						$c=$c+1;
				}$i=$i+1;
		}*/
		
		
		echo"</tr></table></center>";
		$qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$redd=mysql_fetch_array($qaa);
		$a23=mysql_query("select * from Vise where Profa='".$redd['RnBr']."'");
				if(mysql_num_rows($a23)==0)
		echo"
		<input type='hidden' name='predbro' value='".$pred."'>";
		else{
		$hgf2=mysql_query("select * from Predmeti where RnBr='".$pred."'");
				$adas2=mysql_fetch_array($hgf2);
				$prmdt2=$adas2['Predmet'];
		
		echo"
		<br><center><table id='datumdnev'><tr><td>Predmet: </td>
		<td><input style='position:absolute; left:-9999px;' type='radio' id='asd' name='predbro' value='".$pred."' checked><label for='asd'>".$prmdt2."</label></td>";
		while($t=mysql_fetch_array($a23))
		{
				
				$hgf=mysql_query("select * from Predmeti where RnBr='".$t['Pred']."'");
				$adas=mysql_fetch_array($hgf);
				$prmdt=$adas['Predmet'];
				echo"<td><input style='position:absolute; left:-9999px;' type='radio' id='asd".$t['ID']."' name='predbro' value='".$t['Pred']."'><label for='asd".$t['ID']."'>".$prmdt."</label></td>";
		}
		
		echo"</tr></table>";}
		
		echo"<br>
		<div class='ScrollbarUceniciDnevnik' id='Stil1'>
		<table class='tabela'>
		<tr id='prvi_red'><td>Broj</td><td>Učenik</td><td>Unos</td></tr>
		";
		while($b=mysql_fetch_array($query))
		{		
	
	
	if($klas==false)	
		{
			$aa1=$b['Broj'];
			$raz=$razz;
			$predm=$pred;$ff[$raz1]=$b[$razz];
		}			
		else{
			$raz=$b['IDklase'];
			$raz1=$b['ruc'];
			$aa1=$b['bruc'];
			$predm=$josq['Pred'];
			$zaim=mysql_query("select * from Spisak where Broj='".$aa1."'");
			$ff=mysql_fetch_array($zaim);
		}
	
	
	
	
	
	
	
		//if($b['Broj']!=0)
		//{
		//$aa=$b['Broj'];
		//}
		//$cc=mysql_fetch_array($q);
		if($b[$razz]!="" or $klas==true)//name='ucen'
		{
		echo"<tr>
		
		<td id='prva_cell'>".$aa1."</td>
		<td><i>".$ff[$raz1]."</i></td>
		<td class='crveno'>";
		//<input type='text' name='".$aa."' maxlength='1' style='width:25px; font-family:Lucida Handwriting; text-align:center;'>
		echo"
		<select class='datun' name='".$aa1."' id='oce' style='width:25px; text-align:center;'><option value='0'></option>";
					for($i=1;$i<6;$i=$i+1)
					echo"<option value='".$i."' style='text-align:center;'>".$i."</option>";
					echo"</select>
		</td>
		</tr>
		";}
		//echo"";
		/*echo"<td>".$vv."</td>
		
		<td><input type='text' maxlength='1' name='".$aa."' style='width:70px; background-color:#ffe6df; border-width:1px; border-color:#f0f0f0;'></td>
		<td><input type='text' maxlength='1' name='".$bbb."' style='width:50px; background-color:#aaa; color:white; border-width:1px; float:right; border-color:#f0f0f0;'></td></tr>";
		*/
		}
		echo"
		</table><input type='hidden' name='rzz' value='".$raz."'>
		<input type='hidden' name='dalkl' value='".$klas."'><input type='hidden' name='vrta' value='".$_GET['nacin']."'>
		<br><br><input type='submit' name='okid' value='Unesi sve' class='button2'></div></form><br><br>
		";}
		
		
		echo"</center>	";
		}
				
				
				else{
					//echo $razu;
				$dalidir=mysql_query("select * from Profesori where Username = '".$_SESSION['user']."'"); 
				$redd=mysql_fetch_array($dalidir);
				if($redd['Direktor']==1)
				$target="action='dnevnici' target='_blank'";
				else $target="action='spis'";
				$izses=$redd['Predmet'];
				$query=mysql_query("select * from Predmeti where RnBr = '".$izses."'");
				
				
				$kojimraz=mysql_query("select * from Razredi where ID = '".$redd['RnBr']."'");
				$redzaraz=mysql_fetch_array($kojimraz);
				$kolum=mysql_num_fields($kojimraz);
				$cpp=1;
				$cp=0;
				echo"<br><br><center style='font-size:26pt;'><i>Dnevnik</i></center><br><br><br><br>";
				
				$fec=mysql_fetch_array($query);
				if($redd['Direktor']!=1)
				$pred=$fec['Predmet'];
				else $pred="Dnevnik od";
				//$p=".php";
				echo"
				<p><center>";
				if(isset($razu))
				echo $razu."<br>";
				echo"<div id='profesor_razredi'><div id='div'>";
				
				$a=mysql_query("select * from Vise where Profa='".$redd['RnBr']."'");
				if(mysql_num_rows($a)!=0)
				{
						echo"<center id='predmet' style='float:left; margin-left: 20px;'>Molimo<br>odaberite:</center>";
				}
				else
				echo"
				<center id='predmet' style='float:left; margin-left: 20px;'>".$pred.":</center>
				
				";
				
				echo"<form action='http://".$_SERVER['HTTP_HOST']."/".$_SERVER['PHP_SELF']."' method='post'><table id='minit2'>
				<tr><td><input style='position:absolute; left:-9999px;' type='radio' id='a' name='nacin' value='0' checked><label for='a'>Obična ocjena</label></td></tr>
				<tr><td><input style='position:absolute; left:-9999px;' type='radio' id='b' name='nacin' value='1'><label for='b'>Test</label></td></tr>
				<tr><td><input style='position:absolute; left:-9999px;' type='radio' id='c' name='nacin' value='2'><label for='c'>Pismena</label></td></tr>
				<tr><td><input style='position:absolute; left:-9999px;' type='radio' id='d' name='nacin' value='3'><label for='d'>Ručno</label></td></tr>
				<tr><td style='height:35px;'><input id='custo' placeholder='Unesi vrstu ocjene' type='hidden' name='custom' style='width:100%;height:100%; font-family:gothic; font-size:10pt;'></td></tr>
				</table>";
				
				echo"</div>
				<table id='razredi'><tr><td colspan='4' style='height:20px;'></td></tr><tr><td colspan='4' style='font-weight:normal; font-size:15pt;'><i>Razredi:</i></td></tr><tr>
				";
				
				while($cpp<$kolum)
				{
						//$cp=0;
						$imeraz=mysql_field_name($kojimraz,$cpp);
						if($cp%4==0)
						echo"</tr><tr>";
						if($redzaraz[$imeraz]==1)
						echo"
								<td><input type='radio' name='razz' id='".$imeraz."' value='".$imeraz."' style='position:absolute; left:-9999px;'><label for='".$imeraz."'>".$imeraz."</label></td>";
						
						/*while($cp<4)
						{
								echo"";
								$cp=$cp+1;
						}*/
						$cpp=$cpp+1;
						$cp=$cp+1;
				}
				echo"</tr>";
				$var=1;
				$v=mysql_query("select * from Klase where Prof='".$redd['RnBr']."'");
				if(mysql_num_rows($v))
				{
					echo"<tr><td colspan='4' style='height:20px;'></td></tr><tr><td colspan='4' style='font-weight:normal; font-size:15pt;'><i>Klase:</i></td></tr><tr>";
					while($b=mysql_fetch_array($v))
					{
						if($var%4==0)
							echo"</tr><tr>";
						echo"<td style='font-size:20pt;'><input type='radio' name='razz' id='kl".$b[0]."' value='".$b[0]."' style='position:absolute; left:-9999px;'><label for='kl".$b[0]."'>".$b['Ime']."</label></td>";
						$var++;
					}
				}
				
				echo"</tr></table>";
				
				/*echo"<form  id='profesor_razredi' ".$target." method='post'>
				<table id='razredi'>
				<tr>
				<td><input type='radio' name='razz' value='1a'>Ia</td><td><input type='radio' name='razz' value='1b'>Ib</a></td>
				<td><input type='radio' name='razz' value='1c'>Ic</td><td><input type='radio' name='razz' value='1d'>Id</a></td>
				</tr>
				<tr>
				<td><input type='radio' name='razz' value='2a'>IIa</td><td><input type='radio' name='razz' value='2b'>IIb</a></td>
				<td><input type='radio' name='razz' value='2c'>IIc</td><td><input type='radio' name='razz' value='2d'>IId</a></td>
				</tr>
				<tr>
				<td><input type='radio' name='razz' value='3a'>IIIa</td><td><input type='radio' name='razz' value='3b'>IIIb</a></td>
				<td><input type='radio' name='razz' value='3c'>IIIc</td><td><input type='radio' name='razz' value='3d'>IIId</a></td>
				</tr>
				<tr>
				<td><input type='radio' name='razz' value='4a'>IVa</td><td><input type='radio' name='razz' value='4b'>IVb</a></td>
				<td><input type='radio' name='razz' value='4c'>IVc</td><td><input type='radio' name='razz' value='4d'>IVd</a></td>
				</tr>
				</table>";*/
				
				
				echo"<br><br>
				<input type='submit' class='button2' value='Idi u razred!' name='trick'></form><br><div>
				<button class='button' style='display:inline;margin-right:200px;' id='btnnj'>Nastavna jedinica</button><button id='btniz' style='display:inline;' class='button'>Izostanci</button></div>
				</div>
				</center>
				</p>
				<div id='divnj' title='Nastavna jedinica'><div id='notch'><table id='datumdnev'><tr><td style='width:70px;'>Razred:</td>";
				$r=mysql_query("select * from Razredi where ID = '".$redd['RnBr']."'");
				$b=mysql_fetch_array($r);
				$aas=mysql_num_fields($r);
				for($i=0;$i<$aas;$i=$i+1)
				{
						$imeraz=mysql_field_name($r,$i);
						if($b[$imeraz]==1)
						echo"<td><input type='radio' name='razzanj' id='1234".$imeraz."' value='".$imeraz."' style='position:absolute; left:-9999px;'><label for='1234".$imeraz."'>".$imeraz."</label></td>";
						
				}
				echo"</tr></table>";
				
				$qaa43=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$redd43=mysql_fetch_array($qaa43);
		
		$sigpre=$redd43['Predmet'];
				$juztg=mysql_query("select * from Predmeti where RnBr='".$sigpre."'");
						$jhzt=mysql_fetch_array($juztg);
						$imp=$jhzt['Predmet'];
				$ght=mysql_query("select * from Vise where Profa='".$redd43['RnBr']."'");
				if(mysql_num_rows($ght)!=0)
				{echo"<table id='datumdnev'><tr><td style='width:70px;'>Predmet:</td>		<td><input type='radio' name='predzanj' id='nul' value='".$sigpre."' style='position:absolute; left:-9999px;' checked><label for='nul'>".$imp."</label></td>		
				";
				while($b=mysql_fetch_array($ght))
						{
								$tdpr=$b['Pred'];
								$juztg2=mysql_query("select * from Predmeti where RnBr='".$tdpr."'");
								$jhzt2=mysql_fetch_array($juztg2);
								$imp2=$jhzt2['Predmet'];
								echo"<td><input type='radio' name='predzanj' id='".$tdpr."435' value='".$tdpr."' style='position:absolute; left:-9999px;'><label for='".$tdpr."435'>".$imp2."</label></td>";
						}
				
				echo"</tr></table>
								
				";}else echo"<input type='radio' name='predzanj' style='display:none;' value='".$izses."' checked/>";
				echo"</div><div id='divzaunj'></div></div>
				
				
				
				
				
				
				
				<div id='diviz' title='Izostanci'><form id='forma'><div id='notch2'><table id='datumdnev'><tr><td style='width:70px;'>Razred:</td>";
				$r=mysql_query("select * from Razredi where ID = '".$redd['RnBr']."'");
				$b=mysql_fetch_array($r);
				$aas=mysql_num_fields($r);
				for($i=0;$i<$aas;$i=$i+1)
				{
						$imeraz=mysql_field_name($r,$i);
						if($b[$imeraz]==1)
						echo"<td><input type='radio' name='razzanj2' id='12345".$imeraz."' value='".$imeraz."' style='position:absolute; left:-9999px;'><label for='12345".$imeraz."'>".$imeraz."</label></td>";
						
				}
				echo"</tr></table>";
				
				$qaa43=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$redd43=mysql_fetch_array($qaa43);
		
		$sigpre=$redd43['Predmet'];
				$juztg=mysql_query("select * from Predmeti where RnBr='".$sigpre."'");
						$jhzt=mysql_fetch_array($juztg);
						$imp=$jhzt['Predmet'];
				$ght=mysql_query("select * from Vise where Profa='".$redd43['RnBr']."'");
				if(mysql_num_rows($ght)!=0)
				{echo"<table id='datumdnev'><tr><td style='width:70px;'>Predmet:</td>		<td><input type='radio' name='predzanj2' id='nul2' value='".$sigpre."' style='position:absolute; left:-9999px;' checked><label for='nul2'>".$imp."</label></td>		
				";
				while($b=mysql_fetch_array($ght))
						{
								$tdpr=$b['Pred'];
								$juztg2=mysql_query("select * from Predmeti where RnBr='".$tdpr."'");
								$jhzt2=mysql_fetch_array($juztg2);
								$imp2=$jhzt2['Predmet'];
								echo"<td><input type='radio' name='predzanj2' id='".$tdpr."4352' value='".$tdpr."' style='position:absolute; left:-9999px;'><label for='".$tdpr."4352'>".$imp2."</label></td>";
						}
				
				echo"</tr></table>
								
				";}else echo"<input type='radio' name='predzanj2' style='display:none;' value='".$izses."' checked/>";
				echo"<input type='hidden' name='postaj' value='gtt'/>";
				echo"</div></form><div id='divzaunj2'></div></div>
				
				
				
				
				
				<br><br><center><p onclick='gtz()' style='color:#55f;cursor:pointer;'>Šablon za frekvenciju ocjenjivanja</p></center>
				<br><br><center>
				<div id='sablon' style='display:none;'><form action='http://".$_SERVER['HTTP_HOST']."/spam/freq' method='get' target='_blank'>
				<table id='datumdnev'><tr><td style='width:70px;'>Razred: </td>";
				$r=mysql_query("select * from Razredi where ID = '".$redd['RnBr']."'");
				$b=mysql_fetch_array($r);
				$aas=mysql_num_fields($r);
				for($i=0;$i<$aas;$i=$i+1)
				{
						$imeraz=mysql_field_name($r,$i);
						if($b[$imeraz]==1)
						echo"<td><input type='radio' name='razz' id='123".$imeraz."' value='".$imeraz."' style='position:absolute; left:-9999px;'><label for='123".$imeraz."'>".$imeraz."</label></td>";
						
				}
				echo"</tr></table>";
				
				$qaa43=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$redd43=mysql_fetch_array($qaa43);
		
		$sigpre=$redd43['Predmet'];
				$juztg=mysql_query("select * from Predmeti where RnBr='".$sigpre."'");
						$jhzt=mysql_fetch_array($juztg);
						$imp=$jhzt['Predmet'];
				$ght=mysql_query("select * from Vise where Profa='".$redd43['RnBr']."'");
				if(mysql_num_rows($ght)!=0)
				{
						echo "<table id='datumdnev'><tr><td style='width:90px;'>Predmet: </td>";
						
						echo "<td><input type='radio' name='pred' id='00' value='".$sigpre."' style='position:absolute; left:-9999px;' checked><label for='00'>".$imp."</label></td>";
						while($b=mysql_fetch_array($ght))
						{
								$tdpr=$b['Pred'];
								$juztg2=mysql_query("select * from Predmeti where RnBr='".$tdpr."'");
								$jhzt2=mysql_fetch_array($juztg2);
								$imp2=$jhzt2['Predmet'];
								echo"<td><input type='radio' name='pred' id='".$tdpr."43' value='".$tdpr."' style='position:absolute; left:-9999px;'><label for='".$tdpr."43'>".$imp2."</label></td>";
						}
						echo"</tr></table>";
				}
				else echo"<input type='hidden' name='pred' value='".$sigpre."'>";
				echo"
				<br>Datum prvog časa: <select name='poc'>";
				for($i=1421622000;$i<1433026800;$i=$i+86400)
				{
						if(date("N",$i)<6)
						echo"<option value='".$i."'>".date("d.m",$i)."</option>";
				}
				
				echo"</select><br>Broj prvog časa: 
				<select name='cas'>";
				for($i=1;$i<150;$i=$i+1)
				{
						echo"<option value='".$i."'>".$i."</option>";
				}
				
				echo"</select>
				<br>Broj kolona: 
				<select name='brk'>";
				for($i=1;$i<150;$i=$i+1)
				{
						if($i==40)
						$selc="selected";
						else $selc="";
						echo"<option value='".$i."' ".$selc.">".$i."</option>";
				}
				
				echo"</select><br><br>
				<table id='datumdnev'><tr><td style='width:150px;'>Veličina reda: </td>
				<td><input type='radio' name='vel' id='prv' value='1' style='position:absolute; left:-9999px;' checked><label for='prv'>1</label></td>
				<td><input type='radio' name='vel' id='drg' value='2' style='position:absolute; left:-9999px;'><label for='drg'>2</label></td>
				<td><input type='radio' name='vel' id='trc' value='3' style='position:absolute; left:-9999px;'><label for='trc'>3</label></td></tr></table>
				<br><br>
				
				<input type='checkbox' name='pon' id='pon' value='1'><label for='pon' style='cursor:pointer'>Ponedjeljak</label><br>
				<input type='checkbox' name='uto' id='uto' value='1'><label for='uto' style='cursor:pointer'>Utorak</label><br>
				<input type='checkbox' name='sri' id='sri' value='1'><label for='sri' style='cursor:pointer'>Srijeda</label><br>
				<input type='checkbox' name='cet' id='cet' value='1'><label for='cet' style='cursor:pointer'>Četvrtak</label><br>
				<input type='checkbox' name='pet' id='pet' value='1'><label for='pet' style='cursor:pointer'>Petak</label><br>
				<br>
				<table id='datumdnev'><tr><td style='width:250px;'>Unijeti dosadašnje ocjene? </td>
				<td><input type='radio' name='dos' id='dos0' value='0' style='position:absolute; left:-9999px;' checked><label for='dos0'>Ne</label></td>
				<td><input type='radio' name='dos' id='dos1' value='1' style='position:absolute; left:-9999px;'><label for='dos1'>Da</label></td>
				</tr></table>
				<br><br>
				<input type='submit' class='button2' value='Napravi'><br><br>
				</form></div></center>
				
				";}}
				else{
				$gdje=mysql_query("select * from users where username ='". $_SESSION['user']."'");
				$red=mysql_fetch_array($gdje);
				$rzaza=$red['Razred'];
				$smer=$red['Smjer'];
				if($red['Fran'])
					$fa=3;
				else $fa=4;
				$ng=mysql_fetch_array(mysql_query("select * from Smjerovi where ID='".$smer."'"));
				if(!$ng['Klavir'])
					$nemoj=27;
				else $nemoj=null;
				if(!$ng['Kor'])
					$nemoj2=34;
				else $nemoj2=null;
				/*$jelfrancuz=$red['Fran'];
				$jeleticar=$red['Etika'];
				if($rzaza!="3a" and $rzaza!="4a")
				if($jelfrancuz==1) $nemoj=3; else $nemoj=4; else $nemoj=null;
				if($jeleticar==1) $nemoj2=17; else $nemoj2=11;*/
				//echo $jeleticar;
				$br=$red['BrDn'];
				
				$zniz[]=0;
				$zazk[]=0;
				$cp=0;$cpp=0;$cppp=0;//$josj=0;
				$r=0;$zz[]=0;
				$novv=mysql_query("select * from PredPoRazz");
				
				echo"
				
				<div id='navigacijaa2' style='cursor:pointer;'>
				<ul id='nav2'>
				<li><a onClick='PrikaziOcjene()'>OCJENE</a></li>
				<li><a onClick='PrikaziObavijestiRazrednik()'>OBAVIJESTI - RAZREDNIK</a></li>
				<li><a onClick='PrikaziObavijestiDirektor()'>OBAVIJESTI - UPRAVA</a></li></ul>
				<ul class='zadnjiunav'>
				<li><a onClick='PrikaziVladanja()'>VLADANJE</a></li>
				</ul></div>
				
				<div id='ocjeneucenici'>
				<br><br><center>
				<table class='tabela'><tr id='prvi_red'>";
				while($cp<6 and $bcc=mysql_fetch_array($novv))
				{
						if($bcc[$rzaza]!=0){
						$sel=mysql_query("select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
						$sadur=mysql_fetch_array($sel);
						$print=$sadur['Predmet'];
						if(!mysql_num_rows(mysql_query("select * from Struka where Pred='".$bcc['Predmet']."'")))
						if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
						{
						echo"<td>".$print."</td>";
						$cp=$cp+1;
						}
						}
				}
				echo"</tr><tr>";
				$nvv=mysql_query("select * from PredPoRazz");
				while($cpp<$cp and $bbcc=mysql_fetch_array($nvv))
				{
					
						if($bbcc[$rzaza]!=0 and !mysql_num_rows(mysql_query("select * from Struka where Pred='".$bbcc['Predmet']."'")) and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
						){
						$zz[$cpp]=$bbcc['Predmet'];
						$hjooj=mysql_query("select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
						echo"<td id='stil_ocjene'>";
						$tmo=0;
						$inkr=0;
						while($ajd=mysql_fetch_array($hjooj))
						{if($ajd['Tajp']==3)
							$jojoj=$ajd['Custom'];
						else if($ajd['Tajp']==2) $jojoj="Pismena";
						else if($ajd['Tajp']==1) $jojoj="Test";
						else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
								echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
								$tmo=$tmo+$ajd['Ocjena'];
								$inkr=$inkr+1;
						}
						echo"</td>";
						if($inkr!=0)
						$zniz[$cpp]=$tmo/$inkr;
						else $zniz[$cpp]=0;
						$cpp=$cpp+1;}
				}
				
				echo"</tr><tr>";
				while($cppp<6)
				{
						$trp=$zz[$cppp];
						$zadnja=mysql_query("select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
						if(mysql_num_rows($zadnja)==0)
						{
						if($zniz[$cppp]!=0)
						{
							if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
							$khmm=floor($zniz[$cppp]/1);
							else $khmm=floor($zniz[$cppp]/1)+1;
							$prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
							$zazk[$cppp]=$khmm;
						}
						
						else {$prs=" ";$zazk[$cppp]=0;}
						}else{
						
						$der=mysql_fetch_array($zadnja);
						$zazk[$cppp]=$der['Ocjena'];
						$prs="<b>".$der['Ocjena']."</b>";
						}
						echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
						$cppp=$cppp+1;
				}
								
				echo"</tr></table><br>";
				
				
				
				
				
				
				
				
				echo"<table class='tabela'><tr id='prvi_red'>";
				while($bcc=mysql_fetch_array($novv) and $cp<12)
				{
						if($bcc[$rzaza]!=0 and !mysql_num_rows(mysql_query("select * from Struka where Pred='".$bcc['Predmet']."'"))){
						$sel=mysql_query("select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
						$sadur=mysql_fetch_array($sel);
						$print=$sadur['Predmet'];
						if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
						echo"<td>".$sadur['Predmet']."</td>";
						$cp++;}
				}
				echo"</tr><tr>";
				while($bbcc=mysql_fetch_array($nvv) and $cpp<12)
				{
						if($bbcc[$rzaza]!=0 and !mysql_num_rows(mysql_query("select * from Struka where Pred='".$bbcc['Predmet']."'")) and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
						){
						$zz[$cpp]=$bbcc['Predmet'];
						$hjooj=mysql_query("select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
						echo"<td id='stil_ocjene'>";
						$tmo=0;
						$inkr=0;
						while($ajd=mysql_fetch_array($hjooj))
						{if($ajd['Tajp']==3)
							$jojoj=$ajd['Custom'];
						else if($ajd['Tajp']==2) $jojoj="Pismena";
						else if($ajd['Tajp']==1) $jojoj="Test";
						else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
								echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
								$tmo=$tmo+$ajd['Ocjena'];
								$inkr=$inkr+1;
								
						}
						if($inkr!=0)
						$zniz[$cpp]=$tmo/$inkr;
						else $zniz[$cpp]=0;
						//$josj=$josj+1;
						echo"</td>";
						$cpp=$cpp+1;}
				}
				
				echo"</tr><tr>";
				while($cppp<$cpp)
				{
						$trp=$zz[$cppp];
						$zadnja=mysql_query("select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
						if(mysql_num_rows($zadnja)==0)
						{
						if($zniz[$cppp]!=0)
						{
							if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
							$khmm=floor($zniz[$cppp]/1);
							else $khmm=floor($zniz[$cppp]/1)+1;
							$prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
							$zazk[$cppp]=$khmm;
						}
						else {$prs=" ";$zazk[$cppp]=0;}
						}else{
						
						$der=mysql_fetch_array($zadnja);
						$zazk[$cppp]=$der['Ocjena'];
						$prs="<b>".$der['Ocjena']."</b>";
						}
						echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
						$cppp=$cppp+1;
				}
				/*$uhh=0;
				for($i=0;$i<$cppp;$i=$i+1)
				if($zazk[$i]!=0)
				{
					$r=$r+$zazk[$i];
					$uhh=$uhh+1;
				}
				if($uhh!=0)
				$trss=$r/$uhh;else $trss=0;
				$jjoj=number_format($trss,2);
				if($trss-floor($trss/1)<0.5)
				$npknz=floor($trss/1);
				else $npknz=floor($trss/1)+1;*/
				echo"</tr></table><br>";
				
				echo"<table class='tabela'><tr id='prvi_red'>";
				while($bcc=mysql_fetch_array($novv))
				{
						if($bcc[$rzaza]!=0){
						$sel=mysql_query("select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
						$sadur=mysql_fetch_array($sel);
						$print=$sadur['Predmet'];
						if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
							if(!mysql_num_rows(mysql_query("select * from Struka where Pred='".$bcc['Predmet']."'")))
						echo"<td>".$sadur['Predmet']."</td>";}
				}
				$selec=mysql_query("select * from Struka where Smjer='".$smer."'");
				while($b=mysql_fetch_array($selec))
				{
					$sel=mysql_query("select * from Predmeti where RnBr = '".$b['Pred']."'");
						$sadur=mysql_fetch_array($sel);
						$print=$sadur['Predmet'];
					echo"<td>".$sadur['Predmet']."</td>";
				}
				
				echo"</tr><tr>";
				while($bbcc=mysql_fetch_array($nvv))
				{
						if($bbcc[$rzaza]!=0 and !mysql_num_rows(mysql_query("select * from Struka where Pred='".$bbcc['Predmet']."'"))and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
						){
						$zz[$cpp]=$bbcc['Predmet'];
						$hjooj=mysql_query("select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
						echo"<td id='stil_ocjene'>";
						$tmo=0;
						$inkr=0;
						while($ajd=mysql_fetch_array($hjooj))
						{if($ajd['Tajp']==3)
							$jojoj=$ajd['Custom'];
						else if($ajd['Tajp']==2) $jojoj="Pismena";
						else if($ajd['Tajp']==1) $jojoj="Test";
						else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
								echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
								$tmo=$tmo+$ajd['Ocjena'];
								$inkr=$inkr+1;
								
						}
						if($inkr!=0)
						$zniz[$cpp]=$tmo/$inkr;
						else $zniz[$cpp]=0;
						//$josj=$josj+1;
						echo"</td>";
						$cpp=$cpp+1;}
				}
				$selec=mysql_query("select * from Struka where Smjer='".$smer."'");
				while($b=mysql_fetch_array($selec))
				{
					$zz[$cpp]=$b['Pred'];
						$hjooj=mysql_query("select * from Izmjene where Predmet ='".$b['Pred']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
						echo"<td id='stil_ocjene'>";
						$tmo=0;
						$inkr=0;
						while($ajd=mysql_fetch_array($hjooj))
						{if($ajd['Tajp']==3)
							$jojoj=$ajd['Custom'];
						else if($ajd['Tajp']==2) $jojoj="Pismena";
						else if($ajd['Tajp']==1) $jojoj="Test";
						else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
								echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
								$tmo=$tmo+$ajd['Ocjena'];
								$inkr=$inkr+1;
								
						}
						if($inkr!=0)
						$zniz[$cpp]=$tmo/$inkr;
						else $zniz[$cpp]=0;
						//$josj=$josj+1;
						echo"</td>";
						$cpp=$cpp+1;
				}
				
				echo"</tr><tr>";
				while($cppp<$cpp)
				{
						$trp=$zz[$cppp];
						$zadnja=mysql_query("select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
						if(mysql_num_rows($zadnja)==0)
						{
						if($zniz[$cppp]!=0)
						{
							if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
							$khmm=floor($zniz[$cppp]/1);
							else $khmm=floor($zniz[$cppp]/1)+1;
							$prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
							$zazk[$cppp]=$khmm;
						}
						else {$prs=" ";$zazk[$cppp]=0;}
						}else{
						
						$der=mysql_fetch_array($zadnja);
						$zazk[$cppp]=$der['Ocjena'];
						$prs="<b>".$der['Ocjena']."</b>";
						}
						echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
						$cppp=$cppp+1;
				}
				$uhh=0;
				for($i=0;$i<$cppp;$i=$i+1)
				if($zazk[$i]!=0)
				{
					$r=$r+$zazk[$i];
					$uhh=$uhh+1;
				}
				if($uhh!=0)
				$trss=$r/$uhh;else $trss=0;
				$jjoj=number_format($trss,2);
				if($trss-floor($trss/1)<0.5)
				$npknz=floor($trss/1);
				else $npknz=floor($trss/1)+1;
				echo"</tr></table><br><br>
				
				<div class='prosjek'>Prosjek ocjena:  <b id='stil_ocjene' style='font-size:14pt;'>".$jjoj." (".$npknz.")</b> </div>
				
				
				</center></div>";
				
				
				
				
				
				/*
				$br2=mysql_query("select * from ".$red['Razred']." where Broj ='". $br."'");
				$br3=mysql_query("select * from ".$red['Razred']." where Broj ='0'");
				$red2=mysql_fetch_array($br2);
				$red3=mysql_fetch_array($br3);
				$kolonaa=mysql_num_fields($br2);
				$inc=1;$inc2=1;
				echo "<center>
				<br>
				<font style='color:#000000;'><p><b> Ocjene: </b></p></font><br>";
				echo"<table border='1' style='color:#000000; border-color:#000000; border-style:none; border-collapse:collapse; width:600px'>
				<tr align='center'>
					<td id='tabela1'><b style='color:white;'>Broj</b></td>
					";
					while($inc2<8)
					{
						$que=mysql_query("select * from Predmeti where RnBr ='".$red3[$inc2]."'");
						$fetc=mysql_fetch_array($que);
						$sadkoji=$red3[$inc2];
						if($sadkoji=='3')
						$njegdje=$inc2;
						if($sadkoji=='4')
						$fragdje=$inc2;
						if($sadkoji=='11')
						$etgdje=$inc2;
						if($sadkoji=='17')
						$vjegdje=$inc2;
					
						
						if($red3[$inc2]!='3' && $red3[$inc2]!='4' && $red3[$inc2]!='11' && $red3[$inc2]!='17')
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						else {
						if($red3[$inc2]=='3' && $jelfrancuz==0)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='4' && $jelfrancuz==1)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='11' && $jeleticar==1)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='17' && $jeleticar==0)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
				}
						$inc2=$inc2+1;
					}
					
						if($jeleticar==1)
						$neces2=$vjegdje;
						else $neces2=$etgdje;
						if($jelfrancuz==1)
						$neces=$njegdje;
						else $neces=$fragdje;
					echo"
				</tr>
				<tr align='center'>
					<td style='color:#000000;'><b>".$br."</b></td>
					";
					while($inc<8)
					{
					//echo $nemoj.$nemoj;
					if($inc!=$neces && $inc!=$neces2){
					if($red2[$inc]!='0')
					$bla=$red2[$inc];
					else $bla=" ";
						echo"<td>".$bla."</td>";}
						$inc=$inc+1;
					
					}
					
					echo"</tr>
				</table><br><br>
				<table border='1' style='color:#000000; border-color:#000000; border-style:none; border-collapse:collapse; width:600px;'>
				<tr align='center'>";
				
				while($inc2<$kolonaa-1)
					{
						$que=mysql_query("select * from Predmeti where RnBr ='".$red3[$inc2]."'");
						$fetc=mysql_fetch_array($que);
						$sadkoji=$red3[$inc2];
						if($sadkoji=='3')
						$njegdje=$inc2;
						if($sadkoji=='4')
						$fragdje=$inc2;
						if($sadkoji=='11')
						$etgdje=$inc2;
						if($sadkoji=='17')
						$vjegdje=$inc2;
					
						
						if($red3[$inc2]!='3' && $red3[$inc2]!='4' && $red3[$inc2]!='11' && $red3[$inc2]!='17')
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						else {
						if($red3[$inc2]=='3' && $jelfrancuz==0)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='4' && $jelfrancuz==1)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='11' && $jeleticar==1)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
						if($red3[$inc2]=='17' && $jeleticar==0)
						echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
				}
						$inc2=$inc2+1;
					}
					if($jeleticar==1)
						$necess=$vjegdje;
						else $necess=$etgdje;
						if($jelfrancuz==1)
						$neces=$njegdje;
						else $neces=$fragdje;
				echo"
				</tr>
				<tr align='center'>";
				while($inc<$kolonaa-1)
					{
					
					if($inc!=$necess && $inc!=$neces ){
					if($red2[$inc]!='0')
					$bla=$red2[$inc];
					else $bla=" ";
					
						echo"<td>".$bla."</td>";}
						$inc=$inc+1;
					
					}
				
				
				
				echo"</tr></table>";*/
				echo"
				<br>
				<div id='linija'></div>
				<br>
				<div>
				<center>
				<div id='obavijestidir'>
				<table class='tabela'>
				<tr><th colspan='3'>Obavijesti od uprave (za sve učenike)</th></tr>";
				$msg=mysql_query("select * from Obavijesti order by ID desc");
				$nekinc=0;
				while($uzmi=mysql_fetch_array($msg))
				{
						$hahs2=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$uzmi['Autor']."'"));
						if( $nekinc<5 && $hahs2['Direktor']==1){
						echo"<tr><td>".$hahs2['Ime']." ".$hahs2['Prezime']."</td><td class='crveno'>".$uzmi['Msg']."</td><td>".$uzmi['Date']."</td></tr>";
						$nekinc=$nekinc+1;}
				}
				
				echo"
				
				</table>
				</center></div>";
				echo"
				<center>
				<div id='obavijestiraz'>
				<table class='tabela'>
				<tr><th colspan='3'>Obavijesti od razrednika</th></tr>"; 
				$msg2=mysql_query("select * from Obavijesti order by ID desc");
				$nekinc2=0;
				while($uzmi2=mysql_fetch_array($msg2))
				{
						//echo $rzaza."-".$uzmi2['Razz']."---";
				$hahs=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$uzmi2['Autor']."'"));
						if( $nekinc2<5 and $rzaza==$hahs['Razrednik']){
						echo"<tr><td>".$hahs['Ime']." ".$hahs['Prezime']."</td><td class='crveno'>".$uzmi2['Msg']."</td><td>".$uzmi2['Date']."</td></tr>";
						$nekinc2=$nekinc2+1;}
				}
				
				echo"	
				</table></div>
				</center>
				";
				
				//echo $br.$rzaza;
				$jooj=mysql_query("select * from Vladanja where BrUc='".$br."' and Razz='".$rzaza."' order by ID desc");
				if(mysql_num_rows($jooj)!=0){
				echo"
				<div id='vladanjaucenik'><center><table class='tabela'>
				<th colspan='4'>Promjene vladanja</th>
				<tr id='prvi_red'><td>Profesor</td><td>Razlog</td><td>Ocjena</td><td>Datum</td></tr>";
				while($fecfec=mysql_fetch_array($jooj))
				{
							$josfec=mysql_fetch_array(mysql_query("select * from Profesori where RnBr='".$fecfec['Prof']."'"));
							echo"<tr><td>".$josfec['Ime']." ".$josfec['Prezime']."</td><td class='crveno'><b>".$fecfec['Razlog']."<b></td><td><center><b>".$fecfec['Ocjena']."</b></center></td><td>".$fecfec['Datum']."</td></tr>";
				}				
				
				echo"
				</table></center></div>
				";}
			}}
				else
					echo "<p align='center'>Moras biti logovan</p>";
			?>
		<?php include("ftincld.php");?>
	</body>
</html>