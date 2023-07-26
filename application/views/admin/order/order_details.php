<main class="main-content">

    

    <!--== Start Contact Area ==-->

    <section class="user-area">



      <div class="container-fluid">

        <div class="">

          <h3 class="uk_title">Order Summary</h3>

		  

				  <div class="summery_order">
				  		<?php $cart_typeArray = array();?>
							<div class="row">

								<div class="col-sm-10">

									<p><b>Order ID : <?= (!empty($order->order_id))? $order->order_id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order->payment_status))? ucwords($order->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order->order_status))? ucwords($order->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>

								</div>

								

								<div class="col-sm-2 text-right">

									<p><a href="<?= base_url('admin/user-order') ?>" class="btn btn-success"><i class="fa fa-long-arrow-left" ></i> Back</a></p>

								</div>

							</div>

							<hr>

							<div class="row">		

								<div class="col-md-12">	

									<div class="table-responsive">	

										<table class="table table-bordered table-striped text-nowrap text-center">

											<tr>

												<td>Image</td>

												<td>Name</td>

												<td>Vendor</td>

												<td>Size</td>

												<td>Unit Price</td>

												<td>Qty</td>

												<td>Subtotal</td>

											</tr>

											

											<?php if(!empty($val)) { foreach($val as $value) {?>
											
											<?php 
														if (!in_array($value->cart_type, $cart_typeArray)) {
															array_push($cart_typeArray, $value->cart_type);
														}
														$img = image_exist($value->productImg,'assets/images/product/'); 

                            if ($value->cart_type == 'service') {
                                $img = $value->productImg;
                            }

											?>
											<tr>

												<td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="order_pic" style= "width:60px;height: 60px;" ></td>

												<td><?= $value->productName ?></td>

												<td><?= $value->fname.' '.$value->lname ?> </td>

												<td><?= $value->size ?> </td>

												<td>&#8377; <?= number_format($value->productPrice)  ?></td>

												<td><?= (!empty($value->productQty))?$value->productQty :'' ?> </td>

												<td>&#8377; <?php $fAmt = $value->productPrice*$value->productQty;   echo number_format($fAmt);  ?></td>

											</tr>

											<?php } } ?>

									

											<?php if ($order->coupon_value) {?>

												<?php if ($order->bag_total_price * 100) {?>

													<tr>

														<td colspan="6" class="text-right"> Total</td>

														<td> &#8377; <?= number_format($order->bag_total_price)  ?></td>

													</tr>

												<?php }?>

	                      <tr>

													<td colspan="6" class="text-right"> Coupon Code(<?=$order->coupon_code?>)</td>

													<td> &#8377; - <?= number_format($order->coupon_value)  ?></td>

												</tr>

										

											<?php }?>

											<tr>

												<td colspan="6" class="text-right"> Total</td>

												<td> &#8377; <?= number_format($order->total_price)  ?></td>

											</tr>

											 

										</table>

									</div>	

								</div>

							</div>
							<?php  if(in_array('product',$cart_typeArray)){ ?>
								<div class="pp_profile">

									<div class="row">

										<div class="col-sm-12">

											<h3 class="uk_title">Shipping Address</h3>

											<p>Address : <?= $order->address ?></p>

											<p>Pin : <?=  $order->pincode ?></p>

											<p><?= $order->city.', '.$order->state.' - '.$order->country ?></p>

											<p>Email : <?= $order->user_email ?></p>

											<p>Mobile : <?= $order->mobile ?></p>

										</div>

									</div>

								</div>


								<div class="">

									<form method="post">

										<div class="row">

											<div class="col-md-12">

												<?php echo $this->session->flashdata('success');?>

											</div>

										</div>

										<div class="row">

											<div class="col-md-6">

												<div class="form-group boot_sp">

												    <label class="form-control-placeholder2" for="payment_status">Payment Status</label>

											    	<?php if(('APPROVED' != strtoupper($order->payment_status))){?>

														<select id="payment_status" name="payment_status" class="form-control box_in3">

															<?php foreach($payment_status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order->payment_status)){$sel = 'selected';}else{$sel = '';}?>

																<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

															<?php } ?>

														</select>

													<?php }else{?>

														<input type="text" value="<?php if(set_value('payment_status')){echo set_value('payment_status');}else{echo (!empty($order->payment_status))?$order->payment_status:'';}?>" class="form-control box_in3" required>

													<?php }?>

												</div>

											</div>

											

											<div class="col-md-6">

											    <div class="form-group boot_sp">

												    <label class="form-control-placeholder2" for="order_status">Order Status</label>

											    	<?php if('COMPLETED' != strtoupper($order->order_status)){?>

														<select id="order_status" name="order_status" class="form-control box_in3">

															<?php foreach($status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order->order_status)){$sel = 'selected';}else{$sel = '';}?>

																<?php if(strtoupper($value->status_name) != 'COMPLETED'){ ?>

																	<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

																<?php }else{ ?>

																	<?php if(('APPROVED' == strtoupper($order->payment_status))){ $style=""; }else{$style = 'display:none';}?>

																		<option id="<?=strtoupper($value->status_name)?>" style="<?=$style?>" value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

																	

																<?php } ?>

															<?php } ?>

														</select>

													<?php }else{?>

														<input type="text" value="<?php if(set_value('order_status')){echo set_value('order_status');}else{echo (!empty($order->order_status))?$order->order_status:'';}?>" class="form-control box_in3" required>

													<?php }?>

												</div>

											</div>

											<div class="col-md-6">	 

												<?php  if(strtoupper($order->order_status) != 'COMPLETED'){?>

													<button type="submit" class="btn btn-primary">Submit</button>

												<?php  }?>

											

											</div>

										</div>

									</form>

								</div>

							<?php  } ?>
					

				  </div>

					

					

        </div>

	    </div>

	  </section>

    <!--== End Contact Area ==-->



  

  

  </main>



  <!--== Start Footer Area Wrapper ==-->

