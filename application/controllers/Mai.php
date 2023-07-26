<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mai extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        $this->load->model('common_model');
    }
    
    public function index() {
            $data['order_id'] = 4;
            $id = $data['order_id'];
             
            $order = $this->db->get_where('services_booking',['id'=> $id])->row();
            var_dump($order);
            
            if ($order) { 
                $condition = " WHERE id = '". $order->package_id ."'";
                $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();
                 
                if ($value['admin_status']) {
                    $condition = " WHERE services_id = '". $value['services_id'] ."' order by id asc";
                }else{
                    $condition = " WHERE services_id = '". $value['id'] ."' order by id asc";
                }
                $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();
                  
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

                $up = array();
                $up['sentMailFlag'] = 1;
                $this->db->where('id', $id);
                $this->db->update('services_booking',$up); 
                 
                 
                
                $option = '<div class="summery_order">
                            <hr/> 
                            <div class="row">

                                <div class="col-sm-12">
                                    <p class="odds">
                                        <b>Order ID : #'.$order->id.' | </b>
                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>
                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>
                                        Order Date : '. date('j F, Y',strtotime($order->created_at)) .'
                                    </p>
                                </div>
                            </div>
                            <table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse; display:none">
                                <thead>
                                <tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333;" class="text-left"><b>Feature</b></td>
                                    <td style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>
                                </tr>
                                </thead><tbody>';
                                $total = 0; 
                                $discountTotal = 0;
                                foreach($rows as $list) { 
                                    $option .= '<tr style="border: 1px solid #333;">
                                        <td style="border: 1px solid #333;text-align:left">'. $list['feature'] .'</td>
                                        <td style="border: 1px solid #333;text-align:left">'. $list[strtolower($txt)] .'</td>
                                        </tr>';
                                }

                                $option .= '<tr style="border: 1px solid #333;">
                                    <td class="text-right" style="border: 1px solid #333;"><b> </b></td>
                                    <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></td>
                                </tr>';
                            $option .= '</tbody></table>
                            <div><h3>'.$value['area_expertise_name'].'</h3></div>
                            <div><b>'.$txt.' Package</b></div>
                            <div>'.$value[$description].'</div>
                            <div style="padding: 4px;"><b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></div>
                            <div style="padding: 20px;margin-bottom: 20px;line-height: 7px; margin-top:4px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3>Shipping Address</h3>
                                        <p>'. $order->address .'</p>
                                        <p>Pin - '. $order->pincode .'</p>
                                        <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>
                                        <p>Email : '. $order->user_email .'</p>
                                        <p>Mobile : '. $order->mobile .'</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                 


                $to      =  'vijay@gleamingllp.com,'.$order->user_email;
                $form =  $this->mail->Username;
                $mailContent = '<p><b>Dear : </b>'.ucwords($order->fname.' '.$order->lname).'</p>';
                $mailContent .= $option;
                $mailContent .= '<hr/>';
                $mailContent .= '<p>Thanks for order</p>
                            <p><b>Regards</b><br/>'.$this->site->site_name.'</p>
                            <p><b>CONTACT INFO</b><br/>
                            '.$this->site->mobile.'<br/>Email: '.$this->site->email.''.$this->site->address.'</p><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 240px;">';
                
                
                            
                $pdf_name = 'invoice_'.time() .'.pdf';
                $pdfFilePath = FCPATH . "upload/pdf/" . $pdf_name;
                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';
                //echo APPPATH.'third_party/mpdf/mpdf.php';;
                
                //require_once APPPATH . '/third_party/mpdf/vendor/autoload.php';
                try {
                    /*$mpdf = new \Mpdf\Mpdf();
                    $mpdf->WriteHTML('<h1>Hello world!</h1>');
                    $mpdf->Output();*/

                    $this->load->library('m_pdf'); 
                    $this->m_pdf->pdf->WriteHTML($sty, 1);
                    $this->m_pdf->pdf->AddPage();
                    $this->m_pdf->pdf->WriteHTML($mailContent);

                    //$this->m_pdf->pdf->Output();
                    $this->m_pdf->pdf->Output($pdfFilePath, 'I');
                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');

                    $config = array('mailtype' => 'html','charset'  => 'utf-8','priority' => '1');
                    $this->email->initialize($config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('jogindar@gleamingllp.com', 'jjj');
                    //$this->email->from($website_setting['site_email'], $website_setting['site_name']);
                    
                    $this->email->to($to);
                    $this->email->cc('vijay@gleamingllp.com');              
                    $this->email->subject('New Invoice');
                    $this->email->attach($pdfFilePath);
                    $this->email->message($mailContent);
                    $this->email->send();

                    $this->session->set_userdata('user_id', $this->session->userdata('user_id'));
                    $this->session->set_userdata('email', $this->session->userdata('email'));
                    unlink($pdfFilePath);
                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>');
                      
                } catch(Exception $e) {
                    echo $e;
                }
                echo $mailContent;
                /*$config = array('mailtype' => 'html','charset'  => 'utf-8','priority' => '1');
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from($form, $this->site->site_name);
                $this->email->to($to);
                $this->email->cc('vijay@gleamingllp.com');              
                $this->email->subject($subject);
                $this->email->attach($pdfFilePath);
                $this->email->message($mailContent);
                $this->email->send();*/
             
            }
         
    }

}