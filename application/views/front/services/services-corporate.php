<?php $section3  =  $seoData; ?>

<style>.fg_gp span {

    float: left;

}</style>

<div class="new_banner_stylish2">

    <div class="row m-0 align-items-center">

        <div class="col-sm-6 p-0">

        </div>

        <div class="col-sm-6 p-0 ">

            <div class="new_sk2">

                <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-bs-ride="carousel">

					<div class="carousel-inner">

						<div class="carousel-item active">

					      <img src="<?php echo base_url(); ?>assets/images/c-banner1.png" class="d-block">

					    </div>

					    <div class="carousel-item">

					      <img src="<?php echo base_url(); ?>assets/images/c-banner2.png" class="d-block">

					    </div>

					    <div class="carousel-item">

					      <img src="<?php echo base_url(); ?>assets/images/c-banner3.png" class="d-block">

					    </div>



						



					</div>

				</div>

            </div>

        </div>

        

    </div>



    <div class="baner_info2 baner_info3">

    	<div class="container">

    		<div class="stylish_rg2 col-sm-7">

                <h1>Corporate Styling Services</h1>

                <p>We provide extensive packages and memberships to corporate who want to get access to our styling services. </p>

                <a href="<?=base_url('contact-us')?>" class="  action_bt_2">Contact Us</a>

                <?php if (!$this->session->userdata('userType')) { ?>

                	<a href="<?=base_url('corporate-login')?>" class="  action_bt_2">Login</a>

                <?php } ?>

            </div>

    	</div>

    </div>

    

</div>



<section class="benefits">

	<div class="container">

		

		<div class="title_part ">

			<h2 class="font40 fontfamily">Benefits for your Employees</h2>

		</div>





		<div class="benefits_data">

			<div class="row m-0">

					

				<div class="col-sm-11 p-0">



					<div class="row m-0">

						<div class="col-sm-3 col-6">

							<div class="my_benn">

								<p>Custom Styling Services at discounted pricing</p>

							</div>

						</div>



						<div class="col-sm-3 col-6">

							<div class="my_benn">

								<p>Group Interactive Styling Session with our Stylist</p>

							</div>

						</div>



						<div class="col-sm-3 col-6">

							<div class="my_benn">

								<p>Build their Confidence & presentation</p>

							</div>

						</div>



						<div class="col-sm-3 col-6">

							<div class="my_benn">

								<p>Boost Employee Happiness & get more deals</p>

							</div>

						</div>

					</div>



				</div>

			</div>

		</div>



	</div>

</section>





<section class="why_stylee">



	<div class="container">

		

		<div class="title_part why_hed">

			<h2 class="font40 fontfamily">Why Stylebuddy?</h2>

			<p>As one of the earliest companies to offer styling focused services, our goal is to empower individuals with great style.</p>

		</div>





		<div class="why_data">

			

			<ul>

				<li>

					<div class="why_photo"><img src="<?php echo base_url(); ?>assets/images/why1.png"></div>

					<p>Friendly Stylist Support</p>

				</li>



				<li>

					<div class="why_photo"><img src="<?php echo base_url(); ?>assets/images/why2.png"></div>

					<p>Supporting Communities</p>

				</li>



				<li>

					<div class="why_photo"><img src="<?php echo base_url(); ?>assets/images/why3.png"></div>

					<p>Quality Styling Delivered</p>

				</li>



				<li>

					<div class="why_photo"><img src="<?php echo base_url(); ?>assets/images/why4.png"></div>

					<p>Exclusive Employee Rewards</p>

				</li>



				<li>

					<div class="why_photo"><img src="<?php echo base_url(); ?>assets/images/why5.png"></div>

					<p>Styling for Everyone across India</p>

				</li>



			</ul>



		</div>



	</div>



	<img src="<?php echo base_url(); ?>assets/images/why_girl.png" class="why_girl">

</section>







<section class="read_make">

	<div class="container">

		<div class="my_read">

			<div class="row m-0 align-items-center">

				<div class="col-sm-8">

					<div class="make_ppp">Ready to make your employees look more stylish & confident?</div>

				</div>

				<div class="col-sm-4 p-0">

					<img src="<?php echo base_url(); ?>assets/images/raed_mm.png" class="img-fluid">

				</div>

			</div>

		</div>

	</div>

</section>





<section class="conn_me">

	<div class="container">

		<div class="title_part ">

			<h2 class="font40 fontfamily">Connect with us</h2>

		</div>



		<div class="conn_styy">

			<?php 

				/*if ($this->session->flashdata('message_success_corporate_lead')) {

					echo $this->session->flashdata('message_success_corporate_lead');

				}*/

			?>

			<?= form_open_multipart('',['id'=>'loginForm','name'=>'loginForm','method'=>'post']) ?>

				<div class="row m-0">

					<div class="col-sm-4">

						<div class="fg_gp">

	                        <input type="text" id="fname" name="fname" placeholder="Your First Name" class="box_new"  onkeypress="return IsAlphaNumeric(event,'fname_err');">

	                        <i class="fa fa-user" aria-hidden="true"></i>

	                        <div id="fname_err"></div>

	                    </div>

					</div>

	            	<div class="col-sm-4">

	            	 	<div class="fg_gp">

	                    	<input type="text" id="lname" name="lname" placeholder="Your Last Name" class="box_new"  onkeypress="return IsAlphaNumeric(event,'lname_err');">

	                   	 	<i class="fa fa-user" aria-hidden="true"></i>

	                    	<div id="lname_err"> </div>

	                	</div>

	                </div>

	            	<div class="col-sm-4">

	            		<div class="fg_gp">

	                   	 	<input type="email" id="email_corporate" name="email" placeholder="Your Email" class="box_new">

	                    	<i class="fa fa-envelope" aria-hidden="true"></i>

	                  	  	<div id="email_err"> </div>

	               		</div>

	               	</div>

	               	<div class="col-sm-4">

	            		<div class="fg_gp">

	                   	 	<select id="country" name="country" class="box_new">

	                   	 		<option  value="" disabled>Select Country</option>

	                   	 	    <?php if($country) { foreach($country as $state) { ?>

							        <option value="<?= $state->id ?>"><?= $state->name ?></option>

							   	<?php }} ?>

	                    	</select>

	                    	<i class="fa fa-globe" aria-hidden="true"></i>

	                  	  	<div id="country_err"> </div>

	               		 </div>

	               	</div>

	               	<div class="col-sm-4">

	            		<div class="fg_gp">

	                   	 	<select id="state" name="state" class="box_new">

	                   	 		<option  value="">Select state</option>

	                   	 	    <?php if($states) { foreach($states as $state) { ?>

							        <option value="<?= $state->id ?>"><?= $state->name ?></option>

							   	<?php }} ?>

	                    	</select>

	                    	<i class="fa fa-globe" aria-hidden="true"></i>

	                  	  	<div id="state_err"> </div>

	               		 </div>

	               	</div>

	               	<div class="col-sm-4">

						<div class="fg_gp">

							<select class="box_new"   name="city" id="city">

							   <option  value="">Select City <span class="text-danger">*</span></option>

							</select>
							<i class="fa fa-building-o" aria-hidden="true"></i>
							<?php echo form_error('city','<span class="text-primary mt-1">','</span>') ;?>

							<div id="city_err"></div>

						</div>

					</div>

	               	 

	               	<div class="col-sm-6">

	            		<div class="fg_gp">

	                   		<input type="text" id="company_name" name="company_name" placeholder="Company name" class="box_new"  onkeypress="return IsAlphaNumeric(event,'company_name_err');">

	                    	<i class="fa fa-building" aria-hidden="true"></i>

	                  	  	<div id="company_name_err"> </div>

	               		</div>

	               	</div>



	               	<div class="col-sm-6">

	            		<div class="fg_gp">

	                   	 	<input type="text" id="company_website" name="company_website" placeholder="Company Website" class="box_new">

	                    	<i class="fa fa-globe" aria-hidden="true"></i>

	                  	  	<div id="company_website_err"> </div>

	               		</div>

	               	</div>



	               	<div class="col-sm-6">

	            		<div class="fg_gp">

	                   	 	<select id="services" name="services" placeholder="" class="box_new">

	                   	 		<option value="" disabled>---which styling service do you need---</option>

	                   	 		<?php foreach ($our_services as $key => $value) { ?>

									<option value="<?=$value->title?>"><?=$value->title?></option>

								<?php }?>

	                   	 	</select>

	                    	<i class="fa fa-server" aria-hidden="true"></i>

	                  	  	<div id="services_err"> </div>

	               		</div>

	               	</div>



	               	<div class="col-sm-6">

	            		<div class="fg_gp">

	                   	 	<select id="no_of_employee" name="no_of_employee" placeholder="" class="box_new">

	                       	 	<option value="" disabled>---No. of employees in your company---</option>

	                       	 	<?php $a = array('5'=>'5','10'=>'10','15'=>'15','20'=>'20','30'=>'30','50'=>'50','50+'=>'50+','100'=>'100','100+'=>'100 Above'); ?>

	                       	 	<?php  foreach ($a as $key => $value) {?>

	                       	 		<option value="<?=$key?>"><?=$value?></option>

	                       	 	<?php } ?>

	                       	</select>

	                    	<i class="fa fa-list-ol" aria-hidden="true"></i>

	                  	  	<div id="no_of_employee_err"> </div>

	               		</div>

	               	</div>



	               	<div class="col-sm-12">

	            		<div class="fg_gp">

	                   	 	<textarea type="message" id="message" name="message" placeholder="Message" class="box_text3"></textarea>

	                    	<i class="fa fa-message" aria-hidden="true"></i>

	                  	  	<div id="message_err"> </div>

	               		</div>

	               	</div>



	       			<div class="col-sm-12 text-center mt-2">

			    		<div class="form-group">

							<input type="submit" value="Submit" class="subscribe_bt">

							<div id="success_msg"></div>

						</div>

			    	</div>

	        	</div>

        	<?= form_close(); ?>

     	</div>

	</div>

</section>

 <script type="text/javascript">





 	



	

	function exMatch(t){

		var expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;

		var regex = new RegExp(expression);

		//var t = 'www.google.com';

		if (t.match(regex)) {

		  return true;

		} else {

		  return false;

		}

	}



	$(document).ready(function() {

		$('#loginForm').on('submit',function(e){

		    e.preventDefault();

	      	$('#fname_err').html('');

	      	$('#lname_err').html('');

	      	$('#email_err').html('');

	      	$('#company_website_err').html('');

	      	$('#country_err').html('');

	      	$('#state_err').html('');

	      	$('#city_err').html('');

	      	$('#company_name_err').html('');

	      	$('#services_err').html('');

	      	$('#no_of_employee_err').html('');

	      	$('#message_err').html('');

	     	var company_website  = $('#company_website').val()

	      	

	      	if($('#fname').val() == '') {

	          	$('#fname_err').html('<span class="text-danger">Please enter fname</span>');

	          	$('#fname').focus();

	          	return false; 

	      	}else if($('#lname').val() == '') {

	          	$('#lname_err').html('<span class="text-danger">Please enter lname</span>');

	          	$('#lname').focus();

	          	return false; 

	      	}else if($('#email_corporate').val() == '') {

	          	$('#email_err').html('<span class="text-danger">Please enter email</span>');

	          	$('#email_corporate').focus();

	          	return false; 

	      	}else if(!$('#country').val()) {

	          	$('#country_err').html('<span class="text-danger">Please select country</span>');

	          	$('#country').focus();

	          	return false; 

	      	}else if(!$('#state').val()) {

	          	$('#state_err').html('<span class="text-danger">Please select state</span>');

	          	$('#state').focus();

	          	return false; 

	      	}else if(!$('#city').val() ) {

	          	$('#city_err').html('<span class="text-danger">Please select city</span>');

	          	$('#city').focus();

	          	return false; 

	      	}else if($('#company_name').val() == '') {

	          	$('#company_name_err').html('<span class="text-danger">Please enter company name</span>');

	          	$('#company_name').focus();

	          	return false; 

	      	}else if(!exMatch(company_website)) {

	          	$('#company_website_err').html('<span class="text-danger">Please enter company website name</span>');

	          	$('#company_website').focus();

	          	return false; 

	      	}else if(!$('#services').val()) {

	          	$('#services_err').html('<span class="text-danger">Please select services</span>');

	          	$('#services').focus();

	          	return false; 

	      	}else if(!$('#no_of_employee').val()) {

	          	$('#no_of_employee_err').html('<span class="text-danger">Please enter no of employee</span>');

	          	$('#no_of_employee').focus();

	          	return false; 

	      	}else if($('#message').val() == '') {

	          	$('#message_err').html('<span class="text-danger">Please enter message</span>');

	          	$('#message').focus();

	          	return false; 

	      	}else{

	        	$('#loginForm').get(0).submit();

	        	return true;

	      	}

		});    

	});

</script>