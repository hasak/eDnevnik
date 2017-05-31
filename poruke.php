<?php
include('inc/php/first.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Poruke &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
    <script type="text/javascript" src="inc/js/poruke.js"></script>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
        <h3><span class="fa fa-envelope-o"></span> Poruke</h3>
      <div class="btn-group col-xs-12" role="group" aria-label="...">
        <button type="button" class="btn btn-default porbtns" id="inbox"><span class="fa fa-download"></span> Dolazne poruke</button>
          <button type="button" class="btn btn-default porbtns" id="send"><span class="fa fa-pencil"></span> Nova poruka</button>
          <button type="button" class="btn btn-default porbtns" id="sent"><span class="fa fa-upload"></span> Poslane poruke</button>
      </div>
      <br><br>
      <div class="container-fluid col-xs-12 por inbox">
          <div class="panel panel-default">
              <div class="panel-heading"><span class="fa fa-envelope"></span> Omar Hassan <span class="pull-right"><span class="fa fa-calendar"></span> <?php echo date("d.m.Y.");?> <span class="fa fa-clock-o"></span> <?php echo date("G:i");?></span></div>
              <div class="panel-body togglable">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, assumenda at consequatur enim est in magni necessitatibus neque, nisi odio officiis porro quaerat rem repellat sed unde veniam voluptatem, voluptatibus!
              </div>
          </div>
          <div class="panel panel-default">
              <div class="panel-heading"><span class="fa fa-envelope-open-o"></span> Jusuf Elfarahati <span class="pull-right"><span class="fa fa-calendar"></span> <?php echo date("d.m.Y.");?> <span class="fa fa-clock-o"></span> <?php echo date("G:i");?></span></div>
              <div class="panel-body togglable">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur distinctio dolorem fuga, omnis quaerat repellendus tempora velit voluptate. Ad aspernatur at corporis ducimus praesentium reiciendis repudiandae, sed unde voluptates. A accusamus amet debitis ea earum enim ex fugiat, illum ipsam ipsum libero natus nesciunt praesentium, qui quos! Alias, laborum, vel.
              </div>
          </div>
      </div>
        <div class="container-fluid col-xs-12 por send">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="fa fa-pencil"></span> Nova poruka</div>
                <div class="panel-body togglable">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Za</span>
                        <input type="text" class="form-control" placeholder="Unesi username" aria-describedby="basic-addon1">
                    </div>
                    <div class="form-group">
                        <label for="comment">Poruka</label>
                        <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>
                    <br>
                    <button class="btn btn-success pull-right"><span class="fa fa-send"></span> Pošalji poruku</button>
                </div>
            </div>
        </div>
        <div class="container-fluid col-xs-12 por sent">
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-envelope"></span> Bakir Brkić <span class="pull-right"><span class="fa fa-calendar"></span> <?php echo date("d.m.Y.");?> <span class="fa fa-clock-o"></span> <?php echo date("G:i");?></span></div>
                <div class="panel-body togglable">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda cumque dignissimos eligendi inventore ipsa non provident quam quas quod quos.
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-envelope"></span> Himzo Hasak <span class="pull-right"><span class="fa fa-calendar"></span> <?php echo date("d.m.Y.");?> <span class="fa fa-clock-o"></span> <?php echo date("G:i");?></span></div>
                <div class="panel-body togglable">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa debitis, dolorum earum esse ex facilis hic illum inventore neque nihil obcaecati odio quaerat quisquam ratione rem, reprehenderit sapiente suscipit tempora tenetur totam ut voluptates?
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