<?php  $this->load->view('Page/template/header'); ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap" rel="stylesheet">

<style>

	

	body{/*overflow: hidden;*/}

    .top_bar{background: #ffffff!important;}

    .banner_post {

	    width: 32%;

	    text-align: left;

	    bottom: 20%;

		}

    .banner_post h1{

    	font-weight: 900!important;

    	font-size: 68px!important;

    	text-transform: uppercase;

    	background: #7401CA;

		background: linear-gradient(to right, #7401CA 0%, #F62AC1 41%);

		-webkit-background-clip: text;

		-webkit-text-fill-color: transparent;

		margin-bottom: 0px;

    }



	.btn{

	  cursor: pointer;

	}





	.my_session {

	    background: #8a0dcb;

	    padding: 30px;

	    color: #fff;

	    width: 100%;

	    height: 100%;

	    z-index: 9;

	    position: relative;

	}

	.my_session a {

	    color: #FFF;

	}



	.login-sub {width: auto!important; color: #FFF!important;}







	.my_session p {

	    text-align: center;

	    color: #FFF;

	    font-size: 20px;

		 margin-bottom: 20px;

	}



	@media (max-width: 575px) {

	  .formwrap{

	    width: 100%

	  }

	}









    @media(max-width: 1400px){

    	.banner_post{

	    	width: 46%;

	    	text-align: left;

	    	bottom: 15%;

	    }

    }

    @media(max-width: 700px){

    	.banner_post h1{

    		font-weight: 900!important;

    		font-size: 36px!important;

    	}

    	body{overflow: scroll;}

    }



</style>



<div class="banner">

		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/banner-1.gif" class="img-fluid">

		<div class="banner_post">

			<h1>We help You Get Styled</h1>

			<p>The No. 1 destination for Fashion Styling </p> 

			<a href="<?=base_url('select-service')?>" class="book_now">Get Started <i class="fas fa-caret-right" aria-hidden="true"></i></a>

			

			<!-- <?php if ($this->session->userdata('userType')) { ?>

				<a href="<?= base_url('logout') ?>" title="Logout" class="book_now">LOGOUT<i class="fas fa-caret-right"></i></a>

		  	<?php }else{ ?>

		  		<a href="<?= base_url('login') ?>" title="Login" class="book_now">LOGIN<i class="fas fa-caret-right"></i></a>

		  	<?php } ?> -->



		  	<a  data-bs-toggle="modal" data-bs-target="#rakhi" class="book_now cta-open">Your Free Styling Session <i class="fas fa-caret-right" aria-hidden="true"></i></a>

		</div>

</div>

<style type="text/css">
	.bx-contain{
		padding: 60px 0px;
		border-top: 1px solid #ccc;
	}
	.bx-contain h2{
		margin-bottom: 8px;
		font-size: 32px!important;
		text-transform: capitalize;
		color: #7401CA;
	}
	.line-tag{
		margin-bottom: 30px;
	}
	.bx-slider{
		padding: 60px 0px;
		position: relative;
		padding-top: 100px;
	}
	/*.bx-slider:after{
		content: '';
		width: 100%;
		height: 160px;
		background-image: url('https://dndtestserver.com/stylebuddy2/beta-new/assets/images/download.svg')!important;
		left: 0;
		bottom: 0;
		z-index: 0;
		position: absolute;
	}*/
	.bx-slider .carousel-item img{
		background: none!important;
		height: auto!important;
		border-radius: 6px;
	}
	.carousel-item {
        transition: transform 1s ease-in-out;
    }
    .carousel-fade .active.carousel-item-start,
    .carousel-fade .active.carousel-item-end {
        transition: opacity 0s 1s;
    }
    figure.snip1212 {
  font-family: 'Raleway', Arial, sans-serif;
  color: #fff;
  position: relative;
  overflow: hidden;
  margin: 10px;
/*  min-width: 220px;
  max-width: 310px;*/
  max-height: 280px;
  width: 100%;
  color: #000000;
  background-image: -webkit-linear-gradient(top, #ffffff 0%, #000000 70%);
  background-image: linear-gradient(to bottom, #ffffff 0%, #000000 70%);
}

figure.snip1212 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.35s ease;
  transition: all 0.35s ease;
}

figure.snip1212 img {
  max-width: 100%;
  width: 100%;
}

figure.snip1212 figcaption {
  position: absolute;
  bottom: 0%;
  left: 0;
  width: 100%;
  z-index: 1;
  -webkit-transform: translateY(100%);
  transform: translateY(100%);
}

figure.snip1212 h2,
figure.snip1212 p {
  margin: 0;
  width: 100%;
  padding: 10px 15px;
}

figure.snip1212 h2 {
    color: #000000;
    position: absolute;
    bottom: 100%;
    display: inline-block;
    font-weight: 400;
    text-transform: capitalize;
    font-size: 15px!important;
    background: rgba(255, 255, 255, 0.9);
}

figure.snip1212 p {
  background: rgba(255, 255, 255, 0.9);
  text-align: left;
  bottom: 0;
  font-size: 0.8em;
  font-weight: 500;
  padding-top: 0px;
}

figure.snip1212 a {
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  position: absolute;
  z-index: 1;
}

figure.snip1212:hover img,
figure.snip1212.hover img {
  opacity: 0.4;
}

figure.snip1212:hover figcaption,
figure.snip1212.hover figcaption {
  -webkit-transform: translateY(-10px);
  transform: translateY(-10px);
}
figure.snip1212:hover h2{
	background: #7401CA;
	color: #fff;
}
.sr-box{
	text-align: right;
	padding: 20px;
}
.sr-box1{
	text-align: left!important;
}
.sr-box h3{
	text-transform: uppercase;
	text-transform: uppercase;
    font-size: 20px!important;
    letter-spacing: 1px;
    position: relative;
}
.sr-box h3:before{
	content: '';
	position: absolute;
	bottom: -15px;
	right: 0;
	height: 2px;
	width: 60px;
	background: #ccc;
}
.sr-box1 h3:before{
	left: 0!important;
}
.sr-box a{
	    color: #7401CA;
    display: block;
    margin-top: 30px;
}
.sr-img{
	position: relative;
}
.sr-img:before{
	content: '';
	position: absolute;
	width: 25px;
	height: 2px;
	top: 30px;
	left: -12px;
	background: #f62ac1;
}
.sr-img:after{
	content: '';
	position: absolute;
	width: 25px;
	height: 2px;
	top: 35px;
	left: -12px;
	background: #f62ac1;
}
.sr-img1{
	position: relative;
}
.sr-img1:before{
	content: '';
	position: absolute;
	width: 25px;
	height: 2px;
	top: 30px;
	right: -12px;
	background: #f62ac1;
}
.sr-img1:after{
	content: '';
	position: absolute;
	width: 25px;
	height: 2px;
	top: 35px;
	right: -12px;
	background: #f62ac1;
}
.ot-btn{
	display: inline-block;
    padding: 9px 20px;
    background-color: #742ea0;
    font-size: 14px;
    line-height: 22px;
    font-weight: 500;
    text-transform: capitalize;
    color: #FFF!important;
    transition: 0.4s all ease-in-out;
    margin-top: 10px;
    transition: all 0.5s;
    position: relative;
    z-index: 9;
    width: fit-content;
    margin: auto;
    margin-top: 30px;
}
.ot-btn:before{
		content: '';
		width: 0%;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		background: none;
		transition: all 0.5s;
		z-index: -1;
	}
	.ot-btn:hover:before{
		width: 100%;
		background:#f62ac1;
	}
</style>

<section class="bx-contain">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Book a Fashion styling Session</h2>
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/heading-line.webp" class="line-tag">
			</div>
		</div>
	</div>

	<div class="container_full_2">
		<div class="row m-0 row-flex">
			<div class="col-6 col-sm-6 mb-4">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<div class="sr-box">
							<h3>Styling &amp; Wedding Shopping</h3>
							<a href="https://dndtestserver.com/stylebuddy2/beta-new/select-service/styling-for-weddings">Read More</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="sr-img">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/stylist/image1661250555.jpg" alt="sample74" class="img-fluid" />
						</div>
					</div>
				</div>
			</div>

			<div class="col-6 col-sm-6 mb-4">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<div class="sr-img1">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/stylist/image1661427358.jpg" alt="sample74" class="img-fluid" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="sr-box sr-box1">
							<h3>Photoshoot Styling</h3>
							<a href="https://dndtestserver.com/stylebuddy2/beta-new/select-service/styling-for-photo-shoots">Read More</a>
						</div>
					</div>
				</div>
			</div>


			<div class="col-6 col-sm-6">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<div class="sr-box">
							<h3>Office &amp; Work Styling</h3>
							<a href="https://dndtestserver.com/stylebuddy2/beta-new/select-service/corporate-style">Read More</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="sr-img">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/stylist/image1661250579.jpg" alt="sample74" class="img-fluid" />
						</div>
					</div>
				</div>
			</div>

			<div class="col-6 col-sm-6">
				<div class="row align-items-center">
					<div class="col-sm-6">
						<div class="sr-img1">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/stylist/image1661250591.jpg" alt="sample74" class="img-fluid" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="sr-box sr-box1">
							<h3>Event Styling</h3>
							<a href="https://dndtestserver.com/stylebuddy2/beta-new/select-service/personal-styling">Read More</a>
						</div>
					</div>
					
				</div>
			</div>

			
			<div class="col-sm-12 text-center">
				<a href="" class="ot-btn">View More Services</a>
			</div>



	    </div>
	</div>	
</section>

<style type="text/css">
	.head-bx{
		background: url('https://dndtestserver.com/stylebuddy2/beta-new/assets/images/new-bg.webp');
		background-size: cover;
		padding: 60px 0px;
		position: relative;
		color: #fff;
	}
	.head-bx:before {
	    content: "";
	    width: 100%;
	    height: 100%;
	    background-color: #000;
	    opacity: .5;
	    position: absolute;
	    inset: 0 0 0 0;
	}
	.head-bx .container{
    	padding: 30px 0px;
	}
	.head-bx h2{
		margin-bottom: 20px;
	}
	.head-bx h2 span{
		background:#7401CA;
		padding: 0px 10px;
	}
	.head-bx h2, .head-bx p{
		opacity: 1;
    	position: relative;
	}
	.head-bx p{
		font-size: 20px;
	}
	.head-bx h2{
		font-size:32px!important;
		text-transform: capitalize;
	}
	.slide-btn{
		    display: inline-block;
		    padding: 9px 20px;
		    background-color: #742ea0;
		    font-size: 14px;
		    line-height: 22px;
		    font-weight: 500;
		    text-transform: capitalize;
		    color: #FFF!important;
		    transition: 0.4s all ease-in-out;
		    margin-top: 10px;
		    transition: all 0.5s;
		    position: relative;
		    z-index: 9;
	}
	.slide-btn:before{
		content: '';
		width: 0%;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		background: none;
		transition: all 0.5s;
		z-index: -1;
	}
	.slide-btn:hover:before{
		width: 100%;
		background:#f62ac1;
		color: #fff;
	}
	.bx-slider{
		position: relative;
	}
	.bx-slider h2{
		line-height: 40px;
		text-transform: capitalize;
		font-size: 32px!important;
	}
	.bx-slider .carousel-indicators [data-bs-target]{
		background-color: #000!important;
	}
	.bx-slider .img-dot{
		position: absolute;
	    right: -42px;
	    top: -35px;
	    width: 100px;
	}
	.box-sd{
		margin: 20px;
	}
	.box-sd{
		position: relative;
	    text-align: right;
	    background: #fff;
	    padding: 15px;
	    box-shadow: -1px 1px 7px -2px #ccc;
	    margin-right: -90px;
	    border-radius: 7px;
	}
</style>

<section class="">
	<div class="container head-bx">
		<div class="row justify-content-center text-center">
			<div class="col-sm-12">
				<h2>We have the right stylists for <span>your styling needs</span></h2>
			</div>
			<div class="col-sm-5">
				<p>Fully verified & vetted styling experts to guide you about best styling</p>
			</div>
		</div>
	</div>
</section>

<section class="bx-slider">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-10">
				
				<div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
					<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/dot-img.png" class="img-dot">
					<div class="carousel-inner">
						<div class="carousel-item active" data-bs-interval="1000">
					      	<div class="row align-items-center">
						    	<div class="col-sm-6">
						    		<div class="box-sd">
						    			<h2>1:1 guidance to help you create long term styling habits</h2>
						    			<a href="" class="slide-btn">Get Free Styling Session</a>
						    		</div>
						    	</div>
						    	<div class="col-sm-6">
						    		 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/bx1.webp" class="d-block w-100" alt="...">
						    	</div>
					    	</div>
						</div>
						<div class="carousel-item " data-bs-interval="1000">
						    <div class="row align-items-center">
						    	<div class="col-sm-6">
						    		<div class="box-sd">
						    			<h2>Whether you are a beginner or pro, our stylists can help you?</h2>
						    			<a href="" class="slide-btn">Get Free Styling Session</a>
						    		</div>
						    	</div>
						    	<div class="col-sm-6">
						    		 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/bx2.webp" class="d-block w-100" alt="...">
						    	</div>
						    </div>
						</div>
						<div class="carousel-item " data-bs-interval="1000">
						    <div class="row align-items-center">
						    	<div class="col-sm-6">
						    		<div class="box-sd">
						    			<h2>Prefer virtual styling? Get a online styling from our stylists</h2>
						    			<a href="" class="slide-btn">Get Free Styling Session</a>
						    		</div>
						    	</div>
						    	<div class="col-sm-6">
						    		 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"   src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/bx3.webp" class="d-block w-100" alt="...">
						    	</div>
						    </div>
						</div>

						<div class="carousel-item " data-bs-interval="1000">
						    <div class="row align-items-center">
						    	<div class="col-sm-6">
						    		<div class="box-sd">
						    			<h2>Get a Custom Detailed styling report suitable for you</h2>
						    			<a href="" class="slide-btn">Get Free Styling Session</a>
						    		</div>
						    	</div>
						    	<div class="col-sm-6">
						    		 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"   src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/bx-4.webp" class="d-block w-100" alt="...">
						    	</div>
						    </div>
						</div>
					</div>
					  <div class="carousel-indicators">
					<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"></button>
    				<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"></button>
    				<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2"></button>
    				<button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3"></button>
    			</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style type="text/css">
	.trd-bx {
		padding: 60px 0px;
	    background: rgb(223,187,254);
	    background: linear-gradient(180deg, rgb(255 255 255) 48%, rgb(116 1 202) 48%);
	    padding-bottom: 0px;
	    color: #fff;
	}
	.trd-bx h2{
		margin-bottom: 12px;
		font-size: 32px!important;
	    text-transform: capitalize;
	    color: #7401CA;
	}
	.trd-bx h3{
		margin-bottom: 0px;
		position: relative;
	}
	.trd-bx small{
		margin-bottom: 10px;
		display: block;
	}
	.trd-bx h3 a{
		color: #fff;
		text-transform: uppercase;
	}
	.trd-bx p{
		font-size: 16px;
	}
	.trd-bx .td-btn{
	    display: inline-block;
	    padding: 9px 20px;
	    background-color: #f62ac1;
	    font-size: 14px;
	    line-height: 22px;
	    font-weight: 500;
	    text-transform: capitalize;
	    color: #FFF;
	    transition: 0.4s all ease-in-out;
	    margin-top: 10px;
	    transition: all 0.5s;
	    position: relative;
	    z-index: 9;
	    margin-bottom: 20px;
	}
	.trd-bx .td-btn:before {
	    content: '';
	    width: 0%;
	    position: absolute;
	    top: 0;
	    left: 0;
	    height: 100%;
	    background: none;
	    transition: all 0.5s;
	    z-index: -1;
	}
	.trd-bx .td-btn:hover:before {
	    width: 100%;
	    background: #742ea0 ;
	}
	.trd-bx ul{
		margin: 0;
		padding: 0;
	}
	.trd-bx ul li{
		text-decoration: none;
		font-size: 14px;
		line-height: 27px;
		list-style-type: none;
	}
	button.slick-arrow img {
	    filter: brightness(0) invert(1);
	}
	.trd-bx .table{
		color: #fff;
	}
	.trd-bx .table tr td{
		padding-left: 0px;
	}
</style>
<section class="trd-bx">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Trending Stylists</h2>
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/heading-line.webp" class="line-tag">
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="customer-logos2 slider">
			<div class="col-md-6 col-6">
				<div class="row align-items-end">
					<div class="col-sm-6">
						<h3 class="team-title">
	                        <a href="#">Chintan</a>
	                    </h3>
	                    <small>Celebrity Stylist and Designer</small>
	                    <table class="table">
	                    	<tr>
	                    		<td><i class="fa fa-map-marker" aria-hidden="true"></i> Location</td>
	                    		<td>Mumbai</td>	
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-calendar" aria-hidden="true"></i> Experience</td>
	                    		<td>4 Years</td>
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-check-circle" aria-hidden="true"></i> Projects</td>
	                    		<td>64</td>
	                    	</tr>
	                    </table>
	                    <!-- <ul>
	                    	<li><i class="fa fa-map-marker" aria-hidden="true"></i> Location: Mumbai</li>
	                    	<li><i class="fa fa-calendar" aria-hidden="true"></i> Experience: 4 Years</li>
	                    	<li><i class="fa fa-check-circle" aria-hidden="true"></i> Projects Delivered: 64</li>
	                    </ul> -->
                        <!-- <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                        <a href="#" class="td-btn">View Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
					<div class="col-sm-6">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/tm-1.png" class="img-fluid">
					</div>
				</div>
			</div>

			<div class="col-md-6 col-6">
				<div class="row align-items-end">
					<div class="col-sm-6">
						<h3 class="team-title">
	                        <a href="#">Jyoti</a>
	                    </h3>
	                    <small>Celebrity Stylist and Designer</small>
	                    <table class="table">
	                    	<tr>
	                    		<td><i class="fa fa-map-marker" aria-hidden="true"></i> Location</td>
	                    		<td>Delhi</td>	
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-calendar" aria-hidden="true"></i> Experience</td>
	                    		<td>10 Years</td>
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-check-circle" aria-hidden="true"></i> Projects</td>
	                    		<td>32</td>
	                    	</tr>
	                    </table>
                        <!-- <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                        <a href="#" class="td-btn">View Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
					<div class="col-sm-6">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/tm-2.png" class="img-fluid">
					</div>
				</div>
			</div>

			<div class="col-md-4 col-6">
				<div class="row align-items-end">
					<div class="col-sm-6">
						<h3 class="team-title">
	                        <a href="#">Khushi</a>
	                    </h3>
	                    <small>Celebrity Stylist and Designer</small>
	                    <table class="table">
	                    	<tr>
	                    		<td><i class="fa fa-map-marker" aria-hidden="true"></i> Location</td>
	                    		<td>Nagpur</td>	
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-calendar" aria-hidden="true"></i> Experience</td>
	                    		<td>6 Years</td>
	                    	</tr>
	                    	<tr>
	                    		<td><i class="fa fa-check-circle" aria-hidden="true"></i> Projects</td>
	                    		<td>34</td>
	                    	</tr>
	                    </table>
                        <a href="#" class="td-btn">View Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
					<div class="col-sm-6">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/tm-3.png" class="img-fluid">
					</div>
				</div>
			</div>

			</div>
		</div>
	</div>
</section>
<style type="text/css">
	.db-box{
		padding: 60px 0px;
		/*background:#191919;
		color: #fff;*/
	}
	.db-box h2{
		font-size: 32px!important;
	}
	.db-box a{
		display: inline-block;
	    padding: 9px 20px;
	    background-color: #742ea0;
	    font-size: 14px;
	    line-height: 22px;
	    font-weight: 500;
	    text-transform: capitalize;
	    color: #FFF;
	    transition: 0.4s all ease-in-out;
	    margin-top: 10px;
	    transition: all 0.5s;
	    position: relative;
	    z-index: 9;
	}
	.db-box a:before{
		content: '';
		width: 0%;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		background: none;
		transition: all 0.5s;
		z-index: -1;
	}
	.db-box a:hover:before{
		width: 100%;
		background:#f62ac1;
	}
	
</style>
<section class="db-box">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-sm-5">
				<h2>Are you a Production House, Agency or a Brand looking for stylists?</h2>
				<p>You can hire experienced stylists from stylebuddy on project basis. </p>
				<a href="">Hire Stylists</a>
			</div>
			<div class="col-sm-4">
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/hire.png" class="img-fluid">
			</div>
		</div>
	</div>
</section> 
<div class="bt-db-box"></div>

<style type="text/css">
	.hm-abt{
		background: #FEF8F5;
		padding: 60px 0px;
		position: relative;
	}
	.hm-abt h2{
		margin-bottom: 16px;
		font-size: 32px!important;
	}
	.hm-abt p {
	    font-size: 17px;
	    line-height: 30px;
	    font-weight: 600;
	}
	.img_absolute {
	    position: absolute;
	    bottom: 0;
	    right: 0;
	    width: fit-content;
	}
	.das-line{
		height: 2px;
		width: 70px;
		background:#f62ac1;
		margin-bottom: 15px;
	}
	.abx_bx{
		position: relative;
	}
	.rt-img{
		animation: spin 15s infinite linear;
		    animation: spin 15s infinite linear;
   	 position: absolute;
    width: 90px;
    top: -30px;
    left: -82px;
	}

	@-moz-keyframes spin { 
    100% { -moz-transform: rotate(360deg); } 
		}
		@-webkit-keyframes spin { 
		    100% { -webkit-transform: rotate(360deg); } 
		}
		@keyframes spin { 
		    100% { 
		        -webkit-transform: rotate(360deg); 
		        transform:rotate(360deg); 
		    } 
		}
</style>
<section class="hm-abt">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-sm-6 text-center">
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/login-img.webp" class="img-fluid">
			</div>
			<div class="col-sm-6">
				<h2>About Us</h2>
				<div class="das-line"></div>
				<p>We founded StyleBuddy to help women, men, students, homemakers, businesspersons, and every individual feel good about themselves, empower them, and be the best version of themselves through style. We are on a mission to style millions of people around the world. </p>
				<p>We are empowering Fashion stylists from every corner of India & the world to showcase their styling ability & help businesses & individuals who seek fashion styling support.</p>
			</div>
		</div>
	</div>
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/st-le.webp" class="img_absolute">
</section>

<style type="text/css">
	.hm-blog{
		padding: 60px 0px;
	}
	.hm-blog h2{
		    margin-bottom: 10px;
    font-size: 32px!important;
    text-transform: capitalize;
    color: #7401CA;
	}
	.box-blog{
		position: relative;
		margin-top: 30px;
		overflow: hidden;
	}
	.box-blog .blog-date {
	    position: absolute;
	    top: 20px;
	    left: 0;
	    background-color: #FFF;
	    color: #000;
	    transform-origin: top left;
	    transform: rotate(-90deg) translateX(-100%);
	    padding: 7px 14px;
	    line-height: 1;
	    text-transform: uppercase;
    	letter-spacing: 1px;
	}
	.box-blog h4{
		font-size: 20px!important;
	    color: #000;
	    line-height: 32px;
	    font-weight: 400;
	    text-transform: capitalize;
	    overflow: hidden;
	    position: relative;
	    margin-top: 18px;
	    padding-bottom: 10px;
	}
	.box-blog p{
		color: #333;
	}
	.box-blog h4::before {
	    content: "";
	    width: 80px;
	    height: 1px;
	    background-color: #f62ac1;
	    position: absolute;
	    left: 0;
	    bottom: 0;
	}
	.box-blog img{
		height: 300px;
		width: 100%;
		object-fit: cover;
		overflow: hidden;
		transition: all 0.4s;
		transform: scale(1.0);
	}
	.box-blog a.blg-btn{
		display: inline-block;
	    padding: 9px 20px;
	    background-color: #742ea0;
	    font-size: 14px;
	    line-height: 22px;
	    font-weight: 500;
	    text-transform: capitalize;
	    color: #FFF;
	    transition: 0.4s all ease-in-out;
	    margin-top: 10px;
	    transition: all 0.5s;
	    position: relative;
	    z-index: 9;
	}

	.box-blog:hover img{
		transform: scale(1.06);
	}
	/*.box-blog:hover a.blg-btn{
		background: #f62ac1;
	}*/
	.box-blog a.blg-btn:before{
		content: '';
		width: 0%;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		background: none;
		transition: all 0.5s;
		z-index: -1;
	}
	.box-blog:hover a.blg-btn:before{
		width: 100%;
		background:#f62ac1;
	}
</style>
<section class="hm-blog">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Our Blogs</h2>
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/heading-line.webp" class="line-tag">
			</div>
		</div>
	</div>	
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="box-blog">
					<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/how-can-a-personal-stylist-help-in-grooming">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/story/HOW_CAN_A_PERSONAL_STYLIST_HELP_IN.jpg" class="img-fluid">
						<div class="blog-date">
							<span class="created">
							<time class="date" datetime=" 2022">
							<span class="b-daycount">
							9
							</span>
							<span class="b-month">
							Sep

							</span>
							<span class="b-year">
							2022

							</span>
							</time>
							</span>
							</div>
						<h4> How can a personal stylist help</h4>
						<p>Everyone wants to Look Good, Feel Good</p>
						<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/how-can-a-personal-stylist-help-in-grooming" class="blg-btn">Read More</a>
					</a>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-blog">
					<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/fashion-trends">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/story/fashion-trands.jpg" class="img-fluid">
						<div class="blog-date">
							<span class="created">
							<time class="date" datetime=" 2022">
							<span class="b-daycount">
							10
							</span>
							<span class="b-month">
							Sep

							</span>
							<span class="b-year">
							2022

							</span>
							</time>
							</span>
							</div>
						<h4> Fashion Trends </h4>
						<p>Fashion is anything that helps to look</p>
						<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/fashion-trends" class="blg-btn">Read More</a>
					</a>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-blog">
					<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/trending-styles">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://dndtestserver.com/stylebuddy2/beta-new/assets/images/story/tranding-style.jpg" class="img-fluid">
						<div class="blog-date">
							<span class="created">
							<time class="date" datetime=" 2022">
							<span class="b-daycount">
							17
							</span>
							<span class="b-month">
							Sep

							</span>
							<span class="b-year">
							2022

							</span>
							</time>
							</span>
							</div>
						<h4> Trending Styles </h4>
						<p>Concepts of fashion and Trending Styles change</p>
						<a href="https://dndtestserver.com/stylebuddy2/beta-new/style-stories/trending-styles" class="blg-btn">Read More</a>
					</a>
				</div>
			</div>
		</div>
	</div>	
</section>

<style type="text/css">
	.top-footer {
		  width:100%;
		  height: 100px;
		  background-color: white;
		  position: relative;
		}
		.top-footer:after {
		     content: ' ';
		    border-bottom: 100px solid #000;
		    border-left: 98.75vw solid transparent;
		    width: 0;
		    position: absolute;
		}
	.footer {
    position: relative;
    padding-top: 0px;
    background: #000;
}
.footer-contact p{
	    text-indent: -15px;
    margin-left: 34px;
}
.footer .newsletter {
    position: relative;
    max-width: 900px;
    margin: 0 auto 45px auto;
    padding: 30px 15px;
    background: #000000;
    text-align: center;
    padding-top: 10px;
}

.footer .newsletter h2 {
    color: #dddddd;
    font-size: 35px;
    font-weight: 600;
    margin-bottom: 20px;
}

.footer .newsletter .form {
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

.footer .newsletter input {
    height: 50px;
    border: 2px solid #cdcdcd;
    border-radius: 0;
}

.footer .newsletter .btn {
    position: absolute;
    top: -5px;
    right: 0px;
    height: 40px;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    color: #fff!important;
    background: #7401CA;
    border-radius: 0;
    border: 2px solid #7401CA;
    transition: .3s;
}

.footer .newsletter .btn:hover {
    color: #ffffff;
    background: #7401CA;
}

.footer .newsletter .btn:focus {
    box-shadow: none;
}

.footer .footer-about,
.footer .footer-link,
.footer .footer-contact {
    position: relative;
    margin-bottom: 45px;
    color: #dddddd;
}

.footer .footer-about h3,
.footer .footer-link h3,
.footer .footer-contact h3{
    position: relative;
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 1px;
    color: #ffffff;
    font-weight: 100!important;
    text-transform: uppercase;
    font-size: 22px!important;
}
.footer-about p{
	font-size: 14px;
}
.footer .footer-link a {
    display: block;
    margin-bottom: 10px;
    color: #dddddd;
    transition: .3s;
    text-transform: capitalize;
}

.footer .footer-link a::before {
    position: relative;
    content: "\f105";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    margin-right: 10px;
}

.footer .footer-link a:hover {
    color: #f62ac1;
    letter-spacing: 1px;
}

.footer .footer-contact p i {
    width: 10px;
    color: #f62ac1;
}

.footer .footer-social {
    position: relative;
    margin-top: 20px;
}

.footer .footer-social a {
    display: inline-block;
}

.footer .footer-social a i {
    margin-right: 15px;
    font-size: 18px;
    color: #fff;
}

.footer .footer-social a:last-child i {
    margin: 0;
}

.footer .footer-social a:hover i {
    color: #dddddd;
}

.footer .footer-menu .f-menu {
    position: relative;
    padding: 10px 0;
    font-size: 0;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, .1);
    /*border-bottom: 1px solid rgba(255, 255, 255, .1);*/
    margin-bottom: 10px;
}

.footer .footer-menu .f-menu a {
    color: #dddddd;
    font-size: 14px;
    margin-right: 15px;
    padding-right: 15px;
    border-right: 1px solid rgba(255, 255, 255, .3);
}

.footer .footer-menu .f-menu a:hover {
    color: #f62ac1;
}

.footer .footer-menu .f-menu a:last-child {
    margin-right: 0;
    padding-right: 0;
    border-right: none;
}

.footer .copyright {
       padding: 20px 15px;
    font-size: 14px;
    border-top: 1px solid rgba(255, 255, 255, .1);
}

.footer .copyright p {
    margin: 0;
    color: #dddddd;
}

.footer .copyright .col-md-6:last-child p {
    text-align: right;
}

.footer .copyright p a {
    color: #fff;
    font-weight: 500;
    letter-spacing: 1px;
}

.footer .copyright p a:hover {
    color: #ffffff;
}
.bt-tp-footer{
	background: #191919;
	padding: 20px 0px;
}
.bt-tp-footer .footer-link{
	margin-bottom: 20px;
}
.bt-tp-footer .footer-link a{
	font-size: 12px;
	display: inline-block;
	margin-right: 9px;
}
.bt-tp-footer .footer-link a:hover{
	letter-spacing: 0px;
}
@media (max-width: 768px) {
    .footer .copyright p,
    .footer .copyright .col-md-6:last-child p {
        margin: 5px 0;
        text-align: center;
    }
}
</style>



<?php $this->load->view('Page/template/footer'); ?>



<style>

	

	body{background: #ffffff!important; /*overflow: hidden;*/}

    .top_bar{background: #ffffff!important;}



    .loc{background: #000;}

    .loc:hover{color: #ffffff;}

</style>

<style>

	.rakhi_popup {

	    

	}

	.fm_details p {

	    font-size: 23px;

	    line-height: 29px;

	    font-weight: bold;

	}

	.box_pop {

	    width: 100%;

	    height: 40px;

	    margin-bottom: 20px;

	    border: 2px solid #c809e0;

	    border-radius: 4px;

	    padding: 5px;

	}

	.sub_bt {

	    width: 100%;

	    height: 40px;

	    text-transform: uppercase;

	    font-weight: bold;

	    letter-spacing: 1px;

	    border-radius: 4px;

	    background: #000;

	    color: var(--yellow);

	}

	button.btn-close {

	    position: absolute;

	    right: -9px;

	    top: -13px;

	    font-size: 18px;

	    z-index: 99;

	}



	#rakhi .modal-body {

	    padding: 0px;

	}



	#rakhi .modal-content {

	    background: transparent;

	}



		

	#rakhi .form-control {

	    width: 100%;

	    height: 38px;

	    border-radius: 4px;

	    border: 0px solid #ececec;

	    

	}





	@media screen and (min-width : 200px) and (max-width:  768px){



	.m_padd{padding: 0px!important;}

	/*.m25{ margin-top: 25px; }

	*/

	}

</style>

<script type="text/javascript">

	$(document).ready(function(){

		//$("#rakhi").modal('show');

	});

</script>

<?php 	if ($this->session->flashdata('festival_message')) { ?>



	<script type="text/javascript">

		$(document).ready(function(){

			$("#festivalPopup").modal('show');

		});

	</script>

	<div class="modal" id="festivalPopup" data-bs-backdrop="static" aria-modal="true" >

	  	<div class="modal-dialog modal-lg modal-dialog-centered">

		    <div class="modal-content">

		      	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

		       	<div class="modal-body text-center">

		        	<h2><?php echo $this->session->flashdata('festival_message')?></h2>

		        </div>

		    </div>

	  	</div>

	</div>

<?php 	}	?>

<?php 	if(!empty($show_flag)){ ?>



	<div class="modal" id="rakhi" data-bs-backdrop="static" aria-modal="true" >

	  	<div class="modal-dialog  modal-dialog-centered">

		    <div class="modal-content">

		      	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

		       	<div class="modal-body">

		        	<div class="rakhi_popup">

								

							<div class="my_session">

	            	    <?= form_open('',['id'=>'register1','name'=>'register1']) ?>

                        		<div class="col-sm-12">

                        			<p>SIGNUP FOR A FREE STYLING SESSION </p>

                        		</div>

                        	

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="text" id="name1" name="name" class="form-control" placeholder="Your Full Name">

                        				<div id="name_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="text" id="city1" name="city" class="form-control" placeholder="Your City" >

                        				<div id="city_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="text" id="email1" name="email" class="form-control" placeholder="Email Address" >

                        				<div id="email_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="text" id="mobile1" name="mobile" class="form-control" placeholder="Phone Number" >

                        				<div id="mobile_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="password" id="password1" name="password" class="form-control" placeholder="Password" >

                        				<div id="password_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="password" id="con_password1" name="con_password" class="form-control" placeholder="Confirm  Password" >

                        				<div id="con_password_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12">

                        			<div class="form-group">

                        				<input type="checkbox" id="terms1" name="terms" > <a href="<?=base_url('terms-of-use')?>">Terms & Conditions</a>

                        				<div id="terms_err1"></div>

                        			</div>

                        		</div>

                        		

                        		<div class="col-sm-12 text-center">

                        			<input type="submit" value="Get Free Styling Session" name="free_stylist_lead" class="login-sub">

                        		</div>

                            <?= form_close(); ?>

                            <script type="text/javascript">

                                $(document).ready(function() {

        

                                    $('#register1').on('submit',function(e) {

                                        e.preventDefault();

                                        

                                     

                                       

                                        $('#name_err1').html('');

                                        $('#city_err1').html('');

                                        $('#mobile_err1').html('');

                                        $('#email_err1').html('');

                                        $('#password_err1').html('');

                                        $('#con_password_err1').html('');

                                        $('#terms_err1').html('');

                                

                            

                                        if($('#name1').val() == '') {

                            

                                            $('#name_err1').html('<span class="text-red">Please enter your Name</span>');

                                

                                            $('#name1').focus();

                                

                                            return false;

                                

                                        } else if($('#city1').val() == '') {

                                

                                            $('#city_err1').html('<span class="text-red">Please enter your city</span>');

                                

                                            $('#city1').focus();

                                

                                            return false;

                                

                                        } else if($('#email1').val() == '') {

                                

                                            $('#email_err1').html('<span class="text-red">Please enter email</span>');

                                

                                            $('#email1').focus();

                                

                                            return false; 

                                

                                        } else if(!IsEmail($('#email1').val())) {

                                

                                            $('#email_err1').html('<span class="text-red">Please enter correct email</span>');

                                

                                            $('#email1').focus();

                                

                                            return false; 

                                

                                        } else if($('#mobile1').val() == '') {

                                

                                            $('#mobile_err1').html('<span class="text-red">Please enter your mobile</span>');

                                

                                            $('#mobile1').focus();

                                

                                            return false;

                                

                                        } else if($('#password1').val() == '') {

                                

                                            $('#password_err1').html('<span class="text-red">Please enter password</span>');

                                

                                            $('#password1').focus();

                                

                                            return false; 

                                

                                        } else if($('#password1').val().trim().length < 8) {

                                

                                            $('#password_err1').html('<span class="text-red">Please enter 8 character password</span>');

                                

                                            $('#password1').focus();

                                

                                            return false; 

                                

                                        } else if($('#con_password1').val() == '') {

                                

                                            $('#con_password_err1').html('<span class="text-red">Please enter confirm password</span>');

                                

                                            $('#con_password1').focus();

                                

                                            return false; 

                                

                                        }else if ($('#con_password1').val() != $('#password1').val()) { 

                                			$('#con_password_err1').html('<span class="text-red">Password did not match: Please try again...</span>') 

                                			$('#con_password1').focus();

                                			return false; 

                                        }else  if (!$('#terms1:checked').val()) {

                                			$('#terms_err1').html('<span class="text-red">Please checked terms</span>') 

                                			$('#terms1').focus();

                                			return false;

                                		}else {

                                            $('#register1').get(0).submit();

                            			    return true;

                                        }

                                    });

                                

                                });

                                $(document).on("blur","#email1",function() {

                                  	var checkEmail = $(this).val();

                                    if(IsEmail(checkEmail)) { 

                                        $.ajax({

                                            type: 'POST',

                                            url: '<?php echo base_url(); ?>vendor/emailcheck',

                                            data: 'checkEmail='+checkEmail,

                                            success: function(data) {

                                              if(data == 1) {

                                                 $('#email_err1').html('<span class="text-red">your email address is registered</span>');

                                                 $('#email1').focus();

                                                 return false; 

                                              } else {

                                                 $('#email_err1').html(' '); 

                                              }

                                           }

                                        });    

                                    }

                                });



                            </script>

                	</div>

				

					</div>

		        </div>

		    </div>

	  	</div>

	</div>

<?php 	}	?>







<script type="text/javascript">



    $(document).ready(function() {

        

        $('#register').on('submit',function(e) {

            e.preventDefault();

            

         

           

            $('#name_err').html('');

            $('#city_err').html('');

            $('#mobile_err').html('');

            $('#email_err').html('');

            $('#password_err').html('');

            $('#con_password_err').html('');

            $('#terms_err').html('');

    



            if($('#name').val() == '') {



                $('#name_err').html('<span class="text-red">Please enter your Name</span>');

    

                $('#name').focus();

    

                return false;

    

            } else if($('#city').val() == '') {

    

                $('#city_err').html('<span class="text-red">Please enter your city</span>');

    

                $('#city').focus();

    

                return false;

    

            } else if($('#email').val() == '') {

    

                $('#email_err').html('<span class="text-red">Please enter email</span>');

    

                $('#email').focus();

    

                return false; 

    

            } else if(!IsEmail($('#email').val())) {

    

                $('#email_err').html('<span class="text-red">Please enter correct email</span>');

    

                $('#email').focus();

    

                return false; 

    

            } else if($('#mobile').val() == '') {

    

                $('#mobile_err').html('<span class="text-red">Please enter your mobile</span>');

    

                $('#mobile').focus();

    

                return false;

    

            } else if($('#password').val() == '') {

    

                $('#password_err').html('<span class="text-red">Please enter password</span>');

    

                $('#password').focus();

    

                return false; 

    

            } else if($('#password').val().trim().length < 8) {

    

                $('#password_err').html('<span class="text-red">Please enter 8 character password</span>');

    

                $('#password').focus();

    

                return false; 

    

            } else if($('#con_password').val() == '') {

    

                $('#con_password_err').html('<span class="text-red">Please enter confirm password</span>');

    

                $('#con_password').focus();

    

                return false; 

    

            }else if ($('#con_password').val() != $('#password').val()) { 

    			$('#con_password_err').html('<span class="text-red">Password did not match: Please try again...</span>') 

    			$('#con_password').focus();

    			return false; 

            }else  if (!$('#terms:checked').val()) {

    			$('#terms_err').html('<span class="text-red">Please checked terms</span>') 

    			$('#terms').focus();

    			return false;

    		}else {

                $('#register').get(0).submit();

			    return true;

            }

        });

    

    });

    

    function IsEmail(email) {     

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       

        return regex.test(email);   

    }

    $(document).on("blur","#email",function() {

      	var checkEmail = $(this).val();

        if(IsEmail(checkEmail)) { 

            $.ajax({

                type: 'POST',

                url: '<?php echo base_url(); ?>vendor/emailcheck',

                data: 'checkEmail='+checkEmail,

                success: function(data) {

                  if(data == 1) {

                     $('#email_err').html('<span class="text-red">your email address is registered</span>');

                     $('#email').focus();

                     return false; 

                  } else {

                     $('#email_err').html(' '); 

                  }

               }

            });    

        }

    });

    

</script>


<script type="text/javascript">
	  /* Demo purposes only */
  $(".hover").mouseleave(
    function() {
      $(this).removeClass("hover");
    }
  );
</script>






