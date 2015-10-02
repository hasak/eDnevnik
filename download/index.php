<?php
ob_start();
				session_start();
				include('../db.php');
// ADD SPECIFIC FILES YOU WANT TO IGNORE HERE
if (isset($_SESSION['user'])) {
	function cleanTitle($title)
{
	$title = str_replace("-", " ", $title);
	$title = str_replace("_", " ", $title);
	return ucwords($title);
}

function getFileExt($filename) 
{
	return substr(strrchr($filename,'.'),1);
}

function format_size($file) 
{
	$bytes = filesize($file);
	if ($bytes < 1024) return $bytes.'b';
	elseif ($bytes < 1048576) return round($bytes / 1024, 2).'kb';
	elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).'mb';
	elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).'gb';
	else return round($bytes / 1099511627776, 2).'tb';
}
	$ignore_file_list = array(".", "Thumbs.db", ".DS_Store", "index.php", "icons.png",".htaccess");

// ADD SPECIFIC FILE EXTENSIONS YOU WANT TO IGNORE HERE
$ignore_ext_list = array();

$title = cleanTitle(basename(dirname(__FILE__)));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
				include('../ink.php');
?>
	<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/uplaodstyle/style.css">
	<title><?php echo $title; ?></title>
</head>
<body>
<?php include("../includ.php");

?>
	<div class="wrap">
		<h1><?php echo $title ?></h1>
<?php
if(isset($_SESSION['user']))
{


// GET FILES AND PUT INTO AN ARRAY
$files = $directories = array();
$handle=opendir(dirname(__FILE__));
while (($file = readdir($handle))!==false) { $files[] = $file; }
closedir($handle);

sort($files);

// GET DIRECTORIES
foreach($files as $c => $file)
{
	if(!is_dir($file)) { continue; }
	if(in_array($file, $ignore_file_list)) { continue; }
	if(in_array($fileExt, $ignore_ext_list)) { continue; }
	
	//echo "<div class=\"media_block\">";
	//echo "	<div class=\"media_block_image\"><a href=\"$file\" class=\"dir\">&nbsp;</a></div>";
	//echo "	<div class=\"media_block_name\">\n";
	//echo "		<div class=\"media_block_file\"><a href=\"$file\">$file</a></div>\n";
	//echo "		<div class=\"media_block_date\">Zadnja izmjena: " .  date("j M Y - G:i", filemtime($file)) . "</div>\n";
	//echo "	</div>\n";
	//echo "</div>";	
	
	unset($files[$c]);
}

// LOOP THE FILES
foreach($files as $file)
{
	$fileExt = getFileExt($file);
	if(in_array($file, $ignore_file_list)) { continue; }
	if(in_array($fileExt, $ignore_ext_list)) { continue; }
	if(is_dir($file)) { $fileExt = "dir"; }

	echo "<div class=\"media_block\">";
	echo "	<div class=\"media_block_image\"><a href=\"$file\" class=\"$fileExt\">&nbsp;</a></div>";
	echo "	<div class=\"media_block_name\">\n";
	echo "		<div class=\"media_block_file\"><a href=\"$file\" download='".basename($file)."'>$file</a></div>\n";
	echo "		<div class=\"media_block_date\">Veličina: " . format_size($file) . "<br />Zadnja izmjena: " .  date("j M Y - G:i", filemtime($file)) . "</div>\n";
	echo "	</div>\n";
	echo "</div>";
}


}else echo "<center><br><br><h2>Moraš biti logovan</h2></center>";
?>
	</div><?php 
		include("../ftincld.php");?>
</body>
</html>