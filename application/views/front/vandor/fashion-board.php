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
							<h3>Manage my Fashion Board</h3></div>

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
							<a href="<?= base_url('stylist-zone/add-style-stories') ?>" style="text-decoration: none;"><b>Write on the<br> Board</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/add-style-stories') ?>" class="animate">More</a></p></div>
						</div>
					</div>

					<div class="col-sm-3 col-6">
						<div class="week_box">
							<a href="<?= base_url('stylist-zone/manage-style-stories') ?>" style="text-decoration: none;"><b>Manage my <br>content</b></a>
							<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/manage-style-stories') ?>" class="animate">More</a></p></div>
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
