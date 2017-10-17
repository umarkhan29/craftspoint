<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(isset($_SESSION['Loggedin_User'])){
	
		header('location:profile.php');
	}
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
?>

<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_login_pannel">
	<?php
		if(isset($_GET['message'])){
			if($_GET['message']="password sent"){
				echo '<div style="width:80%;  padding-left:20%; overflow:hidden; color:green; font-size:32px; background:#999999;">Password sent to you registered email</div>';
			}
		
		}
	?>
	 <div class="left_content">
      <div class="title"></span>My account</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">login into your account</div>
           <form action="" method="post">
		  <table>
		 	 <tr>
				<td>
					<div class="form_row">
					  <label class="contact"><strong>Username</strong></label>
					  <input type="text" class="contact_input" name="usernametxtbox" />
					</div>
				</td>
				<td class="signup_val_error">
					<?php 
						
						if(isset($_POST['loginbtn'])){
							$admin="1";
							if($_POST['usernametxtbox']==""){
								$admin="0";
								echo "Enter UserName";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['usernametxtbox'])){
									
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
					  <label class="contact"><strong>Password</strong></label>
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
			</table>
           <div class="form_row">
		   
              <div class="terms">
                <a href="forgot_password.php"/>Forgot Password</a>
				
				 
               
				</div>
				
				
            </div>
            <div class="form_row">
              <input type="submit" id="adloginbtn" value="Login" name="loginbtn" />
            </div>
			<a href="user_signup.php"/>Need an account ?</a>
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
			$user__name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['usernametxtbox']))));
			$user__pass=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['passwrdtxtbox']))));
			$user__pass=md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$user__pass))))));
			$query="select * from `users` where `name`='$user__name' and `passcode`='$user__pass';";
			
			if($user=mysql_query($query)){
				while($row=mysql_fetch_assoc($user)){
				if(mysql_num_rows($user)==1){
					$_SESSION['Loggedin_User']="yes";
					$_SESSION['Loggedin_User_password']=$user__pass;
					$_SESSION['current_loggedin_user']= $user__name;
					$_SESSION['current_loggedin_user_email']=$row['email'];
					header('location:profile.php');
				}
				
				else{
					echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:24px; color:red;">Invalid Login !</div>';
				}
			}
			}
			else{
				echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:24px; color:red;">Something Went Wrong!</div>';
			}
		}
		
	}
	?>



<?php
ob_end_flush();
require_once(COMMON.FOOTER);
?>