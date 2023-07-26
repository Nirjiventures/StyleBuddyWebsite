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
						<div class="col-sm-3">
							<h3>Edit Services</h3>
						</div>

						<div class="col-sm-6 text-center">
							<a href="<?=base_url('vendor/addownservice')?>" class="btn btn-primary add_pro"><i class="fa fa-plus" aria-hidden="true"></i> Add a New Service</a>
						</div>

						<div class="col-sm-3 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
				</div>

				<table class="table table-border table-striped mt-3">
					<tr class="skin">
						<td style="width:80px;">S.No</td>
						<td>Service Name</td>
						<td>Package Name</td>
						<td>Price</td>
						<td>Action</td>
					</tr>
					

					<tr>
						<td>1</td>
						<td>Wedding Styling </td>
						<td>Classic Package </td>
						<td>Rs.5000</td>
						<td> <a href="" class="btn btn-success">Edit</a></td>
					</tr>

					<tr>
						<td>2</td>
						<td>Wedding Styling </td>
						<td>Premium Package  </td>
						<td>Rs.25000</td>
						<td> <a href="" class="btn btn-success">Edit</a></td>
					</tr>

					<tr>
						<td>3</td>
						<td>Personal Styling </td>
						<td>Premium Package  </td>
						<td>Rs.15000</td>
						<td> <a href="" class="btn btn-success">Edit</a></td>
					</tr>
				   
				   

				</table>
				
				
			</div>
		</div>
	</div>
</div>


</body>
</html>
