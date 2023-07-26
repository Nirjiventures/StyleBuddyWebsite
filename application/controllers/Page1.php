<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {
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
    public function newsletter(){   

        if ($this->input->post('email')) {
            $data['email'] = $this->input->post('email');
            $data['form_name'] = 'newsletter';
            $insert =  $this->db->insert('contact-us',$data); 
            echo 'Thank you for contacting Style Buddy. We will get back to you shortly';      

        }

    }
    public function index(){   
         
        $data = $this->Page_Model->common_all('');
        $postData = $this->input->post();
        if (!empty($postData['email']) && !empty($postData['name']) && !empty($postData['mobile']) && !empty($postData['city'])) {
            
            /*$data2 = array();
            $data2['user_type'] = 3;
            $data2['status'] = 0;
            $data2['fname'] = $this->input->post('name');
            $data2['email'] = $this->input->post('email');
            $data2['password'] = md5($this->input->post('password'));
            $data2['mobile'] = $this->input->post('mobile');
            $data2['city'] = $this->input->post('city');
            $data2['created_at']  = date('Y-m-d h:i:s');
            $updateTrue = $this->common_model->simple_insert('vender',$data2);     
            $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
            $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);


            $subject = 'Welcome to Stylebuddy Fashion Platform- Confirm your Email';
            $option .= '<div>';
                $option =  '<p style="font-size:18px;">Thank you for signing up on the stylebuddy Fashion platform- the No.1 destination for fashion styling. We are excited to have you part of the stylebuddy platform.</p>';
                $option .= '<p style="font-size:18px;">In order to access the platform, please confirm your account by clicking the button below:</p>';
                $option .= '<p style="font-size:16x;text-align:center;">';
                    $option .= '<a style="background: #742ea0;color: #FFF;text-decoration: none; padding: 1em;text-transform: uppercase;font-weight: bold;border-radius: 4px;margin-top: 30px;display: inline-block;" href="'.base_url('page/activeaccount/'.$activate_string).'">Confirm Account</a>';
                $option .= '</p>';
            $option .= '</div>';
            $option .= '<div style="text-align: center;background: gray;padding: 5px;margin-top: 50px;color:#fff">';
                $option .= '<p><b>Need more help?</b></p>';
                $option .= '<p>If you have any trouble confirming your account, please send an email to <p>';
                $option .= '<p><a href="mailto:'.$this->site->email.'" style="color: #742ea0; text-decoration: none;"><i class="fa fa-envelope-o" aria-hidden="true"></i> '.$this->site->email.'</a></p>';
            $option .= '</div>';
            
            
            $mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            $to = TO_EMAIL;
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
            
            $mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($data2['fname']).'</h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            
            $to      =  $data2['email'];
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 
            
            //$this->session->set_flashdata('festival_message','<span class=" p-2 mb-2">Thank you for registering with StyleBuddy. Please verify your email address. A verification email has been to sent your email ID. Thank you.</span>');
            $this->session->set_flashdata('festival_message','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
            redirect(base_url());*/
             
        }else  if (!empty($postData['festival_email']) && !empty($postData['festival_name']) && !empty($postData['festival_mobile'])) {
            /*$insert_data['festival_name'] = 'Diwali';
            $insert_data['mobile'] = $postData['festival_mobile'];
            $insert_data['email'] = $postData['festival_email'];
            $insert_data['name'] = $postData['festival_name'];
            $insert_data['ip_address'] = $this->input->ip_address();
            $insert_data['user_agent'] = $this->input->user_agent();
            $insert_data['browser'] = $this->agent->browser();
            $insert_data['browserVersion'] = $this->agent->version();
            $insert_data['platform'] = $this->agent->platform();
            $date1 = "2022-08-11 23:59:59";
            $date2 = date('Y-m-d H:i:s');
            $timestamp1 = strtotime($date1);
            $timestamp2 = strtotime($date2);
            $hour = intval(abs($timestamp2 - $timestamp1)/(60*60));
            set_cookie('festival_name',$postData['festival_name'],time()+60*60*$hour); 
            set_cookie('festival_email',$postData['festival_email'],time()+60*60*$hour);
            set_cookie('festival_mobile',$postData['festival_mobile'],time()+60*60*$hour);
            $this->common_model->simple_insert('festival_form',$insert_data); 
            $mailForm = $postData['festival_email'];

            $subject = 'Festival Form Details';
            $option = '
            <h3>Festival Form Details</h3>
            <p><b>Name :</b>'.$postData['festival_name'].'</p>
            <p><b>Email Id :</b>'.$postData['festival_email'].'</p>
            <p><b>Mobile :</b>'.$postData['festival_mobile'].'</p>';
            
            $mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            $to = TO_EMAIL;
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
            
            $mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($postData['festival_name']).'</h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            
            $to      =  $data2['email'];
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 
            
            $this->session->set_flashdata('festival_message','<span class=" p-2 mb-2">Thanks for your interest, we will get back to you soon</span>');
            redirect(base_url());*/
             
        }else  if (!empty($postData['getStartedContact']) && !empty($postData['getStartedEmail']) && !empty($postData['getStartedName'])) {
            
            $inputCaptcha = $postData['getStartedCaptcha'];
            $sessCaptcha = $this->session->userdata('captchaTextCode');
            //var_dump($postData);
            //var_dump($sessCaptcha);
            
            if($inputCaptcha == $sessCaptcha){
                $insert_data = array();
                $name = $postData['getStartedName'];
                $email = $postData['getStartedEmail'];
                $mobile = $postData['getStartedContact'];
                $city = $postData['getStartedCity'];
                $message = $postData['getStartedMessage'];
                
                 

                $insert_data['name'] = $name;
                $insert_data['email'] = $email;
                $insert_data['mobile'] = $mobile;
                $insert_data['city'] = $city;
                $insert_data['message'] = $message;
                
                $insert_data['ip_address'] = $this->input->ip_address();
                $insert_data['user_agent'] = $this->input->user_agent();
                $insert_data['browser'] = $this->agent->browser();
                $insert_data['browserVersion'] = $this->agent->version();
                $insert_data['platform'] = $this->agent->platform();
                
                $this->common_model->simple_insert('get_started_form',$insert_data); 
                
                

                $subject = 'Get Started Form Details';

                $option = '<p>Thank you for submitting your request for a trial of styling service. We will get back to you soon to fix an appointment for you.</p>'; 
                $option .= '<p>You can also call or message us on '.$this->site->site_name.' to fix an appointment. Meanwhile, here are the details you submitted in your form:</p>';
                $option .= '<p><b>Name :</b>'.ucwords($name).'</p>';
                $option .= '<p><b>Email Id :</b>'.$email.'</p>';
                $option .= '<p><b>Mobile :</b>'.$mobile.'</p>';
                $option .= '<p><b>City :</b>'.$city.'</p>';
                $option .= '<p><b>Message :</b>'.$message.'</p>';
               
                 
                $mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($name).'</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                
                $to      =  $email;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 
                
                $this->session->set_flashdata('get_started_form_message','<div><h4 style="color:#fff">We got your details, thank you. We will call you soon</h4></div>');
                redirect(base_url());
            }
             
        }else  if (!empty($postData['quoteContact']) && !empty($postData['quoteEmail']) && !empty($postData['quotefname']) && !empty($postData['quotelname'])) {
            
            $inputCaptcha = $postData['quotecaptcha'];
            $sessCaptcha = $this->session->userdata('captchaTextCode');

            if($inputCaptcha == $sessCaptcha){
                $insert_data = array();
                $mobile = $postData['quoteContact'];
                $email = $postData['quoteEmail'];
                $fname = $postData['quotefname'];
                $lname = $postData['quotelname'];
                $message = $postData['quotemessage'];
                
                $name = $fname.' '.$lname;

                $insert_data['fname'] = $fname;
                $insert_data['lname'] = $lname;
                $insert_data['name'] = $name;
                
                $insert_data['mobile'] = $mobile;
                $insert_data['email'] = $email;
                $insert_data['message'] = $message;
                
                $insert_data['ip_address'] = $this->input->ip_address();
                $insert_data['user_agent'] = $this->input->user_agent();
                $insert_data['browser'] = $this->agent->browser();
                $insert_data['browserVersion'] = $this->agent->version();
                $insert_data['platform'] = $this->agent->platform();
                
                $this->common_model->simple_insert('ask_for_quote',$insert_data); 
                
                

                $subject = 'Ask for a quote Details';

                $option = '';
                $option .= '<p><b>Email Id :</b>'.$email.'</p>';
                $option .= '<p><b>Mobile :</b>'.$mobile.'</p>';
                $option .= '<p><b>Message :</b>'.$message.'</p>';

                 
                $mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($name).'</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                
                $to      =  $email;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 
                
                $this->session->set_flashdata('ask_for_quote_form_message','<div><h4>Style Buddy team will get back to you soon</h4></div>');
                redirect(base_url());
            }
             
        }else  if (!empty($postData['surveyContact']) && !empty($postData['surveyEmail']) && !empty($postData['surveyName']) && !empty($postData['captcha']) && ($postData['captcha'] == $this->session->userdata('captchaTextCode'))) {
            $inputCaptcha = $postData['captcha'];
            $sessCaptcha = $this->session->userdata('captchaTextCode');

            if($inputCaptcha == $sessCaptcha){
                $insert_data = array();
                $mobile = $postData['surveyContact'];
                $email = $postData['surveyEmail'];
                $name = $postData['surveyName'];
                
                if(is_numeric($mobile)){
                    $insert_data['mobile'] = $mobile;
                    $insert_data['email'] = $email;
                    $insert_data['name'] = $name;
                    $a=array();
                    for ($i=1; $i < 8; $i++) { 
                        $a['radio-group'.$i] = $postData['radio-group'.$i];
                    }
        
                    $insert_data['answer'] = json_encode($a);
                    $insert_data['ip_address'] = $this->input->ip_address();
                    $insert_data['user_agent'] = $this->input->user_agent();
                    $insert_data['browser'] = $this->agent->browser();
                    $insert_data['browserVersion'] = $this->agent->version();
                    $insert_data['platform'] = $this->agent->platform();
                    $this->common_model->simple_insert('survey_form',$insert_data);
                    
                    
                    $hour = 1 * 24 * 365;
                    set_cookie('surveyName',$name,time()+60*60*$hour); 
                    set_cookie('surveyEmail',$email,time()+60*60*$hour);
                    set_cookie('surveyContact',$mobile,time()+60*60*$hour);
                     
                    
                    
        
                    $subject = 'Thank you submitting your Style Questionnaire';
        
                    $option = '<p style="margin-top:20px;margin-bottom:20px;">Thank you for submitting your Styling Questionnaire. Our Expert Stylist will send your personalized style assessment report in 2 working days. For your reference, we are providing below your responses to the Survey:</p>';
                    $option .= '<p><b>Name : </b>'.$name.'</p>';
                    $option .= '<p><b>Email Id : </b>'.$email.'</p>';
                    $option .= '<p><b>Mobile : </b>'.$mobile.'</p>';
        
                    $abQuestion = array(
                                    array(
                                        'title'=>'Welcome to Your Style Assessment. Lets start with Basics. How often do you see yourself in the mirror?',
                                        'sub_title'=>'Mirrors help us regulate our emotions and sync up with ourselves and others',
                                        'question'=>array('2 to 5 times a Day','More than 5 times a Day','Less then Twice a Day')
                                    ),
                                    array(
                                        'title'=>'“How do I Look?” – how often you ask this question to others?',
                                        'sub_title'=>'We usually want to know other\'s opinions to help make decisions or to ensure we are doing the right thing',
                                        'question'=>array('Never or Rarely','Almost always','When I am dressing up for special occassion')
                                    ),
                                    array(
                                        'title'=>'Is Looking Good and Stylish important for you?',
                                        'sub_title'=>'Looking good will not only increase your self-confidence but it also impresses and attracts other people',
                                        'question'=>array('Yes, Always','Yes, but only on special occasions','This is not important for me')
                                    ),
                                    array(
                                        'title'=>'How often do you get praised for your style and what you wear?',
                                        'sub_title'=>'It demonstrates their admiration for your fashion sense',
                                        'question'=>array('Almost Always :-)','Only when I dress up for special occasions','Never or very Rarely :-(')
                                    ),
                                    array(
                                        'title'=>'Do you think that dressing well and carrying your unique style helps boost confidence at workplace?',
                                        'sub_title'=>'Studies show that people who dress right for interviews or business meetings are 80% more likely to succeed',
                                        'question'=>array('Yes, I Strongly Agree','I am not sure about it','No, I don\'t think it is important')
                                    ),
                                    array(
                                        'title'=>'What are your Style Goals for 2023?',
                                        'sub_title'=>'Did you know that Indians are adopting fashion and style like never before?',
                                        'question'=>array('Try Something New','Look Simple but Stylish','I have no personal style goals')
                                    ),
                                    array(
                                        'title'=>'Do you comment on what other people wear and their style?',
                                        'sub_title'=>'It means you are good at observing and appreciate fashion and style',
                                        'question'=>array('Almost Always','Sometimes','Never')
                                    ),
        
                                );
                    $option .= '<h5>Questions: </h5>';
                    $option .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">';
                    $option .= '<table class="table table-striped">'; 
                        $ib=0;  foreach ($abQuestion as $key => $value) { $ib++; 
                            $option .= '<tr>';
                                $option .= '<td><p><b>Question '.$ib.'.</b> '.$value['title'].'<br/><small>'.$value['sub_title'].'</small></p>
                                            <p style="margin-bottom:0px;"><b>Ans. </b>'.$postData['radio-group'.$ib].'</p>
                                            </td>';
                            $option .= '</tr>';
                            
                        }
                    $option .= '</table>';
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<p>Dear <b>'.ucwords($name).',</b></p>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to      =  $email;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = ""); 
                    
                     
                    $this->session->set_flashdata('survey_form_message','<div><h4>Thank You for taking the first steps towards your style journey</h4><p>Our Expert Fashion Consultant  will review your and prepare a personalized stylng assessment report for you. Your report will be mailed to you in 2 working days. </p><a class="popup_button" href="'.base_url('buy-styling-packages').'">Explore Styling Packages</a></div>');
                    redirect(base_url()); 
                }else{
                    $this->session->set_flashdata('survey_form_message','<div><h4>You enter incorrect mobile</h4></div>');
                    redirect(base_url()); 
                }
                
                
            }
             
        }
        $data['survey_form_flag'] = 1;
        if(!empty(get_cookie('surveyContact')) && !empty(get_cookie('surveyEmail')) && !empty(get_cookie('surveyName')) ){
            $data['survey_form_flag'] = 0;
            $wh=array();
            $wh['name']= get_cookie('surveyName');
            $wh['email']= get_cookie('surveyEmail');
            $wh['mobile']= get_cookie('surveyContact');
            $wh['ip_address']=$this->input->ip_address();

            $row = $this->common_model->get_all_details('survey_form',$wh)->row_array();
            if ($row) {
                $data['survey_form_flag'] = 0;
            }
            
        }

        if(!empty(get_cookie('festival_name')) && !empty(get_cookie('festival_email')) && !empty(get_cookie('festival_mobile')) ){
            $wh=array();
            $wh['name']= get_cookie('festival_name');
            $wh['email']= get_cookie('festival_email');
            $wh['mobile']= get_cookie('festival_mobile');
            $wh['ip_address']=$this->input->ip_address();

            $row = $this->common_model->get_all_details('festival_form',$wh)->row_array();
            if ($row) {
                $data['show_flag'] = 0;
            }else{
                 $data['show_flag'] = 1;   
            }
        }else{
            $data['show_flag'] = 1;
        }
         

        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise_looking');
        
        $blogs = $this->common_model->get_all_details_query('our_services',' where status = 1 order BY ID asc  limit 0,8')->result();
        $data['datas'] = $blogs;    
       
         
        
        $blogs = $this->common_model->get_all_details_query('blog',' where status = 1 order BY ID desc  limit 0,8')->result();
        foreach($blogs as $k=>$v){
            if($v->vender_id){
                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();
                $blogs[$k]->fname = $d['fname'];
                $blogs[$k]->lname = $d['lname'];
            }else{
                $blogs[$k]->fname = 'ADIMN';
                $blogs[$k]->lname = '';
            }
        }
        $data['style_stories'] = $blogs;
        
         

        $query = $this->db->query("select * from vender  WHERE user_type = 2 ORDER BY count_view DESC limit 0,4");

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
        $data['tranding_vendor'] = $rows;
        
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 order by id desc limit 8 ";
        $result = $this->db->query($query);
        
        $products =  $result->result();;

        foreach ($products as $key => $productDetails) {
            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $products[$key]->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $products[$key]->feedbackRating = ($review->rating)?$review->rating:0;
    
            $products[$key]->feedbackCount = $review->feedbackCount;
    
            $products[$key]->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $products[$key]->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $products[$key]->fname = $row['fname'];
            $products[$key]->lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  
            }else{
                /*$this->db->select('*');  
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  */
                $products[$key]->sizesArray = array();  
            }
            

        }
        $data['products'] =  $products;
        
        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }
        }
        $data['parentCategory'] = $rows;
        $this->load->view('Page/index',$data);

    }
    public function activeaccount(){
        if($this->session->userdata('userType')) {
	        redirect(base_url());
	    }
	    
        $postData = $this->input->get();
        $aa = explode('====', base64_decode($this->uri->segment(3)));
		 
		$abc  = array();
		$abc['id'] = $aa[0];
		$abc['email'] = $aa[1];
		$abc['password'] = $aa[2];
		$abc['email_verification'] = 0;
		$userRow 	=  $this->common_model->get_all_details('vender',$abc)->row_array();
		 
		if($userRow){
			$p['status'] = 1;
			$p['email_verification'] = 1;
			$updateTrue = $this->common_model->commonUpdate('vender',$p,array('id'=>$userRow['id']));
			//$this->session->set_flashdata('festival_message','<span class=" p-2 mb-2">Your account have activated. <br/><a href="'.base_url('login').'">Please login</a>.</span>');
			$this->session->set_flashdata('festival_message1','<span class=" p-2 mb-2">Your Account Is Activated. Please <a href="'.base_url('login').'">Login</a></span>');
		}else{
		    $this->session->set_flashdata('festival_message','<span class=" p-2 mb-2">Your varification link expired.</span>');
		}
		redirect(base_url());
    }
    public function activeaccountjobs(){
        if($this->session->userdata('userType')) {
            redirect(base_url());
        }
        
        $postData = $this->input->get();
        $aa = explode('====', base64_decode($this->uri->segment(3)));
         
        $abc  = array();
        $abc['id'] = $aa[0];
        $abc['email'] = $aa[1];
        $abc['password'] = $aa[2];
        $abc['email_verification'] = 0;
        $userRow    =  $this->common_model->get_all_details('vender',$abc)->row_array();
         
        if($userRow){
            $p['status'] = 1;
            $p['email_verification'] = 1;
            $updateTrue = $this->common_model->commonUpdate('vender',$p,array('id'=>$userRow['id']));
            //echo $this->db->last_query();die;
            $this->session->set_flashdata('festival_message1','<span class=" p-2 mb-2">Your Account Is Activated. Please <a href="'.base_url('page/postjoblogin').'">Login</a></span>');
        }else{
            $this->session->set_flashdata('festival_message','<span class=" p-2 mb-2">Your varification link expired.</span>');
        }
        redirect(base_url('page/postjoblogin'));
    }
    
	public function fashionService(){   

	    $data['fashonService'] = $this->Page_Model->fetch_all('fashion_services');

		$this->load->view('Page/fashion-services',$data);

	}


    public function magazine(){   

		$this->load->view('Page/magazine',$data);

	}

    

	

	public function cms($url){

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "'.$url.'" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

        } 

        //https://stylebuddy.in/intial-booking-form

        

        if ($url == 'intial-booking-form') {

            $data['callback_url']       = base_url().'razorpay/intial_booking_form';

            $data['surl']               = base_url().'razorpay/success';;

            $data['furl']               = base_url().'razorpay/failed';;

            $data['currency_code']      = 'INR';

    

            $this->load->view('Page/intialbookingform',$data);

        }else if ($url == 'services') {

            $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result();    

            $this->load->view('Page/services',$data);

        }else if ($url == 'services-develop') {

            $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result();    

            $this->load->view('Page/services-develop',$data);

        }else{

            $list = $this->db->get_where('cms_pages',['slug'=> $url, 'status'=> 1 ])->row();

            //echo $this->db->last_query();

            //var_dump($list);

            if($list) {

                $data['cmsData'] = $list;

                if($list->slug === 'about-us') {
                    $this->load->view('Page/about-us',$data);
                } else if( $list->slug === 'about-us-develop') {
                    $this->load->view('Page/about-us-develop',$data);
                } else {
                    $this->load->view('Page/privacy-policy',$data);
                }
            } else {
                redirect();
            }
        }
    }
   
	public function register_____(){   

	    if($this->session->userdata('userType') == 3 ) {

	        redirect(base_url());

	    }else {

	        $this->load->view('Page/register');   

	    }

	}

	public function registerProcess_comment() { 

	    

	    $this->form_validation->set_rules('fname', 'First Name', 'required|trim'); 

	    $this->form_validation->set_rules('lname', 'Last Name', 'required|trim'); 

	    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]'); 

	    $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[password]');

	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email[vender.email]');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	    $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another'); 



	    $msg = '';

        if($this->form_validation->run()) {
            $data['user_type'] = 3;
            $data['status'] = 0;
            $data['fname'] = $this->input->post('fname');
            $data['lname'] = $this->input->post('lname');
            $data['email'] = $this->input->post('email');
            $data['password'] = md5($this->input->post('password'));
            $data['created_at']  = date('Y-m-d h:i:s');
            //$insert = $this->db->insert('vender',$data);
            //$updateTrue = $this->common_model->simple_insert('vender',$data);     
            $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
            $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);
            
            
            if($updateTrue) {
                $subject = 'Welcome to Stylebuddy Fashion Platform- Confirm your Email';
                $option .= '<div>';
                    $option =  '<p style="font-size:18px;">Thank you for signing up on the stylebuddy Fashion platform- the No.1 destination for fashion styling. We are excited to have you part of the stylebuddy platform.</p>';
                    $option .= '<p style="font-size:18px;">In order to access the platform, please confirm your account by clicking the button below:</p>';
                    $option .= '<p style="font-size:16px;text-align:center;">';
                        $option .= '<a style="background: #742ea0;color: #FFF;text-decoration: none; padding: 1em;text-transform: uppercase;font-weight: bold;border-radius: 4px;margin-top: 30px;display: inline-block;" href="'.base_url('page/activeaccount/'.$activate_string).'">Confirm Account</a>';
                    $option .= '</p>';
                $option .= '</div>';
                $option .= '<div style="text-align: center;background: gray;padding: 5px;margin-top: 50px;color:#fff">';
                    $option .= '<p><b>Need more help?</b></p>';
                    $option .= '<p>If you have any trouble confirming your account, please send an email to <p>';
                    $option .= '<p><a href="mailto:'.$this->site->email.'" style="color: #742ea0; text-decoration: none;"><i class="fa fa-envelope-o" aria-hidden="true"></i> '.$this->site->email.'</a></p>';
                $option .= '</div>';
                /* Send email to admin*/
                
                $mailContent =  mailHtmlHeader($this->site);
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
                 
                $to = TO_EMAIL;
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
                
                /* Send email to   user */
                
                 
                $mailContent =  mailHtmlHeader($this->site);
                    //$mailContent .= '<h1 style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Welcome to Style Buddy</h1>';
                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($data['fname'].' '.$data['lname']).'</h3>';
                    $mailContent .= $option;
                $mailContent .= mailHtmlFooter($this->site);
             

                $to      =  $data['email'];
                $from = FROM_EMAIL;
                $from_name = $this->site->site_name;
                $cc = CC_EMAIL;
                //$cc = 'mr.vijaybaghel@gmail.com,vijay@gleamingllp.com,joginder@gleamingllp.com';
                $reply = REPLY_EMAIL;
                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                $msg = array('success' => '<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
                //$msg = array('success' => "<span class='text-success p-2'>You have registered successfully.  Please login</span>");

            }

        } else {

           $msg = array( 'error' => true, 'fname_err' => form_error('fname'), 'lname_err' => form_error('lname'), 'repass_err' => form_error('repass'), 'email_err' => form_error('email'), 'password_err' => form_error('password')  );

       }


       echo json_encode($msg);

	}

	public function login(){      

        $lastPage = '';

        $refer =  $this->agent->referrer();

        $a  = explode('/',$refer);

        foreach($a as $k=>$v){

                $lastPage = $v;

        }

        $data['lastPage'] = $refer;



		 

       

        if (!empty($this->input->post('userEmail')) && !empty($this->input->post('userPassword'))) {

            $data['lastPage'] = $this->input->post('lastPage');



            //$email = $this->security->xss_clean($this->input->post('userEmail'));

            //$password = md5($this->security->xss_clean($this->input->post('userPassword')));

            $email = $this->input->post('userEmail');

            $password = md5($this->input->post('userPassword'));

            $table = 'vender';

            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND password="'.$password.'"')->row();

            if($user) {

                if($user->status != 1) {

                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');

                    

                } else {

                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];

                    $this->session->set_userdata($frontUserData);
                    $this->session->set_userdata('session_user_id_temp',$user->id);
                     
                    $cart = $this->cart->contents();

                    $refer = $data['lastPage'];

                    $a  = explode('/',$refer);

                    foreach($a as $k=>$v){

                            $lastPage = $v;

                    }

                    //var_dump($user);

                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Logged in Successfully</span>');

                    if ($lastPage == 'login' || $lastPage == 'registration') {

                        if ($user->user_type == '2') {

                           redirect(base_url('stylist-zone/dashboard'));    

                        }

                        redirect(base_url());    

                    }else{

                        if ($user->user_type == '2') {

                           redirect(base_url('stylist-zone/dashboard'));    

                        }

                        redirect($data['lastPage']);    

                    }

               }

            } else {

                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');

            }

        }

        $this->load->view('Page/login',$data);   

	    

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

    public function forgotPassword(){   

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

                $this->mail->setFrom($this->mail->Username,$this->site->site_name);

                $this->mail->AddAddress($email, $fullName);

                $this->mail->Subject = 'Forgot Password';       

                //$this->mail->addBCC('arpit@gleamingllp.com' ,$this->site->site_name);

                //$this->mail->addCC('joginder@gleamingllp.com' ,$this->site->site_name);

                $mailContent = '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table" style="font-family: Poppins, sans-serif;margin:0;margin:0px">

                    <tr><td style="">

                                <p><b>Hi '.$fullName.',</b></p>

                                <p>Kindly put this OTP while changing the password :  '.$password.'</p>

                                <p>Please find below the link for changing your password. : Link <a href="'.base_url().'login/reset_password"> Please click here</a></p>

                        </td>

                    </tr>

                </table><br/><br/><br/>';



                $mailContent .= ' 

                    

                    <p><b>CONTACT INFO</b></p>

                    <p><b>'.$this->site->site_name.'</b></p>

                    <p>Mobile : '.$this->site->mobile.'</p>

                    <p>Email: '.$this->site->email.'</p>

                    <p>Address: '.$this->site->address.'</p> <img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';

                

                $this->mail->Body = $mailContent;

                $mailsend =  $this->mail->send();

                if($mailsend) {

                    $this->db->where('email', $email);

                    $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('Y-m-d H:i:s') ]); 

                    if($update_password) {

                        $this->session->set_flashdata('success',"<span class='text-success mb-3'>Your reset otp has been sent to your email, please make sure to check your JUNK folder if you don’t get it in your inbox.</span>");

                    }

                }

            } else {

                $this->session->set_flashdata('success',"<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");

                $msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");

            }

        }

        $this->load->view('Page/forgot-password');   

	}





    public function reset_password() {

        if($this->session->userdata('userType')) {

            redirect(base_url());

        }

        $postData = $this->input->post();

         

        if($postData){

            $this->load->library('form_validation');

            if($this->input->post('password')==$this->input->post('confirm_password')){

                $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[20]');

                $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');

             

                    $userRow = $this->db->get_where('vender',['otp' => $postData['otp']])->row_array();

                    //echo $this->db->last_query();

                    //var_dump($userRow);

                    if($userRow){

                        $p['password'] = md5($postData['password']);

                        $p['otp'] = '';

                        $this->db->where('otp', $postData['otp']);

                        $update_password = $this->db->update('vender',$p); 

                        //echo $this->db->last_query();

                        $response = array(

                            'status' => 'success',

                            'message' => 'Password has been changed successful. <a href="'.base_url('login').'">Please login</a>',

                        );

                        $this->session->set_flashdata('message', $response);

                        //redirect(base_url('login'));

                    }else{

                        $response = array(

                            'status' => 'success',

                            'message' => 'Wrong Otp',

                        );

                        $this->session->set_flashdata('message', $response);

                    }

                

            }else{

                $response = array(

                    'status' => 'success',

                    'message' => 'Password did not match',

                );

                $this->session->set_flashdata('message', $response);

                //$this->setErrorMessage('success','Password did not match');

            }

        }

        $this->load->view('Page/reset-password');

    }



    public function forgotProcess()

    {

        $this->form_validation->set_rules('email','Email','required|trim|valid_email');

        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');

            

            $msg = array();     

            if( $this->form_validation->run()) { 

	            

	            $email = $this->input->post('email');

	            $result = $this->db->get_where('vender',['email' => $email]);

	            if($result->num_rows() == 1) {

	                   $output = $result->row();   $fullName = $output->fname.' '.$output->lname;

	                   $password  =  $this->random_password();

	                                      

                            $this->mail->setFrom($this->mail->Username,$this->site->site_name);

                            $this->mail->AddAddress($email, $fullName);

                            $this->mail->Subject = 'Forgot Password';		

                            

                            $mailContent = ' 

                            <h3>Forgot Password</h3>

                            <br><br>

                            <p>Dear '.$fullName.', <br><br> Your password successfully update, please change password from user Dashboard section.</p>

                            <br>

                            <p><b>Password:</b> '.$password.'</p>

                            <br>

                            <p><b>CONTACT INFO</b></p>

                            <p><b>'.$this->site->site_name.'</b></p>

		                    <p>Mobile : '.$this->site->mobile.'</p>

                            <p>Email: '.$this->site->email.'</p>

                            <p>Address: '.$this->site->address.'</p> <img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';

                            

                            $this->mail->Body = $mailContent;

                            $mailsend =  $this->mail->send();

                             if($mailsend) {

                                $this->db->where('email', $email);

                                $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('Y-m-d H:i:s') ]); 

                                if($update_password) {

                                    //$this->session->set_flashdata('success','your password successfully update, updated password send on your mail');

	                                 $msg = array('success' => "<span class='text-success mb-3'>Your password successfully update, updated password send on your mail</span>");

	                                //redirect('forgot-password');    

                                }

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

	public function collaborate()

	{  

        if ($this->input->post('name') && $this->input->post('email')) {

             

          $data['name'] = $this->input->post('name');

          $data['email'] = $this->input->post('email');

          $data['subject'] = $this->input->post('subject');

          $data['portfolio_url'] = $this->input->post('portfolio_url');

          $data['message'] = strip_tags($this->input->post('message'));

          $data['created_at'] = date('Y-m-d H:i:s');

          $data['form_name'] = 'collaborate';

          

          $insert =  $this->db->insert('contact-us',$data); 

          if($insert) {

                /* Send email to admin*/

                $mailForm = $data['email'];

                $this->mail->setFrom($mailForm,$data['name']);

                $this->mail->addAddress($this->mail->Username,$this->site->site_name);

                $this->mail->Subject = 'Contact Us Form Query';     

                

                $mailContent = ' 

                <h3>Collaborate with  Us Query</h3>

                <br><br><br>

                <p><b>Name : </b>'.$data['name'].'</p>

                <p><b>Email Id :</b>'.$data['email'].'</p>

                <p><b>Portfolio Url :</b>'.$data['portfolio_url'].'</p>

                <p><b>Message :</b></p>

                <p>'.$data['message'].' </p> 

                <br><br>

                <p><b>Regards</b></p>

                <p>'.$data['name'].'</p> <img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';

               

                $this->mail->Body = $mailContent;

                $admin =  $this->mail->send();

                /* Send email to   user */

                

                

                $to      =  $data['email'];

                $form =  $this->mail->Username;

                $subject =  'Thanks message';

                $mailContent = ' 

                            <h3>Thanks for Contact Us </h3>

                            <br>

                            <p><b>Dear : </b>'.$data['name'].'</p>

                            <p>thanks for contacting us we will get in touch with you shortly</p>

                            <br><br>

                            <p><b>Regards</b></p>

                            <p>'.$this->site->site_name.'</p>

                            <b>CONTACT INFO</b>

                            <p>'.$this->site->mobile.'</p>

                            <p>Email: '.$this->site->email.'</p>

                            <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                          ';

                $headers =  "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $headers .=  "From: StyleBuddy <$form>"  . "\r\n";

                $headers .=  "Reply-To: $form"  . "\r\n";

                mail($to, $subject, $mailContent, $headers);

                if(!$admin) {

                   $array = array('success' => '<span class="alert text-white bg-danger p-2">Something went wrong,try again </span>');

                   $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Something went wrong,try again</span>');

                }else {

                    $array = array('success' => '<span class="text-white bg-info p-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');

                   

                }

                $this->session->set_flashdata('message','<span class="text-white bg-info mb-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');

            

            } else {

                //$array = array('success' => '<span class="alert alert-danger">Something went wrong</span>');

                $this->session->set_flashdata('message','<span class="text-danger mb-2">Something went wrong,try again</span>');

            }

            //redirect(base_url('collaborate-with-us'));        

        }

		$this->load->view('Page/collaborate-with-us');

	}
    public function contact(){   

        if ($this->input->post('name') && $this->input->post('email')) {

             

            $data['name'] = $this->input->post('name');
            
            $data['email'] = $this->input->post('email');
            
            $data['subject'] = $this->input->post('subject');
            
            $data['portfolio_url'] = $this->input->post('url');
            
            $data['message'] = strip_tags($this->input->post('message'));
            
            $data['created_at'] = date('Y-m-d H:i:s');
            
            $data['form_name'] = 'collaborate';

            $inputCaptcha = $this->input->post('captcha');
       	 	$sessCaptcha = $this->session->userdata('captchaTextCode');
       	 	if($inputCaptcha !== $sessCaptcha){
       	 		$response = array(
	                'status' => FALSE,
	                'message' => 'Invalid captcha',
	            );
	            $this->session->set_flashdata('message','<span class="text-white bg-info mb-2">Invalid captcha</span>');
	            $this->session->set_flashdata('register_error', $response);
			}else{

                $insert =  $this->db->insert('contact-us',$data); 
    
                if($insert) {
    
                    /* Send email to admin*/
    
                    $mailForm = $data['email'];
    
                    $this->mail->setFrom($mailForm,$data['name']);
    
                    $this->mail->addAddress($this->mail->Username,$this->site->site_name);
    
                    $this->mail->Subject = 'Contact Us Form Query';     
    
                    
    
                    $mailContent = ' 
    
                    <h3>Collaborate with  Us Query</h3>
    
                    <br><br><br>
    
                    <p><b>Name : </b>'.$data['name'].'</p>
    
                    <p><b>Email Id :</b>'.$data['email'].'</p>
    
                    <p><b>Portfolio Url :</b>'.$data['portfolio_url'].'</p>
    
                    <p><b>Message :</b></p>
    
                    <p>'.$data['message'].' </p> 
    
                    <br><br>
    
                    <p><b>Regards</b></p>
    
                    <p>'.$data['name'].'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;"> ';
    
                   
    
                    $this->mail->Body = $mailContent;
    
                    $admin =  $this->mail->send();
    
                    /* Send email to   user */
    
                   
    
                    $to      =  $data['email'];
    
                    $form =  $this->mail->Username;
    
                    $subject =  'Thanks message';
    
                    $mailContent = ' 
    
                                <h3>Thanks for Contact Us </h3>
    
                                <br>
    
                                <p><b>Dear : </b>'.$data['name'].'</p>
    
                                <p>thanks for contacting us we will get in touch with you shortly</p>
    
                                <br><br>
    
                                <p><b>Regards</b></p>
    
                                <p>'.$this->site->site_name.'</p>
    
                                <b>CONTACT INFO</b>
    
                                <p>'.$this->site->mobile.'</p>
    
                                <p>Email: '.$this->site->email.'</p>
    
                                <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">
    
                              ';
    
                    $headers =  "MIME-Version: 1.0" . "\r\n";
    
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
                    $headers .=  "From: StyleBuddy <$form>"  . "\r\n";
    
                    $headers .=  "Reply-To: $form"  . "\r\n";
    
                    mail($to, $subject, $mailContent, $headers);
    
                    if(!$admin) {
    
                       $array = array('success' => '<span class="alert text-white bg-danger p-2">Something went wrong,try again </span>');
    
                       $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Something went wrong,try again</span>');
    
                    }else {
    
                        $array = array('success' => '<span class="text-white bg-info p-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');
    
                       
    
                    }
    
                    $this->session->set_flashdata('message','<span class="text-white bg-info mb-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');
    
                
    
                } else {
    
                    //$array = array('success' => '<span class="alert alert-danger">Something went wrong</span>');
    
                    $this->session->set_flashdata('message','<span class="text-danger mb-2">Something went wrong,try again</span>');
    
                }
			}
            //redirect(base_url('collaborate-with-us'));        

        }

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "contact-us" and status=1')->row();

        if($list) {

            $data1['seoData'] = $list;

        }

        $this->load->view('Page/contact-us',$data1);

    }

	public function contact_develop(){   

        if ($this->input->post('name') && $this->input->post('email')) {

             

          $data['name'] = $this->input->post('name');

          $data['email'] = $this->input->post('email');

          $data['subject'] = $this->input->post('subject');

          $data['portfolio_url'] = $this->input->post('url');

          $data['message'] = strip_tags($this->input->post('message'));

          $data['created_at'] = date('Y-m-d H:i:s');

          $data['form_name'] = 'collaborate';

          

          $insert =  $this->db->insert('contact-us',$data); 

          if($insert) {

                /* Send email to admin*/

                $mailForm = $data['email'];

                $this->mail->setFrom($mailForm,$data['name']);

                $this->mail->addAddress($this->mail->Username,$this->site->site_name);

                $this->mail->Subject = 'Contact Us Form Query';     

                

                $mailContent = ' 

                <h3>Collaborate with  Us Query</h3>

                <br><br><br>

                <p><b>Name : </b>'.$data['name'].'</p>

                <p><b>Email Id :</b>'.$data['email'].'</p>

                <p><b>Portfolio Url :</b>'.$data['portfolio_url'].'</p>

                <p><b>Message :</b></p>

                <p>'.$data['message'].' </p> 

                <br><br>

                <p><b>Regards</b></p>

                <p>'.$data['name'].'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;"> ';

               

                $this->mail->Body = $mailContent;

                $admin =  $this->mail->send();

                /* Send email to   user */

               

                $to      =  $data['email'];

                $form =  $this->mail->Username;

                $subject =  'Thanks message';

                $mailContent = ' 

                            <h3>Thanks for Contact Us </h3>

                            <br>

                            <p><b>Dear : </b>'.$data['name'].'</p>

                            <p>thanks for contacting us we will get in touch with you shortly</p>

                            <br><br>

                            <p><b>Regards</b></p>

                            <p>'.$this->site->site_name.'</p>

                            <b>CONTACT INFO</b>

                            <p>'.$this->site->mobile.'</p>

                            <p>Email: '.$this->site->email.'</p>

                            <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                          ';

                $headers =  "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $headers .=  "From: StyleBuddy <$form>"  . "\r\n";

                $headers .=  "Reply-To: $form"  . "\r\n";

                mail($to, $subject, $mailContent, $headers);

                if(!$admin) {

                   $array = array('success' => '<span class="alert text-white bg-danger p-2">Something went wrong,try again </span>');

                   $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Something went wrong,try again</span>');

                }else {

                    $array = array('success' => '<span class="text-white bg-info p-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');

                   

                }

                $this->session->set_flashdata('message','<span class="text-white bg-info mb-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');

            

            } else {

                //$array = array('success' => '<span class="alert alert-danger">Something went wrong</span>');

                $this->session->set_flashdata('message','<span class="text-danger mb-2">Something went wrong,try again</span>');

            }

            //redirect(base_url('collaborate-with-us'));        

        }

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "contact-us" and status=1')->row();

        if($list) {

            $data1['seoData'] = $list;

        }

        $this->load->view('Page/contact-us-develop',$data1);

    }

    public function process()

	{

	       $this->form_validation->set_rules('name', 'Name', 'required|trim');

	       $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

	       $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	     

	        $array = array(); 

	        if($this->form_validation->run()) { 

	              $data['name'] = $this->input->post('name');

	              $data['email'] = $this->input->post('email');

	              $data['subject'] = $this->input->post('subject');

                  $data['portfolio_url'] = $this->input->post('portfolio_url');

	              $data['message'] = strip_tags($this->input->post('message'));

	              $data['created_at'] = date('Y-m-d H:i:s');

                  $data['form_name'] = 'contact';

                  $insert =  $this->db->insert('contact-us',$data); 

                  if($insert) {

                        /* Send email to admin*/

                        $mailForm = $data['email'];

                        $this->mail->setFrom($mailForm,$data['name']);

                        $this->mail->addAddress($this->mail->Username,$this->site->site_name);

                        $this->mail->Subject = 'Contact Us Form Query';		

                    	

                    	$mailContent = ' 

                        <h3>Contact Us Query</h3>

                        <br><br><br>

                        <p><b>Name : </b>'.$data['name'].'</p>

                        <p><b>Email Id :</b>'.$data['email'].'</p>

                        <p><b>Portfolio Url :</b>'.$data['portfolio_url'].'</p>

                        <p><b>Message :</b></p>

                        <p>'.$data['message'].' </p> 

                        <br><br>

                        <p><b>Regards</b></p>

                        <p>'.$data['name'].'</p> <img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';

                       

                        $this->mail->Body = $mailContent;

                        $admin =  $this->mail->send();

                        /* Send email to   user */

                        $to      =  $data['email'];

                        $form =  $this->mail->Username;

                        $subject =  'Thanks message';

                        $mailContent = ' 

                                    <h3>Thanks for Contact Us </h3>

                                    <br>

                                    <p><b>Dear : </b>'.$data['name'].'</p>

                                    <p>thanks for contacting us we will get in touch with you shortly</p>

                                    <br><br>

                                    <p><b>Regards</b></p>

                                    <p>'.$this->site->site_name.'</p>

                                    <b>CONTACT INFO</b>

        		                    <p>'.$this->site->mobile.'</p>

                                    <p>Email: '.$this->site->email.'</p>

                                    <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                                  ';

                        $headers =  "MIME-Version: 1.0" . "\r\n";

                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        $headers .=  "From: StyleBuddy <$form>"  . "\r\n";

                        $headers .=  "Reply-To: $form"  . "\r\n";

                        mail($to, $subject, $mailContent, $headers);

                        if(!$admin) {

                           $array = array('success' => '<span class="alert text-white bg-danger p-2">Something went wrong,try again </span>');

                        }else {

                            $array = array('success' => '<span class="text-white bg-info p-2">Thank you for contacting Style Buddy. We will get back to you shortly</span>');

                        }

                      // $array = array('success' => "<span class='text-primary mt-3'>Thank you for contacting Style Buddy. We will get back to you shortly.</span>");

                  } else {

                       //$array = array('success' => '<span class="alert alert-danger">Something went wrong</span>');

                  }

                  

	        }  else {

	             $array = array('error'=> true, 'name_err' => form_error('name'), 'email_err' => form_error('email') );

	        }

	       echo json_encode($array);

	}

	public function userLogin()

	{  

        $postData = $this->input->post();

	    $this->form_validation->set_rules('userEmail','Email','required|trim|valid_email');

        $this->form_validation->set_rules('userPassword','Password','required|trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');

       

        if( $this->form_validation->run() == false) {

           //$msg = array( 'error' => true, 'email_err' => form_error('email'), 'password_err' => form_error('userPassword')  );

            //redirect('login');

	    } else {

            $email = $this->security->xss_clean($this->input->post('userEmail'));

            $password = md5($this->security->xss_clean($this->input->post('userPassword')));

            $table = 'vender';

            $user = $this->Page_Model->login_chk($email,$password,$table);

            if($user) {

                if($user->status != 1) {

                    $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');

                    redirect('login');

                } else {

                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'userId'=>$user->id, 'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];

                    

                    $this->session->set_userdata($frontUserData);
                    $this->session->set_userdata('session_user_id_temp',$user->id);
                    

                    $cart = $this->cart->contents();

                    if ($user->user_type == '3') {

                       redirect('stylist-zone/dashboard'); 

                    }

                    redirect($postData['lastPage']);    

                    

               }

            } else {

                $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');

                redirect('login');

            }

	    }

	}

    public function job()

    {   

        $data['datas'] = $this->db->get_where('career',['status'=> 1])->result();

        $this->load->view('Page/job-board',$data);

    }

    public function jobDetails($slug)

    {   

        $data['datas'] = $this->db->get_where('career',['jobSlug'=> $slug])->row();

        if($data['datas']) {

          $this->load->view('Page/jobs-details',$data);

        } else {

            redirect('job-board');

        }  

    }

    public function howItWork()

    {

        $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result(); 

        $this->load->view('Page/how-it-works',$data);

    }

    public function bookOnline()

    {   

        $this->db->select('fashon_consulting.*,fashion_services.name,fashion_services.slug');

        $this->db->from('fashon_consulting');

        $this->db->join('fashion_services', 'fashion_services.id = fashon_consulting.service_id');

        $this->db->where('fashion_services.status',1);

        $data['datas'] = $this->db->get()->result();

        $this->load->view('Page/book-online',$data);

    }

    public function bookNows($slug)

    {   

        $this->db->select('fashon_consulting.*,fashion_services.name,fashion_services.slug');

        $this->db->from('fashon_consulting');

        $this->db->join('fashion_services', 'fashion_services.id = fashon_consulting.service_id');

        $this->db->where('fashion_services.slug',$slug); $data['datas'] = 
        $this->db->get()->row();

         

        //$data['datas'] = $this->db->get_where('fashion_services',['slug'=> $slug])->row();     

        if($data['datas']) {

                $this->load->view('Page/book-now',$data);    

        } else {

            redirect('book-online');

        }

    }

    public function bookNowsPrecess()

    {

          $booknow['consulting_id'] = $this->input->post('id');

          $booknow['date'] = $this->input->post('date');

          $booknow['time'] = $this->input->post('time');

          $booknow['staff'] = $this->input->post('staff');

          $booknow['price'] = $this->input->post('price');

          $booknow['name'] = $this->input->post('name');

          $booknow['meetingHour'] = $this->input->post('meetingHour');

          $this->session->set_userdata($booknow);

          $array = array('status'=> true, 'redirect' => 'booking-form');

          echo json_encode($array);         

    }

    public function bookForm(){   

        if(!empty( $this->session->userdata('consulting_id') )) {

            $data['callback_url']       = base_url().'razorpay/fashon_consulting_booking';

            $data['surl']               = base_url().'razorpay/fashion_success';;

            $data['furl']               = base_url().'razorpay/fashion_failed';;

            $data['currency_code']      = 'INR';



            $this->load->view('Page/booking-form',$data);

        } else {

            redirect('book-online');

        }    

    }

    public function bookProcess()

    {

          $insert['consulting_id'] = $this->session->userdata('consulting_id');

          $insert['date'] = $this->session->userdata('date');

          $insert['time'] = $this->session->userdata('time');

          $insert['staff'] = $this->session->userdata('staff');

          $insert['price'] = $this->session->userdata('price');

          $insert['service_name'] = $this->session->userdata('name');

          $insert['meetingHour'] = $this->session->userdata('meetingHour');

          $insert['fname'] = $this->input->post('fname');

          $insert['lname'] = $this->input->post('lname');

          $insert['mobile'] = $this->input->post('mobile');

          $insert['email'] = $this->input->post('email');

          $insert['address'] = $this->input->post('address');

          $insert['country'] = $this->input->post('country');

          $insert['state'] = $this->input->post('state');

          $insert['city'] = $this->input->post('city');

          $insert['pinecode'] = $this->input->post('pinecode');

          $insert['requiremnt'] = $this->input->post('requiremnt');

          $insert['age'] = $this->input->post('age');

          $insert['favorite_color'] = $this->input->post('favorite_color'); 

          $this->db->insert('fashon_consulting_booking',$insert);

          $bookingId = $this->db->insert_id();  

          $this->session->set_userdata(['bookingId' => $bookingId ]);

          //$this->session->unset_userdata($booknow);

          echo json_encode(['status'=> true, 'redirect' => base_url('booking-checkout')]);

    }

    public function bookCheckout()

    {   

        $this->session->unset_userdata('consulting_id,date,time,staff,price,name,meetingHour');

        $bookingId = $this->session->userdata('bookingId');

        $data['bookingData'] = $this->db->get_where('fashon_consulting_booking',['id'=> $bookingId])->row();

                

        /* Send email to   user */

            $to      =  $data['bookingData']->email;

            $form =  $this->mail->Username;

            $subject =  'Thanks for booking!';

            $mailContent = ' 

                        <h3>hi</h3>

                        <br>

                        <p><b>Dear : </b>'.$data['bookingData']->fname.' '.$data['bookingData']->fname.'</p>

                        <p>Here are the details:</p>

                        <p>'.$data['bookingData']->service_name.' with '.$data['bookingData']->staff.'</p>

                        <br><br>

                        <p><b>Regards</b></p>

                        <p>'.$this->site->site_name.'</p>

                        <b>CONTACT INFO</b>

	                    <p>'.$this->site->mobile.'</p>

                        <p>Email: '.$this->site->email.'</p>

                        <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                      ';

            $headers =  "MIME-Version: 1.0" . "\r\n";

            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .=  "From: StyleBuddy <$form>"  . "\r\n";

            $headers .=  "Reply-To: $form"  . "\r\n";

            mail($to, $subject, $mailContent, $headers);



        

        $this->load->view('Page/booking-checkout',$data);

        

    }

    public function theme()

    {   

        $data['datas'] = $this->db->get_where('theme',['status'=> 1])->result();

        $this->load->view('Page/theme',$data);

    }

    public function services(){  
       $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result();    
       $this->load->view('Page/services',$data);
    }

    public function servicesDetails($slug){  

        $data['datas'] = $datas = $this->db->get_where('our_services',['slug'=> $slug])->row();

        $id = $datas->id;
        if($id){
           $data['privious'] = $this->db->query("SELECT * FROM our_services WHERE id < $id ORDER BY id DESC LIMIT 1")->row();

           $data['next'] = $this->db->query("SELECT * FROM our_services WHERE id > $id ORDER BY id DESC LIMIT 1")->row();

             $list = $this->db->query('select meta_title,meta_keyword,meta_description from our_services where slug = "'.$slug.'"')->row();

            if($list) {

                $data['seoData'] = $list;

            }
        }
       

       

        

       if(!empty($data['datas'])) {
            $data['parentCategory'] = $this->data['parentCategory'];
            $this->load->view('Page/services-details',$data);

       } else {

           redirect();

       }  
    }


    public function services_develop(){  
       $data['datas'] = $this->db->get_where('our_services',['status'=> 1])->result();    
       $this->load->view('Page/services-develop',$data);
    }


   

    


    public function servicesDetails_develop($slug){  

       $data['datas'] = $this->db->get_where('our_services',['slug'=> $slug])->row();

       $id = $data['datas']->id;

       $data['privious'] = $this->db->query("SELECT * FROM our_services WHERE id < $id ORDER BY id DESC LIMIT 1")->row();

       $data['next'] = $this->db->query("SELECT * FROM our_services WHERE id > $id ORDER BY id DESC LIMIT 1")->row();

       

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from our_services where slug = "'.$slug.'"')->row();

        if($list) {

            $data['seoData'] = $list;

        }

        

       if(!empty($data['datas'])) {

           $this->load->view('Page/the-perfect-shoot-develop',$data);

       } else {

           redirect();

       }  
    }

    public function servicesForm(){

        $data['callback_url']       = base_url().'razorpay/intial_booking_form';

        $data['surl']               = base_url().'razorpay/success';;

        $data['furl']               = base_url().'razorpay/failed';;

        $data['currency_code']      = 'INR';
        $loggedRow = array();
        if ($this->session->userdata('userId')) {
            $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();
        }
        
        $data['loggedRow'] = $loggedRow;

        $this->load->view('Page/intialbookingform',$data);

    }

	public function styleingService($a = false)

	{   

        $data['states']  = $this->db->get('states')->result();

        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise');

        

        $config = array();

        $this -> load -> library('pagination');

	    $query = $this->db->get_where('vender',['status'=> 1 ]);

	    $rowCount  = $query->num_rows();

	    $par_page = 15; 

	   

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

	    $config['base_url'] = base_url('styling-and-image-management-services');

	    $config['per_page']    = $par_page;

		$config['uri_segment'] = 2;

		$config['use_page_numbers'] = true;

	    $this->pagination->initialize($config); 

	    

	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

	    if($page != 0){ $page = ($page-1) * $par_page; }

	    

	    $this->db->limit($par_page, $page);

	    $this->db->where('status',1);

	    $this->db->order_by('id',"desc");  

        $data['venders'] = $this->db->get('vender')->result(); 

       

        $data["p_links"] = $this->pagination->create_links();

		$this->load->view('Page/styling-and-image-management-services',$data);

	}

	public function stylistSearch(){

	  $stylist = $this->input->post('stylist');

	   

      $this->db->select('vender.fname,vender.lname,vender.id');

      $this->db->from("vender");

      $this->db->where('status',1);

      $this->db->like('fname', $stylist);

      //$this->db->or_like('fname', $stylist);

      $this->db->order_by('id', 'DESC'); 

      $value = $this->db->get()->result();

       if(!empty($value)) {

           $result = '';

           $result = "<ul>";

           foreach($value as $value) {

                $result .=  '<li  onclick="selectTitle(\''.$value->fname.' '.$value->lname.'\')" >'.$value->fname.' '.$value->lname.'</li>';

           }

           $result .= "</ul>";

       } else {

           $result = "<ul><li>Stylist not found</li></ul>";

       }

       echo $result;

	}

    

    public function stylistSearchPage_old_durgesh(){

        $expert = $this->input->post('expert');

        $location = $this->input->post('location');

        $fname = explode(' ',$expert); 

        $location = $this->db->get_where('cities',['city'=> $location])->row();

        

        $data['venders'] = $this->db->query("select * from vender where fname =  '".$fname[0]."' ")->result();

        //echo $this->db->last_query();

        $data['states']  = $this->db->get('states')->result();

        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise');

        $this->load->view('Page/stylist-search',$data); 

    }

	

	public function stylistIdea($slug)

	{

	    $slug = base64_decode ($slug);

	    $data['idea_tag']  = $this->Page_Model->fetch_all('idea_tag');

	    $data['ideas'] = $this->db->get_where('ideas',['id'=>$slug])->row();

	    $data['vender'] = $this->db->get_where('vender',['id'=>$data['ideas']->vender_id ])->row();

	    

	    if($data['vender']->city) {

    	        $data['city'] = $this->db->get_where('cities',['id'=>$data['vender']->city])->row();

            }

            //echo $data['vender']->city;

	    if($data['ideas']) {

	        //print_r($data['vender']); 

	        $this->load->view('Page/profile-view',$data);

	    } else {

	        redirect('styling-and-image-management-services');

	    }     

	}

	public function stylistService()

	{

	    $this->load->view('Page/styling-services');

	}
    public function stylistForm(){
         redirect('buy-styling-packages');  
        /*if(!$this->session->userdata('userType')) {
            redirect($postData['lastPage']);  
        }*/

        /*$stylist_dates_availability = $this->db->query('SELECT * FROM stylist_availability')->result_array();
        foreach ($stylist_dates_availability as $key1 => $value1) {
            $venders = $this->db->query('SELECT * FROM vender WHERE status= 1')->result_array();
           
            foreach ($venders as $key => $value) {
               unset($value1['id']);
               unset($value1['stylist_id']);
               $a = array();
               $a = $value1;
               $a['stylist_id'] = $value['id'];
               $this->db->insert('stylist_availability',$a);
           }
        }*/
        


        //
        $venderId = base64_decode(str_replace('uOiEa', '', $this->uri->segment(2)));
        $data11['stylist_id'] = $venderId;
        
         
        $lastPage = '';

        $refer =  $this->agent->referrer();

        $a  = explode('/',$refer);

        foreach($a as $k=>$v){

                $lastPage = $v;

        }

        $data11['lastPage'] = $refer;

        $postData = $this->input->post();

        //var_dump($postData);

        if ($postData) {

                $data['stylist_id'] = base64_decode(str_replace('uOiEa', '', $this->input->post('stylist_id')));

                $data['date_id'] = $date_id = $this->input->post('date_id');

                /*$stylist_datesRow = $this->db->query('SELECT * FROM stylist_availability WHERE id ='.$date_id)->row_array();

                $ddd = '';
                if($stylist_datesRow){
                    $ddd = date('Y-m-d h:i A',strtotime($stylist_datesRow['availability_datetime']));
                    $this->db->update('stylist_availability',array('status'=>0),array('id'=>$date_id));
                }*/


                $data['fname'] = $this->input->post('fname');

                $data['lname'] = $this->input->post('lname');

                $data['email'] = $this->input->post('email');

                $data['mobile'] = $this->input->post('mobile');

                $data['city'] = $this->input->post('city');

                $data['area_expertise'] = $this->input->post('area_expertise');

                $data['message'] = $this->input->post('message');

                $data['created_at']  = date('Y-m-d h:i:s');

                

                $insert = $this->db->insert('ask-quote',$data);

                if($insert) {
                    
                     
                    $subject =  $this->site->site_name.' Ask a  quote Details';
                    
                    $mailHeader = '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">';
                    $mailHeader .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
                    $mailHeader .= '<body style="margin:0px;">';
                        $mailHeader .= '<div style="background: linear-gradient( 180deg, #742ea0 30%, #f0f0f0 10%); width:100%;  padding: 50px 0px 10px 0px; margin: auto;">';
                            $mailHeader .= '<div style="width: 70%;margin: 40px auto;background: #FFFFFF;font-family: \'Poppins\', sans-serif; padding: 20px;border-radius: 20px;">';
                                $mailFooter = '<div style="margin-top: 50px;">';
                                    $mailFooter .= '<p style="margin: 0px;"><b>Thank you,</b></p>';
                                    $mailFooter .= '<p style="margin: 0px;">Stylebuddy Team</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Call: '.$this->site->mobile.'</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Email: '.$this->site->email.'</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Address: '.$this->site->address.'</p>';
                                    $mailFooter .= '<p style="text-align: left; padding-left: 0px; margin-top: 10px;"><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 160px;"></p>';
                                $mailFooter .= '</div>';
                                $mailFooter .= '<div style="margin-top:20px;padding-bottom: 1px;background: #ffffff;display: block;">';
                                    $mailFooter .= '<p style=" font-size:20px;line-height: 28px;margin-bottom: 15px;">Follow Us </p>';
                                    $socialArray=   array( array('image'=>'fb.png','name'=>$this->site->facebook), array('image'=>'tw.png','name'=>$this->site->twitter), array('image'=>'youtube.png','name'=>$this->site->youtube),array('image'=>'insta.png','name'=>$this->site->instagram), array('image'=>'linke.png','name'=>$this->site->linkedin));
                                    $mailFooter .= '<p style="margin-top: 0px;">';
                                        foreach($socialArray as $p=>$w){
                                                $mailFooter .= '<a target="_blank" href="'.$w['name'].'"><img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;"></a>';
                                        }
                                    $mailFooter .= '</p>';
                                $mailFooter .= '</div>';
                            $mailFooter .= '</div>';
                        $mailFooter .= '</div>';
                    $mailFooter .= '</body>';
                    
                    $option = ' 
                        <h3>Form Details</h3>
                        <p><b>Name : </b>'.$data['fname'].' '.$data['lname'].'<br/>
                        <b>Email Id : </b>'.$data['email'].'<br/>
                        <b>Mobile : </b>'.$data['mobile'].'<br/>
                        <b>City : </b>'.$data['city'].'<br/>
                        <b>Query : </b>'.$data['area_expertise'].'<br/>
                        <b>Message : </b>'.$data['message'].'</p>
                        ';
                    $option .= '<p>Your request is received. Somebody from the Style Buddy team will contact you within 24 hrs.</p>';
                    
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to = TO_EMAIL;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
                    
                     
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($data['fname'].' '.$data['lname']).'</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to      = $data['email'];
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");

                    
                    $this->session->set_flashdata('success',"<span class='text-success p-2'>Thank you, we have received your information. Our styling desk will call you soon to discuss your requirements. You can also whatsapp us on +919898828200 to discuss your requirements</span>");
                    $this->session->set_flashdata('lastUrl',$postData['lastPage']);

                }

            

        }

        $availability_date = date('Y-m-d');
        $stylist_dates_availability = $this->db->query('SELECT * FROM stylist_availability WHERE stylist_id ='.$venderId.' AND availability_date >= "'.$availability_date.'" AND status=1 ORDER BY availability_date DESC')->result_array();
        $str = array();
        $dates = array();
        foreach($stylist_dates_availability as $key=>$value){
            $str1 = array();
            $str1['title'] = date('h:i A',strtotime($value['availability_start_time'])).' - '.date('h:i A',strtotime($value['availability_end_time']));
            //$str1['display'] = 'background';
            $str1['color'] = 'green';
            $str1['start'] = $value['availability_date'];
            $str1['groupId'] = $value['id'];
            $str1['date_id'] = $value['id'];
            $str1['availability_date'] = $value['availability_date'];
            $str1['availability_time'] = date('h:i A',strtotime($value['availability_time']));
            $str1['start_time'] = date('h:i A',strtotime($value['availability_start_time']));
            $str1['end_time'] = date('h:i A',strtotime($value['availability_end_time']));

            array_push($str,$str1);
            $str1 = array();
            $str1['start'] = $value['availability_date'];
            array_push($dates,$str1);
        }
        $data11['stylist_dates_availability'] = $str;
        $data11['stylist_availability'] = $stylist_dates_availability;


        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 limit 8')->result_array();

        $data11['area_expertise'] = $loggedRow;

        $loggedRow = $this->db->query('select * from cities order by city ASC')->result_array();

        $data11['cities'] = $loggedRow;
        $loggedRow = array();
        if ($this->session->userdata('userId')) {
            $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();
        }
        
        $data11['loggedRow'] = $loggedRow;
        $data11['callback_url']       = base_url().'razorpay/ask_quote_booking';
        $data11['surl']               = base_url().'razorpay/ask_quote_booking_success';;
        $data11['furl']               = base_url().'razorpay/failed';;
        $data11['package_price']      = '499';

        $data11['currency_code']      = 'INR';
	    $this->load->view('Page/ask-for-quote',$data11);

	}



	public function stylistFormBookHome(){
        
        $venderId = base64_decode(str_replace('uOiEa', '', $this->uri->segment(2)));
        $data11['stylist_id'] = $venderId;
        
         
        $lastPage = '';

        $refer =  $this->agent->referrer();

        $a  = explode('/',$refer);

        foreach($a as $k=>$v){

                $lastPage = $v;

        }

        $data11['lastPage'] = $refer;

        $postData = $this->input->post();

        

        if ($postData) {

                $data['stylist_id'] = base64_decode(str_replace('uOiEa', '', $this->input->post('stylist_id')));

                $data['date_id'] = $date_id = $this->input->post('date_id');

                 

                $data['fname'] = $this->input->post('fname');

                $data['lname'] = $this->input->post('lname');

                $data['email'] = $this->input->post('email');

                $data['mobile'] = $this->input->post('mobile');

                $data['city'] = $this->input->post('city');

                $data['area_expertise'] = $this->input->post('area_expertise');

                $data['message'] = $this->input->post('message');

                $data['created_at']  = date('Y-m-d h:i:s');

                

                $insert = $this->db->insert('ask-quote',$data);

                if($insert) {
                    
                     
                    $subject =  $this->site->site_name.' Ask a  quote Details';
                    
                    $mailHeader = '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">';
                    $mailHeader .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
                    $mailHeader .= '<body style="margin:0px;">';
                        $mailHeader .= '<div style="background: linear-gradient( 180deg, #742ea0 30%, #f0f0f0 10%); width:100%;  padding: 50px 0px 10px 0px; margin: auto;">';
                            $mailHeader .= '<div style="width: 70%;margin: 40px auto;background: #FFFFFF;font-family: \'Poppins\', sans-serif; padding: 20px;border-radius: 20px;">';
                                $mailFooter = '<div style="margin-top: 50px;">';
                                    $mailFooter .= '<p style="margin: 0px;"><b>Thank you,</b></p>';
                                    $mailFooter .= '<p style="margin: 0px;">Stylebuddy Team</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Call: '.$this->site->mobile.'</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Email: '.$this->site->email.'</p>';
                                    $mailFooter .= '<p style="margin: 0px;">Address: '.$this->site->address.'</p>';
                                    $mailFooter .= '<p style="text-align: left; padding-left: 0px; margin-top: 10px;"><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 160px;"></p>';
                                $mailFooter .= '</div>';
                                $mailFooter .= '<div style="margin-top:20px;padding-bottom: 1px;background: #ffffff;display: block;">';
                                    $mailFooter .= '<p style=" font-size:20px;line-height: 28px;margin-bottom: 15px;">Follow Us </p>';
                                    $socialArray=   array( array('image'=>'fb.png','name'=>$this->site->facebook), array('image'=>'tw.png','name'=>$this->site->twitter), array('image'=>'youtube.png','name'=>$this->site->youtube),array('image'=>'insta.png','name'=>$this->site->instagram), array('image'=>'linke.png','name'=>$this->site->linkedin));
                                    $mailFooter .= '<p style="margin-top: 0px;">';
                                        foreach($socialArray as $p=>$w){
                                                $mailFooter .= '<a target="_blank" href="'.$w['name'].'"><img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;"></a>';
                                        }
                                    $mailFooter .= '</p>';
                                $mailFooter .= '</div>';
                            $mailFooter .= '</div>';
                        $mailFooter .= '</div>';
                    $mailFooter .= '</body>';
                    
                    $option = ' 
                        <h3>Form Details</h3>
                        <p><b>Name : </b>'.$data['fname'].' '.$data['lname'].'<br/>
                        <b>Email Id : </b>'.$data['email'].'<br/>
                        <b>Mobile : </b>'.$data['mobile'].'<br/>
                        <b>City : </b>'.$data['city'].'<br/>
                        <b>Query : </b>'.$data['area_expertise'].'<br/>
                        <b>Message : </b>'.$data['message'].'</p>
                        ';
                    $option .= '<p>Your request is received. Somebody from the Style Buddy team will contact you within 24 hrs.</p>';
                    
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to = TO_EMAIL;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
                    
                     
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($data['fname'].' '.$data['lname']).'</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to      = $data['email'];
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");

                    
                    $this->session->set_flashdata('success',"<span class='text-success p-2'>Thank you, we have received your information. Our styling desk will call you soon to discuss your requirements. You can also whatsapp us on +919898828200 to discuss your requirements</span>");
                    $this->session->set_flashdata('lastUrl',$postData['lastPage']);

                }

            

        }

         


        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 limit 8')->result_array();

        $data11['area_expertise'] = $loggedRow;

        $loggedRow = $this->db->query('select * from cities order by city ASC')->result_array();

        $data11['cities'] = $loggedRow;
        $loggedRow = array();
        if ($this->session->userdata('userId')) {
            $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();
        }
        
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "buy-styling-packages"')->row();
        $data11['seoData'] = $list;
            
        $data11['loggedRow'] = $loggedRow;
        /*$data11['callback_url']       = base_url().'razorpay/ask_quote_booking';
        $data11['surl']               = base_url().'razorpay/ask_quote_booking_success';;
        $data11['furl']               = base_url().'razorpay/failed';;*/
        
        $data11['currency_code']      = 'INR';
        //$data11['package_price']      = '499';
        
        $data11['consult_callback_url']       = base_url().'razorpay/consult_booking';
        $data11['consult_surl']               = base_url().'razorpay/consult_booking_success';;
        $data11['consult_furl']               = base_url().'razorpay/failed';
	    $this->load->view('Page/book-stylist-sesion',$data11);

	}
    public function buypackage()    {
        if(!$this->uri->segment(3)){
            redirect(base_url('buy-styling-packages'));
        }else{
            $segment3 = $this->uri->segment(3);
            $table = 'consult_plan';
            $condition = " WHERE id != '0' AND status = 1 ";
            $condition .= " AND id = '".base64_decode($segment3)."'";
            $condition .= " order by id ASC";
            $consult_plan = $this->common_model->get_all_details_query($table,$condition)->row_array();
            if (!$consult_plan) {
                redirect(base_url('buy-styling-packages'));
            }
            $table = 'consult_question';
            $condition = " WHERE status = '1' order by id ASC";
            $list = $this->common_model->get_all_details_query($table,$condition)->result_array();
            $consult_plan_question = $list;
            $data11['consult_plan_question'] = $consult_plan_question;
            $data11['consult_plan'] = $consult_plan;

            $loggedRow = array();
            if ($this->session->userdata('userId')) {
                $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();
            }
            
            $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "buy-styling-packages"')->row();
            $data11['seoData'] = $list;


            $data11['loggedRow'] = $loggedRow;

            $data11['currency_code']      = 'INR';
            
            $data11['consult_callback_url']       = base_url().'razorpay/consult_booking';
            $data11['consult_surl']               = base_url().'razorpay/consult_booking_success';;
            $data11['consult_furl']               = base_url().'razorpay/failed';
            $this->load->view('Page/checkout-buy-package',$data11);  
        } 

        
    }


    public function cities()    { 

        $city_name = $this->input->get('term');

        $where = "  where city LIKE '%". $city_name ."%'";

        //$where = "";

        $query = $this->db->query("select * from cities".$where);

        $list = $query->result(); 

        $result1 = array();

        if(!empty($list)) {

            foreach($list as $value) {

                $companyLabel['value'] = html_entity_decode($value->city);

                $companyLabel['id'] = html_entity_decode(base64_encode($value->city));

                array_push( $result1, $companyLabel);

            }

        }



        echo json_encode( $result1 );

    }





	public function quoteSbumit() {

	    

	    $this->form_validation->set_rules('fname', 'First Name', 'required|trim'); 

	    $this->form_validation->set_rules('lname', 'Last Name', 'required|trim'); 

	    $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|min_length[10]'); 

	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_rules('city', 'city', 'required');

	    $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

	     

	    $msg = '';

	    if($this->form_validation->run()) {

	            $data['stylist_id'] = base64_decode(str_replace('uOiEa', '', $this->input->post('stylist_id')));

                $data['fname'] = $this->input->post('fname');

	            $data['lname'] = $this->input->post('lname');

	            $data['email'] = $this->input->post('email');

	            $data['mobile'] = $this->input->post('mobile');

	            $data['city'] = $this->input->post('city');

                $data['message'] = $this->input->post('message');

	            $data['created_at']  = date('Y-m-d h:i:s');

	            

	            $insert = $this->db->insert('ask-quote',$data);

	            if($insert) {

	                

	                /* Send email to admin*/

                    $mailForm = $data['email'];

                    $this->mail->setFrom($mailForm);

                    $this->mail->addAddress($this->mail->Username,$this->site->site_name);

                    $this->mail->Subject = 'Ask a  quote Details';		

                	$mailContent = ' 

                    <h3>Form Details</h3>

                    <br><br>

                    <p><b>Name :</b>'.$data['fname'].' '.$data['lname'].'</p>

                    <p><b>Email Id :</b>'.$data['email'].'</p>

                    <p><b>Mobile :</b>'.$data['mobile'].'</p>

                    <br><br><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                    ';

                    $this->mail->Body = $mailContent;

                    $admin =  $this->mail->send();

                    

                    /* Send email to   user */

                    $to      =  $data['email'];

                    $form =  $this->mail->Username;

                    $subject =  'Thanks Message';

                    $mailContent = ' 

                            <p><b>Dear : </b>'.$data['fname'].' '.$data['lname'].'</p>

                            <p>Welcome to Style Buddy. We hope that you will enjoy the journey.</p>

                            <p>one of our team members will contact you shortly...</p>

                            <p><b>Regards</b></p>

                            <p>'.$this->site->site_name.'</p>

                            <b>CONTACT INFO</b>

		                    <p>'.$this->site->mobile.'</p>

                            <p>Email: '.$this->site->email.'</p>

                            <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                          ';

                $headers =  "MIME-Version: 1.0" . "\r\n";

                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $headers .=  "From: Style Buddy <$form>"  . "\r\n";

                $headers .=  "Reply-To: $form"  . "\r\n";

                mail($to, $subject, $mailContent, $headers);

                

	                $msg = array('success' => "<span class='text-success p-2'>Thank you, we have received your information. Our styling desk will call you soon to discuss your requirements. You can also whatsapp us on +919898828200 to discuss your requirements</span>");

	            }

	    } else {

	        $msg = array( 'error' => true, 'fname_err' => form_error('fname'), 'lname_err' => form_error('lname'), 'mobile_err' => form_error('mobile'), 'email_err' => form_error('email') , 'city_err' => form_error('city')  );

	     }

	  echo json_encode($msg);

	}

	public function serviceDetails()

	{

	    $this->load->view('Page/services-detail');

	}

	//BLOG\\

	public function archive()

	{

	        //$data['archives'] = $this->db->query("SELECT MONTHNAME(`created_at`) as fullmonth, YEAR(`created_at`) as year , MONTH(`created_at`) as month FROM `blog` GROUP BY Month(`created_at`), Year(`created_at`) order BY YEAR(`created_at`) DESC")->result();     

            $data['archives'] = $this->db->query("SELECT MONTHNAME(`created_at`) as fullmonth, YEAR(`created_at`) as year , MONTH(`created_at`) as month FROM `blog` order BY YEAR(`created_at`) DESC")->result();     

	        $data['tags']  = $this->db->order_by('tagName', 'ASC')->get_where('blogTags',['status'=>1])->result();  

	        

	        $category  = $this->db->order_by('blogCategoryName', 'ASC')->get_where('blogCategory',['status'=>1])->result();

	        foreach($category as $key => $value) {

	            $countAll = $this->db->where('category_id',$value->id)->from("blog")->count_all_results();

	            $category[$key]->categoryCount = $countAll;

	        }

	        $data['categorys'] = $category;

	        return  $data;

	}

	public function styleStory($slug = ''){       

            $this->form_validation->set_rules('comment_name', 'Name', 'required|trim');

            $this->form_validation->set_rules('comment_message', 'Message', 'required|trim');

            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

    

            $array = array(); 

            if($this->form_validation->run()) { 

                $data['form_id'] = $this->input->post('blog_id');

                $data['email'] = $this->input->post('email');

                $data['name'] = $this->input->post('comment_name');

                $data['message'] = strip_tags($this->input->post('comment_message'));

                $data['created_at'] = date('Y-m-d H:i:s');

                $data['form_name'] = 'Blog Form';

                $insert =  $this->db->insert('contact-us',$data); 

                if($insert) {

                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Thank you for comment Style Buddy. We will get back to you shortly</span><br/>');

                } else {

                    $this->session->set_flashdata('success', '<span class="alert alert-danger">Something went wrong</span>');

                }

            }

            

	       $data = $this->archive();

	       $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-stories"')->row();

	 

            if($list) {

                $data['seoData'] = $list;

            }

            $loggedRow = array();

            if($this->session->userdata('userId')){

                $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();

            }

            $data['loggedRow'] = $loggedRow;



	       if($slug == '') { 

    	       
                $blogs = $this->common_model->get_all_details_query('blog',' where status = 1 order BY ID desc')->result();
                foreach($blogs as $k=>$v){
                    if($v->vender_id){
                        $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();
                        $blogs[$k]->fname = $d['fname'];
                        $blogs[$k]->lname = $d['lname'];
                    }else{
                        $blogs[$k]->fname = 'ADIMN';
                        $blogs[$k]->lname = '';
                    }
                }
                $data['datas'] = $blogs;
                
    		    $this->load->view('Page/style-stories',$data);

	       }  else {

    	      

    		    $blogs = $this->common_model->get_all_details_query('blog',' where blogSlug = "'.$slug.'" AND status = 1')->row();
    		    if($blogs) {
        		    if($blogs->vender_id){
                        $d = $this->common_model->get_all_details_query('vender','WHERE id='.$blogs->vender_id.'')->row_array();
                        $blogs->fname = $d['fname'];
                        $blogs->lname = $d['lname'];
                    }else{
                        $blogs->fname = 'ADIMN';
                        $blogs->lname = '';
                    }
                    
                    
                    $data['datas'] = $blogs;
                    $data['seoData'] = $blogs;
                    if($blogs->meta_title){
                        $data['seoData'] = $blogs;
                    }else{
                        $list = array();
                        $list['meta_title'] = $blogs->blogTitle;
                        $list['meta_description'] = '';
                        $list['meta_keyword'] = '';
                        
                        $data['seoData'] = (object)$list; 
                    }
                    
                    
                    
                    $this->load->view('Page/style-stories-details',$data);

    		    } else {

    		        redirect();

    		    }     

	       }
	}
    public function styleStoryCat($catSlug){   
        $data = $this->archive();
        $this->db->select('blog.*, blogCategory.blogCategoryName'); 
        $this->db->from('blog');
        $this->db->join('blogCategory', 'blogCategory.id = blog.category_id');
        $this->db->where(['blog.status'=>1]);
        $this->db->where(['blogCategory.blogCategorySlug' =>  $catSlug ]);
        $this->db->order_by("blog.id", "desc");
        $blogs  = $this->db->get()->result();
        
        //$blogs = $this->common_model->get_all_details_query('blog',' where status = 1 AND blogCategorySlug = "'.$catSlug.'" order BY ID desc')->result();
        foreach($blogs as $k=>$v){
            if($v->vender_id){
                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();
                $blogs[$k]->fname = $d['fname'];
                $blogs[$k]->lname = $d['lname'];
            }else{
                $blogs[$k]->fname = 'ADIMN';
                $blogs[$k]->lname = '';
            }
        }
        $data['datas'] = $blogs;
        

        

        

        $this->load->view('Page/style-stories-categories',$data);
    }
    public function styleStoryTag($tagSlug){

        $data = $this->archive();
        $this->db->select('blog.*, blogCategory.blogCategoryName, blogTags.tagName '); 
        $this->db->from('blog');
        $this->db->join('blogCategory', 'blogCategory.id = blog.category_id');
        //$this->db->join('vender', 'vender.id = blog.vender_id');
        $this->db->join('blogTags', 'blogTags.id = blog.tag_id');
        $this->db->where(['blog.status'=>1]);
        $this->db->where(['blogTags.tagSlug' =>  $tagSlug ]);
        $this->db->order_by("blog.id", "desc");
        $blogs  = $this->db->get()->result();
        foreach($blogs as $k=>$v){
            if($v->vender_id){
                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();
                $blogs[$k]->fname = $d['fname'];
                $blogs[$k]->lname = $d['lname'];
            }else{
                $blogs[$k]->fname = 'ADIMN';
                $blogs[$k]->lname = '';
            }
        }
        $data['datas'] = $blogs;
        $this->load->view('Page/style-stories-tag',$data);
    }
    public function styleStoryArchive($year,$month){
        $data = $this->archive();
        $this->db->select('blog.*'); 
        $this->db->from('blog');
        $this->db->where(['blog.status'=>1]);
        $this->db->where(["month(blog.`created_at`)"=> $month ]);
        $this->db->where(["year(blog.`created_at`)"=> $year ]);
        $this->db->order_by("blog.id", "desc");
        $blogs  = $this->db->get()->result();
        foreach($blogs as $k=>$v){
            if($v->vender_id){
                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();
                $blogs[$k]->fname = $d['fname'];
                $blogs[$k]->lname = $d['lname'];
            }else{
                $blogs[$k]->fname = 'ADIMN';
                $blogs[$k]->lname = '';
            }
        }
        $data['datas'] = $blogs;
        
         
        
        $this->load->view('Page/style-stories-archives',$data);
    }




    public function styleStory_develop($slug = ''){       

            $this->form_validation->set_rules('comment_name', 'Name', 'required|trim');

            $this->form_validation->set_rules('comment_message', 'Message', 'required|trim');

            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

    

            $array = array(); 

            if($this->form_validation->run()) { 

                $data['form_id'] = $this->input->post('blog_id');

                $data['email'] = $this->input->post('email');

                $data['name'] = $this->input->post('comment_name');

                $data['message'] = strip_tags($this->input->post('comment_message'));

                $data['created_at'] = date('Y-m-d H:i:s');

                $data['form_name'] = 'Blog Form';

                $insert =  $this->db->insert('contact-us',$data); 

                if($insert) {

                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Thank you for comment Style Buddy. We will get back to you shortly</span>');

                } else {

                    $this->session->set_flashdata('success', '<span class="alert alert-danger">Something went wrong</span>');

                }

            }

            

           $data = $this->archive();

           $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-stories"')->row();

     

            if($list) {

                $data['seoData'] = $list;

            }

            $loggedRow = array();

            if($this->session->userdata('userId')){

                $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();

            }

            $data['loggedRow'] = $loggedRow;



           if($slug == '') { 

               $this->db->select('blog.*, vender.fname,vender.lname'); 

               $this->db->from('blog');

               $this->db->join('vender', 'vender.id = blog.vender_id');

               $this->db->where(['blog.status'=>1]);

               $data['datas']  = $this->db->get()->result();

               $this->load->view('Page/style-stories-develop',$data);

           }  else {

               $this->db->select('blog.*, vender.fname,vender.lname'); 

               $this->db->from('blog');

               $this->db->join('vender', 'vender.id = blog.vender_id');

               $this->db->where(['blog.status'=>1,'blogSlug' => $slug ]);

               $data['datas']  = $this->db->get()->row();

               
                $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "'.$slug.'" and status=1')->row();
                if($list) {
                    $data['seoData'] = $list;
                } 
                if($data['datas']) {
                    $this->load->view('Page/story-details-develop',$data);
                } else {
                    redirect();
                }     

           }
    }
    public function styleStoryCat_develop($catSlug){   

        $data = $this->archive();

        

        $this->db->select('blog.*, blogCategory.blogCategoryName, vender.fname,vender.lname'); 

        $this->db->from('blog');

        $this->db->join('blogCategory', 'blogCategory.id = blog.category_id');

        $this->db->join('vender', 'vender.id = blog.vender_id');

        $this->db->where(['blog.status'=>1]);

        $this->db->where(['blogCategory.blogCategorySlug' =>  $catSlug ]);

        $data['datas']  = $this->db->get()->result();

        

        $this->load->view('Page/style-stories-categories-develop',$data);
    }
    public function styleStoryTag_develop($tagSlug){

         $data = $this->archive();



        $this->db->select('blog.*, blogCategory.blogCategoryName, vender.fname,vender.lname, blogTags.tagName '); 

        $this->db->from('blog');

        $this->db->join('blogCategory', 'blogCategory.id = blog.category_id');

        $this->db->join('vender', 'vender.id = blog.vender_id');

        $this->db->join('blogTags', 'blogTags.id = blog.tag_id');

        $this->db->where(['blog.status'=>1]);

        $this->db->where(['blogTags.tagSlug' =>  $tagSlug ]);

        $data['datas']  = $this->db->get()->result();

        

        $this->load->view('Page/style-stories-tag-develop',$data);
    }
    public function styleStoryArchive_develop($year,$month){
       $data = $this->archive();

       

       $this->db->select('blog.*, vender.fname,vender.lname'); 

       $this->db->from('blog');

       $this->db->join('vender', 'vender.id = blog.vender_id');

       $this->db->where(['blog.status'=>1]);

       $this->db->where(["month(blog.`created_at`)"=> $month ]);

       $this->db->where(["year(blog.`created_at`)"=> $year ]);

       $data['datas']  = $this->db->get()->result();

       $this->load->view('Page/style-stories-archives-develop',$data);
    }
    //END BLOG\\
    public function recursive($tbl_name,$k,$parent_id) {
        $rs = $this->common_model->get_all_details($tbl_name,array('parent_id'=>$parent_id,'status'=>1))->result_array();
        if($rs){
            foreach($rs as $key=>$value){
                $rs[$key]['child'] = $this->recursive($tbl_name,$k,$value['id']);
            }
        }else{
            $rs = array();
        }
        return $rs;
    }
    public function recursiveParent($tbl_name,$k,$parent_id) {
        $rs = $this->common_model->get_all_details($tbl_name,array('id'=>$parent_id))->result_array();
        if($rs){
            foreach($rs as $key=>$value){
                $rs[$key]['child'] = $this->recursiveParent($tbl_name,$k,$value['parent_id']);
            }
        }else{
            $rs = array();
        }
        return $rs;
    }
    public function shopmain(){   
        $postData = $this->input->get();
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $uri_segment = 3;
        $paginationPrefix = $segment1.'/';
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        $where_in = '';
        //$catid =  $this->input->post('catid');
        //$gender =  $this->input->post('gender');
        $orderBy = $this->input->post('orderBy');
        if(isset($catid)) {
            $where_in = implode(',', $catid);
            $query .= "AND cat_id IN ($where_in)";
        }
        if(isset($gender)){
             $query .= "AND gender = $gender";
        } 
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' cat_id = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('price')) {
            $catid =  $this->input->get('price');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                //$str .= " ( discount != '' AND discount <= '".$value."') " ;
                $str .= ' discount = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        
        if ($this->input->get('gender')) {
            $catid =  $this->input->get('gender');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' gender = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        } 
        $sortBy = ' order by id desc';
        if ($this->input->get('orderBy')) {
            $sortBy = ' order by price '.$this->input->get('orderBy');
        }
        $query .= $sortBy;
        $result = $this->db->query($query);
        $data['all'] =  $result->result();
        $rowCount  = $result->num_rows();
        $uriSegment = 3; $par_page = 6;
        $this->load->library('pagination');
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
        $config['per_page']    = $par_page;
        $config["base_url"] = base_url().$paginationPrefix;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");
        $config['uri_segment'] = $uriSegment;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($page != 0){ $page = ($page-1) * $par_page; }
        $query .= ' LIMIT '.$page.','.$par_page;
        $result = $this->db->query($query);
        $data['products'] =  $result->result();

        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }

        }
        $data['parentCategory'] = $rows;

        $wh = ' WHERE featured = 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        $data['featuredCategory'] = $rows;

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "shop" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

        }
        
        $this->load->view('Page/shop-main',$data);
    }
    
    public function shopcategory(){  
        $postData = $this->input->get();
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $paginationPrefix = $segment1.'/'.$segment2.'/';
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        
        
        
        $where_in = '';
        $orderBy = $this->input->post('orderBy');
        
        if ($this->input->get('price')) {
            $catid =  $this->input->get('price');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                if(strtoupper($f[1]) == 'ABOVE'){
                    $str .= ' ( price >= "'.$f[0].'" AND price <= "100000") ' ;
                }else{
                    $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                }
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('size')) {
            $catid =  $this->input->get('size');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' FIND_IN_SET('.$value.',size) ';
                    $i++;
                }
            }else{
                $str .= ' FIND_IN_SET('.$catid.',size) ';
            }
            $query .= " AND (". $str.") ";
        }
        
        
        /*if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' discount = '.$value;
                    $i++;
                }
            }else{
               $str .= ' discount > 0 AND discount <= '.$catid; 
            }
            $query .= " AND (". $str.") ";
        }*/
        
        if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                if(strtoupper($f[1]) == 'ABOVE'){
                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "100000") ' ;
                }else{
                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "'.$f[1].'") ' ;
                }
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' FIND_IN_SET("'.$value.'",cat_id)';
                    //$str .= ' cat_id = '.$value;
                    $i++;
                }
                $query .= " AND (". $str.") ";
            }else{
            
                $wh = ' WHERE parent_id = '.$catid.' order by ui_order ASC';
                $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
                foreach ($rowsCatF as $k => $v) {
                    $rs = array();
                    $wh1 = ' WHERE parent_id = '.$v['id'].' order by ui_order ASC';
                    $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                    $rowsCatF[$k]['child'] = $rs;
                    foreach($rs as $k1=>$v1){
                        $rowsCatF[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
                    }
                }
                if ($rowsCatF) {
                    $i=0;
                    $str = '';
                    foreach ($rowsCatF as $key => $value) {
                        if ($i>0) {
                            $str .= ' OR '; 
                        }
                        //$str .= ' cat_id = '.$value['id'];
                        $str .= ' FIND_IN_SET('.$value['id'].',cat_id)';
                        
                        foreach ($value['child'] as $key1 => $value1) {
                            $str .= ' OR '; 
                            //$str .= ' cat_id = '.$value1['id'];
                            $str .= ' FIND_IN_SET('.$value1['id'].',cat_id)';
                            foreach ($value1['child'] as $key2 => $value2) {
                                $str .= ' OR '; 
                                $str .= ' FIND_IN_SET('.$value2['id'].',cat_id)';
                                //$str .= ' cat_id = '.$value2['id'];
                                $i++;
                            }
                            $i++;
                        }
                        $i++;
                    }
                    if ($str) {
                        //$query .= " AND (". $str." OR  cat_id = ".$catid.") ";
                        $query .= " AND (". $str." OR  FIND_IN_SET(".$catid.",cat_id) ) ";
                    }
                }else{
                    $query .= ' AND FIND_IN_SET("'.$catid.'",cat_id)';
                    
                    //$query .= " AND cat_id = ". $catid;
                }
            }
        }
        $sortBy = ' order by id desc';
        if ($this->input->get('orderBy')) {
            $sortBy = ' order by price '.$this->input->get('orderBy');
        }

        $rowsCatF = array(); 
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            if (is_array($catid)) {
                
            }else{
                $wh = ' WHERE id = '.$catid.' order by ui_order ASC';
                $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
                foreach ($rowsCatF as $k => $v) {
                    $rs = array();
                    $wh1 = ' WHERE id = '.$v['parent_id'].' order by ui_order ASC';
                    $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                    $rowsCatF[$k]['child'] = $rs;
                    foreach($rs as $k1=>$v1){
                        $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
                    }
                }
            }
        }




        $query .= $sortBy;
        $result = $this->db->query($query);
        //echo $this->db->last_query();
        $data['all'] =  $result->result();
        $data['catRecords'] = $catRecords = $rowsCatF;

        $rowCount  = $result->num_rows();
        $uriSegment = 3; $par_page = 20;
        $this->load->library('pagination');
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
        $config['per_page']    = $par_page;
        $config["base_url"] = base_url().$paginationPrefix;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");
        $config['uri_segment'] = $uriSegment;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($page != 0){ $page = ($page-1) * $par_page; }
        $query .= ' LIMIT '.$page.','.$par_page;
        $result = $this->db->query($query);
        
        
        $data['start_limit'] = $page;
		$end_limit = $page + $par_page;
		if($rowCount > $end_limit){
			$data['end_limit'] = $end_limit;
		}else{
			$data['end_limit'] = $rowCount;
		}
		
        $data['total_rows'] =  $rowCount;
        $products =  $result->result();

        foreach ($products as $key => $productDetails) {
            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $products[$key]->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $products[$key]->feedbackRating = ($review->rating)?$review->rating:0;
    
            $products[$key]->feedbackCount = $review->feedbackCount;
    
            $products[$key]->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $products[$key]->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $products[$key]->fname = $row['fname'];
            $products[$key]->lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  
            }else{
                /*$this->db->select('*');  
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  */
                $products[$key]->sizesArray = array();  
            }
            

        }
        $data['products'] =  $products;
        $data['catLists'] =  $this->db->order_by('name','ASC')->get_where('category',['status'=>1])->result();
        
        $this->db->order_by("ui_order", "asc");
        $data['sizes'] = $this->db->get('product_size')->result(); 

        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }
        }
        $data['parentCategory'] = $rows;
        
        
        
        $aaaa = array();
        foreach ($catRecords as $key => $value) { 
        
            $ab = array();
            $ab['id'] = $value['id'];
            $ab['slug'] = $value['slug'];
            $ab['name'] = $value['name'];
            $ab['label'] = 1;
            array_push($aaaa,$ab);
            foreach ($value['child'] as $key1 => $value1) { 
            
                $ab = array();
                $ab['id'] = $value1['id'];
                $ab['slug'] = $value1['slug'];
                $ab['name'] = $value1['name'];
                $ab['label'] = 2;
                array_push($aaaa,$ab);
                
                foreach ($value1['child'] as $key2 => $value2) {  
                
                    $ab = array();
                    $ab['id'] = $value2['id'];
                    $ab['slug'] = $value2['slug'];
                    $ab['name'] = $value2['name'];
                    $ab['label'] = 3;
                    array_push($aaaa,$ab);
                
                }  
            }  
        }  
        array_multisort( array_column($aaaa, "label"), SORT_DESC, $aaaa ); 
        $meta_title = '';
        foreach ($aaaa as $key => $value) { 
           $meta_title =  $value['name']; 
        }  
		
		if($this->input->get('ptype')){
		    $meta_title = 'New Arrival';
		}
		
        $list = array();
        $list['meta_title'] = $meta_title;
       /* $list['meta_description'] = strip_tags($productDetails->description);
        $list['meta_keyword'] = strip_tags($productDetails->description);*/
        $data['seoData'] = (object)$list;
    
    
    
        $this->load->view('Page/shop-category',$data);
    }
    public function productDetailsnew(){   
        
        $slug = $this->uri->segment(3);
        
        $data['sizes']  = $this->Page_Model->fetch_all('product_size');
        $this->db->select('products.*, vender.fname,vender.lname'); 

        $this->db->from('products');

        $this->db->join('vender', 'vender.id = products.vender_id');

        $this->db->where('products.slug', $slug);
        $this->db->where('products.vendor_status', 1);
        $this->db->where('products.admin_status', 1);
        $this->db->where('products.status', 1);

        $productDetails  = $this->db->get()->row();
        if(!$productDetails){
            redirect(base_url('shop'));
        }


        $wishListStatus = 0;

        if($this->session->userdata('userId')){

            $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('userId') ])->row();

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
            
        $data['productDetails']  = $productDetails;
        $catRow = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
        
        $meta_title = $catRow['name'].' | '.$productDetails->product_name; 
        
        $list = array();
        $list['meta_title'] = $meta_title;
        $list['meta_description'] = strip_tags($productDetails->description);
        $list['meta_keyword'] = strip_tags($productDetails->description);
        $data['seoData'] = (object)$list;
    
        $rowsCatF = array(); 
        if ($productDetails->cat_id) {
            $catArray = explode(',', $productDetails->cat_id);
            $cat_id =  $catArray[0];
            $wh = ' WHERE id = '.$cat_id.' order by ui_order ASC';
            $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
            foreach ($rowsCatF as $k => $v) {
                $rs = array();
                $wh1 = ' WHERE id = '.$v['parent_id'].' order by ui_order ASC';
                $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                $rowsCatF[$k]['child'] = $rs;
                foreach($rs as $k1=>$v1){
                    $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
                }
            }
        }
        $data['catRecords'] =  $rowsCatF;

        $data['gallary'] = $this->db->get_where('product_galary',['product_id'=> $data['productDetails']->id ])->result();

        /*$this->db->select('*');  
        $this->db->where_in('id',$data['productDetails']->size,false);

        $data['sizes'] = $this->db->get('product_size')->result(); 
        */
        if($data['productDetails']->size){
            $this->db->select('*'); 
            $this->db->where_in('id',$data['productDetails']->size,false);
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
        }else{
            $data['sizes'] = array();
        }
        

        $catArray = explode(',', $productDetails->cat_id);
        
        $cat_id =  $catArray[0];
            
        /*$this->db->select('*');  
        $this->db->where('id !=', $data['productDetails']->id);
        $this->db->where('cat_id', $cat_id); 
        $this->db->limit(4);
        $products = $this->db->get('products')->result(); */
        
        $wh1 = ' WHERE id != '.$data['productDetails']->id.' and status= 1 ';
        $ab=0;
        $st = '';
        foreach ($catArray as $v) {
            if($ab>0){
                $st .= ' OR ';
            }
            $st .= ' cat_id = '.$v;
            $ab++;
        }
        if($st){
            $wh1 .= ' AND ('.$st.') ';
        }
        $wh1 .= ' ORDER BY RAND() ';
        $wh1 .= ' limit 4';
        
        $products = $this->common_model->get_all_details_query('products',$wh1)->result();
        
        
        foreach($products as $key => $productDetails){
            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $products[$key]->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $products[$key]->feedbackRating = ($review->rating)?$review->rating:0;
    
            $products[$key]->feedbackCount = $review->feedbackCount;
    
            $products[$key]->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $products[$key]->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $products[$key]->fname = $row['fname'];
            $products[$key]->lname = $row['lname'];
            
            $catArray = explode(',', $productDetails->cat_id);
            $cat_id =  $catArray[0];
        
            $row = $this->common_model->get_all_details('category',array('id'=>$cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  
            }else{
                $products[$key]->sizesArray = array();  
            }
             
        }
        $data['relatedProducts'] = $products; 
        
        
        
        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }

        }
        $data['parentCategory'] = $rows;
        $this->load->view('Page/shop-details-new',$data);

    }
    
    public function product_search(){
        $currLanguage = $this->session->userdata('site_lang');
        $suffix= '';
        if ($currLanguage == 'ar') {
            $suffix= '_'.$currLanguage;
        }
        
        $postData = $this->input->get();
        $sort = array(array('field'=>'id','type'=>'DESC'));
        if(!empty($postData['key']) && !empty($postData['value'])){
            $sort = array(array('field'=>$postData['key'],'type'=>$postData['value']));
        }
        $str = '';
        $search_text1 = utf8_decode($postData['term']);
        $search_text = $postData['term'];
        if($postData['term']){ 
            $str .= " AND (  LOWER(product_name) LIKE '%".$search_text1."%')"; 
        }
        
        $sort1 = ' order by id DESC';
        if(!empty($postData['orderby'])){
            $a = explode('=', $postData['orderby']);
            $sort1 = ' order by '.$a[0].' '.$a[1];
        }
        $condition = ' where  status = 1 '.$str.$sort1;
        
        $query = $this->common_model->get_all_details_query('products',$condition);
        //echo $this->db->last_query();
        
        $rows = $query->result_array();
        
        $result1 = array();
        foreach ($rows as $company) {
            $companyLabel['value'] = html_entity_decode($company["product_name".$suffix]);
            //$companyLabel['id'] = ($company[ "slug" ]);
            //$companyLabel['id'] = ($company[ "slug" ]);
            
            $row = $this->common_model->get_all_details('category',array('id'=>$company['cat_id']))->row_array();
            //$companyLabel['category_slug'] = $row['category_slug'];
            $companyLabel['id'] = ($row['slug'].'/'.$company[ "slug" ]);
           
            array_push( $result1, $companyLabel);
        }
        echo json_encode( $result1 );
    }
	public function shop($slug = false){   

        $postData = $this->input->get();

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $uri_segment = 2;

        $paginationPrefix = $segment1.'/';





	    $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";

        $where_in = '';

        //$catid =  $this->input->post('catid');

        //$gender =  $this->input->post('gender');

        $orderBy = $this->input->post('orderBy');

       



        /*if(isset($catid)) {
            $where_in = implode(',', $catid);
            $query .= "AND cat_id IN ($where_in)";
        }
        if(isset($gender)){
             $query .= "AND gender = $gender";
        }*/
        
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' cat_id = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('price')) {
            $catid =  $this->input->get('price');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                //$str .= " ( discount != '' AND discount <= '".$value."') " ;
                $str .= ' discount = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        
        if ($this->input->get('gender')) {
            $catid =  $this->input->get('gender');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' gender = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('catid_mobile')) {
            $catid =  $this->input->get('catid_mobile');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' cat_id = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('price_mobile')) {
            $catid =  $this->input->get('price_mobile');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('discount_mobile')) {
            $catid =  $this->input->get('discount_mobile');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                //$str .= " ( discount != '' AND discount <= '".$value."') " ;
                $str .= ' discount = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        
        if ($this->input->get('gender_mobile')) {
            $catid =  $this->input->get('gender_mobile');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' gender = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        $sortBy = ' order by id desc';

        if ($this->input->get('orderBy')) {

            $sortBy = ' order by price '.$this->input->get('orderBy');

        }

        $query .= $sortBy;

        $result = $this->db->query($query);
        //echo $this->db->last_query();
	    $data['all'] =  $result->result();

	    $rowCount  = $result->num_rows();

	    

	    $uriSegment = 2; $par_page = 18;

	    

	    $this->load->library('pagination');

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

	    $config['per_page']    = $par_page;

        

        $config["base_url"] = base_url().$paginationPrefix;

        $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");



		$config['uri_segment'] = $uriSegment;

		$config['use_page_numbers'] = TRUE;

	    $this->pagination->initialize($config); 

	    

	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        

	    if($page != 0){ $page = ($page-1) * $par_page; }



	    



        $query .= ' LIMIT '.$page.','.$par_page;



        $result = $this->db->query($query);

        //echo $this->db->last_query();

        $data['products'] =  $result->result();

        //$data['products'] = $this->Page_Model->list($config["per_page"],$page, $where_in, $orderBy, $gender);

        $data['catLists'] =  $this->db->order_by('name','ASC')->get_where('category',['status'=>1])->result();

        //echo $data['products'];

        

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "shop" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

        }

		$this->load->view('Page/shop-new',$data);

	}

	function fetch_data(){   

	    sleep(1);

	    $cat_id = $this->input->post('cat_id');

	    $gender = $this->input->post('gender');

	    $this->load->library('pagination');

        $config = array();

        $config['base_url'] = '#';

        $config['total_rows'] = $this->Page_Model->count_all($cat_id, $gender);

        $config['per_page'] = 9;

        $config['uri_segment'] = 3;

        $config['use_page_numbers'] = TRUE;

        $config['full_tag_open'] = '<ul class="pagination">';

        $config['full_tag_close'] = '</ul>';

        $config['first_tag_open'] = '<li>';

        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';

        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&gt;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&lt;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'><a href='#'>";

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['num_links'] = 3;

        $this->pagination->initialize($config);

        $page = $this->uri->segment(2);

        //$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $start = ($page - 1) * $config['per_page'];

        $output = array (

       'pagination_link'  => $this->pagination->create_links(),

       'product_list'   => $this->Page_Model->fetch_data($config["per_page"], $start, $cat_id, $gender) );

      

        echo json_encode($output);

	} 

	public function productDetails($slug){   
    
	    $data['sizes']  = $this->Page_Model->fetch_all('product_size');

        if($slug){
            
         

            $this->db->select('products.*, vender.fname,vender.lname'); 
    
            $this->db->from('products');
    
            $this->db->join('vender', 'vender.id = products.user_id');
    
            $this->db->where('products.slug', $slug);
    
            $productDetails  = $this->db->get()->row();
    
    
    
            $wishListStatus = 0;
    
            if($this->session->userdata('userId')){
    
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('userId') ])->row();
    
                if ($wishListStatusRow) {
    
                    $wishListStatus = 1;
    
                }
    
            }
    
            $productDetails->wishListStatus = $wishListStatus;
            if($productDetails->id){
                
                $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
                $productDetails->feedbackRating = ($review->rating)?$review->rating:0;
        
                $productDetails->feedbackCount = $review->feedbackCount;
        
                $productDetails->review = $review;
            
                $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
            }
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $productDetails->reviews = $reviews;
            $data['productDetails']  = $productDetails;
    
            $data['gallary'] = $this->db->get_where('product_galary',['product_id'=> $data['productDetails']->id ])->result();
    
            if($data['productDetails']->size){
                $this->db->select('*'); 
                $this->db->where_in('id',$data['productDetails']->size,false);
                $this->db->order_by('ui_order','asc');
                $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
            }else{
                $data['sizes'] = array();
            }
            
            
    
            $this->db->select('*');  $this->db->where('id !=', $data['productDetails']->id);
    
            $this->db->where('cat_id', $data['productDetails']->cat_id); $this->db->limit(4);
    
            $data['relatedProducts'] = $this->db->get('products')->result(); 
    
            $list = array();
            $meta_title = ''.$productDetails->product_name;  
            $list['meta_title'] = $meta_title;
            $list['meta_description'] = strip_tags($productDetails->description);
            $list['meta_keyword'] = strip_tags($productDetails->description);
            $data['seoData'] = (object)$list;
        
        }
        $this->load->view('Page/shop-details',$data);

	}
   
    public function cart(){
        //var_dump($this->session->userdata());   
        $this->cartupdateAjax();
        $cart = $this->cart->contents();
        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();
        $data['cartArray'] = $rs;

	    if($rs) {
            if($this->session->userdata('userType')) {
                $data['user'] = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 
            }else{
                $data['user'] = array(); 
            }
            $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
            $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
            foreach ($rows as $k => $v) {
                $rs = array();
                $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
                $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                $rows[$k]['child'] = $rs;
                foreach($rs as $k1=>$v1){
                    $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
                }
    
            }
            $data['parentCategory'] = $rows;

            
            
            $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
            $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();
            $data['user_cart_session'] = $rs;
            
            $this->load->view('Page/cart',$data);  

	    } else {

	        redirect();

	    }

	}

    public function cartnew(){   

        $cart = $this->cart->contents();

        if($cart) {

            $this->load->view('Page/cart-new');  

        } else {

            redirect();

        }

    }

	

	public function checkout(){  

        $postData = $this->input->post();

        /*$lastPage = '';

        $refer =  $this->agent->referrer();

        $a  = explode('/',$refer);

        foreach($a as $k=>$v){

                $lastPage = $v;

        }

        */

        $data['lastPage'] = base_url('checkout');



        $cart = $this->cart->contents();

        if(!$cart) {

            redirect('shop');

        }

        if($this->session->userdata('userType')) {

            $data['user'] = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 

            $data['callback_url']       = base_url().'razorpay/userOrder';

            $data['surl']               = base_url().'razorpay/success';;

            $data['furl']               = base_url().'razorpay/failed';;

            $data['currency_code']      = 'INR';

            $data['user_shipping_address'] = $user_shipping_address= $this->db->get_where('user_shipping_address',['user_id'=> $this->session->userdata('userId')])->result_array(); 

        }else{

            

            if($this->session->userdata('userType')) {

                redirect($postData['lastPage']);  

            }

            if (!empty($this->input->post('userEmail')) && !empty($this->input->post('userPassword'))) {

                $data['lastPage'] = $this->input->post('lastPage');

                $email = $this->input->post('userEmail');

                $password = md5($this->input->post('userPassword'));

                $table = 'vender';

                $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND password="'.$password.'"')->row();

                if($user) {

                    if($user->status != 1) {

                        $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');

                        

                    } else {

                        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];

                        $this->session->set_userdata($frontUserData);

                        $cart = $this->cart->contents();

                        $refer = $data['lastPage'];

                        $a  = explode('/',$refer);

                        foreach($a as $k=>$v){

                                $lastPage = $v;

                        }

                        if ($lastPage == 'login' || $lastPage == 'registration') {

                            redirect(base_url());    

                        }else{

                            redirect($data['lastPage']);    

                        }

                   }

                } else {

                    $this->session->set_flashdata('message','<p class="text-danger">Invalid email or Password, Try Again</p>');

                }

            }



            $data['user'] = array(); 

            $data['callback_url']       = '';

            $data['surl']               = '';

            $data['furl']               = '';

            $data['currency_code']      = 'INR';

            $data['user_shipping_address'] =  array(); 



        }



        

         

        $this->load->view('Page/checkout',$data);

          

	}



    
    public function cartUpdate(){

	    $rowid = $this->input->post('rowid');
	    $price = $this->input->post('price');
        $mrpprice = $this->input->post('mrpprice');
        if(!$mrpprice){
           $mrpprice = $price; 
        }
	    $qty = $this->input->post('qty');
        $data = array( 'rowid' => $rowid, 'price' => $price, 'qty' => $qty );
        //$this->cart->update($data);
        //echo $this->db->last_query();
        
        
        $discount_total = $mrpprice-$price;
        $data = array(
            'discount_total' => $discount_total * $qty,
            'mrp_price_total' => $mrpprice * $qty,
            'sale_price' => $price,
            'price' => $price,
            'quantity' => $qty,
            'total' => $qty * $price,
        );              
        $this->common_model->commonUpdate('user_cart',$data,array('id'=>$rowid));
        //echo $this->db->last_query();
        echo true; 
	}

    public function cartupdateAjax(){
        $user_id = $this->session->userdata('session_user_id_temp');
        $postData['user_id'] = $user_id;
        /*$cartArray = $this->common_model->get_all_details('user_cart',array('user_id'=>$user_id))->result_array();
        foreach($cartArray as $key=>$r){
            $sale_price = $r['mrp_price'];
            $price = $r['price'];
            $total = $r['total'];
            $discount = $r['discount'];
            $total_discount = $r['discount_total'];

            $productRow = $this->common_model->get_all_details('products',array('id'=>$r['product_id']))->row_array();
            $postDataNew['mrp_price'] =  $sale_price;;
            $postDataNew['price'] = $price;
            $postDataNew['discount'] =  $discount;
            $postDataNew['discount'] =  $total_discount;
            $postDataNew['total'] = $total;
            $this->common_model->commonUpdate('user_cart',$postDataNew,array('id'=>$r['id']));
        }*/
        $cartArray = $this->common_model->get_all_details('user_cart',array('user_id'=>$user_id,'in_stock'=>1))->result_array();
        $bag_total= 0;
        $bag_mrp_price_total= 0;
        $totalcount= 0;
        $coupon_id = 0;
        $coupon_code = '';
        $coupon_value = '';
        $coupon_price = 0;
        $discount_total = 0;
        $redeem_point = 0;
        $redeem_record = '';
        foreach($cartArray as $key=>$value){
            if($value['in_stock']){
                $totalcount += $value['quantity'];
                $bag_total += $value['total'];
                $discount_total += $value['discount_total'];
                $bag_mrp_price_total += $value['mrp_price_total'];
            }
        }
        $this->data['totalcount'] = $totalcount;
         
        
        

        $cart_record = array();
        
        $cart_record['bag_total'] = numberFormat($bag_total);
        $cart_record['discount_total'] = numberFormat($discount_total);
        $cart_record['sub_total'] = numberFormat($bag_total);
        $cart_record['bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);
        

        $cart_record['display_bag_total'] = numberFormat($bag_total);
        $cart_record['display_discount_total'] = numberFormat($discount_total);
        $cart_record['display_sub_total'] = numberFormat($bag_total);
        $cart_record['display_bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);

        $shipping_total = 0;

        $display_total = $shipping_total + $bag_total;
        $display_mrp_price_total = $shipping_total + $bag_mrp_price_total;
        
        $cart_record['shipping_total'] = numberFormat($shipping_total);
        $cart_record['total'] = numberFormat($display_total);
        $cart_record['mrp_price_total'] = numberFormat($display_mrp_price_total);

        $cart_record['display_shipping_total'] = numberFormat($shipping_total);
        $cart_record['display_total'] = numberFormat($display_total);
        $cart_record['display_mrp_price_total'] = numberFormat($display_mrp_price_total);
        
        $sess_array = array();
        $sess_array['user_id'] = $user_id;
        $sess_array['cart_record'] = json_encode($cart_record);
        $sess_array['coupon_id'] = $coupon_id;
        $sess_array['coupon_code'] = $coupon_code;
        $sess_array['coupon_value'] = $coupon_value;
        $sess_array['coupon_price'] = numberFormat($coupon_price);
        $sess_array['redeem_point'] = $redeem_point;
        $sess_array['redeem_record'] = $redeem_record;
        $sess_array['created_at'] = date('Y-m-d h:i:s');
        

        $conSession = array('user_id'=>$user_id);
        $sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession);
        //echo $this->db->last_query();
        $num_rows = $sessionRow->num_rows();
        if ($num_rows) {
            $this->common_model->commonDelete('user_cart_session',$conSession);
            $this->common_model->simple_insert('user_cart_session',$sess_array);
        }else {
            $this->common_model->simple_insert('user_cart_session',$sess_array);
            //echo $this->db->last_query();
        }
    }

	public function cartRemove(){
	    $row_id = $this->input->post('row_id');
   	    $data = array( 'rowid'  => $row_id,  'qty'  => 0  );
        $this->cart->update($data);

        $postData = $this->input->post();
        $this->common_model->commonDelete('user_cart',array('id'=>$row_id));


        echo true;
	}
    public function cart_old()

	{   

	     $cart = $this->cart->contents();

	    if($cart) {

	        $this->load->view('Page/cart');  

	    } else {

	        redirect();

	    }

	}

	public function cartProcess_old()

	{

	    $id = $this->input->post('id');

        $price = $this->input->post('price');

        $name = $this->input->post('name');

        $qty  = $this->input->post('qty');

        $image = $this->input->post('image');

        $catId = $this->input->post('catId');

        $discount = ($this->input->post('discount'))?$this->input->post('discount'):0;

        $discountPrice = ($this->input->post('discountPrice'))?$this->input->post('discountPrice'):0;

        $venderId = $this->input->post('venderId');

        $size = $this->input->post('size');

        $mrpprice = $this->input->post('mrpprice');

        

        //if(!empty($discountPrice)) { $price = $discountPrice; }

        

         $data = array(

          'id' => $id,

          'name' => $name,

          'mrpprice' => $mrpprice,

          'price' => $price,

          'discount' => $discount,

          'discountPrice' => $discountPrice,

          'qty' => $qty,

          'options' => array (

           'image' => $image, 'catId' => $catId,'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice,'venderId'=>$venderId,'size' =>$size) 

          );              



	    $this->cart->insert($data);

        $cart = $this->cart->contents();

        $rowsCount = count($this->cart->contents());

        $total = $this->cart->total(); 



         if(!empty($cart)) {

           	$msg = ['success'=>true, 'rowCount'=> $rowsCount];

		     }  else {

           $msg = ['error'=>true, 'message'=> 'something went wrong' ];     

          }

         echo json_encode($msg);

	}

	public function checkout_old(){  

        $postData = $this->input->post();

        /*$lastPage = '';

        $refer =  $this->agent->referrer();

        $a  = explode('/',$refer);

        foreach($a as $k=>$v){

                $lastPage = $v;

        }

        */

        $data['lastPage'] = base_url('checkout');



        $cart = $this->cart->contents();

        if(!$cart) {

            redirect('shop');

        }

        if($this->session->userdata('userType')) {

            $data['user'] = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 

            $data['callback_url']       = base_url().'razorpay/userOrder';

            $data['surl']               = base_url().'razorpay/success';;

            $data['furl']               = base_url().'razorpay/failed';;

            $data['currency_code']      = 'INR';

            $data['user_shipping_address'] = $user_shipping_address= $this->db->get_where('user_shipping_address',['user_id'=> $this->session->userdata('userId')])->result_array(); 

        }else{

            

            if($this->session->userdata('userType')) {

                redirect($postData['lastPage']);  

            }

            if (!empty($this->input->post('userEmail')) && !empty($this->input->post('userPassword'))) {

                $data['lastPage'] = $this->input->post('lastPage');

                $email = $this->input->post('userEmail');

                $password = md5($this->input->post('userPassword'));

                $table = 'vender';

                $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND password="'.$password.'"')->row();

                if($user) {

                    if($user->status != 1) {

                        $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');

                        

                    } else {

                        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];

                        $this->session->set_userdata($frontUserData);

                        $cart = $this->cart->contents();

                        $refer = $data['lastPage'];

                        $a  = explode('/',$refer);

                        foreach($a as $k=>$v){

                                $lastPage = $v;

                        }

                        if ($lastPage == 'login' || $lastPage == 'registration') {

                            redirect(base_url());    

                        }else{

                            redirect($data['lastPage']);    

                        }

                   }

                } else {

                    $this->session->set_flashdata('message','<p class="text-danger">Invalid email or Password, Try Again</p>');

                }

            }



            $data['user'] = array(); 

            $data['callback_url']       = '';

            $data['surl']               = '';

            $data['furl']               = '';

            $data['currency_code']      = 'INR';

            $data['user_shipping_address'] =  array(); 



        }



        

         

        $this->load->view('Page/checkout',$data);

          

	}



	public function cartUpdate_old()

	{

	    $rowid = $this->input->post('rowid');

	    $price = $this->input->post('price');

	    $qty = $this->input->post('qty');

        $data = array( 'rowid' => $rowid, 'price' => $price, 'qty' => $qty );

        $this->cart->update($data);

        echo true; 

	}

	public function cartRemove_old()

	{

	    $row_id = $this->input->post('row_id');

   	    $data = array( 'rowid'  => $row_id,  'qty'  => 0  );

        $this->cart->update($data);

        echo true;

	}
    
    	public function addressProcess()

	{   

	    $total = $this->cart->total();

        $cart = $this->cart->contents();

        $productList = array();

        $uploadData = array();

        

        $data['total_price'] = $total;

        $data['pay_type'] = $this->input->post('pay_type');

        $data['fname'] = $this->input->post('fname');

        $data['lname'] = $this->input->post('lname');

        $data['company'] = $this->input->post('company');

        $data['address'] = $this->input->post('address'); 

        $data['city'] = $this->input->post('city');

        $data['state'] = $this->input->post('state');

        $data['pinecode'] = $this->input->post('pinecode');

        $data['country'] = $this->input->post('country');

        $data['mobile'] = $this->input->post('mobile');

        $data['user_id'] = $this->session->userdata('userId');

        $data['user_email'] = $this->session->userdata('email');

        $data['created_at'] = date('Y-m-d H:i:s');

        if(!empty($cart)) {    

            $this->db->insert('user_order',$data);

            $orderId = $this->db->insert_id();

        }

        foreach($cart as $cartval) {

             $productList[] = array(

                    'productId' =>  $cartval['id'],

                    'productName' =>  $cartval['name'],

                    'productQty' =>  $cartval['qty'],

                    'productPrice' =>  $cartval['price'],

                    'productImg' =>  $cartval['options']['image'],

                    'catId' =>  $cartval['options']['catId'],

                    'discount' =>  $cartval['options']['discount'],

                    'discountPrice' =>  $cartval['options']['discountPrice'],

                    'venderId' =>  $cartval['options']['venderId'],

                    'size' =>  $cartval['options']['size']

                    );

        }

        



        for($i = 0; $i < count($productList); $i++ ) {

                  

              $uploadData[$i]['orderId'] = $orderId;    

              $uploadData[$i]['user_id'] = $data['user_id'];

              $uploadData[$i]['invoiceNo'] = $orderId; 

              $uploadData[$i]['productId'] = $productList[$i]['productId'];

              $uploadData[$i]['productQty'] = $productList[$i]['productQty'];

              $uploadData[$i]['productName'] = $productList[$i]['productName'];

              $uploadData[$i]['productPrice'] = $productList[$i]['productPrice'];

              $uploadData[$i]['productImg'] = $productList[$i]['productImg'];

              

              $uploadData[$i]['catId'] = $productList[$i]['catId'];

              $uploadData[$i]['discount'] = $productList[$i]['discount'];

              $uploadData[$i]['discountPrice'] = $productList[$i]['discountPrice']; 

              $uploadData[$i]['venderId'] = $productList[$i]['venderId'];

              $uploadData[$i]['size'] = $productList[$i]['size'];

              $uploadData[$i]['created_at'] = date('Y-m-d H:i:s');

        }

        $this->db->insert_batch('user_order_details',$uploadData);

          

        $userInvoice = ['invoice'=> $orderId];

        $this->session->set_userdata($userInvoice);  

           

        $this->cart->destroy();    

          // $this->session->unset_userdata('invoice');

            redirect('thanks-page');

         // $msg = array('redirect' => "thanks-page");

         // echo json_encode($msg);

   

	}

	public function  thanksPage()

	{   

	     $invoiceId = $this->session->userdata('invoice'); 

	     $data['order'] = $this->db->get_where('user_order',['id'=>$invoiceId])->row();

	     $this->load->view('Page/thanksPage',$data);

	}
	public function wishList()

	{   

	   //$user_Id = $this->session->userdata('userId');

	   $data['user_Id'] = $this->input->post('');

	   $data['product_Id'] = $this->input->post('id');

	   $data['cat_id'] = $this->input->post('catId');

	   $data['vender_id'] = $this->input->post('venderId');

	}

    // new pages 

    public function team()

    {   
        $data['datas'] = $this->db->get_where('ourteam',['status'=> 1])->result();

        $this->load->view('Page/team',$data);

    }

    public function teamDetails() 

    {

        if ($this->uri->segment(3)) {

            $id = base64_decode($this->uri->segment(3));

            $data['datas'] = $this->db->get_where('ourteam',['id'=> $id,'status'=> 1])->row();

        }else{

            $data['datas'] = array();

        }

        $this->load->view('Page/team-details',$data);

    }

	public function loyalty()

	{

	    $this->load->view('Page/loyalty');

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
            $loggedRow = $this->db->query('select * from vender where id = '.$this->session->userdata('userId'))->row_array();
        }
        
        $data11['giftCradRow'] = $giftCradRow;
        $data11['loggedRow'] = $loggedRow;
        $data11['callback_url']       = base_url().'razorpay/giftcard_booking';
        $data11['surl']               = base_url().'razorpay/giftcard_booking_success';;
        $data11['furl']               = base_url().'razorpay/failed';

        $data11['currency_code']      = 'INR';
        $data11['package_price']      = $giftCradRow['gift_code_price'];
	    $this->load->view('Page/gift-quote',$data11);

	}
	/*public function giftCard()

	{

	    $this->load->view('Page/gift-card');

	}*/

	public function personalStyleLocation() 

	{   

        $data['datas'] = $this->db->get_where('personal_stylist',['status'=> 1])->result();

	    $this->load->view('Page/personal-styling-locations',$data);

	}

	public function personalStyleLocationdetails($slug)

	{      

	      $data['lists'] = $this->db->order_by("id", "desc")->get_where('personal_stylist',['status'=> 1])->result();

          $data['datas'] = $this->db->get_where('personal_stylist',['slug'=> $slug])->row();    

          if($data['datas']) {

                $this->load->view('Page/personal-stylist-delhi',$data);                   

          } else {

                redirect();  

          }

	}

 

    public function logout()

	{

        //$this->session->unset_userdata($frontUserData);

        $this->session->sess_destroy();

        $refer =  $this->agent->referrer();

        redirect($refer);

    }

    


    public function expertise(){
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "expertise" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise_looking');
        //$data['expertises']  = $this->Page_Model->fetch_all('area_expertise');
        $this->load->view('Page/select-service',$data);
    }



    public function stylistExpert($a = false){   

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4);

        $segment5 = $this->uri->segment(5);

        $data['states']  = $this->db->get('states')->result();

        $this->db->where('status',1);

        $this->db->where('slug',$segment2);

        $this->db->order_by('slug',$segment2);  

        $expertises = $this->db->get('area_expertise_looking')->row(); 
        $this->session->set_userdata('area_expertise_looking_current',$segment2);
        $data['expertises'] = $expertises; 
        if($expertises) {

            $data['seoData'] = $expertises;

        }

        

        $where = " where display_status = 1 AND user_type = 2 ";

         

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

        $config['total_rows'] = $rowCount;

        $config['per_page'] = $par_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

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
        $data['expertises_list']  = $this->Page_Model->fetch_all('area_expertise_looking');
        
        
        

        if ($this->input->get('expert_by_city')) {
            //$where .= " AND  city = '".  ."' ";
            $datas  =  $this->common_model->get_all_details('area_expertise_looking_city',array('area_expertise_looking_id'=> $expertises->id,'city_id'=>base64_decode($this->input->get('expert_by_city'))))->row();
            //echo $this->db->last_query();
            $data['description_city'] = $datas;
             
           // var_dump();
           // echo $this->session->userdata('area_expertise_looking_current');
        
        }
        
         
        
        $this->load->view('Page/select-service-list',$data);

    }

    public function expertise_develop(){
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "expertise" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise_looking');
        //$data['expertises']  = $this->Page_Model->fetch_all('area_expertise');
        $this->load->view('Page/area_expertise_develop',$data);
    }
    public function stylistExpert_develop($a = false){   

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment4 = $this->uri->segment(4);

        $segment5 = $this->uri->segment(5);

        $data['states']  = $this->db->get('states')->result();





        $this->db->where('status',1);

        $this->db->where('slug',$segment2);

        $this->db->order_by('slug',$segment2);  

        $expertises = $this->db->get('area_expertise_looking')->row(); 

        $data['expertises'] = $expertises; 

         

        //$list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "expertise" and status=1')->row();

        if($expertises) {

            $data['seoData'] = $expertises;

        }

        

        $where = " where status = 1 AND user_type = 2 ";

         

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



        $where .= "  order by experience desc";

        $query = $this->db->query("select * from vender".$where);

        $rowCount = $query->num_rows();

        //echo $this->db->last_query();

        $par_page = 16; 

       



        $config = array();

        $this -> load -> library('pagination');



        $config = array();

        $config['total_rows'] = $rowCount;

        $config['per_page'] = $par_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

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

        $this->load->view('Page/styling-expert-develop',$data);

    }

    public function search_stylist_by_state()    { 

        /*$query = $this->db->query("select * from registerUser_old");

        $list = $query->result(); 

        foreach ($list as $key => $value) {

            $aa = array();

            foreach ($value as $key1 => $value1) {

                echo $key1.'====================='.$value1;

                $aa[$key1] = $value1;

            }

            unset($aa['id']);

            $aa['gender'] = 1;

            $query = $this->db->query("select * from vender where email = '".$aa['email']."'")->row();

            if ($query) {
            }else{

                $this->db->insert('vender',$aa);

            }

           

        }*/



        $query = $this->db->query("select * from vender");

        $list = $query->result(); 
        $expertises  = $this->Page_Model->fetch_all('area_expertise');
        foreach ($list as $key => $value) {
            $data = array();
            if(!empty($value->expertise)) { 
                $arrayVal = explode(',',$value->expertise); 
                $values = ""; 
                foreach($expertises as $expertise)  {    
                    if(in_array($expertise->id, $arrayVal)) { 
                        $values .=  " | ".$expertise->name; 
                    } 
                     
                }
                $values1 = ""; 
                foreach($expertises as $expertise)  {    
                    if(in_array($expertise->id, $arrayVal)) { 
                        $values1 .=  ", ".$expertise->name; 
                    } 
                     
                }
                $meta_title = trim($values,' | ').' | '.$value->fname.' '.$value->lname.' |'.' StyleBuddy'; 
                $meta_keyword = trim($values1,', ').', '.$value->fname.' '.$value->lname.','.' StyleBuddy'; 
                $data['meta_title'] = $meta_title;
                $data['meta_keyword'] = $meta_keyword; 
                $data['meta_description'] = $value->about; 

                $update = $this->db->update('vender',$data,array('id'=>$value->id));
                echo $this->db->last_query();
            }
            

            /*$query = $this->db->query("select * from states where id = '".$value->state."'")->row();
            if ($query) {
                $this->db->where('id',$value->id);
                $this->db->update('vender',['state_name'=>$query->name]);
            }
            $query = $this->db->query("select * from cities where id = '".$value->city."'")->row();
            if ($query) {
                $this->db->where('id',$value->id);
                $this->db->update('vender',['city_name'=>$query->city]);
            }*/
        }

        /*$state_name = $this->input->get('term');

        $segment2 = $this->input->get('expertise');

        

        $this->db->where('status',1);

        $this->db->where('slug',$segment2);  

        $expertises = $this->db->get('area_expertise')->row(); 



        $where = " where status = 1";

        $where .= "  AND state_name  LIKE '%". $state_name ."%'";

        $where .= "  AND FIND_IN_SET('". $expertises->id ."',expertise)";

        $where .= "  group by state_name";

        $where .= "  order by id desc";

        $query = $this->db->query("select vender.fname,vender.lname,vender.state_name,vender.state,vender.id from vender".$where);

        $list = $query->result(); 

        $result1 = array();

        if(!empty($list)) {

            foreach($list as $value) {

                $companyLabel['value'] = html_entity_decode($value->state_name);

                $companyLabel['id'] = html_entity_decode(base64_encode($value->state));

                array_push( $result1, $companyLabel);

            }

        }

        echo json_encode( $result1 );*/

    }

    public function search_stylist_by_city()    { 

        $city_name = $this->input->get('term');

        $segment2 = $this->input->get('expertise');

        $state = base64_decode($this->input->get('state'));

        

        $this->db->where('status',1);

        $this->db->where('slug',$segment2);  

        $expertises = $this->db->get('area_expertise')->row(); 



        $where = " where status = 1";

        $where .= "  AND city_name LIKE '%". $city_name ."%'";

       // $where .= "  AND state = '". $state ."'";

        $where .= "  AND FIND_IN_SET('". $expertises->id ."',expertise)";

        $where .= "  group by city_name";

        $where .= "  order by id desc";

        $query = $this->db->query("select vender.fname,vender.lname,vender.city_name,vender.city,vender.id from vender".$where);

        $list = $query->result(); 



        $result1 = array();

        if(!empty($list)) {

            foreach($list as $value) {

                $companyLabel['value'] = html_entity_decode($value->city_name);

                $companyLabel['id'] = html_entity_decode(base64_encode($value->city));

                array_push( $result1, $companyLabel);

            }

        }

        echo json_encode( $result1 );

    }



	public function search_stylist_by_name(){ 

        $stylist = $this->input->get('term');

        $this->db->select('vender.fname,vender.lname,vender.city_name,vender.city,vender.id');

        $this->db->from("vender");

        $this->db->where('status',1);

        $this->db->like('fname', $stylist, 'after');

        $this->db->order_by('id', 'DESC'); 

        $list = $this->db->get()->result();

        //echo $this->db->last_query();

        $result1 = array();

        if(!empty($list)) {

            foreach($list as $value) {

                $companyLabel['value'] = html_entity_decode($value->fname.' '.$value->lname);

                $companyLabel['id'] = html_entity_decode(base64_encode($value->id));

                array_push( $result1, $companyLabel);

            }

        }

        echo json_encode( $result1 );

    }

    public function stylistExpertByState($a = false){   

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment3 = $this->uri->segment(3);

        $segment = $segment1;

        if ($this->uri->segment(2)) {

            $segment = $segment1.'/'.$segment2;

        }

        $data['states']  = $this->db->get('states')->result();



        $this->db->where('status',1);

        $this->db->order_by('slug',$segment2);  

        $data['expertises'] = $this->db->get('area_expertise')->row(); 





        //$data['expertises']  = $this->Page_Model->fetch_all('area_expertise');

        

        $config = array();

        $this -> load -> library('pagination');

        $query = $this->db->get_where('vender',['status'=> 1 ]);

        $rowCount  = $query->num_rows();

        $par_page = 16; 

       

       

        $config = array();

        $config['total_rows'] = $rowCount;

        $config['per_page'] = $par_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

        $config['uri_segment'] = 3;

        $config['use_page_numbers'] = TRUE;

        $config["base_url"] = base_url($segment);

        //$config['suffix'] = '?' . http_build_query($_GET, '', "&");

        // $config['first_url'] = base_url($segment).'?' . http_build_query($_GET, '', "&");



        $this->pagination->initialize($config); 





        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if($page != 0){ $page = ($page-1) * $par_page; }

        

        $this->db->limit($par_page, $page);

        $this->db->where('status',1);

        $this->db->order_by('id',"desc");  

        $data['venders'] = $this->db->get('vender')->result(); 

       

        $data["p_links"] = $this->pagination->create_links();

        $this->load->view('Page/styling-expert',$data);

        //$this->load->view('Page/styling-and-image-management-services',$data);

    }



    public function stylistSearchPage(){

        $id = base64_decode($this->uri->segment(2));

        $data['venders'] = $this->db->query("select * from vender where city =  '".$id."' order by id DESC ")->result();

        //echo $this->db->last_query();

        $data['states']  = $this->db->get('states')->result();

        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise');

        $this->load->view('Page/styling-expert-by-city',$data); 

    }
    public function profile($idd = ''){
        if(empty($idd)) {
            redirect(base_url());
            $data['vender']  = $this->Page_Model->fetch_all('vender');

            $this->load->view('Page/style-buddies',$data); 

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


            

            $row = $this->db->get_where('vender',['id'=>$id,'display_status'=>1])->row();
            if(!$row){
                $lastPage = '';
        		$refer =  $this->agent->referrer();
        		$a  = explode('/',$refer);
        		foreach($a as $k=>$v){
        				$lastPage = $v;
        		}
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
            
            if($this->input->get('show')){
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
            }
            
            
            
            
            
           

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
                $this->load->view('Page/profile-page',$data);    

            } else {

                redirect(base_url());

            }

       } 
    }
    public function profile_develop($idd = ''){
        if(empty($idd)) {
            redirect(base_url());
             $data['vender']  = $this->Page_Model->fetch_all('vender');

             $this->load->view('Page/style-buddies',$data); 

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


            

            $row = $this->db->get_where('vender',['id'=>$id])->row();

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







            $data['expertises']  = $this->Page_Model->fetch_all('area_expertise');
            $data['ideas'] = $this->db->get_where('ideas',['vender_id'=>$id,'status'=> 1])->result();
            $data['idea_tag']  = $this->Page_Model->fetch_all('idea_tag'); 
            $data['seoData'] = $data['vender'];

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

                $this->load->view('Page/profile-page-develop',$data);    

            } else {

                redirect(base_url());

            }

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
                    $msg = ['success'=>'<span class="text-white bg-info p-2">'.$txt.' inserted Successfully!!</span>', 'rowCount'=> $rowsCount];
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
                        $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Date inserted Successfully!!</span>');
                    }else{
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Date already exist.</span>');
                    }
                    redirect('stylist-zone/available-dates');
                }
                
            }

            $data['stylist_availability'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE stylist_id ='.$venderId.' ORDER BY availability_date DESC')->result();
            $this->load->view('Page/vandor/available-dates',$data);
        } else {
            redirect();   
        } 
    }
    public function available_dates_delete($id) {
        $tbl = 'stylist_availability';
        $venderId = $this->session->userdata('venderId');
        $availability_date = date('Y-m-d');
        $delete = $this->db->delete($tbl, array('id' => $id,'stylist_id' => $venderId,'availability_date>='=>$availability_date));  
        if($delete) { 
            $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Date Deleted Successfully!!</span>');
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
                        $this->db->insert($tbl,$d); 
                        $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Date inserted Successfully!!</span>');
                    }else{
                        $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Date already exist.</span>');
                    }
                    redirect('stylist-zone/capture-video');
                 
                
            }
            $data['portfolio_video'] = $this->db->query('SELECT * FROM '.$tbl.' WHERE vender_id ='.$venderId.' AND videoType ="capture" ORDER BY id DESC')->result();
            $this->load->view('Page/vandor/capture-video',$data);
        } else {
            redirect();   
        } 
    }
    public function capture_video_delete($id) {
        $tbl = 'portfolio_video';
        $venderId = $this->session->userdata('venderId');
        $delete = $this->db->delete($tbl, array('id' => $id,'vender_id' => $venderId));  
        if($delete) { 
            $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Video Deleted Successfully!!</span>');
            redirect('stylist-zone/capture-video');
        } else {
            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
            redirect('stylist-zone/capture-video');
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
                $insert = $this->db->insert('portfolio_video',$data);
                //echo $this->db->last_query();
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
    public function fashiongram(){
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);
        $segment5 = $this->uri->segment(5);

        $segment = $segment1;
        $uri_segment = 2;
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        //$where = " where status = 1 AND user_type = 2 ";
        $where = " where status = 1 AND user_type = 2  AND portfolio_count != 0 ";
        $where .= "  order by experience desc";

        $query = $this->db->query("select * from vender".$where);
        
        /*$rows = $query->result();
        foreach($rows as $k=>$v){
            $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$v->id,'status'=> 1]);
            $total_portfolio = $ideas->num_rows();
            $this->common_model->commonUpdate('vender',['portfolio_count'=>$total_portfolio],['id'=>$v->id]);
        }
        */
        
        $rowCount = $query->num_rows();

        //echo $this->db->last_query();

        $par_page = 15; 

       



        $config = array();

        $this -> load -> library('pagination');



        $config = array();

        $config['total_rows'] = $rowCount;

        $config['per_page'] = $par_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

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
            $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$v->id,'status'=> 1]);
            $rows[$k]->portfolioCount = $total_portfolio = $ideas->num_rows();
            $rows[$k]->portfolioArray = $ideas->result();
            $rows[$k]->area_expertiseRow = array();
            if ($v->expertise) {
                $area_expertise = explode(',', $v->expertise);
                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                $rows[$k]->area_expertiseRow = $ideas;
            }
        }

        $data['venders'] = $rows;
        $data["p_links"] = $this->pagination->create_links();

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "fashiongram" and status=1')->row();

        if($list) {
            $data['seoData'] = $list;
        } 
        
        $this->load->view('Page/fashiongram',$data);

    }
    public function fashiongram_detail($idd){ 
        $dc = explode('Name=', $idd);
        $id = base64_decode($dc[0]);
        
        $ideas = $this->common_model->get_all_details('ideas',['vender_id'=>$id,'status'=> 1]);
        $data['portfolioCount'] = $ideas->num_rows();
        $data['portfolioArray'] = $ideas->result();
        $row = $this->db->get_where('vender',['id'=>$id])->row();
        if ($row->expertise) {
            $area_expertise = explode(',', $row->expertise);
            $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
            $row->area_expertiseRow = $ideas;
        }
        
        $data['seoData'] = $row;
        $this->load->view('Page/fashiongram-detail',$data);
    }
    public function fashiongram_video(){
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);
        $segment5 = $this->uri->segment(5);

        $segment = $segment1;
        $uri_segment = 2;
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        //$where = " where status = 1 AND user_type = 2 ";
        $where = " where status = 1 AND user_type = 2  AND portfolio_video_count != 0 ";
        $where .= "  order by experience desc";

        $query = $this->db->query("select * from vender".$where);
        /*$rows = $query->result();
        foreach($rows as $k=>$v){
            $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$v->id,'status'=> 1]);
            $rows[$k]->portfolioCount = $total_portfolio = $ideas->num_rows();
            $this->common_model->commonUpdate('vender',['portfolio_video_count'=>$total_portfolio],['id'=>$v->id]);
        }*/
        $rowCount = $query->num_rows();

        //echo $this->db->last_query();

        $par_page = 15; 

       



        $config = array();

        $this -> load -> library('pagination');



        $config = array();

        $config['total_rows'] = $rowCount;

        $config['per_page'] = $par_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

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
            $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$v->id,'status'=> 1]);
            $rows[$k]->portfolioCount = $ideas->num_rows();
            $rows[$k]->portfolioArray = $ideas->result();
            $rows[$k]->area_expertiseRow = array();
            if ($v->expertise) {
                $area_expertise = explode(',', $v->expertise);
                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                $rows[$k]->area_expertiseRow = $ideas;
            }
        }

        $data['venders'] = $rows;
        $data["p_links"] = $this->pagination->create_links();

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "fashiongram-video" and status=1')->row();

        if($list) {
            $data['seoData'] = $list;
        }         
        $this->load->view('Page/fashiongram-video',$data);

    }
    public function fashiongram_video_detail($idd){ 
        $dc = explode('Name=', $idd);
        $id = base64_decode($dc[0]);
        
        $ideas = $this->common_model->get_all_details('portfolio_video',['vender_id'=>$id,'status'=> 1]);
        $data['portfolioCount'] = $ideas->num_rows();
        $data['portfolioArray'] = $ideas->result();
        
        $row = $this->db->get_where('vender',['id'=>$id])->row();
        if ($row->expertise) {
            $area_expertise = explode(',', $row->expertise);
            $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
            $row->area_expertiseRow = $ideas;
        }
        $data['seoData'] = $row;
        $this->load->view('Page/fashiongram-video-detail',$data);
    }
    
    public function checkout_stylist_book(){  
        $postData = $this->input->post();
        $lastPage = '';
        $refer =  $this->agent->referrer();
        $a  = explode('/',$refer);
        foreach($a as $k=>$v){
                $lastPage = $v;
        }
        $data['lastPage'] = $refer;
        if (empty($postData['package_id'])) {
            redirect($refer);
        }
        if($this->session->userdata('userType')) {
            $vendor_id = $postData['vendor_id'];
            $package_id = $postData['package_id'];
            $package_column = $postData['package_price'];

            $condition = " WHERE id = '".$vendor_id."'";
            $r = $this->common_model->get_all_details_query('vender',$condition)->row_array();
            $data['vendor_row']      = $r;
            $condition = " WHERE id = '".$package_id."'";
            $r = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
            $package_price = $r[$package_column];

            $data['package_row']      = $r;
            $data['package_price']      = $package_price;
            $data['package_id']      = $package_id;
            $data['package']      = $package_column;
            $data['vendor_id']      = $vendor_id;

            $data['user'] = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 
            $data['callback_url']       = base_url().'razorpay/stylist_service_book';
            $data['surl']               = base_url().'razorpay/stylistbook_success';;
            $data['furl']               = base_url().'razorpay/failed';;
            $data['currency_code']      = 'INR';
            $user_shipping_address= $this->db->get_where('user_shipping_address',['user_id'=> $this->session->userdata('userId')])->result_array(); 
            $data['user_shipping_address'] = $user_shipping_address; 
        }else{
            if (!empty($this->input->post('userEmail')) && !empty($this->input->post('userPassword'))) {
                $data['lastPage'] = $this->input->post('lastPage');
                $email = $this->input->post('userEmail');
                $password = md5($this->input->post('userPassword'));
                $table = 'vender';
                $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND password="'.$password.'"')->row();
                if($user) {
                    if($user->status != 1) {
                        $this->session->set_flashdata('message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');
                    } else {
                        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];
                        $this->session->set_userdata($frontUserData);
                        $refer = $data['lastPage'];
                        $a  = explode('/',$refer);
                        foreach($a as $k=>$v){
                                $lastPage = $v;
                        }
                        if ($lastPage == 'login' || $lastPage == 'registration') {
                            redirect(base_url());    
                        }else{
                            redirect($data['lastPage']);    
                        }
                   }
                } else {
                    $this->session->set_flashdata('message','<p class="text-danger">Invalid email or Password, Try Again</p>');
                }
            }
            $data['user'] = array(); 
            $data['callback_url']       = '';
            $data['surl']               = '';
            $data['furl']               = '';
            $data['currency_code']      = 'INR';
            $data['user_shipping_address'] =  array(); 
        }
        $this->load->view('Page/checkout-stylist-book',$data);
    }

    public function postjoblogin(){
        $postData = $this->input->post();
        $lastPage = '';
        $refer =  $this->agent->referrer();
        $a  = explode('/',$refer);
        foreach($a as $k=>$v){
                $lastPage = $v;
        }
        $data['lastPage'] = $refer;
        if($this->session->userdata('userType')) {
            redirect($postData['lastPage']);  
        }
        if (!empty($this->input->post('userEmail')) && !empty($this->input->post('userPassword'))) {
            $data['lastPage'] = $this->input->post('lastPage');
            $email = $this->input->post('userEmail');
            $user_type = $this->input->post('user_type');
            $password = md5($this->input->post('userPassword'));
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.$password.'"')->row();
            //echo $this->db->last_query();die;
            if($user) {
                if($user->status) {
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    $cart = $this->cart->contents();
                    $refer = $data['lastPage'];
                    $a  = explode('/',$refer);
                    foreach($a as $k=>$v){
                            $lastPage = $v;
                    }
                    if ($lastPage == 'login' || $lastPage == 'registration') {
                        if ($user->user_type == '2') {
                           redirect('stylist-zone/dashboard'); 
                        }else if ($user->user_type == '4') {
                            $this->session->set_userdata('boutique_id',$user->id);
                            redirect($postData['lastPage']);
                        }else{
                            //$msg = 'Welcome to Stylebuddy- The home of fashion styling.<br/><br/><a class="btn btn-success" href="'.base_url('select-service').'">Find a stylist</a>';
                            //$this->session->set_flashdata('message_login', $msg);
                            redirect($postData['lastPage']);
                        }
                    }else{
                        if ($user->user_type == '2') {
                           redirect('stylist-zone/dashboard'); 
                        }else if ($user->user_type == '4') {
                            $this->session->set_userdata('boutique_id',$user->id);
                            redirect($postData['lastPage']);
                        }else if ($user->user_type == '5') {
                            $this->session->set_userdata('boutique_id',$user->id);
                            $msg = 'Welcome to StyleBuddy. Start posting jobs.<br/><br/><a class="btn btn-success" href="'.base_url('postjob/index').'">Jobs DashBoard</a>';
                            $this->session->set_flashdata('message_login', $msg);
                            //redirect($postData['lastPage']);
                            redirect(base_url('postjob/index'));
                        }else{
                            //$msg = 'Welcome to Stylebuddy- The home of fashion styling.<br/><br/><a class="btn btn-success" href="'.base_url('select-service').'">Find a stylist</a>';
                            //$this->session->set_flashdata('message_login', $msg);
                            redirect($postData['lastPage']);
                        }  
                    }
                } else {
                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your Account is disabled. Please contact administrator</span>');
                }
            } else {
                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');
            }
        }
        $this->load->view('Page/post-job-login',$data);
        
    }

    public function postjobregister(){
        if(!empty($this->input->post('fname'))){
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[vender.email]');
            $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
            $this->form_validation->set_rules('mobile','Mobile','required|trim');
            $this->form_validation->set_rules('state','State','required|trim');
            $this->form_validation->set_rules('city','City','required|trim');
            $this->form_validation->set_rules('pin','PineCode','required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-primary mt-1">','</span>');

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaTextCode');
            

            if( $this->form_validation->run() == false) {
                 
            }  else {
                if($inputCaptcha === $sessCaptcha){
                    $this->uploadPath = 'assets/vandor/images/';
                    $image = $this->uploadSingleImage('image',$this->uploadPath);
                    if(!empty($image)){
                        $data['image'] = $image;
                    }
                    $image = $this->uploadSingleImage('portfolio_pdf',$this->uploadPath);
                    if(!empty($image)){
                        $data['portfolio_pdf'] = $image;
                    }

                    $data['user_type'] = 5;
                    $data['status'] = 0;
                    $data['fname'] = $this->input->post('fname');
                    $data['email'] = $this->input->post('email');
                    $data['mobile'] = $this->input->post('mobile');
                    $data['contact_person_name'] = $this->input->post('contact_person_name');
                    $data['company_type'] = $this->input->post('company_type');
                    $data['business_nature'] = $this->input->post('business_nature');
                    $data['state'] = $state = $this->input->post('state');
                    $data['city'] = $city = $this->input->post('city');
                    $data['pin'] = $this->input->post('pin');
                    $data['gstin'] = $this->input->post('gstin');
                    $data['password'] = md5($this->input->post('password'));
                    
                    
                    
                    $r = $this->db->query("select * from states where id = ".$state)->row();
                    $data['state_name'] = $r->name;
                    $r = $this->db->query("select * from cities where id = ".$city)->row();
                    $data['city_name'] = $r->city;
                    $data['created_at']  = date('Y-m-d h:i:s');

                    $insert = $this->db->insert('vender',$data);
                    $insert_id = $this->db->insert_id(); 
                    $updateTrue = $insert_id;     
                    $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
                    $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);




                    $attach ='';
                    if(!empty($data['cv'])) {
                        $attach = $config['upload_path'].$data['cv'];
                    }
                    $subject = 'Welcome to Stylebuddy Fashion Platform- Confirm your Email';
                    $option .= '<div>';
                        $option =  '<p style="font-size:18px;">Thank you for signing up on the stylebuddy Fashion platform- the No.1 destination for fashion styling. We are excited to have you part of the stylebuddy platform.</p>';
                        $option .= '<p style="font-size:18px;">In order to access the platform, please confirm your account by clicking the button below:</p>';
                        $option .= '<p style="font-size:16px;text-align:center;">';
                            $option .= '<a style="background: #742ea0;color: #FFF;text-decoration: none; padding: 1em;text-transform: uppercase;font-weight: bold;border-radius: 4px;margin-top: 30px;display: inline-block;" href="'.base_url('page/activeaccountjobs/'.$activate_string).'">Confirm Account</a>';
                        $option .= '</p>';
                    $option .= '</div>';
                    $option .= '<div style="text-align: center;background: gray;padding: 5px;margin-top: 50px;color:#fff">';
                        $option .= '<p><b>Need more help?</b></p>';
                        $option .= '<p>If you have any trouble confirming your account, please send an email to <p>';
                        $option .= '<p><a href="mailto:'.$this->site->email.'" style="color: #742ea0; text-decoration: none;"><i class="fa fa-envelope-o" aria-hidden="true"></i> '.$this->site->email.'</a></p>';
                    $option .= '</div>';

                    // Send email to admin
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                
                    $to = TO_EMAIL;
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach='');
                     
                     
                    
                    $mailContent =  mailHtmlHeader($this->site);
                        $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($data['fname'].' '.$data['lname']).'</h3>';
                        $mailContent .= $option;
                    $mailContent .= mailHtmlFooter($this->site);
                    
                    $to      =  $data['email'];
                    $from = FROM_EMAIL;
                    $from_name = $this->site->site_name;
                    $cc = CC_EMAIL;
                    $reply = REPLY_EMAIL;
                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach='');
                     
                    
                    if($insert_id) {
                        $this->session->set_flashdata('register_message',"<span class='text-success mb-3'>Please check your e-mail ID and verify the account and start posting jobs.</span>");
                        redirect('page/postjoblogin');
                    }
                }else{
                    $this->session->set_flashdata('register_message','Please enter correct captch'); redirect('registration','refresh');
                }
            }
        }
        
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-zone-registration"')->row();
     
        if($list) {
            $style['seoData'] = $list;
        }
        
        
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        $style['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
        $style['states'] = $this->db->get('states')->result();
        
        $this->load->view('Page/post-job-register',$style);
        
    }

    public function browsejobs(){
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment = $segment1.'/'.$segment2;
        $uri_segment = 3;
        //$style['jobs'] = $this->db->get('jobs')->result_array();
        $where .= "  WHERE id != 0 ";
        $job_location = $this->input->get('job_type');
        if ($job_location) {
            $ss = '';
            $i = 0;
            foreach ($job_location as $key => $value) {
                if ($i>0) {
                    $ss .= " OR ";
                }
                $ss .= " job_type = '". $value ."' ";
                $i++;
            }
            $where .= "  AND (" .$ss. ")";
        }

        $job_location = $this->input->get('city');
        if ($job_location) {
            $ss = '';
            $i = 0;
            foreach ($job_location as $key => $value) {
                if ($i>0) {
                    $ss .= " OR ";
                }
                $ss .= " city = '". $value ."' ";
                $i++;
            }
            $where .= "  AND (" .$ss. ")";
        }

        $where .= "  order by id desc";
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $query = $this->db->query("select * from jobs".$where);
        //echo $this->db->last_query();
        $rowCount = $query->num_rows();
        $par_page = 5; 
        $config = array();
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $rowCount;
        $config['per_page'] = $par_page;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbers'] = TRUE;
        //$config["base_url"] = base_url($segment);

        $config["base_url"] = base_url().$segment;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = base_url() . $segment.'/?' . http_build_query($_GET, '', "&");


        $this->pagination->initialize($config); 
        if($page != 0){ $page = ($page-1) * $par_page; }
        $where .= " limit ".$page.", ".$par_page;
        $query = $this->db->query("select * from jobs".$where);
        $rows = $query->result_array();


        foreach ($rows as $key1 => $row) {
            $q = $this->common_model->get_all_details_distinct_query('job_apply_id','job_apply',' WHERE job_id = "'.$row['id'].'"'); 
            $data = $q->result_array(); 
            $num_rows = $q->num_rows(); 
            foreach ($data as $key => $value) {
                $r = $this->common_model->get_all_details('vender',array('id'=>$value['job_apply_id']))->row_array(); 
                $data[$key]['job_apply_image'] = $r['image'];
            }
            $rows[$key1]['job_apply'] = $data;
            $rows[$key1]['job_apply_num_rows'] = $num_rows;
        }


        $style['jobs'] = $rows;
        $style["p_links"] = $this->pagination->create_links();
        $style["city"]  = $this->db->query("select DISTINCT(city) from jobs order by city ASC")->result_array();
        
        
        $list = array();
        //$list['meta_title'] = $row['company'].' | '.$row['city'].' | StyleBuddy';
        
        $job_location = $this->input->get('city');
        $ss = '';
        if ($job_location) {
            $i = 0;
            foreach ($job_location as $key => $value) {
                if ($i>0) {
                    $ss .= " , ";
                }
                $ss .= $value;
                $i++;
            }
        }
        if($ss){
            $list['meta_title'] = 'Fashion Jobs in '.$ss.' | StyleBuddy | Styling Jobs';
        }else{
            $list['meta_title'] = 'Fashion Jobs | StyleBuddy | Styling Jobs';
        
        }
        
        $list['meta_description'] = 'Find thousands of fashion jobs, styling jobs and designer jobs on StyleBuddy. The No. 1 Fashion styling job board for brands, Agencies, Production Houses and Individuals.';
        $list['meta_keyword'] = 'Fashion Jobs, Styling Jobs, Fashion careers, fashion designer jobs';
        $style['seoData'] = (object)$list;
        
        $this->load->view('Page/browse-a-jobs',$style);
        
    }
 
    public function browsejobdetail(){
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
         
        $where .= " where slug = '".$segment2."'  order by id desc";
        $query = $this->db->query("select * from jobs".$where);
        $rowCount = $query->num_rows();
        $row = $query->row_array();
        $total_applicant = $row['count_view'] + 1;
        $data1['count_view'] = $total_applicant; 
        $where = ['id'=>$row['id'] ];
        $table = 'jobs';
        $this->common_model->commonUpdate($table,$data1,$where); 

        $venderId = $this->session->userdata('venderId');
        $data = $this->common_model->get_all_details('vender',array('id'=>$venderId))->row_array(); 
        $style['loginUserRow'] = $data;
        $style['jobRow'] = $row;
        


        $q = $this->common_model->get_all_details_distinct_query('job_apply_id','job_apply',' WHERE job_id = "'.$row['id'].'"'); 
        $data = $q->result_array(); 
        $num_rows = $q->num_rows(); 
        foreach ($data as $key => $value) {
            $r = $this->common_model->get_all_details('vender',array('id'=>$value['job_apply_id']))->row_array(); 
            $data[$key]['job_apply_image'] = $r['image'];
        }
        $style['job_apply'] = $data;
        $style['job_apply_num_rows'] = $num_rows;
        //var_dump($this->session->userdata('userType'));

        if($this->session->userdata('userType') == 2  ) {
            $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $about = str_word_count($profile->about);
            $more_about = str_word_count($profile->more_about);
            $projectCount  =  $this->common_model->get_all_details('ideas',array('vender_id'=>$this->venderId,'status'=>1))->num_rows();
            $videoCount  =  $this->common_model->get_all_details('portfolio_video',array('vender_id'=>$this->venderId,'status'=>1))->num_rows();
            $servicesCount  =  $this->common_model->get_all_details('services_vendor',array('vendor_id'=>$this->venderId))->num_rows();


            $profile_update_ratio = 0;
            $stylist_profile = array();
            
            if ($about >= 50) {
                $profile_update_ratio += 20;
                $stylist_profile['about'] = 1;
            }else{
                $stylist_profile['about'] = 0;
                $stylist_profile['aboutTotal'] = $about;
            }

            if ($more_about >= 500) {
                $profile_update_ratio += 20;
                $stylist_profile['more_about'] = 1;
            }else{
                $stylist_profile['more_about'] = 0;
                $stylist_profile['more_aboutTotal'] = $more_about;
            }

            if ($projectCount >= 5) {
                $profile_update_ratio += 20;
                $stylist_profile['projectCount'] = 1;
            }else{
                $stylist_profile['projectCount'] = 0;
                $stylist_profile['projectCountTotal'] = $projectCount;
            }

            if ($videoCount >= 5) {
                $profile_update_ratio += 20;
                $stylist_profile['videoCount'] = 1;
            }else{
                $stylist_profile['videoCount'] = 0;
                $stylist_profile['videoCountTotal'] = $videoCount;
            }

            if ($servicesCount >= 1) {
                $profile_update_ratio += 20;
                $stylist_profile['servicesCount'] = 1;
            }else{
                $stylist_profile['servicesCount'] = 0;
                $stylist_profile['servicesCountTotal'] = $servicesCount;
            }

            $ab = array();
            $ab['profile_update_ratio'] = $profile_update_ratio;
            $this->db->update('vender',$ab,array('id'=>$this->venderId));
            $style['stylist_profile_complete'] = $stylist_profile;
            $style['stylist_profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        }else{
            $style['stylist_profile'] = array();
        }
        $list = array();
        $list['meta_title'] = $row['job_title'].' | '.$row['city'].' | StyleBuddy';
        $list['meta_description'] = strip_tags($row['job_description']);
        $list['meta_keyword'] = 'Fashion Jobs, Styling Jobs, Fashion careers, fashion designer jobs';
        $style['seoData'] = (object)$list;
        $this->load->view('Page/browse-a-jobs-detail',$style);
    }
    public function applyjob(){
        /* Send email to admin*/
        $table = 'jobs';
        $venderId = $this->session->userdata('venderId'); 
        $id = $this->input->post('id');
        $row = $this->common_model->get_all_details($table,array('id'=>$id))->row(); 
        //echo $this->db->last_query();
        if($row) {
            $total_applicant = $row->total_applicant + 1;
            $data1['total_applicant'] = $total_applicant; 
            $where = ['id'=>$id ];
            $this->common_model->commonUpdate($table,$data1,$where); 
            //echo $this->db->last_query();
            $rec = array();
            $rec['job_id'] = $id;
            $rec['job_apply_id'] = $venderId;
            $rec['created_at'] = date('Y-m-d h:i:s');
            $this->common_model->simple_insert('job_apply',$rec); 
            //echo $this->db->last_query();
            $job_admin_id = $row->job_admin_id;
            $data = $this->common_model->get_all_details('vender',array('id'=>$job_admin_id))->row_array(); 
        
        
            $option = '<p>Thank you for applying for the position of "'.$row->job_title.'".</p>';
            $option .= '<p><b>User Details:</b></p>';
            $option .= '<p><b>Name:</b> '.$data['fname'].' '.$data['lname'].'<br/>';
            $option .= '<p><b>Email:</b> '.$data['email'].'<br/>';
            $option .= '<p><b>Phone:</b> '.$data['mobile'].'</p>';
            
            $subject = $this->site->site_name . ' Job applied';
    
            /*$mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear </b>Admin,<br/></h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            $to = TO_EMAIL;
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach = "");
            */
            $mailContent =  mailHtmlHeader($this->site);
                $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear  </b>'.ucwords($data['fname'].' '.$data['lname']).',<br/></h3>';
                $mailContent .= $option;
            $mailContent .= mailHtmlFooter($this->site);
            $to      =  $data['email'];
            $from = FROM_EMAIL;
            $from_name = $this->site->site_name;
            $cc = CC_EMAIL;
            $reply = REPLY_EMAIL;
            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
    
            $msg = array('success' => "<span class='text-success p-2'>Your profile has been submitted to the employer. As next steps, you will hear back directly from the advertiser on your selection process. Please keep updating your profile to attract more job opportunities. Thank You.</span>");
            echo json_encode($msg);
        }
        
    }
    public function product_review(){
        $postData = $this->input->post();
        $id =  $postData['id'];
        $name =  $postData['name'];
        $email =  $postData['email'];
        $comment =  $postData['comment'];
        $rating =  $postData['rating'];
        $curlPost['product_id'] = $id;
        $curlPost['email'] = $email;
        $reviewRow = $this->db->query("select * from product_review where product_id =  '".$id."' and email =  '".$email."'")->row();
        if ($reviewRow) {
            $msg = 'You have aready given rating';
        }else{
            $curlPost['from_user_id'] = $this->session->userdata('userId');
            $curlPost['name'] = $name;
            $curlPost['comment'] = $comment;
            $curlPost['rating'] = $rating;
            $curlPost['created_at'] = date('Y-m-d h:i:s');
            $this->db->insert('product_review',$curlPost);
            $msg = 'Thanks you for given feedback!';
        }
        echo $msg;
    }
}

