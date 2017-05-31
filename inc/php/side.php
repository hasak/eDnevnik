<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 14:18
 */
if(isset($_SESSION['user'])){
if($_SESSION['prof'])
    $ha="Profesori";
else $ha="users";
    $q2=mysqli_query($c,"select * from ".$ha." where Username='".$_SESSION['user']."'");
    $b=mysqli_fetch_array($q2);

    echo'<div class="container-fluid">
            <h2><span class="fa fa-user"></span> Profesor</h2>
                <a href="#" class="thumbnail profImg">
                    <img src="'.$b['Img'].'">
                </a>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$b['Ime'].'</h3>
                        <i class="list-group-item-text">Ime:</i>
                    </li>
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$b['Prezime'].'</h3>
                        <i class="list-group-item-text">Prezime:</i>
                    </li>';

    if($_SESSION['prof']){
        $qt=mysqli_query($c,"select * from Predmeti where RnBr='".$b['Predmet']."'");
        $hh=mysqli_fetch_array($qt);
        if($b['Razrednik'])
            $raz=$b['Razrednik'];
        else $raz="None";

        echo'
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$hh['Predmet'].'</h3>
                        <i class="list-group-item-text">Predmeti:</i>
                    </li>
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$raz.'</h3>
                        <i class="list-group-item-text">Razrednik:</i>
                    </li>';
    }
    else{

        echo'
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$b['BrDn'].'</h3>
                        <i class="list-group-item-text">Broj:</i>
                    </li>
                    <li class="list-group-item">
                        <h3 class="list-group-item-heading pull-right">'.$b['Razred'].'</h3>
                        <i class="list-group-item-text">Razred:</i>
                    </li>';
    }
    echo'
                </ul>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Napomene</div>
                <div class="panel-body togglable">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto necessitatibus possimus vel. Atque consectetur dicta doloribus eos, exercitationem facilis fugiat, illum inventore laboriosam nobis officiis pariatur porro quasi repudiandae vero!
                </div>
            </div>
        </div>';
}
else {echo'<form action="/" method="post"><div class="container-fluid">
<h2>Login</h2>
<div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="email" type="text" class="form-control" name="user" placeholder="Username">
    </div><p class="text-right text-danger">';
if(isset($erru))
    echo $erru;
else echo '&nbsp;';

echo'
    </p><div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="pass" placeholder="Password">
    </div><p class="text-right text-danger">
    ';
if(isset($errp))
    echo $errp;
else echo '&nbsp;';

echo'</p>
    <button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Log In</button>
</div></form>';}