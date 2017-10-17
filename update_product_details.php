<?php
	require_once('config.khan');
	ob_start();
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
	require_once(COMMON.HEADER);
	if(!isset($_GET['token'])){
		header('location:error.php');
	}
?>
<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_welcome_div" >
    Welcome  <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>

<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);

$token=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['token']))));
$result=mysql_query("SELECT * FROM `products` WHERE `id`='$token' or `name` = '$token'") or die(header('location:error.php?token=dbt'));
$count=0;
		if($result){ 
			while($row = mysql_fetch_assoc($result)){
						$product_details[] = array(
							'NAME'				=>	$row['name'],
							'SIZE'				=>	$row['size'],
							'ORIGINAL_COST'		=>	$row['price'],
							'FINAL_PRICE'		=>	$row['discount'],
							'DESC'				=>	$row['discription'],
							'ID'				=>	$row['id'],
							'QUANTITY'			=>	$row['quantity'],
							'PATH'				=>	$row['path']	
						);	
				}
			}
			
	$flag=0;
	if(isset($product_details[0]['ID'])){
			$flag=1;
		}

?>

<div id="admin_login_section">

			<div class="main">
				<div class="content">
					<div class="content_top">
						<div class="heading">
						<h3>Update Products</h3>
						</div>
				
					 </div>
				</div>
			</div>
			<?php if($flag==1){ ?>
   <div style=" padding-top:100px; padding-left:30%; margin-left:-15%;">
   <form action="" method="post">
  		<table>
			<tr>
				<td >
					 <img src="<?php echo $product_details[0]['PATH'];?>" height="180" alt="" />
				</td>
				<td style="color:#602D8D; padding:7px; font-size:24px;"><?php echo $product_details['0']['NAME']; ?></td>
				<td></td>
			</tr>
				<tr>
				<td style="color:#602D8D; padding:7px; font-size:24px;">Size</td>
				<td><input type="text" class="inputtext" name="product_size" value="<?php echo $product_details['0']['SIZE']; ?>"/></td>
				<td class="val_error">
					<?php 
					
					if(isset($_POST['submitbtn'])){
						if(!$_POST['product_size']==""){
							if(preg_match("%^[0-9]{1,3}[*]{1}[0-9]{1,3}$%",$_POST['product_size'])){
			
								}	
							else{
								$count=1;
								echo "Invalid Size";
							}
						}
						else{
							echo "Enter Size";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
			
			</tr>
				<tr>
				<td style="color:#602D8D; padding:7px; font-size:24px;">Quantity</td>
				<td><input type="text" class="inputtext" name="product_qty" value="<?php echo $product_details['0']['QUANTITY']; ?>"/></td>
				<td class="val_error">
					<?php 
					
					if(isset($_POST['submitbtn'])){
						if(!$_POST['product_qty']==""){
							if(preg_match("%^[0-9]{1,3}$%",$_POST['product_qty'])){
			
								}	
							else{
								$count=1;
								echo "Invalid Quantity";
							}
						}
						else{
							echo "Enter Quantity";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
			
				<tr>
				<td style="color:#602D8D; padding:7px; font-size:24px;">Original Cost</td>
				<td><input type="text" class="inputtext" name="product_original_cost" value="<?php echo $product_details['0']['ORIGINAL_COST']; ?>" /></td>
				<td class="val_error">
					<?php 
					
					if(isset($_POST['submitbtn'])){
						if(!$_POST['product_original_cost']==""){
							if(preg_match("%^[0-9]{1,11}$%",$_POST['product_original_cost'])){
			
								}	
							else{
								$count=1;
								echo "Enter Valid Amount";
							}
						}
						else{
							echo "Enter Original Price";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
				<tr>
				<td style="color:#602D8D; padding:7px; font-size:24px;">Final Cost</td>
				<td><input type="text" class="inputtext" name="final_cost" value="<?php echo $product_details['0']['FINAL_PRICE']; ?>"/></td>
				<td class="val_error">
					<?php 
					if(isset($_POST['submitbtn'])){
						if(!$_POST['final_cost']==""){
							if(preg_match("%^[0-9]{1,11}$%",$_POST['final_cost'])){
			
								}	
							else{
								$count=1;
								echo "Enter Valid Amount";
							}
						}
						else{
							echo "Enter Final Price";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
				<tr>
				<td style="color:#602D8D; padding:7px; font-size:24px;">Description</td>
				<td><input type="text" class="inputtext" name="product_description" value="<?php echo $product_details['0']['DESC']; ?>" /></td>
				<td class="val_error">
					<?php 
					
					if(isset($_POST['submitbtn'])){
						if(!$_POST['product_description']==""){
							if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,1000}$%",$_POST['product_description'])){
			
								}	
							else{
								$count=1;
								echo "Invalid Characters Entered";
							}
						}
						else{
							echo "Enter Description";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="submitbtn" name="submitbtn" value="Update" /></td>
			</tr>
		
		</table>
   </form>
   </div>
   
  <?php
  }//close if(check for if id or name  is present in db or not
  else{
  	echo '<div style="width:35%; margin-top:100px !important; color:red; margin:auto; font-size:18px;">The Id or Name you entered is Either Invalid or it does not exist in our Database</div>';
	echo 'Go back to <a href="products_update.php">Products update</a>';
  }
if(isset($_POST['submitbtn'])){
	if($count==0){
	$id=$product_details['0']['ID'];
	$size=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['product_size']))));
	$original_price=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['product_original_cost']))));
	$final_price=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['final_cost']))));
	$desc=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['product_description']))));
	$qty=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['product_qty']))));
		
		if(mysql_query("UPDATE `products` SET `price`='$original_price',`discount`='$final_price' ,`discription`='$desc',`size`='$size',`quantity` ='$qty'   WHERE `id`='$id' ")){
				echo '<div style="width:35%; padding:2%; color:green; margin:auto; font-size:18px;">Sucessfully Updated ! </div>';
		}
		else{
			echo '<div style="width:35%; padding:2%; color:red; margin:auto; font-size:18px;">Something went wrong !</div>';
		}
	}

}
?>

</div>

</div>
<div style="height:7px; width:100%;" > </div>

<?php

require_once(COMMON.FOOTER);
ob_end_flush();
?>

