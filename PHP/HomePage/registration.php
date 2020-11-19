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
   $email = $_POST['email'];

   if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
       echo "<script> alert('Please enter all required field!')</script>";
   } else {
       $query = "SELECT * FROM users WHERE name='$username' OR email='$email' ";
       $result = mysqli_query($conn,$query);
       $sql=mysqli_query($conn,"SELECT * from info");
       $info=mysqli_fetch_array($sql)['data'];
       if (mysqli_num_rows($result) > 0) {
           header("Location: registration.php?MSG=Username:$username or E-mail:$email is already exist, please use another one!");
            } else {
                $query = "INSERT INTO users (name, pass, email) VALUES ('$username','$password','$email')";
                if (mysqli_query($conn,$query)) {
                    $_SESSION['login']=$username;
                    $_SESSION['pass']=$password;
                    $_SESSION['school']=" ";
                    $_SESSION['add']=" ";
                    $_SESSION['info']=$info;
                    header("Location: content.php");

                }
            }
        }
        }

mysqli_close($conn);

?>
<html>
<head>
   <title> Registration Page </title>
</head>
<body style="text-align:center; background-color: lightgrey ">
<?php
if(isset($_GET['MSG'])) {
    echo $_GET['MSG'];
}
?>
   <form method="post" action="registration.php">
   <table border="5" align="center">
       <tr>
           <th colspan="2" align="center"> Registration </th>
        </tr>
            <td width="100"> Username </td>
            <td> <input type="text" name="username" > </td>
       </tr>
       <tr>
            <td width="100"> Password </td>
            <td> <input type="password" name="password" > </td>
       </tr>
       <tr>
            <td width="100"> E-mail </td>
            <td> <input type="text" name="email" > </td>
       </tr>
       <tr>
            <td colspan="2" align="center"> <input type="submit" name="submit" value="Regist" > </td>
       </tr>
   </table>
   <form>
    <h3><a href="index.php">Return user login page</a></h3>
</body>
</html>