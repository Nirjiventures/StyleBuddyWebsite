<?php $this->load->view('front/boutiques/header'); ?>
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
							<h2>Manage my Orders</h2></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				
				<div class="container">
				<div class="row align-items-center justify-content-center">


					<div class="col-sm-3">
						<div class="week_box">
							<a href="<?= base_url('boutiques/orders') ?>" style="text-decoration: none;"><b>Open Orders<br> List</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('boutiques/user-orders') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="week_box">
							<a href="<?= base_url('boutiques/completedorderslist') ?>" style="text-decoration: none;"><b>Completed <br>Orders List</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('boutiques/completedorderslist') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					 
					 

				</div>

			</div>

				


			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/boutiques/footer'); ?>
 