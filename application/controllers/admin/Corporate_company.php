<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Corporate_company extends MY_Controller {
	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('common_model');
        $this->logged_in();

        $this->url1 = $this->uri->segment(1);
        $this->url2 = $this->uri->segment(2);
        $this->url3 = $this->uri->segment(3);
        $this->url4 = $this->uri->segment(4);

        $this->uploadPath = 'assets/images/corporate_company/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	public function index(){
        $this->getPermission('admin/corporate_company');
	    $data['datas'] = $this->Dashboard_Model->common_all('corporate_company');
        $this->load->view($this->url1.'/'.$this->url2.'/list',$data); 
	}
	function validDomain($domain) {
      $domain = rtrim($domain, '.');
      if (!mb_stripos($domain, '.')) {
        return false;
      }
      $domain = explode('.', $domain);
      $allowedChars = array('-');
      $extenion = array_pop($domain);
      foreach ($domain as $value) {
        $fc = mb_substr($value, 0, 1);
        $lc = mb_substr($value, -1);
        if (
          hash_equals($value, '')
          || in_array($fc, $allowedChars)
          || in_array($lc, $allowedChars)
        ) {
          return false;
        }
        if (!ctype_alnum(str_replace($allowedChars, '', $value))) {
          return false;
        }
      }
      if (
        !ctype_alnum(str_replace($allowedChars, '', $extenion))
        || hash_equals($extenion, '')
      ) {
        return false;
      }
      return true;
    }

	public function add(){
        $this->getPermission('admin/corporate_company/add');	
		$postData = $this->input->post();
        if ($postData) {
		    $this->form_validation->set_rules('name', 'Company Name', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
		        $name = $this->input->post('name'); 
		        $data['name'] = $name; 
		        $data['slug'] = url_title( $data['name'], 'dash', true);
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 

	            $multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $data['image']=  trim($insert_,',');

                }

	            $insert = $this->Dashboard_Model->common_insert($data,'corporate_company');
	            if($insert) {
	                $this->session->set_flashdata('success','Our Data Insert Successfully!!');
	                redirect($this->url1.'/'.$this->url2);
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	            }
	        }
	    }
        $data['datas'] = array();
        $this->load->view($this->url1.'/'.$this->url2.'/addEdit',$data); 
	}
	
	public function edit($id){
        $this->getPermission('admin/corporate_company/edit');
        $result_data['datas'] = $this->Dashboard_Model->common_row($id,'corporate_company');
        if(empty($result_data['datas'])) {
         	redirect($this->url1.'/'.$this->url2);
        }else{
         	$postData = $this->input->post();
         	if ($postData) {
         		$this->form_validation->set_rules('name', 'Company Name', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			    $id = $this->input->post('id');
			    if($this->form_validation->run()) {
		            //$data['name']  = $this->input->post('name');
                    $data['status']  = $this->input->post('status');
			       	$multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);
	                if(!empty($multiImage)){
	                    $insert_= trim($multiImage,',');
	                    $data['image']=  trim($insert_,',');
	                }
		            $update = $this->common_model->commonUpdate('corporate_company',$data,array('id'=>$id));
		            if($update) {
		                $this->session->set_flashdata('success','Our Data Update Successfully!!');
		                redirect($this->url1.'/'.$this->url2);
		            } else {
		                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
		                redirect($this->url1.'/'.$this->url2);
		            }
		        }
         	}
         	$this->load->view($this->url1.'/'.$this->url2.'/addEdit',$result_data); 
        }  
	}
	
	public function statusUpdate(){
	    $id = $this->input->post('id');
	    $domain_id = $this->input->post('domain_id');
	    $status = $this->input->post('status'); 
	    $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'corporate_company');
	    echo $update;   
	}
	function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = 'corporate_company';
            if ($table) {
                $tbl_name = $table;
            }

            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            
            $row = $this->common_model->get_all_details($tbl_name,$con)->row_array();
            
            $condition = ' WHERE status = 1  ui_order >= '.$ui_order;
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