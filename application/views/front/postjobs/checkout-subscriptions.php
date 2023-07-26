<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>

			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
					
						<h2>Subscriptions</h2>
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
						<?= form_open($callback_url,['id'=>'checkoutprocess','method'=>'post']); ?>
						<div class="row m-0">

							<div class="col-sm-6 m_padd">

								<div class="shipping_ads2">
									<div class="fm">
										<h4> Payment</h4>
										<hr>
										 
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
			    						        <input type="hidden" name="package" value="<?=$package_row['package_name']?>">
			    								<input type="hidden" id="fname" name="fname" value="<?= ($user->fname)?$user->fname:'' ?>" class="form-control">
			    								<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="form-control">
			    								<input type="hidden" id="mobile" name="mobile" value="<?= ($user->mobile)?$user->mobile:'' ?>" class="form-control">
			                                <?php }?>
											<p><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/razo.png" alt="ROZARPAY" title="RAZORPAY"></p>
								
											<div id="pay_type_Err"></div>
											<div class="checkout-methods">
												<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Place Order" class="btn2" />
											</div>
										</div>
									 
									</div>
								</div>	
							</div>
							<div class="col-sm-6 m_padd">
								<?php 
									$option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">
							                    <tr style="border: 1px solid #333;">
							                        <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>
							                        <td style="border: 1px solid #333;" class="text-left">'.ucwords($vendor_row['fname'].' '.$vendor_row['lname']).'</td>
							                    </tr> 
							                    <tr style="border: 1px solid #333;">
							                        <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$package_row['package_name'].'</b></td>
							                    </tr>';
							                    $option .= '<tr style="border: 1px solid #333;">
							                        <td style="border: 1px solid #333;"> <b>Price : </b></td>
							                    	<td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($package_row['package_price']) .'</b></td>
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
		</div>
	</div>
</div>

<script type="text/javascript">
	function submitForm(id){
		document.getElementById(id).submit();
	}
</script>
</body>
</html>
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

    	 
    	$('#pay_type_Err').html('');

    	

    	if(!$('input[name=pay_type]:checked').val()){

    		$('#pay_type_Err').html('Please checked Payment Method');

    		$('input[name=pay_type]').focus();

    		return false

    	}else{

    		if($('input[name=pay_type]:checked').val() == 'RAZORPAY'){



	    		var name = document.getElementById('fname').value;

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











