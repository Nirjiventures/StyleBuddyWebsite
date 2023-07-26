<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>

<div class="main">
	<div class="container">

		 
		<div class="col-sm-12">
			<div class="rightbar">


				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>Consult Orders Detail</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/consultorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>
				 
					<?=$result;?>
				 
				
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('front/vandor/footer'); ?>
</body>
</html>
