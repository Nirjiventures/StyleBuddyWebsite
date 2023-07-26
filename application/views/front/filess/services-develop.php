<?php $this->load->view('Page/template/header') ?>
<?php $url1 = $this->uri->segment(1);?>
<!--========Banner Area ========-->
<style type="text/css">
	.h-line {
	    width: 75px;
	    height: 3.5px;
	    background: #f42cc2;
	    margin: auto;
	}
	.ss_section h2{
		text-transform: uppercase;
	}
	.lt-bg {
	    background: #f1f1f1;
	    padding: 60px 0px;
	}
	.ab-banner_inner {
	    padding: 40px 0px;
	}
	.vi-listing ul {
	    margin: 0;
	    padding: 0;
	    margin-top: 10px;
	    margin-bottom: 20px!important;
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
	.book-box .book-text .desc_book{
		color: #000;
	}
	.book-text {
	    background: var(--bg-white);
	    margin: auto;
	    padding: 15px;
	    width: 100%;
	    margin-top: 0px;
	    z-index: 9;
	    position: relative;
	    color: #000;
	}
	.book-text h4 {
	    height: auto;
	    font-size: 18px!important;
	}

	.effect-05 {
    position: relative;
    margin-bottom: 30px;
    /*overflow: hidden;*/
}

.effect-05 * {
    transition: .3s;
}

.effect-05 .effect-img {
    font-size: 0;
    overflow: hidden;
}

.effect-05 .effect-img img {
    width: 100%;
    transition: .5s;
}

.effect-05:hover .effect-img img {
    transform: scale(1.2);
}

.effect-05 .effect-text {
    position: absolute;
    top: 15px;
    right: 15px;
    bottom: 15px;
    left: 15px;
    padding: 15px;
    text-align: center;
    background: rgba(0, 0, 0, .1);
    border: 15px solid rgba(255, 255, 255, .1);
    transition: .5s;
}

.effect-05 .effect-text h4 {
    position: relative;
    color: #ffffff;
    font-size: 20px!important;
    margin-bottom: 15px;
    top: calc(50% - 13px); 
    transition: .5s;
}
.effect-05 .effect-text h4 a{
	color: #fff!important;
	    text-shadow: 1px 2px 3px #000;
}
.effect-05 .effect-text p {
    position: relative;
    color: #ffffff;
    font-size: 14px;
    margin-bottom: 20px;
    transform: scale(0);
    opacity: 0;
    transition: .5s;
    transition-delay: .1s;
}


.effect-05 .effect-btn .btn {
    display: inline-block;
    height: 35px;
    padding: 7px 15px;
    color: #333333;
    background: #ffffff;
    transform: scale(0);
    opacity: 0;
    transition: .2s;
    transition-delay: .3s;
    background: var(--black);
    color: var(--yellow);
    margin-top: 10px;
    width: fit-content;
    padding: 5px 9px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 4px;
    font-size: 14px;
}

.effect-05:hover .effect-text {
    background: rgba(0, 0, 0, .5);
    border: 15px solid rgba(255, 255, 255, .5);
}

.effect-05:hover .effect-text h4 {
    top: 0;
}

.effect-05:hover .effect-text p {
    transform: scale(1);
    opacity: 1;
}

.effect-05:hover .effect-text .btn {
    transform: scale(1);
    opacity: 1;
}

</style>
<div class="ab-banner_inner">
		<div class="container text-center"><h1>OUR SERVICES</h1></div>
</div>

<!--========End Banner Area ========-->	


<div class="middle_part pt-0">
	<div class="lt-bg">
		<div class="container ss_section">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2>Styling Solutions for <br>Individuals, Models, and Businesses</h2>
					<p>We provide a comprehensive range of fashion, styling and grooming solutions for everyone.</p>
					<div class="h-line"></div>
				</div>
				<div class="col-sm-12 text-left mb-5 vi-listing">
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
	<div class="container book_online ss_section">
		
		
	
		<div class="row pt-5 justify-content-center" id="element">
			<div class="col-sm-12 text-center mb-5"><h2>Select from our Services</h2>
				<div class="h-line"></div>
			</div>
			
			<?php if($datas) { foreach ($datas as $list) { ?>
			<div class="col-md-6 col-lg-4">
				<div class="effect-05">
                        <div class="effect-img book-box">
                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$list->image ?>" class="img-fluid">
                        </div>
                        <div class="effect-text">
                            <h4><a href="<?= base_url($url1.'/').$list->slug ?>"><?= $list->title ?></a></h4>
                            <p class="desc_book"><?= $list->short_description ?></p>
                            <div class="effect-btn">
                                <a href="<?= base_url($url1.'/').$list->slug ?>" class="book_btn btn"><i class="fa fa-eye"></i> Read More</a>
                            </div>
                        </div>
                    </div>
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