<?php $this->load->view('Page/template/header'); ?>
<!--========Banner Area ========-->

<div class="container mt-3">
	<div class="banner_inner banner_inner3 th_banner">
		<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/book-img.jpg" class="img-fluid"> -->
		<div class="top_text">
			<div class="container">
				<div class="row text-center">
					<h2 class="mb-5 mt-5">Regional Personal Fashion Styling Services</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	<div class="container">
		<div class="row pt-3 location_box">
		    
		   <?php if($datas) { foreach($datas as $data) { ?> 
			<div class="col-sm-4">
				<div class="book-box">
					<a href="<?= base_url('personal-stylist/').$data->slug ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/').$data->image ; ?>" class="img-fluid"></a>
					<div class="book-text">
						<h4><a href="<?= base_url('personal-stylist/').$data->slug ?>"><?= $data->title ?></a></h4>
						<p class="desc_book">Check out our <?= $data->title ?></p>
					</div>
				</div>
			</div>
        <?php } } ?>
		</div>			
	</div>
	
</div>



<?php $this->load->view('Page/template/footer'); ?>