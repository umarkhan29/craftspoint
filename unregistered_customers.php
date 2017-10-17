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
		Unregistered Customers
	</div>   
	
		<?php
		$count=0;
		if($result=mysql_query("SELECT * FROM `unregistered_customers`")){
			while($row=mysql_fetch_assoc($result)){
				$searchResults[] = array(
							'NAME'			=>	$row['name'],
							'EMAIL'			=>	$row['email'],
							'PHONE' 		=> 	$row['phone'],
							'PRODUCT'		=>	$row['product_name'],
							'PRICE'			=>	$row['price'],
							'SOLD_ON' 		=>	$row['sold_on'],
							'SHIPPING'		=>	$row['shipping_address']
						);
						$count=$count+1;
			}
			}
	?> 
	<?php
	if($count>0){
	
	$_SESSION['admin_results']= $searchResults;
	
	$pages = $count/5;
	$pages=ceil($pages);
	$_SESSION['admin_total_pages']=$pages;
	$_SESSION['admin_start_product_of_page']=0;
	$last_product=$_SESSION['admin_start_product_of_page']+5;
	$_SESSION['admin_total_products']=$count;
	if($_SESSION['admin_total_products']<$last_product){
				$last_product=$_SESSION['admin_total_products'];
			}
	?>
	
	<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						
						<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer;" onClick="admin_pages('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						
						
					
    			<?php 
				}
				?>	
    			
    				</ul></p>
    </div>
	<table style="width:100%;">
	<tr >
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">S.No</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Email</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Phone</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Product Name</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Price</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Sold On</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Address</span></td>
	</tr>
		<?php
		
	for($i=$_SESSION['admin_start_product_of_page'];$i<$last_product;$i++){
	?>
	<tr >
		<td class="unreg_customer_details_table"><?php echo  $i+1;?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['EMAIL'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PHONE'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PRODUCT']; ?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PRICE']; ?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['SOLD_ON'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['SHIPPING'];?></td>
		
		
	</tr>
	
	<?php
		}
		
		}
	
	?>
</table>






</div>

</div>
<div style="height:7px; width:100%;" > </div>
<script type="text/javascript">
function admin_pages(thediv,number){


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
	xmlhttp.open('GET','home/catalog/admin_pages.php?page_no='+number,true);
	
	document.getElementById('page_content').style.visibility="hidden";
	xmlhttp.send();
	
}

</script>



<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>