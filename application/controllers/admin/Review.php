<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends MY_Controller {
	
	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
    }
	public function index(){ 
		$this->getPermission('admin/review');  
			$review = $this->db->query('select * from review')->result();
	    $data['datas'] = $review;
	     
			$this->load->view('admin/template/header');
			$this->load->view('admin/review/list',$data);
			$this->load->view('admin/template/footer');
	}
	
	public function add(){  
		$this->getPermission('admin/review/add');  
	    $this->form_validation->set_rules('name', 'Category', 'required|trim|is_unique[category.name]');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
	    
	    if($this->form_validation->run()) {
	            
	            if($_FILES['cat_image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/'; 
    	         $config['max_size'] = 1024;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('cat_image')){
                   $uploadImg = $this->upload->data(); 
                   $data['cat_image'] = $uploadImg['file_name']; 
    	          }  else {
    	              $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-category','refresh');
    	          }
    	        }
    	    
    	        $data['name'] = $this->input->post('name'); 
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s'); 
	            $data['slug'] = url_title($data['name'], 'dash', true);
	            
	            $insert = $this->Dashboard_Model->common_insert($data,'category');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Category Data Insert Successfully!!');
                        redirect('admin/add-category');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-category');
    	            }
	            
	        }else {
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/category/form');
                    $this->load->view('admin/template/footer');
	    }
  }
	public function view($id){
	  		if (ctype_digit(strval($id)) ) {
	        $review = $this->db->query('select * from review where id = '.$id)->row();
	    		$data['datas'] = $review;
	        $this->load->view('admin/template/header');
	        $this->load->view('admin/review/view',$data);
          $this->load->view('admin/template/footer');
	      
    	  } else {
    	       redirect('admin/review');
    	  }
	}
	public function edit($id){
		$this->getPermission('admin/review/edit'); 
	  		if (ctype_digit(strval($id)) ) {
	        $review = $this->db->query('select * from review where id = '.$id)->row();
	    		$data['datas'] = $review;
	        $this->load->view('admin/template/header');
	        $this->load->view('admin/review/edit',$data);
          $this->load->view('admin/template/footer');
	      
    	   } else {
    	       redirect('admin/review');
    	   }
	}
	
	
	public function delete($id){
		$this->getPermission('admin/review/delete'); 
	   	$this->db->where('id', $id);
      $this->db->delete('review');
    	redirect('admin/review');
	}
	public function changeStatus()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    
	    $this->db->where('id', $id);
      $update = $this->db->update('review',['status'=>$status]);
      echo $update;
	}
	
}