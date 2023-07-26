<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stories extends MY_Controller {
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
   
    public function styleStory($slug = ''){
            $segment1 = $this->uri->segment(1);
            $segment2 = $this->uri->segment(2);
            $segment3 = $this->uri->segment(3);
            $uri_segment = 2;
            $paginationPrefix = $segment1.'/';
            $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

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

                    $this->session->set_flashdata('success','<span class="text-success" style="font-size: 18px;"><b>Thank you for your comment. StyleBuddy team is reviewing the comment and it will be available for other users to see in the next 24 to 48 hours. </b></span><br/>');
                    redirect(current_url());
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
            
            if($slug == '' || is_numeric($slug)) { 
                $where = ' where status = 1 order BY id desc';
                $query = $this->db->query("select * from blog".$where);
                $rowCount = $query->num_rows();
                $par_page = 16; 
                $config = array();
                $this ->load->library('pagination');
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
                $config["base_url"] = base_url().$paginationPrefix;
                $config['suffix'] = '?' . http_build_query($_GET, '', "&");
                $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");
                $this->pagination->initialize($config); 
                if($page != 0){ $page = ($page-1) * $par_page; }
                $where .= " limit ".$page.", ".$par_page;
                $query = $this->db->query("select * from blog".$where);
                $blogs = $query->result();

                //$blogs = $this->common_model->get_all_details_query('blog',' where status = 1 order BY ID desc')->result();
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
                $this->load->view('front/stories/style-stories',$data);
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
                    $list = array();
                    if($blogs->blogImage_type == 'video')  { 
                        if(!empty($blogs->blogImage_thumbnail ))  { 
                            $img1 =  'assets/images/story/'.$blogs->blogImage_thumbnail ; 
                            if (file_exists($img1)) {
                                $img = $img1;
                            }
                        }
                    }else{
                        if(!empty($blogs->blogImage ))  { 
                            $img1 =  'assets/images/story/'.$blogs->blogImage ; 
                            if (file_exists($img1)) {
                                $img = $img1;
                            }
                        }
                    }

                    $list['meta_image'] = $img;
                    
                    $meta_title = $blogs->meta_title; 
                    
                    if(empty($meta_title)){
                        $meta_title = $blogs->blogTitle;
                    } 
                    $list['meta_title'] = $meta_title;
                    $list['meta_description'] = $blogs->meta_description; 
                    $list['meta_keyword'] = $blogs->meta_keyword; 
                    $data['seoData'] = (object)$list; 
                    
                    $comments = $this->common_model->get_all_details_query('`contact-us`',' where form_id = "'.$blogs->id.'" AND form_name = "Blog Form" AND status = 1 order by id desc')->result();
                    $data['comments'] = $comments; 
                 
                    $this->load->view('front/stories/style-stories-details',$data);
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
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-stories"')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/stories/style-stories',$data);
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
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-stories"')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/stories/style-stories',$data);
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
        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "style-stories"')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/stories/style-stories',$data);
    }
    public function archive(){
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

}

