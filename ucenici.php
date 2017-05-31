<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Učenici &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
        <h3><span class="fa fa-group"></span> Students</h3>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default ajbtn" id="0">All Students</button>
        <button type="button" class="btn btn-default ajbtn" id="1">1. <span class="hidden-xs">class</span></button>
        <button type="button" class="btn btn-default ajbtn" id="2">2. <span class="hidden-xs">class</span></button>
        <button type="button" class="btn btn-default ajbtn" id="3">3. <span class="hidden-xs">class</span></button>
        <button type="button" class="btn btn-default ajbtn" id="4">4. <span class="hidden-xs">class</span></button>
      </div>
      <br><br>
      <div class="container-fluid" id="forajaxing">

      </div>
    </div>
      <div class="col-md-4 col-lg-3">
          <?php include('inc/php/side.php');?>
      </div>
  </div>
</div>
<?php include('inc/php/footer.php');?>
</body>
</html>