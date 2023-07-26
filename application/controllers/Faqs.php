<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faqs extends MY_Controller {
    function __construct(){

        parent::__construct();

        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        

        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();
        $this->load->model('common_model');
        $this->userID = $this->session->userdata('userId');
        $this->venderId = $this->session->userdata('venderId');

        
        

    }
    public function index(){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $table = 'faqs_category';
        $condition = " WHERE id != '0' ";
        $condition .= " order by id ASC";
        $list = $this->common_model->get_all_details_query($table,$condition)->result();
        foreach ($list as $key => $value) {
            $condition = " WHERE cat_id = '".$value->id."' ";
            $condition .= " order by id ASC";
            $rows = $this->common_model->get_all_details_query('faqs',$condition)->result();
            $list[$key]->rows = $rows;
        }
        $data['list'] = $list;

            
        $list = $this->db->query('select * from cms_pages where slug = "faqs" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $data['parentCategory'] = $this->data['parentCategory'];   
        $this->load->view('front/faqs',$data);

    }
}    