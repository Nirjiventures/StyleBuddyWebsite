<style type="text/css">
	p#applyCouponMessage {
	    color: #14a01c;
	}
</style>
<?php 
	$cart_qty = 0;
	$cart_price = 0;

	$display_page_service = 0;
	$display_page_shop = 0;
	foreach ($cartArray as $key => $value) {
		if($value->in_stock){
			$cart_price += $value->total;
			$cart_qty += $value->quantity;


			if($value->cart_type == 'service'){
				$display_page_service++;
			}else{
				$display_page_shop++;	
			}

		}
	}
	 
?>
<div class="banner_inner">
	<div class="container">
		<h1>Cart</h1>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			if ($display_page_service) {
				$this->breadcrumb->add('Services', base_url('services'));
			}else{
				$this->breadcrumb->add('Shop', base_url('shop'));
			}
			$this->breadcrumb->add('Cart', base_url('cart'));
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>


<div class="middle_part">
		<div class="container">
			<div class="row m-0">
    			<div class="col-sm-12">
    				<div class="hdc_pp"><h5>My Shoping Cart (<?= $cart_qty; ?>)</h5></div>
    			</div>
    			<div class="col-sm-12"><hr></div>
    			<div class="col-sm-7">
    				
    				<?php $cartTotal = $sessionArray->display_bag_total;?>
    				<?php $cartIds = array();?>
    				<?php foreach($cartArray as $k=>$v){?>
    					<?php
    						$tbl_name = 'products';
    						$str = " WHERE id = '".$v->product_id."' ";
    						$pageRowQuery =  $this->common_model->get_all_details_query($tbl_name,'  '.$str);
    						$cRow = $pageRowQuery->row();
    					?>
    					<?php 	$total = $v->display_total;?>
    					
    					<?php 	$display_mrp_price = $v->display_mrp_price;?>
    					<?php 	$display_price = $v->display_price;?>
    					<?php 	$name = $cRow->product_name;?>
    					<?php  	$imgSplit = $cRow->image; ?>
    					<?php 	$quantity = $v->quantity ?>
						<?php 

							if($v->cart_type == 'service'){
								$finalImageUrl = $v->product_image;
								$name = $v->name;
							}else{
								if($cRow->image_base_url){
									$finalImageUrl = $imgSplit;
								}else{ 
									$finalImageUrl = 'assets/images/product/'.$imgSplit;
								}	
							}
							
						?>
						<?php $img =  'assets/images/no-image.jpg';?>
				        <?php if(!empty($finalImageUrl))  {?>
				            <?php 
				                if (file_exists($finalImageUrl)) {
				                    $img = $finalImageUrl;
				                }
				            ?>
				        <?php } ?>
    					<div class="cart_data">
    						<div class="row m-0">

    							
    							<div class="col-sm-2 col-4">
									<div class="photo_serv">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
									</div>
								</div>
    							<div class="col-sm-10 col-8">
    								<div class="card_dk">
    									<p><b><?=$name?></b> <span class="qqt">(Qty <?= $quantity ?>)</span></p>
    									<div class="row m-0 align-items-center">
    										<div class="col-sm-5 p-0 ">
    											<div class="ppc_cart">
													<?= ($v->price)?$this->site->currency.''.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?> 
													<?php if($v->mrp_price > $v->price){ ?>
													<span><del> <?= ($v->mrp_price)?$this->site->currency.''.number_format($v->mrp_price):$this->site->currency.''.number_format($v->mrp_price) ?></del> (<?= ($v->discount)?$v->discount.'%':'' ?> Discount)</span>
												    <?php }?> 
												</div>

		    									<?php if ($v->size) { ?>
		    										<!-- <div class="pro_size">Size: <?= ucwords($v->size) ?></div> -->
		    									<?php } ?>
		    
		    									<?php if ($v->discount) { ?>
		    										<!-- <div class="pro_price">Discount: <?= ($v->discount)?$v->discount.'%':'' ?></div> -->
		    									<?php } ?>
		    									
		    									<div class="ppc" style="display:none">
		    										Price : 
		    										<?php if($v->mrp_price > $v->price){ ?>
		    											<span style="text-decoration: line-through;" class="amount mrpprice<?= $v->id ?>"> <?= ($v->mrp_price)?$this->site->currency.''.number_format($v->mrp_price):$this->site->currency.''.number_format($v->mrp_price) ?></span>
		    											<span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.''.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>
		    										<?php }else{?>
		    											<span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.''.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>
		    										<?php }?> 
		    	                                </div>
	    	                                </div>
	    									<div class="col-sm-4">
	    									    <?php if($v->cart_type == 'service'){ ?>
    	    									    <?php if ($this->session->userdata('userType') && $this->session->userdata('userType') == 6) { ?>
                										<input type="hidden" class="in-num" name="qtybutton" value="1">
                									<?php }else if(empty($v->price * 100)){ ?>
                									    <input type="hidden" class="in-num" name="qtybutton" value="1">
                									<?php }else{ ?>
                    									<div class="my_cat_qty ssssseeerrrr">
                    										<div class="num-block skin-2">
                    											<div class="num-in">
                    												<span class="minus dis"></span>
                    												<input type="text" class="in-num qty<?= $v->id ?>" name="qtybutton" value="<?= $v->quantity ?>" readonly="">
                    												<span class="plus"></span>
                    											</div>
                    										</div>
                    									</div>
                    								<?php } ?>
                								<?php }else{ ?>
    												<div class="my_cat_qty">
    													<div class="num-block skin-2">
    		    											<div class="num-in">
    		    												<span class="minus dis"></span>
    		    												<input type="text" class="in-num qty<?= $v->id ?>"  name="qtybutton" value="<?= $v->quantity ?>" readonly="">
    		    												<span class="plus"></span>
    		    											</div>
    		    										</div>
    		                                		</div>
		                                		<?php } ?>
	                                		</div>
	    	                                <!-- <div class="ppc_new">
	    										<?= $this->site->currency.' '.number_format($v->total) ?>
	    	                                </div> -->
	    	                                <div class="col-sm-3">
		    	                                <div class="trs">
		    	                                	<a class="removecart" title="Remove" href="javascript:void(0)" id="<?= $v->id ?>" ><i class="fa fa-trash"></i> Remove</a>
		    	                                </div>
	    	                                </div>
	    								</div>
    								</div>
    							</div>
    							
    						</div>
    						<a class="up_cart"  onclick="javascript:updateproduct('<?= $v->id ?>')" alt="Update" title="Update"><i class="fa fa-refresh"></i></a>
    					</div>
    				<?php } ?>
    			</div>
    
    			 
    			<div class="col-sm-5">
    				<div class="final_summ">
    					<?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>
						<p><b>Order Summary</b></p>
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
								<?php 	$total = $v->display_total;?>
								
								<?php 	$display_mrp_price = $v->display_mrp_price;?>
								<?php 	$display_price = $v->display_price;?>
								 
								<?php  	$imgSplit = $cRow->image; ?>
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
						<div class="clearfix"></div>
						<?php if ($couponRow) { ?>
                			<div class="off_apply">
								<div class="row">
									<div class="col-sm-12">
										<b>Offers & Benefits</b>
									</div>
									<?php $i=0;foreach ($couponRow as $key => $value) { ?>
										<?php if($i==0) { $sty ='display:block;'; }else{$sty ='display:none;';} ?>
											<div class="col-sm-12 cart_div_" style="<?=$sty;?>" id="cart_div_<?php echo $value['id'];?>">
												<div class="coup_off">
													<div class="row">
														<div class="col-9 col-sm-9">
															<div class="cou_name">
																<h4><?php echo $value['gift_code'];?><span id="applyIcon<?php echo $value['id'];?>" style="display:none">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></span></h4>
																<p>Save another <i class="fa fa-inr"></i> <?php echo $value['coupon_code_price'];?> on this service</p>
															</div>
														</div>
														<input name="coupan" id="coupon_code__<?php echo $value['id'];?>" type="hidden" class="coup" value="<?php echo $value['gift_code'];?>">
														<input name="coupan" id="re_coupon_code<?php echo $value['id'];?>" type="hidden" class="coup" value="remove_coupon_code">
														<div class="col-3 col-sm-3 text-end">
															<div class="view_ooff" id="view_offer_button_apply<?=$value['id'];?>">
																<a style="cursor:pointer" onclick="ajax_couponapply('<?=$this->site->currency;?>','coupon_code__',<?php echo $value['id'];?>)">Apply</a>
															</div>
															<div class="view_ooff" id="view_offer_button_remove<?=$value['id'];?>" style="display:none;">
																<a style="cursor:pointer" onclick="ajax_couponapply('<?=$this->site->currency;?>','re_coupon_code',<?php echo $value['id'];?>)">Remove</a>
															</div>
														</div>
													</div>

													<div class="view_m_off text-center" id="view_more_cop_div<?=$value['id'];?>">
														<a href="#" data-bs-toggle="modal" data-bs-target="#view_more_cop">View more coupons <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
													</div>
												</div>
											</div>
									<?php $i++;} ?>
								</div>
							</div>
						<?php } ?>
						 
							<div class="coupan">
								<input name="coupan" id="coupon_code" type="text" class="coup" placeholder="Enter Gift Code / Coupon Code">
								<a  type="submit" style="cursor:pointer" onclick="ajax_couponapply('<?=$currentCurrency;?>','coupon_code','')" class="sub_coup"> Apply </a>
							</div> 
						
							<p class="mt-2" id="applyCouponMessage"><b></b></p>
		    				<hr/>
		    				<p><b>Subtotal</b> <span class="last_pp"><?= $this->site->currency ?> <?=$sessionArray->bag_mrp_price_total;?></span></p>
                            
							<!--<p><b>Discount</b> <span class="last_pp green_dis">- <?//= $this->site->currency ?> <?//=$sessionArray->display_discount_total;?></span></p>-->
							<p><span class="last_pp green_dis"></span></p>
							
							<p id="p_discount_html" style="display: none">Coupon Discount <span class="last_pp green_dis">-<?= $this->site->currency ?> <span  id="discount_html"><?=$sessionArray->display_discount_total;?></span></span></p>
							<hr>
							<p><b>Estimated Total</b> <span class="last_pp"><?= $this->site->currency ?> <span id="price_html"><?=$sessionArray->display_total;?></span></span></p>

		    				

		    				 
		    				 
                            <div class="col-sm-12"><div class="logo_p text-left mt-4"><?php if($this->session->flashdata('checkout_message')){echo $this->session->flashdata('checkout_message');} ?></div></div>
							<div class="text-center col-12"><a href="<?= base_url('checkout'); ?>" class="subscribe_bt3 w_fix">Proceed to checkout</a></div>
							<!--<div class="col-12 text-center mt-2 mb-2">OR</div>
							<div class="text-center col-12"><a href="<?=base_url('services/plans')?>" class="subscribe_bt3 w_fix">Continue Shopping</a></div>-->
						 
    				</div>
    			</div>
    
    		</div>
    	</div>
    </div>
</div>
 