<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faqs_category extends MY_Controller {
    function __construct(){

        parent::__construct();

        $this->load->library('session');

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'faqs_category';

         
        $this->uploadPath = 'assets/images/faqs_category/';
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
        $this->getPermission('admin/faqs_category'); 
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;

        $condition = " WHERE id != '0' ";

        

         

        $condition .= " order by id DESC";



        $list = $this->common_model->get_all_details_query($table,$condition)->result();

       

        $data['list'] = $list;

        $this->load->view('admin/'.$url2.'/list',$data);

    }

    public function add(){ 

        $this->getPermission('admin/faqs_category/add');

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Faqs List';

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('name', 'name', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['name']      = trim($this->input->post('name'));
                $insert_data['sub_title']      = trim($this->input->post('sub_title'));
                $insert_data['description']      = trim($this->input->post('description'));
                $slugBase = $slug = url_title($this->input->post('name'), '-', TRUE);

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



                $multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $insert_data['image']=  trim($insert_,',');

                }

                $insert_data['created_at']  = date("Y-m-d h:i:s");
                //$insert_data['updated_at']  = date("Y-m-d h:i:s");

                 



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

        

         

        $this->load->view('admin/'.$url2.'/addedit',$data);

    }

    public function edit($id=''){ 
        $this->getPermission('admin/faqs_category/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Faqs List';

        if (!empty($postData)) {            

            $this->form_validation->set_rules('name', 'name', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['name']      = trim($this->input->post('name'));
                $insert_data['sub_title']      = trim($this->input->post('sub_title'));
                $insert_data['description']      = trim($this->input->post('description'));

                $multiImage = $this->uploadMultipleImageOnly('image',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $insert_data['image']=  trim($insert_,',');

                }


                //$insert_data['updated_at']  = date("Y-m-d h:i:s");


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



           

        $this->load->view('admin/'.$url2.'/addedit',$data);

    }

    public function delete($id){
        $this->getPermission('admin/faqs_category/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Data deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

    public function deleteImages(){

        $postData = $this->input->get();

        $tbl_name = $this->tbl_name;

       /* if ($postData['table']) {

            $tbl_name = $postData['table'];

        }*/

        

        $id = $postData['id'];

        $img = $postData['img'];

        $column = $postData['column'];

        $path = $postData['path'];

        $condition = array('id' =>$id );

        $row = $this->common_model->get_all_details($tbl_name,$condition)->row_array();

         

        if($row){

            if($row[$column]){

                $b = array();

                $a = explode(',',$row[$column]);

                $pos = array_search($img, $a);

                unset($a[$pos]);

                $insert_data[$column] = implode(',',$a);

                $updateTrue       = $this->common_model->commonUpdate($tbl_name,$insert_data,$condition);

                echo $this->db->last_query();

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
}    