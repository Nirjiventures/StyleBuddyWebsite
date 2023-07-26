<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->

		<div class="col-sm-12">

			<div class="rightbar">

				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>ORDER DETAILS</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?= base_url('stylist-zone/user-orders/'); ?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

			

				<div class="summery_order">
					
					<div class="row align-items-center">
						<div class="col-sm-9">
							<p class="odds">
								<b>Order ID : <?= "#$order->id" ?> | </b>
								<b>Payment Status: <span class="approved"><?= $order->payment_status ?></span> | </b>
								Ordr Status: <span class="approved"><?= $order->order_status ?></span>  |  
								Order Date : <?= date('j F, Y',strtotime($order->created_at)) ?>
							</p>
						</div>
						
					</div>
					<hr/>
					<table class="table table-bordered table-striped text-center">

						<tr>

							<td></td>

							<td>Product Name</td>

							<td>Unit Price</td>

							<td>Qty</td>

							<td>Subtotal</td>

						</tr>

						

						<?php foreach($orderDetails as $list) { ?>

							<tr>

								<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$list->productImg  ?>" class="min_pro"> </td>

								<td class="text-left"> <?= $list->productName ?></td>

								<td><?= $this->site->currency.' '.number_format($list->productPrice) ?></td>

								<td><?= $list->productQty ?> </td>

								<td><?php echo  $this->site->currency.' '.number_format($list->productPrice*$list->productQty) ?></td>

							</tr>

						<?php } ?>
						<tr>

							<td colspan="4" class="text-right"><b> Subtotal</b></td>

							<td> <b><?= $this->site->currency.' '.number_format($order->total_price) ?></b></td>

						</tr>
					</table>
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
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>