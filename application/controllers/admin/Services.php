<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->logged_in();
        $this->tbl_name = 'services';
    }
	
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
    public function index(){
        $this->getPermission('admin/services');
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
        $this->load->view('admin/services/list',$data);
    }
    public function add(){ 
        $this->getPermission('admin/services/add');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = $this->tbl_name;
        $postData = $this->input->post();
        
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = 'Service';
        
        if (!empty($postData)) {            
            $this->form_validation->set_rules('area_expertise_id', 'area_expertise_id', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                
                $vvv = explode('====', $this->input->post('area_expertise_id'));
                $insert_data['area_expertise_id']   = $area_expertise_id   = $vvv[0];
                $insert_data['area_expertise_name']      = $vvv[1];
                //$insert_data['package_feature']    = trim($this->input->post('package_feature'));
                
                $insert_data['package_title_1']      = trim($this->input->post('package_title_1'));
                $insert_data['package_description_1']      = trim($this->input->post('package_description_1'));
                $insert_data['package_name_1']      = trim($this->input->post('package_name_1'));
                $insert_data['package_price_1']      = trim($this->input->post('package_price_1'));
                
                $insert_data['package_title_2']      = trim($this->input->post('package_title_2'));
                $insert_data['package_description_2']      = trim($this->input->post('package_description_2'));
                $insert_data['package_name_2']      = trim($this->input->post('package_name_2'));
                $insert_data['package_price_2']      = trim($this->input->post('package_price_2'));
                
                $insert_data['package_title_3']      = trim($this->input->post('package_title_3'));
                $insert_data['package_description_3']      = trim($this->input->post('package_description_3'));
                $insert_data['package_name_3']      = trim($this->input->post('package_name_3'));
                $insert_data['package_price_3']      = trim($this->input->post('package_price_3'));
                
                $insert_data['created_at']  = date("Y-m-d h:i:s");
                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);
                
                if($updateTrue){
                    $this->common_model->commonUpdate('area_expertise',array('services_created_flag'=>1),array('id'=>$area_expertise_id));

                    /*$f1    = $this->input->post('first_col');
                    $c1    = $this->input->post('second_col');
                    $p1    = $this->input->post('third_col');
                    $L1    = $this->input->post('fourth_col');

                    $array = array();
                    for ($i=0; $i < count($f1) ; $i++) { 
                        $a = array();
                        $a['services_id'] = $updateTrue;
                        $a['feature'] = $f1[$i];
                        $a['classic'] = $c1[$i];
                        $a['premium'] = $p1[$i];
                        $a['luxury'] = $L1[$i];
                        $a['admin_status'] = 1;
                        array_push($array,$a);
                        $this->common_model->simple_insert('services_feature',$a);
                    }*/

                    $this->setErrorMessage('success','Data has been successfully updated');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->setErrorMessage('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        
        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 AND services_created_flag = 0 ')->result_array();
        //echo $this->db->last_query();
        $data['area_expertise'] = $loggedRow;

        $this->load->view('admin/services/addedit',$data);
    }
    public function edit($id=''){ 
        $this->getPermission('admin/services/edit');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        //$this->db->query("ALTER TABLE `ask-quote` ADD `allocated_name` VARCHAR(255) NULL AFTER `allocated_id`");
        $tbl_name = $this->tbl_name;
        $postData = $this->input->post();
        
        $data['title'] = 'Edit ';
        $data['list_heading'] = 'Edit';
        $data['right_heading'] = ' Entry List';
        
        
        if (!empty($postData)) {            
            $this->form_validation->set_rules('area_expertise_id', 'area_expertise_id', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                
                $vvv = explode('====', $this->input->post('area_expertise_id'));
                $insert_data['area_expertise_id']   = $area_expertise_id   = $vvv[0];
                $insert_data['area_expertise_name']      = $vvv[1];
                //$insert_data['package_feature']    = trim($this->input->post('package_feature'));
                
                $insert_data['package_title_1']      = trim($this->input->post('package_title_1'));
                $insert_data['package_description_1']      = trim($this->input->post('package_description_1'));
                $insert_data['package_name_1']      = trim($this->input->post('package_name_1'));
                $insert_data['package_price_1']      = trim($this->input->post('package_price_1'));
                
                $insert_data['package_title_2']      = trim($this->input->post('package_title_2'));
                $insert_data['package_description_2']      = trim($this->input->post('package_description_2'));
                $insert_data['package_name_2']      = trim($this->input->post('package_name_2'));
                $insert_data['package_price_2']      = trim($this->input->post('package_price_2'));
                
                $insert_data['package_title_3']      = trim($this->input->post('package_title_3'));
                $insert_data['package_description_3']      = trim($this->input->post('package_description_3'));
                $insert_data['package_name_3']      = trim($this->input->post('package_name_3'));
                $insert_data['package_price_3']      = trim($this->input->post('package_price_3'));
                

                if ($id!='') { 
                    //$insert_data['updated_at']  = date("Y-m-d h:i:s");
                    $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                    $wh = array();
                    $wh['services_id'] = $id;
                    $wh['admin_status'] = 1;
                    $this->common_model->commonDelete('services_feature',$wh);

                    /*$f1    = $this->input->post('first_col');
                    $c1    = $this->input->post('second_col');
                    $p1    = $this->input->post('third_col');
                    $L1    = $this->input->post('fourth_col');
                    
                    $array = array();
                    if( $f1){
                        for ($i=0; $i < count($f1) ; $i++) { 
                            $a = array();
                            $a['services_id'] = $id;
                            $a['feature'] = $f1[$i];
                            $a['classic'] = $c1[$i];
                            $a['premium'] = $p1[$i];
                            $a['luxury'] = $L1[$i];
                            $a['admin_status'] = 1;
                            array_push($array,$a);
                            $this->common_model->simple_insert('services_feature',$a);
                        }
                    }*/

                }
                if($updateTrue){
                    $updateTrue = $this->common_model->commonUpdate('area_expertise',array('services_created_flag'=>1),array('id'=>$area_expertise_id));
                    
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

            /*$venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$record_detail->stylist_id))->row();
            $record_detail->stylist_name = $venderRow->fname.' '.$venderRow->lname;
            $record_detail->stylist_mail = $venderRow->email;
            $record_detail->stylist_mobile = $venderRow->mobile;*/
            
            $condition = " WHERE services_id = '". $id ."' AND admin_status = '1' order by id asc";
            $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();
            $record_detail['package_featureArray']      = $rows; 
            //echo $this->db->last_query();
            $data['record_detail'] = $record_detail  ;  
        }

        $loggedRow = $this->db->query('select * from area_expertise where status  = 1 ')->result_array();
        //echo $this->db->last_query();
        $data['area_expertise'] = $loggedRow;
        $this->load->view('admin/services/addedit',$data);
    }
    public function delete($id){
        $this->getPermission('admin/services/delete');
        $table = $this->tbl_name;
        
        $record_detail  =  $this->common_model->get_all_details($table,array('id'=>$id))->row_array();
        $this->common_model->commonUpdate('area_expertise',array('services_created_flag'=>0),array('id'=>$record_detail['area_expertise_id']));
        
        
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Services deleted successfully!!');
            redirect('admin/services');
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/services');
        }
    }
}    