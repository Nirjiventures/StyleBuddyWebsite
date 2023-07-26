<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopslider extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->logged_in();
        $this->uploadPath = 'assets/images/slider/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
        $this->tbl_name = 'shop_slider';
        
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
    }
    public function index()
    {    $this->getPermission('admin/shopslider');
         $data['datas'] = $this->Dashboard_Model->common_all('shop_slider');
         $this->load->view('admin/template/header');
         $this->load->view('admin/shop-slider/view',$data);
         $this->load->view('admin/template/footer');   
    }
    public function add(){
        $this->getPermission('admin/shopslider/add');
        $postData = $this->input->post();
        if ($postData) {
            $this->form_validation->set_rules('title', 'title', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
          
            if($this->form_validation->run()) {
                $multiImage = $this->uploadSingleImageOnly('slider_image',$this->uploadPath);
                if(!empty($multiImage)){
                    $data['slider_image']=  trim($multiImage,',');
                }
                $data['title'] = $this->input->post('title'); 
                $data['sub_title'] = $this->input->post('sub_title');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d-m-Y h:i:s'); 
               
                $insert = $this->Dashboard_Model->common_insert($data,'shop_slider');
                if($insert) {
                    $this->session->set_flashdata('success','Slider Data Insert Successfully!!');
                    redirect('admin/shopslider');
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                }
            } 
        }    
	    $this->load->view('admin/template/header');
        $this->load->view('admin/shop-slider/form');
        $this->load->view('admin/template/footer');   
    }
    
     
    public function edit($id){
        $this->getPermission('admin/shopslider/edit');
        $postData = $this->input->post();
        if ($postData) {

    	    $this->form_validation->set_rules('title', 'title', 'required|trim');
    	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
    	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
    	   
    	    if($this->form_validation->run()) {
                $multiImage = $this->uploadSingleImageOnly('slider_image',$this->uploadPath);
                 

                if(!empty($multiImage)){
                    $data['slider_image']=  trim($multiImage,',');
                }
    	        $id = $this->input->post('id');
    	        $data['title'] = $this->input->post('title'); 
                $data['sub_title'] = $this->input->post('sub_title');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d m Y h:i:s'); 
               
                $update = $this->Dashboard_Model->common_update($id,$data,'shop_slider');
                
                if($update) {
                    $this->session->set_flashdata('success','Slider Data Updated Successfully!!');
                    redirect('admin/shopslider');
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                }
            }
        }
        $data['datas'] = $this->Dashboard_Model->common_row($id,'shop_slider');
        $this->load->view('admin/template/header');
        $this->load->view('admin/shop-slider/edit',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function sliderDelete($id)
    {      $this->getPermission('admin/shopslider/sliderDelete');
        $query_image = $this->db->get_where('shop_slider', array('id' => $id))->row();
        $image = $query_image->slider_image;

        if (file_exists($this->uploadPath.$image)) {
            unlink($this->uploadPath.$image);
        }
        $delete = $this->Dashboard_Model->common_delete($id,'shop_slider');
        if($delete) {
            $this->session->set_flashdata('success','Slider data delete successfully');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong');
        }
        redirect('admin/shopslider');
    }

    function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {
            $tbl_name = $this->tbl_name;
            if ($table) {
                $tbl_name = $table;
            }
            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            $condition = ' WHERE status = 1 AND ui_order >= "'.$ui_order.'"';
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

    function sliderStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'shop_slider');
	    echo $update;
    }

}    