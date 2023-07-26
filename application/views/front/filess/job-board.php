<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>JOB BOARD</h3></div>
	</div>
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	<div class="container">		
		<div class="row mb-4">
			<div class="col-sm-12 text-center">
				<h2>Available Positions</h2>
			</div>
		</div>
		<div class="row">
		    <?php if($datas) foreach($datas as $list) { ?>
			<div class="col-sm-12">
				<div class="d-flex job_list">
				    <div class="flex-shrink-0">
				       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/job-user.png" class="mr-3 rounded-circle img-thumbnail" width="90px">
				    </div>
				    <div class="flex-grow-1 ms-3">
				        <div class="name_title"><?= $list->jobTitle ?></div>
				        <div class="dp mb-1">Department : <span><?= $list->department ?></span></div>
				        <p class="mb-1"><small><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $list->location ?></small></p>
				        <p class="mb-2"><?= $list->shortDesc ?></p>
				        <!--<span class="badge bg-soft-success fs-13 mt-1 mx-1">Full Time</span> -->
				        <!--<span class="badge bg-soft-success fs-13 mt-1 mx-1">Negotiable</span> -->
				        <a class="ap_btn" href="<?= base_url('job-board/').$list->jobSlug ; ?>">Job Description</a>
				    </div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>



<?php $this->load->view('Page/template/footer'); ?>