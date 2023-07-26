<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->
<!--<div class="container mt-3">-->
<!--<div class="banner_inner banner_inner2">-->
<!--	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/new/design-banner.jpg" class="img-fluid">-->
<!--	<div class="top_title2">-->
<!--		<div class="container"><h3>It's the Next</h3> <h4>big fashion idea</h4> <p>Join a thriving community of stylists and make the world a stylish place.</p></div>-->
<!--	</div>-->
	
<!--	</div>-->
<!--</div>-->
<!--========End Banner Area ========-->	


<div class="register_part pos">
	
	<div class="container register_form">
	
	     <?= form_open_multipart('registration',['id'=>'registration-form','name'=>'registration-form']) ?>
		<div class="row m-0 justify-content-center">
			
			<div class="col-sm-12">
			    <div class="register_fm">
				<div class="row">
					
					<div class="col-sm-12"><div class="logo_p text-center"><h4>Stylist Registration</h4></div></div>
					<div class="col-sm-12"><div class="logo_p text-center"><p>if you have an account please <a href="<?= base_url('login'); ?>" class="text-primary text-decoration-none">Login</a></p></div></div>
					<div class="col-sm-12">
					    <div class="logo_p text-center mb-4">
					    <?//=  ?>
					    </div>
				   </div>
					
					<div class="col-sm-12 mb-4">
						  <div>
						  	<label><b>Profile Image<span class="text-danger">*</span></b></label>
							<a class='btn btn-primary' href='javascript:;'>
								Choose File...
								<input type="file" id="image" name="image" accept=".jpg,.png,.jpeg" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40">
							</a>
							&nbsp;
							<span class='label label-info' id="upload-file-info"></span>
							<div id="image_err"></div>
						</div>
						<?php if($this->session->flashdata('imgerror') || $this->session->flashdata('imgBerror')) { ?>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgerror') ?></div>
						    <div class="text-primary p-2"><?= $this->session->flashdata('imgBerror') ?></div>
						<?php } ?>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="fname" name="fname" value="<?php echo set_value('fname') ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="fname">First Name<span class="text-danger">*</span></label>
							<?php echo form_error('fname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="fname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="lname" name="lname" value="<?= set_value('lname') ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="fname">Last Name<span class="text-danger">*</span></label>
							<?php echo form_error('lname','<span class="text-primary mt-1">','</span>') ;?>
							<div id="lname_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="fname">Email<span class="text-danger">*</span></label>
							<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
							<div id="email_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="Password" id="password" name="password" value="<?= set_value('password') ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Password">Password<span class="text-danger">*</span></label>
							<?php echo form_error('password','<span class="text-primary mt-1">','</span>') ;?>
							<div id="password_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="Password" id="cpassword" name="cpassword" value="<?= set_value('cpassword') ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Password">Confirm Password<span class="text-danger">*</span></label>
							<?php echo form_error('cpassword','<span class="text-primary mt-1">','</span>') ;?>
							<div id="cpassword_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<select class="form-control box_in3" name="gender"id="gender" >
								<option value="">Select Gender</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							<label class="form-control-placeholder2" for="Password">Gender<span class="text-danger">*</span></label>
							<?php echo form_error('gender','<span class="text-primary mt-1">','</span>') ;?>
							<div id="gender_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="mobile" name="mobile" class="form-control box_in3">
							<label class="form-control-placeholder2" for="mobile">Mobile Number<span class="text-danger">*</span></label>
						    <?php echo form_error('mobile','<span class="text-primary mt-1">','</span>') ;?>
						    <div id="mobile_err"></div>
						</div>
						
					</div>
                    
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
							  <select class="form-control box_in3" name="state" id="state" >
							   <option  value="">Select State</option>
							   <?php if($states) { foreach($states as $state) { ?>
							        <option value="<?= $state->id ?>"><?= $state->name ?></option>
							   <?php }} ?>
							  </select>
							<label class="form-control-placeholder2" for="state">State<span class="text-danger">*</span></label>
							<?php echo form_error('state','<span class="text-primary mt-1">','</span>') ;?>
							<div id="state_err"></div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<select class="form-control box_in3"   name="city" id="city">
							   <option  value="">Select City <span class="text-danger">*</span></option>
							</select>
							<label class="form-control-placeholder2"  for="dob">Location<span class="text-danger">*</span></label>
							<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>
							<div id="city_err"></div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group boot_sp">
								<select class="form-control box_in3"  id="experience" name="experience" >
    								<option  value="">Select Experience</option>
    								<option value="1-5">1-5 Years</option>
    								<option value="5-10">5-10 Years</option>
    								<option value="10-15">10-15 Years</option>
    								<option value="15">Above 15</option>
							</select>
							<label class="form-control-placeholder2" for="Password">Years of Experience<span class="text-danger">*</span></label>
							<?php echo form_error('experience','<span class="text-primary mt-1">','</span>') ;?>
							<div id="experience_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="address" name="address"  value="<?= set_value('address') ?>"  class="form-control box_in3">
							<label class="form-control-placeholder2" for="address">Address<span class="text-danger">*</span></label>
							<?php echo form_error('address','<span class="text-primary mt-1">','</span>') ;?>
							<div id="address_err"></div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="pin" name="pin" value="<?= set_value('pin') ?>" class="form-control box_in3">
							<label class="form-control-placeholder2" for="pin">Pincode<span class="text-danger">*</span></label>
							<?php echo form_error('pin','<span class="text-primary mt-1">','</span>') ;?>
							<div id="pin_err"></div>
						</div>
					</div>
     
                    <div class="col-sm-4">
						<div class="form-group boot_sp">
							<input type="text" id="instagram_nlink" name="instagram_nlink"   value="<?= set_value('instagram_nlink') ?>"class="form-control box_in3">
							<label class="form-control-placeholder2" for="inlink">Instagram Link<span class="text-danger">*</span></label>
							<?php echo form_error('instagram_nlink','<span class="text-primary mt-1">','</span>') ;?>
							<div id="instagram_nlink_err"></div>
						</div>
					</div>					
					<div class="col-sm-4">
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
					</div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<textarea class="form-control box_in33 border border-dark"  onkeypress="checkWord('about',50)" minlength="50" id="about" name="about" rows="3" placeholder="Minimum 50 character"><?= set_value('about') ?></textarea>
							<label class="form-control-placeholder2" for="about">About Me short<span class="text-danger">*</span></label>
							<?php echo form_error('about','<span class="text-primary mt-1">','</span>') ;?>
							<!-- Minimum 50 character <span id="short_message"></span> -->
							<div id="about_err"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group boot_sp">
							<textarea class="form-control box_in33 border border-dark" id="more_about" minlength="180" onkeypress="checkWord('more_about',180)" rows="5" name="more_about" placeholder="Minimum 180 character"><?= set_value('more_about') ?></textarea>
							<label class="form-control-placeholder2" for="more_about">More About Me<span class="text-danger">*</span></label>
							<?php echo form_error('more_about','<span class="text-primary mt-1">','</span>') ;?>
							<!-- Minimum 180 character <span id="long_message"></span> -->
							<div id="more_about_err"></div>
						</div>
						<script>//  CKEDITOR.replace( 'editor1' );</script>
					</div>
				</div>
                <div class="col-md-12 dynamic_row">    
                <div class="row ">
                    <div class="col-md-12 mb-3"><h4>Add Portfolio</h4></div>
                    
                    <div class="col-md-4">
                        <div class="form-group boot_sp">
							<input type="text" name="title[]"  value="<?//= set_value('title') ?>"class="form-control box_in3">
							<label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label>
						</div>
                    </div>
                    <div class="col-md-4">
                          
                          <div class="form-group boot_sp">
							<input type="file"  accept=".png, .jpg, .jpeg" name="gallery_image[]" multiple class="form-control box_in3">
							<label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label>
						 </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group boot_sp">
							<select id="tag_id"  name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select"data-placeholder="Begin typing a tag to filter...">
    							
    							 <?php if(!empty($tags)) { foreach($tags as $list) { ?>    								
    								<option class="Female" value="<?= $list->id ?>"><?= $list->tag ?></option>
    							 <?php } } ?>
    							</select> 
							<label class="form-control-placeholder2" for="fname">#Tags</label>
						 </div>
                    </div>
                    <div class="col-md-12 m">
                         <div class="form-group boot_sp mb-0">
							<textarea  class="form-control box_in33 border border-dark"   maxlength="180" rows="5" name="content[]" placeholder=""><?//= set_value('content') ?></textarea>
							<label class="form-control-placeholder2" for="pin">Portfolio Description<span class="text-danger">*</span></label>
						</div>
                    </div>
                </div> 
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn-plus add_more"><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                    </div>
                </div>
                


				<div class="row box_checkbox">
					<div class="col-sm-12 mt-4">
						<div class="form-group">
							<label><b>Area Of Expertise / Interests<span class="text-danger">*</span></b></label>
						</div>
					</div>
                    <?php if(!empty($style)) {  foreach($style as $list) {  
                            if($list->name == 'Creating Lookbooks') {
                                continue;    } ?>
					<div class="col-sm-4">
						<div class="form-check checkbox-group"> 
						  <input class="form-check-input" type="checkbox" name="expertise[]" value="<?= $list->id ?>" id="flexCheckDefault-<?= $list->id ?>">
						  <label class="form-check-label" for="flexCheckDefault-<?= $list->id ?>">
						   <?= $list->name ?>
						  </label>
						  	<?php //echo form_error('expertise','<span class="text-primary mt-1">','</span>') ;?>
						</div>
					</div>
                    <?php  } } ?>
	
				</div>
                
				<div class="row mb-4 mt-2">
					
					<div class="col-sm-12 text-center">
						<input type="submit" value="SUBMIT" class="btn2">
					</div>
				</div>

				<div class="row align-item-center">
					
				</div>
			</div>
			</div>	
		</div>
	    <?= form_close() ?>
	</div>
</div>
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
$('.add_more').click(function(){
	$.ajax({
        url: '<?php echo base_url(); ?>vendor/gettags',
        type: "POST",
        success: function (res) {
        	$('.dynamic_row').append('<div class="col-md-12 remove_row"> <div class="row"> <div class="col-md-4"><div class="form-group boot_sp"><input type="text" required name="title[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Title<span class="text-danger">*</span></label></div></div><div class="col-md-4"><div class="form-group boot_sp"><input type="file" required accept=".png, .jpg, .jpeg" name="gallery_image[]" class="form-control box_in3"><label class="form-control-placeholder2" for="inlink">Portfolio Image<span class="text-danger">*</span></label></div></div><div class="col-md-4"><div class="form-group boot_sp"><select id="tag_id" name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select" data-placeholder="Begin typing a tag to filter..." > '+res+' </select><label class="form-control-placeholder2" for="fname">#Tags</label></div></div><div class="col-md-12 m"><div class="form-group boot_sp mb-0"><textarea required class="form-control box_in33 border border-dark" maxlength="180" rows="5" name="content[]" placeholder=""></textarea><label class="form-control-placeholder2" for="pin">Portfolio Description<span class="text-danger">*</span></label></div></div><div class="col-md-12 text-right"><a class="btn-plus remove_more"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove</a></div> </div> </div>');

             
        }
    })

    //$(this).hide();
    console.log('click');
});
$("body").on("click",".remove_more",function(e) { 
         e.preventDefault();
        $(this).parents(".remove_row").remove();
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
        
        /*if($('#image').val() == '' || $('#image').val().trim().length == '') {
            $('#image_err').html('<span class="text-primary">Please select Image</span>');
            $('#image').focus();
            return false; 
        } else if($('#fname').val() == '' || $('#fname').val().trim().length == '') {
            $('#fname_err').html('<span class="text-primary">Please enter your Last Name</span>');
            $('#fname').focus();
            return false;
        } else if($('#lname').val() == '' || $('#lname').val().trim().length == '') {
            $('#lname_err').html('<span class="text-primary">Please enter your Last Name</span>');
            $('#lname').focus();
            return false;
        } else if($('#email').val() == '') {
            $('#email_err').html('<span class="text-primary">Please enter email</span>');
            $('#email').focus();
            return false; 
        } else if(!IsEmail($('#email').val())) {
            $('#email_err').html('<span class="text-primary">Please enter correct email</span>');
            $('#email').focus();
            return false; 
        } else if($('#password').val() == '' || $('#password').val().trim().length == '') {
            $('#password_err').html('<span class="text-primary">Please enter password</span>');
            $('#password').focus();
            return false; 
        } else if($('#cpassword').val() == '' || $('#cpassword').val().trim().length == '') {
            $('#cpassword_err').html('<span class="text-primary">Please enter confirm password</span>');
            $('#cpassword').focus();
            return false; 
        }else if ($('#password').val() != $('#cpassword').val()) { 
			$('#cpassword_err').html('<span class="text-primary">Password did not match: Please try again...</span>') 
			$('#cpassword').focus();
			return false; 
		}else */if ($('#gender').val() == '') { 
			$('#gender_err').html('<span class="text-primary">Please select gender</span>') 
			$('#gender').focus();
			return false; 
		}else if ($('#mobile').val() == '' || $('#mobile').val().trim().length == '') { 
			$('#mobile_err').html('<span class="text-primary">Please enter mobile number</span>') 
			$('#mobile').focus();
			return false; 
		}else if ($('#state').val() == '' || $('#state').val().trim().length == '') { 
			$('#state_err').html('<span class="text-primary">Please select state</span>') 
			$('#state').focus();
			return false; 
		}else if ($('#city').val() == '' || $('#city').val().trim().length == '') { 
			$('#city_err').html('<span class="text-primary">Please enter select city</span>') 
			$('#city').focus();
			return false; 
		}else if ($('#experience').val() == '' || $('#experience').val().trim().length == '') { 
			$('#experience_err').html('<span class="text-primary">Please enter select experience</span>') 
			$('#experience').focus();
			return false; 
		}else if ($('#address').val() == '' || $('#address').val().trim().length == '') { 
			$('#address_err').html('<span class="text-primary">Please enter address</span>') 
			$('#address').focus();
			return false; 
		}else if ($('#pin').val() == '' || $('#pin').val().trim().length == '') { 
			$('#pin_err').html('<span class="text-primary">Please enter pincode</span>') 
			$('#pin').focus();
			return false; 
		}else if ($('#instagram_nlink').val() == '' || $('#instagram_nlink').val().trim().length == '') { 
			$('#instagram_nlink_err').html('<span class="text-primary">Please enter instagram link</span>') 
			$('#instagram_nlink').focus();
			return false; 
		}else if ($('#about').val() == '' || $('#about').val().trim().length == '') { 
			$('#about_err').html('<span class="text-primary">Please enter minimum 50 character</span>') 
			$('#about').focus();
			return false; 
		}else if ($('#more_about').val() == '' || $('#more_about').val().trim().length == '' ) { 
			$('#more_about_err').html('<span class="text-primary">Please enter minimum 180 character</span>') 
			$('#more_about').focus();
			return false; 
		}else if ($('#title').val() == '' || $('#title').val().trim().length == '' ) { 
			$('#title_err').html('<span class="text-primary">Please enter title</span>') 
			$('#title').focus();
			return false; 
		}else if ($('#files').val() == '' || $('#files').val().trim().length == '' ) { 
			$('#files_err').html('<span class="text-primary">Please enter minimum 180 character</span>') 
			$('#files').focus();
			return false; 
		}else if ($('#content').val() == '' || $('#content').val().trim().length == '' ) { 
			$('#content_err').html('<span class="text-primary">Please enter minimum 180 character</span>') 
			$('#content').focus();
			return false; 
		}else{
			$('#registration-form').get(0).submit();
			return true;
		}
    });
            
});
	function checkWord(id,count){
		var words= $('#'+id).val().length;
    	if (words > count) {
    		$('#'+id+'_err').html('');
    	}else{
    		$('#'+id+'_err').html((words + 1) + ' words. Please enter minimum '+count);
    	}
    	
    }
	function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
</script>


<?php $this->load->view('Page/template/footer'); ?>