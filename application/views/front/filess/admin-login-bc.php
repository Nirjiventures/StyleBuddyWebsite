<?php //$this->load->view('Page/template/head'); ?>
<?php  $this->load->view('Page/template/header'); ?>
<style type="text/css">
.login-sub {
  background: #f62ac1;
  color: #fff;
}
.top_bar{
	display: none;
}
.cont-rd {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
    border-radius: 5px;
  padding: 11px 11px;
  background: var(--bg-light-shin);
  box-shadow: 1px 0px 5px 0px #0006;
  margin: 10px 5px;
  display: inline-block;
  font-size: 14px;
  padding-left: 30px;
}
.cont-rd input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}
.checkmark {
  position: absolute;
  top: 11px;
  left: 8px;
  height: 18px;
  width: 18px;
  background-color: #eee;
  border-radius: 50%;
}
.cont-rd:hover input ~ .checkmark {
  background-color: #ccc;
}
.cont-rd input:checked ~ .checkmark {
  background-color: #742ea0;
}
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}
.cont-rd input:checked ~ .checkmark:after {
  display: block;
}
.cont-rd .checkmark:after {
 	top: 5.5px;
  left: 5.5px;
  width: 7px;
  height: 7px;
	border-radius: 50%;
	background: white;
}
.boot_sp label.cont-rd{
	display: inline-block;
	    padding-top: 9px;
    padding-bottom: 9px;
}
@media(max-width: 768px){
	.top_bar{
		display: block;
	}
	.cont-rd .checkmark:after {
    top: 5px;
  }
}
</style>
<div class="login-bg">
	<div class="middle_part">

		<div class="container">
		
			<?php  $a = $this->uri->segment(1); ?>
			<div class="row m-0">
				<div class="col-12 col-lg-8 l_box p-0">
					<div class="row align-items-center m-0">
						
						<div class="col-sm-8 p-0">
						    <div class="backtohome"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="300px"></a><hr></div>
						    
							<?= form_open_multipart('',['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
				      <?php //echo form_open('user/login-process') ?>
							<div class="row m-0">
								<div class="login_form jogi_log">
									
								<div class="col-sm-12">
									<div class="logo_p text-center">
										<?php  if($a == 'boutiques'){ ?>
											<h2><b>Login</b></h2><p>Please login as a Boutique</p>
										<?php  }else{?>
											<h2><b>Login</b></h2><p>Please login as a User or as a Stylist</p>
										<?php  }?>
									</div>
								</div>
							  <div class="col-sm-12"><div class="logo_p text-left mb-2"><?= $this->session->flashdata('login_message'); ?></div></div>
								
								<div class="col-sm-12 text-center check_lls">
									<div class="form-group boot_sp">
										
										<?php  if($a == 'boutiques'){ ?>
												<label class="cont-rd">Boutique Login <input type="radio" name="user_type" value="4" class=""><div class="checkmark"></div></label>
										<?php  }else{?>
											<label class="cont-rd">User Login <input type="radio" name="user_type" value="3" class=""><div class="checkmark"></div></label>
											<label class="cont-rd">Stylist Login <input type="radio" name="user_type" value="2" class=""><div class="checkmark"></div></label>
										<?php  } ?>	

										 
									</div>
									<div id="user_type_err"></div>
								</div>

								<div class="col-sm-12">
									<div class="form-group boot_sp">
											<label class="" for="fname">User email</label>
										<input type="text" id="email" name="userEmail" value="" class="form-control box_new_2">
									
										<div id="email_err"></div>
									</div>
									
								</div>
								
								<div class="col-sm-12">
									<div class="form-group boot_sp">
										<label class="" for="Password">Password <a href="<?= base_url('forgot-password') ?>" class="text-dark">Forgot Password?</a></label>
										<input type="Password" id="password" name="userPassword" value="" class="form-control box_new_2">
										
										<div id="password_err"></div>
									</div>
									
								</div>
								
								<!--<div class="col-sm-12 text-center check_lls d-dk">
									<div class="form-group boot_sp">
										<?php  if($a == 'boutiques'){ ?>
												<span><input type="radio" name="user_type" value="4" class="">&nbsp;Boutique Login</span>
										<?php  }else{?>
											<span><input type="radio" name="user_type" value="3" class="">&nbsp;User Login &nbsp;&nbsp;&nbsp;&nbsp;</span>
											<span><input type="radio" name="user_type" value="2" class="">&nbsp;Stylist Login</span>
										<?php  } ?>	
									</div>
									<div id="user_type_err"></div>
								</div>-->
								
								<div class="col-sm-12 mb-3 text-center">
									
								</div>
								<div class="col-sm-12 text-center">
									<input type="submit" value="LOGIN" class="login-sub">
								</div>
								<input type="hidden" name="lastPage" value="<?=$lastPage?>">
								
								<div class="col-sm-12 text-center mt-3">
									<?php  if($a == 'login'){ ?>
								    <p><b>Create an account as 
								    <a href="<?= base_url('stylist-zone/registration') ?>" class="create">Stylist</a> or <a href="<?= base_url('user/registration') ?>" class="create">User</a>.</b></p>
									 <?php  } ?>
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
	      }else if (!$('input[name="user_type"]:checked').val()) { 
	        $('#user_type_err').html('<span class="text-danger">Please Select User Type</span>') 
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

