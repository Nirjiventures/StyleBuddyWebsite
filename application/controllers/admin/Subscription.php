<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->logged_in();
        $this->tbl_name = 'subscription_plan';
    }
	
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
    public function index(){
        $this->getPermission('admin/subscription');
        $table = $this->tbl_name;
        $condition = " WHERE id != '0' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $this->load->view('admin/subscription/list',$data);
    }
    public function add(){ 
        $this->getPermission('admin/subscription/add');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = $this->tbl_name;
        $postData = $this->input->post();
        
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = 'Service';
        
        if (!empty($postData)) {            
            $this->form_validation->set_rules('package_name', 'package_name', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                
                
                $insert_data['package_name']      = trim($this->input->post('package_name'));
                $insert_data['package_description']      = trim($this->input->post('package_description'));
                $insert_data['package_price']      = trim($this->input->post('package_price'));
                $insert_data['valid_days']      = trim($this->input->post('valid_days'));
                $insert_data['total_job']      = trim($this->input->post('total_job'));
                
                $insert_data['created_at']  = date("Y-m-d h:i:s");
                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);
                if($updateTrue){
                    $this->setErrorMessage('success','Data has been successfully updated');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->setErrorMessage('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        
        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 AND services_created_flag = 0 ')->result_array();
        //echo $this->db->last_query();
        $data['area_expertise'] = $loggedRow;

        $this->load->view('admin/subscription/addedit',$data);
    }
    public function edit($id=''){
        $this->getPermission('admin/subscription/edit'); 
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        //$this->db->query("ALTER TABLE `ask-quote` ADD `allocated_name` VARCHAR(255) NULL AFTER `allocated_id`");
        $tbl_name = $this->tbl_name;
        $postData = $this->input->post();
        
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = ' Entry List';
        if (!empty($postData)) {            
            $this->form_validation->set_rules('package_name', 'package_name', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                $insert_data['package_name']      = trim($this->input->post('package_name'));
                $insert_data['package_description']      = trim($this->input->post('package_description'));
                $insert_data['package_price']      = trim($this->input->post('package_price'));
                $insert_data['valid_days']      = trim($this->input->post('valid_days'));
                $insert_data['total_job']      = trim($this->input->post('total_job'));
                 
                $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));
                if($updateTrue){
                    $this->setErrorMessage('success','Data has been successfully updated');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->setErrorMessage('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        if ($id!='') {
            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();
            $data['record_detail'] = $record_detail  ;  
        }
        $this->load->view('admin/subscription/addedit',$data);
    }
    public function delete($id){
        $this->getPermission('admin/subscription/delete');
        $table = $this->tbl_name;
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','subscription deleted successfully!!');
            redirect('admin/subscription');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/subscription');
        }
    }
    function changeStatus(){ 
        $type = $this->input->post('status');  
        $id = $this->input->post('id');  
        $table = $this->tbl_name;
        $params = array('status'=>$type);
        $this->common_model->commonUpdate($table,$params,array('id'=>$id));
        //echo $this->db->last_query();
        echo $type; 
        die;
    }
    function update_ui_order($ui_order='',$id='',$category=''){ 
        if ($id) {
            $tbl_name = $this->tbl_name;
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
                    $params = array('ui_order'=>$order,'status'=>1);
                    $con = array('id'=>$value['id']);
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