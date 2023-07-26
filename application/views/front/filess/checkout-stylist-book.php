<style type="text/css">

    #regiration_form fieldset:not(:first-of-type) {

        display: none;

    }



	.box_form {

	    width: 60%;

	    padding: 6px;

	    border-radius: 3px!important;

	    margin-bottom: 15px;

	}

	.fld p {

	    margin-bottom: 1px;

	}



	.btn_step {

	    background: #ff295d;

	    color: #FFF;

	    border: 0px!important;

	    padding: 10px 30px;

	    border-radius: 3px!important;

	    font-weight: bold;

	    letter-spacing: 2px;

	    text-transform: uppercase;

	}

	.fm{margin-bottom: 20px;}



	.stp2, .stp3, .stp4{display: none;}



	.stp2 input, .stp2 select, .stp3 input, .stp3 select{

	    background: transparent;

	    border: 1px solid #000;

	    color: #000;

	}



	.fm span {

	    background: #423f2e;

	    width: 30px;

	    height: 30px;

	    display: inline-block;

	    border-radius: 100px;

	    text-align: center;

	    color: #fff;

	    line-height: 30px;

	    font-size: 19px;

	}

	.summry .final_c b {

	    width: 46%;

	    display: inline-block;

	    font-weight: normal;

	    font-size: 14px;

	}



	.ck_im {

	    width: 100%;

	    height: 60px!important;

	    object-fit: cover;

	    border-radius: 4px;

	}

	.final_c {

	    margin-bottom: 8px;

	    border-bottom: 1px solid #caa98b;

	    padding-bottom: 10px;

	}

	.summry h5 {

	    margin-bottom: 0px;

	}

  </style>



<?php  $this->load->view('Page/template/header'); ?>

<div class="ab-banner_inner">
		<div class="container text-center"><h1>Stylist Booking</h1></div>
</div>
<?php
	$description        = "Product Description";
	$txnid              = date("YmdHis");     
	$key_id             = ROZARPAY_KEY;
	$currency_code      = $currency_code;            
	$totalCart              = ($package_price* 100); // 100 = 1 indian rupees
	$amountCart             = $package_price;
	$merchant_order_id  = "STYLE-".date("YmdHis");
?>
<?php
	$tax = ($package_price * 18)/100;
	
	$description        = "Product Description";
	$txnid              = date("YmdHis");     
	$key_id             = ROZARPAY_KEY;
	$currency_code      = $currency_code;            
	$totalCart              = ($package_price * 100) + ($tax * 100); // 100 = 1 indian rupees
	$amountCart             = $package_price + $tax;
	$merchant_order_id  = "STYLE-".date("YmdHis");
?>


<div class="middle_part">

	<div class="container">

		<?= form_open($callback_url,['id'=>'checkoutprocess','method'=>'post']); ?>

		<div class="row m-0">

			<div class="col-sm-8 m_padd">

				<div class="shipping_ads2">

					<div class="fm">

						<h4><span>1</span> Customer</h4>

						<hr>

						<?php if($this->session->userdata('userType')) { ?>

							<div class="fld">

								<p><b>Full Name : </b><?= ucfirst($user->fname.' '.$user->lname) ?></p>

							</div>

							<div class="fld">&nbsp;</div>

							<div class="fld">

									<input type="button" name="" value="NEXT" class="btn_step" id="next1">

							</div>



						<?php }else { ?>

							<p>Don't have an account? <a href="<?php echo base_url(); ?>user/registration"> Create an account</a> to continue.</p>

							

							<div class="fld">

								<?= $this->session->flashdata('message'); ?>

							</div>

							<div class="fld">

								<p>Email Address</p>

								<input type="text" name="userEmail" id="email"  class="box_form">

							</div>

							<div class="fld">

								<p>Password</p>

								<input type="password" name="userPassword" id="password" class="box_form">

							</div>

							<div class="fld">

								<input type="hidden" name="lastPage" value="<?=$lastPage?>">

								<input type="submit" name="" value="SIGN IN" class="btn_step" id="next1">

							</div>

						<?php } ?>

					</div>





				   	<div class="fm">



						<h4><span>2</span> Address</h4>

						<hr>
						<div class="stp2">
							<?php if($user){?>
								<div class=" row m-0">

									<div class="col-sm-4">



										<div class="form-group required-field">

											<label>First Name </label>

											<input type="text" id="fname" name="fname" value="<?= ($user->fname)?$user->fname:'' ?>" class="form-control">

											<div id="fname_Err"></div>

										</div>

									</div>



									<div class="col-sm-4">

										<div class="form-group required-field">

											<label>Last Name </label>

											<input type="text" id="lname" name="lname" value="<?= ($user->lname)?$user->lname:'' ?>" class="form-control">

											<div id="lname_Err"></div>

										</div>

									</div>



									<div class="col-sm-4">

										<div class="form-group required-field">

											<label>Phone Number </label>

											<input type="tel" id="mobile" name="mobile" value="<?= ($user->mobile)?$user->mobile:'' ?>" class="form-control onlyInteger">

											<div id="mobile_Err"></div>

										</div>

									</div>



									<!-- <div class="col-sm-4">

										<div class="form-group">

											<label>Company </label>

											<input type="text" id="company" name="company" value="<?= ($user->company)?$user->company:'' ?>" class="form-control">

											<div id="company_Err"></div>

										</div>

									</div>

									 -->

									<div class="col-sm-4">

					                    <div class="form-group">

											<label>Country</label>

											<div class="select-custom">

												<select class="form-control" id="country" name="country">

													<option value="India">India</option>

												</select>

												<div id="country_Err"></div>

											</div>

										</div>

								  	</div>

									<div class="col-sm-8">

										<div class="form-group required-field">

											<label>Address (<small>House No, Flat, block, etc</small>)</label>

											<input type="text" id="address" name="address" value="<?= ($user->address)?$user->address:'' ?>" class="form-control">

											<div id="address_Err"></div>

										</div>

									</div>



									

				                    <div class="col-sm-4">

										<div class="form-group required-field">

											<label>State/Province</label>

											<input type="text" id="state" name="state" value="<?= ($user->state)?$user->state:'' ?>" class="form-control">

											<div id="state_Err"></div>

										</div>

									</div>

									<div class="col-sm-4">

										<div class="form-group required-field">

											<label>City  </label>

											<input type="text" class="form-control" id="city"  name="city" value="<?= ($user->city)?$user->city:'' ?>">

											<div id="city_Err"></div>

										</div>

									</div>



									<div class="col-sm-4">

										<div class="form-group required-field">

											<label>Zip/Postal Code </label>

											<input type="text" class="form-control onlyInteger" id="zip" name="zip" value="<?= ($user->pin)?$user->pin:'' ?>">

											<div id="zip_Err"></div>

										</div>

									</div>

									<!-- <div class="col-sm-12 mb-4">

										<input type="checkbox" name="chk" class="" id="same_as"> <small>My billing address is the same as my shipping address..</small>

									</div> -->



									<div class="col-sm-12"><button type="button" class="btn_step hide_bt" id="next2">Next</button></div>

								</div>
							<?php } ?>
						</div>
					</div>
					<div class="fm">
						<h4><span>3</span> Payment</h4>
						<hr>
						<div class="stp3">
							<div class="pay_opt">
                                <?php if($user){?>
                                    <input type="hidden" name="payment_tax" id="payment_tax" value="18"/>
    								<input type="hidden" name="payment_tax_total" id="payment_tax_total" value="<?php echo $tax; ?>"/>
    								<input type="hidden" name="grand_total" id="grand_total" value="<?php echo $amountCart; ?>"/>
    								<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
    						        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
    						        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
    						        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
    						        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
    						        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
    						        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
    						        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>
    						        <input type="hidden" name="vendor_id"  value="<?=$vendor_id?>">
    						        <input type="hidden" name="package_id"  value="<?=$package_id?>">
    						        <input type="hidden" name="package_price" value="<?=$package_price?>">
    						        <input type="hidden" name="package" value="<?=$package?>">
    								<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">
                                <?php }?>
								<!-- <p><input name="pay_type" type="radio" value="ccavanue"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/ccavanue.png" alt="ccavanue" title="ccavanue"></p> -->
								<p><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/razo.png" alt="ROZARPAY" title="RAZORPAY"></p>
								<!-- <p><input name="pay_type" type="radio" value="Cash on delivery"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/cod.png" alt="Cash on delivery " title="Cash on delivery "></p> -->
								<div id="pay_type_Err"></div>
								<div class="checkout-methods">
									<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="btn2" />
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-sm-4 m_padd">
				<?php 
					$txt = 'Classic';
			        if ($package == 'package_price_1') {
			           $txt = 'Classic';
			           $description = 'package_description_1';
			        }elseif ($package == 'package_price_2') {
			           $txt = 'Premium';
			           $description = 'package_description_2';
			        }elseif ($package == 'package_price_3') {
			           $txt = 'Luxury';
			           $description = 'package_description_3';
			        }

			        $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">
			                    <tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;" class="text-left"><b>'.$package_row['area_expertise_name'].' Package</b></td>
			                    </tr> 
			                    <tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>
			                    </tr>';
			                    $option .= '<tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($package_row[$package]) .'</b></td>
			                    </tr>';
			        $option .= '</table>';
			        
			        $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">
			                    <tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;" class="text-left"><b>Stylist Name : </b></td>
			                        <td style="border: 1px solid #333;" class="text-left">'.ucwords($vendor_row['fname'].' '.$vendor_row['lname']).'</td>
			                    </tr> 
			                    <tr style="border: 1px solid #333;">
			                        <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$package_row['area_expertise_name'].' Package</b></td>
			                    </tr> 
			                    <tr style="border: 1px solid #333;">
			                        <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>
			                    </tr>';
			                    $option .= '<tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;"> <b>Price : </b></td>
			                    	<td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($package_row[$package]) .'</b></td>
			                    	</tr>';
			                    $option .= '<tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;"> <b>GST @ 18% : </b></td>
			                    	<td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($tax) .'</b></td>
			                    	</tr>';
			                    $option .= '<tr style="border: 1px solid #333;">
			                        <td style="border: 1px solid #333;"> <b>Total Payable : </b></td>
			                    	<td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($amountCart) .'</b></td>
			                    	</tr>';
			        $option .= '</table>';

					echo $option;

				?>
			</div>
		</div>

		<?= form_close(); ?>   

	</div>

</div>

<?php $this->load->view('Page/template/footer'); ?>



<script>

	$(document).ready(function(){

	  $("#next1").click(function(){

	    $(".stp2").show();

	  });

	  $("#next2").click(function(){

	     $(".stp3").show();

	     $(".hide_bt").hide();	     

	  });

	  $("#next3").click(function(){

	     $(".stp4").show();

	     $(".hide_bt2").hide();	     

	  });

	});

</script>



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

	$('.onlyInteger').on('keypress', function(e) {

      keys = ['0','1','2','3','4','5','6','7','8','9','.']

      return keys.indexOf(event.key) > -1

    }) 

    function validateAlphabet(value) {         

        var regexp = /^[a-zA-Z ]*$/;         

        return regexp.test(value);    

    }   

    function IsEmail(email) {     

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       

        return regex.test(email);   

    } 

    function ValidateEmail(e) {

        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        return expr.test(e);

    };

    var razorpay_pay_btn, instance;

    function razorpaySubmit(el) {

    	$('#fname_Err').html('');

    	$('#lname_Err').html('');

    	$('#mobile_Err').html('');

    	$('#email_Err').html('');

    	$('#address_Err').html('');

    	//$('#company_Err').html('');

    	//$('#country_Err').html('');

    	$('#state_Err').html('');

    	$('#city_Err').html('');

    	$('#zip_Err').html('');

    	$('#pay_type_Err').html('');

    	

    	if(!$('#fname').val()){

    		$('#fname_Err').html('Please enter first name');

    		$('#fname').focus();

    		return false

    	}else if(!$('#lname').val()){

    		$('#lname_Err').html('Please enter last name');

    		$('#lname').focus();

    		return false

    	}else if(!$('#mobile').val()){

    		$('#mobile_Err').html('Please enter mobile');

    		$('#mobile').focus();

    		return false

    	/*}else if(!$('#company').val()){

    		$('#company_Err').html('Please enter first name');

    		$('#company').focus();

    		return false

    	}else if(!$('#country').val()){

    		$('#country_Err').html('Please enter country name');

    		$('#country').focus();

    		return false

    	*/}else if(!$('#address').val()){

    		$('#address_Err').html('Please enter address name');

    		$('#address').focus();

    		return false

    	}else if(!$('#state').val()){

    		$('#state_Err').html('Please enter state name');

    		$('#state').focus();

    		return false

    	}else if(!$('#city').val()){

    		$('#city_Err').html('Please enter city name');

    		$('#city').focus();

    		return false

    	}else if(!$('#zip').val()){

    		$('#zip_Err').html('Please enter zip code');

    		$('#zip').focus();

    		return false

    	}else if(!$('input[name=pay_type]:checked').val()){

    		$('#pay_type_Err').html('Please checked Payment Method');

    		$('input[name=pay_type]').focus();

    		return false

    	}else{

    		if($('input[name=pay_type]:checked').val() == 'RAZORPAY'){



	    		var name = document.getElementById('fname').value + ' ' +document.getElementById('lname').value;

		    	var email = document.getElementById('email').value;

		    	var mobile = document.getElementById('mobile').value;



		    	var options = {

		            key:            "<?php echo $key_id; ?>",

		            amount:         "<?php echo $totalCart; ?>",

		            name:           name,

		            description:    "Order # <?php echo $merchant_order_id; ?>",

		            netbanking:     true,

		            currency:       "<?php echo $currency_code; ?>", // INR

		            prefill: {

		                name:       name,

		                email:      email,

		                contact:    mobile

		            },

		            notes: {

		                soolegal_order_id: "<?php echo $merchant_order_id; ?>",

		            },

		            handler: function (transaction) {

		                document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;

		                document.getElementById('checkoutprocess').submit();

		            },

		            "modal": {

		                "ondismiss": function(){

		                    location.reload()

		                }

		            }

		        };





		        if(typeof Razorpay == 'undefined') {

		            setTimeout(razorpaySubmit, 200);

		            if(!razorpay_pay_btn && el) {

		                razorpay_pay_btn    = el;

		                el.disabled         = true;

		                el.value            = 'Please wait...';  

		            }

		        } else {

		            if(!instance) {

		                instance = new Razorpay(options);

		                if(razorpay_pay_btn) {

		                razorpay_pay_btn.disabled   = false;

		                razorpay_pay_btn.value      = "Pay Now";

		                }

		            }

		            instance.open();

		        }

		    }else if($('input[name=pay_type]:checked').val() == 'ccavanue'){

		    	document.getElementById('checkoutprocess').action='<?=base_url()?>ccavanue/userOrder';

		    	document.getElementById('checkoutprocess').submit();

		    }else{

		    	document.getElementById('checkoutprocess').submit();

		    }

    	}

    	

    } 





    $('#same_as').on("click", function () {



        if ($(this).is(':checked')) {

			$('input[name=bill_fname]').val($('input[name=fname]').val());

			$('input[name=bill_lname]').val($('input[name=lname]').val());

			$('input[name=bill_mobile]').val($('input[name=mobile]').val());

			$('input[name=bill_address]').val($('input[name=address]').val());



			$('input[name=bill_state]').val($('input[name=state]').val());

			$('input[name=bill_city]').val($('input[name=city]').val());

			$('input[name=bill_zip]').val($('input[name=zip]').val());

			

        } else {



			$('input[name=bill_fname]').val('');



			$('input[name=bill_lname]').val('');



			$('input[name=bill_mobile]').val('');



			$('input[name=bill_country]').val('');



			$('input[name=bill_state]').val('');



			$('input[name=bill_city]').val('');



			$('input[name=bill_zip]').val('');



			$('input[name=bill_address]').val('');

			$('input[name=ship_address2]').val('');

        }

    });





</script>











