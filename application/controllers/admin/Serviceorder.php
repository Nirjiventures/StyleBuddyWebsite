<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Serviceorder extends MY_Controller {

	

	function __construct()

	{

        parent::__construct();

        $this->load->library('session');

        $this->load->model('common_model');

        $this->logged_in();

        $this->tbl_name = 'services_booking';



        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

        $this->style = $this->Page_Model->stylist();

        

        $this->load->library('PHPMailer_Lib');

        $this->mail = $this->phpmailer_lib->load();



    }

	

	private function logged_in(){

        if (!$this->session->userdata('authenticated')) {

            redirect('desk-login');

        }

    }

    public function index(){

         
        $this->getPermission('admin/serviceorder'); 
        $table = $this->tbl_name;

        $condition = " WHERE id != '0' ";

        

        if($_GET['search_text'] && !empty($_GET['search_text'])){

            $condition .= ' AND allocated_name like "%'.$_GET['search_text'].'%"';

        }

        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){

            $condition .= ' AND status = '.$_GET['status'];

        }

        $condition .= " order by id DESC";



        $list = $this->common_model->get_all_details_query($table,$condition)->result();

       

        $data['list'] = $list;

        $this->load->view('admin/template/header');

        $this->load->view('admin/serviceorder/order',$data);

        $this->load->view('admin/template/footer'); 



    }

    public function detail($id){ 

        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $table = $this->tbl_name;

        $postData = $this->input->post();

        $condition = " order by id DESC";

        $list = $this->common_model->get_all_details_query('payment_status',$condition)->result();

        $data['payment_status_list'] = $list;



        $condition = " order by id DESC";

        $list = $this->common_model->get_all_details_query('order_status',$condition)->result();

        $data['status_list'] = $list;



        if(!empty($this->input->post('payment_status'))){

            $status = trim($this->input->post('payment_status'));

            $this->db->where ( 'id',$id);

            $this->db->update($table,['payment_status'=> $status]);

        }



        if(!empty($this->input->post('order_status'))){
            $this->getPermission('admin/serviceorder/edit');
            $status = trim($this->input->post('order_status'));

            $this->db->where ( 'id',$id);

            if ($status == 'Delivered') {

                if ($order->payment_status == 'APPROVED') {

                    $this->db->update($table,['order_status'=> $status]);

                }else{

                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');

                    redirect(base_url($url1.'/'.$url2.'/details/'.$id));

                }

                

            }else{

                $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');

                $this->db->update($table,['order_status'=> $status]);

            }

        }



        

        $condition = " WHERE id = '".$id."' ";

        $order = $this->common_model->get_all_details_query($table,$condition)->row();

        $data['order'] = $order;

        $condition = " WHERE id = '". $order->package_id ."'";

        $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();

        

         

        $txt = 'Classic';

        if ($order->package == 'package_price_1') {



           $txt = 'Classic';

           $description = 'package_description_1';

        }elseif ($order->package == 'package_price_2') {



           $txt = 'Premium';

           $description = 'package_description_2';

        }elseif ($order->package == 'package_price_3') {



           $txt = 'Luxury';

           $description = 'package_description_3';

        }



       $option = '<div class="summery_order">';

            $option = '<div class="row align-items-center">

                            <div class="col-sm-12">

                                <p class="odds">

                                    <b>Order ID : #'.$order->id.' | </b>

                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>

                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>

                                    Order Date : '. date('j F, Y',strtotime($order->created_at)) .'

                                </p>

                            </div>

                        </div>';

                 $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">

                        <tr style="border: 1px solid #333;">

                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$value['area_expertise_name'].'</b></td>

                        </tr> 

                        <tr style="border: 1px solid #333;">

                            <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                                <td colspan="2" style="border: 1px solid #333;text-align:left">'. $value[$description] .'</td>

                                </tr>';

                         

                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;"> <b>Total: </b></td>

                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;"> <b>Tax: </b></td>

                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->tax_total) .'</b></td>

                        </tr>';

                        $option .= '<tr style="border: 1px solid #333;">

                            <td style="border: 1px solid #333;"> <b>Grand Total: </b></td>

                            <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->grand_total) .'</b></td>

                        </tr>';

            $option .= '</table>';

            $option .= '<div style="background: #e5da95;margin-bottom: 20px;padding: 16px;">

                            <div class="row">

                                <div class="col-sm-6">

                                    <h3 class="uk_title mb-3 mt-3">Address</h3>

                                    <p>'. $order->address .'</p>

                                    <p>Pin - '. $order->pincode .'</p>

                                    <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>

                                    <p>Email : '. $order->user_email .'</p>

                                    <p>Mobile : '. $order->mobile .'</p>

                                </div>

                            </div>

                        </div>';

        $option .= '</div>';



        $data['result']  = $option;



        $this->load->view('admin/template/header');

        $this->load->view('admin/serviceorder/order_details',$data);

        $this->load->view('admin/template/footer'); 

    }

     

    public function delete($id){
        $this->getPermission('admin/serviceorder/delete');
        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Service order deleted successfully!!');

            redirect('admin/services');

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/services');

        }

    }

}    