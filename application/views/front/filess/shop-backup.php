<?php  $this->load->view('Page/template/header'); ?>
<?php //print_r($catLists[0]->name); ?>
<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Shop</h3></div>
	</div>
</div>

<div class="middle_part">
	<div class="container shop">
		<div class="row">
			<div class="col-sm-3 search_sidebar">
				<div class="filter">
					Filter <span><a href="#">Clear All</a></span>
				</div>

				<div class="accordion" id="accordionPanelsStayOpenExample">
					<div class="accordion-item">
						<div class="accordion-body">
				        	<form>
					            <div class="form-group"> <input type="checkbox" class="common_selector gender" value="1" id="d1"> <label for="d1"> Men </label> </div>
					            <div class="form-group"> <input type="checkbox" class="common_selector gender" value="2" id="d2"> <label for="d2"> Women</label> </div>
					        </form>
				      </div>
					</div>
				  <div class="accordion-item">
				    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
				      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
				        Categories
				      </button>
				    </h2>
				    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
				      <div class="accordion-body">
				        	
					          <?php if($catLists) { foreach($catLists as $catList)  { ?>
					            <div class="form-group"> <input type="checkbox" class="common_selector cat_id" id="a1" value="<?= $catList->id ?>" > <label for="a1"> <?= $catList->name ?> </label> </div>
					          <?php } } ?>
					        
				      </div>
				    </div>
				  </div>
				  <!--<div class="accordion-item">-->
				  <!--  <h2 class="accordion-header" id="panelsStayOpen-headingTwo">-->
				  <!--    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">-->
				  <!--      Filter By Price-->
				  <!--    </button>-->
				  <!--  </h2>-->
				  <!--  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">-->
				  <!--    <div class="accordion-body">-->
				  <!--      <form>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="b1"> <label for="b1"> 0-100$</label> </div>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="b2"> <label for="b2"> 100$-150$</label> </div>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="b3"> <label for="b3"> 150$-250$</label> </div>-->
				  <!--      </form>-->
				  <!--    </div>-->
				  <!--  </div>-->
				  <!--</div>-->
				  <!--<div class="accordion-item">-->
				  <!--  <h2 class="accordion-header" id="panelsStayOpen-headingThree">-->
				  <!--    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">-->
				  <!--      Top Offers-->
				  <!--    </button>-->
				  <!--  </h2>-->
				  <!--  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">-->
				  <!--    <div class="accordion-body">-->
				  <!--      <form>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="c1"> <label for="c1"> 10% OFF & ABOVE</label> </div>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="c2"> <label for="c2"> 25% OFF & ABOVE</label> </div>-->
				  <!--          <div class="form-group"> <input type="checkbox" id="c3"> <label for="c3"> 30% OFF & ABOVE</label> </div>-->
				  <!--      </form>-->
				  <!--    </div>-->
				  <!--  </div>-->
				  <!--</div>-->
				  
				</div>
				
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-7">
					</div>
					<div class="col-sm-5 text-end">
						<div class="sele_cate">
							   <select class="cate_box" id="cat_box">
								<option  value="">Sort By : Recommended</option>
								<option  value="desc">Price High to Low</option>
								<option  value="asc">Price Low to High</option>
							   </select>
						</div>
					</div>
				</div>
				<div class="prdt_new pt-0">
					<div class="tab-container-one">
			          	<div class="row filter_dataa">
			          	    
			          	 <?php if(!empty($products))  { foreach($products as $product) { 
			          	     
			          	       if($product->discount) { $discount = ($product->discount / 100) * $product->price; $discountAmt = round($product->price - $discount); }
			          	   ?>
			          	 
			          		<div class="col-6 col-sm-4">
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
			          				<button type="button" class="btn btn-price"><a class="text-white" href="<?= base_url('product-detail/').$product->slug ?>">Buy Now</a></button>
			          				<!--<button type="button" class="btn btn-price">Customize</button> <button type="button" class="btn btn-price">Hire</button>-->
			          			</div>
			          		</div>
			          		
			          	<?php } } ?>	
                        
			          	</div>

			          	<div class="row mt-5">
			          		<div class="col-sm-12">
			          		    <div id="pagination_link"></div>
			     				<?php echo $this->pagination->create_links(); ?>
			          		</div>
			          	</div>
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php $this->load->view('Page/template/footer'); ?>