<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">

		<div class="row m-0 justify-content-end">



			<div class="col-sm-3 p-0 black_bg">

				<div class="sidebar">

					<?php $this->load->view('front/user/siderbar'); ?>

				</div>

			</div>



			<div class="col-sm-9">

				<div class="rightbar1">

					<h2>Profile </h2>

					

					<hr>

				<?= form_open_multipart('') ?>	

					<div class="row mt-5">
					    <div class="col-sm-3"> 
    						<div class="uskk2 mb-2"> 
    							<?php $img =  'assets/images/no-image.jpg';?>
    					        <?php if(!empty($datas->image))  {?>
    					            <?php 
    					            	$img1  = 'assets/images/vandor/' . $datas->image;
    					                if (file_exists($img1)) {
    					                    $img = $img1;
    					                }
    					            ?>
    					        <?php } ?>
    					        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
    						</div>
    						
    						<input type="file" name="image" class="box">

					    </div>
						<div class="col-sm-4">
							<div class="form-group boot_sp">
								<input type="text" id="fname" name="fname" value="<?= $datas->fname ?>" class="form-control box_in3">
								<label class="form-control-placeholder2" for="fname">First Name</label>
							</div>
							<div class="form-group boot_sp">
								<input type="text" id="lname" name="lname" value="<?= $datas->lname ?>" class="form-control box_in3">
								<label class="form-control-placeholder2" for="lName">Last Name</label>
							</div>
							<div class="form-group boot_sp">
								<input type="email" disabled id="email" name="email" value="<?= $datas->email ?>" class="form-control box_in3">
								<label class="form-control-placeholder2" for="email">Email</label>
							</div>
							<div class="form-group boot_sp">
								<input type="text" id="mobile" maxlength="10" name="mobile" value="<?= $datas->mobile ?>" class="form-control box_in3 onlyInteger">
								<label class="form-control-placeholder2" for="Phone">Phone</label>
							</div>
							<div class="form-group boot_sp">
								<input type="text" id="company" name="company" value="<?= $datas->company ?>" class="form-control box_in3">
								<label class="form-control-placeholder2" for="company">Company</label>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group boot_sp">
								<input type="text" class="form-control box_in3" id="address" name="address" value="<?= $datas->address ?>">
								<label class="form-control-placeholder2" for="Address">Address</label>
							</div>
							<div class="form-group boot_sp">
								<select class="form-control box_in3" name="country" id="country">
						            <option>Select Country</option>
						            <?php if($country) { foreach($country as $state) { ?>
						            <option value="<?= $state->id ?>" <?= ($datas->country == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
						            <?php }} ?>
						         </select>
						         <label class="form-control-placeholder2" for="Password">Country</label>
							</div>
							<div class="form-group boot_sp">
								<select id="state" name="state" class="form-control box_in3" >
									<?php if($states) { foreach($states as $state) { ?>
									  <option <?= ($datas->state == $state->id )?'selected':'' ?> value="<?= $state->id ?>"><?= $state->name ?></option>
									<?php } } ?>
							    </select>
								<label class="form-control-placeholder2" for="State">State</label>
							</div>
							<div class="form-group boot_sp">
								<select id="city" name="city" class="form-control box_in3" >
                                   	<option value="">Select City</option>
    							    <option value="<?=$datas->city?>" selected><?= $datas->city_name ?></option>
									<!-- <?php if($cities) { foreach($cities as $city) { ?>
									  <option <?= ($datas->city == $city->id )?'selected':'' ?> value="<?= $city->id ?>"><?= $city->city ?></option>
									<?php } } ?>-->
								</select>
								<label class="form-control-placeholder2" for="City">City</label>
							</div>
							<div class="form-group boot_sp">
								<input type="text" id="zip" name="zip" value="<?= $datas->zip ?>" class="form-control box_in3">
								<label class="form-control-placeholder2" for="Pin">Pin / Postal code</label>
							</div>
						</div>
					  <div class="col-sm-4 offset-sm-3">
						<input type="submit" value="Update Now" class="sub" >
					  </div>
					</div>
				<?= form_close(); ?>	
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/template/footer'); ?>