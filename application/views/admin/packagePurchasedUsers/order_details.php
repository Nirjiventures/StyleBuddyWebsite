<?php







	$segment1 = $this->uri->segment(1);







	$segment2 = $this->uri->segment(2);







	$segment3 = $this->uri->segment(3);







	$segment4 = $this->uri->segment(4);







?>



<?php 



$url1 = $this->uri->segment(1);



$url2 = $this->uri->segment(2);



$url3 = $this->uri->segment(3);











?>

<?php 

     $rrr = getUserPermission();

     //echo $this->db->last_query();

     $permission = unserialize($rrr['permission']);

     //var_dump($permission);

?>

<main class="main-content">







    <section class="user-area">







      <div class="container-fluid">







          <div class="summery_order">







							<div class="row">







								<div class="col-sm-9">







									<h3 class="uk_title">Summary</h3>







								</div>







								<div class="col-sm-3 text-right">







									<p><a href="<?= base_url($segment1.'/'.$segment2) ?>" class="btn btn-success"><i class="fa fa-long-arrow-left" ></i> Back to List</a></p>







								</div>







							</div>







							<hr>







							<div class="">







								<?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>







									<div class="row">







										<div class="col-md-12">







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



												<?php if($order->productName){ ?>



													<tr>



														<td>Service Type : </td>



														<td><?= ucwords($order->productName);?></td>



													</tr>



												<?php } ?>



												<?php if($order->totalMrpPrice){ ?>

													<tr>

														<td>Service amount: </td>

														<td>

															<?php if($order->totalMrpPrice > $order->totalPrice){ ?>

																<span style="text-decoration-line: line-through;">&#8377; <?= number_format($order->totalMrpPrice) ?></span> 

															<?php } ?>

															<?php 

				           									$totalPrice = $order->totalPrice;

				           									echo '&#8377;'. number_format($totalPrice);

				       								?>



														</td>

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

															<td>Service Paid Price : </td>

															<td> 

																<?php 

			                    									$totalPrice = $order->totalPrice - $order->coupon_value;

			                    									echo '&#8377; '.number_format($totalPrice);

			                									?>

			                								</td>

														</tr>

													<?php } ?>

													 

												<?php } ?>

												<?php if($order->order_row){ ?>

													<?php if($order->order_row->coupon_code){ ?>

	                         <!--  <tr>

															<td>Gift card  : </td>

															<td><?=$order->order_row->coupon_code?></td>

														</tr> -->

													<?php } ?>

												<?php } ?>

												<tr>

														<td>Date Time: </td>

														<td><?= $order->created_at;?></td>

												</tr>

											</table>







											







										</div>







									</div>







											















									<input type="hidden" name="id" value="<?= $order->id ?>">







									<div class="row mt-5">







											<div class="col-sm-12">







												<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>















		            				<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>







		            			</div>





		            			<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>

										 	<div class="col-sm-6">







												<div class="form-group boot_sp">







													<input type="file" id="pic" title="Browse Image" name="image" accept="application/pdf" required class="form-control box_in3">







													<label class="form-control-placeholder2" for="Price">Upload styling report</label>







													<div id="pic_Err"></div>







												</div>







											</div>







											<div class="col-sm-6"></div>





											

												<div class="col-sm-6">







	 												<button type="submit" class="btn btn-primary">Submit</button>







	 											</div>

	 										<?php } ?>





									</div>







								<?php echo form_close();?>















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







	  </section>







</main>