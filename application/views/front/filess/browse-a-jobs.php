<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>

<?php $url4 = $this->uri->segment(4);?>
<?php  $this->load->view('Page/template/header'); ?>


<section class="job-browse section">
	<div class="container text-center browse-head">
		<h1>Browse Jobs</h1>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', '/');
			$this->breadcrumb->add('Browse Jobs', '/page/browsejobs');
	    ?>
	 
		<?php echo $this->breadcrumb->output(); ?>
	</div>
    <div class="container">
        <div class="row">
        	<?php if ($city) { ?>
	        	<div class="col-lg-3 col-md-3 col-xs-12">
	 				<div class="mbl">
		 				<div class="row mbl-fliter">
		 					<div class="col-6 col-sm-6">
		 						<a href="" class="fil-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-sliders" aria-hidden="true"></i> Categories</a>
		 					</div>
		 					<div class="col-6 col-sm-6 text-end">
		 						<a href="" class="fil-btn" data-bs-toggle="modal" data-bs-target="#myModal2"><i class="fa fa-sliders" aria-hidden="true"></i> Location</a>
		 					</div>
		 				</div>
	 				</div>

					<div class="side_filter">
						<form name="filterForm" id="filterForm">
						<p>CATEGORIES</p>
						<ul>
							<?php $abc= array('Permanent','Part-time','Freelancer','Internship','Temporary');?>
							<?php  foreach ($abc as $key => $value) { if($_GET['job_type'] && in_array($value, $_GET['job_type'])){$sel='checked';}else{$sel='';}?>
								<li><input type="checkbox" name="job_type[]" onclick="filterForm.submit()" <?=$sel?> value="<?=$value?>"><?=$value?></li>
							<?php   } ?>
							 
						</ul>
						<p>LOCATIONS</p>
						<ul class="height_fix">
							 
							<?php  foreach ($city as $key => $value) { if($_GET['city'] &&  in_array($value['city'], $_GET['city'])){$sel='checked';}else{$sel='';}?>
								<li><input type="checkbox" name="city[]" onclick="filterForm.submit()" <?=$sel?> value="<?=$value['city']?>"><?=$value['city']?></li>
							<?php   } ?>
						</ul>
						</form>
					</div>
				</div>
			    <div class="col-lg-9 col-md-9 col-xs-12">			
	                <?php if ($jobs) {  $num = $start_limit + 1 ;?>
						<?php foreach ($jobs as $key => $value) { ?>
						<a class="job-listings" href="<?= base_url('jobs/'.$value['slug']) ?>">
		                    <div class="row align-items-center">
		                        <div class="col-lg-12 col-md-12 col-xs-12">
			                        <div class="campany_name">
			                        	<h3><span> <?= $value['company']; ?></span></h3>
			                            <!-- <div class="job-company-logo">
			                            	

			                            	<?php //$img = base_url('assets/images/logo.png');if ($value['company_logo']) {$img = base_url('assets/vandor/images/'.$value['company_logo']);} ?>

			                                <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=$img?>" class="img-fluid" alt="">
			                            </div> -->
			                        </div>
		                        </div>
		                        <div class="col-lg-12 col-md-12 col-xs-12">
									<div class="job-details">
		                                <h3><?= $value['job_title']; ?> <span class="btn-full-time"><?= $value['job_type']; ?></span></h3>
		                                <div class="location"> 
											<?php if($value['city']){ ?> 
												<i class="fa fa-map-marker"></i> <?= $value['city']; ?> |
											<?php } ?>
											<?php if($value['qualification']){ ?> 
												<i class="fa fa-graduation-cap"></i> Qualification : <?= $value['qualification']; ?> | 
											<?php } ?>
											<?php if($value['experience']){ ?> 
												<i class="fa fa-suitcase"></i> Experience : <?= $value['experience']; ?>
											<?php } ?>
											<?php if($value['department']){ ?> 
												<i class="fa fa-building-o"></i> Department : <?= $value['department']; ?>
											<?php } ?>
										</div>
		                            </div>
									<p><?= substr(strip_tags($value['job_description']), 0,200).'...'; ?></p>
									<hr>
									<div class="row m-0">
										<div class="col-sm-3 p-0">
											<div class="apply_uk">
												<ul>

													<?php $job_apply_num_rows = $value['job_apply_num_rows'];?>
													<?php $job_apply = $value['job_apply'];?>
													<?php $nn = 3;?>
													<?php if ($job_apply_num_rows < $nn) { ?>
																<?php foreach ($job_apply as $k => $v) { ?>
																	<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url('assets/vandor/images/'.$v['job_apply_image']); ?>"></li>
																<?php }?>
													<?php }else{ $ppp = 0;?>
																<?php foreach ($job_apply as $k => $v) { ?>
																	<?php if ($ppp < $nn) { ?>
																		<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url('assets/vandor/images/'.$v['job_apply_image']); ?>"></li>
																	<?php }?>
																<?php $ppp++;}?>

															<li><?=$job_apply_num_rows?>+</li>
													<?php }?>

												</ul>
											</div>
										</div>
										<div class="col-sm-9 p-0 text-end">
											<span class="btn-apply">View Details</span>
										</div>
									</div>
								</div>
							</div>
		                </a>
						<?php } ?>
					<?php } else {  ?>
						<div class="row align-items-center">
					    <h3 class="text-center no-jobs"> No Jobs Available.</h3>
					</div>
					<?php  } ?>	
				</div>
				<div class="row m-0">
					<div class="col-sm-12 text-center">
				   		<div class="pagging-stylist ">
				   			<ul class="pagination justify-content-center ">
						   		<?php echo $p_links; ?>
						   	</ul>
				   		</div>
				   </div>
			   </div>
		   <?php }else{ ?>
		   		<h3 class="text-center no-jobs"> No Jobs Available.</h3>
		   <?php }?>
		</div>
    </div>
</section>

<!-- The Modal -->
				<div class="modal filter-popup" id="myModal">
				  <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">

				      <!-- Modal Header -->
				      <div class="modal-header">
				        <h4 class="modal-title">Select Categories</h4>
				        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				      </div>

				      <!-- Modal body -->
				      <div class="modal-body">
				      	<div class="mbllist_filter">
					        <form name="filterForm1" id="filterForm1">
								<ul>
									<?php $abc= array('Permanent','Part-time','Freelancer','Internship','Termporary');?>
									<?php  foreach ($abc as $key => $value) { if($_GET['job_type'] && in_array($value, $_GET['job_type'])){$sel='checked';}else{$sel='';}?>
										<li><input type="checkbox" name="job_type[]" onclick="filterForm1.submit()" <?=$sel?> value="<?=$value?>"><?=$value?></li>
									<?php   } ?>
								</ul>
								<a href="" class="popup_btn">Submit</a>
							</form>
						</div>
				      </div>

				    </div>
				  </div>
				</div>

				<div class="modal filter-popup" id="myModal2">
				  <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">

				      <!-- Modal Header -->
				      <div class="modal-header">
				        <h4 class="modal-title">Select Location</h4>
				        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				      </div>

				      <!-- Modal body -->
				      <div class="modal-body">
				        <div class="mbllist_filter">
					        <form name="filterForm2" id="filterForm2">
								<ul class="height_fix">
									<?php //$job_location= array('Delhi','Noida','Mumbai','Gurugram','Gujarat','Odisha','Maharashtra','Bhopal','Jaipur','Kolkata');?>
									<?php  foreach ($city as $key => $value) { if($_GET['city'] &&  in_array($value['city'], $_GET['city'])){$sel='checked';}else{$sel='';}?>
										<li><input type="checkbox" name="city[]" onclick="filterForm2.submit()" <?=$sel?> value="<?=$value['city']?>"><?=$value['city']?></li>
									<?php   } ?>
								</ul>
								<a href="" class="popup_btn">Submit</a>
							</form>
						</div>
				      </div>

				    </div>
				  </div>
				</div>

<?php $this->load->view('Page/template/footer'); ?>


