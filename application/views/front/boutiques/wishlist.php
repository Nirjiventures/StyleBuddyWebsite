<?php $this->load->view('front/vandor/header'); ?>; ?>

<style type="text/css">
	.wishlist_image{
		height: 320px;
	    width: 100%;
	    object-fit: cover;
	}
	.pdt_box .prd_title h4 a {
	  font-size: 18px;
	  color: #ff2954;
	}
	.pdt_box {
	  position: relative;
	  background: var(--bg-light-skin);
	  border-radius: 10px;
	}
	.pdt_inner {
	  position: relative;
	  overflow: hidden;
	}
	.product-top {
	  background: #fc636b none repeat scroll 0 0;
	  color: #fff;
	  display: inline-block;
	  right: 0;
	  padding: 0 10px 1px;
	  position: absolute;
	  top: 0;
	  z-index: 9;
	  border-radius: 0px 6px 0px 0px;
	}
	.pdt_box img {
	  transition: all 0.5s ease-out 0s;
	  padding: 0px 0px 0px;
	  width: 100%;
	  height: 220px;
	  object-fit: cover;
	  border-radius: 10px 10px 0px 0px;
	  object-position: top;
	  margin-bottom: 18px;
	}
	.pdt_box .prd_price {
	  text-align: center;
	  font-size: 16px;
	  font-weight: bold;
	  margin-bottom: 10px;
	}
	.pdt_box .prd_price del {
	  color: #8d8d8d;
	}
	.text-center {

	    text-align: center !important;

	}
	.pdt_inner .link-cart {
	  position: absolute;
	  width: 100%;
	  text-align: center;
	  padding: 8px 0px;
	  z-index: 0;
	  top: 0%;
	  left: 0px;
	  background: #333333;
	  opacity: 0;
	  color: #fff;
	  transition: all 0.5s;
	}
	.text-white {
	  --bs-text-opacity: 1;
	  color: rgba(var(--bs-white-rgb),var(--bs-text-opacity)) !important;
	}
	.pdt_box button.btn-price {
	  text-align: center;
	  font-size: 14px;
	  padding: 6px 10px;
	  background: #4bd19f;
	  color: #fff;
	  font-weight: 700;
	  margin-top: 14px;
	  display: inline-block !important;
	}
</style>

<div class="main">
	<div class="container">
		<div class="row m-0">
			<div class="col-sm-12">
				<div class="rightbar">
					<div class="container p-0">
						<div class="row">
							<div class="col-sm-9">
								<h2>Wishlist</h2>
							</div>
							<div class="col-sm-3 text-end">
								<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="prdt_new pt-0">
						<div class="tab-container-one">
							<div class="row m-0 mt-5 filter_dataa">
								<?php  foreach ($wishlistArray as $key => $value) { ?>
									<?php  	$product = $value->productRow; ?>
									<?php  	if($product->discount) { $discount = ($product->discount / 100) * $product->price; $discountAmt = round($product->price - $discount); }
								          	   ?>

								    <div class="col-6 col-sm-3">
					          			<div class="pdt_box">
					          				<div class="pdt_inner">
					          				    <?php if($product->discount) { ?>
					            				    <span class="product-top"><?= ($product->discount)?"($product->discount% OFF)":"" ?></span>
					            				<?php } ?> 
					            				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$product->image ?>" class="img-fluid">
					            				<div class="prd_title text-center">
					            					<h4><a href="<?= base_url('product-detail/').$product->slug ?>"><?= mb_strimwidth($product->product_name,0,20, '....') ?></a></h4>
					            				</div>
					            				<a href="<?= base_url('product-detail/').$product->slug ?>" class="link-cart">Quick View</a>
					            			</div>
					          				<div class="prd_price">
					          				        <?php if($product->discount) { ?>
					          				            <span><?= $this->site->currency.' '.number_format($discountAmt) ?></span> <del><?= $this->site->currency.''.number_format($product->price) ?></del>
					          				        <?php }else { ?>
					          				            <span><?= $this->site->currency.' '.number_format($product->price) ?></span> 
					          				        <?php } ?>
					          				</div>
					          				<button type="button" class="btn btn-price"><a class="text-white" href="<?= base_url('product-detail/').$product->slug ?>">Details</a></button>
					          				<!--<button type="button" class="btn btn-price">Customize</button> <button type="button" class="btn btn-price">Hire</button>-->
					          			</div>
					          		</div>
					          		<!-- <div class="col-6 col-sm-4">
					          			<div class="products_lst">
				          				 	<a href="<?= base_url('product-detail/').$product->slug ?>" class="link-cart">
					            				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$product->image ?>" class="img-fluid wishlist_image">
				            				</a>
					            			<div class="title_data">
					            				<div class="prd_title text-center">
					            					<p><?= mb_strimwidth($product->product_name,0,20, '....') ?> </p>
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
					          		</div> -->
							    <?php  	} ?>
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