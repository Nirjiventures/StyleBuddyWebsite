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

        $data['parentCategory'] = $this->data['parentCategory'];

    }



    public function giftcard(){
        $this->load->view('front/template/header',$data);
        $this->load->view('front/shop/gift-card',$data);
        $this->load->view('front/template/footer',$data);

    }


    public function cms($url){

        $data['parentCategory'] = $this->data['parentCategory'];

        $data['country'] = $this->db->get('countries')->result();

        $list = $this->db->query('select * from cms_pages where slug = "'.$url.'" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

        }



        if ($url == 'intial-booking-form') {

        }else if ($url == 'services') {

        }else{

            $list = $this->db->get_where('cms_pages',['slug'=> $url, 'status'=> 1 ])->row();

            if($list) {

                $data['cmsData'] = $list;

                $this->load->view('front/template/header',$data);

                if($list->slug === 'about-us') {

                    $this->load->view('front/cms-pages/about-us',$data);

                } else if( $list->slug === 'about-us-develop') {

                    $this->load->view('front/about-us-develop',$data);

                } else if( $list->slug === 'report-an-issue') {

                    $postData = $this->input->post();

                    if ($postData) {

                        $inputCaptcha = $this->input->post('captcha');

                        $sessCaptcha = $this->session->userdata('captchaTextCode');

                        if($inputCaptcha === $sessCaptcha){

                            $insert = array();

                            $insert['fname'] = $this->input->post('fname');

                            $insert['lname'] = $this->input->post('lname');

                            $insert['country'] = $this->input->post('country');

                            $insert['mobile'] = $this->input->post('mobile');

                            $insert['email'] = $this->input->post('email');

                            $insert['message'] = $this->input->post('message');

                            

                            

                            if(!empty($this->input->post('expertise'))) { 

                                $insert['issue'] = $arrayVal = implode(',',$this->input->post('expertise')); 

                            }





                            $insert['created_at']  = date('Y-m-d h:i:s');

                            $insert['ip_address'] = $this->input->ip_address();

                            $insert['user_agent'] = $this->input->user_agent();

                            $insert['browser'] = $this->agent->browser();

                            $insert['browserVersion'] = $this->agent->version();

                            $insert['platform'] = $this->agent->platform();

                            $updateTrue = $this->common_model->simple_insert('report_an_issue',$insert);

                            $this->session->set_flashdata('message_success_redirect_home','<div class=" p-2 mb-2"><p class="festival_message_p">Thank you. Our team will get back to you within 24 hours. </p><p  class="festival_message_p2"></p></div>'); 

                            redirect('report-an-issue','refresh');

                        }else{

                            $this->session->set_flashdata('imgBerror_','Please enter correct captch'); 

                            redirect('report-an-issue','refresh');

                        }

                    }

                    $rows  =  $this->common_model->get_all_details('report_an_issue_question',array('status'=>1))->result();

                    $data['report_an_issue_question'] = $rows;

                    $this->load->view('front/cms-pages/report-an-issue',$data);

                } else {

                    $this->load->view('front/cms-pages/privacy-policy',$data);

                }

                $this->load->view('front/template/footer',$data);

            }else{

                redirect('404_override');

            }

        }

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

                    $mailForm = $data['email'];

                    $subject = 'Contact Us Form Query';     

    

                    $option = '';

                    $option .= '<style>';

                        $option .= '.banner{background: #FFFA00; }

                                    .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}

                                    .banner img {width: 100%; height: 190px; object-fit: cover; }

                                    .meddle_content{padding:30px 40px; background:#fff;}

                                    .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   

                                    .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}

                                    .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}

                                    .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';

                    $option .= '</style>';

                    /*$option.= '<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 260px; ">';

                        $option  .= '<div class="row m-0" style="width:100%;">';

                            $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';

                                $option  .= '<h1 style="padding-top:42px;padding-left:20px;padding-right:20px;text-align:center; font-weight: 700; font-size: 20px; line-height: 36px; text-transform: uppercase;">Thank you for contacting Us</h1>';

                            $option  .= '</div>';

                            $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';

                                $option  .= '<img style="width: 100%; height: 260px; object-fit: cover; " src="'.base_url('assets/images/email_banner_contact_us.png').'" class="img-fluid">';

                            $option  .= '</div>';

                        $option  .= '</div>';

                    $option  .= '</div>';*/

                    /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';

                        $option  .= '<div class="row m-0" style="width:100%;">';

                            $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';

                                $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Thank you for contacting Us</h1>';

                            $option  .= '</div>';

                            $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';

                                $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_contact_us.png').'" class="img-fluid">';

                            $option  .= '</div>';

                        $option  .= '</div>';

                    $option  .= '</div>';*/

                    

                    /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';

                        $option  .= '<div class="row m-0" style="width:100%;">';

                            $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';

                                $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 

                                font-size: 100%; line-height: 20px; text-transform: uppercase;">Thank you for contacting U</h1>';

                            $option  .= '</div>';

                            $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';

                                $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_contact_us.png').'" class="img-fluid"> ';

                            $option  .= '</div>';

                        $option  .= '</div>';

                    $option  .= '</div>';*/

                    

                    

                    $mailContent =  mailHtmlHeader_New($this->site);

                        $mailContent .= $option;

                        $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Thank you for contacting Us</b></div>';

                        $mailContent .= '<div style="clear: both;"></div>';

                        $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';

                            $mailContent.='<h4>Hi '.ucwords($data['name']).',</h4>';

                            $mailContent .= '<p>We have received your query from our website. <br> Our team will be in touch with you very shortly.  In the meantime, <br>feel free to explore our styling services, click the button below:</p>';

                            $mailContent .= '<p><a href="'.base_url('services').'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;">Explore Styling Services</a></p>';

                        $mailContent .= '</div>';

                    $mailContent .= mailHtmlFooter_New_1($this->site);

                

                    $to      =  $data['email'];

                    $from = FROM_EMAIL;

                    $from_name = $this->site->site_name;

                    $cc = CC_EMAIL;

                    $reply = REPLY_EMAIL;

                    $pdfFilePath = '';

                    $admin =  $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);

                    if(!$admin) {

                       $array = array('success' => '<p class="alert text-white bg-danger p-2"><span >Something went wrong,try again </span></p>');

    

                       $this->session->set_flashdata('message','<p class="text-danger p-2 mb-2"><span >Something went wrong,try again</span></p>');

                    }else {

                        $array = array('success' => '<p class="text-white bg-info p-2"><span >Thank you for contacting Style Buddy. We will get back to you shortly</span></p>');

                    }

                    $this->session->set_flashdata('message','<p class="text-white bg-info mb-2"><span >Thank you for contacting Style Buddy. We will get back to you shortly</span></p>');

                    redirect(base_url('contact-us'));

                } else {

                    $this->session->set_flashdata('message','<p class="text-danger mb-2"><span >Something went wrong,try again</span></p>');


                }

            }

        }



        $list = $this->db->query('select * from cms_pages where slug = "contact-us" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

            $data['cmsData'] = $list;

        }

        $data['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/template/header',$data);

        $this->load->view('front/cms-pages/contact-us',$data);

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

                $data['parentCategory'] = $this->data['parentCategory'];

                $this->load->view('front/style-stories',$data);



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

                    

                    

                    $data['parentCategory'] = $this->data['parentCategory'];

                    $this->load->view('front/style-stories-details',$data);



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

        



        



        

        $data['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/style-stories-categories',$data);

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

        $data['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/style-stories-tag',$data);

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

        

         

        $data['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/style-stories-archives',$data);

    }

    public function postjoblogin(){

        redirect(base_url('login/postjoblogin'));

    }

    public function postjobregister(){

        redirect(base_url('login/postjobregister'));

    }

    public function browsejobs(){

        $segment1 = $this->uri->segment(1);

        $segment2 = $this->uri->segment(2);

        $segment = $segment1.'/'.$segment2;

        $uri_segment = 3;

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

        

        $config['uri_segment'] = $uri_segment;

        $config['use_page_numbers'] = TRUE;

         

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

        $style['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/jobs/browse-a-jobs',$style);

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

        $style['parentCategory'] = $this->data['parentCategory'];

        $this->load->view('front/jobs/browse-a-jobs-detail',$style);

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

}



