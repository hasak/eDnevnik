<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Statistika - eDnevnik</title><?php include('ink.php'); ?>
		<script>
		function neka()
		{
			var a=document.getElementById('divzak').style.display;
			if(a=="block")
			b="none";
			else b="block";
			document.getElementById('divzak').style.display=b;
		}
		function adjax(rzz)
		{
			if(rzz==0){
			document.getElementById("bruce").innerHTML="";
			document.getElementById("zauce").innerHTML="";}
			else{
			document.getElementById("zauce").innerHTML="Učenik: ";
			document.getElementById("bruce").innerHTML="<i>Učitavanje</i>";
				xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() 
		{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("bruce").innerHTML=xmlhttp.responseText;
				}
		}
		xmlhttp.open("GET","ajax2.php?rzz="+rzz,true);
		xmlhttp.send();
		}}
		</script>
		
		
	</head>
	<body>
		<?php include("includ.php");?>
		<?php
		$jest=false;
		if($_SESSION['prof']==true or $admin==true)
		{
		
		$qaa2=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj2=mysql_fetch_array($qaa2);
		if($fetcaraj2['Direktor']==1 or $admin==true)
		$jest=true;
		//$razz=$_POST['razz'];
		//$query=mysql_query("select * from ".$razz);
		if(isset($_POST['zast'])){
		$qaa=mysql_query("select * from Profesori where RnBr='".$_POST['zast']."'");
		}
		
		else if(isset($_POST['adime']) and $jest==true)
		{
			$qaa=mysql_query("select * from Profesori where RnBr='".$_POST['adime']."'");
			$_POST['zast']=$_POST['adime'];
		}
		else $qaa=mysql_query("select * from Profesori where Username='".$_SESSION['user']."'");
		$fetcaraj=mysql_fetch_array($qaa);
		$id=$fetcaraj['RnBr'];
		$pred=$fetcaraj['Predmet'];
		$query2=mysql_query("select * from Predmeti where RnBr = '".$pred."'");
				$fec=mysql_fetch_array($query2);
				$pred2=$fec['Predmet'];
				//$proba="'".$pred."'";
		if(isset($_POST['roz']))
		{
				$ra=$_POST['roz'];
				$uc=$_POST['djak'];
				$me=$_POST['mjo'];
				$prrr=$_POST['predm'];
		}
		 //////////////////////////////////////////////////////////////////////
		/////mktime(hour,minute,second,month,day,year,is_dst);/////
	   /////////////////////////////////////////////////////////////////////
		echo"<br>
		<p><center><h2>Statistika - ".$fetcaraj['Ime']." ".$fetcaraj['Prezime']."</h2></center></p><br><br>
		<form action='".$_SERVER['PHP_SELF']."' method='post'><center><table id='datumdnev'><tr><td>
		<input type='radio' name='predm' id='prm".$pred."' value='".$pred."' style='position:absolute; left:-9999px;' ";
		if($pred==$prrr or $prrr=="")
			echo "checked";
		echo">
		<label for='prm".$pred."'>".$pred2."</label>
		</td>";
		$zu=mysql_query("select * from Vise where Profa='".$id."'");
		while($b=mysql_fetch_array($zu))
		{
			$query23=mysql_query("select * from Predmeti where RnBr = '".$b['Pred']."'");
				$fec2=mysql_fetch_array($query23);
				$pred23=$fec2['Predmet'];
				echo"<td>
		<input type='radio' name='predm' id='prm".$pred23."' value='".$b['Pred']."' style='position:absolute; left:-9999px;' ";
		if($b['Pred']==$prrr)
			echo "checked";
		echo">
		<label for='prm".$pred23."'>".$pred23."</label>
		</td>";
		}

		echo"
		</tr></table></center><br>
		
				<div id='zasel'>
				<center><h3>Odaberi:</h3></center><br>
				<table><tr><td>Mjesec: </td><td style='text-align:right;'>
				<select name='mjo'><option value='0'>Svi</option>";
				$i=9;
				while(1){
				//if($i==13)
				//$i=1;
				if($i==13)
				$i=1;
				if($i==7)
				break;
				if($i==$me)
				$d="selected";
				else $d="";
				echo "<option value='".$i."' ".$d.">".$i."</option>";
				$i=$i+1;
				}
				echo"</select></td></tr><tr><td>Razred: </td><td style='text-align:right;'>
				
				<select name='roz' onchange='adjax(this.value)'><option value='0'>Svi</option>"; 
					$kuer124=mysql_query("select * from Razredi where ID='".$id."'");
					$reed=mysql_fetch_array($kuer124);
				//$majf3=mysql_fetch_array($kuer2);
				$brinc134=mysql_num_fields($kuer124);
				$kre134=1;
				while($kre134<$brinc134)
				{
					$kojir114=mysql_field_name($kuer124,$kre134);
					//if($reed[$kre134]==1)
					if($kojir114==$ra)
				$d="selected";
				else $d="";
				if($reed[$kre134]==1)
					echo"<option value='".$kojir114."' ".$d.">".$kojir114."</option>";
					$kre134=$kre134+1;
				}
					echo"</select></td></tr>";
					echo"<tr><td id='zauce'>";
					if(isset($ra) and $ra!=0) echo"Učenik: ";
					echo"</td><td id='bruce' style='text-align:right;'>";
					if(isset($ra) and $ra!=0)
					{
							$a=mysql_query("select * from Spisak");
echo"<select name='djak'><option value='0'>Svi</option>"; 
					while($b=mysql_fetch_array($a))
					{
					if($b[0]==$uc)
				$d="selected";
				else $d="";
				if($b[$ra]!="")
					echo"<option value='".$b[0]."' ".$d.">".$b[0].". ".$b[$ra]."</option>";
					}echo"</select>";
					}
					echo"</td></tr>";
					
					echo"</table>
				
		<br><br>
		";
		if($jest=true)
		echo"<input type='hidden' name='adime' value='".$_POST['zast']."'>";
		echo"
		<center><input type='submit' value='Odaberi' class='button'></center></div></form>
		
		
		";
		if(isset($_POST['roz']))
		{
				$ra=$_POST['roz'];
				$uc=$_POST['djak'];
				$me=$_POST['mjo'];
				$premed=$_POST['predm'];
				///mktime(hour,minute,second,month,day,year,is_dst);
				if($me!=0)
				{
				$pocm=mktime(0,0,0,$me,1,date("Y"));
				$brdn=cal_days_in_month(CAL_GREGORIAN, $me, date("Y"));
				$krajm=mktime(23,59,59,$me,$brdn,date("Y"));
				$mee=" and Datum>".$pocm." and Datum<".$krajm;
				}else $mee="";
				if($ra!=0)
				$raa=" and Razred='".$ra."'";
				else $raa="";
				if($uc!=0)
				$ucc=" and Brojuc='".$uc."'";
				else $ucc="";
				
				
				
				
				echo"<div id='statoc'>";
				$c=0;
				for($i=1;$i<6;$i=$i+1){
				//if($i<4) $pr=1; else $pr=2;
				echo"<div id='zaoc' class='oc".$i."'>";
				echo"<center><h3>Ocjena ".$i."</h3></center><br>";
				$qh=mysql_query("select * from Izmjene where Prof='".$id."'".$raa.$ucc.$mee." and Ocjena='".$i."' and Zakljucna='0' and Predmet='".$premed."' order by Datum");
				$a=mysql_num_rows($qh);
				$f[$i]=$f[$i]+$a;
				$c=$c+$f[$i];
				if(mysql_num_rows($qh)!=0)
				{
						echo"<table class='tabela'><tr id='prvi_red'><td>Datum</td><td>Oc</td><td>Br</td><td>Raz</td></tr>";
						while($b=mysql_fetch_array($qh))
						{
							if($b['Tajp']==3)
							$jojoj=$b['Custom'];
						else if($b['Tajp']==2) $jojoj="Pismena";
						else if($b['Tajp']==1) $jojoj="Test";
						else if($b['Tajp']==0) $jojoj="Obična ocjena";
								echo"<tr><td class='crveno'>".date("d.m",$b['Datum'])."</td>
								<td class='bpzo".$b['Tajp']."' title='".$jojoj."'><b>".$b['Ocjena']."</b></td><td>".$b['Brojuc']."</td>
								<td>".$b['Razred']."</td></tr></tr>";
						}
						echo"<tr style='height:10px'></tr>
								<tr><td id='sum' colspan='2'>∑</td><td id='sum' colspan='2'>".$a."</td></tr></table>";
				}
				else echo"<center><i>Nema ocjene ".$i."</i></center>";
				echo"</div>";
				if($i==3)
				echo "</div><div id='statoc2'>";
				}
				if($c==0)
				{$c=1;
			$c32=0;}
			else $c32=$c;
				echo"<div id='zaoc' class='oc6'><center><h3>Ukupno</h3></center><br>
				<table style='width:100%; height:100%' class='tabela'><tr id='prvi_red'><td>Ocjena</td><td>∑</td><td>%</td></tr>
				<tr><td>Petica: </td><td>".$f[5]."</td><td class='crveno'>".number_format(100*$f[5]/$c,2)."%</td></tr>
				<tr><td>Četvorki: </td><td>".$f[4]."</td><td class='crveno'>".number_format(100*$f[4]/$c,2)."%</td></tr>
				<tr><td>Trica: </td><td>".$f[3]."</td><td class='crveno'>".number_format(100*$f[3]/$c,2)."%</td></tr>
				<tr><td>Dvica: </td><td>".$f[2]."</td><td class='crveno'>".number_format(100*$f[2]/$c,2)."%</td></tr>
				<tr><td>Jedinica: </td><td>".$f[1]."</td><td class='crveno'>".number_format(100*$f[1]/$c,2)."%</td></tr>
				<tr><td id='sum' colspan='2'>∑</td><td id='sum' colspan='2'>".$c32."</td></tr>
				
				</table></div></div>";
		}
		for($i=1;$i<6;$i=$i+1)
		$ss=$ss+$f[$i]*$i;
		if($c!=0)
		$pros=number_format($ss/$c,2);
		else $pros=0;
		echo"<br><br><br>";
		if(isset($_POST['roz']))
		echo"<center><div class='prosjek' style='font-size:15pt; width:450px;'>Prosjek svih odabranih ocjena:&nbsp&nbsp&nbsp&nbsp<b id='stil_ocjene' style='font-size:20pt;'>".$pros."</b> </div></center>";
		
		echo"<br>
		<button class='button2' onClick='neka()' id='divz'>Zaključne</button>
		<center>
		<table class='tabela' id='divzak'>
		<tr id='prvi_red'><td>Razz</td><td>Odličan</td><td>Vrlodobar</td><td>Dobar</td><td>Dovoljan</td><td>Nedovoljan</td><td>Prosjek</td></tr>
		";
		$koje[300]=0;
		$sveu[300]=0;
		$brojac=1;
		$povu=mysql_query("select * from Razredi where ID='".$id."'");
		$ur=mysql_fetch_array($povu);
		$brkln=mysql_num_fields($povu);
		while($brojac<$brkln)
		{
		$reset=1;
		$ocjene=0;
		$zbir=0;
		while($reset<6)
		{
				$koje[$reset]=0;
				$reset=$reset+1;
		}
		$razr=mysql_field_name($povu,$brojac);
		if($ur[$razr]!=0){
		$qqaa=mysql_query("select * from Izmjene where Prof='".$id."' and Razred = '".$razr."' order by RnBr desc");
		while($fff=mysql_fetch_array($qqaa))
		{
				//$string=$fff['Ocjena'];
				if($fff['Zakljucna']==1)
				{
				//echo $fff['Ocjena'].$fff['Ocjena'];
						$brr=$fff['Ocjena'];
						$koje[$brr]=$koje[$brr]+1;
						$sveu[$brr]=$sveu[$brr]+1;
						$ocjene=$ocjene+1;
				}
				
				
		}
		$reset=1;
		while($reset<6)
		{
				$zbir=$zbir+$koje[$reset]*$reset;
				$reset=$reset+1;
		}
		if($ocjene!=0)
		$prosjek=number_format($zbir/$ocjene,2);
			else $prosjek=0;
		echo"<tr><td id='prva_cell'>".$razr."</td><td>".$koje[5]."</td><td>".$koje[4]."</td><td>".$koje[3]."</td><td>".$koje[2]."</td><td>".$koje[1]."</td><td>".$prosjek."</td></tr>";}
		$brojac=$brojac+1;}
		$naz=$sveu[5]+$sveu[4]+$sveu[3]+$sveu[2]+$sveu[1];
		if($naz!=0)
		$savpr=number_format(($sveu[5]*5+$sveu[4]*4+$sveu[3]*3+$sveu[2]*2+$sveu[1])/($naz),2);
		else $savpr=0;
		echo"
		<tr style='height:10px;'></tr>
		<tr id='zadnji_red'><td id='prva_cell'><b>∑</b></td>";
		$dojava=5;
		while($dojava>0)
		{
		echo "<td id='suma'>".$sveu[$dojava]."</td>";
		$dojava=$dojava-1;
		}
		echo"<td id='suma'>".$savpr."</td></tr>
		</table></center><br><br>";
		}
		else echo"<p><center><h1>Niste profesor !</h1><center></p>";
		?>
		<?php include("ftincld.php");?>
	</body>
</html>