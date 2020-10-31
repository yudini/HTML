<!DOCTYPE html>
<?php
session_start();
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'yj_db';

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   if (empty($_POST['username'])) {
       echo "<script> alert('Please enter your name!')</script>";
   }
   else if (empty($_POST['password'])) {
        echo "<script> alert('Please enter your password!')</script>";
   }
   $sql="SELECT school FROM users WHERE name='$username";
   $result2=mysqli_query($conn,$sql);

   $query = "SELECT name, pass FROM users WHERE name='$username' AND pass='$password' ";
   $result = mysqli_query($conn,$query);
   
   $sch=mysqli_query($conn,"SELECT school from users where name='$username'");
   $two=mysqli_fetch_array($sch);

   $sql2=mysqli_query($conn,"SELECT add_info from users where name='$username'");
   $add_info=mysqli_fetch_array($sql2)['add_info'];
   
   $sql3=mysqli_query($conn,"SELECT * from info");
   $info=mysqli_fetch_array($sql3)['data'];

   if ( mysqli_num_rows($result) > 0 ) {
       $_SESSION['login']=$username;
       $_SESSION['pass']=$password;
       $_SESSION['school']=$school;
       $_SESSION['add']=$add_info;
       $_SESSION['info']=$info;
       $school=$two['school'];
       header("Location: content.php");
   } else {
       echo "Wrong username or password !";
   }

mysqli_close($conn);
}
?>
<html>
<head>
   <title> Login Page </title>
<style>

</style>
</head>
<body style=" text-align:center; background-color: lightgrey;">
   <h1> Welcome to homepage!</h1>
   <p> If you want to look around the page, Please Login!</p><br>
   <form method="post" action="index.php">
   <table border="5" align="center" >
       <tr>
           <th colspan="5" align="center"> Login </th>
        </tr>
            <td width="100"> Username </td>
            <td> <input type="text" name="username" > </td>
       </tr>
       <tr>
            <td width="100"> Password </td>
            <td> <input type="password" name="password" > </td>
       </tr>
       <tr>
            <td colspan="2" align="center"> <input type="submit" name="submit" value="Login" > </td>
       </tr>
   </table>
   <form>
    <br>
    <b> Not registered yet? <a href="registration.php"> Registeration </a></b><br>
    <b>Do you want to login by Admin account? <a href="admin_login.php"> Admin login</a></b>
   </form>
</body>
</html>