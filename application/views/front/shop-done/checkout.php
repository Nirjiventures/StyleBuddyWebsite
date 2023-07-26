<div class="banner_inner_2">

	<div class="container">

		<h1>Checkout</h1>

		<!--<?php 

				$this->breadcrumb = new Breadcrumbcomponent();

				$this->breadcrumb->add('Home', base_url());

				$this->breadcrumb->add('Checkout', base_url('checkout'));

		?>

		<?php echo $this->breadcrumb->output(); ?>-->

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



<?php

	$display_total = str_replace(",", '', $sessionArray->display_total);

	$description        = "Product Description";

	$txnid              = date("YmdHis");     

	$key_id             = ROZARPAY_KEY;

	$currency_code      = $currency_code;            

	$totalCart              = ($display_total * 100); // 100 = 1 indian rupees

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

									<div id="response_msg"></div>
									<div class="my_log_fm">
										<p><b>Email:</b></p>
										<input  id="userEmail" type="text">
									</div>

									<div class="my_log_fm">
										<p><b>Password:</b></p>
										<input id="userPassword" type="password">
									</div>

									<div class="remobb">
										<input name="rem" type="checkbox"> Remember
										<span><a href="<?=base_url('forgot-password')?>">Forgot password?</a></span>
									</div>
									<a type="submit" value="Login" class="action_bt4 mt-3 mb-3" onclick="login()">Login</a>
									 

									<p class="font12">By signing in, your are agreeing to our 
										<a href="#">Terms of Use</a> and 
										<a href="#">Privacy Policy.</a></p>

								</div>
							</div>	

						</div>
						<div class="gust_form">
							<a href="" id="back_to_page"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to Login</a>
							<div class="contact_info_">
								<div class="col-sm-12"><h5>Checkout As Guest </h5></div>
								<div class="row ">
								 	<input type="hidden" id="email" name="email" value="" class="box">
									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>First Name </label>

											<input type="text" id="fname" name="fname" value="" class="box">

											<div id="fname_Err" class="red"></div>

										</div>

									</div>



									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>Last Name </label>

											<input type="text" id="lname" name="lname" value="" class="box">

											<div id="lname_Err" class="red"></div>

										</div>

									</div>



									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>Phone Number </label>

											<input type="tel" id="mobile" name="mobile" value="" class="box onlyInteger">
										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>Email</label>
												<input type="email" id="email" name="email" value="" class="box onlyInteger">
										</div>

									</div>



								</div>	



							</div>


							<div class="ship_ads">

								<div class="col-sm-12 mt-5 mb-3"><h5>Shipping Information</h5></div>

								<div class=" row ">

									<div class="col-sm-12">

										<div class="form-group required-field">

											<label>Address (<small>House No, Flat, block, etc</small>)</label>

											<input type="text" id="address" name="address" value="" class="box">

											<div id="address_Err" class="red"></div>

										</div>

									</div>



									<div class="col-sm-6">

										<div class="form-group">

											<label>Country</label>

											<div class="select-custom">

												<select class="box" id="country" name="country">

													<option value="">Select Country *</option>

													
														<option value="Afghanistan">Afghanistan</option>

													
														<option value="Albania">Albania</option>

													
														<option value="Algeria">Algeria</option>

													
														<option value="Angola">Angola</option>

													
														<option value="Antarctica">Antarctica</option>

													
														<option value="Argentina">Argentina</option>

													
														<option value="Armenia">Armenia</option>

													
														<option value="Aruba">Aruba</option>

													
														<option value="Australia">Australia</option>

													
														<option value="Azerbaijan">Azerbaijan</option>

													
														<option value="Bahamas The">Bahamas The</option>

													
														<option value="Bahrain">Bahrain</option>

													
														<option value="Bangladesh">Bangladesh</option>

													
														<option value="Barbados">Barbados</option>

													
														<option value="Belarus">Belarus</option>

													
														<option value="Belize">Belize</option>

													
														<option value="Bermuda">Bermuda</option>

													
														<option value="Bhutan">Bhutan</option>

													
														<option value="Bolivia">Bolivia</option>

													
														<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

													
														<option value="Botswana">Botswana</option>

													
														<option value="Bouvet Island">Bouvet Island</option>

													
														<option value="Brazil">Brazil</option>

													
														<option value="Brunei">Brunei</option>

													
														<option value="Bulgaria">Bulgaria</option>

													
														<option value="Burundi">Burundi</option>

													
														<option value="Cambodia">Cambodia</option>

													
														<option value="Canada">Canada</option>

													
														<option value="Cape Verde">Cape Verde</option>

													
														<option value="Cayman Islands">Cayman Islands</option>

													
														<option value="Chile">Chile</option>

													
														<option value="China">China</option>

													
														<option value="Christmas Island">Christmas Island</option>

													
														<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>

													
														<option value="Colombia">Colombia</option>

													
														<option value="Comoros">Comoros</option>

													
														<option value="Democratic Republic Of The Congo">Democratic Republic Of The Congo</option>

													
														<option value="Costa Rica">Costa Rica</option>

													
														<option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>

													
														<option value="Cuba">Cuba</option>

													
														<option value="Czech Republic">Czech Republic</option>

													
														<option value="Denmark">Denmark</option>

													
														<option value="Djibouti">Djibouti</option>

													
														<option value="Dominican Republic">Dominican Republic</option>

													
														<option value="East Timor">East Timor</option>

													
														<option value="Egypt">Egypt</option>

													
														<option value="El Salvador">El Salvador</option>

													
														<option value="Eritrea">Eritrea</option>

													
														<option value="Estonia">Estonia</option>

													
														<option value="Ethiopia">Ethiopia</option>

													
														<option value="Falkland Islands">Falkland Islands</option>

													
														<option value="Fiji Islands">Fiji Islands</option>

													
														<option value="French Southern Territories">French Southern Territories</option>

													
														<option value="Gambia The">Gambia The</option>

													
														<option value="Georgia">Georgia</option>

													
														<option value="Ghana">Ghana</option>

													
														<option value="Gibraltar">Gibraltar</option>

													
														<option value="Guatemala">Guatemala</option>

													
														<option value="Guernsey and Alderney">Guernsey and Alderney</option>

													
														<option value="Guinea">Guinea</option>

													
														<option value="Guyana">Guyana</option>

													
														<option value="Haiti">Haiti</option>

													
														<option value="Heard and McDonald Islands">Heard and McDonald Islands</option>

													
														<option value="Honduras">Honduras</option>

													
														<option value="Hong Kong S.A.R.">Hong Kong S.A.R.</option>

													
														<option value="Hungary">Hungary</option>

													
														<option value="Iceland">Iceland</option>

													
														<option value="India" selected="">India</option>

													
														<option value="Indonesia">Indonesia</option>

													
														<option value="Iran">Iran</option>

													
														<option value="Iraq">Iraq</option>

													
														<option value="Israel">Israel</option>

													
														<option value="Jamaica">Jamaica</option>

													
														<option value="Japan">Japan</option>

													
														<option value="Jersey">Jersey</option>

													
														<option value="Jordan">Jordan</option>

													
														<option value="Kazakhstan">Kazakhstan</option>

													
														<option value="Kenya">Kenya</option>

													
														<option value="Korea North">Korea North</option>

													
														<option value="Korea South">Korea South</option>

													
														<option value="Kuwait">Kuwait</option>

													
														<option value="Kyrgyzstan">Kyrgyzstan</option>

													
														<option value="Laos">Laos</option>

													
														<option value="Latvia">Latvia</option>

													
														<option value="Lebanon">Lebanon</option>

													
														<option value="Lesotho">Lesotho</option>

													
														<option value="Liberia">Liberia</option>

													
														<option value="Libya">Libya</option>

													
														<option value="Lithuania">Lithuania</option>

													
														<option value="Macau S.A.R.">Macau S.A.R.</option>

													
														<option value="Macedonia">Macedonia</option>

													
														<option value="Madagascar">Madagascar</option>

													
														<option value="Malawi">Malawi</option>

													
														<option value="Malaysia">Malaysia</option>

													
														<option value="Maldives">Maldives</option>

													
														<option value="Man (Isle of)">Man (Isle of)</option>

													
														<option value="Mauritania">Mauritania</option>

													
														<option value="Mauritius">Mauritius</option>

													
														<option value="Mexico">Mexico</option>

													
														<option value="Moldova">Moldova</option>

													
														<option value="Mongolia">Mongolia</option>

													
														<option value="Morocco">Morocco</option>

													
														<option value="Mozambique">Mozambique</option>

													
														<option value="Myanmar">Myanmar</option>

													
														<option value="Namibia">Namibia</option>

													
														<option value="Nepal">Nepal</option>

													
														<option value="Netherlands">Netherlands</option>

													
														<option value="New Zealand">New Zealand</option>

													
														<option value="Nicaragua">Nicaragua</option>

													
														<option value="Nigeria">Nigeria</option>

													
														<option value="Norway">Norway</option>

													
														<option value="Oman">Oman</option>

													
														<option value="Pakistan">Pakistan</option>

													
														<option value="Panama">Panama</option>

													
														<option value="Papua new Guinea">Papua new Guinea</option>

													
														<option value="Paraguay">Paraguay</option>

													
														<option value="Peru">Peru</option>

													
														<option value="Philippines">Philippines</option>

													
														<option value="Poland">Poland</option>

													
														<option value="Qatar">Qatar</option>

													
														<option value="Romania">Romania</option>

													
														<option value="Russia">Russia</option>

													
														<option value="Rwanda">Rwanda</option>

													
														<option value="Saint Helena">Saint Helena</option>

													
														<option value="Samoa">Samoa</option>

													
														<option value="Sao Tome and Principe">Sao Tome and Principe</option>

													
														<option value="Saudi Arabia">Saudi Arabia</option>

													
														<option value="Serbia">Serbia</option>

													
														<option value="Seychelles">Seychelles</option>

													
														<option value="Sierra Leone">Sierra Leone</option>

													
														<option value="Singapore">Singapore</option>

													
														<option value="Smaller Territories of the UK">Smaller Territories of the UK</option>

													
														<option value="Solomon Islands">Solomon Islands</option>

													
														<option value="Somalia">Somalia</option>

													
														<option value="South Africa">South Africa</option>

													
														<option value="South Georgia">South Georgia</option>

													
														<option value="South Sudan">South Sudan</option>

													
														<option value="Sri Lanka">Sri Lanka</option>

													
														<option value="Sudan">Sudan</option>

													
														<option value="Suriname">Suriname</option>

													
														<option value="Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>

													
														<option value="Swaziland">Swaziland</option>

													
														<option value="Sweden">Sweden</option>

													
														<option value="Switzerland">Switzerland</option>

													
														<option value="Syria">Syria</option>

													
														<option value="Taiwan">Taiwan</option>

													
														<option value="Tajikistan">Tajikistan</option>

													
														<option value="Tanzania">Tanzania</option>

													
														<option value="Thailand">Thailand</option>

													
														<option value="Tonga">Tonga</option>

													
														<option value="Trinidad And Tobago">Trinidad And Tobago</option>

													
														<option value="Tunisia">Tunisia</option>

													
														<option value="Turkey">Turkey</option>

													
														<option value="Turkmenistan">Turkmenistan</option>

													
														<option value="Tuvalu">Tuvalu</option>

													
														<option value="Uganda">Uganda</option>

													
														<option value="Ukraine">Ukraine</option>

													
														<option value="UAE">UAE</option>

													
														<option value="England">England</option>

													
														<option value="United States">United States</option>

													
														<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>

													
														<option value="Uruguay">Uruguay</option>

													
														<option value="Uzbekistan">Uzbekistan</option>

													
														<option value="Vanuatu">Vanuatu</option>

													
														<option value="Venezuela">Venezuela</option>

													
														<option value="Vietnam">Vietnam</option>

													
														<option value="West indies">West indies</option>

													
														<option value="Yemen">Yemen</option>

													
														<option value="Yugoslavia">Yugoslavia</option>

													
														<option value="Zambia">Zambia</option>

													
														<option value="Zimbabwe">Zimbabwe</option>

													
														<option value="IRELAND">IRELAND</option>

													
														<option value="Scotland ">Scotland </option>

								


												</select>

												<div id="country_Err" class="red"></div>

											</div>

										</div>

									</div>



									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>State/Province</label>

											<input type="text" id="state" name="state" value="" class="box">

											<div id="state_Err" class="red"></div>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>City  </label>

											<input type="text" class="box" id="city" name="city" value="">

											<div id="city_Err" class="red"></div>

										</div>

									</div>



									<div class="col-sm-6">

										<div class="form-group required-field">

											<label>Zip/Postal Code </label>

											<input type="text" class="box onlyInteger" id="zip" name="zip" value="">

											<div id="zip_Err" class="red"></div>

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
					<?php }else{ ?>
						<div class="shipping_ads2_new">
							<div class="fm">
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



										<!--<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="box">-->

		                                <input type="hidden" name="userId" value="<?= ($user->id)?$user->id:'' ?>" class="box">



										<div class="contact_info_">

											<div class="col-sm-12"><h5>Contact Information</h5></div>



											<div class="row ">

											    <?php if(!$this->session->userdata('userType')) { ?>

													<div class="form-group required-field">

														<label>Email </label>

														<input type="email" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="box">

														<div id="email_Err" class="red"></div>

													</div>

													<p>If already have an account please <a href="<?=base_url('login')?>">login</a> else you can enter your mail ID and checkout as a Guest User. </p>

												<?php }else{ ?>

													<input type="hidden" id="email" name="email" value="<?= ($user->email)?$user->email:'' ?>" class="box">

												<?php } ?>

												

												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>First Name </label>

														<input type="text" id="fname" name="fname" value="<?= ($user->fname)?$user->fname:'' ?>" class="box">

														<div id="fname_Err" class="red"></div>

													</div>

												</div>



												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>Last Name </label>

														<input type="text" id="lname" name="lname" value="<?= ($user->lname)?$user->lname:'' ?>" class="box">

														<div id="lname_Err" class="red"></div>

													</div>

												</div>



												<div class="col-sm-6">

													<div class="form-group required-field">

														<label>Phone Number </label>

														<input type="tel" id="mobile" name="mobile" value="<?= ($user->mobile)?$user->mobile:'' ?>" class="box onlyInteger">

														<div id="mobile_Err" class="red"></div>

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

															<div id="address_Err" class="red"></div>

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

																<div id="country_Err" class="red"></div>

															</div>

														</div>

												  	</div>

													

								                    <div class="col-sm-6">

														<div class="form-group required-field">

															<label>State/Province</label>

															<input type="text" id="state" name="state" value="<?= ($user_shipping_address->state_name)?$user_shipping_address->state_name:'' ?>" class="box">

															<div id="state_Err" class="red"></div>

														</div>

													</div>

													<div class="col-sm-6">

														<div class="form-group required-field">

															<label>City  </label>

															<input type="text" class="box" id="city"  name="city" value="<?= ($user_shipping_address->city_name)?$user_shipping_address->city_name:'' ?>">

															<div id="city_Err" class="red"></div>

														</div>

													</div>



													<div class="col-sm-6">

														<div class="form-group required-field">

															<label>Zip/Postal Code </label>

															<input type="text" class="box onlyInteger" id="zip" name="zip" value="<?= ($user_shipping_address->zip)?$user_shipping_address->zip:'' ?>">

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

							<!-- <p><input name="pay_type" type="radio" value="ccavanue"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/ccavanue.png" alt="ccavanue" title="ccavanue"></p> -->

							<div class="pay_cin"><input name="pay_type" type="radio" value="RAZORPAY"> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/payments_ic.png" alt="ROZARPAY" title="RAZORPAY"></div>

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
		<?= form_close(); ?>   
	</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

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
            $.ajax({
                type: 'POST',
                dataType:"json",
                url: '<?php echo base_url(); ?>login/loginAjax',
                data: {userEmail:userEmail,userPassword:userPassword},
                success: function(data) {
                	$('#response_msg').html(data.response);
                	if(data.status == 'success'){
                		window.location.reload();
                	}else{

                	}
	           	}
            });    
        
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