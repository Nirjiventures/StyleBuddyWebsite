<style type="text/css">
	.red{color: red;}
</style>
<div class="banner_inner_2">

	<div class="container">

		<h1>Checkout</h1>

		 

	</div>

</div> 

		 

<?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>

<?php 

	$cart_qty = 0;

	$cart_price = 0;

	$cart_typeArray = array();

	foreach ($cartArray as $key => $value) {

		if($value->in_stock){

			$cart_price += $value->total;

			$cart_qty += $value->quantity;

			if (!in_array($value->cart_type, $cart_typeArray)) {

				array_push($cart_typeArray, $value->cart_type);

			}

			

		}

	}

	

?>
<?php if (!$cart_qty) {redirect(base_url());} ?>


<?php

	$display_total = str_replace(",", '', $sessionArray->display_total);

	$description        = "Product Description";

	$txnid              = date("YmdHis");     

	$key_id             = ROZARPAY_KEY;

	$currency_code      = $currency_code;            

	$totalCart              = ($display_total * 100);

	$amountCart             = $display_total;

	$merchant_order_id  = "STYLE-".date("YmdHis");

?>

 

			

<div class="middle_part">
	<div class="container">
		<?php if (!$cart_qty) {redirect(base_url());} ?>
		<?= form_open($callback_url,['id'=>'checkoutprocess','method'=>'post']); ?>
		<div class="row m-0">
			<div class="col-sm-7 m_padd p-0">
				<div class="">

					<?php if(!$this->session->userdata('userType')) { ?>
						<div class="row m-0 gust_hide">
							
							<div class="col-sm-4 p-0">
								<div class="new_cusyomm">
									<h4>New Customers</h4>
									<p>Proceed to checkout and you will have an opportunity to create an account at the end it one does not
									already exist for you.</p>
									<a type="submit" value="Login" id="gust_uk" class="action_bt4 mt-3 mb-3">Continue as Guest</a>
								</div>
							</div>

							<div class="col-sm-6 p-0 offset-sm-1 bod_left">
								<div class="ret_cusyomm">
									<h4>Returning Customers</h4>
									<p>Sign in to speed up the checkout process and save payments to account</p>

									<div id="response_msg" class="red"></div>
									<div class="my_log_fm">
										<p><b>Email:</b></p>
										<div class="fg_gp">
											<i class="fa fa-envelope-o"></i>
											<input id="userEmail" name="userEmail" type="text" placeholder="Email Address" class="box_new">
											<div id="userEmail_err"  class="red"></div>
										</div>
									</div>

									<div class="my_log_fm">
										<p><b>Password:</b></p>
										<div class="fg_gp">
											<i class="fa fa-lock"></i>
											<input id="userPassword" name="userPassword" type="password" placeholder="Password" class="box_new">
											<i class="toggle-password fa fa-fw fa-eye-slash"></i>
											<div id="userPassword_err"  class="red"></div>
										</div>

									</div>
									

									<div class="remobb">
										<input name="rem" type="checkbox"> Remember
										<span><a href="<?=base_url('forgot-password')?>">Forgot password?</a></span>
									</div>
									<a type="submit" value="Login" class="action_bt4 mt-3 mb-3" onclick="login()">Login</a>
									 

									<p class="font12">By signing in, your are agreeing to our 
										<a target="_blank" href="<?=base_url('terms-of-use');?>">Terms of Use</a> and 
										<a target="_blank" href="<?=base_url('privacy-policy');?>">Privacy Policy.</a></p>

								</div>
							</div>	

						</div>
						<div class="gust_form">
							<a href="" id="back_to_page"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to Login</a>
							<div class="contact_info_">
								<div class="col-sm-12"><h5>Checkout As Guest </h5></div>
								<div class="row ">
									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>Email</label>
											<input type="email" id="email" name="email" value="" class="box">
											<div id="email_err" class="red"></div>
										</div>
									</div>
								 	<div class="col-sm-6">
										<div class="form-group required-field">
											<label>First Name </label>
											<input type="text" id="fname" name="fname" value="" class="box">
											<div id="fname_err" class="red"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>Last Name </label>
											<input type="text" id="lname" name="lname" value="" class="box">
											<div id="lname_err" class="red"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>Phone Number </label>
											<input type="tel" id="mobile" maxlength="10" name="mobile" value="" class="box onlyInteger">
										</div>
									</div>
									
								</div>	
							</div>
							<?php  if(in_array('product',$cart_typeArray)){ ?>

								<div class="ship_ads">

									<div class="col-sm-12 mt-5 mb-3"><h5>Shipping Information</h5></div>

									<div class=" row ">

										<div class="col-sm-12">

											<div class="form-group required-field">

												<label>Address (<small>House No, Flat, block, etc</small>)</label>

												<input type="text" id="address" name="address" value="<?= ($user_shipping_address->address)?$user_shipping_address->address:'' ?>" class="box">

												<div id="address_err" class="red"></div>

											</div>

										</div>



										<div class="col-sm-6">

						                    <div class="form-group">

												<label>Country</label>

												<div class="select-custom">

													<select class="box" id="country" name="country">

														<option  value="" >Select Country <span class="text-danger">*</span></option>

													 	<?php if($country) { foreach($country as $state) { if(strtoupper($state->name) == 'INDIA'){$sel='selected';}else{$sel='';}?>

													        <option value="<?= $state->name ?>" <?= $sel ?>><?= $state->name ?></option>

													   	<?php }} ?>



													</select>

													<div id="country_err" class="red"></div>

												</div>

											</div>

									  	</div>

										

					                    <div class="col-sm-6">

											<div class="form-group required-field">

												<label>State/Province</label>

												<input type="text" id="state" name="state" value="<?= ($user_shipping_address->state_name)?$user_shipping_address->state_name:'' ?>" class="box">

												<div id="state_err" class="red"></div>

											</div>

										</div>

										<div class="col-sm-6">

											<div class="form-group required-field">

												<label>City  </label>

												<input type="text" class="box" id="city"  name="city" value="<?= ($user_shipping_address->city_name)?$user_shipping_address->city_name:'' ?>">

												<div id="city_err" class="red"></div>

											</div>

										</div>



										<div class="col-sm-6">

											<div class="form-group required-field">

												<label>Zip/Postal Code </label>

												<input type="text" class="box onlyInteger" id="zip" name="zip" value="<?= ($user_shipping_address->zip)?$user_shipping_address->zip:'' ?>">

												<div id="zip_err" class="red"></div>

											</div>

										</div>



										<div class="col-sm-12">

											<div class="form-group required-field">

												<input name="save_address" type="checkbox"> Save Address

											</div>

										</div>



										<div class="col-sm-12">

											<div class="form-group required-field">

												<input name="notify_latest_product" type="checkbox"> Notify me of latest news, special offers and exclusive events relating to Style Buddy products and services. You can unsubscribe at any time by clicking on the unsubscribe link in each e-mail.

											</div>

										</div>

									</div>

								</div>

							<?php }else{ ?>

								<input type="hidden" id="address" name="address" value="Delhi" class="box">

								<input type="hidden" id="country" name="country" value="India" class="box">

								<input type="hidden" id="state" name="state" value="Delhi" class="box">

								<input type="hidden" class="box" id="city"  name="city" value="Delhi">

								<input type="hidden" class="box onlyInteger" id="zip" name="zip" value="110096">

							<?php } ?>
						</div>
					<?php }else{ ?>
						<div class="shipping_ads2_new">
							<div class="fm">
								<div class="stp2_s">

									<!-- <?php //if($user){?> -->

										



										 

		                                <input type="hidden" name="userId" value="<?= ($user->id)?$user->id:'' ?>" class="box">



										<div class="contact_info_">

											<div class="col-sm-12"><h5>Contact Information</h5></div>



											<div class="row ">

											    <?php if(!$this->session->userdata('userType')) { ?>

													<div class="form-group required-field">

														<label>Email </label>

														<input type="email" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="box">

														<div id="email_err" class="red"></div>

													</div>

													<p>If already have an account please <a href="<?=base_url('login')?>">login</a> else you can enter your mail ID and checkout as a Guest User. </p>

												<?php }else{ ?>

													<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="box">

												<?php } ?>

												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>Email </label>

														<input type="text" readonly value="<?= ($user->email)?$user->email:'' ?>" class="box">

														<div id="email_err" class="red"></div>

													</div>

												</div>

												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>First Name </label>

														<input type="text" id="fname" name="fname" value="<?= ($user->fname)?$user->fname:'' ?>" class="box">

														<div id="fname_err" class="red"></div>

													</div>

												</div>



												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>Last Name </label>

														<input type="text" id="lname" name="lname" value="<?= ($user->lname)?$user->lname:'' ?>" class="box">

														<div id="lname_err" class="red"></div>

													</div>

												</div>



												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>Phone Number </label>

														<input type="tel" id="mobile" maxlength="10" name="mobile" value="<?= ($user->mobile)?$user->mobile:'' ?>" class="box onlyInteger">

														<div id="mobile_err" class="red"></div>

													</div>

												</div>



											</div>	



										</div>

										<?php  if(in_array('product',$cart_typeArray)){ ?>

											<div class="ship_ads">

												<div class="col-sm-12 mt-5 mb-3"><h5>Shipping Information</h5></div>

												<div class=" row ">

													<div class="col-sm-12">

														<div class="form-group required-field">

															<label>Address (<small>House No, Flat, block, etc</small>)</label>

															<input type="text" id="address" name="address" value="<?= ($user_shipping_address->address)?$user_shipping_address->address:'' ?>" class="box">

															<div id="address_err" class="red"></div>

														</div>

													</div>



													<div class="col-sm-6">

									                    <div class="form-group">

															<label>Country</label>

															<div class="select-custom">

																<select class="box" id="country" name="country">

																	<option  value="" >Select Country <span class="text-danger">*</span></option>

																 	<?php if($country) { foreach($country as $state) { if(strtoupper($state->name) == 'INDIA'){$sel='selected';}else{$sel='';}?>

																        <option value="<?= $state->name ?>" <?= $sel ?>><?= $state->name ?></option>

																   	<?php }} ?>



																</select>

																<div id="country_err" class="red"></div>

															</div>

														</div>

												  	</div>

													

								                    <div class="col-sm-6">

														<div class="form-group required-field">

															<label>State/Province</label>

															<input type="text" id="state" name="state" value="<?= ($user_shipping_address->state_name)?$user_shipping_address->state_name:'' ?>" class="box">

															<div id="state_err" class="red"></div>

														</div>

													</div>

													<div class="col-sm-6">

														<div class="form-group required-field">

															<label>City  </label>

															<input type="text" class="box" id="city"  name="city" value="<?= ($user_shipping_address->city_name)?$user_shipping_address->city_name:'' ?>">

															<div id="city_err" class="red"></div>

														</div>

													</div>



													<div class="col-sm-6">

														<div class="form-group required-field">

															<label>Zip/Postal Code </label>

															<input type="text" class="box onlyInteger" id="zip" name="zip" value="<?= ($user_shipping_address->zip)?$user_shipping_address->zip:'' ?>">

															<div id="zip_err" class="red"></div>

														</div>

													</div>



													<div class="col-sm-12">

														<div class="form-group required-field">

															<input name="save_address" type="checkbox"> Save Address

														</div>

													</div>



													<div class="col-sm-12">

														<div class="form-group required-field">

															<input name="notify_latest_product" type="checkbox"> Notify me of latest news, special offers and exclusive events relating to Style Buddy products and services. You can unsubscribe at any time by clicking on the unsubscribe link in each e-mail.

														</div>

													</div>

												</div>

											</div>

										<?php }else{ ?>

											<input type="hidden" id="address" name="address" value="Delhi" class="box">

											<input type="hidden" id="country" name="country" value="India" class="box">

											<input type="hidden" id="state" name="state" value="Delhi" class="box">

											<input type="hidden" class="box" id="city"  name="city" value="Delhi">

											<input type="hidden" class="box onlyInteger" id="zip" name="zip" value="110096">

										<?php } ?>
								</div>
							</div>
						</div>	
					<?php }  ?>

				</div>

				


			</div>

			<div class="col-sm-5">

				<div class="final_summ">
 
					<p><b>Summary</b></p>

					<hr>

					<div class="final_summ2">

						<?php $cartTotal = $sessionArray->display_bag_total;?>

						<?php $cartIds = array();?>

						<?php foreach($cartArray as $k=>$v){?>

							<?php

								$tbl_name = 'products';

								$str = " WHERE id = '".$v->product_id."' ";

								$pageRowQuery =  $this->common_model->get_all_details_query($tbl_name,'  '.$str);

								$cRow = $pageRowQuery->row();

							?>

							<?php $total = $v->display_total;?>

							

							<?php $display_mrp_price = $v->display_mrp_price;?>

							<?php $display_price = $v->display_price;?>

							<?php  $imgSplit = $cRow->image; ?>

							<?php 

								if($cRow->image_base_url){

									$finalImageUrl = $imgSplit;

								}else{ 

									$finalImageUrl = base_url().'assets/images/product/'.$imgSplit;

								}

							?>

							<p>

								<?=$v->name?> 

								<span class="qqt">(Qty <?= $v->quantity ?>)</span> 

								<!-- <span class="last_pp"><?= $this->site->currency.' '.numberformat($v->total) ?></span> -->

								<span class="last_pp ppc_cart">

									<?php if($v->mrp_price_total > $v->total){ ?>

										<span style="text-decoration: line-through;" class="amount mrpprice<?= $v->id ?>"> <?= ($v->mrp_price_total)?$this->site->currency.' '.number_format($v->mrp_price_total):$this->site->currency.' '.number_format($v->mrp_price_total) ?></span>

										<?= ($v->total)?$this->site->currency.' '.number_format($v->total):$this->site->currency.' '.number_format($v->total) ?> 

									<?php }else{?>

										<?= ($v->total)?$this->site->currency.' '.number_format($v->total):$this->site->currency.' '.number_format($v->total) ?> 

									<?php }?>

								</span>

							</p>

						<?php } ?>

					</div>

					<div class="">

						<?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>

						<hr>

						<p><b>Subtotal</b> <span class="last_pp"><?= $this->site->currency .' '. $sessionArray->bag_mrp_price_total;?></span></p>

						<p><b>Discount</b> <span class="last_pp green_dis">-<?= $this->site->currency ?> <?=$sessionArray->display_discount_total;?></span></p>

						<?php if(($sessionArray->display_coupon_discount_total * 100)){?>

							<p><b>Coupon Discount(<?=$user_cart_session['coupon_code'];?>) </b><span class="last_pp green_dis">- <?= $this->site->currency ?> <?=$sessionArray->display_coupon_discount_total;?></span></p>

						<?php }?>

						<p><b>Estimated Total </b><span class="last_pp"><?= $this->site->currency ?> <?=$sessionArray->display_total;?></span></p>



						

						

						<div class="pay_opt">

							<?php if ($display_total * 100) { ?>
								<div class="pay_cin"><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/payments_ic.png" alt="ROZARPAY" title="RAZORPAY"></div>
							<?php }else{ ?>
								<?php if($user_cart_session['coupon_code']){ ?>
									<div class="pay_cin"><input name="pay_type" checked type="radio" value="Gift Card Used"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/payments_ic.png" alt="ROZARPAY" title="RAZORPAY"></div>
								<?php }else{?>
									<div class="pay_cin"><input name="pay_type" checked type="radio" value="FREE"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/payments_ic.png" alt="ROZARPAY" title="RAZORPAY"></div>
								<?php }?>
							<?php }?>
							<div id="pay_type_err" class="red"></div>
							<div class="checkout-methods">
								<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
						        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
						        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
						        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
						        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
						        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
						        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
						        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>
								<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="all_b" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= form_close(); ?>   
	</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

    var razorpay_pay_btn, instance;

    function razorpaySubmit(el) {

        $('#email_err').html('');

    	$('#fname_err').html('');

    	$('#lname_err').html('');

    	$('#mobile_err').html('');

    	$('#email_err').html('');

    	$('#address_err').html('');

    	//$('#company_err').html('');

    	//$('#country_err').html('');

    	$('#state_err').html('');

    	$('#city_err').html('');

    	$('#zip_err').html('');

    	$('#pay_type_err').html('');

    	

    	if(!$('#email').val()){

    		$('#email_err').html('Please enter email');

    		$('#email').focus();

    		return false

    	}else if(!IsEmail($('#email').val())){

    		$('#email_err').html('Please enter correct email');

    		$('#email').focus();

    		return false

    	}else if(!$('#fname').val()){

    		$('#fname_err').html('Please enter first name');

    		$('#fname').focus();

    		return false

    	}else if(!$('#lname').val()){

    		$('#lname_err').html('Please enter last name');

    		$('#lname').focus();

    		return false

    	}else if(!$('#mobile').val()){

    		$('#mobile_err').html('Please enter mobile');

    		$('#mobile').focus();

    		return false

    	/*}else if(!$('#company').val()){

    		$('#company_err').html('Please enter first name');

    		$('#company').focus();

    		return false

    	}else if(!$('#country').val()){

    		$('#country_err').html('Please enter country name');

    		$('#country').focus();

    		return false

    	*/}else if(!$('#address').val()){

    		$('#address_err').html('Please enter address name');

    		$('#address').focus();

    		return false

    	}else if(!$('#state').val()){

    		$('#state_err').html('Please enter state name');

    		$('#state').focus();

    		return false

    	}else if(!$('#city').val()){

    		$('#city_err').html('Please enter city name');

    		$('#city').focus();

    		return false

    	}else if(!$('#zip').val()){

    		$('#zip_err').html('Please enter zip code');

    		$('#zip').focus();

    		return false

    	}else if(!$('input[name=pay_type]:checked').val()){

    		$('#pay_type_err').html('Please checked Payment Method');

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

		            $("#loader").modal('show');

		            $(".modal-backdrop").css('zoom','100');

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

</script>

<script type="text/javascript">
	function login(){
		var userEmail = $('#userEmail').val();
		var userPassword = $('#userPassword').val();
		$('#userEmail_err').html('');
		$('#userPassword_err').html('');
		if(!userEmail){

    		$('#userEmail_err').html('Please enter email');

    		$('#userEmail').focus();

    		return false

    	}else if(!userPassword){

    		$('#userPassword_err').html('Please enter password');

    		$('#userPassword').focus();

    		return false

    	
    	}else{
    		$.ajax({
                type: 'POST',
                dataType:"json",
                url: '<?php echo base_url(); ?>login/loginAjax',
                data: {userEmail:userEmail,userPassword:userPassword},
                success: function(data) {
                	$('#response_msg').html(data.response);
                	if(data.status == 'success'){
                		window.location.href = '<?=base_url('cart')?>';
                		//window.location.reload();
                	}else{

                	}
	           	}
            });  
    	}
              
        
	}
</script>


<script>
	$(document).ready(function(){
	  $("#gust_uk").click(function(){
	    $(".gust_hide").hide();
	    $(".gust_form").show();

	  });
	  $("#back_to_page").click(function(){
	    $(".gust_hide").show();
	    $(".gust_form").hide();
	  });
	});
</script>