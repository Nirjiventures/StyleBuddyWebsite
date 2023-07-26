<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package_renewal extends MY_Controller {

    function __construct()

	{

    
        parent::__construct();

        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();

        $this->load->model('common_model');

    }

    public function index(){   

        $data = $this->Page_Model->common_all('');

        $postData = $this->input->post();



        $query = $this->db->query("select * from vender  WHERE package_status = 1");

        $rows = $query->result_array();

        foreach($rows as $k=>$v){

            $dateToday = date('Y-m-d');

            $package_expire_date = $v['package_expire_date'];

            $package_expire_date = '2023-01-22';



            $date1 = strtotime($dateToday);  

            $date2 = strtotime($package_expire_date); 

            $diff = abs($date2 - $date1);  

            $days   = floor($diff / (60*60*24)); 



            if ($days <= 15) {

                if (($date2 - $date1) > 0) {

                    $option='<p>You package expire soon. Please <a href="'.base_url('buy-styling-packages').'">click here</a> for renewal</p>';

                }else{

                    $option='<p>You package expired. Please <a href="'.base_url('buy-styling-packages').'">click here</a> for renewal</p>';

                }

                



                

                $mailContent =  mailHtmlHeader($this->site);

                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($v['fname'].' '.$v['lname']).'</h3>';

                    $mailContent .= $option;

                    $mailContent .= mailHtmlFooter($this->site);

                

                $subject = 'Stylebuddy Package Renewal';

                $to      =  $v['email'];

                $to      =  'vijay@gleamingllp.com';

                $from = FROM_EMAIL;

                $from_name = $this->site->site_name;

                $cc = CC_EMAIL;

                $reply = REPLY_EMAIL;

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 

            }

        }

    }

}



