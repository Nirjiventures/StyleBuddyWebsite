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

		<div class="my_checkout">

			<div class="container">

				<div class="row m-0 justify-content-between">

					<div class="col-sm-12">

						<div class="hdc_pp"><h1>Checkout</h1></div>

					</div>

				</div>

			</div>

		</div>

		 



<div class="middle_part pt-0">

	<div class="container">
		<?php
			$ij=1;
			$value = $consult_plan;
            $package_price_1 =$value['package_price'];
            $tax_1 = 0;
            $tax_total_1 = 0;
            $description_1        = $value['package_name'];
            $txnid_1              = date("YmdHis");     
            $key_id_1             = ROZARPAY_KEY;
            $currency_code_1      = $currency_code;            

            $totalCart_1              = ($package_price_1 * 100) + ($tax * 100); 
            $amountCart_1             = ($package_price_1 + $tax);
            $merchant_order_id_1  = "STYLE-".date("YmdHis");

            $surl_1 = $consult_surl;
            $furl_1 = $consult_furl;

        ?>
    
		<?=form_open_multipart($consult_callback_url,['id'=>'ask-quote_'.$ij,'name'=>'ask-quote_'.$ij,'method'=>'post']) ?>

		<div class="row m-0 justify-content-center">

			<div class="col-sm-5 m_padd">

				 

				<div class="shipping_ads2_new">

					<div class="fm">
						<div class="stp2_s">
							<div class="contact_info">
								<div class="col-sm-12"><h5>Contact Information</h5></div>
								<div class="row ">
									<?php if(!$this->session->userdata('userType')) { ?>
										<div class="form-group required-field">
											<label>Email </label>
											<input type="email" id="email" name="email" value="<?= ($loggedRow['email'])?$loggedRow['email']:'' ?>" class="form-control">
											<div id="email_Err"></div>
										</div>
										<p>If alrady have an account. Please <a href="<?=base_url('login')?>">login</a> else you can enter your mail ID and checkout as a Guest User. </p>
									<?php }else{ ?>
										<input type="hidden" id="email" name="email" value="<?= ($loggedRow['email'])?$loggedRow['email']:'' ?>" class="form-control">
									<?php } ?>
									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>First Name </label>

											<input type="text" id="fname" name="fname" value="<?= ($loggedRow['fname'])?$loggedRow['fname']:'' ?>" class="form-control">

											<div id="fname_Err"></div>

										</div>
									</div>
									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>Last Name </label>

											<input type="text" id="lname" name="lname" value="<?= ($loggedRow['lname'])?$loggedRow['lname']:'' ?>" class="form-control">

											<div id="lname_Err"></div>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group required-field">
											<label>Phone Number </label>
											<input type="tel" id="mobile" name="mobile" value="<?= ($loggedRow['mobile'])?$loggedRow['mobile']:'' ?>" class="form-control onlyInteger">
											<div id="mobile_Err"></div>
										</div>
									</div>
									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>City </label>

											<input required type="text"  id="city" name="city" value="<?= ($loggedRow['city_name'])?$loggedRow['city_name']:'' ?>" class="form-control">

											<div id="lname_Err"></div>

										</div>
									</div>
									
									<div class="form-group boot_sp">
                                        <labe>Message</label>
                                        <textarea required class="form-control box_in3" id="message" name="message" rows="5" style="height:100px!important;"></textarea>
                                        
                                        <div id='message_err'></div>
                                    </div>
                              
								</div>	
							</div>
						</div>
					 
						<div class="">
	 						
                            
                            <input type="hidden" name="userId"  value="<?=$this->session->userdata('userId')?>"/>
                            <input type="hidden" name="consult_package_id"  value="<?=$value['id']?>"/>
                            <input type="hidden" name="key_id"  value="<?=$key_id_1?>"/>
                            <input type="hidden" name="currency" value="<?=$currency_code_1?>"/>
                            <input type="hidden" name="pay_type"   value="RAZORPAY"/>
                            <input type="hidden" name="payment_tax" value="<?php echo $tax_1; ?>"/>
                            <input type="hidden" name="payment_tax_total"  value="<?php echo $tax_total_1; ?>"/>
                            <input type="hidden" name="grand_total" value="<?php echo $amountCart_1; ?>"/>
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_<?=$ij?>" />
                            <input type="hidden" name="merchant_order_id" value="<?php echo $merchant_order_id_1; ?>"/>
                            <input type="hidden" name="merchant_trans_id" value="<?php echo $txnid_1; ?>"/>
                            <input type="hidden" name="merchant_product_info_id" value="<?php echo $description_1; ?>"/>
                            <input type="hidden" name="merchant_surl_id" value="<?php echo $surl_1; ?>"/>
                            <input type="hidden" name="merchant_furl_id" value="<?php echo $furl_1; ?>"/>
                            <input type="hidden" name="merchant_total" value="<?php echo $totalCart_1; ?>"/>
                            <input type="hidden" name="merchant_amount" value="<?php echo $amountCart_1; ?>"/>
                            <div class="pay_opt">
								<!-- <p><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/razo.png" alt="ROZARPAY" title="RAZORPAY"></p> -->
								<!--<p><input name="pay_type" type="radio" value="Cash on delivery"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/cod.png" alt="Cash on delivery " style="width: 64px;" title="Cash on delivery "></p>
								--><div id="pay_type_Err"></div>
								<div class="checkout-methods">
									<input  id="pay-btn" type="submit" value="Place Order" class="all_b" />
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
	
	$(document).on("blur","#email",function() {
      	var checkEmail = $(this).val();
        if(IsEmail(checkEmail)) { 
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>vendor/emailcheck',
                data: 'checkEmail='+checkEmail,
                success: function(data) {
                  if(data == 1) {
                     $('#email_Err').html('<p class="text-primary">your email address is registered</span>');
                     $('#email').focus();
                     return false; 
                  } else {
                     $('#email_Err').html(' '); 
                  }
               }
            });    
        }
    });



</script>

<script type="text/javascript">
    $(document).ready(function() {
      var razorpay_pay_btn, instance;
      $('#ask-quote_1').on('submit',function(e){
          e.preventDefault();
          var name = this.fname.value +' '+this.lname.value;
          var email = this.email.value;
          var mobile = this.mobile.value;


          var options = {
                 
                key:            this.key_id.value,
                amount:         this.merchant_total.value,
                name:           name,
                description:    "Order # "+this.merchant_order_id.value,
                netbanking:     true,
                currency:       this.currency.value,
                prefill: {
                    name:       name,
                    email:      email,
                    contact:    mobile
                },
                notes: {
                    soolegal_order_id: this.merchant_order_id.value,
                },
                handler: function (transaction) {
                    document.getElementById('razorpay_payment_id_1').value = transaction.razorpay_payment_id;
                    document.getElementById('ask-quote_1').submit();
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
           

      }); 
    });
</script>











