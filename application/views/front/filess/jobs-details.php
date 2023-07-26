<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3><?= $datas->jobTitle ?></h3></div>
	</div>
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container">
	
		<div class="col-sm-12 text-center mb-5"><h2><?= $datas->jobTitle ?></h2></div>
	
		<div class="jobs_list">
			<div class="row m-0">
				<div class="col-sm-12">
					<div class="jobs pt-4">
						<h3><?= $datas->jobTitle ?></h3>
						<p class="mb-2"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $datas->location ?></p>
						<p><i class="fas fa-calendar-alt"></i> Date : <?= date('j F, Y',strtotime($datas->created_at)); ?> </p> 
						<hr>
					        <?= $datas->longDesc ?>
						<hr>
						
						<p>Send your CV and protfolio to : <a href="mailto:jyoti@stylebuddy.in">jyoti@stylebuddy.in</a></p>
						
						<hr>
					</div>
				</div>
				
				<div class="col-sm-12">
					<a href="mailto:jyoti@stylebuddy.in" class="btn btn-success">Apply Now <i class="fas fa-arrow-alt-circle-right"></i></a>
				</div>
				
			</div>
		</div>
		
		
		
	
	</div>
	
</div>

<?php $this->load->view('Page/template/footer'); ?>