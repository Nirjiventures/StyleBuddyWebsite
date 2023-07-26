<?php $this->load->view('Page/template/header');  ?>
<div class="blk_back">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-9 bread">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
				    <li class="breadcrumb-item"><a href="<?= base_url('team') ?>">Team Members</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Sanya Arora</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-9">
				<div class="team_detail">
					<div class="row">
						<?php //var_dump($datas);?>
						<div class="col-sm-12">
							<div class="team-img">
								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$datas->image)?>">
							</div>

							<div class="detail-head">
								<h3><?=ucfirst($datas->fname .' '. $datas->lname)?></h3>
								<div class="detail-text">
									<?=$datas->designation?>
								</div>
								<div class="">
									<?=$datas->experience?>
								</div>
							</div>
							<hr>
							<?=$datas->about?>
							<?=$datas->more_about?>
							
							<div class="detail-call"><p><a href="mailto:<?=$datas->email?>"><i class="fa fa-envelope-o" aria-hidden="true"></i>  <?=$datas->email?></a> <a href="tel:<?=$datas->mobile?>"><i class="fa fa-phone" aria-hidden="true"></i> <?=$datas->mobile?></p></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-9 text-center">
				<hr>
				<a href="<?= base_url('team') ?>" class="backbtn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</a>
			</div>
		</div>			
	</div>
</div>



<?php $this->load->view('Page/template/footer'); ?>