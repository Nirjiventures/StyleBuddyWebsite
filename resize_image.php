<?php
set_time_limit(10000);
ini_set('memory_limit', '-1');
error_reporting(E_ALL ^ E_NOTICE);
include 'resize.image.class.php';
$resize_image = new Resize_Image;
 
// Folder where the (original) images are located with trailing slash at the end
$images_dir = '';
 
// Image to resize

 if($_GET['image']=="")
{
	$_GET['image']="noc.jpg";
}
$image = $_GET['image'];
/* Some validation */
if(!@file_exists($images_dir.$image)){
	exit('The requested image does not exist.');
}
 
// Get the new with & height
$new_width = (int)$_GET['new_width'];
$new_height = (int)$_GET['new_height'];
 
$resize_image->new_width = $new_width;
$resize_image->new_height = $new_height;
 
$resize_image->image_to_resize = $images_dir.$image; // Full Path to the file
 
$resize_image->ratio = true; // Keep aspect ratio
 
$process = $resize_image->resize(); // Output image
?>