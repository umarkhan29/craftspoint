<?php 
	require_once('../../config.khan');
	require_once('../components/connect.khan');					
	if(isset($_GET['name'])){
							
		$name=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['name']))));
		$value=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['value']))));	
		$pass=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['pass']))));
		//Phone Number	
		if($name=="Phone_Number"){
			if(preg_match("%^[0-9]{10,10}$%",$value)){
		
		}	
		else{
		
			echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Invalid Number</div> ');
		}
		
		exit();
		}
		
		
		
		
		
		
		
		//password
	if($name=="Password"){
		if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$value)){
		$count=strlen($value);
			if($count<=8){
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Strength:Weak </div> ');
			}
			if($count>8&&$count<14){
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:blue;">Strength:Good </div> ');
			}
			if($count>=14){
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:green;">Strength:Strong </div> ');
			}
		}	
		else{
		
			echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Invalid ').$name.('</div> ');
			exit();
		}
		}	
			
			
		
		//confirm password
		if($name=="Confirm_Password"){
			
				if($value!=$pass){
					echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Passwords do not Match</div> ');
					
					exit();
				}
	
				exit();
		
		
		}
		
		//username
		if($name=="Username"){
		if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,26}$%",$value)){
		
			
			$result=mysql_query("SELECT * FROM `users`") or die("Db error");
			if($result){
					$users;
					while($row = mysql_fetch_assoc($result)){
							if($value==$row['name']){
						echo "User Name already exists.";
					}
							
					
							
					}
				// noe $search_slide_Results contains whole slide db table
				}
				else{
					// no users
				}
				
		
		}	
		else{
		
			echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Invalid ').$name.('</div> ');
			exit();
		}
	}							
								
		//email
		if($name=="Email"){
			if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-z]{2,16}$%",$value)){
			
			$result=mysql_query("SELECT * FROM `users`") or die("Db error");
			if($result){
					$users;
					while($row = mysql_fetch_assoc($result)){
							if($value==$row['email']){
						echo "Email already registered";
					}
							
					
							
					}
				// noe $search_slide_Results contains whole slide db table
				}
				else{
					// no users
				}
		
		}	
		else{
		
			echo ('<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:red;">Invalid ').$name.('</div> ');
		}
		
		exit();
		}						
								
}							
								
				
?>