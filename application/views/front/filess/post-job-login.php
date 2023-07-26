<?php  $this->load->view('Page/template/header'); ?>

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

	<div class="container">
			
			<div class="josb_login">
				<a href="<?= base_url(); ?>page/postjoblogin" class="act_job">login </a>
				<a href="<?= base_url(); ?>page/postjobregister">Register</a>
			</div>

			 
			<?= form_open_multipart('',['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
				<div class="row m-0 justify-content-center login_from_job">
					

					<div class="col-sm-6">
						<div class="login_post">

							<div class="col-12 logo_p text-center">
								<h2><b>Login</b></h2><p>Please login for job a post</p>
							</div>
							<div class="col-sm-12"><div class="logo_p text-left mb-2"><?= $this->session->flashdata('login_message'); ?></div></div>
							<input type="hidden" name="user_type" value="5" class="">
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<label class="" for="fname">User email</label>
									<input type="text" id="email" name="userEmail" value="" class="form-control box_new_2">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<label class="" for="Password">Password <a href="#" class="text-dark flt">Forgot Password?</a></label>
									<input type="password" id="password" name="userPassword" value="" class="form-control box_new_2">
									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
								</div>
							</div>


							<div class="col-sm-12 text-center">
								<input type="submit" value="LOGIN" class="login-sub">
							</div>
						</div>
					</div>
				</div>
			<?= form_close(); ?>
		</form>
	</div>


<?php $this->load->view('Page/template/footer'); ?>


