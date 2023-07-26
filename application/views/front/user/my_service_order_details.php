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

						<div class="col-sm-6">

							<h3>Order Summary</h3>

						</div>

						<div class="col-sm-6 text-end">

							<a href="<?=base_url('user/user-dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>

							&nbsp; - &nbsp; 

							<a href="<?=base_url('user/myserviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>

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

									<table>



										<tr>



											<td>Name : </td>



											<td><?= ucwords($order->user_row->fname.' '.$order->user_row->lname);?></td>



										</tr>



										<tr>



											<td>Email : </td>



											<td><?= ucwords($order->user_row->email);?></td>



										</tr>



										<?php if($order->user_row->mobile){ ?>



											<tr>



												<td>Mobile : </td>



												<td><?= ucwords($order->user_row->mobile);?></td>



											</tr>



										<?php } ?>

										<?php if($order->totalPrice){ ?>



											<tr>



												<td>Price : </td>



												<td>&#8377; <?= number_format($order->totalPrice) ?></td>



											</tr>



											 

											<?php if($order->coupon_id){  ?>

												<tr>
													<?php if($order->coupon_type == 'coupon'){  ?>
														<td>Coupon Code Discount (<?php echo $order->coupon_code; ?>): </td>
													<?php }else{  ?>
														<td>Gift Code Discount (<?php echo $order->coupon_code; ?>): </td>
													<?php }  ?>
													<td> 

														<?php echo '- '.'&#8377; '.$order->coupon_value; ?>

	                								</td>

												</tr>

												<tr>

													<td>Paid Price : </td>

													<td> 

														<?php 

	                    									$totalPrice = $order->totalPrice - $order->coupon_value;

	                    									echo '&#8377; '.number_format($totalPrice);

	                									?>

	                								</td>

												</tr>

											<?php } ?>

										 



										<?php } ?>





										

									</table>

									<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">

										<thead>



											<tr>



												<th class="no">No</th>



												<th class="action">Report Pdf</th>



												<th class="action">Action</th>



											</tr>

										</thead>

										<tbody>



											<?php $num = 1; if(!empty($order->package_report_pdf)) { foreach($order->package_report_pdf as $value) { ?>



												<?php $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);  ?>



												<tr>



												  <td><?= $num ?></td>



												  <td><a target="_blank" href="<?= base_url('assets/images/package_report/').$value->image ?>" class="btn btn-success">View Pdf</a></td>



												  <td class=''>



												   	<a class="btn" href="<?php echo base_url($segment1.'/'.$segment2.'/delete/').$value->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>



													</td>







												</tr>



											<?php $num++; }} else {?>



										    <tr>



										        <td colspan="9" class="text-center"><h6>Attachment is not available</h6></td>



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