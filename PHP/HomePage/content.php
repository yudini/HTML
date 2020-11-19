<!DOCTYPE html>
<?php
session_start();
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'yj_db';

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
$username=$_SESSION['login'];
$sql="SELECT email from users where name='$username'";
$result=mysqli_query($conn,$sql);

if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }

if (isset($_POST['submit'])) {

   if (empty($_POST['search'])) {
      echo "<script> alert('Please enter the content to search!')</script>";
   }else{
   	$_SESSION['search']=$_POST['search'];
   	header("Location: search.php");
   }
}
?>
<html>
<head>
    <title> Content Page </title>
<style>
	fieldset{
		display: inline-block;
	}
	li{
		float: center;

	}
	li a{
		display: block;
		color: black;
		text-align: center;
		padding:15px;
	}
	li a:hover {
		background-color: lightgreen;
	}
</style>
</head>
<body style="background-size: cover; background-image: url('https://www.10wallpaper.com/wallpaper/medium/2010/Mountain_Desert_Sunrise_2020_Nature_Scenery_Photo_medium.jpg');">
<h1 align="center"> About ! </h1> <br>
<form action="content.php" method="POST">
	<div align="center" style="width: 500px; height: 70px; border: 3px dashed lightgreen; margin: auto;">
		<br>
		<input type="text" name="search">
		<input type="submit" name="submit" value="search"> 
	</div>
</form>
<div align="right">
		<fieldset style="width: 10%; text-align: left;  border-color: blue;" >
		
		<p align="center" style="color: blue;"><b>Welcome</b></p>
		<b>Username:</b> <?=$_SESSION['login']; ?>
		<br>
		<?php
		while($row= mysqli_fetch_assoc($result) ){
			  $_SESSION['email']=$row['email'];
				echo "<b>E-mail:</b> ".  $_SESSION['email']."<br>";
				echo "<b>School:</b>". $_SESSION['school'];
				echo "<br>";
		}

		echo "<a href='update_user.php'>-my profile update!</p></a>"
		?>
	
	 </fieldset>
	
</div>
<div>
	<br>
		<ul type="none">
			<li><a href='image.php'> -Image Update </a></li>
			<li><a href='info.php'>-Information Update</a></li>
			<li><a href="admin_login.php">-Login Admin Account!</a></li>
			<li> <a href="./logout.php"><b>-Logout </b></p> </a></li>
			<br>
		</ul>
</div>
<h1 align="center" style="color: black">Information</h1>
<div align="center">
<textarea rows="20" cols="100" style="text-align: left; font-family: sans-serif; ">
	<?=$_SESSION['info']?>
</textarea>
<br>
   <?php
   $sql2="UPDATE users set add_info where name='$username'";

   if(isset($_POST['update'])){
   	$add_in=$_POST['add'];
   	$sql2="UPDATE users set add_info='$add_in' where name='$username'";
   	mysqli_query($conn,$sql2);
   	$_SESSION['add']=$_POST['add'];
   }
   ?>
   <p style="color:yellow;" >mycontent ---> 
   <textarea><?=$_SESSION['add']?></textarea> </p>
   <div align="right">
   <form action="content.php" method="post">
   	<p style="color: #FFFF00;">add content
   	<input type="text" name="add" value="">
	<input type="submit" name="update" value="add">	
	</p>
   </form>	 
    </div>
</div>
<br>

<?php
$olds = mysqli_query($conn, 'SELECT * FROM images');
   while ( $one = mysqli_fetch_array($olds) ) {
      $id=$one['id'];
   	  //$im_name="SELECT name from images where id='$id'";
      //$result=mysqli_query($conn,$im_name);
      //$row= mysqli_fetch_assoc($result);
      echo "  <img src='data:image/jpeg;base64," . base64_encode($one['data']) . "' width=250 height=200 /> ";
      echo "            "; 
     // echo $row['name'];
   }
   echo "<br>";
?>
</body>
</html>