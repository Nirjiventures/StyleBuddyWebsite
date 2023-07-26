<?php $this->load->view('front/template/header'); ?>
<div class="banner_inner">
	<div class="container">
		<h2><?php echo $rowdata->title; ?> </h2>
        <?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
		?>
		<?php 
			if($last_activityRow){
			   $this->breadcrumb->add($last_activityRow->title_develop, base_url('select-service/'.$last_activityRow->slug)); 
			}
			$this->breadcrumb->add(ucwords($vender->fname.' '.$vender->lname), base_url('select-service')); 
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>
<?php $review = $vender->review;?>
<div class="middle_part_1  padding_top_bottom">
	<div class="container">
        <?= form_open('',['id'=>'availabilityForm','name'=>'availabilityForm']) ?>
    		<div class="row m-0 justify-content-center">
                <input type="hidden" name="vendor_id" value="<?=$vender->id?>">
                
                
                <?php if($this->session->flashdata('imgBerror_') || $this->session->flashdata('imgBerror_')) { ?>
                    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror_') ?></div>
                <?php } ?>

                <div class="col-sm-5">
                    <div class="fg_gp">
                        <input type="text" id="fname" name="name" placeholder="Your Full Name"  class="box_new">
                        <i class="fa fa-user"></i>
                        <div id="fname_err"></div>
                    </div>

                    <div class="fg_gp">
                        <input type="email" id="email_check" name="email" placeholder="Email Address"  class="box_new">
                        <i class="fa fa-envelope"></i>
                        <div id="email_err"></div>
                    </div>

                    <div class="fg_gp">
                        <input type="text" id="city" name="city" placeholder="City"  class="box_new">
                        <i class="fa fa-city"></i>
                        <div id="city_err"></div>
                    </div>

                    <div class="fg_gp">
                        <input type="text" id="mobile" name="phone" placeholder="Phone Number"  class="box_new onlyInteger">
                        <i class="fa fa-phone"></i>
                        <div id="mobile_err"></div>
                    </div>
    		    </div>
                <div class="col-sm-5">
    				<?php if(!empty($expertises_list)) { $i=0;?>
                        <div class="fg_gp">
                            <select type="text" id="service_id" name="service_id" placeholder="Styling Service"  class="box_new">
                                <option value="">Select Styling Service</option>
                                <?php   foreach($expertises_list as $list) {  ?>
                                <option value="<?= $list->id?>"><?= $list->title_develop ?></option>
                                <?php  $i++;} ?>
                            </select>
                            <i class="fa fa-user"></i>
                            <div id="service_id_err"></div>
                        </div>
                    <?php } ?>
                    <div class="fg_gp">
                	   <textarea type="text" id="message" name="message" placeholder="Message"  class="box_text_comm"></textarea>
                   		<i class="fa fa-pencil"></i>
                	   <div id="message_err"></div>
                    </div>
                    <div class="fg_gp inline">
                        <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha Code" class="box_new_shot">
                        <i class="fa fa-shield"></i>
                        
                        <div id="captcha_err"></div>
                        <input  type="hidden" id="captcha_v" name="captcha_v" value="">
                     
                        <span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><div class="fa fa-refresh" aria-hidden="true"></div></a>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class=" font14"> 
                    	<p><input type="checkbox" id="terms" name="terms">  Agree with our  <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</p>
                    	<div id="terms_err"></div>
                    </div>
                    <div class="col-sm-10 check-aligns font14">
                        <p>This site is protected by reCAPTCHA and the Google <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> and <a href="<?=base_url('terms-of-use')?>">Terms of Service</a> apply </p>
                    </div>
                </div>
                <div class="col-12 col-sm-3 text-center"> 
                    <input type="submit"  value="Check Availability" class="action_bt4 w100">
                    <!-- <input type="submit" data-bs-toggle="modal" data-bs-target="#check_availability" value="Check Availability" class="action_bt4 w100"> -->
    			</div>	
            </div>
        <?= form_close(); ?>
    </div>
</div>

<?php $this->load->view('front/template/footer'); ?>
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


        $('#availabilityForm').on('submit',function(e){
            e.preventDefault();
            $('#fname_err').html('');
            $('#email_err').html('');
            $('#city_err').html('');
            $('#mobile_err').html('');
            $('#service_id_err').html('');
            $('#message_err').html('');
            $('#captcha_err').html('');
            $('#terms_err').html('');
            if($('#fname').val() == '') {
                $('#fname_err').html('<span class="text-red">Please enter your Name</span>');
                $('#fname').focus();
                return false;
            } else if($('#email_check').val() == '') {
                $('#email_err').html('<span class="text-red">Please enter email</span>');
                $('#email_check').focus();
                return false; 
            } else if(!IsEmail($('#email_check').val())) {
                $('#email_err').html('<span class="text-red">Please enter correct email</span>');
                $('#email_check').focus();
                return false; 
            }else if ($('#city').val() == '') { 
                $('#city_err').html('<span class="text-red">Please enter city</span>') 
                $('#city').focus();
                return false; 
            }else if ($('#mobile').val() == '') { 
                $('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 
                $('#mobile').focus();
                return false; 
            }else if ($('#service_id').val() == '') { 
                $('#service_id_err').html('<span class="text-red">Please  select service</span>') 
                $('#service_id').focus();
                return false; 
            }else if ($('#message').val() == '') { 
                $('#message_err').html('<span class="text-red">Please enter message</span>') 
                $('#message').focus();
                return false; 
            }else if ($('#captcha').val() == '') { 
                $('#captcha_err').html('<span class="text-red">Please enter captcha</span>') 
                $('#captcha').focus();
                return false; 
            }else if ($('#captcha').val() != $('#captcha_v').val()) { 
                $('#captcha_err').html('<span class="text-red">Please enter correct captcha</span>') 
                $('#captcha').focus();
                return false; 
            }else  if (!$('#terms:checked').val()) {
                $('#terms_err').html('<span class="text-red">Please checked terms</span>') 
                $('#terms').focus();
                return false;
            }else{
                $('#availabilityForm').get(0).submit();
                return true;
            }
        });
    
    });
     
    
</script>

