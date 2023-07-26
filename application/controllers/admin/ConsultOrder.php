<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class ConsultOrder extends MY_Controller {

	

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
        $this->getPermission('admin/consultOrder'); 
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        

        $table = 'consult_order';

        $condition = " order by id DESC";



        $list = $this->db->query('SELECT * FROM '.$table.''.$condition)->result();

        $data['list'] = $list;

        $data['title'] = 'Fashion Expert Consultation';

        $data['list_heading'] = 'Fashion Expert Consultation';

        $data['right_heading'] = 'Add';

        $this->load->view('admin/consultOrder/list',$data);

    }

    public function view($id){

        

        $data['order'] = $order = $this->db->get_where('consult_order',['id'=> $id])->row_array();

        $option = '<div class="summery_order">';

            $option = '<div class="row align-items-center">

                            <div class="col-sm-12">

                                <p class="odds">

                                    <b>Order ID : #'.$order['id'].' | </b>

                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>

                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>

                                    Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'

                                </p>

                            </div>

                        </div>';

                 $option .= '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">';



                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>

                            <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;" class="text-left"><b>Email : </b></td>

                            <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['email']).'</td>

                        </tr>';

                        if ($order['mobile']) {

                            $option .= '<tr style="border: 1px solid #333;">

                                <td style="border: 1px solid #333;" class="text-left"><b>Mobile : </b></td>

                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['mobile']).'</td>

                            </tr>';

                        }

                        $option .= '<tr style="border: 1px solid #333;">

                            <td colspan="2" style="text-align:center"><h5>Package Info </h5></td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                            <td colspan="2" style="text-align:center"> <b>Package Name : <b>'. $order['package_name'] .'</b></td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;"> <b>Package Price : </b></td>

                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['total_price']) .'</b></td>

                        </tr>';

                        $package_description =  json_decode($order['package_description']);



                        foreach ($package_description as $key => $value) {

                            $option .= '<tr style="border: 1px solid #333;">

                                <td style="border: 1px solid #333;"> <b>'.$value->question_name.' : </b></td>

                                <td style="border: 1px solid #333;"> <b>'. $value->question_value .'</b></td>

                            </tr>';

                        }

                        



            $option .= '</table>';

             

        $option .= '</div>';

        



        $data['result']  = $option;

        $this->load->view('admin/consultOrder/order_details',$data);

    }

    public function delete($id){
        $this->getPermission('admin/consultOrder/delete'); 
        $url1  =$this->uri->segment(1);

        $url2  =$this->uri->segment(2);

        $url3  =$this->uri->segment(3);

        $table = 'consult_order';

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Consultation order deleted successfully!!');

            redirect('admin/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

     



}    