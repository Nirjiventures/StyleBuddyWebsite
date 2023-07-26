<?php  $this->load->view('Page/template/header'); ?>

<?php $catlist = array(); foreach($products as $list) { 

      $catlist[] = $list->cat_id;        

}   

?>



    



<style type="text/css">

	.pagination li a{

		background: none!important;

		padding: 0!important;

		min-width: 0px;

		height: 21px;

		line-height: 20px;

	}





	.mynew_shop .line-tag {

		display: block;

		margin: auto;

	}



</style>



<div class="container">

	<div class="main_banner">

		<!-- Carousel -->

		<div id="demo" class="carousel slide" data-bs-ride="carousel">



		  <!-- Indicators/dots -->

		  <div class="carousel-indicators">

		    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>

		    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>

		    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>

		  </div>

		  

		  <!-- The slideshow/carousel -->

		  <div class="carousel-inner">

		    <div class="carousel-item active">

		       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/slider/banner_sale.jpg" alt="Stylebuddy" class="d-block" style="width:100%"> 

    		      	<div class="ctp">

    		      	<div class="row m-0 align-items-center">

    		      		<div class="col-sm-6 text_cent">

    		      		    <h3>SALE</h3>

    		      		    <p class="enj">Enjoy special offers on the most popular categories.</p>

    		      	    	<div class="my_dis_new"> <a href="<?php echo base_url(); ?>shop/category?discount=30">DISCOVER <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/shopping-cart.png" class="shppi_icon"></a></div>

    					</div>

    				</div>

    		 	 </div>

		      </div>



		    <div class="carousel-item">

		        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/slider/slider01.jpg" alt="Stylebuddy" class="d-block" style="width:100%">

		    	<div class="bg-overlay2"></div>

		    	<div class="ctp">

		      	<div class="row m-0 align-items-center">

		      		<div class="col-sm-6 text_cent">

		      		    <h3>New Arrivals</h3>

		      	    	<div class="my_dis_new"> <a href="<?php echo base_url(); ?>shop/category?ptype=new">DISCOVER <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/shopping-cart.png" class="shppi_icon"></a></div>

					</div>

				</div>

		 	 </div>

		    </div>

		    <div class="carousel-item">

		        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/slider/slider03.jpg" alt="Stylebuddy" class="d-block" style="width:100%">

		    	<div class="bg-overlay2"></div>

		    	<div class="ctp">

		      	<div class="row m-0 align-items-center">

		      		<div class="col-sm-6 text_cent">

		      			<h3>Going On Vacation?</h3>

		      			<div class="my_dis_new"><a href="<?php echo base_url(); ?>shop/outfits-by-occasion?catid=76">DISCOVER <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/shopping-cart.png" class="shppi_icon"></a></div>

					</div>

					

		      	</div>

		 	 </div>

		    </div>

		  </div>

		  

		  

		</div>

	</div>

</div>



<style>

  .col-xs-5-cols,

.col-sm-5-cols,

.col-md-5-cols,

.col-lg-5-cols {

  position: relative;

  min-height: 1px;

  padding-right: 15px;

  padding-left: 15px;

}



.col-xs-5-cols {

  width: 20%;

  float: left;

}



@media (min-width: 768px) {

  .col-sm-5-cols {

      width: 20%;

      float: left;

  }

}



@media (min-width: 992px) {

  .col-md-5-cols {

      width: 20%;

      float: left;

  }

}



@media (min-width: 1200px) {

  .col-lg-5-cols {

      width: 20%;

      float: left;

  }

}

</style>



<?php if ($featuredCategory) {?>

<div class="my_new_cat">

	<div class="container mb-3">

		<div class="row m-0">

			<div class="col-sm-12 text-center">

				<div class="new_title"><h2><span>Popular Categories<?php ?></span></h2></div>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row m-0">

			<?php foreach ($featuredCategory as $key => $value) {?>

				<div class="col-md-5-cols col-6">

					<a href="<?php echo base_url('shop/'.$value['slug'].'?catid='.$value['id']); ?>">

						<div class="cat_box">

							<?php $img =  'assets/images/cat/cat1.jpg';?>

							<?php if(!empty($value['cat_image'])) { ?>

								<?php $img = $value['cat_image'];?>

							<?php } ?> 

							<?php $img =  'assets/images/cat/cat1.jpg';?>
							<?php if(!empty($value['cat_image']))  {?>
					   		<?php 
					   			$img1 =  $value['cat_image']; 
					   			if (file_exists($img1)) {
					   				$img = $img1;
					   			}
					   		?>
					   	<?php } ?>
  						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">
							<div class="cat_name"><?=$value['name']?></div>

						</div>

					</a>

				</div>

			<?php } ?>

			 

		</div>

	</div>

</div>

<?php } ?>




<div class="limit_off">



	<div class="container mb-3">

		<div class="row m-0">

			<div class="col-sm-12 text-center">

				<div class="new_title"><h2><span>Limited Time Offer</span></h2></div>

			</div>

		</div>

	</div>





	<div class="container">

		<div class="off_banner">

			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/style-buddy-ads.jpg" class="img-fluid">

			<div class="offers_box">

				<h3>Sale </h3>

				<h5>UP to 30% off</h5>

				<p>Enjoy special offers on the most iconic brands and popular categories</p>

				<a href="<?php echo base_url(); ?>shop/all?discount=30">Discover</a>

			</div>

		</div>

	</div>

</div>





<div class="gift_card">

	<div class="container mb-3">

		<div class="row m-0">

			<div class="col-sm-12 text-center">

				<div class="new_title"><h2><span>Gift Cards</span></h2></div>

			</div>

		</div>

	</div>



	<div class="row m-0 justify-content-center">

        <div class="col-sm-10 text-center">

            <?php //$giftCrad = $this->common_model->get_all_details_query('gift','WHERE DATE(end_date) >= "'.date('Y-m-d').'" AND status = 1')->result_array(); echo $this->db->last_query();var_dump($giftCrad);?>

        	<?php $giftCrad = $this->common_model->get_all_details_query('gift','WHERE status = 1')->result_array();?>

        	<?php foreach ($giftCrad as $key => $value) { ?>

		        	<?php if ($value['media']) { ?>

		        		<div class="col-md-5-cols col-6">

										<a href="<?=base_url('page/giftcard/'.base64_encode(base64_encode(base64_encode($value['id']))))?>">

											<div class="cat_box">

												<?php $img =  'assets/images/cat/cat1.jpg';?>

												<?php if(!empty($value['media'])) { ?>

													<?php $img = $value['media'];?>

												<?php } ?> 

												

												<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">

							                    <!--<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url().$img?>" class="img-fluid">-->

							

												

												<div class="cat_name">Price: <?=$this->site->currency.''.$value['gift_code_price']?></div>

											</div>

										</a>

								</div>

		        	<?php }?>

        	<?php }?>

            <!--<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="IMG" src="<?= base_url() ?>assets/images/coming-soon-gift.png" class="img-fluid">-->

        </div>

    </div>

	    

	<section class="customer-logos3 slider" style="display:none">

		

		

		<div class="gift_box">

			<a href="#">

				<div class="row m-0 align-items-center">

					<div class="col-sm-6">

						<div class="my_title">

							<p>Coupon</p>

							<h4>Styling Services</h4>

							<p class="c_dis">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>

						</div>

					</div>

					<div class="col-sm-6 p-0">

						<div class="offers_dis">

							<h4>20% off <span>Coupon</span></h4>

						</div>

					</div>

				</div>

		  	 </a>

		</div>



		<div class="gift_box">

			<a href="#">

				<div class="row m-0 align-items-center">

					<div class="col-sm-6">

						<div class="my_title">

							<p>Coupon</p>

							<h4>Men's Clothing</h4>

							<p class="c_dis">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>

						</div>

					</div>

					<div class="col-sm-6 p-0">

						<div class="offers_dis">

							<h4>50% off <span>Coupon</span></h4>

						</div>

					</div>

				</div>

		  	 </a>

		</div>

		

		<div class="gift_box">

			<a href="#">

				<div class="row m-0 align-items-center">

					<div class="col-sm-6">

						<div class="my_title">

							<p>Coupon</p>

							<h4>Women's Clothing</h4>

							<p class="c_dis">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>

						</div>

					</div>

					<div class="col-sm-6 p-0">

						<div class="offers_dis">

							<h4>35% off <span>Coupon</span></h4>

						</div>

					</div>

				</div>

		  	 </a>

		</div>



		<div class="gift_box">

			<a href="#">

				<div class="row m-0 align-items-center">

					<div class="col-sm-6">

						<div class="my_title">

							<p>Coupon</p>

							<h4>Kids Clothing</h4>

							<p class="c_dis">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>

						</div>

					</div>

					<div class="col-sm-6 p-0">

						<div class="offers_dis">

							<h4>15% off <span>Coupon</span></h4>

						</div>

					</div>

				</div>

		  	 </a>

		</div>



		<div class="gift_box">

			<a href="#">

				<div class="row m-0 align-items-center">

					<div class="col-sm-6">

						<div class="my_title">

							<p>Coupon</p>

							<h4>Corporate Styling Services</h4>

							<p class="c_dis">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>

						</div>

					</div>

					<div class="col-sm-6 p-0">

						<div class="offers_dis">

							<h4>25% off <span>Coupon</span></h4>

						</div>

					</div>

				</div>

		  	 </a>

		</div> 



		



	</section>





</div>







<?php $this->load->view('Page/template/footer'); ?>







