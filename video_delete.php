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
    Welcome  <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>
<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);


?>

<div id="admin_login_section">
			<?php
			$products=mysql_query("SELECT * FROM `videos`") or die(header('location:error.php?token=dbt'));
				
				if($products){
						$count=0;
						while($row = mysql_fetch_assoc($products)){
								$items[] = array(
									'PATH'		=>	$row['path'],
									'ID'		=>	$row['id'],
									'DESC'		=>	$row['discription'],
									'NAME'		=>	$row['name'],
									
								);
							$count=	$count+1;
						}
					
					}
					else{
						echo "No Produsts avaliable";
					}
					
				?>
		
		<?php
			if($count>0){
			
			$_SESSION['Total_results']= $items;
			
			$pages = $count/6;
			$pages=ceil($pages);
			$_SESSION['total_pages']=$pages;
			$_SESSION['start_product_of_page']=0;
			$last_product=$_SESSION['start_product_of_page']+6;
			$_SESSION['total_products']=$count;
			if($_SESSION['total_products']<$last_product){
						$last_product=$_SESSION['total_products'];
					}
			
		?>
  		
			<div class="main">
				<div class="content">
					<div class="content_top">
						<div class="heading">
						<h3>Delete Videos</h3>
						</div>
						
						
	
	
						<div class="page-no">
							<p>Result Pages:<ul>
							<?php
							
							for($i=1;$i<=$pages;$i++){
							?>
								
									<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer;" onClick="videodelt('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
							<?php 
							}
							?>	
							
								</ul></p>
						</div>
						<?php
							if(isset($_GET['deletemsg'])){
								echo $_GET['deletemsg'];
							}
						?>
						<div class="clear"></div>
					</div>
					
					  <div class="section group">
					  
			
						<?php
							
							for($i=$_SESSION['start_product_of_page'];$i<$last_product;$i++){
								
						?>
							<div class="grid_1_of_4 images_1_of_4">
								<img src="<?php echo $items[$i]['PATH'];?>" height="180" alt="" />
								 <h2><?php echo $items[$i]['NAME'];?></h2>
								
								 <div class="button"> <span><a href="deletevideo.php?product_id=<?php echo $items[$i]['ID'];?>&product_path=<?php echo $items[$i]['PATH'];?>" class="details">Delete</a></span></div>
								
							</div>
						
						<?php
							} //close for
							
							} //close if
						?>
						
						
						
						
						
						<div class="clear"></div>
					</div>
						
				</div>
			 </div>
			</div></div>


  
  
</div>

</div>
<div style="height:7px; width:100%;" > </div>

<script type="text/javascript">
function videodelt(thediv,number){


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
	xmlhttp.open('GET','home/catalog/deletevideopages.php?page_no='+number,true);
	
	document.getElementById('page_content').style.visibility="hidden";
	xmlhttp.send();
	
}

</script>

<?php

require_once(COMMON.FOOTER);
ob_end_flush();
?>

