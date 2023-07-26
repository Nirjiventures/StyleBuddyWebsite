
<?php $this->load->view('front/template/header'); ?>

<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">

			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>

			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
					 
					 <h2>Applied Jobs</h2>
						<p></p>
						<hr>
						<div class="row m-0 pt-3">
							<div class="table-responsive manage_table">
								<table class="table table-bordered table-striped">
									<tr>
										<th>S.N.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
									<?php if ($job_apply) {  $num = $start_limit + 1 ;?>
										<?php foreach ($job_apply as $key => $value) { ?>
										<?php $vender = $value->vendor_row; ?>

											<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.$vender->city_name) ?>

											<tr>
												<td><?=  $num; ?></td>
												<td><?= $vender->fname; ?></td>
												<td><?= $vender->email; ?></td>
												<td><?= $value->created_at; ?></td>
												<td><a target="_blank" href="<?=$url;?>" class="btn btn-primary">View Profile</a></td>
											</tr>
										
										<?php } ?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">jobs not available.</td></tr>
									<?php  } ?>	
									
									
								</table>
								
							</div>
							
							
							
						</div>
						
					
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
