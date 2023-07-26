<?php $this->load->view('Page/template/header'); ?>
<style type="text/css">
.scroll-to-this{
    height: 50px;
    background: pink;
}
.lg-tt{
	background: #f1f1f1;
    padding: 40px 0px;
}
.h-line {
    width: 75px;
    height: 3.5px;
    background: #f42cc2;
    margin: auto;
}
.lg-tt .h-line{
	margin-bottom: 20px;
}
</style>

<!--========Banner Area ========-->

<!-- <div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3> </h3></div>
	</div>
	
</div> -->

<div class="ab-banner_inner">
		<div class="container text-center"><h1>Initial Consultation</h1></div>
</div>
 
<?php
	$description        = "Product Description";
	$txnid              = date("YmdHis");     
	$key_id             = ROZARPAY_KEY;
	$currency_code      = $currency_code;            
	$total              = (1000 * 100); // 100 = 1 indian rupees
	$amount             = 1000;
	$merchant_order_id  = "STYLE-".date("YmdHis");
	$callback_url = base_url('ccavanue/initialForm');
	
	$slug = $this->uri->segment(2);
	$our_services = $this->db->get_where('our_services',['slug'=> $slug])->row();
     
       
?>

<div class="middle_part pt-0">
	
	<div class="lg-tt">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-8 text-center">
						<h2>Book Your Initial Consultation</h2>
						<div class="h-line"></div>
						<p>Fill up this form to book your session with our style expert to discuss your requirements. The booking fee you pay now will be adjusted against the final services fee you will pay after discussion with our personal stylist. The booking fee is not refundable in case you decide not to proceed with our services after discussion with our personal stylist.</p>
						<!-- <div class="text-center">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/dress.png">
						</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="container cons_form">	
		<?= form_open($callback_url,['id'=>'checkoutprocess']); ?>
		<!--<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
        
        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>-->
        
        <input type="hidden" name="service_id" id="service_id" value="<?php echo $our_services->id; ?>">
       
		<div class="row m-0 justify-content-center">
			
			<div class="col-sm-8">
			        
					<div class="row m-0 pt-5">
						<div class="col-sm-12 mb-3 text-center">
							<h4>Online Booking Form</h4>
							<p class="p_bc">Book your initial session for only Rs.1000/-</p>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" name="fname" id="fname" class="form-control" value="<?=$loggedRow['fname']?>">
								<div id="fname_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" name="lname" id="lname" class="form-control"   value="<?=$loggedRow['lname']?>">
								<div id="lname_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" id="email" class="form-control"   value="<?=$loggedRow['email']?>">
								<div id="email_Err"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="tel" name="mobile" id="mobile" class="form-control onlyInteger" value="<?=$loggedRow['mobile']?>">
								<div id="moblile_Err"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" id="address" class="form-control"  value="<?=$loggedRow['address']?>">
								<div id="address_Err"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Special Instructions</label>
								<textarea class="form-control"  name="special_instruction" id="special_instruction" rows="4"></textarea>
								<div id="special_instruction_Err"></div>
							</div>
						</div>
						<div class="col-sm-12 text-center">
							<div class="form-group">
								<input  id="pay-btn" type="button" onclick="razorpaySubmit(this);" value="Submit" class="btn btn-primary" />
							</div>
						</div>
					</div>
			</div>	
		</div>
		<?= form_close() ?>
	</div>
	
</div>


<?php $this->load->view('Page/template/footer'); ?>
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
    	$('#special_instruction_Err').html('');
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
    	}else if(!$('#email').val()){
    		$('#email_Err').html('Please enter email');
    		$('#email').focus();
    		return false
    	}else if(!IsEmail($('#email').val())) {
            $('#email_Err').html('Please enter correct email');
    		$('#email').focus();
    		return false
        }else if(!$('#mobile').val()){
    		$('#mobile_Err').html('Please enter mobile');
    		$('#mobile').focus();
    		return false
    	}else if(!$('#address').val()){
    		$('#address_Err').html('Please enter address name');
    		$('#address').focus();
    		return false
    	}else if(!$('#special_instruction').val()){
    		$('#special_instruction_Err').html('Please enter special instruction');
    		$('#special_instruction').focus();
    		return false
    	/*}else if(!$('input[name=pay_type]:checked').val()){
    		$('#pay_type_Err').html('Please checked Payment Method');
    		$('input[name=pay_type]').focus();
    		return false
    	*/}else{
    	    document.getElementById('checkoutprocess').submit();
    		/*var name = document.getElementById('fname').value + ' ' +document.getElementById('lname').value;
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
	        }*/
    	}
    	
    } 
    
</script>