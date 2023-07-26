<?php $this->load->view('Page/template/header');  ?>

<!--========Banner Area ========-->

<div class="container mt-3">
	<div class="banner_inner banner_inner3 th_banner">
		<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/book-img.jpg" class="img-fluid"> -->
		<div class="top_text">
			<div class="container">
				<div class="row text-center">
					<h2 class="mb-5 mt-5">Team Members</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
		<div class="row pt-3 location_box  row-flex">
			<?php if($datas){ ?>
				<?php foreach ($datas as $key => $value) { ?>
					<div class="col-sm-3">
						<div class="team-box">
							<div class="team-img">
								<a href="<?= base_url('team/team-details/'.base64_encode($value->id)) ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$value->image)?>"></a>
							</div>
							<div class="team-text">
								<h4><a href="<?= base_url('team/team-details') ?>"><?=ucfirst($value->fname .' '. $value->lname)?></a></h4>
								<div class="d_text"><?=$value->designation?></div>
								<div class="team_desc"><?=$value->experience?></div>
								<a class="team_btn" href="<?= base_url('team/team-details/'.base64_encode($value->id)) ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			
		</div>
		<div class="row pt-3 location_box  row-flex" style="display: none;">

			<div class="col-sm-3">
				<div class="team-box">
					<div class="team-img">
						<a href="<?= base_url('team/team-details') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/team-1.webp"></a>
					</div>
					<div class="team-text">
						<h4><a href="<?= base_url('team/team-details') ?>">Sanjay Pandit</a></h4>
						<div class="d_text">Founder</div>
						<div class="team_desc">Global business leader with 30+years experience</div>
						<a class="team_btn" href="<?= base_url('team/team-details') ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="team-box">
					<div class="team-img">
						<a href="<?= base_url('team/team-details') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/team-2.webp"></a>
					</div>
					<div class="team-text">
						<h4><a href="<?= base_url('team/team-details') ?>">Sanya Arora</a></h4>
						<div class="d_text">Celebrity Stylist and Designer</div>
						<div class="team_desc">Celebrity Fashion Stylist with 5+ years in industry..</div>
						<a class="team_btn" href="<?= base_url('team/team-details') ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>

			<!-- <div class="col-sm-3">
				<div class="team-box">
					<div class="team-img">
						<a href="<?= base_url('team/team-details') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/team-3.webp"></a>
					</div>
					<div class="team-text">
						<h4><a href="<?= base_url('team/team-details') ?>">Sachi Breja</a></h4>
						<div class="d_text">Celebrity Stylist and Fashion Advisor</div>
						<div class="team_desc">10+ years experience in celebrity styling, event styling..</div>
						<a class="team_btn" href="<?= base_url('team/team-details') ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div> -->

			<div class="col-sm-3">
				<div class="team-box">
					<div class="team-img">
						<a href="<?= base_url('team/team-details') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/team-4.webp"></a>
					</div>
					<div class="team-text">
						<h4><a href="<?= base_url('team/team-details') ?>">Shagun Mehta</a></h4>
						<div class="d_text">Senior Fashion Designer and Stylist</div>
						<div class="team_desc">Fashion Design expert with 7+ years experience..</div>
						<a class="team_btn" href="<?= base_url('team/team-details') ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="team-box">
					<div class="team-img">
						<a href="<?= base_url('team/team-details') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/team-5.webp"></a>
					</div>
					<div class="team-text">
						<h4><a href="<?= base_url('team/team-details') ?>">Jyoti</a></h4>
						<div class="d_text">Senior Manager Operations</div>
						<div class="team_desc">Fashion Model, Celebrity Stylist and Designer..</div>
						<a class="team_btn" href="<?= base_url('team/team-details') ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>

		</div>			
	</div>
	
</div>



<?php $this->load->view('Page/template/footer'); ?>