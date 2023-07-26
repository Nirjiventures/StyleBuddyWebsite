<style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }

	.box_form {
	    width: 60%;
	    padding: 6px;
	    border-radius: 3px!important;
	    margin-bottom: 15px;
	    border: none;
	    background: #f3f3f4!important;
	}
	.fld p {
	    margin-bottom: 1px;
	    font-weight: bold;
	}
	.stp2 label{
		font-weight: bold;
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
	    background:#f3f3f4!important;
	    border:none;
	    color: #000;
	}
	.stp3 label{
		font-weight: bold;
	}
	.fm span {
	    background: #8200c8;
	    width: 30px;
	    height: 30px;
	    display: inline-block;
	    border-radius: 100px;
	    text-align: center;
	    color: #fff;
	    line-height: 30px;
	    font-size: 14px;
	    margin-right: 8px;
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
	.summry h5, .summry h4 {
	    margin-bottom: 0px;
	    font-size: 18px!important;
	}
	.summry h4{
		margin-top: 10px;
	}
	.pay_opt .btn2{

	}
  </style>

<?php  $this->load->view('Page/template/header'); ?>
<!-- <div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Checkout</h3></div>
	</div>
</div> -->
<div class="ab-banner_inner">
		<div class="container text-center"><h1>Checkout</h1></div>
</div>
<?php

	$description        = "Product Description";
	$txnid              = date("YmdHis");     
	$key_id             = ROZARPAY_KEY;
	$currency_code      = $currency_code;            
	$totalCart              = ($this->cart->total()* 100); // 100 = 1 indian rupees
	$amountCart             = $this->cart->total();
	$merchant_order_id  = "STYLE-".date("YmdHis");
	//$callback_url = base_url('ccavanue/userOrder');
	//var_dump($user_shipping_address); 
?>

<div class="middle_part pt-0">
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

						<h4><span>2</span> Shipping Address</h4>
						<hr>
						<div class="stp2">
							<?php if($user){?>
								<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
						        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
						        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
						        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
						        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
						        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
						        
						        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
						        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>

								<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">

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
									<div class="col-sm-12 mb-4">
										<input type="checkbox" name="chk" class="" id="same_as"> <small>My billing address is the same as my shipping address..</small>
									</div>

									<div class="col-sm-12"><button type="button" class="btn_step hide_bt" id="next2">Next</button></div>
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="fm">
						<h4><span>3</span> Billing</h4>
						<hr>
						<div class="stp3">
							
							<div class="row m-0">
								
								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>First Name</label>
										<input type="text" class="form-control" id="bill_fname" name="bill_fname" value="">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>Last Name</label>
										<input type="text" class="form-control" id="bill_lname" name="bill_lname" value="">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>Phone Number</label>
										<input type="text" class="form-control" id="bill_mobile" name="bill_mobile" value="">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group required-field">
										<label>Address</label>
										<input type="text" class="form-control" id="bill_address" name="bill_address" value="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>State</label>
										<input type="text" class="form-control" id="bill_state" name="bill_state" value="">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>City</label>
										<input type="text" class="form-control" id="bill_city" name="bill_city" value="">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group required-field">
										<label>Pin / Postal code</label>
										<input type="text" class="form-control" id="bill_zip" name="bill_zip" value="">
									</div>
								</div>

								

								<div class="col-sm-12"><button type="button" class="btn_step hide_bt2" id="next3">Next</button></div>
							</div>
						
						</div>

					</div>

					<div class="fm">
						<h4><span>4</span> Payment</h4>
						<hr>
						<div class="stp4">
							
							
							
							<div class="pay_opt">
								<!-- <p><input name="pay_type" type="radio" value="ccavanue"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/ccavanue.png" alt="ccavanue" title="ccavanue"></p> -->
								<p><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/razo.png" alt="ROZARPAY" title="RAZORPAY"></p>
								<p><input name="pay_type" type="radio" value="Cash on delivery"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/cod.png" alt="Cash on delivery " title="Cash on delivery "></p>
								<div id="pay_type_Err"></div>
								
								<div class="checkout-methods">
									<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="btn2" />
								</div>
							</div>
						
						</div>

					</div>


				</div>	
			</div>
			<div class="col-sm-4 p-0">
				<div class="summry">
					<div class="row m-0">
						<div class="col-7 col-sm-6 p-0"><h5>Order summary</h5></div>
						<div class="col-5 col-sm-6 p-0 text-end">Total Items : <?=  count($this->cart->contents()); ?></div>
					</div>
					<hr>
					
					<?php $cart = $this->cart->contents();?>  
					<?php      if(!empty($cart)) {  ?>
				    <?php      $total = 0;  ?>
				    <?php      $discountTotal = 0;  ?>
				    <?php      $grandTotal = 0;  ?>
				    
				    	<?php  foreach(array_reverse($cart) as $value) {   ?>
					    	<?php      $total += $value['mrpprice'] * $value['qty'];  ?>
						    <?php      $discountTotal += $value['discountPrice'] * $value['qty'];  ?>
						    <?php      $grandTotal += $value['price'] * $value['qty'];  ?>

							<div class="final_c">
								<div class="row align-items-center m-0">
									<div class="col-3 col-sm-2 p-0"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/product/<?= $value['options']['image']; ?>" class="ck_im img-fluid"> </div>
									<div class="col-9 col-sm-7"><?= ucwords($value['name']) ?>x<?= $value['qty'] ?></div>
									<div class="col-sm-3 p-0 text-end"><?= $this->site->currency.' '.number_format($value['subtotal']) ?></div>
								</div>
							</div>
				    	<?php }?>
					<?php } ?>
					<!-- <h6>Total : <span class="total-amount"><?=  $this->site->currency.' '.number_format($total); ?></span></h6>
					<h6>Discount : <span class="total-amount">-<?=  $this->site->currency.' '.number_format($discountTotal); ?></span></h6> -->
					<h4>Grand Total : <span class="total-amount"><?=  $this->site->currency.' '.number_format($grandTotal); ?></span></h4>
				</div>
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





