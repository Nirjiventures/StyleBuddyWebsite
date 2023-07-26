<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Abandon_cart extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->tbl_name = 'user_cart_session';

	}

	public function index() {
		$this->getPermission('admin/abandon_cart');
		$data = array(

            'rows' => $users,

            'title' => 'Abandon cartList',

            'list_heading' => 'Abandon cartlist',

        );

		$tbl_name = 'user_cart_session';

		$str = " WHERE user_id REGEXP '^[0-9]+$' and user_id !=0 order by id desc";

		$segment1 = $this->uri->segment(1);

		$segment2 = $this->uri->segment(2);

		$segment3 = $this->uri->segment(3);

		$segment4 = $this->uri->segment(4);

		$list 	=  $this->common_model->get_all_details_distinct_query('id',$tbl_name,$str);
        //echo $this->db->last_query();
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

			$r = $this->common_model->get_all_details('vender',array('id'=>$value->user_id))->row();

			$post_list[$key]->name = $r->fname.' '.$r->lname;

			$post_list[$key]->email = $r->email;

			$post_list[$key]->mobile = $r->mobile;

			$post_list[$key]->sessionArray = json_decode($value->cart_record); ;







		}

		$data['list'] = $post_list;

		$this->load->view('admin/template/header');

        $this->load->view($segment1.'/'.$segment2.'/list',$data);

        $this->load->view('admin/template/footer');

    }

    public function view($id=''){ 
    	$this->getPermission('admin/abandon_cart/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = ' Cart Detail List';

        if (!$id) {

        	redirect($url1.'/'.$url2);

        }

        $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();

        $record_detail->user_cart  =  $this->common_model->get_all_details('user_cart',array('user_id'=>$record_detail->user_id))->result();



        $data['record_detail'] = $record_detail  ;  

    

        $this->load->view('admin/template/header');

        $this->load->view('admin/'.$url2.'/addedit',$data);

        $this->load->view('admin/template/footer');

    }

    public function delete($id){
    	$this->getPermission('admin/abandon_cart/delete');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $tbl_name = 'user_cart_session';
        $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();
        $delete =  $this->common_model->commonDelete('user_cart',array('user_id'=>$record_detail->user_id));
        $delete = $this->common_model->commonDelete($tbl_name,array('id'=>$id));
        if($delete) {
            $this->session->set_flashdata('success','Deleted successfully!!');
            redirect('admin/'.$url2);
        } else {
            $this->session->set_flashdata('error','Something Went Wrong, try again!!');
            redirect('admin/'.$url2);
        }
    }

}

