<?php
session_start();

if(isset($_GET["action"])){  
      if($_GET["action"] == "delete"){  
           foreach($_SESSION["cart"] as $keys => $values){  
		  
                if($values["vehicle"] == $_GET["id"]){  
				
				
                     unset($_SESSION["cart"][$keys]);  
                     echo '<script>alert("Vehicle Removed")</script>';  
                     echo '<script>window.location="cart.php"</script>';  
                }  
           }  
      }  
 }  

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Hertz-UTS</title>
  <link href="css/style.css" rel="stylesheet"/>
  <script language="Javascript">
 function checkOnlyDigits(e, id) {
			e = e ? e : window.event;
			var charCode = e.which ? e.which : e.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				document.getElementById(id+'_errorMsg').style.display = 'block';
				document.getElementById(id+'_errorMsg').style.color = 'red';
				document.getElementById(id+'_errorMsg').innerHTML = 'OOPs! Only digits allowed.';
				
				return false;
			} else {
				document.getElementById(id+'_errorMsg').style.display = 'none';
				return true;
			}
		}
  function validateCheckout(){
	  
	  var cart = <?php echo count($_SESSION["cart"]);?>;
	  
	  if (cart <=0){ 
		alert("No car has been reserved");
		return false; 
	  }else{
		  
		  var inputs = document.getElementsByName('qty[]');
		  var count=0;
			var i;
			for (i = 0; i < inputs.length; i++) {
			   var input = inputs[i].value;
			if(input==0){
				count++;
			}
			   // work with input (validate, etc.)
			}
			if(count>0){
				alert(count+" Days must be greater than 0");
				return false; 
			}else{
				return true;
			}
		  
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
    <h2 align="center">Car Reservation</h2>
   
	<div id="clear"></div>
    <section>
	<form name="checkout" action="checkout.php" method="POST">
	<table id="cart-table" width="100%">
	  <tbody>
		<tr>
		<th>Thumbnail</th>
		<th>Vehicle</th>
		<th>Price Per Day</th>
		<th>Rental Days</th>
		<th>Action</th>
		</tr>
		<?php
		if(isset($_SESSION["cart"])){	
		
			foreach ($_SESSION["cart"] as $vehicles){//loop through the cart items
		?>
			<tr>
				<td>
				<img src='images/<?php echo $vehicles["vehicle"]; ?>.jpg' alt="" width="50" height="40" />
				</td>
				<td><?php echo $vehicles["year"]."-".$vehicles["vehicle"]?></td>
				<td>$<?php echo $vehicles["price"] ?></td>
				<td>
				<input type='text' id="<?php echo $vehicles["vehicle"];?>_qty" name="qty[]"  maxlength="2" size="2" placeholder="qty" required  onkeypress="return checkOnlyDigits(event,'<?php echo $vehicles["vehicle"];?>')" /><div id="<?php echo $vehicles["vehicle"];?>_errorMsg"></div>
				</td>
				<td><a href="cart.php?action=delete&id=<?php echo $vehicles["vehicle"]; ?>" class="button">Remove</a></td>  
                          
                          
			</tr>
		<?php
		}
		?>
			<tr>
			<td colspan="5" align="right"><input type='submit' name='checkout' class='button' value="Proceding to Checkout" onclick="return validateCheckout()" /></td>
			</tr>
		<?php
		}else{
		?>
		<tr>
		<td colspan="5" align="center">Your cart is empty</td>
		</tr>
		<?php	
		}	
		?>
	  </tbody>
	</table>
	</form>
<div id="clear"></div>
    </section>
    
   </article>
   
   <footer>
   Hertz-UTS Car Rental Center
   </footer>
  </div>
 </body>
</html>
