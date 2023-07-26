<?php  $this->load->view('front/template/header'); ?>
	<div class="banner_inner">
		<div class="container">
			<h1>Login</h1>
			<a href="<?=base_url()?>">Home</a> > Login
		</div>
	</div>
<div class="middle_part">
	<div class="container">
		<div class="login">
			<?php 	if ($this->session->flashdata('register_message')) { ?>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#festivalPopup").modal('show');
					});
				</script>
				<div class="modal" id="festivalPopup" data-bs-backdrop="static" aria-modal="true" >
				  	<div class="modal-dialog modal-lg modal-dialog-centered">
					    <div class="modal-content">
					      	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					       	<div class="modal-body text-center">
					        	<h2><?php echo $this->session->flashdata('register_message')?></h2>
					        </div>
					    </div>
				  	</div>
				</div>
			<?php 	}	?>

			<div class="col-12 text-center "><b>SIGN INTO YOUR ACCOUNT</b></div>
			<?= form_open_multipart('',['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
				<div class="row m-0 justify-content-center login_from_job">
					<div class="login_form jogi_log">
						<div class="login_post">
							<div class="col-12 logo_p text-center">
								<p>Please login for job a post</p>
							</div>
							<div class="col-sm-12"><div class="logo_p text-left mb-2"><?= $this->session->flashdata('login_message'); ?></div></div>
							<input type="hidden" name="user_type" value="5" class="">
							 
							<div class="fg_gp">
								<input id="userEmail" name="userEmail" type="text" placeholder="Email Address" class="box_new">
								<i class="fa fa-envelope-o"></i>
								<div id="email_err"></div>
							</div>
						

							<div class="fg_gp">
								<input id="password" name="userPassword" type="password" placeholder="Password" class="box_new">
								<i class="fa fa-lock"></i>
								<i class="toggle-password fa fa-fw fa-eye-slash"></i>
								<div id="password_err"></div>
							</div>

							<div class="col-sm-12 text-center">
								<input type="submit" value="LOGIN" class="subscribe_bt2">
							</div>
						</div>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>


<?php $this->load->view('front/template/footer'); ?>


