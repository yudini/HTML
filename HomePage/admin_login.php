<!DOCTYPE html>
<?php
session_start();

$con=mysqli_connect('localhost','root','','yj_db');

if(isset($_POST['submit'])){
	$adminname=$_POST['name'];
	$adminpass=$_POST['pass'];
	$one=mysqli_query($con,"SELECT name, pass from admin where name='$adminname'and pass='adminpass'");
	$_SESSION['admin_login']=$adminname;
	if(mysqli_num_rows($one)>0){
		header("Location: admin_users.php");
	} else{
		header("Location: admin_login.php");
	}
	mysqli_close($con);
}
?>


<html>
<head>
	<title></title>
</head>
<body style="background-color: lightgrey">
	<form action="admin_login.php" method="POST">
		<table border="5" align="center">
			<tr><th colspan="2">Admin Login</th></tr>
			<tr><td>Admin Name</td><td><input type="text" name="name"></td></tr>
			<tr><td>Admin Pass</td><td><input type="text" name="pass"></td></tr>
			<tr align="center"><td colspan="2"><input type="submit" name="submit" value="Admin Login"></td></tr>
		</table>
	</form>
	<a href="index.php"><h4 align="center">Return user login page</h4></a>

</body>
</html>