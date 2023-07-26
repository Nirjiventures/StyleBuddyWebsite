<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Push_notification_log extends MY_Controller {

    function __construct() {

        parent::__construct();

         

	}

	public function index() {
		$this->getPermission('admin/push_notification_log');
		$data = array(

            'rows' => $users,

            'title' => 'Push Notification Activity Log List',

            'list_heading' => 'Push Notification Activity Log',

        );

		$tbl_name = 'push_notification_activity_log';

		$str = " WHERE notification_id = '0' order by id desc";

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

		$query = $this->common_model->get_all_details_query($tbl_name,$str,$limit);

		$this->db->last_query(); 

		$post_list = $query->result();

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

        $this->load->view('admin/notification/push_notification-activity-log-list',$data);

        $this->load->view('admin/template/footer');



        //$this->template->load('admin/base', 'admin/notification/push_notification-activity-log-list', $data);

    }

    public function delete($id){
    	$this->getPermission('admin/push_notification_log/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = 'push_notification_activity_log';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

    function deleteRecord() {
    	
		$id = $this->input->post('id');

		$tbl_name = 'push_notification_activity_log';

		$msg = 1;

		$success_count = 0;

		$error_count = 0;

		if($id!=''){

			$deleted  = $this->common_model->commonDelete($tbl_name,array('id'=>$id));

			$success_count += 1;

		}

		$data['msg'] = $msg;

		$data['status'] = 1;

		$data['error_count'] = $error_count;

		$data['success_count'] = $success_count;

		echo json_encode($data);	

		die;		

	}

}

