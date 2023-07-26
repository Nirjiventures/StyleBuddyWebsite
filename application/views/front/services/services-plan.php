<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<div class="banner_yello">
	<div class="container">
		<h2>PRICING</h2>
        <p>Buy a styling service today & get exciting discounts on your next sessions</p>
	</div>
</div>

<div class="middle_part">
		<div class="container">
		
			<div class="row m-0 ">
					<div class="col-sm-6">
						<?php $serviceArray= array();?>
						<?php foreach($cartArray as $k=>$v){?>
							<?php 	if($v->cart_type == 'service'){?>
									<?php $serviceArra = array();?>
									<?php $serviceArra['id']= $v->product_id;?>
									<?php $serviceArra['qty']= $v->quantity;?>
									<?php array_push($serviceArray,$serviceArra);?>
							<?php } ?>	
						<?php } ?>	
							

						<div class="styling_daa">
							<p><b>Select from our Styling Services</b></p>
							<select class="box_select" name="services_id" id="services_id" onchange="getPlanShow(this.value)">
								<?php 
									$k = 0;
									$id = 0;
								?>
								<?php foreach ($our_services as $key => $datas) { ?>
									<?php
									$disabled = ''; 
									$key = array_search($datas->id, array_column($serviceArray, 'id')); 
									if ($key !== FALSE) {
										if ($k==0) {
											$k=1;
											$id = $serviceArray[$key]['id'];
											
										}
										//$disabled = 'disabled';  	
									}
									if ($datas->id == $id) {$sel='selected';}else{$sel='';}
									?>
									<option value="<?=$datas->id?>" <?=$sel?> <?=$disabled?>><?=$datas->title?></a> 
								<?php }?>
							</select>
						</div>
						<div id="allPlansDiv">
							<?php $i=0;foreach ($our_services as $key => $value) { ?>
								<?php 
									$datas = $value;	
									$price = $datas->price;
									$mrpprice = $datas->mrp_price;
									$discountAmt = $mrpprice - $price;
									if(empty($mrpprice)){
                            		    $discount_ = 0; 
                            		}else{
                            		    $discount_ = ($discountAmt*100/$mrpprice);   
                            		}
									$data_display = 'none';
									$display = 'display:none;';

									if (empty($serviceArray)) {
										if ($i == 0) {
											$display = 'display:block;';
											$data_display = 'show';
										}
									}
									$display_addbutton = 'display:none;';
									$display_addbutton1 = 'display:block;';
									$key = array_search($datas->id, array_column($serviceArray, 'id'));
									$qty = 1;
									if ($key !== FALSE) {
									  	$display_addbutton = 'display:block;';
										$display_addbutton1 = 'display:none;';
										$qty = $serviceArray[$key]['qty'];
										$display = 'display:block;';
										$data_display = 'show';


									}

								?>

								<div class="stylish_by" data-visible="<?=$data_display?>" id="planDiv<?=$value->id?>" style="<?=$display?>">
									<h4><?=$value->title?> <span><a href="<?=base_url('services/'.$value->slug)?>" class="action_bt2">Read More</a></span></h4>
									<hr>
									<?= $value->short_description ?>
									
									<!--<p><a  data-bs-toggle="modal" data-bs-target="#myModal___<?=$value->id?>" class="action_bt2">Read More</a></p>-->
                                    <div class="pk_price">
										<p><i class="fa fa-inr"></i> <?= $price;?> /-<span class="per_session"> Per Session</span></p>
										<?php if($mrpprice > $price){ ?>
											<span><del> <i class="fa fa-inr"></i> <?= $mrpprice?></del> (<?=(int)$discount_?>% Discount)</span>	
										<?php }?>
										 
									</div>
									<div class="modal" id="myModal___<?=$value->id?>" data-bs-keyboard="false" data-bs-backdrop="static">
										<div class="modal-dialog modal-dialog-centered modal-lg">
										    <div class="modal-content">
										      	<div class="modal-header">
										        	<h4 class="modal-title"><?=$value->title?> <span><a href="<?=base_url('services/'.$value->slug)?>" class="action_bt2">Read More</a></span></h4>
										        	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										      	</div>
										      	<div class="modal-body">
												  	<div class="full_reccc">
														<?= $value->description_middle ?>
													</div>
										      	</div>
										    </div>
										</div>
									</div>
									<div class="qty">
										<div class="add_v"><a style="<?=$display_addbutton1?>" class="add_data" data-id="<?= $datas->id ?>"  data-price="<?= $datas->price ?>" data-mrp_price="<?= $datas->mrp_price ?>">Add</a></div>
										
										<div class="add_qt" style="<?=$display_addbutton?>">
											<div class="num-block skin-2">
												<div class="num-in">
													<span class="minus"></span>
													<input type="text" data-id="<?= $datas->id ?>"  data-price="<?= $datas->price ?>" data-mrp_price="<?= $datas->mrp_price ?>" class="in-num_plan" name="qtybutton" value="<?=$qty?>" readonly="">
													<span class="plus"></span>
												</div>
											</div>
										</div>
									</div>

									<?php $couponRow =  $value->couponRow; ?>
						            <?php if($couponRow){ ?>
		                                <div class="col-sm-12 ">
		                                    <div class="message_offer">
		                                       Get <span><?php echo $couponRow['name'];?></span> Discount using coupon code
		                                    </div>
		                                </div>
		                            <?php } ?>
								</div>
							<?php $i++;}?>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="data_summery" id="data_summery">
							<h4>Summary </h4>
							<hr>
							<?php $sessionArray = json_decode($user_cart_session['cart_record']); ?>
							<?php $cartTotal = $sessionArray->display_bag_total;?>
							<?php $cartIds = array();?>
							<?php $discount_total = 0;?>
							<?php $quantity = 0;?>
							<?php $total = 0;?>
							<?php $mrp_price_total = 0;?>
							<div class="personal_sp_summery">
								<?php foreach($cartArray as $k=>$v){?>
									<?php 	if($v->cart_type == 'service'){?>
										<?php 	$discount_total += $v->discount_total;?>
										<?php 	$quantity += $v->quantity;?>
										<?php 	$total += $v->total;?>
										<?php 	$mrp_price_total += $v->mrp_price_total;?>

										<div class="personal_sp">
											<p><b><?=$v->name?> <span class="qqt" id="qty_plan<?=$v->product_id?>">(Qty <?= $v->quantity ?>)</span></b></p>
											<p>One time Payment
												<span class="font22 right_pasa">
													<small class="sav" id="sav_plan<?=$v->product_id?>">Save <?= $this->site->currency.' '.numberformat($v->discount_total) ?></small>
													<b id="plan_total_plan<?=$v->product_id?>"><?= $this->site->currency.' '.numberformat($v->total) ?></b>
												</span>
											</p>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
							<?php 
								$d = 0;
								if ($mrp_price_total) {
									$d = number_format((($discount_total * 100) / $mrp_price_total),1);
								}
								 
							?>
							<?php if($quantity){ ?>
								<div class="my_discount"><b>Discount(<?= number_format($d,1) ?>%)<span><?=$this->site->currency.' '.numberformat($discount_total)?></span> </b></div>
								<div class="Sub_total">
									Subtotal (<span id="total_qty_plan<?=$v->product_id?>"><?=$quantity?> item</span>): <b id="sub_total_plan<?=$v->product_id?>"><?=$this->site->currency.' '.numberformat($total)?></b>
								</div>
							<?php } ?>
							<div class="personal_sp">
								<?php if($quantity){ ?>
									<div class="text-center col-12"><a href="<?=base_url('cart')?>" class="subscribe_bt3">View Cart</a></div>
								<?php }else{ ?>
									<div class="text-center col-12"><a href="#" class="subscribe_bt3">Cart is empty</a></div>
								<?php } ?>
								
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<script>
		
		$(document).ready(function() {
	      	$('.num-in span').click(function () {
		        var $input = $(this).parents('.num-block').find('input.in-num_plan');
		        let id = $input.data("id");
				let price = $input.data("price");
				let mrpprice = $input.data("mrp_price");
		        let url =  base_url+"Services/add_to_cart";

		        var count;
		        if($(this).hasClass('minus')) {
		          	count = parseFloat($input.val()) - 1;
		          	count = count < 1 ? 1 : count;
		          	if (count < 2) {
		            	$(this).addClass('dis');
		            }
		          	else {
		            	$(this).removeClass('dis');
		            }
		          	if(parseFloat($input.val()) > 1){
		        		let qty = count;
						ajaxCall(id,price,mrpprice,qty,'remove');
						$(".min_cart_bottom").show();
		        	}
	          		$input.val(count);
		        }
		        else {
		          	count = parseFloat($input.val()) + 1
		          	$input.val(count);
		          	if (count > 1) {
		            	$(this).parents('.num-block').find(('.minus')).removeClass('dis');
		          	}
		          	let qty = count;
					ajaxCall(id,price,mrpprice,qty,'add');
					$(".min_cart_bottom").show();
		        }
		        $input.change();
		        
		        
		        
		        return false;
	      	});
	    });
		
	</script>