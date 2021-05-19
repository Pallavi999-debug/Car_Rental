<?php
session_start();

if(isset($_POST['firstname'])){
	$fname=$_POST["firstname"];
	$lname=$_POST["lastname"];
	$email=$_POST["email"];
	$address=$_POST["address"];
	$city=$_POST["city"];
	$state=$_POST["state"];
	$code=$_POST["code"];
	$paymenttype=$_POST["paymenttype"];
	$totalpayable=$_POST["totalpayable"];
	
	
	$message="Thank you for renting cars from Hertz_UTS, the total cost is $totalpayable<br/><br/>".
	"Details are as follows<br/><br/>";
  
  echo $message;
  
  
  $keys = array_keys($_SESSION["cart"]);
  $qty=$_SESSION["qty"];
  
for($i = 0; $i < count($_SESSION["cart"]); $i++) {
    
    foreach($_SESSION["cart"][$keys[$i]] as $key => $value) {

        echo $key . " : " . $value ." <br/>";
		//$tot=$value*$qtys[$i];
		//echo $tot;
    }
	echo "Rent days: ".$qty[$i]." <br/>-------------<br/>";
  
	//$totals+=$tot;
}

}

?>