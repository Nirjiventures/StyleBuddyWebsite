<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
					 <div class=" profile_fm">
						<h2>Post Jobs</h2>
						<p></p>
						<hr>
						<?= form_open_multipart('') ?>	
						<div class="row m-0 pt-3">
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label  for="company">Client Name<span class="text-danger">*</span></label>
									<input required type="text" id="company" name="company" value="<?=$jobs->company?>" class="form-control box_in3">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="mobile">Mobile Number<span class="text-danger">*</span></label>
									<input required type="text" id="mobile" name="mobile" value="<?=($jobs)?$jobs->mobile:$datas->mobile?>" class="form-control box_in3">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" required for="email">Mail ID<span class="text-danger">*</span></label>
									<input type="text" id="email" name="email" value="<?=($jobs)?$jobs->email:$datas->email?>" class="form-control box_in3">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="city">Client City<span class="text-danger">*</span></label>
									<select required id="city" name="city" class="form-control box_in3" >
										<option value="" disabled="">-select city-</option>
										<?php if($cities) { ?>
										 	<?php foreach($cities as $city) { ?>
										  		<option <?= ($jobs->city == $city->city )?'selected':'' ?> value="<?= $city->city ?>"><?= $city->city ?></option>
											<?php }  ?>
										<?php } ?>
									</select>
									<!-- <input type="text" id="city" name="city" value="<?=$jobs->city?>" class="form-control box_in3"> -->
								</div>
							</div>
							

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="job_title">Job Title<span class="text-danger">*</span></label>
									<!-- <input type="text" id="job_title" name="job_title" value="<?=$jobs->job_title?>" class="form-control box_in3"> -->
									<select required class="form-control box_in3" id="job_title" name="job_title">
										<option value="" disabled=""></option>
										<?php $aa = 
											array(
												array('key'=>"Need Personal Stylist for Wedding",'name'=>"Need Personal Stylist for Wedding"),
												array('key'=>"Urgently need personal stylist for photoshoot",'name'=>"Urgently need personal stylist for photoshoot"),
												array('key'=>"Fashon model looking for personal stylist",'name'=>"Fashon model looking for personal stylist"),
												array('key'=>"Looking for wardrobe specialist",'name'=>"Looking for wardrobe specialist"),
												array('key'=>"Looking for Personal Shopper",'name'=>"Looking for Personal Shopper"),
												array('key'=>"Need Personal Stylist for corporate outfit",'name'=>"Need Personal Stylist for corporate outfit"),
												array('key'=>"Image Consultant needed",'name'=>"Image Consultant needed"),
												array('key'=>"Personal Shopper needed urgently",'name'=>"Personal Shopper needed urgently"),
												array('key'=>"Personal Styling needed for private event",'name'=>"Personal Styling needed for private event"),
												array('key'=>"Urgently looking for Wedding fashion stylist",'name'=>"Urgently looking for Wedding fashion stylist"),
												array('key'=>"Stylist needed for branded photoshoot",'name'=>"Stylist needed for branded photoshoot"),
												array('key'=>"Celebrity Stylist needed urgently",'name'=>"Celebrity Stylist needed urgently"),
												array('key'=>"Fashion house looking for experienced stylists",'name'=>"Fashion house looking for experienced stylists"),
												array('key'=>"Need help with wardrobe management",'name'=>"Need help with wardrobe management"),
												array('key'=>"Media company looking for fashion stylists",'name'=>"Media company looking for fashion stylists"),
												array('key'=>"Production House looking for experienced celebrity stylists",'name'=>"Production House looking for experienced celebrity stylists"),
												array('key'=>"Freelance stylists needed",'name'=>"Freelance stylists needed"),
												array('key'=>"Need help in dressing for interview",'name'=>"Need help in dressing for interview"),
												array('key'=>"Businessman looking for personal stylist",'name'=>"Businessman looking for personal stylist"),
												array('key'=>"Fashion Label seeking freelance stylists and designers",'name'=>"Fashion Label seeking freelance stylists and designers"),
												array('key'=>"Urgently needed Event Stylist for HNI",'name'=>"Urgently needed Event Stylist for HNI"),
												array('key'=>"Corporate house looking for freelance stylists on panel",'name'=>"Corporate house looking for freelance stylists on panel"),
												array('key'=>"Styling trainers and consultants needed",'name'=>"Styling trainers and consultants needed"),
												array('key'=>"Fresh fashion graduates needed for freelance work",'name'=>"Fresh fashion graduates needed for freelance work"),
												array('key'=>"Wedding fashion stylists required urgently",'name'=>"Wedding fashion stylists required urgently")
											);
										?>
										<?php foreach ($aa as $key => $value) { if($jobs->job_title == $value['key']){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value['key']?>" <?=$sel?>><?=$value['name']?></option>
										<?php }?>
									</select>

								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="job_type">Job Type<span class="text-danger">*</span></label>
									<select required type="text" id="job_type" name="job_type"  class="form-control box_in3">
										<?php $abc= array('Permanent','Part-time','Freelancer','Internship','Temporary');?>
										<?php  foreach ($abc as $key => $value) { if($value == $jobs->job_type){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value?>" <?=$sel?>><?=$value?></option>
										<?php   } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="job_location">Job Location<span class="text-danger">*</span></label>
									<select class="form-control box_in3" id="job_location" name="job_location" required="">
										<option value="" disabled=""></option>
										<?php $aa = 
											array(
												array('key'=>"Online Video Styling",'name'=>"Online Video Styling"),
												array('key'=>"At Client Location",'name'=>"At Client Location"),
											);
										?>
										<?php foreach ($aa as $key => $value) { if($jobs->job_location == $value['key']){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value['key']?>" <?=$sel?>><?=$value['name']?></option>
										<?php }?>
									</select>

								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="experience">Experience needed<span class="text-danger">*</span></label>
									<select class="form-control box_in3" id="experience" name="experience" required="">
										<option value="" disabled=""></option>
										<?php $aa = 
											array(
												array('key'=>"Freshers welcome",'name'=>"Freshers welcome"),
												array('key'=>"2 to 5 years",'name'=>"2 to 5 years"),
												array('key'=>"5 to 10 years",'name'=>"5 to 10 years"),
												array('key'=>"More than 10 years",'name'=>"More than 10 years"),
											);
										?>
										<?php foreach ($aa as $key => $value) { if($jobs->experience == $value['key']){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value['key']?>" <?=$sel?>><?=$value['name']?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="job_frequency">Job frequency<span class="text-danger">*</span></label>
									<select class="form-control box_in3" id="job_frequency" name="job_frequency" required="">
										<option value="" disabled=""></option>
										<?php $aa = 
											array(
												array('key'=>"One-time project",'name'=>"One-time project"),
												array('key'=>"Many projects in a month",'name'=>"Many projects in a month"),
												array('key'=>"Several projects during year",'name'=>"Several projects during year"),
												array('key'=>"Full-time employment",'name'=>"Full-time employment"),
											);
										?>
										<?php foreach ($aa as $key => $value) { if($jobs->job_frequency == $value['key']){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value['key']?>" <?=$sel?>><?=$value['name']?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<label class="" for="package">Estimated Spend<span class="text-danger">*</span></label>
									<select class="form-control box_in3" id="package" name="package" required="">
										<option value="" disabled=""></option>
										<?php $aa = 
											array(
												array('key'=>"Upto Rs. 10000 one-time",'name'=>"Upto Rs. 10000 one-time"),
												array('key'=>"Upto Rs. 20000 one-time",'name'=>"Upto Rs. 20000 one-time"),
												array('key'=>"Upto Rs. 50000 one-time",'name'=>"Upto Rs. 50000 one-time"),
												array('key'=>"Upto Rs. 100000 one-time",'name'=>"Upto Rs. 100000 one-time"),
												array('key'=>"Upto Rs. 100000 per month",'name'=>"Upto Rs. 100000 per month"),
												array('key'=>"Upto Rs. 50000 per month",'name'=>"Upto Rs. 50000 per month"),
												array('key'=>"Upto Rs. 25000 per month",'name'=>"Upto Rs. 25000 per month"),
												array('key'=>"Upto Rs. 5 lakhs per year",'name'=>"Upto Rs. 5 lakhs per year"),
												array('key'=>"Upto Rs. 10 lakhs per year",'name'=>"Upto Rs. 10 lakhs per year"));
										?>
										<?php foreach ($aa as $key => $value) { if($jobs->package == $value['key']){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value['key']?>" <?=$sel?>><?=$value['name']?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<label class="" for="ab">Job Detail</label>
									<textarea class="form-control box_in3" id="job_description" name="job_description" style="height: 100px!important;"><?=$jobs->job_description?></textarea>
									
									<script type="text/javascript"> CKEDITOR.replace("job_description"); </script>
								</div>
							</div>
							<!-- <div class="col-sm-3">
								<div class="form-group boot_sp">
									<label class="" for="department">Department<span class="text-danger">*</span></label>
									<select type="text" id="department" name="department" class="form-control box_in3">
										<?php $abc= array('Sales','HR','IT');?>
										<?php  foreach ($abc as $key => $value) { if($value == $jobs->department){$sel='selected';}else{$sel='';}?>
											<option value="<?=$value?>" <?=$sel?>><?=$value?></option>
										<?php   } ?>
									</select>
									
								</div>
							</div> -->
							<!-- <div class="col-sm-3">
								<div class="form-group boot_sp">
										<label class="" for="qualification">Qualification<span class="text-danger">*</span></label>
										<select type="text" id="qualification" name="qualification" value="" class="form-control box_in3">
											<?php $abc= array('Qualification','Bachelor\'s degree','Master\'s degree','Any Diploma');?>
											<?php  foreach ($abc as $key => $value) { if($value == $jobs->qualification){$sel='selected';}else{$sel='';}?>
												<option value="<?=$value?>" <?=$sel?>><?=$value?></option>
											<?php   } ?>
										</select>
									
								</div>
							</div> -->
							<!-- <div class="col-sm-6">
								<div class="form-group boot_sp">
									<label class="" for="company_logo">Company Logo<span class="text-danger"></span></label>
									<input type="file" id="company_logo" name="company_logo" value="<?=$jobs->job_title?>" class="form-control box_in3">
								</div>
							</div>
							 -->
							<div class="col-sm-12">
								<input type="submit" value="SUBMIT" class="login-sub">
							</div>
							
						</div>
						<?= form_close(); ?>	
						
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
