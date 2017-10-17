<?php
ob_start();
	
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
?>

<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_login_pannel">
	
	 <div class="left_content">
      <div class="title"></span>Privacy</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">Change Password</div>
           <form action="" method="post">
		  <table>
		 	 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Current Password</strong></label>
					  <input type="text" class="contact_input" name="oldpass" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['loginbtn'])){
							$admin="1";
							if($_POST['oldpass']==""){
								$admin="0";
								echo "Enter UserName";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['oldpass'])){
										if($_SESSION['Loggedin_User_password']!= md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$_POST['oldpass']))))))){
											echo "Incorrect Password";
											$admin="0";
										}
									}	
									else{
									$admin="0";
									echo "Enter a valid UserName";
									}
								}
						} 
					?>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>New Password</strong></label>
					  <input type="password" class="contact_input" name="passwrdtxtbox" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						if(isset($_POST['loginbtn'])){
							if($_POST['passwrdtxtbox']==""){
								$admin="0";
								echo "Enter Password";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,30}$%",$_POST['passwrdtxtbox'])){
										
									}	
									else{
									$admin="0";
									echo "Enter a valid Password";
									}
								}
						} 
					?>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Confirm Password</strong></label>
					  <input type="password" class="contact_input" name="confirmpasswrdtxtbox" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						if(isset($_POST['loginbtn'])){
							if($_POST['confirmpasswrdtxtbox']==""){
								$admin="0";
								echo "Enter Password";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,30}$%",$_POST['confirmpasswrdtxtbox'])){
										if($_POST['confirmpasswrdtxtbox']!=$_POST['passwrdtxtbox']){
											echo "Passwords do not match";
											$admin="0";
										}
									}	
									else{
									$admin="0";
									echo "Enter a valid Password";
									}
								}
						} 
					?>
				</td>
			</tr>
			</table>
           <div class="form_row">
		   
             
				
				
            </div>
            <div class="form_row">
              <input type="submit" id="changePassbtn" value="Update Password" name="loginbtn" />
            </div>
			
          </form>
		  </div>
        </div>
</div>
     
 
   
</div>
<div style="height:30px; width:100%;">
</div>


<?php
	if(isset($_POST['loginbtn'])){
		if($admin=="1"){
			
			$user_pass=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['confirmpasswrdtxtbox']))));
			$user_pass=md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$user_pass))))));
			$user_name=$_SESSION['current_loggedin_user'];
			$query="UPDATE `users` SET `passcode` = '$user_pass' WHERE `name` = '$user_name';";
			
			if(mysql_query($query)){
			
					$_SESSION['Loggedin_User_password']=$user_pass;
					echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:16px; color:green;">Password Changed</div>';
				}
				else{
					echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:16px; color:red;">Something Went Wrong</div>';
					
				}
			}
			
		}
		
	
	?>



<?php

require_once(COMMON.FOOTER);
ob_end_flush();
?>