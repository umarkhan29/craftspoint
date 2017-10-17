<?php
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
<link rel="stylesheet" href="css/admin_style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);
?>

<div id="admin_login_section">

        
		<?php
		
		$user_name=$_SESSION['current_user'];
		$result=mysql_query("SELECT * FROM `admins` where `username`='$user_name'") or die("Db error");
		if($result){
				$User_Results;
				while($row = mysql_fetch_assoc($result)){
						$User_Results[] = array(
							'NAME'		=>	$row['username'],
							'EMAIL'		=>	$row['email'],
						);
						
						
						
				}
			// now $User_Results[] contains   db table
			}
			else{
				//  error
			}
			
		?>
<div style = "height:130px; padding-left:40px;  padding-top:30px; font-size:27px; color: #666666;width:100%;border:0px solid red; margin:auto;">
<img  src="images/profile_pictures/default.png" style="border-radius:50px; height:100px; width:110px; cursor:pointer;" alt="Change Picture"/> <?php echo $_SESSION['current_user']; ?>
</div>
<div style = "height:40px; padding-left:50px;  padding-top:30px; font-size:20px; color:#999999; width:100%; margin:auto; ">
Email : <?php echo $User_Results[0]['EMAIL']; ?>
</div>

<div style="width:100%; height:20px; border-bottom:1px dashed #999999;">
</div>


<div style="width:80%; margin-top:15px;">

	<a href="change_admin_password.php" style = "height:40px; padding-left:50px;  padding-top:0px; font-size:20px; color:#999999; width:100%;">Change Password</a>

<br />
<a href="logout.php" style = "height:40px; padding-left:50px; font-size:20px; color:#999999; width:100%; margin-left:80%;">Logout</a>
</div>
<div style="width:100%; height:30px;">
</div>






</div>

</div>
<div style="height:7px; width:100%;" > </div>

</meta>
<?php

require_once(COMMON.FOOTER);
ob_end_flush();
?>

