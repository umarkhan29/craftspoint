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
		Upload New Product!
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
							if(preg_match("%^[a-z A-Z 0-9_ .,!@&$]{4,26}$%",$_POST['filename'])){
			
								}	
							else{
								$count=1;
								echo "Enter a valid Name";
							}
						}
						else{
							echo "Enter Item Name";
							$count=1;
						}
					
					} 
				
				?>
		</td>
		</tr>
		
		
		<tr>
			<td > <input type="text" name="filesize" class="inputtext" placeholder="Image Size (width*height)" /></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if(!$_POST['filesize']==""){
							if(preg_match("%^[0-9 .]{1,5}[*]{1}[0-9 .]{1,5}$%",$_POST['filesize'])){
			
								}	
							else{
								$count=1;
								echo "Enter valid Size";
							}
						}
						else{
							echo "Enter Size of Item";
							$count=1;
						}
					
					} 
				
				?>
		</td>
		</tr>
		
		
		<tr>
		<td > 
			<select class="inputtext" name="imgtype">
				<option>--Choose Image Type--</option>
				<option>Chain Stitch</option>
				<option>Curtains</option>
				<option>Pashmina</option>
				<option>Carpets</option>
				<option>Cushions</option>
				<option>Paper Machie</option>
			</select>
		</td>
		<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
					if($_POST['imgtype']=="--Choose Image Type--"){
					echo "Select type of image to be uploded";
					$count=1;
					}
					} 
				
				?>
		</td>
		</tr>
		
		<tr>
			<td > <input type="text" name="original_cost" class="inputtext" placeholder="Original Item Cost (In Rupees)" /></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if(!$_POST['original_cost']==""){
							if(preg_match("%^[0-9]{2,9}$%",$_POST['original_cost'])){
			
								}	
							else{
								$count=1;
								echo "Enter Valid Cost Value";
							}
						}
						else{
								echo "Enter Cost of Item";
								$count=1;
						}
					
					} 
				
				?>
		</td>
		</tr>
		<tr>
			<td > <input type="text" name="final_cost" class="inputtext" placeholder="Final Item Cost (In Rupees)" /></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if(!$_POST['final_cost']==""){
							if(preg_match("%^[0-9]{2,9}$%",$_POST['final_cost'])){
			
								}	
							else{
								$count=1;
								echo "Enter Valid Cost Value";
							}
						}
						else{
								echo "Enter Cost of Item";
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
					if(isset($_FILES['fileupld'])){
					if($_FILES['fileupld']['name']==""){
					echo "Select image to be uploded";
					$count=1;
					}
					else{
						$filenamecopmopents=explode('.',$_FILES['fileupld']['name']);
						$FileExtension=count($filenamecopmopents);
						$extenstion=strtolower($filenamecopmopents[($FileExtension-1)]);
						if($extenstion == "jpg"||$extenstion =="jpeg"||$extenstion =="png"){
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
							echo "Size of image is too large";
						}
						
						
					} 
				
				?>
		</td>
		</tr>
		
		<tr>
			<td > 
				<select class="inputtext" name="filematerial">
				<option>--Material--</option>
				<option>Cotton</option>
				<option>Wool</option>
				<option>Silk</option>
				<option>Wood</option>
				<option>Valvet</option>
				<option>Pashmina</option>
				<option>Shahtoos</option>
				<option>Wool,Silk</option>
				<option>Cotton,Wool</option>
				<option>Paper</option>
				<option>Cotton,Silk</option>
				<option>Cotton,Wool,Silk</option>
				
			</select>
				</td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if($_POST['filematerial']!="--Material--"){
							if(preg_match("%^[a-z A-Z 0-9 /\().,!@*]{2,350}$%",$_POST['filematerial'])){
			
								}	
							else{
								$count=1;
								echo "Watch out for your text";
							}
						}
						else{
								echo "Mention Material of Item";
								$count=1;
						}
						
					} 
				
				?>
		</td>
		</tr>
		
		
		<tr>
			<td > <input type="text" name="filequantity" class="inputtext" placeholder="Quantity" /></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if(!$_POST['filematerial']==""){
							if(preg_match("%^[0-9]{1,999}$%",$_POST['filequantity'])){
			
								}	
							else{
								$count=1;
								echo "Enter valid Quantity";
							}
						}
						else{
								echo "Enter Quantity of Item";
								$count=1;
						}
						
					} 
				
				?>
		</td>
		</tr>
		
		
		<tr>
			<td > <select class="inputtext" name="filedesign">
				<option>--Design (Optional)--</option>
				<option>Printed</option>
				<option>Flooring</option>
				<option>Kalim</option>
				<option>Striped</option>
				<option>Stapel</option>
				<option>Embroidered</option>
			</select></td>
			<td class="val_error"> 
				<?php 
					if(isset($_FILES['fileupld'])){
						if($_POST['filedesign']=="--Design (Optional)--"){
							$_POST['filedesign']="";
						}
							if(preg_match("%^[a-z A-Z 0-9 /\().,!@*]{0,250}$%",$_POST['filedesign'])){
			
								}	
							else{
								$count=1;
								echo "Watch out for your text";
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
							if(preg_match("%^[a-z A-Z 0-9 . , ( ) ]{2,350}$%",$_POST['filedescription'])){
			
								}	
							else{
								$count=1;
								echo "Watch out for your text";
							}
						}
						else{
								echo "Enter Description of Item";
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
						if(file_exists("images/Products/".$_POST['imgtype']."/".basename($_FILES['fileupld']['name']))){
						$count=1;
						
						echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:red">File aleady exists !</div>';
						}
				
				if($count==0){
							$file_path="images/Products/".$_POST['imgtype']."/".basename($_FILES['fileupld']['name']);
				
						if(move_uploaded_file($_FILES['fileupld']['tmp_name'],$file_path)){
						
							$file_name=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filename']))));
							$file_type=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['imgtype']))));
							$file_size=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filesize']))));
							$original_file_cost=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['original_cost']))));
							$final_file_cost=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['final_cost']))));
							$file_desc=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filedescription']))));
							$file_material=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filematerial']))));
							$file_quantity=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filequantity']))));
							
							$file_design=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['filedesign']))));
							$user=$_SESSION['current_user'];
							if(mysql_query("INSERT INTO `products`(`name`, `catagory`, `price`, `discount` ,`path`, `discription`,`size`,`material`,`quantity`,`design`,`added_by`) VALUES     ('$file_name','$file_type','$original_file_cost','$final_file_cost','$file_path','$file_desc','$file_size','$file_material','$file_quantity','$file_design','$user')")){
							header('location:home/catalog/resize.php?page=product_upload&path='.$file_path.'&extention='.$extenstion);
							}
							else{
								die('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; color:red"> Could Not Upload!</div>');
							}
						}
				
						else{
							echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; color:red"> Something went wrong !</div>';
							
						}
				
				
			
				}
		
		
		}
	if($_SERVER['REQUEST_METHOD']=="GET"){
		if(isset($_GET['message'])){
		if($_GET['message']="sucess"){
			echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px;"> Product Uploaded Sucessfully !</div>';
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