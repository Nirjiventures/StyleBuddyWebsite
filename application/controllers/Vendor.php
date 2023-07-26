<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends MY_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        
        $this->userID = $this->session->userdata('userId');
        $this->venderId = $this->session->userdata('venderId');
        $this->load->model('common_model');
    }
    public function stylingreport(){
        $table = 'package_report_pdf';
        $condition = " WHERE user_id = '".$this->userID."' ";
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
        foreach ($list as $key => $value) {
            $table = 'user_order_details';
            $condition = " where id =".$value->order_detail_id." order by id DESC";
            $r = $this->db->query('SELECT * FROM '.$table.''.$condition)->row();
            $list[$key]->order_detail = $r;

            $str = " WHERE id = ".$value->user_id." ";
            $query   =  $this->common_model->get_all_details_query('vender',$str);
            $row1 =  $query->row();
            $list[$key]->user_row = $row1;
        }
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/service_report',$data);
         
    }
    public function stylingreportdetail($id){
        $table = 'package_report_pdf';
        $str = " WHERE id = ".$id." ";
        $query   =  $this->common_model->get_all_details_query($table,$str);
        $row =  $query->row();


        $tbl_name = 'user_order_details';
        $str = " WHERE id = ".$row->order_detail_id." AND cart_type = 'service' ORDER BY id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,$str);
        $r =  $query->row();
        $row->report_detail = $r;
        $data['order_detail'] = $row;

        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/service_report_detail',$data);
         
    }
    public function consultorder(){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->session->userdata('venderId')){
            $table = 'consult_order';
            $condition = " where user_id =".$this->session->userdata('venderId')." order by id DESC";

            $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
            $data['list'] = $list;
            $data['title'] = 'Fashion Expert Consultation';
            $data['list_heading'] = 'Fashion Expert Consultation';
            $data['right_heading'] = 'Add';
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        
            $this->load->view('front/vandor/consult_order',$data); 
        }else{
             redirect(base_url()); 
        }
        
    }
    public function consultorderview($id){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->session->userdata('venderId')){
            $data['order'] = $order = $this->db->get_where('consult_order',['id'=> $id,'user_id'=> $this->session->userdata('venderId')])->row_array();
            $option = '<div class="summery_order">';
                $option = '<div class="row align-items-center">
                                <div class="col-sm-12">
                                    <p class="odds">
                                        <b>Order ID : #'.$order['id'].' | </b>
                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>
                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>
                                        Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'
                                    </p>
                                </div>
                            </div>';
                     $option .= '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">';

                            $option .= '<tr style="border: 1px solid #333;">
                                <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>
                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>
                            </tr>';
                            $option .= '<tr style="border: 1px solid #333;">
                                <td style="border: 1px solid #333;" class="text-left"><b>Email : </b></td>
                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['email']).'</td>
                            </tr>';
                            if ($order['mobile']) {
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333;" class="text-left"><b>Mobile : </b></td>
                                    <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['mobile']).'</td>
                                </tr>';
                            }
                            $option .= '<tr style="border: 1px solid #333;">
                                <td colspan="2" style="text-align:center"><h5>Package Info </h5></td>
                            </tr>';
                            $option .= '<tr style="border: 1px solid #333;">
                                <td colspan="2" style="text-align:center"> <b>Package Name : <b>'. $order['package_name'] .'</b></td>
                            </tr>';
                            $option .= '<tr style="border: 1px solid #333;">
                                <td style="border: 1px solid #333;"> <b>Package Price : </b></td>
                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['total_price']) .'</b></td>
                            </tr>';
                            $package_description =  json_decode($order['package_description']);

                            foreach ($package_description as $key => $value) {
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333;"> <b>'.$value->question_name.' : </b></td>
                                    <td style="border: 1px solid #333;"> <b>'. $value->question_value .'</b></td>
                                </tr>';
                            }
                            

                $option .= '</table>';
                 
            $option .= '</div>';
            

            $data['result']  = $option;
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        
            $this->load->view('front/vandor/consult_order_view',$data);
        }else{
             redirect(base_url()); 
        }
    }
    public function sendproposal_ajax(){
        $postData = $this->input->post();
        $id = $postData['id'];
        $vendor_id = $this->venderId;
        $condition = " WHERE vendor_id = '". $vendor_id ."' AND id = '". $id ."' AND deleted_status = 0 ";
        $r = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
        echo json_encode($r);
    }
    public function sendproposal(){
        $postData = $this->input->post();
        if($postData['service_name']){
            $services_id = $this->input->post('service_name');
            $customer_name = $this->input->post('customer_name');
            $vendor_id = $this->venderId;

            /*$condition = " WHERE vendor_id = '". $vendor_id ."' AND id = '".$services_id."' AND customer_name = '".$customer_name."'";
            $r = $this->common_model->get_all_details_query('services_vendor_proposal',$condition)->row_array();
            if (!$r) {*/
                $condition = " WHERE vendor_id = '". $vendor_id ."' AND id = '".$services_id."'";
                $rrr = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
                $insert_data= array();
                $insert_data['services_id']    = $services_id;
                $insert_data['vendor_id']    = $vendor_id;
                $insert_data['customer_date']    = trim($this->input->post('customer_date'));
                $insert_data['customer_name']    = trim($this->input->post('customer_name'));
                $insert_data['area_expertise_id']    = $rrr['area_expertise_id'];
                $insert_data['area_expertise_name']    = $rrr['area_expertise_name'];
                
                $insert_data['quote_name']      = trim($this->input->post('quote_name'));
                $insert_data['package_title_1']      = trim($this->input->post('package_title_1'));
                $insert_data['package_description_1']      = trim($this->input->post('package_description_1'));
                $insert_data['package_price_1']      = trim($this->input->post('package_price_1'));
                
                $insert_data['package_title_2']      = trim($this->input->post('package_title_2'));
                $insert_data['package_description_2']      = trim($this->input->post('package_description_2'));
                $insert_data['package_price_2']      = trim($this->input->post('package_price_2'));
                
                $insert_data['package_title_3']      = trim($this->input->post('package_title_3'));
                $insert_data['package_description_3']      = trim($this->input->post('package_description_3'));
                $insert_data['package_price_3']      = trim($this->input->post('package_price_3'));
                
                $insert_data['created_at']      = date('Y-m-d h:i:s');
                $updateTrue                 = $this->common_model->simple_insert('services_vendor_proposal',$insert_data);

                $vendor_id = $this->venderId;
                $condition = " WHERE id = '". $updateTrue ."'";
                $r1 = $this->common_model->get_all_details_query('services_vendor_proposal',$condition)->row_array();
                
                $data111['v'] = $r1;
                $data111['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
                
                try {
                    $mailContent = $this->sendproposal_html($data111);
                    $pdf_name = 'proposal_'.time() .'.pdf';
                    $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;
                    $this->createPDF($pdfFilePath, $mailContent);
                    /*$this->load->library('m_pdf'); 
                    //$this->m_pdf->pdf->AddPage();
                    $this->m_pdf->pdf->AddPageByArray([
                        'margin-left' => 0,
                        'margin-right' => 0,
                        'margin-top' => 0,
                        'margin-bottom' => 0,
                        'border' =>  '3em solid red;',
    
                    ]);
    			    $this->m_pdf->pdf->WriteHTML($mailContent);
    			    sleep(1);
                	//$this->m_pdf->pdf->Output($pdfFilePath, 'F');
                	$this->m_pdf->pdf->Output($pdfFilePath, 'I');*/
    			} catch (Exception $e) {
    				throw new MpdfException($e->getMessage());
    				return false;
    			}
                
        }

        $table = 'services_booking';
        $condition = " WHERE vendor_id = '".$this->venderId."' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();



        $vendor_id = $this->venderId;

        $condition = " WHERE vendor_id = '". $vendor_id ."' AND deleted_status = 0 ";
        $r = $this->common_model->get_all_details_query('services_vendor',$condition)->result_array();
        foreach ($r as $key => $value) {
            if ($value['admin_status']) {
                $condition = " WHERE services_id = '". $value['services_id'] ."' order by id asc";
            }else{
                $condition = " WHERE services_id = '". $value['id'] ."' order by id asc";
            }
            $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();
            $r[$key]['package_featureArray']      = $rows; 
        }

        $data['services_list'] = $r;


        $this->load->view('front/vandor/sendproposal',$data);
         

    }

    public function sendproposal_html($data111){
        $v = $data111['v'];
        $profile = $data111['profile'];
        $html = '';
        $html .= '<body style="margin:0px; font-family: \'Poppins\', sans-serif; ">';
        $html .= '<div style="width: 100%;" id="printableArea" >';
            $html .= '<style media="print">
                            @font-face {
                                font-family: \'Poppins\', sans-serif;
                                font-style: normal;
                                font-weight: 400;
                                src: url(data:https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet,
                                url(data:https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet);
                                 
                            }

                           li{margin: 5px 0px; border-bottom: 1px solid #ccc; padding-bottom: 7px; }

                          body{height:100%;}
                        </style>';

            $html .= '<div class="whole" style="border: 10px solid #742ea0; border-bottom: 0px solid #742ea0;">

                <div class="top_c" style=" position: relative;">
                    <img src="'.base_url('assets/images/header_dd.png').'" style="float:right;">
                    
                    <div class="logooo" style="text-align: center; padding: 440px 0px 52px;"><img src="'.base_url('assets/images/logo-big.png').'">
                        
                    </div>
                    
                    <img src="'.base_url('assets/images/footer_dd.png').'" style="left: 0;">
                </div>';

                
                $html .= '<div class="header" style="width: 100%; margin: 0px auto 0px; ">';
                    $html .= '<div class="logg" style="background-color: #f0f0f0;  -webkit-print-color-adjust: exact; padding: 20px; text-align:center; ">';
                        $html .= '<img src="'.base_url('assets/images/'.$this->site->logo).'">';
                        $quote_name = $v['quote_name'];
                        if (empty($v['quote_name'])) {
                            $quote_name = 'Proposal Quotation';
                        }
                        $html .= '<p style="font-size: 40px;font-weight: bold; margin-bottom: 80px; margin-top: 28px;">'.$quote_name.'</p>';
                    $html .= '</div>';
                    $html .= '<div style="text-align: center; background: #FFF; width: 50%; margin: -70px auto 0px; border-radius: 14px; padding: 10px; box-shadow: 0px 2px 2px #ccc; border: 2px dashed #f62ac1;">';
                        if($profile->image) {
                            $img = base_url('assets/images/vandor/'.$profile->image);
                        } else {
                            $img = base_url('assets/images/no-image.jpg') ;
                        }    
                        $html .= '<div style=" text-align: center;">
                                    <img src="'.$img.'" style="width: 100px; height: 110px; border-radius: 10px; border: 2px solid #333; display: block; margin: auto; object-fit: cover; margin-right: 10px;  padding: 6px;">
                                  </div>';
                        $html .= '<h2 style="margin-bottom: 0px;">'.strtoupper($profile->fname.' '.$profile->lname).'</h2>';
                        $html .= '<p style="margin-top: 10px;">'.$profile->designation.'</p>';
                    $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="middle_part" style="width: 100%; margin: 20px auto 0px;">';
                    $html .= '<div class="pakcll" style="padding: 20px; margin-bottom:10px;">';
                        $html .= '<h3 style="color: #ce30c8; font-size:20px; margin:5px 0px;">Styling Proposal for: '.$v['customer_name'].'</h3>';
                        $html .= '<div style="font-weight: bold; margin:7px 0px;">Service Type: '.$v['area_expertise_name'].'</div>';
                        $html .= '<div style="font-weight: bold; margin:7px 0px;">Proposal Date: '.date('d M, Y',strtotime($v['customer_date'])).'</div>';
                        $html .= '<div style="font-weight: bold; margin:7px 0px;">Proposal Validity: '.date('d M, Y',strtotime($v['customer_date'] . ' 15 days')).'</div>';
                         

                        $html .= '<div style="margin-top:20px;"> Dear '.$v['customer_name'].', Thank you for your interest in StyleBuddy. As discussed, we are pleased to attach our proposal for your consideration. If you have any questions or would like to discuss this proposal with us, please feel free to WhatsApp us on 
                            <a href="tel:+919898828200" style="color: #ce30c8;">+919898828200</a> or send us a mail on <a href="mailto:support@stylebuddy.in" style="color: #ce30c8;">support@stylebuddy.in.</a>  We look forward to making you Look Good, Feel Good!!

                        </div>';
                    $html .= '</div>';
                    if ($v['package_price_1']) {
                        $html .= '<div class="pakcll" style="background-color: #f0f0f0;  -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">';
                            $html .= '<div style="border: 10px solid #742ea0;"><div class="you_p" style="background-color: #742ea0!important;  -webkit-print-color-adjust: exact;  padding: 15px; border: 2px solid #fff;">';
                                $html .= '<div style="width:40%; text-align:left;  float:left;"><span style="font-weight: bold; color: #fff;  font-size: 20px;  position: relative;">CLASSIC PACKAGE  </span></div>
                                           <div style="width:40%; text-align:right; float:right;"> <span style="font-weight: bold; position: absolute; right: 20px; font-size: 20px;  color: #ffffff;">Rs. '.$v['package_price_1'].'</span></div>';
                            $html .= '</div></div>';
                            $html .= '<div class="col-sm-12">';
                                $html .=  $v['package_description_1'];
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                    if ($v['package_price_2']) {
                        $html .= '<div class="pakcll" style="background-color: #f0f0f0; -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">';
                               $html .= '<div style="border: 10px solid #742ea0;"><div class="you_p" style="background-color: #742ea0!important;  -webkit-print-color-adjust: exact; padding: 15px; border: 2px solid #fff;">';
                                $html .= '<div style="width:40%; text-align:left;  float:left;"><span style="font-weight: bold; color: #fff;  font-size: 20px;  position: relative;">PREMIUM PACKAGE   </span></div>
                                           <div style="width:40%; text-align:right; float:right;"> <span style="font-weight: bold; position: absolute; right: 20px; font-size: 20px;  color: #ffffff;">Rs. '.$v['package_price_2'].'</span></div>';
                            $html .= '</div></div>';
                            $html .= '<div class="col-sm-12">';
                                $html .= $v['package_description_2'];
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                    if ($v['package_price_3']) {
                        $html .= '<div class="pakcll" style="background-color: #f0f0f0; -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">';
                            $html .= '<div style="border: 10px solid #742ea0;"><div class="you_p" style="background-color: #742ea0!important;  -webkit-print-color-adjust: exact;  outline: 2px solid #fff; outline-offset: -10px; padding: 15px; border: 2px solid #fff;">';
                                $html .= '<div style="width:40%; text-align:left;  float:left;"><span style="font-weight: bold; color: #fff;  font-size: 20px;  position: relative;">LUXURY PACKAGE   </span></div>
                                           <div style="width:40%; text-align:right; float:right;"> <span style="font-weight: bold; position: absolute; right: 20px; font-size: 20px;  color: #ffffff;">Rs. '.$v['package_price_3'].'</span></div>';
                            $html .= '</div></div>';
                            $html .= '<div class="col-sm-12">';
                                $html .= $v['package_description_3'];
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                    

                $html .= '</div>';


                $html .= '<div class="footer" style="padding:310px 80px 50px;">';
                    $html .= '<div style="text-align:center;">';
                        $html .= '<img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 280px; padding-bottom: 5px">';
                        $html .= '<p style="font-size:18px;">'.strip_tags($this->site->address) .'</p>';
                        $html .= '<p style="font-size:18px;">'.strip_tags($this->site->mobile).' | '.strip_tags($this->site->email) .' | '.base_url().'</p>';
                        $html .= '<div class="footer-social">';
                            $html .= '<a href="'.$this->site->twitter.'">';
                                $html .= '<img src="'.base_url().'assets/images/tw.png" style="width: 60px;">';
                            $html .= '</a>';
                            $html .= '<a href="'.$this->site->facebook.'">';
                                $html .= '<img src="'.base_url().'assets/images/fb.png" style="width: 60px;">';
                            $html .= '</a>';
                            $html .= '<a href="'.$this->site->youtube.'">';
                                $html .= '<img src="'.base_url().'assets/images/youtube.png" style="width: 60px;">';
                            $html .= '</a>';
                            $html .= '<a href="'.$this->site->instagram.'">';
                                $html .= '<img src="'.base_url().'assets/images/insta.png" style="width: 60px;">';
                            $html .= '</a>';
                            $html .= '<a href="'.$this->site->linkedin.'">';
                                $html .= '<img src="'.base_url().'assets/images/linke.png" style="width: 60px;">';
                            $html .= '</a>';
                        $html .= '</div>';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        $html .= '</body>';
        return $html;
    }
    function checkUserLogin(){
        if($this->session->userdata('adminEmail') || $this->session->userdata('userType')) {
        }else{
            $this->session->set_flashdata('festival_message','<span class="pink_c text-white p-2">You are not logged in</span>');
            redirect(base_url());
        
        }
    }
    function checkUserType(){
            if($this->session->userdata('adminEmail') || $this->session->userdata('userType') == 2) {
                
            }else{
               $this->session->set_flashdata('festival_message','<span class="pink_c text-white p-2">You can not access this</span>');
                redirect(base_url()); 
            }
    }
    public function serviceorder(){
         
        $table = 'services_booking';
        $condition = " WHERE vendor_id = '".$this->venderId."' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/service_order',$data);
         

    }
    public function consultationorder(){
         
            $r = $this->db->query('SELECT * FROM vender where id='.$this->venderId)->row();
            $url1 = $this->uri->segment(1);
            $url2 = $this->uri->segment(2);
            $url3 = $this->uri->segment(3);
            
            $table = 'ask_quote_online';
            $condition = " WHERE email = '". $r->email ."' order by id DESC";
            $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
            //echo $this->db->last_query();
            $data['list'] = $list;
            $data['title'] = 'Fashion Expert Consultation';
            $data['list_heading'] = 'Fashion Expert Consultation';
            $data['datas'] = $this->db->get_where('vender',['id' => $this->venderId ])->row();
         
           
        $this->load->view('front/vandor/consultationorder',$data);
        
    }
    public function serviceorderdetail($id){ 
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $table = 'services_booking';
        $postData = $this->input->post();
        $condition = " order by id DESC";
        $list = $this->common_model->get_all_details_query('payment_status',$condition)->result();
        $data['payment_status_list'] = $list;

        $condition = " order by id DESC";
        $list = $this->common_model->get_all_details_query('order_status',$condition)->result();
        $data['status_list'] = $list;

        if(!empty($this->input->post('payment_status'))){
            $status = trim($this->input->post('payment_status'));
            $this->db->where ( 'id',$id);
            $this->db->update($table,['payment_status'=> $status]);
        }

        if(!empty($this->input->post('order_status'))){
            $status = trim($this->input->post('order_status'));
            $this->db->where ( 'id',$id);
            if ($status == 'Delivered') {
                if ($order->payment_status == 'APPROVED') {
                    $this->db->update($table,['order_status'=> $status]);
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please complete payment status first</span><br/><br/>');
                    redirect(base_url($url1.'/'.$url2.'/details/'.$id));
                }
                
            }else{
                $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please status updated  successfully</span><br/><br/>');
                $this->db->update($table,['order_status'=> $status]);
            }
        }

        
        $condition = " WHERE id = '".$id."' and  vendor_id = '".$this->venderId."' ";
        $order = $this->common_model->get_all_details_query($table,$condition)->row();
        $data['order'] = $order;
        $condition = " WHERE id = '". $order->package_id ."'";
        $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
        
         
        $txt = 'Classic';
        if ($order->package == 'package_price_1') {

           $txt = 'Classic';
           $description = 'package_description_1';
        }elseif ($order->package == 'package_price_2') {

           $txt = 'Premium';
           $description = 'package_description_2';
        }elseif ($order->package == 'package_price_3') {

           $txt = 'Luxury';
           $description = 'package_description_3';
        }

        $option = '<div class="summery_order">';
            $option = '<div class="row align-items-center">
                            <div class="col-sm-12">
                                <p class="odds">
                                    <b>Order ID : #'.$order->id.' | </b>
                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>
                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>
                                    Order Date : '. date('j F, Y',strtotime($order->created_at)) .'
                                </p>
                            </div>
                        </div>';
                 $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">
                        <tr style="border: 1px solid #333;">
                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$value['area_expertise_name'].'</b></td>
                        </tr> 
                        <tr style="border: 1px solid #333;">
                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                                <td colspan="2" style="border: 1px solid #333;text-align:left">'. $value[$description] .'</td>
                                </tr>';
                         
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Total: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Tax: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->tax_total) .'</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Grand Total: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->grand_total) .'</b></td>
                        </tr>';
            $option .= '</table>';
            $option .= '<div style="background: #e5da95;margin-bottom: 20px;padding: 16px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="uk_title mb-3 mt-3">Address</h3>
                                    <p>'. $order->address .'</p>
                                    <p>Pin - '. $order->pincode .'</p>
                                    <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>
                                    <p>Email : '. $order->user_email .'</p>
                                    <p>Mobile : '. $order->mobile .'</p>
                                </div>
                            </div>
                        </div>';
        $option .= '</div>';

        $data['result']  = $option;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/service_order_details',$data);
         
    }
    
    public function myserviceorder(){
         
        $table = 'services_booking';
        $condition = " WHERE user_id = '".$this->userID."' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/my_service_order',$data);
         

    }
    public function myserviceorderdetail($id){ 
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $table = 'services_booking';
        $postData = $this->input->post();
        $condition = " order by id DESC";
        $list = $this->common_model->get_all_details_query('payment_status',$condition)->result();
        $data['payment_status_list'] = $list;

        $condition = " order by id DESC";
        $list = $this->common_model->get_all_details_query('order_status',$condition)->result();
        $data['status_list'] = $list;

        if(!empty($this->input->post('payment_status'))){
            $status = trim($this->input->post('payment_status'));
            $this->db->where ( 'id',$id);
            $this->db->update($table,['payment_status'=> $status]);
        }

        if(!empty($this->input->post('order_status'))){
            $status = trim($this->input->post('order_status'));
            $this->db->where ( 'id',$id);
            if ($status == 'Delivered') {
                if ($order->payment_status == 'APPROVED') {
                    $this->db->update($table,['order_status'=> $status]);
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please complete payment status first</span><br/><br/>');
                    redirect(base_url($url1.'/'.$url2.'/details/'.$id));
                }
                
            }else{
                $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please status updated  successfully</span><br/><br/>');
                $this->db->update($table,['order_status'=> $status]);
            }
        }

        
        $condition = " WHERE id = '".$id."' and  user_id = '".$this->userID."' ";
        $order = $this->common_model->get_all_details_query($table,$condition)->row();
        $data['order'] = $order;
        $condition = " WHERE id = '". $order->package_id ."'";
        $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
        
         
        $txt = 'Classic';
        if ($order->package == 'package_price_1') {

           $txt = 'Classic';
           $description = 'package_description_1';
        }elseif ($order->package == 'package_price_2') {

           $txt = 'Premium';
           $description = 'package_description_2';
        }elseif ($order->package == 'package_price_3') {

           $txt = 'Luxury';
           $description = 'package_description_3';
        }

        $option = '<div class="summery_order">';
            $option = '<div class="row align-items-center">
                            <div class="col-sm-12">
                                <p class="odds">
                                    <b>Order ID : #'.$order->id.' | </b>
                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>
                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>
                                    Order Date : '. date('j F, Y',strtotime($order->created_at)) .'
                                </p>
                            </div>
                        </div>';
                 $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">
                        <tr style="border: 1px solid #333;">
                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$value['area_expertise_name'].'</b></td>
                        </tr> 
                        <tr style="border: 1px solid #333;">
                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                                <td colspan="2" style="border: 1px solid #333;text-align:left">'. $value[$description] .'</td>
                                </tr>';
                         
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Total: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Tax: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->tax_total) .'</b></td>
                        </tr>';
                        $option .= '<tr style="border: 1px solid #333;">
                            <td style="border: 1px solid #333;"> <b>Grand Total: </b></td>
                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->grand_total) .'</b></td>
                        </tr>';
            $option .= '</table>';
            $option .= '<div style="background: #e5da95;margin-bottom: 20px;padding: 16px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="uk_title mb-3 mt-3">Address</h3>
                                    <p>'. $order->address .'</p>
                                    <p>Pin - '. $order->pincode .'</p>
                                    <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>
                                    <p>Email : '. $order->user_email .'</p>
                                    <p>Mobile : '. $order->mobile .'</p>
                                </div>
                            </div>
                        </div>';
        $option .= '</div>';

        $data['result']  = $option;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/my_service_order_details',$data);
         
    }
    
    public function fetchCity(){
        $state_id = $this->input->post('state_id');
        $cities = $this->db->order_by('name', 'ASC')->get_where('cities',['state_id'=>$state_id])->result();
        
        if(!empty($cities)) {
            $data = '';
            $data = '<option value="">Select city</option>';
            foreach($cities as $city) {
                 $data .= '<option value="'.$city->id.'">'.ucwords(($city->name)?$city->name:$city->code).'</option>';
            }
        } else {
            $data = '<option value="">City Not Found</option>';
        }
      echo  $data;   
    }
    public function getstate(){
        $country_id = $this->input->post('country_id');
        $cities = $this->db->order_by('name', 'ASC')->get_where('states',['country_id'=>$country_id])->result();
        
        if(!empty($cities)) {
            $data = '';
            $data = '<option value="">Select state</option>';
            foreach($cities as $city) {
                 $data .= '<option value="'.$city->id.'">'.ucwords($city->name).'</option>';
            }
        } else {
            $data = '<option value="">State Not Found</option>';
        }
      echo  $data;   
    }
    
    public function emailcheck() {
        $email = $this->input->post('checkEmail');
        $value = $this->db->get_where('vender',['email'=> $email ])->row();
        if(!empty($value)) {  echo 1; } else { echo 0;  }
    }
    public function gettags(){
        $tags = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
        $style['tags'] = $tags;
        $option = ''; 
        foreach($tags as $list) { 
            $option .= '<option class="Female" value="'.$list->id.'">'.$list->tag.'</option>';
        } 
        echo $option;
    }
    
    public function stylist_dashboard(){
        if($this->session->userdata('adminEmail')) {
            $seg3 = $this->uri->segment(3);
            $user = $this->db->query('select * from vender WHERE id ="'.$seg3.'"')->row();
            if($user) {
                $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];
                $this->session->set_userdata($frontUserData);
                redirect(base_url('stylist-zone/dashboard'));
            }

            
        } 
    }
    


    public function dashboard(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }
            
            $data['expertises']  = $expertises = $this->Page_Model->fetch_all('area_expertise');
            
            $profileArray = $this->db->get_where('vender',[] )->result();
            foreach ($profileArray as $key => $row) {
                if(!empty($row->expertise)) { $arrayVal = explode(',',$row->expertise); } 
                $val = "";
                $values = ""; $i=0;
                foreach($expertises as $expertise)  {    
                     if(isset($arrayVal)) { 
                        if(in_array($expertise->id, $arrayVal)) { 
                            if ($i==0) {
                                $val =  $expertise->name;
                            }
                            if ($i > 0) {
                                $values .=  ', ';
                            }
                            
                            $values .=  $expertise->name;
                            $i++; 
                        } 
                    } 
                }
                $meta_title = $val.' IN '.$row->city_name.' | '.$row->fname.' '.$row->lname.'| StyleBuddy';  
                $data1['meta_title'] = $meta_title; 
                $data1['meta_keyword'] = $values; 
                $data1['meta_description'] = $row->about; 
                $this->db->update('vender',$data1,array('id'=>$row->id));
            }
            
            $profileArray = $this->db->get_where('vender',['id'=> $this->venderId] )->result();
            //$profileArray = $this->db->get_where('vender',[] )->result();
            foreach ($profileArray as $key => $profile) {
                $about = str_word_count($profile->about);
                $more_about = str_word_count($profile->more_about);
                $iddd = $profile->id;
                $projectCount  = $this->common_model->get_all_details('ideas',array('vender_id'=>$iddd))->num_rows();
                $videoCount  =  $this->common_model->get_all_details('portfolio_video',array('vender_id'=>$iddd))->num_rows();
                $servicesCount  =  $this->common_model->get_all_details('services_vendor',array('deleted_status'=>0,'vendor_id'=>$iddd))->num_rows();
               
                /*echo 'about:'.$about;
                echo 'more_about:'.$more_about;
                echo 'projectCount:'.$projectCount;
                echo 'videoCount:'.$videoCount;
                echo 'servicesCount:'.$servicesCount.'<br/><br/>';*/

                $profile_update_ratio = 0;
                if ($about >= 50) {
                    $profile_update_ratio += 20;
                    //echo '<br/>about';
                }
                if ($more_about >= 500) {
                    $profile_update_ratio += 20;
                    //echo '<br/>mre about';
                }
                if ($projectCount >= 5) {
                    $profile_update_ratio += 20;
                    //echo '<br/>projectCount';
                }
                if ($videoCount >= 5) {
                    $profile_update_ratio += 20;
                    //echo '<br/>videoCount';
                }
                if ($servicesCount >= 1) {
                    $profile_update_ratio += 20;
                    //echo '<br/>servicesCount ';
                }
                //echo $profile_update_ratio;
                $ab = array();
                $ab['profile_update_ratio'] = $profile_update_ratio;
                $this->db->update('vender',$ab,array('id'=>$iddd));
                //echo $this->db->last_query();
            }

            //
            
            $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            if ($profile->expertise) {
                $area_expertise = explode(',', $profile->expertise);
                $ideas = array();
                if($area_expertise){
                    //$ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                }
                $profile->area_expertiseRow = $ideas;
            }
            $data['profile'] = $profile;
            //echo $this->db->last_query();
            $this->load->view('front/vandor/dashboard',$data);
        } else {
            redirect();   
        } 
    }
    public function mydashboard(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }
            $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $about = str_word_count($profile->about);
            $more_about = str_word_count($profile->more_about);
            $projectCount  =  $this->common_model->get_all_details('ideas',array('vender_id'=>$this->venderId))->num_rows();
            $videoCount  =  $this->common_model->get_all_details('portfolio_video',array('vender_id'=>$this->venderId))->num_rows();
            $servicesCount  =  $this->common_model->get_all_details('services_vendor',array('vendor_id'=>$this->venderId))->num_rows();


            $profile_update_ratio = 0;
            
            if ($about >= 50) {
                $profile_update_ratio += 20;
            }
            if ($more_about >= 500) {
                $profile_update_ratio += 20;
            }
            if ($projectCount >= 5) {
                $profile_update_ratio += 20;
            }
            if ($videoCount >= 5) {
                $profile_update_ratio += 20;
            }
            if ($servicesCount >= 1) {
                $profile_update_ratio += 20;
            }
            $ab = array();
            $ab['profile_update_ratio'] = $profile_update_ratio;
            $this->db->update('vender',$ab,array('id'=>$this->venderId));
            //echo $this->db->last_query();
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/my-dashboard',$data);
        } else {
            redirect();   
        } 
    }


    public function videopage(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/video-page',$data);
        } else {
            redirect();   
        } 
    }

    public function fashionboard(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/fashion-board',$data);
        } else {
            redirect();   
        } 
    }

    public function managemyorders(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/manage-my-orders',$data);
        } else {
            redirect();   
        } 
    }

    /*public function completedorderslist(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/completed-orders-list',$data);
        } else {
            redirect();   
        } 
    }*/
    public function orders(){   
        if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['order'] = $this->common_model->get_all_details_query('user_order_details',' where vendor_vendor_id = "'.$this->venderId.'" AND order_status != "COMPLETED" order by id desc')->result();
            $this->load->view('front/vandor/orders',$data);
        }else {
            redirect();
        }    
    }
    public function ordersdetails($id){
        if($this->session->userdata('userType') == 2  ) {
            if(!empty($this->input->post('payment_status'))){
                $status = trim($this->input->post('payment_status'));
                $this->db->where ( 'id',$id);
                $this->db->update('user_order_details',['payment_status'=> $status]);
            }

            $order = $this->db->get_where('user_order_details',['id'=> $id])->row();
            if(!empty($this->input->post('order_status'))){
                $status = trim($this->input->post('order_status'));
                $this->db->where ( 'id',$id);
                if ($status == 'Delivered') {
                    if ($order->payment_status == 'APPROVED') {
                        $this->db->update('user_order_details',['order_status'=> $status]);
                    }else{
                        $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please complete payment status first</span><br/><br/>');
                        redirect(base_url('/vandor/ordersdetails/'.$id));
                    }
                    
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please status updated  successfully</span><br/><br/>');
                    $this->db->update('user_order_details',['order_status'=> $status]);
                }
            }


            $data['order_detail'] = $orderRow = $this->db->get_where('user_order_details',['id'=> $id])->result();
            $data['order'] = $this->db->get_where('user_order',['id'=> $orderRow[0]->orderId])->row();
            $this->db->select ( '*'); 
            $this->db->from ( 'payment_status' );
            $data['payment_status_list'] = $this->db->get()->result();


            $this->db->select ( '*'); 
            $this->db->from ( 'order_status' );
            $data['status_list'] = $this->db->get()->result();

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $this->load->view('front/vandor/ordersdetails',$data);
        }else {
            redirect();
        }
    }
     
    public function myorders($id = ''){
        if(!$this->session->userdata('userType') == 2  ) {
            redirect();
        }
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        if($id == '') {
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $data['order'] = $this->db->order_by('id','DESC')->get_where('user_order',['user_id' => $this->userID ])->result();
            $this->load->view('front/vandor/myorders',$data);    
        } else {
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $data['order'] = $this->db->get_where('user_order',['user_id' => $this->userID,'id'=> $id])->row();

            $this->db->select ( 'user_order.*, user_order_details.*' ); 
            $this->db->from ( 'user_order' );
            $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
            $this->db->order_by("user_order.id", "DESC");
            $this->db->where ( 'user_order.id',$id);
            $query = $this->db->get();
            $data['orderDetails'] = $query->result(); 
            if(!empty($data['orderDetails'])){
                $this->load->view('front/vandor/view-myorder',$data);       
            }else {
                redirect('stylist-zone/user-orders');
            }      
        }
    }
    public function completedorderslist(){
        if($this->session->userdata('userType') == 2) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['order'] = $this->common_model->get_all_details_query('user_order_details',' where vendor_vendor_id = "'.$this->venderId.'"  AND order_status = "COMPLETED" order by id desc')->result();
            $this->load->view('front/vandor/completed-orders-list',$data);
        }else {
            redirect();
        } 
    }
    public function completedordersdetails($id){
        if($this->session->userdata('userType') == 2) {
            if(!empty($this->input->post('payment_status'))){
                $status = trim($this->input->post('payment_status'));
                $this->db->where ( 'id',$id);
                $this->db->update('user_order_details',['payment_status'=> $status]);
            }

            $order = $this->db->get_where('user_order_details',['id'=> $id])->row();
            if(!empty($this->input->post('order_status'))){
                $status = trim($this->input->post('order_status'));
                $this->db->where ( 'id',$id);
                if ($status == 'Delivered') {
                    if ($order->payment_status == 'APPROVED') {
                        $this->db->update('user_order_details',['order_status'=> $status]);
                    }else{
                        $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please complete payment status first</span><br/><br/>');
                        redirect(base_url('/vandor/completedordersdetails/'.$id));
                    }
                    
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander pink_c p-2">Please status updated  successfully</span><br/><br/>');
                    $this->db->update('user_order_details',['order_status'=> $status]);
                }
            }


            $data['order_detail'] = $orderRow = $this->db->get_where('user_order_details',['id'=> $id])->result();
            $data['order'] = $this->db->get_where('user_order',['id'=> $orderRow[0]->orderId])->row();
            $this->db->select ( '*'); 
            $this->db->from ( 'payment_status' );
            $data['payment_status_list'] = $this->db->get()->result();


            $this->db->select ( '*'); 
            $this->db->from ( 'order_status' );
            $data['status_list'] = $this->db->get()->result();

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $this->load->view('front/vandor/completedordersdetails',$data);
        }else {
            redirect();
        }
    }
    public function myearnings(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/my-earnings',$data);
        } else {
            redirect();   
        } 
    }

    public function mypayouts(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/my-payouts',$data);
        } else {
            redirect();   
        } 
    }
    public function profile(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            if ($postData) {
                $this->form_validation->set_rules('fname','First Name','required|trim');
                $this->form_validation->set_rules('lname','Last Name','required|trim');
                $this->form_validation->set_rules('email','Email','required|trim|valid_email');
                $this->form_validation->set_rules('gender','Gender','required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
                
                if( $this->form_validation->run() == false) {
                    redirect('stylist-zone/manage-profile'); 
                }  else {
                    $check_content_sightengine = array();
                    $check_content_sightengine['designation'] = $postData['designation'];;
                    $check_content_sightengine['about'] = $postData['about'];;
                    $check_content_sightengine['more_about'] = $postData['more_about'];;
                    $check_content_sightengine['address'] = $postData['address'];;
                    $check_content_sightengine['fname'] = $postData['fname'];;
                    $check_content_sightengine['lname'] = $postData['lname'];;
                    $dd = check_content_sightengine($check_content_sightengine);
                    if ($dd) {
                        $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                        //redirect('stylist-zone/manage-profile');  
                    }else{
                        $c_c_s = array();    
                        $this->uploadPath = 'assets/images/vandor/';
                        $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                        if(!empty($image)){
                            $data['image'] = $image;
                            $c_c_s['image'] = base_url($this->uploadPath.$image);
                        }
                        $image = $this->uploadSingleImageOnly('portfolio_pdf',$this->uploadPath);
                        if(!empty($image)){
                            $data['portfolio_pdf'] = $image;
                        }
                        $dd = check_image_sightengine($c_c_s);
                        if ($dd) {
                            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                             
                        }
                        else{ 
                             

                            $data['designation'] = $this->input->post('designation');
                            $data['country'] = $country = $this->input->post('country');
                            $data['state'] = $state = $this->input->post('state');
                            $data['city'] = $city = $this->input->post('city');
                            
                            $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                            $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                            $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
                
                            $data['country_name'] = $countryRow->name;
                            $data['state_name'] = $statesRow->name;
                            $data['city_name'] = $cityRow->name;
                            
                            $data['experience'] = $this->input->post('experience');
                            $data['fname'] = $this->input->post('fname');
                            $data['email'] = $this->input->post('email');
                            $data['lname'] = $this->input->post('lname');
                            
                            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
                            
                            $data['gender'] = $this->input->post('gender');
                            $data['mobile'] = $this->input->post('mobile');
                            $data['dob'] = $this->input->post('dob');
                            $data['address'] = $this->input->post('address');
                            $data['pin'] = $this->input->post('pin');
                            $data['about'] = $this->input->post('about');
                            $data['more_about'] = $this->input->post('more_about');
                            $data['linkedin_link'] = $this->input->post('linkedin_link');
                            $data['behance_link'] = $this->input->post('behance_link');
                            $data['facebook_link'] = $this->input->post('facebook_link');
                            $data['twitter_link'] = $this->input->post('twitter_link');
                            $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                            $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                            $data['expertise'] = implode(',',$this->input->post('expertise'));
                            
                            $data['project_deliverd'] = $this->input->post('project_deliverd');

                            $table = 'vender'; 
                            $where = ['id'=> $this->venderId ];
                            $update = $this->Page_Model->common_update($data,$where,$table); 
                            
                            if($update) {
                                $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your profile is updated successfully</span>');
                                redirect('stylist-zone/manage-profile');
                            } else {
                                $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
                                redirect('stylist-zone/manage-profile');
                            }
                        }
                    }
                }
            }

            $profileArray = $this->db->get_where('vender',['id'=> $this->venderId] )->result();
            //$profileArray = $this->db->get_where('vender',[] )->result();
            foreach ($profileArray as $key => $profile) {
                $about = str_word_count($profile->about);
                $more_about = str_word_count($profile->more_about);
                $iddd = $profile->id;
                $projectCount  = $this->common_model->get_all_details('ideas',array('vender_id'=>$iddd))->num_rows();
                $videoCount  =  $this->common_model->get_all_details('portfolio_video',array('vender_id'=>$iddd))->num_rows();
                $servicesCount  =  $this->common_model->get_all_details('services_vendor',array('deleted_status'=>0,'vendor_id'=>$iddd))->num_rows();
               
               

                $profile_update_ratio = 0;
                if ($about >= 50) {
                    $profile_update_ratio += 20;
                    //echo '<br/>about';
                }
                if ($more_about >= 500) {
                    $profile_update_ratio += 20;
                    //echo '<br/>mre about';
                }
                if ($projectCount >= 5) {
                    $profile_update_ratio += 20;
                    //echo '<br/>projectCount';
                }
                if ($videoCount >= 5) {
                    $profile_update_ratio += 20;
                    //echo '<br/>videoCount';
                }
                if ($servicesCount >= 1) {
                    $profile_update_ratio += 20;
                    //echo '<br/>servicesCount ';
                }
                //echo $profile_update_ratio;
                $ab = array();
                $ab['profile_update_ratio'] = $profile_update_ratio;
                $this->db->update('vender',$ab,array('id'=>$iddd));
                //echo $this->db->last_query();
            }
            
            $data['profile'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['country'] = $this->db->get('countries')->result();
            $data['states'] = $this->db->get_where('states',['country_id'=> $profile->country ])->result();
           // $data['cities'] = $this->db->order_by('name', 'asc')->get('cities')->result();
            $data['expertises'] = $this->db->get_where('area_expertise',['status'=> 1 ])->result();
            $this->load->view('front/vandor/profile',$data);
        } else {
            redirect();   
        } 
    }
    public function profileUpdate()
    {
        $this->form_validation->set_rules('fname','First Name','required|trim');
        $this->form_validation->set_rules('lname','Last Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('gender','Gender','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
        
        if( $this->form_validation->run() == false) {
            redirect('stylist-zone/manage-profile'); 
        }  else {
               
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }
                $image = $this->uploadSingleImageOnly('portfolio_pdf',$this->uploadPath);
                if(!empty($image)){
                    $data['portfolio_pdf'] = $image;
                }
                 
                $data['designation'] = $this->input->post('designation');
                //$data['location'] = $this->input->post('location');
               

                $data['country'] = $country = $this->input->post('country');
                $data['state'] = $state = $this->input->post('state');
                $data['city'] = $city = $this->input->post('city');
                
                $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
    
                $data['country_name'] = $countryRow->name;
                $data['state_name'] = $statesRow->name;
                $data['city_name'] = $cityRow->name;
                
                $data['experience'] = $this->input->post('experience');
                $data['fname'] = $this->input->post('fname');
                $data['email'] = $this->input->post('email');
                $data['lname'] = $this->input->post('lname');
                
                $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
                
                $data['gender'] = $this->input->post('gender');
                $data['mobile'] = $this->input->post('mobile');
                $data['dob'] = $this->input->post('dob');
                $data['address'] = $this->input->post('address');
                $data['pin'] = $this->input->post('pin');
                $data['about'] = $this->input->post('about');
                $data['more_about'] = $this->input->post('more_about');
                $data['linkedin_link'] = $this->input->post('linkedin_link');
                $data['behance_link'] = $this->input->post('behance_link');
                $data['facebook_link'] = $this->input->post('facebook_link');
                $data['twitter_link'] = $this->input->post('twitter_link');
                $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                $data['expertise'] = implode(',',$this->input->post('expertise'));
                
                $data['project_deliverd'] = $this->input->post('project_deliverd');

                $table = 'vender'; 
                $where = ['id'=> $this->venderId ];
                $update = $this->Page_Model->common_update($data,$where,$table); 
                
                if($update) {
                    $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your profile is updated successfully</span>');
                    redirect('stylist-zone/manage-profile');
                } else {
                    $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
                    redirect('stylist-zone/manage-profile');
                }
        }
    }
    public function myProfile()
    {   
        if($this->session->userdata('userType') == 2  ) {
                $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row(); 
                $this->load->view('front/vandor/my-profile',$data);
        } else {
             redirect('');
        }
    }
    public function myProfileUpdate()
    {
            if($_FILES['image']['name'] !="") {
                 $config['upload_path'] = './assets/images/vandor/';  
                 $config['max_size'] = 2448;
                 $config['allowed_types'] = 'jpg|jpeg'; 
                 $this->load->library('upload',$config);
                 $this->upload->initialize($config);
                 
                 if($this->upload->do_upload('image')){
                   $uploadImg = $this->upload->data(); 
                   $data['image'] = $uploadImg['file_name']; 
                  }  else {
                      $ierror = $this->upload->display_errors();
                      $this->session->set_flashdata('imgerror',$ierror);
                      redirect('vandor/my-profile','refresh');
                  }
                }
              //  if(!empty($data['designation'])) { 
                    $data['designation'] = $this->input->post('designation');
                    $data['location'] = $this->input->post('location');
                    $data['more_about'] = $this->input->post('more_about');
                    
                    $table = 'vender';
                    $where = ['id'=> $this->venderId ];
                    $update = $this->Page_Model->common_update($data,$where,$table); 
                    
                        if($update) {
                            $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your profile is updated successfully</span>');
                            redirect('stylist-zone/my-profile');
                        } else {
                            $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
                            redirect('stylist-zone/my-profile');
                      }
               // } else {
                    redirect('stylist-zone/my-profile');
              //  }       
    }
    public function manageProducts()
    {   
        if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['products'] = $this->db->order_by('id', 'desc')->get_where('products',['vender_id'=> $this->venderId ])->result();
            $this->load->view('front/vandor/manage-products',$data);
        } else {
            redirect(); 
        }    
    }
    public function productStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('products',['status'=> $status]);
        echo $update;
    }
    public function productVendorStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('products',['vendor_status'=> $status]);
        echo $update;
    }
    
    public function addProducts(){
        if($this->session->userdata('userType') == 2  ) {
                
            $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            //$this->form_validation->set_rules('cat_id', 'Catogery', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'required|trim');
            //$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean|greater_than[0]'); gallery
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
            $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another name');
    
            if($this->form_validation->run()) {
                $postData = $this->input->post();    
                $check_content_sightengine = array();
                $check_content_sightengine['product_name'] = $postData['product_name'];;
                $check_content_sightengine['description'] = $postData['description'];;
                
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                }else{
                    $c_c_s = array();  
                    $this->uploadPath = 'assets/images/product/';
                    $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                    if(!empty($image)){
                        $data['image'] = $image;
                        $c_c_s['image'] = base_url($this->uploadPath.$image);
                    } 

                    $this->uploadPath = 'assets/images/gallery/'; 
                    $multiImage = $this->uploadMultipleImageOnly('gallery_image',$this->uploadPath);
                    $product_galary = '';
                    if(!empty($multiImage)){
                        $insert_= trim($multiImage,',');
                        $product_galary =  trim($insert_,',');

                        $aa = explode(',', $product_galary);
                        $j =0;
                        foreach ($aa as $key => $value) {$j++;
                            $c_c_s['image'.$j] = base_url($this->uploadPath.$value);
                        }

                    }

                    $dd = check_image_sightengine($c_c_s);
                    if ($dd) {
                        $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                         
                    }
                    else{ 

                        $data['vender_id'] = $this->venderId;
                        $data['product_name'] = $this->input->post('product_name');
                        $data['slug'] =  url_title($data['product_name'], 'dash', true);
                        $data['gender'] = $this->input->post('gender');
                        $data['cat_id'] = implode(',', $this->input->post('cat_id'));
                        $data['price'] = $this->input->post('price');
                        $data['size'] = implode(',',$this->input->post('size'));
                        $data['description'] = $this->input->post('description');
                        $data['discount'] = $this->input->post('discount');
                        $data['created_at']  = date('Y-m-d h:i:s');
                        
                        $this->db->insert('products',$data);
                        $insert_id = $this->db->insert_id();
                        
                        if($insert_id) {
                            $aa = explode(',', $product_galary);
                            $i =0;
                            $ImageName = '';
                            foreach ($aa as $key => $value) {
                                $uploadData[$i]['gallery_image'] = $value; 
                                $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
                                $uploadData[$i]['product_id'] = $insert_id;
                                $ImageName =  $value;
                                $i++;
                            }
                            if (!empty($ImageName)) {
                                $batch_insert = $this->db->insert_batch('product_galary',$uploadData);
                            }
                            $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Product added Successfully!!</span>');
                            redirect('stylist-zone/add-products');
                        }else{
                            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                            redirect('stylist-zone/add-products');
                        }
                    }
                }
            }
            $data['categorys'] = $this->db->get_where('category',['status'=> 1])->result();
            //$data['sizes'] = $this->db->get_where('product_size',['status'=> 1])->result();
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
    
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $this->load->view('front/vandor/add-products',$data); 
        } else {
            redirect(); 
        }
    }
     
    public function deleteProductImages(){
        $postData = $this->input->get();
        $table = 'product_galary';
        $id = $postData['id'];
        $row = $this->db->get_where($table,['id' => $id ])->row_array();
        if($row){
            $this->db->where('id', $id);
            $this->db->delete($table);
        }
    }            
    public function editProducts($id){   
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            if ($postData) {
                $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                //$this->form_validation->set_rules('cat_id', 'Catogery', 'required|trim');
                $this->form_validation->set_rules('price', 'Price', 'required|trim');
                //$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean|greater_than[0]'); gallery
                $this->form_validation->set_rules('description', 'Description', 'required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
                $id = $this->input->post('id');
                if($this->form_validation->run()) {
                    $check_content_sightengine = array();
                    $check_content_sightengine['designation'] = $postData['product_name'];;
                    $check_content_sightengine['description'] = $postData['description'];;
                    
                    $dd = check_content_sightengine($check_content_sightengine);
                    if ($dd) {
                        $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                    }else{
                        $c_c_s = array();  
                        $this->uploadPath = 'assets/images/product/';
                        $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                        if(!empty($image)){
                            $data['image'] = $image;
                            $c_c_s['image'] = base_url($this->uploadPath.$image);
                        } 

                        $this->uploadPath = 'assets/images/gallery/'; 
                        $multiImage = $this->uploadMultipleImageOnly('gallery_image',$this->uploadPath);
                        $product_galary = '';
                        if(!empty($multiImage)){
                            $insert_= trim($multiImage,',');
                            $product_galary =  trim($insert_,',');

                            $aa = explode(',', $product_galary);
                            $j =0;
                            foreach ($aa as $key => $value) {$j++;
                                $c_c_s['image'.$j] = base_url($this->uploadPath.$value);
                            }

                        }

                        $dd = check_image_sightengine($c_c_s);
                        if ($dd) {
                            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                             
                        }
                        else{ 
                             
                            $data['vender_id'] = $this->venderId;
                            $data['product_name'] = $this->input->post('product_name');
                            //$data['slug'] =  url_title($data['product_name'], 'dash', true);
                            $data['gender'] = $this->input->post('gender');
                            $data['cat_id'] = implode(',', $this->input->post('cat_id'));
                            $data['price'] = $this->input->post('price');
                            $size = '';
                            if(!empty($this->input->post('size'))){
                                $size = implode(',',$this->input->post('size'));
                            }
                            $data['size'] = $size;
                            //$data['size'] = implode(',',$this->input->post('size'));
                            $data['description'] = $this->input->post('description');
                            $data['discount'] = $this->input->post('discount');
                            $data['created_at']  = date('Y-m-d h:i:s');
                            
                            $table = 'products'; 
                            $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                            $update = $this->Page_Model->common_update($data,$where,$table); 
                            //echo $update; exit;  
                            if($update) {

                                $aa = explode(',', $product_galary);
                                $i =0;
                                $ImageName = '';
                                foreach ($aa as $key => $value) {
                                    $uploadData[$i]['gallery_image'] = $value; 
                                    $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
                                    $uploadData[$i]['product_id'] = $id;
                                    $ImageName =  $value;
                                    $i++;
                                }
                                if (!empty($ImageName)) {
                                    $batch_insert = $this->db->insert_batch('product_galary',$uploadData);
                                }
                                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Product Updated Successfully!!</span>');
                                redirect('stylist-zone/manage-products');    
                            } else {
                                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                redirect('stylist-zone/manage-products');
                            }
                        }
                    }
                } else {
                     redirect("stylist-zone/edit-products/$id");
                }
            } 

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['products'] = $this->db->get_where('products',['id'=> $id , 'vender_id' => $this->venderId ])->row();
            $data['galleryes'] = $this->db->get_where('product_galary',['product_id'=> $id ])->result();
            $data['categorys'] = $this->db->get_where('category',['status'=> 1])->result();
            
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
            $this->db->order_by('ui_order','asc');
            $data['colors'] =  $this->db->get_where('product_color',array('status'=>1))->result();

            if(!empty($data['products'])) {
                $this->load->view('front/vandor/edit-product',$data);   
            } else {
                redirect('stylist-zone/manage-products');
            }
        } else {
            redirect();
        }
    }
    public function updateProducts() {
        $postData = $this->input->post();
        if ($postData) {
            $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            //$this->form_validation->set_rules('cat_id', 'Catogery', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'required|trim');
            //$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean|greater_than[0]'); gallery
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
            $id = $this->input->post('id');
            if($this->form_validation->run()) {
                $this->uploadPath = 'assets/images/product/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }  

                $data['vender_id'] = $this->venderId;
                $data['product_name'] = $this->input->post('product_name');
                //$data['slug'] =  url_title($data['product_name'], 'dash', true);
                $data['gender'] = $this->input->post('gender');
                $data['cat_id'] = implode(',', $this->input->post('cat_id'));
                $data['price'] = $this->input->post('price');
                $size = '';
                if(!empty($this->input->post('size'))){
                    $size = implode(',',$this->input->post('size'));
                }
                $data['size'] = $size;
                //$data['size'] = implode(',',$this->input->post('size'));
                $data['description'] = $this->input->post('description');
                $data['discount'] = $this->input->post('discount');
                $data['created_at']  = date('Y-m-d h:i:s');
                
                $table = 'products'; 
                $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                $update = $this->Page_Model->common_update($data,$where,$table); 
                //echo $update; exit;  
                if($update) {
                    $filename = 'gallery_image';
                    $path = 'assets/images/gallery/'; 
                    
                    if(is_array($_FILES[$filename]['name']) && !empty($_FILES[$filename]['name'])){
                        $cpt = count($_FILES[$filename]);
                        $ImageName = '';
                        $timeImg = '';
                        for($i=0; $i<$cpt; $i++){
                            if(!empty($_FILES[$filename]['name'][$i])){
                                $tempFile = $_FILES[$filename]['tmp_name'][$i];
                                $temp = strtolower(basename($_FILES[$filename]["name"][$i]));
                                $path_parts = pathinfo($temp);
                                $t =  time();
                                $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
                                $targetFile = $path . $fileName_ ;
                                move_uploaded_file($tempFile, $targetFile);
                                $uploadData[$i]['gallery_image'] = $fileName_; 
                                $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
                                $uploadData[$i]['product_id'] = $id;
                                $ImageName =  $fileName_;

                            }
                        }
                        if (!empty($ImageName)) {
                            $batch_insert = $this->db->insert_batch('product_galary',$uploadData);
                        }
                        
                    }
                    $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Product Updated Successfully!!</span>');
                    redirect('stylist-zone/manage-products');    
                } else {
                    $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                    redirect('stylist-zone/manage-products');
                }
            } else {
                 redirect("stylist-zone/edit-products/$id");
            }
        } 
    }
    public function updateProducts_olddd() {
                $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                $this->form_validation->set_rules('cat_id', 'Catogery', 'required|trim');
                $this->form_validation->set_rules('price', 'Price', 'required|trim');
                //$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean|greater_than[0]'); gallery
                $this->form_validation->set_rules('description', 'Description', 'required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
                      
                    $id = $this->input->post('id');
                    if($this->form_validation->run()) {
                        
                            if($_FILES['image']['name'] !=" ") {
                             $config['upload_path'] = './assets/images/product/'; 
                             $config['max_size'] = 2448;
                             $config['allowed_types'] = 'jpg|jpeg|png'; 
                             $this->load->library('upload',$config);
                             $this->upload->initialize($config);
                 
                             if($this->upload->do_upload('image')){
                                   $uploadImg = $this->upload->data(); 
                                   $data['image'] = $uploadImg['file_name']; 
                              }  else {
                                   //$ierror = $this->upload->display_errors();
                                   //$this->session->set_flashdata('imgerror',$ierror);
                                   //redirect("vandor/edit-products/$id");
                              }
                            } else {  
                                   $data['image'] =  $this->input->post('old_image');
                              }         
                            
                            $data['vender_id'] = $this->venderId;
                            $data['product_name'] = $this->input->post('product_name');
                            $data['slug'] =  url_title($data['product_name'], 'dash', true);
                            $data['gender'] = $this->input->post('gender');
                            $data['cat_id'] = $this->input->post('cat_id');
                            $data['price'] = $this->input->post('price');
                            $size = '';
                            if(!empty($this->input->post('size'))){
                                $size = implode(',',$this->input->post('size'));
                            }
                            $data['size'] = $size;
                            //$data['size'] = implode(',',$this->input->post('size'));
                            $data['description'] = $this->input->post('description');
                            $data['discount'] = $this->input->post('discount');
                            $data['created_at']  = date('Y-m-d h:i:s');
                            
                            $table = 'products'; 
                            $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                            $update = $this->Page_Model->common_update($data,$where,$table); 
                            //echo $update; exit;  
                            if($update) {
                               // if($_FILES['gallery_image']['name'] !="") {
                               //if(isset($_FILES['gallery_image']['name'])) {
                                  //print_r($_FILES['gallery_image']); exit;
                                if($_FILES['gallery_image']['size'] > 0) {  
                                $count = count($_FILES['gallery_image']['name']);
                                $files = $_FILES; $uploadData = array();
                                for($i = 0; $i < $count; $i++ ) {
                                $_FILES['gallery_image']['name']     = $files['gallery_image']['name'][$i]; 
                                $_FILES['gallery_image']['type']     = $files['gallery_image']['type'][$i]; 
                                $_FILES['gallery_image']['tmp_name'] = $files['gallery_image']['tmp_name'][$i]; 
                                $_FILES['gallery_image']['error']     = $files['gallery_image']['error'][$i]; 
                                $_FILES['gallery_image']['size']     = $files['gallery_image']['size'][$i]; 
                                  
                                $uploadPath = './assets/images/gallery/'; 
                                $config1['upload_path'] = $uploadPath; 
                                $config1['allowed_types'] = 'jpg|jpeg|png'; 
                                $this->load->library('upload', $config1); 
                                $this->upload->initialize($config1); 
                                    
                                     if($this->upload->do_upload('gallery_image')) { 
                                        // Uploaded file data 
                                     $fileData = $this->upload->data(); 
                                     $uploadData[$i]['gallery_image'] = $fileData['file_name']; 
                                     $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
                                     $uploadData[$i]['product_id'] = $id;
                                    }else {
                                         //$data['imgMerror'] = '';
                                         //$data['imgMerror'] = $this->upload->display_errors();
                                         //print_r($data['imgerror']);
                                         //redirect("vandor/edit-products/$id");
                                    }                   
                               }
                                    if(!empty($uploadData)) { $this->db->insert_batch('product_galary',$uploadData); }
                                  
                        }  //else { multiple image else part } 
                                 $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Product Updated Successfully!!</span>');
                                 redirect('stylist-zone/manage-products');    
                            } else {
                                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                redirect('stylist-zone/manage-products');
                            }
                     } else {
                         redirect("stylist-zone/edit-products/$id");
                     } 
    }
    public function deleteProducts($id) {
        $delete = $this->db->delete('products', array('id' => $id));  
        if($delete) { 
           $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Product Delete Successfully!!</span>');
            redirect('stylist-zone/manage-products');
            } else {
              $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
              redirect('stylist-zone/manage-products');
        }
    }
    
    
    public function address(){
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        $data['user_shipping_address'] = $this->db->get_where('user_shipping_address',['user_id'=> $this->venderId])->result_array();

        $this->load->view('front/vandor/address',$data);
    }
    public function wishlist(){
         if(!$this->session->userdata('userType') == 2  ) {
            redirect();
        }
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        $wishlistArray = $this->db->get_where('wishlist',['user_id' => $this->userID ])->result();
        foreach ($wishlistArray as $key => $value) {
           $this->db->select('products.*, vender.fname,vender.lname'); 
            $this->db->from('products');
            $this->db->join('vender', 'vender.id = products.vender_id');
            $this->db->where('products.id', $value->product_id);
            $productDetails  = $this->db->get()->row();

            $wishlistArray[$key]->productRow = $productDetails;
        }
        
        $data['wishlistArray'] = $wishlistArray; 

        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
        $this->load->view('front/vandor/wishlist',$data);
    }
    public function wishlistadd(){
        $data = array();
        $data['user_id'] =  $this->input->post('loggedid');
        $data['product_id'] =  $this->input->post('id');
        $data['cat_id'] =  $this->input->post('catId');
        $data['vendor_id'] =  $this->input->post('venderId');

        $datas = $this->db->get_where('wishlist',$data)->row();
        if ($datas) {
            $datas = $this->db->delete('wishlist',$data);
            $msg =  'Product removed from wishlist';
            $st = 0;
        }else{
            $this->db->insert('wishlist',$data);
            $insert_id = $this->db->insert_id(); 
            $msg =  'Product added into wishlist';
            $st = 1;
        }
        $a['success'] = $msg;
        $a['status'] = $st;
        echo json_encode($a);

    }
    public function setting()
    {   
        if($this->session->userdata('userType') == 2  ) {
            
        $this->form_validation->set_rules('currentPassword','Current Password','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|matches[password]');
        
        $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
                $currentPassword = $this->security->xss_clean($this->input->post('currentPassword'));
                $password = $this->security->xss_clean($this->input->post('password'));
                $cpassword = $this->security->xss_clean($this->input->post('cpassword'));
                
                $this->db->select('*');
                $this->db->from('vender');
                $this->db->where('id',$this->venderId);
                $this->db->where('password',md5($currentPassword));
                $query = $this->db->get();
                if($query->num_rows()==1){

                    $data = array( 'password' => md5($password), 'updated_at' => date('Y-m-d H:i:s')  );
                    $this->db->where('id', $this->venderId);
                    $this->db->update('vender', $data); 

                    $this->session->set_flashdata('updatePassword','<span class="pink_c text-white p-2">Your password is updated successfully.</span>');
                    redirect('stylist-zone/setting');
                }else{
                    $this->session->set_flashdata('error','<span class="pink_c text-danger p-2">Password not match, try again</span>');
                    redirect('stylist-zone/setting');
                }
           
            } else {
                $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
                $this->load->view('front/vandor/setting',$data);
              }
        } else {
            redirect('');
        }      
    }
    public function vendorForgotPass______()
    {   
        if($this->session->userdata('userType')) {
            redirect(base_url());
        }
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            $result = $this->db->get_where('vender',['email' => $email]);
            if($result->num_rows() == 1) {
                $output = $result->row();   $fullName = $output->fname.' '.$output->lname;
                $password  =  $this->random_password();
                $this->db->where('email', $email);
                $update_password = $this->db->update('vender',['password'=> md5($password),'otp'=> $password,'updated_at' => date('Y-m-d H:i:s') ]); 
                    
                $option  = '<style>';
                    $option  .= '.banner{background: #FFFA00; }
                            .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                            .banner img {width: 100%; height: 190px; object-fit: cover; }
                            .meddle_content{padding:30px 40px; background:#fff;}
                            .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                            .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                            .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                            .bt_box:hover{text-decoration:none; color:#fff; background:#000;}
                            ';
                $option  .= '</style>';
                $option  .= '<div class="common_w banner">';
                    $option  .= '<div class="row m-0">';
                        $option  .= '<div class="col-sm-7 p-0">';
                            $option  .= '<h1>Re-Set your password</h1>';
                        $option  .= '</div>';
                        $option  .= '<div class="col-sm-5 p-0">';
                            $option  .= '<img src="'.base_url('assets/images/email_banner.png').'" class="img-fluid">';
                        $option  .= '</div>';
                    $option  .= '</div>';
                $option  .= '</div>';

                
                 
                 
                //
                $subject = 'Forgot Password';  
                /*$mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<div class="common_w meddle_content">';
                        $mailContent .= '<h4>Hi : Admin</h4>';
                    $mailContent .= '</div>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                
                 
                $to = TO_EMAIL;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;*/
                //$this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
                
                $mailContent =  mailHtmlHeader_New($this->site);
                    $mailContent .= $option;
                    $mailContent .= '<div class="common_w meddle_content">';
                        $mailContent .= '<h4>Hi '.ucwords($fullName).'</h4>';
                        $mailContent .= '<p>Looks like you have re-set your password. <br>Kindly use this OTP while changing the password :  '.$password.'<br/>Please click the button below to change you password.</p>';
                        $mailContent .= '<p><a class="bt_box" href="'.base_url().'login/reset_password"> Change my password</a></p>';
                    $mailContent .= '</div>';
                $mailContent .= mailHtmlFooter_New_1($this->site);
                 //die;

                $to      =  $email;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                
                $this->db->where('email', $email);
                $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('Y-m-d H:i:s') ]); 
                if($update_password) {
                    $this->session->set_flashdata('success',"<span class='text-success mb-3'>Your reset otp has been sent to your email, please make sure to check your JUNK folder if you don’t get it in your inbox.</span>");
                }
                
            } else {
                $this->session->set_flashdata('success',"<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
                $msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
            }
        }
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/forgot-password',$data);   
    }
    public function vendorForgotPass()
    {   
        if($this->session->userdata('userType')) {
            redirect(base_url());
        }
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            $result = $this->db->get_where('vender',['email' => $email]);
            if($result->num_rows() == 1) {
                $output = $result->row();   $fullName = $output->fname.' '.$output->lname;
                $password  =  $this->random_password();
                $this->db->where('email', $email);
                $update_password = $this->db->update('vender',['password'=> md5($password),'otp'=> $password,'updated_at' => date('Y-m-d H:i:s') ]); 
                    
                $option  = '<p>Kindly put this OTP while changing the password :  '.$password.'</p>';
                $option .= '<p>Please find below the link for changing your password. : Link <a href="'.base_url().'login/reset_password"> Please click here</a></p>';

                 
                 
                //
                $subject = 'Forgot Password';  
                /*$mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                
                 
                $to = TO_EMAIL;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;*/
                //$this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
                
                $mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($fullName).'</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                 

                $to      =  $email;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                
                $this->db->where('email', $email);
                $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('Y-m-d H:i:s') ]); 
                if($update_password) {
                    $this->session->set_flashdata('success',"<span class='text-success mb-3'>Your reset otp has been sent to your email, please make sure to check your JUNK folder if you don’t get it in your inbox.</span>");
                }
                
            } else {
                $this->session->set_flashdata('success',"<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
                $msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
            }
        }
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/forgot-password',$data);   
    }
    function random_password() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); 
        $alpha_length = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) 
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
      return implode($password); 
    }
    public function resetPass()
    {
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
            
            $msg = array();     
           if( $this->form_validation->run()) { 
                
                $email = $this->input->post('email');
                $result = $this->db->get_where('vender',['email' => $email]);
                if($result->num_rows() == 1) {
                    $output = $result->row();  
                    $password  =  $this->random_password();
                    $this->db->where('email', $email);
                    $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('Y-m-d H:i:s') ]); 
                    $subject = 'Forgot Password';       
                        
                    $option = ' 
                            <h3>Forgot Password</h3>
                            <br><br>
                            <p>Dear '.$output->fname.' '.$output->lname.', <br><br>Your password successfully updated, please change the password from the dashboard section.</p>
                            <br>
                            <p><b>Password:</b> '.$password.'</p>';
                            
                             
                    $fullName = $output->fname.' '.$output->lname;
                            
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($fullName).'</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                     
    
                    $to      =  $email;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                    if($update_password) {
                        $msg = array('success' => "<span class='text-info text-left p-2 mb-3'>your password successfully updated, updated password send on your mail</span>");
                    }
                    
                } else {
                    //$this->session->set_flashdata('error','Email Id not registered in our directory');
                    $msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
                    //redirect('forgot-password');
                }
        } else {
             $msg = array( 'error' => true,  'email_err' => form_error('email'));
        }
        echo json_encode($msg);

    }
    public function addTags()
    {
        if(!$this->session->userdata('userType') == 2  ) { redirect(); }
        
        $this->form_validation->set_rules('tag','Tag','required|trim|is_unique[idea_tag.tag]');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another tag'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) 
        {
                $data['add_by'] = $this->venderId;
                $data['tag'] = $this->input->post('tag');
                $data['created_at']   = date('Y-m-d h:i:s');
                    
                $insert = $this->db->insert('idea_tag',$data);
                if($insert) {
                      $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Tag Added Successfully.</span>');
                      redirect('stylist-zone/add-tags');
                      } else {
                      $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                      redirect('stylist-zone/add-tags');
                    }
         } else {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row(); 
            $this->load->view('front/vandor/tagForm',$data);
         }
    }
    public function manageTags()
    {
        if(!$this->session->userdata('userType') == 2  ) { redirect(); }
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        $data['tags'] = $this->db->get_where('idea_tag',['add_by' => $this->venderId])->result();
        $this->load->view('front/vandor/tagView',$data);
    }
    public function editTags($id){
        
        if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['tags'] = $this->db->get_where('idea_tag',['id'=> $id , 'add_by' => $this->venderId ])->row();
            if(!empty($data['tags'])) {
                $this->load->view('front/vandor/tagEdit',$data);   
            } else {
                redirect('stylist-zone/manage-tags');
            }
        } else {
            redirect();
        }
    }
    public function updateTags()
    {
        if(!$this->session->userdata('userType') == 2  ) { redirect(); }
        
        $this->form_validation->set_rules('tag','Tag','required|trim|is_unique[idea_tag.tag]');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another tag'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        $id = $this->input->post('id');
        if( $this->form_validation->run() == true) 
        {
                $data['add_by'] = $this->venderId;
                $data['tag'] = $this->input->post('tag');
                $data['updated_at']   = date('Y-m-d h:i:s');
                                    
                $update = $this->db->where('id',$id)->update('idea_tag',$data);
                
                if($update) {
                      $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Tag Updated Successfully.</span>');
                      redirect('stylist-zone/manage-tags');
                      } else {
                      $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                      redirect('stylist-zone/manage-tags');
                    }
         } else {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row(); 
            $this->load->view('front/vandor/tagForm',$data);
            redirect("stylist-zone/edit-tags/$id");
         }
    }
    public function tagStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('idea_tag',['status'=> $status]);
        echo $update;
    }
    // test purpose
     public function addIdeasTest()
    {       
        //$this->form_validation->set_rules('tag_id','Tag','required|trim');
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        //$this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
                        
                if($_FILES['image']['name'] !=" ") {
                     $config['upload_path'] = './assets/images/story/'; 
                     //$config['max_size'] = 2448;
                     $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
                     $this->load->library('upload',$config);
                     $this->upload->initialize($config);
         
                     if($this->upload->do_upload('image')){
                           $uploadImg = $this->upload->data(); 
                           $data['image'] = $uploadImg['file_name']; 
                      }  else {
                           $ierror = $this->upload->display_errors();
                           $this->session->set_flashdata('imgerror',$ierror);
                           redirect("stylist-zone/add-ideas");
                      }
                    } else { 
                            $this->session->set_flashdata('imgBerror','<span class="text-adnger">Please Upload Idea image</span>');
                           redirect("stylist-zone/add-ideas");
                    }    
                    $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                    $data['title'] = $this->input->post('title');
                    $data['content'] = $this->input->post('content');
                    $data['created_at']   = date('Y-m-d h:i:s');
                    $data['vender_id'] = $this->venderId;
                    $data['slug'] = url_title($data['title'], 'dash', true);
                    
                    $insert = $this->db->insert('ideas',$data);
                    $insert_id = $this->db->insert_id();
                            
                            if($insert_id) {
                                    
                                if(!empty($_FILES['gallery_image']['name'])) {
                                $count = count($_FILES['gallery_image']['name']);
                                $files = $_FILES;
                                for($i = 0; $i < $count; $i++ ) {
                                $_FILES['gallery_image']['name']     = $files['gallery_image']['name'][$i]; 
                                $_FILES['gallery_image']['type']     = $files['gallery_image']['type'][$i]; 
                                $_FILES['gallery_image']['tmp_name'] = $files['gallery_image']['tmp_name'][$i]; 
                                $_FILES['gallery_image']['error']     = $files['gallery_image']['error'][$i]; 
                                $_FILES['gallery_image']['size']     = $files['gallery_image']['size'][$i]; 
                                  
                                $uploadPath = './assets/images/story/'; 
                                $config1['upload_path'] = $uploadPath; 
                                $config1['allowed_types'] = 'jpg|jpeg|webp'; 
                                $this->load->library('upload', $config1); 
                                $this->upload->initialize($config1); 
                                    
                                     if($this->upload->do_upload('gallery_image')) { 
                                        // Uploaded file data 
                                     $fileData = $this->upload->data(); 
                                     $uploadData[$i]['gallery_image'] = $fileData['file_name']; 
                                     $uploadData[$i]['created_at'] = date("Y-m-d H:i:s");
                                     $uploadData[$i]['ideas_id'] = $insert_id;
                                    }else {
                                         $data['imgGerror'] = '';
                                         $data['imgGerror'] = $this->upload->display_errors();
                                         //print_r($data['imgerror']);
                                         redirect('stylist-zone/add-ideas-test');
                                    }                   
                               }
                                 $batch_insert = $this->db->insert_batch('ideas_gallary',$uploadData);
                               
                                    if($batch_insert) {
                                        $this->session->set_flashdata('success','<span class="text-info  p-2">Portfolio  added Successfully!!</span>');
                                        redirect('stylist-zone/add-ideas-test');
                                        } else {
                                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                        redirect('stylist-zone/add-ideas-test');
                            }
                   } else {
                       //multiple image else part
                   } 
                            } else {
                                // insert else part
                            }
                        // if($insert) {
                        //       $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Ideas Portfolio add Successfully!!</span>');
                        //         redirect('stylist-zone/add-ideas');
                        //         } else {
                        //           $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                        //           redirect('stylist-zone/add-ideas');
                        //     }
                    
         } else {
             $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
             $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
             $this->load->view('front/vandor/addIdeasTest',$data);
         }
    }
    // test purpose
    public function addIdeas_ooo()
    {     
        if($this->session->userdata('userType')) {
        }else{
            redirect(base_url());
        }
        //$this->form_validation->set_rules('tag_id','Tag','required|trim');
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        //$this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
                        
            $this->uploadPath = 'assets/images/story/';
            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }

            $multiImage = $this->uploadMultipleImageOnly('multi_image',$this->uploadPath);
            if(!empty($multiImage)){
                $insert_= trim($multiImage,',');
                $data['multi_image']=  trim($insert_,',');
            }

            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['created_at']   = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['slug'] = url_title($data['title'], 'dash', true);
            
            $insert = $this->db->insert('ideas',$data);
            
            if($insert) {
                $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$this->venderId,'status'=> 1]);
                $total_portfolio = $ideas->num_rows();
                $this->common_model->commonUpdate('vender',['portfolio_count'=>$total_portfolio],['id'=>$this->venderId]);
                
                $this->session->set_flashdata('success','<span class="btn btn-success pink_c pt-2">Portfolio successfully added !!</span>');
                redirect('stylist-zone/add-ideas');
                } else {
                  $this->session->set_flashdata('error','<span class="btn bg-danger pt-2">Something Went Wrong, try again!!</span>');
                  redirect('stylist-zone/add-ideas');
            }
                    
         } else {
             $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
             $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
             $this->load->view('front/vandor/ideasForm',$data);
         }
    }
    public function addIdeas(){
        $postData = $this->input->post();     
        if($this->session->userdata('userType')) {
        }else{
            redirect(base_url());
        }
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
             
            $check_content_sightengine = array();
            $check_content_sightengine['title'] = $postData['title'];;
            $check_content_sightengine['content'] = $postData['content'];;
            $check_content_sightengine['tag_id'] = $postData['tag_id'];;
            $dd = check_content_sightengine($check_content_sightengine);
            if ($dd) {
                $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                //redirect('user/user-profile');
                redirect('stylist-zone/add-ideas');
            }else{  
                $c_c_s = array();

                $this->uploadPath = 'assets/images/story/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                    $c_c_s['image'] = base_url($this->uploadPath.$image);
                }

                $multiImage = $this->uploadMultipleImageOnly('multi_image',$this->uploadPath);
                if(!empty($multiImage)){
                    $insert_= trim($multiImage,',');
                    $data['multi_image']=  trim($insert_,',');
                    $aa = explode(',', $data['multi_image']);
                    $j =0;
                    foreach ($aa as $key => $value) {$j++;
                        $c_c_s['image'.$j] = base_url($this->uploadPath.$value);
                    }
                    
                }

                $dd = check_image_sightengine($c_c_s);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                    redirect('stylist-zone/add-ideas');
                }else{ 

                    $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                    $data['title'] = $this->input->post('title');
                    $data['content'] = $this->input->post('content');
                    $data['created_at']   = date('Y-m-d h:i:s');
                    $data['vender_id'] = $this->venderId;
                    $data['slug'] = url_title($data['title'], 'dash', true);
                    
                    $insert = $this->db->insert('ideas',$data);
                    
                    if($insert) {
                        $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$this->venderId,'status'=> 1]);
                        $total_portfolio = $ideas->num_rows();
                        $this->common_model->commonUpdate('vender',['portfolio_count'=>$total_portfolio],['id'=>$this->venderId]);
                        
                        $this->session->set_flashdata('success','<span class="btn btn-success pink_c pt-2">Portfolio successfully added !!</span>');
                        redirect('stylist-zone/add-ideas');
                    } else {
                        $this->session->set_flashdata('error','<span class="btn bg-danger pt-2">Something Went Wrong, try again!!</span>');
                          redirect('stylist-zone/add-ideas');
                    }
                }
            }
                    
         } else {
             $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
             $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
             $this->load->view('front/vandor/ideasForm',$data);
         }
    }
    public function manageIdeas(){   
          if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            //$data['blogs'] = $this->db->get_where('ideas',['vender_id'=> $this->venderId])->result();

            $condition = " WHERE id != '0' and vender_id = ".$this->venderId." order by id DESC";
            $data['blogs'] = $this->common_model->get_all_details_query('ideas',$condition)->result();

            $this->load->view('front/vandor/ideas',$data);
        } else {
            redirect(); 
        }    
    }
    public function editIdeas($id){       
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            if ($postData) {
                $check_content_sightengine = array();
                $check_content_sightengine['title'] = $postData['title'];;
                $check_content_sightengine['content'] = $postData['content'];;
                $check_content_sightengine['tag_id'] = $postData['tag_id'];;
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                    //redirect('user/user-profile');
                }else{  
                    $c_c_s = array();

                    $this->form_validation->set_rules('title','Idea Title','required|trim');
                    $this->form_validation->set_rules('content','Short Description','required|trim');
                    //$this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
                    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
                    
                    $id = $this->input->post('id');
                    $this->uploadPath = 'assets/images/story/';
                    if( $this->form_validation->run() == true) {
                         
                        $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                        if(!empty($image)){
                            $data['image'] = $image;
                            $c_c_s['image'] = base_url($this->uploadPath.$image);
                        }

                        $multiImage = $this->uploadMultipleImageOnly('multi_image',$this->uploadPath);
                        if(!empty($multiImage)){
                            $insert_= trim($multiImage,',');
                            $IsExistGallery = $this->db->get_where('ideas',['id' => $id ])->row();
                            if(!empty($IsExistGallery)){
                                $galleryNew = $IsExistGallery->multi_image;
                                $NowGalleryCreated = $galleryNew . ',' .$insert_;
                                $data['multi_image']=  trim($NowGalleryCreated,',');
                                //$data['multi_image']=  trim($insert_,',');
                            }
                            else{
                                $data['multi_image']=  trim($insert_,',');
                            }
                            $aa = explode(',', $data['multi_image']);
                            $j =0;
                            foreach ($aa as $key => $value) {$j++;
                                $c_c_s['image'.$j] = base_url($this->uploadPath.$value);
                            }
                        }
                        $dd = check_image_sightengine($c_c_s);
                        if ($dd) {
                            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                        }else{ 
                            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                            $data['title'] = $this->input->post('title');
                            $data['content'] = $this->input->post('content');
                            $data['updeated_at']   = date('Y-m-d h:i:s');
                            $data['vender_id'] = $this->venderId;
                            $data['slug'] = url_title($data['title'], 'dash', true);
                            
                            $table = 'ideas'; $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                            
                            $update = $this->Page_Model->common_update($data,$where,$table); ;
                            echo $this->db->last_query();
                            if($update) { 
                               $this->session->set_flashdata('success','<span class="btn btn-success pink_c pt-2">Portfolio successfully updated!!</span>');
                                redirect('stylist-zone/manage-portfolio');
                            } else {
                                $this->session->set_flashdata('error','<span class="btn bg-danger pt-2">Something Went Wrong, try again!!</span>');
                                redirect('stylist-zone/manage-portfolio');
                            }
                        }
                    } else {
                         //redirect("stylist-zone/edit-ideas/$id");
                    }

                }
            
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1])->result();
            $data['idea'] = $this->db->get_where('ideas',['status'=> 1 ,'id' => $id ])->row();

            if(!empty($data['idea'])) {
                $this->load->view('front/vandor/ideasEdit',$data);   
            } else {
                redirect('stylist-zone/manage-portfolio');
            }
        } else {
            redirect();
        }
    }
    public function deleteIdeaImages(){
        $postData = $this->input->get();
        $table = 'ideas';
        $id = $postData['id'];
        $img = $postData['img'];
        $column = $postData['column'];
        $path = $postData['path'];
       
        $row = $this->db->get_where($table,['status'=> 1 ,'id' => $id ])->row_array();
        if($row){
            if($row[$column]){
                $b = array();
                $a = explode(',',$row[$column]);
                $pos = array_search($img, $a);
                unset($a[$pos]);
                $insert_data[$column] = implode(',',$a);
                $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                $update = $this->Page_Model->common_update($insert_data,$where,$table); ;
                echo $this->db->last_query();
            }
        }
    }
    public function updateIdeas() 
    {
        //$this->form_validation->set_rules('tag_id','Tag','required|trim');
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        //$this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        $id = $this->input->post('id');
        $this->uploadPath = 'assets/images/story/';
        if( $this->form_validation->run() == true) {
             
            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }

            $multiImage = $this->uploadMultipleImageOnly('multi_image',$this->uploadPath);
            if(!empty($multiImage)){
                $insert_= trim($multiImage,',');
                $IsExistGallery = $this->db->get_where('ideas',['id' => $id ])->row();
                if(!empty($IsExistGallery)){
                    $galleryNew = $IsExistGallery->multi_image;
                    $NowGalleryCreated = $galleryNew . ',' .$insert_;
                    $data['multi_image']=  trim($NowGalleryCreated,',');
                }
                else{
                    $data['multi_image']=  trim($insert_,',');
                }
            }

            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['updeated_at']   = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['slug'] = url_title($data['title'], 'dash', true);
            
            $table = 'ideas'; $where = ['vender_id'=> $this->venderId, 'id'=> $id];
            
            $update = $this->Page_Model->common_update($data,$where,$table); ;
            echo $this->db->last_query();
            if($update) { 
               $this->session->set_flashdata('success','<span class="btn btn-success pink_c pt-2">Portfolio successfully updated!!</span>');
                redirect('stylist-zone/manage-portfolio');
            } else {
                $this->session->set_flashdata('error','<span class="btn bg-danger pt-2">Something Went Wrong, try again!!</span>');
                redirect('stylist-zone/manage-portfolio');
            }
         } else {
             redirect("stylist-zone/edit-ideas/$id");
         }
    }
    public function deleteIdeas($id) {
        
        $delete = $this->db->delete('ideas', array('id' => $id));  
        if($delete) { 
            $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$this->venderId,'status'=> 1]);
            $total_portfolio = $ideas->num_rows();
            $this->common_model->commonUpdate('vender',['portfolio_count'=>$total_portfolio],['id'=>$this->venderId]);
            
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio Deleted Successfully!!</span>');
            redirect('stylist-zone/manage-portfolio');
        } else {
              $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
              redirect('stylist-zone/manage-portfolio');
        }
    }
    public function ideaStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('ideas',['status'=> $status]);
        $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$this->venderId,'status'=> 1]);
        $total_portfolio = $ideas->num_rows();
        $this->common_model->commonUpdate('vender',['ideas'=>$total_portfolio],['id'=>$this->venderId]);
        echo $update;
    }






    public function manageVideo(){   
        if($this->session->userdata('userType') == 2  ) {
            $tbl = 'portfolio_video';
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['blogs'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE vender_id ='.$this->venderId.' AND videoType !="capture" ORDER BY id DESC')->result();

            $data['portfolio_video'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE vender_id ='.$this->venderId.' AND videoType ="capture" ORDER BY id DESC')->result();


            $this->load->view('front/vandor/video',$data);
        } else {
            redirect(); 
        }    
    }
    public function addVideo(){       
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
                        
            $this->uploadPath = 'assets/images/story/';
            
            if ($this->input->post('image1')) {
                $data['image'] = $this->input->post('image1');
            }

            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }

            
            $data['videoType'] = $this->input->post('videoType');
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['created_at']   = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['slug'] = url_title($data['title'], 'dash', true);
            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $insert = $this->db->insert('portfolio_video',$data);
            if($insert) {
                $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$this->venderId,'status'=> 1]);
                $total_portfolio = $ideas->num_rows();
                $this->common_model->commonUpdate('vender',['portfolio_video_count'=>$total_portfolio],['id'=>$this->venderId]);
                
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio video added Successfully!!</span>');
                redirect('stylist-zone/add-video');
            } else {
                  $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                  redirect('stylist-zone/add-video');
            }
                    
         } else {
             $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
             
             $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
             $this->load->view('front/vandor/videoAdd',$data);
         }
    }
    
    public function editVideo($id)
    {       
          if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
             
            $data['idea'] = $this->db->get_where('portfolio_video',['status'=> 1 ,'id' => $id ])->row();

            if(!empty($data['idea'])) {
                $this->load->view('front/vandor/videoEdit',$data);   
            } else {
                redirect('stylist-zone/manage-video');
            }
        } else {
            redirect();
         }
    }

    public function deleteVideoImages(){
        $postData = $this->input->get();
        $table = 'portfolio_video';
        $id = $postData['id'];
        $img = $postData['img'];
        $column = $postData['column'];
        $path = $postData['path'];
       
        $row = $this->db->get_where($table,['status'=> 1 ,'id' => $id ])->row_array();
        if($row){
            if($row[$column]){
                $b = array();
                $a = explode(',',$row[$column]);
                $pos = array_search($img, $a);
                unset($a[$pos]);
                $insert_data[$column] = implode(',',$a);
                $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                $update = $this->Page_Model->common_update($insert_data,$where,$table); ;
                echo $this->db->last_query();
            }
        }
    }
    public function updateVideo() 
    {
        //$this->form_validation->set_rules('tag_id','Tag','required|trim');
        $this->form_validation->set_rules('title','Idea Title','required|trim');
        $this->form_validation->set_rules('content','Short Description','required|trim');
        //$this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        $id = $this->input->post('id');
        $this->uploadPath = 'assets/images/story/';
        if( $this->form_validation->run() == true) {
            if ($this->input->post('image1')) {
                $data['image'] = $this->input->post('image1');
            }

            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }

             

           
            
            $data['videoType'] = $this->input->post('videoType');

            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['updeated_at']   = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['slug'] = url_title($data['title'], 'dash', true);
            
            $table = 'portfolio_video'; 
            $where = ['vender_id'=> $this->venderId, 'id'=> $id];
            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $update = $this->Page_Model->common_update($data,$where,$table); ;
            echo $this->db->last_query();
            if($update) { 
               $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio Video Updated Successfully!!</span>');
                redirect('stylist-zone/manage-video?tab=upload-video');
            } else {
                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                redirect('stylist-zone/manage-video?tab=upload-video');
            }
         } else {
             //redirect("stylist-zone/edit-ideas/$id");
         }
    }
    public function addVideo_by_ajax(){       
            $this->uploadPath = 'assets/images/story/';
            
            if ($this->input->post('image1')) {
                $data['image'] = $this->input->post('image1');
            }

            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
            if(!empty($image)){
                $data['image'] = $image;
            }
            $data['videoType'] = $this->input->post('videoType');
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['created_at']   = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['slug'] = url_title($data['title'], 'dash', true);
            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $insert = $this->db->insert('portfolio_video',$data);
            if($insert) {
                $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$this->venderId,'status'=> 1]);
                $total_portfolio = $ideas->num_rows();
                $this->common_model->commonUpdate('vender',['portfolio_video_count'=>$total_portfolio],['id'=>$this->venderId]);
                
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio video added Successfully!!</span>');
                echo '<span class="text-white pink_c p-2">Portfolio video added Successfully!!</span>';
            } else {
                echo 2;
            }
            die;
    }
    public function updateVideo_by_ajax() {
        $id = $this->input->post('id');
        $this->uploadPath = 'assets/images/story/';

        if ($this->input->post('image1')) {
            $data['image'] = $this->input->post('image1');
        }


        $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
        if(!empty($image)){
            $data['image'] = $image;
        }
            
        $data['videoType'] = $this->input->post('videoType');

        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $data['updeated_at']   = date('Y-m-d h:i:s');
        $data['vender_id'] = $this->venderId;
        $data['slug'] = url_title($data['title'], 'dash', true);
        
        $table = 'portfolio_video'; 
        $where = ['vender_id'=> $this->venderId, 'id'=> $id];
        $data['tag_id'] = implode(',',$this->input->post('tag_id'));
        $update = $this->Page_Model->common_update($data,$where,$table); ;
        if($update) { 
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio video updated successfully!!</span>');
                
            echo '<span class="text-white pink_c p-2">Portfolio Video Updated Successfully!!</span>';
            die;
        }
         
    }
    public function deleteVideo($id) {
        
        $delete = $this->db->delete('portfolio_video', array('id' => $id));  
        if($delete) { 
            $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$this->venderId,'status'=> 1]);
            $total_portfolio = $ideas->num_rows();
            $this->common_model->commonUpdate('vender',['portfolio_video_count'=>$total_portfolio],['id'=>$this->venderId]);
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Portfolio Video Deleted Successfully!!</span>');
            redirect('stylist-zone/manage-video?tab=upload-video');
        } else {
              $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
              redirect('stylist-zone/manage-video?tab=upload-video');
        }
    }
    public function VideoStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('portfolio_video',['status'=> $status]);
        
        $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$this->venderId,'status'=> 1]);
        $total_portfolio = $ideas->num_rows();
        $this->common_model->commonUpdate('vender',['portfolio_video_count'=>$total_portfolio],['id'=>$this->venderId]);
        echo $update;
    }

    
    public function manageStories(){   
          if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            //$data['blogs'] = $this->db->get_where('blog',['vender_id'=> $this->venderId])->result();

            $condition = " WHERE vender_id = ".$this->venderId." order by id DESC";
            $data['blogs'] = $this->common_model->get_all_details_query('blog',$condition)->result();

            $this->load->view('front/vandor/manage-style-stories',$data);
        } else {
            redirect(); 
        }    
    }
    
    public function storyStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('blog',['status'=> $status]);
        echo $update;
    }
    public function addStories(){
        $postData = $this->input->post();

        $this->form_validation->set_rules('category_id','Category','required|trim');
        $this->form_validation->set_rules('blogTitle','Story Title','required|trim|is_unique[blog.blogTitle]');
        $this->form_validation->set_rules('shortData','Short Description','required|trim');
        $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {

            $check_content_sightengine = array();
            $check_content_sightengine['title'] = $postData['blogTitle'];;
            $check_content_sightengine['content'] = $postData['longData'];;
            $check_content_sightengine['tag_id'] = $postData['shortData'];;
            $dd = check_content_sightengine($check_content_sightengine);
            if ($dd) {
                $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                //redirect('user/user-profile');
            }else{  
                $c_c_s = array();

                $this->uploadPath = 'assets/images/story/';
                $image = $this->uploadSingleImageOnly('blogImage',$this->uploadPath);
                if(!empty($image)){
                    $data['blogImage'] = $image;
                    $c_c_s['image'] = base_url($this->uploadPath.$image);
                }
                $image = $this->uploadSingleImageOnly('detailImg',$this->uploadPath);
                if(!empty($image)){
                    $data['detailImg'] = $image;
                    $c_c_s['image1'] = base_url($this->uploadPath.$image);
                }
                $dd = check_image_sightengine($c_c_s);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                     
                }else{ 
                     
                    $data['category_id'] = $this->input->post('category_id');
                    $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                    $data['blogTitle'] = $this->input->post('blogTitle');
                    $data['shortData'] = $this->input->post('shortData');
                    $data['longData'] = $this->input->post('longData');
                    $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
                    $data['vender_id'] = $this->venderId;
                    $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
                    
                    $insert = $this->db->insert('blog',$data);
                    if($insert) {
                        $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details added Successfully!!</span>');
                        redirect('stylist-zone/add-style-stories');
                    } else {
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                        redirect('stylist-zone/add-style-stories');
                    }
                }
            }
        }
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
        $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
        $this->load->view('front/vandor/add-style-stories',$data);
    }
    public function editStories($id){

        if($this->venderId) {
            $postData = $this->input->post();
            if ($postData) {
                $check_content_sightengine = array();
                $check_content_sightengine['title'] = $postData['blogTitle'];;
                $check_content_sightengine['content'] = $postData['shortData'];;
                $check_content_sightengine['tag_id'] = $postData['longData'];;
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                    //redirect('user/user-profile');
                }else{  
                    $c_c_s = array();

                    $this->form_validation->set_rules('category_id','Category','required|trim');
                    $this->form_validation->set_rules('blogTitle','Story Title','required|trim');
                    $this->form_validation->set_rules('shortData','Short Description','required|trim');
                    $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
                    $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
                    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
                    
                    $id = $this->input->post('id');
                    if( $this->form_validation->run() == true) {
                                    
                          
                        $this->uploadPath = 'assets/images/story/';
                        $image = $this->uploadSingleImageOnly('blogImage',$this->uploadPath);
                        if(!empty($image)){
                            $data['blogImage'] = $image;
                            $c_c_s['image'] = base_url($this->uploadPath.$image);
                        }
                        $image = $this->uploadSingleImageOnly('detailImg',$this->uploadPath);
                        if(!empty($image)){
                            $data['detailImg'] = $image;
                            $c_c_s['image1'] = base_url($this->uploadPath.$image);
                        }
                        $dd = check_image_sightengine($c_c_s);
                        if ($dd) {
                            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                             
                        }else{
                            $data['category_id'] = $this->input->post('category_id');
                            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                            $data['blogTitle'] = $this->input->post('blogTitle');
                            $data['shortData'] = $this->input->post('shortData');
                            $data['longData'] = $this->input->post('longData');
                            $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
                            $data['vender_id'] = $this->venderId;
                            $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
                            
                            $table = 'blog'; 
                            $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                            $update = $this->Page_Model->common_update($data,$where,$table); 
                            if($update) {
                                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details updated Successfully!!</span>');
                                redirect('stylist-zone/manage-style-stories');
                            } else {
                                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                redirect('stylist-zone/manage-style-stories');
                            }
                        }
                    } else {
                        redirect("stylist-zone/edit-style-stories/$d");
                    } 
                }
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['styleStory'] = $this->db->get_where('blog',['vender_id'=> $this->venderId, 'id' => $id ])->row();
            if($data['styleStory']) {
                $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
                $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
                $this->load->view('front/vandor/edit-style-stories',$data);
            } else {
                redirect('stylist-zone/manage-style-stories');     
            }
        } else {
            redirect();
        }
    }


    public function addStories__(){       
        $this->form_validation->set_rules('category_id','Category','required|trim');
        $this->form_validation->set_rules('blogTitle','Story Title','required|trim|is_unique[blog.blogTitle]');
        $this->form_validation->set_rules('shortData','Short Description','required|trim');
        $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
            $this->uploadPath = 'assets/images/story/';
            $image = $this->uploadSingleImageOnly('blogImage',$this->uploadPath);
            if(!empty($image)){
                $data['blogImage'] = $image;
            }
            $image = $this->uploadSingleImageOnly('detailImg',$this->uploadPath);
            if(!empty($image)){
                $data['detailImg'] = $image;
            }

                 
            $data['category_id'] = $this->input->post('category_id');
            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $data['blogTitle'] = $this->input->post('blogTitle');
            $data['shortData'] = $this->input->post('shortData');
            $data['longData'] = $this->input->post('longData');
            $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
            
            $insert = $this->db->insert('blog',$data);
            if($insert) {
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details added Successfully!!</span>');
                redirect('stylist-zone/add-style-stories');
            } else {
                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                redirect('stylist-zone/add-style-stories');
            }
        } else {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
            $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
            $this->load->view('front/vandor/add-style-stories',$data);
        }
    }
    public function editStories__($id){
        if($this->venderId) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['styleStory'] = $this->db->get_where('blog',['vender_id'=> $this->venderId, 'id' => $id ])->row();
            if($data['styleStory']) {
                $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
                $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
                $this->load->view('front/vandor/edit-style-stories',$data);
            } else {
                redirect('stylist-zone/manage-style-stories');     
            }
        } else {
            redirect();
        }
    }
    public function updateStories(){
        $this->form_validation->set_rules('category_id','Category','required|trim');
        $this->form_validation->set_rules('blogTitle','Story Title','required|trim');
        $this->form_validation->set_rules('shortData','Short Description','required|trim');
        $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        $id = $this->input->post('id');
        if( $this->form_validation->run() == true) {
                        
              
            $this->uploadPath = 'assets/images/story/';
            $image = $this->uploadSingleImageOnly('blogImage',$this->uploadPath);
            if(!empty($image)){
                $data['blogImage'] = $image;
            }
            $image = $this->uploadSingleImageOnly('detailImg',$this->uploadPath);
            if(!empty($image)){
                $data['detailImg'] = $image;
            }   
            $data['category_id'] = $this->input->post('category_id');
            $data['tag_id'] = implode(',',$this->input->post('tag_id'));
            $data['blogTitle'] = $this->input->post('blogTitle');
            $data['shortData'] = $this->input->post('shortData');
            $data['longData'] = $this->input->post('longData');
            $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
            $data['vender_id'] = $this->venderId;
            $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
            
            $table = 'blog'; 
            $where = ['vender_id'=> $this->venderId, 'id'=> $id];
            $update = $this->Page_Model->common_update($data,$where,$table); 
            if($update) {
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details updated Successfully!!</span>');
                redirect('stylist-zone/manage-style-stories');
            } else {
                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                redirect('stylist-zone/manage-style-stories');
            }
        } else {
            redirect("stylist-zone/edit-style-stories/$d");
        }
    }
    public function addStories11(){       
        $this->form_validation->set_rules('category_id','Category','required|trim');
        $this->form_validation->set_rules('blogTitle','Story Title','required|trim|is_unique[blog.blogTitle]');
        $this->form_validation->set_rules('shortData','Short Description','required|trim');
        $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == true) {
                        
                if($_FILES['blogImage']['name'] !=" ") {
                     $config['upload_path'] = './assets/images/story/'; 
                     $config['max_size'] = 2448;
                     $config['allowed_types'] = 'jpg|jpeg|png'; 
                     $this->load->library('upload',$config);
                     $this->upload->initialize($config);
         
                     if($this->upload->do_upload('blogImage')){
                           $uploadImg = $this->upload->data(); 
                           $data['blogImage'] = $uploadImg['file_name']; 
                      }  else {
                           $ierror = $this->upload->display_errors();
                           $this->session->set_flashdata('imgerror',$ierror);
                           redirect("stylist-zone/add-style-stories");
                      }
                    } else { 
                            $this->session->set_flashdata('imgBerror','<span class="text-adnger">Please Upload Style Stories Main image</span>');
                           redirect("stylist-zone/add-style-stories");
                    }    
                    
                    if($_FILES['detailImg']['name'] !=" ") {
                     $config['upload_path'] = './assets/images/story/'; 
                     $config['max_size'] = 2448;
                     $config['allowed_types'] = 'jpg|jpeg|png'; 
                     $this->load->library('upload',$config);
                     $this->upload->initialize($config);
         
                     if($this->upload->do_upload('detailImg')){
                           $uploadImg = $this->upload->data(); 
                           $data['detailImg'] = $uploadImg['file_name']; 
                      }  else {
                           $ierror = $this->upload->display_errors();
                           $this->session->set_flashdata('imgerrorr',$ierror);
                           redirect("stylist-zone/add-style-stories");
                      }
                    } else { 
                            $this->session->set_flashdata('imgBerrorr','<span class="text-adnger">Please Upload Style Stories Details image</span>');
                           redirect("stylist-zone/add-style-stories");
                    }    
                    $data['category_id'] = $this->input->post('category_id');
                    $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                    $data['blogTitle'] = $this->input->post('blogTitle');
                    $data['shortData'] = $this->input->post('shortData');
                    $data['longData'] = $this->input->post('longData');
                    $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
                    $data['vender_id'] = $this->venderId;
                    $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
                    
                    $insert = $this->db->insert('blog',$data);
                        if($insert) {
                               $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details added Successfully!!</span>');
                                redirect('stylist-zone/add-style-stories');
                                } else {
                                  $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                  redirect('stylist-zone/add-style-stories');
                            }
                    
         } else {
             $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
             $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
             $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
             $this->load->view('front/vandor/add-style-stories',$data);
         }
    }
    public function editStories11($id){
       if($this->venderId) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['styleStory'] = $this->db->get_where('blog',['vender_id'=> $this->venderId, 'id' => $id ])->row();
             if($data['styleStory']) {
                    $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();
                    $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();
                    $this->load->view('front/vandor/edit-style-stories',$data);
             } else {
                redirect('stylist-zone/manage-style-stories');     
             }
       } else {
           redirect();
       }
    }
    
    public function updateStories11(){
        $this->form_validation->set_rules('category_id','Category','required|trim');
        $this->form_validation->set_rules('blogTitle','Story Title','required|trim');
        $this->form_validation->set_rules('shortData','Short Description','required|trim');
        $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');
        $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        $id = $this->input->post('id');
        if( $this->form_validation->run() == true) {
                        
                if($_FILES['blogImage']['name'] !=" ") {
                     $config['upload_path'] = './assets/images/story/'; 
                     //$config['max_size'] = 2448;
                     $config['allowed_types'] = 'jpg|jpeg|png'; 
                     $this->load->library('upload',$config);
                     $this->upload->initialize($config);
         
                     if($this->upload->do_upload('blogImage')){
                           $uploadImg = $this->upload->data(); 
                           $data['blogImage'] = $uploadImg['file_name']; 
                      }  else {
                           //$ierror = $this->upload->display_errors();
                           //$this->session->set_flashdata('imgerror',$ierror);
                           //redirect("stylist-zone/edit-style-stories/$id");
                      }
                    } else {  
                           $data['blogImage'] = $this->input->post('old_blogImage');          
                    }    
                    
                    if($_FILES['detailImg']['name'] !=" ") {
                     $config['upload_path'] = './assets/images/story/'; 
                     //$config['max_size'] = 2448;
                     $config['allowed_types'] = 'jpg|jpeg|png'; 
                     $this->load->library('upload',$config);
                     $this->upload->initialize($config);
         
                     if($this->upload->do_upload('detailImg')){
                           $uploadImg = $this->upload->data(); 
                           $data['detailImg'] = $uploadImg['file_name']; 
                      }  else {
                           //$ierror = $this->upload->display_errors();
                           //$this->session->set_flashdata('imgerrorr',$ierror);
                           //redirect("stylist-zone/edit-style-stories/$d");
                      }
                    } else { 
                            $data['detailImg'] = $this->input->post('old_detailImg');
                    }    
                    $data['category_id'] = $this->input->post('category_id');
                    $data['tag_id'] = implode(',',$this->input->post('tag_id'));
                    $data['blogTitle'] = $this->input->post('blogTitle');
                    $data['shortData'] = $this->input->post('shortData');
                    $data['longData'] = $this->input->post('longData');
                    $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');
                    $data['vender_id'] = $this->venderId;
                    $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);
                    
                    $table = 'blog'; 
                    $where = ['vender_id'=> $this->venderId, 'id'=> $id];
                    $update = $this->Page_Model->common_update($data,$where,$table); 
                        if($update) {
                               $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Style Stories Details updated Successfully!!</span>');
                                redirect('stylist-zone/manage-style-stories');
                                } else {
                                  $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                  redirect('stylist-zone/manage-style-stories');
                            }
         } else {
            redirect("stylist-zone/edit-style-stories/$d");
         }
    }
    public function sub_vendor()
    {   
          if($this->session->userdata('userType') == 2  ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['blogs'] = $this->db->get_where('ideas',['vender_id'=> $this->venderId])->result();
            $this->load->view('front/vandor/ideas',$data);
        } else {
            redirect(); 
        }    
    }
    
    public function available_dates(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            $tbl = 'stylist_availability';
            $venderId = $this->session->userdata('venderId');
            if ($postData) {
                $dates = $postData['dates'];
                if (is_array($dates)) {
                    $i=0;
                    foreach($dates as $k=>$v){
                        $d = array();
                        $d['stylist_id'] = $venderId;
                        $d['availability_date'] = $v;
                        $r = $this->db->get_where($tbl,$d)->row();
                        if (!$r) {
                            $d['created_at'] = date('Y-m-d h:i:s');
                            $this->db->insert($tbl,$d); 
                            //echo $this->db->last_query();
                        }
                        $i++;
                    }
                    $txt = 'Date';
                    if ($i>1) {
                        $txt = 'Dates';
                    }
                    $msg = ['success'=>'<span class="text-white pink_c p-2">'.$txt.' inserted Successfully!!</span>', 'rowCount'=> $rowsCount];
                    echo json_encode($msg);
                    die;
                }else{
                    $d = array();
                    $d['stylist_id'] = $venderId;
                    $d['availability_datetime'] = date('Y-m-d H:i:s',strtotime($dates));
                    $d['availability_date'] = date('Y-m-d',strtotime($dates));
                    $d['availability_time'] = date('H:i:s',strtotime($dates));
                    $r = $this->db->get_where($tbl,$d)->row();
                    if (!$r) {
                        $d['created_at'] = date('Y-m-d h:i:s');
                        $this->db->insert($tbl,$d); 
                        $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Date inserted Successfully!!</span>');
                    }else{
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Date already exist.</span>');
                    }
                    redirect('stylist-zone/available-dates');
                }
                
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['stylist_availability'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE stylist_id ='.$venderId.' ORDER BY availability_date DESC')->result();
            $this->load->view('front/vandor/available-dates',$data);
        } else {
            redirect();   
        } 
    }
    public function available_dates_submit(){
        $postData = $this->input->get();
        $tbl = 'stylist_availability';
        $venderId = $this->session->userdata('venderId');
        
        $selected_date = $postData['selected_date'];
        $start_time = $postData['start_time'];
        $end_time = $postData['end_time'];

        $d = array();
        $d['stylist_id'] = $venderId;
        $d['availability_datetime'] = date('Y-m-d H:i:s',strtotime($selected_date));
        $d['availability_date'] = date('Y-m-d',strtotime($selected_date));
        $d['availability_start_time'] = date('H:i:s',strtotime($start_time));
        $d['availability_end_time'] = date('H:i:s',strtotime($end_time));
        $r = $this->db->get_where($tbl,$d)->row();
        if (!$r) {
            $d['created_at'] = date('Y-m-d h:i:s');
            $this->db->insert($tbl,$d); 
            $iiidd = $this->db->insert_id();
            $v = $this->db->query('SELECT * FROM '.$tbl.' WHERE id ='.$iiidd.' ORDER BY availability_date DESC')->row();
            $b = array();
            $b['title'] = ''.date('h:i A',strtotime($v->availability_start_time)).' - '.date('h:i A',strtotime($v->availability_end_time)) ;
            $b['start'] = $v->availability_date;
            $b['start_time'] = $v->availability_start_time;
            $b['end_time'] = $v->availability_end_time;
             
            $msg = ['status'=>'success','msg'=>'<span class="text-white pink_c p-2">Date inserted Successfully!!</span>', 'data'=> $b];
        }else{
            $msg = ['status'=>'fail','msg'=>'<span class="text-white pink_c p-2">Date already exist</span>', 'data'=> array()];
        }

        
        echo json_encode($msg);
        die;


    }
    public function available_dates_json(){
        $venderId = $this->session->userdata('venderId');
        $tbl = 'stylist_availability';
        $stylist_availability = $this->db->query('SELECT * FROM '.$tbl.' WHERE stylist_id ='.$venderId.' ORDER BY availability_date DESC')->result();
        $a= array();
        foreach($stylist_availability as $k=>$v){ 
            $b = array();
            $b['title'] = ''.date('h:i A',strtotime($v->availability_start_time)).' - '.date('h:i A',strtotime($v->availability_end_time)) ;
            $b['start'] = $v->availability_date;
            $b['start_time'] = $v->availability_start_time;
            $b['end_time'] = $v->availability_end_time;
            $b['id'] = $v->id;

            array_push($a, $b);
        }
        echo json_encode($a);
    }
    public function available_dates_delete($id) {
        $tbl = 'stylist_availability';
        $venderId = $this->session->userdata('venderId');
        $availability_date = date('Y-m-d');
        $delete = $this->db->delete($tbl, array('id' => $id,'stylist_id' => $venderId,'availability_date>='=>$availability_date));  
        if($delete) { 
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Date Deleted Successfully!!</span>');
            redirect('stylist-zone/available-dates');
        } else {
            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
            redirect('stylist-zone/available-dates');
        }
    }
    
    
    public function capture_video(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            $tbl = 'portfolio_video';
            $venderId = $this->session->userdata('venderId');
            if ($postData) {
                $dates = $postData['dates'];
                
                    $d = array();
                    $d['stylist_id'] = $venderId;
                    $d['availability_datetime'] = date('Y-m-d H:i:s',strtotime($dates));
                    $d['availability_date'] = date('Y-m-d',strtotime($dates));
                    $d['availability_time'] = date('H:i:s',strtotime($dates));
                    $r = $this->db->get_where($tbl,$d)->row();
                    if (!$r) {
                        $d['created_at'] = date('Y-m-d h:i:s');
                        $d['tag_id'] = implode(',',$this->input->post('tag_id'));
                        $this->db->insert($tbl,$d); 
                        $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Date inserted Successfully!!</span>');
                    }else{
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Date already exist.</span>');
                    }
                    redirect('stylist-zone/capture-video');
                 
                
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['portfolio_video'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE vender_id ='.$venderId.' AND videoType ="capture" ORDER BY id DESC')->result();
            $this->load->view('front/vandor/capture-video',$data);
        } else {
            redirect();   
        } 
    }
    public function capture_video_add(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            $tbl = 'portfolio_video';
            $venderId = $this->session->userdata('venderId');
            if ($postData) {
                $dates = $postData['dates'];
                
                    $d = array();
                    $d['stylist_id'] = $venderId;
                    $d['availability_datetime'] = date('Y-m-d H:i:s',strtotime($dates));
                    $d['availability_date'] = date('Y-m-d',strtotime($dates));
                    $d['availability_time'] = date('H:i:s',strtotime($dates));
                    $r = $this->db->get_where($tbl,$d)->row();
                    if (!$r) {
                        $d['created_at'] = date('Y-m-d h:i:s');
                        $d['tag_id'] = implode(',',$this->input->post('tag_id'));

                        $this->db->insert($tbl,$d); 
                        $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Date inserted Successfully!!</span>');
                    }else{
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Date already exist.</span>');
                    }
                    redirect('stylist-zone/capture-video');
                 
                
            }
            $data['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
            
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['portfolio_video'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE vender_id ='.$venderId.' AND videoType ="capture" ORDER BY id DESC')->result();
            $this->load->view('front/vandor/capture-video-add',$data);
        } else {
            redirect();   
        } 
    }
    public function capture_video_delete($id) {
        $tbl = 'portfolio_video';
        $venderId = $this->session->userdata('venderId');
        $delete = $this->db->delete($tbl, array('id' => $id,'vender_id' => $venderId));  
        if($delete) { 
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Video Deleted Successfully!!</span>');
            redirect('stylist-zone/manage-video?tab=record-video');
        } else {
            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
            redirect('stylist-zone/manage-video?tab=record-video');
        }
    }
    public function uploadCaptureVideo(){
        $postData = $this->input->post();
        if($postData['video-filename']){
                $this->selfInvoker();
                //var_dump($postData);
                $fileName = $_POST['video-filename'];
                $data['image']   = $fileName;
                $data['videoType'] = 'capture';
                $data['title'] = $this->input->post('title');
                $data['content'] = $this->input->post('content');
                $data['created_at']   = date('Y-m-d h:i:s');
                $data['vender_id'] = $this->venderId;
                $data['slug'] = url_title($data['title'], 'dash', true);
                $data['tag_id'] = $this->input->post('tag_id');
                $insert = $this->db->insert('portfolio_video',$data);
                $response = array(
                    'status' => 'success',
                    'message' => 'UPLOADED! RECORD MORE',
                );
                $this->session->set_flashdata('message', 'UPLOADED! RECORD MORE');
                //redirect(base_url('stylist-zone/capture-video'));
        }
    }

    public function selfInvoker(){
        if (!isset($_POST['audio-filename']) && !isset($_POST['video-filename'])) {
            echo 'Empty file name.';
            return;
        }

        // do NOT allow empty file names
        if (empty($_POST['audio-filename']) && empty($_POST['video-filename'])) {
            echo 'Empty file name.';
            return;
        }

        // do NOT allow third party audio uploads
        if (false && isset($_POST['audio-filename']) && strrpos($_POST['audio-filename'], "RecordRTC-") !== 0) {
            echo 'File name must start with "RecordRTC-"';
            return;
        }

        // do NOT allow third party video uploads
        if (false && isset($_POST['video-filename']) && strrpos($_POST['video-filename'], "RecordRTC-") !== 0) {
            echo 'File name must start with "RecordRTC-"';
            return;
        }
        
        $fileName = '';
        $tempName = '';
        $file_idx = '';
        
        if (!empty($_FILES['audio-blob'])) {
            $file_idx = 'audio-blob';
            $fileName = $_POST['audio-filename'];
            $tempName = $_FILES[$file_idx]['tmp_name'];
        } else {
            $file_idx = 'video-blob';
            $fileName = $_POST['video-filename'];
            $tempName = $_FILES[$file_idx]['tmp_name'];
        }
        
        if (empty($fileName) || empty($tempName)) {
            if(empty($tempName)) {
                echo 'Invalid temp_name: '.$tempName;
                return;
            }

            echo 'Invalid file name: '.$fileName;
            return;
        }
 

        $filePath111 = 'story/' . $fileName;
        $filePath = 'assets/images/' . $filePath111;
        
        // make sure that one can upload only allowed audio/video files
        $allowed = array(
            'webm',
            'wav',
            'mp4',
            'mkv',
            'mp3',
            'ogg'
        );
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
            echo 'Invalid file extension: '.$extension;
            return;
        }
        
        if (!move_uploaded_file($tempName, $filePath)) {
            if(!empty($_FILES["file"]["error"])) {
                $listOfErrors = array(
                    '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                    '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                    '3' => 'The uploaded file was only partially uploaded.',
                    '4' => 'No file was uploaded.',
                    '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                    '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                    '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
                );
                $error = $_FILES["file"]["error"];

                if(!empty($listOfErrors[$error])) {
                    echo $listOfErrors[$error];
                }
                else {
                    echo 'Not uploaded because of error #'.$_FILES["file"]["error"];
                }
            }
            else {
                echo 'Problem saving file: '.$tempName;
            }
            return;
        }
        
        echo 'success';
    }


    public function explore_detail()

    {   

        //$data['explore'] = $this->Page_Model->fetch_all('explore');

        $this->load->view('front/explore-detail',$data);

    }
    public function leads(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            $tbl = 'portfolio_video';
            $venderId = $this->session->userdata('venderId');
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            
            $table = 'ask-quote';
            $condition = " WHERE allocated_id = '".$venderId."' ";
            if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
                $condition .= ' AND status = '.$_GET['status'];
            }
            $condition .= " order by id DESC";
            $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();
            foreach ($list as $key => $value) {
                
                $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();
                $list[$key]->availability_date = $availRow->availability_date;
                $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));
                $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));

                 


            }
            $data['list'] = $list;
            $this->load->view('front/vandor/leads',$data);
        } else {
            redirect();   
        } 
    }
    public function lead_detail($id){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            if ($postData['client_age_group']) {
                
                $table = 'ask-quote';
                $condition = " WHERE  id = '".base64_decode($id)."'";
                $condition .= " order by id DESC";
                $row = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->row_array();

                $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$row['date_id']))->row();
                $row['availability_date'] = $availRow->availability_date;
                $row['availability_start_time'] = date('h:i A',strtotime($availRow->availability_start_time));
                $row['availability_end_time'] = date('h:i A',strtotime($availRow->availability_end_time));

                $requirment_id = array();
                foreach($postData['requirment'] as $k=>$v){
                    $vv = explode('====', $v);
                    array_push($requirment_id,$vv[0]);
                }
                $u = array();
                $u['requirment_status'] = 1;
                $u['requirment_id'] = implode(',', $requirment_id);
                $u['requirment_total'] = $postData['final_total'];

                $u['client_age'] = $postData['client_age'];
                $u['client_gender'] = $postData['client_gender'];
                $u['client_age_group']=$postData['client_age_group'];
                $u['client_favorite_colour']=$postData['client_favorite_colour'];
                $u['client_body_type']=$postData['client_body_type'];
                $u['client_skin_tone']=$postData['client_skin_tone'];
                $u['client_address_type']=$postData['client_address_type'];
                $u['client_shop_type']=$postData['client_shop_type'];
                $u['client_personality']=$postData['client_personality'];
                $u['client_looking_today']=$postData['client_looking_today'];
                $u['client_take_help']=$postData['client_take_help'];
                $u['client_spend_amount']=$postData['client_spend_amount'];
                $u['client_comment']=$postData['client_comment'];

                $this->uploadPath = 'assets/images/ask-quote/';
                $image = $this->uploadSingleImageOnly('client_picture',$this->uploadPath);
                if(!empty($image)){
                    $u['client_picture'] = $image;
                }
                $this->common_model->commonUpdate('ask-quote',$u,array('id'=>base64_decode($id)));
                //echo $this->db->last-query();die;


                
                 
                $content_part  = '<p>';
                    $content_part .= '<b>Mobile:</b>'.$row['mobile'].'<br/>';
                    $content_part .= '<b>City:</b>'.$row['city'].'<br/>';
                    $content_part .= '<b>Date Time:</b>'.$row['availability_date'].'&nbsp;&nbsp;'.$row['availability_start_time'].'-'.$row['availability_end_time'].'<br/>';
                    $content_part .= '<b>Message:</b>'.$row['message'].'';
                $content_part .= '</p>';
                $content_part .= '<p>If you have any questions or need any additional information, please WhatsApp +91 9898 828 200 or write to us at support@stylebuddy.in</p>';

                
                $mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($row['fname'].' '.$row['lname']).'</h3>';
                    $mailContent .= $content_part;
                $mailContent .= mailHtmlFooter($this->site);
                
                $subject =  $this->site->site_name.' - Lead Confirmation';
                
                $to = $row['email'];
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                //$cc = 'mr.vijaybaghel@gmail.com,vijay@gleamingllp.com,joginder@gleamingllp.com';
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach);
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Quote has been sent Successfully!!</span>');
                redirect('stylist-zone/lead-detail/'.$id);   

            }
            $venderId = $this->session->userdata('venderId');
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            
            $table = 'ask-quote';
            $condition = " WHERE allocated_id = '".$venderId."' AND id = '".base64_decode($id)."'";
            if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
                $condition .= ' AND status = '.$_GET['status'];
            }
            $condition .= " order by id DESC";
            $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();
            foreach ($list as $key => $value) {
                $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();
                $list[$key]->availability_date = $availRow->availability_date;
                $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));
                $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));
            }
            $data['list'] = $list;

            $list  =  $this->common_model->get_all_details('requirment',array('status'=>1))->result();
            $data['requirment'] = $list;
            $this->load->view('front/vandor/lead-detail',$data);
        } else {
            redirect();   
        } 
    }

    public function leads_status(){
        if($this->session->userdata('userType') == 2  ) {
            $venderId = $this->session->userdata('venderId');

             $id = $this->input->post('id');
            $status = $this->input->post('status');
            $update = $this->db->where('id',$id)->update('ask-quote',['status'=> $status]);
            echo $update;die;
        } else {
            redirect();   
        } 
    }

    public function boutiques(){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
            $tbl = 'vender';
            $venderId = $this->session->userdata('venderId');
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['list'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE parent_id ='.$venderId.' and user_type = 4 ORDER BY id DESC')->result();
            $this->load->view('front/vandor/boutiques',$data);
        } else {
            redirect();   
        } 
    }
    public function boutiques_add($id=''){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
             
            $venderId = $this->session->userdata('venderId');
            if ($postData) {
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }

                $data['designation'] = $this->input->post('designation');
                
                $data['country'] = $country = $this->input->post('country');
                $data['state'] = $state = $this->input->post('state');
                $data['city'] = $city = $this->input->post('city');
                
                $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
    
                $data['country_name'] = $countryRow->name;
                $data['state_name'] = $statesRow->name;
                $data['city_name'] = $cityRow->name;
                
                $data['password'] = md5($this->input->post('password'));
                $data['experience'] = $this->input->post('experience');
                $data['fname'] = $this->input->post('fname');
                $data['email'] = $this->input->post('email');
                $data['lname'] = $this->input->post('lname');
                $data['gender'] = $this->input->post('gender');
                $data['mobile'] = $this->input->post('mobile');
                $data['dob'] = $this->input->post('dob');
                $data['address'] = $this->input->post('address');
                $data['pin'] = $this->input->post('pin');
                $data['about'] = $this->input->post('about');
                $data['more_about'] = $this->input->post('more_about');
                $data['linkedin_link'] = $this->input->post('linkedin_link');
                $data['behance_link'] = $this->input->post('behance_link');
                $data['facebook_link'] = $this->input->post('facebook_link');
                $data['twitter_link'] = $this->input->post('twitter_link');
                $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                //$data['expertise'] = implode(',',$this->input->post('expertise'));
                
               // $data['project_deliverd'] = $this->input->post('project_deliverd');
                $data['user_type'] = 4;
                $data['parent_id'] = $this->venderId;
                $data['created_at'] = date('Y-m-d h:i:s');


                $table = 'vender'; 
                $where = ['id'=> $this->venderId ];
                $update = $this->common_model->simple_insert($table,$data);
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Boutique inserted Successfully!!</span>');
                redirect('vendor/boutiques');
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            if ($id) {
                $data['rowArray'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE id ='.$id.' and parent_id ='.$venderId.' and user_type = 4 ORDER BY id DESC')->row();
            }else{
                $data['rowArray'] = array();
            }
            $data['title']='Boutiques Add';
            $data['country'] = $this->db->get('countries')->result();
            $data['states'] = $this->db->get('states')->result();
            
            $this->load->view('front/vandor/boutiques-add',$data);
        } else {
            redirect();   
        } 
    }
    public function boutiques_edit($id=''){
        if($this->session->userdata('userType') == 2  ) {
            $postData = $this->input->post();
             
            $venderId = $this->session->userdata('venderId');
            if ($postData) {
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }

                $data['designation'] = $this->input->post('designation');
                
                $data['country'] = $country = $this->input->post('country');
                $data['state'] = $state = $this->input->post('state');
                $data['city'] = $city = $this->input->post('city');
                
                $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
    
                $data['country_name'] = $countryRow->name;
                $data['state_name'] = $statesRow->name;
                $data['city_name'] = $cityRow->name;
                if (!empty($this->input->post('password'))) {
                    $data['password'] = md5($this->input->post('password'));
                }
                
                $data['experience'] = $this->input->post('experience');
                $data['fname'] = $this->input->post('fname');
                //$data['email'] = $this->input->post('email');
                $data['lname'] = $this->input->post('lname');
                $data['gender'] = $this->input->post('gender');
                $data['mobile'] = $this->input->post('mobile');
                $data['dob'] = $this->input->post('dob');
                $data['address'] = $this->input->post('address');
                $data['pin'] = $this->input->post('pin');
                $data['about'] = $this->input->post('about');
                $data['more_about'] = $this->input->post('more_about');
                $data['linkedin_link'] = $this->input->post('linkedin_link');
                $data['behance_link'] = $this->input->post('behance_link');
                $data['facebook_link'] = $this->input->post('facebook_link');
                $data['twitter_link'] = $this->input->post('twitter_link');
                $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                //$data['expertise'] = implode(',',$this->input->post('expertise'));
                
                //$data['project_deliverd'] = $this->input->post('project_deliverd');
                $data['user_type'] = 4;
                $data['parent_id'] = $this->venderId;
                $data['created_at'] = date('Y-m-d h:i:s');


                $table = 'vender'; 
                $where = ['id'=> $id ];
                $update = $this->common_model->commonUpdate($table,$data,$where);
                $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Boutique updated Successfully!!</span>');
                redirect('vendor/boutiques');
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            if ($id) {
                $data['rowArray'] = $this->db->query('SELECT * FROM vender WHERE id ='.$id.' and parent_id ='.$venderId.' and user_type = 4 ORDER BY id DESC')->row();
            }else{
                $data['rowArray'] = array();
            }
            $data['country'] = $this->db->get('countries')->result();
            $data['states'] = $this->db->get('states')->result();
            $data['title']='Boutiques Edit';
            $this->load->view('front/vandor/boutiques-add',$data);
        } else {
            redirect();   
        } 
    }
    public function boutiquesStatusUpdate(){
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['status'=>$status];
        $update = $this->db->update('vender',$data,array('id'=>$id));
        echo $update;   
    }
    
    
    
    public function addaservices(){  
        $url1  =$this->uri->segment(1);
        $url2  =$this->uri->segment(2);

        if($this->session->userdata('userType') == 2  ) {
            
            if($this->input->post('hiddenValue')){
                $services_id = $this->input->post('hiddenValue');
                $vendor_id = $this->venderId;

                $condition = " WHERE vendor_id = '". $vendor_id ."' AND services_id = '".$services_id."'";
                $r = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
                //echo $this->db->last_query();
                if ($r) {
                    $wh = array();
                    $wh['services_id'] = $services_id;
                    $wh['vendor_id'] = $vendor_id;

                    $r['package_price_1']      = trim($this->input->post('package_price_1'));
                    $r['package_price_2']      = trim($this->input->post('package_price_2'));
                    $r['package_price_3']      = trim($this->input->post('package_price_3'));
                    $updateTrue = $this->common_model->commonUpdate('services_vendor',$r,$wh);
                    $msg = 'Services updated successfully!';
                }else{
                    $condition = " WHERE id = '".$services_id."'";
                    $r = $this->common_model->get_all_details_query('services',$condition)->row_array();

                    unset($r['created_at']);
                    unset($r['updated_at']);
                    unset($r['id']);
                    $r['services_id'] = $services_id;
                    $r['vendor_id'] = $vendor_id;
                    $r['created_at']  = date("Y-m-d h:i:s");
                    $r['package_price_1']      = trim($this->input->post('package_price_1'));
                    $r['package_price_2']      = trim($this->input->post('package_price_2'));
                    $r['package_price_3']      = trim($this->input->post('package_price_3'));
                    $r['admin_status']      = 1;
                    $updateTrue                 = $this->common_model->simple_insert('services_vendor',$r);
                    $msg = 'Services added successfully!';
                }
                $this->session->set_flashdata('service_msg',$msg);
                redirect(base_url($url1.'/'.$url2));
            }else if($this->input->post('hiddenValue_')){
                $services_id = $this->input->post('hiddenValue_');
                $vendor_id = $this->venderId;

                $condition = " WHERE vendor_id = '". $vendor_id ."' AND id = '".$services_id."'";
                $r = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
                if ($r) {
                    
                    $insert_data= array();
                    //$insert_data['package_feature']    = trim($this->input->post('package_feature'));
                    $insert_data['area_expertise_name']    = trim($this->input->post('area_expertise_name'));
                    
                    $insert_data['package_title_1']      = trim($this->input->post('package_title_1'));
                    $insert_data['package_description_1']      = trim($this->input->post('package_description_1'));
                    $insert_data['package_name_1']      = trim($this->input->post('package_name_1'));
                    $insert_data['package_price_1']      = trim($this->input->post('package_price_1'));
                    
                    $insert_data['package_title_2']      = trim($this->input->post('package_title_2'));
                    $insert_data['package_description_2']      = trim($this->input->post('package_description_2'));
                    $insert_data['package_name_2']      = trim($this->input->post('package_name_2'));
                    $insert_data['package_price_2']      = trim($this->input->post('package_price_2'));
                    
                    $insert_data['package_title_3']      = trim($this->input->post('package_title_3'));
                    $insert_data['package_description_3']      = trim($this->input->post('package_description_3'));
                    $insert_data['package_name_3']      = trim($this->input->post('package_name_3'));
                    $insert_data['package_price_3']      = trim($this->input->post('package_price_3'));
                    
                    $wh = array();
                    $wh['id'] = $services_id;
                    $wh['vendor_id'] = $vendor_id;
                    $updateTrue = $this->common_model->commonUpdate('services_vendor',$insert_data,$wh);

                    $wh = array();
                    $wh['services_id'] = $services_id;
                    $wh['admin_status'] = 0;
                    $this->common_model->commonDelete('services_feature',$wh);

                    $f1    = $this->input->post('first_col');
                    $c1    = $this->input->post('second_col');
                    $p1    = $this->input->post('third_col');
                    $L1    = $this->input->post('fourth_col');
                    
                    $array = array();
                    for ($i=0; $i < count($f1) ; $i++) { 
                        $a = array();
                        $a['services_id'] = $services_id;
                        $a['feature'] = $f1[$i];
                        $a['classic'] = $c1[$i];
                        $a['premium'] = $p1[$i];
                        $a['luxury'] = $L1[$i];
                        $a['admin_status'] = 0;
                        array_push($array,$a);
                        $this->common_model->simple_insert('services_feature',$a);
                    }

                    $msg = 'Services updated successfully!';
                }
                $this->session->set_flashdata('service_msg',$msg);
                redirect(base_url($url1.'/'.$url2));
            }else{

            }
            
            $condition = " WHERE id != '0'  order by id DESC";
            $list = $this->common_model->get_all_details_query('services',$condition)->result_array();
            
            foreach ($list as $key => $value) {
                $services_id = $value['id'];
                $vendor_id = $this->venderId;
                $condition = " WHERE vendor_id = '". $vendor_id ."' AND services_id = '".$services_id."'";
                $r = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
                $list[$key]['deleted_id']      = $r['id']; 
                $list[$key]['deleted_status']      = $r['deleted_status']; 

                if ($r) {
                    unset($list[$key]['package_price_1'] );
                    unset($list[$key]['package_price_2'] );
                    unset($list[$key]['package_price_3'] );

                    $list[$key]['package_price_1']      = trim($r['package_price_1']);
                    $list[$key]['package_price_2']      = trim($r['package_price_2']);
                    $list[$key]['package_price_3']      = trim($r['package_price_3']);
                    
                    if ($r['deleted_status']) {
                       $list[$key]['flag']      = 0; 
                    }else{
                        $list[$key]['flag']      = 1; 
                    }
                }else{
                    $list[$key]['flag']      = 0; 
                }
               

                $condition = " WHERE services_id = '". $value['id'] ."' and admin_status = 1 order by id asc";
                $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();
                $list[$key]['package_featureArray']      = $rows; 
            }
            $data['services_list'] = $list;
            
            
            $vendor_id = $this->venderId;
            $condition = " WHERE vendor_id = '". $vendor_id ."' AND services_id = '0'";
            $list = $this->common_model->get_all_details_query('services_vendor',$condition)->result_array();
            foreach ($list as $key => $value) {
                    if ($value['deleted_status']) {
                       $list[$key]['flag']      = 0; 
                    }else{
                        $list[$key]['flag']      = 1; 
                    }

                $condition = " WHERE services_id = '". $value['id'] ."' and admin_status = 0 order by id asc";
                $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();
                $list[$key]['package_featureArray']      = $rows; 
            }
            $data['services_list_own'] = $list;

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/add-a-services',$data);
        } else {
            redirect();   
        } 
    }


    public function editmyservices(){  
        if($this->session->userdata('userType') == 2  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/vandor/edit-my-services',$data);
        } else {
            redirect();   
        } 
    }
    public function deleteOwnService(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->update('services_vendor',array('deleted_status'=>$status),array('id'=>$id));
        if($update) { 
            $this->session->set_flashdata('success','<span class="text-white pink_c p-2">Service Delete Successfully!!</span>');
            redirect('vendor/addaservices');
        } else {
            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
            redirect('vendor/addaservices');
        }
    }
    public function addownservice(){
        $data = array();
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = 'services_vendor';
        $postData = $this->input->post();
        
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = 'Service';
        
        if (!empty($postData)) {            
            $this->form_validation->set_rules('area_expertise_name', 'area_expertise_name', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                
                $insert_data['vendor_id']    = trim($this->venderId);
                $insert_data['area_expertise_name']    = trim($this->input->post('area_expertise_name'));
                
                
                $insert_data['package_title_1']      = trim($this->input->post('package_title_1'));
                $insert_data['package_description_1']      = trim($this->input->post('package_description_1'));
                $insert_data['package_name_1']      = trim($this->input->post('package_name_1'));
                $insert_data['package_price_1']      = trim($this->input->post('package_price_1'));
                
                $insert_data['package_title_2']      = trim($this->input->post('package_title_2'));
                $insert_data['package_description_2']      = trim($this->input->post('package_description_2'));
                $insert_data['package_name_2']      = trim($this->input->post('package_name_2'));
                $insert_data['package_price_2']      = trim($this->input->post('package_price_2'));
                
                $insert_data['package_title_3']      = trim($this->input->post('package_title_3'));
                $insert_data['package_description_3']      = trim($this->input->post('package_description_3'));
                $insert_data['package_name_3']      = trim($this->input->post('package_name_3'));
                $insert_data['package_price_3']      = trim($this->input->post('package_price_3'));
                
                $insert_data['created_at']  = date("Y-m-d h:i:s");
                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);
                //echo $this->db->last_query();
                if($updateTrue){
                    /*$f1    = $this->input->post('first_col');
                    $c1    = $this->input->post('second_col');
                    $p1    = $this->input->post('third_col');
                    $L1    = $this->input->post('fourth_col');

                    $array = array();
                    for ($i=0; $i < count($f1) ; $i++) { 
                        $a = array();
                        $a['services_id'] = $updateTrue;
                        $a['feature'] = $f1[$i];
                        $a['classic'] = $c1[$i];
                        $a['premium'] = $p1[$i];
                        $a['luxury'] = $L1[$i];
                        $a['admin_status'] = 0;
                        array_push($array,$a);
                        $this->common_model->simple_insert('services_feature',$a);
                    }*/
                    $this->session->set_flashdata('success','Data has been successfully created');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        $this->load->view('front/vandor/add-own-service',$data);
    }
    public function vendorRegistrationRes(){

        if(!empty($this->input->post('fname'))){
             //var_dump($this->input->post());
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_rules('lname','Last Name','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[vender.email]');
            $this->form_validation->set_rules('password','Password','required|trim|');
            $this->form_validation->set_rules('cpassword','Confirm Password','required|matches[password]');
            $this->form_validation->set_rules('gender','Gender','required|trim');
            $this->form_validation->set_rules('mobile','Mobile','required|trim');
            $this->form_validation->set_rules('state','State','required|trim');
            $this->form_validation->set_rules('city','City','required|trim');
            $this->form_validation->set_rules('experience','Experience','required|trim');
            $this->form_validation->set_rules('address','Address','required|trim');
            $this->form_validation->set_rules('pin','PineCode','required|trim');
            $this->form_validation->set_rules('instagram_nlink','Instagram Link','required|trim');
            $this->form_validation->set_rules('about','About','required|trim');
            $this->form_validation->set_rules('more_about','More About','required|trim');
            //$this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another'); 
            $this->form_validation->set_error_delimiters('<span class="text-primary mt-1">','</span>');
            if( $this->form_validation->run() == false) {
                echo 'erroe';  
            }  else {
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }

                $data['user_type'] = 2;
                //$data['status'] = 0;
                $data['fname'] = $this->input->post('fname');
                $data['email'] = $this->input->post('email');
                $data['lname'] = $this->input->post('lname');
                $data['password'] = md5($this->input->post('password'));
                $data['gender'] = $this->input->post('gender');
                $data['mobile'] = $this->input->post('mobile');
                $data['dob'] = $this->input->post('dob');
                $data['address'] = $this->input->post('address');
                $data['pin'] = $this->input->post('pin');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['experience'] = $this->input->post('experience');
                $data['about'] = $this->input->post('about');
                $data['more_about'] = $this->input->post('more_about');
                $data['facebook_link'] = $this->input->post('facebook_link');
                $data['twitter_link'] = $this->input->post('twitter_link');
                $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                if(!empty($this->input->post('expertise'))) { 
                    $data['expertise'] = implode(',',$this->input->post('expertise')); 
                }
                $data['created_at']  = date('Y-m-d h:i:s');  
                /*if(!empty($data['expertise'])) {
                    $values = ""; $arrayVal = explode(',',$data['expertise']);        
                    $expertises =  $this->db->get_where('area_expertise',['status'=>1])->result();
                    foreach ($expertises as $expertise) { 
                        if( in_array($expertise->id , $arrayVal)) {  $values .= ", $expertise->name"; }
                    }
                    $stylist = substr($values,1);    
                }*/
                
                $insert = $this->db->insert('vender',$data);
                $insert_id = $this->db->insert_id(); 
                 
                if($insert_id) {

                    $insertIdeasAll = array();
                    $titleArray = $this->input->post('title');
                    $contentArray = $this->input->post('content');
                    $tag_idArray = $this->input->post('tag_id');
                    for ($i=0; $i < count($titleArray); $i++) { 
                        $insertIdeas = array();
                        $insertIdeas['title'] = $titleArray[$i];
                        $insertIdeas['content'] = $contentArray[$i];
                        $insertIdeas['tag_id'] = $tag_idArray[$i];
                        $insertIdeas['vender_id'] =  $insert_id;
                        $insertIdeas['created_at'] = date("Y-m-d H:i:s");
                        $insertIdeas['slug'] = url_title($titleArray[$i], 'dash', true);


                        $path = $this->uploadPath = 'assets/images/story/';

                        $filename = 'gallery_image';
                        $cpt = count($_FILES[$filename]);
                        $ImageName = '';
                        $timeImg = '';
                        if(!empty($_FILES[$filename]['name'][$i])){
                            $tempFile = $_FILES[$filename]['tmp_name'][$i];
                            //$temp = $_FILES[$filename]['name'][$i];
                            $temp = strtolower(basename($_FILES[$filename]["name"][$i]));
                            $path_parts = pathinfo($temp);
                            $t =  time();
                            $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
                            $targetFile = $path . $fileName_ ;
                            move_uploaded_file($tempFile, $targetFile);
                            //$p = str_replace('uploads/','',$path);
                            //$ImageName .= $p.$fileName_;

                            $insertIdeas['image']=  trim($fileName_);
                        }
                        $insertIdeasAll[]=$insertIdeas;
                    }
                    $batch_insert = $this->db->insert_batch('ideas',$insertIdeasAll);
                    //echo $this->db->last_query();
                }
                $mailForm = $data['email']; $fullName = $data['fname'].' '.$data['lname'];
                $this->mail->setFrom($mailForm,$fullName);
                $this->mail->addAddress($this->mail->Username,$this->site->site_name);
                $this->mail->addAddress($this->site->support_email,$this->site->site_name);
                
                if(!empty($data['cv'])) {
                    $this->mail->addAttachment($config['upload_path'].$data['cv']);
                }
                $this->mail->Subject = "Stylist Registration Form Details";     
                
                $mailContent = ' ';
                $mailContent .= '<h3>Stylist Registration Details</h3>'; 
                $mailContent .= '<br><br><br>';
                $mailContent .= '<p><b>Name : </b>'.$fullName.'</p>';
                $mailContent .= '<p><b>Email Id :</b>'. $data['email'].'</p>';
                
                ($data['mobile'])?$mailContent .= '<p><b>Mobile :</b>'. $data['mobile'].'</p>':''; 
                ($data['mobile'])?$mailContent .= '<p><b>Mobile :</b>'. $data['mobile'].'</p>':'';
                ($data['gender'] == 1)?$mailContent .= '<p><b>Gender :</b>Male</p>':'<p><b>Gender :</b>Femail</p>';
                ($data['dob'])?$mailContent .= '<p><b>Date of Birth :</b>'. $data['dob'].'</p>':'';
                ($data['address'])?$mailContent .= '<p><b>Address :</b>'. $data['address'].'</p>':'';
                ($data['pin'])?$mailContent .= '<p><b>Zip Code :</b>'. $data['pin'].'</p>':'';
                ($data['about'])?$mailContent .= '<p><b>About :</b>'. $data['about'].'</p>':'';
                ($data['facebook_link'])?$mailContent .= '<p><b>Facebook Link :</b>'. $data['facebook_link'].'</p>':'';
                ($data['twitter_link'])?$mailContent .= '<p><b>Twitter Link :</b>'. $data['twitter_link'].'</p>':'';
                ($data['instagram_nlink'])?$mailContent .= '<p><b>Instagram Link :</b>'. $data['instagram_nlink'].'</p>':'';
                ($data['portfolio_rlink'])?$mailContent .= '<p><b>Portfolio Link :</b>'. $data['portfolio_rlink'].'</p>':'';
                //($stylist)?$mailContent .= '<p><b>Stylist Expertise :</b>'. $stylist.'</p>':'';
                
                $mailContent .= '<br><br>';
                $mailContent .= '<p><b>Regards</b></p>';
                $mailContent .= '<p>'.$fullName.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';
                
                $this->mail->Body = $mailContent;
                $admin =  $this->mail->send();
                
                /* Send email to   user */
                $to      =  $data['email'];
                $form =  $this->site->support_email;
                //$form = $this->mail->Username;
                $subject =  'Thanks Message';
                
                $mailContent = ' 
                            <p><b>Dear  </b>'.$data['fname'].' '.$data['lname'].'</p>
                            <p>Welcome to Style Buddy. We hope that you will enjoy the journey.</p>
                            <p>Thank you for registering. Please log in and complete your portfolio from your personalized dashboard <a href="https://stylistjobs.org/login">Login<a></p>
                            <p>If you have any questions or need any additional information, please WhatsApp +91 9898 828 200 or write to us at support@stylebuddy.in</p>
                            <br><br>
                            <p><b>Regards</b></p>
                            <p>'.$this->site->site_name.'</p>
                            <p><b>CONTACT INFO</b></p>
                            <p>'.$this->site->mobile.'</p>
                            <p>Email: '.$this->site->email.'</p>
                            <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">
                          ';
                $headers =  "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .=  "From: Stylebuddy <$form>"  . "\r\n";
                $headers .=  "Reply-To: $form"  . "\r\n";
                mail($to, $subject, $mailContent, $headers);
                $this->session->set_flashdata('success','<span>Registration Successfull. Please Login</span>');
                redirect('registration');
                //die;
            }
        }
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        $style['states'] = $this->db->get('states')->result();
        $style['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
        $this->load->view('front/style-registration',$style);
    }
    
    
    public function addjob() {
        $this->checkUserLogin();
        $this->checkUserType(); 
        $condition = " where user_id = '".$this->venderId."' order by id DESC";
        $subscription_booking = $this->common_model->get_all_details_query('subscription_booking',$condition)->row();


        if ($subscription_booking){
            $result['subscription_booking'] = $subscription_booking;  
            if ($subscription_booking->end_date >= date('Y-m-d')) {
                $total_job_limit = $subscription_booking->total_job;
                $condition = " where job_admin_id = '".$this->venderId."' AND DATE(created_at) <= '".$subscription_booking->end_date."' AND DATE(created_at) >= '".$subscription_booking->start_date."' order by id DESC";
                $query = $this->common_model->get_all_details_query('jobs',$condition);

                $total_job = $query->num_rows();
                $result['total_jobs'] = $list = $query->result();
            }else{
                $condition = " where id = '1' order by id DESC";
                $subscription_plan = $this->common_model->get_all_details_query('subscription_plan',$condition)->row();
                $total_job_limit = $subscription_plan->total_job;

                $condition = " where job_admin_id = '".$this->venderId."'  AND DATE(created_at) >= '".$subscription_booking->end_date."' order by id DESC";
                $list = $this->common_model->get_all_details_query('jobs',$condition);
                $total_job = $list->num_rows();
                $result['total_jobs'] = $list->result();
            }
        }else{
            $condition = " where id = '1' order by id DESC";
            $subscription_plan = $this->common_model->get_all_details_query('subscription_plan',$condition)->row();
            

            $total_job_limit = $subscription_plan->total_job;

            $condition = " where job_admin_id = '".$this->venderId."' order by id DESC";
            $list = $this->common_model->get_all_details_query('jobs',$condition);
            $total_job = $list->num_rows();
            $result['total_jobs'] = $list->result();
            /*echo $this->db->last_query();
            die;*/
        }

        


        if ($total_job_limit > $total_job) {
            $postData = $this->input->post();
            
            if ($postData['experience']) {
                 
                $this->form_validation->set_rules('experience','experience','required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
                
                if( $this->form_validation->run() == false) {
                }  else {
                    $this->uploadPath = 'assets/images/vandor/';
                    $image = $this->uploadSingleImageOnly('company_logo',$this->uploadPath);
                    if(!empty($image)){
                        $data['company_logo'] = $image;
                    }
                    $data['email'] = $this->input->post('email');
                    $data['mobile'] = $this->input->post('mobile');
                    $data['job_title'] = $this->input->post('job_title');
                    $data['city'] = $this->input->post('city');
                    $data['package'] = $this->input->post('package');
                    $data['job_frequency'] = $this->input->post('job_frequency');
                    $data['experience'] = $this->input->post('experience');
                    $data['job_type'] = $this->input->post('job_type');
                    $data['job_location'] = $this->input->post('job_location');
                    $data['department'] = $this->input->post('department');
                    $data['qualification'] = $this->input->post('qualification');
                    $data['company'] = $this->input->post('company');
                    $data['job_description'] = $this->input->post('job_description');
                    $data['job_admin_id'] = $this->venderId;
                    $data['created_at'] = date('Y-m-d h:i:s');

                     
                    $table = 'jobs'; 
                    $update = $this->common_model->simple_insert($table,$data); 
                    if($update) {
                        $data1['slug'] =  url_title($data['job_title'], 'dash', true).'-'.url_title($data['company'], 'dash', true).'-'.$update;
                        $where = ['job_admin_id'=> $this->venderId,'id'=>$update ];
                        $update = $this->common_model->commonUpdate($table,$data1,$where); 
                        $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your job is added successfully</span>');
                        redirect('vendor/managejobs');
                    } else {
                        $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
                         
                    }
                }
            }
        }else{
            $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your subscription limit is over</span>');
            redirect('postjob/managejobs');
        }
        $data['jobs'] = array(); 
        $result['datas'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $result['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $result['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $this->load->view('front/vandor/jobpostform',$result);
    }
    public function editjob() {
        $this->checkUserLogin();
        $this->checkUserType(); 
        $job_id = $this->uri->segment(3);
        $postData = $this->input->post();
        if ($postData['experience']) {
            $this->form_validation->set_rules('experience','experience','required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
            
            if( $this->form_validation->run() == false) {
            }  else {
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('company_logo',$this->uploadPath);
                if(!empty($image)){
                    $data['company_logo'] = $image;
                }
                $data['email'] = $this->input->post('email');
                $data['mobile'] = $this->input->post('mobile');
                $data['city'] = $this->input->post('city');
                $data['package'] = $this->input->post('package');
                $data['job_frequency'] = $this->input->post('job_frequency');
                $data['job_title'] = $this->input->post('job_title');
                $data['experience'] = $this->input->post('experience');
                $data['job_type'] = $this->input->post('job_type');
                $data['job_location'] = $this->input->post('job_location');
                $data['department'] = $this->input->post('department');
                $data['qualification'] = $this->input->post('qualification');
                $data['company'] = $this->input->post('company');
                $data['job_description'] = $this->input->post('job_description');
                $data['job_admin_id'] = $this->venderId;
                 
                 
                $table = 'jobs'; 
                $where = ['job_admin_id'=> $this->venderId,'id'=>$job_id ];
                $update = $this->Page_Model->common_update($data,$where,$table); 
                if($update) {
                    $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your job is updated successfully</span>');
                    redirect('vendor/managejobs');
                } else {
                    $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
                     
                }
            }
        }
        $data['jobs'] = $this->db->get_where('jobs',['id'=> $job_id ])->row();   
        $data['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/vandor/jobpostform',$data);
    }
    public function deletejob() {
        $this->checkUserLogin();
        $this->checkUserType(); 
        $job_id = $this->uri->segment(3);
        $postData = $this->input->post();
        
        $table = 'jobs'; 
        $where = ['job_admin_id'=> $this->venderId,'id'=>$job_id ];
        $update = $this->common_model->commonDelete($table,$where); 
        if($update) {
            $this->session->set_flashdata('success','<span class="pink_c text-white p-2">Your job deleted successfully</span>');
            
        } else {
            $this->session->set_flashdata('error','<span class="pink_c text-white p-2">Something Went Wrong, try again!!</span>');
             
        }
        redirect('vendor/managejobs');
    }
    
    public function managejobs() {
        $this->checkUserLogin();
        $this->checkUserType(); 
        $data['datas'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['states'] = $this->db->get('states')->result();
        $data['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $data['jobs'] = $this->db->get_where('jobs',['job_admin_id'=> $this->venderId ])->result();   
        $this->load->view('front/vandor/jobs',$data);
    }
    
}    
