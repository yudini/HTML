<?php

session_start();
if(isset($_SESSION['admin_login'])){
	$id=$_GET['id'];
    $con=mysqli_connect('localhost','root','','yj_db');
    if(mysqli_query($con,"DELETE from users where id='$id'")){
	    header("Location: admin_users.php");
    }else {
    	header("Location:admin_login.php");
    }
}else {
	header("Location: admin_login.php");
}
?>