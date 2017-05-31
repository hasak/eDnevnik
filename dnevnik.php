<?php
include('inc/php/first.php');
include('inc/php/dnev.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dnevnik &ndash; eDnevnik</title>
    <?php include('inc/php/head.php');?>
</head>
<body>
<?php include('inc/php/nav.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-7 col-lg-offset-1">
        <?php if(isset($_SESSION['user']))
        {
            if($_SESSION['prof']==true)
            {




                if(isset($_GET['razz']) or isset($_SESSION['post']) or isset($_GET['klasa']))
                {
                    if(isset($_SESSION['post'])) unset($_SESSION['post']);
                    //$query=mysqli_query($c,"select * from Spisak");

                    //$proba="'".$pred."'";
                    $qaa=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
                    $redd=mysqli_fetch_array($qaa);


                    $a23=mysqli_query($c,"select * from Vise where Profa='".$redd['RnBr']."'");
                    if(mysqli_num_rows($a23)!=0)
                    {if($_GET['nacin']==0 or $_GET['nacin']==3)
                        $pred2="Choose student";
                    else $pred2="Enter grades";
                    }
                    //if($klas==true)
                    //{
                    //$as=mysqli_fetch_array(mysqli_query($c,"select * from Klase where ID='".$razz."'"));
                    //$razz=$as['Ime'];
                    //}
                    echo"<h3>".$pred2." &ndash; ".$razz."</h3>
		";

                    if($_GET['nacin']==0 or $_GET['nacin']==3)
                    {
                        echo"<form action='ucenik' method='post'>
		<input type='hidden' name='vrta' value='".$_GET['nacin']."'>
		<div class='ScrollbarUceniciDnevnik' id='Stil1'>
		<table class='table table-hover hp'>
		<thead><th>Broj</th><th>Učenik</th><th>Zadnja obicna ocjena</th></thead>
		";
                        while($b=mysqli_fetch_array($query))
                        {
                            if($klas==false)
                            {
                                $aa1=$b['Broj'];
                                $raz=$razz;
                                $predm=$pred;$ff[$raz]=$b[$razz];
                            }
                            else{
                                $raz=$b['ruc'];
                                $aa1=$b['bruc'];
                                $predm=$josq['Pred'];
                                $zaim=mysqli_query($c,"select * from Spisak where Broj='".$aa1."'");
                                $ff=mysqli_fetch_array($zaim);
                            }
                            echo "
		<input type='hidden' name='predbro' value='".$predm."'>";
                            //if($b['Broj']!=0)
                            //{

                            //$bbb=-$aa;
                            //if($b[$pred]!='0')
                            //$vv=$b[$pred];
                            //else $vv=" ";
                            //$q=mysqli_query($c,"select * from Spisak where Broj='".$aa."'");
                            $prik=mysqli_query($c,"select * from Izmjene where BrojUc='".$aa1."' and Razred = '".$raz."' and Predmet = '".$predm."' and Zakljucna='1' order by RnBr desc");
                            if(mysqli_num_rows($prik)!=0)
                            {
                                $stil="";
                                $zar2=mysqli_fetch_array($prik);
                                $focj="<i><b>Zaključeno: </b><b id='stil_ocjene'>".$zar2['Ocjena']."</b></i>";
                            }
                            else{
                                $stil="id='stil_ocjene'";
                                $noviq=mysqli_query($c,"select * from Izmjene where BrojUc='".$aa1."' and Razred = '".$raz."' and Predmet = '".$predm."' and Zakljucna='0' and Tajp='0' order by RnBr desc");

                                if(mysqli_num_rows($noviq)!=0)
                                {
                                    $zar=mysqli_fetch_array($noviq);
                                    $focj=date("d.m",$zar['Datum'])." (<b>".$zar['Ocjena']."</b>)";
                                }
                                else $focj="&nbsp";
                            }
                            //$cc=mysqli_fetch_array($q);
                            //if($klas==false)

                            if($b[$raz]!="" or $klas==true)//name='ucen'
                                echo"<tr data-toggle='modal' data-target='#myModal".$aa1."'>
		
		<td>".$aa1."</td>
		<td>".$ff[$raz]."</td>
		<td>".$focj."</td>
		</tr>
		<div id='myModal".$aa1."' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>".$ff[$raz]."</h4>
      </div>
      <div class='modal-body'>
        <img class='colo-xs-4 avatarImgModal' src='#'>
        <p class='gradeEntryModal'>Subject:________ Grade:______ <button class='btn btn-primary' style='margin-right:5px;'><span class='fa fa-pencil'></span> Change</button><button class='btn btn-danger'><span class='fa fa-times'></span> Delete</button></p>
        <p class='gradeEntryModal'>Subject:________ Grade:______ <button class='btn btn-primary' style='margin-right:5px;'><span class='fa fa-pencil'></span> Change</button><button class='btn btn-danger'><span class='fa fa-times'></span> Delete</button></p>
        <div>
            <h3>Enter new grade:</h3>
            <div class=\"btn-group\">
            <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
             <span class='fa fa-book'></span> Subject <span class=\"caret\"></span>
            </button>
            <ul class=\"dropdown-menu\">
              <li><a href=\"#\">Predmeti1</a></li>
              <li><a href=\"#\">Predmet2</a></li>
            </ul>
          </div>
          <div class='col-xs-offset-3'>
          1 <input type='radio' name='grade' value='1'>
          2 <input type='radio' name='grade' value='2'>
          3 <input type='radio' name='grade' value='3'>
          4 <input type='radio' name='grade' value='4'>
          5 <input type='radio' name='grade' value='5'></p>
          </div>
          <btn class='btn btn-success pull-right'><span class='glyphicon glyphicon-ok'></span> Enter grade</btn>
          <br><br>
        </div>
      </div>
      <div class='modal-footer'>
      
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>
		";
                            //echo"";
                            /*echo"<td>".$vv."</td>
                            
                            <td><input type='text' maxlength='1' name='".$aa."' style='width:70px; background-color:#ffe6df; border-width:1px; border-color:#f0f0f0;'></td>
                            <td><input type='text' maxlength='1' name='".$bbb."' style='width:50px; background-color:#aaa; color:white; border-width:1px; float:right; border-color:#f0f0f0;'></td></tr>";
                            */
                            //}
                        }
                        echo"
		</table><input type='hidden' name='rzz' value='".$raz."'></div></form>
		";
                    }
                    else{
                        echo"<form action='http://".$_SERVER['HTTP_HOST']."/dnevnik' method='post'>
		<br><table id='datumdnev'><tr><td>Datum: </td>";
                        $c=0;

                        $unix=time();
                        while($c<10)
                        {
                            if(date("N",$unix)<6)
                            {
                                if($c==0)
                                    $aas="checked"; else $aas="";
                                $pocd=date("j",$unix);
                                $pocm=date("n",$unix);
                                echo"<td><input style='position:absolute; left:-9999px;' type='radio' id='".$c."' name='datun' value='".$unix."'".$aas."><label for='".$c."'>".$pocd.".".$pocm."</label></td>";

                                $c=$c+1;
                            }

                            $unix=$unix-86400;
                        }



                        /*while($c<7)
                        {
                                if(aaa($dds-$i)!=6 and aaa($dds-$i)!=7)
                                {
                                        $dan=$dd-$i;
                                        $me=$dm;
                                        if($dan<1)
                                        {$me=$me-1;$dan=ss($dan,$me);}
                                        echo "<option value='".$i."'>".$dan.".".$me."</option>";
                                        $c=$c+1;
                                }$i=$i+1;
                        }*/


                        echo"</tr></table>";
                        $qaa=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
                        $redd=mysqli_fetch_array($qaa);
                        $a23=mysqli_query($c,"select * from Vise where Profa='".$redd['RnBr']."'");
                        if(mysqli_num_rows($a23)==0)
                            echo"
		<input type='hidden' name='predbro' value='".$pred."'>";
                        else{
                            $hgf2=mysqli_query($c,"select * from Predmeti where RnBr='".$pred."'");
                            $adas2=mysqli_fetch_array($hgf2);
                            $prmdt2=$adas2['Predmet'];

                            echo"
		<br><table id='datumdnev'><tr><td>Predmet: </td>
		<td><input style='position:absolute; left:-9999px;' type='radio' id='asd' name='predbro' value='".$pred."' checked><label for='asd'>".$prmdt2."</label></td>";
                            while($t=mysqli_fetch_array($a23))
                            {

                                $hgf=mysqli_query($c,"select * from Predmeti where RnBr='".$t['Pred']."'");
                                $adas=mysqli_fetch_array($hgf);
                                $prmdt=$adas['Predmet'];
                                echo"<td><input style='position:absolute; left:-9999px;' type='radio' id='asd".$t['ID']."' name='predbro' value='".$t['Pred']."'><label for='asd".$t['ID']."'>".$prmdt."</label></td>";
                            }

                            echo"</tr></table>";}

                        echo"<br>
		<div class='ScrollbarUceniciDnevnik' id='Stil1'>
		<table class='tabela'>
		<tr id='prvi_red'><td>Broj</td><td>Učenik</td><td>Unos</td></tr>
		";
                        while($b=mysqli_fetch_array($query))
                        {


                            if($klas==false)
                            {
                                $aa1=$b['Broj'];
                                $raz=$razz;
                                $predm=$pred;$ff[$raz1]=$b[$razz];
                            }
                            else{
                                $raz=$b['IDklase'];
                                $raz1=$b['ruc'];
                                $aa1=$b['bruc'];
                                $predm=$josq['Pred'];
                                $zaim=mysqli_query($c,"select * from Spisak where Broj='".$aa1."'");
                                $ff=mysqli_fetch_array($zaim);
                            }







                            //if($b['Broj']!=0)
                            //{
                            //$aa=$b['Broj'];
                            //}
                            //$cc=mysqli_fetch_array($q);
                            if($b[$razz]!="" or $klas==true)//name='ucen'
                            {
                                echo"<tr>
		
		<td id='prva_cell'>".$aa1."</td>
		<td><i>".$ff[$raz1]."</i></td>
		<td class='crveno'>";
                                //<input type='text' name='".$aa."' maxlength='1' style='width:25px; font-family:Lucida Handwriting; text-align:center;'>
                                echo"
		<select class='datun' name='".$aa1."' id='oce' style='width:25px; text-align:center;'><option value='0'></option>";
                                for($i=1;$i<6;$i=$i+1)
                                    echo"<option value='".$i."' style='text-align:center;'>".$i."</option>";
                                echo"</select>
		</td>
		</tr>
		";}
                            //echo"";
                            /*echo"<td>".$vv."</td>
                            
                            <td><input type='text' maxlength='1' name='".$aa."' style='width:70px; background-color:#ffe6df; border-width:1px; border-color:#f0f0f0;'></td>
                            <td><input type='text' maxlength='1' name='".$bbb."' style='width:50px; background-color:#aaa; color:white; border-width:1px; float:right; border-color:#f0f0f0;'></td></tr>";
                            */
                        }
                        echo"
		</table><input type='hidden' name='rzz' value='".$raz."'>
		<input type='hidden' name='dalkl' value='".$klas."'><input type='hidden' name='vrta' value='".$_GET['nacin']."'>
		<br><br><input type='submit' name='okid' value='Unesi sve' class='button2'></div></form><br><br>
		";}


                }


                else{
                    //echo $razu;
                    $dalidir=mysqli_query($c,"select * from Profesori where Username = '".$_SESSION['user']."'");
                    $redd=mysqli_fetch_array($dalidir);
                    if($redd['Direktor']==1)
                        $target="action='dnevnici' target='_blank'";
                    else $target="action='spis'";
                    $izses=$redd['Predmet'];
                    $query=mysqli_query($c,"select * from Predmeti where RnBr = '".$izses."'");


                    $kojimraz=mysqli_query($c,"select * from Razredi where ID = '".$redd['RnBr']."'");
                    $redzaraz=mysqli_fetch_array($kojimraz);
                    $kolum=mysqli_num_fields($kojimraz);
                    $cpp=1;
                    $cp=0;
                    echo"<h2><span class='fa fa-book'></span> Dnevnik</h2><br>
<ul class=\"nav nav-tabs nav-justified txlg\">
    
    <li class='active'><a data-toggle=\"tab\" href=\"#menu1\"><span class='fa fa-fw fa-graduation-cap'></span> Ocjene</a></li>
    <li><a data-toggle=\"tab\" href=\"#menu2\"><span class='fa fa-fw fa-calendar'></span> Časovi</a></li>
    <li><a data-toggle=\"tab\" href=\"#menu3\"><span class='fa fa-fw fa-heartbeat'></span> Izostanci</a></li>
  </ul><br>";

                    $fec=mysqli_fetch_array($query);
                    if($redd['Direktor']!=1)
                        $pred=$fec['Predmet'];
                    else $pred="Dnevnik od";
                    //$p=".php";
                    echo"
				";
                    if(isset($razu))
                        echo $razu."<br>";
                    echo"<div id='profesor_razredi'><div id='div'>";

                    $a=mysqli_query($c,"select * from Vise where Profa='".$redd['RnBr']."'");
                    if(mysqli_num_rows($a)!=0)
                    {
                        echo"";
                    }
                    else
                        echo"
				".$pred.":
				
				";

                    echo"<div class=\"tab-content\">
    <div id=\"menu1\" class=\"tab-pane fade in active\">
    <div class='container-fluid'><h3><span class='fa fa-fw fa-graduation-cap'></span> Ocjene <small>Unesite, pregledajte ili uredite ocjene</small></h3><br>
    <div class='form-inline'><span class='fa fa-pencil-square-o fa-fw'></span> Vrsta ocjene: <input type='radio' name='vrsta' id='ob' value='0' checked><label for='ob'><span class='fa fa-sticky-note-o'></span> Obična</label>
<input type='radio' name='vrsta' id='ts' value='1'><label for='ts'><span class='fa fa-check-square-o'></span> Test</label>
<input type='radio' name='vrsta' id='ps' value='2'><label for='ps'><span class='fa fa-pencil'></span> Pismena</label>
<input type='radio' name='vrsta' id='rc' value='3'><label for='rc'><span class='fa fa-hand-peace-o'></span> Ručno</label><br><span class='fa fa-fw fa-group'></span> Razred: ";
              $r=mysqli_query($c,"select * from Razredi where ID = '".$redd['RnBr']."'");
                    $b=mysqli_fetch_array($r);
                    $aas=mysqli_num_fields($r);
                    for($i=0;$i<$aas;$i=$i+1)
                    {
                        $imeraz=mysqli_field_name($r,$i);
                        if($b[$i]==1)
                            echo"<button class='btn btn-default' style='margin-right: 5px;'>".$imeraz."</button>";

                    }

                    echo"
            </div></div></div>
				<div id=\"menu2\" class=\"tab-pane fade\">
      <div class='container-fluid'><h3><span class='fa fa-fw fa-calendar'></span> Časovi <small>Unesite čas ili pregledajte šta ste prešli</small></h3></div>
      </div>
    <div id=\"menu3\" class=\"tab-pane fade\">
      <div class='container-fluid'><h3><span class='fa fa-fw fa-heartbeat'></span> Izostanci <small>Zapišite izostanak učenika</small></h3></div>
    </div>
				
				</div></div></div>
				
				
				
				
				<div id='sablon' style='display:none;'><form action='http://".$_SERVER['HTTP_HOST']."/spam/freq' method='get' target='_blank'>
				<table id='datumdnev'><tr><td style='width:70px;'>Razred: </td>";
                    $r=mysqli_query($c,"select * from Razredi where ID = '".$redd['RnBr']."'");
                    $b=mysqli_fetch_array($r);
                    $aas=mysqli_num_fields($r);
                    for($i=0;$i<$aas;$i=$i+1)
                    {
                        $imeraz=mysql_field_name($r,$i);
                        if($b[$imeraz]==1)
                            echo"<td><input type='radio' name='razz' id='123".$imeraz."' value='".$imeraz."' style='position:absolute; left:-9999px;'><label for='123".$imeraz."'>".$imeraz."</label></td>";

                    }
                    echo"</tr></table>";

                    $qaa43=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
                    $redd43=mysqli_fetch_array($qaa43);

                    $sigpre=$redd43['Predmet'];
                    $juztg=mysqli_query($c,"select * from Predmeti where RnBr='".$sigpre."'");
                    $jhzt=mysqli_fetch_array($juztg);
                    $imp=$jhzt['Predmet'];
                    $ght=mysqli_query($c,"select * from Vise where Profa='".$redd43['RnBr']."'");
                    if(mysqli_num_rows($ght)!=0)
                    {
                        echo "<table id='datumdnev'><tr><td style='width:90px;'>Predmet: </td>";

                        echo "<td><input type='radio' name='pred' id='00' value='".$sigpre."' style='position:absolute; left:-9999px;' checked><label for='00'>".$imp."</label></td>";
                        while($b=mysqli_fetch_array($ght))
                        {
                            $tdpr=$b['Pred'];
                            $juztg2=mysqli_query($c,"select * from Predmeti where RnBr='".$tdpr."'");
                            $jhzt2=mysqli_fetch_array($juztg2);
                            $imp2=$jhzt2['Predmet'];
                            echo"<td><input type='radio' name='pred' id='".$tdpr."43' value='".$tdpr."' style='position:absolute; left:-9999px;'><label for='".$tdpr."43'>".$imp2."</label></td>";
                        }
                        echo"</tr></table>";
                    }
                    else echo"<input type='hidden' name='pred' value='".$sigpre."'>";
                    echo"
				<br>Datum prvog časa: <select name='poc'>";
                    for($i=1421622000;$i<1433026800;$i=$i+86400)
                    {
                        if(date("N",$i)<6)
                            echo"<option value='".$i."'>".date("d.m",$i)."</option>";
                    }

                    echo"</select><br>Broj prvog časa: 
				<select name='cas'>";
                    for($i=1;$i<150;$i=$i+1)
                    {
                        echo"<option value='".$i."'>".$i."</option>";
                    }

                    echo"</select>
				<br>Broj kolona: 
				<select name='brk'>";
                    for($i=1;$i<150;$i=$i+1)
                    {
                        if($i==40)
                            $selc="selected";
                        else $selc="";
                        echo"<option value='".$i."' ".$selc.">".$i."</option>";
                    }

                    echo"</select><br><br>
				<table id='datumdnev'><tr><td style='width:150px;'>Veličina reda: </td>
				<td><input type='radio' name='vel' id='prv' value='1' style='position:absolute; left:-9999px;' checked><label for='prv'>1</label></td>
				<td><input type='radio' name='vel' id='drg' value='2' style='position:absolute; left:-9999px;'><label for='drg'>2</label></td>
				<td><input type='radio' name='vel' id='trc' value='3' style='position:absolute; left:-9999px;'><label for='trc'>3</label></td></tr></table>
				<br><br>
				
				<input type='checkbox' name='pon' id='pon' value='1'><label for='pon' style='cursor:pointer'>Ponedjeljak</label><br>
				<input type='checkbox' name='uto' id='uto' value='1'><label for='uto' style='cursor:pointer'>Utorak</label><br>
				<input type='checkbox' name='sri' id='sri' value='1'><label for='sri' style='cursor:pointer'>Srijeda</label><br>
				<input type='checkbox' name='cet' id='cet' value='1'><label for='cet' style='cursor:pointer'>Četvrtak</label><br>
				<input type='checkbox' name='pet' id='pet' value='1'><label for='pet' style='cursor:pointer'>Petak</label><br>
				<br>
				<table id='datumdnev'><tr><td style='width:250px;'>Unijeti dosadašnje ocjene? </td>
				<td><input type='radio' name='dos' id='dos0' value='0' style='position:absolute; left:-9999px;' checked><label for='dos0'>Ne</label></td>
				<td><input type='radio' name='dos' id='dos1' value='1' style='position:absolute; left:-9999px;'><label for='dos1'>Da</label></td>
				</tr></table>
				<br><br>
				<input type='submit' class='button2' value='Napravi'><br><br>
				</form></div>
				
				";}}
            else{
                $gdje=mysqli_query($c,"select * from users where username ='". $_SESSION['user']."'");
                $red=mysqli_fetch_array($gdje);
                $rzaza=$red['Razred'];
                $smer=$red['Smjer'];
                if($red['Fran'])
                    $fa=3;
                else $fa=4;
                $ng=mysqli_fetch_array(mysqli_query($c,"select * from Smjerovi where ID='".$smer."'"));
                if(!$ng['Klavir'])
                    $nemoj=27;
                else $nemoj=null;
                if(!$ng['Kor'])
                    $nemoj2=34;
                else $nemoj2=null;
                /*$jelfrancuz=$red['Fran'];
                $jeleticar=$red['Etika'];
                if($rzaza!="3a" and $rzaza!="4a")
                if($jelfrancuz==1) $nemoj=3; else $nemoj=4; else $nemoj=null;
                if($jeleticar==1) $nemoj2=17; else $nemoj2=11;*/
                //echo $jeleticar;
                $br=$red['BrDn'];

                $zniz[]=0;
                $zazk[]=0;
                $cp=0;$cpp=0;$cppp=0;//$josj=0;
                $r=0;$zz[]=0;
                $novv=mysqli_query($c,"select * from PredPoRazz");

                echo"
				
				<div id='navigacijaa2' style='cursor:pointer;'>
				<ul id='nav2'>
				<li><a onClick='PrikaziOcjene()'>OCJENE</a></li>
				<li><a onClick='PrikaziObavijestiRazrednik()'>OBAVIJESTI - RAZREDNIK</a></li>
				<li><a onClick='PrikaziObavijestiDirektor()'>OBAVIJESTI - UPRAVA</a></li></ul>
				<ul class='zadnjiunav'>
				<li><a onClick='PrikaziVladanja()'>VLADANJE</a></li>
				</ul></div>
				
				<div id='ocjeneucenici'>
				<br><br>
				<table class='tabela'><tr id='prvi_red'>";
                while($cp<6 and $bcc=mysqli_fetch_array($novv))
                {
                    if($bcc[$rzaza]!=0){
                        $sel=mysqli_query($c,"select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
                        $sadur=mysqli_fetch_array($sel);
                        $print=$sadur['Predmet'];
                        if(!mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bcc['Predmet']."'")))
                            if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
                            {
                                echo"<td>".$print."</td>";
                                $cp=$cp+1;
                            }
                    }
                }
                echo"</tr><tr>";
                $nvv=mysqli_query($c,"select * from PredPoRazz");
                while($cpp<$cp and $bbcc=mysqli_fetch_array($nvv))
                {

                    if($bbcc[$rzaza]!=0 and !mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bbcc['Predmet']."'")) and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
                    ){
                        $zz[$cpp]=$bbcc['Predmet'];
                        $hjooj=mysqli_query($c,"select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
                        echo"<td id='stil_ocjene'>";
                        $tmo=0;
                        $inkr=0;
                        while($ajd=mysqli_fetch_array($hjooj))
                        {if($ajd['Tajp']==3)
                            $jojoj=$ajd['Custom'];
                        else if($ajd['Tajp']==2) $jojoj="Pismena";
                        else if($ajd['Tajp']==1) $jojoj="Test";
                        else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
                            echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
                            $tmo=$tmo+$ajd['Ocjena'];
                            $inkr=$inkr+1;
                        }
                        echo"</td>";
                        if($inkr!=0)
                            $zniz[$cpp]=$tmo/$inkr;
                        else $zniz[$cpp]=0;
                        $cpp=$cpp+1;}
                }

                echo"</tr><tr>";
                while($cppp<6)
                {
                    $trp=$zz[$cppp];
                    $zadnja=mysqli_query($c,"select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
                    if(mysqli_num_rows($zadnja)==0)
                    {
                        if($zniz[$cppp]!=0)
                        {
                            if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
                                $khmm=floor($zniz[$cppp]/1);
                            else $khmm=floor($zniz[$cppp]/1)+1;
                            $prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
                            $zazk[$cppp]=$khmm;
                        }

                        else {$prs=" ";$zazk[$cppp]=0;}
                    }else{

                        $der=mysqli_fetch_array($zadnja);
                        $zazk[$cppp]=$der['Ocjena'];
                        $prs="<b>".$der['Ocjena']."</b>";
                    }
                    echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
                    $cppp=$cppp+1;
                }

                echo"</tr></table><br>";








                echo"<table class='tabela'><tr id='prvi_red'>";
                while($bcc=mysqli_fetch_array($novv) and $cp<12)
                {
                    if($bcc[$rzaza]!=0 and !mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bcc['Predmet']."'"))){
                        $sel=mysqli_query($c,"select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
                        $sadur=mysqli_fetch_array($sel);
                        $print=$sadur['Predmet'];
                        if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
                            echo"<td>".$sadur['Predmet']."</td>";
                        $cp++;}
                }
                echo"</tr><tr>";
                while($bbcc=mysqli_fetch_array($nvv) and $cpp<12)
                {
                    if($bbcc[$rzaza]!=0 and !mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bbcc['Predmet']."'")) and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
                    ){
                        $zz[$cpp]=$bbcc['Predmet'];
                        $hjooj=mysqli_query($c,"select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
                        echo"<td id='stil_ocjene'>";
                        $tmo=0;
                        $inkr=0;
                        while($ajd=mysqli_fetch_array($hjooj))
                        {if($ajd['Tajp']==3)
                            $jojoj=$ajd['Custom'];
                        else if($ajd['Tajp']==2) $jojoj="Pismena";
                        else if($ajd['Tajp']==1) $jojoj="Test";
                        else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
                            echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
                            $tmo=$tmo+$ajd['Ocjena'];
                            $inkr=$inkr+1;

                        }
                        if($inkr!=0)
                            $zniz[$cpp]=$tmo/$inkr;
                        else $zniz[$cpp]=0;
                        //$josj=$josj+1;
                        echo"</td>";
                        $cpp=$cpp+1;}
                }

                echo"</tr><tr>";
                while($cppp<$cpp)
                {
                    $trp=$zz[$cppp];
                    $zadnja=mysqli_query($c,"select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
                    if(mysqli_num_rows($zadnja)==0)
                    {
                        if($zniz[$cppp]!=0)
                        {
                            if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
                                $khmm=floor($zniz[$cppp]/1);
                            else $khmm=floor($zniz[$cppp]/1)+1;
                            $prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
                            $zazk[$cppp]=$khmm;
                        }
                        else {$prs=" ";$zazk[$cppp]=0;}
                    }else{

                        $der=mysqli_fetch_array($zadnja);
                        $zazk[$cppp]=$der['Ocjena'];
                        $prs="<b>".$der['Ocjena']."</b>";
                    }
                    echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
                    $cppp=$cppp+1;
                }
                /*$uhh=0;
                for($i=0;$i<$cppp;$i=$i+1)
                if($zazk[$i]!=0)
                {
                    $r=$r+$zazk[$i];
                    $uhh=$uhh+1;
                }
                if($uhh!=0)
                $trss=$r/$uhh;else $trss=0;
                $jjoj=number_format($trss,2);
                if($trss-floor($trss/1)<0.5)
                $npknz=floor($trss/1);
                else $npknz=floor($trss/1)+1;*/
                echo"</tr></table><br>";

                echo"<table class='tabela'><tr id='prvi_red'>";
                while($bcc=mysqli_fetch_array($novv))
                {
                    if($bcc[$rzaza]!=0){
                        $sel=mysqli_query($c,"select * from Predmeti where RnBr = '".$bcc['Predmet']."'");
                        $sadur=mysqli_fetch_array($sel);
                        $print=$sadur['Predmet'];
                        if($bcc['Predmet']!=$nemoj and $bcc['Predmet']!=$nemoj2 and $bcc['Predmet']!=$fa)
                            if(!mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bcc['Predmet']."'")))
                                echo"<td>".$sadur['Predmet']."</td>";}
                }
                $selec=mysqli_query($c,"select * from Struka where Smjer='".$smer."'");
                while($b=mysqli_fetch_array($selec))
                {
                    $sel=mysqli_query($c,"select * from Predmeti where RnBr = '".$b['Pred']."'");
                    $sadur=mysqli_fetch_array($sel);
                    $print=$sadur['Predmet'];
                    echo"<td>".$sadur['Predmet']."</td>";
                }

                echo"</tr><tr>";
                while($bbcc=mysqli_fetch_array($nvv))
                {
                    if($bbcc[$rzaza]!=0 and !mysqli_num_rows(mysqli_query($c,"select * from Struka where Pred='".$bbcc['Predmet']."'"))and $bbcc['Predmet']!=$nemoj and $bbcc['Predmet']!=$nemoj2 and $bbcc['Predmet']!=$fa
                    ){
                        $zz[$cpp]=$bbcc['Predmet'];
                        $hjooj=mysqli_query($c,"select * from Izmjene where Predmet ='".$bbcc['Predmet']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
                        echo"<td id='stil_ocjene'>";
                        $tmo=0;
                        $inkr=0;
                        while($ajd=mysqli_fetch_array($hjooj))
                        {if($ajd['Tajp']==3)
                            $jojoj=$ajd['Custom'];
                        else if($ajd['Tajp']==2) $jojoj="Pismena";
                        else if($ajd['Tajp']==1) $jojoj="Test";
                        else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
                            echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
                            $tmo=$tmo+$ajd['Ocjena'];
                            $inkr=$inkr+1;

                        }
                        if($inkr!=0)
                            $zniz[$cpp]=$tmo/$inkr;
                        else $zniz[$cpp]=0;
                        //$josj=$josj+1;
                        echo"</td>";
                        $cpp=$cpp+1;}
                }
                $selec=mysqli_query($c,"select * from Struka where Smjer='".$smer."'");
                while($b=mysqli_fetch_array($selec))
                {
                    $zz[$cpp]=$b['Pred'];
                    $hjooj=mysqli_query($c,"select * from Izmjene where Predmet ='".$b['Pred']."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =0");
                    echo"<td id='stil_ocjene'>";
                    $tmo=0;
                    $inkr=0;
                    while($ajd=mysqli_fetch_array($hjooj))
                    {if($ajd['Tajp']==3)
                        $jojoj=$ajd['Custom'];
                    else if($ajd['Tajp']==2) $jojoj="Pismena";
                    else if($ajd['Tajp']==1) $jojoj="Test";
                    else if($ajd['Tajp']==0) $jojoj="Obična ocjena";
                        echo "<span class='bojaoc".$ajd['Tajp']."' style='cursor:help;' title='".$jojoj."'>".date("d.m",$ajd['Datum'])." (<b>".$ajd['Ocjena']."</b>)</span><br>";
                        $tmo=$tmo+$ajd['Ocjena'];
                        $inkr=$inkr+1;

                    }
                    if($inkr!=0)
                        $zniz[$cpp]=$tmo/$inkr;
                    else $zniz[$cpp]=0;
                    //$josj=$josj+1;
                    echo"</td>";
                    $cpp=$cpp+1;
                }

                echo"</tr><tr>";
                while($cppp<$cpp)
                {
                    $trp=$zz[$cppp];
                    $zadnja=mysqli_query($c,"select * from Izmjene where Predmet ='".$trp."' and BrojUc='".$br."' and Razred='".$rzaza."' and Zakljucna =1");
                    if(mysqli_num_rows($zadnja)==0)
                    {
                        if($zniz[$cppp]!=0)
                        {
                            if($zniz[$cppp]-floor($zniz[$cppp]/1)<0.5)
                                $khmm=floor($zniz[$cppp]/1);
                            else $khmm=floor($zniz[$cppp]/1)+1;
                            $prs=number_format($zniz[$cppp],2)." (<b>".$khmm."</b>)";
                            $zazk[$cppp]=$khmm;
                        }
                        else {$prs=" ";$zazk[$cppp]=0;}
                    }else{

                        $der=mysqli_fetch_array($zadnja);
                        $zazk[$cppp]=$der['Ocjena'];
                        $prs="<b>".$der['Ocjena']."</b>";
                    }
                    echo"<td id='stil_ocjene' class='crveno'>".$prs."</td>";
                    $cppp=$cppp+1;
                }
                $uhh=0;
                for($i=0;$i<$cppp;$i=$i+1)
                    if($zazk[$i]!=0)
                    {
                        $r=$r+$zazk[$i];
                        $uhh=$uhh+1;
                    }
                if($uhh!=0)
                    $trss=$r/$uhh;else $trss=0;
                $jjoj=number_format($trss,2);
                if($trss-floor($trss/1)<0.5)
                    $npknz=floor($trss/1);
                else $npknz=floor($trss/1)+1;
                echo"</tr></table><br><br>
				
				<div class='prosjek'>Prosjek ocjena:  <b id='stil_ocjene' style='font-size:14pt;'>".$jjoj." (".$npknz.")</b> </div>
				
				
				</div>";





                /*
                $br2=mysqli_query($c,"select * from ".$red['Razred']." where Broj ='". $br."'");
                $br3=mysqli_query($c,"select * from ".$red['Razred']." where Broj ='0'");
                $red2=mysqli_fetch_array($br2);
                $red3=mysqli_fetch_array($br3);
                $kolonaa=mysqli_num_fields($br2);
                $inc=1;$inc2=1;
                echo "
                <br>
                <font style='color:#000000;'><p><b> Ocjene: </b></p></font><br>";
                echo"<table border='1' style='color:#000000; border-color:#000000; border-style:none; border-collapse:collapse; width:600px'>
                <tr align='center'>
                    <td id='tabela1'><b style='color:white;'>Broj</b></td>
                    ";
                    while($inc2<8)
                    {
                        $que=mysqli_query($c,"select * from Predmeti where RnBr ='".$red3[$inc2]."'");
                        $fetc=mysqli_fetch_array($que);
                        $sadkoji=$red3[$inc2];
                        if($sadkoji=='3')
                        $njegdje=$inc2;
                        if($sadkoji=='4')
                        $fragdje=$inc2;
                        if($sadkoji=='11')
                        $etgdje=$inc2;
                        if($sadkoji=='17')
                        $vjegdje=$inc2;
                    
                        
                        if($red3[$inc2]!='3' && $red3[$inc2]!='4' && $red3[$inc2]!='11' && $red3[$inc2]!='17')
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        else {
                        if($red3[$inc2]=='3' && $jelfrancuz==0)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='4' && $jelfrancuz==1)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='11' && $jeleticar==1)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='17' && $jeleticar==0)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                }
                        $inc2=$inc2+1;
                    }
                    
                        if($jeleticar==1)
                        $neces2=$vjegdje;
                        else $neces2=$etgdje;
                        if($jelfrancuz==1)
                        $neces=$njegdje;
                        else $neces=$fragdje;
                    echo"
                </tr>
                <tr align='center'>
                    <td style='color:#000000;'><b>".$br."</b></td>
                    ";
                    while($inc<8)
                    {
                    //echo $nemoj.$nemoj;
                    if($inc!=$neces && $inc!=$neces2){
                    if($red2[$inc]!='0')
                    $bla=$red2[$inc];
                    else $bla=" ";
                        echo"<td>".$bla."</td>";}
                        $inc=$inc+1;
                    
                    }
                    
                    echo"</tr>
                </table><br><br>
                <table border='1' style='color:#000000; border-color:#000000; border-style:none; border-collapse:collapse; width:600px;'>
                <tr align='center'>";
                
                while($inc2<$kolonaa-1)
                    {
                        $que=mysqli_query($c,"select * from Predmeti where RnBr ='".$red3[$inc2]."'");
                        $fetc=mysqli_fetch_array($que);
                        $sadkoji=$red3[$inc2];
                        if($sadkoji=='3')
                        $njegdje=$inc2;
                        if($sadkoji=='4')
                        $fragdje=$inc2;
                        if($sadkoji=='11')
                        $etgdje=$inc2;
                        if($sadkoji=='17')
                        $vjegdje=$inc2;
                    
                        
                        if($red3[$inc2]!='3' && $red3[$inc2]!='4' && $red3[$inc2]!='11' && $red3[$inc2]!='17')
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        else {
                        if($red3[$inc2]=='3' && $jelfrancuz==0)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='4' && $jelfrancuz==1)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='11' && $jeleticar==1)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                        if($red3[$inc2]=='17' && $jeleticar==0)
                        echo"<td id='tabela1'>".$fetc['Predmet']."</td>";
                }
                        $inc2=$inc2+1;
                    }
                    if($jeleticar==1)
                        $necess=$vjegdje;
                        else $necess=$etgdje;
                        if($jelfrancuz==1)
                        $neces=$njegdje;
                        else $neces=$fragdje;
                echo"
                </tr>
                <tr align='center'>";
                while($inc<$kolonaa-1)
                    {
                    
                    if($inc!=$necess && $inc!=$neces ){
                    if($red2[$inc]!='0')
                    $bla=$red2[$inc];
                    else $bla=" ";
                    
                        echo"<td>".$bla."</td>";}
                        $inc=$inc+1;
                    
                    }
                
                
                
                echo"</tr></table>";*/
                echo"
				<br>
				<div id='linija'></div>
				<br>
				<div>
				
				<div id='obavijestidir'>
				<table class='tabela'>
				<tr><th colspan='3'>Obavijesti od uprave (za sve učenike)</th></tr>";
                $msg=mysqli_query($c,"select * from Obavijesti order by ID desc");
                $nekinc=0;
                while($uzmi=mysqli_fetch_array($msg))
                {
                    $hahs2=mysqli_fetch_array(mysqli_query($c,"select * from Profesori where RnBr='".$uzmi['Autor']."'"));
                    if( $nekinc<5 && $hahs2['Direktor']==1){
                        echo"<tr><td>".$hahs2['Ime']." ".$hahs2['Prezime']."</td><td class='crveno'>".$uzmi['Msg']."</td><td>".$uzmi['Date']."</td></tr>";
                        $nekinc=$nekinc+1;}
                }

                echo"
				
				</table>
				</div>";
                echo"
				
				<div id='obavijestiraz'>
				<table class='tabela'>
				<tr><th colspan='3'>Obavijesti od razrednika</th></tr>";
                $msg2=mysqli_query($c,"select * from Obavijesti order by ID desc");
                $nekinc2=0;
                while($uzmi2=mysqli_fetch_array($msg2))
                {
                    //echo $rzaza."-".$uzmi2['Razz']."---";
                    $hahs=mysqli_fetch_array(mysqli_query($c,"select * from Profesori where RnBr='".$uzmi2['Autor']."'"));
                    if( $nekinc2<5 and $rzaza==$hahs['Razrednik']){
                        echo"<tr><td>".$hahs['Ime']." ".$hahs['Prezime']."</td><td class='crveno'>".$uzmi2['Msg']."</td><td>".$uzmi2['Date']."</td></tr>";
                        $nekinc2=$nekinc2+1;}
                }

                echo"	
				</table></div>
				
				";

                //echo $br.$rzaza;
                $jooj=mysqli_query($c,"select * from Vladanja where BrUc='".$br."' and Razz='".$rzaza."' order by ID desc");
                if(mysqli_num_rows($jooj)!=0){
                    echo"
				<div id='vladanjaucenik'><table class='tabela'>
				<th colspan='4'>Promjene vladanja</th>
				<tr id='prvi_red'><td>Profesor</td><td>Razlog</td><td>Ocjena</td><td>Datum</td></tr>";
                    while($fecfec=mysqli_fetch_array($jooj))
                    {
                        $josfec=mysqli_fetch_array(mysqli_query($c,"select * from Profesori where RnBr='".$fecfec['Prof']."'"));
                        echo"<tr><td>".$josfec['Ime']." ".$josfec['Prezime']."</td><td class='crveno'><b>".$fecfec['Razlog']."<b></td><td><b>".$fecfec['Ocjena']."</b></td><td>".$fecfec['Datum']."</td></tr>";
                    }

                    echo"
				</table></div>
				";}
            }}
        else
            echo "<p align='center'>Moras biti logovan</p>";
        ?>
    </div>
      <div class="col-md-4 col-lg-3">
          <?php include('inc/php/side.php');?>
      </div>
  </div>
</div>
<?php include('inc/php/footer.php');?>
</body>
</html>