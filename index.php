<?php
session_start();
if(isset($_SESSION["cart"])) {
$items=count($_SESSION["cart"]);
}
else{
$items=0;	
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Hertz-UTS</title>
  <link href="css/style.css" rel="stylesheet"/>
  <script>

function addToCart(id) {
	
	var car_name=document.getElementById(id+"_name").value;
	  var priceperday=document.getElementById(id+"_price").value;
	  var availability=document.getElementById(id+"_availability").value;
	  var yr=document.getElementById(id+"_year").value;
	  var seat=document.getElementById(id+"_seat").value;
	  var fuel=document.getElementById(id+"_fuel").value;
	  var mile=document.getElementById(id+"_mileage").value;
	  var des=document.getElementById(id+"_description").value;
	  var str=car_name +","+priceperday+","+yr+","+seat+","+fuel+","+mile+","+des;
    if (availability== "False") { 
       // document.getElementById("txtHint").innerHTML = "";
	    alert("Sorry, the car is not availability right now. Please try other cars");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
				alert(""+this.responseText);
            }
        };
        xmlhttp.open("GET", "cart_items.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
 </head>
 <body>
  <div class="container">
   <header>
   <div style="float:left; background-color: yellow;"><a href="index.php">Hertz-UTS</a></div>
    <big>Car Rental Center</big>
	
	
   </header>
   
   <article>
   
	<div style="float:right;"><a href="cart.php"><img src="images/cart-icon.png" width="30" />
	<input type="button" id="total_items" value="<?php echo $items;?>"></a></div>
	<div id="clear"></div>
    <section>
	
<?php
	 $xml = simplexml_load_file('cars.xml') or die("Failed to load");//load the xml file
	 $cols=0;
	foreach( $xml->children()  as $result){//read through the xml file and display cars list
    $cols++;
	?>
	<div class="thirds" id="<?php echo $result->Model;?>">
	<img src="images/<?php echo $result->Model;?>.jpg" class="img" /><br/>
	
	<span><?php echo $result->Brand ."-".$result->Model ."-".$result->Year .  "<br/>" ?></span>
	<span style="font-weight:bold;">Fuel type: </span><?php echo $result->Fuel?><br/>
    <span style="font-weight:bold;">Seats: </span> <?php echo $result->Seats ?><br/>
    <span style="font-weight:bold;">Price-per-day: </span>$<?php echo $result->Price?><br/>
     <span style="font-weight:bold;">Availability: </span><?php echo $result->Availability ?><br/>
	 <span style="font-weight:bold;">Description: </span><?php echo $result->Description ?><br/>
	 
	 <input type="hidden" id="<?php echo $result->Model;?>_name" value="<?php echo $result->Model;?>">
    <input type="hidden" id="<?php echo $result->Model;?>_price" value="<?php echo $result->Price;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_availability" value="<?php echo $result->Availability;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_year" value="<?php echo $result->Year;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_seat" value="<?php echo $result->Seats;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_fuel" value="<?php echo $result->Fuel;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_mileage" value="<?php echo $result->Mileage;?>">
	 <input type="hidden" id="<?php echo $result->Model;?>_description" value="<?php echo $result->Description;?>">
	 
	<div id="clear"></div>
	 <input type='button' name='addtocart' class='button' value="Add to Cart" onclick="addToCart('<?php echo $result->Model;?>')" />
	
	 </div>
	<?php 
	if($cols==5){
		?>
		<div id="clear"></div>
		<?php
	}
  }
  
	
?><div id="clear"></div>
    </section>
    
   </article>
   
   <footer>
   Hertz-UTS Car Rental Center
   </footer>
  </div>
 </body>
</html>
