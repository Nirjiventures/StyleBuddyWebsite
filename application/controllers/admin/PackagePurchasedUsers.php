<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class PackagePurchasedUsers extends MY_Controller {

	

	function __construct(){

        parent::__construct();

        $this->load->library('session');

        $this->load->model('admin/Dashboard_Model');

        $this->load->model('Common_model');

        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->logged_in();

    }

	private function logged_in()

	{

        if (!$this->session->userdata('authenticated')) {

            redirect('stylebuddy-admin');

        }

	} 
    public function orderExport(){
        $filename = 'user_order_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'user_order_details';
        $tbl_name1 = 'vender';
        $str = ' WHERE '.$tbl_name.'.cart_type = "service"';
        if ($this->input->get('user_type')) {
            $str .= " AND ".$tbl_name1.".user_type = '".$this->input->get('user_type')."'";
        }
        if ($this->input->get('corporate_company_id')) {
            $str .= " AND ".$tbl_name1.".corporate_company_id = '".$this->input->get('corporate_company_id')."'";
        }
        if ($this->input->get('domain_id')) {
            $str .= " AND ".$tbl_name1.".domain_id = '".$this->input->get('domain_id')."'";
        }
        if ($this->input->get('report_status')) {
            $str .= " AND ".$tbl_name.".report_status = '".$this->input->get('report_status')."'";
        }
        if ($this->input->get('created_at')) {
            $str .= " AND DATE(".$tbl_name.".created_at) = '".$this->input->get('created_at')."'";
        }
        
        
        $str .= " ORDER BY $tbl_name.id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.user_id = '.$tbl_name1.'.id '.$str);
        $usersData = $query->result();
        echo $this->db->last_query();die;
        $file = fopen('php://output', 'w');
        $header = array("Order id","Name","Email","Sub Total","Date","Coupon Code","Coupon Price","Price","Name"); 
        fputcsv($file, $header);
        foreach ($usersData as $k=>$v){ 
            $date = strtotime($v->created_at); 
            $fdate = date('d M, Y',$date);

            $this->db->select ( '*'); 
            $this->db->from ( 'user_order' );
             $this->db->where ( 'id',$v->orderId);
            $this->db->order_by("id", "DESC");
            $val = $this->db->get()->row();

            
             

            $line = array();
            $line['order_id'] = $v->order_id;
            $line['name'] = ucfirst($v->fname.' '.$v->lname);
            $line['email'] = $v->email;
            $line['total_price'] = number_format($val->total_price);
            $line['date'] = $fdate ;
            $line['coupon_code'] = $val->coupon_code ;
            $line['coupon_price'] = ($val->coupon_value)?$val->coupon_value:'' ;
            
            $line['product_price'] = $v->productPrice;
            $line['product_name'] = $v->productName;
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }
    public function index(){
        $this->getPermission('admin/packagePurchasedUsers');
        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4);

        $tbl_name = 'user_order_details';

       
        $tbl_name1 = 'vender';

        //$str = " WHERE cart_type = 'service' ORDER BY id desc";
        $str = ' WHERE '.$tbl_name.'.cart_type = "service"';
        if ($this->input->get('user_type')) {
            $str .= " AND ".$tbl_name1.".user_type = '".$this->input->get('user_type')."'";
        }
        if ($this->input->get('corporate_company_id')) {
            $str .= " AND ".$tbl_name1.".corporate_company_id = '".$this->input->get('corporate_company_id')."'";
        }
       
        if ($this->input->get('domain_id')) {
            $str .= " AND ".$tbl_name1.".domain_id = '".$this->input->get('domain_id')."'";
        }
        if ($this->input->get('report_status')) {
            $str .= " AND ".$tbl_name.".report_status = '".$this->input->get('report_status')."'";
        } 
        if ($this->input->get('created_at')) {
            $str .= " AND DATE(".$tbl_name.".created_at) = '".$this->input->get('created_at')."'";
        }
        if ($this->input->get('service_id')) {
            $str .= " AND ".$tbl_name.".productName = '".$this->input->get('service_id')."'";
        } 

        
        $uri_segment = 4;

        $per_page = 20;
        if ($this->input->get('per_page')) {
            $per_page = $this->input->get('per_page');
        }
        $str .= " ORDER BY $tbl_name.id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.user_id = '.$tbl_name1.'.id '.$str);

        //$query   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
        //echo $this->db->last_query();
        $numRows =  $query->num_rows();

        $data['numRows'] = $numRows;



        $this->load->library('pagination');

        $config = array();

        $config['total_rows'] = $numRows;

        $config['per_page'] = $per_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

        $config['uri_segment'] = $uri_segment;

        $config['use_page_numbers'] = TRUE;

        $config["base_url"] = base_url().$segment1.'/'.$segment2.'/index';

        $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['first_url']=base_url().$segment1.'/'.$segment2.'/index/?'.http_build_query($_GET, '', "&");

        $this->pagination->initialize($config);

        $links = $this->pagination->create_links();

        $start_from = $this->uri->segment($uri_segment);

        if (!empty($start_from)) {

            $start = $config['per_page'] * ($start_from - 1);

        } else {

            $start = 0;

        }

        $limit['l1'] = $start;

        $limit['l2'] = $config["per_page"];


        
        $query   =  $this->db->query('SELECT '.$tbl_name.'.* FROM '.$tbl_name.' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.user_id = '.$tbl_name1.'.id '.$str.' limit '.$limit['l1'].','.$limit['l2']);
        //$query   =  $this->db->query('SELECT '.$tbl_name.'.* FROM '.$tbl_name' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.user_id = '.$tbl_name1.'.id '.$str);

        //$query = $this->common_model->get_all_details_query($tbl_name,$str,$limit);

        //echo $this->db->last_query(); 

        $post_list = $query->result();

        $data['links'] = $links;

        $data['start_limit'] = $limit['l1'];

        $end_limit = $limit['l2'] + $limit['l1'];

        if($numRows > $end_limit){

            $data['end_limit'] = $end_limit;

        }else{

            $data['end_limit'] = $numRows;

        }

        foreach($post_list as $key=>$row){

            $str = " WHERE id = ".$row->user_id." ";

            $query   =  $this->common_model->get_all_details_query('vender',$str);

            $row1 =  $query->row();

            $post_list[$key]->user_row = $row1;

        }

        $data['title'] = 'Stylist List';

        $data['list_heading'] = 'Stylist List';

        $data['right_heading'] = 'Add';

        $data['datas'] =  $post_list;


        $data['corporate_company'] = array();

        if ($this->input->get('user_type') && $this->input->get('user_type') == 6) {
            $rows = $this->common_model->get_all_details('corporate_company',array('status'=>1))->result();
            $data['corporate_company'] = $rows;
        }
        $data['corporate_domain'] = array();
        if ($this->input->get('corporate_company_id')) {
            $st = " WHERE corporate_company_id = '".$this->input->get('corporate_company_id')."'";
            $que = $this->common_model->get_all_details_query('corporate_domain',$st)->result();
            $data['corporate_domain'] = $que;
        }
        $table = 'our_services';
        $our_services = $this->db->get_where($table,['status'=> 1])->result();  
        $data['our_services'] = $our_services;
        
        $this->load->view($segment1.'/template/header');

        $this->load->view($segment1.'/'.$segment2.'/index',$data);

        $this->load->view($segment1.'/template/footer'); 

    }

    public function userOrderDetails($id){

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4); 

        $postData = $this->input->post();

        $tbl_name = 'user_order_details';

        if ($postData) {
            $this->getPermission('admin/packagePurchasedUsers/edit');
            $this->uploadPath = 'assets/images/package_report/';

            $image = $this->uploadSingleImageOnly('image',$this->uploadPath);

            if(!empty($image)){

                $id = $postData['id'];

                



                $image_type_full = $_FILES['image']['type'];

                $image_type = explode('/',$image_type_full);

                //var_dump($image_type[1]);die;

                if (strtolower($image_type[1]) != 'pdf') {

                    $this->session->set_flashdata('success','Please upload only pdf file');

                    redirect(base_url('admin/packagePurchasedUsers/userOrderDetails/'.$id));   

                }



                 



                $d = array();

                $d['report_status'] = 1;

                $d['last_report'] = $image;

                $this->common_model->commonUpdate($tbl_name,$d,array('id'=>$id));

                $str = " WHERE id = ".$id." ORDER BY id desc";

                $query   =  $this->common_model->get_all_details_query($tbl_name,$str);

                $row =  $query->row();

                $user_id = $row->user_id;

                $str = " WHERE id = ".$row->user_id." ";

                $query   =  $this->common_model->get_all_details_query('vender',$str);

                $row1 =  $query->row();

                $row->user_row = $row1;



                

                $package_id = $row->productId;



                $d = array();

                $d['user_id'] = $row->user_id;

                $d['order_detail_id'] = $id;

                $d['package_id'] = $package_id;

                $d['image'] = $image;

                $this->common_model->simple_insert('package_report_pdf',$d);

                $subject = 'Styling Report';     

    

                $option = '';

                $option .= '<style>';

                    $option .= '.banner{background: #FFFA00; }

                                .banner h1 { padding: 51px 20px; font-weight: 700; font-size: 30px; line-height: 44px; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 0px; }

                                .banner img {width: 100%; height: 190px; object-fit: cover; }

                                .meddle_content{padding:30px 40px; background:#fff;}

                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   

                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; }

                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 5px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:14px; display: inline-block;}

                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';

                $option .= '</style>';



                 

                

                /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';

                    $option  .= '<div class="row m-0" style="width:100%;">';

                        $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';

                            $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Your Styling report is AValiable</h1>';

                        $option  .= '</div>';

                        $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';

                            $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_report_upload.png').'" class="img-fluid">';

                        $option  .= '</div>';

                    $option  .= '</div>';

                $option  .= '</div>';*/

                

                /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';

                    $option  .= '<div class="row m-0" style="width:100%;">';

                        $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';

                            $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 

                            font-size: 100%; line-height: 20px; text-transform: uppercase;">Your Styling report is AValiable</h1>';

                        $option  .= '</div>';

                        $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';

                            $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_report_upload.png').'" class="img-fluid"> ';

                        $option  .= '</div>';

                    $option  .= '</div>';

                $option  .= '</div>';*/

                

                $mailContent =  mailHtmlHeader_New($this->site);

                    $mailContent .= $option;
                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Your styling report is avaliable</b></div>';


                    $mailContent .= '<div style="clear: both;"></div>';

                    $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';

                        $mailContent .= '<h4>Hi '.ucwords($row->user_row->fname.' '.$row->user_row->lname).'</h4>';

                        $mailContent .= '<p>CONGRATS! Your Styling Report is now Available to be viewed.  Our Styling team are quite excited to show you the report!</p>';

                        $mailContent .= '<p>To view the report, please login to your dashboard from here:</p>';

                        $mailContent .= '<p><a href="'.base_url('login').'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;">LOGIN</a></p>';

                    $mailContent .= '</div>';

                $mailContent .= mailHtmlFooter_New_1($this->site);

                 



                $to =  ($row->user_row->email)?$row->user_row->email:'vijay@gleamingllp.com';

                $from = FROM_EMAIL;

                $from_name = $this->site->site_name;

                $cc = CC_EMAIL;

                $reply = REPLY_EMAIL;

                $pdfFilePath = '';

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



                //echo $this->db->last_query();

                $this->session->set_flashdata('success','Data has been successfully uploaded');

                redirect(base_url().$segment1.'/'.$segment2.'/'.$segment3.'/'.$id);      

            }

        }

        

        $str = " WHERE id = ".$id." AND cart_type = 'service' ORDER BY id desc";

        $query   =  $this->common_model->get_all_details_query($tbl_name,$str);

        $row =  $query->row();



        $str = " WHERE id = ".$row->user_id." ";

        $query   =  $this->common_model->get_all_details_query('vender',$str);

        $row1 =  $query->row();

        $row->user_row = $row1;

        $str = " WHERE id = ".$row->orderId." ";

        $query   =  $this->common_model->get_all_details_query('user_order',$str);

        $row1 =  $query->row();

        $row->order_row = $row1;
        

        $str = " WHERE  order_detail_id = ".$id."  ORDER BY id desc";

        $query   =  $this->common_model->get_all_details_query('package_report_pdf',$str);

        $row1 =  $query->result();

        $row->package_report_pdf = $row1;



        

        $data['order'] = $row;

        $this->load->view($segment1.'/template/header');

        $this->load->view($segment1.'/'.$segment2.'/order_details',$data);

        $this->load->view($segment1.'/template/footer');  

    }



    public function delete($id){
        $this->getPermission('admin/packagePurchasedUsers/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = 'package_report_pdf';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Data deleted successfully!!');

            redirect($url1.'/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect($url1.'/'.$url2);

        }

    }

}	