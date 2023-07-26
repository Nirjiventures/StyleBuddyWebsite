<?php  $this->load->view('front/template/header'); ?>
<?php
    $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2);
    $segment3 = $this->uri->segment(3);
    $segment4 = $this->uri->segment(4);
?>
<style type="text/css">

    .text-red{color: #bd1f1f!important;}

   
       span#captImg img {
            position: relative;
            left: 0px;
            width: 100%!important;
            margin-right: 0px;
        }
        
        .fa.fa-refresh {
            position: absolute;
            right: -25px;
            top: 11px;
        }
        
        .my_header {position: relative!important;}

        @media screen and (min-width: 200px) and (max-width: 767px) {
        .my_header {position: relative!important;}

        }
    
        footer{display:none;}

</style>
<?= form_open(base_url().'user/registration',['id'=>'register','name'=>'register']) ?>
    <div class="my_login_part2 new_mms stp1">
        <div class="container">
            <div class="login">
                 <div id="rrmessage" class="text-center mb-3"></div>
                <?php if($this->session->flashdata('imgBerror_') || $this->session->flashdata('imgBerror_')) { ?>
                    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror_') ?></div>
                <?php } ?>
                <div class="row m-0 justify-content-between align-items-center ">
                    <div class="col-sm-5">
                        <div class="login_form jogi_log">
                            <div class="col-sm-12 mb-3">
                                <div class="logo_p">
                                   <div class="col-12  sign_into"><b>Ready to get more <br>Fashionable?<br> <span class="regg_cop"> Register to book a styling session.</span></b></div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-sm-12 text-center">
                                <div class="logo_p  mb-2"><?= $this->session->flashdata('login_message'); ?></div>
                            </div>
                            <div class="clearfix"></div>

                             <div class="fg_gp">
                                 <input type="text" id="fname" name="fname" placeholder="Your First Name"  class="box_new"  onkeypress="return IsAlphaNumeric(event,'fname_err');">
                                 <i class="fa fa-user"></i>
                                <div id="fname_err"></div>
                            </div>

                            <div class="fg_gp">
                                 <input type="text" id="lname" name="lname" placeholder="Your Last Name"  class="box_new"  onkeypress="return IsAlphaNumeric(event,'lname_err');">
                                 <i class="fa fa-user"></i>
                                 <div id="lname_err"></div>
                            </div>

                            <div class="fg_gp">
                                <input type="email" id="email_id" name="email" placeholder="Your Email"  class="box_new">
                                <i class="fa fa-envelope"></i>
                                <div id="email_err"></div>
                            </div>

                           <div class="fg_gp">
                                <input type="text" id="mobile" name="mobile" maxlength="10" placeholder="Your Number"  class="box_new onlyInteger">
                                <i class="fa fa-phone"></i>
                                <div id="mobile_err"></div>
                            </div>

                            
                             
                            <div class="row m-0">
                                <div class="mt-3 col-sm-4 paddleft">
                                   <a id="next_form" class="action_bt_2  font16">Continue</a>
                                </div>
                                <div class="mt-3  col-sm-8 paddright">
                                    <div id="onSignup"></div>
                                </div>
                                <input type="hidden" name="lastPage" value="<?=$lastPage?>">
                            </div>

                            


                            <div class="fg_gp ot_info">
                                <p>Corporate user registration <a href="<?php echo base_url('corporate-registration'); ?>" class="red_login"> Click here</a></p>
                                <p>Already a user? <a href="<?php echo base_url('login'); ?>" class="red_login">Login here</a></p>
                            </div>


                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="get_new_sty">
                                <p>Join thousand<br> others who believe<br> in personal styling</p> 
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="<?= base_url(); ?>assets/images/new-men.png" class="img-fluid">
    </div>
    
    <div class="my_login_part2 new_mms stp2">
        <div class="container">
            <div class="login">
                <div class="row m-0 justify-content-between align-items-center ">
                    <div class="col-sm-4">
                        <div class="login_form jogi_log">
                            <div class="col-sm-12 mb-5">
                                <div class="logo_p">
                                   <div class="col-12  sign_into"><b>Ready to get more<br> Fashionable?</b></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="fg_gp">
                                <input type="text" id="referral_code" name="referral_code" placeholder="Referral Code" class="box_new">
                                <i class="fa fa-shield"></i>
                                <div id="referral_code_err"></div>
                            </div>
                            
                            <div class="fg_gp">
                                <input type="password" id="pass" name="password" placeholder="Password" class="box_new">
                                <i class="fa fa-lock"></i>
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                 
                            </div>
                            <div id="password_err"><span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span></div>
                            <div class="fg_gp">
                                <input type="password" id="repass" name="con_password"  placeholder="Confirm Password"  class="box_new">
                                <i class="fa fa-lock"></i>
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                <div id="repasser"></div>
                            </div>
                            <div class="fg_gp inline">
                                <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha Code" class="box_new_shot">
                                <i class="fa fa-shield"></i>
                                
                                <input  type="hidden" id="captcha_v" name="captcha_v" value="">
                                <span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><div class="fa fa-refresh" aria-hidden="true"></div></a>
                            </div>
                            <div id="captcha_err"></div>
                            <div class="mt-3 font14"> 
                                <p><input type="checkbox" id="terms" name="terms">  Create an account means you are okay with our  <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</p>
                                <div id="terms_err"></div>
                            </div>
                            <div class="col-sm-12 check-aligns">
                                <p>This site is protected by reCAPTCHA and the Google <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> and <a href="<?=base_url('terms-of-use')?>">Terms of Service</a> apply </p>
                            </div>
                            <div class="col-12 col-sm-7 text-center mt-4"> 
                                <input type="submit" value="Create Account" class="action_bt_2">
                            </div>

                             <div class="fg_gp ot_info">
                                <p>Corporate user registration <a href="<?php echo base_url('corporate-registration'); ?>" class="red_login"> Click here</a></p>
                                <p>Already a user? <a href="<?php echo base_url('login'); ?>" class="red_login">Login here</a></p>
                            </div>
                              
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="get_new_sty">
                                <p>One step away<br> from unlocking the<br> power of Styling</p> 
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="<?= base_url(); ?>assets/images/new-girl.png" class="img-fluid">
    </div>

<?= form_close(); ?>



<?php   $this->load->view('front/template/footer'); ?>




 




<script type="text/javascript">
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            pageLoad();
        });
        function pageLoad(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                console.log(data);
                result = $.parseJSON(data);
                $('#captImg').html(result.image);
                $('#captcha_v').val(result.word);
                
            });
        }
        //window.onload = pageLoad;
        $("#next_form").click(function(){
            $('#fname_err').html('');
            $('#lname_err').html('');
            $('#email_err').html('');
            $('#mobile_err').html('');
            var checkEmail = $('#email_id').val();
            if($('#fname').val() == '') {
                $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
                $('#fname').focus();
                return false;
            } else if($('#lname').val() == '') {
                $('#lname_err').html('<span class="text-red">Please enter your Last Name</span>');
                $('#lname').focus();
                return false;
            } else if($('#email_id').val() == '') {
                $('#email_err').html('<span class="text-red">Please enter email</span>');
                $('#email_id').focus();
                return false; 
            } else if(!IsEmail($('#email_id').val())) {
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
                $('#email_id').focus();
                return false; 
            }else if ($('#mobile').val() == '') { 
                $('#mobile_err').html('<span class="text-red">Please enter your number</span>') 
                $('#mobile').focus();
                return false; 
            } else{
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>login/emailcheck',
                    data: 'checkEmail='+checkEmail,
                    success: function(data) {
                        console.log(data);
                        if(data == 1) {
                            $('#email_err').html('<span class="text-red">Your Email Id is already registered</span>');
                            $('#email_corporate').focus();
                            return false;
                        }else{
                            $(".stp2").show();
                            $(".stp1").hide();
                        }
                         
                    }
                });

            }
            
        });
        $("#show").click(function(){
            $("p").show();
        });
        
	    
        $('#register').on('submit',function(e) {
            e.preventDefault();

            let fname = $('#fname').val();    
            let lname = $('#lname').val();        
            let email = $('#email_id').val();
            let password = $('#pass').val();
            let repass = $('#repass').val();
            var psslen = password.length;
            var error;

            $('#fname_err').html('');

            $('#lname_err').html('');
    
            $('#email_err').html('');
            $('#mobile_err').html('');
            $('#referral_code_err').html('');
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
    
            } else if($('#email_id').val() == '') {
    
                $('#email_err').html('<span class="text-red">Please enter email</span>');
    
                $('#email_id').focus();
    
                return false; 
    
            } else if(!IsEmail($('#email_id').val())) {
    
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
    
                $('#email_id').focus();
    
                return false; 
    
            }else if ($('#mobile').val() == '') { 
                $('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 
                $('#mobile').focus();
                return false; 
            /*} else if($('#referral_code').val() == '') {
                $('#referral_code_err').html('<span class="text-red">Please enter your Last Name</span>');
                $('#referral_code').focus();
                return false;
    
            */} else if($('#pass').val() == '') {
    
                $('#password_err').html('<span class="text-red">Please enter password</span>');
    
                $('#pass').focus();
    
                return false; 
    
            } else if($('#pass').val().trim().length < 8) {
    
                $('#password_err').html('<span class="text-red">Please enter 8 character password</span>');
    
                $('#password').focus();
    
                return false; 
    
            } else if(!checkPasswordValidation($('#pass').val())) {
                $('#password_err').html('<span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span>');
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
            }
        });
    
    });
     
    
</script>



