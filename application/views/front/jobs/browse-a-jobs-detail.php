<?php  $this->load->view('front/template/header'); ?>
 

<div class="banner_inner">
	<div class="container">
		<h1><?= $jobRow['job_title']; ?></h1>
		<?php 
				$this->breadcrumb = new Breadcrumbcomponent();
				$this->breadcrumb->add('Home', '/');
				$this->breadcrumb->add('Browse Jobs', base_url('page/browsejobs'));
				$this->breadcrumb->add($jobRow['job_title'], base_url('page/browsejobs'));
    	?>
    	<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>


<section class="job-browse section">
  <div class="container">
      
 
	
      <div class="row justify-content-center  mt-5">
          
          <div class="col-lg-8 col-md-8 col-xs-12">
					    <div class="job-listings my_full_job">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12">
                      		<div class="campany_name"><h3><span> <?= $jobRow['company']; ?></span></h3>

                           
                      </div>
                    </div>
                      <div class="col-lg-12 col-md-12 col-xs-12">
												<div class="job-details">
                              <h3><?= $jobRow['job_title']; ?> <span class="action_bt_2 fontfamily "><?= $jobRow['job_type']; ?></span></h3>
                              <div class="location"> 
                              	<?php if($jobRow['city']){ ?> 
																	<i class="fa fa-map-marker"></i> <?= $jobRow['city']; ?> | 
																<?php } ?>
																<?php if($jobRow['qualification']){ ?> 
																	<i class="fa fa-graduation-cap"></i> Qualification : <?= $jobRow['qualification']; ?> | 
																<?php } ?>
																<?php if($jobRow['experience']){ ?> 
																	<i class="fa fa-suitcase"></i> Experience : <?= $jobRow['experience']; ?>
																<?php } ?>
																<?php if($jobRow['department']){ ?> 
																	<i class="fa fa-building-o"></i> Department : <?= $jobRow['department']; ?>
																<?php } ?>
																<!-- <?php if($jobRow['job_frequency']){ ?> 
																	<i class="fa fa-building-o"></i> Job Frequency : <?= $jobRow['job_frequency']; ?>
																<?php } ?>
																<?php if($jobRow['package']){ ?> 
																	<i class="fa fa-building-o"></i> Package : <?= $jobRow['package']; ?>
																<?php } ?> -->
								
															</div>
                          </div>
						<hr>

						<div class="post_tt"><p>Posted:
						        <?php
						            $now = time(); // or your date as well
                        $your_date = strtotime($jobRow['created_at']);
                        $datediff = $now - $your_date;
                        
                        echo round($datediff / (60 * 60 * 24));
						        
						        ?>
								  days ago <span>Job Views: <b><?= $jobRow['count_view']; ?></b> | Job Applicants: <b><?= $jobRow['total_applicant']; ?></b></span></p>
						</div>
						
						<div class="share_icon pb-3">
								Share : &nbsp;&nbsp; 
								<div class="soical_m">
										<a  onclick="shareCount(<?=$jobRow['id']?>,'heartIconT')" class="twitter-share-button" target="_blank" rel="noopener noreferrer" href="https://twitter.com/intent/tweet?url=<?=base_url()?>page/browsejobdetail/<?=$jobRow['slug']?>"><i class="fab fa-twitter"></i></a>

										<a class="facebook-share-button" target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>page/browsejobdetail/<?=$jobRow['slug']?>"><i class="fab fa-facebook-f"></i></a>
								</div>
						</div>
						<br/>
						<?= $jobRow['job_description']; ?>
						<div class="row m-0">
														<div class="col-sm-3 p-0">
															<div class="apply_uk">
																<ul>
																	<?php $nn = 3;?>
																	<?php if ($job_apply_num_rows < $nn) { ?>
																				<?php foreach ($job_apply as $key => $v) { ?>
																					<?php $img =  'assets/images/no-image.jpg';?>
																					<?php if(!empty($v['job_apply_image']))  {?>
																				   		<?php 
																				   			$img1 =  'assets/images/vandor/'.$v['job_apply_image']; 
																				   			if (file_exists($img1)) {
																				   				$img = $img1;
																				   			}
																				   		?>
																				   	<?php } ?>
																					<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url($img); ?>" class="img-fluid"></li>

																					 
																				<?php }?>
																	<?php }else{ $ppp = 0;?>
																				<?php foreach ($job_apply as $key => $v) { ?>
																					<?php if ($ppp < $nn) { ?>
																						<?php $img =  'assets/images/no-image.jpg';?>
																						<?php if(!empty($v['job_apply_image']))  {?>
																					   		<?php 
																					   			$img1 =  'assets/images/vandor/'.$v['job_apply_image']; 
																					   			if (file_exists($img1)) {
																					   				$img = $img1;
																					   			}
																					   		?>
																					   	<?php } ?>
																						<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url($img); ?>" class="img-fluid"></li>
																					<?php }?>
																				<?php $ppp++;}?>

																			<li><?=$job_apply_num_rows?>+</li>
																	<?php }?>
																	
																</ul>
															</div>
														</div>
													</div>
                      </div>
                  </div>
              </div>
					</div>
		<div class="col-sm-4">
			<div class="side_full_details">
				
				<p><b>Job Summary</b></p>
				<hr>
				<div class="location"> 
				<?php if($jobRow['city']){ ?> 
					<p><i class="fa fa-map-marker"></i> <?= $jobRow['city']; ?> </p>
				<?php } ?>
				<?php if($jobRow['qualification']){ ?> 
					<p><i class="fa fa-graduation-cap"></i> Qualification : <?= $jobRow['qualification']; ?></p>
				<?php } ?>
				<?php if($jobRow['experience']){ ?> 
					<p><i class="fa fa-suitcase"></i> Experience : <?= $jobRow['experience']; ?></p>
				<?php } ?>
				<?php if($jobRow['department']){ ?> 
					<p><i class="fa fa-building-o"></i> Department : <?= $jobRow['department']; ?></p>
				<?php } ?>
				<?php if($jobRow['company']){ ?> 
					<p><i class="fa fa-building-o"></i> Company : <?= $jobRow['company']; ?></p>
				<?php } ?>
				<?php if($jobRow['job_frequency']){ ?> 
					<p><i class="fa fa-building-o"></i> Job Frequency : <?= $jobRow['job_frequency']; ?></p>
				<?php } ?>
				<?php if($jobRow['package']){ ?> 
					<p><i class="fa fa-building-o"></i> Package : <?= $jobRow['package']; ?></p>
				<?php } ?>
				<?php if($jobRow['job_location']){ ?> 
					<p><i class="fa fa-map-marker"></i> <?= $jobRow['job_location']; ?> </p>
				<?php } ?>
				 
				</div>
				<div class="col-12 text-center">
						<?php if ($this->session->userdata('userType')) { ?>
							<?php if ($this->session->userdata('userType') == 2) {  ?>
									<?php if ($loginUserRow['profile_update_ratio'] >= 80) {?>
										<a data-bs-toggle="modal" data-bs-target="#job_appy_pop" onclick="post_job(<?=$jobRow['id']?>)" class="action_bt_2">SUBMIT YOUR PROFILE</a>
									<?php }else{ ?>
										<a data-bs-toggle="modal" data-bs-target="#profile_compp" class="job_bt action_bt_2">SUBMIT YOUR PROFILE</a>
										<!-- <a href="<?=base_url('stylist-zone/dashboard')?>" class="job_bt">SUBMIT YOUR PROFILE</a> -->
									<?php }?>
							<?php }else{ ?>
								<?php //$this->session->set_flashdata('message_success_redirect_home','<span class="text-danger p-2" style="font-size: 20px;    background: #ccc;"><b>You are not allowed to apply this job.</b></span>'); ?>

								<a href="<?=base_url()?>" class="action_bt_2">SUBMIT YOUR PROFILE</a>
								 
							<?php }?>
						<?php }else{ ?>
							<a href="<?=base_url('login')?>" class="action_bt_2">SUBMIT YOUR PROFILE</a>
						<?php }?>
						
						 
				</div>
			</div>
		</div>
 

		</div>
  </div>
</section>

<style>
		#job_appy_pop .modal-content {
			background: #fff;
			text-align: center;
			outline: 2px solid #940cc1;
			outline-offset: -25px;
			padding: 20px;
		}

		#job_appy_pop .btn-close {
			opacity: 1;
			filter: initial;
			right: 0px;
			position: absolute;
			top: 0px;
		}

		#job_appy_pop button{text-align:right;}

		.style_job_buddy span {
			display: block;
			font-size: 16px;
			color: #940cc1;
			margin-top: 3px;
			letter-spacing: 0px;
		}
		
		.style_job_buddy {
			font-weight: bold;
			font-size: 24px;
			letter-spacing: 1px;
		}


		#profile_compp .modal-content {
		    background: #FFF;
		    outline: 2px solid #f130be;
		    outline-offset: -24px;
		}

		#profile_compp .modal-body {
		    padding: 10px 40px 30px 40px;
		}

		.message_board{color: #940cc1; font-size: 16px; text-align: center;}
		.message_board h5 {font-size: 22px!important;}

		.pp_compl {
		    background: #f9eeee;
		    padding: 10px;
		}

		.pp_compl h5 {
		    font-size: 22px!important; text-align: center;
		}

		.pp_compl ol li {
		    font-size: 16px!important;
		    margin: 5px 0px;
		    border: 1px solid #333;
		    padding: 5px;
		    border-radius: 4px;
		    list-style-position: inside;
		}

		.pp_compl ol {padding-left: 0px; margin: 0px;}

		.pp_compl ol li::marker {
		    margin-left: 21px;
		    padding-left: 50px;
		}

		.not_comm h5 {
		    text-align: center;
		    font-size: 22px!important;
		    color: #d718a4;
		}
		.not_comm i {
		    color: #0ba72c;
		}

		.not_comm tr td {
		    font-weight: bold;
		    letter-spacing: 1px;
		}
		.not_comm a {
		    color: #fff;
		    background: #db2031;
		    font-size: 14px;
		    padding: 3px 10px;
		    border-radius: 30px;
		    font-weight: normal;
		    letter-spacing: 0px;
		}
		#profile_compp .btn-close {
		    opacity: 1;
		    filter: brightness(1) invert(0);
		}
		.style_job_buddy span p {
    color: #000;
}

.style_job_buddy span h5 {
    font-size: 22px!important;
}
</style>
 

<div class="modal" id="profile_compp" data-bs-backdrop="static" aria-modal="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="message_board">
        	<h5>Your profile needs to be at-least 80% complete to <br>apply for the jobs at StyleBuddy.</h5>
        	<p>Please take a look at below mentioned parameters and complete that is pending and start applying for jobs.  </p>
        </div> 
      
        <div class="pp_compl">
        	<h5>Profile Completion Parameters </h5>
        	<ol>
        		<li>About Me section -Minimum 50 words</li>
        		<li>More about me section -Minimum 500 words </li>
        		<li>My Projects section -Minimum 5 projects </li>
        		<li>Videos section -Minimum 5 videos</li>
        		<li>My Packages section -Minimum 1service. </li>
        	</ol>
      	</div>

      	<div class="not_comm">
	      	<table class="table">
	      		
	      		<tr>
	      			<td colspan="2"><h5>Your profiles current completion parameters</h5></td>
	      		</tr>

	      		<tr>
	      			<td>About Me section</td>
	      			<td> 
	      				<?php if($stylist_profile_complete['about']){ ?>
	      					Complete
		      				<i class="fa fa-check-circle" aria-hidden="true"></i>
		      			<?php }else{ ?>
		      				Not Complete
		      				<?php   $this->session->set_flashdata('aboutTotal_message','<span class=" p-2 mb-2">'.$stylist_profile_complete['aboutTotal'].' words out of 50 are complete. Complete your profile to start applying for the available jobs.</span>');?>
		      				<a href="<?=base_url('stylist-zone/manage-profile')?>">Complete Now</a>
		      			<?php } ?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td>More about me section </td>
	      			<td> 
	      				<?php if($stylist_profile_complete['more_about']){ ?>
	      					Complete
		      				<i class="fa fa-check-circle" aria-hidden="true"></i>
		      			<?php }else{ ?>
		      				Not Complete
		      				<?php $this->session->set_flashdata('more_aboutTotal_message','<span class=" p-2 mb-2">'.$stylist_profile_complete['more_aboutTotal'].' words out of 500 are complete. Complete your profile to start applying for the available jobs.</span>');?>
		      				<a href="<?=base_url('stylist-zone/manage-profile')?>">Complete Now</a>
		      			<?php } ?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td>My Projects section</td>
	      			<td> 
	      				<?php if($stylist_profile_complete['projectCount']){ ?>
	      					Complete
		      				<i class="fa fa-check-circle" aria-hidden="true"></i>
		      			<?php }else{ ?>
		      				Not Complete
		      				<?php $this->session->set_flashdata('projectCountTotal_message','<span class=" p-2 mb-2">'.$stylist_profile_complete['projectCountTotal'].' of 5 are complete. Complete your profile to start applying for the available jobs. </span>');?>
		      				<a href="<?=base_url('stylist-zone/manage-portfolio')?>">Complete Now</a>
		      			<?php } ?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td>Videos section </td>
	      			<td> 
	      				<?php if($stylist_profile_complete['videoCount']){ ?>
	      					Complete
		      				<i class="fa fa-check-circle" aria-hidden="true"></i>
		      			<?php }else{ ?>
		      				Not Complete
		      				<?php $this->session->set_flashdata('videoCountTotal_message','<span class=" p-2 mb-2">'.$stylist_profile_complete['videoCountTotal'].' of 5 are complete. Complete your profile to start applying for the available jobs. </span>');?>
		      				<a href="<?=base_url('vendor/videopage')?>">Complete Now</a>
		      			<?php } ?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td>My Packages section  </td>
	      			<td> 
	      				<?php if($stylist_profile_complete['servicesCount']){ ?>
	      					Complete
		      				<i class="fa fa-check-circle" aria-hidden="true"></i>
		      			<?php }else{ ?>
		      				Not Complete
		      				<?php $this->session->set_flashdata('servicesCount_message','<span class=" p-2 mb-2">'.$stylist_profile_complete['servicesCountTotal'].' of 5 are complete. Complete your profile to start applying for the available jobs. </span>');?>
		      				<a href="<?=base_url('vendor/addaservices')?>">Complete Now</a>
		      			<?php } ?>
	      			</td>
	      		</tr>

	      	</table>
      </div>
      
      </div>

    </div>
  </div>
</div>

<div class="modal" id="job_appy_pop" data-bs-backdrop="static" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="style_job_buddy"><span>
        	<h5>Your profile has been submitted to the employer.</h5>
        	<hr>
        		<p> As next steps, you will hear back directly from the advertiser on your selection process. Please keep updating your profile to attract more job opportunities.</p>
        	  <h5>Thank You.</h5></span></div> 
      </div>

    </div>
  </div>
</div>

<div class="modal" id="please_login" data-bs-backdrop="static" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="style_job_buddy">Please login as stylist</span></div> 
      </div>

    </div>
  </div>
</div>


<?php $this->load->view('front/template/footer'); ?>
<script type="text/javascript">
	function post_job(id){
		console.log(id);
		$.ajax({
          type:'POST',
          url:"<?= base_url('page/applyjob'); ?>",
          data:'id='+id,
          success:function(html){
              console.log(html);
              $('#city').html(html);
          }
      });
	}
</script>



