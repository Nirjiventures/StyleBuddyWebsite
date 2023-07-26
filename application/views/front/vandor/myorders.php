<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>

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
							<h3>Open Orders List</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
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
						<th class="no">No</th>
						<th class="no">Order ID</th>
						<th class="name">Name</th>
						<th class="date">Date</th>
						<th class="status">Transaction  ID</th>
						<th class="status">Payment Type</th>
						<th class="total">Total  Amount</th>
						<th class="action">Status</th>
						<th nowrap="nowrap">Action</th>
					</tr>
					</thead>
					<?php $no = 1; if($order) { foreach($order as $value ) { 
						$date = strtotime($value->created_at); $fdate = date('d M, Y',$date);
					?>
					<tr>
						<td><?= $no ?></td>

					   <td><?= $value->order_id ?></td>

						<td><?= ucfirst($value->fname.' '.$value->lname);  ?></td>

						<td><?= $fdate ?></td>

						

						<td><?= $value->order_id ?></td>

						<td class="hold"><?= $value->pay_type ?></td>

						<td> &#8377; <?= number_format($value->total_price) ?></td>

						<td><?= $value->order_status ?></td>
						<td> <a href="<?= base_url($seg1.'/user-orders/').$value->id; ?>" class="btn btn-success">View</a></td>
					</tr>
				   <?php $no++; } } ?>	
				
				</table>
				</div>
				
			</div>
		</div>
	</div>
</div>


</body>
</html>
