<?php $this->load->view('front/template/header'); ?>


<div class="container-fluid p-0">
	<div>

		<div class="row m-0 justify-content-end">



			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>




			<div class="col-sm-9">

				<div class="rightbar1 ">

					<h2>Orders</h2>

					

					<hr>

					

					
					<div class="table-responsive">
        				<table class="table table-border table-striped mt-3" id="example">
        					<thead class="text-white bg-primary">
        						<tr>
        							<th class=''>S. No.</th>
        							<th class=''>Name </th>
        							<th class=''>E-Mail ID</th>
        							<th class=''>Phone</th>
        							<th class=''>City</th>
        							<th class=''>Consultation Topic</th>
        							<th class=''>Consultation Fees</th>
        							<th class=''>Message</th>
        							<th class=''>Date</th>
        							<!--<th class=''>Action</th>-->					
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
        										<td><?php echo $row->city; ?></td>
        										<td><?php echo $row->area_expertise; ?></td>
        										<td><?php echo $row->currency; ?> <?php echo $row->total_price; ?></td>
        										<td><?php echo $row->message; ?></td>
        										<td><?php echo $row->created_at; ?></td>
        										<!--<td>
        										   	<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
        										</td>-->
        									</tr>
        							   	<?php $num++; ?>
        						   	<?php } ?>
        							<?php } else { ?>
        						   	<tr><td colspan="4" class="text-center">Result Not Available</td></tr>
        						<?php } ?>
        					</tbody>
        				</table>
			        </div>
					

					

				</div>

			</div>

		</div>

	</div>
</div>





</body>

</html>

