<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ourteam extends CI_Controller {
	
	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
    }
	public function index(){ 
			$this->getPermission('admin/ourteam');  
			$ourteam = $this->db->query('select * from ourteam order by id desc')->result();
	    	$data['datas'] = $ourteam;
	     
			$this->load->view('admin/template/header');
			$this->load->view('admin/ourteam/list',$data);
			$this->load->view('admin/template/footer');
	}
	
	public function add($id=''){ 
		$this->getPermission('admin/ourteam/add');  
    	$postData = $this->input->post();
		if (!empty($postData)) {
			$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
		    $this->form_validation->set_rules('lname', 'last Name', 'required|trim');
		    $this->form_validation->set_rules('email', 'email', 'required|trim');
		    $this->form_validation->set_rules('mobile', 'mobile', 'required|trim');
		    $this->form_validation->set_rules('status', 'Status', 'required|trim');
		    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
		    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
		    
		    if($this->form_validation->run()) {
		    	$this->uploadPath = 'assets/images/ourteam/';
	            $image = $this->uploadSingleImage('image',$this->uploadPath);
	            if(!empty($image)){
	                $data['image'] = $image;
	            }

		        $data['fname'] = $this->input->post('fname'); 
		        $data['lname'] = $this->input->post('lname'); 
		        $data['email'] = $this->input->post('email'); 
		        $data['mobile'] = $this->input->post('mobile'); 
	            $data['address']  = $this->input->post('address');
	            $data['designation']  = $this->input->post('designation');
	            $data['experience']  = $this->input->post('experience');
	            $data['about']  = $this->input->post('about');
	            $data['more_about']  = $this->input->post('more_about');
	           
	            $data['status']  = $this->input->post('status');
	            $data['created_at']  = date('d m Y h:i:s'); 
	            //$data['slug'] = url_title($data['fname'].' '.$data['lname'], 'dash', true);
	            
	            $insert = $this->db->insert('ourteam',$data);
	            if($insert) {
	                $this->session->set_flashdata('success','Team added Successfully!!');
	            } else {
	                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
	            }
	        	redirect('admin/ourteam');
	        }

		}
		$ourteam = array();
		$data['datas'] = $ourteam;
		$this->load->view('admin/template/header');
		$this->load->view('admin/ourteam/add',$data);
		$this->load->view('admin/template/footer');
  	}
	public function view($id){

		if (ctype_digit(strval($id)) ) {
			$ourteam = $this->db->query('select * from ourteam where id = '.$id)->row();
			$data['datas'] = $ourteam;
			$this->load->view('admin/template/header');
			$this->load->view('admin/ourteam/view',$data);
			$this->load->view('admin/template/footer');

		} else {
			redirect('admin/ourteam');
		}
	}
	public function edit($id){
		$this->getPermission('admin/ourteam/edit'); 
		if (ctype_digit(strval($id)) ) {
			$postData = $this->input->post();
			if (!empty($postData)) {
				$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
			    $this->form_validation->set_rules('lname', 'last Name', 'required|trim');
			    $this->form_validation->set_rules('email', 'email', 'required|trim');
			    $this->form_validation->set_rules('mobile', 'mobile', 'required|trim');
			    $this->form_validation->set_rules('status', 'Status', 'required|trim');
			    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
			    $this->form_validation->set_rules('is_unique', 'The %s entered is already in use');
			    
			    if($this->form_validation->run()) {
			    	$this->uploadPath = 'assets/images/ourteam/';
		            $image = $this->uploadSingleImage('image',$this->uploadPath);
		            if(!empty($image)){
		                $data['image'] = $image;
		            }

			        $data['fname'] = $this->input->post('fname'); 
			        $data['lname'] = $this->input->post('lname'); 
			        $data['email'] = $this->input->post('email'); 
			        $data['mobile'] = $this->input->post('mobile'); 
		            $data['address']  = $this->input->post('address');
		            $data['designation']  = $this->input->post('designation');
		            $data['experience']  = $this->input->post('experience');
		            $data['about']  = $this->input->post('about');
		            $data['more_about']  = $this->input->post('more_about');
		           
		            $data['status']  = $this->input->post('status');
		            $data['created_at']  = date('d m Y h:i:s'); 
		            //$data['slug'] = url_title($data['fname'].' '.$data['lname'], 'dash', true);
		            
		            $this->db->where('id',$id);
		            $insert = $this->db->update('ourteam',$data);
		            if($insert) {
		                $this->session->set_flashdata('success','Team updated Successfully!!');
		            } else {
		                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
		            }
		        	redirect('admin/ourteam');
		        }

			}
			$ourteam = $this->db->query('select * from ourteam where id = '.$id)->row();
			$data['datas'] = $ourteam;
			$this->load->view('admin/template/header');
			$this->load->view('admin/ourteam/edit',$data);
			$this->load->view('admin/template/footer');

		} else {
			redirect('admin/ourteam');
		}
	}
	
	
	public function delete($id){
		$this->getPermission('admin/ourteam/delete'); 
		$this->db->where('id', $id);
		$this->db->delete('ourteam');
		redirect('admin/ourteam');
	}
	public function changeStatus(){
		$id = $this->input->post('id');
		$status = $this->input->post('status'); $data = ['status'=>$status];

		$this->db->where('id', $id);
		$update = $this->db->update('ourteam',['status'=>$status]);
		echo $update;
	}
	
	public function uploadSingleImage($filename,$path){
        $files = $_FILES;
        $timeImg = '';
        if(!empty($_FILES[$filename]['name'])){
            $tempFile = $files[$filename]['tmp_name'];
            //$temp = $files[$filename]["name"];
            $temp = strtolower(basename($files[$filename]["name"]));
            $path_parts = pathinfo($temp);
            $t =  time();
            $ImageName = 'image'. $t . '.' . $path_parts['extension'];
            $targetFile = $path . $ImageName ;
            move_uploaded_file($tempFile, $targetFile);
             
            $p = str_replace('assets/images/','',$path);
            return trim($p.$ImageName);
        }
        
    }
    public function uploadMultipleImage($filename,$path){
        if(is_array($_FILES[$filename]['name'])){
            $cpt = count($_FILES[$filename]);
            $ImageName = '';
            $timeImg = '';
            for($i=0; $i<$cpt; $i++){
                if(!empty($_FILES[$filename]['name'][$i])){
                    $tempFile = $_FILES[$filename]['tmp_name'][$i];
                    //$temp = $_FILES[$filename]['name'][$i];
                    $temp = strtolower(basename($_FILES[$filename]["name"][$i]));
                    $path_parts = pathinfo($temp);
                    $t =  time();
                    $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
                    $targetFile = $path . $fileName_ ;
                    move_uploaded_file($tempFile, $targetFile);
                     
                    $p = str_replace('assets/images/','',$path);
                    $ImageName .= ','.$p.$fileName_;
                }
            }
            return trim($ImageName,',');
        }else{
            $files = $_FILES;
            if(!empty($_FILES[$filename]['name'])){
                $tempFile = $_FILES[$filename]['tmp_name'];
                $temp = $_FILES[$filename]["name"];
                $path_parts = pathinfo($temp);
                $t =  time();
                $ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];
                $targetFile = $path . $ImageName ;
                move_uploaded_file($tempFile, $targetFile);
                $p = str_replace('assets/images/','',$path);  
                return trim($p.$ImageName);
            }
        }
    }
    public function update_ui_order($ui_order='',$id='',$table=''){ 
        if ($id) {

            $tbl_name = 'ourteam';
            if ($table) {
                $tbl_name = $table;
            }

            if ($ui_order) {
                $params = array('ui_order'=>$ui_order);
            }
            $con = array('id'=>$id);
            $this->common_model->commonUpdate($tbl_name,$params,$con);
            $condition = ' WHERE status = 1 AND ui_order >= '.$ui_order;
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