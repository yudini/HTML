<!DOCTYPE html>
<html>
<head>
<title> Image Uploading Example </title>
</head>
<body style="background-size: cover; background-image: url('https://www.10wallpaper.com/wallpaper/medium/2010/Mountain_Desert_Sunrise_2020_Nature_Scenery_Photo_medium.jpg');">
  <br><br><br>
  <div align="center">
    <form action="info.php" method="post">
      <input type="text" name="info" style="width: 50%; height: 100px;" value="">
      <br>
      <input type="submit" name="submit" value="Update">
    </form>
  </div>
  <br>

    <?php
    $conn = mysqli_connect("localhost","root", "", "yj_db");
    session_start();
    
    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }

    if (isset($_POST['submit'])){
      $info=$_POST['info'];
      $username=$_SESSION['login'];
      $_SESSION['info']=$info;
      $sql="UPDATE info set data='$info' where id=1 ";
      mysqli_query($conn,$sql);
    }
   ?>
<div align="center">
  <textarea rows="10" cols="50"><?=$_SESSION['info']?></textarea>
  <br>
   <h3><a href='content.php' style="color: white">Return Home</a></h3>
</div>
 </body>
 </html>