<?php  $this->load->view('front/template/header'); ?>

<?php

	$segment1 = $this->uri->segment(1);

	$segment2 = $this->uri->segment(2);

	$segment3 = $this->uri->segment(3);

	$segment4 = $this->uri->segment(4);

?>
<style>
    footer{display:none;}
    .my_header {position: relative!important;}
</style>
<div class="my_login_part new_bg_color">

	<div class="container">

		<div class="login">

			<?= form_open_multipart('',['id'=>'loginForm','name'=>'loginForm','method'=>'post']) ?>

	      		<div class="row m-0 justify-content-between align-items-center">

					<div class="col-sm-4">

						<div class="login_form jogi_log">

							<div class="col-sm-12 mb-3">

								<div class="logo_p">

									<div class="col-12 sign_into"><?php echo ($seoData->content);?></div>

									<p class="mt-2 cop_account">Dont have a corporate account? <a target="_blank" href="<?=base_url('corporate-registration')?>" class="cop_login">Register now</a></p>

									

								</div>

							</div>

							<div class="clearfix"></div>

						  	<div class="col-sm-12 text-center">

						  		<div class="logo_p  mb-2"><?= $this->session->flashdata('login_message'); ?></div>
                                
						  	</div>

							<div class="clearfix"></div>

							<div class="fg_gp">

								<i class="fa fa-envelope-o"></i>

								<input id="userEmail" name="userEmail" type="text" placeholder="Email Address" class="box_new">

								<div id="email_err"></div>

							</div>

							<div class="fg_gp">

								<i class="fa fa-lock"></i>

								<input id="password" name="userPassword" type="password" placeholder="Password" class="box_new">

								<i class="toggle-password fa fa-fw fa-eye-slash"></i>

								<div id="password_err"></div>

							</div>

						 	<div class="fg_gp font14">

								<input name="name" type="checkbox"> Remember me

								<span><a href="<?= base_url('forgot-password') ?>">Forgot password?</a></span>

							</div>

						 	<div class="row m-0">

								<div class="col-6 text-center  mt-3 paddleft">

									<input type="submit" value="LOGIN" class="action_bt4 w100 font16">

								</div>

								 

								<input type="hidden" name="lastPage" value="<?=$lastPage?>">

							</div>

							<!-- <div class="col-sm-12 text-center mt-4">Have a corporate account? <a href="<?php echo base_url('corporate-login'); ?>" class="red_login">Login here</a></div> -->



						</div>



					</div>

					<div class="col-sm-4 mobile_off">

						<div class="get_new_sty">

							<?php 

						        $img =  'assets/images/'.$this->site->logo; 

						        $path = 'assets/images/'; 

						        $image = $seoData->image;

						        if(!empty($image))  { 



						            $img1 =  $path.$image; 



						            if (file_exists($img1)) {



						                $img = $img1;



						            }



						        }

					        ?>



							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img); ?>" class="img-fluid">

							<?php echo ($seoData->content2);?>

						</div>

					</div>



				</div>

			<?= form_close(); ?>

		</div>

	</div>

</div>

<?php  $this->load->view('front/template/footer'); ?>

<script type="text/javascript">

	$(document).ready(function() {

	

		$('#loginForm').on('submit',function(e){

		    e.preventDefault();



	      $('#email_err').html('');

	      $('#password_err').html('');

	     

	      if($('#userEmail').val() == '') {

	          $('#email_err').html('<span class="text-danger">Please enter username</span>');

	          $('#userEmail').focus();

	          return false; 

	      }else if ($('#password').val() == '' || $('#password').val().trim().length == '') { 

	        $('#password_err').html('<span class="text-danger">Please enter password</span>') 

	        $('#password').focus();

	        return false; 

	      /*}else if (!$('input[name="user_type"]:checked').val()) { 

	        $('#user_type_err').html('<span class="text-danger">Please Select User Type</span>') 

	        return false; 

	      */}else{

	        $('#loginForm').get(0).submit();

	        return true;

	      }

	  

		});    

	   

	});



   

   

</script>



