<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Adminusers extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->uploadPath = 'assets/images/vandor/';
    }
    public function index() {
        $this->getPermission('admin/adminusers');
    	$url1 = $this->uri->segment(1);
		$url2 = $this->uri->segment(2);
		$url3 = $this->uri->segment(3);
		//$data['permission'] =   $this->getPermission();
		//$this->loginPermission();
		$tbl_name = "user_master";
		
		$condition = " WHERE id != '1'";
		 
		
		$condition .= "order by id DESC";
		$list 	=  $this->common_model->get_all_details_query($tbl_name,$condition)->result();
		
		$data['title'] = 'Admin Users List';
		$data['list_heading'] = 'Admin Users List';
		$data['right_heading'] = 'Add';
		$data['users'] =  $list;
		$thumb = 'placeholder.png';
		$segment2 = $this->uri->segment(2);
		$this->load->view('admin/'.$segment2.'/list', $data);
    }
     
	function edit($id=''){ 
	    $this->getPermission('admin/adminusers/edit');
		$url1 = $this->uri->segment(1);
		$url2 = $this->uri->segment(2);
		$url3 = $this->uri->segment(3);

		//$data['permission'] =   $this->getPermission();
		//$this->loginPermission();
		$tbl_name = 'user_master';
		$postData = $this->input->post();
		 
		
		
		 
		$data['title'] = 'Edit ';
		$data['list_heading'] = 'Edit';
		$data['right_heading'] = 'Users List';
		
		if ($id!='') {
			$data['record_detail'] = $record_detail    =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();	
        }
		if (!empty($postData)) {			
			$this->form_validation->set_rules('name', 'name', 'trim|required');	
			if($this->form_validation->run()== TRUE){
				$insert_data 				= array();
				$multiImage = $this->uploadSingleImageOnly('profilephoto',$this->uploadPath);
                if(!empty($multiImage)){
                    $insert_data['profilephoto']=  trim($multiImage,',');
                }

				$insert_data['name']	= trim($this->input->post('name'));
				//$insert_data['phone']		= trim($this->input->post('phone'));
				$insert_data['permission']		= trim(serialize($this->input->post('permission')));
				if ($id!='') { 
					if($this->input->post('password')!=''){ 
						$insert_data['password']= md5(trim($this->input->post('password')));
					}
					$updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));
				}
				else{ 
					$insert_data['password']	= md5(trim($this->input->post('password')));
					$updateTrue 				= $this->common_model->simple_insert($tbl_name,$insert_data);
				}
				//echo $this->db->last_query();die;
				if($updateTrue){
					$this->session->set_flashdata('success','Data has been successfully updated');
					redirect(base_url($url1.'/'.$url2));						
				}else{
					$this->session->set_flashdata('error','Opps! something went wrong, please try again');
					$data['message_error'] = 'Opps! something went wrong, please try again';
				}
			}				
		}
		$segment2 = $this->uri->segment(2);
	    $this->load->view('admin/'.$segment2.'/addedit', $data);
    }
	 
	function add(){ 
		//$data['permission'] =   $this->getPermission();
		//$this->loginPermission();
		$tbl_name = 'user_master';
		$postData = $this->input->post();

		$url1 = $this->uri->segment(1);
		$url2 = $this->uri->segment(2);
		$url3 = $this->uri->segment(3);
		
		$data['title'] = 'Add New';
		$data['list_heading'] = 'Add New';
		
		$data['right_heading'] = 'Users List';
		
		$department = $this->input->post('department');
		
		 
        if (!empty($postData)) {
			$this->form_validation->set_rules('name', 'name', 'trim|required');	
			if($this->form_validation->run()== TRUE){
				$emailRow = $this->common_model->get_all_details($tbl_name,array('email'=>trim($this->input->post('email'))))->row();
				if($emailRow){
					$this->setErrorMessage('error','Opps! Email already exists, please try other email id again');
					$data['message_error'] = 'Opps! something went wrong, please try again';	
				}else{
					$insert_data 				= array();
					$multiImage = $this->uploadSingleImageOnly('profilephoto',$this->uploadPath);
	                if(!empty($multiImage)){
	                    $insert_data['profilephoto']=  trim($multiImage,',');
	                }

					
					$insert_data['name']	= trim($this->input->post('name'));
					$insert_data['email']	= trim($this->input->post('email'));
					//$insert_data['phone']		= trim($this->input->post('phone'));
					$insert_data['status']		= 1;
					$insert_data['password']	= md5(trim($this->input->post('password')));
					$insert_data['permission']		= trim(serialize($this->input->post('permission')));

					$updateTrue 				=$this->common_model->simple_insert($tbl_name,$insert_data);
					if($updateTrue){
						$this->session->set_flashdata('success','Data Insert Successfully!!');
						redirect(base_url($url1.'/'.$url2));					
					}else{
						$this->session->set_flashdata('error','Opps! something went wrong, please try again');
						$data['message_error'] = 'Opps! something went wrong, please try again';
					}
				}						
			}				
		}
		$segment2 = $this->uri->segment(2);
		$this->load->view('admin/'.$segment2.'/addedit', $data);
    }
 
	 
	function changeStatus($id='',$type=''){   
		$tbl_name = 'user_master';
		$id = $this->input->post('id');
	    $status = $this->input->post('status'); 
        $params = ['status'=>$status];
	    

		//$params = array('status'=>$type);
			
		$this->common_model->commonUpdate($tbl_name,$params,array('id'=>$id));
		echo $type;	
		die;
	}
	function changeStatusAll(){ 
		$ids = $_POST['ids'];
		$type = $_POST['type'];
		$tbl_name = 'user_master';
		foreach($ids as $id){
			if(!empty($id)){
				$params = array('status'=>$type);
				$this->common_model->commonUpdate($tbl_name,$params,array('id'=>$id));
			}
		}
		echo $type;	
		die;
	}
	
	function deleteAll(){ 
		$ids = $this->input->post('ids');
		$tbl_name = 'user_master';
		$msg = 1;
		$success_count = 0;
		$error_count = 0;
		foreach($ids as $id){
			if(!empty($id)){
				$this->common_model->commonDelete($tbl_name,array('id'=>$id));
				$success_count += 1;
			}
		}
		$data['msg'] = $msg;
		$data['status'] = 1;
		$data['error_count'] = $error_count;
		$data['success_count'] = $success_count;
		echo json_encode($data);	
		die;
	}
	
	public function delete($id){
        $this->getPermission('admin/adminusers/delete'); 
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        //$table = $this->tbl_name;
        $table = 'user_master';
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Data deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

	function deleteRecord() {
		$id = $this->input->post('id');
		$tbl_name = 'user_master';
		$msg = 1;
		$success_count = 0;
		$error_count = 0;
		if($id!=''){
			$deleted  = $this->common_model->commonDelete($tbl_name,array('id'=>$id));
			$success_count += 1;
		}
		$data['msg'] = $msg;
		$data['status'] = 1;
		$data['error_count'] = $error_count;
		$data['success_count'] = $success_count;
		echo json_encode($data);	
		die;		
	}
	
}