<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Push_notification extends MY_Controller {

    function __construct() {

        parent::__construct();

         

	}

	public function index() {
		$this->getPermission('admin/push_notification');
		$data = array(

            'rows' => $users,

            'title' => 'Notification List',

            'list_heading' => 'Notification list',

        );

		$tbl_name = 'push_notification';

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

		$config['per_page'] = 20;

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

        $this->load->view('admin/notification/send_notice-list',$data);

        $this->load->view('admin/template/footer');



        //$this->template->load('admin/base', 'admin/notification/send_notice-list', $data);

    }

    public function send() {
    	$this->getPermission('admin/push_notification/send');
    	$segment1 = $this->uri->segment(1);

		$segment2 = $this->uri->segment(2);

		$segment3 = $this->uri->segment(3);

		$segment4 = $this->uri->segment(4);

		$postData = $this->input->post();

		if(!empty($postData)){

			$users 	=  $this->common_model->get_all_details('token_log',array())->result_array();

    		$count = 1;

    		$title = $this->input->post('title');

    		$description = $this->input->post('description');

    		

    		$device_array= array();			

			$payloaArray = array();

			foreach ($users as $key => $value) {

    			$created = date('Y-m-d H:i:s');

    			$offer_id = 1;

    			if(!empty($value)){

    				$device_token = $value['device_id'];

    				$user_mobile_info = array($device_token);

    				if($device_token){

						array_push($device_array,$value['device_id']);

					}

    			}

    			$count++;

    		}

			if($device_array){

				$payloaArray['badge'] = 0;

				$payloaArray['sound'] = "default";

				$payloaArray['body'] = $description;

				$payloaArray['title'] = $title;

				$payloaArray['notification_type'] = '';

				$noti = $this->common_model->push_notification($device_array, $payloaArray);

 

				$insert_data = array();

				$insert_data['title'] = $title;

				$insert_data['description'] = $description;

				$insert_data['device_id'] = json_encode($device_array);

				

				$insert_data['multicast_id'] = $noti->multicast_id;;

				$insert_data['message_id'] = json_encode($noti->results);

				$insert_data['success_count'] = $noti->success;

				$insert_data['error_count'] = $noti->failure;



				$last_id = $this->common_model->simple_insert('push_notification',$insert_data);

				

				$insert_data = array();

				$insert_data['notification_id'] = $last_id;

				$insert_data['title'] = $title;

				$insert_data['message_to'] = $description;

				

				$insert_data['multicast_id'] = $noti->multicast_id;;

				$insert_data['message_id'] = json_encode($noti->results);

				$insert_data['success_count'] = $noti->success;

				$insert_data['error_count'] = $noti->failure;

				

				$this->common_model->simple_insert('push_notification_activity_log',$insert_data);



				$this->setErrorMessage('success','<div class=" p-2 mb-2"><p class="festival_message_p">Notification Send Successfully.</p></div>');

            	redirect(base_url($segment1.'/'.$segment2));

			}

		}

        $data = array(

            'title' => 'Send Notification',

            'list_heading' => 'Send Notification',

        );



        $this->load->view('admin/template/header');

        $this->load->view('admin/notification/send_notice',$data);

        $this->load->view('admin/template/footer');

	}

    public function delete($id){
    	$this->getPermission('admin/push_notification/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = 'push_notification';

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

		$tbl_name = 'push_notification';

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

