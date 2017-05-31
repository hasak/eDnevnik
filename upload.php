<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
      <div class="container-fluid">
        <button class="btn btn-primary">
          <span class="glyphicon glyphicon-upload"></span>
          Odaberi fajl
        </button>
        <br><br>
        <div class="container col-xs-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              [ime fajla]
            </div>
            <div class="panel-body togglable">
              <div class="form-group col-xs-8">
                <label for="comment">Opis fajla:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
              </div>
              <img src="http://a3.mzstatic.com/us/r30/Purple18/v4/c2/5f/3d/c25f3dcd-602e-10ef-2da1-d88379ba70f3/icon175x175.jpeg" class="col-xs-4">
            </div>
          </div>
        </div>
        <br><br>
        <button class="btn btn-success">
          <span class="glyphicon glyphicon-ok"></span>
          Pošalji fajl
        </button>
        <button class="btn btn-danger">
          <span class="glyphicon glyphicon-remove"></span>
          Odustani
        </button>
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