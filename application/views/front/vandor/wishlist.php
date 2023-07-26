<?php $this->load->view('front/vandor/header'); ?>; ?>

<style type="text/css">
	.wishlist_image{
		height: 320px;
	    width: 100%;
	    object-fit: cover;
	}
</style>

<div class="main">

	<div class="container">



		<!-- <div class="col-sm-3 p-0 sdk">

			<div class="sidebar">

			<?php //$this->load->view('front/vandor/siderbar'); ?>

			</div>

		</div>
 -->




		<div class="col-sm-12">

			<div class="rightbar">

				<h2>Wishlist</h2>

				

				<hr>

				

				<div class="row m-0 mt-5">

					<?php  foreach ($wishlistArray as $key => $value) { ?>
						<?php  	$product = $value->productRow; ?>
						<?php  	if($product->discount) { $discount = ($product->discount / 100) * $product->price; $discountAmt = round($product->price - $discount); }
					          	   ?>
					          	 
		          		<div class="col-6 col-sm-4">
		          			<div class="products_lst">
	          				 	<a href="<?= base_url('product-detail/').$product->slug ?>" class="link-cart">
		          				    <?php if($product->discount) { ?>
		            				    <!-- <span class="product-top"><?= ($product->discount)?"($product->discount% OFF)":"" ?></span> -->
		            				<?php } ?> 
		            				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$product->image ?>" class="img-fluid wishlist_image">
		            				
	            				</a>
		            			<div class="title_data">
		            				<div class="prd_title text-center">
		            					<p><?= mb_strimwidth($product->product_name,0,20, '....') ?></a> </p>
		            				</div>
			          				<div class="cart_new_2">
			          				        <?php if($product->discount) { ?>
			          				            <span style="display:none"><?= $this->site->currency.' '.number_format($discountAmt) ?> <del><?= $this->site->currency.''.number_format($product->price) ?></del></span>
			          				        <?php }else { ?>
			          				            <span style="display:none"><?= $this->site->currency.' '.number_format($product->price) ?></span> 
			          				        <?php } ?>
			          				
			          					<a class="text-white" href="<?= base_url('product-detail/').$product->slug ?>">Details</a>
			          				</div>
			          				<br/>
		          				</div>
		          				 
		          			</div>
		          		</div>

				    <?php  	} ?>

					<div class="col-sm-3 p-0" style="display: none;">

						<div class="products_lst">

							<a href="product-details.php"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="images/t4.jpg" class="img-fluid"></a>

							<div class="title_data">

								<i class="fa fa-heart wishhh"></i>



								<p>Wedding Jewelry</p>

								<div class="cart_new_2">

									<a href="product-details.php" class="">Add to bag $22</a>

								</div>

								<a href="#" class="remm"><i class="fa fa-trash" aria-hidden="true"></i></a>

							</div>

						</div>

					</div>

					

					 
				

				</div>

				

			</div>

		</div>

	</div>

</div>





</body>

</html>

