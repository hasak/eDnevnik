<?php ob_start(); session_start();
include('../db.php');

function DownloadFile($file) { // $file = include path 
        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }

    }
	
	if(isset($_SESSION['user']))
{
	include("../admin.php");
	if($admin or $direktor)
	{
		
//error_reporting(0);

/* backup the db OR just a table */
function backup_tables()
{
$return = "";
//$link = mysql_connect($host,$user,$pass);
//mysql_select_db($name,$link);
//get all of the tables
if(1)
{
$tables = array();
$result = mysql_query('SHOW TABLES');
while($row = mysql_fetch_row($result))
{
$tables[] = $row[0];
}
}
else
{
$tables = is_array($tables) ? $tables : explode(',',$tables);
}
//cycle through
foreach($tables as $table)
{
$result = mysql_query('SELECT * FROM '.$table);
$num_fields = mysql_num_fields($result);
//$return.= 'DROP TABLE '.$table.';';
$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
$return.= "\n\n".$row2[1].";\n\n";
for ($i = 0; $i < $num_fields; $i++)
{
while($row = mysql_fetch_row($result))
{
$return.= 'INSERT INTO '.$table.' VALUES(';
for($j=0; $j<$num_fields; $j++)
{
$row[$j] = addslashes($row[$j]);
$row[$j] = ereg_replace("\n","\\n",$row[$j]);
if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
if ($j<($num_fields-1)) { $return.= ','; }
}
$return.= ");\n";
}
}
$return.="\n\n\n";
}
//save file
$pathh='Backup baze '.date("j M Y").' u '.date("G:i").'.sql';
$handle = fopen($pathh,'w+');
// echo $return;
fwrite($handle,$return);echo $handle; if(DownloadFile($pathh))echo "uspjelo"; else echo "Nije";
fclose($handle);
}backup_tables();//host-name,user-name,password,DB name

$aaa= "<br><br><center><i style='font-size:20pt;'>Backup baze podataka je uspješno izvršen</i></center>";

		
	}else $aaa= "<br><center><h2>Niste administrator niti uprava!</h2></center>";
}else $aaa= "<br><center><h2>Morate biti prijavljeni</h2></center>";?>
<html>
	<head>
		<title>Backup baze - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('../ink.php'); ?>
	</head>
	<body>
		<?php include("../includ.php");
echo $aaa;

		include("../ftincld.php");?>
	</body>
</html>