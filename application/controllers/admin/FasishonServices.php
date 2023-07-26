<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FasishonServices extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('common_model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	public function fasihon()
	{
	     $data['datas'] = $this->Dashboard_Model->common_all('fashion_services');
         $this->load->view('admin/template/header');
         $this->load->view('admin/FasihonServices/view',$data);
         $this->load->view('admin/template/footer');   
	}
	public function fasihonForm()
	{
	    $this->form_validation->set_rules('name', 'Fashion Services', 'required|trim');
	    $this->form_validation->set_rules('content', 'Fashion Services Data', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	  
	    if($this->form_validation->run()) {
	            
	            if($_FILES['main_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/services/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('main_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['main_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect('admin/add-fashion-services','refresh');
    	          }
    	        }
    	        
    	        if($_FILES['details_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/services/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('details_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['details_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect('admin/add-fashion-services','refresh');
    	          }
    	        }

    	        $data['name'] = $this->input->post('name'); 
	            $data['content'] = $this->input->post('content');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d-m-Y h:i:s'); 
	           
	            $insert = $this->Dashboard_Model->common_insert($data,'fashion_services');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Fashion Services Data Insert Successfully!!');
                        redirect('admin/add-fashion-services');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-fashion-services');
    	            }
	        } else {
	            $this->load->view('admin/template/header');
                $this->load->view('admin/FasihonServices/form');
                $this->load->view('admin/template/footer');   
	        }
	}
	public function fasihonEdit($id)
	{
	     $data['datas'] = $this->Dashboard_Model->common_row($id,'fashion_services');
         $this->load->view('admin/template/header');
         $this->load->view('admin/FasihonServices/edit',$data);
         $this->load->view('admin/template/footer');   
	}
	public function fasihonUpdate()
	{
	    $this->form_validation->set_rules('name', 'Fashion Services', 'required|trim');
	    $this->form_validation->set_rules('content', 'Fashion Services Data', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    $id = $this->input->post('id');
	    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/services/';
	            $image = $this->uploadSingleImageOnly('main_image',$this->uploadPath);
	            if(!empty($image)){
	                $data['main_image'] = $image;
	            }
	            $image = $this->uploadSingleImageOnly('details_image',$this->uploadPath);
	            if(!empty($image)){
	                $data['details_image'] = $image;
	            }
	            
	             
    	        $data['name'] = $this->input->post('name'); 
	            $data['content'] = $this->input->post('content');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d-m-Y h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_update($id,$data,'fashion_services');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Fashion Services Data Update Successfully!!');
                        redirect('admin/fashion-services');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/fashion-services');
    	            }
	        } else {
	           redirect("admin/our-services",'refresh');
	        }
	}
	public function fasihonDelete($id)
	{
	     $delete = $this->Dashboard_Model->common_delete($id,'fashion_services');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Fashion Services Data delete successfully');
               redirect('admin/fashion-services');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/fashion-services');
    	   }
	}
	public function fasihonStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'fashion_services');
	    echo $update;   
	}
	public function looking_stylist()
	{	$this->getPermission('admin/looking-stylist');
	    $data['datas'] = $this->Dashboard_Model->common_all('area_expertise_looking');
        $this->load->view('admin/FasihonServices/stylist-view',$data);
	}
    public function looking_stylist_add()
	{	$this->getPermission('admin/looking-stylist/add');
		if ($this->input->post('title')) {

		    $this->form_validation->set_rules('title', 'Expertise / Interests Name', 'required|trim|is_unique[area_expertise.title]');
		    $this->form_validation->set_rules('status', 'Status', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another Name'); 
		    
		    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/stylist/';

		        $data['title'] = $this->input->post('title');
		        $data['title_develop'] = $this->input->post('title_develop');  
		        $data['sub_title'] = $this->input->post('sub_title'); 
	            $data['slug'] = $slug = url_title($data['title'], 'dash', true);
	            $data['description'] = $this->input->post('description');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	           	$image = $this->uploadSingleImageOnly('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }
	            $data['meta_title'] = $this->input->post('meta_title'); 
		        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
		        $data['meta_description'] = $this->input->post('meta_description'); 
	            $update = $this->Dashboard_Model->common_insert($data,'area_expertise_looking');
	            
	            if($update) {
	                $this->session->set_flashdata('success','Stylist Expertise / Interests  Data Insert Successfully!!');
	                redirect('admin/looking-stylist');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	                redirect('admin/looking-stylist');
	            }
	        } else {
	        	
	        }
        }
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        $this->load->view('admin/FasihonServices/stylist-add',$style);
	}
	public function looking_stylist_edit($id)
	{	$this->getPermission('admin/looking-stylist/edit');
		if ($this->input->post('title')) {
		    $this->form_validation->set_rules('title', 'Expertise / Interests', 'required|trim');
		    $this->form_validation->set_rules('status', 'Status', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    
		    $id = $this->input->post('id');

		    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/stylist/';
		        $data['title'] = $this->input->post('title'); 
		        $data['title_develop'] = $this->input->post('title_develop'); 
		        $data['sub_title'] = $this->input->post('sub_title'); 
	           
	            $data['description'] = $this->input->post('description');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	           	$image = $this->uploadSingleImageOnly('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }

	            if(!empty($this->input->post('expertise'))) { 
                    $data['expertise'] = $arrayVal = implode(',',$this->input->post('expertise')); 
                    $values = ""; 
                    $arrayVal = $this->input->post('expertise');        
                    $expertises =  $this->db->get_where('area_expertise',['status'=>1])->result();
                    foreach ($expertises as $expertise) { 
                        if( in_array($expertise->id , $arrayVal)) {  $values .= ", $expertise->name"; }
                    }
                    $stylist = substr($values,1);    
                }
                $data['meta_title'] = $this->input->post('meta_title'); 
		        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
		        $data['meta_description'] = $this->input->post('meta_description'); 
	            $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise_looking');
	            //echo $this->db->last_query();
	            //die;
	            if($update) {
	                $this->session->set_flashdata('success','Stylist Expertise / Interests  Data Update Successfully!!');
                    redirect('admin/looking-stylist');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/looking-stylist');
	            }
	        }
	    }
	    $data['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
	    $data['datas'] = $this->Dashboard_Model->common_row($id,'area_expertise_looking');
	    if(!empty($data['datas'])) {
            $this->load->view('admin/FasihonServices/stylist-edit',$data);    
        } else {
             //redirect('admin/looking-stylist');
        }
	}
	public function looking_stylist_delete($id)
	{		$this->getPermission('admin/looking-stylist/delete');
	       	$delete = $this->Dashboard_Model->common_delete($id,'area_expertise_looking');
    	   	if($delete) {
    	       $this->session->set_flashdata('success','Stylist Expertise / Interests Data delete successfully');
               redirect('admin/looking-stylist');
    	   	} else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/looking-stylist');
    	   	}
	}
	public function looking_stylist_delete_status()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise_looking');
	    echo $update;   
	}
    public function stylist(){
    		$this->getPermission('admin/stylist-expertise-interests');
	     $data['datas'] = $this->Dashboard_Model->common_all('area_expertise');
         $this->load->view('admin/FasihonServices/stylistView',$data);
	}

	public function stylistForm()
	{	$this->getPermission('admin/stylist-expertise-interests/add');
	    $this->form_validation->set_rules('name', 'Expertise / Interests Name', 'required|trim|is_unique[area_expertise.name]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another Name'); 
	    
	    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/stylist/';
    	        $data['name'] = $this->input->post('name'); 
    	        //$data['title'] = $this->input->post('title'); 
    	        $data['sub_title'] = $this->input->post('sub_title'); 
	            $data['slug'] = $slug = url_title($data['name'], 'dash', true);
	            $data['description'] = $this->input->post('description');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	           	$image = $this->uploadSingleImageOnly('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }
	            $image = $this->uploadSingleImageOnly('icon_image',$this->uploadPath);
	            if(!empty($image)){
	                $data['icon_image'] = $image;
	            }
	            $update = $this->Dashboard_Model->common_insert($data,'area_expertise');
	            
	            if($update) {
	                $this->session->set_flashdata('success','Stylist Expertise / Interests  Data Insert Successfully!!');
                    redirect('admin/add-stylist-expertise-interests');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/add-stylist-expertise-interests');
	            }
	        } else {
	           $this->load->view('admin/FasihonServices/stylistForm');
	        }
	}
	public function stylistEdit($id)
	{	$this->getPermission('admin/stylist-expertise-interests/edit');
	    $data['datas'] = $this->Dashboard_Model->common_row($id,'area_expertise');
         if(!empty($data['datas'])) {
            $this->load->view('admin/FasihonServices/stylistEdit',$data);    
         } else {
             redirect('admin/stylist-expertise-interests');
         }
	}
	public function stylistUpdate()
	{
        $this->form_validation->set_rules('name', 'Expertise / Interests', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    $id = $this->input->post('id');
	    if($this->form_validation->run()) {
            $this->uploadPath = 'assets/images/stylist/';
	        $data['name'] = $this->input->post('name'); 
	        $data['sub_title'] = $this->input->post('sub_title'); 
            $data['description'] = $this->input->post('description');
            $data['status']  = $this->input->post('status');
            $data['updated_at']  = date('d-m-Y h:i:s'); 
           	$image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }
            $image = $this->uploadSingleImageOnly('icon_image',$this->uploadPath);
            if(!empty($image)){
                $data['icon_image'] = $image;
            }
            $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise');
            if($update) {
                $this->session->set_flashdata('success','Stylist Expertise / Interests  Data Update Successfully!!');
                redirect('admin/stylist-expertise-interests');
            } else {
                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                redirect('admin/stylist-expertise-interests');
            }
        } else {
           redirect("admin/edit-stylist-expertise-interests/$id",'refresh');
        }
	}
	public function stylistDelete($id)
	{		$this->getPermission('admin/stylist-expertise-interests/delete');
	       $delete = $this->Dashboard_Model->common_delete($id,'area_expertise');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Stylist Expertise / Interests Data delete successfully');
               redirect('admin/stylist-expertise-interests');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/stylist-expertise-interests');
    	   }
	}
	public function stylistStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise');
	    echo $update;   
	}
    // THEME \\
	public function manageTheme()
	{
	     $data['datas'] = $this->Dashboard_Model->common_all('theme');
         $this->load->view('admin/template/header');
         $this->load->view('admin/FasihonServices/themeView',$data);
         $this->load->view('admin/template/footer');      
	}
	public function addTheme()
	{
        $this->form_validation->set_rules('question', 'Question', 'required|trim');
	    $this->form_validation->set_rules('answer', 'Answer', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	  
	    if($this->form_validation->run()) {

    	        $data['question'] = $this->input->post('question'); 
	            $data['answer'] = $this->input->post('answer');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 
	           
	            $insert = $this->Dashboard_Model->common_insert($data,'theme');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Theme Data Insert Successfully!!');
                        redirect('admin/add-theme');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-theme');
    	            }
	        } else {
	            $this->load->view('admin/template/header');
                $this->load->view('admin/FasihonServices/themeForm');
                $this->load->view('admin/template/footer');   
	        }   	    
	}
	public function editTheme($id)
	{
	     $data['datas'] = $this->Dashboard_Model->common_row($id,'theme');
         if(!empty($data['datas'])) {
            $this->load->view('admin/FasihonServices/themeEdit',$data);    
         } else {
             redirect('admin/manage-theme');
         }
	}
	public function updateTheme()
	{
        $this->form_validation->set_rules('question', 'Question', 'required|trim');
	    $this->form_validation->set_rules('answer', 'Answer', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	     $id = $this->input->post('id'); 
	    if($this->form_validation->run()) {

    	        $data['question'] = $this->input->post('question'); 
	            $data['answer'] = $this->input->post('answer');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_update($id,$data,'theme');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Theme Data Update Successfully!!');
                        redirect('admin/manage-theme');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/manage-theme');
    	            }
	        } else {
	                redirect("admin/manage-theme/$id");
	        }   	    
	}
	public function deleteTheme($id)
	{
	     $delete = $this->Dashboard_Model->common_delete($id,'theme');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Theme Data delete successfully');
               redirect('admin/manage-theme');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/manage-theme');
    	   }
	}
	public function updateThemeStatus()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'theme');
	    echo $update;   
	}
	public function service(){
		$this->getPermission('admin/our-services');
	    $data['datas'] = $this->Dashboard_Model->common_all('our_services');
        $this->load->view('admin/FasihonServices/serviceView',$data);
	}
	public function serviceForm(){
		$this->getPermission('admin/our-services/add');	
		$postData = $this->input->post();
        if ($postData) {
		    $this->form_validation->set_rules('title', 'Service Title', 'required|trim');
		    $this->form_validation->set_rules('status', 'Status', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/services/';
	            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }

		        $mrp_price = $this->input->post('mrp_price');
		        $discount = $this->input->post('discount');
	            
	             
	            
	            //if ($mrp_price) {
	            	$data['mrp_price'] = $mrp_price;
	            	$data['price'] = $mrp_price;
	            	$data['discount'] = 0;
	            	if ($discount) {
			            $data['discount'] = $discount;
			            $price = (int)($mrp_price - ($mrp_price * $discount * .01));
			            $data['price'] = $price;
		            }
	            //}


		        $data['title'] = $this->input->post('title'); 
		        $data['slug'] = url_title( $data['title'], 'dash', true);
	            $data['short_description'] = $this->input->post('short_description');
	            $data['description_top'] = $this->input->post('description_top');
	            //$data['description_middle'] = $this->input->post('description_middle');
	            $data['description_bottom'] = $this->input->post('description_bottom');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 

	            $accordian = array();
	           	$accordian['ac_title'] = $this->input->post('ac_title');
	           	$accordian['ac_description'] = $this->input->post('ac_description');
	           	$data['description_middle'] = json_encode($accordian);
                
                $data['sub_title'] = $this->input->post('sub_title'); 
		        $data['section1'] = $this->input->post('section1'); 
	           	$data['section3'] = $this->input->post('section3'); 

    
	           	$data['section2'] = $this->input->post('section2'); 
	            $data['right_section2'] = $this->input->post('right_section2'); 
	            $data['left_section2'] = $this->input->post('left_section2'); 
	            
	            $data['right_section1'] = $this->input->post('right_section1'); 
	            $data['left_section1'] = $this->input->post('left_section1'); 

	            $data['meta_title'] = $this->input->post('meta_title'); 
		        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
		        $data['meta_description'] = $this->input->post('meta_description'); 
	            $insert = $this->Dashboard_Model->common_insert($data,'our_services');
	            
	            if($insert) {
	                $this->session->set_flashdata('success','Our Services Data Insert Successfully!!');
	                redirect('admin/our-services');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	            }
	        }
	    }
        $data['datas'] = array();
        $this->load->view('admin/FasihonServices/serviceAddEdit',$data); 
	}
	
	public function serviceEdit($id){
		$this->getPermission('admin/our-services/edit');
        $result_data['datas'] = $this->Dashboard_Model->common_row($id,'our_services');
        if(empty($result_data['datas'])) {
         	redirect('admin/our-services');
        }else{
         	$postData = $this->input->post();
         	if ($postData) {
         		$this->form_validation->set_rules('title', 'Service Title', 'required|trim');
			    $this->form_validation->set_rules('status', 'Status', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			  
			    $id = $this->input->post('id');
			    if($this->form_validation->run()) {
		            $this->uploadPath = 'assets/images/services/';
		            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
		            if(!empty($image)){
		                $data['image'] = $image;
		            }

		            $data['sub_title'] = $this->input->post('sub_title'); 
			        $data['section1'] = $this->input->post('section1'); 
		           	$data['section3'] = $this->input->post('section3'); 

			        $data['title'] = $this->input->post('title'); 
			       
			       	$mrp_price = $this->input->post('mrp_price');
			        $discount = $this->input->post('discount');
		            
		            //if ($mrp_price) {
		            	$data['mrp_price'] = $mrp_price;
		            	$data['price'] = $mrp_price;
		            	$data['discount'] = 0;
		            	if ($discount) {
				            $data['discount'] = $discount;
				            $price = (int)($mrp_price - ($mrp_price * $discount * .01));
				            $data['price'] = $price;
			            }
		            //}
		            


		            $data['short_description'] = $this->input->post('short_description');
		            $data['description_top'] = $this->input->post('description_top');
		            //$data['description_middle'] = $this->input->post('description_middle');
		            $data['description_bottom'] = $this->input->post('description_bottom');
		            $data['status']  = $this->input->post('status');
		            $data['updated_at']  = date('Y-m-d h:i:s'); 
		           
		           	$accordian = array();
		           	$accordian['ac_title'] = $this->input->post('ac_title');
		           	$accordian['ac_description'] = $this->input->post('ac_description');
		           	$data['description_middle'] = json_encode($accordian);

		            $data['section2'] = $this->input->post('section2'); 
		            $data['right_section2'] = $this->input->post('right_section2'); 
		            $data['left_section2'] = $this->input->post('left_section2'); 
		            
		            $data['right_section1'] = $this->input->post('right_section1'); 
		            $data['left_section1'] = $this->input->post('left_section1'); 
		           
		            $data['meta_title'] = $this->input->post('meta_title'); 
			        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
			        $data['meta_description'] = $this->input->post('meta_description'); 

			        $update = $this->common_model->commonUpdate('our_services',$data,array('id'=>$id));
		            //echo $this->db->last_query();
		             
		            if($update) {
		                $this->session->set_flashdata('success','Our Services Data Update Successfully!!');
		                redirect('admin/our-services');
		            } else {
		                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
		                redirect('admin/our-services');
		            }
		        } else {
		            redirect("admin/edit-our-services/$id");       
		        }
         	}
            $this->load->view('admin/FasihonServices/serviceAddEdit',$result_data);    
        }  
	}
	public function serviceDelete($id){
		$this->getPermission('admin/our-services/delete');
	    $delete = $this->Dashboard_Model->common_delete($id,'our_services');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Our Services Data delete successfully');
               redirect('admin/our-services');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/our-services');
    	   }
	}
	public function serviceStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'our_services');
	    echo $update;   
	}
	public function personalStylistForm()
	{
	    $this->form_validation->set_rules('top_content', 'Top Content', 'required|trim');
	    $this->form_validation->set_rules('last_content', 'Last Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[personal_stylist.title]');
        $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	  
	    if($this->form_validation->run()) {

	            if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/stylist/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect('admin/add-personal-stylist','refresh');
    	          }
    	        }
    	        
    	        if($_FILES['last_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/stylist/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('last_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['last_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect('admin/add-personal-stylist','refresh');
    	          }
    	        }
    	        $data['title'] = $this->input->post('title');
    	        $data['slug'] = url_title($data['title'], 'dash', true);
    	        $data['top_content'] = $this->input->post('top_content'); 
	            $data['col_1_data'] = $this->input->post('col_1_data');
	            $data['col_2_data'] = $this->input->post('col_2_data');
	            $data['col_3_data'] = $this->input->post('col_3_data');
	            $data['col_4_data'] = $this->input->post('col_4_data');
	            $data['col_5_data'] = $this->input->post('col_5_data');
	            $data['col_6_data'] = $this->input->post('col_6_data');
	            $data['last_content'] = $this->input->post('last_content');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 
	           
	            $insert = $this->Dashboard_Model->common_insert($data,'personal_stylist');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Personal Stylist Data Insert Successfully!!');
                        redirect('admin/add-personal-stylist');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-personal-stylist');
    	            }
	        } else {
	            $data['cities'] = $this->db->get('cities')->result();
	            $this->load->view('admin/FasihonServices/personalStylistForm',$data);
	        }
	}
	public function personalStylist()
	{
	    $data['datas'] = $this->Dashboard_Model->common_all('personal_stylist');
        $this->load->view('admin/FasihonServices/personalStylistView',$data);
	}
	public function personalStylistEdit($id)
	{     
	     $data['cities'] = $this->db->get('cities')->result();
	     $data['datas'] = $this->Dashboard_Model->common_row($id,'personal_stylist');
         if(!empty($data['datas'])) {
            $this->load->view('admin/FasihonServices/personalStylistEdit',$data);    
         } else {
             redirect('admin/personal-stylist');
         }  
	}
	public function personalStylistUpdate()
	{
	    $this->form_validation->set_rules('top_content', 'Top Content', 'required|trim');
	    $this->form_validation->set_rules('last_content', 'Last Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	     
	    $id = $this->input->post('id');      
	    if($this->form_validation->run()) {

	            if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/stylist/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect("admin/edit-personal-stylist/$id",'refresh');
    	          }
    	        } else {$data['image'] = $this->input->post('old_image');}
    	        
    	        if($_FILES['last_image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/stylist/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('last_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['last_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect("admin/add-personal-stylist/$id",'refresh');
    	          }
    	        }else {$data['last_image'] = $this->input->post('old_last_image');}
    	        
    	        $data['title'] = $this->input->post('title');
    	        $data['slug'] = url_title($data['title'], 'dash', true);
    	        $data['top_content'] = $this->input->post('top_content'); 
	            $data['col_1_data'] = $this->input->post('col_1_data');
	            $data['col_2_data'] = $this->input->post('col_2_data');
	            $data['col_3_data'] = $this->input->post('col_3_data');
	            $data['col_4_data'] = $this->input->post('col_4_data');
	            $data['col_5_data'] = $this->input->post('col_5_data');
	            $data['col_6_data'] = $this->input->post('col_6_data');
	            $data['last_content'] = $this->input->post('last_content');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('Y-m-d h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_update($id,$data,'personal_stylist');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Personal Stylist Data Update Successfully!!');
                        redirect('admin/personal-stylist');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/personal-stylist');
    	            }
	        } else {
	            $data['cities'] = $this->db->get('cities')->result();
	            $this->load->view('admin/FasihonServices/personalStylistForm',$data);
	        }
	}
	public function personalStylistDelete($id)
	{
	    $delete = $this->Dashboard_Model->common_delete($id,'personal_stylist');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Personal Stylist Data delete successfully');
               redirect('admin/personal-stylist');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/personal-stylist');
    	   }
	}
	public function personalStylistStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'personal_stylist');
	    echo $update; 
	}
	public function consultingForm()
	{   
	    $this->form_validation->set_rules('service_id', 'Service', 'required|trim|is_unique[fashon_consulting.service_id]');
	    $this->form_validation->set_rules('price', 'Service Price', 'required|trim');
	    $this->form_validation->set_rules('time', 'Service Time', 'required|trim');
	    $this->form_validation->set_rules('content', 'Service Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another Name'); 
	  
	    if($this->form_validation->run()) {
	            
    	        if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/services/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect('admin/add-fashion-consulting-services','refresh');
    	          }
    	        }
    	        $data['time'] = $this->input->post('time'); 
    	        $data['price'] = $this->input->post('price'); 
    	        $data['service_id'] = $this->input->post('service_id'); 
	            $data['content'] = $this->input->post('content');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d-m-Y h:i:s'); 
	           
	            $insert = $this->Dashboard_Model->common_insert($data,'fashon_consulting');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','fashion consulting services Data Insert Successfully!!');
                        redirect('admin/add-fashion-consulting-services');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-fashion-consulting-services');
    	            }
	        } else {
	            $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result();
	            $this->load->view('admin/FasihonServices/consultingServiceForm',$data);
	       }
	}
	public function consulting()
	{
	    $this->db->select('fashon_consulting.*,our_services.title');
        $this->db->from('fashon_consulting');
        $this->db->join('our_services', 'our_services.id = fashon_consulting.service_id');
        //$this->db->where('table1.col1', 2);
        $data['datas'] = $this->db->get()->result();
        $this->load->view('admin/FasihonServices/consultingServiceView',$data);
	}
	public function consultingEdit($id)
	{
        
        $data['datas'] = $this->Dashboard_Model->common_row($id,'fashon_consulting');
        $data['services'] = $this->db->get_where('our_services',['status'=> 1])->result();   
        
        if(!empty($data['datas'])) {
            $this->load->view('admin/FasihonServices/consultingServiceEdit',$data);   
         } else {
             redirect('admin/fashion-consulting-services');
         }  
	}
	public function consultingUpdate()
	{
	    $this->form_validation->set_rules('service_id', 'Fashion Service', 'required|trim');
	    $this->form_validation->set_rules('price', 'Service Price', 'required|trim');
	    $this->form_validation->set_rules('time', 'Service Time', 'required|trim');
	    $this->form_validation->set_rules('content', 'Service Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    $id = $this->input->post('id'); 
	    if($this->form_validation->run()) {
	            
    	        if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/services/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	              $this->session->set_flashdata('imgerror',$ierror);
                      redirect("admin/edit-fashion-consulting-services/$id",'refresh');
    	          }
    	        } else { $data['image'] = $this->input->post('old_image'); }
    	        
    	        $data['time'] = $this->input->post('time'); 
    	        $data['price'] = $this->input->post('price'); 
    	        $data['service_id'] = $this->input->post('service_id'); 
	            $data['content'] = $this->input->post('content');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_update($id,$data,'fashon_consulting');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','fashion consulting services Data Update Successfully!!');
                        redirect('admin/fashion-consulting-services');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/fashion-consulting-services');
    	            }
	        } else {
	            redirect("admin/edit-fashion-consulting-services/$id");
	       }
	}
	public function consultingDelete($id)
	{
	    $delete = $this->Dashboard_Model->common_delete($id,'fashon_consulting');
    	   if($delete) {
    	       $this->session->set_flashdata('success','fashion consulting services Data delete successfully');
               redirect('admin/fashion-consulting-services');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/fashion-consulting-services');
    	   }
	}
	public function consultingStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'fashon_consulting');
	    echo $update; 
	}
	public function uploadSingleImageOnly($filename,$path){
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
             
            $p = str_replace('assets/images/','',$path);
            //return trim($p.$ImageName);
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
                    $t =  time();
                    $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
                    $targetFile = $path . $fileName_ ;
                    move_uploaded_file($tempFile, $targetFile);
                     
                    $p = str_replace('assets/images/','',$path);
                    //$ImageName .= ','.$p.$fileName_;
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
                $t =  time();
                $ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];
                $targetFile = $path . $ImageName ;
                move_uploaded_file($tempFile, $targetFile);
                $p = str_replace('assets/images/','',$path);  
                //return trim($p.$ImageName);
                return trim($ImageName);
            }
        }
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
             
            $p = str_replace('assets/images/','',$path);
            return trim($p.$ImageName);
            //return trim($ImageName);
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
                     
                    $p = str_replace('assets/images/','',$path);
                    $ImageName .= ','.$p.$fileName_;
                    //$ImageName .= ','.$fileName_;
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
                $p = str_replace('assets/images/','',$path);  
                return trim($p.$ImageName);
                //return trim($ImageName);
            }
        }
    }
    public function looking_stylist_city_session($id){
         
        $this->session->set_userdata('looking_stylist_city_session',$id);
	    redirect(base_url('admin/looking-stylist-city'));
	}
    public function looking_stylist_city(){
        if(!$this->session->userdata('looking_stylist_city_session')){
            redirect(base_url('admin/looking-stylist'));
        }
        $data['cities'] = $this->db->get_where('cities',['footer_ui_status'=>1])->result();
	    $data['datas'] = $datas  =  $this->common_model->get_all_details('area_expertise_looking_city',array('area_expertise_looking_id'=> $this->session->userdata('looking_stylist_city_session')))->result();

	    $data['experiseRow'] = $this->Dashboard_Model->common_row($this->session->userdata('looking_stylist_city_session'),'area_expertise_looking');
	    $this->load->view('admin/FasihonServices/stylist-city-view',$data);
	}
    public function looking_stylist_city_add(){
		if ($this->input->post('title')) {
		    $this->form_validation->set_rules('description', 'Enter Description', 'required|trim|is_unique[area_expertise.title]');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
	            $data['title'] = $this->input->post('title');
		        $data['sub_title'] = $this->input->post('sub_title'); 
		        $data['city_id'] = $this->input->post('city_id'); 
		        $data['area_expertise_looking_id'] = $this->session->userdata('looking_stylist_city_session'); 
	            $data['description'] = $this->input->post('description');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	           	$update = $this->Dashboard_Model->common_insert($data,'area_expertise_looking_city');
	            if($update) {
	                $this->session->set_flashdata('success','Stylist Expertise Insert Successfully!!');
	                redirect('admin/looking-stylist-city');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	                redirect('admin/looking-stylist-city');
	            }
	        } else {
	        	
	        }
        }
        $style['experiseRow'] = $this->Dashboard_Model->common_row($this->session->userdata('looking_stylist_city_session'),'area_expertise_looking');
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        
        $datas  =  $this->common_model->get_all_details('area_expertise_looking_city',array('area_expertise_looking_id'=> $this->session->userdata('looking_stylist_city_session')))->result();
        $where = ' where footer_ui_status = 1';
        if($datas){
            $i=0;
            $str='';
            foreach($datas as $k=>$v){
                if($i>0){
                    $str .= ' AND ';
                }
                $str .= ' id != '.$v->city_id;
                $i++;
            }
            if($str){
                $where .= ' AND ( '.$str.')';
            }
        }
        $style['cities'] = $this->common_model->get_all_details_query('cities',$where)->result();
        //echo $this->db->last_query();
        $this->load->view('admin/FasihonServices/stylist-city-edit',$style);
	}
	public function looking_stylist_city_edit($id)
	{
		if ($this->input->post('title')) {
		    $this->form_validation->set_rules('description', 'Enter Description', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    $id = $this->input->post('id');
		    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/stylist/';
		        $data['title'] = $this->input->post('title');
		        $data['sub_title'] = $this->input->post('sub_title'); 
		        $data['city_id'] = $this->input->post('city_id'); 
		        $data['description'] = $this->input->post('description');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	            $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise_looking_city');
	            if($update) {
	                $this->session->set_flashdata('success','Stylist Expertise  Data Update Successfully!!');
                    redirect('admin/looking-stylist-city');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/looking-stylist-city');
	            }
	        }
	    }
	    $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
	    $style['datas'] = $datas = $this->Dashboard_Model->common_row($id,'area_expertise_looking_city');
	    $style['cities'] = $this->db->get_where('cities',['id'=>$datas->city_id])->result();
        $style['experiseRow'] = $this->Dashboard_Model->common_row($this->session->userdata('looking_stylist_city_session'),'area_expertise_looking');
        
        if(!empty($style['datas'])) {
            $this->load->view('admin/FasihonServices/stylist-city-edit',$style);    
        } else {
              
        }
	}
	public function looking_stylist_city_delete($id)
	{
	       $delete = $this->Dashboard_Model->common_delete($id,'area_expertise_looking_city');
    	   if($delete) {
    	       $this->session->set_flashdata('success','Stylist Expertise / Interests Data delete successfully');
               redirect('admin/looking-stylist-city');
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/looking-stylist-city');
    	   }
	}
	public function looking_stylist_city_delete_status()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'area_expertise_looking_city');
	    echo $update;   
	}

	function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = 'our_services';
            if ($table) {
                $tbl_name = $table;
            }

            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            $condition = ' WHERE status = 1 AND ui_order >= '.$ui_order;
            $list = $this->common_model->get_all_details_query($tbl_name,$condition)->result_array();
            $uu = 0;
            foreach($list as $key=>$value){
                if($id != $value['id']){
                    $uu++;
                    $order = $ui_order + $uu;
                    $params = array('ui_order'=>$order);
                    $con = array('id'=>$value['id'],'status'=>1);
                    $this->common_model->commonUpdate($tbl_name,$params,$con);
                }
            }
            if($uu > 0){
                echo $uu;
            }else{
                echo 0;
            }
            die;
        }
    }

 }	