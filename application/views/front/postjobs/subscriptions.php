<?php $this->load->view('front/template/header'); ?>

<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1">
					 	<h2>Subscriptions</h2>
						<p></p>
						<hr>
						<div class="row m-0 pt-3">
							<div class="col-sm-12 text-center">
								<h3>Package for job application to Subscription Packages.</h3>
							</div>
							<?php 
								$pqr = 0;
								foreach ($list as $key => $value) {   
									if ($subscription_booking && $subscription_booking->package_id == $value->id) {
										if ($subscription_booking->end_date > date('Y-m-d')) {
										 	if ($pqr == 0) {
										 		$pqr = 1;
										 	}
										} 
									}
								} 
							?>

							<?php foreach ($list as $key => $value) { ?>
								<?php 
								if ($subscription_booking && $subscription_booking->package_id == $value->id) {
									if ($subscription_booking->end_date > date('Y-m-d')) {
									 	$iii = ' Expire will be '.$subscription_booking->end_date;
									}else{
										$iii = ' Expired on '.$subscription_booking->end_date;
									} 
								}else{
									$iii = '';
								} 
								?>
								 
								<div class="col-sm-3">
									<div class="my_package">
										<div class="packname"><p><?=$value->package_name?></p>
											<div class="plan_name"><h4><i class="fa fa-inr" aria-hidden="true"></i> <?=$value->package_price?> <span> <?=$value->valid_days?> days</span></h4></div>
											<?php  if($iii){ echo '<p style="font-size: 14px;color: red;">'.$iii.'</p>';} ?>
										</div>
										<div class="pak_dis">
											<?=$value->package_description?>
										</div>
										<div class="by_pack">
											<form name="subscription<?=$value->id?>" id="subscription<?=$value->id?>" method="post">
												<input type="hidden" name="package_id" value="<?=$value->id?>">
												<input type="hidden" name="package_price" value="<?=$value->package_price?>">
												<?php if($value->package_price){ ?>
													<a style="cursor:pointer" onclick="submitForm('subscription<?=$value->id?>')">Subscribe Now</a>
												<?php }else{ ?>
													<?php if($pqr){ ?>
														<a style="cursor:pointer" disabled>Start Now</a>
													<?php }else{ ?>
														<a style="cursor:pointer" onclick="submitForm('subscription<?=$value->id?>')">Start Now</a>
													<?php } ?>
												<?php } ?>
											</form>
											
										</div>
									</div>
								</div>
								
							<?php }?>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function submitForm(id){
		document.getElementById(id).submit();
	}
</script>
</body>
</html>
