<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="row m-0 row-flex">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->


		<div class="col-sm-9">
			<div class="rightbar">
				<h2>My Profile</h2>
				<?php if($this->session->flashdata('success')) {  ?>
					<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<?php } ?>
				<?php if($this->session->flashdata('error')) {  ?>
					<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				<?php } ?>
				<hr>
				<?= form_open_multipart('stylist-zone/my-profile-update'); ?>
				<div class="row mt-5">
				  	<div class="col-sm-3">
						<div class="uskk2 mb-2"> 
						  <?php if(empty($profile->image)) { ?>    
						      <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/vandor/images/c3.jpg" class="img-fluid">	
						  <?php } else { ?>
						      <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/vandor/images/').$profile->image ?>" class="img-fluid">
						  <?php } ?>
						</div>
						<input type="file" class="box" name="image" accept=".jpg,.jpeg" >
						
						<?php if($this->session->flashdata('imgerror')) {  ?>
							<span class="bg-danger text-white p-2"><?= $this->session->flashdata('imgerror');  ?></span>
						<?php } ?>
				  	</div>
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group boot_sp">
									<input type="text" id="designation" name="designation" value="<?= $profile->designation ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Designation<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group boot_sp">
									<input type="text" id="location" name="location" value="<?= $profile->location ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="location">Location<span class="text-danger">*</span></label>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group boot_sp">
								    <label class="form-control-placeholder2" for="ab">More About Me</label>
									<textarea class="form-control box_in3" id="editor1" name="more_about" style="height: 100px!important;"><?= $profile->more_about ?></textarea>
									<script type="text/javascript"> CKEDITOR.replace("editor1"); </script>
								</div>
							</div>

						</div>

						<div class="row mb-4 mt-0">
							<div class="col-sm-12">
								<hr>
							</div>
							<div class="col-sm-12">
								<input type="submit" value="UPDATE NOW" class="sub">
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
<?php $this->load->view('front/vandor/footer'); ?>