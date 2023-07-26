<?php  $this->load->view('Page/template/head'); ?>
<div class="login-bg">
	<div class="middle_part">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 l_box p-0">
					<div class="row align-items-center">
						<div class="col-sm-6">
							<div class="login-box text-center">
								<div class="mb-3"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/login-img.png">
							</div>
						</div>
						<div class="col-sm-6">
							<form method="post" name="loginForm"  onSubmit = "return checkPassword(this)" >

								<div class="row login_form">
									<div class="col-sm-12"><div class="logo_p text-center mb-5"><h4>Reset Password</h4></div></div>
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
										<div class="form-group boot_sp">
											<label class="form-control-placeholder2" for="fname">Password</label>
											<input id="password" name="password" type="password" class="form-control box_in3" value ="<?php if(set_value('password')) { echo set_value('password');}?>" required placeholder="Password">
											<div class="eye" id="password_eye" onclick="showHidePassword('password','password_eye')"></div>
										</div>
									</div>
									<div class="col-sm-12 ">
										<div class="form-group boot_sp">
											<label class="form-control-placeholder2" for="fname">Confirm Password</label>
											<input id="confirm_password" name="confirm_password" type="password" class="form-control box_in3" value ="<?php if(set_value('confirm_password')) { echo set_value('confirm_password');} ?>" required  placeholder="Confirm Password">
											<div class="eye" id="confirm_password_eye" onclick="showHidePassword('confirm_password','confirm_password_eye')"></div>
										</div>
									</div>
									<div class="col-sm-12 ">
										<div class="form-group boot_sp">
											<label class="form-control-placeholder2" for="fname">OTP</label>
											<input name="otp" type="text" class="form-control box_in3" value ="<?php if(set_value('otp')) { echo set_value('otp');}  ?>" required  placeholder="OTP">
										</div>
									</div>
									<br/>
									<div class="col-sm-12 text-center">
										<input type="submit" value="Submit" class="login-sub">
									</div>
								<?php //} ?>
								</div>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>
	</div>
</div>
<script type="text/javascript">
	function checkPassword(form) { 
		email = form.email.value; 
		password1 = form.password.value; 
		password2 = form.confirm_password.value; 
		
		if( email == '') { 			
			alert('Please enter Email Id');				
			return false;		
		}else if( !IsEmail(email)) { 			
			alert('Please enter valid Email Id');				
			return false;		
		}else  if (password1 == ''){ 
			alert ("Please enter Password"); 
			return false; 
		}
		else if (password2 == ''){ 
			alert ("Please enter confirm password"); 
			return false; 
		}
		else if (password1 != password2) { 
			alert ("\nPassword did not match: Please try again...") 
			form.confirm_password.focus(); 
			return false; 
		} 
		else{ 
			return true; 
		}
	} 

	$(document).ready(function() {
	    
	    $('#forgot-process').on('submit',function(e){
	        
	        e.preventDefault(); 

	          $('#email_err').html('');
		      if($('#email').val() == '') {
		          $('#email_err').html('<span class="text-danger">Please enter email</span>');
		          $('#email').focus();
		          return false; 
		      } else if(!IsEmail($('#email').val())) {
		          $('#email_err').html('<span class="text-danger">Please enter correct email</span>');
		          $('#email').focus();
		          return false; 
		      }else{
		        $('#forgot-process').get(0).submit();
		        return true;
		      }

	    });
	    
	    function IsEmail(email) {
	        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	        if(!regex.test(email)) { return false; } else { return true; }
	    }     
	    
	});

</script>

