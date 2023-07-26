<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Corporate_user extends MY_Controller {
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
        $this->table = 'vender';
    }
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	public function export(){
        $filename = 'data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        /**/
        $tbl_name = $this->table;
		$str = " WHERE user_type = '6' ";
		if ($this->input->get('corporate_company_id')) {
			$st = " WHERE corporate_company_id = '".$this->input->get('corporate_company_id')."'";
			$que = $this->common_model->get_all_details_distinct_query('id','corporate_domain',$st)->result_array();
			$i = 0;
			$tt = '';
			foreach ($que as $key => $value) {
				if ($i > 0) {
					$tt .= ' OR ';
				}
				$tt .= ' domain_id = '.$value['id'];
				$i++;
			}
			if ($tt) {
				$str .= 'AND ('.$tt.')';
			}
		}
        if ($this->input->get('domain_id')) {
			$str .= " AND domain_id = '".$this->input->get('domain_id')."'";
		}
        $str .= " order by id desc";

        /**/
        /*$tbl_name = 'vender';
        $str = " WHERE user_type = '6' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $str .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $str .= ' AND status = '.$_GET['status'];
        }
         
        $str .= " order by id DESC";*/
        $query = $this->db->query('SELECT fname, lname, mobile, email, city_name,state_name,created_at FROM vender'.$str);
        $usersData = $query->result_array();
       
        $file = fopen('php://output', 'w');
 
        $header = array("First Name","Last Name","Mobile","Email","City Name","State Name","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}

	public function index(){
		$this->getPermission('admin/corporate_user');	
	    $tbl_name = $this->table;
		$str = " WHERE user_type = '6' ";
		if ($this->input->get('corporate_company_id')) {
			$st = " WHERE corporate_company_id = '".$this->input->get('corporate_company_id')."'";
			$que = $this->common_model->get_all_details_distinct_query('id','corporate_domain',$st)->result_array();
			$i = 0;
			$tt = '';
			foreach ($que as $key => $value) {
				if ($i > 0) {
					$tt .= ' OR ';
				}
				$tt .= ' domain_id = '.$value['id'];
				$i++;
			}
			if ($tt) {
				$str .= 'AND ('.$tt.')';
			}
		}
        if ($this->input->get('domain_id')) {
			$str .= " AND domain_id = '".$this->input->get('domain_id')."'";
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
		$this->getPermission('admin/corporate_user/add');	
		$postData = $this->input->post();
        if ($postData) {
		    $this->form_validation->set_rules('domain_name', 'Service Title', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    if($this->form_validation->run()) {
		        $data['domain_name'] = $this->input->post('domain_name'); 
		        $data['slug'] = url_title( $data['domain_name'], 'dash', true);
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('Y-m-d h:i:s'); 
	            $insert = $this->Dashboard_Model->common_insert($data,$this->table);
	            if($insert) {
	                $this->session->set_flashdata('success','Our Services Data Insert Successfully!!');
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
		$this->getPermission('admin/corporate_user/edit');	
        $result_data['datas'] = $this->Dashboard_Model->common_row($id,$this->table);
        if(empty($result_data['datas'])) {
         	redirect($this->url1.'/'.$this->url2);
        }else{
         	$postData = $this->input->post();
         	if ($postData) {
         		$this->form_validation->set_rules('domain_name', 'Domain Name', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			    $id = $this->input->post('id');
			    if($this->form_validation->run()) {
		            $data['domain_name'] = $this->input->post('domain_name'); 
			       	$data['status']  = $this->input->post('status');
		            $update = $this->common_model->commonUpdate($this->table,$data,array('id'=>$id));
		            if($update) {
		                $this->session->set_flashdata('success','Our Services Data Update Successfully!!');
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
	public function delete($id){
		$this->getPermission('admin/corporate_user/edit');	
	    $delete = $this->Dashboard_Model->common_delete($id,$this->table);
    	   if($delete) {
    	       $this->session->set_flashdata('success','Domain deleted successfully');
               redirect($this->url1.'/'.$this->url2);
    	   } else {
               $this->session->set_flashdata('error','Something Went Wrong');
               redirect($this->url1.'/'.$this->url2);
    	   }
	}
	public function statusUpdate(){
	    $id = $this->input->post('id');
	    $status = $this->input->post('status'); 
	    $data = array();
	    $data['status'] = $status;
	    //if($status){
	        $data['email_verification'] = 1;
	    //}
	    
	    
	    $update = $this->Dashboard_Model->common_update($id,$data,$this->table);
	    echo $update;   
	}
	function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = $this->table;
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