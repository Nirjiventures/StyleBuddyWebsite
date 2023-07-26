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
							<h2>Open Orders List</h2></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('boutiques/managemyorders')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				<table class="table table-border table-striped mt-3">
					<tr class="skin">
						<td style="width:80px;">S.No</td>
						<td>Order ID</td>
						<td>Customer Name</td>
						<td>City</td>
						<td>Service Type </td>
						<td>Confirm order</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
					<?php $no = 1; if($order) { foreach($order as $list ) { ?>
					<tr>
						<td><?= $no; ?></td>
						<td>#<?= $list->id; ?></td>
						<td>Maddy</td>
						<td>Noida</td>
						<td>Wedding Styling</td>
						<td class="text-warning"><?= $list->order_status; ?></td>
						<td>
						<select class="all_odc">
							<option>View Order Form</option>
							<option>Schedule client interview</option>
							<option>Generate Pricing</option>
							<option>Confirm Payment</option>
							<option>Prepare Draft Report</option>
							<option>Send Draft Report to client</option>
							<option>Schedule client discussion</option>
							<option>Prepare Final Report</option>
							<option>Send Final Report</option>
							<option>Order Closed</option>
						</select>
						</td>
						<td> <a href="<?= base_url($seg1.'/user-orders/').$list->id; ?>" class="btn btn-success">View</a></td>
					</tr>
				   <?php $no++; } } ?>	
				
				</table>
				
				
			</div>
		</div>
	</div>
</div>


</body>
</html>
