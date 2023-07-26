<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slides extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/common_model');
        $this->logged_in();
        $this->uploadPath = 'assets/images/slider/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
        $this->tbl_name = 'slides';
        
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
    }
    public function index(){
        $this->getPermission('admin/slides');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = $this->tbl_name;
        $str = '';
        if ($this->input->get('slider_id')) {
            $str = ' WHERE slider_id = "'.$this->input->get('slider_id').'"';
        }
        $str .= ' ORDER BY id DESC';
        $datas = $this->common_model->get_all_details_query($tbl_name,$str)->result();

        //$datas = $this->common_model->get_all_details($tbl_name,array())->result();
        foreach ($datas as $key => $value) {
            $slider = $this->common_model->get_all_details('slider',array('id'=>$value->slider_id))->row();
            $datas[$key]->slider_name = $slider->title;
        }
        $data['datas'] = $datas;
        $data['slider'] = $this->common_model->get_all_details('slider',array('status'=>1))->result(); 
        
        $this->load->view('admin/template/header');
        $this->load->view($url1.'/'.$url2.'/list',$data);
        $this->load->view('admin/template/footer');   
    }
    public function add(){
        $this->getPermission('admin/slides/add');
        $postData = $this->input->post();
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = $this->tbl_name;
        if ($postData) {
            $this->form_validation->set_rules('title', 'title', 'required|trim');
            $this->form_validation->set_rules('slider_id', 'slider_id', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
          
            if($this->form_validation->run()) {
                $multiImage = $this->uploadSingleImageOnly('slides_image',$this->uploadPath);
                if(!empty($multiImage)){
                    $data['slides_image']=  trim($multiImage,',');
                }
                $data['slider_id'] = $this->input->post('slider_id'); 
                $data['sub_title2'] = $this->input->post('sub_title2');
                $data['title'] = $this->input->post('title'); 
                $data['sub_title'] = $this->input->post('sub_title');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d-m-Y h:i:s'); 
               
                $insert = $this->common_model->simple_insert($tbl_name,$data);
                if($insert) {
                    $this->session->set_flashdata('success','Slider Data Insert Successfully!!');
                    redirect($url1.'/'.$url2);
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                }
            } 
        } 
        $data['slider'] = $this->common_model->get_all_details('slider',array('status'=>1))->result(); 
	    $this->load->view('admin/template/header');
        $this->load->view($url1.'/'.$url2.'/edit',$data);
        $this->load->view('admin/template/footer');   
    }
    
     
    public function edit($id){
        $this->getPermission('admin/slides/edit');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $postData = $this->input->post();
        $tbl_name = $this->tbl_name;
        if ($postData) {

    	    $this->form_validation->set_rules('title', 'title', 'required|trim');
            $this->form_validation->set_rules('slider_id', 'slider_id', 'required|trim');
    	    $this->form_validation->set_rules('status', 'Status', 'required|trim');
    	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
    	   
    	    if($this->form_validation->run()) {
                $multiImage = $this->uploadSingleImageOnly('slides_image',$this->uploadPath);
                if(!empty($multiImage)){
                    $data['slides_image']=  trim($multiImage,',');
                }
    	        $id = $this->input->post('id');
    	        $data['slider_id'] = $this->input->post('slider_id'); 
                $data['title'] = $this->input->post('title'); 
                $data['sub_title'] = $this->input->post('sub_title');
                $data['sub_title2'] = $this->input->post('sub_title2');
                $data['status']  = $this->input->post('status');
                $data['created_at']  = date('d m Y h:i:s'); 
               
                $update = $this->common_model->commonUpdate($tbl_name,$data,array('id'=>$id));
                
                if($update) {
                    $this->session->set_flashdata('success','Slider Data Updated Successfully!!');
                    redirect($url1.'/'.$url2);
                } else {
                    $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                }
            }
        }
        $data['datas'] = $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();
        $data['slider'] = $this->common_model->get_all_details('slider',array('status'=>1))->result();
        $this->load->view('admin/template/header');
        $this->load->view($url1.'/'.$url2.'/edit',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function delete($id){
        $this->getPermission('admin/slides/delete');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;   
        $query_image = $this->db->get_where($tbl_name, array('id' => $id))->row();
        $image = $query_image->slides_image;

        if (file_exists($this->uploadPath.$image)) {
            unlink($this->uploadPath.$image);
        }
        $delete = $this->common_model->commonDelete($tbl_name,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Slides data delete successfully');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong');
        }
        redirect($url1.'/'.$url2);
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
    function sliderStatusUpdate(){
        $tbl_name = $this->tbl_name;
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->common_model->commonUpdate($tbl_name,$data,array('id'=>$id));
	    echo $update;
    }

}    