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
	ob_start();	
	require_once(COMMON.HEADER);
	
?>

<link rel="stylesheet" href="css/admin_style.css" />


<div id="admin_welcome_div" >
    Welcome <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>
<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);
?>

<div id="admin_login_section">

    <div class="admin_section_title">
		Upload Your Gallery!
	</div>    
	
	
	<form action="" method="post" enctype="multipart/form-data">
<div class="admin_main_section">
	<table cellspacing="5px">
		<tr>
			<td > <input type="text" name="filename" class="inputtext" placeholder="Image Name" /></td>
			<td class="val_error"> 
				<?php 
					$count=0;
					if(isset($_FILES['fileupld'])){
						if(!$_POST['filename']==""){
							if(preg_match("%^[a-z A-Z 0-9 _ .,!@&$]{4,26}$%",$_POST['filename'])){
			
								}	
							else{
								$count=1;
								echo "Enter a valid Name";
							}
						}
						else{
							echo "Enter Image Name";
							$count=1;
						}
					
					} 
				
				?>
		</td>
		</tr>
		
		
		
		
	
		
	
		<tr>
		<td > <input type="file"  class="inputtext"  name="fileupld"  /></td>
		<td class="val_error"> 
				<?php 
				$extenstion="";
					if(isset($_FILES['fileupld'])){
						if($_FILES['fileupld']['name']==""){
							echo "Select an Image to be uploded";
							$count=1;
						}
						else{
							$filenamecopmopents=explode('.',$_FILES['fileupld']['name']);
							$FileExtension=count($filenamecopmopents);
							$extenstion=strtolower($filenamecopmopents[($FileExtension-1)]);
							
							if($extenstion == "jpg"|| $extenstion =="jpeg"||$extenstion =="png"||$extenstion =="gif"||$extenstion =="bmp"||$extenstion =="webp"||$extenstion =="3gp"){
								$_FILES['fileupld']['name']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filename']))));
								$_FILES['fileupld']['name'].=".".$extenstion;
							}
							else{
	
								$count=1;
								echo "Select an Valid Image Type";
							}
						}
						
						if($_FILES['fileupld']['size']>104857600){
							$count=1;
							echo "Size of Image is too large";
						}
						
						
					} 
				
				?>
		</td>
		</tr>
		<tr>
			<td > <input type="text" name="filedescription" class="inputtext" placeholder="Enter Description(Max 185 Characters)" /></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if(!$_POST['filedescription']==""){
							if(preg_match("%^[a-z A-Z 0-9 /\(){}?:.,!@*]{2,350}$%",$_POST['filedescription'])){
			
								}	
							else{
								$count=1;
								echo "Watch out for your text";
							}
						}
						else{
								echo "Enter Description of Image";
								$count=1;
						}
						if(mb_strlen($_POST['filedescription'])>185){  //for max chars
							echo "Maximum Charecters are 185";
							$count=1;
						}
					} 
				
				?>
		</td>
		</tr>
		<tr>
		<td > <input type = "submit" class="submitbtn" value="Upload"/></td>
		</tr>
	</table>
	
	<div style="color:#0fa1e0; padding:10px;">
				
				
	<?php
				
			if(isset($_FILES['fileupld'])){
				if($_FILES['fileupld']['name']!=""){
						if(file_exists("images/Gallery/".basename($_FILES['fileupld']['name']))){
						
					$count=1;
						echo '<div style="font-size:18px; color:red">File aleady exists !</div>';
						}
				}
				if($count==0){
					$file_path="images/Gallery/".basename($_FILES['fileupld']['name']);
					
						if(move_uploaded_file($_FILES['fileupld']['tmp_name'],$file_path)){							
						
							$file_name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filename']))));
							$file_desc=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filedescription']))));
							$user=$_SESSION['current_user'];
							if(mysql_query("INSERT INTO `gallery` (`name`, `path`, `added_by`,`discription`) VALUES  ('$file_name','$file_path','$user','$file_desc')")){
							header('location:home/catalog/resize.php?page=gallery&path='.$file_path.'&extention='.$extenstion);
							}
							else{
								
								die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red"> Could Not Upload!</div>');
							}
						}
				
						else{
							echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red"> Something went wrong !</div>';
						}
				
				
			
				}
		
		
		}
	if($_SERVER['REQUEST_METHOD']=="GET"){
		if(isset($_GET['message'])){
			if($_GET['message']="sucess"){
				echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px;"> Image Uploaded Sucessfully !</div>';
			}
		}
	}
	?>
	</div>
</div>
</form>



</div>

</div>
<div style="height:7px; width:100%;" > </div>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>