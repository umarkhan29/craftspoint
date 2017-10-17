<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
?>
<script type="text/javascript">
function signup_validate(thediv,name){

	var value=document.getElementById(name).value;
	var password=document.getElementById('Password').value;
	
	
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById(thediv).innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','home/catalog/signup_validation.php?name='+name+'&value='+value+'&pass='+password,true);
	
	
	xmlhttp.send();
	
}

</script>



<link rel="stylesheet" href="css/admin_style.css" />

<div id="admin_login_pannel">
	
	 <div class="left_content">
      <div class="title"></span>WELCOME</div>
      
   
        <div class="contact_form">
		<div style="margin-top:-40px">
          <div class="form_subtitle">Create An Account</div>
          <form action="" method="post">
		  <table>
		  	<tr>
            <td><div class="form_row">
              <label class="contact"><strong>Username</strong></label>
              <input type="text" class="contact_input" id="Username"  name="Username" onKeyUp="signup_validate('validate_username','Username');"/></td>
			 </div>
			 <td class="signup_val_error">
			 <div id="validate_username">
			 	<?php 
						$admin="1";
						if(isset($_POST['signupbtn'])){
							
							if($_POST['Username']==""){
								$admin="0";
								echo "Enter UserName";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['Username'])){
										$result=mysql_query("SELECT * FROM `users`") or die("Db error");
									if($result){
											$users;
											while($row = mysql_fetch_assoc($result)){
													if($_POST['Username']==$row['name']){
												echo "User Name already exists.";
												$admin="0";
											}
													
											
													
											}
										// noe $search_slide_Results contains whole slide db table
										}
										else{
											// no users
										}
				
									}	
									else{
									$admin="0";
									echo "Enter a valid UserName";
									}
								}
						} 
					?>
					</div>
			 </td>
            
			</tr>
			<tr>
			<td> <div class="form_row">
              <label class="contact"><strong>Email id</strong></label>
              <input type="text" class="contact_input" id="Email" name="Email" onKeyUp="signup_validate('validate_email','Email');" /></td>
			  <td class="signup_val_error">
			  <div id="validate_email">
			  		<?php 
						
						if(isset($_POST['signupbtn'])){
						
							if($_POST['Email']==""){
								$admin="0";
								echo "Enter Email";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-z]{2,16}$%",$_POST['Email'])){
											$result=mysql_query("SELECT * FROM `users`") or die("Db error");
									if($result){
											$users;
											while($row = mysql_fetch_assoc($result)){
													if($_POST['Email']==$row['email']){
												echo "Email already registered";
												$admin="0";
											}
													
											
													
											}
										// noe $search_slide_Results contains whole slide db table
										}
										else{
											// no users
										}
									}	
									else{
									$admin="0";
									echo "Enter a valid Email";
									}
								}
						} 
					?>
					</div>
			  	</td>
            </div>
			</tr>
			
			<tr>
			<td><div class="form_row">
              <label class="contact"><strong>Phone Number</strong></label>
              <input type="text" class="contact_input" id="Phone_Number" name="Phone_Number" onKeyUp="signup_validate('validate_phone','Phone_Number');"/></td>
			  <td class="signup_val_error"><div id="validate_phone">
			  		<?php 
						
						if(isset($_POST['signupbtn'])){
							
							if($_POST['Phone_Number']==""){
								$admin="0";
								echo "Enter Phone Number";
								}
								else{
									if(preg_match("%^[0-9]{10,10}$%",$_POST['Phone_Number'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Number";
									}
								}
						} 
					?>
					</div>
				</td>
            </div>
			</tr>
			<tr>
            <td> <div class="form_row">
             <label class="contact"><strong>Password</strong></label>
              <input type="password" class="contact_input" name="Password" id="Password" onKeyUp="signup_validate('validate_pass','Password');"/></td>
			  <td class="signup_val_error">
			  <div id="validate_pass">
			  	<?php 
						
						if(isset($_POST['signupbtn'])){
							
							if($_POST['Password']==""){
								$admin="0";
								echo "Enter Password";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['Password'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Password";
									}
								}
						} 
					?>
			  </td>
			  </div>
            </div>
			</tr>
			
			<tr>
			<td> <div class="form_row">
              <label class="contact"><strong>Confirm Password</strong></label>
              <input type="password" class="contact_input" id="Confirm_Password" name="Confirm_Password" onKeyUp="signup_validate('validate_confirm_pass','Confirm_Password');" /></td>
			  <td class="signup_val_error">
			  <div id="validate_confirm_pass" >
			  	<?php 
						
						if(isset($_POST['signupbtn'])){
							
							if($_POST['Confirm_Password']==""){
								$admin="0";
								echo "Confirm your Password";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$_POST['Confirm_Password'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Password";
									}
									if($_POST['Confirm_Password'] != $_POST['Password']){
										echo "Passwords do not match";
									}
								}
						} 
					?>
					</div>
			  </td>
            
            </div>
			</tr>
			<tr>
			<td>
            <div class="form_row">
              
            </div>
			</td>
			<td><input type="submit" class="register" value="Sign Up" name="signupbtn"/></td>
			</tr>
			</table>
          </form>
		  </div>
        </div>
</div>
     
 
   
</div>
<div style="height:30px; width:100%;">
</div>
<?php
	
	if(isset($_POST['Username'])){
		if($admin=="1"){
			$_SESSION['$user_name']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['Username']))));
			$_SESSION['$pass']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['Password']))));
			$_SESSION['$email']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['Email']))));
			$_SESSION['$phone']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['Phone_Number']))));
			$_SESSION['$pass']=md5(md5(hash('sha512',md5(base64_encode(hash('sha1',$_SESSION['$pass']))))));
			$_SESSION['$auth']=rand(0000,999999);
		$message="Your OTP for registration process is ".$_SESSION['$auth']."\n \n \n \n"."Disclaimer:
This message is intended only for the use of the addressee and may contain information that is privileged, confidential and exempt from disclosure under applicable law. If the reader of this message is not the intended recipient, or the employee or agent responsible for delivering the message to the intended recipient, you are hereby notified that any dissemination, distribution or copying of this communication is strictly prohibited. If you have received this e-mail in error, please notify us immediately and delete this e-mail and all attachments from your system.";
			mail($_SESSION['$email'],"Authentication Code",$message,"From:Craftspoint.in");
			header('location:user_auth.php');
		}
	}
?>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>