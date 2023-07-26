<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaign extends MY_Controller {
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
    public function index(){ 
        $fffff = $this->common_model->get_all_details('user_order',array())->result();
        foreach ($fffff as $key => $value) {
            $orderId = $value->id;
            $up = array();
            $up['order_id'] = $value->order_id;
            //$this->common_model->commonUpdate('user_order',$up,array('id'=>$orderId));
            $this->common_model->commonUpdate('user_order_details',$up,array('orderId'=>$orderId));
    
        }
        
        $data = $this->Page_Model->common_all('');
        $postData = $this->input->post();
        if (!empty($postData['getStartedContact']) && !empty($postData['getStartedEmail']) && !empty($postData['getStartedName'])) {
            
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
         

        $table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $data['our_services'] = $this->db->get_where($table_corporate,['status'=> 1,'domain_id'=> $domain_nameRow->id])->result(); 
            }else{
                $data['our_services'] = $this->db->get_where($table,['status'=> 1])->result();
            }
        }else{
            $data['our_services'] = $this->db->get_where($table,['status'=> 1])->result();  
        }


        $data['expertises']  = $this->Page_Model->fetch_all('area_expertise_looking');
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

        
        
        $catid = 56;
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        
         
        $wh = ' WHERE parent_id = "'.$catid.'" order by ui_order ASC';
        $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rowsCatF as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = "'.$v['id'].'" order by ui_order ASC';
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
                $str .= ' FIND_IN_SET("'.$value['id'].'",cat_id)';
                foreach ($value['child'] as $key1 => $value1) {
                    $str .= ' OR '; 
                    $str .= ' FIND_IN_SET("'.$value1['id'].'",cat_id)';
                    foreach ($value1['child'] as $key2 => $value2) {
                        $str .= ' OR '; 
                        $str .= ' FIND_IN_SET("'.$value2['id'].'",cat_id)';
                        $i++;
                    }
                    $i++;
                }
                $i++;
            }
            if ($str) {
                $query .= " AND (". $str." OR  FIND_IN_SET('".$catid."',cat_id) ) ";
            }
        }else{
            $query .= ' AND FIND_IN_SET("'.$catid.'",cat_id)';
        }
        $sortBy = ' order by id desc';
        $rowsCatF = array(); 
        $wh = ' WHERE id = "'.$catid.'" order by ui_order ASC';
        $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rowsCatF as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE id = "'.$v['parent_id'].'" order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rowsCatF[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
            }
        }
        $query .= $sortBy;
        $query .= ' limit 0,4';
        $result = $this->db->query($query);
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

             
            $where = "WHERE status = 1 AND product_id = '".$productDetails->id."' order by id DESC";
            $query = $this->common_model->get_all_details_query("product_review",$where);
            $reviews = $query->result_array();

            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $where = "WHERE id = '".$val11['from_user_id']."'";
                    $query = $this->common_model->get_all_details_query("vender",$where);
                    $reviewUser = $query->row_array();
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
                $products[$key]->sizesArray = array();  
            }
        }
        $data['products_women'] =  $products;
       
         
        $catid = 55;
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        
         
        $wh = ' WHERE parent_id = "'.$catid.'" order by ui_order ASC';
        $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rowsCatF as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = "'.$v['id'].'" order by ui_order ASC';
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
                $str .= ' FIND_IN_SET("'.$value['id'].'",cat_id)';
                foreach ($value['child'] as $key1 => $value1) {
                    $str .= ' OR '; 
                    $str .= ' FIND_IN_SET("'.$value1['id'].'",cat_id)';
                    foreach ($value1['child'] as $key2 => $value2) {
                        $str .= ' OR '; 
                        $str .= ' FIND_IN_SET("'.$value2['id'].'",cat_id)';
                        $i++;
                    }
                    $i++;
                }
                $i++;
            }
            if ($str) {
                $query .= " AND (". $str." OR  FIND_IN_SET('".$catid."',cat_id) ) ";
            }
        }else{
            $query .= ' AND FIND_IN_SET("'.$catid.'",cat_id)';
        }
        $sortBy = ' order by id desc';
        $rowsCatF = array(); 
        $wh = ' WHERE id = "'.$catid.'" order by ui_order ASC';
        $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rowsCatF as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE id = "'.$v['parent_id'].'" order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rowsCatF[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
            }
        }
        $query .= $sortBy;
        $query .= ' limit 4,4';
        $result = $this->db->query($query);
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

             
            $where = "WHERE status = 1 AND product_id = '".$productDetails->id."' order by id DESC";
            $query = $this->common_model->get_all_details_query("product_review",$where);
            $reviews = $query->result_array();

            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $where = "WHERE id = '".$val11['from_user_id']."'";
                    $query = $this->common_model->get_all_details_query("vender",$where);
                    $reviewUser = $query->row_array();
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
                $products[$key]->sizesArray = array();  
            }
        }
        $data['products_men'] =  $products;

        

        
        $where = "WHERE user_type = 2 and image != '' ORDER BY feedback_rating DESC  limit 0,30";
        $query = $this->common_model->get_all_details_query("vender",$where);
        $rows = $query->result();
        foreach($rows as $k=>$v){
            $where = "WHERE status = 1 AND user_id = '".$v->id."' ORDER BY id DESC";
            $query = $this->common_model->get_all_details_query("review",$where);
            $row = $query->row();
            $rows[$k]->review = $row;
        }
        $data['featured_stylist'] = $rows;

        $brand = $this->common_model->get_all_details('brand',array())->result();
        $data['brand'] = $brand;

        $occasion_stylist_category = $this->common_model->get_all_details('occasion_stylist_category',array())->result();
        $data['occasion_stylist_category'] = $occasion_stylist_category;

        $data['parentCategory'] = $this->data['parentCategory'];



        $this->load->view('front/template/header',$data);
        $this->load->view('front/index',$data);
        $this->load->view('front/template/footer',$data);

    }
    
    
}

