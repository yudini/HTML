<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "yj_db";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }

//if (!isset($_SESSION['admin_login'])) {
     //   header("Location: admin_login.php");
  //  }

$username=$_SESSION['login'];
$sch=mysqli_query($conn,"SELECT school from users where name='$username'");
$two=mysqli_fetch_array($sch);
$school=$two['school'];
$_SESSION['school']=$school;

$olds ="SELECT id FROM users where name='$username'";
$one = mysqli_fetch_array(mysqli_query($conn,$olds));
$id=$one['id'];
if (isset($_POST['submit'])) {
	 $newusername = $_POST['username'];
	 $newpassword = $_POST['password'];
	 $newemail=$_POST['email'];
   $newschool=$_POST['school'];
	 $_SESSION['login']=$newusername;
	 $_SESSION['email']=$newemail;
	 $_SESSION['pass']=$newpassword;
   $_SESSION['school']=$newschool;
	 $sql="UPDATE users set name='$newusername',pass='$newpassword',email='$newemail',school='$newschool' where id='$id'";
	 mysqli_query($conn,$sql);
	 //header("Location: index.php");

}

    echo "<br> <br> <h3>Current Profile </h3>";
    echo "<form method='post'><table border='2'>";
		echo "<tr>
          <th align='center' width='200'>username</th> 
          <td width='200'>". $_SESSION['login']."</td></tr>
          <tr>
          <th align='center'>E-mail</th>
          <td>".$_SESSION['email'] ."</td> </tr> 
          <tr>
          <th>School</th>
          <td>".$_SESSION['school']."</td></tr>
          </table> <form>";
	echo "<br> <br>";

//mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="background-size: cover; background-image: url('https://www.10wallpaper.com/wallpaper/medium/2010/Mountain_Desert_Sunrise_2020_Nature_Scenery_Photo_medium.jpg');">
	<form method="post" action="index.php">
		<table border="3" >
			<tr>
				<th colspan="4" align="center"> Update your profile </th>
            </tr>
            <tr>
                <td width="200"> Username </td>
                <td> <input type="text" name="username"value="<?=$_SESSION['login']?>" > </td>
            </tr>
            <tr>
                <td width="200"> Password </td>
                <td> <input type="password" name="password" value="<?=$_SESSION['pass']?>"> </td>
            </tr>
            <tr>
            	 <td width="200"> E-mail</td>
            	<td> <input type="text" name="email" value="<?=$_SESSION['email']?>"> </td>
            </tr>
            <tr>
               <td width="200"> School</td>
              <td> <input type="text" name="school" value="<?=$_SESSION['school']?>"> </td>
            </tr>
            <tr>
                <td colspan="2" align="center"> <input type="submit" name="submit" value="update" > </td>
            </tr>

        </table>
   <form>
   	<h3 align="right"><a href="content.php" style="color:white;">Return Home</a></h3>
</body>
</html>