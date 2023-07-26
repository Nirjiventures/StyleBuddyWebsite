<?php 
$this->load->view('Page/template/head');
?>

	<div class="login-bg">
<div class="middle_part">

	<div class="container">
	
	
		<div class="row">
			<div class="col-sm-7 l_box p-0">
				<div class="row align-items-center justify-content-center">
					<!--<div class="col-sm-6">
						<div class="login-box text-center">
							<div class="mb-3"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/login-img.png">
						</div>
					</div>-->
					<div class="col-sm-6">
					    <div class="mb-5 text-center"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
			           <?= form_open('',['id'=>'reset-password']) ?>
						<div class="row">
							<div class="login_form">
							<div class="col-sm-12"><div class="logo_p text-left mb-5" id="rrmessage"></div></div>    
							<div class="col-sm-12"><div class="logo_p text-center mb-5"><h4>Stylist Forgot Password </h4></div></div>
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<input type="email" id="email" name="email" value="" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Enter Email</label>
									<div id="email_err"></div>
								</div>
							</div>
							
							<div class="col-sm-12 text-center">
								<input type="submit" value="SUBMIT" class="login-sub">
							</div>
							<div class="col-sm-12 text-center mt-3">
								<p>if you have an account please
								<a href="<?= base_url('login') ?>" class="create">Login</a> </p>
							</div>
							</div>
						</div>
					   <?= form_close(); ?>	
					</div>
				</div>
			</div>
			
		</div>
	
	</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    
    $('#reset-password').on('submit',function(e){
        
        e.preventDefault();  
        var email = $('#email').val();
        var error;
        
          if(email == ''|| email[0] == ' '){
                $('#email').addClass("box_in3_err");
                error = true;
            }else if((IsEmail(email)==false)) {
                 $('#email').addClass("box_in3_err");
                 error = true;
            }else {
                $('#email').removeClass("box_in3_err");
                error = false;
            }
            
            if(error === false) {
              $.ajax({
                  url: "reset-password",
                  type:"POST",
                  dataType:"json",
                  data: { email:email}, 
                  success: function(data)
                  {  
	                    if(data.error) {
    	                 
                            if(data.email_err !== '') {
                                $('#email_err').html(data.email_err);
                                $('#email_err').delay(2500).fadeOut('slow');
                                } else {
                                $('#email_err').html('');
                                }
	                    }
	                    if(data.success) {
                                 $('#email_err').html('');
                                 $('#reset-password')[0].reset();
                                 //$('#registerMessage').modal('show');
                                 $('#rrmessage').html(data.success);
                                  $('#rrmessage').delay(2500).fadeOut('slow');
                                 setTimeout(function() { window.location.href = "login" },3000);
                                }
                  }
              });
          }  
    });
    
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) { return false; } else { return true; }
    }     
    
});

</script>


