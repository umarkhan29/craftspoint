<?php
	
	if(isset($_GET['path'],$_GET['page'],$_GET['extention'])){
		$extenstion=trim(strip_tags(stripslashes($_GET['extention'])));	
		$image="../../";
		$image.=trim(strip_tags(stripslashes($_GET['path'])));
		$page=trim(strip_tags(stripslashes($_GET['page'])));
		if($extenstion == "png"){
				header('content-type: image/png');								
		}elseif($extenstion == "jpg"){
			header('content-type: image/jpeg');								
		}
	
		$image_size=getimagesize($image);
		
		$image_width=$image_size[0];
		$image_height=$image_size[1];
		$new_width=0;
		$new_height=0;
		if($page=="gallery"){
			$new_width=750;
			$new_height=450;
		}
		
		if($page=="product_upload"){
			$new_width=1000;
			$new_height=750;
		}
		
		if($page=="slide_show"){
			$new_width=1000;
			$new_height=450;
		}
		
		$new_image=imagecreatetruecolor($new_width,$new_height);
		if($extenstion == "png"){
				$old_image=imagecreatefrompng($image);											
		}elseif($extenstion == "jpg"){
						$old_image=imagecreatefromjpeg($image);					
		}

		
		
		imagecopyresized($new_image,$old_image,0,0,0,0,$new_width,$new_height,$image_width,$image_height);
		if($extenstion == "png"){
				imagepng($new_image,$image);										
		}elseif($extenstion == "jpg"){
					imagejpeg($new_image,$image);							
		}
		
		header('location:watermark.php?page='.$page.'&path='.$image.'&extention='.$extenstion);
		
	}
	else{
			header('location:../../error.php');
		}

?>