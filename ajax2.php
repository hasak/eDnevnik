<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>AJAXX</title>
		<?php include('ink.php'); ?>
	</head>
	<body><?php 
if(isset($_GET['rzz'])){
$ra=$_GET['rzz'];
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
					
else {echo"Neka serverska greška!";}
?></body>
</html>