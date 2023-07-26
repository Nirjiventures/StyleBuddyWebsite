<?php $this->load->view('Page/template/header') ?>

<style type="text/css">
	.book-box{
		box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
	}
	.book-text {
	    background: var(--bg-white);
	    margin: auto;
	    padding: 15px;
	    width: 100%;
	    margin-top: 0px;
	    z-index: 9;
	    position: relative;
	}
	.book-text h4 {
	    height: auto;
	    font-size: 18px!important;
	}
	.book-box .book-text .desc_book {
	    height: auto;
	    overflow: hidden;
	    color: var(--black);
	}
	.book-box img{
		overflow: hidden;
		height: 245px;
	}
	.book-box:hover img {
	    transform: scale(1.2);
	    -webkit-transform: scale(1.1);
	    overflow: hidden;
	}
	.ab-banner_inner {
	    padding: 40px 0px;
	}
	.lt-bg {
	    background: #f1f1f1;
	    padding: 60px 0px;
	}
	.ss_section h2 {
	    text-transform: uppercase;
	}
	.h-line {
	    width: 75px;
	    height: 3.5px;
	    background: #f42cc2;
	    margin: auto;
	}
	.vi-listing ul {
	    margin: 0;
	    padding: 0;
	    margin-top: 20px;
	}
	.vi-listing ul li {
	    margin-bottom: 0px;
	    list-style-type: none;
	    position: relative;
	    padding: 10px 0 0 22px;
	    font-size: 16px;
	}
	.vi-listing ul i {
	    left: 0;
	    top: 14px;
	    position: absolute;
	    font-size: 14px;
	    color: #f42cc2;
	}
	.ss_section h2 {
    	text-transform: uppercase;
	}
	.cate_block img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .new_s p {
        font-size: 16px;
        padding: 0px 10px;
        color: #000;
        /* text-transform: uppercase; */
        font-weight: bold;
        line-height: 24px;
        padding-bottom: 5px;
        text-align: center;
    }
    .cate_block h4{
    	font-size: 20px;
    	text-align: center;
    }
    .cate_block h4 a{
    	color: #000;
    }
    .cate_block {
        /* background: var(--bg-light-skin); */
        /* text-align: center; */
        /* padding: 5px; */
        border-radius: 0px;
        box-shadow: 0px 0px 10px 4px rgb(0 0 0 / 28%);
        margin-bottom: 24px;
        border: 1px solid #f0f0f5;
        box-shadow: 0 4px 8px rgb(0 0 0 / 12%);
        /* border-radius: 24px; */
        box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
        margin-bottom: 40px;
        position: relative;
        height: 100%;
    }
    .cate_block:hover img {
        transform: scale(1.1);
    }
    .cate_block:after {
        content: '';
        position: absolute;
        width: 15%;
        height: 2px;
        background: #f62ac1;
        left: 40%;
        transition: all 0.5s;
        bottom: -2px;
    }
    .cate_block:hover:after {
        right: 0;
        width: 100%;
        left: 0;
    }
    @media(max-width: 768px){
    	.cate_block{margin-bottom:0px;}
    }
</style>
<!--========Banner Area ========-->

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



<?php $this->load->view('Page/template/footer') ?>

 <script type="text/javascript">
// 	$('#element').click(function(e){
//     e.preventDefault();
//     $('body, html').animate({
//         scrollTop: $this.offset().top - 300
//     }, 1000);
// });
// </script>