<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Check_availability extends MY_Controller {

    function __construct() {

        parent::__construct();

         

	}

	public function index() {
		 $this->getPermission('admin/check_availability');
		//$this->db->query("ALTER TABLE `check_availability` ADD `allocated_id` INT NOT NULL DEFAULT '0' AFTER `source_from`, ADD `allocated_name` VARCHAR(255) NULL DEFAULT NULL AFTER `allocated_id`");

		$data = array(

            'rows' => $users,

            'title' => 'Check Availability List',

            'list_heading' => 'Check Availability list',

        );

		$tbl_name = 'check_availability';

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

		foreach ($post_list as $key => $value) {

			$r = $this->common_model->get_all_details_query('area_expertise_looking','where id="'.$value->service_id.'"')->row();

			$post_list[$key]->service_name = $r->title_develop;

			$r = $this->common_model->get_all_details_query('vender','where id="'.$value->vendor_id.'"')->row();

			$post_list[$key]->vendor_name = $r->fname.' '.$r->lname;

		}

		$data['list'] = $post_list;

        $this->load->view('admin/template/header');

        $this->load->view('admin/check_availability/list',$data);

        //$this->load->view('admin/template/footer');

    }

    public function edit($id=''){ 

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = 'check_availability';

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = 'List';

        

        if ($id!='') {

            $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row();



            $venderRow  =  $this->common_model->get_all_details('vender',array('id'=>$record_detail->vendor_id))->row();

            $record_detail->stylist_name = $venderRow->fname.' '.$venderRow->lname;

            $record_detail->stylist_mail = $venderRow->email;

            $record_detail->stylist_mobile = $venderRow->mobile;

            



            $r = $this->common_model->get_all_details_query('area_expertise_looking','where id="'.$record_detail->service_id.'"')->row();

			$record_detail->service_name = $r->title_develop;

			



            if (!$record_detail) {

                redirect(base_url($url1.'/'.$url2));

            }

            $data['record_detail'] = $record_detail  ;  

        }

        if (!empty($postData)) {            

            $this->form_validation->set_rules('fname', 'fname', 'trim|required'); 

            if($this->form_validation->run()== TRUE){

                $insert_data                = array();

                

                $vvv = explode('====', $this->input->post('allocated'));



                 

                $insert_data['vendor_id']    = trim($this->input->post('stylist_id'));

                $insert_data['name']    = trim($this->input->post('fname'));

                $insert_data['email']      = trim($this->input->post('email'));

                $insert_data['phone']      = trim($this->input->post('mobile'));

                $insert_data['city']      = trim($this->input->post('city'));

                $insert_data['message']      = trim($this->input->post('message'));

                $insert_data['status']      = trim($this->input->post('status'));

                $insert_data['source_from']      = trim($this->input->post('source_from'));

                $insert_data['allocated_id']  = $allocated_id    = $vvv[0];

                $insert_data['allocated_name']      = $vvv[1];

                

                if ($id!='') { 

                    $insert_data['updated_at']  = date("Y-m-d h:i:s");

                    $updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$id));

                }

                else{ 

                    /*$insert_data['created_at']  = date("Y-m-d h:i:s");

                    $updateTrue                 = $this->common_model->simple_insert($tbl_name,$insert_data);*/

                }

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



        $this->load->view('admin/check_availability/addedit',$data);

    } 

    public function delete($id){

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = 'check_availability';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Deleted successfully!!');

            redirect('admin/'.$url2);

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



         



        $tbl_name = 'check_availability';

		$str = " WHERE id != '0' order by id desc";

		$segment1 = $this->uri->segment(1);

		$segment2 = $this->uri->segment(2);

		$segment3 = $this->uri->segment(3);

		$segment4 = $this->uri->segment(4);

		//$query 	=  $this->common_model->get_all_details_distinct_query('name,email,phone,created_at',$tbl_name,$str);;

		$query 	=  $this->common_model->get_all_details_query($tbl_name,$str);

		$usersData = $query->result_array();



		foreach ($usersData as $key => $value) {

			$r=$this->common_model->get_all_details_query('area_expertise_looking','where id="'.$value['service_id'].'"')->row();

			$usersData[$key]['service_name'] = $r->title_develop;

			$r=$this->common_model->get_all_details_query('vender','where id="'.$value['vendor_id'].'"')->row();

			$usersData[$key]['vendor_name'] = $r->fname.' '.$r->lname;

		}

        $file = fopen('php://output', 'w');

        $header = array("Stylist Name","Name","Email","Mobile No","City","Service","Message","Created Date"); 

        fputcsv($file, $header);

        foreach ($usersData as $key=>$line){ 

        	$a = array();

        	$a['vendor_name'] = $line['vendor_name'];

        	$a['name'] = $line['name'];

        	$a['email'] = $line['email'];

        	$a['phone'] = $line['phone'];

        	$a['city'] = $line['city'];

        	$a['service_name'] = $line['service_name'];

        	$a['message'] = $line['message'];

        	$a['created_at'] = $line['created_at'];

        	fputcsv($file,$a); 

        }

        fclose($file); 

        exit; 

	}

    function deleteRecord() {

		$id = $this->input->post('id');

		$tbl_name = 'check_availability';

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

