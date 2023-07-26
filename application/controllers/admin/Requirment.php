<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Requirment extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'requirment';

    }

	

	private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }
    }

    public function index(){

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

        $this->load->view('admin/requirment/list',$data);
    }

    public function add(){ 

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Add ';

        $data['list_heading'] = 'Add';

        $data['right_heading'] = 'Requirement';

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('title', 'title', 'trim|required'); 

            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                $insert_data['title']      = trim($this->input->post('title'));
                $insert_data['amount']      = trim($this->input->post('amount'));
                $insert_data['created_at']  = date("Y-m-d h:i:s");
                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);
                if($updateTrue){
                    $this->session->set_flashdata('success','Requirement has been successfully inserted');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        $this->load->view('admin/requirment/addedit',$data);
    }
    public function edit($id=''){ 

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = 'Requirement List';
        if (!empty($postData)) {            
            $this->form_validation->set_rules('title', 'title', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                $insert_data['title']      = trim($this->input->post('title'));
                $insert_data['amount']      = trim($this->input->post('amount'));
                $insert_data['updated_at']  = date("Y-m-d h:i:s");
                $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));
                if($updateTrue){
                    $this->session->set_flashdata('success','Requirement has been successfully updated');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        if ($id!='') {
            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();
            $data['record_detail'] = $record_detail  ;  
        }
        $this->load->view('admin/requirment/addedit',$data);
    }
    public function delete($id){
        $table = $this->tbl_name;
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Requirement deleted successfully!!');
            redirect('admin/requirment');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/requirment');
        }
    }

    public function change_status(){
        $table = $this->tbl_name;
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['status'=> $status];
        $update = $this->common_model->commonUpdate($table,$data,array('id'=>$id));
        echo $update;   
    }

}    