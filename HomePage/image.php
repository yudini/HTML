<!DOCTYPE html>
<html>
<head>
<title> Image Uploading Example </title>
</head>
<body style="background-size: cover; background-image: url('https://www.10wallpaper.com/wallpaper/medium/2010/Mountain_Desert_Sunrise_2020_Nature_Scenery_Photo_medium.jpg');">
    <form style="color: white" action="image.php" method="POST" enctype="multipart/form-data">
        File :
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>
    <br>
   
    <?php
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
   
    $conn = mysqli_connect("localhost","root","","yj_db") or die(mysqli_connect_error());
   
    $olds = mysqli_query($conn, "SELECT * FROM images");
   
    if(isset($_POST['submit'])) {
       if(empty($_FILES['image']['name'])) {
          echo "<h2>Please select an image.</h2>";
       } else {
          $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
          $image_name = addslashes($_FILES['image']['name']);
          $image_size = getimagesize($_FILES['image']['tmp_name']);
         
          if($image_size == FALSE) {
             echo "<h2>That's not an image.</h2>";
             } else {
             $sql = "INSERT INTO images VALUES (NULL,'$image_name','$image_data')" ;
             if ( !mysqli_query($conn,$sql) ) {
                 echo "Problem in uploading image !." . mysqli_error($conn);
             } else {
                //echo "<h2> Newly uploaded Image : $image_name </h2>";
                // [option-1] using separate php file
               echo "<img width='250' height='200' src='get.php?name=$image_name'> <br>";

                // [option-2] using direct display
                // $image = mysqli_query($con, "SELECT * FROM images WHERE name='$image_name'");
                // $image = mysqli_fetch_array($image);
                //echo "<img src='data:image/jpeg;base64," . base64_encode($image['data']) . "' width='250' height='200' />";

              
            }
         }
      }
   }
   //echo "<h2> Previously Uploaded Pictures </h2>";
   while ( $one = mysqli_fetch_array($olds) ) {
    $id=$one['id'];
     $im_name="SELECT name from images where id='$id'";
      $result=mysqli_query($conn,$im_name);
      echo "<img src='data:image/jpeg;base64," . base64_encode($one['data']) . "' width=250 height=200 />";
      $row= mysqli_fetch_assoc($result);
      echo $row['name'];
      echo "<a href='delete.php?id=" . $one['id'] . "'> Delete </a>";

   }

   echo "<br><h3><a href='content.php'style='color:white;' >Return Home</a></h3>";
   mysqli_close($conn);
?>

</body>
</html>