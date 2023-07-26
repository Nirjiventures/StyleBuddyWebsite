<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="row m-0">
				<div class="col-sm-12">
					<div class="rightbar">
						<div class="row">
							<div class="col-sm-8"><h2>Manage Jobs</h2></div>
							<div class="col-sm-4 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/addjob')?>" class="btn btn-success add_pro"><i class="fa fa-plus" aria-hidden="true"></i> Add Job</a>
							</div>
							<div class="col-sm-12">
								<?= $this->session->flashdata('success'); ?>
							    <?= $this->session->flashdata('error'); ?>
							</div>
						</div>
						<hr>

						<div class="row m-0 pt-3">
							<div class="table-responsive manage_table">
								<table class="table table-bordered table-striped">
									<tr>
										<th>S.N.</th>
										<th>Job Title</th>
										<th>Job Location</th>
										<th>City</th>
										<th>Company</th>
										<th>Applicant</th>
										<th>Action</th>
									</tr>
									<?php if ($jobs) {  $num = 1 ;?>
										<?php foreach ($jobs as $key => $value) { ?>
											<tr>
												<td><?=  $num; ?></td>
												<td><?= $value->job_title; ?></td>
												<td><?= $value->job_location; ?></td>
												<td><?= $value->city; ?></td>
												<td><?= $value->company; ?></td>
												<td><a href="<?= base_url('vendor/applyed/'.$value->id) ?>" class="btn btn-primary"><?= $value->total_applicant; ?></a></td>
												<td>
													<a href="<?= base_url('vendor/editjob/'.$value->id) ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> 
													</a> 
													<a href="<?= base_url('vendor/deletejob/'.$value->id) ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												</td>
											</tr>
										<?php $num++; ?>
										<?php } ?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">Jobs not available.</td></tr>
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
<?php $this->load->view('front/vandor/footer'); ?>