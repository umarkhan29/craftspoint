<?php
ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
		if(isset($_SESSION['Loggedin_User'])){
	if($_SESSION['Loggedin_User']=="no"){
		header('location:login.php');
	}
}
else{
		header('location:login.php');
}
	
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	?>
	
	
	<?php
		
		$user_name=$_SESSION['current_loggedin_user'];
		$result=mysql_query("SELECT * FROM `users` where `name`='$user_name'") or die(header('location:error.php?token=dbt'));
		if($result){
				$User_Results;
				while($row = mysql_fetch_assoc($result)){
						$User_Results[] = array(
							'NAME'		=>	$row['name'],
							'EMAIL'		=>	$row['email'],
							'PHONE'		=>	$row['phone']
							
						);
						
						
						
				}
			// now $User_Results[] contains   db table
			}
			else{
				//  error
			}
			
		?>
<div style = "height:130px; padding-left:40px;  padding-top:30px; font-size:27px; color: #666666;width:100%;border:0px solid red; margin:auto;">
<img  src="images/profile_pictures/default.png" style="border-radius:50px; height:100px; width:110px; cursor:pointer;" alt="Change Picture"/> <?php echo $_SESSION['current_loggedin_user']; ?>
</div>
<div style = "height:40px; padding-left:50px;  padding-top:30px; font-size:20px; color:#999999; width:100%; margin:auto; ">
Email : <?php echo $User_Results[0]['EMAIL']; ?>
</div>
<div style = "height:40px; padding-left:50px;  padding-top:0px; font-size:20px; color:#999999; width:100%;margin:auto;">
Phone :<?php echo $User_Results[0]['PHONE']; ?>
</div>

<div style="width:100%; height:20px; border-bottom:1px dashed #999999;">
</div>
<br />
<div style="width:80%;">
	<a href="orders.php" style = "height:40px; padding-left:50px; font-size:20px; color:#999999; width:100%; ">My Orders</a>
<br /><br />

	<a href="change_password.php" style = "height:40px; padding-left:50px;  padding-top:0px; font-size:20px; color:#999999; width:100%;">Change Password</a>

<br />
<a href="user_logout.php" style = "height:40px; padding-left:50px; font-size:20px; color:#999999; width:100%; margin-left:80%;">Logout</a>
</div>
<div style="width:100%; height:30px;">
</div>







<?php
require_once('home/common/footer.khan');
ob_end_flush();
?>
