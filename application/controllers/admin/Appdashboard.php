<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appdashboard extends MY_Controller {
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
        $this->getPermission('admin/appdashboard');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $condition = ' where slug="stylist-dashboard" OR slug="user-dashboard"  order by id desc';
        $datas = $this->common_model->get_all_details_query('cms_pages',$condition)->result();
           

        $data['datas'] = $datas;
        $this->load->view('admin/template/header');
        $this->load->view($url1.'/'.$url2.'/view',$data);
        $this->load->view('admin/template/footer');
    }
    public function add()
    {   $this->getPermission('admin/appdashboard/add');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $this->form_validation->set_rules('title', 'Page Title', 'required|trim|is_unique[cms_pages.title]');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
        
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another %s'); 

        if($this->form_validation->run()) {
                
                $this->uploadPath = 'assets/images/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                } 
          
                $data['title'] = $this->input->post('title');
                $data['sub_title'] = $this->input->post('sub_title');
                $data['slug'] = url_title($data['title'], 'dash', true);
                $data['content'] = $this->input->post('content');
                $data['content2'] = $this->input->post('content2');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d-m-Y h:i:s'); 
               
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                
                $insert = $this->Dashboard_Model->common_insert($data,'cms_pages');
                
                    if($insert) {
                        $this->session->set_flashdata('success','Data Insert Successfully!!');
                        redirect('admin/add-cms-page');
                    } else {
                        $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/add-cms-page');
                    }
            } else {
                $this->load->view('admin/template/header');
                $this->load->view('admin/cms/edit');
                $this->load->view('admin/template/footer');   
            }

    }
    public function edit($id){ 
        $this->getPermission('admin/appdashboard/edit');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
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
                    $this->session->set_flashdata('success','Data Update Successfully!!');
                    redirect($url1.'/'.$url2);
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                    redirect($url1.'/'.$url2);
                }
            } else {
                redirect($url1.'/'.$url2.'/'.$url3.'/'.$id);
            }
        }    
        $datas['datas'] = $this->Dashboard_Model->common_row($id,'cms_pages');
        $this->load->view('admin/template/header');
        $this->load->view($url1.'/'.$url2.'/edit',$datas);
        $this->load->view('admin/template/footer');
    
       
    }
     
    public function delete($id)
    {   $this->getPermission('admin/appdashboard/delete');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $delete = $this->Dashboard_Model->common_delete($id,'cms_pages');
           if($delete) {
               $this->session->set_flashdata('success','Data delete successfully');
               redirect($url1.'/'.$url2);
           } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect($url1.'/'.$url2);
           }
    }
    public function aboutStatusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['status'=>$status];
        $update = $this->Dashboard_Model->common_update($id,$data,'cms_pages');
        echo $update;
    }
    
    
    
}    