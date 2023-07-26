<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends MY_Controller {
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
    public function corporate(){  
        /*$data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "styling-service" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }*/
        $postData = $this->input->post();
        if ($postData['email'] && $postData['fname'] && $postData['lname']) {
            
            $email = $postData['email'];
            
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            
            $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
            $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
            $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();

            $postData['country_name'] = $countryRow->name;
            $postData['state_name'] = $statesRow->name;
            $postData['city_name'] = $cityRow->name;
            $postData['created_at'] = date('Y-m-d h:i:s');

            $insert =  $this->common_model->simple_insert('corporate_form',$postData);
            if ($insert) {
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
                
                 
                
                $subject = 'Thank you for contacting us';  
                 
                $fullName = $postData['fname'].' '.$postData['lname'];
                $mailContent =  mailHtmlHeader_New($this->site);
                    $mailContent .= $option;
                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><h3><b>Thank you for contacting us</b></h3></div>';
                    $mailContent .= '<div style="clear: both;"></div>';
                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($fullName).'</h4>';
                        $mailContent .= '<p style="font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;">We have received your query from our website.<br>Our team will be in touch with you very shortly. In the meantime feel free to explore our styling services. click the button below</p>';
                        $mailContent .= '<p><a class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;" href="'.base_url().'services"> Explore Styling Services</a></p>';
                    $mailContent .= '</div>';
                $mailContent .= mailHtmlFooter_New_2($this->site);
                 //die;

                $to      =  $email;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                $this->session->set_flashdata('message_success_corporate_lead','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for contacting Style Buddy Corporate Services. Our team will get back to you shortly.</p></div>');
                redirect(base_url('Services/corporate'));
            }
             
        }
        $data['country'] = $this->db->get('countries')->result();
        $data['our_services'] = $this->db->get_where('our_services',['status'=> 1])->result(); 
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/services/services-corporate',$data);
        $this->load->view('front/template/footer',$data);
    }
    public function newsletter(){   
        if ($this->input->post('email')) {
            $data['email'] = $this->input->post('email');
            $data['form_name'] = 'newsletter';
            $insert =  $this->db->insert('contact-us',$data); 
            echo 'Thank you for contacting Style Buddy. We will get back to you shortly';      
        }
    }
    public function index(){ 
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "styling-service" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        
        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );

            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $data['our_services'] = $this->db->get_where($table_corporate,['status'=> 1,'corporate_company_id'=> $domain_nameRow->corporate_company_id])->result(); 
            }else{
                $our_services = $this->db->get_where($table,['status'=> 1])->result();
                foreach ($our_services as $key => $value) {
                    $condition = '  WHERE status = 1 AND display_status = 1';  
                    $condition .= '  AND service = "'.$value->id.'"';
                    $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                    $condition .= " order by id DESC";
                    $query = $this->common_model->get_all_details_query('coupon',$condition);
                    //echo $this->db->last_query();
                    $couponRow = $query->row_array();
                    $our_services[$key]->couponRow = $couponRow;
                }

                $data['our_services'] = $our_services;
            }
        }else{
            $our_services = $this->db->get_where($table,['status'=> 1])->result();  
            foreach ($our_services as $key => $value) {
                $condition = '  WHERE status = 1 AND display_status = 1';  
                $condition .= '  AND service = "'.$value->id.'"';
                $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                $condition .= " order by id DESC";
                $query = $this->common_model->get_all_details_query('coupon',$condition);
                //echo $this->db->last_query();
                $couponRow = $query->row_array();
                $our_services[$key]->couponRow = $couponRow;
            }
            $data['our_services'] = $our_services;  
        }
         
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/services/services',$data);
        $this->load->view('front/template/footer',$data);
    }

    public function servicesDetails($slug){  
        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $rows = $this->db->get_where($table_corporate,['status'=> 1,'slug!='=> $slug,'corporate_company_id'=> $domain_nameRow->corporate_company_id])->result(); 
                $data['our_services'] = $rows; 

                $row_detail = $this->db->get_where($table_corporate,['status'=> 1,'slug'=> $slug])->row();
            }else{
                $rows = $this->db->get_where($table,['status'=> 1,'slug!='=> $slug])->result();
                foreach ($rows as $key => $value) {
                    $condition = '  WHERE status = 1 AND display_status = 1';  
                    $condition .= '  AND service = "'.$value->id.'"';
                    $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                    $condition .= " order by id DESC";
                    $query = $this->common_model->get_all_details_query('coupon',$condition);
                    //echo $this->db->last_query();
                    $couponRow = $query->row_array();
                    $rows[$key]->couponRow = $couponRow;
                }
                $data['our_services'] = $rows;
                $row_detail = $this->db->get_where($table,['status'=> 1,'slug'=> $slug])->row();
            }
        }else{
            $rows = $this->db->get_where($table,['status'=> 1,'slug!='=> $slug])->result();
            foreach ($rows as $key => $value) {
                $condition = '  WHERE status = 1 AND display_status = 1';  
                $condition .= '  AND service = "'.$value->id.'"';
                $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                $condition .= " order by id DESC";
                $query = $this->common_model->get_all_details_query('coupon',$condition);
                //echo $this->db->last_query();
                $couponRow = $query->row_array();
                $rows[$key]->couponRow = $couponRow;
            }

            $data['our_services'] = $rows;
            $row_detail = $this->db->get_where($table,['status'=> 1,'slug'=> $slug])->row();
        }
        


        
        
        
        
        $data['datas'] = $row_detail;
        $meta_title = $row_detail->meta_title; 
        $list = array();
        $list['meta_title'] = $meta_title;
        $list['meta_description'] = strip_tags($row_detail->meta_keyword);
        $list['meta_keyword'] = strip_tags($row_detail->meta_description);

        //$couponRow  =  $this->common_model->get_all_details('coupon',array('service'=>$row_detail->id))->row_array();
        //$couponRow  =  $this->common_model->get_all_details('coupon',array('service'=>$row_detail->id,'status'=>1,'display_status'=>1))->row_array();

        $table = 'coupon';
        $condition = '  WHERE status = 1 AND display_status = 1';  
        $condition .= '  AND service = "'.$row_detail->id.'"';
        $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
        $condition .= " order by id DESC";
        $query = $this->common_model->get_all_details_query($table,$condition);
        //echo $this->db->last_query();
        $couponRow = $query->row_array();


        $data['couponRow'] = $couponRow;
        //$data['couponRow'] = array();
        if(!empty($row_detail->image ))  { 
            $img1 =  'assets/images/services/'.$row_detail->image ; 
            if (file_exists($img1)) {
                $img = $img1;
            }
        }

        $list['meta_image'] = $img;
        $data['seoData'] = (object)$list;
        
        $table = 'coupon';
        $condition = '  WHERE status = 1 AND display_status = 1';  
        $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
        $condition .= " order by id DESC";
        $query = $this->common_model->get_all_details_query($table,$condition);
        //echo $this->db->last_query();
        $couponRows = $query->result_array();
        foreach ($couponRows as $key => $value) {
            $r = $this->db->get_where('our_services',['status'=> 1,'id'=> $value['service']])->row_array();
            
            $couponRows[$key]['serviceRow'] = $r;
        }
        $data['couponRows'] = $couponRows;
        //$data['couponRows'] = array();
        if(!empty($row_detail)) {
            $data['parentCategory'] = $this->data['parentCategory'];
            $this->load->view('front/template/header',$data);
            $this->load->view('front/services/services-details',$data);
            $this->load->view('front/template/footer',$data);
        } else {
           redirect();
       }  
    }
    
    public function expertise(){
        $list = $this->db->query('select * from cms_pages where slug = "expertise" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
            $data['cmsData'] = $list;
        }
        
        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise_looking');
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/services/select-service',$data);
        $this->load->view('front/template/footer',$data);

    }



    public function stylistExpert($a = false){   

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4);

        $segment5 = $this->uri->segment(5);

        $data['states']  = $this->db->get('states')->result();
        $this->session->set_userdata('area_expertise_looking_current',$segment2);
        

        $this->db->where('status',1);
        $this->db->where('slug',$segment2);
        $this->db->order_by('slug',$segment2);  
        $expertises = $this->db->get('area_expertise_looking')->row(); 
        $data['expertises'] = $expertises; 
        if($expertises) {
            $data['seoData'] = $expertises;
        }

        

        $where = " where display_status = 1 AND status = 1 AND user_type = 2 ";

         

        if ($this->uri->segment(3) && !is_numeric( $this->uri->segment(3) )) {

             

            $key = 'city';

            $v = base64_decode($this->uri->segment(3));

            $where .= "  AND ".$key." = '".$v."' ";



            $segment = $segment1.'/'.$segment2.'/'.$segment3;

            $uri_segment = 4;

        }else if ($this->uri->segment(2)) {

            $segment = $segment1.'/'.$segment2;

            $uri_segment = 3;

        }else{

            $segment = $segment1;

            $uri_segment = 2;

        }

        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;





        $expertisesArray = explode(',', $expertises->expertise);

        if ($expertisesArray) {

            $ss = '';

            $i = 0;

            foreach ($expertisesArray as $key => $value) {

                if ($i>0) {

                    $ss .= " OR ";

                }

                $ss .= " FIND_IN_SET('". $value ."',expertise)";

                $i++;

            }

            $where .= "  AND (" .$ss. ")";

        }

        

        if ($this->uri->segment(3) && !is_numeric( $this->uri->segment(3) )) {

        }else {

            if ($this->input->get('expert_by_city')) {

                $where .= " AND  city = '". $this->input->get('expert_by_city') ."' ";

                $segment = $segment1.'/'.$segment2.'/'.$segment3;

                $uri_segment = 4;

            }

        }

        if ($this->input->get('experience')) {
            $abc = explode('-', $this->input->get('experience'));
            if ($abc[1] == 'above') {
                $where .= " AND  experience >= '". $abc[0] ."' ";
            }else{
                $where .= " AND  (experience >= '". $abc[0] ."' AND experience <= '". $abc[1] ."' ) ";
            }
            
        }

        $where .= "  order by experience desc";

        $query = $this->db->query("select * from vender".$where);

        $rowCount = $query->num_rows();

        //echo $this->db->last_query();

        $par_page = 16; 

       



        $config = array();

        $this -> load -> library('pagination');



        $config = array();
        $config['full_tag_open']    = '<div class="pagging "><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        $config['total_rows'] = $rowCount;
        $config['per_page'] = $par_page;
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url($segment);
        $this->pagination->initialize($config); 

        if($page != 0){ $page = ($page-1) * $par_page; }

        $where .= " limit ".$page.", ".$par_page;

        $query = $this->db->query("select * from vender".$where);

        $rows = $query->result();
        foreach($rows as $k=>$v){
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$v->id)->row();
            $rows[$k]->feedbackRating = ($review->rating)?$review->rating:0;
            $rows[$k]->feedbackCount = $review->feedbackCount;
            $rows[$k]->review = $review;
            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();
            $rows[$k]->total_portfolio = $ideas->count;
            $rows[$k]->area_expertiseRow = array();
            if ($v->expertise) {
                $area_expertise = explode(',', $v->expertise);
                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                $rows[$k]->area_expertiseRow = $ideas;
            }
        }
        $data['venders'] = $rows;

        $data["p_links"] = $this->pagination->create_links();

        $loggedRow = $this->db->query('select * from cities order by city ASC')->result_array();

        $data['cities'] = $loggedRow;
        

        
        
        $data['expertises_list']  =  $this->common_model->get_all_details_query('area_expertise_looking','WHERE status=1 order by ui_order asc')->result();
        if ($this->input->get('expert_by_city')) {
            $datas  =  $this->common_model->get_all_details('area_expertise_looking_city',array('area_expertise_looking_id'=> $expertises->id,'city_id'=>base64_decode($this->input->get('expert_by_city'))))->row();
            $data['description_city'] = $datas;
        }
        
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/services/select-service-list',$data);
        $this->load->view('front/template/footer',$data);
    }


    public function plans(){  
        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $our_services = $this->db->get_where($table_corporate,['status'=> 1,'corporate_company_id'=> $domain_nameRow->corporate_company_id])->result(); 
            }else{
                $our_services = $this->db->get_where($table,['status'=> 1])->result();
                foreach ($our_services as $key => $value) {
                    $condition = '  WHERE status = 1 AND display_status = 1';  
                    $condition .= '  AND service = "'.$value->id.'"';
                    $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                    $condition .= " order by id DESC";
                    $query = $this->common_model->get_all_details_query('coupon',$condition);
                    //echo $this->db->last_query();
                    $couponRow = $query->row_array();
                    $our_services[$key]->couponRow = $couponRow;
                }
            }
        }else{
            $our_services = $this->db->get_where($table,['status'=> 1])->result();
            foreach ($our_services as $key => $value) {
                $condition = '  WHERE status = 1 AND display_status = 1';  
                $condition .= '  AND service = "'.$value->id.'"';
                $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                $condition .= " order by id DESC";
                $query = $this->common_model->get_all_details_query('coupon',$condition);
                //echo $this->db->last_query();
                $couponRow = $query->row_array();
                $our_services[$key]->couponRow = $couponRow;
            }  
        }
        

        $data['our_services'] = $our_services;
         

        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();
        $data['cartArray'] = $rs;

        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();
        $data['user_cart_session'] = $rs;

        if(!empty($data['our_services'])) {
             
            $data['seoData'] = array();
            $list = $this->db->query('select * from cms_pages where slug = "service-price" and status=1')->row();
            if($list) {
                $data['seoData'] = $list;
            }
            $this->load->view('front/template/header',$data);
            $this->load->view('front/services/services-plan',$data);
            $this->load->view('front/template/footer',$data);
        } else {
           redirect();
       }  
    }
    public function add_to_cart(){
         
        $id = $this->input->post('id');
        $price = $this->input->post('price');
        $qty  = $this->input->post('qty');
        $mrpprice = $this->input->post('mrpprice');
        $activity = $this->input->post('activity');
        
         

        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $row_detail = $this->db->get_where($table_corporate,['id'=> $id])->row();
            }else{
                $row_detail = $this->db->get_where($table,['id'=> $id])->row();
            }
        }else{
            $row_detail = $this->db->get_where($table,['id'=> $id])->row();
        }

        if (file_exists($image_path = FCPATH . 'assets/images/services/' . $row_detail->image)) {  
            $image = 'assets/images/services/'.$row_detail->image;
        } else {
            $image = 'assets/images/no-image.jpg';
        }

        $name = $row_detail->title;
        $user_id = $this->session->userdata('session_user_id_temp');
        $wh = array();
        $wh['user_id'] = $user_id;
        $wh['product_id'] = $id;
        $wh['cart_type'] = 'service';
        $rr = $this->common_model->get_all_details('user_cart',$wh)->row();

        $discountAmt = $mrpprice - $price;
        $discountPrice = ($discountAmt)?(int)$discountAmt:0;
        
        if(empty($mrpprice) || empty($price)){
		    $discount_ = 0; 
		}else{
		    $discount_ = ($discountAmt*100/$mrpprice);   
		}
		
        $discount = ($discount_)?(int)$discount_:0;

        $mrp_price_total =  $qty * $mrpprice;
        $discount_total =  $qty * $discountPrice;
        
        $optionArray = array ('image' => $image, 'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice);

        $data = array(
            'product_image' => $image,
            'cart_type' => 'service',
            'user_id' => $user_id,
            'product_id' => $id,
            'name' => $name,
            'mrp_price' => $mrpprice,
            'sale_price' => $price,
            'price' => $price,
            'discount' => $discount,
            'discount_price' => $discountPrice,
            'quantity' => $qty,
            'created_at' => date('Y-m-d h:i:s'),
            'total' => $qty * $price,
            'mrp_price_total' => $mrp_price_total,
            'discount_total' => $discount_total,
            'options' => json_encode($optionArray),
        );
        if($rr){
            $last_id = $rr->id;
            $this->common_model->commonUpdate('user_cart',$data,array('id'=>$rr->id));
        }else{
            $last_id = $this->common_model->simple_insert('user_cart',$data);
        }
        
        
        $c['user_id'] = $user_id;
        $cartRows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();
        $cart_qty = 0;
        $cart_price = 0;
        
        $html = '';
        $service_cart_qty = 0;
        $service_cart_price = 0;
        foreach ($cartRows as $key => $value) {
            if($value->in_stock){
                $cart_price += $value->total;
                $cart_qty += $value->quantity;
            }
            if($value->cart_type == 'service'){
                $service_cart_price += $value->total;
                $service_cart_qty += $value->quantity;
            }
        }
        if ($activity == 'add') {
            if ($qty > 1) {
                $html .= '<div class="add_you_item">1 Quantity added into cart</div>';  
            }else{
                $html .= '<div class="add_you_item">The service added into cart</div>';
            }
        }else{
            $html .= '<div class="add_you_item">1 Quantity remove from cart</div>';  
        }
        
        
        $c['id'] = $last_id;
        $cartRows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();

        foreach ($cartRows as $key => $value) {
            $v = $value;
            if($v->cart_type == 'service'){
                $name = $v->name;
                $qty = $v->quantity;
                $price = $v->price;
                $html .= '<div class="other_daatt">';
                    $html .= '<span>'.$qty.' Items</span> | <i class="fa fa-inr"></i> '.number_format($qty * $price).'  <a href="'.base_url('cart').'">View cart</a>';
                $html .= '</div>';
            }
        }

        
        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();
        $sessionArray = json_decode($rs['cart_record']);
        
        $c = array();
        $c['user_id'] = $user_id;
        $cartRowsAll = $this->common_model->get_all_details_field('*','user_cart',$c)->result();
        
        $cartTotal = $sessionArray->display_bag_total;
        $discount_total = 0;
        $quantity = 0;
        $total = 0;
        $mrp_price_total = 0;
        $option = '';
        foreach($cartRowsAll as $k=>$v){
            if($v->cart_type == 'service'){
                $discount_total += $v->discount_total;
                $quantity += $v->quantity; 
                $total += $v->total; 
                $mrp_price_total += $v->mrp_price_total; 

                $option .= '<div class="personal_sp">';
                    $option .= '<p><b>'.$v->name.' <span class="qqt" id="qty_plan'.$v->product_id.'">(Qty '.$v->quantity .')</span></b></p>';
                    $option .= '<p>One time Payment  <span class="font22 right_pasa"> <small class="sav" id="sav_plan'.$v->product_id.'">Save '.$this->site->currency.' '.numberformat($v->discount_total).'</small> <b id="plan_total_plan'.$v->product_id.'">'.$this->site->currency.' '.numberformat($v->total).'</b></span></p>';
                $option .= '</div>';

            }
        }
        //$d = number_format((($discount_total * 100) / $mrp_price_total),1); 
        if(empty($mrp_price_total)){
		    $d = 0; 
		}else{
		    $d = number_format((($discount_total * 100) / $mrp_price_total),1);
		}
		
        $option .= '<div class="my_discount"><b>Discount( '.number_format($d,1).'%)<span>'.$this->site->currency.' '.numberformat($discount_total).'</span> </b></div>';
            $option .= '<div class="Sub_total">Subtotal (<span id="total_qty_plan'.$v->product_id.'">'.$quantity.' item</span>): <b id="sub_total_plan'.$v->product_id.'">'.$this->site->currency.' '.numberformat($total).'</b></div>';
            $option .= '<div class="personal_sp"><div class="text-center col-12"><a href="'.base_url('cart').'" class="subscribe_bt3">View cart</a></div> </div>';
        

        if(!empty($cartRows)) {
            $msg = ['success'=>true, 'rowCount'=> $cart_qty ,'rowCountService'=> $service_cart_qty ,'src'=> base_url($image),'pop_up_html'=> $html,'summary_html'=> $option] ;
        }  else {
           $msg = ['error'=>true, 'message'=> 'something went wrong' ];     
        }
        echo json_encode($msg);
    }
    public function ajaxPlanFetach(){
        $postData = $this->input->post();
        $service_id = $postData['id'];

        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $row_detail = $this->db->get_where($table_corporate,['status'=> 1,'id'=> $service_id])->row();
            }else{
                $row_detail = $this->db->get_where($table,['status'=> 1,'id'=> $service_id])->row();
                
                $condition = '  WHERE status = 1 AND display_status = 1';  
                $condition .= '  AND service = "'.$row_detail->id.'"';
                $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                $condition .= " order by id DESC";
                $query = $this->common_model->get_all_details_query('coupon',$condition);
                //echo $this->db->last_query();
                $couponRow = $query->row_array();
                $row_detail->couponRow = $couponRow;
                 

            }
        }else{
            $row_detail = $this->db->get_where($table,['status'=> 1,'id'=> $service_id])->row();

            $condition = '  WHERE status = 1 AND display_status = 1';  
            $condition .= '  AND service = "'.$row_detail->id.'"';
            $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
            $condition .= " order by id DESC";
            $query = $this->common_model->get_all_details_query('coupon',$condition);
            //echo $this->db->last_query();
            $couponRow = $query->row_array();
            $row_detail->couponRow = $couponRow;
        } 
         $value = $row_detail;
        ?>
        <?php 
            $datas = $value;    
            $price = $datas->price;
            $mrpprice = $datas->mrp_price;
            $discountAmt = $mrpprice - $price;
            if(empty($mrpprice) || empty($price)){
    		    $discount_ = 0; 
    		}else{
    		    $discount_ = ($discountAmt*100/$mrpprice);   
    		}
    		
            //$discount_ = ($discountAmt*100/$mrpprice);
            $display = 'display:block;';
            $display_addbutton = 'display:none;';
            $display_addbutton1 = 'display:block;';
            $qty = 1;


            $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
            $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();
            $cartArray = $rs;

            ?>
            <?php $serviceArray= array();?>
            <?php foreach($cartArray as $k=>$v){?>
                <?php   if($v->cart_type == 'service'){?>
                        <?php $serviceArra = array();?>
                        <?php $serviceArra['id']= $v->product_id;?>
                        <?php $serviceArra['qty']= $v->quantity;?>
                        <?php array_push($serviceArray,$serviceArra);?>
                <?php } ?>  
            <?php } ?>  

            <?php  
            $key = array_search($postData['id'], array_column($serviceArray, 'id'));
            if ($key !== FALSE) {
                $display_addbutton = 'display:block;';
                $display_addbutton1 = 'display:none;';
                $qty = $serviceArray[$key]['qty'];
                $display = 'display:block;';
            }
        ?>

        <div class="stylish_by" id="planDiv<?=$value->id?>" data-visible="show" style="<?=$display?>">
            <!-- <h4><?=$value->title?></h4> -->
            <h4><?=$value->title?> <span><a href="<?=base_url('services/'.$value->slug)?>" class="action_bt2">Read More</a></span></h4>
            <hr>
            <?= $value->short_description ?>
            <!-- <p><a  data-bs-toggle="modal" data-bs-target="#myModal___<?=$value->id?>" class="action_bt2">Read More</a></p> -->
            <div class="pk_price">
                <p><i class="fa fa-inr"></i> <?= $price;?> /-<span class="per_session"> Per Session</span></p>
                <?php if($mrpprice > $price){ ?>
                    <span><del> <i class="fa fa-inr"></i> <?= $mrpprice?></del> (<?=(int)$discount_?>% Discount)</span> 
                <?php }?>
                 
            </div>
            <div class="modal" id="myModal___<?=$value->id?>" data-bs-keyboard="false" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?=$value->title?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="full_reccc">
                                <?= $value->description_middle ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qty">
                <div class="add_v"><a style="<?=$display_addbutton1?>" class="add_data" data-id="<?= $datas->id ?>"  data-price="<?= $datas->price ?>" data-mrp_price="<?= $datas->mrp_price ?>">Add</a></div>
                
                <div class="add_qt" style="<?=$display_addbutton?>">
                    <div class="num-block skin-2">
                        <div class="num-in">
                            <span class="minus"></span>
                            <input type="text" data-id="<?= $datas->id ?>"  data-price="<?= $datas->price ?>" data-mrp_price="<?= $datas->mrp_price ?>" class="in-num_plan" name="qtybutton" value="<?=$qty?>" readonly="">
                            <span class="plus"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php $couponRow =  $value->couponRow; ?>
            <?php if($couponRow){ ?>
                <div class="col-sm-12 ">
                    <div class="message_offer">
                       Get <span><?php echo $couponRow['name'];?></span> Discount using coupon code
                    </div>
                </div>
            <?php } ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".add_data").click(function(){
                    let id = $(this).data("id");
                    let qty = 1;
                    //let qty = $(this).parents('.cart_qty_row').find("input[name='qtybutton']").val();
                    let price = $(this).data("price");
                    let mrpprice = $(this).data("mrp_price");
                    ajaxCall(id,price,mrpprice,qty);
                    $(this).parents('.qty').find('.add_qt').show(); 
                    $(this).hide();
                    $(".min_cart_bottom").show();
                });
            });
            $(document).ready(function() {
                $('.num-in span').click(function () {
                    var $input = $(this).parents('.num-block').find('input.in-num_plan');
                    let id = $input.data("id");
                    let price = $input.data("price");
                    let mrpprice = $input.data("mrp_price");
                    let url =  base_url+"Services/add_to_cart";

                    var count;
                    if($(this).hasClass('minus')) {
                        count = parseFloat($input.val()) - 1;
                        count = count < 1 ? 1 : count;
                        if (count < 2) {
                            $(this).addClass('dis');
                        }
                        else {
                            $(this).removeClass('dis');
                        }
                        if(parseFloat($input.val()) > 1){
                            let qty = count;
                            ajaxCall(id,price,mrpprice,qty,'remove');
                            $(".min_cart_bottom").show();
                        }
                        $input.val(count);
                    }
                    else {
                        count = parseFloat($input.val()) + 1
                        $input.val(count);
                        if (count > 1) {
                            $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                        }
                        let qty = count;
                        ajaxCall(id,price,mrpprice,qty,'add');
                        $(".min_cart_bottom").show();
                    }
                    $input.change();
                    
                    
                    
                    return false;
                });
            });
        </script>
        <?php
    
    }
     
    
}

