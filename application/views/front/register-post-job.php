<?php  $this->load->view('front/template/header'); ?>
<div class="banner_inner">
    <div class="container">
        <h1>Register</h1>
        <a href="<?=base_url()?>">Home</a> > Register
    </div>
</div>
<div class="middle_part">
    <div class="container">
        <div class="login">
			<div class="col-12 text-center mb-4"><p><b>CREATE JOB POST USER ACCOUNT</b></p></div>
			<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
				<div id="rrmessage" class="text-center mb-3"></div>
				<?php if($this->session->flashdata('imgBerror_') || $this->session->flashdata('imgBerror_')) { ?>
				    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror_') ?></div>
				<?php } ?>

				 
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label for="fname">Company Name</label>
							<input type="text"  name="fname"  id="fname" value="<?= set_value('fname') ?>" class="box_new" onkeypress="return IsAlphaNumeric(event,'fname_err');">
							<div id="fname_err"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label for="fname">Official email</label>
							<input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="box_new" >
							<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
							<div id="email_err"></div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label for="mobile">Mobile / Landline*</label>
							<input type="text" id="mobile" name="mobile" value="<?= set_value('mobile') ?>" class="box_new onlyInteger">
							<div id="mobile_err"></div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label for="contact_person_name">Contact Person Name</label>
							<input type="text" id="contact_person_name" name="contact_person_name" value="<?= set_value('contact_person_name') ?>" class="box_new" onkeypress="return IsAlphaNumeric(event,'contact_person_name_err');">
							<div id="contact_person_name_err"></div>
						</div>
					</div>

					<div class="col-sm-12"><hr></div>

					<p>Company Type*</p>

					<div class="time_table" id="wrapper-radios4">
						<div class="radios">
							<input type="radio" value='Company' name='company_type' id='radio_time1'>
							<label for='radio_time1'><span>Company</span></label>
						</div>

						<div class="radios">
							<input type="radio" value='Consultant' name='company_type' id='radio_time2'>
							<label for='radio_time2'><span>Consultant</span></label>
						</div>
						<div id="company_type_err"></div>		
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="business_nature">Nature of Business</label>
							<select type="text" id="business_nature" name="business_nature" value="" class="box_new">
								<option>Fashion</option>
								<option>Movies</option>
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="pin_code">Country</label>
							<select class="form-control box_in3" name="country" id="country" >
							   <option  value="" >Select Country</option>
							   <?php if($country) { foreach($country as $state) { ?>
							        <option value="<?= $state->id ?>"><?= $state->name ?></option>
							   <?php }} ?>
							</select>
							<?php echo form_error('country','<span class="text-primary mt-1">','</span>') ;?>
							<div id="state_err"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="pin_code">State</label>
							<select class="form-control box_in3" name="state" id="state" >
							   <option  value="" >Select State</option>
							   <?php if($states) { foreach($states as $state) { ?>
							        <option value="<?= $state->id ?>"><?= $state->name ?></option>
							   <?php }} ?>
							</select>
							<?php echo form_error('state','<span class="text-primary mt-1">','</span>') ;?>
							<div id="state_err"></div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="pin_code">City</label>
							<select class="form-control box_in3"   name="city" id="city">
							   <option  value="">Select City <span class="text-danger">*</span></option>
							</select>
							<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>
							<div id="city_err"></div>
						</div>
					</div>

					

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="pin_code">Pin Code</label>
							<input type="text" id="pin" name="pin" value="<?= set_value('pin') ?>" class="box_new onlyInteger">
							<?php echo form_error('pin','<span class="text-primary mt-1">','</span>') ;?>
							<div id="pin_err"></div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="" for="gstin">GSTIN (optional)</label>
							<input type="text" id="gstin" name="gstin" value="<?= set_value('gstin') ?>" class="box_new onlyInteger">
							<?php echo form_error('gstin','<span class="text-primary mt-1">','</span>') ;?>
							<div id="gstin_err"></div>
						</div>
					</div>
					<div class="col-sm-12"> 
						<label class="" for="Password">Password </label>
						<div class="fg_gp">
							<input id="password" name="password" value="<?= set_value('password') ?>" minlength="8"  type="password" placeholder="Password" class="box_new">
							<i class="fa fa-lock"></i>
							<i class="toggle-password fa fa-fw fa-eye-slash"></i>
							<div id="password_err"><span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span></div>
						</div>
					</div>

					<p style="margin-bottom: 5px;"><input type="checkbox" name="promotional" id="promotional"> I agree to receive Promotional Communication from Stylebuddy</p>
					<p><input type="checkbox" name="terms" id="terms"> I agree to <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a target="_blank" href="<?=base_url('privacy-policy')?>">Privacy Policy</a></p>
					<div class="fg_gp inline">
	                    <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha Code" class="box_new_shot">
	                    <i class="fa fa-shield"></i>
	                    
	                    <div id="captcha_err"></div>
	                    <input  type="hidden" id="captcha_v" name="captcha_v" value="">
	                 
	                    <span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><div class="fa fa-refresh" aria-hidden="true"></div></a>
	                </div>

					

					<div class="col-sm-12 text-center">
						<input type="submit" value="REGISTER" class="subscribe_bt2">
					</div>
				</div>
			<?= form_close() ?>
					 
			 
		</div>
	</div>
</div>
<?php $this->load->view('front/template/footer'); ?>
<script type="text/javascript">
	$(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            pageLoad();
        });
    });
    function pageLoad(){
        $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
            console.log(data);
            result = $.parseJSON(data);
            $('#captImg').html(result.image);
            $('#captcha_v').val(result.word);
            
        });
    }
    window.onload = pageLoad;


    $('#registration-form').on('submit',function(e){
        e.preventDefault();
        $('#fname_err').html('');
        $('#email_err').html('');
        $('#password_err').html('');
        $('#mobile_err').html('');
        $('#state_err').html('');
        $('#city_err').html('');
        $('#experience_err').html('');
        $('#address_err').html('');
        $('#pin_err').html('');
        $('#instagram_nlink_err').html('');
        $('#about_err').html('');
        $('#more_about_err').html('');
        $('#title_err').html('');
        $('#content_err').html('');
        $('#expertise_err').html('');
        $('#terms_err').html('');
        $('#captcha_err').html('');
        var searchIDs = $("input.checkarray:checkbox:checked").map(function(){
	      return $(this).val();
	    }).get(); 
	     


        if($('#fname').val() == '' || $('#fname').val().trim().length == '') {
            $('#fname_err').html('<span class="text-red">Please enter your Company Name</span>');
            $('#fname').focus();
            return false;
        } else if($('#email').val() == '') {
            $('#email_err').html('<span class="text-red">Please enter email</span>');
            $('#email').focus();
            return false; 
        } else if(!IsEmail($('#email').val())) {
            $('#email_err').html('<span class="text-red">Please enter correct email</span>');
            $('#email').focus();
            return false; 
        }else if ($('#mobile').val() == '' || $('#mobile').val().trim().length == '') { 
			$('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 
			$('#mobile').focus();
			return false; 
		}else if ($('#state').val() == '' || $('#state').val().trim().length == '') { 
			$('#state_err').html('<span class="text-red">Please select state</span>') 
			$('#state').focus();
			return false; 
		}else if ($('#city').val() == '' || $('#city').val().trim().length == '') { 
			$('#city_err').html('<span class="text-red">Please enter select city</span>') 
			$('#city').focus();
			return false; 
		}else if ($('#pin').val() == '' || $('#pin').val().trim().length == '') { 
			$('#pin_err').html('<span class="text-red">Please enter pincode</span>') 
			$('#pin').focus();
			return false; 
		/*}else if ($('#gstin').val() == '' || $('#gstin').val().trim().length == '') { 
			$('#gstin_err').html('<span class="text-red">Please enter pincode</span>') 
			$('#gstin').focus();
			return false; 
		*/} else if($('#password').val() == '' || $('#password').val().trim().length == '') {
            $('#password_err').html('<span class="text-red">Please enter password</span>');
            $('#password').focus();
            return false; 
        } else if($('#password').val().trim().length < 8) {
            $('#password_err').html('<span class="text-red">Please enter 8 character password</span>');
            $('#password').focus();
            return false; 
        } else if(!checkPasswordValidation($('#password').val())) {
            $('#password_err').html('<span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span>');
            $('#password').focus();
            return false; 
        }else  if (!$('#terms:checked').val()) {
			$('#terms_err').html('<span class="text-red">Please checked terms</span>') 
			$('#terms').focus();
			return false;
		}else if ($('#captcha').val() == '') { 
			$('#captcha_err').html('<span class="text-red">Please enter captcha</span>') 
			$('#captcha').focus();
			return false; 
		}else if ($('#captcha').val() != $('#captcha_v').val()) { 
			$('#captcha_err').html('<span class="text-red">Please enter correct captcha</span>') 
			$('#captcha').focus();
			return false; 
		}else{
			$('#registration-form').get(0).submit();
			return true;
		}
    });
</script>