<?php
								if(isset($_GET['path'],$_GET['page'],$_GET['extention'])){
								$extention=trim(strip_tags(stripslashes($_GET['extention'])));
								$page=trim(strip_tags(stripslashes($_GET['page'])));
								$source=trim(strip_tags(stripslashes($_GET['path'])));
								
								
								if($extention=="jpg"){
								header('content-type: image/jpeg');
								
								$watermark=imagecreatefrompng('../../images/watermark.png');
								$watermark_width=imagesx($watermark);
								$watermark_height=imagesy($watermark);
								$image=imagecreatetruecolor($watermark_width,$watermark_height);
								$image=imagecreatefromjpeg($source);	
								
								$image_size=getimagesize($source);
								$x=$image_size[0] - $watermark_width - 10;
								$y=$image_size[1] - $watermark_height - 10;
								imagecopymerge($image, $watermark, $x, $y,0,0, $watermark_width, $watermark_height,50);
								imagejpeg($image,$source);	
								
								
								if($page=="gallery"){
									header('location:../../gallery_upload.php?message=sucess');
									}
									
								if($page=="product_upload"){
									header('location:../../products_upload.php?message=sucess');
									}
									
								
									if($page=="slide_show"){
									header('location:../../slideshow_update.php?message=sucess');
									}
							
						}
									
							
						
							elseif($extention=="png"){
										header('content-type: image/png');
										$watermark=imagecreatefrompng('../../images/watermark.png');
										$watermark_width=imagesx($watermark);
										$watermark_height=imagesy($watermark);
										$image=imagecreatetruecolor($watermark_width,$watermark_height);
										
										$image=imagecreatefrompng($source);
										$image_size=getimagesize($source);
										$x=$image_size[0] - $watermark_width;
										$y=$image_size[1] - $watermark_height;
										imagecopymerge($image, $watermark, $x, $y,0,0, $watermark_width, $watermark_height,50);
										imagepng($image,$source);
										if($page=="gallery"){
											header('location:../../gallery_upload.php?message=sucess');
											}
											
										if($page=="product"){
											header('location:../../product_upload.php?message=sucess');
											}
											
										
											if($page=="slide_show_update"){
											header('location:../../slideshow_update.php?message=sucess');
											}
									}
					}
						
				else{
						header('location:../../error.php');
					}
												
?>