<?php  $this->load->view('Page/template/header'); ?>

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>User Dashboard</h3></div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3>User Dashboard</h3>
			</div>
			<div class="col-sm-12 mt-4 text-center">
			    <h1><?= $this->session->userdata('email'); ?></h1>
			    <a href="<?= base_url('logout') ?>">Logout</a>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Page/template/footer'); ?>