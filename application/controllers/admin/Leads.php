<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Leads extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

         $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        



        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'ask-quote';



        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();

    }

	

	private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

    public function dashboard(){

        $table = 'ask-quote';

        $condition = " WHERE allocated_id != '0' ";

        

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



        $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();

        foreach ($list as $key => $value) {

            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$value->stylist_id))->row();

            $list[$key]->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $list[$key]->stylist_mail = $venderRow->email;

            $list[$key]->stylist_mobile = $venderRow->mobile;



            $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();

            $list[$key]->availability_date = $availRow->availability_date;

            $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));

            $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));

            

        }

        $data['allocated_list'] = $list;

        $table = 'ask-quote';

        $condition = " WHERE allocated_id = '0' ";

        

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



        $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();

        foreach ($list as $key => $value) {

            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$value->stylist_id))->row();

            $list[$key]->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $list[$key]->stylist_mail = $venderRow->email;

            $list[$key]->stylist_mobile = $venderRow->mobile;



            $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();

            $list[$key]->availability_date = $availRow->availability_date;

            $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));

            $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));



        }

        $data['list'] = $list;

        $this->load->view('admin/leads/dashboard',$data);

    }

    



    public function allocate(){

        $table = 'ask-quote';

        $condition = " WHERE allocated_id != '0' ";

        

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



        $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();

        foreach ($list as $key => $value) {

            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$value->stylist_id))->row();

            $list[$key]->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $list[$key]->stylist_mail = $venderRow->email;

            $list[$key]->stylist_mobile = $venderRow->mobile;



            $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();

            $list[$key]->availability_date = $availRow->availability_date;

            $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));

            $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));

            

        }

        $data['list'] = $list;

        $this->load->view('admin/leads/allocate_list',$data);

    }

    public function allocate_edit($id=''){ 

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        //$this->db->query("ALTER TABLE `ask-quote` ADD `allocated_name` VARCHAR(255) NULL AFTER `allocated_id`");

        $tbl_name = 'ask-quote';

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Air Bill Entry List';

        

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();



            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$record_detail->stylist_id))->row();

            $record_detail->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $record_detail->stylist_mail = $venderRow->email;

            $record_detail->stylist_mobile = $venderRow->mobile;

            

            if (!$record_detail) {

                redirect(base_url($url1.'/'.$url2.'/allocate'));

            }

            $data['record_detail'] = $record_detail  ;  

        }

        if (!empty($postData)) {            

            $this->form_validation->set_rules('fname', 'fname', 'trim|required'); 

            $this->form_validation->set_rules('lname', 'lname', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                

                $vvv = explode('====', $this->input->post('allocated'));



                $insert_data['date_id']    = trim($this->input->post('date_id'));

                $insert_data['stylist_id']    = trim($this->input->post('stylist_id'));

                $insert_data['fname']    = trim($this->input->post('fname'));

                $insert_data['lname']      = trim($this->input->post('lname'));

                $insert_data['email']      = trim($this->input->post('email'));

                $insert_data['mobile']      = trim($this->input->post('mobile'));

                $insert_data['city']      = trim($this->input->post('city'));

                $insert_data['area_expertise']      = trim($this->input->post('area_expertise'));

                $insert_data['message']      = trim($this->input->post('message'));

                $insert_data['status']      = trim($this->input->post('status'));

                $insert_data['allocated_id']      = $vvv[0];

                $insert_data['allocated_name']      = $vvv[1];

                

                if ($id!='') { 

                    $insert_data['updated_at']  = date("Y-m-d h:i:s");

                    $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                    $insert_data['created_at']  = date("Y-m-d h:i:s");

                    $updateTrue = $this->common_model->simple_insert('ask_quote_log',$insert_data);

                }

                else{ 

                    /*$insert_data['created_at']  = date("Y-m-d h:i:s");

                    $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);*/

                    

                }

                if($updateTrue){

                    $this->setErrorMessage('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2.'/allocate');                   

                }else{

                    $this->setErrorMessage('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        $venderList  =  $this->common_model->get_all_details('vender',array('status'=>1))->result_array();

        $data['venderList'] = $venderList;

    



        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 limit 8')->result_array();

        $data['area_expertise'] = $loggedRow;



        $this->load->view('admin/leads/allocate_addedit',$data);

    }

    public function allocate_delete($id){

        $table = 'ask-quote';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Lead deleted successfully!!');

            redirect('admin/leads/allocate');

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/leads/allocate');

        }

    }

    public function index(){
        $this->getPermission('admin/leads');
        $table = 'ask-quote';

        $condition = " WHERE allocated_id = '0' ";

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



        $list = $this->db->query('SELECT * FROM `ask-quote`'.$condition)->result();

        //echo $this->db->last_query();

        foreach ($list as $key => $value) {

            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$value->stylist_id))->row();

            $list[$key]->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $list[$key]->stylist_mail = $venderRow->email;

            $list[$key]->stylist_mobile = $venderRow->mobile;



            $availRow  =  $this->common_model->get_all_details('stylist_availability',array('id'=>$value->date_id))->row();

            $list[$key]->availability_date = $availRow->availability_date;

            $list[$key]->availability_start_time = date('h:i A',strtotime($availRow->availability_start_time));

            $list[$key]->availability_end_time = date('h:i A',strtotime($availRow->availability_end_time));



        }

        $data['list'] = $list;

        $this->load->view('admin/leads/list',$data);

    }

    public function edit($id=''){ 
        $this->getPermission('admin/leads/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        //$this->db->query("ALTER TABLE `ask-quote` ADD `allocated_name` VARCHAR(255) NULL AFTER `allocated_id`");

        $tbl_name = 'ask-quote';

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Air Bill Entry List';

        

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();



            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$record_detail->stylist_id))->row();

            $record_detail->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $record_detail->stylist_mail = $venderRow->email;

            $record_detail->stylist_mobile = $venderRow->mobile;

            

            if (!$record_detail) {

                redirect(base_url($url1.'/'.$url2));

            }

            $data['record_detail'] = $record_detail  ;  

        }

        if (!empty($postData)) {            

            $this->form_validation->set_rules('fname', 'fname', 'trim|required'); 

            $this->form_validation->set_rules('lname', 'lname', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                

                $vvv = explode('====', $this->input->post('allocated'));



                $insert_data['date_id']    = trim($this->input->post('date_id'));

                $insert_data['stylist_id']    = trim($this->input->post('stylist_id'));

                $insert_data['fname']    = trim($this->input->post('fname'));

                $insert_data['lname']      = trim($this->input->post('lname'));

                $insert_data['email']      = trim($this->input->post('email'));

                $insert_data['mobile']      = trim($this->input->post('mobile'));

                $insert_data['city']      = trim($this->input->post('city'));

                $insert_data['area_expertise']      = trim($this->input->post('area_expertise'));

                $insert_data['message']      = trim($this->input->post('message'));

                $insert_data['status']      = trim($this->input->post('status'));

                $insert_data['source_from']      = trim($this->input->post('source_from'));

                $insert_data['allocated_id']  = $allocated_id    = $vvv[0];

                $insert_data['allocated_name']      = $vvv[1];

                

                if ($id!='') { 

                    $insert_data['updated_at']  = date("Y-m-d h:i:s");

                    $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                    $insert_data['created_at']  = date("Y-m-d h:i:s");

                    $updateTrue = $this->common_model->simple_insert('ask_quote_log',$insert_data);

                }

                else{ 

                    /*$insert_data['created_at']  = date("Y-m-d h:i:s");

                    $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);*/

                    

                }

                if($updateTrue){



                    /**/

                    $leadRow = $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();

                    $date_id = $leadRow['date_id'];

                    $sRow = $this->db->query('SELECT * FROM stylist_availability WHERE id ='.$date_id)->row_array();



                    $ddd = '';

                    if($sRow){

                        $ddd = date('Y-m-d',strtotime($sRow['availability_date'])) .' '.date('h:iA',strtotime($sRow['availability_start_time'])).'-'.date('h:iA',strtotime($sRow['availability_end_time']));

                    }

                    $allocatedRow  =  $this->common_model->get_all_details('vender',array('id'=>$allocated_id))->row_array();



                    $mailForm = $allocatedRow['email']; 

                    //$mailForm = 'vijay@gleamingllp.com'; 

                    $fullName = $allocatedRow['fname'].' '.$allocatedRow['lname'];



                    $this->mail->setFrom($mailForm,$fullName);

                    $this->mail->addAddress($this->mail->Username,$this->site->site_name);

                    $this->mail->addAddress($this->site->support_email,$this->site->site_name);

                    

                     

                    $this->mail->Subject = "Stylist Leads allocated";     

                    

                    $mailContent = ' ';

                    $mailContent .= '<br><br><br>';

                    $mailContent .= '<p><b>Name : </b>'.$fullName.'</p>';

                    $mailContent .= '<p><b>Email Id :</b>'. $mailForm.'</p>';



                    

                    ($data['mobile'])?$mailContent .= '<p><b>Mobile :</b>'. $allocatedRow['mobile'].'</p>':''; 

                    $mailContent .= '<h2>Client Detail</h2>

                                <p>First Name: '.$leadRow['fname'].'<br/>

                                Last Name: '.$leadRow['lname'].'<br/>

                                Email: '.$leadRow['email'].'<br/>

                                Mobile: '.$leadRow['mobile'].'<br/>

                                City: '.$leadRow['city'].'<br/>

                                Query: '.$leadRow['area_expertise'].'<br/>

                                Date Time '.$ddd.'</p>';

                    

                    $mailContent .= '<br><br>';

                    $mailContent .= '<p><b>Regards</b></p>';

                    $mailContent .= '<p>'.$fullName.'</p>';

                    

                    $this->mail->Body = $mailContent;

                    $admin =  $this->mail->send();

                    

                    /* Send email to   user */

                    $to      =  $mailForm;

                    //$form =  $this->site->support_email;

                    $form = $this->mail->Username;

                    $subject =  'Lead allocated';

                    $mailContent = '<p><b>Dear  </b>'.$fullName.'</p>

                                <h2>Client Detail</h2>

                                <p>First Name: '.$leadRow['fname'].'<br/>

                                Last Name: '.$leadRow['lname'].'<br/>

                                Email: '.$leadRow['email'].'<br/>

                                Mobile: '.$leadRow['mobile'].'<br/>

                                City: '.$leadRow['city'].'<br/>

                                Query: '.$leadRow['area_expertise'].'<br/>

                                Date Time '.$ddd.'</p>

                                <br><br>

                                <p><b>Regards</b></p>

                                <p>'.$this->site->site_name.'</p>

                                <p><b>CONTACT INFO</b></p>

                                <p>'.$this->site->mobile.'</p>

                                <p>Email: '.$this->site->email.'</p>

                                <p>'.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">

                              ';

                    $headers =  "MIME-Version: 1.0" . "\r\n";

                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    $headers .=  "From: Stylebuddy <$form>"  . "\r\n";

                    $headers .=  "Reply-To: $form"  . "\r\n";

                    mail($to, $subject, $mailContent, $headers);



                    /**/

                    $this->setErrorMessage('success','Data has been successfully updated');

                    redirect(base_url().$url1.'/'.$url2);                   

                }else{

                    $this->setErrorMessage('error','Opps! something went wrong, please try again');

                    $data['message_error'] = 'Opps! something went wrong, please try again';

                }

            }               

        }

        $venderList  =  $this->common_model->get_all_details('vender',array('status'=>1))->result_array();

        $data['venderList'] = $venderList;

    



        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 limit 8')->result_array();

        $data['area_expertise'] = $loggedRow;



        $this->load->view('admin/leads/addedit',$data);

    }

    public function upload($id=''){ 
        $this->getPermission('admin/leads/upload');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        //$this->db->query("ALTER TABLE `ask-quote` ADD `allocated_name` VARCHAR(255) NULL AFTER `allocated_id`");

        $tbl_name = 'ask-quote';

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'Air Bill Entry List';

        

        

        if (!empty($postData)) {            

            $this->form_validation->set_rules('fname', 'fname', 'trim|required'); 

            $this->form_validation->set_rules('lname', 'lname', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                

                $vvv = explode('====', $this->input->post('allocated'));

                $allocated_id    = $vvv[0];

                $allocated_name    = $vvv[1];

                //$insert_data['date_id']    = trim($this->input->post('date_id'));

                $insert_data['stylist_id']    = trim($allocated_id);

                $insert_data['fname']    = trim($this->input->post('fname'));

                $insert_data['lname']      = trim($this->input->post('lname'));

                $insert_data['email']      = trim($this->input->post('email'));

                $insert_data['mobile']      = trim($this->input->post('mobile'));

                $insert_data['city']      = trim($this->input->post('city'));

                $insert_data['area_expertise']      = trim($this->input->post('area_expertise'));

                $insert_data['message']      = trim($this->input->post('message'));

                $insert_data['status']      = trim($this->input->post('status'));

                $insert_data['source_from']      = trim($this->input->post('source_from'));

                $insert_data['allocated_id']  = $allocated_id ;

                $insert_data['allocated_name']      = $allocated_name;

                

                $insert_data['created_at']  = date("Y-m-d h:i:s");

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

        $venderList  =  $this->common_model->get_all_details('vender',array('status'=>1))->result_array();

        $data['venderList'] = $venderList;

    



        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 limit 8')->result_array();

        $data['area_expertise'] = $loggedRow;



        $this->load->view('admin/leads/addedit',$data);

    }

    public function delete($id){
        $this->getPermission('admin/leads/delete');
        $table = 'ask-quote';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Lead deleted successfully!!');

            redirect('admin/leads');

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/leads');

        }

    }

    public function venders()    { 

        $city_name = $this->input->get('term');

        $where = "  where fname LIKE '%". $city_name ."%'";

        //$where = "";

        $query = $this->db->query("select * from vender".$where);

        $list = $query->result(); 

        $result1 = array();

        if(!empty($list)) {

            foreach($list as $value) {

                $companyLabel['value'] = html_entity_decode($value->fname.' '.$value->lname);

                $companyLabel['id'] = html_entity_decode(($value->id));

                array_push( $result1, $companyLabel);

            }

        }



        echo json_encode( $result1 );

    }



}    