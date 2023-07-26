<?php $this->load->view('Page/template/head'); ?>
<style type="text/css">

</style>
	<div class="login-bg">
<div class="middle_part_p">

	<div class="container">
	
	
		<div class="row">
			<div class="col-12 col-lg-7 l_box p-0">
				<div class="row align-items-center m-0">
					
					

					<div class="col-sm-8 p-0">
						 <div class="backtohome"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="300px"></a> <hr></div>


						 <?= form_open_multipart('',['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
			            <?php //echo form_open('user/login-process') ?>
						<div class="row m-0">
							<div class="login_form">
							<div class="col-sm-12"><div class="logo_p text-center mb-5"><h2><b>User Login</b></h2><p>Please login below account detail </p></div></div>
							<div class="col-sm-12"><div class="logo_p text-left mb-4"><?php if($this->session->flashdata('login_message')){echo $this->session->flashdata('login_message');} ?></div></div>
							<div class="col-sm-12">
								<div class="form-group boot_sp jogi_log">
									<label class="" for="fname">Email</label>
									<input type="text" id="email" name="userEmail" value="" class="form-control box_new_2">
									<div id="email_err"></div>
								</div>
								
							</div>
							
							<div class="col-sm-12">
								<div class="form-group boot_sp jogi_log">
									<label class="" for="Password">Password</label>
									<input type="Password" id="password" name="userPassword" value="" class="form-control box_new_2">
									
									<div id="password_err"></div>
								</div>
								
							</div>
							
							<div class="col-sm-12 mb-3 text-center">
								<a href="<?= base_url('user/forgot-password') ?>" class="text-dark">Forgot Password?</a>
							</div>
							<div class="col-sm-12 text-center">
								<input type="submit" value="SUBMIT" class="login-sub">
							</div>
							<input type="hidden" name="lastPage" value="<?=$lastPage?>">
							
							<div class="col-sm-12 text-center mt-3 p-0">
								<p>If  you don't have an account please 
								<a href="<?= base_url('user/registration') ?>" class="create">Create Account</a> </p>
							</div>
							</div>
						</div>
						<?= form_close(); ?>
					</div>

					<div class="col-sm-4 p-0">
						<div class="login-box text-center">
							<div class="mb-3"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/login-img.png" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
			
		</div>
	
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	
		$('#ask-quote').on('submit',function(e){
		    e.preventDefault();

	      $('#email_err').html('');
	      $('#password_err').html('');
	     
	      if($('#email').val() == '') {
	          $('#email_err').html('<span class="text-danger">Please enter username</span>');
	          $('#email').focus();
	          return false; 
	      }else if ($('#password').val() == '' || $('#password').val().trim().length == '') { 
	        $('#password_err').html('<span class="text-danger">Please enter password</span>') 
	        $('#password').focus();
	        return false; 
	      }else{
	        $('#ask-quote').get(0).submit();
	        return true;
	      }
	  
		});    
	   
	});

  $('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    })
    function validateAlphabet(value) {         
        var regexp = /^[a-zA-Z ]*$/;         
        return regexp.test(value);    
    }
  function checkWord(id,count){
    var words= $('#'+id).val().length;
      if (words > count) {
        $('#'+id+'_err').html('');
      }else{
        $('#'+id+'_err').html('<span class="text-danger">' + (words + 1) + ' character. Please enter minimum '+count + ' character.</span>');
         
      }
      
    }
  function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
  }
</script>

