<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Webuser extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('admin/Dashboard_Model');

        $this->load->model('Common_model');

        

         

	}

	public function index() {

        $this->getPermission('admin/allproducts');

	    $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $data['country'] = $this->db->order_by('name', 'asc')->get('countries')->result();
        $data['states'] =  array();
        $data['cities'] = array();
        
        if ($this->input->get('country')) {
            $data['states'] = $this->db->order_by('name', 'asc')->get_where('states',['country_id'=> $this->input->get('country')])->result();
        }
        if ($this->input->get('state')) {
            $data['cities'] = $this->db->order_by('name', 'asc')->get_where('cities',['state_id'=> $this->input->get('state')])->result();
        }

        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '3' AND FIND_IN_SET('web',registration_on) ";
         
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR lname like "%'.$_GET['search_text'].'%" OR name like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if($this->input->get('profile_update_ratio')){
            $condition .= ' AND profile_update_ratio = '.$this->input->get('profile_update_ratio');
        }
        if($this->input->get('experience')){
            $condition .= ' AND experience = '.$this->input->get('experience');
        }
        if($this->input->get('gender')){
            $condition .= ' AND gender = '.$this->input->get('gender');
        }
        if($this->input->get('country')){
            $condition .= ' AND country = '.$this->input->get('country');
        }
        if($this->input->get('state')){
            $condition .= ' AND state = '.$this->input->get('state');
        }
        if($this->input->get('city')){
            $condition .= ' AND city = '.$this->input->get('city');
        }
        if($this->input->get('social_id')){
            if($this->input->get('social_id') == 1){
                $condition .= ' AND social_id != ""';
            }else{
                $condition .= ' AND social_id IS NULL ';
            }
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT * FROM vender'.$condition);
        //echo $this->db->last_query();
        $numRows = $query->num_rows();

         
        $data['numRows'] = $numRows;
        
        $this->per_page = 25;
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

        $condition .= ' LIMIT '.$start.' ,'.$config["per_page"];
        
        $per_page = $config["per_page"];
        $rows = $this->db->query('SELECT * FROM vender'.$condition);
       // echo $this->db->last_query();
        $list = $rows->result();

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


        $data['expertises'] = $this->Dashboard_Model->common_all('area_expertise');
        $this->load->view($url1.'/template/header');
        $this->load->view($url1.'/'.$url2.'/list',$data);
        $this->load->view($url1.'/template/footer');
    }

    public function delete($id){
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $table = 'vender';
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Deleted successfully!!');
            redirect($url1.'/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect($url1.'/'.$url2);
        }
    }
    
    public function export(){
        $filename = 'register_user_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        //$condition = " WHERE user_type = '2' ";
        //$condition = " WHERE user_type = '3' AND (user_agent LIKE '%StyleBuddy%' OR user_agent LIKE '%okhttp%') ";
        $condition = " WHERE user_type = '3' AND FIND_IN_SET('web',registration_on) ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR lname like "%'.$_GET['search_text'].'%" OR name like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, lname, email, mobile,address,city_name,state_name,instagram_nlink,created_at FROM vender'.$condition);
        $usersData = $query->result_array();


         
       
        $file = fopen('php://output', 'w');
 
        $header = array("First Name","Last Name","Email","Mobile No","Address","City Name","State Name","Istagram Link","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}
	
}