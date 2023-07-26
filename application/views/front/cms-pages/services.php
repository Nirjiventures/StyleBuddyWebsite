<div class="ab-banner_inner mb-3">
		<div class="container text-center">
		    <h1>Services</h1>
    		<?php 
    			$this->breadcrumb = new Breadcrumbcomponent();
    			$this->breadcrumb->add('Home', '/');
    			$this->breadcrumb->add('Services', '/services');
    		?>
    	 
    		<?php echo $this->breadcrumb->output(); ?>
		</div>
</div>

<!--========End Banner Area ========-->	


<div class="middle_part pt-0 mt-5">
    
	<div class="lt-bg">
		<div class="container ss_section">
		    
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2>Styling Solutions for <br>Individuals, Models, and Businesses</h2>
					<p>We provide a comprehensive range of fashion, styling and grooming solutions for everyone.</p>
					<div class="h-line"></div>
				</div>
				<div class="col-sm-12 text-left vi-listing">
					<ul>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Photoshoot, styling and grooming services for fashion models</li>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Styling and grooming services for corporate professionals, working women and businesspersons</li>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Styling and grooming services for students, young adults, startup entrepreneurs</li>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Comprehensive styling and fashion packages for wedding events with customization for everyone at the wedding - bride, groom, relatives and friends</li>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Styling services and fashion designing services for photographers, media companies, Ad companies, modelling agencies and production houses</li>
						<li><i class="fa fa-angle-double-right" aria-hidden="true"></i> Employee Styling and personal grooming services for corporates</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container book_online">
	
		<div class="row pt-5 justify-content-center row-flex" id="element">
			<div class="col-sm-12 text-center mb-5 ss_section"><h2>Select from our Services</h2>
				<div class="h-line"></div>
			</div>
			
			<?php if($datas) { foreach ($datas as $list) { ?>
			<div class="col-md-6 col-lg-3">
				<div class="cate_block new_s">
						<a href="<?= base_url('services/').$list->slug ?>" class="book_btn">
						<div class="cat_photo">
							<?php  if (file_exists($image_path = FCPATH . 'assets/images/services/' . $list->image)) { ?>
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/'.$list->image) ?>"  class="img-fluid">
							<?php  } else { ?>
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
							<?php  } ?>
							
							<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$list->image ?>" class="img-fluid"> -->
						</div>
						<!-- <h4><a href="<?= base_url('services/').$list->slug ?>"><?= $list->title ?></a></h4> -->
						<!-- <p class="desc_book"><?= $list->short_description ?></p> -->
						<p class="desc_book"><?= $list->title ?></p>
						<!-- <a href="https://dndtestserver.com/stylebuddy2/dev/services-develop/photo-shoot-solutions" class="book_btn">Read More</a> -->
						</a>
				</div>
				<!-- <div class="book-box">
					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$list->image ?>" class="img-fluid">
					<div class="book-text">
						<h4><a href="<?= base_url('services/').$list->slug ?>"><?= $list->title ?></a></h4>
						<p class="desc_book"><?= $list->short_description ?></p>
						<a href="<?= base_url('services/').$list->slug ?>" class="book_btn">Read More</a>-->
						<!-- <a href="https://dndtestserver.com/stylebuddy2/dev/services-develop/photo-shoot-solutions" class="book_btn">Read More</a> -->
					<!-- </div> -->
				<!-- </div> -->
			</div>
			<?php } } ?>

		</div>
	
	</div>
	
</div>
 