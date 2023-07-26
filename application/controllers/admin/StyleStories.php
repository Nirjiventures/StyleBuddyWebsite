<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StyleStories extends MY_Controller {

    function __construct(){

        parent::__construct();

        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        

        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();

        

        $this->userID = $this->session->userdata('userId');

        $this->venderId = $this->session->userdata('venderId');

        $this->load->model('common_model');

    }

    public function index(){  

        

        $this->db->select('blog.*, vender.fname,vender.lname'); 

        $this->db->from('blog');

        $this->db->join('vender', 'vender.id = blog.vender_id');

        $data['blogs']  = $this->db->get()->result();



        $blogs = $this->common_model->get_all_details_query('blog',' order BY ID desc')->result();

        foreach($blogs as $k=>$v){

            

            if($v->vender_id){

                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.' order BY ID desc')->row_array();

                $blogs[$k]->uploaded_by = $d['fname'].' '.$d['lname'];

            }else{

                $blogs[$k]->uploaded_by = 'ADIMN';

            }

            

        }

        $data['blogs'] = $blogs;

        $this->load->view('admin/style-stories/style-stories',$data);

            

    }

    

    public function storyStatus(){

        $id = $this->input->post('id');

        $status = $this->input->post('status');

        $update = $this->db->where('id',$id)->update('blog',['status'=> $status]);

        echo $update;

    }

    public function add(){  

        $postData = $this->input->post(); 

        if ($postData) {

            $this->form_validation->set_rules('category_id','Category','required|trim');

            $this->form_validation->set_rules('blogTitle','Story Title','required|trim');

            $this->form_validation->set_rules('shortData','Short Description','required|trim');

            $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');

           // $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 

            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');

            

            if( $this->form_validation->run() == true) {

                $this->uploadPath = 'assets/images/story/';

                

                 
                $image = $this->uploadSingleImage('blogImage',$this->uploadPath);

                if(!empty($image)){
                    $data['blogImage'] = $image;
                    $image_type_full = $_FILES['blogImage']['type'];
                    $image_type = explode('/',$image_type_full);
                    $data['blogImage_type'] = $image_type[0];

                }
                if ($_POST['screenshotbase64']) {
                    $data1 = $_POST['screenshotbase64'];
                    list($type, $data1) = explode(';', $data1);
                    list(, $data1) = explode(',', $data1);
                    $data1 = base64_decode($data1);
                    
                    $mt = explode(' ', microtime());
                    $millies = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
                    $screenshotfilename = time(). $millies . '.png';
                    
                    file_put_contents($this->uploadPath . $screenshotfilename, $data1);
                    $data['blogImage_thumbnail'] = $screenshotfilename;
                }
                 

                $image = $this->uploadSingleImage('detailImg',$this->uploadPath);

                if(!empty($image)){

                    $data['detailImg'] = $image;
                    $image_type_full = $_FILES['detailImg']['type'];
                    $image_type = explode('/',$image_type_full);
                    $data['detailImg_type'] = $image_type[0];
                }   

                

                

                

                $data['category_id'] = $this->input->post('category_id');

                $data['tag_id'] = implode(',',$this->input->post('tag_id'));

                $data['blogTitle'] = $this->input->post('blogTitle');

                $data['shortData'] = $this->input->post('shortData');

                $data['longData'] = $this->input->post('longData');

                $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');

                $data['blogSlug'] = url_title($data['blogTitle'], 'dash', true);

                

                

                if($this->input->post('meta_title')){

                    $data['meta_title'] = $this->input->post('meta_title'); 

                }else{

                    $data['meta_title'] = $this->input->post('blogTitle'); 

                }

                if($this->input->post('meta_keyword')){

                    $data['meta_keyword'] = $this->input->post('meta_keyword'); 

                }else{

                    $data['meta_keyword'] = $this->input->post('shortData'); 

                }

                if($this->input->post('meta_description')){

                    $data['meta_description'] = $this->input->post('meta_description'); 

                }else{

                    $data['meta_description'] = $this->input->post('shortData'); 

                }

                

                

                $insert = $this->db->insert('blog',$data);

                if($insert) {

                    $this->session->set_flashdata('success','<span class="pink_c p-2">Style Stories Details added Successfully!!</span>');

                    redirect('admin/StyleStories');   

                } else {

                    $this->session->set_flashdata('error','<span class="bg-danger p-2">Something Went Wrong, try again!!</span>');

                    redirect('admin/StyleStories');   

                }

            } 

                 

        }  

        $data['styleStory'] = array();

        $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();

        $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();

        $this->load->view('admin/style-stories/style-stories-edit',$data);

    }

    public function edit($id){

         

        $postData = $this->input->post();

        if ($postData) {

            $this->form_validation->set_rules('category_id','Category','required|trim');

            $this->form_validation->set_rules('blogTitle','Story Title','required|trim');

            $this->form_validation->set_rules('shortData','Short Description','required|trim');

            $this->form_validation->set_rules('longData', 'Long Description', 'required|trim');

            $this->form_validation->set_message('is_unique', 'The %s is already taken, Please use another Title'); 

            $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');

            

            $id = $this->input->post('id');

            if( $this->form_validation->run() == true) {

                $this->uploadPath = 'assets/images/story/';

                $image = $this->uploadSingleImage('blogImage',$this->uploadPath);

                if(!empty($image)){
                    $data['blogImage'] = $image;
                    $image_type_full = $_FILES['blogImage']['type'];
                    $image_type = explode('/',$image_type_full);
                    $data['blogImage_type'] = $image_type[0];

                }
                $image = $this->uploadSingleImage('blogImage_thumbnail',$this->uploadPath);
                if(!empty($image)){
                    $data['blogImage_thumbnail'] = $image;
                }

                

                if ($_POST['screenshotbase64']) {
                    $data1 = $_POST['screenshotbase64'];
                    list($type, $data1) = explode(';', $data1);
                    list(, $data1) = explode(',', $data1);
                    $data1 = base64_decode($data1);
                    
                    $mt = explode(' ', microtime());
                    $millies = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
                    $screenshotfilename = time(). $millies . '.png';
                    
                    file_put_contents($this->uploadPath . $screenshotfilename, $data1);
                    $data['blogImage_thumbnail'] = $screenshotfilename;
                }
                 
                 

                $image = $this->uploadSingleImage('detailImg',$this->uploadPath);

                if(!empty($image)){

                    $data['detailImg'] = $image;
                    $image_type_full = $_FILES['detailImg']['type'];
                    $image_type = explode('/',$image_type_full);
                    $data['detailImg_type'] = $image_type[0];
                }   

                $data['category_id'] = $this->input->post('category_id');

                $data['tag_id'] = implode(',',$this->input->post('tag_id'));

                $data['blogTitle'] = $this->input->post('blogTitle');

                $data['shortData'] = $this->input->post('shortData');

                $data['longData'] = $this->input->post('longData');

                $data['created_at'] = $data['created_at']  = date('Y-m-d h:i:s');

                $data['meta_title'] = $this->input->post('meta_title'); 

                $data['meta_keyword'] = $this->input->post('meta_keyword'); 

                $data['meta_description'] = $this->input->post('meta_description'); 

                 

                 

                

                $table = 'blog'; 

                $where = ['id'=> $id];

                $update = $this->Page_Model->common_update($data,$where,$table); 

                if($update) {

                    $this->session->set_flashdata('success','<span class="pink_c p-2">Style Stories Details updated Successfully!!</span>');

                    redirect('admin/StyleStories');   

                } else {

                    $this->session->set_flashdata('error','<span class="bg-danger p-2">Something Went Wrong, try again!!</span>');

                    redirect('admin/StyleStories');   

                }

            } else {

                redirect('admin/StyleStories/edit/'.$id);   

            }

        }

        $data['styleStory'] = $this->db->get_where('blog',[ 'id' => $id ])->row();

        if($data['styleStory']) {

            $data['tags'] = $this->db->get_where('blogTags',['status'=> 1 ])->result();

            $data['category'] = $this->db->get_where('blogCategory',['status'=> 1 ])->result();

            $this->load->view('admin/style-stories/style-stories-edit',$data);

        } else {

            redirect('admin/StyleStories');     

        }

         

    } 

    

    public function delete($id){



        $url1  =$this->uri->segment(1);



        $url2  =$this->uri->segment(2);



        $url3  =$this->uri->segment(3);



        $table = 'blog';



        $delete = $this->common_model->commonDelete($table,array('id'=>$id));



        if($delete) {



            $this->session->set_flashdata('success','Story deleted successfully!!');



            redirect('admin/'.$url2);



        } else {



            $this->session->set_flashdata('error','Something Went Wrong, try again!!');



            redirect('admin/'.$url2);



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

}    

