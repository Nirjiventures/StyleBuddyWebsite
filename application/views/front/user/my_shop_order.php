<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">

	<div>

		<div class="row m-0 justify-content-end">

			<div class="col-sm-3 p-0 black_bg">

				<div class="sidebar">

				<?php $this->load->view('front/user/siderbar'); ?>

				</div>

			</div>

			<div class="col-sm-9">

    			<div class="rightbar1">

    			    

                    <?php 

                        $url1 = $this->uri->segment(1);

                        $url2 = $this->uri->segment(2);

                        $url3 = $this->uri->segment(3);

                    ?>

                    <div class="container">

    					<div class="row">

    						<div class="col-sm-8">

    							<h3>Shop Orders</h3>

    						</div>

    						<div class="col-sm-4 text-end">

    							 

    						</div>

    					</div>

    					<hr>

    				</div>

    				 

                    <div class="container">

                    	<div class="row">

                    		<div class="col-md-12 mt-5">

                    		    <div id="message" class="text-primary text-center"></div>

                    			<div class="table-responsive ">

                    			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

                                    <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		

                                    
                                    <?php $cart_typeArray = array();?>
                        			<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">

                    					<thead>

                    						<tr>

                    							<th class="no">No</th>
                    							<th class="no">Thumb</th>
												<th class="no">Order ID</th>
												<th class="name">Name</th>
												<th class="date">Date</th>
												<th class="date">Order Status</th>
												<th class="date">Qty</th>
												<th class="total">Total  Amount</th>
												<th class="action">Details</th>
                    						</tr>

                    					</thead>

                        				<tbody>
                            				<?php  $num = 1; if(!empty($list)) { foreach($list as $value) { 
                            				        $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);
                            				?>
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
                    						    <td><?= $num ?></td>
                    						    <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="min_pro" style= "width:60px;height: 60px;" ></td>
                    						    <td>#<?= $value->order_id ?></td>
                    							<td><?= ($value->productName);  ?></td>
                    							<td><?= $fdate ?></td>
                    							<td> <?= ucwords($value->order_status) ?></td>
                    							<td> <?= number_format($value->productQty) ?></td>
                    							<td> &#8377; <?= number_format($value->totalPrice) ?></td>
                    							<td><a href="<?= base_url($url1.'/'.$url2.'detail/').$value->id ?>" class="btn btn-success">View</a></td>
                    						</tr>
                    						<?php $num++; }} else {?>
                    						    <tr>
                    						        <td colspan="9" class="text-center"><h6>Order is not available</h6></td>
                    						    </tr>
                    						<?php }?>

                        				</tbody>

                        			</table>

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