<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stylist extends MY_Controller {
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
    public function profile($idd = ''){
        if(empty($idd)) {
            redirect(base_url());
            $data['vender']  = $this->Page_Model->fetch_all('vender');
            $this->load->view('front/style-buddies',$data); 
        } else {
            $dc = explode('Name=', $idd);
            $id = base64_decode($dc[0]);
            $tbl_name = 'stylist_view';
            $logsData['ip_address'] = $ip_address=$this->input->ip_address();
            $logsData['user_agent'] = $this->input->user_agent();
            $logsData['user_session_id'] = $session_id = $this->session->session_id;
            $logsData['stylist_id'] = $id;
            $logsData['device_id'] = $postData['device_id'];

            $logsData['created_at']  = date("Y-m-d h:i:s");
            $logsData['updated_at']  = date("Y-m-d h:i:s");

            
            $row  = $this->db->get_where($tbl_name,['stylist_id'=>$id,'ip_address'=>$ip_address,'user_session_id'=>$session_id]);
            if($row->num_rows()){
                
            }else{
                $updateTrue= $this->db->insert($tbl_name,$logsData); 
                $ro  = $this->db->get_where('vender',['id'=>$id])->row_array();
                $u['count_view']=$ro['count_view']+1;
                $this->db->update('vender',$u,array('id'=>$id));
            }


            

            $row = $this->db->get_where('vender',['id'=>$id,'display_status'=>1,'status'=>1])->row();
            if(!$row){
                $lastPage = '';
                $refer =  $this->agent->referrer();
                $a  = explode('/',$refer);
                foreach($a as $k=>$v){
                        $lastPage = $v;
                }
                
                $this->session->set_flashdata('pop_same_page_success','<p class="text-center">Stylist not exist!</p>');
                redirect($refer);
            }

            $query = "select * from products where status = 1 and vender_id = ".$row->id;

            $sortBy = ' order by id desc';

            $query .= $sortBy;

            $result = $this->db->query($query);

            //echo $this->db->last_query();

            $row->products =  $result->result();



            $query = "select * from portfolio_video where status = 1 and vender_id = ".$row->id;

            $sortBy = ' order by id desc';

            $query .= $sortBy;

            $result = $this->db->query($query);

            //echo $this->db->last_query();
            $row->videos =  $result->result();
            /**/
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$row->id)->row();
            $row->feedbackRating = ($review->rating)?$review->rating:0;
            $row->feedbackCount = $review->feedbackCount;
            $row->review = $review;



            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$row->id)->row();
            $row->total_portfolio = $ideas->count;
            /**/

            $data['vender'] = $row;

            $reviews = $this->db->query('select * from review'." WHERE status = 1 AND user_id = ".$row->id)->result_array();
            foreach ($reviews as $ke => $val11) { 

                $reviewUser = array();

                if ($val11['from_user_id']) {

                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();

                    //echo $this->db->last_query();

                }

                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $row->reviews = $reviews;
            $data['expertises']  = $expertises = $this->Page_Model->fetch_all('area_expertise');
            $data['ideas'] = $this->db->get_where('ideas',['vender_id'=>$id,'status'=> 1])->result();
            $data['idea_tag']  = $this->Page_Model->fetch_all('idea_tag'); 

            if(!empty($row->expertise)) { $arrayVal = explode(',',$row->expertise); } 
            $val = ""; $i=0;
            $values = ""; $i=0;
            foreach($expertises as $expertise)  {    
                 if(isset($arrayVal)) { 
                    if(in_array($expertise->id, $arrayVal)) { 
                        if ($i==0) {
                            $val .=  $expertise->name;
                        }
                        $values .=  " , $expertise->name";
                        $i++; 
                    } 
                } 
            }
            
            /*if($this->input->get('show')){
                if($this->input->get('show') == 'packages'){
                    $list = array();
                    $meta_title = 'My Styling Services | '.$row->fname.' '.$row->lname.' | '.$val.' in '.$row->city_name;  
                    $list['meta_title'] = $meta_title;
                    $list['meta_description'] = '';
                    $list['meta_keyword'] = '';
                    $data['seoData'] = (object)$list;
                }else{
                    $data['seoData'] = $data['vender'];
                }
            }else{
                $data['seoData'] = $data['vender'];
            }*/
            $list = array();
            $meta_title = 'My Styling Services | '.$row->fname.' '.$row->lname.' | '.$val.' in '.$row->city_name;  
            $list['meta_title'] = $meta_title;
            $list['meta_description'] = '';
            $list['meta_keyword'] = '';
            
            if(!empty($row->image ))  { 
                $img1 =  'assets/images/vandor/'.$row->image ; 
                if (file_exists($img1)) {
                    $img = $img1;
                }
            }

            $list['meta_image'] = $img;
            $data['seoData'] = (object)$list;
            $vendor_id = $row->id;
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

            if(!empty($data['vender'])) {

                $data['callback_url']       = base_url().'razorpay/stylistbook';
                $data['surl']               = base_url().'razorpay/stylistbook_success';;
                $data['furl']               = base_url().'razorpay/failed';;
                $data['currency_code']      = 'INR';

                $lastPage = '';
                $refer =  $this->agent->referrer();
                $a  = explode('/',$refer);
                foreach($a as $k=>$v){
                        $lastPage = $v;
                }
                $data['lastPage'] = $refer;
                
                
                
                $expertise = explode(',',$data['vender']->expertise); 
                if($this->session->userdata('area_expertise_looking_current')){
                    $condition = array('slug'=>$this->session->userdata('area_expertise_looking_current'));
                }else{
                    $condition = array('id'=>$expertise[0]);
                }
                
                $expertises = $this->common_model->get_all_details('area_expertise_looking',$condition)->row();
                 
                $data['last_activityRow'] = $expertises;
                $this->load->view('front/stylist-profile-page',$data);    

            } else {

                redirect(base_url());

            }

       } 
    }
    public function checkavailability($idd = ''){
        if(empty($idd)) {
            redirect(base_url());
        } else {

            $dc = explode('Name=', $idd);
            $id = base64_decode($dc[0]);
            $row = $this->db->get_where('vender',['id'=>$id,'display_status'=>1])->row();
            
            $url =  base_url('stylist/checkavailability/').base64_encode($row->id).'/'.strtolower($row->fname.'-'.$row->lname);

            $postData = $this->input->post();
            if ($postData) {
                $inputCaptcha = $this->input->post('captcha');
                $sessCaptcha = $this->session->userdata('captchaTextCode');
                if($inputCaptcha === $sessCaptcha){
                    $insert = array();
                    $insert['vendor_id'] = $id;
                    $insert['name'] = $this->input->post('name');
                    $insert['email'] = $this->input->post('email');
                    $insert['city'] = $this->input->post('city');
                    $insert['phone'] = $this->input->post('phone');
                    $insert['message'] = $this->input->post('message');
                    $insert['service_id'] = $this->input->post('service_id');
                    $insert['created_at']  = date('Y-m-d h:i:s');
                    $insert['ip_address'] = $this->input->ip_address();
                    $insert['user_agent'] = $this->input->user_agent();
                    $insert['browser'] = $this->agent->browser();
                    $insert['browserVersion'] = $this->agent->version();
                    $insert['platform'] = $this->agent->platform();
                    $updateTrue = $this->common_model->simple_insert('check_availability',$insert);
                    
                    $row  = $this->common_model->get_all_details('check_availability',array('id'=>$updateTrue))->row();
                    $r = $this->common_model->get_all_details('area_expertise_looking',array('id'=>$row->service_id))->row();
                    $vendor = $this->common_model->get_all_details('vender',array('id'=>$row->vendor_id))->row();
                    
                    $subject =  'Check availability request ';

                    $option = '';
                    $option .= '<style>';
                        $option .= '.banner{background: #FFFA00; }
                                    .banner h1 { padding: 46px 35px; font-weight: 700; font-size: 30px; line-height: 44px; text-transform: uppercase; letter-spacing: -1px; }
                                    .banner img {width: 100%; height: 190px; object-fit: cover; }
                                    .meddle_content{padding:30px 40px; background:#fff;}
                                    .meddle_content h4{font-weight: 700; font-size: 12px; line-height: 22px;}   
                                    .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}
                                    .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                    .bt_box:hover{text-decoration:none; color:#fff; background:#000;}
                                    .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }
                                    .ord {font-size: 12px; line-height: 24px; }
                                    .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }
                                    .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }
                                    .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }
                                    .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  
                                    .pk_list span { float: right; font-weight: 600; }

                                    .pin_box { background: #FF00C7; border: 2px solid #FF00C7; border-radius: 10px; color: #FFF; padding: 11px 0px; margin-bottom:15px;}
                                    a.yellow_bt { background: #FFFA00; border-radius: 5px; font-weight: 700; font-size: 11px; line-height: 16px; color: #000; text-decoration: none; padding: 6px 10px; }
                                    .pink_data { font-weight: 600; font-size: 12px; line-height: 14px; font-style: normal; }

                                        ';
                    $option .= '</style>';

                    /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';
                        $option  .= '<div class="row m-0" style="width:100%;">';
                            $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';
                                $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Your request has been received</h1>';
                            $option  .= '</div>';
                            $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';
                                $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_check_avail.png').'" class="img-fluid">';
                            $option  .= '</div>';
                        $option  .= '</div>';
                    $option  .= '</div>';*/
                    /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';
                        $option  .= '<div class="row m-0" style="width:100%;">';
                            $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';
                                $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 
                                font-size: 100%; line-height: 20px; text-transform: uppercase;">Your request has been received</h1>';
                            $option  .= '</div>';
                            $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';
                                $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_check_avail.png').'" class="img-fluid"> ';
                            $option  .= '</div>';
                        $option  .= '</div>';
                    $option  .= '</div>';*/
                    $mailContent =  mailHtmlHeader_New($this->site);
                        $mailContent .= $option;
                        $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Your request has been received</b></div>';
                        
                        $mailContent .= '<div style="clear: both;"></div>';
                        $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                            $mailContent .= '<h4>'.ucwords($row->name).', Thank you for sending your request to connect with one of our stylists. Our Team will be in touch with you shortly to confirm whether the stylist is available</h4>';

                                $option  = '<style>p{margin:0px;padding:0px;}</style>';   
                                $option .= '<p>Name: '.$row->name.'</p>';   
                                $option .= '<p>Email: '.$row->email.'</p>';   
                                $option .= '<p>City: '.$row->city.'</p>';   
                                $option .= '<p>Phone: '.$row->phone.'</p>';   
                                $option .= '<p>Service Name: '.$r->title_develop.'</p>';   
                                $option .= '<p>Stylist Name: '.ucwords($vendor->fname.' '.$vendor->lname).'</p>';   
                                $option .= '<p>Message: '.$row->message.'</p>';   
                            $mailContent .= $option;
                             
                             
                            $mailContent .= '<div style="clear:both"></div>';
                            $mailContent .= '<hr/>';
                             
                            $mailContent .= '<div class="next_sp" style="font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px;">Next Steps</div>';

                            $mailContent .= '<div class="pin_box" style="background: #FF00C7; border: 2px solid #FF00C7; border-radius: 10px; color: #FFF; padding: 11px 0px; margin-bottom:15px;">
                                                <div class="row m-0 align-items-center">
                                                    <div class="col-sm-1"><img src="'.base_url('assets/images/email_user_check.png').'"></div>
                                                    <div class="col-sm-8"><div class="pink_data" style="font-weight: 600; font-size: 12px; line-height: 14px; font-style: normal;">Register as a user on the website. </div></div>
                                                    <div class="col-sm-3 text-center" style="margin-top:20px">
                                                        <a href="href="'.base_url('user/registration').'"" class="yellow_bt" style="background: #FFFA00; border-radius: 5px; font-weight: 700; font-size: 11px; line-height: 16px; color: #000; text-decoration: none; padding: 6px 10px;">Register</a>
                                                    </div>
                                                </div>
                                            </div>';
                            $mailContent .= '<div class="pin_box" style="background: #FF00C7; border: 2px solid #FF00C7; border-radius: 10px; color: #FFF; padding: 11px 0px; margin-bottom:15px;">
                                                <div class="row m-0 align-items-center">
                                                    <div class="col-sm-1"><img src="'.base_url('assets/images/email_style_check.png').'"></div>
                                                    <div class="col-sm-8"><div class="pink_data" style="font-weight: 600; font-size: 12px; line-height: 14px; font-style: normal;">Browse through our Styling services &<br> exciting offers.</div></div>
                                                    <div class="col-sm-3 text-center"  style="margin-top:20px">
                                                        <a href="'.base_url('services').'" class="yellow_bt" style="background: #FFFA00; border-radius: 5px; font-weight: 700; font-size: 11px; line-height: 16px; color: #000; text-decoration: none; padding: 6px 10px;">Browse Services</a>
                                                    </div>
                                                </div>
                                            </div>';
                        $mailContent .= '</div>';
                    $mailContent .= mailHtmlFooter_New_2($this->site);
                    
                    
                    $to      =  'vijay@gleamingllp.com,'.$row->email;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    
                                            
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath='');

                    $this->session->set_flashdata('check_availability_success','<p class="green_color"><b>Your query has been sent to our styling team. </b></p><p><b>We will connect with you very shortly to confirm if the stylist is available</b></p>'); 
                    redirect($url);
                }else{
                    $this->session->set_flashdata('imgBerror_','Please enter correct captch'); 
                }
            }
            
            $list = $this->db->query('select * from cms_pages where slug = "book-a-free-discussion" and status=1')->row();
            //echo $this->db->last_query();
            if($list) {
                $data['rowdata'] = $list;
            }
            
            $data['vender'] = $row;
            $data['seoData'] = $row;
            if(!empty($data['vender'])) {
                $expertises_list  = $this->common_model->get_all_details_query('area_expertise_looking','where status = 1 order by ui_order asc')->result();
                $data['expertises_list'] = $expertises_list;
                $this->load->view('front/stylist/checkavailability',$data);    
            } else {
                redirect(base_url());
            }
       } 
    }
    public function send_review(){

        $postData = $this->input->post();

        $id =  $postData['id'];

        $name =  $postData['name'];

        $email =  $postData['email'];

         

         

        $comment =  $postData['comment'];

        $rating =  $postData['rating'];

        

        $curlPost['user_id'] = $id;

        $curlPost['email'] = $email;

        $reviewRow = $this->db->query("select * from review where user_id =  '".$id."' and email =  '".$email."'")->row();

        if ($reviewRow) {

            $msg = 'You have aready given rating';

        }else{

            $curlPost['from_user_id'] = $this->session->userdata('userId');

            $curlPost['name'] = $name;

            

            $curlPost['comment'] = $comment;

            $curlPost['rating'] = $rating;

            $curlPost['created_at'] = date('Y-m-d h:i:s');



            $check_content_sightengine = array();
            $check_content_sightengine['fname'] = $comment;
            $check_content_sightengine['lname'] = $name;
            $check_content_sightengine['email'] = $email;
            $dd = check_content_sightengine($check_content_sightengine);
            if ($dd) {
                $msg ='Your request could not be submitted because you enter inappropriate content.'; 
            }else{

                $this->db->insert('review',$curlPost);
    
                $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$id)->row();
                $a = array();
                $a['feedback_rating'] = ($review->rating)?$review->rating:0;
                $this->common_model->commonUpdate('vender',$a,array('id'=>$id));
    
                $msg = 'Thanks you for given feedback!';
            }
        }

        echo $msg;

    }
}

