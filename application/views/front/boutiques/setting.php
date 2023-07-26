<?php $this->load->view('front/boutiques/header'); ?>

<div class="main">
	<div class="container">

		 
		<div class="col-sm-12">
			<div class="rightbar">

				<div class="row">
					<div class="col-sm-9">
						<h2>Update Password</h2>
					</div>

					<div class="col-sm-3 text-end">
						<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
						&nbsp; - &nbsp; 
						<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
					</div>

				</div>
				<hr>

				<h2></h2>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('updatePassword'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				

				<?= form_open(''); ?>
				<div class="row  justify-content-center">
				
				  <div class="col-sm-7">
					  <div class="chpass row m-0 justify-content-center">
						<p><b>Change Password</b></p>
						<br>
					  
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<input type="password" id="Current" name="currentPassword"  class="form-control box_in3">
									<label class="form-control-placeholder2" for="Current">Enter Current Password</label>
									<?php echo form_error('currentPassword','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
						 
							<div class="col-sm-12"><hr></div>
						 
							<div class="col-sm-12 mt-4">
								<div class="form-group boot_sp">
									<input type="password" id="new_p" name="password"  class="form-control box_in3">
									<label class="form-control-placeholder2" for="new_p">Enter New Password</label>
									<?php echo form_error('password','<span class="text-danger mt-1">','</span>') ;?>
								</div>
								<div class="form-group boot_sp">
									<input type="password" id="new_p2" name="cpassword"  class="form-control box_in3">
									<label class="form-control-placeholder2" for="new_p2">Enter Confirm Password</label>
									<?php echo form_error('cpassword','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
						  
						  <div class="col-sm-12 text-center">
							<input type="submit" value="Update Now" class="btc" >
						  </div>
						  
					  </div>
				  </div>
				  
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>


</body>
</html>
<?php $this->load->view('front/boutiques/footer'); ?>