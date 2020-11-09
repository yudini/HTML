<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<fieldset>
			<legend>Order Form</legend>
			<input type="text" name="cookie" size="2" /> 
			<img height="50" width="50" src="http://jun.hansung.ac.kr/SWP/HW/Order/Cookie.gif"/>
			Cookie &times; $1.50<br />
            <input type="text" name="candy"  size="2" />
            <img height="50" width="20" src="http://jun.hansung.ac.kr/SWP/HW/Order/snickers.jpg" />
            Candy Bar &times; $2.00<br />
            Delivery : 
            <input type="radio" name="delivery" value="Regular" checked="checked" /> (default) Regular ($4.00)
            <input type="radio" name="delivery" value="Express"> Express ($8.00)<br />
            Donation for children in need : 
            <input type="checkbox" name="donation" /> $10 extra <br />
            <input type="submit" name="submit" value="Buy Now!" />
		</fieldset> 
    </form>

    <?php
    $cost = 0.00;
    $delivery="Regular";
    if ( isset($_POST["cookie"])) {
    	$cookie=$_POST["cookie"];
        if(empty($_POST["cookie"]))
        	$cookie=0.00;
        else
        	$cost +=$cookie * 1.50;
    }
    if ( isset($_POST["candy"])) {
    	$candy = $_POST["candy"];
        if(empty($_POST["candy"]))
        	$cookie=0.00;
        else
        	$cost += $candy * 2.00;


    }
    if ( isset($_POST["donation"]) ) {
        $cost += 10.00;
    }
    if(isset($_POST["delivery"])) {
    	$delivery =$_POST["delivery"];
    	if($delivery=="Regular")
    		$cost+=4.00;
    	else
    		$cost+=8.00;
    }
    ?>


    <hr>
    	<fieldset>
    		<legend>Your Order</legend>
    		<?php
    		if(isset($_POST["cookie"])){
    			for($i=0;$i<$_POST["cookie"];$i++){
    				echo ' <img height="50" width="50" src="http://jun.hansung.ac.kr/SWP/HW/Order/Cookie.gif" /> ';
    			}
    		}

    		if(isset($_POST["candy"])){
    			for($i=0;$i<$_POST["candy"];$i++){
    				echo '<img height="50" width="20" src="http://jun.hansung.ac.kr/SWP/HW/Order/snickers.jpg" /> ';
    			}
    		}

    		?>

    		<p> Total order cost: <strong> $<?= $cost ?> </strong> </p> 
    		<p>Delivery type :  <?=$delivery ?> </p>
    		 <?php
             if (isset($_POST["donation"])) { echo "<p>Thank you for your generous donation! </p>"; }
             ?> 
    	</fieldset>



</body>
</html>