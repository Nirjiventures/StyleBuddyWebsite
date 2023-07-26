<?php  $this->load->view('Page/template/header'); ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap" rel="stylesheet">
<style type="text/css">
	.text-red{
		color: #bd1f1f!important;
	}
    .pp_detail {
        padding: 20px;
        padding-top: 0px;
        padding-bottom:0px;
    }
    .register_fm{
    	margin-top: 0px;
    	padding-top: 0px;
    }
    .reg-content p{
    	text-align: justify;
    }
    .reg-content ul{
    	margin: 0;
    	padding: 0;
    	margin-top: 10px;
    }
    .reg-content h4{
    	margin-bottom: 20px;
    }
    .reg-content ul li{
    	text-align: left;
    	margin-left: 15px;
    }
    .lt-bg-reg {
        background: #f1f1f1;
        padding: 40px 40px;
    }
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
    .register_fm .btn2{
    	background: var(--pink);
        padding: 10px 20px;
        border: 0px;
        border-radius: 6px;
        color: var(--white)!important;
        font-weight: bold;
        letter-spacing: 2px;
    }
    .reg-content .h1{
        font-weight: 900!important;
        font-size: 68px!important;
        text-transform: uppercase;
        background: linear-gradient(to right, #7401CA 0%, #F62AC1 41%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .mbl .h1{
        font-size: 38px!important; 
    }
    .checkbox-group label a{
        color:#0d6efd;
    }
    .terms-checkbox{
        margin-bottom:15px;
    }
    .terms-checkbox .form-check {
        margin-bottom: 5px;
    }
</style>

<div class="register_part pos">
        <div class="container">
    	    
        </div>
    	
    	
		<div class="container-fluid f-width">
		    
        	
			<div class="row align-items-center justify-content-center">
			    
				<div class="col-sm-6"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('assets/images/banner-1.gif')?>" class="img-fluid"></div>

				<div class="col-sm-6">
				    <div class="logo_p reg-content text-justify mt-4 dsk">
				            <h1 class="h1">Stylist Registration</h1>
				       	<p>Welcome to the style buddy registration page. Stylebuddy empowers individual stylists to sell styling services to millions of people around the world, without having the need to find clients on their own. As a stylist on stylebuddy, you can post your portfolio, Join our stylist community, Be featured on our social media for free and sell your services to various clients. If you are a stylist who wants to join the stylebuddy platform, please register below for free. Stylists who add their full bio & profile win a chance to be featured on our social media for free & be part of other exciting offers.</p>
				    </div>
				    <div class="logo_p reg-content text-justify mt-4 mbl">
				        <h1 class="h1">Stylist Registration</h1>
				    	<p>Welcome to the style buddy registration page. Stylebuddy empowers individual stylists to sell styling services to millions of people around the world, without having the need to find clients on their own.</p>
				    	<p> As a stylist on stylebuddy, you can post your portfolio, Join our stylist community, Be featured on our social media for free and sell your services to various clients. If you are a stylist who wants to join the stylebuddy platform, please register below for free. Stylists who add their full bio & profile win a chance to be featured on our social media for free & be part of other exciting offers.</p>
				    </div>
			   </div>
			</div>
		</div>
	<div class="container register_form">
		
	    <?= form_open_multipart('registration',['id'=>'registration-form','name'=>'registration-form']) ?>
		<div class="row m-0 justify-content-center">
			
			<div class="col-sm-12">
			    <div class="register_fm">
				<div class="row justify-content-center align-items-center">
					<div class="col-sm-12 pp_detail">
					
					<div class="row">
					   <div class="col-sm-12 mt-4">
					   		<div class="logo_p lt-bg-reg reg-content text-center"><h4>Registration Tips</h4>
					   			<ul>
					   				<li>Here are some quick tips before you register as a stylist with us. </li>
					   				<li>Make sure you add real and genuine information. Fake profiles will be deleted. </li>
					   				<li>The more information you add as part of your profile, the more likely you will get styling gigs & jobs. </li>
					   				<li>Be Specific about your expertise so you match with the ideal customer faster.</li>
					   				<li>Your social media links will help you land more gigs & jobs. Dont forget to add them. </li>
					   				<li>Upload only PDF documents.</li>
					   			</ul>
					   		</div>
					   	</div>
					</div>
					</div>
					<div class="col-sm-12 mt-4"><div class="logo_p text-center"><h4>Stylist Registration</h4></div><div class="logo_p text-center"><p>if you have an account please <a href="<?= base_url('login'); ?>" class="text-primary text-decoration-none">Login</a></p></div></div>
					<h3 style="color: red;"><b>Note: </b>All fields with a * are mandatory fields</h3>
					<div class="col-sm-12 mb-4 mt-4">
						  <div class="d-flex align-items-center">
						  	<label><b>Profile Image<span class="text-danger">*</span></b></label>
							<a class='btn btn-primary' href='javascript:;'>
                                <label for="image">Upload file</label>
								<input type="file" id="image" name="image"  accept=".jpg,.png,.jpeg,.webp" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40">
							</a>
							<div id="file-upload-filename"></div>
							&nbsp;
							 
							<div id="image_err"></div>
						</div>
						<?php if($this->session->flashdata('imgerror') || $this->session->flashdata('imgBerror')) { ?>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgerror') ?></div>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror') ?></div>
						<?php } ?>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="fname">First Name<span class="text-danger">*</span></label>
							<input type="text" id="fname" name="fname" value="<?php echo set_value('fname') ?>" class="form-control box_in3" >
							
							<?php echo form_error('fname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="fname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="fname">Last Name<span class="text-danger">*</span></label>
							<input type="text" id="lname" name="lname" value="<?= set_value('lname') ?>" class="form-control box_in3" >
							
							<?php echo form_error('lname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="lname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="fname">Email<span class="text-danger">*</span></label>
							<input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control box_in3" >
							
							<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
							<div id="email_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="Password">Password<span class="text-danger">*</span><span class="text-char">(Minimum 8 alphanumeric letters.)</span></label>
							<input type="password" id="password" name="password" value="<?= set_value('password') ?>"class="form-control box_in3" >
							<i class="toggle-password fa fa-fw fa-eye-slash"></i>
							<?php echo form_error('password','<span class="text-primary mt-1">','</span>') ;?>
							<div id="password_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="Password">Confirm Password<span class="text-danger">*</span></label>
							<input type="password" id="cpassword" name="cpassword" value="<?= set_value('cpassword') ?>" class="form-control box_in3" >
							<i class="toggle-password fa fa-fw fa-eye-slash"></i>
							<?php echo form_error('cpassword','<span class="text-primary mt-1">','</span>') ;?>
							<div id="cpassword_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="Password">Gender<span class="text-danger">*</span></label>
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
							<label class="form-control-placeholder2" for="mobile">Mobile Number<span class="text-danger">*</span></label>
							<input type="text" id="mobile" name="mobile" class="form-control box_in3">
							
						    <?php echo form_error('mobile','<span class="text-primary mt-1">','</span>') ;?>
						    <div id="mobile_err"></div>
						</div>
						
					</div>
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
								<label class="form-control-placeholder2" for="Password">Years of Experience<span class="text-danger">*</span></label>
								<select class="form-control box_in3"  id="experience" name="experience" >
    								<option  disabled selected>Select Experience</option>
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
							<label class="form-control-placeholder2" for="state">State<span class="text-danger">*</span></label>
							<select class="form-control box_in3" name="state" id="state" >
							   <option  value="" >Select State</option>
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
							<label class="form-control-placeholder2"  for="dob">Location<span class="text-danger">*</span></label>
							<select class="form-control box_in3"   name="city" id="city">
							   <option  value="">Select City <span class="text-danger">*</span></option>
							</select>
							
							<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>
							<div id="city_err"></div>
						</div>
					</div>
					

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="address">Address<span class="text-danger">*</span></label>
							<input type="text" id="address" name="address"  value="<?= set_value('address') ?>"  class="form-control box_in3 ">
							
							<?php echo form_error('address','<span class="text-primary mt-1">','</span>') ;?>
							<div id="address_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="pin">Pincode<span class="text-danger">*</span></label>
							<input type="text" id="pin" name="pin" value="<?= set_value('pin') ?>" class="form-control box_in3 onlyInteger">
							
							<?php echo form_error('pin','<span class="text-primary mt-1">','</span>') ;?>
							<div id="pin_err"></div>
						</div>
					</div>
     
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="inlink">Instagram Link<span class="text-danger">*</span></label>
							<input type="text" id="instagram_nlink" name="instagram_nlink"   value="<?= set_value('instagram_nlink') ?>"class="form-control box_in3">
							
							<?php echo form_error('instagram_nlink','<span class="text-primary mt-1">','</span>') ;?>
							<div id="instagram_nlink_err"></div>
						</div>
					</div>	
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="linkedin">linkedin Link</label>
							<input type="text" id="linkedin" name="linkedin_link" value="<?= set_value('linkedin_link') ?>" class="form-control box_in3">
							

						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="tlink">Behance Link</label>
							<input type="text" id="tlink" name="behance_link" value="<?= set_value('behance_link') ?>" class="form-control box_in3">
							
						</div>
					</div>				
					<!-- <div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="flink" name="facebook_link" value="<?= set_value('facebook_link') ?>" class="form-control box_in3">
							<label class="form-control-placeholder2" for="flink">Facebook Link</label>

						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="tlink" name="twitter_link" value="<?= set_value('twitter_link') ?>" class="form-control box_in3">
							<label class="form-control-placeholder2" for="tlink">Twitter Link</label>
						</div>
					</div> -->

					<div class="col-sm-12 mb-4">
						  <div class="d-flex align-items-center">
						  	<label><b>Upload Portfolio PDF</b></label>
							<a class='btn btn-primary' href='javascript:;'>
                                <label for="image">UPLOAD</label>
								<input type="file" id="portfolio_pdf" name="portfolio_pdf"  accept=".pdf" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40">
							</a>
							<div id="file-upload-pdf"></div> 
							<div id="portfolio_pdf_err"></div>
						</div>
						<?php if($this->session->flashdata('imgerror') || $this->session->flashdata('imgBerror')) { ?>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgerror') ?></div>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror') ?></div>
						<?php } ?>
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="about">About Me short<span class="text-danger">*</span></label>
							<textarea class="form-control box_in33 border border-dark" id="about" name="about" onkeyup="checkWord('about',50)" rows="3" placeholder="maximum 50 words"><?= set_value('about') ?></textarea>
							
							<?php echo form_error('about','<span class="text-primary mt-1">','</span>') ;?>
							 
							<div id="about_err" class="text-red"></div>
						</div>
						<!--<div class="form-group boot_sp">
							<label class="form-control-placeholder2" for="about">About Me short<span class="text-danger">*</span></label>
							<textarea class="form-control box_in33 border border-dark"  onkeypress="checkWord('about',50)" minlength="5" maxlength="50" id="about" name="about" rows="3" placeholder="maximum 50 character"><?= set_value('about') ?></textarea>
							
							<?php echo form_error('about','<span class="text-primary mt-1">','</span>') ;?>
							 
							<div id="about_err"></div>
						</div>-->
						
					</div>
					<!--<div class="col-sm-12">-->
					<!--	<div class="form-group boot_sp">-->
					<!--		<textarea class="form-control box_in33 border border-dark" id="more_about" minlength="180" onkeypress="checkWord('more_about',180)" rows="5" name="more_about" placeholder="Minimum 180 character"><?= set_value('more_about') ?></textarea>-->
					<!--		<label class="form-control-placeholder2" for="more_about">More About Me<span class="text-danger">*</span></label>-->
					<!--		<?php echo form_error('more_about','<span class="text-primary mt-1">','</span>') ;?>-->
							<!-- Minimum 180 character <span id="long_message"></span> -->
					<!--		<div id="more_about_err"></div>-->
					<!--	</div>-->
						<script>//  CKEDITOR.replace( 'editor1' );</script>
					<!--</div>-->
				</div>
       <!--         <div class="col-md-12 dynamic_row">    -->
	      <!--          <div class="row ">-->
	      <!--              <div class="col-md-12 mb-3"><h4>Add Portfolio</h4></div>-->
	      <!--          </div>    -->
       <!--             <div class="dynamic_row_All row" id="0">-->
	      <!--              <div class="col-md-4">-->
	      <!--                  <div class="form-group boot_sp">-->
								<!--<input type="text" name="title[]" id="title" value="<?= set_value('title') ?>"class="form-control box_in3">-->
							<!--	<label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label>-->
							<!--	<div id="title_err"></div>-->
							<!--</div>-->
	      <!--              </div>-->
	      <!--              <div class="col-md-4">-->
	                          
	      <!--                    <div class="form-group boot_sp">-->
							<!--	<input type="file" id="files"  accept=".png, .jpg, .jpeg" name="gallery_image[0][]" multiple class="form-control box_in3">-->
							<!--	<label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label>-->
							<!-- </div>-->
							<!-- <div id="files_err"></div>-->
	      <!--              </div>-->
	      <!--              <div class="col-md-4">-->
	      <!--                   <div class="form-group boot_sp">-->
							<!--	<select id="tag_id" multiple name="tag_id[0][]" class="form-control-lg form-control box_in33 chosen-select"data-placeholder="Begin typing a tag to filter...">-->
	    							
	    		<!--					 <?php if(!empty($tags)) { foreach($tags as $list) { ?>    								-->
	    		<!--						<option class="Female" value="<?= $list->id ?>"><?= $list->tag ?></option>-->
	    		<!--					 <?php } } ?>-->
	    		<!--					</select> -->
							<!--	<label class="form-control-placeholder2" for="fname">#Tags</label>-->
							<!-- </div>-->
							<!-- <div id="tag_id_err"></div>-->
	      <!--              </div>-->
	      <!--              <div class="col-md-12 m">-->
	      <!--                   <div class="form-group boot_sp mb-0">-->
							<!--	<textarea  class="form-control box_in33 border border-dark"   maxlength="180" id="content" rows="5" name="content[]" placeholder=""></textarea>-->
							<!--	<label class="form-control-placeholder2" for="pin">Portfolio Description<span class="text-danger">*</span></label>-->
							<!--</div>-->
							<!--<div id="content_err"></div>-->
	      <!--              </div>-->
	      <!--          </div> -->
	                
       <!--         </div>-->
                <!--<div class="row">-->
                <!--    <div class="col-md-12 text-right">-->
                <!--        <a class="btn-plus add_more"  onclick="addRow(1)"><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--  <div class="col-sm-12">
				    <div class="col-sm-12 text-start">
				    	<div class="re_up_video">
					        <a class="btn btn-danger" onclick="addRow(1)"> <i class="fa fa-plus"></i> Add</a>
					        <span id="err"></span>
				        </div>
				    </div>
				    <br/>
			    </div>
			    <div class="col-sm-12">
			        <table id="list" class="">
			            <tbody>
			            </tbody>
			        </table>
			        <p id="msg"></p>
		        </div>
				 -->

				<div class="box_checkbox">
				  <div class="row">
					<div class="col-sm-12 mt-0">
						<div class="form-group">
							<label><b>3 areas of expertise maximum<span class="text-danger">*</span></b></label>
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
				<div class="row">
	                <div class="col-sm-5">
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

               
				<div class="row mb-0 mt-2">
					
					<div class="col-sm-12 text-center">
						<input type="submit" value="Submit & Upload Portfolio" class="btn2">
					</div>
				</div>
 				
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<?php  if($this->session->flashdata('success') !=   '') { ?>  
<script>
    $(document).ready(function(){
      $('#messageModal').modal('show');
    });
 </script>
<?php } ?>
  <!-- The Modal -->
  <div class="modal login_popup" id="messageModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Message</h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/checked.png') ?>">
          <?= $this->session->flashdata('success'); ?>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
           <a href="<?= base_url('login') ?>" type="button" class="btn btn-danger" >Login</a>         
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
	//$(".chosen-select").chosen({ no_results_text: "Oops, nothing found!" });
</script>

<script>
    $(document).ready(function(){
        
$("#short_area").on('keyup', function() {
    var words = 0;
    if ((this.value.match(/\S+/g)) != null) {
      words = this.value.match(/\S+/g).length;
    }
    if (words > 50) {
      var trimmed = $(this).val().split(/\s+/, 50).join(" ");
      $(this).val(trimmed + " ");
    }
    else {
      $('#short_message').text(words);
      $('#short_left').text(50-words);
    }
  });
$("#long_area").on('keyup', function() {
    var words = 0;
    if ((this.value.match(/\S+/g)) != null) {
      words = this.value.match(/\S+/g).length;
    }
    if (words > 180) {
      var trimmed = $(this).val().split(/\s+/, 180).join(" ");
      $(this).val(trimmed + " ");
    }
    else {
      $('#long_message').text(words);
      $('#long_left').text(180-words);
    }
  });  
    $("body").on("click",".remove_more",function(e) { 
         e.preventDefault();
        $(this).parents(".remove_row").remove();
    });
    
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
	    
		/*var image = document.getElementById('image'); 
		var width = image.clientWidth;
		var height = image.clientHeight;
		console.log(searchIDs.length);*/
 

		/*var img=$("#image")[0].files[0].size;
		var imgsize=img/1024; 
		console.log(imgsize);
		console.log(img);*/

		console.log($('#password').val());
		console.log($('#password').val().length);
        if($('#image').val() == '' || $('#image').val().trim().length == '') {
            $('#image_err').html('<span class="text-red">Please select Image</span>');
            $('#image').focus();
            return false; 
        } else if(($("#image")[0].files[0].size) > 4194304) {
            $('#image_err').html('<span class="text-red">Image should be less than 4MB</span>');
            $('#image').focus();
            return false; 
        } else if($('#fname').val() == '') {
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
		}else if ($('#state').val() == '') { 
			$('#state_err').html('<span class="text-red">Please select state</span>') 
			$('#state').focus();
			return false; 
		}else if ($('#city').val() == '') { 
			$('#city_err').html('<span class="text-red">Please enter select city</span>') 
			$('#city').focus();
			return false; 
		}else if ($('#experience').val() == '') { 
			$('#experience_err').html('<span class="text-red">Please enter select experience</span>') 
			$('#experience').focus();
			return false; 
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
		}else if ($('#about').val() == '' || $('#about').val().trim().length == '') { 
			$('#about_err').html('<span class="text-red">Please enter maximum 50 character</span>') 
			$('#about').focus();
			return false; 
		/*}else if ($('#more_about').val() == '' || $('#more_about').val().trim().length == '' ) { 
			$('#more_about_err').html('<span class="text-red">Please enter minimum 180 character</span>') 
			$('#more_about').focus();
			return false; 
		}else if ($('#title').val() == '' || $('#title').val().trim().length == '' ) { 
			$('#title_err').html('<span class="text-red">Please enter title</span>') 
			$('#title').focus();
			return false; 
		}else if ($('#files').val() == '' || $('#files').val().trim().length == '' ) { 
			$('#files_err').html('<span class="text-red">Please enter minimum 180 character</span>') 
			$('#files').focus();
			return false; 
		}else if ($('#content').val() == '' || $('#content').val().trim().length == '' ) { 
			$('#content_err').html('<span class="text-red">Please enter minimum 180 character</span>') 
			$('#content').focus();
			return false; */
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
	$('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    })
    function validateAlphabet(value) {         
        var regexp = /^[a-zA-Z ]*$/;         
        return regexp.test(value);    
    }
    
    /*$(document).ready(function() {
        $("#about").keyup(function(){
            var content = $("#about").val(); 
            var words = content.split(/\s+/); 
            var num_words = words.length;  
            var max_limit=35;
            if(num_words>max_limit){
                var lastIndex = content.lastIndexOf(" ");
                $("#about").val(content.substring(0, lastIndex));
                
                $('#about_err').text('Limit Exceeding');
                return false;
            }
            else{
                $('#about_err').text(max_limit+1-num_words +" words remaining");
            }
        });
    });*/

    function checkWord(id,count){
        var content = $("#"+id).val(); 
        var words = content.split(/\s+/); 
        var num_words = words.length;  
        var max_limit=count;
        if(num_words>max_limit){
            var lastIndex = content.lastIndexOf(" ");
            $("#"+id).val(content.substring(0, lastIndex));
            
            //$('#'+id+'_err').text('Limit Exceeding');
            $('#'+id+'_err').text( (max_limit+1-num_words ) +" words remaining");
            return false;
        }
        else{
            //$('#'+id+'_err').text( (max_limit+1-num_words ) +" words remaining");
        }
        
		/*var str= $('#'+id).val();
		var words =  str.trim().split(/\s+/).length;
		if (words < count) {
    		$('#'+id+'_err').html('');
    	}else{
    		$('#'+id+'_err').html('<span class="text-red">' + (words) + ' words. Please enter maximum '+count + ' words.</span>');
    		return false;
    		 
    	}*/
    	
    }
    
	function checkCharector(id,count){
		var words= $('#'+id).val().length;
    	if (words < count) {
    		$('#'+id+'_err').html('');
    	}else{
    		$('#'+id+'_err').html('<span class="text-red">' + (words) + ' character. Please enter maximum '+count + ' character.</span>');
    		 
    	}
    	
    }
	function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
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

<?php $this->load->view('Page/template/footer'); ?>