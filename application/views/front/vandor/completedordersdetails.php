<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="row m-0">
				<div class="col-sm-12">
					<div class="rightbar">
						<div class="row">
							<div class="col-sm-8"><h2>Order Detail</h2></div>
							<div class="col-sm-4 text-end">
								<a href="<?=base_url('vendor/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/completedorderslist')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>
						</div>
						<div class="summery_order">
							<div class="row">
								<div class="col-sm-9">
									<p><b>Order ID : #<?= (!empty($order->id))? $order->id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order_detail[0]->payment_status))? ucwords($order_detail[0]->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order_detail[0]->order_status))? ucwords($order_detail[0]->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>
								</div>
								
								<div class="col-sm-3 text-center">
									
								</div>
							</div>
							<hr>
							<div class="row">		
								<div class="col-md-12">	
									<div class="table-responsive">	
										<table class="table table-bordered table-striped text-nowrap text-center">
											<thead>
											<tr>
												<td nowrap="nowrap">Product Image</td>
												<td nowrap="nowrap">Product Name</td>
												<td nowrap="nowrap">Size</td>
												<td nowrap="nowrap">Unit Price</td>
												<td nowrap="nowrap">Qty</td>
												<td nowrap="nowrap">Subtotal</td>
											</tr>
											</thead>
											<?php if(!empty($order_detail)) { foreach($order_detail as $value) {?>
											<tr>
												<td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$value->productImg ?>" class="order_pic" style= "width:60px;height: 60px;" ></td>
												<td><?= $value->productName ?></td>
												<td><?= $value->size ?> </td>
												<td>&#8377; <?= number_format($value->productPrice)  ?></td>
												<td><?= (!empty($value->productQty))?$value->productQty :'' ?> </td>
												<td>&#8377; <?php $fAmt = $value->productPrice*$value->productQty;   echo number_format($fAmt);  ?></td>
											</tr>
											<?php } } ?>
										</table>
									</div>	
								</div>
							</div>
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
										    	<?php if(('APPROVED' != strtoupper($order_detail[0]->payment_status))){?>
													<select id="payment_status" name="payment_status" class="form-control box_in3">
														<?php foreach($payment_status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order_detail[0]->payment_status)){$sel = 'selected';}else{$sel = '';}?>
															<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>
														<?php } ?>
													</select>
												<?php }else{?>
													<input type="text" value="<?php if(set_value('payment_status')){echo set_value('payment_status');}else{echo (!empty($order_detail[0]->payment_status))?$order_detail[0]->payment_status:'';}?>" class="form-control box_in3" required>
												<?php }?>
											</div>
										</div>
										
										<div class="col-md-6">
										    <div class="form-group boot_sp">
											    <label class="form-control-placeholder2" for="order_status">Order Status</label>
										    	<?php if('COMPLETED' != strtoupper($order_detail[0]->order_status)){?>
													<select id="order_status" name="order_status" class="form-control box_in3">
														<?php foreach($status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order_detail[0]->order_status)){$sel = 'selected';}else{$sel = '';}?>
															<?php if(strtoupper($value->status_name) != 'COMPLETED'){ ?>
																<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>
															<?php }else{ ?>
																<?php if(('APPROVED' == strtoupper($order_detail[0]->payment_status))){ $style=""; }else{$style = 'display:none';}?>
																	<option id="<?=strtoupper($value->status_name)?>" style="<?=$style?>" value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>
																
															<?php } ?>
														<?php } ?>
													</select>
												<?php }else{?>
													<input type="text" value="<?php if(set_value('order_status')){echo set_value('order_status');}else{echo (!empty($order_detail[0]->order_status))?$order_detail[0]->order_status:'';}?>" class="form-control box_in3" required>
												<?php }?>
											</div>
										</div>
										<div class="col-md-6">	 
											<?php  if(strtoupper($order_detail[0]->order_status) != 'COMPLETED'){?>
												<button type="submit" class="btn btn-primary">Submit</button>
											<?php  }?>
										
										</div>
									</div>
								</form>
							</div>
					
				  		</div>
						<div class="rightbar" style="display: none;">
							<div class="row m-0 ">
								<div class="col-sm-8 text-start"><h2>Order Details</h2></div>
							
								<div class="col-sm-4 text-end">
									<b>Change Status</b>
									<select class="chhs">
										<option>Approved</option>
										<option>Pending</option>
										<option>Processing</option>
										<option>On Hold</option>
										<option>Delivered</option>
									</select>
								</div>
							</div>
							
							<hr>
							
							<div class="summery_order">
										<div class="row align-items-center">
											<div class="col-sm-9">
												<p class="odds"><b>Order ID : 0582 | </b>Status: <span class="approved">Approved</span>  |  Order Date : 03-May-22</p>
											</div>
											
											<div class="col-sm-3 text-center">
												<a href="orders.php" class="back_orders"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a>
											</div>
										</div>
										
										<hr>
										
											<table class="table table-bordered table-striped text-center">
												<tr>
													<td></td>
													<td>Product Name</td>
													<td>Unit Price</td>
													<td>Qty</td>
													<td>Subtotal</td>
												</tr>
												
												<tr>
													<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/vandor/images/t4.jpg" class="min_pro"> </td>
													<td> Running Shoes</td>
													<td> $ 5</td>
													<td> 1</td>
													<td> $ 5</td>
												</tr>
												
												<tr>
													<td> <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/vandor/images/t6.jpg" class="min_pro"> </td>
													<td> Running Shoes</td>
													<td> $ 5</td>
													<td> 2</td>
													<td> $ 10</td>
												</tr>
												
												<tr>
													<td colspan="4" class="text-right"> Total</td>
													<td> $ 15</td>
												</tr>
												<tr>
													<td colspan="4" class="text-right"> Tax</td>
													<td> $ 5</td>
												</tr>
												
												<tr>
													<td colspan="4" class="text-right"><b> Subtotal</b></td>
													<td> <b>$ 20</b></td>
												</tr>
												
											</table>
						
											<div class="pp_profile">
												<div class="row">
													<div class="col-sm-6">
														<h3 class="uk_title">Billing Address</h3>
														<p>B14/15 Noida Sector - 1</p>
														<p>Pin - 201301</p>
														<p>Uttar Pradesh - India</p>
														<p>Email : info@gmail.com</p>
														<p>Mobile : 9876543210</p>
														
													</div>
													
													<div class="col-sm-6">
														<h3 class="uk_title">Shipping Address</h3>
														<p>B14/15 Noida Sector - 1</p>
														<p>Pin - 201301</p>
														<p>Uttar Pradesh - India</p>
														<p>Email : info@gmail.com</p>
														<p>Mobile : 9876543210</p>
													</div>
													
												</div>
											</div>
											
									
									
						
								</div>
						
									
							<div class="col-sm-12">
								<input type="submit" value="Update"  class="sub">
							</div>						
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>