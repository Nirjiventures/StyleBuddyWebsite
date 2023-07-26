<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">

	.text-red{

		color: #bd1f1f!important;

	}

</style>
<div class="main">
	<div class="container">
		<div class="manage_w">
			<div class="rightbar">
				<div class="container p-0">
					<div class="row">
						<div class="col-sm-6">
							<h3><?=$title;?></h3>
						</div>
						<div class="col-sm-6 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/boutiques')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>



				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				

				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
				 


				<div class="row mt-5">
					<div class="col-sm-12">
						<div class="row justify-content-center mb-5">
						 	<div class="col-sm-1 col-5 p-0">
							     <div class="uskk2 mb-2"> 
							     	<?php $img =  'assets/images/no-image.jpg';?>
							        <?php if(!empty($rowArray->image))  {?>
							            <?php 
							                $img1 =  'assets/images/vandor/'.$rowArray->image; 
							                if (file_exists($img1)) {
							                    $img = $img1;
							                }
							            ?>
							        <?php } ?>

							     	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>"  class="img-fluid">

        							

	    						   
	    						</div>
							</div>
						    
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="fname" name="fname" value="<?= $rowArray->fname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">First name<span class="text-danger">*</span></label>
									<?php echo form_error('fname','<span class="text-danger mt-1">','</span>') ;?>
									<div id="fname_err"></div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="lname" name="lname" value="<?= $rowArray->lname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Last name<span class="text-danger">*</span></label>
									<?php echo form_error('lname','<span class="text-danger mt-1">','</span>') ;?>
									<div id="lname_err"></div>
								</div>
							</div>
							<?php if($this->uri->segment(3)){$readonly='readonly';}else{$readonly='';}?>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="email" name="email" <?=$readonly?> value="<?= $rowArray->email ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Email<span class="text-danger">*</span></label>
									<?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
									<div id="email_err"></div>
								</div>
							</div>
							<div class="col-sm-4">

								<div class="form-group boot_sp">

									<input type="Password" id="password" name="password" value="" minlength="8" class="form-control box_in3" >

									<label class="form-control-placeholder2" for="Password">Password<span class="text-danger">*</span></label>

									<?php echo form_error('password','<span class="text-primary mt-1">','</span>') ;?>

									<div id="password_err"></div>

								</div>

							</div>



							 

							 
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="mobile" value="<?= $rowArray->mobile ?>" name="mobile" class="form-control box_in3 onlyInteger">
									<label class="form-control-placeholder2" for="mnumber">Mobile Number</label>
									<div id="mobile_err"></div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
										<select class="form-control box_in3"  id="experience" name="experience" >
		    								<option  disabled selected>Select Experience</option>
		    								<?php $aaa = array('< 1'=>'< 1 Years','1'=>'1+ Years','2'=>'2+ Years','3'=>'10-15 Years','15'=>'Above 15 Years');?>
		    								<?php 
		    								for ($i=1; $i < 17  ; $i++) { if($i == $rowArray->experience){$sel='selected';}else{$sel='';}  if($i == 16){ $text = 'Above 15 Year';}else{$text = '< '.$i.' Year';}?>
		    									<option value="<?=$i?>" <?=$sel?>><?=$text?></option>
		    								<?php } ?>
		    						</select>
									<label class="form-control-placeholder2" for="Password">Years of Experience<span class="text-danger">*</span></label>
									<?php echo form_error('experience','<span class="text-primary mt-1">','</span>') ;?>
									<div id="experience_err"></div>
								</div>
							</div>
  

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="address" name="address" value="<?= $rowArray->address ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="address">Address</label>
									<div id="experience_err"></div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="pin" name="pin" value="<?= $rowArray->pin ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="pin">Pincode</label>
									<div id="experience_err"></div>
								</div>
							</div>
							 

							 
							
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="behance_link" name="behance_link" value="<?= $rowArray->behance_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">Behance Link</label>
									<div id="behance_link_err"></div>
								</div>
							</div>
							
 							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="country" id="country">
							            <option>Select Country</option>
							            <?php if($country) { foreach($country as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($rowArray->country == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="Password">country</label>
								</div>
							</div>
              				<div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="state" id="state">
							            <option>Select State</option>
							            <?php if($states) { foreach($states as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($rowArray->state == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="state">state</label>
								</div>
							</div>
							<div class="col-sm-4">
	    						<div class="form-group boot_sp">
	    							<select class="form-control box_in3" name="city" id="city">
	    							   	<option value="">Select City</option>
	    							   	<option value="<?=$rowArray->city?>" selected><?= $rowArray->city_name ?></option>
	    							    
	    							</select>
	    							<label class="form-control-placeholder2" for="dob">City<span class="text-danger">*</span></label>
	    						</div>
	    					</div> 

                            
                            
                            <div class="col-sm-4">
	                            <div class="form-group boot_sp">
	                            	<input type="file" class="form-control box_in3" name="image" accept=".jpg,.jpeg" >
		    						
		    						<?php if($this->session->flashdata('imgerror')) {  ?>
		    						<span class="bg-danger text-white p-2"><?= $this->session->flashdata('imgerror');  ?></span>
		    						<?php } ?>
		    						<label class="form-control-placeholder2" for="dob">Profile Pic</label>

					  	      	</div>
				  	      	</div>
							
							<!-- <div class="col-sm-12">
								<div class="form-group boot_sp">
									<textarea class="form-control box_in3" id="about" name="about" style="height: 100px!important;"><?= $rowArray->about ?></textarea>
									<label class="form-control-placeholder2" for="pin">About Me short</label>
									<div id="about_err"></div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group boot_sp">
								    
									<textarea class="form-control box_in3" id="editor1" name="more_about" style="height: 100px!important;"><?= $rowArray->more_about ?></textarea>
									<label class="form-control-placeholder2" for="ab">More About Me</label>
									<script type="text/javascript"> CKEDITOR.replace("editor1"); </script>
									<div id="editor1_err"></div>
								</div>
							</div> -->
						</div>
						
							
							<div class="col-sm-12 text-center">
								<input type="submit" value="Submit" class="btc">
							</div>
						
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
	    $('#state').on('change',function(){
	      var state_id = $(this).val();
	      if(state_id) {
	          $.ajax({
	                type:'POST',
	                url:"<?= base_url('city-data')?>",
	                data:'state_id='+state_id,
	                success:function(html){
	                    $('#city').html(html);
	                }
	            }); 
	      } else {
	          $('#city').html('<option value="">Select state first</option>');
	      } 
	    });
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

        }else if ($('#gender').val() == '') { 

			$('#gender_err').html('<span class="text-red">Please select gender</span>') 

			$('#gender').focus();

			return false; 

		}else if ($('#mobile').val() == '') { 

			$('#mobile_err').html('<span class="text-red">Please enter mobile number</span>') 

			$('#mobile').focus();

			return false; 

		}else if ($('#address').val() == '') { 

			$('#address_err').html('<span class="text-red">Please enter address</span>') 

			$('#address').focus();

			return false; 

		}else if ($('#pin').val() == '') { 

			$('#pin_err').html('<span class="text-red">Please enter pincode</span>') 

			$('#pin').focus();

			return false; 

		}else{

			$('#registration-form').get(0).submit();

			return true;

		}
    });
    $('.onlyInteger').on('keypress', function(e) {

      keys = ['0','1','2','3','4','5','6','7','8','9','.']

      return keys.indexOf(event.key) > -1

    })

    function validateAlphabet(value) {         

        var regexp = /^[a-zA-Z ]*$/;         

        return regexp.test(value);    

    }

	function checkWord(id,count){

		var words= $('#'+id).val().length;

    	if (words > count) {

    		$('#'+id+'_err').html('');

    	}else{

    		$('#'+id+'_err').html('<span class="text-red">' + (words + 1) + ' character. Please enter minimum '+count + ' character.</span>');

    		 

    	}

    	

    }

	function IsEmail(email) {     

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        console.log(regex.test(email))
        return regex.test(email);   

    }

</script>
</body>
</html>

<style type="text/css">
	.text-green{
		font-weight: bold;
		color: green!important;
	}
</style>
<?php $this->load->view('front/vandor/footer'); ?>
