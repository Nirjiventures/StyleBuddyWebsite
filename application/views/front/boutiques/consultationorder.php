<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="rightbar">
				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h2>Orders</h2>
						</div>

						<div class="col-sm-3 text-end">
							<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('boutiques/managemyorders')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
				</div>
				<ul class="nav nav-tabs" id="myNavTabs">
				  <li><a href="#navtabs1" class="active" data-toggle="tab">All Orders</a></li>
				</ul>
				<div class="tab-content pt-5">
				    <div class="tab-pane fade show active" id="navtabs1">
    	  				<div class="table-responsive">
    	  				    <table id="example" class="table table-striped" style="width:100%">
            					<thead>
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
</div>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
	$('#myNavTabs a').click(function (evt) {
	  evt.preventDefault();
	  $(this).tab('show');
	});
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	  console.log(e.target);
	  console.log(e.relatedTarget);
	})
</script>
</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>