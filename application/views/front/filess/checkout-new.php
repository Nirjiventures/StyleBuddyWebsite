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
	.red{color:red;}
  </style>
<?php  $this->load->view('Page/template/header'); ?>
		<div class="my_checkout">
			<div class="container">
				<div class="row m-0 justify-content-between">
					<div class="col-sm-12">
						<div class="hdc_pp"><h1>Checkout</h1></div>
					</div>
				</div>
			</div>
		</div>
		<?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>
		

		<?php
			$display_total = str_replace(",", '', $sessionArray->display_total);
			$description        = "Product Description";
			$txnid              = date("YmdHis");     
			$key_id             = ROZARPAY_KEY;
			$currency_code      = $currency_code;            
			$totalCart              = ($display_total * 100); // 100 = 1 indian rupees
			$amountCart             = $display_total;
			$merchant_order_id  = "STYLE-".date("YmdHis");
			//$callback_url = base_url('ccavanue/userOrder');
			//var_dump($user_shipping_address); 
		?>

<div class="middle_part pt-0">
	<div class="container">
		<?= form_open($callback_url,['id'=>'checkoutprocess','method'=>'post']); ?>
		<div class="row m-0 justify-content-between">
			<div class="col-sm-7 m_padd">
				<hr>
				<div class="shipping_ads2_new">
					<div class="fm">

						<div class="col-sm-12"><h4>Shipping Address</h4></div>
						
						<div class="stp2_s">
							<!-- <?php //if($user){?> -->
								<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
						        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
						        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
						        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
						        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
						        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
						        
						        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
						        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>

								<!--<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">-->
                                <input type="hidden" name="userId" value="<?= ($user->id)?$user->id:'' ?>" class="form-control">

								<div class="contact_info">
									<div class="col-sm-12"><h5>Contact Information</h5></div>

									<div class="row ">
									    <?php if(!$this->session->userdata('userType')) { ?>
											<div class="form-group required-field">
												<label>Email </label>
												<input type="email" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">
												<div id="email_Err" class="red"></div>
											</div>
											<p>If already have an account please <a href="<?=base_url('login')?>">login</a> else you can enter your mail ID and checkout as a Guest User. </p>
										<?php }else{ ?>
											<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">
										<?php } ?>
										
										<div class="col-sm-6">
											<div class="form-group required-field">
												<label>First Name </label>
												<input type="text" id="fname" name="fname" value="<?= ($user->fname)?$user->fname:'' ?>" class="form-control">
												<div id="fname_Err" class="red"></div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group required-field">
												<label>Last Name </label>
												<input type="text" id="lname" name="lname" value="<?= ($user->lname)?$user->lname:'' ?>" class="form-control">
												<div id="lname_Err" class="red"></div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group required-field">
												<label>Phone Number </label>
												<input type="tel" id="mobile" name="mobile" value="<?= ($user->mobile)?$user->mobile:'' ?>" class="form-control onlyInteger">
												<div id="mobile_Err" class="red"></div>
											</div>
										</div>

									</div>	

								</div>
								<div class="ship_ads">
									<div class="col-sm-12 mb-3"><h5>Shipping Information</h5></div>
									<div class=" row ">
									
								 
									
									<div class="col-sm-12">
										<div class="form-group required-field">
											<label>Address (<small>House No, Flat, block, etc</small>)</label>
											<input type="text" id="address" name="address" value="<?= ($user_shipping_address->address)?$user_shipping_address->address:'' ?>" class="form-control">
											<div id="address_Err" class="red"></div>
										</div>
									</div>

									<div class="col-sm-6">
					                    <div class="form-group">
											<label>Country</label>
											<div class="select-custom">
												<select class="form-control" id="country" name="country">
													<option value="India">India</option>
												</select>
												<div id="country_Err" class="red"></div>
											</div>
										</div>
								  	</div>
									
				                    <div class="col-sm-6">
										<div class="form-group required-field">
											<label>State/Province</label>
											<input type="text" id="state" name="state" value="<?= ($user_shipping_address->state_name)?$user_shipping_address->state_name:'' ?>" class="form-control">
											<div id="state_Err" class="red"></div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>City  </label>
											<input type="text" class="form-control" id="city"  name="city" value="<?= ($user_shipping_address->city_name)?$user_shipping_address->city_name:'' ?>">
											<div id="city_Err" class="red"></div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>Zip/Postal Code </label>
											<input type="text" class="form-control onlyInteger" id="zip" name="zip" value="<?= ($user_shipping_address->zip)?$user_shipping_address->zip:'' ?>">
											<div id="zip_Err" class="red"></div>
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
							 
						</div>
					</div>


				</div>	
			</div>

			<div class="col-sm-4 p-0">

				<div class="stk2">
						<div class="ot_summry">
							<span class="ot_sum">YOUR BAG <small> </small></span>
							<div class="you_b_itm" id="style-4">
								<div class="ot_immer">
									<?php $cartTotal = $sessionArray->display_bag_total;?>
									<?php $cartIds = array();?>
									<?php foreach($cartArray as $k=>$v){?>
										<?php
											$tbl_name = 'products';
											$str = " WHERE id = '".$v->product_id."' ";
											$pageRowQuery =  $this->common_model->get_all_details_query($tbl_name,'  '.$str);
											//echo $this->db->last_query();
											$cRow = $pageRowQuery->row();
											//var_dump($cRow);
										?>
										<?php $total = $v->display_total;?>
										
										<?php $display_mrp_price = $v->display_mrp_price;?>
										<?php $display_price = $v->display_price;?>
										<div class="final_c2">
											<div class="row align-items-center m-0">
												<?php  $imgSplit = $cRow->image; ?>
												<?php 
													if($cRow->image_base_url){
														$finalImageUrl = $imgSplit;
													}else{ 
														$finalImageUrl = base_url().'assets/images/product/'.$imgSplit;
													}
												?>
												<div class="col-4 col-sm-5 p-0">
													<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=$finalImageUrl?>" class="your_bag_photo img-fluid">
												</div>
												<div class="col-8 col-sm-7">
														<div class="min_sm">
														<p><b><?=$cRow->product_name?></b></p>

														<?php if ($v->size) { ?>
															<div class="pro_size">Size: <?= ucwords($v->size) ?></div>
														<?php } ?>

														<?php if ($v->discount) { ?>
															<div class="pro_price">Discount: <?= ($v->discount)?$v->discount.'%':'' ?></div>
														<?php } ?>
														
														<div class="ppc">
															Price : 
															<?php if($v->mrp_price > $v->price){ ?>
																<span style="text-decoration: line-through;" class="amount mrpprice<?= $v->id ?>"> <?= ($v->mrp_price)?$this->site->currency.' '.number_format($v->mrp_price):$this->site->currency.' '.number_format($v->mrp_price) ?></span>
																<span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.' '.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>
															<?php }else{?>
																<span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.' '.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>
															<?php }?> 
						                                </div>
						                                <p>Qty: <?= $v->quantity ?></p>
														<p>Total Price: <?= $this->site->currency.' '.number_format($v->total) ?></p>

													</div>
												</div>
												
											</div>
										</div>

									<?php } ?>
								</div>
							</div>
						</div>

					</div>


				<div class="stk2 mt-4">
					<div class="ot_summry">
						<span class="ot_sum">ORDER SUMMARY</span>
						<div class="ot_immer">
							
								 
							<?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>

							<p>Subtotal <span><?= $this->site->currency ?> <?=$sessionArray->bag_total;?></span></p>

							<p>Discount <span>-<?= $this->site->currency ?> <?=$sessionArray->display_discount_total;?></span></p>
							<?php if(($sessionArray->display_coupon_discount_total * 100)){?>
								<p>Coupon Discount(<?=$user_cart_session['coupon_code'];?>) <span>-<?= $this->site->currency ?> <?=$sessionArray->display_coupon_discount_total;?></span></p>
							<?php }?>
							<p>Estimated Total <span><?= $this->site->currency ?> <?=$sessionArray->display_total;?></span></p>


							
							<hr>
							<small>Taxes,discount and shipping calculated at checkout</small>

							<div class="pay_opt">
							<!-- <p><input name="pay_type" type="radio" value="ccavanue"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/ccavanue.png" alt="ccavanue" title="ccavanue"></p> -->
							<p><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/razo.png" alt="ROZARPAY" title="RAZORPAY"></p>
							<!--<p><input name="pay_type" type="radio" value="Cash on delivery"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/cod.png" alt="Cash on delivery " style="width: 64px;" title="Cash on delivery "></p>
							--><div id="pay_type_Err" class="red"></div>
							
							<div class="checkout-methods">
								<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="all_b" />
							</div>
						</div>

							
							

						</div>
					</div>
				</div>


				
			</div>
		</div>
		<?= form_close(); ?>   
	</div>
</div>

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
    $(document).on("blur","#email",function() {
      	var checkEmail = $(this).val();
        if(IsEmail(checkEmail)) { 
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>vendor/emailcheck',
                data: 'checkEmail='+checkEmail,
                success: function(data) {
                  if(data == 1) {
                     $('#email_Err').html('your email address is registered');
                     $('#email').focus();
                     return false; 
                  } else {
                     $('#email_Err').html(' '); 
                  }
               }
            });    
        }
    });
    var razorpay_pay_btn, instance;
    function razorpaySubmit(el) {
        $('#email_Err').html('');
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
    	
    	if(!$('#email').val()){
    		$('#email_Err').html('Please enter email');
    		$('#email').focus();
    		return false
    	}else if(!IsEmail($('#email').val())){
    		$('#email_Err').html('Please enter correct email');
    		$('#email').focus();
    		return false
    	}else if(!$('#fname').val()){
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
<?php $this->load->view('Page/template/footer'); ?>





