<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Booking Online</h3></div>
	</div>
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container book_online">
	
		<div class="col-sm-12 text-center mb-5"><h2>Fashion Consulting Services</h2></div>
	
		<div class="row m-0">
		 
		 <?php if($datas) { foreach($datas as $data)  { ?>
		    
			<div class="col-sm-4">
				<div class="book-box">
					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$data->image ?>" class="img-fluid">
					<div class="book-text">
						<h4><a href="#"><?= $data->name ?></a></h4>
						<p class="desc_book"><?= $data->content ?></p>
						<span><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $data->time ?>hr</span> <span><?= $this->site->currency.' '.$data->price ?></span>
						<hr>
						<a href="<?= base_url('book-now/').$data->slug ?>" class="book_btn">Book Now</a>
					</div>
				</div>
			</div>
		<?php }} ?>	

		</div>
	
	</div>
	
</div>


<?php $this->load->view('Page/template/footer'); ?>