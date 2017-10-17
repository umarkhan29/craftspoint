<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
	
		$products=mysql_query("SELECT * FROM `videos` ") or die(header('location:error.php?token=dbt'));
		
		if($products){
				$count=0;
				while($row = mysql_fetch_assoc($products)){
						$items[] = array(
							'PATH'		=>	$row['path'],
							'NAME'		=>	$row['name'],
							'ID'		=>	$row['id'],
							'DESC'		=>	$row['discription']
							
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
	
	$pages = $count/12;
	$pages=ceil($pages);
	$_SESSION['total_pages']=$pages;
	$_SESSION['start_product_of_page']=0;
	$last_product=$_SESSION['start_product_of_page']+12;
	$_SESSION['total_products']=$count;
	if($_SESSION['total_products']<$last_product){
				$last_product=$_SESSION['total_products'];
			}
	
?>

<script type="text/javascript">
function video(thediv,number){


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
	xmlhttp.open('GET','home/catalog/video_pages.php?page_no='+number,true);
	
	document.getElementById('page_content').style.visibility="hidden";
	xmlhttp.send();
	
}

</script>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Videos</h3>
    		</div>
    		
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					<form action="" method="GET">
						
						<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer; " onClick="video('search_div',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						<input type="hidden" id="page_no" value="<?php echo $i; ?>"/>
						
					</form>
    			<?php 
				}
				?>	
    			
    				</ul></p>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

		  	<?php
				
				for($i=$_SESSION['start_product_of_page'];$i<$last_product;$i++){
					
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="video_preview.php?video_id=<?php echo $items[$i]['ID'];?>">
					 <video width="150" height="180" controls>
					  <source src="<?php echo $items[$i]['PATH'];?>" type="video/mp4">
					  
					</video>
					 
					</a>
					 <h2><?php echo $items[$i]['NAME'];?></h2>
					 
					 
				</div>
			
			<?php
				} //close for
				
				} //close if
			?>
			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>
</div>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>







