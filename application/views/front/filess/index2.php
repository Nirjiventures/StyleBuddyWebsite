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


    .job-banner{
    	padding: 60px 0px;
    }
    .job-banner p{
    	font-size: 22px;
    	margin-bottom: 30px;
    	color: #000;
    }
    .job-banner h1{
    	font-size: 42px!important;
    	background: linear-gradient(to right, #f62bc1 0%, #742ea0 100%);
    	-webkit-background-clip: text;
    	-webkit-text-fill-color: transparent;
    	text-transform: capitalize;
    }
    .job-banner img{
    	border-radius: 6px;
    	width: 100%;
    }
    .job-banner a{
    		background: #742ea0;
        color: #fff;
        border-radius: 6px;
        padding: 8px 30px;
        font-size: 17px;
        margin-right: 17px;
    }
    .job-banner a:hover{
    	background: #f62ac1;
    }
    @media(max-width: 768px){
    	.job-banner h1 {
        font-size: 30px!important;
      }
    	.job-banner p {
        font-size: 16px;
      }
      .btn-grp{
      	display: block;
        position: relative;
        margin-bottom: 30px;
      }
    }
</style>

<div class="container mt-2">
     <?php 
		$this->breadcrumb = new Breadcrumbcomponent();
		$this->breadcrumb->add('Home', '/');
		$this->breadcrumb->add('Post Jobs', '/postjobs');
	?>
 
	<?php echo $this->breadcrumb->output(); ?>
</div>

<div class="job-banner">
	<div class="container">
	         
        	
		<div class="row align-items-center">
		   
			<div class="col-sm-6">
				<h1>Post Fashion styling Jobs</h1>
				<p>The No. 1 Fashion styling job board for brands, Agencies, Contractors and Production Houses. </p>
				<div class="btn-grp">
					<a href="<?=base_url()?>page/postjoblogin">Post Now</a>
					<a href="<?=base_url()?>page/postjobregister">Register</a>
				</div>
			</div>
			<div class="col-sm-6">
				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/jb-img.jpg" class="img-fluid">
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.jb-board{
		padding: 60px 0px;
		background: #FEF8F5;
	}
	.jb-board h2{
		font-size: 28px!important;
		text-transform: capitalize;
		color: #000;
		line-height: 38px;
	}
	.jb-board p{
		font-size: 18px;
		color: #000;
	}
	.jb-board img{
		width: 100%;
	}
	.board-jb .board-list{
		background: #fff;
		border-radius: 6px;
		padding: 20px;
		box-shadow: 10px 10px 10px #ccc;
	}
	.board-jb .board-list a{
		border-bottom: 1px solid #ccc;
		padding: 15px 0px;
		display: block;
		color: #000;
		font-weight: bold;
	}
	.board-jb .board-list a:last-child{
		border-bottom: none;
	}
	.board-jb .board-list a:hover{
		color: #f62ac1;
	}
	.board-jb .board-list a span{
		display: block;
	}
	.board-jb .input-group{
		width: 80%;
	}
	.board-search .input-group-text {
    border: none;
    background: #f3f3f4!important;
		}
	.board-search .form-control{
		height: 40px;
    padding: 0 20px;
    font-size: 14px;
    border-radius: 0px;
	}
	.board-jb{
		margin-top: 50px;
		margin-left: -60px;
	}
	.board-jb .board-list{
		margin-left: 30px;
	}
@media(max-width: 768px){
	.board-jb .input-group {
	    width: 100%;
	}
	.board-jb{
		margin-left: 0px;
	}
	.board-jb .board-list{
		margin-left: 0px;
	}
	.jb-board h2{
		font-size: 24px!important;
	}
	.jb-board p{
		font-size: 16px;
	}
	.jb-board img {
    width: 100%;
    height: 250px;
    object-fit: contain;
	}
}
</style>
<div class="jb-board">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h2>The job board for top Fashion styling talent</h2>
				<p>Connect with thousands of stylists in India and worldwide. Our job postings get strong responses in front of one of the best fashion stylists. </p>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/jb-board.jpg" class="img-fluid">
					</div>
					<div class="col-sm-6">
						<div class="board-jb">
							<div class="board-search">
								<form>
	  								<div class="input-group">
	    								<span class="input-group-text"><i class="fa fa-search"></i></span>
	    								<input type="text" class="form-control" placeholder="Personal stylist jobs">
	  								</div>
								</form>
							</div>
							<div class="board-list">
								<a href="<?=base_url()?>page/browsejobs">Fashion stylist <span>Full time- Mumbai</span></a>
								<a href="<?=base_url()?>page/browsejobs">Wedding Stylist <span>Part time- Delhi</span></a>
								<a href="<?=base_url()?>page/browsejobs">Celebrity Stylist <span>Full time- Ahmedabad</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.easy-box{
		padding: 60px 0px;
	}
	.easy-box h2{
    font-size: 28px!important;
    text-transform: capitalize;
    color: #000;
    line-height: 38px;
	}
	.easy-box p{
			font-size: 18px;
			color: #000;
	}
	.easy-box a.btn-easy{
    background: #742ea0;
    color: #fff;
    border-radius: 6px;
    padding: 8px 30px;
    font-size: 17px;
    margin-right: 17px;
    display: inline-block;
    margin-top: 5px;
	}
	.easy-box a.btn-easy:hover {
    background: #f62ac1;
	}
	.easy-box .input-group{
		width: 50%;
	}
	.easy-box .input-group-text {
    border: none;
    background: #f3f3f4!important;
	}
	.easy-box .form-control{
		height: 40px;
    padding: 0 20px;
    font-size: 14px;
    border-radius: 0px;
	}
	.easy-box .designer_list_1 p {
    margin-bottom: 0px;
	}
	.easy-box .designer_list_1 p.portfolio_total {
    position: relative;
    z-index: 9;
    top: 0px;
    left: 0px;
    background: none;
    font-size: 12px!important;
    padding: 2px 0px;
    border-radius: 4px;
    color: var(--black)!important;
    margin-top: 5px!important;
    margin-bottom: 0px!important;
	}
	.easy-box .designer_list_1 {
		padding: 10px;
    box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
    margin-top: 12px;
    margin-left: 40px;
    margin-bottom: 0px;
  }
	.easy-box .rating-md {
    font-size: 12px;
	}
	.easy-box .designer_list_1 h4{
  	margin-bottom: 0px;
  }
  .easy-box .designer_list_1 img {
    height: 110px;
    width: 110px;
    border-radius: 5%;
	}
  .easy-box .designer_list_1{
    position: relative;
    text-decoration: none;
    background: #ffffff;
    border: 2px solid #ffffff;
    transition: ease-out 0.5s;
    -webkit-transition: ease-out 0.5s;
    -moz-transition: ease-out 0.5s;
	}
  .easy-box .designer_list_1::after,
  .easy-box .designer_list_1::before {
    position: absolute;
    content: "";
    width: 0%;
    height: 0%;
    visibility: hidden;
  }
 	.easy-box .designer_list_1::after {
    bottom: -2px;
    right: -2px;
    border-left: 2px solid #f62ac1;
    border-bottom: 2px solid #f62ac1;
    transition: width .1s ease .1s, height .1s ease, visibility 0s .2s;
  }
  .easy-box .designer_list_1::before {
    top: -2px;
    left: -2px;
    border-top: 2px solid #f62ac1;
    border-right: 2px solid #f62ac1;
    transition: width .1s ease .3s, height .1s ease .2s, visibility 0s .4s;
  }
  .easy-box .designer_list_1:hover {
    animation: pulse 1s ease-out .4s;
    color: #222222;
  }
  .easy-box .designer_list_1:hover::after,
  .easy-box .designer_list_1:hover::before {
    width: calc(100% + 4px);
    height: calc(100% + 3px);
    visibility: visible;
    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
  }
  .easy-box .designer_list_1:hover::after {
    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
  }
  .easy-box .designer_list_1:hover::before {
    transition: width .1s ease, height .1s ease .1s;
  }
  .easy-box .ratingss{
   	color: #000;
  }
  .easy-box a.absc{
    position: static;
    z-index: 1;
  }
  .easy-box button.v_quote{
   	margin-top: 5px;
    background: #742ea0;
    color: #fff;
    border-radius: 14px;
    padding: 2px 9px;
    position: relative;
    z-index: 9;
    border: 2px solid #742ea0;
    font-size: 12px;
  }
  .easy-box a.absc:hover button.v_quote{
    position: relative;
    z-index: 9;
   }
@media screen and (min-device-width: 200px) and (max-device-width: 767px){
  .easy-box .ratingss{
    	margin-bottom: 12px;
  }
  .easy-box .book_now_b a {
    width: 100%!important;
    margin: auto;
  }
  .easy-box .book_now_b {
    margin-top: 10px;
  }
  .easy-box button.v_quote {
    margin-top: 4px;
  }
  .easy-box .space {
    padding-left: 0px!important;
    padding-right: 0px!important;
  }
  .easy-box .input-group {
    width: 100%;
	}
	.easy-box .designer_list_1{
		margin-left: 0px;
	}
	.easy-box h2{
		margin-top: 30px;
		font-size: 24px!important;
	}
	.easy-box p{
		font-size: 16px;
	}
}
</style>
<div class="easy-box">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<form>
  				<div class="input-group">
    				<span class="input-group-text"><i class="fa fa-search"></i></span>
    					<input type="text" class="form-control" placeholder="Celebrity stylist">
  					</div>
				</form>
				<?php if($tranding_vendor){ ?>
					<?php foreach($tranding_vendor as $k=>$vender){ ?>	
								<?php $review = $vender->review;?>
								<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.$vender->city_name) ?>
								<?php  if (file_exists($image_path = FCPATH . 'assets/vandor/images/' . $vender->image)) { ?>
								    <?php 	$img = base_url('assets/vandor/images/'.$vender->image); ?>
								<?php  } else { ?>
								    <?php  	$img = base_url('assets/images/stylist/no-image.jpg'); ?>
								<?php  } ?>
								<a href="<?=$url?>" class="absc">
									<div class="designer_list_1">
										<span>
											<div class="row">
									      <div class="col-sm-3 col-5">
									        <div class="pro_part">
										        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=$img?>" class="img-fluid">
													</div>
												</div>
									      <div class="col-sm-9 col-7">
									        <div class="all_data">

														<h4><span><?= ucwords($vender->fname.' '.$vender->lname) ?></span></h4>

														<div class="row">

															<div class="col-sm-6">

																 

																	<p class="mt-0"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>



																	<p style="display: none;"><?= $vender->designation ?></p>



																	<div class="hidden_star_pointer ratingss">



																		<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Reviews <?=$vender->feedbackCount?>) 



																	</div>

																 

															</div>

															<div class="col-sm-6">

																

																	<?php if(isset($vender->city_name) && (!empty($vender->city_name)) ) {  ?>

												        			<p><small><i class='fa fa-map-marker' aria-hidden="true"></i> <?= $vender->city_name ?></small></p>

												        			<?php } ?>



																	<p class="portfolio_total"><i class="fa fa-eye"></i> <?=$vender->count_view;?> Views</p>

																

																<div class="book_now_b">

																	<?php if($this->session->userdata('loginUser')){ ?>

																		<button class="v_quote" onclick="redire('<?= base_url('ask-for-quote/uOiEa'.base64_encode($vender->id) ) ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

															        	 



															        <?php }else{ ?>	

															        	<button class="v_quote" onclick="redire('<?= base_url('login') ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

															        	 



															        <?php } ?>

															    </div>

															</div>

														</div>

													</div>
									       </div>
								       </div>
										</span>
									</div>
								</a>
						<?php } ?>	
					<?php } ?>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-5">
				<h2>Hire fast & easy. Find talented fashion stylists in minutes. </h2>
				<p>Connect with thousands of stylists in India and worldwide. Our job postings get strong responses in front of one of the best fashion stylists. </p>
				<a href="<?=base_url()?>page/postjoblogin" class="btn-easy">Post Now</a>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.amz-fashion{
		padding: 60px 0px;
	}
	.amz-fashion h2{
    font-size: 28px!important;
    text-transform: capitalize;
    color: #000;
    line-height: 38px;
	}
	.amz-fashion p{
			font-size: 18px;
			color: #000;
			margin-bottom: 30px;
	}
	.amz-fashion a {
    background: #742ea0;
    color: #fff;
    border-radius: 6px;
    padding: 8px 30px;
    font-size: 17px;
    margin-right: 17px;
	}
	.amz-fashion a:hover {
    background: #f62ac1;
	}
	@media (max-width: 768px){
		.amz-fashion h2 {
   		 font-size: 24px!important;
  	}
  	.amz-fashion p{
  		font-size: 16px;
  	}
  	.amz-fashion{
  		padding-top: 10px;
  	}
	}
</style>
<div class="amz-fashion">
	<div class="container text-center">
		<div class="row justify-content-center">
			<div class="col-sm-8">
				<h2>Find amazing fashion stylists for your brand, agency or production House!</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-sm-7">
				<p>Connect with thousands of stylists in India and worldwide. Our job postings get strong responses in front of one of the best fashion stylists. </p>
				<a href="<?=base_url()?>page/postjoblogin">Post Now</a>
			</div>
		</div>
	</div>
</div>

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
    .top-footer:after {
	    border-left: 100vw solid transparent;
	}
	.footer .newsletter{
		margin-bottom: 10px;
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






