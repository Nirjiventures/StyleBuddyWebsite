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

<?= form_open_multipart('',['id'=>'register','name'=>'register','method'=>'post']) ?>
    <div class="my_login_part2 new_mms stp1">
        <div class="container">
            <div class="login">
                <div class="row m-0 justify-content-between align-items-center ">
                    <div class="col-sm-4">
                        <div class="login_form jogi_log">
                            <div class="col-sm-12 mb-3">
                                <div class="logo_p">
                                   <div class="col-12  sign_into"><b>Ready to get more <br>Fashionable?<br> <span class="regg_cop"> Register now!</span></b></div>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            <div class="col-sm-12 text-center">
                                <div class="logo_p  mb-2"><?= $this->session->flashdata('login_message'); ?></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="fg_gp">
                                <i class="fa fa-user"></i>
                                <input id="fname" name="fname" type="text" placeholder="Your First Name" class="box_new" onkeypress="return IsAlphaNumeric(event,'fname_err');">
                                <div id="fname_err"></div>
                            </div>

                             <div class="fg_gp">
                                <i class="fa fa-user"></i>
                                <input id="lname" name="lname" type="text" placeholder="Your Last Name" class="box_new" onkeypress="return IsAlphaNumeric(event,'lname_err');">
                                <div id="lname_err"></div>
                            </div>

                            <div class="fg_gp">
                                <i class="fa fa-envelope-o"></i>
                                <input id="email_corporate" name="email" type="email" placeholder="Your Email" class="box_new">
                                <div id="email_err"></div>
                            </div>
                            <div class="fg_gp">
                                <input type="text" id="mobile" name="mobile" maxlength="10" placeholder="Your Number"  class="box_new onlyInteger">
                                <i class="fa fa-phone"></i>
                                <div id="mobile_err"></div>
                            </div>
                            <!--<div class="fg_gp">
                                <i class="fa fa-id-card-o"></i>
                                <input id="employee_id" name="employee_id" type="text" placeholder="Employee ID" class="box_new">
                                <div id="employee_id_err"></div>
                            </div>-->
                            <div class="fg_gp">
                                <i class="fa fa-city"></i>
                                <select id="state" name="state" type="text" placeholder="Select State" class="box_new">
                                    <option  value="">Select State <span class="text-danger">*</span></option>
                                   <?php if($states) { foreach($states as $state) { ?>
                                        <option value="<?= $state->id ?>"><?= $state->name ?></option>
                                   <?php }} ?>
                                </select>
                                <div id="state_err"></div>
                            </div>

                            <div class="fg_gp">
                                <i class="fa fa-city"></i>
                                <select id="city" name="city" type="text" placeholder="Select City" class="box_new">
                                        <option value="">---Select City---</option>
                                </select>
                                <div id="city_err"></div>
                            </div>

                            
                            <div class="row m-0">
                                <div class="col-6 text-center  mt-3 p-0">
                                   <a id="next_form" class="action_bt_2 w100 font16">Continue</a>
                                </div>
                                <input type="hidden" name="lastPage" value="<?=$lastPage?>">
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
                            
                            <div class="clearfix"></div>
                            <div class="fg_gp">
                                <i class="fa fa-lock"></i>
                                <input id="password" name="password" type="password" placeholder="Password" class="box_new">
                                <i class="toggle-password fa fa-fw fa-eye-slash" aria-hidden="true"></i>
                            </div>
                            <div id="password_err"><span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span></div>
                            <div class="fg_gp">
                                <i class="fa fa-lock"></i>
                                <input id="c_password" name="c_password" type="password" placeholder="Confirm Password" class="box_new">
                                <i class="toggle-password fa fa-fw fa-eye-slash" aria-hidden="true"></i>
                            </div>
                            <div id="c_password_err"></div>

                            <!--<div class="fg_gp inline">
                                <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha Code" class="box_new_shot">
                                <i class="fa fa-shield"></i>
                                
                                <input  type="hidden" id="captcha_v" name="captcha_v" value="">
                                <span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><div class="fa fa-refresh" aria-hidden="true"></div></a>
                            </div>-->
                            <div id="captcha_err"></div>
                            <div class="mt-3 font14"> 
                                <p><input type="checkbox" id="terms" name="terms">  Create an account means you are okay with our  <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</p>
                                <div id="terms_err"></div>
                            </div>
                            <div class="col-sm-12 check-aligns">
                                <p>This site is protected by reCAPTCHA and the Google <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> and <a href="<?=base_url('terms-of-use')?>">Terms of Service</a> apply </p>
                            </div>
                            <div class="col-12 col-sm-7 text-center mt-4"> 
                                <input type="submit" value="Create Account" class="action_bt_2 w100">
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
<?php  $this->load->view('front/template/footer'); ?>
<style>
    span#captImg img {
        position: relative;
        left: 10px;
        width: 140px!important;
        margin-right: 20px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            pageLoad();
        });

        $("#next_form").click(function(){
            $('#fname_err').html('');
            $('#lname_err').html('');
            $('#email_err').html('');
            $('#employee_id_err').html('');
            $('#state_err').html('');
            $('#city_err').html('');
            $('#mobile_err').html('');
            var checkEmail = $('#email_corporate').val();
            var lasta = checkEmail.lastIndexOf('@');
            var host='';
            if (lasta != -1) {
                host = checkEmail.substring(lasta+1);
            }
             

            if($('#fname').val() == '') {
                $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
                $('#fname').focus();
                return false;
            } else if($('#lname').val() == '') {
                $('#lname_err').html('<span class="text-red">Please enter your Last Name</span>');
                $('#lname').focus();
                return false;
            } else if(checkEmail == '') {
                $('#email_err').html('<span class="text-red">Please enter email</span>');
                $('#email_corporate').focus();
                return false; 
            } else if(!IsEmail(checkEmail)) {
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
                $('#email_corporate').focus();
                return false; 
            }else if ($('#mobile').val() == '') { 
                $('#mobile_err').html('<span class="text-red">Please enter your number </span>') 
                $('#mobile').focus();
                return false; 
            /*} else if($('#employee_id').val() == '') {
                $('#employee_id_err').html('<span class="text-red">Please enter employee id</span>');
                $('#employee_id').focus();
                return false;
            */} else if($('#state').val() == '') {
                $('#state_err').html('<span class="text-red">Please enter state</span>');
                $('#state').focus();
                return false;
            /*} else if($('#city').val() == '') {
                $('#city_err').html('<span class="text-red">Please enter city</span>');
                $('#city').focus();
                return false;
            */} else{
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>login/emailcheck_corporate',
                    data: 'checkEmail='+checkEmail,
                    success: function(data) {
                        console.log(data);
                        if(data == 2) {
                            $('#email_err').html('<span class="text-red">Please enter valid corporate mail ID.</span>');
                            $('#email_corporate').focus();
                            return false; 
                        } else if(data == 1) {
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
            let password = $('#password').val();
            let repass = $('#c_password').val();
            var psslen = password.length;
            var error;
            
            $('#fname_err').html('');
            $('#lname_err').html('');
            $('#email_err').html('');
            $('#password_err').html('');
            $('#c_password_err').html('');
            $('#employee_id_err').html('');
            $('#captcha_err').html('');
            $('#terms_err').html('');

            if($('#fname').val() == '') {
                $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
                $('#fname').focus();
                return false;
            } else if($('#lname').val() == '') {
                $('#lname_err').html('<span class="text-red">Please enter your Last Name</span>');
                $('#lname').focus();
                return false;
            } else if($('#email_corporate').val() == '') {
                $('#email_err').html('<span class="text-red">Please enter email</span>');
                $('#email_corporate').focus();
                return false; 
            } else if(!IsEmail($('#email_corporate').val())) {
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
                $('#email_corporate').focus();
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
            /*}else if ($('#captcha').val() == '') { 
                $('#captcha_err').html('<span class="text-red">Please enter captcha</span>') 
                $('#captcha').focus();
                return false; 
            }else if ($('#captcha').val() != $('#captcha_v').val()) { 
                $('#captcha_err').html('<span class="text-red">Please enter correct captcha</span>') 
                $('#captcha').focus();
                return false; 
            */}else  if (!$('#terms:checked').val()) {
                $('#terms_err').html('<span class="text-red">Please checked terms</span>') 
                $('#terms').focus();
                return false;
            }else {
                $('#register').get(0).submit();
                return true;
            }
        });
    });
</script>

