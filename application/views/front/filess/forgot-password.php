<?php  $this->load->view('Page/template/header'); ?>
<style type="text/css">
	.login-sub {
    background: #f62ac1;
    color: #fff;
  }
	.top_bar{
		display: none;
	}
	@media(max-width: 768px){
		.top_bar{
			display: block;
		}
	}
</style>
<div class="login-bg">
	<div class="middle_part">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 l_box p-0">
					<div class="row align-items-center justify-content-center">
						
						<div class="col-sm-6">
						    <div class="mb-5 text-center m_none"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
						    
				            <?= form_open('',['id'=>'forgot-process']) ?>
							<div class="row">
								<div class="login_form">
								<div id="rrmessage"><?php echo $this->session->flashdata('success')?></div>    
								<div class="col-sm-12"><div class="logo_p text-center mb-5"><h4>Forgot Password </h4></div></div>
								<div class="col-sm-12">
									<div class="form-group boot_sp">
										<label class="form-control-placeholder2" for="fname">Enter Email</label>
										<input type="email" id="email" name="email" class="form-control box_in3">
										<div id="email_err"></div>
									</div>
								</div>
								
								<div class="col-sm-12 text-center">
									<input type="submit" value="Recover Password" class="login-sub">
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

