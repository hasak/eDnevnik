<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Postavke profila &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
    <script src="/inc/js/postavke.js"></script>
</head>
<body>
<?php include('inc/php/nav.php');?>
<?php
if($_SESSION['prof'])
    $ha="Profesori";
else $ha="users";
$q2=mysqli_query($c,"select * from ".$ha." where Username='".$_SESSION['user']."'");
$b=mysqli_fetch_array($q2);

echo'
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
    <div class="container-fluid">
      <h3><span class="fa fa-wrench"></span> Postavke Profila</h3>
      <a href="#" class="profImg col-xs-5">
        <img src="'.$b['Img'].'" class="img-thumbnail">
      </a>
      <ul class="list-group profInfo col-xs-7">
        <li class="list-group-item profInfoItem">
          Ime <span class="pull-right">'.$b['Ime'].'</span>
        </li>
        <li class="list-group-item profInfoItem">
          Prezime <span class="pull-right">'.$b['Prezime'].'</span>
        </li>
      </ul>
      </div>
      <br>
      <div class="container-fluid">
        <div class="panel panel-default">
        <div class="panel-heading"><span class="fa fa-cog"></span> Postavke</div>
        <div class="panel-body togglable">
          <button class="btn btn-primary passBtn"><span class="fa fa-lock"></span> Promijeni password</button>
          <button class="btn btn-primary avatarBtn"><span class="fa fa-picture-o"></span> Promijeni sliku</button>
          <br><br>
          <div class="passBox">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Old password</span>
              <input type="text" class="form-control" placeholder="Unesi stari password" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">New Password</span>
              <input type="text" class="form-control" placeholder="Unesi novi password" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">New Password</span>
              <input type="text" class="form-control" placeholder="Ponovi novi password" aria-describedby="basic-addon1">
            </div>
            <br>
            <button class="btn btn-success pull-right"><span class="fa fa-check"></span> Change</button>
          </div>
          <div class="avatarBox">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Link slike</span>
              <input type="text" class="form-control avatarLink" placeholder="Unesi link slike" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="form-inline pull-right">
              <button class="btn btn-default tryOutAvatar">
              <span class="fa fa-eye"></span> Probaj</button>
              <button class="btn btn-success">
              <span class="fa fa-check"></span> Promijeni</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>';?>
      <div class="col-md-4 col-lg-3">
          <?php include('inc/php/side.php');?>
      </div>
  </div>
</div>
<?php include('inc/php/footer.php');?>
</body>
</html>