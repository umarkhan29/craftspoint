<?php
	ob_start();
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

<div id="admin_welcome_div" >
    Welcome <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>
<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);
?>

<div id="admin_login_section">
	<div class="admin_section_title">
		Slide Show Update 
	</div>

      <div>
		<?php
		
		$total_images=0;
		$slide_result=mysql_query("SELECT * FROM `slideshow`") or die(header('location:error.php?token=dbt'));
		if($slide_result){
				$search_slide_Results;
				while($slide_row = mysql_fetch_assoc($slide_result)){
						$search_slide_Results[] = array(
							'SLIDER_NAME'		=>	$slide_row['name'],
							'SLIDER_PATH'		=>	$slide_row['path'],
							'SLIDER_ID'		=>	$slide_row['id']
							
						);
						
						$total_images=$total_images+1;
						
				}
			// noe $search_slide_Results contains whole slide db table
			}
			else{
				// slide show error
			}
			$count=0;
		?>
	
	</div>



	<form action="" method="post" enctype="multipart/form-data">
		<div class="admin_main_section">
				<table cellspacing="5px">
					<tr>
						<td > 
							<select class="inputtext" name="existingimage">
								<option>--Choose an Image to be replaced --</option>
								<?php
								for($i=0;$i<$total_images;$i++){
								
								
								?>
									<option><?php echo $search_slide_Results[$i]['SLIDER_NAME'];?> </option>
									
								<?php
								
								}
								
								?>
							</select>
						</td>
						<td class="val_error"> 
							<?php 
								if(isset($_FILES['slide_upld'])){
									if($_POST['existingimage']=="--Choose an Image to be replaced --"){
										echo "Select image to be replaced";
										$count=1;
										
									}
									
								} 
								
							?>
						</td>
					</tr>
					
					<tr>
						<td > <input type="text" name="newfilename" class="inputtext" placeholder=" New Image Name" /></td>
						<td class="val_error"> 
							<?php 
								if(isset($_FILES['slide_upld'])){
									if($_POST['newfilename']==""){
										echo "Give a name to the new image uploaded";
										$count=1;
									}
								
								} 
							
							?>
						</td>
					</tr>
					<tr>
						<td > <input type="file"  class="inputtext"  name="slide_upld"  /></td>
						<td class="val_error"> 
							<?php 
								if(isset($_FILES['slide_upld'])){
									if($_FILES['slide_upld']['name']==""){
									echo "Select image to be uploded";
									$count=1;
								}
								else{
										$filenamecopmopents=explode('.',$_FILES['slide_upld']['name']);
										$FileExtension=count($filenamecopmopents);
										$extenstion=strtolower($filenamecopmopents[($FileExtension-1)]);
										if($extenstion == "jpg"){
											$_FILES['slide_upld']['name']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['newfilename']))));
											$_FILES['slide_upld']['name'].= ".".$extenstion;
										}
										else{
											$count=1;
											echo "Select .jpg format only";
										}
								}
								
								if($_FILES['slide_upld']['size']>104857600) //100mb size 
								{
									$count=1;
									echo "Size of image is too large";
								}
								
								
							} 
						
						?>
						</td>
					</tr>
					
					<tr>
						<td > <input type = "submit" class="submitbtn" value="Replace"/></td>
					</tr>
					
				</table>
			
			
			<div style="color:#0fa1e0; padding:10px;">
			
					<?php
						
					if(isset($_FILES['slide_upld']) and $count==0){
								if(file_exists("images/slide_show/".$_FILES['slide_upld']['name'])){
								$count=1;
								echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red">File aleady exists !</div>';
								}
						
						if($count==0){
							$file_path="images/slide_show/".$_FILES['slide_upld']['name'];
								if(move_uploaded_file($_FILES['slide_upld']['tmp_name'],$file_path)){
								
									$new_file_name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['newfilename']))));
									if(mysql_query("INSERT INTO `slideshow`(`name`,`path`) VALUES ('$new_file_name','$file_path')")){
									
										
										$delt_file="images/slide_show/".$_POST['existingimage'].".jpg";
										if(unlink($delt_file)){
											$name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['existingimage']))));
											if(mysql_query("DELETE FROM `slideshow` WHERE `name` = '$name' ")){
												header('location:home/catalog/resize.php?page=slide_show&path='.$file_path.'&extention='.$extenstion);
											}
											
										}
										else{
										
												unlink($file_path);
												mysql_query("DELETE FROM `slideshow` WHERE `name`= '$new_file_name' ");
												echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red">Invalid Image Selected</div>';
											}
									}
									else{
										die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red"> Could Not connect to DataBase!</div>');
									}
								}
						
								else{
									die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red"> Something went wrong !</div>');
								}
						
						
					
						}
				
				
				}
			if(isset($_GET['message'])){
				if($_GET['message']="sucess"){
					echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px;"> Image Uploaded Sucessfully !</div>';
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

