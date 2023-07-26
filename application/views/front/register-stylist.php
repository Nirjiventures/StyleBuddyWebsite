<?php  $this->load->view('front/template/header'); ?>
<div class="new_banner_stylish">
    <div class="row m-0 align-items-center">
        <div class="col-sm-6 p-0">
            
        </div>
        <div class="col-sm-6 p-0 ">
            <div class="new_sk2">
                
                <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-bs-ride="carousel">
					
					<div class="carousel-inner">
						<?php $i=0;foreach ($slides as $key => $value) { ?>
							<?php $img =  'assets/images/banner-reg1.png';?>
							<?php if(!empty($value->slides_image))  { ?>
								<?php if ($i==0) {$active='active';}else{$active="";}?>
						   		<?php 
						   			$img1 =  'assets/images/slider/'.$value->slides_image; 
						   			if (file_exists($img1)) {
						   				$img = $img1;
						   			}
						   		?>
						   		<div class="carousel-item <?=$active?>" data-bs-interval="3000">
						   			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="d-block " alt="...">
								</div>
						   	<?php } ?>
						<?php $i++;} ?>
					</div>
				</div>
            </div>
        </div>
        
    </div>

    <div class="baner_info2">
    	<div class="container">
    		<div class="stylish_rg col-sm-7">
                <h1><?=$seoData->sub_title?></h1>
                <p><?=$seoData->content?></p>
                <a href="#" class="mt23  action_bt_2">Register</a>
            </div>
    	</div>
    </div>
    
</div>


<div class="container">
	<div class="my_regg">
	<?=$seoData->content2?>
	</div>
</div>

<div class="style_ka_register">
	<div class="container">
		<h2>Register Now</h2>
		<p class="font18">If you have an account please <span class="yellow_color"><a href="<?=base_url('login/stylistlogin')?>">Login</a></span></p>
		<p class="yellow_color font14">Note: All fields with a * are mandatory fields</p>
	</div>
</div>


<div class="middle_part">
	<div class="container">
		
	   
	    <?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
		    
		    <div class="style_reg">
				<div class="row  align-items-center">
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="fname" name="fname" value="<?php echo set_value('fname') ?>" class="form-control box_in3" placeholder="First Name*" onkeypress="return IsAlphaNumeric(event,'fname_err');">
							
							<?php echo form_error('fname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="fname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="lname" name="lname" value="<?= set_value('lname') ?>" class="form-control box_in3" placeholder="Last Name*"  onkeypress="return IsAlphaNumeric(event,'lname_err');">
							
							<?php echo form_error('lname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="lname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control box_in3" placeholder="Email*">
							
							<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
							<div id="email_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="fg_gp">
							<input type="password" id="password" name="password" value="<?= set_value('password') ?>"class="form-control box_in3" placeholder="password">
							<i class="toggle-password fa fa-fw fa-eye-slash"></i>
							<?php echo form_error('password','<span class="text-primary mt-1">','</span>') ;?>
							<div id="password_err"><span class="text-red">Please enter at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</span></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="fg_gp">
							<input type="password" id="cpassword" name="cpassword" value="<?= set_value('cpassword') ?>" class="form-control box_in3" placeholder="Confirm password">
							<i class="toggle-password fa fa-fw fa-eye-slash"></i>
							<?php echo form_error('cpassword','<span class="text-primary mt-1">','</span>') ;?>
							<div id="cpassword_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<select class="form-control box_in3" name="gender" id="gender" >
								<option  value="">Select Gender</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							
							<?php echo form_error('gender','<span class="text-primary mt-1">','</span>') ;?>
							<div id="gender_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="mobile" name="mobile" maxlength="10" class="form-control box_in3 onlyInteger"  placeholder="Mobile Number*">
							
						    <?php echo form_error('mobile','<span class="text-primary mt-1">','</span>') ;?>
						    <div id="mobile_err"></div>
						</div>
						
					</div>
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
								 
								<select class="form-control box_in3"  id="experience" name="experience" >
    								<option  value="">Select Experience</option>
    								<?php $aaa = array('< 1'=>'< 1 Years','1'=>'1+ Years','2'=>'2+ Years','3'=>'10-15 Years','15'=>'Above 15 Years');?>
    								<?php 
    								for ($i=1; $i < 17  ; $i++) {  if($i == 16){ $text = 'Above 15 Year';}else{$text = '< '.$i.' Year';}?>
    									<option value="<?=$i?>"><?=$text?></option>
    								<?php } ?>
    							</select>
							
							<?php echo form_error('experience','<span class="text-primary mt-1">','</span>') ;?>
							<div id="experience_err"></div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<select class="form-control box_in3" name="country" id="country" >
							   <option  value="" >Select Country <span class="text-danger">*</span></option>
							   <?php if($country) { foreach($country as $state) { ?>
							        <option value="<?= $state->id ?>"><?= $state->name ?></option>
							   <?php }} ?>
							</select>
							<?php echo form_error('country','<span class="text-primary mt-1">','</span>') ;?>
							<div id="country_err"></div>
						</div>
					</div>
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
							<select class="form-control box_in3" name="state" id="state" >
							   <option  value="" >Select State <span class="text-danger">*</span></option>
							   <?php if($states) { foreach($states as $state) { ?>
							        <option value="<?= $state->id ?>"><?= $state->name ?></option>
							   <?php }} ?>
							</select>
							<?php echo form_error('state','<span class="text-primary mt-1">','</span>') ;?>
							<div id="state_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<select class="form-control box_in3"   name="city" id="city">
							   <option  value="">Select City <span class="text-danger">*</span></option>
							</select>
							<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>
							<div id="city_err"></div>
						</div>
					</div>
					

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="address" name="address"  value="<?= set_value('address') ?>"  class="form-control box_in3 " placeholder="Address*">
							
							<?php echo form_error('address','<span class="text-primary mt-1">','</span>') ;?>
							<div id="address_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="pin" name="pin" value="<?= set_value('pin') ?>" maxlength="6"  class="form-control box_in3 onlyInteger" placeholder="Pincode*">
							
							<?php echo form_error('pin','<span class="text-primary mt-1">','</span>') ;?>
							<div id="pin_err"></div>
						</div>
					</div>
     
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
							 
							<input type="text" id="instagram_nlink" name="instagram_nlink"   value="<?= set_value('instagram_nlink') ?>"class="form-control box_in3"  placeholder="Instagram Link*">
							
							<?php echo form_error('instagram_nlink','<span class="text-primary mt-1">','</span>') ;?>
							<div id="instagram_nlink_err"></div>
						</div>
					</div>	
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="linkedin" name="linkedin_link" value="<?= set_value('linkedin_link') ?>" class="form-control box_in3"  placeholder="linkedin Link">
							

						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="tlink" name="behance_link" value="<?= set_value('behance_link') ?>" class="form-control box_in3" placeholder="Behance Link">
							
						</div>
					</div>				
					 

					<div class="col-sm-4 mb-4 mt-4">
						  <div class="d-flex align-items-center">
						  	<label><b>Upload Portfolio PDF</b></label>
							<div class='btn yellow mleft'>
							<!--<a class='btn yellow mleft' href='javascript:;'>-->
                                <label for="portfolio_pdf">Upload</label>
								<input type="file" id="portfolio_pdf" name="portfolio_pdf"  accept=".pdf" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40">
								<!--<input type="file" id="portfolio_pdf" name="portfolio_pdf"  accept=".pdf"  size="40">-->
							</div>
							<div id="file-upload-pdf"></div> 
							<div id="portfolio_pdf_err"></div>
						</div>
						<?php if($this->session->flashdata('imgerror') || $this->session->flashdata('imgBerror')) { ?>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgerror') ?></div>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror') ?></div>
						<?php } ?>
					</div>
					<div class="col-sm-4 mb-4 mt-4">
						  <div class="d-flex align-items-center">
						  	<label><b>Profile Image<span class="text-danger">*</span></b></label>
							<!--<a class='btn yellow mleft' href='javascript:;'>-->
							<div class='btn yellow mleft'>
                                <label for="image">Upload file</label>
								<input type="file" id="image" name="image"  accept=".jpg,.png,.jpeg,.webp" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40">
								<!--<input type="file" id="image" name="image"  accept=".jpg,.png,.jpeg,.webp" size="40">-->
							</div>
							<div id="file-upload-filename"></div>
							&nbsp;
							 
							<div id="image_err"></div>
						</div>
						<?php if($this->session->flashdata('imgerror') || $this->session->flashdata('imgBerror')) { ?>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgerror') ?></div>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror') ?></div>
						<?php } ?>
					</div>
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							 
							<textarea class="form-control box_in33 border border-dark" id="about" name="about" onkeyup="checkWord('about',50)" rows="3" placeholder="maximum 50 words"><?= set_value('about') ?></textarea>
							
							<?php echo form_error('about','<span class="text-primary mt-1">','</span>') ;?>
							 
							<div id="about_err" class="text-red"></div>
						</div>
						 
						
					</div>
				</div>
        

				<div class="box_checkbox">
				  	<div class="row">
					<div class="col-sm-12 mt-0 mb-2">
						<div class="form-group">
							<label><b>Your Expertise (Maximum 3)<span class="text-danger">*</span></b></label>
						</div>
					</div>
                    <?php if(!empty($style)) {  foreach($style as $list) {  
                            if($list->name == 'Creating Lookbooks') {
                                continue;    } ?>
							<div class="col-sm-4">
								<div class="form-check checkbox-group"> 
								  <input class="form-check-input checkarray" type="checkbox" name="expertise[]" value="<?= $list->id ?>" id="flexCheckDefault-<?= $list->id ?>">
								  <label class="form-check-label" for="flexCheckDefault-<?= $list->id ?>">
								   <?= $list->name ?>
								  </label>
								  	<?php //echo form_error('expertise','<span class="text-primary mt-1">','</span>') ;?>
								</div>
							</div>
                    <?php  } } ?>

                    <div id="expertise_err"></div>
					</div>
				</div>
				<div class="octt">
					<div class="row ">
		                <div class="col-sm-12 mb-2">
		                    <div class="terms-checkbox">
		                	<div class="form-check checkbox-group"> 
	    	                    <input type="checkbox" class="form-check-input" id="terms" name="terms"> <label>Create an account means you are okay with our  <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</label>
				            </div>
		                	<div class="form-check checkbox-group"> 
	    	                    <input type="checkbox" class="form-check-input" id="service_provider_agreement" name="service_provider_agreement "> <label><a target="_blank" href="<?=base_url('service-provider-agreement')?>">Service Provider Agreement</a></label>
				            </div>
		                	<div id="terms_err"></div>
		                	</div>
		                </div>
		                <div class="col-md-3">
		                	<input  type="text" id="captcha" name="captcha" value="" placeholder="Enter captcha Code" class="form-control box_in3">
		                	<div id="captcha_err"></div>
		                	<input  type="hidden" id="captcha_v" name="captcha_v" value="">
						</div>
		                <div class="col-md-4">
							<span id="captImg"></span> <a href="javascript:void(0);" class="refreshCaptcha"><i class="fa fa-refresh" aria-hidden="true" style="margin-left: 20px;"></i></a>
						</div>
					</div>
				</div>

               
				<div class="row mb-0 mt-5">
					
					<div class="">
						<input type="submit" value="Submit & Upload Portfolio" class="action_bt4 ">
					</div>
				</div>
 				
			</div>
	    <?= form_close() ?>
	</div>
</div>

 
<script type="text/javascript">
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

</script>


<script type="text/javascript">
	function addRow(id){
        var id  = id;
        var rowCount = $('.dynamic_row .dynamic_row_All').length;
        console.log(rowCount);
        /*var rowCount = $('#list tr').length;
        console.log(id);
        console.log(rowCount);
        data  = addSlots(id,rowCount);
        $("#list").append(data);*/
        result = '';
 		$.ajax({
	        url: '<?php echo base_url(); ?>vendor/gettags',
	        type: "POST",
	        success: function (res) {
	        	result = res;
	        	data  = addSlotsDiv(id,rowCount,result);
        		$(".dynamic_row").append(data);
		 	}
	    });

        
    	 
    }
 	function addSlots(id,rowCount){
 		html = '';
 		$.ajax({
	        url: '<?php echo base_url(); ?>vendor/gettags',
	        type: "POST",
	        success: function (res) {
	        	html += '<tr id="'+rowCount+'">';
					html += '<td>';
				 		html += '<div class="form-group boot_sp"><input type="text" required name="title[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label></div>';
					html += '</td>';
					html += '<td>';
				 		html += '<div class="form-group boot_sp"><input type="file" required accept=".png, .jpg, .jpeg" name="gallery_image[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label></div>';
					html += '</td>';
					 
					html += '<td>';
				 		html += '<div class="form-group boot_sp"><select id="tag_id" name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select" data-placeholder="Begin typing a tag to filter..." > '+res+' </select><label class="form-control-placeholder2" for="fname">#Tags</label></div>';
					html += '</td>';
					html  += '<td class="action"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute('+rowCount+');return false;"><i class="fa fa-times red"></i></a></span></td>';
				html += '</tr>';
				
		 	}
	    })
	    html += '<tr id="'+rowCount+'">';
			html += '<td style="width:15%">';
		 		html += '<div class="form-group boot_sp"><input type="text" required name="title[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label></div>';
			html += '</td>';
			html += '<td style="width:15%">';
		 		html += '<div class="form-group boot_sp"><input type="file" required accept=".png, .jpg, .jpeg" name="gallery_image[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label></div>';
			html += '</td>';
			 
			html += '<td style="width:15%">';
		 		html += '<div class="form-group boot_sp"><select id="tag_id" name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select" data-placeholder="Begin typing a tag to filter..." > </select><label class="form-control-placeholder2" for="fname">#Tags</label></div>';
			html += '</td>';
			html += '<td style="width:52%">';
		 		html += '<div class="form-group boot_sp mb-0"><textarea required class="form-control box_in33 border border-dark" maxlength="180" rows="5" name="content[]" placeholder=""></textarea><label class="form-control-placeholder2" for="pin">Portfolio Description<span class="text-danger">*</span></label></div>';
			html += '</td>';
			html  += '<td  style="width:3%"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute('+rowCount+');return false;"><i class="fa fa-times red"></i></a></span></td>';
		html += '</tr>';
		return html; 
	}
 	function addSlotsDiv(id,rowCount,result){
 		/*result = '';
 		$.ajax({
	        url: '<?php echo base_url(); ?>vendor/gettags',
	        type: "POST",
	        success: function (res) {
	        	result = res;
	        	console.log(result);
		 	}
	    });*/
	    html = '<div class="col-md-12 remove_row"  id="'+rowCount+'"> <div class="dynamic_row_All row"> <div class="col-md-4"><div class="form-group boot_sp"><input type="text" required name="title[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label></div></div><div class="col-md-4"><div class="form-group boot_sp"><input type="file" required accept=".png, .jpg, .jpeg" multiple name="gallery_image['+rowCount+'][]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label></div></div><div class="col-md-4"><div class="form-group boot_sp"><select id="tag_id" multiple name="tag_id['+rowCount+'][]" class="form-control-lg form-control box_in33 chosen-select" data-placeholder="Begin typing a tag to filter..." > '+result+'</select><label class="form-control-placeholder2" for="fname">#Tags</label></div></div><div class="col-md-12 m"><div class="form-group boot_sp mb-0"><textarea required class="form-control box_in33 border border-dark" maxlength="180" rows="5" name="content[]" placeholder=""></textarea><label class="form-control-placeholder2" for="pin">Portfolio Description<span class="text-danger">*</span></label></div></div><div class="col-md-12 text-right"><a class="btn-plus remove_more"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove</a></div> </div> </div>';
		return html; 
	}
	function deleteAttribute(id){
        $("#"+id).css("display","none");
       	$("#"+id).remove();
    }
	 
</script>
<script type="text/javascript">
 
$(document).ready(function(){
        
	
    
    $('#registration-form').on('submit',function(e){
        e.preventDefault();
        $('#image_err').html('');
        $('#fname_err').html('');
        $('#lname_err').html('');
        $('#email_err').html('');
        $('#password_err').html('');
        $('#cpassword_err').html('');
        $('#gender_err').html('');
        $('#mobile_err').html('');
        $('#country_err').html('') 
        $('#state_err').html('');
        $('#city_err').html('');
        $('#experience_err').html('');
        $('#address_err').html('');
        $('#pin_err').html('');
        $('#instagram_nlink_err').html('');
        $('#about_err').html('');
        $('#more_about_err').html('');
        $('#title_err').html('');
        $('#content_err').html('');
        $('#expertise_err').html('');
        $('#terms_err').html('');
        $('#captcha_err').html('');
        var searchIDs = $("input.checkarray:checkbox:checked").map(function(){
	      return $(this).val();
	    }).get(); 
	    
		 
		console.log($('#password').val());
		console.log($('#password').val().length);
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
        } else if($('#cpassword').val() == '') {
            $('#cpassword_err').html('<span class="text-red">Please enter confirm password</span>');
            $('#cpassword').focus();
            return false; 
        }else if ($('#password').val() != $('#cpassword').val()) { 
			$('#cpassword_err').html('<span class="text-red">Password did not match: Please try again...</span>') 
			$('#cpassword').focus();
			return false; 
		}else if ($('#gender').val() == '') { 
			$('#gender_err').html('<span class="text-red">Please select gender</span>') 
			$('#gender').focus();
			return false; 
		}else if ($('#mobile').val() == '') { 
			$('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 
			$('#mobile').focus();
			return false; 
		}else if ($('#experience').val() == '') { 
			$('#experience_err').html('<span class="text-red">Please enter select experience</span>') 
			$('#experience').focus();
			return false; 
		}else if ($('#country').val() == '') { 
			$('#country_err').html('<span class="text-red">Please select country</span>') 
			$('#country').focus();
			return false; 
		/*}else if ($('#state').val() == '') { 
			$('#state_err').html('<span class="text-red">Please select state</span>') 
			$('#state').focus();
			return false; 
		}else if ($('#city').val() == '') { 
			$('#city_err').html('<span class="text-red">Please enter select city</span>') 
			$('#city').focus();
			return false; */
		}else if ($('#address').val() == '') { 
			$('#address_err').html('<span class="text-red">Please enter address</span>') 
			$('#address').focus();
			return false; 
		}else if ($('#pin').val() == '') { 
			$('#pin_err').html('<span class="text-red">Please enter pincode</span>') 
			$('#pin').focus();
			return false; 
		}else if ($('#instagram_nlink').val() == '' || $('#instagram_nlink').val().trim().length == '') { 
			$('#instagram_nlink_err').html('<span class="text-red">Please enter instagram link</span>') 
			$('#instagram_nlink').focus();
			return false; 
		}else if($('#image').val() == '' || $('#image').val().trim().length == '') {
            $('#image_err').html('<span class="text-red">Please select Image</span>');
            $('#image').focus();
            return false; 
        } else if(($("#image")[0].files[0].size) > 4194304) {
            $('#image_err').html('<span class="text-red">Image should be less than 4MB</span>');
            $('#image').focus();
            return false; 
        } else if ($('#about').val() == '' || $('#about').val().trim().length == '') { 
			$('#about_err').html('<span class="text-red">Please enter maximum 50 character</span>') 
			$('#about').focus();
			return false; 
		}else if(!searchIDs.length){
			$('#expertise_err').html('<span class="text-red">Please checked expertise</span>') 
			return false; 
		}else if(searchIDs.length>3){
			$('#expertise_err').html('<span class="text-red">Please checked expertise less than 4</span>') 
			return false; 
		}else  if (!$('#terms:checked').val()) {
			$('#terms_err').html('<span class="text-red">Please checked terms</span>') 
			$('#terms').focus();
			return false;
		}else if ($('#captcha').val() == '') { 
			$('#captcha_err').html('<span class="text-red">Please enter captcha</span>') 
			$('#captcha').focus();
			return false; 
		}else if ($('#captcha').val() != $('#captcha_v').val()) { 
			$('#captcha_err').html('<span class="text-red">Please enter correct captcha</span>') 
			$('#captcha').focus();
			return false; 
		}else{
			$('#registration-form').get(0).submit();
			return true;
		}
    });
        


});
	 
 
	
	 
</script>

<script>
	var input = document.getElementById( 'image' );
	var infoArea = document.getElementById( 'file-upload-filename' );

	input.addEventListener( 'change', showFileName );
	function showFileName( event ) {
		var input = event.srcElement;
		var fileName = input.files[0].name;
		infoArea.textContent = 'File name: ' + fileName;
		$('#image_err').html('');
	}


	var input1 = document.getElementById( 'portfolio_pdf' );
	var infoArea1 = document.getElementById( 'file-upload-pdf' );
	input1.addEventListener( 'change', showFileName1 );
	function showFileName1( event ) {
		var input1 = event.srcElement;
		var fileName1 = input1.files[0].name;
		infoArea1.textContent = 'File name: ' + fileName1;
	}    
</script>

<?php $this->load->view('front/template/footer'); ?>