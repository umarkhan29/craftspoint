
<?php
require_once('../../config.khan');
ob_start();
require_once('../components/session.khan');
if(isset($_GET['page_no'])){
	
		$_SESSION['user_start_product_of_page']=$_GET['page_no']-1;
		$_SESSION['user_start_product_of_page']=$_SESSION['user_start_product_of_page']*11;
		$last_product=$_SESSION['user_start_product_of_page']+11;
		 $searchResults=$_SESSION['user_results'];
		 $pages=$_SESSION['user_total_pages'];
		 
		 
		if($_SESSION['user_total_products']<$last_product){
				$last_product=$_SESSION['user_total_products'];
			}
	}


?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>CUSTOMERS</h3>
    		</div>
    	
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				
				<div style="height:20px;">
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						<li <?php if($i==$_GET['page_no']){echo 'class="active"';}?> style="cursor:pointer;" onClick="user_pages('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
					
    			<?php 
				}
				?>	
    			</div>
    				</ul></p>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

		  	<div style="width:100%; min-height:300px; background:#999999;"> 

<table style="width:100%;">
	<tr >
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">S.No</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Name</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Email</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Phone</span></td>
	</tr>
	<?php
		
	for($i=$_SESSION['user_start_product_of_page'];$i<$last_product;$i++){
	?>
	<tr >
		<td class="user_table"><?php echo $i+1; ?></td>
		<td class="user_table"><a href="user_details.php?email=<?php echo $searchResults[$i]['EMAIL']; ?>"><?php echo $searchResults[$i]['NAME']; ?></a></td>
		<td class="user_table"><?php echo $searchResults[$i]['NAME']; ?></td>
		<td class="user_table"><?php echo $searchResults[$i]['PHONE']; ?></td>
		
		
	</tr>
	<?php
	}
	
	?>

</table>

			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>

<?php
ob_end_flush();
?>