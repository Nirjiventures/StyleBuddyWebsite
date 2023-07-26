<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boutiques extends MY_Controller {
        function __construct()
	{
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        $this->userID = $this->session->userdata('userId');
        $this->venderId = $this->session->userdata('boutique_id');
        $this->load->model('common_model');
        /*if($this->session->userdata('site_lang')){
            $language = $this->session->userdata('site_lang');
            if($this->session->userdata('site_lang') == 'en' || $this->session->userdata('site_lang') == 'english'){
            }else{
                redirect(base_url().'/'.$language);   
            }
        }*/
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
            $this->load->view('front/boutiques/consult_order',$data); 
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
            $this->load->view('front/boutiques/consult_order_view',$data);
        }else{
             redirect(base_url()); 
        }
    }
    public function login(){

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
            $user_type = '4';
            $password = md5($this->input->post('userPassword'));
            $table = 'vender';
            $user = $this->db->query('select * from '.$table.' WHERE email="'.$email.'" AND user_type="'.$user_type.'" AND password="'.$password.'"')->row();
             
            if($user) {
                if($user->status != 1) {
                    $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Your Account is disabled, please contact to Administer</span>');
                    
                } else {
                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'profile_update_ratio'=>$user->profile_update_ratio,'currently_logged_in' => 1 ];
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
                        }else{
                            redirect($postData['lastPage']);
                        }  
                    }
               }
            } else {
                $this->session->set_flashdata('login_message','<span class="text-danger p-2 mb-2">Invalid email or Password, Try Again</span>');
            }
        }

        $this->load->view('front/login-boutique',$data);
    }
    public function boutiquedashboard(){
        //if($this->session->userdata('adminEmail')) {
            $seg3 = $this->uri->segment(3);
            $user = $this->db->query('select * from vender WHERE id ="'.$seg3.'"')->row();
            if($user) {
                $this->session->set_userdata('boutique_id',$user->id);
                $this->venderId = $this->session->userdata('boutique_id');
                redirect(base_url('boutiques/dashboard'));
            }
        //} 
    }
    
    public function consultationorder(){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id')  ) {
            $r = $this->db->query('SELECT * FROM vender where id='.$this->session->userdata('boutique_id'))->row();
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
            $data['datas'] = $this->db->get_where('vender',['id' => $this->session->userdata('boutique_id') ])->row();
        }
           
        $this->load->view('front/boutiques/consultationorder',$data);
        
    }
    

    public function dashboard(){  
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id')  ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            if ($profile->expertise) {
                $area_expertise = explode(',', $profile->expertise);
                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                $profile->area_expertiseRow = $ideas;
            }
            $data['profile'] = $profile;
            $this->load->view('front/boutiques/dashboard',$data);
        } else {
            redirect();   
        } 
    }
    public function mydashboard(){  
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/boutiques/my-dashboard',$data);
        } else {
            redirect();   
        } 
    }

    public function managemyorders(){  
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/boutiques/manage-my-orders',$data);
        } else {
            redirect();   
        } 
    }

    
    public function myearnings(){  
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/boutiques/my-earnings',$data);
        } else {
            redirect();   
        } 
    }

    public function mypayouts(){  
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }

            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $this->load->view('front/boutiques/my-payouts',$data);
        } else {
            redirect();   
        } 
    }

    public function uploadSingleImage($filename,$path){
        $files = $_FILES;
        $timeImg = '';
        if(!empty($_FILES[$filename]['name'])){
            $tempFile = $files[$filename]['tmp_name'];
            //$temp = $files[$filename]["name"];
            $temp = strtolower(basename($files[$filename]["name"]));
            $path_parts = pathinfo($temp);
            $t =  time();
            $ImageName = 'image'. $t . '.' . $path_parts['extension'];
            $targetFile = $path . $ImageName ;
            move_uploaded_file($tempFile, $targetFile);
             
            $p = str_replace('uploads/','',$path);
            //return trim($p.$ImageName);
            return trim($ImageName);
        }
        
    }
    public function uploadMultipleImage($filename,$path){
        if(is_array($_FILES[$filename]['name'])){
            $cpt = count($_FILES[$filename]);
            $ImageName = '';
            $timeImg = '';
            for($i=0; $i<$cpt; $i++){
                if(!empty($_FILES[$filename]['name'][$i])){
                    $tempFile = $_FILES[$filename]['tmp_name'][$i];
                    //$temp = $_FILES[$filename]['name'][$i];
                    $temp = strtolower(basename($_FILES[$filename]["name"][$i]));
                    $path_parts = pathinfo($temp);
                    $t =  time();
                    $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];
                    $targetFile = $path . $fileName_ ;
                    move_uploaded_file($tempFile, $targetFile);
                     
                    $p = str_replace('uploads/','',$path);
                    //$ImageName .= ','.$p.$fileName_;
                    $ImageName .= ','.$fileName_;
                }
            }
            return trim($ImageName,',');
        }else{
            $files = $_FILES;
            if(!empty($_FILES[$filename]['name'])){
                $tempFile = $_FILES[$filename]['tmp_name'];
                $temp = $_FILES[$filename]["name"];
                $path_parts = pathinfo($temp);
                $t =  time();
                $ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];
                $targetFile = $path . $ImageName ;
                move_uploaded_file($tempFile, $targetFile);
                $p = str_replace('uploads/','',$path);  
                //return trim($p.$ImageName);
                return trim($ImageName);
            }
        }
    }
    public function profile(){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $postData = $this->input->post();
            if ($postData['fname']) {
                $this->form_validation->set_rules('fname','First Name','required|trim');
                $this->form_validation->set_rules('lname','Last Name','required|trim');
                $this->form_validation->set_rules('email','Email','required|trim|valid_email');
                //$this->form_validation->set_rules('gender','Gender','required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
                
                if( $this->form_validation->run() == false) {
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

                    }else{
                        $c_c_s = array(); 

                        $this->uploadPath = 'assets/images/vandor/';
                        $image = $this->uploadSingleImage('image',$this->uploadPath);
                        if(!empty($image)){
                            $data['image'] = $image;
                            $c_c_s['image'] = base_url($this->uploadPath.$image);
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
                            //echo $this->db->last_query();die;
                            if($update) {
                                $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your profile is updated successfully</span>');
                                redirect('boutiques/profile');
                            } else {
                                $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                                redirect('boutiques/profile');
                            }
                        }
                    }
                }
            }
            $data['profile'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['country'] = $this->db->get('countries')->result();
            $data['states'] = $this->db->get_where('states',['country_id'=> $profile->country ])->result();
            $data['cities'] = $this->db->order_by('name', 'asc')->get('cities')->result();

            $data['expertises'] = $this->db->get_where('area_expertise',['status'=> 1 ])->result();
            $this->load->view('front/boutiques/profile',$data);
        } else {
            redirect();   
        } 
    }
    public function manageProducts(){   
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['products'] = $this->db->order_by('id', 'desc')->get_where('products',['user_id'=> $this->venderId ])->result();
            //echo $this->db->last_query();
            $this->load->view('front/boutiques/manage-products',$data);
        } else {
            redirect(); 
        }    
    }
    public function productStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $update = $this->db->where('id',$id)->update('products',['status'=> $status]);
        echo $update;
    }
    public function addProducts(){
        $postData = $this->input->post();
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
            $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another name');
    
            if( $this->form_validation->run() == true) {

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
                        
                        $r = $this->common_model->get_all_details('vender',array('id'=>$this->venderId))->row();
            	        $data['vender_id'] = $r->parent_id;
                        $data['user_id'] = $this->venderId;
                        $data['product_name'] = $this->input->post('product_name');
                        
                        $slugBase = $slug = cleanString(url_title($data['product_name'], '-', TRUE));
            			$slug_check = '0';
            			$duplicate_url = $this->common_model->get_all_details('products',array('slug'=>$slug));
            			if ($duplicate_url->num_rows()>0){
            				$slug = $slugBase.'-'.$duplicate_url->num_rows();
            			}else {
            				$slug_check = '1';
            			}
            			$urlCount = $duplicate_url->num_rows();
            			while ($slug_check == '0'){
            				$urlCount++;
            				$duplicate_url = $this->common_model->get_all_details('products',array('slug'=>$slug));
            				if ($duplicate_url->num_rows()>0){
            					$slug = $slugBase.'-'.$urlCount;
            				}else {
            					$slug_check = '1';
            				}
            			}
            			$data['slug'] = $slug;
            			
                        $data['gender'] = $this->input->post('gender');
                        $data['cat_id'] = implode(',', $this->input->post('cat_id'));
                        $data['price'] = $this->input->post('price');
                        $size = '';
                        if(!empty($this->input->post('size'))){
                            $size = implode(',',$this->input->post('size'));
                        }
                        $data['size'] = $size;
                        
                        $color = '';
                        if(!empty($this->input->post('color'))){
                            $color = implode(',',$this->input->post('color'));
                        }
                        $data['color'] = $color;
                        
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
                            redirect('boutiques/addProducts');
                        }else{
                            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                            redirect('boutiques/addProducts');
                        }
                    }
                }    
            } 
            $data['categorys'] = $this->db->get_where('category',['status'=> 1])->result();
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
            $this->db->order_by('ui_order','asc');
            $data['colors'] =  $this->db->get_where('product_color',array('status'=>1))->result();
        
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $this->load->view('front/boutiques/edit-product',$data);

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
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $postData = $this->input->post();
            if ($this->input->post('product_name')) {
                $this->form_validation->set_rules('product_name', 'product Name', 'required|trim');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                //$this->form_validation->set_rules('cat_id', 'Catogery', 'required|trim');
                $this->form_validation->set_rules('price', 'Price', 'required|trim');
                //$this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean|greater_than[0]'); gallery
                $this->form_validation->set_rules('description', 'Description', 'required|trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">', '</span>');
                      
                $id = $this->input->post('id');
                if( $this->form_validation->run() == true) {
                    $check_content_sightengine = array();
                    $check_content_sightengine['designation'] = $postData['product_name'];;
                    //$check_content_sightengine['description'] = $postData['description'];;
                    
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
                            //$data['vender_id'] = $this->venderId;
                            $data['product_name'] = $this->input->post('product_name');
                            
                            $data['gender'] = $this->input->post('gender');
                            $data['cat_id'] = implode(',', $this->input->post('cat_id'));
                            $data['price'] = $this->input->post('price');
                            $size = '';
                            if(!empty($this->input->post('size'))){
                                $size = implode(',',$this->input->post('size'));
                            }
                            $data['size'] = $size;
                            
                            $color = '';
                            if(!empty($this->input->post('color'))){
                                $color = implode(',',$this->input->post('color'));
                            }
                            $data['color'] = $color;

                            $data['description'] = $this->input->post('description');
                            $data['discount'] = $this->input->post('discount');
                            $data['created_at']  = date('Y-m-d h:i:s');
                            
                            $table = 'products'; 
                            $where = ['user_id'=> $this->session->userdata('boutique_id'), 'id'=> $id];
                            //$where = ['id'=> $id];
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
                                $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Product Updated Successfully!!</span>');
                                redirect('boutiques/manageProducts');    
                            } else {
                                $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
                                redirect('boutiques/manageProducts');
                            }
                        }
                    }
                }
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $where = ['user_id'=> $this->session->userdata('boutique_id'), 'id'=> $id];
            $data['products'] = $this->db->get_where('products',$where)->row();
           // $data['products'] = $this->db->get_where('products',['id'=> $id ])->row();
            $data['galleryes'] = $this->db->get_where('product_galary',['product_id'=> $id ])->result();
            $data['categorys'] = $this->db->get_where('category',['status'=> 1])->result();
            
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
            $this->db->order_by('ui_order','asc');
            $data['colors'] =  $this->db->get_where('product_color',array('status'=>1))->result();
                
            $this->load->view('front/boutiques/edit-product',$data);   
        } else {
            redirect();
        }
    }
     
    public function deleteProducts($id) {
        $delete = $this->db->delete('products', array('id' => $id));  
        if($delete) { 
            $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Product Delete Successfully!!</span>');
            redirect('boutiques/manageProducts');
        } else {
            $this->session->set_flashdata('error','<span class="text-white bg-danger p-2">Something Went Wrong, try again!!</span>');
            redirect('boutiques/manageProducts');
        }
    }
    public function allorders(){   
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['order'] = $this->common_model->get_all_details_query('user_order_details',' where vendor_id = "'.$this->venderId.'" order by id desc')->result();
            $this->load->view('front/boutiques/orders',$data);
        }else {
            redirect();
        }    
    }
    public function orders(){   
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['order'] = $this->common_model->get_all_details_query('user_order_details',' where vendor_id = "'.$this->venderId.'" AND order_status != "COMPLETED" order by id desc')->result();
            $this->load->view('front/boutiques/orders',$data);
        }else {
            redirect();
        }    
    }
    public function ordersdetails($id){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
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
                        $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');
                        redirect(base_url('/boutiques/ordersdetails/'.$id));
                    }
                    
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');
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
            $this->load->view('front/boutiques/ordersdetails',$data);
        }else {
            redirect();
        }
    }
    public function completedorderslist(){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            if ($this->input->post('meta_title')) {
                $data['meta_title'] = $this->input->post('meta_title'); 
                $data['meta_keyword'] = $this->input->post('meta_keyword'); 
                $data['meta_description'] = $this->input->post('meta_description'); 
                $update = $this->db->update('vender',$data,array('id'=>$this->venderId));
            }
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['order'] = $this->common_model->get_all_details_query('user_order_details',' where vendor_id = "'.$this->venderId.'"  AND order_status = "COMPLETED" order by id desc')->result();
            $this->load->view('front/boutiques/completed-orders-list',$data);
        }else {
            redirect();
        } 
    }
    public function completedordersdetails($id){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
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
                        $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');
                        redirect(base_url('/boutiques/completedordersdetails/'.$id));
                    }
                    
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');
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
            $this->load->view('front/boutiques/completedordersdetails',$data);
        }else {
            redirect();
        }
    }
    public function myorders($id = ''){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $data['datas'] = $this->db->get_where('vender',['id' => $this->userID ])->row();
            $data['order'] = $this->db->order_by('id','DESC')->get_where('user_order',['user_id' => $this->boutique_id ])->result();
            $this->load->view('front/boutiques/myorders',$data);    
        }else{
            redirect();
        }
    }
    public function address(){
        $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        $data['user_shipping_address'] = $this->db->get_where('user_shipping_address',['user_id'=> $this->venderId])->result_array();

        $this->load->view('front/boutiques/address',$data);
    }
    public function wishlist(){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
         
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
            $this->load->view('front/boutiques/wishlist',$data);
        }else{
            redirect();
        }
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
    public function setting(){   
        if($this->session->userdata('userType') == 4 || $this->session->userdata('boutique_id') ) {
            
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
                         
                            $data = array( 'password' => md5($password), 'updated_at' => date('d-m-Y h:i:s')  );
                            $this->db->where('id', $this->venderId);
                            $this->db->update('vender', $data); 
                         
                         $this->session->set_flashdata('updatePassword','<span class="bg-info text-white p-2">Your password is updated successfully.</span>');
                         redirect('boutiques/setting');
                    }else{
                        $this->session->set_flashdata('error','<span class="bg-info text-danger p-2">Password not match, try again</span>');
                        redirect('boutiques/setting');
                    }
           
            } else {
                $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
                $this->load->view('front/boutiques/setting',$data);
              }
        } else {
            redirect('');
        }      
    }
    public function vendorForgotPass(){   
        //$data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
        //$this->load->view('front/admin-forgot-password',$data);
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
                $update_password = $this->db->update('vender',['password'=> md5($password),'otp'=> $password,'updated_at' => date('d-m-Y h:i:s') ]); 
                    


                $this->mail->setFrom($this->mail->Username,$this->site->site_name);
                $this->mail->AddAddress($email, $fullName);
                $this->mail->Subject = 'Forgot Password';       
                
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
                    $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('d-m-Y h:i:s') ]); 
                    if($update_password) {
                        $this->session->set_flashdata('success',"<span class='text-success mb-3'>Your reset otp has been sent to your email, please make sure to check your JUNK folder if you don’t get it in your inbox.</span>");
                    }
                }
            } else {
                $this->session->set_flashdata('success',"<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
                $msg = array('success' => "<span class='text-white bg-danger p-2'>Email Id not registered in our directory</span>");
            }
        }
        $this->load->view('front/forgot-password');   
    }
    public function random_password() {
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
    public function resetPass(){
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
            
           $msg = array();     
           if( $this->form_validation->run()) { 
	            
	            $email = $this->input->post('email');
	            $result = $this->db->get_where('vender',['email' => $email]);
	            if($result->num_rows() == 1) {
	                   $output = $result->row();  
	                   $password  =  $this->random_password();
	                                      
                            $this->mail->setFrom($this->mail->Username,$this->site->site_name);
                            $this->mail->AddAddress($email, $output->fname);
                            $this->mail->Subject = 'Forgot Password';		
                            
                            $mailContent = ' 
                            <h3>Forgot Password</h3>
                            <br><br>
                            <p>Dear '.$output->fname.' '.$output->lname.', <br><br>Your password successfully updated, please change the password from the dashboard section.</p>
                            <br>
                            <p><b>Password:</b> '.$password.'</p>
                            <br>
                            <p><b>CONTACT INFO</b></p>
                            <p><b>'.$this->site->site_name.'</b></p>
		                    <p>Mobile : '.$this->site->mobile.'</p>
                            <p>Email: '.$this->site->email.'</p>
                            <p>Address: '.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';
                            
                            $this->mail->Body = $mailContent;
                            $mailsend =  $this->mail->send();
                             if($mailsend) {
                                $this->db->where('email', $email);
                                $update_password = $this->db->update('vender',['password'=> md5($password),'updated_at' => date('d-m-Y h:i:s') ]); 
                               
                                if($update_password) {
                                    //$this->session->set_flashdata('success','your password successfully update, updated password send on your mail');
	                                 $msg = array('success' => "<span class='text-info text-left p-2 mb-3'>your password successfully updated, updated password send on your mail</span>");
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
     
}    
