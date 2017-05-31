<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 11:37
 */
$c=mysqli_connect("localhost","hasakba_ednevnik","dnevnike123","hasakba_ednevnik");
if(!$c)
    die('Cannot connect:'.mysqli_error($c));