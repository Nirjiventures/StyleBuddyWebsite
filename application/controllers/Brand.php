<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand extends MY_Controller {
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
    public function all(){   
        $data = $this->Page_Model->common_all('');
        $postData = $this->input->post();
                $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "brand-partners" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $brand = $this->common_model->get_all_details('brand',array())->result();
        $data['brand'] = $brand;
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/brand',$data);
        $this->load->view('front/template/footer',$data);

    }
    
}

