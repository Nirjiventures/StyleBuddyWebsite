<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gift extends MY_Controller {
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
    public function giftcard(){
        $gift_id = base64_decode(base64_decode(base64_decode($this->uri->segment(3))));
        
        if (!$gift_id) {
           redirect(base_url('shop'));
        }
        $postData = $this->input->post();
        $giftCradRow = $this->common_model->get_all_details('gift',array('id'=> $gift_id))->row_array();
         

       
        $loggedRow = array();
        if ($this->session->userdata('userId')) {
            $loggedRow = $this->common_model->get_all_details('vender',array('id'=> $this->session->userdata('userId')))->row_array();
        }
        
        $data11['giftCradRow'] = $giftCradRow;
        $data11['loggedRow'] = $loggedRow;
        $data11['callback_url']       = base_url().'razorpay/giftcard_booking';
        $data11['surl']               = base_url().'razorpay/giftcard_booking_success';;
        $data11['furl']               = base_url().'razorpay/failed';
        
        
         
        $list['meta_title'] = ($giftCradRow['meta_title'])?$giftCradRow['meta_title']:$giftCradRow['name'].'';
        $list['meta_description'] = ($giftCradRow['meta_description'])?$giftCradRow['meta_description']:$giftCradRow['description'];
        $list['meta_keyword'] = ($giftCradRow['meta_keyword'])?$giftCradRow['meta_keyword']:$giftCradRow['description'];
        $list['meta_image'] = ($giftCradRow['media'])?$giftCradRow['media']:'';
        $data11['seoData'] = (object)$list;
        
        $data11['currency_code']      = 'INR';
        $data11['package_price']      = $giftCradRow['gift_code_price'];
        $this->load->view('front/gift-quote',$data11);

    }

    
}

