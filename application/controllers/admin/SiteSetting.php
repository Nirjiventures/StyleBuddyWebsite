<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteSetting extends MY_Controller {
	
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
    

public function setting()
    {   $this->getPermission('admin/site-setting');
        $all['datas'] = $this->Dashboard_Model->common_all('site_setting');
        $this->load->view('admin/template/header');
        $this->load->view('admin/setting/view',$all);
        $this->load->view('admin/template/footer');
    }
    public function settingEdit($id)
    {   
        $this->getPermission('admin/site-setting/edit');
        $data['datas'] = $this->Dashboard_Model->common_row($id,'site_setting');
        $this->load->view('admin/template/header');
        $this->load->view('admin/setting/edit',$data);
        $this->load->view('admin/template/footer');   
    }
    public function settingUpdate()
    {
         if($_FILES['logo']['name'] !="") {
    	         $config['upload_path'] = './assets/images/'; 
    	         $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg|png'; 
    	         $this->load->library('upload',$config);
    	         $this->upload->initialize($config);
    	         
    	         if($this->upload->do_upload('logo')){
                   $uploadImg = $this->upload->data(); 
                   $data['logo'] = $uploadImg['file_name']; 
    	          }  else {
    	               $ierror = $this->upload->display_errors();
    	               $this->session->set_flashdata('imgerror',$ierror);
                       redirect('admin/edit-site-setting/1','refresh');
    	          }
    	        }  else { $data['logo'] = $this->input->post('old_img'); }
    	        $id = $this->input->post('id');
    	        
    	        $data['email'] = $this->input->post('email'); 
	            $data['mobile'] = $this->input->post('mobile');
	            $data['gstin'] = $this->input->post('gstin');
	            $data['linkedin']  = $this->input->post('linkedin');
	            $data['facebook']  = $this->input->post('facebook');
	            $data['youtube']  = $this->input->post('youtube');
	            $data['instagram']  = $this->input->post('instagram');
	            $data['twitter']  = $this->input->post('twitter');
	            $data['address']  = $this->input->post('address');
	            $data['short_details']  = $this->input->post('short_details');
	            $data['updated_at']  = date('d-m-Y h:i:s'); 
	            $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                
                
	            $update = $this->Dashboard_Model->common_update($id,$data,'site_setting');
	            
    	            if($update) {
    	                $this->session->set_flashdata('success','Website setting Data update Successfully!!');
                        redirect('admin/site-setting');
    	            } else {
    	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                        redirect('admin/site-setting');
    	            }
      }

}
?>
