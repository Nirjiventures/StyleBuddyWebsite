<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Posts extends MY_Controller {

    

    function __construct()

    {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'posts';

        $this->uploadPath = 'assets/images/posts/';
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    

    private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

    public function index(){
        $this->getPermission('admin/posts');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;

        $condition = " WHERE id != '0' ";

        

        if($_GET['search_text'] && !empty($_GET['search_text'])){

            $condition .= ' AND title like "%'.$_GET['search_text'].'%"';

        }

        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){

            $condition .= ' AND status = '.$_GET['status'];

        }
        if($this->input->get('media_type') == 'video'){
            $condition .= ' AND media_type = "'.$_GET['media_type'].'"';
        }
        if($this->input->get('media_type') == 'image'){
            $condition .= ' AND media_type IS NULL AND media IS NOT NULL ';
        }
        if($this->input->get('media_type') == 'text'){
            $condition .= ' AND media  IS NULL ';
        }
        if(!empty($this->input->get('from_date')) && !empty($this->input->get('to_date'))){
            $condition .= '  AND (DATE(created_at) >= "'.$_GET['from_date'].'" AND DATE(created_at) <= "'.$_GET['to_date'].'") ';
        }
        if(!empty($this->input->get('from_date')) && empty($this->input->get('to_date'))){
            $condition .= '  AND DATE(created_at) = "'.$_GET['from_date'].'"';
        }
        if(empty($this->input->get('from_date')) && !empty($this->input->get('to_date'))){
            $condition .= '  AND DATE(created_at) = "'.$_GET['to_date'].'"';
        }
         

        $condition .= " order by id DESC";


        $query = $this->common_model->get_all_details_query($table,$condition);
        //echo $this->db->last_query();
        $numRows = $query->num_rows();
        
        $data['numRows'] = $numRows;
        
        $this->per_page = 20;
        $config = array();
        $config['total_rows'] = $numRows;
        $config['per_page'] = $this->per_page;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url().$url1.'/'.$url2.'/index';
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url']=base_url().$url1.'/'.$url2.'/index/?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $start_from = $this->uri->segment($config['uri_segment']);
        if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
        $limit['l1'] = $start;
        $limit['l2'] = $config["per_page"];

        
        
        $per_page = $config["per_page"];
        $list = $this->common_model->get_all_details_query($table,$condition.' limit '.$start.' ,'.$per_page)->result();
        foreach($list as $k=>$v){
            
            $list1 = $this->common_model->get_all_details('vender',array('id'=>$v->post_admin_id))->row();
            $list[$k]->post_admin_row = $list1;
        }
        //echo $this->db->last_query();
        
        
        $data['links'] = $links;
        $data['start_limit'] = $limit['l1'];
        $end_limit = $limit['l2'] + $limit['l1'];
        if($numRows > $end_limit){
            $data['end_limit'] = $end_limit;
        }else{
            $data['end_limit'] = $numRows;
        }
        $data['title'] = 'Stylist List';
        $data['list_heading'] = 'Stylist List';
        $data['right_heading'] = 'Add';
        $data['datas'] =  $list;
        
        
        
        
       

        $data['list'] = $list;

        $this->load->view('admin/'.$url2.'/list',$data);

    }

    public function add(){ 

        $this->getPermission('admin/posts/add');

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Subscription Question';

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('title', 'title', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['title']      = trim($this->input->post('title'));

                $insert_data['description']      = trim($this->input->post('description'));

                $insert_data['post_type']      = trim($this->input->post('post_type'));

                $insert_data['post_category']      = trim($this->input->post('post_category'));



                $slugBase = $slug = url_title($this->input->post('title'), '-', TRUE);

                $slug_check = '0';

                $duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));

                if ($duplicate_url->num_rows()>0){

                    $slug = $slugBase.'-'.$duplicate_url->num_rows();

                }else {

                    $slug_check = '1';

                }

                $urlCount = $duplicate_url->num_rows();

                while ($slug_check == '0'){

                    $urlCount++;

                    $duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));

                    if ($duplicate_url->num_rows()>0){

                        $slug = $slugBase.'-'.$urlCount;

                    }else {

                        $slug_check = '1';

                    }

                }

                $insert_data['slug'] = $slug;



                $multiImage = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $IsExistGallery = $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();

                    if(!empty($IsExistGallery)){

                        $galleryNew = $IsExistGallery->media;

                        $NowGalleryCreated = $galleryNew . ',' .$insert_;

                        $insert_data['media']=  trim($NowGalleryCreated,',');

                    }

                    else{

                        $insert_data['media']=  trim($insert_,',');

                    }

                }

                $insert_data['created_at']  = date("Y-m-d h:i:s");

                $insert_data['post_admin_id']  = 1;



                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);

                if($updateTrue){

                    $this->session->set_flashdata('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        

        $table = 'posts_type';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_type'] = $list  ;  

        

        $table = 'posts_category';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_category'] = $list  ;   



        $this->load->view('admin/'.$url2.'/addedit',$data);

    }

    public function edit($id=''){ 
        $this->getPermission('admin/posts/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = ' Subscription Question List';

        if (!empty($postData)) {            

            $this->form_validation->set_rules('title', 'title', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['title']      = trim($this->input->post('title'));

                $insert_data['description']      = trim($this->input->post('description'));

                $insert_data['post_type']      = trim($this->input->post('post_type'));

                $insert_data['post_category']      = trim($this->input->post('post_category'));



                $multiImage = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $IsExistGallery = $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();

                    if(!empty($IsExistGallery)){

                        $galleryNew = $IsExistGallery->media;

                        $NowGalleryCreated = $galleryNew . ',' .$insert_;

                        $insert_data['media']=  trim($NowGalleryCreated,',');

                    }

                    else{

                        $insert_data['media']=  trim($insert_,',');

                    }

                }



                $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                if($updateTrue){

                    $this->session->set_flashdata('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();

            $data['record_detail'] = $record_detail  ;  

        }



        $table = 'posts_type';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_type'] = $list  ;  

        

        $table = 'posts_category';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_category'] = $list  ;  

        $this->load->view('admin/'.$url2.'/addedit',$data);

    }

    public function view($id=''){ 
        $this->getPermission('admin/posts');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = ' Posts List';

        if (!empty($postData)) {            

            $this->form_validation->set_rules('title', 'title', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['title']      = trim($this->input->post('title'));

                $insert_data['description']      = trim($this->input->post('description'));

                $insert_data['post_type']      = trim($this->input->post('post_type'));

                $insert_data['post_category']      = trim($this->input->post('post_category'));



                $multiImage = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $IsExistGallery = $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();

                    if(!empty($IsExistGallery)){

                        $galleryNew = $IsExistGallery->media;

                        $NowGalleryCreated = $galleryNew . ',' .$insert_;

                        $insert_data['media']=  trim($NowGalleryCreated,',');

                    }

                    else{

                        $insert_data['media']=  trim($insert_,',');

                    }

                }



                $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                if($updateTrue){

                    $this->session->set_flashdata('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->session->set_flashdata('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();

            $data['record_detail'] = $record_detail  ;  

        }



        $table = 'posts_type';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_type'] = $list  ;  

        

        $table = 'posts_category';

        $condition = " WHERE id != '0' ";

        $condition .= " AND status = 1";

        $condition .= " order by id DESC";

        $list = $this->common_model->get_all_details_query($table,$condition)->result_array();

        $data['posts_category'] = $list  ;  

        $this->load->view('admin/'.$url2.'/view',$data);

    }

    public function delete($id){
        $this->getPermission('admin/posts/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;
        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','data deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

    public function deleteImages(){

        $postData = $this->input->get();

        $tbl_name = 'posts';

        if ($postData['table']) {

            $tbl_name = $postData['table'];

        }

        

        $id = $postData['id'];

        $img = $postData['img'];

        $column = $postData['column'];

        $path = $postData['path'];

        $condition = array('id' =>$id );

        $row = $this->common_model->get_all_details($tbl_name,$condition)->row_array();

        //echo $this->db->last_query();

        if($row){

            if($row[$column]){

                $b = array();

                $a = explode(',',$row[$column]);

                $pos = array_search($img, $a);

                unset($a[$pos]);

                $insert_data[$column] = implode(',',$a);

                $updateTrue       = $this->common_model->commonUpdate($tbl_name,$insert_data,$condition);

                //echo $this->db->last_query();

            }

        }

        echo 1;die;

        

    } 

    function changeStatus(){ 

        $type = $this->input->post('status');  

        $id = $this->input->post('id');  

        $table = $this->tbl_name;

        $params = array('status'=>$type);

        $this->common_model->commonUpdate($table,$params,array('id'=>$id));

        //echo $this->db->last_query();

        echo $type; 

        die;

    }

    function update_ui_order($ui_order='',$id='',$category=''){ 

        if ($id) {

            $tbl_name = $this->tbl_name;

            if ($ui_order) {

                $params = array('ui_order'=>$ui_order);

            }

            $con = array('id'=>$id);

            $this->common_model->commonUpdate($tbl_name,$params,$con);

             

            $condition = ' WHERE status = 1 AND ui_order >= '.$ui_order;

            $list = $this->common_model->get_all_details_query($tbl_name,$condition)->result_array();

            $uu = 0;

            foreach($list as $key=>$value){

                if($id != $value['id']){

                    $uu++;

                    $order = $ui_order + $uu;

                    $params = array('ui_order'=>$order,'status'=>1);

                    $con = array('id'=>$value['id']);

                    $this->common_model->commonUpdate($tbl_name,$params,$con);

                }

            }

            if($uu > 0){

                echo $uu;

            }else{

                echo 0;

            }

            die;

        }

    }
    public function export(){
        $filename = 'posts_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = $this->tbl_name;
         
        $condition = " WHERE id != '0' ";
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (title like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
         
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT * FROM '.$tbl_name.$condition);
        $usersData = $query->result_array();
        foreach($usersData as $k=>$v){
            $list1 = $this->common_model->get_all_details('vender',array('id'=>$v['post_admin_id']))->row_array();
            $usersData[$k]['post_admin_row'] = $list1;
        }

         
       
        $file = fopen('php://output', 'w');
 
        $header = array("Title","Post Admin","Media","Description","Category","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            $l = array();
            $l['title'] = $line['title'];
            $l['post_admin_row'] = $line['post_admin_row']['fname'];
            $l['media'] = ($line['media'])?base_url('assets/images/posts/'.$line['media']):'';
            $l['description'] = $line['description'];
            $l['post_category'] = $line['post_category'];
            $l['created_at'] = $line['created_at'];
            fputcsv($file,$l); 
        }
        fclose($file); 
        exit; 
	}
	
}    