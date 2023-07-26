<?php $this->load->view('front/boutiques/header'); ?>
 
<div class="main">
	<div class="container">
 		<div class="manage_w">
			<div class="rightbar">

				<div class="container p-0">
					<div class="row">
						<div class="col-sm-6">
							<h2>Profile</h2>
						</div>

						<div class="col-sm-6 text-end">
							<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
				</div>



				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				

				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
				<?php // form_open_multipart('stylist-zone/profile-update') ?>

				


				<div class="row mt-5">
					<div class="col-sm-12">
						<div class="row align-items-end mb-5">
						 	<div class="col-sm-2 ">
							    <div class="uskk2 mb-2"> 
							     	<?php  if (file_exists($image_path = FCPATH . 'assets/images/vandor/' . $profile->image)) { ?>
									    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/vandor/'.$profile->image) ?>"  class="img-fluid">
									<?php  } else { ?>
									    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>"  class="img-fluid">
									<?php  } ?>
	    						</div>
							</div>
						    <div class="col-sm-4">
    						<input type="file" class="box" name="image" accept=".jpg,.jpeg" >
    						<?php if($this->session->flashdata('imgerror')) {  ?>
    						<span class="bg-danger text-white p-2"><?= $this->session->flashdata('imgerror');  ?></span>
    						<?php } ?>
				  	      </div>
						  </div>
						  <div class="row">
						  <!--<div class="col-md-2 "></div>-->
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="fname" name="fname" value="<?= $profile->fname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">First name<span class="text-danger">*</span></label>
									<?php echo form_error('fname','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="lname" name="lname" value="<?= $profile->lname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Last name<span class="text-danger">*</span></label>
									<?php echo form_error('lname','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="email" id="email" name="email" value="<?= $profile->email ?>" readonly class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Email<span class="text-danger">*</span></label>
									<?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<!-- <div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="gender">
										<option value="1" <?= ($profile->gender == 1)?'selected':'' ?> >Male</option>
										<option value="2" <?= ($profile->gender == 2)?'selected':'' ?> >Female</option>
									</select>
									<label class="form-control-placeholder2" for="Password">Gender<span class="text-danger">*</span></label>
									<?php echo form_error('gender','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div> -->
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="mobile" value="<?= $profile->mobile ?>" name="mobile" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="mnumber">Mobile Number</label>
								</div>
							</div>
							<div class="col-sm-4">
								 
								<div class="form-group boot_sp">
										<select class="form-control box_in3"  id="experience" name="experience" >
		    								<option  disabled selected>Select Experience</option>
		    								<?php $aaa = array('< 1'=>'< 1 Years','1'=>'1+ Years','2'=>'2+ Years','3'=>'10-15 Years','15'=>'Above 15 Years');?>
		    								<?php 
		    								for ($i=1; $i < 17  ; $i++) { if($i == $profile->experience){$sel='selected';}else{$sel='';}  if($i == 16){ $text = 'Above 15 Year';}else{$text = '< '.$i.' Year';}?>
		    									<option value="<?=$i?>" <?=$sel?>><?=$text?></option>
		    								<?php } ?>
		    						</select>
									<label class="form-control-placeholder2" for="Password">Years of Experience<span class="text-danger">*</span></label>
									<?php echo form_error('experience','<span class="text-primary mt-1">','</span>') ;?>
									<div id="experience_err"></div>
								</div>
							</div>

							 
							<!-- <div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="designation" name="designation" value="<?= $profile->designation ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Designation<span class="text-danger">*</span></label>
								</div>
							</div> -->

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="address" name="address" value="<?= $profile->address ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="address">Address</label>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="pin" name="pin" value="<?= $profile->pin ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="pin">Pincode</label>
								</div>
							</div>
							 

							<!-- <div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="project_deliverd" name="project_deliverd" value="<?= $profile->project_deliverd ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="pin">project_deliverd</label>
								</div>
							</div>

 

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="instagram_nlink" value="<?= $profile->instagram_nlink ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">Instagram Link</label>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="linkedin_link" value="<?= $profile->linkedin_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">linkedin Link</label>
								</div>
							</div> -->
							
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="behance_link" value="<?= $profile->behance_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">Behance Link</label>
								</div>
							</div>
							
 							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="country" id="country">
							            <option>Select Country</option>
							            <?php if($country) { foreach($country as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($profile->country == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="Password">country</label>
								</div>
							</div>
              				<div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="state" id="state">
							            <option>Select Location</option>
							            <?php if($states) { foreach($states as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($profile->state == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="Password">state</label>
								</div>
							</div>
							<div class="col-sm-4">
							    <div class="form-group boot_sp">
								    <select class="form-control box_in3" name="city" id="city">
									   	<option value="">Select City</option>
									   	<option value="<?=$profile->city?>" selected><?= $profile->city_name ?></option>
									    <!-- <?php if($cities) { foreach($cities as $city) { ?>
									     <option value="<?= $city->id ?>" <?= ($profile->city == $city->id)?"selected":'' ?> ><?= $city->city ?></option>
									   	<?php }} ?> -->
								 	</select>
								 <label class="form-control-placeholder2" for="dob">City<span class="text-danger">*</span></label>
							   	</div>
							</div>
                            
							
							<!-- <div class="col-sm-12">
								<div class="form-group boot_sp">
									<textarea class="form-control box_in3" name="about" style="height: 100px!important;"><?= $profile->about ?></textarea>
									<label class="form-control-placeholder2" for="pin">About Me short</label>
								</div>
							</div> -->
							<div class="col-sm-12">
								<div class="form-group boot_sp">
								    
									<textarea class="form-control box_in3" id="editor1" name="more_about" style="height: 100px!important;"><?= $profile->more_about ?></textarea>
									<label class="form-control-placeholder2" for="ab">About Us</label>
									<script type="text/javascript"> CKEDITOR.replace("editor1"); </script>
								</div>
							</div>
						</div>
						 
							<div class="col-sm-12 text-center">
								<input type="submit" value="UPDATE NOW" class="btc">
							</div>
						
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
	    $('#state').on('change',function(){
	      var state_id = $(this).val();
	      if(state_id) {
	          $.ajax({
	                type:'POST',
	                url:"<?= base_url('city-data')?>",
	                data:'state_id='+state_id,
	                success:function(html){
	                    $('#city').html(html);
	                }
	            }); 
	      } else {
	          $('#city').html('<option value="">Select state first</option>');
	      } 
	    });
	}); 



	$('#registration-form').on('submit',function(e){
        e.preventDefault();
        $('#registration-form').get(0).submit();
    });   
</script>

</body>
</html>
<style type="text/css">
	.text-green{
		font-weight: bold;
		color: green!important;
	}
</style>
<?php $this->load->view('front/boutiques/footer'); ?>
