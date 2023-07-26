<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RakhiLeads extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
         $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        $this->load->model('common_model');
        $this->logged_in();
        $this->tbl_name = 'festival_form';
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
    }
	
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
     
    public function index(){
        $table = 'festival_form';
        $condition = " WHERE id != '0' ";
        $condition .= " order by id DESC";

        $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
        $data['list'] = $list;
        $this->load->view('admin/rakhiLeads/list',$data);
    }
    public function delete($id){
        $url1  =$this->uri->segment(1);
        $url2  =$this->uri->segment(2);
        $url3  =$this->uri->segment(3);
        $table = 'festival_form';
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Lead deleted successfully!!');
            redirect('admin/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/'.$url2);
        }
    }
     

}    