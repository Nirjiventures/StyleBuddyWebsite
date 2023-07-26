<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">
	.switch-handle {
	    top: 1px;
	}
	.switch {
	    width: 90px;
	    padding: 0px;
	    height: 20px;
	}
	.switch-input:checked ~ .switch-handle {
	    left: 70px;
	}
</style>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="row m-0">
				<div class="col-sm-12">
					<div class="rightbar">
						<div class="row">
							<div class="col-sm-8"><h2>My Leads</h2></div>
							<div class="col-sm-4 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>
							<div class="col-sm-12">
								<?= $this->session->flashdata('success'); ?>
							    <?= $this->session->flashdata('error'); ?>
							</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class="table table-bordered odc text-wrap" id="example">
								<thead>
									<tr>
										<th class=''>S.No.</th>
										<th class=''>Name</th>
										<th class=''>Email</th>
										<th class=''>Phone</th>
										<th class=''>City</th>
										<th class=''>Date</th>
										<th class=''>Time</th>
										<th class=''>Status</th>
										<th class=''>Action</th>
									</tr>
								</thead>
								<tbody>
								 	<?php  if(!empty($list)) { ?>
											<?php $num=1; ?>
											<?php  foreach($list as $row) { ?>
												<?php 
													$style='';
													if($row->allocated_id){
														if($row->allocated_id == $row->stylist_id){
															$style='background:#89710c;color:#ffff;';
														}else{
															$style='background:#423f2e;color:#ffff;';
														}
													}
												?>
												<tr style="<?=$style;?>">
													<td class=''><?php echo $num; ?></td>						
													<td class=''><?php echo ucwords($row->fname).' '.ucwords($row->lname); ?></td>
													<td class=''><?php echo $row->email; ?></td>
													<td class=''><?php echo $row->mobile; ?></td>
													<td class=''><?php echo $row->city; ?></td>
													<td class=''><?php echo $row->availability_date; ?></td>
													<td class=''><?php echo $row->availability_start_time; ?> - <?php echo $row->availability_end_time; ?></td>
													<td>
														<label class="switch switch-green">
														  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $row->id ?>,<?= $row->status ?>)"  id="<?= $row->status ?>" <?= ($row->status == 1)?'checked':'' ?> >
														  <span class="switch-label" data-on="Completed" data-off="Pending"></span>
														  <span class="switch-handle"></span>
														</label>
													</td>
													<td>
														<a class="vd_c" href="<?=base_url('stylist-zone/lead-detail/'.base64_encode($row->id))?>">View Detail</a>
													</td>
												</tr>
										   	<?php $num++; ?>
									   	<?php } ?>
										<?php } else { ?>
									   	<tr><td colspan="4" class="text-center">Records Not Available</td></tr>
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
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
 
 
 
 
<script>
    $(document).ready(function(){
         $('#example').DataTable();
    });
    function blogStatus(id,status){
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('vendor/leads_status'); ?>", 
              data: {"status":newstatus, "id":id}, 
              success: function(data) {
                location.reload();
              }         
           });
       } else {
           location.reload();
       }
    }
</script>
</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>