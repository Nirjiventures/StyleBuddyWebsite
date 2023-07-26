<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

        $this->load->model('admin/Dashboard_Model');

        $this->logged_in();

        $this->load->model('common_model');

    }

	private function logged_in()

	{

        if (!$this->session->userdata('authenticated')) {

            redirect('stylebuddy-admin');

        }

    }

	public function index()

	{   

	   $this->load->view('admin/template/header');

	   $this->load->view('admin/template/dashboard');

       $this->load->view('admin/template/footer');

	}
    public function category(){   
    	$this->getPermission('admin/category');
	    $wh = ' WHERE parent_id = 0  ';
	    $wh .= ' order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        $data['parent_category'] = $rows;
        $rows = array();
	    if ($_GET['category']) {
	    	$wh = ' WHERE parent_id = "'.$_GET['category'].'"  ';
	    	$wh .= ' order by ui_order ASC';
        	$rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
	    }
        $data['parent_sub_category'] = $rows;

	    $wh = ' WHERE id != 0  ';
	    if (!empty($_GET['category']) && !empty($_GET['sub_category'])) {
	    	$wh .= ' AND parent_id = "'.$_GET['sub_category'].'"  ';
	    }else if (!empty($_GET['category']) && empty($_GET['sub_category'])) {
	    	$wh .= ' AND parent_id = "'.$_GET['category'].'"  ';
	    }else if (empty($_GET['category']) && !empty($_GET['sub_category'])) {
	    }
	    $wh .= ' order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result();
        $data['datas'] = $rows;
	    
	    $this->load->view('admin/template/header');
	    $this->load->view('admin/category/view',$data);
        $this->load->view('admin/template/footer');
	}
	public function category____________()

	{   

	    $data['datas'] = $this->Dashboard_Model->common_all('category');

	    $this->load->view('admin/template/header');

	    $this->load->view('admin/category/view',$data);

        $this->load->view('admin/template/footer');

	}

	function changeFeaturedStatus(){   
		$tbl_name = 'category';
		$id = $this->input->post('id');
		$status = $this->input->post('display_status'); 
		$params = ['featured'=>$status];	
		$update = $this->common_model->commonUpdate($tbl_name,$params,array('id'=>$id));
		echo $this->db->last_query();
		die;

	}

	public function uploadSingleImage11($filename,$path){

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

			

			$p = str_replace('uploads/','',$path);

			return trim($p.$ImageName);

		}

		

	}

	public function uploadMultipleImage11($filename,$path){

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

				$t =  time();

				$ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];

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

	

	public function categoryForm()
	{   
		$this->getPermission('admin/category/add');
	    //$this->form_validation->set_rules('name', 'Category', 'required|trim|is_unique[category.name]');

	    //$this->form_validation->set_rules('is_unique', 'The %s entered is already in use');

	    $this->form_validation->set_rules('name', 'Category', 'required|trim');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    $data = $this->input->post();

	    if($this->form_validation->run()) {

	            

	            

    	        $image = $this->uploadSingleImage11('cat_image',"assets/images/cat/");

				if(!empty($image)){

					$data['cat_image'] = $image;

				}

				if ($this->input->post('ui_order')) {

    	        	$data['ui_order'] = $this->input->post('ui_order');

	            }

    	    	$tbl_name = 'category';

    	    	

    	        if($this->input->post('menu_type')){

    	            $data['menu_type'] = $this->input->post('menu_type'); 

    	        }

    	        $data['name'] = $this->input->post('name'); 

	            $data['status']  = $this->input->post('status');

	            $data['created_at']  = date('d m Y h:i:s'); 



	            $seourlBase = $seourl = url_title($data['name'], 'dash', true);

	            $seourl_check = '0';

				$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$seourl));

				if ($duplicate_url->num_rows()>0){

					$seourl = $seourlBase.'-'.$duplicate_url->num_rows();

				}else {

					$seourl_check = '1';

				}

				$urlCount = $duplicate_url->num_rows();

				while ($seourl_check == '0'){

					$urlCount++;

					$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$seourl));

					if ($duplicate_url->num_rows()>0){

						$seourl = $seourlBase.'-'.$urlCount;

					}else {

						$seourl_check = '1';

					}

				}

				

				

				$data['slug'] = $seourl;



	            $data['slug'] = url_title($data['name'], 'dash', true);

	            $data['ui_order'] = $data['ui_order'];

				$data['parent_id'] = $data['parent_id'];
                
                $meta_title = $this->input->post('meta_title');
                $meta_keyword = $this->input->post('meta_keyword');
                $meta_description = $this->input->post('meta_description');
                
                $data['meta_title'] = ($meta_title)?$meta_title:$data['name'];
	            $data['meta_keyword'] = ($meta_keyword)?$meta_keyword:$data['name'];
                $data['meta_description'] = ($meta_description)?$meta_description:$data['name'];
                 
	            
	            $insert = $this->Dashboard_Model->common_insert($data,'category');

	            //echo $this->db->last_query();die;

    	            if($insert) {

    	                $this->session->set_flashdata('success','Category Data Insert Successfully!!');

                        redirect('admin/add-category');

    	            } else {

    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                        redirect('admin/add-category');

    	            }

	            

	        }else {

	        	$rows = $this->common_model->get_all_details_query('category',' WHERE parent_id = 0 order by ui_order')->result();;

	        	$data['maincategory'] = $rows;

	        	//$data['maincategory'] = $this->Dashboard_Model->common_all('category');



            $this->load->view('admin/template/header');

            $this->load->view('admin/category/form',$data);

            $this->load->view('admin/template/footer');

	    }

   }

   public function fetch() {

     

		$tbl_name = 'category';

		 

		

		$selectSubcatval 	=  $this->common_model->get_all_details_query($tbl_name,' WHERE '.$tbl_name.'.parent_id = "'.$this->input->get('main_cat_id').'"');

		echo '<option value="">Select a category</option><option value="addnew">Add New</option>';

		if($selectSubcatval->num_rows() > 0){

			foreach($selectSubcatval->result() as $MaincatValues) {

				echo '<option value="'.$MaincatValues->id.'">'.$MaincatValues->name.'</option>'; 

			}

		} else {

		 

			echo 'Nocat';

		}

    }



   public function recursive($tbl_name,$k,$parent_id) {

        $rs = $this->common_model->get_all_details($tbl_name,array('parent_id'=>$parent_id))->result_array();

        if($rs){

            foreach($rs as $key=>$value){

                $rs[$key]['child'] = $this->recursive($tbl_name,$k,$value['id']);

            }

        }else{

            $rs = array();

        }

        return $rs;

    }

	public function categoryEdit($id)

	{

	  if (ctype_digit(strval($id)) ) {

        	$tbl_name = 'category';

        	$data['datas'] = $this->Dashboard_Model->common_row($id,'category');



        	$wh = ' WHERE parent_id = 0 order by ui_order ASC';

	        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();

	        foreach ($rows as $k => $v) {

	            $rs = array();

	            $wh1 = ' WHERE parent_id = '.$v['id'].' order by ui_order ASC';

	            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();

	            $rows[$k]['child'] = $rs;

	            foreach($rs as $k1=>$v1){

	                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);

	            }



	        }

	        $data['catAll'] = $rows;

	        $this->load->view('admin/template/header');

	        $this->load->view('admin/category/edit',$data);

            $this->load->view('admin/template/footer');

	      

	   } else {

	       redirect('admin/category');

	   }

	}

	

	public function categoryUpdate()

	{

	    $this->form_validation->set_rules('name', 'Category', 'required|trim');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    

	    if($this->form_validation->run()) {

	        

	            

    	        $image = $this->uploadSingleImage11('cat_image',"assets/images/cat/");

				if(!empty($image)){

					$data['cat_image'] = $image;

				}



    	        if ($this->input->post('ui_order')) {

    	        	$data['ui_order'] = $this->input->post('ui_order');

	            }

	            if ($this->input->post('parent_id')) {

    	        	$data['parent_id'] = $this->input->post('parent_id');

	            }else{

	            	$data['parent_id'] = 0;

	            }

	            $data['name'] = $this->input->post('name');

	            $data['status']  = $this->input->post('status');

	            $data['updeated_at']  = date('d m Y h:i:s'); 

	            $id = $this->input->post('id');

	            $data['slug'] = url_title($data['name'], 'dash', true);

	            
                $data['meta_description'] = $this->input->post('meta_description');
	            $data['meta_keyword'] = $this->input->post('meta_keyword');
	            $data['meta_title'] = $this->input->post('meta_title');
	            
	            
	            $update = $this->Dashboard_Model->common_update($id,$data,'category');

	            

    	            if($update) {

    	                $this->session->set_flashdata('success','Category Data Update Successfully!!');

                        redirect('admin/category');

    	            } else {

    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                        redirect('admin/category');

    	            }

	        } else {

                    $this->load->view('admin/template/header');

                    $this->load->view('admin/category/form');

                    $this->load->view('admin/template/footer');

	        }

	}

	public function categoryDelete($id)

	{

	        $delete = $this->Dashboard_Model->common_delete($id,'category');

            if($delete) {

                $this->session->set_flashdata('success','Category Data Update Successfully!!');

                redirect('admin/category');

            } else {

                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                redirect('admin/category');

            }

	}

	public function categoryStatusUpdate()

	{

	    $id = $this->input->post('id');

	    $status = $this->input->post('status'); $data = ['status'=>$status];

	    $update = $this->Dashboard_Model->common_update($id,$data,'category');

	    echo $update;

	}

	public function subcategory() {

	    

	    $data['datas'] = $this->db->query("select category.name as category_name,

	                                              subcategory.* FROM subcategory 

	                                              JOIN category ON category.id = subcategory.category")->result();  

	    $this->load->view('admin/template/header');

	    $this->load->view('admin/subcategory/view',$data);

        $this->load->view('admin/template/footer');

	}

	public function subcategoryForm() {

	    

	    $this->form_validation->set_rules('category', 'Category', 'required|trim');

	    $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim|is_unique[subcategory.subcategory]');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');

	    if($this->form_validation->run()) {

	           

	            if($_FILES['sub_cat_image']['name'] !="") {

    	         $config['upload_path'] = './upload/assets/images/cate/'; 

    	         $config['max_size'] = 1024;

                 $config['allowed_types'] = 'jpg|jpeg|png'; 

    	         $this->load->library('upload',$config);

    	         $this->upload->initialize($config);

    	         

    	         if($this->upload->do_upload('sub_cat_image')){

                   $uploadImg = $this->upload->data(); 

                   $data['sub_cat_image'] = $uploadImg['file_name']; 

    	          }  else {

    	              $ierror = $this->upload->display_errors();

    	               $this->session->set_flashdata('imgerror',$ierror);

                       redirect('add-subcategory','refresh');

    	          }

    	        }

	            $data['category'] = $this->input->post('category');

	            $data['is_child'] = $this->input->post('is_child');

	            $data['subcategory'] = $this->input->post('subcategory'); 

	            $data['status']  = $this->input->post('status');

	            $data['created_at']  = date('d m Y h:i:s');

	            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);

	            

	                $insert = $this->Dashboard_Model->common_insert($data,'subcategory');

	            

        	            if($insert) {

        	                $this->session->set_flashdata('success','Subcategory Data Insert Successfully!!');

                            redirect('add-subcategory');

        	            } else {

        	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                            redirect('add-subcategory');

        	            }

	            

	        }else {

	                $all['datas'] = $this->Dashboard_Model->common_all('category');

                    $this->load->view('admin/template/header');

                    $this->load->view('admin/subcategory/form',$all);

                    $this->load->view('admin/template/footer');

	       }

	}

	public function subcategoryEdit($id)

	{   

	    $data['datas'] = $this->Dashboard_Model->common_all('category');

	    $data['single'] = $this->Dashboard_Model->common_row($id,'subcategory');

	    $this->load->view('admin/template/header');

        $this->load->view('admin/subcategory/edit',$data);

        $this->load->view('admin/template/footer');

	}

	public function subcategoryUpdate()

	{

	    $this->form_validation->set_rules('category', 'Category', 'required|trim');

	    $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|trim');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    

	    if($this->form_validation->run()) {

	        

	             if($_FILES['sub_cat_image']['name'] !="") {

    	         $config['upload_path'] = './upload/assets/images/'; 

                 $config['allowed_types'] = 'jpg|jpeg|png'; 

    	         $this->load->library('upload',$config);

    	         $this->upload->initialize($config);

    	         

    	         if($this->upload->do_upload('sub_cat_image')){

                   $uploadImg = $this->upload->data(); 

                   $data['sub_cat_image'] = $uploadImg['file_name']; 

    	          }  else {

    	              //$data['cat_image'] = $this->upload->display_errors();

                     // print_r($data['cat_image']);

    	          }

    	          $data['sub_cat_image'] = $uploadImg['file_name'];

    	          

    	        } else {$data['sub_cat_image'] = $this->input->post('old_img'); }

    	        

	            $data['is_child'] = $this->input->post('is_child');

	            $data['category'] = $this->input->post('category');

	            $data['subcategory'] = $this->input->post('subcategory'); 

	            $data['status']  = $this->input->post('status');

	            $data['updeated_at']  = date('d m Y h:i:s');

	            $data['subcategory_slug'] = url_title($data['subcategory'], 'dash', true);

	            

	            $id = $this->input->post('id');

	               $update = $this->Dashboard_Model->common_update($id,$data,'subcategory');

	            

    	            if($update) {

    	                $this->session->set_flashdata('success','Subategory Data Update Successfully!!');

                        redirect('subcategory');

    	            } else {

    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                        redirect('subcategory');

    	            }

	            

	        }else {

	                $all['datas'] = $this->Dashboard_Model->common_all('category');

                    $this->load->view('admin/template/header');

                    $this->load->view('admin/subcategory/form',$all);

                    $this->load->view('admin/template/footer');

	       }

	}

	public function subcategoryDelete($id)

	{

	    $delete = $this->Dashboard_Model->common_delete($id,'subcategory');

	    if($delete) {

	       $this->session->set_flashdata('success','Subcategory delete successfully');

           redirect('subcategory');

	    } else {

           $this->session->set_flashdata('error','Something Went Wrong');

           redirect('subcategory');

	    }

	}

	public function subcategoryStatusUpdate()

	{

	    $id = $this->input->post('id');

	    $status = $this->input->post('status'); $data = ['status'=>$status];

	    $update = $this->Dashboard_Model->common_update($id,$data,'subcategory');

	    echo $update;

	}

	public function childSubcategory() {

	    

	    $data['datas'] = $this->db->query("select subcategory.subcategory as sub_cat_name,

	                                       childSubcategory.* FROM childSubcategory

	                                       JOIN subcategory ON subcategory.id = childSubcategory.subcategory_id ")->result();  

	    $this->load->view('admin/template/header');

	    $this->load->view('admin/subcategory/childView.php',$data);

        $this->load->view('admin/template/footer');

	}

	public function childSubcategoryForm() {

	    

	    $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');

	    $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');

	    if($this->form_validation->run()) {

	           

	            if($_FILES['child_sub_cat_image']['name'] !="") {

    	         $config['upload_path'] = './upload/assets/images/cate/'; 

    	         $config['max_size'] = 1024;

                 $config['allowed_types'] = 'jpg|jpeg|png'; 

    	         $this->load->library('upload',$config);

    	         $this->upload->initialize($config);

    	         

    	         if($this->upload->do_upload('child_sub_cat_image')){

                   $uploadImg = $this->upload->data(); 

                   $data['child_sub_cat_image'] = $uploadImg['file_name']; 

    	          }  else {

    	              $ierror = $this->upload->display_errors();

    	               $this->session->set_flashdata('imgerror',$ierror);

                       redirect('admin/child-subcategory','refresh');

    	          }

    	        }

	            $data['subcategory_id'] = $this->input->post('subcategory_id');

	            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name'); 

	            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);

	            $data['status']  = $this->input->post('status');

	            $data['created_at']  = date('d m Y h:i:s');

	            

	                $insert = $this->Dashboard_Model->common_insert($data,'childSubcategory');

        	            if($insert) {

        	                $this->session->set_flashdata('success','Child Subcategory Data Insert Successfully!!');

                            redirect('admin/child-subcategory');

        	            } else {

        	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                            redirect('admin/child-subcategory');

        	            }

	        }else {

	                $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();

                    $this->load->view('admin/template/header');

                    $this->load->view('admin/subcategory/childForm.php',$all);

                    $this->load->view('admin/template/footer');

	       }

	}

	public function childSubcategoryEdit($id) {

	    

	    $data['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();

	    $data['single'] = $this->Dashboard_Model->common_row($id,'childSubcategory');

	    $this->load->view('admin/template/header');

        $this->load->view('admin/subcategory/childEdit',$data);

        $this->load->view('admin/template/footer');

	    

	}

	public function childSubcategoryUpdate() {

	    

	    $this->form_validation->set_rules('subcategory_id', 'Sub Category', 'required|trim');

	    $this->form_validation->set_rules('child_sub_cat_name', 'Child SubCategory Name', 'required|trim|is_unique[childSubcategory.child_sub_cat_name]');

	    $this->form_validation->set_rules('status', 'Status', 'required|trim');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    $this->form_validation->set_rules('is_unique', 'The %s entered is already exist');

	    if($this->form_validation->run()) {

	           

	             /*if($_FILES['child_sub_cat_image']['name'] !="") {

    	         $config['upload_path'] = './upload/assets/images/cate/'; 

                 $config['allowed_types'] = 'jpg|jpeg|png'; 

    	         $this->load->library('upload',$config);

    	         $this->upload->initialize($config);

    	         

    	         if($this->upload->do_upload('child_sub_cat_image')){

                   $uploadImg = $this->upload->data(); 

                   $data['child_sub_cat_image'] = $uploadImg['file_name']; 

    	          }  else {

    	              //$data['cat_image'] = $this->upload->display_errors();

                     // print_r($data['cat_image']);

    	          }

    	          $data['child_sub_cat_image'] = $uploadImg['file_name'];

    	          

    	        } else {$data['child_sub_cat_image'] = $this->input->post('old_img'); }*/

    	        $image = $this->uploadSingleImage11('cat_image',"assets/images/cat/");
				if(!empty($image)){
					$data['cat_image'] = $image;
				}
    	        $id = $this->input->post('id');

	            $data['subcategory_id'] = $this->input->post('subcategory_id');

	            $data['child_sub_cat_name'] = $this->input->post('child_sub_cat_name'); 

	            $data['child_sub_cat_slug'] = url_title($data['child_sub_cat_name'], 'dash', true);

	            $data['status']  = $this->input->post('status');

	            $data['updeated_at']  = date('d m Y h:i:s');

	            

	            $update = $this->Dashboard_Model->common_update($id,$data,'childSubcategory');

	                

	            if($update) {

	                $this->session->set_flashdata('success','Child Subcategory Data Update Successfully!!');

                    redirect('admin/child-subcategory');

	            } else {

	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                    redirect('admin/child-subcategory');

	            }

	        }else {

	                $all['datas'] = $all['datas'] = $this->db->get_where('subcategory', ['is_child'=>1])->result();

                    $this->load->view('admin/template/header');

                    $this->load->view('admin/subcategory/childForm.php',$all);

                    $this->load->view('admin/template/footer');

	       }



	}

	public function childSubcategoryDelete($id) {

	    

	    $delete = $this->Dashboard_Model->common_delete($id,'childSubcategory');

	   if($delete) {

	       $this->session->set_flashdata('success','Child Subcategory delete successfully');

           redirect('admin/child-subcategory');

	   } else {

           $this->session->set_flashdata('error','Something Went Wrong');

           redirect('admin/child-subcategory');

	   }

	}

	public function childSubcategoryStatusUpdate() {

	    $id = $this->input->post('id');

	    $status = $this->input->post('status'); $data = ['status'=>$status];

	    $update = $this->Dashboard_Model->common_update($id,$data,'childSubcategory');

	    echo $update;

	}

	public function contactUs(){
		//$all['datas'] = $this->Dashboard_Model->common_all('contact-us');
		//$this->db->order_by("id", "desc");
		//$all['datas'] = $this->db->get_where('contact-us', ['form_name'=>'contact'])->result();
		
		$this->db->select("*");
		$this->db->where("form_name",'contact');
		$this->db->order_by("id", "desc");
		$q=$this->db->get("contact-us");



		$all['datas'] = $q->result();
		

		$this->load->view('admin/template/header');

		$this->load->view('admin/page/contact-view',$all);

		$this->load->view('admin/template/footer');

	}
	public function storyblogcomment(){
		//$this->db->order_by("id", "desc");
		//$all['datas'] = $this->db->get_where('contact-us', ['form_name'=>'contact'])->result();
		
		$this->db->select("*");
		$this->db->where("form_name",'Blog Form');
		$this->db->order_by("id", "desc");
		$q=$this->db->get("contact-us");
		$all['datas'] = $q->result();
		$this->load->view('admin/template/header');
		$this->load->view('admin/page/blog-view',$all);
		$this->load->view('admin/template/footer');
	}
    public function blogDelete($id){

	   $delete = $this->Dashboard_Model->common_delete($id,'contact-us');

            if($delete) {

                $this->session->set_flashdata('success','Data delete Successfully!!');

                redirect('admin/story-blog-comment');

            } else {

                $this->session->set_flashdata('error','Something Went Wrong, try again!!');

                redirect('admin/story-blog-comment');

            }

	}
	function blogStatusUpdate(){
        $tbl_name = 'contact-us';
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['status'=>$status];
        $update = $this->common_model->commonUpdate($tbl_name,$data,array('id'=>$id));
        echo $update;
    }

	public function askQuote(){	
		$this->getPermission('admin/collaborate');
		$this->db->select("*");
		$this->db->order_by("id", "desc");
		$q=$this->db->get("ask_quote_lead");
		$all['datas'] = $q->result();
     	$this->load->view('admin/template/header');
     	$this->load->view('admin/page/ask-quote-view',$all);
     	//$this->load->view('admin/template/footer');
	}
	/*public function export(){
        $filename = 'register_stylist_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
       
        $tbl_name = 'ask_quote_lead';
        //$str = " WHERE id != '0' ";
        //$str = " order by id desc";
        $query = $this->db->query('SELECT name,phone,message FROM '.$tbl_name);
        $usersData = $query->result_array();
        print_r($usersData);die;
        $file = fopen('php://output', 'w');
        $header = array("First Name","Phone","Message); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }*/

	public function askQuoteDelete($id){
		$this->getPermission('admin/Dashboard/collaborateUsDelete');
	   	$delete = $this->Dashboard_Model->common_delete($id,'ask_quote_lead');
        if($delete) {
            $this->session->set_flashdata('success','Data delete Successfully!!');
            redirect('admin/ask-quote-form');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/ask-quote-form');
        }
	}
	
	public function collaborateUs(){	
		$this->getPermission('admin/collaborate');
		$this->db->select("*");
		$this->db->where("form_name",'collaborate');
		$this->db->order_by("id", "desc");
		$q=$this->db->get("contact-us");
		$all['datas'] = $q->result();
     	$this->load->view('admin/template/header');
     	$this->load->view('admin/page/collaborate-view',$all);
     	//$this->load->view('admin/template/footer');
	}

	public function collaborateUsDelete($id){
		$this->getPermission('admin/Dashboard/collaborateUsDelete');
	   	$delete = $this->Dashboard_Model->common_delete($id,'contact-us');
        if($delete) {
            $this->session->set_flashdata('success','Data delete Successfully!!');
            redirect('admin/collaborate');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/collaborate');
        }
	}

	public function registerUser(){

		/*$condition = " WHERE user_type != 3  order by id ASC ";

        $r = $this->common_model->get_all_details_query('vender',$condition)->result();

        $date = '';

        foreach ($r as $key => $value) {

            echo $value->updated_at;

        		if ($value->updated_at) {

					$date =  $value->updated_at;

					 

				}

				$d = substr($date, 0,2);

				$m = substr($date, 3,2);

				$y = substr($date, 6,4);

				$t = substr($date, -8);

				$s['created_at1'] = $y.'-'.$m.'-'.$d.' '.$t;

				$s['created_at1'] = $value->created_at;;

				$r = $this->common_model->commonUpdate('vender',$s,array('id'=>$value->id));

				echo $this->db->last_query();

        }*/



		$condition = " WHERE user_type = 3 order by id desc ";

        $r = $this->common_model->get_all_details_query('vender',$condition)->result();

        //echo $this->db->last_query();

        $all['datas'] = $r;

	     	//$all['datas'] = $this->Dashboard_Model->common_all('vender');

        $this->load->view('admin/template/header');

        $this->load->view('admin/page/registeruser',$all);

        $this->load->view('admin/template/footer');

	}

	public function userStatusUpdate()

    {

        $id = $this->input->post('id');

	    $status = $this->input->post('status'); $data = ['status'=>$status];

	    $update = $this->Dashboard_Model->common_update($id,$data,'vender');

	    echo $update;

    }

}