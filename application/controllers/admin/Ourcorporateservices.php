<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ourcorporateservices extends MY_Controller {
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
    }
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	public function index(){
		$this->getPermission('admin/ourcorporateservices');
		$tbl_name = 'our_services_corporate_domain';
		$str = " WHERE id != '0' ";
		if ($this->input->get('domain_id')) {
			//$str .= " AND domain_id = '".$this->input->get('domain_id')."'";
		}
		if ($this->input->get('corporate_company_id')) {
			$str .= " AND corporate_company_id = '".$this->input->get('corporate_company_id')."'";
		}
        $str .= " order by id desc";

	    $query = $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);;
	    $numRows = $query->num_rows();
	    $data['numRows'] = $numRows;
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $numRows;
        $config['per_page'] = 50;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url().$this->url1.'/'.$this->url2.'/index';
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url']=base_url().$this->url1.'/'.$this->url2.'/index/?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $start_from = $this->uri->segment($config['uri_segment']);
        if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
        $limit['l1'] = $start;
        $limit['l2'] = $config["per_page"];
        $query = $this->common_model->get_all_details_query($tbl_name,$str,$limit);

	    $datas = $query->result();
	    $data['datas'] = $datas;
	    $data['corporate_domain'] = $this->common_model->get_all_details('corporate_domain',array('status'=>1))->result();
	    $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $data['corporate_company'] = $rows;

        $data['corporate_domain'] = array();

		if ($this->input->get('corporate_company_id')) {
			$st = " WHERE corporate_company_id = '".$this->input->get('corporate_company_id')."'";
			$que = $this->common_model->get_all_details_query('corporate_domain',$st)->result();
			$data['corporate_domain'] = $que;
		}

        $this->load->view($this->url1.'/'.$this->url2.'/list',$data); 
	}
	public function add(){
		$this->getPermission('admin/ourcorporateservices/add');	
		$postData = $this->input->post();
        if ($postData) {
		    $this->form_validation->set_rules('title', 'Service Title', 'required|trim');
		    $this->form_validation->set_rules('status', 'Status', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
	            $this->uploadPath = 'assets/images/services/';
	            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }

		        $mrp_price = $this->input->post('mrp_price');
		        $discount = $this->input->post('discount');
	            
	             
	            
	            if ($mrp_price) {
	            	$data['mrp_price'] = $mrp_price;
	            	$data['price'] = $mrp_price;
	            	$data['discount'] = 0;
	            	if ($discount) {
			            $data['discount'] = $discount;
			            $price = (int)($mrp_price - ($mrp_price * $discount * .01));
			            $data['price'] = $price;
		            }
	            }

                $data['sub_title'] = $this->input->post('sub_title'); 
		        $data['section1'] = $this->input->post('section1'); 
	           	$data['section3'] = $this->input->post('section3'); 
		        $data['title'] = $this->input->post('title'); 
		        $data['slug'] = url_title( $data['title'], 'dash', true);
	            $data['short_description'] = $this->input->post('short_description');
	            $data['description_top'] = $this->input->post('description_top');
	            //$data['description_middle'] = $this->input->post('description_middle');
	            $data['description_bottom'] = $this->input->post('description_bottom');
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 

	            $accordian = array();
	           	$accordian['ac_title'] = $this->input->post('ac_title');
	           	$accordian['ac_description'] = $this->input->post('ac_description');
	           	$data['description_middle'] = json_encode($accordian);

	           	$data['section2'] = $this->input->post('section2'); 
	            $data['right_section2'] = $this->input->post('right_section2'); 
	            $data['left_section2'] = $this->input->post('left_section2'); 
	            
	            $data['right_section1'] = $this->input->post('right_section1'); 
	            $data['left_section1'] = $this->input->post('left_section1'); 

	            if ($this->input->post('domain_id')) {
	            	$data['domain_id'] = $this->input->post('domain_id'); 
	            }
	            $data['corporate_company_id'] = $this->input->post('corporate_company_id'); 
	            $data['meta_title'] = $this->input->post('meta_title'); 
		        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
		        $data['meta_description'] = $this->input->post('meta_description'); 
	            $insert = $this->Dashboard_Model->common_insert($data,'our_services_corporate_domain');
	            
	            if($insert) {
	                $this->session->set_flashdata('success','Our Services Data Insert Successfully!!');
	                redirect($this->url1.'/'.$this->url2.'?corporate_company_id='.$data['corporate_company_id']);
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	            }
	        }
	    }
        $data['datas'] = array();
        $data['corporate_domain'] = $this->common_model->get_all_details('corporate_domain',array('status'=>1))->result();
        $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $data['corporate_company'] = $rows;
        $this->load->view($this->url1.'/'.$this->url2.'/addEdit',$data); 
	}
	
	public function edit($id){
		$this->getPermission('admin/ourcorporateservices/edit');
        $result_data['datas'] = $this->Dashboard_Model->common_row($id,'our_services_corporate_domain');
        if(empty($result_data['datas'])) {
         	redirect($this->url1.'/'.$this->url2);
        }else{
         	$postData = $this->input->post();
         	if ($postData) {
         		$this->form_validation->set_rules('title', 'Service Title', 'required|trim');
			    $this->form_validation->set_rules('status', 'Status', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			  
			    $id = $this->input->post('id');
			    if($this->form_validation->run()) {
		            $this->uploadPath = 'assets/images/services/';
		            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
		            if(!empty($image)){
		                $data['image'] = $image;
		            }

		             
			        $data['title'] = $this->input->post('title'); 
			       
			       	$mrp_price = $this->input->post('mrp_price');
			        $discount = $this->input->post('discount');
		            
		            if ($mrp_price) {
		            	$data['mrp_price'] = $mrp_price;
		            	$data['price'] = $mrp_price;
		            	$data['discount'] = 0;
		            	if ($discount) {
				            $data['discount'] = $discount;
				            $price = (int)($mrp_price - ($mrp_price * $discount * .01));
				            $data['price'] = $price;
			            }
		            }
		            

                    $data['sub_title'] = $this->input->post('sub_title'); 
			        $data['section1'] = $this->input->post('section1'); 
		           	$data['section3'] = $this->input->post('section3'); 
		            $data['short_description'] = $this->input->post('short_description');
		            $data['description_top'] = $this->input->post('description_top');
		            //$data['description_middle'] = $this->input->post('description_middle');
		            $data['description_bottom'] = $this->input->post('description_bottom');
		            $data['status']  = $this->input->post('status');
		            $data['created_at']  = date('Y-m-d h:i:s'); 
		           
		           	$accordian = array();
		           	$accordian['ac_title'] = $this->input->post('ac_title');
		           	$accordian['ac_description'] = $this->input->post('ac_description');
		           	$data['description_middle'] = json_encode($accordian);

		            $data['section2'] = $this->input->post('section2'); 
		            $data['right_section2'] = $this->input->post('right_section2'); 
		            $data['left_section2'] = $this->input->post('left_section2'); 
		            
		            $data['right_section1'] = $this->input->post('right_section1'); 
		            $data['left_section1'] = $this->input->post('left_section1'); 
		           
		            $data['meta_title'] = $this->input->post('meta_title'); 
			        $data['meta_keyword'] = $this->input->post('meta_keyword'); 
			        $data['meta_description'] = $this->input->post('meta_description'); 
			        if ($this->input->post('domain_id')) {
		            	$data['domain_id'] = $this->input->post('domain_id'); 
		            }
		            $data['corporate_company_id'] = $this->input->post('corporate_company_id');
			        $update = $this->common_model->commonUpdate('our_services_corporate_domain',$data,array('id'=>$id));
		            //echo $this->db->last_query();
		             
		            if($update) {
		                $this->session->set_flashdata('success','Our Services Data Update Successfully!!');
		                redirect($this->url1.'/'.$this->url2.'?corporate_company_id='.$data['corporate_company_id']);
		            } else {
		                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
		                redirect($this->url1.'/'.$this->url2);
		            }
		        } else {
		        	       
		        }
         	}

        } 
        $result_data['corporate_domain'] = $this->common_model->get_all_details('corporate_domain',array('status'=>1))->result();
        $rows = $this->common_model->get_all_details('corporate_company',array())->result();
        $result_data['corporate_company'] = $rows;
        $this->load->view($this->url1.'/'.$this->url2.'/addEdit',$result_data);  
	}
	public function serviceDelete($id){
		$this->getPermission('admin/ourcorporateservices/serviceDelete');
			$result_data = $this->Dashboard_Model->common_row($id,'our_services_corporate_domain');
	    	$delete = $this->Dashboard_Model->common_delete($id,'our_services_corporate_domain');
    	   	if($delete) {
    	       $this->session->set_flashdata('success','Our Services Data delete successfully');
               redirect($this->url1.'/'.$this->url2.'?corporate_company_id='.$result_data->corporate_company_id);
    	   	} else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect($this->url1.'/'.$this->url2.'?corporate_company_id='.$result_data->corporate_company_id);
    	   	}
	}
	public function serviceStatusUpdate(){
	    $id = $this->input->post('id');
	    $domain_id = $this->input->post('domain_id');
	    $status = $this->input->post('status'); 
	    $data = ['status'=> $status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'our_services_corporate_domain');
	    echo $update;   
	}
	function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = 'our_services_corporate_domain';
            if ($table) {
                $tbl_name = $table;
            }

            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            
            $row = $this->common_model->get_all_details($tbl_name,$con)->row_array();
            
            $condition = ' WHERE status = 1 AND corporate_company_id = "'.$row['corporate_company_id'].'" AND ui_order >= '.$ui_order;
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