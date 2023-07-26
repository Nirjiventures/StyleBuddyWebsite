<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('Common_model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	
    public function service_orders()
    {
        $this->db->select ( '*'); 
        $this->db->from ( 'services_booking' );
        $this->db->order_by("id", "DESC");
        $data['val'] = $this->db->get()->result();

        //$data['val'] = $this->Dashboard_Model->common_all('user_order');
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/order-service',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function index(){

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4);

        $tbl_name = 'user_order_details';

       

        $str = " WHERE cart_type != 'service' ORDER BY id desc";

       

        $uri_segment = 4;

        $per_page = 20;

        $list   =  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);

        $numRows =  $list->num_rows();

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

        $query = $this->common_model->get_all_details_query($tbl_name,$str,$limit);

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
        $str = " WHERE id = ".$id." AND cart_type != 'service' ORDER BY id desc";
        $query   =  $this->common_model->get_all_details_query($tbl_name,$str);
        $row =  $query->row();



        $str = " WHERE id = ".$row->user_id." ";
        $query   =  $this->common_model->get_all_details_query('vender',$str);
        $row1 =  $query->row();
        $row->user_row = $row1;

        $str = " WHERE id = ".$row->vendor_id." ";
        $query   =  $this->common_model->get_all_details_query('vender',$str);
        $row1 =  $query->row();
        $row->vendor_row = $row1;


        $data['order'] = $row;
        $this->load->view($segment1.'/template/header');
        $this->load->view($segment1.'/'.$segment2.'/order_details',$data);
        $this->load->view($segment1.'/template/footer');  

    }
    public function index_old(){
        $this->db->select ( '*'); 
        $this->db->from ( 'user_order' );
        $this->db->order_by("id", "DESC");
        $data['val'] = $this->db->get()->result();
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/order',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function orderDetails($id){
        if(!empty($this->input->post('payment_status'))){
            $status = trim($this->input->post('payment_status'));
            $this->db->where ( 'id',$id);
            $this->db->update('user_order',['payment_status'=> $status]);
            
            $this->db->where ( 'orderId',$id);
            $this->db->update('user_order_details',['payment_status'=> $status]);
        }

        $order = $this->db->get_where('user_order',['id'=> $id])->row();
        if(!empty($this->input->post('order_status'))){
            $status = trim($this->input->post('order_status'));
            if ($status == 'Delivered') {
                if ($order->payment_status == 'APPROVED') {
                    $this->db->where ( 'id',$id);
                    $this->db->update('user_order',['order_status'=> $status]);
                    
                    $this->db->where ( 'orderId',$id);
                    $this->db->update('user_order_details',['order_status'=> $status]);
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');
                    redirect(base_url('admin/user-order-details/'.$id));
                }
                
            }else{
                $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');
                $this->db->update('user_order',['order_status'=> $status]);
            }
        }

        $data['order'] = $this->db->get_where('user_order',['id'=> $id])->row();
        
        $this->db->select ( 'user_order.*, user_order_details.*'); 
        //$this->db->select ( 'user_order.*, user_order_details.*,vender.fname,vender.lname'); 
        $this->db->from ( 'user_order' );
        $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
        //$this->db->join ( 'vender','vender.id = user_order_details.venderId');
        $this->db->order_by("user_order_details.id", "DESC");
        $this->db->where ( 'user_order_details.orderId',$id);
        $user_order_details = $this->db->get()->result();
        foreach ($user_order_details as $key => $value) {
            $venderRow = $this->db->get_where('vender',['id'=> $value->venderId])->row();
            $user_order_details[$key]->fname = $venderRow->fname;
            $user_order_details[$key]->lname = $venderRow->lname;
        }
        $data['val'] = $user_order_details;
 

        $this->db->select ( '*'); 
        $this->db->from ( 'payment_status' );
        //$this->db->order_by("id", "DESC");
        $data['payment_status_list'] = $this->db->get()->result();


        $this->db->select ( '*'); 
        $this->db->from ( 'order_status' );
        //$this->db->order_by("id", "DESC");
        $data['status_list'] = $this->db->get()->result();



         $this->load->view('admin/template/header');
         $this->load->view('admin/order/order_details',$data);
         $this->load->view('admin/template/footer'); 
 
    }
	public function blogs()
	{
           $this->db->select('blog.*, vender.fname,vender.lname'); 
           $this->db->from('blog');
           $this->db->join('vender', 'vender.id = blog.vender_id');
           $this->db->where(['blog.status'=>1]);
           $data['datas']  = $this->db->get()->result();
        
          $this->load->view('admin/template/header');
          $this->load->view('admin/vender/allBlogs',$data);
          $this->load->view('admin/template/footer'); 
	} 
	public function registerUser(){
		$condition = " WHERE user_type = 3 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;
	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser',$all);
        $this->load->view('admin/template/footer');
	}
	public function userStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'vender');
	    echo $update;
    }
    public function userDelete()
	{       $id = $this->input->post('id');
	        $delete = $this->common_model->commonDelete('vender',array('id'=>$id));
	        //$delete = $this->Dashboard_Model->common_delete($id,'vender');
            if($delete) {
                $this->session->set_flashdata('success','Record deleted Successfully!!');
                //redirect('admin/register-user');
            } else {
                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                //redirect('admin/register-user');
            }
	}
	public function boutiqueUser(){
		$condition = " WHERE user_type = 4 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;
	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser-boutique',$all);
        $this->load->view('admin/template/footer');
	}
    public function postJobUser(){
		$condition = " WHERE user_type = 5 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;
	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser-postJob',$all);
        $this->load->view('admin/template/footer');
	}
	public function userExport(){
        $filename = 'register_user_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '3' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}

    public function boutiqueExport(){
        $filename = 'register_boutique_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '4' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}
    public function postJobExport(){
        $filename = 'register_postJob_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '5' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}

}	