<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1">
					 <div class="">
						<h2>Manage Subscriptions</h2>
						<p></p>
						<hr>
						<div class="row m-0 pt-3">
							<div class="table-responsive manage_table">
								<table class="table table-bordered table-striped">
									<tr>
										<th>S.No</th>
										<th>Plan Type</th>
										<th>Price </th>
										<th>Duration </th>
										<th>Jobs Posted</th>
										<th>Jobs Left</th>
										<th>Purchase Date </th>
										<th>Validity </th>
									</tr>
									<?php if ($subscription_booking) {  $num =  1 ;?>
										<?php foreach ($subscription_booking as $key => $value) { ?>
											<tr>
												<td><?=  $num; ?></td>
												<td><?= $value->package; ?></td>
												<td><i class="fa fa-inr" aria-hidden="true"></i> <?= $value->total_price; ?></td>
												<td><span class="fashh">
													<?php 
														$now = strtotime($value->start_date);; // or your date as well
														$your_date = strtotime($value->end_date);
														$datediff = $your_date-$now ;

														echo round($datediff / (60 * 60 * 24));
													?> Days
													</span>
												</td>
												<td><?= $value->package_description; ?></td>
												<td><a class="btn btn-success" title=""> <i class="fa fa-calendar" aria-hidden="true"></i> 
												<?php 
														$now = time(); // or your date as well
														$your_date = strtotime($value->end_date);
														$datediff = $your_date-$now ;

														echo round($datediff / (60 * 60 * 24));
												?> Days Left</a></td>
												<td><?= date('d M Y',strtotime($value->created_at)); ?></td>
												<td><?= date('d M Y',strtotime($value->end_date)); ?></td>
											</tr>
											<?php $num++; ?>
										<?php } ?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">Subscription not available.</td></tr>
									<?php  } ?>	
									 
									
									
								</table>
								
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
