<?php 
if(isset($_SESSION['user']))
if($_SESSION['user']=="Hasak" || $_SESSION['user']=="Venan24" || $_SESSION['user']=="Enis")
					$admin=true;
else $admin=false;?>