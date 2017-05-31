<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 17.05.2017.
 * Time: 17:46
 */

if(isset($_POST["user"]) and isset($_POST["pass"]))
{
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $err="";
    $imaun=false;
    $red=mysqli_query($c,"select * from Profesori where username = '" . $user ."'");
    $red2=mysqli_query($c,"select * from users where username = '" . $user ."'");
    if(mysqli_num_rows($red)==true)
    {$imaun=true;
        $pw=mysqli_fetch_array($red);
        if(md5($pass)==$pw['Pass'])
        {
            $_SESSION['user']=$pw['Username'];
            $_SESSION['pass']=$pass;
            $_SESSION['prof']=true;
            $_SESSION['pred']=$pw['Predmet'];
            $id=$pw['RnBr'];
            $usern=$pw['Username'];
            $ip=$_SERVER['REMOTE_ADDR'];
            $ag=$_SERVER['HTTP_USER_AGENT'];
            $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','0');";
            if(!mysqli_query($c,$sql))
                die(mysqli_error($c));

        }
        else{
            $qe=mysqli_query($c,"select * from users where Admin = 1");
            while($b=mysqli_fetch_array($qe))
            {
                if(md5($pass)==$b['Pass'])
                {
                    $_SESSION['user']=$pw['Username'];
                    $_SESSION['pass']=$pass;
                    $_SESSION['prof']=true;
                    $_SESSION['ad']=true;
                    $_SESSION['pred']=$pw['Predmet'];
                    $id=$pw['RnBr'];
                    $usern=$pw['Username'];
                    $ip=$_SERVER['REMOTE_ADDR'];
                    $ag=$_SERVER['HTTP_USER_AGENT'];
                    $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','1');";
                    if(!mysqli_query($c,$sql))
                        die(mysqli_error($c));

                }
            }
            if(!isset($_SESSION['user']))
            {$qe=mysqli_query($c,"select * from Profesori where Direktor = 1");
                while($b=mysqli_fetch_array($qe))
                {
                    if(md5($pass)==$b['Pass'])
                    {
                        $_SESSION['user']=$pw['Username'];
                        $_SESSION['pass']=$pass;
                        $_SESSION['prof']=true;
                        $_SESSION['ad']=true;
                        $_SESSION['pred']=$pw['Predmet'];
                        $id=$pw['RnBr'];
                        $usern=$pw['Username'];
                        $ip=$_SERVER['REMOTE_ADDR'];
                        $ag=$_SERVER['HTTP_USER_AGENT'];
                        $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','1','".time()."','$ip','$ag','0','1');";
                        if(!mysqli_query($c,$sql))
                            die(mysqli_error($c));

                    }
                }}if(!isset($_SESSION['user']))
                $errp= "Wrong Password";}
    }
    else if(mysqli_num_rows($red2)==true){$imaun=true;
        $pw=mysqli_fetch_array($red2);
        if(md5($pass)==$pw['Pass'])
        {
            if($pw['Akt']==0)
                echo"Čekanje aktivacije<br>Vaš račun čeka aktivaciju ili je trenutno blokiran";
            else{
                $_SESSION['user']=$pw['Username'];
                $_SESSION['pass']=$pass;
                $_SESSION['prof']=false;
                $id=$pw['UserID'];
                $usern=$pw['Username'];
                $ip=$_SERVER['REMOTE_ADDR'];
                $ag=$_SERVER['HTTP_USER_AGENT'];
                $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','0');";
                if(!mysqli_query($c,$sql))
                    die(mysqli_error($c));
            }
        }	else{
            $qe=mysqli_query($c,"select * from users where Admin = 1");
            while($b=mysqli_fetch_array($qe))
            {
                if(md5($pass)==$b['Pass'])
                {
                    $_SESSION['user']=$pw['Username'];
                    $_SESSION['pass']=$pass;
                    $_SESSION['prof']=false;
                    $_SESSION['ad']=true;
                    $id=$pw['UserID'];
                    $usern=$pw['Username'];
                    $ip=$_SERVER['REMOTE_ADDR'];
                    $ag=$_SERVER['HTTP_USER_AGENT'];
                    $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','1');";
                    if(!mysqli_query($c,$sql))
                        die(mysqli_error($c));

                }
            }
            if(!isset($_SESSION['user']))
            {$qe=mysqli_query($c,"select * from Profesori where Direktor = 1");
                while($b=mysqli_fetch_array($qe))
                {
                    if(md5($pass)==$b['Pass'])
                    {
                        $_SESSION['user']=$pw['Username'];
                        $_SESSION['pass']=$pass;
                        $_SESSION['prof']=false;
                        $_SESSION['ad']=true;
                        $id=$pw['UserID'];
                        $usern=$pw['Username'];
                        $ip=$_SERVER['REMOTE_ADDR'];
                        $ag=$_SERVER['HTTP_USER_AGENT'];
                        $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','0','".time()."','$ip','$ag','0','1');";
                        if(!mysqli_query($c,$sql))
                            die(mysqli_error($c));

                    }
                }}if(!isset($_SESSION['user']))
                $errp= "Wrong Password";}

    }
    if($imaun==false) $erru="Wrong Username";

}



if(isset($_GET['odjavi']) and $_GET['odjavi']=="da")
{
    if($_SESSION['prof']==true)
    {$s=mysqli_query($c,"select * from Profesori where Username='".$_SESSION['user']."'");$sta="RnBr";}
    else{ $s=mysqli_query($c,"select * from users where Username='".$_SESSION['user']."'");$sta="UserID";}
    $pw=mysqli_fetch_array($s);
    if(
        $_SESSION['ad']==true)
        $fd=1;else $fd=0;
    if($_SESSION['prof']==true)
        $fd2=1;else $fd2=0;
    $id=$pw[$sta];
    $ip=$_SERVER['REMOTE_ADDR'];
    $ag=$_SERVER['HTTP_USER_AGENT'];
    $usern=$pw['Username'];
    $sql="insert into Sesije (ID,User,Username,Prof,Time,IP,Sve,Odjava,Admin) values(NULL,'$id','$usern','$fd2','".time()."','$ip','$ag','1','$fd');";
    mysqli_query($c,$sql);
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    unset($_SESSION['prof']);
    unset($_SESSION['ad']);
    unset($_SESSION['pred']);
    session_destroy();
    header("Location:/");

}
