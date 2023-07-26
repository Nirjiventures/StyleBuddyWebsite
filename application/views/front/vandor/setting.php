<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">
	.fg_gp {
	  position: relative;
	  margin-bottom: 20px;
	}
	.fg_gp i {
	  position: absolute;
	  left: 10px;
	  top: 11px;
	}
	.toggle-password {
	  position: absolute;
	  right: -25px;
	  bottom: 11px;
	  left: auto !important;
	}
	.box_new {
	  width: 100%;
	  height: 40px;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  padding-left: 35px !important;
	}

</style>
<div class="main">
	<div class="container">
		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->
		<div class="col-sm-12">
			<div class="rightbar">
				<div class="row">
					<div class="col-sm-9">
						<h3>Update Password</h3>
					</div>
					<div class="col-sm-3 text-end">
						<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
						&nbsp; - &nbsp; 
						<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
					</div>
				</div>
				<hr>
				<h2></h2>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('updatePassword'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				<?= form_open('stylist-zone/setting',['id'=>'register','name'=>'register']); ?>
				<div class="row  justify-content-center">
				  	<div class="col-sm-7">
						<div class="chpass row m-0 justify-content-center">
							<p><b>Change Password</b></p>
							<br>
							<div class="col-sm-12">
								<div class="fg_gp">
	                                <i class="fa fa-lock"></i>
	                                <input id="current_password" name="currentPassword" type="password" placeholder="Enter Current Password" class="box_new form-control">
	                                <i class="toggle-password fa fa-fw fa-eye-slash" aria-hidden="true"></i>
	                                <?php echo form_error('currentPassword','<span class="text-danger mt-1">','</span>') ;?>
	                            </div>
							</div>
							<hr>
							<div class="col-sm-12 mt-4">
								<div class="fg_gp">
	                                <i class="fa fa-lock"></i>
	                                <input id="password" name="password" type="password" placeholder="Password" class="box_new form-control">
	                                <i class="toggle-password fa fa-fw fa-eye-slash" aria-hidden="true"></i>
	                                <?php echo form_error('password','<span class="text-danger mt-1">','</span>') ;?>
	                            </div>
	                        </div>
	                        <div id="password_err"><span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span></div>
	                        <div class="col-sm-12 mt-4">
	                            <div class="fg_gp">
	                                <i class="fa fa-lock"></i>
	                                <input id="c_password" name="cpassword" type="password" placeholder="Confirm Password" class="box_new form-control">
	                                <div id="c_password_err"></div>
	                                <i class="toggle-password fa fa-fw fa-eye-slash" aria-hidden="true"></i>
	                                <?php echo form_error('cpassword','<span class="text-danger mt-1">','</span>') ;?>
	                            </div>
							</div>
						  	<div class="col-sm-12">
								<input type="submit" value="Update Now" class="sub" >
						  	</div>
					  	</div>
				  	</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>


</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>
<script type="text/javascript">
	$(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
	function checkPasswordValidation(inputValue) {
        //To check a password between 7 to 16 characters which contain only characters, numeric digits, underscore and first character must be a
        //var passw =  /^[A-Za-z]\w{7,14}$/;

        //To check a password between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter
        //var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

        //To check a password between 7 to 15 characters which contain at least one numeric digit and a special character
        //var passw =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

        //To check a password between 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character
        var passw =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

        if(inputValue.match(passw)) { 
            return true;
        } else { 
            return false;
        }
    }
    $(document).ready(function(){
        
        $('#register').on('submit',function(e) {
            e.preventDefault();
            $('#current_password_err').html('');
            $('#password_err').html('');
            $('#c_password_err').html('');
            
            if($('#current_password').val() == '') {
                $('#current_password_err').html('<span class="text-red">Please enter old password</span>');
                $('#current_password').focus();
                return false;
            } else if($('#password').val() == '') {
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
            } else if($('#c_password').val() == '') {
                $('#c_password_err').html('<span class="text-red">Please enter confirm password</span>');
                $('#c_password').focus();
                return false; 
            }else if ($('#password').val() != $('#c_password').val()) { 
                $('#c_password_err').html('<span class="text-red">Password did not match: Please try again...</span>') 
                $('#c_password').focus();
                return false; 
            }else {
                $('#register').get(0).submit();
                return true;
            }
        });
    });
</script>