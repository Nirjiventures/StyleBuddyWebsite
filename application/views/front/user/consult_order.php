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



				<h2>Orders</h2>



				



				<hr>



				



				

				<div class="table-responsive">

					<table class="table table-bordered table-hover shadow-lg" id="example">

						<thead class="text-white bg-primary">

							<tr>

								<th class=''>S. No.</th>

								<th class=''>Name </th>

								<th class=''>E-Mail ID</th>

								<th class=''>Phone</th>

								<th class=''>Package Name</th>

								<th class=''>Package Fees</th>

								<th class=''>Date</th>

								<th class=''>Action</th>					

							</tr>

						</thead>

						<tbody>

							<?php  if(!empty($list)) { ?>

									<?php $num=1; ?>

									<?php  foreach($list as $row) { ?>

										<tr style="<?=$style;?>">

											<td><?php echo $num; ?></td>						

											<td><?php echo ucwords($row->full_name); ?></td>

											<td><?php echo $row->email; ?></td>

											<td><?php echo $row->mobile; ?></td>

											<td><?php echo $row->package_name; ?></td>

											<td><?php echo $row->currency; ?> <?php echo $row->total_price; ?></td>

											<td><?php echo $row->created_at; ?></td>

											<td>

												<a href="<?= base_url('user/consultorderview/').$row->id ?>"><i class="fa fa-eye text-success fa-lg" aria-hidden="true"></i></a> &nbsp;&nbsp;

											</td>

										</tr>

								   	<?php $num++; ?>

							   	<?php } ?>

								<?php } else { ?>

							   	<tr><td colspan="8" class="text-center">Not Available</td></tr>

							<?php } ?>

						</tbody>

					</table>

				</div>

					



					



				</div>



			</div>



		</div>



	 

</div>



<?php $this->load->view('front/template/footer'); ?>