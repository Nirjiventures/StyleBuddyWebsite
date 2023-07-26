<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Ask_for_quote_log extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->tbl_name = 'ask_for_quote';

        $this->list = 'list';

        $this->add = 'add_edit';

        $this->edit = 'add_edit';

        $this->folder = 'ask_for_quote_log';

         

	}

	public function index() {
		$this->getPermission('admin/ask_for_quote_log');
		$data = array(

            'rows' => $users,

            'title' => 'Ask for a quote Log List',

            'list_heading' => 'Ask for a quote Log list',

        );

		$tbl_name = $this->tbl_name;

		$str = " WHERE id != '0' order by id desc";

		$segment1 = $this->uri->segment(1);

		$segment2 = $this->uri->segment(2);

		$segment3 = $this->uri->segment(3);

		$segment4 = $this->uri->segment(4);

		$list 	=  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);

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

		$this->load->view('admin/template/header');

        $this->load->view('admin/'.$this->folder.'/'.$this->list,$data);

        //$this->load->view('admin/template/footer');

    }

    

    public function delete($id){
    	$this->getPermission('admin/ask_for_quote_log/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Deleted successfully!!');

            redirect($url1.'/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

    

    public function export(){

        $filename = 'register_stylist_data_'.date('Y-m-d-H-i-s').'.csv'; 

        header("Content-Description: File Transfer"); 

        header("Content-Disposition: attachment; filename=$filename"); 

        header("Content-Type: application/csv; ");

        

        $tbl_name =  $this->tbl_name;

         

        

        $condition .= " order by id DESC";

        $query = $this->db->query('SELECT name,email,mobile,created_at FROM '.$tbl_name.$condition);

        $usersData = $query->result_array();



        $file = fopen('php://output', 'w');

 

        $header = array("Name","Email","Mobile No","Created Date"); 

        fputcsv($file, $header);

        foreach ($usersData as $key=>$line){ 

            fputcsv($file,$line); 

        }

        fclose($file); 

        exit; 

	}



}

