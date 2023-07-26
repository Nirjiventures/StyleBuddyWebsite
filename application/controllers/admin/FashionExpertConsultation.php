<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FashionExpertConsultation extends MY_Controller {
	
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
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        
        $table = 'ask_quote_online';
        //$condition = " WHERE festival_name = 'Rakhi' ";
        $condition = " order by id DESC";

        $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
        $data['list'] = $list;
        $data['title'] = 'Fashion Expert Consultation';
        $data['list_heading'] = 'Fashion Expert Consultation';
        $data['right_heading'] = 'Add';
        $this->load->view('admin/fashionExpertConsultation/list',$data);
    }
    public function export(){

        $filename = 'fassion_expert_consultation_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'ask_quote_online';
        //$tbl_name = 'contact-us';
        $str = " WHERE id != '0' ";
        $str .= " order by id desc";
        $query = $this->db->query('SELECT full_name,email,mobile,city,area_expertise,total_price,message,created_at FROM '.$tbl_name.$str);
        //echo $this->db->last_query();die;
        $usersData = $query->result_array();

        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Phone","City","Consultation Topic","Consultation Fees","Message","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }
    public function delete($id){
        $url1  =$this->uri->segment(1);
        $url2  =$this->uri->segment(2);
        $url3  =$this->uri->segment(3);
        $table = 'ask_quote_online';
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Fashion Expert Consultation deleted successfully!!');
            redirect('admin/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/'.$url2);
        }
    }
     

}    