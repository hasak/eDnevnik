<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 08:29
 */
echo'<div class="bs-component">
   <nav class="navbar navbar-default">
    <div class="container-fluid">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
       <span class="sr-only">Toggle navigation</span>
       <span class="glyphicon glyphicon-th"></span>
      </button>
      <a href="/" class="navbar-brand"><span><img src="/inc/ico.ico" alt="Logo" height="24px"></span> eDnevnik</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav">
      <li><a href="/dnevnik.php" class="dnevnikNavBtn"><span class="fa fa-fw fa-book"></span> Dnevnik</a></li>
         <li><a href="/poruke.php" class="porukeNavBtn"><span class="fa fa-fw fa-envelope"></span> Poruke <span class="badge">1</span></a></li>
         <li><a href="/ucenici.php" class="uceniciNavBtn"><span class="fa fa-fw fa-certificate"></span> Obavijesti <span class="badge">3</span></a></li>
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-fw fa-file-text"></span> Datoteke <span class="caret"></span></a>
       <ul class="dropdown-menu" role="menu">
      <li><a href="/upload.php" class="uploadNavBtn"><span class="fa fa-fw fa-arrow-circle-o-up"></span> Upload</a></li>
      <li><a href="/download.php" class="downloadNavBtn"><span class="fa fa-fw fa-arrow-circle-o-down"></span> Download</a></li>
        </ul>
      </li>
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-fw fa-sliders"></span> Alati <span class="caret"></span></a>
       <ul class="dropdown-menu" role="menu">
     
         <li><a href="/profil.php" class="profilNavBtn"><span class="fa fa-fw fa-user"></span> Profil</a></li>
         <li><a href="/ucenici.php" class="uceniciNavBtn"><span class="fa fa-fw fa-users"></span> Učenici</a></li>
         <li><a href="/statistika.php" class="statistikaNavBtn"><span class="fa fa-fw fa-bar-chart"></span> Statistika</a></li>
         <li class="divider"></li>
         <li><a href="/postavke.php" class="postavkeNavBtn"><span class="fa fa-fw fa-wrench"></span> Postavke</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/ap.php" class="panelUpraveNavBtn"><span class="fa fa-fw fa-cog fa-spin"></span> Panel uprave</a></li>
      <li><a href="/odjava" class="odjavaNavBtn"><span class="fa fa-fw fa-sign-out"></span> Odjava</a></li>
    </ul>
    </div>
  </div>
 </nav>
</div>';