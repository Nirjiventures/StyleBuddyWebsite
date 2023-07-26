<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Uploads extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }
	public function importbrands(){
		 
		$tbl_name='brands';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details($tbl_name,array('millCode'=>trim($sheetData[1])))->row();
							if(!$rr){
								$insert_data['company'] 			= trim($sheetData[0]);					
								$insert_data['millCode'] 			= trim($sheetData[1]);					
								$insert_data['name'] 	= trim($sheetData[2]);
								$insert_data['domain']  	= trim($sheetData[3]);
								$insert_data['image']  	= trim($sheetData[4]);
								$insert_data['mediumImage']  	= trim($sheetData[5]);
								
								
								$insert_data['updated_at']  = date("Y-m-d h:i:s");
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;

								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Color Name','Color Group Code','Color Code','Hex Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='colors';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }
		                //var_dump($SheetDataKey);die;
		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode =  $SheetDataKey['ColorCode'];
		                	$HexCode =  $SheetDataKey['HexCode'];
		                	
		                	$ColorName = $title = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
		                	$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
		                	$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
		                	$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							  
							$a['name'] = $title = $ColorName;
							$a['HexCode'] = $HexCode;
							$a['ColorGroupCode'] = $ColorGroupCode;
							$a['ColorCode'] = $ColorCode;
							 
							
							$a['updated_at']  = date("Y-m-d h:i:s");
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title($title, '-', TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;
							if(!empty($title) && !empty($HexCode) && !empty($ColorCode) && !empty($ColorGroupCode)){
			                   	$this->common_model->simple_insert($tbl_name,$a);
			            		echo $this->db->last_query();
			            		DIE;
							}
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/importColors'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function importColors(){
		 
		$tbl_name='colors';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;




								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Color Name','Color Group Code','Color Code','Hex Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='colors';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }
		                //var_dump($SheetDataKey);die;
		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode =  $SheetDataKey['ColorCode'];
		                	$HexCode =  $SheetDataKey['HexCode'];
		                	
		                	$ColorName = $title = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
		                	$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
		                	$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
		                	$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							  
								$a['name'] = $title = $ColorName;
								$a['HexCode'] = $HexCode;
								$a['ColorGroupCode'] = $ColorGroupCode;
								$a['ColorCode'] = $ColorCode;
								 
								
								$a['updated_at']  = date("Y-m-d h:i:s");
								$a['created_at']  = date("Y-m-d h:i:s");
								$a['status']  = 1;

								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$a['slug'] = $slug;
								if(!empty($title) && !empty($HexCode) && !empty($ColorCode) && !empty($ColorGroupCode)){
				                   	$this->common_model->simple_insert($tbl_name,$a);
				            		echo $this->db->last_query();
								}

			                //}
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/importColors'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}

	public function stylingreport(){
        $table = 'package_report_pdf';
        $condition = " WHERE user_id = '".$this->userID."' ";
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
        foreach ($list as $key => $value) {
            $table = 'user_order_details';
            $condition = " where id =".$value->order_detail_id." order by id DESC";
            $r = $this->db->query('SELECT * FROM '.$table.''.$condition)->row();
            $list[$key]->order_detail = $r;
        }
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/user/service_report',$data);
         
    }
	public function index(){
		 
		$tbl_name = 'vender';
		//die;
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;




								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				//echo $ext;
				//echo $_FILES['importfile']['name'];
				$this->load->library('excel');
				//echo $_FILES['importfile']['name'];
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);
		           
		            

		            $flag = 0;
		            
		            $createArray = array('Mail ID','mobile','City','Client','Title','Job Type','Job details','Estimated Spend','Job frequency','Experience needed','Job location');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='vender';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	$job_location = $SheetDataKey['Joblocation'];
		                	$experience = $SheetDataKey['Experienceneeded'];
		                	$job_frequency = $SheetDataKey['Jobfrequency'];
		                	$package = $SheetDataKey['EstimatedSpend'];
		                	$job_description = $SheetDataKey['Jobdetails'];
		                	$job_type = $SheetDataKey['JobType'];
		                	$job_title = $SheetDataKey['Title'];

		                	$MailID =  $SheetDataKey['MailID'];
		                	$mobile =  $SheetDataKey['mobile'];
		                	$City = $SheetDataKey['City'];
		                	$Client = $SheetDataKey['Client'];

		                	$job_location = filter_var(trim($allDataInSheet[$i][$job_location]), FILTER_SANITIZE_STRING);
		                	$experience = filter_var(trim($allDataInSheet[$i][$experience]), FILTER_SANITIZE_STRING);
		                	$job_frequency = filter_var(trim($allDataInSheet[$i][$job_frequency]), FILTER_SANITIZE_STRING);
		                	$package = filter_var(trim($allDataInSheet[$i][$package]), FILTER_SANITIZE_STRING);
		                	$job_description = filter_var(trim($allDataInSheet[$i][$job_description]), FILTER_SANITIZE_STRING);
		                	$job_type = filter_var(trim($allDataInSheet[$i][$job_type]), FILTER_SANITIZE_STRING);
		                	$job_title = filter_var(trim($allDataInSheet[$i][$job_title]), FILTER_SANITIZE_STRING);
		                	
		                	$MailID = filter_var(trim($allDataInSheet[$i][$MailID]), FILTER_SANITIZE_STRING);
							$mobile=filter_var(trim($allDataInSheet[$i][$mobile]), FILTER_SANITIZE_STRING);
							$City = filter_var(trim($allDataInSheet[$i][$City]), FILTER_SANITIZE_STRING);
							$Client = filter_var(trim($allDataInSheet[$i][$Client]), FILTER_SANITIZE_STRING);
							

							$row = $this->common_model->get_all_details($tbl_name,array('email'=>$MailID))->row();
							echo $this->db->last_query();
							if ($row) {
								$tbl_name1='jobs';
								$b = array();
								$b['company']  	= $Client;
								$b['city']  	= $City;
								$b['job_admin_id']  	= $row->id;
								$b['job_location']  	= $job_location;
								$b['job_location']  	= $job_location;
								$b['experience']  	= $experience;
								$b['job_frequency']  	= $job_frequency;
								$b['package']  	= $package;
								$b['job_description']  	= $job_description;
								$b['job_type']  	= $job_type;
								$b['job_title']  	= $job_title;
								$b['created_at']  = date("Y-m-d h:i:s");
								$b['updated_at']  = date("Y-m-d h:i:s");
								$title = $job_title;
								$slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slugBase = $slug;
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name1,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name1,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$b['slug'] = $slug;

								$this->common_model->simple_insert($tbl_name1,$b);

							}else{
								$a = array();
								$a['email']  	= $MailID;
								$a['mobile']  	= $mobile;
								$a['city']  	= $City;
								$a['city_name']  	= $City;
								$a['fname']  	= $Client;
								$a['created_at']  = date("Y-m-d h:i:s");
								$a['status']  = 1;
								$a['user_type']  = 5;
								$a['password']  = md5(123456);
								$fetchData[] = $a;
			            		$this->common_model->simple_insert($tbl_name,$a);
			            	}
							/*$fetchData[] = $a;
		            		$this->common_model->simple_insert($tbl_name,$a);
		            		echo $this->db->last_query();die;*/
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                //redirect(base_url('uploads/index'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}
		$this->load->view('upload-csv',$data);		
		 
	}
	public function import_sweat_shirts(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;




								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);
		           
		            $cat_id = 'Sweat shirts';
					$category = 34;
					$live_cat_id = 50;
					$category_slug = 'sweatshirts';

		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/import_sweat_shirts'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function import_polos(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;




								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);

								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            $cat_id = 'Polos';
					$category = 35;
					$live_cat_id = 100;
					$category_slug = 'polos';
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/import_polos'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function import_outerwear(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;



								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            $cat_id = 'Outerwear';
					$category = 37;
					$live_cat_id = 70;
					$category_slug = 'outerwear';
		            $flag = 0;
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
		            		die;
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		               // redirect(base_url('admin/upload/import_outerwear'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function import_woven_shirts(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				/*if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;

								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}*/
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            $cat_id = 'Woven Shirts';
					$category = 38;
					$live_cat_id = 120;
					$category_slug = 'woven-shirts';
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/import_woven_shirts'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function import_fleece(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;

								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            $cat_id = 'Fleece Jackets';
					$category = 36;
					$live_cat_id = 30;
					$category_slug = 'fleece';
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/import_fleece'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function import_headwear(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;

								$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            $cat_id = 'Headwear';
					$category = 40;
					$live_cat_id = 40;
					$category_slug = 'headwear';
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front of Image Name','Back of Image Name','Side of Image Name','Front Image Hi Res URL','Back Image Hi Res URL','Side Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$style_id =  $SheetDataKey['Style'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];

		                	$SizeGroup = $SheetDataKey['SizeGroup'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
							$size = $SheetDataKey['Size'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	
		                	$gtin = $SheetDataKey['Gtin'];
		                	$weight = $SheetDataKey['Weight'];

		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	
		                	$FrontofImageName = $SheetDataKey['FrontofImageName'];
		                	$BackofImageName = $SheetDataKey['BackofImageName'];
		                	$SideofImageName = $SheetDataKey['SideofImageName'];
		                	
		                	$FrontImageHiResURL = $SheetDataKey['FrontImageHiResURL'];
		                	$BackImageHiResURL = $SheetDataKey['BackImageHiResURL'];
		                	$SideImageHiResURL = $SheetDataKey['SideImageHiResURL'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$item_type = $SheetDataKey['NEW'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$style_id=filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);
							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							$SizeCode=filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							//$cat_id=filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							
							$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
		                	$FrontofImageName = filter_var(trim($allDataInSheet[$i][$FrontofImageName]), FILTER_SANITIZE_STRING);
		                	$BackofImageName = filter_var(trim($allDataInSheet[$i][$BackofImageName]), FILTER_SANITIZE_STRING);
		                	$SideofImageName = filter_var(trim($allDataInSheet[$i][$SideofImageName]), FILTER_SANITIZE_STRING);
		                	$FrontImageHiResURL = filter_var(trim($allDataInSheet[$i][$FrontImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$BackImageHiResURL = filter_var(trim($allDataInSheet[$i][$BackImageHiResURL]), FILTER_SANITIZE_STRING);
		                	$SideImageHiResURL = filter_var(trim($allDataInSheet[$i][$SideImageHiResURL]), FILTER_SANITIZE_STRING);

							$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$a['weight']  	= $weight;
							
							$a['frontImage']  	= $FrontofImageName;
							$a['backImage']  	= $BackofImageName;
							$a['sideImage']  	= $SideofImageName;
							
							$a['frontImageFull']  	= $FrontImageHiResURL;
							$a['backImageFull']  	= $BackImageHiResURL;
							$a['sideImageFull']  	= $SideImageHiResURL;
							
							$a['quantity']  	= $CaseQty;
							$a['product_ids']  	= $LaunchDate;
							$a['category']  	= $category;
							$a['live_cat_id']  	= $live_cat_id;
							$a['category_slug']  	= $category_slug;
							$a['category_name']  	= trim($cat_id);
							
							$a['product_id'] = $product_id;
							$a['style_id'] = $style_id;
							$a['title'] = $title;
							$a['ColorName'] = $ColorName;
							$a['ColorGroupCode'] =  $ColorGroupCode;
		                	$a['ColorCode'] =  $ColorCode;
		                	$a['HexCode'] =  $HexCode;
		                	
							$a['SizeGroup'] = $SizeGroup;
							$a['SizeCode'] = $SizeCode;
							$a['size'] = $size;
							$a['image_base_url'] = 'Live';
							
							$a['description'] = $description;
							$a['millId']  	= $millId;
							$a['MillName']  	= $MillName;
							$a['item_type']  	= $item_type;
	                	 	$a['markupCode']  	= $MarkupCode;
							$a['gtin'] = $gtin;
							$a['image'] = $image;
							$a['created_at']  = date("Y-m-d h:i:s");
							$a['status']  = 1;

							$slugBase = $slug = url_title(htmlspecialchars($title), '-',TRUE);
							$slug_check = '0';
							$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
							if ($duplicate_url->num_rows()>0){
								$slug = $slugBase.'-'.$duplicate_url->num_rows();
							}else {
								$slug_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($slug_check == '0'){
								$urlCount++;
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$urlCount;
								}else {
									$slug_check = '1';
								}
							}
							$a['slug'] = $slug;


		                    $fetchData[] = $a;
		            		$this->common_model->simple_insert('products',$a);
		            		echo $this->db->last_query();
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/import_headwear'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function importFile(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;

								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;


								//$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								//echo $this->db->last_query();			
								//echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Full Feature Description','Category','Size','Size Group','Size Code','Gtin','Front Image Hi Res URL','Color Group Code','Color Code','Color Name','Hex Code','Launch Date','Case Qty','NEW');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	$CaseQty = $SheetDataKey['CaseQty'];
		                	
		                	$LaunchDate = $SheetDataKey['LaunchDate'];
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	
		                	$ColorName = $SheetDataKey['ColorName'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	

		                	$style_id =  $SheetDataKey['Style'];
		                	$size = $SheetDataKey['Size'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
		                	$SizeGroup = $SheetDataKey['SizeGroup'];

		                	$gtin = $SheetDataKey['Gtin'];
		                	$image = $SheetDataKey['FrontImageHiResURL'];
		                	$item_type = $SheetDataKey['NEW'];

		                	$CaseQty = filter_var(trim($allDataInSheet[$i][$CaseQty]), FILTER_SANITIZE_STRING);
		                	$cat_id = filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$LaunchDate = filter_var(trim($allDataInSheet[$i][$LaunchDate]), FILTER_SANITIZE_STRING);
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							$style_id = filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$ColorName = filter_var(trim($allDataInSheet[$i][$ColorName]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$ColorCode]), FILTER_SANITIZE_STRING);

							$HexCode = filter_var(trim($allDataInSheet[$i][$HexCode]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);

							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							$SizeCode = filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							
							$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							
							$item_type = filter_var(trim($allDataInSheet[$i][$item_type]), FILTER_SANITIZE_STRING);
							$a['item_type']  	= $item_type;
		                	/*$rr = $this->common_model->get_all_details('products_category',array('title'=>$cat_id,'status'=>'1'))->row();
							if($rr){*/
								$cat_id = 'Sweat shirts';
								$category = 34;
								$live_cat_id = 50;
								$category_slug = 'sweatshirts';
								
								
								$a['quantity']  	= $CaseQty;
								$a['product_ids']  	= $LaunchDate;
								$a['category']  	= $category;
								$a['live_cat_id']  	= $live_cat_id;
								$a['category_slug']  	= $category_slug;
								$a['category_name']  	= trim($cat_id);
								
								$a['product_id'] = $product_id;
								$a['style_id'] = $style_id;
								$a['title'] = $title;
								$a['ColorName'] = $ColorName;
								$a['ColorCode'] =  $ColorCode;
			                	$a['HexCode'] =  $HexCode;
			                	$a['ColorGroupCode'] =  $ColorGroupCode;
			                	

								$a['size'] = $size;
								$a['SizeCode'] = $SizeCode;
								$a['SizeGroup'] = $SizeGroup;
								$a['image_base_url'] = 'Live';
								


								$a['description'] = $description;
								$a['gtin'] = $gtin;
								$a['image'] = $image;
								$a['created_at']  = date("Y-m-d h:i:s");
								$a['status']  = 1;

								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$a['slug'] = $slug;


			                    $fetchData[] = $a;
			            		//$this->common_model->simple_insert('products',$a);
			            		//echo $this->db->last_query();
			                //}
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                redirect(base_url('admin/upload/importFile'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}

	public function importFileUpdate(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				/*if($_FILES['importfile']['name'] != "" ){
					$file = fopen($_FILES['importfile']['tmp_name'], "r");				
					$i = 1;	
					$insert_data	= array();			
					while($sheetData = fgetcsv($file)){   
						$i++;
						if( $i>1){
							$cat_id = (int)$sheetData[11];
							$rr = $this->common_model->get_all_details('products_category',array('category_id'=>$cat_id))->row();
							if($rr){
								$insert_data['product_id'] 			= trim($sheetData[1]);					
								$insert_data['title']  	= $title	= trim($sheetData[2]);
								$insert_data['description']  	= trim($sheetData[3]);
								$insert_data['short_description']  	= trim($sheetData[3]);
								$insert_data['category']  	= trim($rr->id);
								$insert_data['live_cat_id']  	= trim($cat_id);
								$insert_data['category_slug']  	= $rr->slug;
								$insert_data['category_name']  	= trim($sheetData[14]);
								$insert_data['quantity']  	= trim($sheetData[12]);

								$insert_data['image_base_url']  	= 'YES';
								$insert_data['image']  	= trim($sheetData[4]).trim($sheetData[5]);
								$insert_data['popularity']  	= trim($sheetData[15]);
								 
								$insert_data['created_at']  = date("Y-m-d h:i:s");
								$insert_data['status']  = 1;




								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$insert_data['slug'] = $slug;

								$r = $this->common_model->get_all_details($tbl_name,array('product_id'=>$product_id));
								if (!$r) {
									$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);
								}
								echo $this->db->last_query();			
								echo "<pre>";print_r(fgetcsv($file));
							}
						}
					}
					//fclose($file);
					$data['message_success'] = 'Uploaded Successfully';
				}else{
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}*/
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Full Feature Description','Category','Size','Size Group','Size Code','Gtin','Front Image Hi Res URL','Color Group Code','Color Code','Color Name','Hex Code','Retail Price','GTIN Number');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	
		                	$price = $SheetDataKey['RetailPrice'];
		                	
		                	$cat_id_key = $SheetDataKey['Category'];
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$title = $SheetDataKey['ShortDescription'];
		                	$description = $SheetDataKey['FullFeatureDescription'];
		                	
		                	$color_name = $SheetDataKey['ColorName'];
		                	$ColorCode = $SheetDataKey['ColorCode'];
		                	$HexCode = $SheetDataKey['HexCode'];
		                	$ColorGroupCode = $SheetDataKey['ColorGroupCode'];
		                	

		                	$style_id =  $SheetDataKey['Style'];
		                	$size = $SheetDataKey['Size'];
		                	$SizeCode = $SheetDataKey['SizeCode']; 
		                	$SizeGroup = $SheetDataKey['SizeGroup'];

		                	//$gtin = $SheetDataKey['Gtin'];
		                	$gtin = $SheetDataKey['GTINNumber'];
		                	

		                	$image = $SheetDataKey['FrontImageHiResURL'];

		                	$price = filter_var(trim($allDataInSheet[$i][$price]), FILTER_SANITIZE_STRING);
		                	$cat_id = filter_var(trim($allDataInSheet[$i][$cat_id_key]), FILTER_SANITIZE_STRING);
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$description = filter_var(trim($allDataInSheet[$i][$description]), FILTER_SANITIZE_STRING);
							$style_id = filter_var(trim($allDataInSheet[$i][$style_id]), FILTER_SANITIZE_STRING);
							$title = filter_var(trim($allDataInSheet[$i][$title]), FILTER_SANITIZE_STRING);
							$color_name = filter_var(trim($allDataInSheet[$i][$color_name]), FILTER_SANITIZE_STRING);
							$ColorCode = filter_var(trim($allDataInSheet[$i][$color_code]), FILTER_SANITIZE_STRING);

							$HexCode = filter_var(trim($allDataInSheet[$i][$hexCode]), FILTER_SANITIZE_STRING);
							$ColorGroupCode = filter_var(trim($allDataInSheet[$i][$ColorGroupCode]), FILTER_SANITIZE_STRING);

							$size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
							$SizeCode = filter_var(trim($allDataInSheet[$i][$SizeCode]), FILTER_SANITIZE_STRING);
							$SizeGroup = filter_var(trim($allDataInSheet[$i][$SizeGroup]), FILTER_SANITIZE_STRING);
							
							$gtin = filter_var(trim($allDataInSheet[$i][$gtin]), FILTER_SANITIZE_STRING);
							$image = filter_var(trim($allDataInSheet[$i][$image]), FILTER_SANITIZE_STRING);
							

		                	$rr = $this->common_model->get_all_details('products_category',array('title'=>$cat_id,'status'=>'1'))->row();
							//if($rr){
								$a['category']  	= trim($rr->id);
								$a['live_cat_id']  	= trim($rr->id);
								$a['category_slug']  	= $rr->slug;
								$a['category_name']  	= trim($cat_id);
								
								$a['product_id'] = $product_id;
								$a['style_id'] = $style_id;
								$a['title'] = $title;
								$a['color_name'] = $color_name;
								$a['ColorCode'] =  $ColorCode;
			                	$a['HexCode'] =  $HexCode;
			                	$a['ColorGroupCode'] =  $ColorGroupCode;
			                	

								$a['size'] = $size;
								$a['SizeCode'] = $SizeCode;
								$a['SizeGroup'] = $SizeGroup;
								$a['image_base_url'] = 'Live';
								


								$a['description'] = $description;
								$a['gtin'] = $gtin;
								$a['image'] = $image;
								$a['created_at']  = date("Y-m-d h:i:s");
								$a['status']  = 1;

								$slugBase = $slug = url_title($title, '-', TRUE);
								$slug_check = '0';
								$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
								if ($duplicate_url->num_rows()>0){
									$slug = $slugBase.'-'.$duplicate_url->num_rows();
								}else {
									$slug_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($slug_check == '0'){
									$urlCount++;
									$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));
									if ($duplicate_url->num_rows()>0){
										$slug = $slugBase.'-'.$urlCount;
									}else {
										$slug_check = '1';
									}
								}
								$a['slug'] = $slug;


								$bArray['price'] = $price;
								$con111['product_id'] = $product_id;
			                    $fetchData[] = $b;
			            		$this->common_model->commonUpdate('products',$bArray,$con111);
			            		echo $this->db->last_query();
			                //}
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                //redirect(base_url('admin/upload/importFileupdate'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			/*}else{*/
				$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function updateprice(){

		 

		$tbl_name = 'products';

		$postData = $this->input->post();	

		$insertedArray = array();

		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');

		

		if(!empty($_FILES)){	

			$filename = $_FILES['importfile']['name'];

			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

			if($ext == "csv"){

				

			}else{

				$this->load->library('excel');

				if($_FILES['importfile']['name'] != "" ){

					$image = $this->uploadSingleImage('importfile',"upload/files/");

					$path = FCPATH."upload/";

		           	$inputFileName = $path . $image;

		          	try {

		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);

		                $objPHPExcel = $objReader->load($inputFileName);

		            } catch (Exception $e) {

		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)

		                        . '": ' . $e->getMessage());

		            }

		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

		            $arrayCount = count($allDataInSheet);



		            

		            $flag = 0;

		            

		            $createArray = array('Item Number','Piece','Dozen','Case','Retail');

		            $SheetDataKey = array();

		            foreach ($allDataInSheet as $dataInSheet) {

		                foreach ($dataInSheet as $key => $value) {

		                    if (in_array(trim($value), $createArray)) {

		                        $value = preg_replace('/\s+/', '', $value);

		                        $SheetDataKey[trim($value)] = trim($value);

		                    } else {

		                    }

		                }

		            }

		            $tbl_name='products';

		            if ($flag == 0) {

		            	foreach ($allDataInSheet as $dataInSheet) {

		                    foreach ($dataInSheet as $key => $value) {

		                        if (in_array(trim($value), $createArray)) {

		                            $value = preg_replace('/\s+/', '', $value);

		                            $SheetDataKey[trim($value)] = $key;

		                        }

		                    }

		                }



		                for ($i = 2; $i <= $arrayCount; $i++) {

		                	$product_id =  $SheetDataKey['ItemNumber'];

		                	$Piece = $SheetDataKey['Piece'];

		                	$Dozen = $SheetDataKey['Dozen'];

		                	$Case =  $SheetDataKey['Case'];

		                	$Retail =  $SheetDataKey['Retail'];
		                	
		                	$Piece = filter_var(trim($allDataInSheet[$i][$Piece]), FILTER_SANITIZE_STRING);
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
		                	$Dozen = filter_var(trim($allDataInSheet[$i][$Dozen]), FILTER_SANITIZE_STRING);
		                	$Case = filter_var(trim($allDataInSheet[$i][$Case]), FILTER_SANITIZE_STRING);
							$Retail = filter_var(trim($allDataInSheet[$i][$Retail]), FILTER_SANITIZE_STRING);

		                	
 
		                	$bArray['price'] = trim(str_replace('$', '', $Piece));
							$bArray['dozen_price'] = trim(str_replace('$', '', $Dozen));
							$bArray['case_price'] = trim(str_replace('$', '', $Case));
							$bArray['retail_price'] = trim(str_replace('$', '', $Retail));
		                    $con111['product_id'] = $product_id;
		                    $fetchData[] = $b;
		            		$this->common_model->commonUpdate('products',$bArray,$con111);
		            		echo $this->db->last_query();
		                } 

		                //$this->db->insert_batch($tbl_name, $fetchData);

		                //redirect(base_url('admin/upload/updateprice'));

		            } else {

		                echo "Please import correct file";

		            }

		        }

			 	$data['message_error'] = 'Please upload csv file';

			

			}

			 			

		}		

		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);

	}
	public function updateprice_back_up(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Full Feature Description','Category','Size','Size Group','Size Code','Gtin','Case Qty','Color Group Code','Color Code','Color Name','Hex Code','Piece','GTIN Number');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	$price = $SheetDataKey['Piece'];
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$quantity =  $SheetDataKey['CaseQty'];
		                	
		                	$price = filter_var(trim($allDataInSheet[$i][$price]), FILTER_SANITIZE_STRING);
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
		                	$quantity = filter_var(trim($allDataInSheet[$i][$quantity]), FILTER_SANITIZE_STRING);
		                	

							
							$bArray['price'] = trim(str_replace('$', '', $price));
							//$bArray['quantity'] = $quantity;
							//$bArray['total_qty'] = $quantity;
		                    		                    
		                    $con111['product_id'] = $product_id;
		                    $fetchData[] = $b;
		            		$this->common_model->commonUpdate('products',$bArray,$con111);
		            		echo $this->db->last_query();
		            		//die;
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                //redirect(base_url('admin/upload/updateprice'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			 	$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}
	public function updatebrand(){
		 
		$tbl_name = 'products';
		$postData = $this->input->post();	
		$insertedArray = array();
		$data = array( 'title' => 'Import Product', 'list_heading' => 'Import Product');
		
		if(!empty($_FILES)){	
			$filename = $_FILES['importfile']['name'];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			if($ext == "csv"){
				
			}else{
				$this->load->library('excel');
				if($_FILES['importfile']['name'] != "" ){
					$image = $this->uploadSingleImage('importfile',"upload/files/");
					$path = FCPATH."upload/";
		           	$inputFileName = $path . $image;
		          	try {
		                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		                $objPHPExcel = $objReader->load($inputFileName);
		            } catch (Exception $e) {
		                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
		            }
		            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		            $arrayCount = count($allDataInSheet);

		            
		            $flag = 0;
		            
		            $createArray = array('Item Number','Style','Short Description','Color Name','Color Group Code','Color Code','Hex Code','Size Group','Size Code','Size','Category','Full Feature Description','Case Qty','Mill #','Mill Name','Gtin','Front Image Hi Res URL','Launch Date','NEW','Markup Code');
		            $SheetDataKey = array();
		            foreach ($allDataInSheet as $dataInSheet) {
		                foreach ($dataInSheet as $key => $value) {
		                    if (in_array(trim($value), $createArray)) {
		                        $value = preg_replace('/\s+/', '', $value);
		                        $SheetDataKey[trim($value)] = trim($value);
		                    } else {
		                    }
		                }
		            }
		            $tbl_name='products';
		            if ($flag == 0) {
		            	foreach ($allDataInSheet as $dataInSheet) {
		                    foreach ($dataInSheet as $key => $value) {
		                        if (in_array(trim($value), $createArray)) {
		                            $value = preg_replace('/\s+/', '', $value);
		                            $SheetDataKey[trim($value)] = $key;
		                        }
		                    }
		                }

		                for ($i = 2; $i <= $arrayCount; $i++) {
		                	$product_id =  $SheetDataKey['ItemNumber'];
		                	$millId = $SheetDataKey['Mill#'];
		                	$MillName = $SheetDataKey['MillName'];
		                	$MarkupCode = $SheetDataKey['MarkupCode'];
		                	
		                	$product_id = filter_var(trim($allDataInSheet[$i][$product_id]), FILTER_SANITIZE_STRING);
							$millId = filter_var(trim($allDataInSheet[$i][$millId]), FILTER_SANITIZE_STRING);
		                	$MillName=filter_var(trim($allDataInSheet[$i][$MillName]), FILTER_SANITIZE_STRING);
		                	
							$MarkupCode = filter_var(trim($allDataInSheet[$i][$MarkupCode]), FILTER_SANITIZE_STRING);

							$bArray['millId'] = $millId;
							$bArray['MillName'] = $MillName;
		                    $bArray['markupCode'] = $MarkupCode;		                    
		                    
		                    $con111['product_id'] = $product_id;
		                    $fetchData[] = $b;
		            		$this->common_model->commonUpdate('products',$bArray,$con111);
		            		echo $this->db->last_query();
		            		//die;
			                 
		                } 
		                //$this->db->insert_batch($tbl_name, $fetchData);
		                //redirect(base_url('admin/upload/updateprice'));
		            } else {
		                echo "Please import correct file";
		            }
		        }
			 	$data['message_error'] = 'Please upload csv file';
			
			}
			 			
		}		
		$this->template->load('admin/base', 'admin/cms/upload-csv', $data);
	}

	public function uploadSingleImage($filename,$path){
		$files = $_FILES;
		$timeImg = '';
		if(!empty($_FILES[$filename]['name'])){
			$tempFile = $files[$filename]['tmp_name'];
			//$temp = $files[$filename]["name"];
			$temp = strtolower(basename($files[$filename]["name"]));
			$path_parts = pathinfo($temp);
			$t =  time();
			$ImageName = 'image'. $t . '.' . $path_parts['extension'];
			$targetFile = $path . $ImageName ;
			move_uploaded_file($tempFile, $targetFile);
			//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
			//$this->ImageResizeWithCrop(100, 100, $timeImg.'thumb_'.$ImageName, $path.'thumb/');
			//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
			
			$p = str_replace('upload/','',$path);
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
					$t =  time();
					$fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
					$targetFile = $path . $fileName_ ;
					move_uploaded_file($tempFile, $targetFile);
					
					//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
					//$this->thumbimage_resize($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName ,100, 100);
					//$this->ImageResizeWithCrop(100, 100, $timeImg.$ImageName, $path.'thumb/');
					//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
					
					$p = str_replace('upload/','',$path);
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
				$t =  time();
				$ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];
				$targetFile = $path . $ImageName ;
				move_uploaded_file($tempFile, $targetFile);
				//@copy($path.$ImageName, $path.'thumb/'.$timeImg.'thumb_'.$ImageName);
				//$this->ImageResizeWithCrop(100, 100, $timeImg.'thumb_'.$ImageName, $path.'thumb/');
				//$this->ImageResizeWithCrop(100, 100, $timeImg.$ImageName, $path.'thumb/');
				//copy($path.$ImageName, $path.'thumb/'.$timeImg.$ImageName);
				$p = str_replace('upload/','',$path);	
				return trim($p.$ImageName);
			}
		}
	}
}
