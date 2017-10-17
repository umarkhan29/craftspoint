
<?php
	require_once('../../config.khan');
	ob_start();
	require_once('../components/session.khan');
	require_once('../components/connect.khan');
	
	
?>



<?php

	$count=0;
	
	if(isset($_GET['searchtxtbox'])){
		
		$keywords = mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['searchtxtbox']))));
	
		if($keywords){
			
			$searching = new Search($keywords);
			$result = $searching->result; 
			$resultCount = $searching->resultCount;
			
			if($result){
				$searchResults;
				while($row = mysql_fetch_assoc($result)){
					$searchResults[] = array(
							'NAME'			=>	$row['name'],
							'ID'			=>	$row['id'],
							'CATAGORY'		=>	$row['catagory'],
							'SIZE' 			=> 	$row['size'],
							'PATH'			=>	$row['path'],
							'PRICE' 		=> 	$row['price'],
							'DESC'			=>	$row['discription'],
							'DISCOUNT'		=>	$row['discount'],
							
						);
						$count=$count+1;
						
				}
				
			}
			else{
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:#602D8D; background-color:#414045; width:60%; height:100px; margin:auto; 								margin-top:40px; margin-bottom:40px; padding-left:225px; padding-top:30px; border-radius:7px;">No results found ! </div> ');
				
			}
		}
		else{
				echo ('<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; font-size:40px; color:#602D8D; background-color:#414045; width:60%; height:100px; margin:auto; 	margin-top:40px; margin-bottom:40px; padding-left:120px; padding-top:30px; border-radius:7px;">Enter atleast one keyword to search anything !</div>');
				
		}

	}
		

	class Search{
		private $search_keywords = "";
		public $result;
		public $resultCount;
		function __construct($keywords){
			$this->resultCount = 0;
			$this->search_keywords = $this->splitKeywords($keywords);
			
			$this->result = $this->searchNow();
		}
		private function searchNow(){
			if(count($this->search_keywords) == 0){
				return FALSE;
			}
		
			$query = $this->getQuery();
			if($result = mysql_query($query)){
				
				if(mysql_num_rows($result)!=0){
					$this->resultCount = mysql_num_rows($result);
					return $result;
				}
				return FALSE;
			}
			return FALSE;


		}
		private function splitKeywords($keywords){
			$words = preg_split('/\s+/', $keywords);
			return $words;
		}
		private function getQuery(){
			$count = count($this->search_keywords);
			$words = $this->search_keywords;
			$query = "SELECT * FROM `products` WHERE ";
			$where = "";
			for($i = 0; $i < $count; $i++){
				$where .= "`name` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
				}
			}
			
			$where .= ' OR ';
			for($i = 0; $i < $count; $i++){
				$where .= "`catagory` like '%$words[$i]%'";
				if($i != $count-1){
					$where .= ' OR ';
					}
					}
			
			$query .= $where;
			
			return $query;
		}
	}
?>


<?php
	if($count>0){
	
	$_SESSION['Total_results']= $searchResults;
	
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

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Search Results</h3>
    		</div>
    		
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						
						<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer;" onClick="searchp('search_div',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						
						
					
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
					 <a href="preview.php?product_id=<?php echo $searchResults[$i]['ID']?>"><img src="<?php echo $searchResults[$i]['PATH'];?>" height="180" alt="" /></a>
					 <h2><?php echo $searchResults[$i]['NAME'];?></h2>
					 <p><?php echo $searchResults[$i]['CATAGORY'];?></p>
					 <p>Rs <span class="strike"><?php echo $searchResults[$i]['PRICE']?></span><span class="price"><?php echo $searchResults[$i]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $searchResults[$i]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $searchResults[$i]['ID'];?>" class="details">Details</a></span></div>
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


<?php
ob_end_flush();
?>






