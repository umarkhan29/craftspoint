<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(isset($_SESSION['Authentic&ValidUser'])){
	if($_SESSION['Authentic&ValidUser']=="yes"){
		header('location:admin_section.php');
	}
	}
	

	
	
	require_once(COMPONENTS.CONNECT);
		
	require_once(COMMON.HEADER);
	?>

<link rel="stylesheet" href="css/admin_style.css" />
<?php
		if(isset($_GET['message'])){
			if($_GET['message']="password sent"){
				echo '<div style="width:80%;  padding-left:20%; overflow:hidden; color:green; font-size:32px; background:#999999;">Password sent to you registered email</div>';
			}
		
		}
	?>
<div id="admin_login_pannel">
	
	 <div class="left_content">
      <div class="title"></span>Admin Login</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">Login into your Account</div>
		  
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
                <a href="admin_forgot_password.php"/>Forgot Password</a>
               
				</div>
            </div>
            <div class="form_row">
              <input type="submit" id="adloginbtn" value="Login" name="loginbtn" />
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
			$user__name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['usernametxtbox']))));
			$user__pass=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['passwrdtxtbox']))));
			$user__pass=md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$user__pass))))));
			$query="select * from `admins` where `username`='$user__name' and `passcode`='$user__pass';";
			
			if($user=mysql_query($query)){
			
				if(mysql_num_rows($user)==1){
					$_SESSION['Authentic&ValidUser']="yes";
					$_SESSION['admin_password']=$user__pass;
					$_SESSION['current_user']= $user__name;
					header('location:admin_section.php');
				}
				else{
					echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:40px; color:red;">Invalid Login !</div>';
				}
			}
			else{
				echo '<div style="font-family:Arial,Helvetica,sans-serif;width:40%;height:100px;margin:auto;font-size:40px; color:red;">Something Went Wrong!</div>';
			}
		}
		
	}
	?>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>
