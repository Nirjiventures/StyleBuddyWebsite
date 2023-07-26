<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>

<div class="main">
	<div class="container">
 		<div class="col-sm-12">
			<div class="rightbar">


				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h2>Completed Orders List</h2></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('vendor/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/managemyorders')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>
				<div class="table-responsive">
				<table class="table table-border table-striped mt-3">
					<thead>
						<tr>
							<th nowrap="nowrap">S.No</th>
							<th nowrap="nowrap">Order id</th>
							<th nowrap="nowrap">Thumb</th>
							<th nowrap="nowrap">Product</th>
							<th nowrap="nowrap">Qty</th>
							<th nowrap="nowrap">Price</th>
							<th nowrap="nowrap">Total</th>
							<th nowrap="nowrap">Pament Status</th>
							<th nowrap="nowrap">Order Status</th>
							<th nowrap="nowrap">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; if($order) { foreach($order as $list ) { ?>

							<tr>

								<td><?= $no; ?></td>
								<td>#<?= $list->orderId; ?></td>
								<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$list->productImg  ?>" class="min_pro"> </td>
								<td class="text-left"> <?= $list->productName ?></td>
								<td><?= $list->productQty ?> </td>
								<td><span style="text-decoration: line-through;"><?= $this->site->currency.' '.number_format($list->productMrpPrice) ?></span><?= $this->site->currency.' '.number_format($list->productPrice) ?></td>
								<td><?= $this->site->currency.' '.number_format($list->totalPrice) ?></td>
								<td><?= $list->payment_status ?> </td>
								<td><?= $list->order_status ?> </td>
								<td> <a href="<?= base_url('vendor/completedordersdetails/').$list->id; ?>" class="btn btn-success">View</a></td>
							</tr>

						   <?php $no++; } } ?>	
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
