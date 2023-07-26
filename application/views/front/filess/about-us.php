<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->
<style type="text/css">
	.vi-listing{
		margin-top: 50px;
	}
	.vi-listing ul{
		margin: 0;
		padding: 0;
		margin-top: 10px;
		margin-bottom: 20px!important;
	}
	.vi-listing ul li{
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
	.vi-listing p{
		font-size: 16px;
		text-align: justify;
	}
	.ab-sec p{
		text-align: justify;
		font-size: 14px;
	}
	.ab-sec h1{
		position: relative;
		margin-bottom: 15px;
	}
	.h-bg{
		background: rgb(255 255 255);
    	
    	position: relative;
	}
	.h-bg p{
		margin-top: 20px;
	}
	.h-text{
		padding: 110px;
	}
	.ab-bg{
		position: relative;
	    background-position: center center;
	    background-size: cover;
	    padding: 60px;
	    margin-top: 30px;
	}
	.ab-bg::before {
	    background-color: #fff;
	    bottom: 0;
	    content: "";
	    left: 0;
	    opacity: 0.5;
	    position: absolute;
	    top: 0;
	    width: 100%;
	}
	.lgt-bg{
		padding: 40px 0px;
		margin-top: 50px;
	}
	.lgt-bg .vi-listing{
		margin-top: 0px;
	}
	.h-line{
		width: 50px;
		height: 3.5px;
		background: #f42cc2;
		margin: auto;
		border-radius: 10px;
	}
	.lgt-bg .h-line{
		margin-bottom: 20px;
	}
	.lgt-bg .vi-listing ul li {
	    margin-bottom: 0px;
	    list-style-type: none;
	    position: relative;
	    padding: 10px 0 0 32px;
	    font-size: 14px;
	    border: 1px solid #ccc;
	    margin-bottom: 10px;
	    padding-bottom: 14px;
	    margin-left: 0px;
	    background: #fff;
	    border-radius: 30px;
	}
	.lgt-bg .vi-listing ul i {
	    left: 15px;
	    top: 14px;
	    position: absolute;
	    font-size: 14px;
	    color: #f42cc2;
	}
	.ab-sec h1, .ab-sec h2{
		text-transform: uppercase;
	}
	.box_sh:before {
	    content: "";
	    background: url('<?=base_url()?>assets/images/reel.png');
	    height: 100%;
	    width: 36px;
	    position: absolute;
	    display: block;
	    right: -12px;
	}
	.d_ab{
		background: #fff;
		padding: 0px;
	}
	.d_ab h2{
		margin-bottom: 10px;
	}
	.ab_tag{
		box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
	}
	.ab_tag p{
		margin-right: 15px;
    	margin-top: 15px;
	}
	.ab_tag h2{
		text-transform: uppercase;
		margin-bottom: 0px;
	}
	.ab_tag .h-line{
		margin-top: 10px;
	}
	.banner_inner:before{
		display: none;
	}
	.ab-banner_inner{
		padding: 40px 0px;
	}
	.ab-process{padding: 40px 0px;
    position: relative;
    background: rgb(117 46 161 / 7%);
    margin: 50px 0px;}
    .ab-process h2{margin-bottom:10px;}


.box
{
  position:relative;
  padding: 20px;
  box-shadow:0 15px 25px rgba(0,0,0,.1);
  border-radius:15px;
  box-sizing:border-box;
  overflow:hidden;
  text-align: center; 
  height: 100%;
  margin-top: 20px;
  transition:1.0s;
  border: 2px solid #fff;
}

.box .icon {
  position:relative;
  width: 80px;
  height: 80px;
  color:#fff;
  background:#742ea0;
  display:flex;
  justify-content: center;
  aling-items: center;
  margin:15px auto;
  border-radius:20%;
  font-size: 50px;
  font-weight:normal;
  transition:2s;
  padding:10px;
      border-radius: 50%;
}
.box img{border:none;border-radius: 0px;padding: 5px;}
.box:hover{
	border-top: 2px solid #742ea0;
	box-shadow: none;
	border-radius: 0px;
}
.box:hover img {
    border-radius:0px;
}
.box:hover .icon{
	background:#FF1493 ;
	box-shadow:0 15px 25px rgba(0,0,0,.1);
}
.box .icon i{
  padding:12px;
}


.box .content
{
  position:relative;
  z-index:1;
  transition:1.0s;
  color: #000;
}
.box .content h3
{
  font-size: 16px!important;
  margin:10px 0;
  padding:0;
  text-align: center;
  margin-top: 25px;
}
.box .content p{
   margin:0;
  padding:0;
}
.h-bg img{border:1px solid #ccc; padding: 6px;}
@media(max-width: 768px){
		.h-bg {
		    background: rgb(255 255 255);
		    padding: 18px;
		    position: relative;
		}
		.ab-bg {
		    position: relative;
		    background-position: center center;
		    background-size: cover;
		    padding: 15px;
		}
		.box_sh:before{
			display: none;
		}
		.box{height: auto;}
		.d_ab h2 {
    margin-bottom: 10px;
    margin-top: 30px;
}
	}
</style>
<div class="banner_inner ab-banner_inner">
	<div class="container">
		<div class="text-center">
			<h1>ABOUT US</h1>
			<?php 
        		$this->breadcrumb = new Breadcrumbcomponent();
        		$this->breadcrumb->add('Home', '/');
        		$this->breadcrumb->add('About Us', '/about-us');
        	?>
         
        	<?php echo $this->breadcrumb->output(); ?>
		</div>
	</div>
	<!-- <div class="top_title">
		<div class="container"><h3><?= ucwords($cmsData->title) ?></h3></div>
	</div> -->
	
</div>

<!--========End Banner Area ========-->	


<div class="middle_part" style="padding-top: 0px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-12 text-center">
					<div class="h-bg ab-sec">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/abs.jpg" class="img-fluid">
		     		<p>Fashion styling is an art that combines creativity and technical skills to create visually stunning outfits that make a statement. The goal of a fashion stylist is to make people look and feel their best, and to tell a story through clothing. In today’s world, fashion has become more than just a way to express ourselves. It is a powerful tool that can change the way we feel, the way we interact with others, and the way we are perceived by the world.</p>
		     		<p>At StyleBuddy, we are dedicated to creating memorable fashion experiences that help people express their personal style. Our team of experienced fashion stylists is passionate about helping people find the perfect outfit for any occasion. Whether you are looking for a professional look for a business meeting or a bold statement for a night out, we have the skills and expertise to help you look and feel your best.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="ab-process">
			<div class="ab-sec container">
			     <div class="row align-items-center ">
		     		<div class="col-sm-7 text-justify">
		     			<div class="vi-listing">
				     		<h2>Our Process</h2>
				     		<div class="h-line" style="margin-left: 0px;"></div>
				     		<br>
				     	</div>
			     		<p>At StyleBuddy, we understand that every client has unique needs and preferences. That is why we take a personalized approach to each styling session. Our process starts with a consultation, where we get to know you and your fashion preferences. From there, we will work with you to create a customized styling plan that fits your lifestyle, budget, and personal style.</p>
			     		<p>We source clothing and accessories from a wide range of high-end and affordable brands to ensure that you have a diverse selection to choose from. Our team stays up to date on the latest fashion trends, so you can be confident that your outfit will be both stylish and on-trend.</p>
			     	</div>
			     	<div class="col-sm-5"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/prs.png" class="img-fluid"></div>
			     </div>
			</div>
		</div>
	<div class="lgt-bg">
		<div class="ab-sec container">
			<div class="row align-items-center vi-listing">
				<div class="col-sm-12 text-center">
					<h2>Our Services</h2>
					<p class="text-center">We provide customized styling and fashion services for</p>
					<div class="h-line"></div>
		     	</div>
		     	<div class="col-sm-12">
		     		
		     		<div class="row">
		     			<div class="col-sm-3">
		     				<div class="box">
								<div class="icon"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/s1.png"></div>
								<div class="content">
								    <h3>Personal Styling</h3>
								    <p>Our personal styling services are designed to help you find the perfect outfit for any occasion. Whether you are looking for a professional look for work or a casual look for the weekend, we have the expertise to help you look and feel your best.</p>
								</div>
							</div>
		     			</div>
		     			<div class="col-sm-3">
		     				<div class="box">
								<div class="icon"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/s2.png"></div>
								<div class="content">
								    <h3>Wardrobe Consultation</h3>
								    <p>Our wardrobe consultation service is perfect for those who are looking to streamline their wardrobe and create a more cohesive and functional collection of clothing.</p>
								</div>
							</div>
		     			</div>
		     			<div class="col-sm-3">
		     				<div class="box">
								<div class="icon"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/s3.png"></div>
								<div class="content">
								    <h3> Special Occasion Styling</h3>
								    <p>For those special occasions that require a little extra effort, our special occasion styling services are here to help. Whether it's a wedding, a prom, or a red carpet event, our team will work with you to create the perfect look for the occasion.</p>
								</div>
							</div>
		     			</div>
		     			<div class="col-sm-3">
		     				<div class="box">
								<div class="icon"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/s4.png"></div>
								<div class="content">
								    <h3> Editorial Styling</h3>
								    <p>Our editorial styling services are perfect for those who are looking to create eye-catching, on-trend outfits for photo shoots and fashion shoots.</p>
								</div>
							</div>
		     			</div>
		     		</div>

		     	</div>
		     </div>
		</div>
	</div>
</div>

<!-- <div class="d_ab">
	<div class="container">
		<div class="row justify-content-center ">
			<div class="col-sm-8">
				<div class="ab_tag">
					<div class="row align-items-center m-0">
						<div class="col-sm-6 p-0">
							<div class="box_sh">
								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/').$cmsData->image2 ?>" class="img-fluid">
							</div>
						</div>
						<div class="col-sm-6 text-center">
						    <?= $cmsData->content2; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="d_ab">
	<div class="container">
		<div class="row justify-content-center ">
			<div class="col-sm-12">
					<div class="row align-items-center">
						<div class="col-sm-5">
								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/why-ch.png" class="img-fluid">
						</div>
						<div class="col-sm-7">
							<h2>Why Choose StyleBuddy</h2>
							<div class="h-line" style="margin-left:0px;"></div>
							<br>
							<p>At StyleBuddy, we are dedicated to providing our clients with a fashion styling experience that is both enjoyable and stress-free. Our team of experienced stylists is passionate about helping people find the perfect outfit and will work with you every step of the way to ensure that you are completely satisfied with the final result. </p>
							<p>We understand that fashion can be intimidating, which is why we take a personalized approach to each styling session. Our goal is to make you feel comfortable and confident in your own skin, and to help you express your personal style through your clothing.</p>
							<p>If you're looking for a fashion styling company that can help you create memorable fashion experiences, look no further than StyleBuddy. Contact us today to schedule your consultation and start your fashion journey.</p>
						</div>
					</div>
				
			</div>
			
		</div>
	</div>
</div>




<?php $this->load->view('Page/template/footer'); ?>