<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {
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
    public function emailcheck() {
        $email = $this->input->post('checkEmail');
        $value = $this->db->get_where('vender',['email'=> $email ])->row();
        if(!empty($value)) {  echo 1; } else { echo 0;  }
        die;
    }
    public function emailcheck_corporate() {
        $email = $this->input->post('checkEmail');
        $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
        $domain_nameRow = $this->db->get_where('corporate_domain',['domain_name'=> $domain_name,'status'=> 1 ])->row();
        if ($domain_nameRow) {
            $value = $this->db->get_where('vender',['email'=> $email ])->row();
            if(!empty($value)) {  echo 1; } else { echo 0;  }
        }else{ echo 2;  } die;
    }
    public function corporateLogin(){
        /*if($this->session->userdata('userType')) {
            redirect($postData['lastPage']);  
        }   
        $postData = $this->input->post();
        
        $data['seoData'] = array();
        //$list = $this->db->query('select * from cms_pages where slug = "register-as-a-user" and status=1')->row();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-corporate-account" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }*/
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
            $user_type = 6;
            $password = md5($this->input->post('userPassword'));
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.$password.'"')->row();
            
            if($user) {
                if($user->email_verification) {
                    if($user->status) {
                        $user_id = $user->id;
                        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                        $this->session->set_userdata($frontUserData);
                        
                        
                        $user_id = $user->id;
                        $idm = $this->session->userdata('session_user_id_temp');
                        $updateArraywish = array( 'user_id' => $user_id);
                     
                        $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                        //echo $this->db->last_query();
                        $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                        //echo $this->db->last_query();
                        $this->session->set_userdata('session_user_id_temp',$user_id);
                        
                        $cart = $this->cart->contents();
                        $refer = $data['lastPage'];
                        $a  = explode('/',$refer);
                        foreach($a as $k=>$v){
                                $lastPage = $v;
                        }
    
                        //$this->session->set_flashdata('login_message_shop_page','<h5>Welcome to Stylebuddy, Explore our fashion Styling Services</h5>');
    
                        if ($user->user_type == '6') {
                           redirect('services'); 
                        }else{
                            redirect(base_url());
                        } 
                        
                         
                        
                    } else {
                        $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your Account is disabled. Please contact administrator</span>');
                    }
                } else {
                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your profile has not been activted. Please verify your profile by checking your email</span>');
                }
            } else {
                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');
            }
        }
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-corporate-account" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/login-corporate',$data);   
    }
    public function corporateLogin_olddd(){
        if($this->session->userdata('userType')) {
            redirect($postData['lastPage']);  
        }   
        $postData = $this->input->post();
        
        $data['seoData'] = array();
        //$list = $this->db->query('select * from cms_pages where slug = "register-as-a-user" and status=1')->row();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-corporate-account" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/login-corporate',$data);   
    }
    public function loginAjaxWithOtp(){
        $postData = $this->input->post();
        $email = $postData['userEmail'];
        $password = $postData['userPassword'];
        $login_otp = $postData['login_otp'];
        $user_type = 6;
         
        $response = array();
        if (!empty($email) && !empty($password)) {
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where('corporate_domain',['domain_name'=> $domain_name,'status'=> 1 ])->row();
            if ($domain_nameRow) {
                $table = 'vender';
                $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND login_otp="'.$login_otp.'" AND user_type="'.$user_type.'" AND password="'.md5($password).'"')->row();
                 
                if($user) {
                    if($user->status) {
                        $user_id = $user->id;
                        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                        $this->session->set_userdata($frontUserData);
                        $user_id = $user->id;
                        $idm = $this->session->userdata('session_user_id_temp');
                        $updateArraywish = array( 'user_id' => $user_id);
                    
                        $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                        //echo $this->db->last_query();
                        $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                        //echo $this->db->last_query();
                        $this->session->set_userdata('session_user_id_temp',$user_id);
                        $response['status'] = 'success';
                        $response['response'] = 'You have logged in';
                    } else {
                        $response['status'] = 'fail';
                        $response['response'] = 'Your Account is disabled. Please contact administrator';
                    }
                } else {
                    $response['status'] = 'fail';
                    $response['response'] = 'Invalid OTP, Please Try Again';
                }
            }else{
                $response['status'] = 'fail';
                $response['response'] = 'Please enter valid corporate mail ID.';
            }
        }else{
            $response['status'] = 'fail';
            $response['response'] = 'Please enter username and password';
        }
        echo json_encode($response);
    }
    public function loginAjaxSendOtp(){
        $postData = $this->input->post();
        $email = $postData['userEmail'];
        $password = $postData['userPassword'];
        $user_type = 6;
         
        $response = array();
        if (!empty($email) && !empty($password)) {

            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where('corporate_domain',['domain_name'=> $domain_name,'status'=> 1 ])->row();
            if ($domain_nameRow) {
                $table = 'vender';
                $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.md5($password).'"')->row_array();
                 
                if($user) {
                    if($user['status']) {
                        $login_otp  =  random_number(4);
                        $this->db->where('email', $email);
                        $this->db->update('vender',['login_otp'=> $login_otp,'updated_at' => date('Y-m-d H:i:s')]); 

                            


                        $subject = 'Welcome to Stylebuddy Fashion Platform- Login OTP';
                        $option = '<style>';
                            $option .= '
                                .banner{background: #FFFA00; }
                                .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                                .banner img {width: 100%; height: 190px; object-fit: cover; }
                                .meddle_content{padding:30px 40px; background:#fff;}
                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';
                        $option .= '</style>';
                         
                        $mailContent =  mailHtmlHeader_New($this->site);
                            $mailContent .= $option;
                            $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to the Stylebuddy</b></div>';
                            
                            $mailContent .= '<div style="clear: both;"></div>';
                            $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                                $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($user['fname'].' '.$user['lname']).'</h4>';
                               $mailContent .= '<p>Your Login OTP is : '.$login_otp.'</p>';
                            $mailContent .= '</div>';
                        $mailContent .= mailHtmlFooter_New_1($this->site);
                        $to      =  $user['email'].',vijay@gleamingllp.com';
                        $from = FROM_EMAIL;
                        $from_name = $this->site->site_name;
                        $cc = CC_EMAIL;
                        $reply = REPLY_EMAIL;
                        $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                        $response['status'] = 'success';
                        $response['response'] = 'Please check OTP sent on your corporate mail ID to login';
                    } else {
                        $response['status'] = 'fail';
                        $response['response'] = 'Your Account is disabled. Please contact administrator';
                        //echo json_encode($response);die;
                    }
                } else {
                    $response['status'] = 'fail';
                    $response['response'] = 'Invalid email or Password, Try Again';
                    //echo json_encode($response);die;
                }
            }else{
                $response['status'] = 'fail';
                $response['response'] = 'Please enter valid corporate mail ID.';
                //echo json_encode($response);die;
            }
        }else{
            $response['status'] = 'fail';
            $response['response'] = 'Please enter username and password';
            //echo json_encode($response);die;
        }
        echo json_encode($response);
    }
    public function corporateRegistration(){
        if($this->session->userdata('userType')) {
            redirect($postData['lastPage']);  
        }
        $postData = $this->input->post();
        if ($postData) {
            $this->form_validation->set_rules('fname', 'First Name', 'required|trim'); 
            $this->form_validation->set_rules('lname', 'Last Name', 'required|trim'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email[vender.email]');
            //$this->form_validation->set_rules('employee_id', 'Employee Id', 'required|trim'); 
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]'); 
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
            $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another'); 
            if( $this->form_validation->run() == false) {
            }  else {
                $user = $this->db->query('select * from vender WHERE email="'.$postData['email'].'" ')->row();
                if($user) {
                    $this->session->set_flashdata('imgBerror_','Your Email Id is already registered'); 
                    redirect(base_url('corporate-registration'));
                }else{
                    $check_content_sightengine = array();
                    $check_content_sightengine['fname'] = $postData['fname'];;
                    $check_content_sightengine['lname'] = $postData['lname'];;
                    $check_content_sightengine['email'] = $postData['email'];;
                    $dd = check_content_sightengine($check_content_sightengine);
                    if ($dd) {
                        $this->session->set_flashdata('imgBerror_','Your request could not be submitted because you enter inappropriate content.'); 
                    }else{

                        /*$inputCaptcha = $this->input->post('captcha');
                        $sessCaptcha = $this->session->userdata('captchaTextCode');
                        if($inputCaptcha === $sessCaptcha){*/
                            $data['user_type'] = 6;
                            $data['status'] = 0;
                            $email = $this->input->post('email');
                            $data['mobile'] = $this->input->post('mobile');
                            $data['fname'] = $this->input->post('fname');
                            $data['lname'] = $this->input->post('lname');
                            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
                            $data['email'] = $email;
                            //$data['employee_id'] = $this->input->post('employee_id');
                            $data['password'] = md5($this->input->post('password'));

                            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
                            $domain_Row = $this->db->get_where('corporate_domain',['domain_name'=> $domain_name,'status'=> 1 ])->row();
                            $data['domain_id'] = $domain_Row->id;
                            $data['corporate_company_id'] = $domain_Row->corporate_company_id;


                            $country = 101;
                            $state = $this->input->post('state');
                            $city = $this->input->post('city');
                            
                            $data['country'] = $country;
                            $data['state'] = $state;
                            $data['city'] = $city;
                            
                            $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                            $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                            $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
                
                            $data['country_name'] = $countryRow->name;
                            $data['state_name'] = $statesRow->name;
                            $data['city_name'] = $cityRow->name;


                            $data['created_at']  = date('Y-m-d h:i:s');
                            $data['ip_address'] = $this->input->ip_address();
                            $data['user_agent'] = $this->input->user_agent();
                            $data['browser'] = $this->agent->browser();
                            $data['browserVersion'] = $this->agent->version();
                            $data['platform'] = $this->agent->platform();
                            $updateTrue = $this->common_model->simple_insert('vender',$data); 
                            //echo $this->db->last_query();    
                            $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
                            $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);
                            if($updateTrue) {
                                $subject = 'Welcome to Stylebuddy Fashion Platform';
                                $option = '<style>';
                                    $option .= '
                                        .banner{background: #FFFA00; }
                                        .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                                        .banner img {width: 100%; height: 190px; object-fit: cover; }
                                        .meddle_content{padding:30px 40px; background:#fff;}
                                        .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                                        .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                                        .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                        .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';
                                $option .= '</style>';
                                 
                                $mailContent =  mailHtmlHeader_New($this->site);
                                    $mailContent .= $option;
                                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to the Stylebuddy</b></div>';
                                    
                                    $mailContent .= '<div style="clear: both;"></div>';
                                    $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($data['fname'].' '.$data['lname']).'</h4>';
                                       $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey</p>';
                                        $mailContent .= '<p><a href="'.base_url('login/activeaccount/'.$activate_string).'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px;font-size: 15px; font-weight: 700; font-style: normal;letter-spacing: 0.5px; margin-top:24px; display: inline-block;">Confirm your account</a></p>';
                                    $mailContent .= '</div>';
                                $mailContent .= mailHtmlFooter_New_1($this->site);
                                $to      =  $data['email'].',vijay@gleamingllp.com';
                                $from = FROM_EMAIL;
                                $from_name = $this->site->site_name;
                                $cc = CC_EMAIL;
                                $reply = REPLY_EMAIL;
                                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                                $msg = array('success' => '<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');

                                $this->session->set_flashdata('message_success_redirect_home_corporate','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
                                //$this->session->set_flashdata('message_success_redirect_home_corporate_','<div class=" p-2 mb-2"><p>Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
                                
                                redirect(base_url('corporate-login'));
                            }
                        /*}else{
                            $this->session->set_flashdata('imgBerror_','Please enter correct captch'); 
                            //redirect('corporate-register','refresh');
                        }*/
                    }
                }
            }
        }
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "register-as-a-user" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $data['states'] = $this->db->get_where('states',['country_id'=> 101 ])->result();
        $this->load->view('front/register-corporate',$data);   
    }
    public function vendorForgotPass(){   
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
                
                 
                
                $subject = 'Forgot Password';  
                 
                
                $mailContent =  mailHtmlHeader_New($this->site);
                    $mailContent .= $option;
                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Re-Set your password</b></div>';
                    $mailContent .= '<div style="clear: both;"></div>';
                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($fullName).'</h4>';
                        $mailContent .= '<p style="font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;">Looks like you have re-set your password. <br>Kindly use this OTP while changing the password :  '.$password.'<br/>Please click the button below to change your password.</p>';
                        $mailContent .= '<p><a class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;" href="'.base_url().'login/reset_password"> Change my password</a></p>';
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
                $this->session->set_flashdata('success',"<span class='text-white bg-danger p-2'> Oops! Please enter the correct registered e-mail ID.</span>");
                //$msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
                $msg = array('success' => "<span class='text-white bg-danger p-2'> Oops! Please enter the correct registered e-mail ID.</span>");
            }
        }
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/forgot-password',$data);   
    }
    function random_password() {
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

        $this->load->view('front/reset-password');

    }

    public function logout(){

        $this->session->sess_destroy();

        $refer =  $this->agent->referrer();

        redirect($refer);
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
        $userRow    =  $this->common_model->get_all_details('vender',$abc)->row_array();
         
        if($userRow){
            $p['status'] = 1;
            $p['email_verification'] = 1;
            $updateTrue = $this->common_model->commonUpdate('vender',$p,array('id'=>$userRow['id']));
            if ($userRow['user_type'] == '2') {
                $msg = '<p>Your Account Is Activated.</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('login/stylistlogin').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';
            }else if ($userRow['user_type'] == '3') {
                $msg = '<p>Your Account Is Activated.</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('login/userlogin').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';
                    
            }else if ($userRow['user_type'] == '4') {
                $msg = '<p>Your Account Is Activated.</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('login/userlogin').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';
            }else if ($userRow['user_type'] == '5') {
                $msg = '<p>Your Account Is Activated.</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('login/postjoblogin').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';
            }else if ($userRow['user_type'] == '6') {
                /*$msg = '<p>Your Corporate account has been activated</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('corporate-login').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';*/
                
            }else{
                $msg = '<p>Your Account Is Activated.</p>';
                $msg .= '<hr>';
                $msg .= '<div class="text-center col-sm-12">';
                    $msg .= '<a href="'.base_url('login/userlogin').'" class="action_bt_2">Please login</a>';
                $msg .= '</div>';
            }
            if ($userRow['user_type'] == '6') {
                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your account has been activated. Please login</span>');
                 
                //$this->session->set_flashdata('message_success_redirect_login_corporate',$msg);
                redirect(base_url('corporate-login'));
            }else{
                $this->session->set_flashdata('message_success_redirect_login',$msg); 
            }
            
        }else{
            //$this->session->set_flashdata('message_success_redirect_home','<span class=" p-2 mb-2">Your varification link expired.</span>');
        }
        redirect(base_url());
    }
    public function register(){   
        
        if($this->session->userdata('userType') == 3 ) {

            redirect(base_url());

        }else {
            $postData = $this->input->post();
            if ($postData) {
                $this->form_validation->set_rules('fname', 'First Name', 'required|trim'); 

                $this->form_validation->set_rules('lname', 'Last Name', 'required|trim'); 
                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim'); 

                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]'); 

                $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');

                $this->form_validation->set_rules('email', 'Email', 'required|valid_email[vender.email]');

                $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');

                $this->form_validation->set_message('is_unique', 'The %s is already in use, Please use another'); 



                if( $this->form_validation->run() == false) {
                     
                }  else {
                    $check_content_sightengine = array();
                    $check_content_sightengine['fname'] = $postData['fname'];;
                    $check_content_sightengine['lname'] = $postData['lname'];;
                    $check_content_sightengine['email'] = $postData['email'];;
                    $dd = check_content_sightengine($check_content_sightengine);
                    if ($dd) {
                        $this->session->set_flashdata('imgBerror_','Your request could not be submitted because you enter inappropriate content.'); 
                    }else{
                        $referral_code = $this->input->post('referral_code');
                        $inputCaptcha = $this->input->post('captcha');
                        $sessCaptcha = $this->session->userdata('captchaTextCode');
                        if($inputCaptcha === $sessCaptcha){
                            $data['user_type'] = 3;
                            $data['status'] = 0;
                            $data['fname'] = $this->input->post('fname');
                            $data['lname'] = $this->input->post('lname');
                            $data['mobile'] = $this->input->post('mobile');
                            $data['email'] = $this->input->post('email');
                            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
                            $data['referral_code'] = $referral_code;
                            
                            $data['password'] = md5($this->input->post('password'));
                            $data['created_at']  = date('Y-m-d h:i:s');
                            
                            $data['ip_address'] = $this->input->ip_address();
                            $data['user_agent'] = $this->input->user_agent();
                            $data['browser'] = $this->agent->browser();
                            $data['browserVersion'] = $this->agent->version();
                            $data['platform'] = $this->agent->platform();
                            
                            $referralRow = $this->common_model->get_all_details('referral',array('status'=>'1','referral_code'=>$referral_code))->row_array();
                            if ($referralRow) {
                                $data['referral_id'] = $referralRow['id'];
                            }
                            
                            //$insert = $this->db->insert('vender',$data);
                            $updateTrue = $this->common_model->simple_insert('vender',$data);     
                            $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
                            $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);
                            
                            
                            if($updateTrue) {
                                $subject = 'Welcome to Stylebuddy Fashion Platform';
                                
                                $option = '<style>';
                                    $option .= '
                                        .banner{background: #FFFA00; }
                                        .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                                        .banner img {width: 100%; height: 190px; object-fit: cover; }
                                        .meddle_content{padding:30px 40px; background:#fff;}
                                        .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                                        .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                                        .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                        .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';

                                $option .= '</style>';
                                 
                                $mailContent =  mailHtmlHeader_New($this->site);
                                    $mailContent .= $option;
                                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';

                                    $mailContent .= '<div style="clear: both;"></div>';
                                    $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($data['fname'].' '.$data['lname']).'</h4>';
                                       $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey</p>';
                                        $mailContent .= '<p><a href="'.base_url('login/activeaccount/'.$activate_string).'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;">Confirm your account</a></p>';
                                    $mailContent .= '</div>';
                                $mailContent .= mailHtmlFooter_New_1($this->site);
                             

                                $to      =  $data['email'];
                                //$to      =  'vijay@gleamingllp.com';
                                $from = FROM_EMAIL;
                                $from_name = $this->site->site_name;
                                $cc = CC_EMAIL;
                                $reply = REPLY_EMAIL;
                                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                                
                                $msg = array('success' => '<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
                                $this->session->set_flashdata('register_message_success','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>'); 
                                redirect(base_url('user/registration'));
                                //var_dump($this->input->post());die;
                            }
                        }else{
                            $this->session->set_flashdata('imgBerror_','Please enter correct captch');
                            //redirect('user/registration','refresh');
                        }
                        

                    }
                }
            }
            $data['seoData'] = array();
            $list = $this->db->query('select * from cms_pages where slug = "register-as-a-user" and status=1')->row();
            if($list) {
                $data['seoData'] = $list;
            }
            $this->load->view('front/register',$data);   

        }
    }
    public function vendorRegistration(){
        if ($this->session->userdata('userId')) {
           redirect(base_url());
        }
        if(!empty($this->input->post('fname'))){
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_rules('lname','Last Name','required|trim');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[vender.email]');
            $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
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
            //$this->form_validation->set_rules('more_about','More About','required|trim');
            //$this->form_validation->set_message('is_unique', 'The %s is already in use'); 
            $this->form_validation->set_error_delimiters('<span class="text-primary mt-1">','</span>');



            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaTextCode');
            

            if( $this->form_validation->run() == false) {
                 
            }  else {
                $postData = $this->input->post();
                $check_content_sightengine = array();
                $check_content_sightengine['about'] = $postData['about'];;
                $check_content_sightengine['more_about'] = $postData['more_about'];;
                $check_content_sightengine['address'] = $postData['address'];;
                $check_content_sightengine['fname'] = $postData['fname'];;
                $check_content_sightengine['lname'] = $postData['lname'];;
                $check_content_sightengine['email'] = $postData['email'];;
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('imgBerror_','Your request could not be submitted because you enter inappropriate content.'); 
                    }else{
                         

                    if($inputCaptcha === $sessCaptcha){
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

                            $data['user_type'] = 2;
                            $data['status'] = 0;
                            $data['fname'] = $this->input->post('fname');
                            $data['email'] = $this->input->post('email');
                            $data['lname'] = $this->input->post('lname');
                            $data['password'] = md5($this->input->post('password'));
                            
                            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
                            
                            $data['gender'] = $this->input->post('gender');
                            $data['mobile'] = $this->input->post('mobile');
                            $data['dob'] = $this->input->post('dob');
                            $data['address'] = $this->input->post('address');
                            $data['pin'] = $this->input->post('pin');
                            
                            $data['country'] = $country = $this->input->post('country');
                            $data['state'] = $state = $this->input->post('state');
                            $data['city'] = $city = $this->input->post('city');
                            
                            $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                            $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                            $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();
                
                            $data['country_name'] = $countryRow->name;
                            $data['state_name'] = $statesRow->name;
                            $data['city_name'] = $cityRow->name;

                            $data['experience'] = $experience = $this->input->post('experience');
                            $data['about'] = $this->input->post('about');
                            $data['more_about'] = $this->input->post('more_about');
                            $data['linkedin_link'] = $this->input->post('linkedin_link');
                            $data['behance_link'] = $this->input->post('behance_link');
                            $data['facebook_link'] = $this->input->post('facebook_link');
                            $data['twitter_link'] = $this->input->post('twitter_link');
                            $data['instagram_nlink'] = $this->input->post('instagram_nlink');
                            $data['portfolio_rlink'] = $this->input->post('portfolio_rlink');
                            if(!empty($this->input->post('expertise'))) { 
                                $data['expertise'] = $arrayVal = implode(',',$this->input->post('expertise')); 
                                $values = ""; 
                                $arrayVal = $this->input->post('expertise');        
                                $expertises =  $this->db->get_where('area_expertise',['status'=>1])->result();
                                foreach ($expertises as $expertise) { 
                                    if( in_array($expertise->id , $arrayVal)) {  $values .= ", $expertise->name"; }
                                }
                                $stylist = substr($values,1);    
                            }
                            $data['created_at']  = date('Y-m-d h:i:s');




                            
                            if ($experience == 1) {
                                $projectDeliverd = rand(10,20);
                            }else if ($experience == 2) {
                                $projectDeliverd = rand(20,40);
                            }else if ($experience == 3) {
                                $projectDeliverd = rand(40,50);
                            }else if ($experience == 4) {
                                $projectDeliverd = rand(50,70);
                            }else if ($experience == 5) {
                                $projectDeliverd = rand(50,200);
                            }else if (!empty($experience)) {
                                $projectDeliverd = rand(50,500);
                            }else{
                                $projectDeliverd = rand(1,5);
                            }
                                                

                            $data['project_deliverd'] = $projectDeliverd;
                            
                            $data['ip_address'] = $this->input->ip_address();
                            $data['user_agent'] = $this->input->user_agent();
                            $data['browser'] = $this->agent->browser();
                            $data['browserVersion'] = $this->agent->version();
                            $data['platform'] = $this->agent->platform();
                            
                            
                            $insert = $this->db->insert('vender',$data);
                            $updateTrue = $this->db->insert_id(); 
                            $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();
                            $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);
                            if($updateTrue) {
                                $subject = 'Welcome to Stylebuddy Fashion Platform';
                                
                                $option = '<style>';
                                    $option .= '
                                        .banner{background: #FFFA00; }
                                        .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                                        .banner img {width: 100%; height: 190px; object-fit: cover; }
                                        .meddle_content{padding:30px 40px; background:#fff;}
                                        .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                                        .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                                        .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                        .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';

                                $option .= '</style>';

                                 

                                $mailContent =  mailHtmlHeader_New($this->site);
                                    $mailContent .= $option;
                                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';

                                    $mailContent .= '<div style="clear: both;"></div>';
                                    $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($data['fname'].' '.$data['lname']).'</h4>';
                                       $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey.</p>';
                                       $mailContent .= '<p style="margin-top:24px;">Your account will be activated only after verification and you can login after 24 hours.</p>';
                                         
                                    $mailContent .= '</div>';
                                $mailContent .= mailHtmlFooter_New_1($this->site);
                             

                                $to      =  $data['email'];
                                //$to      =  'vijay@gleamingllp.com';
                                $from = FROM_EMAIL;
                                $from_name = $this->site->site_name;
                                $cc = CC_EMAIL;
                                $reply = REPLY_EMAIL;
                                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach = "");
                                
                                $msg = array('success' => '<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Our styling team is reviewing your profile. We will get back to you very shortly.</p></div>');
                                $this->session->set_flashdata('register_message_success','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Our styling team is reviewing your profile. We will get back to you very shortly.</p></div>'); 
                                redirect(base_url());
                            }
                        }
                    }else{
                        $this->session->set_flashdata('imgBerror','Please enter correct captch'); 
                        //redirect('stylist-zone/registration','refresh');
                    }
                }
            }
        }
        
        $list = $this->db->query('select * from cms_pages where slug = "style-zone-registration"')->row();
     
        if($list) {
            $style['seoData'] = $list;
        }
        $style['parentCategory'] = $this->data['parentCategory'];
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        $style['country'] = $this->db->get('countries')->result();
        $style['states'] = $this->db->get_where('states',['country_id'=> 101 ])->result();
        $style['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();

        $slider  =  $this->common_model->get_all_details_query('slider','where id = 19 AND status = 1')->row();
        $slides  =  $this->common_model->get_all_details_query('slides','where slider_id = "'.$slider->id.'" AND status = 1 ORDER by ui_order desc')->result();
        $style['slider'] = $slider;
        $style['slides'] = $slides;
        
        $this->load->view('front/register-stylist',$style);
    }
    public function loginAjaxSocial(){
        $postData = $this->input->post();
        $email = $postData['userEmail'];
        $social_id = $postData['social_id'];
        $name = $postData['name'];
        $fname = $postData['fname'];
        $lname = $postData['lname'];
        $picture = $postData['picture'];
        $social_id = $postData['social_id'];
        $user_type = 3;
        //var_dump($postData); 
        $response = array();
        if (!empty($email) && !empty($social_id)) {
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" ')->row();
            //echo $this->db->last_query();
            if(!$user) {
                $data['user_type'] = 3;
                $data['status'] = 1;
                $data['fname'] = ($fname)?$fname:$name;
                $data['lname'] = ($lname)?$lname:$name;
                $data['mobile'] = ($this->input->post('mobile'))?$this->input->post('mobile'):'';
                $data['email'] = $email;
                $data['name'] = $name;
                $data['image'] = $picture;
                $data['social_id'] = $social_id;
                
                $data['created_at']  = date('Y-m-d h:i:s');
                
                $data['ip_address'] = $this->input->ip_address();
                $data['user_agent'] = $this->input->user_agent();
                $data['browser'] = $this->agent->browser();
                $data['browserVersion'] = $this->agent->version();
                $data['platform'] = $this->agent->platform();
                $updateTrue = $this->common_model->simple_insert('vender',$data);     
            }else{
                if ($user->user_type == 3) {
                    $insert_data['social_id'] = $social_id;
                    $updateTrue = $this->common_model->commonUpdate($table,$insert_data,array('email'=>$email));
                }else{
                    $response['status'] = 'other';
                    $response['response'] = 'You already have an account as stylist.';
                    echo json_encode($response);die;
                }
                
            }
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND social_id="'.$social_id.'"')->row();
             
            if($user) {
                if($user->status) {
                    $user_id = $user->id;
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    $user_id = $user->id;
                    $idm = $this->session->userdata('session_user_id_temp');
                    $updateArraywish = array( 'user_id' => $user_id);
                
                    $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->session->set_userdata('session_user_id_temp',$user_id);
                    $response['status'] = 'success';
                    $response['response'] = 'Welcome to Stylebuddy, the No. 1 destionation for fashion and styling.<br/>logging in...';
                } else {
                    $response['status'] = 'fail';
                    $response['response'] = 'Your Account is disabled. Please contact administrator';
                }
            } else {
                $response['status'] = 'fail';
                $response['response'] = 'Invalid email or Password, Try Again';
            }
        }else{
            $response['status'] = 'fail';
            $response['response'] = 'Please enter username and password';
        }
        echo json_encode($response);
    }
    

    public function loginAjax(){
        $postData = $this->input->post();
        $email = $postData['userEmail'];
        $password = $postData['userPassword'];
        $user_type = 3;
         
        $response = array();
        if (!empty($email) && !empty($password)) {
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.md5($password).'"')->row();
             
            if($user) {
                if($user->status) {
                    $user_id = $user->id;
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    $user_id = $user->id;
                    $idm = $this->session->userdata('session_user_id_temp');
                    $updateArraywish = array( 'user_id' => $user_id);
                
                    $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->session->set_userdata('session_user_id_temp',$user_id);
                    $response['status'] = 'success';
                    $response['response'] = 'You have logged in';
                } else {
                    $response['status'] = 'fail';
                    $response['response'] = 'Your Account is disabled. Please contact administrator';
                }
            } else {
                $response['status'] = 'fail';
                $response['response'] = 'Invalid email or Password, Try Again';
            }
        }else{
            $response['status'] = 'fail';
            $response['response'] = 'Please enter username and password';
        }
        echo json_encode($response);
    }
    public function loginDetails(){
        $postData = $this->input->post();
        $email = $postData['userEmail'];
        $password = $postData['userPassword'];
        $user_type = 3;
        $table = 'vender';
        $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.md5($password).'"')->row();
        $response['status'] = 'success';
        $response['response'] = $user;
        echo json_encode($response);
    }
    public function bookFreeSess(){
        $postData = $this->input->post();
        $ip = $this->input->ip_address();
        if($postData){
            $sess_data = array(
                'full_name'     => $postData['book_sess_fname'],
                'email_id'      => $postData['book_sess_email'],
                'mobile_no'     => $postData['book_sess_mobile'],
                'services'      => $postData['book_sess_service'],
                'sess_comments' => $postData['book_sess_comment'],
                'user_id'       => $this->session->userdata('userId'),
                'user_type'     => $this->session->userdata('userType'),
                'ip_address'    => $ip,
                'created_at'    => date('Y-m-d H:i:s')
                );
            $insert = $this->db->insert('book_free_sess',$sess_data);
            $insert_id = $this->db->insert_id(); 
            if($insert_id){
                $response['status'] = 'success';
                $response['response'] = 'You have logged in';
            }else{
                $response['status'] = 'fail';
                $response['response'] = 'Something went wrong, Try Again';
            }
        }else{
            $response['status'] = 'fail';
            $response['response'] = 'Book Session not submitted, Try Again';
        }
        echo json_encode($response);
    }
    public function stylistlogin(){
         
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
            $user_type = 2;
            $password = md5($this->input->post('userPassword'));
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.$password.'"')->row();
            //echo $this->db->last_query();die;
            if($user) {
                if($user->status) {
                    $user_id = $user->id;
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    
                    
                    $user_id = $user->id;
                    $idm = $this->session->userdata('session_user_id_temp');
                    $updateArraywish = array( 'user_id' => $user_id);
                 
                    $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                    echo $this->db->last_query();
                    $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                    echo $this->db->last_query();
                    $this->session->set_userdata('session_user_id_temp',$user_id);
                    
                    $cart = $this->cart->contents();
                    $refer = $data['lastPage'];
                    $a  = explode('/',$refer);
                    foreach($a as $k=>$v){
                            $lastPage = $v;
                    }
                    if ($user->user_type == '2') {
                       redirect('stylist-zone/dashboard'); 
                    }else{
                        if ($user->user_type == '4') {
                            $this->session->set_userdata('boutique_id',$user->id);
                        } 
                        if($lastPage == 'checkoutnew'){
                            redirect(base_url('cart'));
                        }else{
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
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-stylist" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }

        $this->load->view('front/login',$data);
    }
    public function userlogin(){
         
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
            $user_type = 3;
            $password = md5($this->input->post('userPassword'));
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.$password.'"')->row();
            
            if($user) {
                if($user->status) {
                    $user_id = $user->id;
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    
                    
                    $user_id = $user->id;
                    $idm = $this->session->userdata('session_user_id_temp');
                    $updateArraywish = array( 'user_id' => $user_id);
                 
                    $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                    //echo $this->db->last_query();
                    $this->session->set_userdata('session_user_id_temp',$user_id);
                    
                    $cart = $this->cart->contents();
                    $refer = $data['lastPage'];
                    $a  = explode('/',$refer);
                    foreach($a as $k=>$v){
                            $lastPage = $v;
                    }

                    $this->session->set_flashdata('login_message_shop_page','<h5>Welcome to Stylebuddy, Explore our fashion Styling Services</h5>');

                    if ($user->user_type == '2') {
                       redirect('stylist-zone/dashboard'); 
                    }else{
                        if ($user->user_type == '4') {
                            $this->session->set_userdata('boutique_id',$user->id);
                        } 
                        if($lastPage == 'checkoutnew' || $lastPage == 'checkout'){
                            redirect(base_url('cart'));
                        }else{
                            //redirect($postData['lastPage']);
                            redirect(base_url());
                        }
                    } 
                    
                     
                    
                } else {
                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your Account is disabled. Please contact administrator</span>');
                }
            } else {
                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');
            }
        }
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-user" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/login',$data);
    }
    public function vendorLogin(){
        redirect(base_url('login/userlogin'));
        /*$cities = $this->db->get('cities')->result();
        foreach ($cities as $key => $value) {
            $this->common_model->commonUpdate('cities',array('city'=>$value->code),array('id'=>$value->id));
        }*/ 
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
                    $user_id = $user->id;
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user_id, 'venderId'=>$user_id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                    
                    
                    $user_id = $user->id;
                    $idm = $this->session->userdata('session_user_id_temp');
                    $updateArraywish = array( 'user_id' => $user_id);
                 
                    $this->common_model->commonUpdate('user_cart',$updateArraywish, array('user_id'=>$idm));
                    echo $this->db->last_query();
                    $this->common_model->commonUpdate('user_cart_session',$updateArraywish, array('user_id'=>$idm));
                    echo $this->db->last_query();
                    $this->session->set_userdata('session_user_id_temp',$user_id);
                    
                    $cart = $this->cart->contents();
                    $refer = $data['lastPage'];
                    $a  = explode('/',$refer);
                    foreach($a as $k=>$v){
                            $lastPage = $v;
                    }
                    if ($user->user_type == '2') {
                       redirect('stylist-zone/dashboard'); 
                    }else{
                        if ($user->user_type == '4') {
                            $this->session->set_userdata('boutique_id',$user->id);
                        } 
                        if($lastPage == 'checkoutnew'){
                            redirect(base_url('cart'));
                        }else{
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
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/login',$data);
    }
    public function vendorLoginProcess(){
        $this->form_validation->set_rules('vanderEmail','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
        $postData = $this->input->post();
        if( $this->form_validation->run() == false) {
            redirect('login');
         } else {
                $email = $this->security->xss_clean($this->input->post('vanderEmail'));
                $password = md5($this->security->xss_clean($this->input->post('password')));
                $table = 'vender';
                $user = $this->Page_Model->login_chk($email,$password,$table); 
                if($user) {
                    
                    if($user->status != 1) {
                        $this->session->set_flashdata('error','<span class="text-danger p-2 mb-2">Your Account is disabled. Please contact administrator</span>');
                        redirect('login');
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
                 $this->session->set_flashdata('error','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');
                 redirect('login');
             }
        }
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
        
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "login-as-a-post-job-user" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }

        $this->load->view('front/login-post-job',$data);
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
                $postData = $this->input->post();
                $check_content_sightengine = array();
                $check_content_sightengine['fname'] = $postData['fname'];;
                $check_content_sightengine['lname'] = $postData['lname'];;
                $check_content_sightengine['email'] = $postData['email'];;
                $check_content_sightengine['contact_person_name'] = $postData['contact_person_name'];;
                $check_content_sightengine['company_type'] = $postData['company_type'];;
                $check_content_sightengine['business_nature'] = $postData['business_nature'];;
                $dd = check_content_sightengine($check_content_sightengine);
                if ($dd) {
                    $this->session->set_flashdata('imgBerror_','Your request could not be submitted because you enter inappropriate content.'); 
                }else{

                    if($inputCaptcha === $sessCaptcha){
                        $this->uploadPath = 'assets/images/vandor/';
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
                        $subject = 'Welcome to Stylebuddy Fashion Platform';
                        $option = '<style>';
                                    $option .= '
                                        .banner{background: #FFFA00; }
                                        .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}
                                        .banner img {width: 100%; height: 190px; object-fit: cover; }
                                        .meddle_content{padding:30px 40px; background:#fff;}
                                        .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   
                                        .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}
                                        .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}
                                        .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';

                                $option .= '</style>';

                                 
                                
                            
                            $mailContent =  mailHtmlHeader_New($this->site);
                                $mailContent .= $option;
                                $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';
                                $mailContent .= '<div style="clear: both;"></div>';
                                $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';
                                    $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($data['fname'].' '.$data['lname']).'</h4>';
                                   $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey</p>';
                                    $mailContent .= '<p><a href="'.base_url('login/activeaccount/'.$activate_string).'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;">Confirm your account</a></p>';
                                $mailContent .= '</div>';
                            $mailContent .= mailHtmlFooter_New_1($this->site);
                         
                        
                        $to      =  $data['email'];
                        $from = FROM_EMAIL;
                        $from_name = $this->site->site_name;
                        $cc = CC_EMAIL;
                        $reply = REPLY_EMAIL;
                        $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach='');
                         
                        
                        if($insert_id) {
                            
                            $msg = array('success' => '<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please verify your email address. A verification email has been to sent your email ID. Thank you.</p></div>');
                            $this->session->set_flashdata('register_message_success','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you for registering with StyleBuddy.</p><p  class="festival_message_p2">Please check your e-mail ID and verify the account and start posting jobs. Thank you.</p></div>'); 
                            
                            redirect('login/postjoblogin');
                        }
                    }else{
                        $this->session->set_flashdata('register_message','Please enter correct captch'); 
                        redirect(base_url('login/postjobregister'),'refresh');
                    }
                }
            }
        }
        
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-zone-registration"')->row();
     
        if($list) {
            $style['seoData'] = $list;
        }
        
        
        $style['style'] = $this->db->get_where('area_expertise',['status'=>1])->result();
        $style['tags'] = $this->db->get_where('idea_tag',['status'=> 1 ])->result();
        $style['country'] = $this->db->get('countries')->result();
        $style['states'] = $this->db->get_where('states',['country_id'=> 101 ])->result();
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/register-post-job',$style);
    }
}

