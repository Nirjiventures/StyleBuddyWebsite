<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class MY_Controller extends CI_Controller {  
	public $perPage;	
	public $privStatus;	
	public $data = array();
	function __construct(){ 
        parent::__construct(); 
		ob_start();
		ob_clean();
		$this->perPage = 12;
				 
		if(!$this->session->userdata('session_user_id_temp')){
			$this->session->set_userdata('session_user_id_temp',session_id());
		}
		
		if (!$this->session->userdata('site_currency')) {
			$this->session->set_userdata('site_currency', 'INR');
		}
		if(!$this->session->userdata('site_lang')){
			$this->session->set_userdata('site_lang', $this->config->item('language'));

			$language = $this->session->userdata('site_lang');
            //echo 'main:'.$language ;die;
            if($this->session->userdata('site_lang') == 'en' || $this->session->userdata('site_lang') == 'english'){
            	
            }else{
                redirect(base_url().'/'.$language);   
            }
		}
		$this->currLanguage = $this->session->userdata('site_lang');
		$this->currCurrency = $this->session->userdata('site_currency');

		$user_id = $this->session->userdata('session_user_id_temp');
		$currentCurrency = $this->currCurrency;
		
		
        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }

        }
        $this->data['parentCategory'] = $rows;

		$this->data['website_setting'] = $website_setting = getWebsiteDetail()->row_array();
	}
	public function recursive($tbl_name,$k,$parent_id) {
        $rs = $this->common_model->get_all_details($tbl_name,array('parent_id'=>$parent_id,'status'=>1))->result_array();
        if($rs){
            foreach($rs as $key=>$value){
                $rs[$key]['child'] = $this->recursive($tbl_name,$k,$value['id']);
            }
        }else{
            $rs = array();
        }
        return $rs;
    }
    public function recursiveParent($tbl_name,$k,$parent_id) {
        $rs = $this->common_model->get_all_details($tbl_name,array('id'=>$parent_id))->result_array();
        if($rs){
            foreach($rs as $key=>$value){
                $rs[$key]['child'] = $this->recursiveParent($tbl_name,$k,$value['parent_id']);
            }
        }else{
            $rs = array();
        }
        return $rs;
    }
	function ip_visitor_country(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        $country  = "Unknown";
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $ip_data_in = curl_exec($ch); // string
        curl_close($ch);

        $ip_data = json_decode($ip_data_in,true);
        $ip_data = str_replace('&quot;', '"', $ip_data);

        if($ip_data && $ip_data['geoplugin_countryName'] != null) {
            $country = $ip_data['geoplugin_countryName'];
        }
        return $ip_data;
        return 'IP: '.$ip.' # Country: '.$country;
    }

	function ajaxDeleteRecord($tbl_name='',$id=''){
		if($tbl_name!='' && $id!='') {
			$this->db->delete($tbl_name, array('id' => $id));
			return true;
		}else{
			return false;
		}			
	}
	public function setErrorMessage($type='',$msg=''){
		($type == 'success') ? $msgVal = 'message-green' : $msgVal = 'message-red';
		$this->session->set_flashdata('sErrMSGType', $msgVal);
		$this->session->set_flashdata('sErrMSG', $msg);
	}
	public function loginPermission(){
		$checklogin = $this->getPermission_();
		if (!$checklogin) {
			if($this->session->userdata('admin_id') && $this->session->userdata('user_id')){
				//redirect('admin/dashboard'); 
			}else if($this->session->userdata('user_id') && $this->session->userdata('user_type') == 5){
				redirect('vendor/dashboard'); 
			}else if($this->session->userdata('user_id')  && $this->session->userdata('user_type') == 6){
				redirect('userdashboard/dashboard'); 
			}else{
				redirect(base_url('admin/auth/logout'));
			}
        }
	}
	
	public function loginPermissionDashboard(){
		$checklogin = $this->getPermission_();
		if (!$checklogin) {
			if($this->session->userdata('admin_id') && $this->session->userdata('user_id')){
			    return true;
			}else if($this->session->userdata('user_id') && $this->session->userdata('user_type') == 5){
				redirect('vendor/dashboard'); 
			}else if($this->session->userdata('user_id')  && $this->session->userdata('user_type') == 6){
				redirect('userdashboard/dashboard'); 
			}else{
				redirect(base_url('admin/auth/logout'));
			}
        }
	}
	public function getPermission_(){
		$cName = $this->router->fetch_class();
		$methodName = $this->router->fetch_method();
		$checkCM = $cName.'/'.$methodName;
		$checklogin = $this->getPermission();
		if(in_array($checkCM,$checklogin)){
			return true;
		}else if($this->session->userdata('admin_id') && $this->session->userdata('user_id')){
		   	return true;	
		}else{
			redirect('vendor/dashboard');
		   	//return false;	
		}
	}
	public function getPermission($path=''){
		$rrr = 	getUserPermission();
		if($rrr){
			$permission = unserialize($rrr['permission']);
			if ($path) {
				if($this->session->userdata('admin_id') == 1 || in_array($path,$permission)){
					return true;
				}else{
					redirect('admin-dashboard');
				}
			}else{
				return $permission;
			}
			
		}else{
			return false;
		}
	}
	public function notPermission($k){
		$rrr = 	getUserPermission();
		if($rrr){
			$permission = unserialize($rrr['permission']);
			if(!in_array($k,$permission)){
				if($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') == 2){
				}else{
					redirect(base_url('userdashboard/dashboard'));
				}
			}
		}else{
			return false;
		}
	}
	public function checkPrivileges($name='',$right=''){
   		$prev = '0';
		$privileges = $this->session->userdata('shopsy_session_admin_privileges');
		extract($privileges);
		$userName =  $this->session->userdata('shopsy_session_admin_name');
		$adminName = $this->config->item('admin_name');
		if ($userName == $adminName){
			$prev = '1';
		}
		if (isset(${$name}) && is_array(${$name}) && in_array($right, ${$name})){
			$prev = '1';
		}
		if ($prev == '1'){
			return TRUE;
		}else {
			return FALSE;
		}
	}
	public function get_rand_str($length='6'){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}
  	public function setPictureProducts($productImage,$position){
		unset($productImage[$position]);
		return $productImage;
	}
	public function imageResizeWithSpace($box_w,$box_h,$userImage,$savepath){
			
			$thumb_file = $savepath.$userImage;
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 255, 255, 255);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $thumb_file, 99);
			
	}
	function getAddEditDetails($excludeArray){
		$inputArrayDetails = array();
		
		foreach($this->input->post() as $key=>$val)
		{
			if(!(in_array($key,$excludeArray)))
			{
				$inputArrayDetails[$key] = trim(addslashes($val));
			}
		}
		return $inputArrayDetails;
	}
	public function thumbimage_resize($source ,$destination ,$width, $height='') {
		
		
 		$files = scandir($destination);
 		foreach($files as $file) {
			if (!is_dir("$destination/$file")){
				unlink($destination.$file);
			}
		}
		$sfiles = scandir($source);
		foreach($sfiles as $file) {
			if (!is_dir("$source/$file")){
				
				if (in_array($file, array(".",".."))) continue;
				
				if (copy($source.$file, $destination.$file)) {
					
				}
			
			}
		}
		
		$newfiles = scandir($destination);
		 
		
		foreach($newfiles as $file) {
			if (!is_dir("$destination/$file")){
				
				if (in_array($file, array(".",".."))) continue;
				//echo $file."<br>";
				if($file != 'Thumbs.db'){
					
					if($height == ''){
						$this->ImageResizeWithCrop($width, '', $file, './'.$destination.'');
					}else{
						$this->ImageResizeWithCropping($width, $height, $file, './'.$destination.'');
					}
				}
			
			}
		}
		
	}
	public function ImageResizeWithCrop($width, $height='', $thumbImage='', $savePath=''){
		$thumb_file = $savePath.$thumbImage;
		$newimgPath = base_url().substr($savePath,2).$thumbImage;
		list($w, $h) = getimagesize($thumb_file);
		$size=getimagesize($thumb_file);
		if ($w>0 && $h>0){
			if ($w >= $width) {
				$height = ($width / $w) * $h;
				$width = $width;
			}else{
				$height = $h;
				$width = $w;
			}
			
			$path = $savePath.'thumb/thumb_'.$thumbImage;
			$imgString = file_get_contents($savePath.$thumbImage);
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($tmp, $image, 0, 0, 0, 0, $width, $height, $w, $h); 

			$mime = strtolower($size["mime"]);
			switch ($mime) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/webp':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/jpg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
				break;
			}
			imagedestroy($image);
			imagedestroy($tmp);
			return $path;
		}
	}
	public function ImageResizeWithCropping($width, $height, $thumbImage, $savePath){
		
		$thumb_file = $savePath.$thumbImage;
	
		$newimgPath = base_url().substr($savePath,2).$thumbImage;
	
		/* Get original image x y*/
		list($w, $h) = getimagesize($thumb_file);
		$size=getimagesize($thumb_file);
		if ($w>0 && $h>0){
			/* calculate new image size with ratio */
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio) / 2;
			$w = ceil($width / $ratio);
			/* new file name */
			$path = $savePath.$thumbImage;
			/* read binary data from image file */
		
			//$imgString = file_get_contents($newimgPath);
			$imgString = file_get_contents($savePath.$thumbImage);
			/* create image from string */
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
		
			/* Save image */
			$mime = strtolower($size["mime"]);
			switch ($mime) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/webp':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/jpg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
					break;
			}
			return $path;
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
		}
	}
	public function image_crop_process_auto($dwidth, $dheight, $x, $y, $srcwidth, $srcheight, $thumbImage, $savePath){
 			
			$thumb_file = $savePath.$thumbImage;
			
			$newimgPath = base_url().substr($savePath,2).$thumbImage;
			$imgString = file_get_contents($savePath.$thumbImage);
			
			$size=getimagesize($thumb_file);
		
			$image = imagecreatefromstring($imgString);
			
			$path = $savePath.$thumbImage;
	
			$tmp = imagecreatetruecolor($dwidth, $dheight);
			
			imagecopyresampled($tmp,$image,0,0,$x,$y,$dwidth,$dheight,$srcwidth,$srcheight);
			switch ($size["mime"]) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/webp':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
					break;
			}
			return $path;
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
			
			if($this->lang->line('prof_photo_change_succ') != '')
				$lg_err_msg = $this->lang->line('prof_photo_change_succ');
			else
				$lg_err_msg = 'Profile photo changed successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			echo $lg_err_msg; die;
			exit;
		 
	}
	public function ImageCompress($source_url, $destination_url='', $quality=50){
		$info = getimagesize($source_url);
		$savePath = $source_url;
		$mime = strtolower($info['mime']);
		if ($mime == 'image/jpeg') $image = imagecreatefromjpeg($savePath);
		elseif ($mime == 'image/webp') $image = imagecreatefromjpeg($savePath);
		elseif ($mime == 'image/jpg') $image = imagecreatefromjpeg($savePath);
		elseif ($mime == 'image/gif') $image = imagecreatefromgif($savePath);
		elseif ($mime == 'image/png') $image = imagecreatefrompng($savePath);
		### Saving Image
		imagejpeg($image, $savePath, $quality);
	}
	public function sendPushNotification($userId='', $message='',$type='',$urlval=array()) {
		$userChkKey=$this->product_model->ExecuteQuery("SELECT gcm_buyer_id,gcm_seller_id,ios_device_id FROM ".USERS." WHERE id=".$userId);
		
		if($userChkKey->num_rows()>0){			
			$msg =array();
			
			$regIds=array();
			$msg ['message']=$message;
			$msg ['type']=$type;
			
			$pmusers=array('follow','message');
			$pmsellers=array('follow','favorite item','favorite shop','order ','contact','review','discussion','message');
			
			$msg ['app_type']='';
			$msg ['url_key1']=(string)$urlval[0];
			$msg ['url_key2']=(string)$urlval[1];
			$msg ['url_key3']=(string)$urlval[2];
			$msg ['url_key4']=(string)$urlval[3];
			$msg ['url_key5']=(string)$urlval[4];
			$msg ['url_key6']=(string)$urlval[5];
			$msg ['url_key7']=(string)$urlval[6];
			
			
			$userPN=NULL;
			$sellerPN=NULL;
			
			/*
			if(in_array($type,$pmusers)){
				if($userChkKey->row()->gcm_buyer_id!=NULL){
					$userPN=1;
					$regIds[]=$userChkKey->row()->gcm_buyer_id;
				}
			}
			if(in_array($type,$pmsellers)){
				if($userChkKey->row()->gcm_seller_id!=NULL){
					$sellerPN=1;
					$regIds[]=$userChkKey->row()->gcm_seller_id;
				}
			}*/
			
			// changes on 11-08-2015 
			if($userChkKey->row()->gcm_buyer_id!=NULL){
			$regIds[]=$userChkKey->row()->gcm_buyer_id;
			$sellerPN=1;
			$userPN=1;
			}
			
			
			
			
			
			if(!empty($regIds)){
				if($userPN==1 && $sellerPN==1){
					$msg ['app_type']='both';
				}else if($userPN==1){
					$msg ['app_type']='user';
				}else if($sellerPN==1){
					$msg ['app_type']='seller';
				}
				
				
				
				$response = $this->sendPushNotificationToGCMOrg($regIds,$msg);
				// print_r($response);die;
			}						
			
			if($userChkKey->row()->ios_device_id !=NULL && strlen($userChkKey->row()->ios_device_id)> 10 && $userChkKey->row()->ios_device_id!='0'){
				$this->push_notification($userChkKey->row()->ios_device_id,$msg);
			}
		}
	}
	public function sendPushNotificationToGCMOrg($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
		/* echo "<pre>registatoin_ids----";print_r($registatoin_ids);
		echo "<pre>message----";print_r($message);die; */
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
					'registration_ids' => $registatoin_ids,
					'data' => $message,
					);
		// Google Cloud Messaging GCM API Key
		#define("GOOGLE_API_KEY", "AIzaSyD0VJs5nLcm0j34eHCIpP7I8iNI-yRycqo"); 		
		#define("GOOGLE_API_KEY", "AIzaSyDKdzKRknMspcpGgzTVicpF18yrwbpFU2o"); 	
		//define("GOOGLE_API_KEY", "AIzaSyBoZKWZ4WF1OdKw-JSdTs1ZhEfK56aPMr0"); 	
		define("GOOGLE_API_KEY", "AIzaSyBWXSQkYhpTbAMmnJXTq0rjMUr85iFLF8c"); 	
		
		$headers = array(
					'Authorization: key=' . GOOGLE_API_KEY,
					'Content-Type: application/json'
					);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);				
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		//echo "<pre>result----";print_r($result);die;
		curl_close($ch);
		return $result;
	}
	public function getImageShape($width, $height, $target_file){
		list($w, $h) = getimagesize($target_file);
		if($w==$width && $h==$height){
			$option="exact";
		}else if($w==$h){
			$option="exact";
		}else if($w>$h){
			$option="landscape";
		}else if($w<$h){
			$option="portrait";
		}else{
			$option="crop";
		}
		return $option;
	}
	public function push_notification($deviceId,$message){
	   	$this->load->library('apns');
	   	$this->apns->send_push_message($deviceId,$message);
	}
	public function uploadSingleImage($filename,$path){
		$files = $_FILES;
		$timeImg = '';
		if(!empty($_FILES[$filename]['name'])){
			$tempFile = $files[$filename]['tmp_name'];
			//$temp = $files[$filename]["name"];
			$temp = strtolower(basename($files[$filename]["name"]));
			$path_parts = pathinfo($temp);
			$extension = $path_parts['extension'];
			$t =  time();
			$ImageName = 'image'. $t . '.' . $extension;
			$targetFile = $path . $ImageName ;
			move_uploaded_file($tempFile, $targetFile);
			/*if (strtolower($extension) == 'png') {
			}else if (strtolower($extension) == 'pdf') {
			}else if (strtolower($extension) == 'gif') {
			}else if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
				$this->ImageCompress($path.$ImageName);
				$this->ImageResizeWithCrop(100, 100, $ImageName, $path);
			}else{
			}*/
			
			$p = str_replace('uploads/','',$path);
			return trim($p.$ImageName);
		}
		
	}
	public function uploadMultipleImage($filename,$path){
		if(is_array($_FILES[$filename]['name'])){
			$cpt = count($_FILES[$filename]);
			$ImageName = '';
			$timeImg = '';
			for($i=0; $i<$cpt; $i++){
				if(!empty($_FILES[$filename]['name'][$i])){
					$tempFile = $_FILES[$filename]['tmp_name'][$i];
					//$temp = $_FILES[$filename]['name'][$i];
					$temp = strtolower(basename($_FILES[$filename]["name"][$i]));
					$path_parts = pathinfo($temp);
					$extension = $path_parts['extension'];
					$t =  time();
					$fileName_ = 'img_'.$i.'_'. $t . '.' . $extension;
					$targetFile = $path . $fileName_ ;
					move_uploaded_file($tempFile, $targetFile);
					
					//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
					//$this->thumbimage_resize($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName ,100, 100);
					//$this->ImageResizeWithCrop(100, 100, $timeImg.$ImageName, $path.'thumb/');
					//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
					
					$p = str_replace('uploads/','',$path);
					$ImageName .= ','.$p.$fileName_;
				}
			}
			return trim($ImageName,',');
		}else{
			$files = $_FILES;
			if(!empty($_FILES[$filename]['name'])){
				$tempFile = $_FILES[$filename]['tmp_name'];
				$temp = $_FILES[$filename]["name"];
				$path_parts = pathinfo($temp);
				$extension = $path_parts['extension'];
				$t =  time();
				$ImageName = 'imgs_'. $t . '.' . $extension;
				$targetFile = $path . $ImageName ;
				move_uploaded_file($tempFile, $targetFile);
				//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
				//$this->ImageResizeWithCrop(100, 100, $timeImg.'thumb_'.$ImageName, $path.'thumb/');
				//$this->ImageResizeWithCrop(100, 100, $timeImg.$ImageName, $path.'thumb/');
				//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
				$p = str_replace('uploads/','',$path);	
				return trim($p.$ImageName);
			}
		}
	}
	public function uploadSingleImageOnly($filename,$path){
		$files = $_FILES;
		$timeImg = '';
		if(!empty($_FILES[$filename]['name'])){
			$tempFile = $files[$filename]['tmp_name'];
			//$temp = $files[$filename]["name"];
			$temp = strtolower(basename($files[$filename]["name"]));
			$path_parts = pathinfo($temp);
			$extension = $path_parts['extension'];
			$t =  time();
			$ImageName = 'image'. $t . '.' . $extension;
			$targetFile = $path . $ImageName ;
			move_uploaded_file($tempFile, $targetFile);
			/*if (strtolower($extension) == 'png') {
			}else if (strtolower($extension) == 'gif') {
			}else if (strtolower($extension) == 'pdf') {
			}else if (strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
				$this->ImageCompress($path.$ImageName);
				$this->ImageResizeWithCrop(100, 100, $ImageName, $path);
			}else{
			}*/
			return trim($ImageName);
		}
		
	}
	public function uploadMultipleImageOnly($filename,$path){
		if(is_array($_FILES[$filename]['name'])){
			$cpt = count($_FILES[$filename]);
			$ImageName = '';
			$timeImg = '';
			for($i=0; $i<$cpt; $i++){
				if(!empty($_FILES[$filename]['name'][$i])){
					$tempFile = $_FILES[$filename]['tmp_name'][$i];
					//$temp = $_FILES[$filename]['name'][$i];
					$temp = strtolower(basename($_FILES[$filename]["name"][$i]));
					$path_parts = pathinfo($temp);
					$extension = $path_parts['extension'];
					$t =  time();
					$fileName_ = 'img_'.$i.'_'. $t . '.' . $extension;
					$targetFile = $path . $fileName_ ;
					move_uploaded_file($tempFile, $targetFile);
					
					$ImageName .= ','.$fileName_;
				}
			}
			return trim($ImageName,',');
		}else{
			$files = $_FILES;
			if(!empty($_FILES[$filename]['name'])){
				$tempFile = $_FILES[$filename]['tmp_name'];
				$temp = $_FILES[$filename]["name"];
				$path_parts = pathinfo($temp);
				$extension = $path_parts['extension'];
				$t =  time();
				$ImageName = 'imgs_'. $t . '.' . $extension;
				$targetFile = $path . $ImageName ;
				move_uploaded_file($tempFile, $targetFile);
				//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
				//$this->ImageResizeWithCrop(100, 100, $timeImg.'thumb_'.$ImageName, $path.'thumb/');
				//$this->ImageResizeWithCrop(100, 100, $timeImg.$ImageName, $path.'thumb/');
				//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
				return trim($ImageName);
			}
		}
	}

	
	public function deleteImage(){
	    $table = $_POST['table'];
	    $id = $_POST['id'];
	    $img = $_POST['img'];
	    $column = $_POST['column'];
	    $path = $_POST['path'];
	    $condition = array('id' =>$id );
		$row = $this->common_model->get_all_details($table,$condition)->row_array();
		if($row){
		    if($row[$column]){
		       $b = array();
		       $a = explode(',',$row[$column]);
		       forEach($a as $v){
					if(trim($v) != trim($img)) {
					   array_push($b,$v);
					} else{unlink($path.$img);
						//unlink($path.'thumb/thumb_'.$img);
					} 
		       }
		       $images = implode(",", $b);
		       $inputArr[$column] = $images;  
		       $excludeArr = array('img','column','path','table');
			   $this->common_model->commonInsertUpdate($table,'update',$excludeArr,$inputArr,$condition);
			   echo $this->db->last_query();
		    }
		}
	}
	protected function init_pagination($base_url, $total_rows,$page_record_limit = PAGE_RECORD_LIMIT){
	
            $this->load->library('pagination');
           
            $config = array();
            $config['base_url'] = $base_url;
            $config['page_query_string'] = true;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $page_record_limit;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] ='<li class="prev">';
            $config['prev_tag_close'] ='</li>';
            $config['next_link'] ='&raquo';
            $config['next_tag_open'] ='<li>';
            $config['next_tag_close'] ='</li>';
            $config['last_tag_open'] ='<li>';
            $config['last_tag_close'] ='</li>';
            $config['cur_tag_open'] ='<li class="active"><a href="#">';
            $config['cur_tag_close'] ='</a></li>';
            $config['num_tag_open'] ='<li>';
            $config['num_tag_close'] ='</li>';
            $this->pagination->initialize($config);
            return $config;
    }
    protected function getQueryString($excludeParams=[]){
        $getVals = $this->input->get();
        $string = [];
        foreach ($getVals as $keys => $vals){
            if($keys != 'per_page'){
                if(!in_array($keys, $excludeParams)){
                    $string[] = $keys.'='.$vals;
                }
            }
        }
        return empty($string)?'':'?'.  implode('&', $string);
    }
    public function convert2english($string) {
	    /*$newNumbers = range(0, 9);
	    $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
	    $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
	    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
	    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

	    $string =  str_replace($persianDecimal, $newNumbers, $string);
	    $string =  str_replace($arabicDecimal, $newNumbers, $string);
	    $string =  str_replace($arabic, $newNumbers, $string);
	    return str_replace($persian, $newNumbers, $string);*/

	    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
	    

	    /*$persinaDigits1= array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
	    $persinaDigits2= array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠');
	    $allPersianDigits=array_merge($persinaDigits1, $persinaDigits2);
	    $replaces = array('0','1','2','3','4','5','6','7','8','9','0','1','2','3','4','5','6','7','8','9');
	    return str_replace($allPersianDigits, $replaces , $string);*/

	    /*$persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
	    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

	    $num = range(0, 9);
	    $convertedPersianNums = str_replace($persian, $num, $string);
	    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

	    return $englishNumbersOnly;*/

	}
	public function send_email($to, $from_email, $from_name, $subject, $message, $cc = "",$reply_to='', $attach = ""){
    	$this->load->library('email');
    	
    	/*$config = Array(
                    'protocol' => 'mail',
                    'smtp_host' => "smtp.lenzzo.com",
                    'smtp_port' => "25",
                    'smtp_user' => "support@lenzzo.com",
                    'smtp_pass' => "LEN@22042020",
                    'smtp_timeout' => 30,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
        );*/
        $config = Array(
                    'protocol' => 'mail',
                    'smtp_host' => "smtp.stylebuddy.in",
                    'smtp_port' => "25",
                    'smtp_user' => "partners@stylebuddy.in",
                    'smtp_pass' => "Style@Buddy",
                    'smtp_timeout' => 30,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
        );
        //$config = array('mailtype' => 'html','charset'  => 'utf-8','priority' => '1');
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($to);
		if($reply_to){
		    $this->email->reply_to($reply_to);
		}
		//if($cc){
		    $this->email->bcc(CC_EMAIL);
		//}
		//$this->email->bcc(TO_EMAIL);
		$this->email->subject($subject);
		if (!empty($attach)) {
		  	$this->email->attach($attach);
		} 
		
		$this->email->message($message); 
		//$this->email->message($message); 
		return $send = @$this->email->send();
    }
	public function send_email_mail($to, $website_setting, $subject, $message, $cc = "", $attach = ""){
    	$this->load->library('email');
    	$from_email = $website_setting['site_email'];
    	$config = Array(
                    'protocol' => 'mail',
                    'smtp_host' => "smtp.lenzzo.com",
                    'smtp_port' => "25",
                    'smtp_user' => "support@lenzzo.com",
                    'smtp_pass' => "LEN@22042020",
                    'smtp_timeout' => 30,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
        );
        //initialize
        $headerPart = '<!DOCTYPE>
                       <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <title> '.$website_setting['site_name'].'</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
                            <style>
                                 body{ -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; line-height: 100% !important;}
                                .mb10{margin-bottom:10px;}
                                .m20{ margin-top:20px;}
                                .m30{ margin-top:30px;}
                                .m40{ margin-top:40px;}
                                .m50{ margin-top:50px;}
                                .topp{background: #FFFC00; padding: 20px 0px!important;}
                                .logo{width: 200px;}
                                .welcom{padding:50px!important; margin-top:10px; background:#f0f0f0;}
                                .welcom h3{margin-top:0px; text-transform: uppercase;}
                                .login{ background: #ffffff;padding: 40px 30px;margin-top: 20px;text-align: center;font-size: 18px;text-transform: uppercase;letter-spacing: 1px;font-weight: bold;color: #48af08;outline: 2px solid #333;outline-offset: -15px;}
                                .login h4{ margin-bottom:40px;}
                                .log{background: #cfac3d; padding: 10px 20px;color: #FFF;text-transform: uppercase;font-weight: bold;letter-spacing: 1px;border-radius: 100px;}
                                .log:hover{text-decoration:none;}
                                .your{border: 1px solid;padding: 10px 20px;border-radius: 100px;}
                                .download{ margin-top:40px;}
                                .apps_logo{width:160px; margin-bottom:10px;}
                                .social{ margin-top:30px;}
                                .social ul{padding:0px; margin:0px;}
                                .social ul li{list-style:none; display:inline-block; background: #cfac3d;}
                                .social ul li a {color: #FFF;padding: 10px;display: block;font-size: 20px;width: 45px;text-align: center;}
                                .unde{ background:#000000; color:#FFF; padding:40px; text-align:center;}
                                .unde a{color: #cfac3d;}
                                .socail_m {background:#000000; text-align: center; margin-bottom: 22px; color:#ffffff;}
                                .socail_m ul {list-style: none;padding: 0px;margin: 0px;}
                                .socail_m ul li {display: inline-block;}
                                .socail_m ul li a {padding: 13px; color: #000;background: #FFFC00;margin-top: 4px;display: block;font-size: 22px;width: 50px;height: 50px;line-height: 50px;border-radius: 4px;}
                                .socail_m ul li a:hover {background: #a17e0a;}
                                li {text-align:-webkit-match-parent; display:list-item;text-indent: -1em;}
                                 ul, ol{    margin-left: 40px !important;}
                                @media screen and (min-width:200px) and (max-width:767px) {
                                    .welcom{padding:20px;}
                                    .login {padding: 10px;margin-top: 20px;}    
                                    .unde {padding: 30px;}
                                    .m50 {margin-top: 12px;}
                                }
                                
                                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                  vertical-align: middle!important; 
                                 }
                                 
                                
                                <style type=“text/css”>
                                @import url(https://fonts.googleapis.com/css2?family=Poppins&display=swap);
                                </style>

                            </style>
                        </head>
                        <body>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table" style="font-family: Poppins, sans-serif;margin:0;margin:0px">
						    <tr>
						    	<td class="topp" style="text-align: center;padding:24px;font-size:22px;" ><img src="'.base_url('uploads/'.$website_setting['header_logo']).'" width="200" style="margin-top:10px;" class="center-block img-responsive logo"></td>
						    </tr>
						</table>';



        	$footerPart = '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table" style="font-family: Poppins, sans-serif;margin:0;margin:0px;">
        					<tr>
						        <td class="unde">
						            <p><b>Cheers</b></p>
								    <p>The '.$website_setting['site_name'].' Team<br>
								    <a style="color:#ffffff;">Support : '.$website_setting['site_email'].' | '.$website_setting['mobile1'].' </a>| <a href="'.base_url().'">Need More Help?</a></p>
								    
						        </td>
						    </tr>
						    <tr class="socail_m">
						        <td>
						            <table width="15%" style="margin: auto;">
						                <tr>
						                    <td style="padding-bottom:15px;"><a target="_blank" href="https://www.facebook.com/"><img src="'.base_url().'assets/ui/images/f1.png"></a></td>
						                    <td style="padding-bottom:15px;"><a target="_blank" href="https://www.twitter.com"><img src="'.base_url().'assets/ui/images/f2.png"></a></td>
						                    <td style="padding-bottom:15px;"><a target="_blank" href="https://www.youtube.com"><img src="'.base_url().'assets/ui/images/f3.png"></a></td>
						                    <td style="padding-bottom:15px;"><a target="_blank" href="https://www.linkedin.com"><img src="'.base_url().'assets/ui/images/f4.png"></a></td>
						                    <td style="padding-bottom:15px;"><a target="_blank" href="https://www.instagram.com"><img src="'.base_url().'assets/ui/images/f5.png"></a></td>
						                </tr>
						            </table>
						        </td>
						    </tr></table></body> </html>';
        $finalMessage = $headerPart.$message.$footerPart;
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
		$this->email->from($from_email, ''); 
		$this->email->to($to);
		$this->email->subject($subject);
		if (!empty($attach)) {
		  	$this->email->attach($attach);
		} 
		
		$this->email->message($finalMessage); 
		//$this->email->message($message); 
		return $send = @$this->email->send();
    }



    public function createPDF($fileName,$html) {
        ob_start(); 
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'ISO-8859-1', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TcPdf');
        $pdf->SetTitle('TcPdf');
        $pdf->SetSubject('TcPdf');
        $pdf->SetKeywords('TcPdf');

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 0);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }       

        // set font
        //$pdf->SetFont('dejavusans', '', 10);
        $pdf->SetFont('dejavusans', '', 8, '', true);
		$pdf->SetFont('helvetica', '', 8, '', true);
        // add a page
        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();       
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($fileName, 'F');        
    }
}
?>
