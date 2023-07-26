<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9">
				<div class="rightbar1 profile_fm">
					<h2>Profile </h2>
					<hr>
				<?= form_open_multipart('') ?>	
					<div class="row mt-5">
					  	<div class="col-sm-2"> 
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
						</div>
						<div class="col-sm-4">
							<div class="form-group boot_sp">
								<label class="" for="fname">Company Name</label>
								<input type="text" id="fname" name="fname" value="<?= $datas->fname ?>" class="form-control box_in3">
								
							</div>
							<div class="form-group boot_sp">
								<label class="" for="email">Official email</label>
								<input type="email" disabled id="email" value="<?= $datas->email ?>" class="form-control box_in3">
								
							</div>
							<div class="form-group boot_sp">
								<label class="" for="Phone">Mobile / Landline*</label>
								<input type="text" id="mobile" name="mobile" value="<?= $datas->mobile ?>" class="form-control box_in3">
								
							</div>
							<div class="form-group boot_sp">
								<label class="" for="company">Contact Person Name</label>
								<input type="text" id="contact_person_name" name="contact_person_name" value="<?= $datas->contact_person_name ?>" class="form-control box_in3">
								
							</div>
							
							<div class="time_table mb-3" id="wrapper-radios4">
								<div class="radios">
									<input type="radio" value='Company' name='company_type' id='radio_time1' <?php if($datas->company_type == 'Company'){ echo 'checked';}?>>
									<label for='radio_time1'><span>Company</span></label>
								
									<input type="radio" value='Consultant' name='company_type' id='radio_time2' <?php if($datas->company_type == 'Consultant'){ echo 'checked';}?>>
									<label for='radio_time2'><span>Consultant</span></label>
								</div>
										
							</div>

							<div class="form-group boot_sp">
								<label class="" for="Address">Nature of Business</label>
								<input type="text" class="form-control box_in3" id="business_nature" name="business_nature" value="<?= $datas->business_nature ?>">
								
							</div>
							

						</div>

					 

						<div class="col-sm-4">
							<div class="form-group boot_sp">
								<label class="" for="Password">country</label>
								<select class="form-control box_in3" name="country" id="country">
						            <option>Select Country</option>
						            <?php if($country) { foreach($country as $state) { ?>
						            <option value="<?= $state->id ?>" <?= ($datas->country == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
						            <?php }} ?>
						         </select>
						         
							</div>
							<div class="form-group boot_sp">
								<label class="" for="State">State</label>
								<select id="state" name="state" class="form-control box_in3" >
									<?php if($states) { foreach($states as $state) { ?>
									  <option <?= ($datas->state == $state->id )?'selected':'' ?> value="<?= $state->id ?>"><?= $state->name ?></option>
									<?php } } ?>
							    </select>
								
							</div>
							<div class="form-group boot_sp">
								<label class="" for="City">City</label>
								<select id="city" name="city" class="form-control box_in3" >
                                   	<option value="">Select City</option>
    							    <option value="<?=$datas->city?>" selected><?= $datas->city_name ?></option>
									 
								</select>
								
							</div>
							 

							<div class="form-group boot_sp">
								<label class="" for="Pin">Pin Code</label>
								<input type="text" id="pin" name="pin" value="<?= $datas->pin ?>" class="form-control box_in3">

							</div>
							
							<div class="form-group boot_sp">
								<label class="" for="Pin">GSTIN (optional)</label>
								<input type="text" id="gstin" name="gstin" value="<?= $datas->gstin ?>" class="form-control box_in3">

							</div>
							
							<div class="form-group boot_sp">
								<label class="" for="Pin">Profile Pic</label>
								<input type="file" name="image" class="form-control box_in3">
								
							</div>
							
							 
							
							
							
							

						</div>

					  
					<hr>
					  <div class="col-sm-12 text-center">

						<input type="submit" value="Update Now" class="sub" >

					  </div>

					  

					</div>

				<?= form_close(); ?>	

				</div>

			</div>

		</div>

	</div>
</div>

<script>

$(document).ready(function(){
	$('#state').on('change',function() {
	    var state_id = $(this).val();
	    if(state_id) {
	      	$.ajax({

	            type:'POST',

	            url:"<?= base_url('city-data'); ?>",

	            data:'state_id='+state_id,

	            success:function(html){

	                console.log(html);

	                $('#city').html(html);

	            }
	        }); 
		} else {

		      $('#city').html('<option value="">Select state first</option>');
		}
	});
});

 

</script>



</body>

</html>

