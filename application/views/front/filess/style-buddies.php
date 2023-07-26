<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>YOUR STYLE BUDDIES</h3></div>
	</div>
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	
	<div class="container shop">
	
		<div class="col-sm-12 text-center mb-5"><h1>Your Style Buddies</h1></div>
	
		<div class="row mb-3">
			<div class="col-sm-9">
				Showing: 1-9  of 27 products
			</div>

		</div>
	
		<div class="row">
            
        <?php if(!empty($vender)) { foreach($vender as $stylist) { ?>    
			<div class="col-sm-4">
				<div class="buddy">
					<div class="view_dnd"><a href="<?= base_url('stylist-profile/').base64_encode($stylist->id) ?>">View Details</a></div>
					<a href="view-details.php"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= ($stylist->image)?"assets/vandor/images/$stylist->image":"assets/images/new/t2.webp" ?>" class="img-fluid"></a>
					<div class="stye_b_data">
						<div class="my_rating3">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="far fa-star"></i>
						</div>
						<h5><?= strtoupper($stylist->fname.' '.$stylist->lname) ?></h4>
						<p><?= ($stylist->location)?"<i class='fas fa-map-marker-alt'></i> Location: $stylist->location":'' ?> </p>
					</div>
				</div>
			</div>
			<?php }} ?>	
				<div class="col-sm-12">
					<div class="paginatii">
						<ul>
							<li><a href="#" class="black_c"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/back_black.png"></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#" class="sle_page">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#" class="black_c"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/next_black.png"></a></li>
						</ul>
					 </div>
				</div>
			
		</div>
	
	</div>
	
</div>
<?php $this->load->view('Page/template/footer'); ?>