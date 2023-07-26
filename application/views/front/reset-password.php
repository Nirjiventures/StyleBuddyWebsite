<?php  $this->load->view('front/template/header'); ?>

<?php

	$segment1 = $this->uri->segment(1);

	$segment2 = $this->uri->segment(2);

	$segment3 = $this->uri->segment(3);

	$segment4 = $this->uri->segment(4);

?>



<div class="my_login_part_new">

    <div class="container">

        <div class="login ">

        	<div class="row login_form justify-content-between">

	        	

	        	<div class="col-md-4 mb70">

					 
					<?= form_open('',['id'=>'register','name'=>'register']) ?>
						<div class="row login_form">
							<div class="col-sm-12"><div class="logo_p text-center mb-3"><h4>Reset Password</h4></div></div>
							<div class="col-sm-12">
								<p>
									<?php  

										if($this->session->flashdata('message')){

											$m = $this->session->flashdata('message');

											echo $m['message'];

										}

									?>

								

								</p>

							</div>

							<?php //if(!$this->session->flashdata('success')){ ?>

								<div class="col-sm-12 ">

									<div class="fg_gp boot_sp">

										<input id="password" name="password" type="password" class="form-control box_new" value ="<?php if(set_value('password')) { echo set_value('password');}?>" placeholder="Password">
										<i class="fa fa-lock"></i>
                                		<i class="toggle-password fa fa-fw fa-eye-slash"></i>
										<div class="eye" id="password_eye" onclick="showHidePassword('password','password_eye')"></div>
										<div id="password_err"></div>
									</div>
									
								</div>

								<div class="col-sm-12 ">

									<div class="fg_gp boot_sp">

										<input id="confirm_password" name="confirm_password" type="password" class="form-control box_new" value ="<?php if(set_value('confirm_password')) { echo set_value('confirm_password');} ?>"  placeholder="Confirm Password">
										<i class="fa fa-lock"></i>
                                		<i class="toggle-password fa fa-fw fa-eye-slash"></i>
										<div class="eye" id="confirm_password_eye" onclick="showHidePassword('confirm_password','confirm_password_eye')"></div>
										<div id="confirm_password_err"></div>
									</div>
									
								</div>

								<div class="col-sm-12 ">

									<div class="fg_gp boot_sp">

										<label class="form-control-placeholder2" for="fname">OTP</label>

										<input name="otp" id="otp" type="text" class="form-control box_new3" value ="<?php if(set_value('otp')) { echo set_value('otp');}  ?>"  placeholder="OTP">
										<div id="otp_err"></div>
									</div>
									
								</div>

								<br/>

								<div class="col-sm-12 ">

									<input type="submit" value="Submit" class="action_bt4 ">

								</div>

							<?php //} ?>

						</div>

					<?= form_close(); ?>

				</div>
                
                <div class="col-sm-4">
						<div class="get_new_sty">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid">
							<p>Get Styled.<br> Be more Fashionable.</p>
						</div>
					</div>
                
			</div>

		</div>

	</div>

</div>

<?php  $this->load->view('front/template/footer'); ?>

<script type="text/javascript">
	$(document).ready(function(){
        $('#register').on('submit',function(e) {
            e.preventDefault();
            var error;
            $('#password_err').html('');
            $('#confirm_password_err').html('');
            $('#otp_err').html('');
    

            if($('#password').val() == '') {
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
            } else if($('#confirm_password').val() == '') {
                $('#confirm_password_err').html('<span class="text-red">Please enter confirm password</span>');
                $('#confirm_password').focus();
                return false; 
            }else if ($('#password').val() != $('#confirm_password').val()) { 
    			$('#confirm_password_err').html('<span class="text-red">Password did not match: Please try again...</span>') 
    			$('#confirm_password').focus();
    			return false; 
            }else if ($('#otp').val() == '') { 
                $('#otp_err').html('<span class="text-red">Please enter otp</span>') 
                $('#otp').focus();
                return false; 
            }else {
                $('#register').get(0).submit();
				return true;
            }
        });
    
    });
	 

</script>



