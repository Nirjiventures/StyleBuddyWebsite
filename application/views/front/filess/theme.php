<?php $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="container mt-3">
	<div class="banner_inner banner_inner3 th_banner">
		<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/book-img.jpg" class="img-fluid"> -->
		<div class="top_text">
			<div class="container">
				<div class="row">
					<h2 class="mb-3 mt-3">Stay Stylish, Stay Fashionable</h2>
					<p class="mb-4">We help you look good, feel good. Get expert tips from your style buddies who are experienced fashion stylists, personal stylists and personal shoppers. Try it today!</p>
					<a href="<?= base_url('services') ?>" class="th_btn">Fashion Help Desk</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container book_online">
		<div class="row">
		<div class="col-sm-12 text-left mb-3"><h2>We help you get styled, get fashionable</h2> <p>We bring you Celebrity Fashion Designers and Style Consultants for your personal styling and grooming.</p></div>
		</div>
		<div class="row">
			<div class="col-sm-12">
			    <?php if(!empty($datas)) { foreach($datas as $data) { ?>
			    
				<div class="q_list">
					<h4><?=  $data->icon ?> <?=  $data->question ?></h4>
					<p><?=  $data->answer ?></p>
				</div>
				<?php } } ?>
			</div>
			
		</div>
	
	</div>
	
</div>



<?php $this->load->view('Page/template/footer'); ?>