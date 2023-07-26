<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allvideos extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->logged_in();
        $this->tbl_name = 'portfolio_video';
        $this->uploadPath = 'assets/images/story/';
    }
	
	private function logged_in(){
        if (!$this->session->userdata('authenticated')) {
            redirect('desk-login');
        }
    }
    public function index(){
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);
        $tbl_name = $this->tbl_name;

        $str = " WHERE id != '0' order by id desc";
        $list   =  $this->common_model->get_all_details_distinct_query('id,vender_id',$tbl_name,$str);
        $post_list = $list->result();
        $vender_id_Array = array();
        foreach ($post_list as $key => $value) {
            if (!in_array($value->vender_id, $vender_id_Array)) {
                array_push($vender_id_Array, $value->vender_id);
            }
        }
        $str = " WHERE id != '0' ";
        if ($this->input->get('vender_id')) {
            $str .= " AND vender_id = '".$this->input->get('vender_id')."'";
        }
        
        $str .= " order by id desc";
        $list   =  $this->common_model->get_all_details_distinct_query('id,vender_id',$tbl_name,$str);
        $numRows =  $list->num_rows();
        
        

        $data['numRows'] = $numRows;

        $this->load->library('pagination');

        $config = array();

        $config['total_rows'] = $numRows;

        $config['per_page'] = 50;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

        $config['uri_segment'] = 4;

        $config['use_page_numbers'] = TRUE;

        $config["base_url"] = base_url().$segment1.'/'.$segment2.'/index';

        $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['first_url']=base_url().$segment1.'/'.$segment2.'/index/?'.http_build_query($_GET, '', "&");

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

        $cars = $this->common_model->get_all_details_query($tbl_name,$str,$limit);

        $this->db->last_query(); 

        $post_list = $cars->result();

        $data['links'] = $links;

        $data['start_limit'] = $limit['l1'];

        $end_limit = $limit['l2'] + $limit['l1'];

        if($numRows > $end_limit){

            $data['end_limit'] = $end_limit;

        }else{

            $data['end_limit'] = $numRows;

            

        }
        $data['list'] = $post_list;
        $data['venders'] = $post_list;
        if($vender_id_Array){
            $i = 0;
            $str = '';
            foreach ($vender_id_Array as $key => $value) {
                if ($i>0) {
                    $str .= ' OR ';
                }
                $str .= 'id = "'.$value.'"';
                $i++;
            }
            if ($str) {
                $str1 = ' WHERE status = 1 AND ('.$str.') order by fname ASC';
                $query = $this->common_model->get_all_details_query('vender',$str1);
                $post_list = $query->result();
                $data['venders'] = $post_list;
            }
        }

        $this->load->view($segment1.'/'.$segment2.'/list',$data);
    }
    public function add(){ 
        
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = $this->tbl_name;
        $postData = $this->input->post();
        
        $data['title'] = 'Add ';
        $data['list_heading'] = 'Add';
        $data['right_heading'] = 'Video';
        
        if (!empty($postData)) {            
            $this->form_validation->set_rules('name', 'name', 'trim|required'); 
            if($this->form_validation->run()== TRUE){
                $insert_data                = array();
                $insert_data['name']    = trim($this->input->post('name'));
                $insert_data['on_page'] = trim($this->input->post('on_page'));
                $insert_data['video_type'] = trim($this->input->post('video_type'));
                $insert_data['updated_at']  = date("Y-m-d h:i:s");
                $insert_data['created_at']  = date("Y-m-d h:i:s");
                $insert_data['youtube_url'] = trim($this->input->post('youtube_url'));
                $multiImage = $this->uploadMultipleImageOnly('media',$this->uploadPath);
                if(!empty($multiImage)){
                    $insert_= trim($multiImage,',');
                    $insert_data['media']=  trim($insert_,',');
                }
                $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);
                if($updateTrue){
                    $this->setErrorMessage('success','Data has been successfully added');
                    redirect(base_url().$url1.'/'.$url2);                   
                }else{
                    $this->setErrorMessage('error','Opps! something went wrong, please try again');
                    $data['message_error'] = 'Opps! something went wrong, please try again';
                }
            }               
        }
        $this->load->view($url1.'/'.$url2.'/add-edit',$data);
    }
    public function edit($id=''){ 
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
                $insert_data['name']    = trim($this->input->post('name'));
                $insert_data['on_page'] = trim($this->input->post('on_page'));
                $insert_data['video_type'] = trim($this->input->post('video_type'));
                $insert_data['youtube_url'] = trim($this->input->post('youtube_url'));
                $multiImage = $this->uploadMultipleImageOnly('media',$this->uploadPath);
                if(!empty($multiImage)){
                    $insert_= trim($multiImage,',');
                    $insert_data['media']=  trim($insert_,',');
                }
                $insert_data['updated_at']  = date("Y-m-d h:i:s");
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
        $this->load->view($url1.'/'.$url2.'/add-edit',$data);
    }
     
    public function delete($id){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Row deleted successfully!!');
            redirect($url1.'/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect($url1.'/'.$url2);
        }
    }
    function changeStatus(){ 
        $type = $this->input->post('status');  
        $id = $this->input->post('id');  
        $table = $this->tbl_name;
        $params = array('admin_status'=>$type);
        $this->common_model->commonUpdate($table,$params,array('id'=>$id));
        echo $type; 
        die;
    }
}    