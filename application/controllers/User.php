<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    
    function __construct()
	{
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        $this->logged_in();
        $this->userID = $this->session->userdata('userId');
        //$this->userID = $this->session->userdata('userType');
        $this->load->model('common_model');
        /*if($this->session->userdata('site_lang')){
            $language = $this->session->userdata('site_lang');
            if($this->session->userdata('site_lang') == 'en' || $this->session->userdata('site_lang') == 'english'){
            }else{
                redirect(base_url().'/'.$language);   
            }
        } */
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
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();

        $this->load->view('front/user/service_report',$data);
         
    }
    public function giftorder(){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->userID){
            $table = 'giftcard_booking';
            $condition = " where user_id =".$this->userID." order by id DESC";

            $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
            $data['list'] = $list;
            $data['title'] = 'Gift Card Booking';
            $data['list_heading'] = 'Gift Card Booking';
            $data['right_heading'] = 'Add';

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $this->load->view('front/user/gift_order',$data); 
        }else{
             redirect(base_url()); 
        }
    }
    public function giftorderview($id){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->userID){
            $data['order'] = $order = $this->db->get_where('giftcard_booking',['id'=> $id,'user_id'=> $this->userID])->row_array();
            $option = '<div class="summery_order">';
                $option = '<div class="row align-items-center">
                                <div class="col-sm-12">
                                    <p class="odds">
                                        <b>Order ID : '.$order['order_id'].' | </b>
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
                                <td style="border: 1px solid #333;"> <b>Gift Code : </b></td>
                                <td style="border: 1px solid #333;"> <b>'. ($order['gift_code']) .'</b></td>
                            </tr>';
                            $option .= '<tr style="border: 1px solid #333;">
                                <td style="border: 1px solid #333;"> <b>Gift Code Price : </b></td>
                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['total_price']) .'</b></td>
                            </tr>';
                            if ($order['is_used']) {
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333;" class="text-left"><b>Used Status : </b></td>
                                    <td style="border: 1px solid #333;" class="text-left">Used</td>
                                </tr>';
                            } else{
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333;" class="text-left"><b>Used Status : </b></td>
                                    <td style="border: 1px solid #333;" class="text-left">Unused</td>
                                </tr>'; 
                            }
                            

                $option .= '</table>';
                 
            $option .= '</div>';
            

            $data['result']  = $option;
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $this->load->view('front/user/gift_order_view',$data);
        }else{
             redirect(base_url()); 
        }
    }
    public function consultorder(){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->userID){
            $table = 'consult_order';
            $condition = " where user_id =".$this->userID." order by id DESC";

            $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();
            $data['list'] = $list;
            $data['title'] = 'Fashion Expert Consultation';
            $data['list_heading'] = 'Fashion Expert Consultation';
            $data['right_heading'] = 'Add';

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $this->load->view('front/user/consult_order',$data); 
        }else{
             redirect(base_url()); 
        }
        
    }
    public function consultorderview($id){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        if($this->userID){
            $data['order'] = $order = $this->db->get_where('consult_order',['id'=> $id,'user_id'=> $this->userID])->row_array();
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
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $this->load->view('front/user/consult_order_view',$data);
        }else{
             redirect(base_url()); 
        }
    }
    private function logged_in()
	{
        if (!$this->session->userdata('userType') == 3) {
            redirect('login');
        }
    }
    public function consultationorder(){
        if (!$this->session->userdata('userType') == 3) {
            redirect('login');
        }
        $r = $this->db->query('SELECT * FROM vender where id='.$this->userID)->row();
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
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
           
        $this->load->view('front/user/consultationorder',$data);
        
    }
    public function myserviceorder(){
         
        $table = 'user_order_details';
        $condition = " WHERE user_id = '".$this->userID."' ";
        $condition .= " AND cart_type = 'service'";
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
        $this->load->view('front/user/my_service_order',$data);
    }
    public function myserviceorderdetail($id){ 
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = 'user_order_details';

        $str = " WHERE id = ".$id." AND cart_type = 'service' ORDER BY id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,$str);
        $row =  $query->row();
        $str = " WHERE id = ".$this->userID." ";
        $query   =  $this->common_model->get_all_details_query('vender',$str);
        $row1 =  $query->row();
        $row->user_row = $row1;
        $str = " WHERE  order_detail_id = ".$id."  ORDER BY id desc";
        $query   =  $this->common_model->get_all_details_query('package_report_pdf',$str);
        $row1 =  $query->result();
        $row->package_report_pdf = $row1;
        
        $data['order'] = $row;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['datas'] = $this->db->get_where('vender',['id'=> $this->userID] )->row();

        $this->load->view('front/user/my_service_order_details',$data);
         
    }
    public function myshoporder(){
        $table = 'user_order_details';
        $condition = " WHERE user_id = '".$this->userID."' ";
        $condition .= " AND cart_type != 'service'";
        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result();
       
        $data['list'] = $list;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
        $this->load->view('front/user/my_shop_order',$data);
    }
    public function myshoporderdetail($id){ 
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = 'user_order_details';

        $str = " WHERE id = ".$id." AND cart_type != 'service' ORDER BY id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,$str);
        $row =  $query->row();


        $str = " WHERE user_id = '".$this->userID."' AND id = '".$row->orderId."'";
        $query   =  $this->common_model->get_all_details_query('user_order',$str);
        $row1 =  $query->row();
        $row->order_row = $row1;
         
        
        $data['order'] = $row;
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['datas'] = $this->db->get_where('vender',['id'=> $this->userID] )->row();

        $this->load->view('front/user/my_shop_order_details',$data);
         
    }
    public function myserviceorder_old(){
         
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
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
        $this->load->view('front/user/my_service_order',$data);
         

    }
    public function myserviceorderdetail_old($id){ 
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
                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');
                    redirect(base_url($url1.'/'.$url2.'/details/'.$id));
                }
                
            }else{
                $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');
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
        $this->load->view('front/user/my_service_order_details',$data);
         
    }
    
    public function userDashboard(){   
        $datas = $this->db->get_where('vender',['id' => $this->userID ])->row(); 
        $data['datas'] = $datas; 
        $data['profile'] = $datas; 
        
	    $this->load->view('front/user/index',$data);
	}
    public function profile(){   
        $postData = $this->input->post();
        if ($postData) {
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_rules('lname','Last Name','required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
            
            if( $this->form_validation->run() == false) {
                redirect('user/user-profile'); 
            }  else {
                $postData = $this->input->post();
                $check_content_sightengine = array();
                $check_content_sightengine['fname'] = $postData['fname'];;
                $check_content_sightengine['lname'] = $postData['lname'];;
                $check_content_sightengine['email'] = $postData['email'];;
                $check_content_sightengine['address'] = $postData['address'];;
                $check_content_sightengine['company'] = $postData['company'];;
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate content.</span>'); 
                    //redirect('user/user-profile');
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
                        $c_c_s['image2'] = base_url($this->uploadPath.$image);
                    }
                    $dd = check_image_sightengine($c_c_s);
                    if ($dd) {
                        $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your request could not be submitted because you enter inappropriate image.</span>'); 
                    }else{  
                     
                        $data['fname'] = $this->input->post('fname');
                        $data['lname'] = $this->input->post('lname');
                        $data['mobile'] = $this->input->post('mobile');
                        $data['address'] = $this->input->post('address');
                        //$data['country'] = $this->input->post('country');
                       
                        $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');

                        $data['country'] = $country = $this->input->post('country');
                        $data['state'] = $state = $this->input->post('state');
                        $data['city'] = $city = $this->input->post('city');
                        
                        $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                        $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                        $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();

                        $data['country_name'] = $countryRow->name;
                        $data['state_name'] = $statesRow->name;
                        $data['city_name'] = $cityRow->name;

                        $data['zip'] = $this->input->post('zip');
                        $data['pin'] = $this->input->post('zip');
                        $data['company'] = $this->input->post('company');
                        
                        $table = 'vender'; 
                        $where = ['id'=> $this->userID ];
                        $update = $this->Page_Model->common_update($data,$where,$table); 
                        
                        if($update) {
                            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your profile is update successfully</span>');
                            redirect('user/user-profile');
                        } else {
                            $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                            redirect('user/user-profile');
                        }
                    }
                }
            }
        }
        $data['country'] = $this->db->get('countries')->result();
        $data['states'] = $this->db->get('states')->result();
        //$data['cities'] = $this->db->order_by('name', 'asc')->get('cities')->result();
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
        $this->load->view('front/user/profile',$data);
    }
	public function profile11()
	{   
	    
	    $data['country'] = $this->db->get('countries')->result();
        $data['states'] = $this->db->get('states')->result();
        //$data['cities'] = $this->db->order_by('name', 'asc')->get('cities')->result();
        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
	    $this->load->view('front/user/profile',$data);
	}
	public function profileUpdate()
	{
	    $this->form_validation->set_rules('fname','First Name','required|trim');
		$this->form_validation->set_rules('lname','Last Name','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
        
        if( $this->form_validation->run() == false) {
            redirect('user/user-profile'); 
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
             
            $data['fname'] = $this->input->post('fname');
            $data['lname'] = $this->input->post('lname');
            $data['mobile'] = $this->input->post('mobile');
            $data['address'] = $this->input->post('address');
            //$data['country'] = $this->input->post('country');
            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');

            $data['country'] = $country = $this->input->post('country');
            $data['state'] = $state = $this->input->post('state');
            $data['city'] = $city = $this->input->post('city');
            
            $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
            $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
            $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();

            $data['country_name'] = $countryRow->name;
            $data['state_name'] = $statesRow->name;
            $data['city_name'] = $cityRow->name;

            $data['zip'] = $this->input->post('zip');
            $data['pin'] = $this->input->post('zip');
            $data['company'] = $this->input->post('company');
            
            $table = 'vender'; 
            $where = ['id'=> $this->userID ];
            $update = $this->Page_Model->common_update($data,$where,$table); 
            
            if($update) {
                $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your profile is update successfully</span>');
                redirect('user/user-profile');
            } else {
                $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                redirect('user/user-profile');
            }
        }
	} 
	public function orders($id = ''){
	    if($id == '') {
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $data['order'] = $this->db->order_by('id','DESC')->get_where('user_order',['user_id' => $this->userID ])->result();
            $this->load->view('front/user/orders',$data);    
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
            //echo $this->db->last_query(); 
            if(!empty($data['orderDetails'])){
                $this->load->view('front/user/view-order',$data);       
            }else {
                redirect('user/user-orders');
            }      
	    }
	}
	public function wishlist(){
        $wishlistArray = $this->db->get_where('wishlist',['user_id' => $this->userID ])->result();
        
        foreach ($wishlistArray as $key => $value) {
            $this->db->select('*'); 
            $this->db->from('products');
            $this->db->where('products.id', $value->product_id);
            $productDetails  = $this->db->get()->row();

            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $productDetails->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $productDetails->feedbackRating = ($review->rating)?$review->rating:0;
    
            $productDetails->feedbackCount = $review->feedbackCount;
    
            $productDetails->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $productDetails->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();
            $productDetails->boutique_fname = $row['fname'];
            $productDetails->boutique_lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $productDetails->fname = $row['fname'];
            $productDetails->lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
            $productDetails->category_name = $row['name'];
            $productDetails->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $productDetails->sizesArray = $this->db->get('product_size')->result();  
            }else{
                $productDetails->sizesArray = array();  
            }
            $wishlistArray[$key]->productRow = $productDetails;
        }
        
        $data['wishlistArray'] = $wishlistArray; 

        $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
	    $this->load->view('front/user/wishlist',$data);
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
        die;
    }
	public function address(){
	    $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
	    $this->load->view('front/user/address',$data);
	}
	public function setting(){
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
                     $this->db->where('id',$this->userID);
                     $this->db->where('password',md5($currentPassword));
                     $query = $this->db->get();
                     if($query->num_rows()==1){
                         
                            $data = array( 'password' => md5($password), 'updated_at' => date('d-m-Y h:i:s')  );
                            $this->db->where('id', $this->userID);
                            $this->db->update('vender', $data); 
                         
                         $this->session->set_flashdata('updatePassword','<span class="bg-info text-white p-2">Your password is update successfully.</span>');
                         redirect('user/user-setting');
                    }else{
                        $this->session->set_flashdata('error','<span class="bg-info text-danger p-2">Password not match, try again</span>');
                        redirect('user/user-setting');
                    }
           
            } else {
               $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
	           $this->load->view('front/user/setting',$data);
              }
	}
    
}    