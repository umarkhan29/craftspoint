<?php
ob_start();
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
	require_once(COMMON.HEADER);
	
?>
<div style="width:100%; background:#cccccc;">
	Go back to <a href="users.php">Customers</a>
</div>
<div style="width:100%; min-height:100px; background:#999999;"> 

<table style="width:100%;">
	<tr >
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Phone</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Product Name</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Price</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Email</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Sold On</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Address</span></td>
	</tr>
	<?php
		$email=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['email']))));
		$i=1;
		if($result=mysql_query("SELECT * FROM `user_details` WHERE `email`='$email'")){
			while($row=mysql_fetch_assoc($result)){
			
	?>
	<tr >
		<td class="user_details_table"><?php echo $row['phone'];?></td>
		<td class="user_details_table"><?php echo $row['product_name']; ?></td>
		<td class="user_details_table"><?php echo $row['price']; ?></td>
		<td class="user_details_table"><?php echo $row['email'];?></td>
		<td class="user_details_table"><?php echo $row['sold_on'];?></td>
		<td class="user_details_table"><?php echo $row['shipping_address'];?></td>
		
		
	</tr>
	
	<?php
				$i++;
			}
		}
	
	?>
</table>

</div>



<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>