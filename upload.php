<?php ob_start(); session_start();
include('db.php');?>
<html>
	<head>
		<title>Upload - eDnevnik</title>
		<meta charset="utf-8">
		<?php include('ink.php'); ?>
	</head>
	<body>
		<?php include("includ.php");?>
<?php
include("admin.php");
		if($_SESSION['prof'] or $admin)
		{
			$uploadpath = 'download/';      // directory to store the uploaded files
$max_size = 2048;          // maximum file size, in KiloBytes
$alwidth = 2500;            // maximum allowed width, in pixels
$alheight = 2000;           // maximum allowed height, in pixels
$allowtype = array('doc', 'docx', 'txt', 'pdf', 'ppt', 'pptx','jpg', 'jpeg', 'gif', 'png','rtf', 'xls', 'xlsx','zip', 'rar', 'tar', 'gzip','swf','fla', 'mp3','wav','mp4','mov', 'aiff', 'm2v', 'avi', 'pict', 'qif','wmv', 'avi', 'mpg','flv', 'f2v','psd','ai','html', 'xhtml', 'dhtml', 'php', 'asp', 'css', 'js', 'inc' );        // allowed extensions

if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
  $uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       // gets the file name
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);       // gets extension
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
  $err = '';         // to store the errors

  // Checks if the file has allowed type, size, width and height (for images)
  if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
  if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
  if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;

  // If no errors, upload the image, else, output the errors
  if($err == '') {
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) { 
      echo "<p style='color:#000000; padding-left:15px;'>Fajl naziva: <b>". basename( $_FILES['fileup']['name']). "</b> je uspješno dodan na server:";
      echo "<br/>Tip fajla: <b>". $_FILES['fileup']['type'] ."</b>";
      echo "<br />Veličina: <b>". number_format($_FILES['fileup']['size']/1024, 3, ".", '') ."</b> KB</p>";
      if(isset($width) && isset($height)) echo '<br/>Image Width x Height: '. $width. ' x '. $height;
      echo "<br/><br/><p style='color:#000000; padding-left:15px;'>Addresa datoteke: <b>http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/')."/".$uploadpath."</b></p>";
    }
    else echo '<b>Došlo je do greške prilikom dodavanja fajla.</b>';
  }
  else echo $err;
} echo "
<div style='margin:1em auto; width:600px; text-align:center;'>
 <form action=' ".$_SERVER['PHP_SELF']."' method='POST' enctype='multipart/form-data'> 
  <br><br><center><h3><i><label for='fajlu' style:'cursor:pointer;'>Izaberite datoteku (fajl):</label></i></h3><br>
  <input type='file' name='fileup' id='fajlu' style='border:none; width:200px; '><br/><br>
  <input type='submit' name='submit' class='button' value='Posaljite datoteku' > </center>
 </form>
</div>";
		}else echo"<br><br><center><h1>Niste profesor</h1></center>";

 ?>
<?php include("ftincld.php");?>
	</body>
</html>