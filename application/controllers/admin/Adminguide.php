<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Adminguide extends MY_Controller {

    

    function __construct()

    {

        parent::__construct();

        $this->load->library('session');

         $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        



        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'upload_documents';



        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();

    }

    

    private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

      

     

    public function index(){
        $this->getPermission('admin/adminguide');
        $table = $this->tbl_name;

        $condition = " WHERE id != '0' ";

        

        if($_GET['search_text'] && !empty($_GET['search_text'])){

            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';

        }

        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){

            $condition .= ' AND status = '.$_GET['status'];

        }

        if($this->input->get('allocated_status') == '0' || $this->input->get('allocated_status') == '1'){

            if($this->input->get('allocated_status') == '1'){

                $condition .= ' AND allocated_id != 0 ';

            }else{

                $condition .= ' AND allocated_id = 0 ';

            }

        }

        $condition .= " order by id DESC";



        $list = $this->db->query('SELECT * FROM '.$table.$condition)->result();

        $data['list'] = $list;

        $this->load->view('admin/adminguide/list',$data);

    }

     

    public function upload($id=''){ 
        $this->getPermission('admin/adminguide/upload');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Admin Guide';

        

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('title', 'title', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['title']      = trim($this->input->post('title'));





                $this->uploadPath = 'assets/images/package_report/';

                $image = $this->uploadSingleImageOnly('image',$this->uploadPath);

                if(!empty($image)){

                    $image_type_full = $_FILES['image']['type'];

                    $image_type = explode('/',$image_type_full);

                    $insert_data['image'] = $image;

                }

                

                $insert_data['created_at']  = date("Y-m-d h:i:s");

                $insert_data['updated_at']  = date("Y-m-d h:i:s");

                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data); 

                //echo $this->db->last_query();

                if($updateTrue){

                    $this->setErrorMessage('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->setErrorMessage('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        $this->load->view('admin/adminguide/addedit',$data);

    }

    public function delete($id){
        $this->getPermission('admin/adminguide/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Data deleted successfully!!');

            redirect(base_url().$url1.'/'.$url2);       

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect(base_url().$url1.'/'.$url2);       

        }

    }

     



}    