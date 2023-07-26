<?php  $this->load->view('front/template/header'); ?>

<div class="my_login_part_new">
	<div class="container">
		<div class="login">
			<div class="login_form jogi_log">
			<div class="row align-items-center justify-content-between">
				
				
				    
				 	<div class="col-sm-4 ">
						<?= form_open('',['id'=>'forgot-process']) ?>
					 		<div class="logo_p  mb-3"><h4>Forgot Password </h4></div>
							<div id="rrmessage"><?php echo $this->session->flashdata('success')?></div>    
							<div class="fg_gp">
								<input type="text" id="email_forgot" name="email" placeholder="Email Address" class="box_new">
								<i class="fa fa-envelope-o"></i>
								<div id="email_err"></div>
							</div>

							<div class="col-sm-12  mt-3">
								<input type="submit" value="Recover Password" class="action_bt4">
							</div>
							<div class="col-sm-12  mt-3">
								<p>if you have an account please
								<a href="<?= base_url('login') ?>" class="create">Login</a> </p>
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
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    
	    $('#forgot-process').on('submit',function(e){
	        
	        e.preventDefault(); 

	          $('#email_err').html('');
		      if($('#email_forgot').val() == '') {
		          $('#email_err').html('<span class="text-danger">Please enter email</span>');
		          $('#email_forgot').focus();
		          return false; 
		      } else if(!IsEmail($('#email_forgot').val())) {
		          $('#email_err').html('<span class="text-danger">Please enter correct email</span>');
		          $('#email_forgot').focus();
		          return false; 
		      }else{
		        $('#forgot-process').get(0).submit();
		        return true;
		      }

	    });
	    
	      
	    
	});

</script>
<?php  $this->load->view('front/template/footer'); ?>
