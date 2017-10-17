<?php
ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(!isset($_SESSION['forgot_pass_auth'])){
		header('location:forgot_password.php');
	}
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
	
?>
<div>
<link rel="stylesheet" href="css/admin_style.css" />
<div style="margin:auto;padding: 7px;border: 0;font-size: 18px;background: transparent; color:#333333; width:50%; ">
A verification code has been send to <span style="color:#602D8D;"><a href=""><?php echo $_SESSION['forgot_email']; ?></a></span><br>Please Enter that code to continue.<br>
</div>
<form action="" method="post">
	<div style="margin-left:25%; width:35%;">
	<table>
		<tr>
			<td ><input type="text" name="auth" placeholder="Authentication Code" class="inputtext" /></td>
			<td style="color:#FF0000; font-size:12px; padding-left:7%;">
				<?php 
						$admin="1";
						if(isset($_POST['authbtn'])){
							
							if($_POST['auth']==""){
								
								echo "Enter Authentication Code";
								$admin="0";
								}
								else{
									if(preg_match("%^[0-9]{2,6}$%",$_POST['auth'])){
									
									}	
									else{
									
									echo "Enter a valid Code";
									$admin="0";
									}
								}
						} 
					?>
			</td>
		</tr>
		<tr>
			<td ><input type="password" name="new_pass" placeholder="New Password" class="inputtext" /></td>
			<td style="color:#FF0000; font-size:12px; padding-left:7%;">
				<?php 
						
						if(isset($_POST['authbtn'])){
							
							if($_POST['new_pass']==""){
								
								echo "Enter New Password";
								$admin="0";
								}
								else{
									if(preg_match("%^[0-9 a-z A_Z .,-90&!@]{4,20}$%",$_POST['new_pass'])){
									
									}	
									else{
									
									echo "Enter a valid Password";
									$admin="0";
									}
								}
						} 
					?>
			</td>
		</tr>
		<tr>
			<td ><input type="password" name="repass" placeholder="ReEnter Password" class="inputtext" /></td>
			<td style="color:#FF0000; font-size:12px; padding-left:7%;">
				<?php 
						
						if(isset($_POST['authbtn'])){
							
							if($_POST['repass']==""){
								
								echo "Retype new password";
								$admin="0";
								}
								else{
									if(preg_match("%^[0-9 a-z A_Z .,-90&!@]{4,20}$%",$_POST['repass'])){
										if($_POST['repass']!=$_POST['new_pass']){
											echo "Passwords do not match";
											$admin="0";
										
										}
									}	
									
									
									
								}
						} 
					?>
			</td>
		</tr>
	</table>
	

	<input type="submit" value="Change Password" name="authbtn" id="authenticatebtn"/>
		</div>
</form>

</div>
<?php
	if(isset($_POST['authbtn'])){
	if($admin=="1"){
	$auth_code=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['auth']))));
	if($auth_code==$_SESSION['forgot_pass_auth']){
		
		$new_pass=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['new_pass']))));
		$new_pass=md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$new_pass))))));
		$email=$_SESSION['forgot_email'];
		if(mysql_query("UPDATE `users` SET `passcode` ='$new_pass' WHERE `email`='$email' ")){
						echo '<div style="font-family:Arial,Helvetica,sans-serif;width:22%;height:100px;margin-left:25%;font-size:18px; color:green;">Password Changed Sucessfully<br><a href="login.php">Login</a></div>';
						session_destroy();
			}
			else{
				
				echo '<div style="font-family:Arial,Helvetica,sans-serif;font-size:14px;margin-left:25%; color:red;">Something Went Wrong !</div>';
			}
	}
	else{
		echo '<div style="font-family:Arial,Helvetica,sans-serif;font-size:14px; margin-left:25%; color:red;">The Code you entered is incorrect.<br>ReEnter Your Code.</div>';
	
	}
	}
	}
?>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>