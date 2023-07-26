<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="row m-0">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->


		<div class="col-sm-9">
			<div class="rightbar">
				<div class="row m-0 ">
					<div class="col-sm-8 text-start"><h2>Order Details</h2></div>
				
					<div class="col-sm-4 text-end">
						<b>Change Status</b>
						<select class="chhs">
							<option>Approved</option>
							<option>Pending</option>
							<option>Processing</option>
							<option>On Hold</option>
							<option>Delivered</option>
						</select>
					</div>
				</div>
				
				<hr>
				
				<div class="summery_order">
							<div class="row align-items-center">
								<div class="col-sm-9">
									<p class="odds"><b>Order ID : 0582 | </b>Status: <span class="approved">Approved</span>  |  Order Date : 03-May-22</p>
								</div>
								
								<div class="col-sm-3 text-center">
									<a href="orders.php" class="back_orders"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a>
								</div>
							</div>
							
							<hr>
							
								<table class="table table-bordered table-striped text-center">
									<tr>
										<td></td>
										<td>Product Name</td>
										<td>Unit Price</td>
										<td>Qty</td>
										<td>Subtotal</td>
									</tr>
									
									<tr>
										<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/vandor/images/t4.jpg" class="min_pro"> </td>
										<td> Running Shoes</td>
										<td> $ 5</td>
										<td> 1</td>
										<td> $ 5</td>
									</tr>
									
									<tr>
										<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/vandor/images/t6.jpg" class="min_pro"> </td>
										<td> Running Shoes</td>
										<td> $ 5</td>
										<td> 2</td>
										<td> $ 10</td>
									</tr>
									
									<tr>
										<td colspan="4" class="text-right"> Total</td>
										<td> $ 15</td>
									</tr>
									<tr>
										<td colspan="4" class="text-right"> Tax</td>
										<td> $ 5</td>
									</tr>
									
									<tr>
										<td colspan="4" class="text-right"><b> Subtotal</b></td>
										<td> <b>$ 20</b></td>
									</tr>
									
								</table>
			
								<div class="pp_profile">
									<div class="row">
										<div class="col-sm-6">
											<h3 class="uk_title">Billing Address</h3>
											<p>B14/15 Noida Sector - 1</p>
											<p>Pin - 201301</p>
											<p>Uttar Pradesh - India</p>
											<p>Email : info@gmail.com</p>
											<p>Mobile : 9876543210</p>
											
										</div>
										
										<div class="col-sm-6">
											<h3 class="uk_title">Shipping Address</h3>
											<p>B14/15 Noida Sector - 1</p>
											<p>Pin - 201301</p>
											<p>Uttar Pradesh - India</p>
											<p>Email : info@gmail.com</p>
											<p>Mobile : 9876543210</p>
										</div>
										
									</div>
								</div>
								
						
						
			
					</div>
			
						
				<div class="col-sm-12">
					<input type="submit" value="Update"  class="sub">
				</div>						
				
				
			</div>
		</div>
	</div>
</div>


</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>