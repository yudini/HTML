<!DOCTYPE html>
<html>
<head>
<title> Image Uploading Example </title>
</head>
<body style="background-size: cover; background-image: url('https://www.10wallpaper.com/wallpaper/medium/2010/Mountain_Desert_Sunrise_2020_Nature_Scenery_Photo_medium.jpg');"> 
    <?php
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }

    $pattern=$_SESSION['search'];
    $conn = mysqli_connect("localhost","root","","yj_db") or die(mysqli_connect_error());
   
    $olds = mysqli_query($conn, "SELECT * FROM images");
   while ( $one = mysqli_fetch_array($olds) ) {
      $id=$one['id'];
      $im_name="SELECT name from images where id='$id'";
      $result=mysqli_query($conn,$im_name);
      $row= mysqli_fetch_assoc($result);
      if(preg_match("/$pattern/", $row['name'])){
        echo " <br> <img src='data:image/jpeg;base64," . base64_encode($one['data']) . "' width=250 height=200 />"; 
        echo $row['name'];
      }
   }
   echo "<br>";
   echo "<h3><a href='content.php' style='color: white'>Go content</a></h3>";
   ?>
 </body>
 </html>
 