	<div class="banner_inner">
		<div class="container">
			<h1>REPORT AN ISSUE</h1>
			<a href="<?=base_url()?>">Home</a> > Report an issue
		</div>
	</div>
	<div class="middle_part">
		<div class="container">
			<div class="report_issue">
				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
					<div class="row m-0 ">
						<div class="col-sm-6">
						  <div class="form-group boot_sp">
							<label class="" for="fname">First Name </label>
							<input type="text" id="fname" name="fname"  value="" class="box_new_2">
							<div id="fname_err"></div>
						  </div>
						</div>
						<div class="col-sm-6">
						  <div class="form-group boot_sp">
							<label class="" for="fname">Last Name</label>
							<input type="text" id="lname" name="lname"  value="" class="box_new_2">
							<div id="lname_err"></div>
						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="form-group boot_sp">
							<label class="" for="fname">Country *</label>
							<select class="form-control box_new_2" name="country" id="country" >
							   <option  value="" >Select Country</option>
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
							<label class="" for="fname">Phone</label>
							<input type="text" id="mobile" name="mobile" maxlength="10" class="form-control box_new_2 onlyInteger">
							<?php echo form_error('mobile','<span class="text-primary mt-1">','</span>') ;?>
						    <div id="mobile_err"></div>

						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="form-group boot_sp">
							<label class="" for="fname">Email *</label>
							<input type="text" id="email_report" name="email" value="" class="box_new_2">
							<?php echo form_error('email','<span class="text-primary mt-1">','</span>') ;?>
							<div id="email_err"></div>

							
						  </div>
						</div>
						<div class="col-sm-12">
						  <div class="form-group boot_sp">
							<p>What is the issue you are facing? </p>
							<div class="reporting_list">
								 
							  	<ul>
								  	<?php foreach ($report_an_issue_question as $key => $value) { ?>
								  		<li>
										  	<input name="expertise[]" type="checkbox" value="<?=$value->name?>" class="form-check-input checkarray" > <?=$value->name;?>
										</li>
								  	<?php  }?>
							  	</ul>
							  	<div id="expertise_err"></div>
							</div>
						  </div>
						</div>
						<div class="col-sm-12">
						  <div class="form-group boot_sp">
							<label class="" for="fname">Message</label>
							<textarea type="text" name="message"  name="message" value="" class="box_new_2 box_new_22"></textarea>
							<div id="message_err"></div>
						  </div>
						</div>
						<div class="col-sm-12">
						  <div class="form-group boot_sp">
						  	<div class="form-check checkbox-group"> 
	    	                    <input type="checkbox" class="form-check-input" id="terms" name="terms"> <label>i agree <a target="_blank" href="<?=base_url('terms-of-use')?>">Terms & Conditions</a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a> on this site.</label>
				            </div>
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

						<div class="col-sm-12 text-center">
							<input type="submit" value="Submit" class="action_bt_2">
						 	<!--  <input type="submit" value="SUBMIT" data-bs-toggle="modal" data-bs-target="#report_an_issue" data-backdrop="static" data-keyboard="false" class="action_bt_2"> -->
						</div>
					</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
 		$(document).ready(function(){
		    $('#registration-form').on('submit',function(e){
		        e.preventDefault();
		        $('#fname_err').html('');
		        $('#lname_err').html('');
		        $('#email_err').html('');
		        $('#mobile_err').html('');
		        $('#country_err').html('');
		        $('#message_err').html('');
		        $('#terms_err').html('');
		        $('#captcha_err').html('');
		        var searchIDs = $("input.checkarray:checkbox:checked").map(function(){
			      return $(this).val();
			    }).get(); 
			     
		        if($('#fname').val() == '') {
		            $('#fname_err').html('<span class="text-red">Please enter your First Name</span>');
		            $('#fname').focus();
		            return false;
		        } else if($('#lname').val() == '') {
		            $('#lname_err').html('<span class="text-red">Please enter your Last Name</span>');
		            $('#lname').focus();
		            return false;
		        }else if ($('#country').val() == '') { 
					$('#country_err').html('<span class="text-red">Please select state</span>') 
					$('#country').focus();
					return false; 
				}else if ($('#mobile').val() == '') { 
					$('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 
					$('#mobile').focus();
					return false; 
				} else if($('#email_report').val() == '') {
		            $('#email_err').html('<span class="text-red">Please enter email</span>');
		            $('#email_report').focus();
		            return false; 
		        } else if(!IsEmail($('#email_report').val())) {
		            $('#email_err').html('<span class="text-red">Please enter correct email</span>');
		            $('#email_report').focus();
		            return false; 
		        }else if(!searchIDs.length){
					$('#expertise_err').html('<span class="text-red">Please checked expertise</span>') 
					return false; 
				}else if(searchIDs.length>10){
					$('#expertise_err').html('<span class="text-red">Please checked expertise less than 10</span>') 
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