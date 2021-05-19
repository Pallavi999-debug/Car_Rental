<?php
session_start();

$qtys = $_POST['qty'];
$_SESSION["qty"]=$qtys;
$totals=0;
$keys = array_keys($_SESSION["cart"]);
for($i = 0; $i < count($_SESSION["cart"]); $i++) {
   // echo $keys[$i] . "{<br>";
    foreach($_SESSION["cart"][$keys[$i]] as $key => $value) {

       // echo $key . " : " . $value ." ".$qtys[$i]." <br>";
		$tot=$value*$qtys[$i];
		//echo $tot;
    }
   // echo "}<br>";
	$totals+=$tot;
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Hertz-UTS</title>
  <link href="css/style.css" rel="stylesheet"/>
 <script type = "text/javascript">
function validEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate() {
	
	
  var fname=document.getElementById("fname").value;
  var lname=document.getElementById("lname").value;
  var email=document.getElementById("email").value;
  var address=document.getElementById("address").value;
  var city=document.getElementById("city").value;
  var state=document.getElementById("state").value;
  var code=document.getElementById("code").value;
  var paymenttype=document.getElementById("paymenttype").value;
  
	if (fname==""){   
		document.getElementById("validator").innerHTML = "*Please provide First Name";
		document.checkout.fname.focus() ;
		return false;  
	}if (lname==""){   
		document.getElementById("validator").innerHTML = "*Please provide Last Name";
		document.checkout.lname.focus() ;
	return false;  
	}
	if (!validEmail(email)) {
       document.getElementById("validator").innerHTML = "*Please provide a valid email";
		document.checkout.email.focus() ;
		return false;
     } 
	 if (address==""){   
		document.getElementById("validator").innerHTML = "*Please provide your Address";
		document.checkout.address.focus() ;
	return false;  
	}
	if (city==""){   
		document.getElementById("validator").innerHTML = "*Please provide your City";
		document.checkout.city.focus() ;
	return false;  
	}
	if (state==""){   
		document.getElementById("validator").innerHTML = "*Please Select your State";
		document.checkout.state.focus() ;
	return false;  
	}
	if (code==""){   
		document.getElementById("validator").innerHTML = "*Please provide your postal code";
		document.checkout.code.focus() ;
	return false;  
	}if (paymenttype==""){   
		document.getElementById("validator").innerHTML = "*Please Select your Payment Type";
		document.checkout.paymenttype.focus() ;
	return false;  
	}
  
  return true ;
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
    <h2 align="center">Check Out</h2>
   
	<div id="clear"></div>
	<p>Customer Details and Payment</p>
	<p>Please fill in your details. * indicates required fields
    <section>
	<div style=" display:block; color:red;" id="validator"></div>
	<form name="checkout" action="checkout_and_sendmail.php" method="POST" onsubmit = "return validate();">
	<table width="60%">
	  <tbody>
			<tr>
            <td>First Name*</td>
            <td><input type="text" class="textfield" id="fname" name="firstname" /></td>
			</tr>
			<tr>
            <td>Last Name*</td>
            <td><input type="text" class="textfield" id="lname" name="lastname"  /></td>
			</tr>
			<tr>
            <td>Email Address*</td>
            <td><input type="text" class="textfield" id="email" name="email" /></td>
			</tr>
            <tr>
            <td>Address Line 1*</td>
            <td><input type="text" class="textfield" id="address" name="address"  /></td>
			</tr>
			<tr>
            <td>Address Line 2</td>
            <td><input type="text" class="textfield" id="address2" name="address2" /></td>
			</tr>
			<tr>
            <td>City*</td>
            <td><input type="text" class="textfield" id="city" name="city"  /></td>
			</tr>
			<tr>
            <td>State*</td>
            <td>
			<select name="state" >
			  <option value="New-South-Wales">New South Wales</option>
			  <option value="Queensland">Queensland</option>
			  <option value="South-Australia">South Australia</option>
			  <option value="Tasmania">Tasmania</option>
			  <option value="Victoria">Victoria</option>
			  <option value="Western-Australia">Western Australia</option>
			  <option value="Northern-Territory">Northern Territory</option>
			  <option value="Australian-Capital-Territory">Australian Capital Territory</option>
			</select></td>
			</tr>
			<tr>
            <td>Postal Code*</td>
            <td><input type="text" class="textfield" id="code" name="code" /></td>
			</tr>
			<tr>
            <td>Payment type*</td>
            <td>
			<select name="paymenttype" >
			  <option value="Visa">Visa</option>
			  <option value="WesternUnion">Western Union</option>
			</select>
			
			</td>
			</tr>
			<tr>
			</tr>
			<td colspan="2"><strong>You are required to pay $<?php echo $totals?></strong></td>
			<tr> 
			<td colspan="2" align="right">
			<a href="index.php" class='button' > Continue Selection </a>
			<input type='submit' name='checkout' class='button' value="Booking"  />
			</td>
			</tr>
			
			
	  </tbody>
	</table>
	<input type="hidden" name="totalpayable" value="<?php echo $totals?>" />
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
