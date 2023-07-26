<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PolicyTerm extends CI_Controller {
	
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
    public function policy()
    {   
        $data['datas'] = $this->Dashboard_Model->common_all('policy');
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/policy/view',$data);
        $this->load->view('admin/template/footer');
    }
    public function policyForm()
    {                   
        $this->form_validation->set_rules('page_name', 'Page name', 'required|trim|is_unique[policy.page_name]');
	    $this->form_validation->set_rules('policy_content', 'Page Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    if($this->form_validation->run()) { 
	        
	                $data['page_name'] = $this->input->post('page_name');     
	                $data['policy_content'] = $this->input->post('policy_content');
	                $data['status'] = $this->input->post('status');
	                $data['metaTitle'] = $this->input->post('metaTitle');
                    $data['metaTag'] = $this->input->post('metaTag');
                    $data['metaDescription'] = $this->input->post('metaDescription');
                    
                    $insert = $this->Dashboard_Model->common_insert($data,'policy');
                   if($insert) {
    	                    $this->session->set_flashdata('success','Policy data insert  Successfully!!');
                            redirect('admin/add-policy');
                        } else {
                            $this->session->set_flashdata('error','Somthing Went Wrong, try again');
                            redirect('admin/add-policy');
                        }
	                    
	    } else {
	        
	         $this->load->view('admin/template/header');
             $this->load->view('admin/policy/form');
             $this->load->view('admin/template/footer');
	    }
    }
    public function policyEdit($id)
    {   
        $data['datas'] = $this->Dashboard_Model->common_row($id,'policy');
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/policy/edit',$data);
        $this->load->view('admin/template/footer');
    }
    public function policyUpdate()
    {
        
        $this->form_validation->set_rules('page_name', 'Page name', 'required|trim');
	    $this->form_validation->set_rules('policy_content', 'Page Content', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
	    
	    if($this->form_validation->run()) { 
	        
	                $data['page_name'] = $this->input->post('page_name');     
	                $data['policy_content'] = $this->input->post('policy_content');
	                $data['status'] = $this->input->post('status');
	                $data['metaTitle'] = $this->input->post('metaTitle');
                    $data['metaTag'] = $this->input->post('metaTag');
                    $data['metaDescription'] = $this->input->post('metaDescription');
                    
                  $id = $this->input->post('id');
	               $update = $this->Dashboard_Model->common_update($id,$data,'policy');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Policy Data Update Successfully!!');
                        redirect('admin/policy');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/policy');
    	            }
	                    
	    } else {
	        
	         $this->load->view('admin/template/header');
             $this->load->view('admin/policy/form');
             $this->load->view('admin/template/footer');
	    }
    }
    public function policyDelete($id)
    {     
         $delete = $this->Dashboard_Model->common_delete($id,'policy');
	   
    	   if($delete) {
    	       $this->session->set_flashdata('success','Policy Data delete successfully');
              redirect('admin/policy');
    	   } else {
              $this->session->set_flashdata('error','Something Went Wrong');
              redirect('admin/policy');
    	   }
    }
    function policyStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'policy');
	    echo $update;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}    