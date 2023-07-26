<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		<div class="col-sm-12">
			<div class="rightbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Manage Videos</h3>
						</div>

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
					    <div class="col-sm-12"> 
	                        <?php if($this->session->flashdata('videoCountTotal_message')) {  ?>
	        					<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('videoCountTotal_message'); ?></div>
	        				<?php } ?>
	                    </div>
						<div class="col-sm-3 col-6">
							<div class="week_box">
								<a href="<?= base_url('stylist-zone/capture-video-add') ?>" style="text-decoration: none;"><b>Record a Video</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/capture-video-add') ?>" class="animate">More</a></p></div>
							</div>
						</div>

						<div class="col-sm-3 col-6">
							<div class="week_box">
								<a href="<?= base_url('stylist-zone/add-video') ?>" style="text-decoration: none;"><b>Upload a Video</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="<?= base_url('stylist-zone/add-video') ?>" class="animate">More</a></p></div>
							</div>
						</div>

						<div class="col-sm-3 col-6">
							<div class="week_box">
								<a href="<?= base_url('stylist-zone/manage-video') ?>" style="text-decoration: none;"><b>My Videos</b></a>
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
 