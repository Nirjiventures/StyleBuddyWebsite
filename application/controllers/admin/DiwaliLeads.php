<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class DiwaliLeads extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

         $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'festival_form';

        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();

    }

	

	private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

     

    public function index(){
        $this->getPermission('admin/DiwaliLeads');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        

        $table = 'festival_form';

        $condition = " WHERE festival_name = 'Diwali'  ";

        $condition .= " order by id DESC";

        

        $query = $this->db->query('SELECT * FROM '.$table.''.$condition);

        $numRows = $query->num_rows();

        /*

         

        $data['numRows'] = $numRows;

        $this->per_page = 20;

        $config = array();

        $config['total_rows'] = $numRows;

        $config['per_page'] = $this->per_page;

        $config['full_tag_open'] = '';

        $config['full_tag_close'] = '';

        $config['first_link'] = 'First';

        $config['last_link'] = 'Last';

        $config['uri_segment'] = 3;

        $config['use_page_numbers'] = TRUE;

        $config["base_url"] = base_url().$url1.'/'.$url2.'/index';

        $config['suffix'] = '?' . http_build_query($_GET, '', "&");

        $config['first_url']=base_url().$url1.'/'.$url2.'/index?'.http_build_query($_GET, '', "&");

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

        $query = $this->db->query('SELECT * FROM '.$table.''.$condition.' limit '.$start.' ,'.$per_page);*/

        $list = $query->result();



        $data['links'] = $links;

        $data['start_limit'] = $limit['l1'];

        $end_limit = $limit['l2'] + $limit['l1'];

        if($numRows > $end_limit){

            $data['end_limit'] = $end_limit;

        }else{

            $data['end_limit'] = $numRows;

        }

        $data['title'] = 'Diwali Leads List';

        $data['list_heading'] = 'Diwali Leads List';

        $data['right_heading'] = 'Add';

        

        $data['list'] = $list;

        $this->load->view('admin/rakhiLeads/list',$data);

    }

    public function delete($id){
        $this->getPermission('admin/DiwaliLeads/delete');
        $url1  =$this->uri->segment(1);

        $url2  =$this->uri->segment(2);

        $url3  =$this->uri->segment(3);

        $table = 'festival_form';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Lead deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

     



}    