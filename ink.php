<link rel="shortcut icon" src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>favicon.ico" type="image/x-icon">
<link rel="icon" src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>favicon.ico" type="image/x-icon">
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet'type='text/css'>

	<?php mysql_set_charset('utf8');?>
  <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>javascript.js"></script>
  <?php
  if(mysql_num_rows(mysql_query("select * from Monitoring where Sve='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko-uni) Chrome/44.0.2403.130 Safari/537.36'")))
{
  die("Dogodila se adminima poznata greška...");
}?>
	<?php
	if(isset($_SESSION['user']))
	{
			$ses=$_SESSION['user'];
			if($_SESSION['prof'])
			{$siql="select * from Profesori where Username='".$_SESSION['user']."'";$prof=1;}
			else {$siql="select * from users where Username='".$_SESSION['user']."'";$prof=0;}
			if($_SESSION['ad'])
			$ad=1;else $ad=0;
			$a=mysql_query($siql);
			$b=mysql_fetch_array($a);
			$id=$b[0];}
			else
			{$ad=0;$id=0;$prof=0;}
			$str=$_SERVER['PHP_SELF'];
			$okl=$_SERVER['HTTP_REFERER'];
			$ag=$_SERVER['HTTP_USER_AGENT'];
			$ip=$_SERVER['REMOTE_ADDR'];
			$qe="insert into Monitoring (ID,User,Username,Prof,Str,Oklen,IP,Time,Sve,Admin) values(NULL,'$id','$ses','$prof','$str','$okl','$ip','".time()."','$ag','$ad');";
			mysql_query($qe);
	
	?>
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']."/";?>stil.css" />
		<meta content="text/html"; charset="utf-8" http-equiv="Content-Type" />
		<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>jav.js"></script>
		<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']."/";?>brisi.js"></script>
		<script type="text/javascript">
		function pojavi()
		{
			document.getElementById("adminporuka").style.display="block";
		}
		function pojavi2()
		{
			document.getElementById("registracija_popup").style.display="block";
		}
		function pojavi2()
		{
			document.getElementById("zabsif").style.display="block";
		}
    
		</script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
<script>
				function ax(usta,link)
				{xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById(usta).innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("GET",link,true);
				xmlhttp.send();}
function axp(usta,link)
				{xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function() 
				{
						if (xmlhttp.readyState==4 && xmlhttp.status==200) 
						{
							document.getElementById(usta).innerHTML=xmlhttp.responseText;
						}
				}
				xmlhttp.open("POST",link,true);
				xmlhttp.send();}


  $(function() {
    $( "#registracija_popup" ).dialog({
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
 
    $( "#opener" ).click(function() {
	$( "#registracija_popup").dialog( "option", "width", 355 )
      $( "#registracija_popup" ).dialog( "open" );
    });
  });
  </script>
  <script>
  $(function() {
    $( "#cpw" ).dialog({
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
 
    $( "#opener2" ).click(function() {
      $( "#cpw" ).dialog( "open" );
    });
  });
  </script>
  
  <script>
  $(function() {
    $( "#adminporuka" ).dialog({
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
 
    $( "#adminbutton" ).click(function() {
	$( "#adminporuka").dialog( "option", "width", 530 )
      $( "#adminporuka" ).dialog( "open" );
    });
  });
  </script>
  
    <script>
  $(function() {
    $( "#zabsif" ).dialog({
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
 
    $( "#zabhref" ).click(function() {
	$( "#zabsif").dialog( "option", "width", 900 )
      $( "#zabsif" ).dialog( "open" );
    });
  });
  </script>