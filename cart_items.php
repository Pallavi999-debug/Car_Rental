<?php
  session_start();

$q = $_REQUEST["q"];
 
   $arg = explode (",", $q);//delimit the posted string to get the car name and the price
	  $car=$arg[0];
	  $price=$arg[1];
	  $yr=$arg[2];
	  $seat=$arg[3];
	  $fuel=$arg[4];
	  $mileage=$arg[5];
	  $description=$arg[6];
	
	$carsArray = array(
		$car=>array(
		'vehicle'=>$car,
		'year'=>$yr,
		'mileage'=>$mileage,
		'fuel'=>$fuel,
		'seats'=>$seat,
		'price'=>$price,
		'description'=>$description)
	);	

	  
	if(empty($_SESSION["cart"])) {//check if there is an empty cart
		$_SESSION["cart"] = $carsArray;//initialize to our carsArray
		echo "Add to Cart Successful";
	}else{
		$array_keys = array_keys($_SESSION["cart"]);//keys associated with our cart if the cart has items already
		
		if(in_array($car,$array_keys)) {//check if the selected vehicle is already in the cart
			echo "The selected Vehicle is already added to your cart!";	
		}else {
			$_SESSION["cart"] = array_merge($_SESSION["cart"], $carsArray);
			echo "Add to Cart Successful";
		}
	} 
   // exit();
   
  

  
?>