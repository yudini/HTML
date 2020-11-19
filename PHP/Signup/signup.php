<!DOCTYPE html>

<html>
<head>
    <title>Attend Job Fair!</title>
    <link rel="stylesheet" type="text/css" href="http://jun.hansung.ac.kr/SWP/HW/Jobfair/jobfair.css">

</head>
<body>
    <?php

    if(!isset($_POST['name'])||!isset($_POST['email'])||!isset($_POST['gender'])||$_POST['interest']==""){
        echo "<h1>Sorry</h1>";
        echo "<p>You didn't fill out the form completely.  <a href='jobfair.html'>Try again?</a></p>";
    }
    else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
            echo "<h1>Sorry</h1>";
            echo "<p>You didn't provide a valid name. <a href='jobfair.html'>Try again?</a></p>";
    }
    else if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false){
            echo "<h1>Sorry</h1>";
            echo " <p>You didn't provide a e-mail address.  <a href='jobfair.html'>Try again?</a></p>";
    }
    else{
        $name=$_POST['name'];
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $interest=$_POST['interest'];
        $gender=$_POST['gender'];

        $myfile="list.txt";
        $new=true;
        $users=explode("\n",file_get_contents($myfile));

        foreach ( $users as $user1 ) {
            $info = explode(":",$user1);
            if ($email==trim($info[1])) {
                echo "<h2>$email</h2>
                   <h3>You have registered already !</h3>
                   <p>Back to <a href='jobfair.html'>the front page.</a></p>";
                echo "<hr>
                      <h3>Current reservation list</h3>";
                $myfile=fopen("list.txt", "r") or die("Unabled to open file");
                while (!feof($myfile)) {
                  echo "<b>".fgets($myfile)."</b>";
                  echo "<br>";
                 }
            fclose($myfile);
                $new=false;
                break;
            }
        }
        if($new){
            echo "  <h1>Thanks, Job Seeker !</h1> 
                     <p>You successfully reserved a seat! See you then ^.^</p>

                     <div class='item'> Name : </div>$name  <br/>
                     <div class=\"item\"> E-mail : </div>$email <br />
                     <div class=\"item\"> Field of interest : </div>$interest <br />
                     <div class=\"item\"> Gender : </div>$gender <br />";
            echo "<hr color=\"yellow\">";
            echo "<h3>Current reservation list</h3>";
            $myfile = fopen("list.txt", "a") or die("Unabled to open file");
            $ary=array($name,$email,$interest,$gender);
            $str = implode(":",$ary);
            $strb="$str";

            fwrite($myfile,implode("",array($strb, "\n")));
            fclose($myfile);

            $myfile = fopen("list.txt", "r") or die("Unabled to open file");
            while (!feof($myfile)) {
                echo fgets($myfile);
                echo "<br>";
            }
            fclose($myfile);
        }

      }
    ?>

</body>
</html>



