<?php  $this->load->view('front/template/header'); ?>
<?php
	$segment1 = $this->uri->segment(1);
	$segment2 = $this->uri->segment(2);
	$segment3 = $this->uri->segment(3);
	$segment4 = $this->uri->segment(4);
?>
<style>
    footer{display:none;}
</style>
<div class="my_login_part">
	<div class="container">
		<div class="login">
			<?= form_open_multipart('',['id'=>'loginForm','name'=>'loginForm','method'=>'post']) ?>
	      		<div class="row m-0 justify-content-between align-items-center">
					<div class="col-sm-4">

						<?php 	if ($this->session->flashdata('register_message')) { ?>
							<script type="text/javascript">
								$(document).ready(function(){
									$("#festivalPopup").modal('show');
								});
							</script>
							<div class="modal" id="festivalPopup" data-bs-backdrop="static" aria-modal="true" >
							  	<div class="modal-dialog modal-lg modal-dialog-centered">
								    <div class="modal-content">
								      	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								       	<div class="modal-body text-center">
								        	<h2><?php echo $this->session->flashdata('register_message')?></h2>
								        </div>
								    </div>
							  	</div>
							</div>
						<?php 	}	?>

						<div class="col-12 text-center sign_into"><b>SIGN INTO YOUR ACCOUNT</b></div>
						<div class="login_form jogi_log">
							<div class="login_post mt-5">
								<div class="col-12 logo_p text-center">
									<p class="login_as">Please login as a boutique user</p>
								</div>
								<div class="col-sm-12"><div class="logo_p text-left mb-2"><?= $this->session->flashdata('login_message'); ?></div></div>
								<input type="hidden" name="user_type" value="5" class="">
								 
								<div class="fg_gp">
									<input id="userEmail" name="userEmail" type="text" placeholder="Email Address" class="box_new">
									<i class="fa fa-envelope-o"></i>
									<div id="email_err"></div>
								</div>
							

								<div class="fg_gp">
									<input id="password" name="userPassword" type="password" placeholder="Password" class="box_new">
									<i class="fa fa-lock"></i>
									<i class="toggle-password fa fa-fw fa-eye-slash"></i>
									<div id="password_err"></div>
								</div>

								<div class="col-sm-12 text-center  mt-3 paddleft">
									<input type="submit" value="LOGIN" class="subscribe_bt2">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="get_new_sty">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid">
							<p>Get Styled.<br> Be more Fashionable.</p>
						</div>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>


<?php $this->load->view('front/template/footer'); ?>
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



