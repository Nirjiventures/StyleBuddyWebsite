<?php  $this->load->view('front/template/header'); ?>
<div class="banner_inner ab-banner_inner">
	<div class="container">
		<div class="text-center">
			<h3><?=$title?></h3>
		</div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
		 
		<?php 
            if ($order) {
                $option = '<div class="summery_order">
                        <hr/> 
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <p class="odds">
                                    <b>Order ID : '.$order->order_id.' | </b>
                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>
                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>
                                    Order Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->order_status .'</span>  |  
                                    Order Date : '. date('j F, Y',strtotime($order->created_at)) .'
                                </p>
                            </div>
                        </div>
                        <hr/>';
                        $cart_typeArray = array();
                        $option .= '<table class="table table-bordered table-striped text-center">';
                            $option .= '<tr>
                                <td></td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Discount</td>
                                <td>Qty</td>
                                <td>Subtotal</td>
                            </tr>';
                            $total = 0; 
                            $discountTotal = 0;
                             
                            foreach($orderDetails as $list) { 
                                if (!in_array($list->cart_type, $cart_typeArray)) {
                                    array_push($cart_typeArray, $list->cart_type);
                                }
                                $total += $list->totalMrpPrice;
                                $discountTotal += $list->totalDiscount;

                                $option .= '<tr>';
                                    $img1 = 'assets/images/product/'.$list->productImg;
                                    if ($list->cart_type == 'service') {
                                        $img1 = $list->productImg;
                                    }
                                    $img =  'assets/images/no-image.jpg'; 
                                    if(!empty($img1))  { 
                                        if (file_exists($img1)) {
                                                $img = $img1;
                                        }
                                    }


                                    $option .= '<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="'.base_url($img) .'" class="min_pro" width="100px"> </td>';

                                    $option .= '<td class="text-left">'. $list->productName .'</td>';
                                    $option .= '<td>';
                                        if ($list->productMrpPrice > $list->productPrice) {
                                            $option .= ' <span style="text-decoration: line-through;">'. $this->site->currency.' '.numberformat($list->productMrpPrice) .'</span>&nbsp;&nbsp;'.$this->site->currency.' '.numberformat($list->productPrice);
                                        }else{
                                            $option .= $this->site->currency.' '.numberformat($list->productPrice);
                                        }
                                    
                                    $option .= '</td>';
                                
                                $option .= '<td class="text-left">'. $list->discount .'</td>
                                    <td>'. $list->productQty .' </td>
                                    <td>'.  $this->site->currency.' '.numberformat($list->productPrice*$list->productQty) .'</td>
                                </tr>';
                            }  
                            $option .= '<tr>
                                <td colspan="4" class="text-right"></td>
                                <td class="text-right"><b> Total</b></td>
                                <td> <b>'. $this->site->currency.' '.numberformat($total) .'</b></td>
                            </tr>';
                            $option .= '<tr>
                                <td colspan="4" class="text-right"></td>
                                <td class="text-right"><b>Discount</b></td>
                                <td> <b>- '. $this->site->currency.' '.numberformat($discountTotal) .'</b></td>
                            </tr>';
                             if ($order->coupon_value) {
                                $option .= '<tr>';
                                    $option .= '<td colspan="4" class="text-right"></td>';
                                    if($order->coupon_type == 'coupon'){
                                        $option .= '<td class="text-right"><b>Coupon Code Discount('.$order->coupon_code.')</b></td>';
                                    }else{ 
                                        $option .= '<td class="text-right"><b>Gift Code Discount('.$order->coupon_code.')</b></td>';
                                    }
                                    $option .= '<td> <b>- '. $this->site->currency.' '.numberformat($order->coupon_value) .'</b></td>';
                                $option .= '</tr>';
                            }
                            $option .= '<tr>
                                <td colspan="4" class="text-right"></td>
                                <td class="text-right"><b> Subtotal</b></td>
                                <td> <b>'. $this->site->currency.' '.numberformat($order->total_price) .'</b></td>
                            </tr>';
                        $option .= '</table>';
                    if(in_array('product',$cart_typeArray)){
                        $option .= '<div class="pp_profile">';
                            $option .= '<div class="row">';
                                $option .= '<div class="col-sm-6">
                                        <h3 class="uk_title">Shipping Address</h3>
                                        <p>'. $order->address .'</p>
                                        <p>Pin - '. $order->pincode .'</p>
                                        <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>
                                        <p>Email : '. $order->user_email .'</p>
                                        <p>Mobile : '. $order->mobile .'</p>';
                                $option .= '</div>';
                            $option .= '</div>';
                        $option .= '</div>';
                    }
                $option .= '</div>';
                echo $option;
            }else{
                echo $message;
            }
		?>
        <div class="text-center">
            <a href="<?=base_url()?>" class="action_bt_2">Back To Home</a>
        </div>
	</div>
</div>
<?php $this->load->view('front/template/footer'); ?>