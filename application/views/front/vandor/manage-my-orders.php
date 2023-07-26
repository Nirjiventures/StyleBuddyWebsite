<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		<!--<div class="col-sm-3 p-0 sdk">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
		</div>-->
		<div class="col-sm-12">
			<?php //$this->venderId = 10;?>
			<div class="rightbar">
				
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Manage my Orders</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				
				<div class="container">
				<div class="row align-items-center justify-content-center">


					<div class="col-sm-3 col-6">
						<div class="week_box">
							<a href="<?= base_url('stylist-zone/orders') ?>" style="text-decoration: none;"><b>Open Orders<br> List</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/user-orders') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					<div class="col-sm-3 col-6">
						<div class="week_box">
							<a href="<?= base_url('vendor/completedorderslist') ?>" style="text-decoration: none;"><b>Completed <br>Orders List</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/completedorderslist') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					<div class="col-sm-3 col-6">
						<div class="week_box">
							<a href="<?= base_url('vendor/myearnings') ?>" style="text-decoration: none;"><b>My <br>earnings</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/manage-video') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					<div class="col-sm-3 col-6">
						<div class="week_box">
							<a href="<?= base_url('vendor/mypayouts') ?>" style="text-decoration: none;"><b>My <br>payouts</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/manage-video') ?>" class="animate">More</a></p></div>
						</div>
					</div>

				</div>

			</div>

				


			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>


</body>
</html>
