<?php
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","yj_db") or die(mysqli_connect_error());
mysqli_query($conn, "DELETE FROM images WHERE id= '$id'");
mysqli_close($conn);
header("location: image.php");
?>