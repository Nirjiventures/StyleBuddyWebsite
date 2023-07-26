<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Postjob extends MY_Controller {
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
        /*if($this->session->userdata('site_lang')){
            $language = $this->session->userdata('site_lang');
            if($this->session->userdata('site_lang') == 'en' || $this->session->userdata('site_lang') == 'english'){
            }else{
                redirect(base_url().'/'.$language);   
            }
        }*/
    }
    function checkUserLogin(){
        if(!$this->session->userdata('userType')) {
            //$this->session->set_flashdata('festival_message','<span class="bg-info text-white p-2">You are not logged in</span>');
            redirect(base_url());
        }
    }
    function checkUserType(){
        if($this->session->userdata('userType')) {
            if($this->session->userdata('userType') != 5) {
                $this->session->set_flashdata('festival_message','<span class="bg-info text-white p-2">You can not access this</span>');
                redirect(base_url());
            }
        }
    }
    
	public function index()	{ 
        $this->checkUserLogin();
        $this->checkUserType(); 
        $q = $this->common_model->get_all_details_distinct_query('id','jobs',' WHERE job_admin_id = "'.$this->venderId.'"'); 
        $data = $q->result_array(); 
        $num_rows = $q->num_rows(); 
        $data['num_rows'] = $num_rows;
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['parentCategory'] = $this->data['parentCategory'];   
		$this->load->view('front/postjobs/index',$data);
	}
    
    public function profile(){
        $this->checkUserLogin();
        $this->checkUserType();
         
        $postData = $this->input->post();

        if ($postData['fname']) {
             
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_error_delimiters('<span class="text-danger bg-primary  mt-1">','</span>');
            
            if( $this->form_validation->run() == false) {
            }  else {
                $this->uploadPath = 'assets/images/vandor/';
                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);
                if(!empty($image)){
                    $data['image'] = $image;
                }

                $data['fname'] = $this->input->post('fname');
                
                $data['mobile'] = $this->input->post('mobile');
                $data['contact_person_name'] = $this->input->post('contact_person_name');
                $data['company_type'] = $this->input->post('company_type');
                $data['business_nature'] = $this->input->post('business_nature');
                $data['pin'] = $this->input->post('pin');
                $data['gstin'] = $this->input->post('gstin');
                if ($this->input->post('password')) {
                    $data['password'] = md5($this->input->post('password'));
                }
                
                $data['country'] = $country = $this->input->post('country');
                $data['state'] = $state = $this->input->post('state');
                $data['city'] = $city = $this->input->post('city');
                
                $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();
                $statesRow = $this->db->get_where('states',['id'=> $state ])->row();
                $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();

                $data['country_name'] = $countryRow->name;
                $data['state_name'] = $statesRow->name;
                $data['city_name'] = $cityRow->name;


                $table = 'vender'; 
                $where = ['id'=> $this->venderId ];
                $update = $this->Page_Model->common_update($data,$where,$table); 
                //echo $this->db->last_query();die;
                if($update) {
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your profile is updated successfully</span>');
                    redirect('postjob/profile');
                } else {
                    $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                    redirect('postjob/profile');
                }
            }
        }
        
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['country'] = $this->db->get('countries')->result();
        $data['states'] = $this->db->get('states')->result();
        $data['expertises'] = $this->db->get_where('area_expertise',['status'=> 1 ])->result();
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/postjobs/profile',$data);
         
    }
    
    public function consultationorder(){
        $this->checkUserLogin();
        $this->checkUserType(); 
        
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
            $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
           
        $this->load->view('front/postjobs/consultationorder',$data);
        
    }
    
    public function setting(){ 
        $this->checkUserLogin();
        $this->checkUserType();   
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
                    redirect('postjob/setting');
                }else{
                    $this->session->set_flashdata('error','<span class="bg-info text-danger p-2">Password not match, try again</span>');
                    redirect('postjob/setting');
                }
       
        } else {
            $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            $data['profile'] = $this->db->get_where('vender',['id'=> $this->venderId])->row();
            $this->load->view('front/postjobs/setting',$data);
        }
             
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
                        $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your job is added successfully</span>');
                        redirect('postjob/managejobs');
                    } else {
                        $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                         
                    }
                }
            }
        }else{
            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your subscription limit is over</span>');
            redirect('postjob/managejobs');
        }
        $result['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        
        $result['country'] = $this->db->get('countries')->result();
        $result['states'] = $this->db->get('states')->result();
        $result['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $this->load->view('front/postjobs/jobpostform',$result);
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
                    $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your job is updated successfully</span>');
                    redirect('postjob/managejobs');
                } else {
                    $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
                     
                }
            }
        }
        $data['jobs'] = $this->db->get_where('jobs',['id'=> $job_id ])->row();  

        $data['country'] = $this->db->get('countries')->result();
        $data['states'] = $this->db->get('states')->result();
         
        $data['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $this->load->view('front/postjobs/jobpostform',$data);
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
            $this->session->set_flashdata('success','<span class="bg-info text-white p-2">Your job deleted successfully</span>');
            
        } else {
            $this->session->set_flashdata('error','<span class="bg-info text-white p-2">Something Went Wrong, try again!!</span>');
             
        }
        redirect('postjob/managejobs');
    }
	public function managejobs() {
        $this->checkUserLogin();
        $this->checkUserType();
        /*if(!$this->session->userdata('userType')) {
            redirect(base_url());
        } */
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['states'] = $this->db->get('states')->result();
        $data['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();
        $data['jobs'] = $this->db->get_where('jobs',['job_admin_id'=> $this->venderId ])->result();   
        $this->load->view('front/postjobs/manage-jobs',$data);
    }
	
	public function userprofile() {   
        
        $this->load->view('front/postjobs/profile',$data);
    }
	
	public function usersetting() {  
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
             
        $this->load->view('front/postjobs/setting',$data);
    }
	
	public function applyed() {
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $venderId = $this->session->userdata('venderId');
        
        $where .= " where id = '".$segment3."' AND job_admin_id = '".$venderId."'  order by id desc";
        $query = $this->db->query("select * from jobs".$where);
        $rowCount = $query->num_rows();
        $row = $query->row_array();
        $data = $this->common_model->get_all_details('vender',array('id'=>$venderId))->row_array(); 
        $style['loginUserRow'] = $data;
        $style['jobRow'] = $row;
        


        //$q = $this->common_model->get_all_details_distinct_query('job_apply_id','job_apply',' WHERE job_id = "'.$row['id'].'"'); 
        $q = $this->common_model->get_all_details_query('job_apply',' WHERE job_id = "'.$row['id'].'"'); 
        //echo $this->db->last_query();
        $rows = $q->result(); 
        $num_rows = $q->num_rows(); 
        foreach ($rows as $k => $value) {
            $v = $this->common_model->get_all_details('vender',array('id'=>$value->job_apply_id))->row(); 
            //var_dump($v);

            $rows[$k]->job_apply_image = $v->image;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$v->id)->row();

            $v->feedbackRating = ($review->rating)?$review->rating:0;
            $v->feedbackCount = $review->feedbackCount;
            $v->review = $review;

            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();
            $v->total_portfolio = $ideas->count;
            $v->area_expertiseRow = array();
            if ($v->expertise) {
                $area_expertise = explode(',', $v->expertise);
                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();
                $v->area_expertiseRow = $ideas;
            }

            $rows[$k]->vendor_row = $v;
            
        }
        $style['job_apply'] = $rows;
        $style['job_apply_num_rows'] = $num_rows;


        $style['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
               
        $this->load->view('front/postjobs/applyed-job',$style);
    }
    
	public function subscriptions() {
        $this->checkUserLogin();
        $this->checkUserType();
        $table = 'subscription_plan';
        $postData = $this->input->post();
        if ($postData['package_id']) {
            $vendor_id = $this->venderId;
            $package_id = $postData['package_id'];
            $package_price = $postData['package_price'];

            $condition = " WHERE id = '".$vendor_id."'";
            $r = $this->common_model->get_all_details_query('vender',$condition)->row_array();
            $data['vendor_row']      = $r;
            $condition = " WHERE id = '".$package_id."'";
            $r = $this->common_model->get_all_details_query('subscription_plan',$condition)->row_array();
             

            $data['package_row']      = $r;
            $data['package_price']      = $package_price;
            $data['package_id']      = $package_id;
            $data['vendor_id']      = $vendor_id;

            $data['user'] = $user = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 
            $data['callback_url']       = base_url().'razorpay/subscription';
            $data['surl']               = base_url().'razorpay/subscription_success';;
            $data['furl']               = base_url().'razorpay/failed';;
            $data['currency_code']      = 'INR';
            $result['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();

            if (empty($package_price)) {
                $postData = $this->input->post();
                $data1['total_price'] = 0;
                $data1['grand_total'] = 0;
                $data1['tax'] = 0;
                $data1['tax_total'] = 0;
                $data1['mobile'] = $user->mobile;
                $data1['fname'] = $user->fname;
                /*$data1['lname'] = $this->input->post('lname');
                $data1['company'] = $this->input->post('company');
                $data1['address'] = $this->input->post('address'); 
                $data1['city'] = $this->input->post('city');
                $data1['state'] = $this->input->post('state');
                $data1['pincode'] = $this->input->post('zip');
                $data1['country'] = $this->input->post('country');
                */
                $data1['vendor_id'] = $vendor_id;
                $data1['package_id'] = $package_id;
                $data1['user_id'] = $this->session->userdata('userId');
                $data1['user_email'] = $this->session->userdata('email');
                $data1['pay_type'] = 'FREE';
                $data1['payment_gateway'] = 'FREE';
                $data1['method'] = 'FREE';
                $data1['order_id'] = 'FREE-'.rand();
                $data1['txn_id'] = 'FREE-'.rand();
                $data1['payment_status'] = 'NONE';
                $data1['order_status'] = 'Pending';
                $data1['created_at'] = date('Y-m-d H:i:s');
                
                $condition = " WHERE id = '". $this->input->post('package_id') ."'";
                $value = $this->common_model->get_all_details_query('subscription_plan',$condition)->row_array();
                $start_date = date('Y-m-d');

                $data1['package'] = $value['package_name'];
                $data1['start_date'] = $start_date;
                $data1['end_date'] = date('Y-m-d', strtotime(' + '.$value['valid_days'].' days'));
                $data1['total_job'] = $value['total_job'];
                $data1['total_days'] = $value['valid_days'];
                $data1['package_description'] = $value['package_description'];
                $data1['left_job'] = $value['total_job'];
                $this->db->insert('subscription_booking',$data1);
                redirect(base_url('postjob/addjob'));
            }

            $this->load->view('front/postjobs/checkout-subscriptions',$data); 
        }else{
           $condition = " WHERE id != '0' ";
            if($_GET['search_text'] && !empty($_GET['search_text'])){
                $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';
            }
            if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
                $condition .= ' AND status = '.$_GET['status'];
            }
            $condition .= " order by ui_order ASC";
            $list = $this->common_model->get_all_details_query($table,$condition)->result();
            $data['list'] = $list;
            $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
            
            $condition = " where user_id = '".$this->venderId."' order by id DESC";
            $subscription_booking = $this->common_model->get_all_details_query('subscription_booking',$condition)->row();
            $data['subscription_booking'] = $subscription_booking;  

            $this->load->view('front/postjobs/subscriptions',$data); 
        }
    }
	
	public function managesubscriptions() {
        $this->checkUserLogin();
        $this->checkUserType(); 
        $data['datas'] = $profile = $this->db->get_where('vender',['id'=> $this->venderId] )->row();
        $data['states'] = $this->db->get('states')->result();
        $data['cities'] = $this->db->order_by('city', 'asc')->get('cities')->result();


        $condition = " where user_id = '".$this->venderId."' order by id DESC";
        $list = $this->common_model->get_all_details_query('subscription_booking',$condition)->result();
        $data['subscription_booking'] = $list;   
        $this->load->view('front/postjobs/manage-subscriptions',$data);
    }
	

}

