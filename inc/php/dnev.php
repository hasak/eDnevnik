<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 18:09
 */
if($_SESSION['prof']==true)
{
    if(isset($_POST['trick']))
    {
        $rzaz=$_POST['razz'];
        $njihaa=$_POST['nacin'];
        if($njihaa==1)
            $ub="/test";
        else if($njihaa==2)
            $ub="/pismena";
        else if($njihaa==3)
            $ub="/".strtoupper(substr($_POST['custom'],0,1)).strtolower(substr($_POST['custom'],1,strlen($_POST['custom'])-1));
        else $ub=null;
        $sve="http://".$_SERVER['HTTP_HOST']."/dnevnik/".$rzaz.$ub;
        header("Location:".$sve);
    }
    if(isset($_POST['okid']))
    {
        //$razu="";
        $qee=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
        $fetcarajjj=mysqli_fetch_array($qee);
        $idic=$fetcarajjj['RnBr'];
        $pred=$fetcarajjj['prdm'];
        //$sigpre=$pred;
        if(isset($_POST['predbro']))
            $pred=$_POST['predbro'];
        $id=$fetcarajjj['RnBr'];
        $vr2ta=$_POST['vrta'];

        $inc=1;
        //$date=date("d");
        //$mjj=date("m");
        $rzz=$_POST['rzz'];
        $unix=$_POST['datun'];
        $jelkl=$_POST['dalkl'];
        //echo $jelkl;
        //$dat=date("d",$unix);
        //$mesec=date("m",$unix);
        $_SESSION['klasee']=$jelkl;
        $pv=time();
        if($jelkl==false)
        {
            while($inc<34)
            {
                $a=$_POST[$inc];
                //$brb=-$inc;
                //$bb=$_POST[$brb];
                //$zklj=0;
                //echo $inc.$a."<br>";
                if($a!=0)
                {
                    if($a>0 and $a<6)
                    {

                        if(!mysqli_query($c,"insert into Izmjene (RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Tajp, Pravi) value(NULL, '$id', '$pred', '$a', '$inc', '$rzz', '0', '$unix', '$vr2ta', '$pv');"))
                            die(mysqli_error($c)); else {
                            $_SESSION['post']=$rzz;
                            $_SESSION['post2']=$inc;
                            $_SESSION['prd']=$pred;

                            //RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Mj, Tajp, Pd, Pm, Sat, Min
                            $razu="Unešeno!";}
                    }else $razu="<br><h2>Greška!</h2><br><h3>Odaberite ocjenu</h3>";}

                $inc=$inc+1;
            }
        }
        else
        {
            //echo $rzz;
            $qf=mysqli_query($c,"select * from Ucukl where IDklase='".$rzz."'");
            while($b=mysqli_fetch_array($qf))
            {
                $raz=$b['ruc'];
                $br=$b['bruc'];
                $a=$_POST[$br];
                //echo $raz." ".$br." ".$a;
                if($a!=0)
                {
                    if($a>0 and $a<6)
                    {
                        if(!mysqli_query($c,"insert into Izmjene (RnBr, Prof, Predmet, Ocjena, Brojuc, Razred, Zakljucna, Datum, Tajp, Pravi) value(NULL, '$id', '$pred', '$a', '$br', '$raz', '0', '$unix', '$vr2ta', '$pv');"))
                            die(mysqli_error($c));
                        else{
                            $_SESSION['post']=$rzz;
                            $_SESSION['post2']=$br;
                            $_SESSION['prd']=$pred;
                            $razu="Unešeno!";
                        }
                    }else $razu="<br><h2>Greška!</h2><br><h3>Odaberite ocjenu</h3>";
                }
            }
        }
    }
    if(isset($_GET['uniuni']))
    {
        if($_GET['uniuni']==1)
        {mysqli_query($c,"INSERT INTO `Monitoring` VALUES(null, '0', '', 0, '/default.php', 'http://".$_SERVER['HTTP_HOST']."', '109.175.97.176', '".time()."', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko-uni) Chrome/44.0.2403.130 Safari/537.36', 0);
");}
        else mysqli_query($c,"delete from Monitoring where Sve='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko-uni) Chrome/44.0.2403.130 Safari/537.36'");
        header("Location: http://".$_SERVER['HTTP_HOST']);
    }
    if(isset($_GET['klasa']))
    {
        $klas=true;
        $razz=$_GET['klasa'];
    }
    else if(isset($_GET['razz']))
    {
        $razz=$_GET['razz'];
        $klas=false;
    }
    else if(isset($_SESSION['klasee']))
    {
        $klas=$_SESSION['klasee'];$razz=$_SESSION['post'];unset($_SESSION['klasee']);//unset($_SESSION['post']);
    }
    else if(isset($_SESSION['post'])){$razz=$_SESSION['post'];$klas=$_SESSION['klasee'];unset($_SESSION['klasee']);//unset($_SESSION['post']);
    }
    else $nes="Dnevnik";

    if(isset($_GET['razz']) or isset($_SESSION['post']) or isset($_GET['klasa']) or isset($_SESSION['klasee']))
    {
        if($klas==false)
            $query=mysqli_query($c,"select * from Spisak");
        else {$query=mysqli_query($c,"select * from Ucukl where IDklase='".$razz."'");
            $josq=mysqli_fetch_array(mysqli_query($c,"select * from Klase where ID='".$razz."'"));}
        $qaa=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
        $fetcaraj=mysqli_fetch_array($qaa);


        $pred=$fetcaraj['Predmet'];
        if(isset($_POST['visepr']))
            $pred=$_POST['visepr'];//
        $query2=mysqli_query($c,"select * from Predmeti where RnBr = '".$pred."'");
        $fec=mysqli_fetch_array($query2);
        $pred2=$fec['Predmet'];
        if($klas==true)
        {
            $as=mysqli_fetch_array(mysqli_query($c,"select * from Klase where ID='".$razz."'"));
            $razz=$as['Ime'];
        }
        $a23=mysqli_query($c,"select * from Vise where Profa='".$fetcaraj['RnBr']."'");
        if(mysqli_num_rows($a23)==0)
            $nes=$pred2." - ".$razz;else $nes=$razz.". razred";}else {
        $a23=mysqli_query($c,"select * from Vise where Profa='".$fetcaraj['RnBr']."'");
        if(mysqli_num_rows($a23)==0)
            $nes=$pred2;
        else
            $nes="Dnevnik";
    }}else $nes="Dnevnik";
if(!isset($_GET['klasa']) and !isset($_GET['razz']))
{
    $qaa=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");
    $fetcaraj=mysqli_fetch_array($qaa);
    $zq=mysqli_query($c,"select * from Vise where Profa='".$fetcaraj['RnBr']."'");
    if(mysqli_num_rows($zq))
        $nes="Dnevnik";
    else {
        $to_nesto=mysqli_fetch_array(mysqli_query($c,"select * from Predmeti where RnBr = '".$fetcaraj['Predmet']."'"));
        $nes=$to_nesto['Predmet'];
    }
}
if(!isset($_SESSION['user']))
    $nes="Dnevnik";
else if(!$_SESSION['prof'])
    $nes="Dnevnik";