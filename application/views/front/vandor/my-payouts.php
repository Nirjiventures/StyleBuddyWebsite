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
							<h3>My Payouts</h3></div>

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
						<td style="width:80px;">S.No</td>
						<td nowrap="nowrap">Order ID</td>
						<td nowrap="nowrap">Customer Name</td>
						<td nowrap="nowrap">City</td>
						<td nowrap="nowrap">Service Type </td>
						<td nowrap="nowrap">Total price</td>
						<td nowrap="nowrap">Amount received</td>
						<td nowrap="nowrap">Date of receipt</td>
						<td nowrap="nowrap">Action</td>
					</thead>
					

					<!--<tr>
						<td>1</td>
						<td>#SB0001</td>
						<td>Maddy</td>
						<td>Noida</td>
						<td>Wedding Styling</td>
						<td>INR- 25487</td>
						<td>INR- 25000</td>
						<td>29-Jul-2022</td>
						<td> <a href="<?= base_url($seg1.'/user-orders/').$list->id; ?>" class="btn btn-success">View</a></td>
					</tr>
				   
				   <tr>
						<td>1</td>
						<td>#SB0001</td>
						<td>Maddy</td>
						<td>Noida</td>
						<td>Wedding Styling</td>
						<td>INR- 25487</td>
						<td>INR- 25000</td>
						<td>29-Jul-2022</td>
						<td> <a href="<?= base_url($seg1.'/user-orders/').$list->id; ?>" class="btn btn-success">View</a></td>
					</tr>-->	
				</table>
				
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
