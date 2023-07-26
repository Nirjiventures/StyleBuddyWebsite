<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
					<div class="">
						<div class="row m-0 pt-3">
							<div class="col-sm-9">
								<h2>Manage Jobs</h2>
							</div>
							<div class="col-sm-3">
								<a href="<?=base_url('postjob/addjob');?>" class="text-end btn btn-primary" style="float: right;">Add Job</a> 
							</div>
						</div>
						<hr>
						<div class="col-sm-12">
					
							<?= $this->session->flashdata('success'); ?>
							<?= $this->session->flashdata('error'); ?>
						</div>
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
												<td><a href="<?= base_url('postjob/applyed/'.$value->id) ?>" class="btn btn-primary"><?= $value->total_applicant; ?></a></td>
												<td>
													<a href="<?= base_url('postjob/editjob/'.$value->id) ?>" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> 
													</a> 
													<a href="<?= base_url('postjob/deletejob/'.$value->id) ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </a>
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
</body>
</html>
