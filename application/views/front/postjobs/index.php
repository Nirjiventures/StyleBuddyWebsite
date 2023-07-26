<?php $this->load->view('front/template/header'); ?>

<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>

			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
						
						<div class="yellow_part">
							<p><b>Welcome to your Stylebuddy Dashboard, <?= $datas->fname.' '.$datas->lname ?></b></p>
							<p>The No. 1 Fashion styling job board for brands, Agencies, Contractors and Production Houses.</p>
							<img src="<?php echo base_url(); ?>assets/images/sdk-men.png">
						</div>



						<div class="data_tottl">

							<div class="col-sm-6">
								<div class="row m-0">
									
									<div class="col-sm-6 col-6">
										<a href="<?= base_url('postjob/managejobs') ?>" style="text-decoration: none;">
											<div class="total_itm">
												<h4><?=$num_rows?></h4>
												<p>Jobs Posted</p>
											</div>
										</a>
									</div>

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
