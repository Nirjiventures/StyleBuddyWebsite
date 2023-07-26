<?php  $this->load->view('Page/template/header'); ?>
<div class="container">
	<div class="josb_login">
		<a href="<?= base_url(); ?>page/postjoblogin">login </a>
		<a href="<?= base_url(); ?>page/postjobregister" class="act_job">Register</a>
	</div>


	<div class="row m-0 justify-content-center resgiter_from_job">
		<div class="col-sm-8">
			<div class="login_post">
				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
					<div class="row m-0">
						<div class="col-12 logo_p text-center mb-3">
							<h2><b>Register</b></h2><p>Please Register for job a post</p>
						</div>
						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label for="fname">Company Name</label>
								<input type="text"  name="fname"  id="fname" value="<?= set_value('fname') ?>" class="form-control box_new_2">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label for="fname">Official email</label>
								<input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control box_new_2" >
								<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
								<div id="email_err"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label for="mobile">Mobile / Landline*</label>
								<input type="text" id="mobile" name="mobile" value="<?= set_value('mobile') ?>" class="form-control box_new_2">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label for="contact_person_name">Contact Person Name</label>
								<input type="text" id="contact_person_name" name="contact_person_name" value="<?= set_value('contact_person_name') ?>" class="form-control box_new_2">
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
									
						</div>

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="business_nature">Nature of Business</label>
								<select type="text" id="business_nature" name="business_nature" value="" class="form-control box_new_2">
									<option>Fashion</option>
									<option>Movies</option>
								</select>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="pin_code">State</label>
								<select class="form-control box_new_2" name="state" id="state" >
								   <option  value="" >Select State</option>
								   <?php if($states) { foreach($states as $state) { ?>
								        <option value="<?= $state->id ?>"><?= $state->name ?></option>
								   <?php }} ?>
								</select>
								<?php echo form_error('state','<span class="text-primary mt-1">','</span>') ;?>
								<div id="state_err"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="pin_code">City</label>
								<select class="form-control box_new_2"   name="city" id="city">
								   <option  value="">Select City <span class="text-danger">*</span></option>
								</select>
								
								<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>
								<div id="city_err"></div>
							</div>
						</div>

						

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="pin_code">Pin Code</label>
								<input type="text" id="pin" name="pin" value="<?= set_value('pin') ?>" class="form-control box_new_2 onlyInteger">
							
								<?php echo form_error('pin','<span class="text-primary mt-1">','</span>') ;?>
								<div id="pin_err"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="gstin">GSTIN (optional)</label>
								<input type="text" id="gstin" name="gstin" value="<?= set_value('gstin') ?>" class="form-control box_new_2 onlyInteger">
								<?php echo form_error('gstin','<span class="text-primary mt-1">','</span>') ;?>
								<div id="gstin_err"></div>
							</div>
						</div>


						<div class="col-sm-6">
							<div class="form-group boot_sp">
								<label class="" for="Password">Password </label>
								<input type="Password" id="password" name="password" value="<?= set_value('password') ?>" minlength="8" class="form-control box_new_2" >
								<i class="toggle-password fa fa-fw fa-eye-slash"></i>
								<?php echo form_error('password','<span class="text-primary mt-1">','</span>') ;?>
								<div id="password_err"></div>
							</div>
						</div>

						<p style="margin-bottom: 5px;"><input type="checkbox" name="promotional" id="promotional"> I agree to receive Promotional Communication from Stylebuddy</p>
						<p><input type="checkbox" name="terms" id="terms"> I agree to <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a target="_blank" href="<?=base_url('privacy-policy')?>">Privacy Policy</a></p>

						<div class="col-md-3">
		                	<input  type="text" id="captcha" name="captcha" value="" placeholder="Enter captcha Code" class="form-control box_new_2">
		                	<div id="captcha_err"></div>
		                	<input  type="hidden" id="captcha_v" name="captcha_v" value="">
						</div>
		                <div class="col-md-6">
							<span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><i class="fa fa-refresh" aria-hidden="true" style="margin-left: 20px;"></i></a>
						</div>

						<div class="col-sm-12 text-center">
							<input type="submit" value="REGISTER" class="login-sub">
						</div>
					</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('Page/template/footer'); ?>
<script type="text/javascript">
	$('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    })
    function validateAlphabet(value) {         
        var regexp = /^[a-zA-Z ]*$/;         
        return regexp.test(value);    
    }
    function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
	$(document).on("blur","#email",function() {
      	var checkEmail = $(this).val();
        if(IsEmail(checkEmail)) { 
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>vendor/emailcheck',
                data: 'checkEmail='+checkEmail,
                success: function(data) {
                  if(data == 1) {
                     $('#email_err').html('<span class="text-primary">your email address is registered</span>');
                     $('#email').focus();
                     return false; 
                  } else {
                     $('#email_err').html(' '); 
                  }
               }
            });    
        }
    });
    
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
            $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
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