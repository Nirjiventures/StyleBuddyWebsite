<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Domain extends MY_Controller {
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

        $this->uploadPath = 'assets/images/corporate_domain/';
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
        $this->getPermission('admin/domain');
        $getData = $this->input->get();

        $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $data['corporate_company'] = $rows;
        $condition = ' WHERE id != 0';
        if ($getData['corporate_company_id']) {
            $condition .= '  AND corporate_company_id = "'.$getData['corporate_company_id'].'"';
        }
         
        $list = $this->common_model->get_all_details_query('corporate_domain',$condition)->result();
        //echo $this->db->last_query();

	    $data['datas'] = $list;
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
        $this->getPermission('admin/domain/add');	
		$postData = $this->input->post();
        $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $result_data['corporate_company'] = $rows;

        if ($postData) {
		    $this->form_validation->set_rules('domain_name', 'Domain Name', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
		        
                $domain_name = $this->input->post('domain_name'); 
		        if(!$this->validDomain($domain_name)){
		        	$this->session->set_flashdata('success','Please enter valid domain');
		        	redirect($this->url1.'/'.$this->url2.'/add'.'?corporate_company_id='.$this->input->post('corporate_company_id'));
		        }
                $r = $this->common_model->get_all_details('corporate_domain',array('domain_name'=>$domain_name))->row();
                if($r){
                    $this->session->set_flashdata('success','Domain already registered');
                    redirect($this->url1.'/'.$this->url2.'/add'.'?corporate_company_id='.$this->input->post('corporate_company_id'));
                }
		        $data['domain_name'] = $domain_name; 
		        $data['slug'] = url_title( $data['domain_name'], 'dash', true);
	            $data['status']  = $this->input->post('status');
                $data['corporate_company_id']  = $this->input->post('corporate_company_id');
	            $data['created_at']  = date('Y-m-d h:i:s'); 

	            $multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $data['image']=  trim($insert_,',');

                }

	            $insert = $this->Dashboard_Model->common_insert($data,'corporate_domain');
	            if($insert) {
	                $this->session->set_flashdata('success','Our Data Insert Successfully!!');
                    redirect($this->url1.'/'.$this->url2.'/'.'?corporate_company_id='.$this->input->post('corporate_company_id'));
	                redirect($this->url1.'/'.$this->url2);
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	            }
	        }
	    }
        $result_data['datas'] = array();
        $this->load->view($this->url1.'/'.$this->url2.'/addEdit',$result_data); 
	}
	
	public function edit($id){
        $this->getPermission('admin/domain/edit');
        $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $result_data['corporate_company'] = $rows;

        $result_data['datas'] = $this->Dashboard_Model->common_row($id,'corporate_domain');
        if(empty($result_data['datas'])) {
            redirect($this->url1.'/'.$this->url2.'/'.'?corporate_company_id='.$this->input->post('corporate_company_id'));
         	redirect($this->url1.'/'.$this->url2);
        }else{
         	$postData = $this->input->post();
         	if ($postData) {
         		$this->form_validation->set_rules('domain_name', 'Domain Name', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			    $id = $this->input->post('id');
			    if($this->form_validation->run()) {
		            $data['status']  = $this->input->post('status');

			       	$multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);

	                if(!empty($multiImage)){

	                    $insert_= trim($multiImage,',');

	                    $data['image']=  trim($insert_,',');

	                }
                    $data['corporate_company_id']  = $this->input->post('corporate_company_id');
		            $update = $this->common_model->commonUpdate('corporate_domain',$data,array('id'=>$id));
		            if($update) {
		                $this->session->set_flashdata('success','Our Data Update Successfully!!');
                        redirect($this->url1.'/'.$this->url2.'/'.'?corporate_company_id='.$this->input->post('corporate_company_id'));
		                redirect($this->url1.'/'.$this->url2);
		            } else {
		                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
		                //redirect($this->url1.'/'.$this->url2);
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
	    $update = $this->Dashboard_Model->common_update($id,$data,'corporate_domain');
	    echo $update;   
	}
	function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = 'corporate_domain';
            if ($table) {
                $tbl_name = $table;
            }

            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            
            $row = $this->common_model->get_all_details($tbl_name,$con)->row_array();
            
            $condition = ' WHERE status = 1 AND domain_id = "'.$row['domain_id'].'" AND ui_order >= '.$ui_order;
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