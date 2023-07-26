<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Users_report extends MY_Controller {

    function __construct() {

        parent::__construct();

         

	}

	public function index() {
		$this->getPermission('admin/users_report');
		$data = array(

            'rows' => $users,

            'title' => 'Users Report Log List',

            'list_heading' => 'Users Report Log list',

        );

		$tbl_name = 'users_report';

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
		foreach ($post_list as $key => $value) {
			$r = $this->common_model->get_all_details('vender',array('id'=>$value->to_user_id))->row();
			$post_list[$key]->to_user = $r;
			$r = $this->common_model->get_all_details('vender',array('id'=>$value->user_id))->row();
			$post_list[$key]->user = $r;

		}
		$data['list'] = $post_list;

		$this->load->view('admin/template/header');

        $this->load->view('admin/'.$segment2.'/list',$data);

        $this->load->view('admin/template/footer');

    }

    public function delete($id){
    	$this->getPermission('admin/users_report/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = 'posts_report';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Message deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }
    public function post_delete($id){
        $this->getPermission('admin/posts/delete');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $table = 'posts';
        $delete = $this->common_model->commonDelete($table,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','post deleted successfully!!');
            redirect('admin/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/'.$url2);
        }
    }
    
    function changeStatusUser(){ 
        $type = $this->input->post('status');  
        $id = $this->input->post('id');  
        $table = 'vender';
        $params = array('status'=>$type);
        $this->common_model->commonUpdate($table,$params,array('id'=>$id));
        echo $type; 
        die;
    }
    function changeStatusPost(){ 
        $type = $this->input->post('status');  
        $id = $this->input->post('id');  
        $table = 'posts';
        $params = array('status'=>$type);
        $this->common_model->commonUpdate($table,$params,array('id'=>$id));
        echo $type; 
        die;
    }
}

