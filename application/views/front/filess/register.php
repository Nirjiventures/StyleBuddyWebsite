<?php  $this->load->view('Page/template/header'); ?>
<?php 	if($this->session->flashdata('register_message_success') || $this->session->flashdata('register_message_success')) { ?>
    	<script type="text/javascript">
			$(document).ready(function(){
				$("#registerMessage____").modal('show');
				 setTimeout(function() { window.location.href = "<?=base_url('login')?>" },3000);
			}); 
		</script>
		<style type="text/css">
			#registerMessage____ .modal-content {
			    background: #fff;
			    text-align: center;
			}
		</style>
		<div class="modal" id="registerMessage____" aria-modal="true" >
		  	<div class="modal-dialog  modal-dialog-centered">
			    <div class="modal-content">
			    	<div class="col-sm-12 text-center had_pink">Response</div>
			        <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
			       	<div class="modal-body ">
			       		<div class="">
			       			<?php echo $this->session->flashdata('register_message_success')?>
			        	</div>
			        </div>
			    </div>
		  	</div>
		</div>	

<?php 	} ?>
<style type="text/css">
	.check-align{
		display: flex;
	}
	.check-align input{
		width: 30px;
		height: 40px;
		margin-right: 10px;
	}
	.check-align p{
		font-size: 14px;
    margin-bottom: 17px;
    margin-top: 6px;
	}
	.check-align p a{
		color: blue!important;
	}
	.check-aligns p{
		font-size: 12px;
	}
	.check-aligns p a{
		color: blue!important;
	}
	.form-group {
	    position: relative;
	    margin-bottom: 1rem!important;
	}
	.top_bar{
		display: none;
	}
	.check-aligns p {
    margin-bottom: 0px;
    }
	@media(max-width: 768px){
		.top_bar{
			display: block;
		}
	}
	@media(max-width: 380px){
		.reg-users{
			margin-top: 60px;
		}
	}
</style>
<div class="login-bg2">
    <div class="register_part">
    
    	<div class="container">
    	
    	
    		<div class="row1">
    			
    			<div class="col-12   p-0 reg-users">
    				<div class="row align-items-center m-0 justify-content-center">
    					
    					<div class="col-sm-8 p-0">
                            <div class="mb-3 mt-3 text-center m_none"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
                        
    			            <?= form_open(base_url().'user/registration',['id'=>'register','name'=>'register']) ?>
    						<div class=" m-0">
    							<div class="row login_form jogi_log">
    							
    							<div class="col-sm-12"><div class="logo_p text-center mt-3 mb-3"><h2><b>Create User Account</b></h2></div></div>
    							<div id="rrmessage" class="text-center mb-3"></div>
    							<?php if($this->session->flashdata('imgBerror_') || $this->session->flashdata('imgBerror_')) { ?>
    							    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror_') ?></div>
    							<?php } ?>
    							
    							<div class="col-sm-6">
    								<div class="form-group boot_sp">
    									<label class="" for="fname">First Name</label>
    									<input type="text" id="fname" name="fname" value="" class="form-control box_new_2">
    									<div id="fname_err"></div>
    								</div>
    							</div>
    							<div class="col-sm-6">
    								<div class="form-group boot_sp">
    									<label class="" for="fname">Last Name</label>
    									<input type="text" id="lname" name="lname" value="" class="form-control box_new_2">
    									<div id="lname_err"></div>
    								</div>
    							</div>
    				
    							<div class="col-sm-12">
    								<div class="form-group boot_sp">
    									<label class="" for="fname">Enter Email</label>
    									<input type="email" id="email" name="email" value="" class="form-control box_new_2">
    									<div id="email_err"></div>
    								</div>
    							</div>
    							
    							<div class="col-sm-12">
    								<div class="form-group boot_sp">
    									<label class="" for="Password">Password</label>
    									<input type="Password" id="pass" name="password" value="" class="form-control box_new_2">
    									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
    									<div id="password_err"></div>
    								</div>
    							</div>
    							
    							<div class="col-sm-12">
    								<div class="form-group boot_sp">
    									<label class="" for="Password">Confirm Password</label>
    									<input type="Password" id="repass" name="con_password" value="" class="form-control box_new_2">
    									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
    									<div id="repasser"></div>
    								</div>
    							</div>
    							<div class="col-md-5">
    			                	<input  type="text" id="captcha" name="captcha" value="" placeholder="Enter captcha Code" class="form-control box_in3">
    			                	<div id="captcha_err"></div>
    			                	<input  type="hidden" id="captcha_v" name="captcha_v" value="">
    							</div>
    			                <div class="col-md-7">
    								<span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><i class="fa fa-refresh" aria-hidden="true" style="margin-left: 20px;"></i></a>
    							</div>
    							
    							<div class="col-sm-12 check-align"> 
    			                	<input type="checkbox" id="terms" name="terms"> <p>Create an account means you are okay with our  <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</p>
    			                	<div id="terms_err"></div>
    			                </div>
    							<div class="col-sm-12">
    								<input type="submit" value="Create Account" class="login-sub">
    							</div>
    					        <?= form_close(); ?>
    							
    							<div class="col-sm-12 mt-3 check-aligns">
    								<p>This site is protected by reCAPTCHA and the Google <a href="">Privacy Policy</a> and <a href="">Terms of Service</a> apply<!--  if you have an account please
    								<a href="<?= base_url('login') ?>" class="create">Login</a> --> </p>
    							</div>
    							
    							</div>
    						</div>
    						
    					</div>
    
    					<!--<div class="col-sm-4 p-0">
    						<div class="login-box  text-center login_lg">
    							<div class="mb-3"><a href="<?= base_url() ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/logo.png" width="200px"></a></div>
    							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/login-img.png" class="img-fluid">
    						</div>
    					</div>-->
    
    				</div>
    			</div>
    			
    		</div>
    	
    	</div>
	</div>
</div>
<?php   $this->load->view('Page/template/footer'); ?>
<style type="text/css">

	.text-red{

		color: #bd1f1f!important;

	}

</style>
<script type="text/javascript">

    $(document).ready(function() {
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
        $('#register').on('submit',function(e) {
            e.preventDefault();
            
           let fname = $('#fname').val();    
           let lname = $('#lname').val();        
           let email = $('#email').val();
           let password = $('#pass').val();
           let repass = $('#repass').val();
           var psslen = password.length;
           var error;
           
             $('#fname_err').html('');

            $('#lname_err').html('');
    
            $('#email_err').html('');
    
            $('#password_err').html('');
    
            $('#repasser').html('');
    

            if($('#fname').val() == '') {

                $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
    
                $('#fname').focus();
    
                return false;
    
            } else if($('#lname').val() == '') {
    
                $('#lname_err').html('<span class="text-red">Please enter your Last Name</span>');
    
                $('#lname').focus();
    
                return false;
    
            } else if($('#email').val() == '') {
    
                $('#email_err').html('<span class="text-red">Please enter email</span>');
    
                $('#email').focus();
    
                return false; 
    
            } else if(!IsEmail($('#email').val())) {
    
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
    
                $('#email').focus();
    
                return false; 
    
            } else if($('#pass').val() == '') {
    
                $('#password_err').html('<span class="text-red">Please enter password</span>');
    
                $('#pass').focus();
    
                return false; 
    
            } else if($('#pass').val().trim().length < 8) {
    
                $('#password_err').html('<span class="text-red">Please enter 8 character password</span>');
    
                $('#password').focus();
    
                return false; 
    
            } else if($('#repass').val() == '') {
    
                $('#repasser').html('<span class="text-red">Please enter confirm password</span>');
    
                $('#repass').focus();
    
                return false; 
    
            }else if ($('#pass').val() != $('#repass').val()) { 
    
    			$('#repasser').html('<span class="text-red">Password did not match: Please try again...</span>') 
    
    			$('#repass').focus();
    
    			return false; 
            }else if ($('#captcha').val() == '') { 
				$('#captcha_err').html('<span class="text-red">Please enter captcha</span>') 
				$('#captcha').focus();
				return false; 
			}else if ($('#captcha').val() != $('#captcha_v').val()) { 
				$('#captcha_err').html('<span class="text-red">Please enter correct captcha</span>') 
				$('#captcha').focus();
				return false; 
			}else {
                $('#register').get(0).submit();
				return true;
				
                /*$.ajax({
                  url: "<?=base_url()?>user/registration-process",
                  type:"POST",
                  dataType:"json",
                  data: { fname:fname, lname:lname, email:email, password:password, repass:repass }, 
                  success: function(data)
                  {  
                      console.log(data.error);
	                  console.log(data.success);
	                    if(data.error) {
    	                    
    	                    if(data.fname_err !== '') {
                             $('#fname_err').html(data.fname_err);
                             $('#fname_err').delay(2500).fadeOut('slow');    
                             } else {
                              $('#fname_err').html('');
                             }
                             if(data.lname_err !== '') {
                             $('#lname_err').html(data.lname_err);
                             $('#lname_err').delay(2500).fadeOut('slow');    
                             } else {
                              $('#lname_err').html('');
                             }
                            if(data.email_err !== '') {
                                $('#email_err').html(data.email_err);
                                $('#email_err').delay(2500).fadeOut('slow');
                                } else {
                                $('#email_err').html('');
                                }
                            if(data.password_err !== '') {
                                $('#password_err').html(data.password_err);
                                $('#password_err').delay(2500).fadeOut('slow');
                                } else {
                                $('#password_err').html('');
                                }          
	                    }
	                    if(data.success){
	                             console.log(data.success);     
                                 $('#user_err,#email_err,#password_err').html('');
                                 $('#register')[0].reset();
                                 //$('#registerMessage').modal('show');
                                 $('#rrmessage').html(data.success);
                                 setTimeout(function() { window.location.href = "<?=base_url('login')?>" },3000);
                                }
                  }
                });*/
            }
        });
    
    });
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
    
</script>



