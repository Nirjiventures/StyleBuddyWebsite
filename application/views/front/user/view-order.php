<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	 
	<div class="row m-0 justify-content-end">
		<div class="col-sm-3 p-0 black_bg">
			<div class="sidebar">
				<?php $this->load->view('front/user/siderbar'); ?>
			</div>
		</div>
		 
		<div class="col-sm-9">
			<div class="rightbar1">
				<div class="row align-items-center">
					<div class="col-sm-9">
						<h2>Order Details</h2>
					</div>
					<div class="col-sm-3 text-end">
						<a href="<?= base_url('user/user-orders/'); ?>" class="back_orders"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a>
					</div>
				</div>
				<div class="summery_order">
					<hr/> 
					<div class="row align-items-center">
						<div class="col-sm-12">
							<p class="odds">
								<b>Order ID : <?= "$order->order_id" ?> | </b>
								<b>Payment Status: <span class="approved"><?= $order->payment_status ?></span> | </b>
								Ordr Status: <span class="approved"><?= $order->order_status ?></span>  |  
								Order Date : <?= date('j F, Y',strtotime($order->created_at)) ?>
							</p>
						</div>
						
					</div>
					<hr/>
					<?php $cart_typeArray = array();?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped text-center">

							<thead>

								<td></td>

								<td  nowrap="nowrap">Product Name</td>

								<td nowrap="nowrap">Unit Price</td>

								<td nowrap="nowrap">Qty</td>

								<td nowrap="nowrap">Subtotal</td>

							</thead>

							

							<?php foreach($orderDetails as $list) { ?>
								<?php 
								if (!in_array($list->cart_type, $cart_typeArray)) {
									array_push($cart_typeArray, $list->cart_type);
								}
								$img = image_exist($list->productImg,'assets/images/product/'); 
	                            if ($list->cart_type == 'service') {
	                                $img = $list->productImg;
	                            }

								?>
								<tr>
									<td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="min_pro" style= "width:60px;height: 60px;" ></td>
									<td class="text-left"> <?= $list->productName ?></td>

									<td><?= $this->site->currency.' '.number_format($list->productPrice) ?></td>

									<td><?= $list->productQty ?> </td>

									<td><?php echo  $this->site->currency.' '.number_format($list->productPrice*$list->productQty) ?></td>

								</tr>

							<?php } ?>
							<?php if ($order->coupon_value) {?>
								<?php if ($order->bag_total_price * 100) {?>
									<tr>
										<td colspan="4" class="text-right"> Total</td>
										<td> &#8377; <?= number_format($order->bag_total_price)  ?></td>
									</tr>
								<?php }?>
	      						<tr>
									<td colspan="4" class="text-right"> Coupon Code(<?=$order->coupon_code?>)</td>
									<td> &#8377; - <?= number_format($order->coupon_value)  ?></td>
								</tr>
						
							<?php }?>
							<tr>

								<td colspan="4" class="text-right"><b> Subtotal</b></td>

								<td> <b><?= $this->site->currency.' '.number_format($order->total_price) ?></b></td>

							</tr>
						</table>
					</div>
					<?php  if(in_array('product',$cart_typeArray)){ ?>
						<div class="pp_profile">
							<div class="row">
								<div class="col-sm-6">
									<h3 class="uk_title">Shipping Address</h3>
									<p><?= $order->address ?></p>
									<p>Pin - <?= $order->pincode ?></p>
									<p><?= $order->city.', '.$order->state.' - '.$order->country ?></p>
									<p>Email : <?= $order->user_email ?></p>
									<p>Mobile : <?= $order->mobile ?></p>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	 
</div><?php $this->load->view('front/template/footer'); ?>