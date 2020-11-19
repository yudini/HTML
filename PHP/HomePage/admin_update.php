<?php

session_start();
if (!isset($_SESSION['admin_login'])) {
        header("Location: index.php");
    }
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","yj_db") or die(mysqli_connect_error());

$sql=mysqli_query($conn,"SELECT name from users where id='$id'");
$one=mysqli_fetch_array($sql);
$username=$one['name'];

$sql2=mysqli_query($conn,"SELECT pass from users where id='$id'");
$two=mysqli_fetch_array($sql2);
$userpass=$two['pass'];
$sql3=mysqli_query($conn,"SELECT email from users where id='$id'");
$three=mysqli_fetch_array($sql3);
$useremail=$three['email'];

$sql4=mysqli_query($conn,"SELECT school from users where id='$id'");
$four=mysqli_fetch_array($sql4);
$userschool=$four['school'];

if (isset($_POST['submit'])) {
	 $username = $_POST['username'];
	 $userpass = $_POST['password'];
	 $useremail=$_POST['email'];
     $userschool=$_POST['school'];
	 $query="UPDATE users set name='$username',pass='$userpass',email='$useremail',school='$userschool' where id='$id'";
	 mysqli_query($conn,$query);

}

//mysqli_query($conn, "UPDATE users set pass=$pass WHERE id= '$id'");
//header("location: admin_users.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="background-size: cover; background-color: lightgrey;">
	<form method="post">
		<table border="3" align="center" >
			<tr>
				<th colspan="4" align="center"> Update user profile </th>
            </tr>
            <tr>
                <td width="200"> Username </td>
                <td> <input type="text" name="username"value="<?=$username?>" > </td>
            </tr>
            <tr>
                <td width="200"> Password </td>
                <td> <input type="password" name="password" value="<?=$userpass?>"> </td>
            </tr>
            <tr>
            	 <td width="200"> E-mail</td>
            	<td> <input type="text" name="email" value="<?=$useremail?>"> </td>
            </tr>
            <tr>
               <td width="200"> School</td>
              <td> <input type="text" name="school" value="<?=$userschool?>"> </td>
            </tr>
            <tr>
                <td colspan="2" align="center"> <input type="submit" name="submit" value="update" > </td>
            </tr>

        </table>
   <form>
   	<h3 align="center"><a href="admin_users.php">Return the admin page</a></h3>
</body>
</html>