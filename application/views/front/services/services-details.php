<style>
    a.whtss {background: #25D366;color: #FFF;padding: 10px 20px;border-radius: 15px 15px 0px;font-size: 25px;display: flex;width: 215px!important;}

a.whtss i {
    font-size: 40px;
    align-items: center;
    margin-left: 18px;
}
</style>

<div class="middle_part_shop">
	<div class="full_see_box">
		<div class="container">
			<div class="row m-0 align-items-center">
				<div class="col-sm-5 p-0">
					<div class="pho_ser">
						<?php  $img = image_exist($datas->image,'assets/images/services/'); ?>
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
						<!-- <div class="my_exp2"><?= $datas->title ?></div> -->
					</div>
				</div>
				<div class="col-sm-7">
					<div class="ser_data">
						<h3><?= $datas->title ?></h3>
						<p><?= $datas->sub_title ?></p>
						<?php //echo $datas->description_top; ?>
					</div>
					<?php //if($datas->price){ ?>
						<?php 	
							$price = $datas->price;
							$mrpprice = $datas->mrp_price;
							$discountAmt = $mrpprice - $price;
							if(empty($mrpprice)){
							    $discount_ = 0; 
							}else{
							    $discount_ = ($discountAmt*100/$mrpprice);   
							}
							//var_dump($couponRow);	
						?>
						
					
					
			            
						<?php if($couponRow){ ?>
							<div class="get_serv_off mb-3" style="display: none;">
								<p><?=$couponRow['name'];?> <br>Copy the coupon code & use on checkout</p>
								 <div class="copy-button">
						          <input id="copyvalue" type="text" readonly value="<?=$couponRow['gift_code'];?>" />
						          <button onclick="copyIt()" class="copybtn">COPY</button>
						        </div>
							</div>
						<?php } ?>
						<div class="<?php if(!$this->session->userdata('userId') && $this->uri->segment(2) != 'free-introduction-to-styling'){ ?> srv_plan<?php }elseif($this->session->userdata('userId') && $this->uri->segment(2) != 'free-introduction-to-styling'){ ?> srv_plan <?php } ?> ?>" >
							<div class="row m-0 align-items-center cart_qty_row">
								<div class="col-sm-6 col-12 p-0">
									<div class="pk_price">
										<?php if ($this->session->userdata('userType') && $this->session->userdata('userType') == 6) { ?>
    										<?php if(!empty($price)){ ?>
    											<p><i class="fa fa-inr"></i> <?= $price;?></p>
    										<?php } ?>
										<?php }else{ ?>
										    <?php if(!empty($price)){ ?>
											    <p><i class="fa fa-inr"></i> <?= $price;?> <?php if(!empty($price)){ ?>/-<span class="per_session"> Per Session</span><?php }?></p>
										    <?php }?>	
										<?php }?>	
										 
										<?php //if($mrpprice > $price){ ?>
											<!--<span><del> <i class="fa fa-inr"></i> <?//= $mrpprice?></del> (<?//=(int)$discount_?>% Discount)</span>	-->
										<?php //}?>
										 
									</div>
								</div>
								<div class="col-sm-6 col-12 p-0">
									<?php if ($this->session->userdata('userType') && $this->session->userdata('userType') == 6) { ?>
										<input type="hidden" class="in-num" name="qtybutton" value="1">
									<?php }else if(empty($mrpprice)){ ?>
									    <input type="hidden" class="in-num" name="qtybutton" value="1">
									<?php }else{ ?>
    									<div class="my_cat_qty2">
    										<div class="num-block skin-2">
    											<div class="num-in">
    												<span class="minus"></span>
    												<input type="text" class="in-num" name="qtybutton" value="1" readonly="">
    												<span class="plus"></span>
    											</div>
    										</div>
    									</div>
    								<?php } ?>
    								<?php if(empty($mrpprice)){ 
    								    // Below condition added by Naushad - 07-07-2023
    								    if(!$this->session->userdata('userId')){ ?>
										<div class="by_serv">
										    <a href="<?php echo base_url('user/registration'); ?>" class="action_bt_2">Book Now </a>
    										<!--<a class="whtss" title="Book Now"  href="https://wa.link/stfnoe"> WhatsApp <i class="fa fa-whatsapp" aria-hidden="true"></i></a>-->
    									</div>
    								<?php } ?>
									<?php }else{ ?>
										<div class="by_serv">
    										<a class="action_bt4 service_add" title="Add"  data-id="<?= $datas->id ?>"  data-price="<?= $datas->price ?>" data-mrp_price="<?= $datas->mrp_price ?>"> Add</a>
    									</div>
									<?php } ?>
									
								</div>
								
								
								
							</div>
								
						</div>
					<?php //} ?>


                        <?php if($couponRow){ ?>
					            <div class="message_offer2  mt-3" style="display:none">
			                       <!--Get <span> <i class="fa fa-inr"></i><?php //echo $couponRow['coupon_code_price'];?></span> Discount using coupon code-->
			                       <span> <?php //echo $couponRow['name'];?></span> 
			                    </div>
			            <?php } ?>

                        <div class="message_offer2  mt-3">
	                       <span>Enjoy discounts with coupon code on checkout </span> 
	                    </div>
		            
				</div>
			</div>
		</div>
	</div>

	<?php if(!empty($datas->right_section1) && !empty($datas->left_section1)){ ?>
		<div class="new_heading">
			<div class="container">
				<div class="suitable">
					<div class="row m-0">
					
						<div class="col-sm-6">
							<div class="find_out">
								<?= $datas->left_section1 ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="not_sure">
								<?= $datas->right_section1 ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php if($couponRows){  ?>
		<section class="offer_box" style="display:none;">
			<div class="container">
				<h3>We are Offering </h3>
				<section class="add_offer_slidre slider">
					<?php $i=0;foreach ($couponRows as $key => $value) {  ?>
						<?php 
							if($i%4 == 1){
								$k = 1;
							}else if($i%4 == 2){
								$k = 2;
							}else if($i%4 == 3){
								$k = 3;
							}else if($i%4 == 0){
								$k = 4;
							}

						?>
						<div class="ads_boxx style<?=$k?>">
							<div  class="dsi_box">
								<div class="ribbon blue"><span>New</span></div>	
								<div class="row align-items-center">
									<div class="col-sm-8">
										<div class="off_data">
											<!--<h4>Get <span><?//=$value['name'];?> <small>off</small></span> </h4>-->
											<h4><span><?=$value['name'];?> </span> </h4>
											<p><?=$value['serviceRow']['title']?></p>
											<a href="<?=base_url('services/'.$value['serviceRow']['slug'])?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="off_photo">
											<?php $img =  'assets/images/services/image1687417032.jpg';?>
								            <?php if(!empty($value['media']))  {?>
								                <?php 
								                    $img1 =  $value['media']; 
								                    if (file_exists($img1)) {
								                        $img = $img1;
								                    }
								                ?>
								            <?php } ?>
								            <img src="<?=base_url($img);?>" class="img-fluid">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php $i++;}  ?>
					


					<!-- <div class="ads_boxx style2">
							<div  class="dsi_box">
							<div class="ribbon blue"><span>New</span></div>	
							<div class="row align-items-center">
								<div class="col-sm-8">
									<div class="off_data">
										<h4>Get <span>30% <small>off</small></span> </h4>
										<p>Personal Wardrobe Edit</p>
										<a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="off_photo">
										<img src="https://www.stylebuddy.in/assets/images/services/image1685610864.jpg" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="ads_boxx style3">
							<div  class="dsi_box">
							<div class="ribbon blue"><span>New</span></div>	
							<div class="row align-items-center">
								<div class="col-sm-8">
									<div class="off_data">
										<h4>Get <span>40% <small>off</small></span> </h4>
										<p>Personal Shopper</p>
										<a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="off_photo">
										<img src="https://www.stylebuddy.in/assets/images/services/image1688133858.jpg" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="ads_boxx style4">
							<div  class="dsi_box">
							<div class="ribbon blue"><span>New</span></div>	
							<div class="row align-items-center">
								<div class="col-sm-8">
									<div class="off_data">
										<h4>Get <span>40% <small>off</small></span> </h4>
										<p>Enhance Your Confidence and Self-Image</p>
										<a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="off_photo">
										<img src="https://www.stylebuddy.in/assets/images/services/image1687486574.jpg" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</section>
			</div>
		</section>
	<?php } ?>

    	
	<?php if(!empty($datas->right_section1) && !empty($datas->left_section1)){ ?>
		<div class="whats_includd">
			<div class="container">
				<div class="title_part ">
					<h2 class="font60"><?= $datas->section2 ?></h2>
				</div>
			
				<div class="row m-0">
					<div class="col-sm-6">
						<div class="styling_pp">
							<?= $datas->left_section2 ?>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="styling_pp">
							<?= $datas->right_section2 ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="container">
		<div class="about_sk">
			<div class="title_part ">
				<h2 class="font60"><?= $datas->section1 ?></h2>
			</div>
			<div class="col-sm-8">	
				<?= $datas->description_top ?>
				
			</div>
		</div>
	</div>
	
	
	


		<div class="container">
        <div class="monre_aboutt">
        <?php if ($datas->description_middle) {  ?>
        	<?php 
				$description_middle = (json_decode($datas->description_middle));
	            $rowCount = 0;
	            $i = 0;
	            $html = '';
	            $ac_title = $description_middle->ac_title;
	            $ac_description = $description_middle->ac_description;
	        ?>
	        <?php if ($description_middle && $ac_title) {  ?>
				<div class="col-sm-12">
					<div class="title_part ">
						<h2 class="font60">More About the Service</h2>
					</div>
				
					<div class="my_data">
						<div class="accordion" id="accordionExample">
							<?php for ($i=0; $i < count($ac_title); $i++) {  ?>
	                        	<div class="accordion-item">
									<h2 class="accordion-header" id="headingOne<?=$i?>">
									 	 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?=$i?>" aria-expanded="true" aria-controls="collapseOne<?=$i?>">
											<p><?=$ac_title[$i];?></p>
									  	</button>
									</h2>
									<div id="collapseOne<?=$i?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?=$i?>" data-bs-parent="#accordionExample">
										<div class="accordion-body"><?=$ac_description[$i];?> </div>
									</div>
								</div>
	                        <?php  } ?>
						</div> 
					</div>
				</div>
			<?php  } ?> 
		<?php  } ?> 
		</div>
	</div>

		<?php if ($featured_stylist) { ?>
			<section class="textiim yellow padd80">
				<div class="container">
					<div class="title_part ">
						<h2 class="font60">Customers Love Stylebuddy</h2>
						<p class="rev">600+ Reviews</p>
					</div>
					<style type="text/css">.caption{display: none!important;}</style>
					<div class="testimonial slider">
						<?php foreach ($featured_stylist as $key => $vender): ?>
							<?php echo stylist_review_div($vender)?>	
						<?php endforeach ?>
					</div>
				</div>
			</section>
		<?php } ?>

		<div class="container">
		<?php if ($our_services) { ?>
			<section class="servicess_slidee">	
				<div class="title_part ">
					<h2 class="font60">More Services</h2>
					<p class="pink">Because you deserve to look your best</p>
				</div>
				<section class="servives_sld slider">
					<?php $i=0;foreach ($our_services as $key => $value) { ?>
						<?php 
							$mode = 4;
							if($i%$mode==0){
								$k = 1;
							}elseif($i%$mode==1){
								$k = 2;
							}elseif($i%$mode==2){
								$k = 3;
							}elseif($i%$mode==3){
								$k = 2;
							} 
							
						?>
						<?php  service_div($value,$k) ;?>
					<?php $i++;}?>
				</section>
			</section>
		<?php } ?>
	</div>
    <?php if (!$this->session->userdata('userType')) { ?>	
    <section class="register_yellow" style="background: #FAFF00 url('<?=base_url('assets/images/skd.png')?>');">
    	<div class="container">
    		<div class="col-sm-9">
    			<div class="yellow_title">
    				<h3 class="font50 mb80">Register for attractive Styling deals</h3>
    				
    				<div class="row m-0 justify-content-between">
    					
    					<div class="col-lg-5 col-md-6 col-sm-6">
    						<div class="log_bottom">
    							<h4 class="mb80">Login</h4>
    							<div id="response_msg"></div>
    							<div class="fm_group">
    								<p>Email Id</p>
    								<input name="userEmail" id="userEmail" type="text" class="sub_box">
    								<div id="email_err"></div>
    							</div>
    							
    							<div class="fm_group">
    								<p>Password: </p>
    								<div class="fg_gp" style="margin-bottom:0px">
        								<input name="userPassword" id="userPassword" type="password" class="sub_box" style="margin-bottom: 16px;">
        								<i class="toggle-password fa fa-fw fa-eye-slash"></i>
        								<div id="password_err"></div>
        							</div>
    							</div>
    							<div class="fg_gp" style="margin-top:0px;float: right;">
    							    <a href="<?= base_url('forgot-password') ?>">Forgot password?</a>
    							</div>
    							<div class="clearfix"></div>
    							<div class="fm_group bt_postion">
    								<a type="submit" value="Login" class="action_bt4" onclick="login()">Login</a>
    							</div>
    							
    							
    						</div>
    					</div>
    					<div class="col-lg-6 col-md-6 col-sm-6">
    						<div class="new_red">
    							<h4>New to Stylebuddy?</h4>
    							<a href="<?=base_url('user/registration')?>">Register Now!</a>
    							<br/><br/>
    							<a href="<?=base_url('login/stylistlogin')?>">Login as Stylist!</a>
    						</div>
    						
    					</div>
    					
    				</div>
    				
    			</div>
    		</div>
    	</div>
    </section> 
    <?php } ?>
</div>
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
                	$('#response_msg').html('<span class="text-danger">'+ data.response +'</span>');
                	if(data.status == 'success'){
                		window.location.reload();
                	}else{

                	}
	           	}
            });    
        
	}
</script>

<script>
	
	let copybtn = document.querySelector(".copybtn");


	function copyIt(){
	  let copyInput = document.querySelector('#copyvalue');

	  copyInput.select();

	  document.execCommand("copy");

	  copybtn.textContent = "COPIED";
	}
</script>
