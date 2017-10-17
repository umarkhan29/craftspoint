<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
		if(isset($_SESSION['total_price'])){
		
?>

<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_login_pannel">
	
	 <div class="left_content">
      <div class="title"></span>Shipping Details</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">Enter You  Address</div>
           <form action="" method="post">
		  <table>
		 	 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Name</strong></label>
					  <input type="text" class="contact_input" name="nametxtbox" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['checkout'])){
							$admin="1";
							if($_POST['nametxtbox']==""){
								$admin="0";
								echo "Enter Name";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['nametxtbox'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Name";
									}
								}
						} 
					?>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Email</strong></label>
					  <input type="text" class="contact_input" name="email" />
					</div>
				</td>
				<td class="signup_val_error">
								  		<?php 
						
						if(isset($_POST['checkout'])){
						
							if($_POST['email']==""){
								$admin="0";
								echo "Enter Email";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-z]{2,36}$%",$_POST['email'])){
											
													
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Email";
									}
								}
						} 
					?>

				</td>
			</tr>
			
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Phone</strong></label>
					  <input type="text" class="contact_input" name="phone" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['checkout'])){
							$admin="1";
							if($_POST['phone']==""){
								$admin="0";
								echo "Enter Phone Number";
								}
								else{
									if(preg_match("%^[0-9 +]{10,13}$%",$_POST['phone'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Number";
									}
								}
						} 
					?>
				</td>
			</tr>
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Address</strong></label>
					  <input type="text" class="contact_input" name="address" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['checkout'])){
							$admin="1";
							if($_POST['address']==""){
								$admin="0";
								echo "Enter Address";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,46}$%",$_POST['address'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Address";
									}
								}
						} 
					?>
				</td>
			</tr>
			
			 
			
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>State</strong></label>

					  <select class="inputtext" name="state" >
						   <option>--Select--</option>
					  		<option>Andra pradesh</option>
							<option>Arunachal pradesh</option>
							<option>Assam</option>
							<option>Bihar</option>
							<option>Chhattisgarh</option>
							<option>Goa</option>
							<option>Gujrat</option>
							<option>Haryana</option>
							<option>Himachal pradesh</option>
							<option>Jammu and kashmir</option>
							<option>jharkand</option>
							<option>Karnataka</option>
							<option>Kerala</option>
							<option>Madya pradesh</option>
							<option>Maharastra</option>
							<option>Manipur</option>
							<option>Meghalaya</option>
							<option>Mizorum</option>
							<option>Nagaland</option>
							<option>Orissa</option>
							<option>Punjab</option>
							<option>Rajasthan</option>
							<option>SIkkim</option>
							<option>Tamil nadu</option>
							<option>Tripur</option>
							<option>Uttaranchal</option>
							<option>Uttar pradesh</option>
							<option>West bengal</option>
							<option>Andaman and nicobar islands</option>
							<option>chandigarh</option>
							<option>Dadar and nagar haveli</option>
							<option>Daman and diu</option>
							<option>Delhi</option>
							<option>Lakhshadeep</option>
							<option>Pondicherry</option>
							
							
					  </select>
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['checkout'])){
							$admin="1";
							if($_POST['state']=="--Select--"){
								$admin="0";
								echo "Enter State Name";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['state'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid State Name";
									}
								}
						} 
					?>
				
				</td>
			</tr>
			
			 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Pin Code</strong></label>
					  <input type="text" class="contact_input" name="pin" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['checkout'])){
							$admin="1";
							if($_POST['state']==""){
								$admin="0";
								echo "Enter Pin Code";
								}
								else{
									if(preg_match("%^[0-9]{6,6}$%",$_POST['pin'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Pin Code";
									}
								}
						} 
					?>
				</td>
			</tr>
			</table>
          
            <div class="form_row">
              <input type="submit" id="changePassbtn" value="Continue" name="checkout"  style=" background:#FF9900;"/>
            </div>
          </form>
		  </div>
        </div>
</div>
     
 
   
</div>
<div style="height:30px; width:100%;">
</div>


<?php
	if(isset($_POST['checkout'])){
		if($admin=="1"){
			$_SESSION['pay_name']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['nametxtbox']))));
			$_SESSION['pay_email']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['email']))));
			$_SESSION['pay_phone']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['phone']))));
			$_SESSION['pay_address']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['address']))));
			$_SESSION['pay_address'].=" state: ".mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['state']))));
			$_SESSION['pay_address'].=" pin: ".mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['pin']))));
			
				$state=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['state']))));
				$shipping_cost=mysql_query("SELECT `cost` FROM `shipping_cost` WHERE `state`='$state'");
												while($row=mysql_fetch_assoc($shipping_cost)){
													$shipping_cost=$row['cost'];
												}
												
				$_SESSION['shipping_cost']=$shipping_cost;
			header('location:payment_preview.php');
			
		}
	}
	?>



<?php
}
else{
	header('location:error.php');
}

ob_end_flush();
require_once(COMMON.FOOTER);
?>