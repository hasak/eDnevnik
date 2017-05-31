<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Statistika &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Postavke</div>
        <div class="panel-body togglable">
        Predmet:
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Predmet <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Predmet 1</a></li>
              <li><a href="#">Predmet 2</a></li>
            </ul>
          </div>
          Mjesec:
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mjesec <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Svi</a></li>
              <li><a href="#">9.</a></li>
              <li><a href="#">10.</a></li>
              <li><a href="#">11.</a></li>
              <li><a href="#">12.</a></li>
              <li><a href="#">1.</a></li>
              <li><a href="#">2.</a></li>
              <li><a href="#">3.</a></li>
              <li><a href="#">4.</a></li>
              <li><a href="#">5.</a></li>
              <li><a href="#">6.</a></li>
            </ul>
          </div>
          <span class="hidden-sm hidden-md hidden-lg"><br></span>
          Razred:
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Razred <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Svi</a></li>
              <li><a href="#">I - V</a></li>
            </ul>
          </div>
          <button class="btn btn-success pull-right">Prikaži!</button>
        </div>
        </div>

        <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-stats"></span> Rezultati</div>
        <div class="panel-body togglable">
          <table class="col-xs-12 table-hover col-sm-3 statTable">
            <thead>
              <tr>
                <th>Ocjena 1</th>
              </tr>
              <tr>
                <th>Datum</th>
                <th>Oc</th>
                <th>Br</th>
                <th>Raz</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.5.2017.</td>
                <td>1</td>
                <td>3</td>
                <td>IV-3</td>
              </tr>
            </tbody>
          </table>
          <table class="col-xs-12 table-hover col-sm-3 col-sm-offset-1 statTable">
            <thead>
              <tr>
                <th>Ocjena 2</th>
              </tr>
              <tr>
                <th>Datum</th>
                <th>Oc</th>
                <th>Br</th>
                <th>Raz</th>
              </tr>
            </thead>
          </table>
          <table class="col-xs-12 table-hover col-sm-3 col-sm-offset-1 statTable">
            <thead>
              <tr>
                <th>Ocjena 3</th>
              </tr>
              <tr>
                <th>Datum</th>
                <th>Oc</th>
                <th>Br</th>
                <th>Raz</th>
              </tr>
            </thead>
          </table>
          <div class="col-xs-12"><br></div>
          <table class="col-xs-12 table-hover col-sm-3 statTable">
            <thead>
              <tr>
                <th>Ocjena 4</th>
              </tr>
              <tr>
                <th>Datum</th>
                <th>Oc</th>
                <th>Br</th>
                <th>Raz</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.5.2017.</td>
                <td>4</td>
                <td>3</td>
                <td>IV-3</td>
              </tr>
            </tbody>
          </table>
          <table class="col-xs-12 table-hover col-sm-3 col-sm-offset-1 statTable">
            <thead>
              <tr>
                <th>Ocjena 5</th>
              </tr>
              <tr>
                <th>Datum</th>
                <th>Oc</th>
                <th>Br</th>
                <th>Raz</th>
              </tr>
            </thead>
          </table>
          <table class="col-xs-12 table-hover col-sm-3 col-sm-offset-1 statTable">
            <thead>
              <tr>
                <th>Ukupno</th>
              </tr>
              <tr>
                <th>Ocjena</th>
                <th>Suma</th>
                <th>%</th>
              </tr>
            </thead>
          </table>
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