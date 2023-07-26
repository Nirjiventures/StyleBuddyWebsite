<?php  $this->load->view('Page/template/header'); ?>
<style>
    .my_cart .skin-2 .num-in {
    width: 100%!important;
}
.pro_cd_bt {
    border: 0px;
    background: #f62ac1;
    color: #FFF;
    padding: 5px 10px;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 12px;
    border-radius: 4px;
    position: absolute;
    right: 0;
}
.pro_cd {
    width: 90%;
    background: transparent;
    border: 0px;
    height: 28px;
    padding-left: 7px;
}
</style>
<?php 
		$cart_qty = 0;
		$cart_price = 0;
		foreach ($cartArray as $key => $value) {
			if($value->in_stock){
				$cart_price += $value->total;
				$cart_qty += $value->quantity;
			}
		}
		 
	?>
	
<div class="middle_part pt-0">
	<div class="container">
	    <div class="row m-3">
			<div class="col-sm-12">
				<div class="heading_part">
					<div class="my_bedcum">
						<ul>
							<li><a href="<?=base_url()?>">Home</a> </li>
							<li><a href="<?=base_url('shop')?>">Shop</a> </li>
							<li>Cart</li>
							 		
						</ul>
					</div>
				</div>
			</div>
		</div>
    	<div class="my_nw_cart">
    		<div class="row m-0 justify-content-between">
    			<div class="col-sm-12">
    				<div class="hdc_pp"><h1>Shopping Bag (<?= $cart_qty; ?>)</h1></div>
    			</div>
    			
    			<div class="col-sm-7">
    				<hr>
    
    				<div class="cta_create" style="display:none">
    				    <div class="col-sm-12"><div class="logo_p text-left mb-4"><?php if($this->session->flashdata('checkout_message')){echo $this->session->flashdata('checkout_message');} ?></div></div>
    					<?php if($this->session->userdata('userType')) {  ?>
    						<div class="fld">
    							<p><b>Full Name : </b><?= ucfirst($user->fname.' '.$user->lname) ?></p>
    						</div>
    					<?php }else { ?>
    						<h4>Create An Account</h4>
    						<p>
    							Signing up for an account is quick and gives you access to exclusive offers, news, order history and faster checkout. 
    							<a href="<?php echo base_url(); ?>user/registration">Create an Account</a> or 
    							<a href="<?php echo base_url(); ?>login">Sign In</a>
    						</p>
    
    					<?php } ?>
    
    
    				</div>
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
    					<div class="pro_summ">
    						<div class="row m-0">
    							<?php  $imgSplit = $cRow->image; ?>
    							<?php 
    								if($cRow->image_base_url){
    									$finalImageUrl = $imgSplit;
    								}else{ 
    									$finalImageUrl = base_url().'assets/images/product/'.$imgSplit;
    								}
    							?>
    							<div class="col-4 col-sm-3 p-0">
    								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=$finalImageUrl?>" class="mini_pro">
    							</div>
    							<div class="col-8 col-sm-9">
    								<div class="pro_dis_summry">
    									<h4><?=$cRow->product_name?></h4>
    
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
    									<div class="qtyy">
                                       		 <div class="num-block skin-2">
    											<div class="num-in">
    												<span class="minus dis"></span>
    												<input type="text" class="in-num qty<?= $v->id ?>"  name="qtybutton" value="<?= $v->quantity ?>" readonly="">
    												<span class="plus"></span>
    											</div>
    										</div>
                                		</div>
    	                                <div class="ppc_new">
    	                                	
    
    
    										<?= $this->site->currency.' '.number_format($v->total) ?>
    	                                </div>
    
    
    	                                <div class="remove_action">
    	                                	<a onclick="javascript:updateproduct('<?= $v->id ?>')" alt="Edit" title="Edit"><i class="fa fa-pencil"></i></a>
    	                                	<!-- <a href="" alt="Wishlist" title="Wishlist"><i class="fa fa-heart-o"></i></a> -->
    	                                	<a class="removecart" title="Remove" href="javascript:void(0)" id="<?= $v->id ?>" ><i class="fa fa-trash"></i></a>
    	                                	
    	                                </div>
    
    								</div>
    							</div>
    							
    						</div>
    					</div>
    
    
    				<?php } ?>
    			</div>
    
    			 
    			<div class="col-sm-4">
    				<div class="stk">
    					<div class="ot_summry">
    						<span class="ot_sum">ORDER SUMMARY</span>
    						<div class="ot_immer">
    						    <?php 	$sessionArray = json_decode($user_cart_session['cart_record']); ?>

    							<p>Subtotal <span><?= $this->site->currency ?> <?=$sessionArray->bag_mrp_price_total;?></span></p>

    							<p>Discount <span>-<?= $this->site->currency ?> <?=$sessionArray->display_discount_total;?></span></p>
    							
    							<p id="p_discount_html" style="display: none">Coupon Discount <span>-<?= $this->site->currency ?> <span id="discount_html"><?=$sessionArray->display_discount_total;?></span></span></p>

    							<p>Estimated Total <span><?= $this->site->currency ?> <span id="price_html"><?=$sessionArray->display_total;?></span></span></p>

    

    							<small class="">Apply Gift Code</small>
    							<div class="procode">
									<form action="#">
										<div class="input-group">
											<input name="coupan" id="coupon_code" type="text" class="pro_cd" placeholder="Enter Gift Code">
											<div class="input-group-append">
												<a style="cursor:pointer" type="submit"  onclick="ajax_couponapply('<?=$currentCurrency;?>')" class="pro_cd_bt"> Apply </a>
											</div>
										</div> 
									</form>
    							</div>
    							<p class="mt-2" id="applyCouponMessage"><b></b></p>
			    				<hr>
			    				
    							 
    							<small>Taxes,discount and shipping calculated at checkout</small>
                                <div class="col-sm-12"><div class="logo_p text-left mt-4"><?php if($this->session->flashdata('checkout_message')){echo $this->session->flashdata('checkout_message');} ?></div></div>
    					
    							<div class="proceed"><a href="<?= ('page/checkoutnew'); ?>">Proceed to checkout</a></div>
    							
    
    						</div>
    					</div>
    
    					<p class="text-center mt-3">Need Help? Email, Chat or Call (+91) 9898828200</p>
    
    				</div>
    			</div>
    
    		</div>
    	</div>	
    
    
    
    
    </div>

</div>

<?php $this->load->view('Page/template/footer'); ?>