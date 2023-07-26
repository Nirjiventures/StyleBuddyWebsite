<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
    
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
            redirect('stylebuddy-admin');
        }
    }
    public function index(){
        $this->getPermission('admin/page');
        $condition = ' where page_on = 1 order by id desc';
        $datas = $this->common_model->get_all_details_query('cms_pages',$condition)->result();
        $data['datas'] = $datas;
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/list',$data);
        $this->load->view('admin/template/footer');
    }
    public function add()
    {   $this->getPermission('admin/page/add');
        $this->form_validation->set_rules('title', 'Page Title', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another %s'); 
        $tbl_name    = 'cms_pages';
        if($this->form_validation->run()) {
                
                $this->uploadPath = 'assets/images/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                } 
                
                $data['page_on'] = 1;
                $data['title'] = $this->input->post('title');
                $data['sub_title'] = $this->input->post('sub_title');
                //$data['slug'] = url_title($data['title'], 'dash', true);
                
                
                $slugBase = $slug = url_title($this->input->post('title'), '-', TRUE);
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
    			$data['slug'] = $slug;
    			
                $data['content'] = $this->input->post('content');
                $data['content2'] = $this->input->post('content2');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d-m-Y h:i:s'); 
               
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                
                $insert = $this->Dashboard_Model->common_insert($data,'cms_pages');
                
                if($insert) {
                    $this->session->set_flashdata('success','CMS Page Data Insert Successfully!!');
                    redirect('admin/page');
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/page');
                }
            } else {
                $this->load->view('admin/template/header');
                $this->load->view('admin/page/edit');
                $this->load->view('admin/template/footer');   
            }

    }
    public function edit($id){ 
        $this->getPermission('admin/page/edit');      
        if ($this->input->post()) {
           $this->form_validation->set_rules('title', 'Page Title', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
           
            $id = $this->input->post('id');
            if($this->form_validation->run()) {
                $this->uploadPath = 'assets/images/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                } 
                
                $data['title'] = $this->input->post('title');
                $data['sub_title'] = $this->input->post('sub_title');
                $data['content'] = $this->input->post('content');
                $data['content2'] = $this->input->post('content2');
                $data['status']  = $this->input->post('status');
                $data['updated_at']  = date('d-m-Y h:i:s'); 
                
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                
                $update = $this->Dashboard_Model->common_update($id,$data,'cms_pages');
                 
                if($update) {
                    $this->session->set_flashdata('success','CMS Page Data Update Successfully!!');
                    redirect('admin/page');
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect('admin/page');
                }
            } else {
               redirect("admin/edit/$id",'refresh'); 
            }
        }    
        $datas['datas'] = $this->Dashboard_Model->common_row($id,'cms_pages');
        $this->load->view('admin/template/header');
        $this->load->view('admin/page/edit',$datas);
        $this->load->view('admin/template/footer');
    
       
    }
     
    public function delete($id)
    {   $this->getPermission('admin/page/delete');
        $delete = $this->Dashboard_Model->common_delete($id,'cms_pages');
           if($delete) {
               $this->session->set_flashdata('success','CMS Page Data delete successfully');
               redirect('admin/page');
           } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect('admin/page');
           }
    }
    public function statusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['status'=>$status];
        $update = $this->Dashboard_Model->common_update($id,$data,'cms_pages');
        echo $update;
    }
    
    
    
}    