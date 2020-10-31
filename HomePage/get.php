<?php
$conn = mysqli_connect("localhost","root","","yj_db") or die(mysqli_connect_error());
$name = $_REQUEST['name'];
$image = mysqli_query($conn, "SELECT * FROM images WHERE name='$name'");
$image = mysqli_fetch_assoc($image);
$image = $image['data'];
echo $image;
?>