<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 25.05.2017.
 * Time: 07:38
 */
include ("db.php");
mysqli_set_charset($c,"utf8");
date_default_timezone_set("Europe/Sarajevo");
if(isset($_POST["id"]) and $_POST["id"]!=0)
    $tt="where razred = '".$_POST["id"]."' order by BrDn";
else
    $tt=" order by Razred, BrDn";
$qu="select * from users ".$tt;
$q=mysqli_query($c,$qu);
echo'<table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Name & Surname</th>
            <th>Class</th>
            <th>Department</th>
            <th>Registered</th>
          </tr>
        </thead>
        <tbody>';
while($b=mysqli_fetch_array($q)){
    $qq=mysqli_query($c,"select * from Smjerovi WHERE ID='".$b['Smjer']."'");
    $ff=mysqli_fetch_array($qq);
    $dep=$ff['Ime'];
    echo'
          <tr>
            <td>'.$b['BrDn'].'</td>
            <td>'.$b['Ime'].' '.$b['Prezime'].'</td>
            <td>'.$b['Razred'].'</td>
            <td>'.$dep.'</td>
            <td>'.date("d.m.Y",$b["Reg"]).'</td>
          </tr>';
}
echo'
        </tbody>
        </table>';