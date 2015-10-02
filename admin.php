<?php 
if(isset($_SESSION['user'])){
if($_SESSION['prof']==true){$red=mysql_query("select * from Profesori where Username ='".$_SESSION['user']."'");
$rcd=mysql_fetch_array($red);
if($rcd['Direktor']==1)
					$direktor=true;}else{
$red=mysql_query("select * from users where Username ='".$_SESSION['user']."'");
$rcd=mysql_fetch_array($red);
if($rcd['Admin']==1)
					$admin=true;
else $admin=false;}}?>