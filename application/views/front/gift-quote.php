<?php $this->load->view('front/template/header'); ?>
<div class="banner_inner">
  <div class="container">
    <h1>Gift card</h1>
    <?php 
        $this->breadcrumb = new Breadcrumbcomponent();
        $this->breadcrumb->add('Home', base_url());
        $this->breadcrumb->add('Gift card', base_url('shop'));
    ?>
    <?php echo $this->breadcrumb->output(); ?>
  </div>
</div>

<?php

  $tax = 0;

  $tax_total = 0;

  $description        = "Ask Quote";

  $txnid              = date("YmdHis");     

  $key_id             = ROZARPAY_KEY;

  $currency_code      = $currency_code;            

  $totalCart              = ($package_price * 100) + ($tax * 100); 

  $amountCart             = $package_price + $tax;

  $merchant_order_id  = "STYLE-".date("YmdHis");
?>
<div class="middle_part">

	<div class="container">

		<div class="row">

		

			<div class="col-sm-3">
        <?php $img =  'assets/images/no-image.jpg';?>
        <?php if(!empty($giftCradRow['media']))  {?>
            <?php 
                $img1 =  $giftCradRow['media']; 
                if (file_exists($img1)) {
                    $img = $img1;
                }
            ?>
        <?php } ?>

				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
 

			</div>

			

			

			<div class="col-sm-7">

				<div class="shop_pro">

					<div class="title_pp1">

						<div class="cebter">

							<h1><?=$giftCradRow['name']?></h1>

							<div class="price">₹ <?=$package_price?></div>

							<p><small>Price inclusive of all taxes</small></p>

						</div>

						<hr>

						<div class="swatches price_s">

			                

						 

						<div class="row">

							<div class="col-sm-12">

								<?=$giftCradRow['description']?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-sm-12 mt-5">
			<div class="quote_form">
          <div class="col-sm-12 text-center">
              <h4>Enter details of recipient of gift card.</h4>
          </div>
          <div class="col-sm-12"><hr></div>
					<?= form_open_multipart($callback_url,['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
    						<input type="hidden" id="lastPage" name="lastPage" value="<?=$lastPage?>">
                <input type="hidden" id="giftcard_id" name="giftcard_id" value="<?=$this->uri->segment(3)?>">
                <div class="row">
                	<div class="col-sm-6">
                		<div class="row">
                      <div class="col-sm-6">
		                    	<div class="form-group boot_sp">
		                        <label class="form-control-placeholder2">First Name</label>
		                        <input type="text" id="fname" name="fname" class="form-control box_in3" value="">
		                        <div id='fname_err'></div>
		                      </div>
		                  </div>
		                  <div class="col-sm-6">
		                    <div class="form-group boot_sp">
		                        <label class="form-control-placeholder2">Last Name</label>
		                        <input type="text" id="lname" name="lname" class="form-control box_in3"  value="">
		                        <div id='lname_err'></div>
		                      </div>
		                  </div>
	                   
  	                  <div class="col-sm-6">
  	                    <div class="form-group boot_sp">
  	                        <label class="form-control-placeholder2">Email</label>
  	                        <input type="text" id="recipient_email" name="email" class="form-control box_in3"  value="">
  	                        <div id='recipient_email_err'></div>
  	                      </div>
  	                  </div>
  	                  <div class="col-sm-6">
  	                     <div class="form-group boot_sp">
  	                        <label class="form-control-placeholder2">Mobile</label>
  	                        <input type="tel" id="mobile" name="mobile" maxlength="10" class="form-control box_in3 onlyInteger" value="">
  	                        <div id='mobile_err'></div>
  	                      </div>
  	                  </div>

                      <div class="col-sm-6">
                        <div class="form-group boot_sp">
                            <label class="form-control-placeholder2">Sender's  Name</label>
                            <input type="text" id="sender_name" name="sender_name" class="form-control box_in3" placeholder="Sender Name" value="<?=$loggedRow['fname']?> <?=$loggedRow['lname']?>">
                            <div id='sender_name_err'></div>
                          </div>
                      </div>
                     
                      <div class="col-sm-6">
                        <div class="form-group boot_sp">
                            <label class="form-control-placeholder2">Sender's Email</label>
                            <input type="text" id="sender_email" name="sender_email" class="form-control box_in3" placeholder="Sender Email" value="<?=$loggedRow['email']?>">
                            <div id='sender_email_err'></div>
                          </div>
                      </div>

	                  </div>
	                </div>
	                <div class="col-sm-6">
		                <div class="form-group boot_sp">
		                    <label class="form-control-placeholder2">Message</label>
		                    <textarea class="form-control box_in3" id="message" name="message" style="height:190px;"></textarea>
		                    <div id='message_err'></div>
		                </div>
	                </div>

              </div>

    				 	<input type="hidden" name="currency" id="currency" value="<?=$currency_code?>"/>
              <input type="hidden" name="pay_type" id="pay_type" value="RAZORPAY"/>
              <input type="hidden" name="payment_tax" id="payment_tax" value="<?php echo $tax; ?>"/>
              <input type="hidden" name="payment_tax_total" id="payment_tax_total" value="<?php echo $tax_total; ?>"/>
              <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $amountCart; ?>"/>
              <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
              <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
              <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
              <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
              <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
              <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
              <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
              <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>

              <input type="submit" value="Buy Now" class="subscribe_bt">

    			<?= form_close(); ?>  

	    </div>

		</div>

	</div>

</div>

</div>
<?php $this->load->view('front/template/footer'); ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

  <script src="assets/js/zoom-image.js"></script>

  <script src="assets/js/main.js"></script>
  <script type="text/javascript">

	$(document).ready(function() {

    $("input[name$='quote']").click(function() {

        var test = $(this).val();
        $("div.desc").hide();

        $("#Quote" + test).show();

    });

});

</script>
<script type="text/javascript">
$(document).ready(function() {
  var razorpay_pay_btn, instance;
  $('#ask-quote').on('submit',function(e){
      e.preventDefault();

      $('#fname_err').html('');
      $('#lname_err').html('');
      $('#mobile_err').html('');
      $('#recipient_email_err').html('');
      $('#sender_name_err').html('');
      $('#sender_email_err').html('');
       
      $('#message_err').html('');
      

      if($('#fname').val() == '' || $('#fname').val().trim().length == '') {
          $('#fname_err').html('<span class="text-danger">Please enter your first name</span>');
          $('#fname').focus();
          return false;
      } else if($('#lname').val() == '' || $('#lname').val().trim().length == '') {
          $('#lname_err').html('<span class="text-danger">Please enter your last name</span>');
          $('#lname').focus();
          return false;
      } else if($('#recipient_email').val() == '') {
          $('#recipient_email_err').html('<span class="text-danger">Please enter email</span>');
          $('#recipient_email').focus();
          return false; 
      } else if(!IsEmail($('#recipient_email').val())) {
          $('#recipient_email_err').html('<span class="text-danger">Please enter correct email</span>');
          $('#recipient_email').focus();
          return false; 
      }else if ($('#mobile').val() == '' || $('#mobile').val().trim().length == '') { 
        $('#mobile_err').html('<span class="text-danger">Please enter mobile number</span>') 
        $('#mobile').focus();
        return false; 
      } else if($('#sender_name').val() == '' || $('#sender_name').val().trim().length == '') {
          $('#sender_name_err').html('<span class="text-danger">Please enter sender name</span>');
          $('#sender_name').focus();
          return false;
      } else if($('#sender_email').val() == '') {
          $('#sender_email_err').html('<span class="text-danger">Please enter sender email</span>');
          $('#sender_email').focus();
          return false; 
      } else if(!IsEmail($('#sender_email').val())) {
          $('#sender_email_err').html('<span class="text-danger">Please enter correct email</span>');
          $('#sender_email').focus();
          return false; 
      }else if ($('#message').val() == '' || $('#message').val().trim().length == '') { 
        $('#message_err').html('<span class="text-danger">Please enter message</span>') 
        $('#message').focus();
        return false; 
      }else{
          /*$('#ask-quote').get(0).submit();
          return true;*/
          var name = document.getElementById('fname').value + ' ' +document.getElementById('lname').value;

          var email = document.getElementById('recipient_email').value;

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

                    document.getElementById('ask-quote').submit();

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
      }
  });    
  $("input[name$='quote']").click(function() {
      var test = $(this).val();
      $("div.desc").hide();
      $("#Quote" + test).show();
  });
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
        $('#'+id+'_err').html('<span class="text-danger">' + (words + 1) + ' character. Please enter minimum '+count + ' character.</span>');
         
      }
      
    }
  function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

