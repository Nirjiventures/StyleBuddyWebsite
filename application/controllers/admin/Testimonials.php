<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
    public function testimonial(){
        
        $data['datas'] = $this->Dashboard_Model->common_all('testimonial');
        $this->load->view('admin/template/header');
        $this->load->view('admin/testimonial/view',$data);
        $this->load->view('admin/template/footer');   
    }
    public function testimonialForm()
    {   
        //$this->form_validation->set_rules('rating', 'Rating', 'required|trim');
        $this->form_validation->set_rules('testimonial_name', 'Testimonial name', 'required|trim');
	    $this->form_validation->set_rules('testimonial_data', 'Testimonial data', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	   
	    if($this->form_validation->run()) {
	        
         if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './assets/images/testimonial/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	               $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/add-testimonial');
    	          }
    	        }  //else { $data['slider_image'] = $this->input->post('old_img'); }
    	        
    	        //$data['rating'] = $this->input->post('rating');
    	        $data['testimonial_name'] = $this->input->post('testimonial_name'); 
	            $data['testimonial_data'] = $this->input->post('testimonial_data');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d-m-Y h:i:s'); 
	           
	            $update = $this->Dashboard_Model->common_insert($data,'testimonial');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Testimonial Data insert Successfully!!');
                        redirect('admin/add-testimonial');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-testimonial');
    	            }
	        } else {
	             $this->load->view('admin/template/header');
                 $this->load->view('admin/testimonial/form');
                 $this->load->view('admin/template/footer');    
	        }
        
    }
    public function testimonialEdit($id)
    {   
        $data['datas'] = $this->Dashboard_Model->common_row($id,'testimonial');
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/testimonial/edit',$data);
        $this->load->view('admin/template/footer');   
    }
    public function testimonialUpdate()
    {
        $this->form_validation->set_rules('testimonial_name', 'Testimonial name', 'required|trim');
        //$this->form_validation->set_rules('rating', 'Rating', 'required|trim');
	    $this->form_validation->set_rules('testimonial_data', 'Testimonial data', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    $id = $this->input->post('id');
	    if($this->form_validation->run()) {
	        
         if($_FILES['image']['name'] !="") {
    	         $config['upload_path'] = './upload/assets/images/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
    	          }  else {
    	               $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect("admin/edit-testimonial/$id");
    	          }
    	        }  else { $data['image'] = $this->input->post('old_img'); }
    	        
    	        
    	       // $data['rating'] = $this->input->post('rating');
    	        $data['testimonial_name'] = $this->input->post('testimonial_name'); 
	            $data['testimonial_data'] = $this->input->post('testimonial_data');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	   
	            $update = $this->Dashboard_Model->common_update($id,$data,'testimonial');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Testimonial Data update Successfully!!');
                        redirect('admin/testimonial');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/testimonial');
    	            }
	        } else {
                redirect("admin/edit-testimonial/$id");    
	        }
    }
    public function testimonialDelete($id)
    {
        $query_image = $this->db->get_where('testimonial', array('id' => $id))->row();
            $image = $query_image->image;
            
            if (file_exists('assets/images/testimonial/'.$image)) {
                   unlink('assets/images/testimonial/'.$image);
            }
              $delete = $this->Dashboard_Model->common_delete($id,'testimonial');
        	   if($delete) {
        	       $this->session->set_flashdata('success','testimonial data delete successfully');
                   redirect('admin/testimonial');
        	   } else {
                   $this->session->set_flashdata('error','Something Went Wrong');
                   redirect('admin/testimonial');
        	   }
    }
    public function testimonialStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); 
	    $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'testimonial');
	    echo $update;
    }
}    