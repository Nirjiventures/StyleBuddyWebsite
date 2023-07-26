<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Gift_booking extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'giftcard_booking';

        $this->uploadPath = 'assets/gift/';

    }

	

	private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

    public function index(){
        $this->getPermission('admin/gift_booking');
        $table = $this->tbl_name;

        $condition = " WHERE id != '0' ";

        

        if($_GET['search_text'] && !empty($_GET['search_text'])){

            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';

        }

        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){

            $condition .= ' AND status = '.$_GET['status'];

        }

        $condition .= " order by id DESC";



        $list = $this->common_model->get_all_details_query($table,$condition)->result();

       

        $data['list'] = $list;

        $this->load->view('admin/giftcard_booking/list',$data);

    }

    public function add(){ 

        $this->getPermission('admin/gift_booking/add');

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Gift card';

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('name', 'name', 'trim|required'); 

            $this->form_validation->set_rules('gift_code', 'gift_code', 'trim|required|is_unique[gift.gift_code]'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['name']      = trim($this->input->post('name'));

                $insert_data['gift_code']      = trim($this->input->post('gift_code'));

                $insert_data['gift_code_limit']      = trim($this->input->post('gift_code_limit'));

                $insert_data['gift_code_limit_avail']      = trim($this->input->post('gift_code_limit'));

                $insert_data['gift_code_price']      = trim($this->input->post('gift_code_price'));

                $insert_data['min_price']      = trim($this->input->post('min_price'));

                $insert_data['max_price']      = trim($this->input->post('max_price'));

                $insert_data['start_date']      = trim($this->input->post('start_date'));

                $insert_data['end_date']      = trim($this->input->post('end_date'));

                $insert_data['description']      = trim($this->input->post('description'));

                $insert_data['updated_at']  = date("Y-m-d h:i:s");

                $insert_data['created_at']  = date("Y-m-d h:i:s");



                $multiImage = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $insert_data['media']=  trim($insert_,',');

                }

                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);

                if($updateTrue){

                    $this->setErrorMessage('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->setErrorMessage('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        

         



        $this->load->view('admin/gift/addedit',$data);

    }

    public function edit($id=''){ 
        $this->getPermission('admin/gift_booking/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = ' Gift Card List';

        if (!empty($postData)) {            

            $this->form_validation->set_rules('name', 'name', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                $insert_data['name']      = trim($this->input->post('name'));

                $insert_data['gift_code']      = trim($this->input->post('gift_code'));

                

                $multiImage = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($multiImage)){

                    $insert_= trim($multiImage,',');

                    $insert_data['media']=  trim($insert_,',');

                }

                //$insert_data['gift_code_limit']      = trim($this->input->post('gift_code_limit'));

                $insert_data['gift_code_price']      = trim($this->input->post('gift_code_price'));

                $insert_data['min_price']      = trim($this->input->post('min_price'));

                $insert_data['max_price']      = trim($this->input->post('max_price'));

                $insert_data['start_date']      = trim($this->input->post('start_date'));

                $insert_data['end_date']      = trim($this->input->post('end_date'));

                $insert_data['updated_at']  = date("Y-m-d h:i:s");

                $insert_data['description']      = trim($this->input->post('description'));

                $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                if($updateTrue){

                    $this->setErrorMessage('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->setErrorMessage('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();

            $data['record_detail'] = $record_detail  ;  

        }

        $this->load->view('admin/gift/addedit',$data);

    }

    public function giftcodecheck() {

        $email = $this->input->post('checkEmail');

        $value = $this->db->get_where('gift',['gift_code'=> $email ])->row();

        if(!empty($value)) {  echo 1; } else { echo 0;  }

    }

    public function delete($id){
        $this->getPermission('admin/gift_booking/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Row deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

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