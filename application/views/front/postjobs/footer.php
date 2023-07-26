
<?php  $this->load->view('front/template/header'); ?>


	<div class="container">
			
			<div class="josb_login">
				<a href="<?= base_url(); ?>page/postjoblogin" class="act_job">login </a>
				<a href="<?= base_url(); ?>page/postjobregister">Register</a>
			</div>


			
				<div class="row m-0 justify-content-center login_from_job">
					<div class="col-sm-6">
						<div class="login_post">
							<div class="col-12 logo_p text-center">
								<h2><b>Login</b></h2><p>Please login for job a post</p>
							</div>

							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<label class="" for="fname">User email</label>
									<input type="text" id="email" name="userEmail" value="" class="form-control box_new_2">
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<label class="" for="Password">Password <a href="#" class="text-dark flt">Forgot Password?</a></label>
									<input type="password" id="pass" name="pass" value="" class="form-control box_new_2">
								</div>
							</div>


							<div class="col-sm-12 text-center">
								<input type="submit" value="LOGIN" class="login-sub">
							</div>
						</div>
				</div>
			</div>


	</div>


<?php //$this->load->view('front/template/footer'); ?>


