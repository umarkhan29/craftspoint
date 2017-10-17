<?php
ob_start();
			 $_SERVER['REQUEST_METHOD'];
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(isset($_SESSION['Authentic&ValidUser'])){
	if($_SESSION['Authentic&ValidUser']=="no"){
		header('location:admin_login.php');
	}
}
else{
		header('location:admin_login.php');
}
	require_once(COMPONENTS.CONNECT);
	ob_start();	
	require_once(COMMON.HEADER);
	
?>

<link rel="stylesheet" href="css/admin_style.css" />


<div id="admin_welcome_div" >
    Welcome <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>
<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);
?>

<div id="admin_login_section">

    <div class="admin_section_title">
		Update Shipping Cost
	</div>    
	
	
	<form action="" method="post" >
<div class="admin_main_section">
	<table cellspacing="5px">
		<tr>
			<td > 
					<select class="inputtext" name="filename" >
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
			</td>
			<td class="val_error"> 
				<?php 
					$count=0;
					if(isset($_POST['update'])){
						if($_POST['filename']!="--Select--"){
							if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{3,26}$%",$_POST['filename'])){
			
								}	
							else{
								$count=1;
								echo "Something wrong happened";
							}
						}
						else{
							echo "Select State";
							$count=1;
						}
					
					} 
				
				?>
		</td>
		</tr>
		
		
		
		
	
		<tr>
			<td > <input type="text" name="cost" class="inputtext" placeholder="Cost in Rupees"  value="<?php if(isset($_POST['see'])){
																			$state=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filename']))));
																				if($cost=mysql_query("SELECT `cost` FROM `shipping_cost` WHERE `state`='$state'")){
																					$row=mysql_fetch_assoc($cost);
																					echo $row['cost'];
																				}
																				}
																				?>" />
			</td>
			
			<td class="val_error"> 
				<?php 
					if(isset($_POST['update'])){
						if($_POST['cost']!=""){
							if(preg_match("%^[0-9]{1,5}$%",$_POST['cost'])){
			
								}	
							else{
								$count=1;
								echo "Enter a valid amount";
							}
						}
						else{
								echo "Enter Cost";
								$count=1;
						}
						
					} 
				
				?>
		</td>
		</tr>
		<tr>
		<td><input type = "submit" class="submitbtn" value="See" name="see"/> </td>
		</tr>
		<tr>
		<td > <input type = "submit" class="submitbtn" value="Update" name="update"/></td>
		</tr>
	</table>
	</form>
	<div style="color:#0fa1e0; padding:10px;">
				
				
	<?php
				
			if(isset($_POST['update'])){
				
				if($count==0){						
						
							$file_name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filename']))));
							$file_cost=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['cost']))));
							
							if(mysql_query("UPDATE `shipping_cost` SET `cost`='$file_cost' WHERE `state`='$file_name'")){
								echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:22px; color:green">Sucessfully Updated</div>';
							}
							else{
								
								die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:28px; color:red"> Could Not Update</div>');
							}
						}
	}
	
	?>
	</div>
</div>




</div>

</div>
<div style="height:7px; width:100%;" > </div>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>