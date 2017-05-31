<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 11:38
 */
session_start();
include ("db.php");
mysqli_set_charset($c,"utf8");

date_default_timezone_set('Europe/Sarajevo');
if($_SERVER['PHP_SELF']!='/index.php' and !isset($_SESSION['user']))
    header("location:/");

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}