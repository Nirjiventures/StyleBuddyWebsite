<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		<div class="col-sm-12">
			<div class="rightbar">
			    
                <?php 
                    $url1 = $this->uri->segment(1);
                    $url2 = $this->uri->segment(2);
                    $url3 = $this->uri->segment(3);
                ?>
                
                <div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Order Summary</h3>
						</div>
						<div class="col-sm-3 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/serviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
				 
                <div class="container">
                    <div class="summery_order">
			        	<div class="row">
							<div class="col-sm-9">
								<p><b>Order ID : #<?= (!empty($order->id))? $order->id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order->payment_status))? ucwords($order->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order->order_status))? ucwords($order->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>
							</div>
							
							 
						</div>
						<hr>
						<div class="row">		
							<div class="col-md-12">	
							<span class="text-center mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

								<?=$result;?>
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
				
			        </div>
				</div>
    	             
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>
</body>
</html>
