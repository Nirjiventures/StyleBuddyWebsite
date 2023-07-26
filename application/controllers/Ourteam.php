<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ourteam extends MY_Controller {
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
     
    public function team(){  
        $list = $this->db->query('select * from cms_pages where slug = "ourteam" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result(); 
        $data['datas'] = $this->db->get_where('ourteam',['status'=> 1])->result();
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/ourteam/team',$data);
        $this->load->view('front/template/footer',$data);
    }

     
}

