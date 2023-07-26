<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>

<?php $url4 = $this->uri->segment(4);?>
<?php  $this->load->view('front/template/header'); ?>


<div class="banner_inner">
	<div class="container">
		<h1>Post Jobs</h1>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', '/');
			$this->breadcrumb->add('Post Jobs', base_url('page/browsejobs'));
		?>
	 
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>

<div class="job-banner common_style">
	<div class="container">
	         
        	
		<div class="row align-items-center">
		   
			<div class="col-sm-6">
				<h1>Post Fashion styling Jobs</h1>
				<p>The No. 1 Fashion styling job board for brands, Agencies, Contractors and Production Houses. </p>
				<div class="btn-grp1">
					<a class="action_bt_2"  href="<?=base_url()?>login/postjoblogin">Post Now</a>
					<a class="action_bt_2" href="<?=base_url()?>login/postjobregister">Register</a>
				</div>
			</div>
			<div class="col-sm-6">
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/jb-img.jpg" class="img-fluid">
			</div>
		</div>
	</div>
</div>
<div class="jb-board common_style">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h2>The job board for top Fashion styling talent</h2>
				<p>Connect with thousands of stylists in India and worldwide. Our job postings get strong responses in front of one of the best fashion stylists. </p>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/jb-board.jpg" class="img-fluid">
					</div>
					<div class="col-sm-6">
						<div class="board-jb">
							<div class="board-list">
								<a href="<?=base_url()?>page/browsejobs">Fashion stylist <span>Full time- Mumbai</span></a>
								<a href="<?=base_url()?>page/browsejobs">Wedding Stylist <span>Part time- Delhi</span></a>
								<a href="<?=base_url()?>page/browsejobs">Celebrity Stylist <span>Full time- Ahmedabad</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
<div class="easy-box common_style">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				 
				<?php if($tranding_vendor){ ?>
					<?php foreach($tranding_vendor as $k=>$vender){ ?>	
						<?php $review = $vender->review;?>
						
						<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-',$vender->city_name)) ?>
       					<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>


						<?php $img =  'assets/images/no-image.jpg';?>
						<?php if(!empty($vender->image))  {?>
					   		<?php 
					   			$img1 =  'assets/images/vandor/'.$vender->image; 
					   			if (file_exists($img1)) {
					   				$img = $img1;
					   			}
					   		?>
					   	<?php } ?>
						<a href="<?=$url?>" class="absc">
							<div class="designer_list_1">
								<span>
									<div class="row">
									     <div class="col-sm-3 col-5">
									        	<div class="pro_part">
										        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img)?>" class="img-fluid">
											</div>
										</div>
									     <div class="col-sm-9 col-7">
									        	<div class="all_data">

												<p><b><span><?= ucwords($vender->fname.' '.$vender->lname) ?></span></b></p>

												<div class="row">

													<div class="col-sm-6">

														 

															<p class="mt-0"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>



															<p style="display: none;"><?= $vender->designation ?></p>



															<div class="hidden_star_pointer ratingss">



																<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Reviews <?=$vender->feedbackCount?>) 



															</div>

														 

													</div>

													<div class="col-sm-6">

														

															<?php if(isset($vender->city_name) && (!empty($vender->city_name)) ) {  ?>

										        			<p><small><i class='fa fa-map-marker' aria-hidden="true"></i> <?= $vender->city_name ?></small></p>

										        			<?php } ?>



															<p class="portfolio_total"><i class="fa fa-eye"></i> <?=$vender->count_view;?> Views</p>

														

														<div class="book_now_b">

															<?php if($this->session->userdata('loginUser')){ ?>

																<button class="action_bt_2" onclick="redire('<?= base_url('ask-for-quote/uOiEa'.base64_encode($vender->id) ) ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

													        	 



													        <?php }else{ ?>	

													        	<button class="action_bt_2" onclick="redire('<?= base_url('login') ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

													        	 



													        <?php } ?>

													    </div>

													</div>

												</div>

											</div>
									     </div>
								     </div>
								</span>
							</div>
						</a>
					<?php } ?>	
				<?php } ?>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-5">
				<h2>Hire fast & easy. Find talented fashion stylists in minutes. </h2>
				<p>Connect with thousands of stylists in India and worldwide. Our job postings get strong responses in front of one of the best fashion stylists. </p>
				<a href="<?=base_url()?>login/postjoblogin" class="action_bt_2">Post Now</a>
			</div>
		</div>
	</div>
</div> 
<?php $this->load->view('front/template/footer'); ?>



