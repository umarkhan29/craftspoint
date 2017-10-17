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
	
?>
<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_welcome_div" >
    Welcome  <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>

<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);


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
   <div style=" padding-top:100px; padding-left:30%;">
   <form action="" method="post">
  		<table>
			<tr>
				<td><input type="text" class="inputtext" name="update_product" placeholder="Enter Name or ID"/></td>
				<td class="val_error">
					<?php 
					$count=0;
					if(isset($_POST['submitbtn'])){
						if(!$_POST['update_product']==""){
							if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{1,26}$%",$_POST['update_product'])){
			
								}	
							else{
								$count=1;
								echo "Invalid Parameter";
							}
						}
						else{
							echo "Enter Name or ID";
							$count=1;
						}
					
					} 
				
				?>
				</td>
			</tr>
			<tr>
				<td><input type="submit" class="submitbtn" name="submitbtn" value="Find" /></td>
			</tr>
		
		</table>
   </form>
   </div>
   
   
</div>

</div>
<div style="height:7px; width:100%;" > </div>
<?php
if(isset($_POST['submitbtn'])){
	if($count==0){
		header('location:update_product_details.php?token='.$_POST['update_product']);
	}

}
?>


<?php

require_once(COMMON.FOOTER);
ob_end_flush();
?>

