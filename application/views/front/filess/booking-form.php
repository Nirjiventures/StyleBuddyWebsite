<?php $this->load->view('Page/template/header');  ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Booking</h3></div>
	</div>
	
</div>

 
<?php
	$description        = "Product Description";
	$txnid              = date("YmdHis");     
	$key_id             = ROZARPAY_KEY;
	$currency_code      = $currency_code;            
	$total              = ($this->session->userdata('price') * 100); // 100 = 1 indian rupees
	$amount             = $this->session->userdata('price');
	$merchant_order_id  = "STYLE-".date("YmdHis");
	 
?>

<div class="middle_part">
	
	<div class="container">
		<?= form_open($callback_url,['id'=>'checkoutprocess']); ?>
		<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
        
        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
		 
		<div class="row">
			
			<div class="col-sm-8">
				
				<div class="shipping_ads">
					<h4>Find Out Your Detail</h4>
					<hr>
							
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group required-field">
								<label>First Name </label>
								<input type="text" name="fname" id="fname" class="form-control">
								<div id="fname_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group required-field">
								<label>Last Name</label>
								<input type="text" name="lname" id="lname" class="form-control">
								<div id="lname_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group required-field">
								<label>Phone Number </label>
								<input type="tel" name="mobile" id="mobile" class="form-control onlyInteger">
								<div id="mobile_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group required-field">
								<label>Email</label>
								<input type="email" name="email" id="email" class="form-control">
								<div id="email_Err"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group required-field">
								<label>Address</label>
								<textarea name="address" id="address" class="form-control"></textarea>
								<div id="address_Err"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Country </label>
								<input type="text" value="india" name="country" id="country" class="form-control">
								<div id="country_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>State/Province</label>
								<input type="text" name="state" id="state" class="form-control">
								<div id="state_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>City </label>
								<input type="text" class="form-control" name="city" id="city">
								<div id="city_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Zip/Postal Code </label>
								<input type="text" class="form-control onlyInteger" name="zip" id="zip">
								<div id="zip_Err"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Tell Us About Your Requiremnts: </label>
								<textarea class="form-control" name="requiremnt" id="requiremnt" style="hight:60px"></textarea>
								<div id="requiremnt_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Age </label>
								<input type="text" min="21" class="form-control onlyInteger" name="age" id="age">
								<div id="age_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>What are your favorite colors?</label>
								<input type="text" class="form-control" name="favorite_color" id="favorite_color">
								<div id="favorite_color_Err"></div>
							</div>
						</div>
					</div>
				</div>
							
			</div>	
			
			<div class="col-sm-4">
				<div class="summry">
					<h5>Payment Details</h5>	
					<p><?= $this->site->currency.' '.$this->session->userdata('price') ?></p>
					<hr>
					<div class="pay_opt">
						<h5>Payment Method</h5>	
						<p><input name="pay_type" type="radio" value="ROZARPAY"> ROZARPAY</p>
						<p><input name="pay_type" type="radio" value="Cash on devivery"> Cash on delivery</p>
						<div id="pay_type_Err"></div>
						<div class="checkout-methods">
							<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="btn2" />
						</div>
					</div>
					 
					
				</div>
			</div>
		</div>
		<?php form_close(); ?>
	</div>
</div>



<?php $this->load->view('Page/template/footer');  ?>
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
    	$('#company_Err').html('');
    	$('#address_Err').html('');
    	$('#country_Err').html('');
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
    	}else if(!$('#email').val()){
    		$('#email_Err').html('Please enter email');
    		$('#email').focus();
    		return false
    	}else if(!IsEmail($('#email').val())) {
            $('#email_Err').html('Please enter correct email');
    		$('#email').focus();
    		return false
        }else if(!$('#address').val()){
    		$('#address_Err').html('Please enter address name');
    		$('#address').focus();
    		return false
    	}else if(!$('#country').val()){
    		$('#country_Err').html('Please enter country name');
    		$('#country').focus();
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
    		if($('input[name=pay_type]:checked').val() == 'ROZARPAY'){

	    		var name = document.getElementById('fname').value + ' ' +document.getElementById('lname').value;
		    	var email = document.getElementById('email').value;
		    	var mobile = document.getElementById('mobile').value;

		    	var options = {
		            key:            "<?php echo $key_id; ?>",
		            amount:         "<?php echo $total; ?>",
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
		    }else{
		    	document.getElementById('checkoutprocess').submit();
		    }
    	}
    	
    }  
</script>