<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin_login'])){
	header("Location:admin_login.php");
}
$con=mysqli_connect('localhost','root','','yj_db');
$all =mysqli_query($con,"SELECT *from users");
?>


<html>
<head>
	<title></title>
</head>
<body style="background-color: lightgrey; text-align: center;"  >
	<h1 align="center">Admin Panel for Users Management</h1>
	<table border="2" align="center">
		<tr><th>id</th><th>name</th><th>password</th><th>E-mail</th><th>school</th><th>Delete?</th><th>Update?</th></tr>
		<?php
		while($one=mysqli_fetch_array($all)){
			echo "<tr>";
			echo "<td>".$one['id']."</td>";
			echo "<td>".$one['name']."</td>";
			echo "<td>".$one['pass']."</td>";
			echo "<td>".$one['email']."</td>";
			echo "<td>".$one['school']."</td>";
			echo "<td><a href='admin_delete.php?id=".$one['id']."'>delete</a></td>";
			echo "<td><a href='admin_update.php?id=".$one['id']."'>Update</a>";
			echo "</tr>";
		}
		?>
	</table>
	<a href="admin_logout.php"><h4 align="center"><b>Logout</b></h4></a>

	
</body>
</html>