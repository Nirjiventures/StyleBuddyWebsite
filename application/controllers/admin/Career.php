<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller {
	
    function __construct()
	{
        parent::__construct();
        //$this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
    //
    public function careerSeo() {
        
        $data['datas'] =  $this -> db -> get_where('pageSeo', array('pageTitle' => 'career'))->row();
        
        $this->load->view('admin/template/header');
        $this->load->view('admin/career/seoView',$data);  
        $this->load->view('admin/template/footer');
    }
    public function careerSeoEdit($id) {
        
        $data['datas'] = $this->Dashboard_Model->common_row($id,'pageSeo'); 
        $this->load->view('admin/template/header');
        $this->load->view('admin/career/seoEdit',$data);
        $this->load->view('admin/template/footer');
        
    }
    public function careerSeoUpdate() {
        
        $this->form_validation->set_rules('title', 'Status', 'required|trim');
        $this->form_validation->set_rules('metaTag', 'Meta Tag', 'required|trim');
        $this->form_validation->set_rules('metaDescription', 'Meta Description', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        $id = $this->input->post('id');
	    if($this->form_validation->run()) { 
	        
	        $data['title'] = $this->input->post('title');
	        $data['metaTag'] = $this->input->post('metaTag');
	        $data['metaDescription'] = $this->input->post('metaDescription');
	        $data['updated_at']  = date('d m Y h:i:s'); 
	        
	         $update = $this->Dashboard_Model->common_update($id,$data,'pageSeo');
	            if($update) {
	                $this->session->set_flashdata('success','Career  SEO Data update Successfully!!');
                    redirect('admin/career-seo');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/career-seo');
	            }
	        
	    } else {
	        
	        redirect("admin/edit-career-us-seo/$id");
	    }
    }
    //
    public function careersForm()
    {       
        $this->form_validation->set_rules('department', 'Department', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
        $this->form_validation->set_rules('jobTitle', 'Job Title', 'required|trim');
        $this->form_validation->set_rules('shortDesc', 'Short Description', 'required|trim');
	    $this->form_validation->set_rules('longDesc', 'Long Description', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    if($this->form_validation->run()) {
	            
    	        $data['jobTitle'] = $this->input->post('jobTitle');
    	        $data['jobSlug'] = url_title($data['jobTitle'], 'dash', true);
    	         $data['department'] = $this->input->post('department');
    	         $data['location'] = $this->input->post('location');
    	        $data['shortDesc'] = $this->input->post('shortDesc');
    	        $data['longDesc'] = $this->input->post('longDesc');
    	        $data['metaTag'] = $this->input->post('metaTag');
    	        $data['metaDescription'] = $this->input->post('metaDescription');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 
	            
	            $insert = $this->Dashboard_Model->common_insert($data,'career');
	            
    	            if($insert) {
    	                $this->session->set_flashdata('success','Career Data add Successfully!!');
                        redirect('admin/add-career');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-career');
    	            }
	            
	        }else {
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/career/form');
                    $this->load->view('admin/template/footer');
	      }
    }
    public function careers()
    {    
       
        $this->db->from('career');$this->db->order_by("id", "desc");$query = $this->db->get(); $data['datas'] =  $query->result();
        

        // $data['datas'] = $this->Dashboard_Model->common_all('career');
         $this->load->view('admin/template/header');
         $this->load->view('admin/career/view',$data);
         $this->load->view('admin/template/footer');
    }
    public function careersEdit($id)
    {
        $datas['data'] = $this->Dashboard_Model->common_row($id,'career');
	    if($datas['data']) {
    	    $this->load->view('admin/template/header');
            $this->load->view('admin/career/edit',$datas);
            $this->load->view('admin/template/footer');
	    } else {
	        redirect('admin/career');
	    }    
    }
    public function careersUpdate()
    {
        $this->form_validation->set_rules('department', 'Department', 'required|trim');
        $this->form_validation->set_rules('location', 'Location', 'required|trim');
        $this->form_validation->set_rules('jobTitle', 'Job Title', 'required|trim');
        $this->form_validation->set_rules('shortDesc', 'Short Description', 'required|trim');
	    $this->form_validation->set_rules('longDesc', 'Long Description', 'required|trim');
	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    if($this->form_validation->run()) {
	        
    	        $data['jobTitle'] = $this->input->post('jobTitle');
    	        $data['jobSlug'] = url_title($data['jobTitle'], 'dash', true);
    	        $data['department'] = $this->input->post('department');
    	        $data['location'] = $this->input->post('location');
    	        $data['shortDesc'] = $this->input->post('shortDesc');
    	        $data['longDesc'] = $this->input->post('longDesc');
    	        $data['metaTag'] = $this->input->post('metaTag');
    	        $data['metaDescription'] = $this->input->post('metaDescription');
	            $data['status']  = $this->input->post('status');
	            $data['updated_at']  = date('Y-m-d h:i:s'); 
	            $id = $this->input->post('id');
	            
	            $update = $this->Dashboard_Model->common_update($id,$data,'career'); 
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Career Data update Successfully!!');
                        redirect('admin/career');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/career');
    	            }
	        } else {
                    $this->load->view('admin/template/header');
                    $this->load->view('admin/career/form');
                    $this->load->view('admin/template/footer');
	          }
    }
    public function careersDelete($id)
    {
        $delete = $this->Dashboard_Model->common_delete($id,'career');
         if($delete) {
        	  $this->session->set_flashdata('success','Career Data data delete successfully');
              redirect('admin/career');
         } else {
           $this->session->set_flashdata('error','Something Went Wrong');
           redirect('admin/career');
        }
    }
    
    public function careersStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'career');
	    echo $update;
    }
    
    
    
    
    
}    
?>    