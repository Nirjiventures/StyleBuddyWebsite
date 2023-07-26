<?php $this->load->view('front/template/header'); ?>
<?php 
    $url1 = $this->uri->segment(1);
    $url2 = $this->uri->segment(2);
    $url3 = $this->uri->segment(3);
?>
<div class="container-fluid p-0">
	<div class="row m-0 justify-content-end">
		<div class="col-sm-3 p-0 black_bg">
			<div class="sidebar">
			<?php $this->load->view('front/user/siderbar'); ?>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="rightbar1">
                <div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Order Summary</h3>
						</div>
						<div class="col-sm-3 text-end">
							<a href="<?=base_url('user/user-dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('user/myshoporder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
                <div class="container">
                    <div class="summery_order">
			        	<div class="row">
							<div class="col-sm-12">
								<p><b>Order ID : #<?= (!empty($order->order_id))? $order->order_id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order->payment_status))? ucwords($order->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order->order_status))? ucwords($order->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>
							</div>
						</div>
						<hr/>
						<div class="row">		
							<div class="col-md-12">	
								<div class="">
									<?php $cart_typeArray = array();?>
                        			<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">
                    					<thead>
                    						<tr>
                    							<th class="no">Thumb</th>
												<th class="no">Order ID</th>
												<th class="name">Name</th>
												<th class="date">Date</th>
												<th class="date">Qty</th>
												<th class="total">Total  Amount</th>
                    						</tr>
                    					</thead>
                        				<tbody>
                            				<?php  
                            					$value = $order; 
                            				    $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);
                            				 
												if (!in_array($value->cart_type, $cart_typeArray)) {
													array_push($cart_typeArray, $value->cart_type);
												}
												$img = image_exist($value->productImg,'assets/images/product/'); 
					                            if ($value->cart_type == 'service') {
					                                $img = $value->productImg;
					                            }

											?>

                    						<tr>
                    						    <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="min_pro" style= "width:60px;height: 60px;" ></td>
                    						    <td>#<?= $value->order_id ?></td>
                    							<td><?= ($value->productName);  ?></td>
                    							<td><?= $fdate ?></td>
                    							<td> <?= number_format($value->productQty) ?></td>
                    							<td> &#8377; <?= number_format($value->totalPrice) ?></td>
                    							 
                    						</tr>
                        				</tbody>
                        			</table>

                        			<?php  if(in_array('product',$cart_typeArray)){ ?>
										<div class="pp_profile">
											<div class="row">
												<div class="col-sm-6">
													<h3 class="uk_title">Shipping Address</h3>
													<p><?= $order->order_row->address ?></p>
													<p>Pin - <?= $order->order_row->pincode ?></p>
													<p><?= $order->order_row->city.', '.$order->order_row->state.' - '.$order->order_row->country ?></p>
													<p>Email : <?= $order->order_row->user_email ?></p>
													<p>Mobile : <?= $order->order_row->mobile ?></p>
												</div>
											</div>
										</div>
									<?php }?>

								</div>
							</div>
						</div>
			        </div>
				</div>
            </div>
        </div>
	</div>
</div>

<?php $this->load->view('front/template/footer'); ?>
