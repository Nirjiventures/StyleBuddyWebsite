<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_Model extends MY_Model {
    function __construct() {
        parent::__construct();
    }

    public $table = "orders";
    public $primary_key = "id";

    public function pdf_payment_response($postData,$website_setting=''){
        $content_part = '';
        if($website_setting){
            //$content_part .= mailHtmlHeader($website_setting);
        }
        $tot = 0;
        $content_part .= $this->order_address($postData);
        $content_part .='<div class="clearfix"></div>';
        $content_part .='<div style=" border: 1px solid #dfc5b1;clear:both">';
             
            
            $record_detail =   $postData['orderRow'];
            $fullName = ($record_detail['ship_first_name']).' ' .($record_detail['ship_last_name']);
            $content_part .='<div class="clearfix"></div>';
            $content_part .='<div class="col-sm-12 m20">';
                $content_part .='<div class="table-responsive">';
                    $content_part .= '<table class="table table-bordered table-striped">';
                                $content_part .= '<thead>';
                                    $content_part .= '<tr class="table-head-row">';
                                        $content_part .= '<th class="text-left white">Thumb</th>';
                                        $content_part .= '<th class="text-left white">Product</th>';
                                        $content_part .= '<th class="text-right white">Qty</th>';
                                        $content_part .= '<th class="text-right white">Mrp Price</th>';
                                        $content_part .= '<th class="text-right white">Discount</th>';
                                        $content_part .= '<th class="text-right white">Price</th>';
                                        $content_part .= '<th class="text-right white">Sub Total</th>';
                                    $content_part .= '</tr>';
                                $content_part .= '</thead>';
                                $content_part .= '<tbody>';
                                    foreach($postData['orderDetail'] as $record_detail){ 
                                        $currency = $record_detail['currencyIcon'];
                                        $pUrl = base_url('product-detail/'.$record_detail['product_slug']);
                                        $imgU = $record_detail['product_thumb'];

                                        $content_part .='<tr>';
                                            $content_part .='<td class="">';
                                                $content_part .= '<a target="_blank" href="'.$pUrl.'">';
                                                    $content_part .= '<img src="'.$imgU.'" alt="Thumb Image" style="width: 80px;">';
                                                $content_part .= '</a>';
                                            $content_part .= '</td>';
                                            $content_part .='<td class="">'.$record_detail['product_name'].'</td>';
                                            $content_part .='<td class="text-right">'.$record_detail['quantity'].'</td>';
                                            $content_part .= '<td class="text-right">'.$record_detail['display_mrp_price'].' '.$currency.' </td>';
                                            $content_part .= '<td class="text-right">';
                                            if ($record_detail['display_discount'] * 100) {
                                                $content_part .= $record_detail['display_discount'].' '.$currency.'';
                                            }else{
                                                $content_part .= '-';
                                            }
                                            $content_part .= '</td>';
                                            $content_part .='<td class="text-right">'.$record_detail['display_price'].' '.$currency.'</td>';
                                            $content_part .='<td class="text-right"><span>'.$record_detail['display_mrp_price_total'].' '.$currency.'</span></td>';
                                        $content_part .='</tr>';

                                         
                                    }
                                $content_part .='</tbody>';
                                $content_part .='</tfoot>';
                                    $content_part .='<tr>';
                                        $content_part .='<th class="" colspan="5"></th>';
                                        $content_part .='<th class="text-right">Sub Total</th>';
                                        $content_part .='<th class="text-right">'.$postData['orderRow']['display_total_order_price'].' '.$currency.'</th>';
                                    $content_part .='</tr>';
                                    if($postData['orderRow']['display_total_discount'] * 100){
                                        $content_part .='<tr>';
                                            $content_part .='<th class="" colspan="5"></th>';
                                            $content_part .='<th class="text-right">Total Discount</th>';
                                            $content_part .='<th class="text-right">-'.$postData['orderRow']['display_total_discount'].' '.$currency.'</th>';
                                        $content_part .='</tr>';
                                    }
                                    if($postData['orderRow']['coupon_price'] * 100){
                                        if($postData['orderRow']['is_percentage'] == 1){$is = '%';}else{$is='';}
                                        $content_part .='<tr>';
                                            $content_part .='<th class="" colspan="4"></th>';
                                            $content_part .='<th class="text-right" colspan="2">Couppon Code('.$postData['orderRow']['coupon_code'].') '.$postData['orderRow']['coupon_value'].$is.'</th>';
                                            $content_part .='<th class="text-right">-'.$postData['orderRow']['coupon_price'].' '.$currency.'</th>';
                                        $content_part .='</tr>';
                                    }
                                    

                                    $content_part .='<tr>';
                                        $content_part .='<th class="" colspan="5"></th>';
                                        $content_part .='<th class="text-right">Total</th>';
                                        $content_part .='<th class="text-right">'.$postData['orderRow']['total_order_price'].' '.$currency.'</th>';
                                    $content_part .='</tr>';
                                $content_part .='</tfoot>';
                    $content_part .='</table>';
                $content_part .='</div>';
            $content_part .='</div>';
            $content_part .='<div class="clearfix"></div>';
             
            $content_part .='<div class="clearfix"></div>';
        $content_part .='</div>';
        $content_part .='<div class="clearfix"></div>';
        if($website_setting){
            //$content_part .= mailHtmlFooter($website_setting);
        }
        return $content_part;
    }
    public function order_address($postData){
         
        $content_part='';
        $content_part .='<style>
                .col-sm-12 {
                    width: 100%;
                }
                .col-sm-3 {
                    width: 25%;
                    position: relative;
                    min-height: 1px;
                    float: left;
                }
                .col-sm-6 {
                    width: 50%;
                    position: relative;
                    min-height: 1px;
                    float: left;
                }
                .clearfix::after {
                    display: block;
                    clear: both;
                    content: "";
                }
                .customer_det {
                    padding: 16px;
                }
                .table {
                    width: 100%;
                    max-width: 100%;
                    margin-bottom: 20px;
                    letter-spacing: 0.5px; 
                    font-size:14px;
                    border-collapse: collapse;
                }
                .table-bordered {
                    border: 1px solid #ddd;
                }
                .table-bordered td, .table-bordered th {
                  border: 1px solid #dee2e6;
                }
                .table-head-row {
                    background: #333;
                    padding: 12px;
                    font-weight: bold;
                    letter-spacing: 1px;
                    color: white!important;
                }
                .table>thead>tr>th, .table>thead>tr>td{
                    color:white!important;
                }
                .table>thead>tr>th, .table>thead>tr>td ,.table>tbody>tr>th, .table>tbody>tr>td, .table>tfoot>tr>th, .table>tfoot>tr>td{
                    padding: 4px;
                }
                .text-right{text-align:right;}
                .text-left{text-align:left}
                .text-center{text-align:center}

                .padd{padding:0px!important;}
                .header-section{margin-bottom:50px;background: #dfc5b1 !important;margin-bottom: 20px;padding:12px; clear: both;  overflow: auto;}
                ..logo-invoice{float:right; 
                    background:white; 
                    pading:10px; 
                    width:100px; 
                    margin-right:120px;
                }
                .footer{
                    clear: both;
                    border-top: 4px solid #dfc5b1;
                    margin: auto;
                    display: block;
                    margin-top:10px;
                }
                .white{
                    color:white;
                }
                .m-8{
                    margin: 8px!important;
                }
                </style>';
         

        $tot = 0;
        $content_part .='<div class="clearfix"></div>';
        $content_part .='<div style=" border: 1px solid #dfc5b1;clear:both">';
            $record_detail =   $postData['orderRow'];
            $fullName = ($record_detail['ship_first_name']).' ' .($record_detail['ship_last_name']);
            $content_part .='<div class="col-sm-12">';
                $content_part .='<div class="row">';
                    $content_part .='<div class="col-sm-6 col-12">';
                        $content_part .='<div class="customer_det">';
                            $content_part .='<div><i class="fa fa-user"></i><b> Customer Details</b></div>';
                            $content_part .='<hr/>';
                            $content_part .='<div class="form-group boot_sp">';
                                $content_part .='<p>';
                                    $content_part .='<strong>Name: </strong>' .$fullName.'<br>
                                    <strong>Address: </strong>' .($record_detail['ship_address']).'<br>
                                    <strong>City: </strong>' .($record_detail['ship_city']).' <br>
                                    <strong>State: </strong>' .($record_detail['ship_state']).'<br>
                                    <strong>Country: </strong>' .($record_detail['ship_country']).'<br>
                                    <strong>Phone: </strong>' .($record_detail['ship_phone']).'<br/>';
                                $content_part .='</p>';
                            $content_part .='</div>';
                        $content_part .='</div>';
                    $content_part .='</div>';
                    $currency = $record_detail['currencyIcon'];
                    $content_part .='<div class="col-sm-6 col-12">';
                        $content_part .='<div class="customer_det">';
                            $content_part .='<div><i class="fa fa-shopping-cart"></i><strong> Order Details</strong></div>';
                            $content_part .='<hr/>';
                            $content_part .='<div class="form-group boot_sp">';
                                $content_part .='<p>';
                                    $content_part .='<strong>Order Number:</strong> ' .($record_detail['order_invoice_no']). '<br>
                                                <strong> Order Date:</strong> ' .($record_detail['date_order_placed']). '<br> 
                                                <strong> Order Status:</strong> ' .($record_detail['order_status']). '<br> 
                                                <strong> Payment Status:</strong> ' .($record_detail['payment_status']). '<br>
                                                <strong> Payment Mode:</strong> ' .($record_detail['payment_mode_name']). '<br>
                                                <strong>Total Order Price:</strong> ' .($record_detail['total_order_price']). ' ' .($currency). '<br/>';
                                $content_part .='</p>';
                            $content_part .='</div>';
                        $content_part .='</div>';
                    $content_part .='</div>';
                $content_part .='</div>';
            $content_part .='</div>';

        $content_part .='</div>';
        $content_part .='<div class="clearfix"></div>';
        return $content_part;
    } 
    public function order_product_detail($postData,$website_setting=''){
        $content_part='';
        $tot = 0;
        $content_part .='<div class="clearfix"></div>';
        $content_part .='<div  style=" border: 1px solid #dfc5b1;clear:both">';
            $record_detail =   $postData['orderRow'];
            $content_part .='<div class="clearfix"></div>';
            $content_part .='<div class="col-sm-12 m20">';
                $content_part .='<div class="table-responsive">';
                    $content_part .= '<table class="table table-bordered table-striped">';
                                $content_part .= '<thead>';
                                    $content_part .= '<tr class="table-head-row">';
                                        $content_part .= '<th class="text-left white">Thumb</th>';
                                        $content_part .= '<th class="text-left white">Product</th>';
                                        $content_part .= '<th class="text-right white">Qty</th>';
                                        $content_part .= '<th class="text-right white">Mrp Price</th>';
                                        $content_part .= '<th class="text-right white">Discount</th>';
                                        $content_part .= '<th class="text-right white">Price</th>';
                                        $content_part .= '<th class="text-right white">Sub Total</th>';
                                    $content_part .= '</tr>';
                                $content_part .= '</thead>';
                                $content_part .= '<tbody>';
                                    foreach($postData['orderDetail'] as $record_detail){ 
                                        $pUrl = base_url('product-detail/'.$record_detail['product_slug']);
                                        $imgU = $record_detail['product_thumb'];
                                        $currency = $record_detail['currencyIcon'];
                                        
                                        $content_part .='<tr>';
                                            $content_part .='<td class="">';
                                                $content_part .= '<a target="_blank" href="'.$pUrl.'">';
                                                    $content_part .= '<img src="'.$imgU.'" alt="Thumb Image" style="width: 80px;">';
                                                $content_part .= '</a>';
                                            $content_part .= '</td>';
                                            $content_part .='<td class="">'.$record_detail['product_name'].'</td>';
                                            $content_part .='<td class="text-right">'.$record_detail['quantity'].'</td>';
                                            $content_part .= '<td class="text-right">'.$record_detail['display_mrp_price'].' '.$currency.' </td>';
                                            $content_part .= '<td class="text-right">';
                                            if ($record_detail['display_discount'] * 100) {
                                                $content_part .= $record_detail['display_discount'].' '.$currency.'';
                                            }else{
                                                $content_part .= '-';
                                            }
                                            $content_part .= '</td>';
                                            $content_part .='<td class="text-right">'.$record_detail['display_price'].' '.$currency.'</td>';
                                            $content_part .='<td class="text-right"><span>'.$record_detail['display_mrp_price_total'].' '.$currency.'</span></td>';
                                            //$content_part .='<td class="text-right"><span  style="text-decoration: line-through;">'.$record_detail['display_mrp_price_total'].' '.$currency.'</span> '.$record_detail['display_total'].' '.$currency.'</td>';
                                        $content_part .='</tr>';

                                         
                                    }
                                $content_part .='</tbody>';
                                $content_part .='</tfoot>';
                                    $content_part .='<tr>';
                                        $content_part .='<th class="" colspan="5"></th>';
                                        $content_part .='<th class="text-right">Sub Total</th>';
                                        $content_part .='<th class="text-right">'.$postData['orderRow']['display_total_order_price'].' '.$currency.'</th>';
                                    $content_part .='</tr>';
                                    if($postData['orderRow']['display_total_discount'] * 100){
                                        $content_part .='<tr>';
                                            $content_part .='<th class="" colspan="5"></th>';
                                            $content_part .='<th class="text-right">Total Discount</th>';
                                            $content_part .='<th class="text-right">-'.$postData['orderRow']['display_total_discount'].' '.$currency.'</th>';
                                        $content_part .='</tr>';
                                    }
                                    if($postData['orderRow']['coupon_price'] * 100){
                                        if($postData['orderRow']['is_percentage'] == 1){$is = '%';}else{$is='';}
                                        $content_part .='<tr>';
                                            $content_part .='<th class="" colspan="4"></th>';
                                            $content_part .='<th class="text-right" colspan="2">Couppon Code('.$postData['orderRow']['coupon_code'].') '.$postData['orderRow']['coupon_value'].$is.'</th>';
                                            $content_part .='<th class="text-right">-'.$postData['orderRow']['coupon_price'].' '.$currency.'</th>';
                                        $content_part .='</tr>';
                                    }
                                    

                                    $content_part .='<tr>';
                                        $content_part .='<th class="" colspan="5"></th>';
                                        $content_part .='<th class="text-right">Total</th>';
                                        $content_part .='<th class="text-right">'.$postData['orderRow']['total_order_price'].' '.$currency.'</th>';
                                    $content_part .='</tr>';
                                $content_part .='</tfoot>';
                    $content_part .='</table>';
                $content_part .='</div>';
            $content_part .='</div>';
            $content_part .='<div class="clearfix"></div>';
            $content_part .='<div class="clearfix"></div>';
        $content_part .='</div>';
        $content_part .='<div class="clearfix"></div>';
        return $content_part;
    }  
    
}    