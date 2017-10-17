<?php
ob_start();
?>

<div id="gallery_popup" style="position:fixed;border:solid 1px black;width:50%; margin-left:25%; margin-top:30px; height:85%;background-color:#CCCCCC;z-index:100; visibility:hidden;">
	<div style="border:width:100%; min-height:42px; background:#CC0000">
		<div style="float:left;color:white; ;padding:7px; font-size:24;">Kashmir Arts-Gallery
		</div>
		<div style="float:right;color:white; background:#990000;  height:27px; cursor:pointer; border-left:1px solid black; border-bottom:1px solid black; padding:7px; font-size:22px;" onclick="hide_popup();">X</div>
	</div>
	
	<div>
		<div style=" width:100%; overflow:hidden;"><img src="" id="popup_img" style="margin:auto;" /></div>
		<div style="color:#602D8D; background:#FFFFFF; font-size:22px; padding-left:15px; padding-bottom:7px;">Description</div>
		<div id="popup_desc" style="color:#747474; background:#FFFFFF; height:11%;">
			
		</div>
	</div>
 </div>
 
 <div id="main_page">
 <?php
 	
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
	
		$products=mysql_query("SELECT * FROM `gallery` ") or die(header('location:error.php?token=dbt'));
		
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
function gallery(thediv,number){


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
	xmlhttp.open('GET','home/catalog/gallery_results.php?page_no='+number,true);
	
	document.getElementById('page_content').style.visibility="hidden";
	xmlhttp.send();
	
}


function popup(desc,path){
	document.getElementById('gallery_popup').style.visibility="visible";
	document.getElementById('popup_img').src=path;
	document.getElementById('popup_desc').innerHTML=desc;
	document.getElementById('main_page').style.opacity="0.2";
	document.getElementById('main_page').style.pointerEvents = "none";
	
	
	
}

function hide_popup(){
	document.getElementById('gallery_popup').style.visibility="hidden";
	document.getElementById('main_page').style.visibility="visible";
	document.getElementById('main_page').style.opacity="1";
	document.getElementById('main_page').style.pointerEvents = "auto";
	
	
}
</script>
 

 <div class="main">

    <div class="content" >
    	<div class="content_top">
    		<div class="heading">
    		<h3>Gallery</h3>
    		</div>
    		
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
				
				<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer;" onClick="gallery('search_div',<?php echo $i; ?>);" ><?php echo $i; ?>
					
					</li>
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
				<div class="grid_1_of_4 images_1_of_4" style="cursor:pointer;" onClick="popup('<?php echo $items[$i]['DESC'];?>','<?php echo $items[$i]['PATH'];?>');">
					 <img src="<?php echo $items[$i]['PATH'];?>" height="180" alt="" />
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



<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>

</div>





