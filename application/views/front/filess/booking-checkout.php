<?php $this->load->view('Page/template/header');  ?>
<?php header('Refresh:4; url= '. base_url().'');  ?>
<!--========Banner Area ========-->


<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container">
		
		<div class="row justify-content-center">
			
			<div class="col-sm-7">
				
				<div class="shipping_ads bg-white">
					<div class="text-center">
						<h4><i class="fa fa-check" aria-hidden="true"></i> Great You're Booked</h4>
						<p>A confirmation email is on its way to you</p>
					</div>
							
					<div class="row">
						<div class="col-sm-12">
							<div class="courses-container">
								<div class="course">
									<div class="course-preview">
										<h6><i class="fa fa-calendar" aria-hidden="true"></i></h6>
										<h2><?= date('F j, Y',strtotime($bookingData->date)) ?></h2>
										<p><i class="fa fa-clock-o" aria-hidden="true"></i><?= $bookingData->time ?></i></p>
									</div>
									<div class="course-info">
										<h6><?= $bookingData->service_name; ?></h6>
										<p><?= $bookingData->staff; ?></p>
										<p><?= $bookingData->meetingHour; ?> Hr | <?= $bookingData->price; ?></p>
										<p><?= ucwords($bookingData->address.' '.$bookingData->city) ?></p>
										<p><a href="<?= base_url('book-online'); ?>">Check out more services</a></p>
									</div>
								</div>
							</div>
						</div>
							
					</div>
				</div>
							
			</div>	
		
			
		</div>
		
		
	</div>
	
</div>
<?php $this->load->view('Page/template/footer');  ?>