<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Download &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
      <div class="container-fluid">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Pretraži:</span>
          <input type="text" class="form-control" placeholder="Pojam za pretragu" aria-describedby="basic-addon1">
          <span class="input-group-btn">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div>
        <br><br>
        <div class="files col-xs-12">
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="http://a3.mzstatic.com/us/r30/Purple18/v4/c2/5f/3d/c25f3dcd-602e-10ef-2da1-d88379ba70f3/icon175x175.jpeg" alt="...">
                <div class="caption">
                  <h3>Ime fajla</h3>
                  <p>Opis fajla...</p>
                  <p><a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-download-alt"></span> Preuzmi</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="http://a3.mzstatic.com/us/r30/Purple18/v4/c2/5f/3d/c25f3dcd-602e-10ef-2da1-d88379ba70f3/icon175x175.jpeg" alt="...">
                <div class="caption">
                  <h3>Ime fajla</h3>
                  <p>Opis fajla...</p>
                  <p><a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-download-alt"></span> Preuzmi</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="http://a3.mzstatic.com/us/r30/Purple18/v4/c2/5f/3d/c25f3dcd-602e-10ef-2da1-d88379ba70f3/icon175x175.jpeg" alt="...">
                <div class="caption">
                  <h3>Ime fajla</h3>
                  <p>Opis fajla...</p>
                  <p><a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-download-alt"></span> Preuzmi</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
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