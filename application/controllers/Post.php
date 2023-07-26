<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends MY_Controller {
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
    public function jobs(){ 
        $where = "WHERE user_type = 2 ORDER BY count_view DESC  limit 0,2";
        $query = $this->common_model->get_all_details_query("vender",$where);
        $rows = $query->result();
        foreach($rows as $k=>$v){
            $where = "WHERE status = 1 AND user_id = '".$v->id."' ORDER BY id DESC";
            $query = $this->common_model->get_all_details_query("review",$where);
            $row = $query->row();
            $rows[$k]->review = $row;
        }
        $data['tranding_vendor'] = $rows;
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "post-jobs" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/jobs/post-job',$data);

    }
}