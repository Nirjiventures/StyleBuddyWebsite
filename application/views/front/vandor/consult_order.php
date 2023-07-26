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


				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>Consult Orders List</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a> 
							</div>

					</div>
					<hr>
				</div>
				<div class="container">

                	<div class="row">

                		<div class="col-md-12 mt-3">

                		    <div id="message" class="text-primary text-center"></div>

                			 
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
															<a href="<?= base_url('vendor/consultorderview/').$row->id ?>"><i class="fa fa-eye text-success fa-lg" aria-hidden="true"></i></a> &nbsp;&nbsp;
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
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>

</body>
</html>


<script>

    $(document).ready(function(){

        $('#example').DataTable();    

        $(document).on('click','.status_checks',function() {

            var id = (this.id);

            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

            var msg = (status=='0')? 'Activate':'Deactivate';

            var newstatus = (status=='0')? '1':'0';

            if(confirm("Are you sure to "+ msg)) {

                      $.ajax({

                      type:"POST",

                      url: "<?= base_url('admin/update_fashion_services_status'); ?>", 

                      data: {"status":newstatus, "id":id}, 

                      success: function(data) {

                      location.reload();

                      }         

                 });

            }

        });    

    });

</script>