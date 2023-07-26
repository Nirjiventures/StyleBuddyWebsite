<div class="banner_inner">
	<div class="container">
		<h1><?= $productDetails->product_name ?></h1>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Shop', base_url('shop'));
		?>
		<?php $aaaa = array(); ?>

		<?php foreach ($catRecords as $key => $value) { ?>

			<?php 

				$ab = array();

				$ab['id'] = $value['id'];

				$ab['slug'] = $value['slug'];

				$ab['name'] = $value['name'];

				$ab['label'] = 1;

				array_push($aaaa,$ab);

			?>

			<?php foreach ($value['child'] as $key1 => $value1) { ?>

				<?php 

					$ab = array();

					$ab['id'] = $value1['id'];

					$ab['slug'] = $value1['slug'];

					$ab['name'] = $value1['name'];

					$ab['label'] = 2;

					array_push($aaaa,$ab);

				?>

				<?php foreach ($value1['child'] as $key2 => $value2) { ?>

					<?php 

						$ab = array();

						$ab['id'] = $value2['id'];

						$ab['slug'] = $value2['slug'];

						$ab['name'] = $value2['name'];

						$ab['label'] = 3;

						array_push($aaaa,$ab);

					?>

				<?php } ?>

			<?php } ?>
		<?php } ?>
		<?php  array_multisort( array_column($aaaa, "label"), SORT_DESC, $aaaa ); ?>
		<?php 
			foreach ($aaaa as $key => $value) { 
				$this->breadcrumb->add($value['name'], base_url('shop/'.$value['slug'].'?catid='.$value['id']));
			}
		?>
		<?php  	$this->breadcrumb->add($productDetails->product_name, base_url());?>		
		<?php 	echo $this->breadcrumb->output(); ?>
	</div>
</div>
<div class="body_contnet">
	<div class="container">
		<div class="row m-0">
			<div class="col-sm-8 p-0">
				<div class="my_pro_new">
					<section class="customer-logos5 slider">

					    <?php $img =  'assets/images/no-image.jpg';?>
	                    <?php if(!empty($productDetails->image ))  {?>
	                        <?php 
	                            $img1 =  'assets/images/product/'.$productDetails->image ; 
	                            if (file_exists($img1)) {
	                                $img = $img1;
	                            }
	                        ?>
	                    <?php } ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">
                        <?php if(!empty($gallary)) { foreach($gallary as $gallari) { ?> 

				            <?php $img =  'assets/images/no-image.jpg';?>
		                    <?php if(!empty($gallari->gallery_image))  {?>
		                        <?php 
		                            $img1 =  'assets/images/gallery/'.$gallari->gallery_image; 
		                            if (file_exists($img1)) {
		                                $img = $img1;
		                            }
		                        ?>
		                    <?php } ?>

				            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">
				        <?php } } ?>

				      

				     </section>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="shop_pro2">
					<div class="title_pp1">
						<div class="cebter_new">

							<small>Designer by: <?= strtoupper($productDetails->boutique_fname.' '.$productDetails->boutique_lname) ?></small>



							<h1><?= $productDetails->product_name ?></h1>

							

							<?php $review = $productDetails->review;?>

							<div class="hidden_star_pointer ratingss my_star">

								<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>

							</div>

							<div class="pasia">
								<?php 

									$discount = '0'; 

									$discountAmt = '0'; 

									$saleAmt = $productDetails->price; 

									if($productDetails->discount) {

									 	$discount = ($productDetails->discount / 100) * $productDetails->price; 

									 	$discountAmt = ($productDetails->discount / 100) * $productDetails->price; 

									 	$saleAmt = round($productDetails->price - $discount); 

									} 
								?>
							    <?php if($productDetails->discount) { ?>	
								    <div class="price_new"><b><span><del><?= $this->site->currency.' '.$productDetails->price ?></del></span>&nbsp;<?= $this->site->currency.' '.$saleAmt ?></b> <small>(<?= $productDetails->discount ?>% OFF)</small></div>
								<?php } else { ?>
									<div class="price_new"><b><?= $this->site->currency.' '.$productDetails->price ?></b></div>
								<?php } ?>

								<small>Price inclusive of all taxes</small>
								<div class="heart_wish">

									<?php if($productDetails->wishListStatus){$wishClass = 'fa-heart';}else{$wishClass = 'fa-heart-o';}?>

									<?php if($this->session->userdata('userId')){ ?>

											<a style="cursor: pointer;"  class="btn_wish" data-venderid="<?= $productDetails->vender_id ?>" data-catid="<?= $productDetails->cat_id ?>" data-id="<?= $productDetails->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $productDetails->id ?>"  class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

									<?php }else{ ?>

										

										<a href="<?php echo base_url('login')?>"  class="btn_wish" data-venderid="<?= $productDetails->vender_id ?>" data-catid="<?= $productDetails->cat_id ?>" data-id="<?= $productDetails->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i  id="btn_wish_<?= $productDetails->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

									<?php }?>
								</div>
							</div>
						</div>
						<hr>
                        <?php if(!empty($sizes)) { ?>
    						<div class="swatches">
    							<div class="row m-0">
    								<div class="col-6 col-sm-6 p-0">Select Size</div>
    								<div class="col-6 col-sm-6"><div class="size_g"><a href="" data-bs-toggle="modal" data-bs-target="#size_guide" ><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/scale.jpg"> Size Guide</a></div></div>
    							</div>
    						    <div id="size-err"></div>
    			               	<div class="swatch clearfix" data-option-index="0">
	    			                <?php if(!empty($sizes)) { foreach($sizes as $size)  { ?> 
	    			                  	<div data-value="S" class="swatch-element plain s available">
	    			                    	<input id="swatch-0-<?= $size->size_name ?>" type="radio" name="size" value="<?= $size->size_name ?>" />
		    			                    <label for="swatch-0-<?= $size->size_name ?>">
		    			                      	<?= $size->size_name ?>
		    			                    </label>
	    			                  	</div>
	    			                <?php }} ?>
    			              	</div>
    			            </div>
						<?php } ?>
						<?php if(!empty($colors)) { ?>
    						<hr>
                        	<div class="swatches">
                        		<div class="row m-0">
    								<div class="col-6 col-sm-6 p-0">Select Color</div>
    							</div>
    							<div id="color-err"></div>
    			               	<div class="swatch clearfix" data-option-index="0">
	    			                <?php if(!empty($colors)) { foreach($colors as $size)  { ?> 
	    			                  	<div data-value="S" class="swatch-element plain s available"  style="background-color: <?= $size->code ?>;">
	    			                    	<input id="swatch-0-<?= $size->name ?>" type="radio" name="color" value="<?= $size->name ?>" />
		    			                    <label for="swatch-0-<?= $size->name ?>" title="<?= $size->name?>">
		    			                    </label>
	    			                  	</div>
	    			                <?php }} ?>
    			              	</div>
    			            </div>
						<?php } ?>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="adc">
									<div class="num-block skin-2">
										<div class="num-in">
											<span class="minus dis"></span>
											<input type="text" class="in-num" name="qtybutton" value="1" readonly="">
											<span class="plus"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 mt-2 mb-2">
								<div class="col-sm-12 text-center">

									<?php if($this->session->userdata('userId') && $this->session->userdata('userId')  == $productDetails->user_id){ ?>

										<a class="cart2 action_bt_2 " id="cartDetail" href="#" title="You can not add this product into cart" data-discountprice="<?= ($discountAmt)?$discountAmt:'' ?>" data-discount="<?= ($productDetails->discount)?$productDetails->discount:'' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $productDetails->price ?>" data-venderid="<?= $productDetails->vender_id ?>" data-product_id="<?= $productDetails->id ?>"  data-catid="<?= $productDetails->cat_id ?>" data-image="<?= $productDetails->image ?>" data-id="<?= $productDetails->id ?>" data-name="<?= str_replace('-',' ',$productDetails->slug) ?>"  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Own Product</a>

									<?php }else{ ?>

									

										<a class="cart2 action_bt_2 add_new_b" id="cartDetail" href="#" title="Add to cart"  data-sizearray="<?= ($sizes)?$sizes:'none' ?>" data-colorarray="<?= ($colors)?$colors:'none' ?>" data-discountprice="<?= ($discountAmt)?$discountAmt:'' ?>" data-discount="<?= ($productDetails->discount)?$productDetails->discount:'' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $productDetails->price ?>" data-venderid="<?= $productDetails->vender_id ?>" data-catid="<?= $productDetails->cat_id ?>" data-image="<?= $productDetails->image ?>" data-id="<?= $productDetails->id ?>" data-name="<?= str_replace('-',' ',$productDetails->slug) ?>"  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Add to Bag</a>

									<?php } ?>

								</div>
							</div>
							<div class="soical_m mt-1">

						        <p class="mb-0">Share At: </p>

						        <!--<div class="fb-share-button" 

	                            data-href="<?=current_url()?>" 

	                            data-layout="button_count">

	                            </div>-->



						        <a class="facebook-share-button" target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>">

						            <i class="fa fa-facebook" aria-hidden="true"></i>

						        </a>

						        <a class="twitter-share-button" target="_blank" rel="noopener noreferrer" href="https://twitter.com/intent/tweet?url=<?=current_url()?>">

						            <i class="fa fa-twitter" aria-hidden="true"></i>

						        </a>

						        <a href="https://www.instagram.com/?url=<?=current_url()?>" target="_blank" rel="noopener">

	                                <i class="fa fa-instagram"></i>

	                            </a>


						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row mt-5 m-0">
    		<div class="col-sm-12 pd_tabs">

    			<ul class="nav nav-tabs dis_shot" role="tablist">

    			    <li class="nav-item">

    			      <a class="nav-link active" data-bs-toggle="tab" href="#home">Description</a>

    			    </li>

    			    <li class="nav-item">

    			      <a class="nav-link" data-bs-toggle="tab" href="#menu1">Reviews</a>

    			    </li>

    			</ul>

    

    			<div class="tab-content">

    			    <div id="home" class="tab-pane active pt-4">

    			        <?= $productDetails->description ?>

    			      

    			    </div>

    			    <div id="menu1" class="tab-pane pt-4">

    			    	<div class="row">

    			    		<div class="col-sm-8 r_list ">

    			    	            <?php 	$reviews = $productDetails->reviews;?>

					    			<?php 	foreach ($reviews as $key => $value) { ?>

					    				<div class="d-flex">

					    					<div class="flex-shrink-0">

										       <?php echo ucfirst(substr($value['name'],0,1));?>

										    </div>

										    <div class="flex-grow-1 ms-3">

										        <div class="name_title"> <?php echo ucfirst( $value['name']);?> <small class="text-muted"> <?php echo date('M d, Y',strtotime($value['created_at']));?></small></div>

										        <div class="hidden_star_pointer ratingss">

													<input value="<?=$value['rating']?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>

												</div>

										        <?php echo $value['comment'];?>

										    </div>

										</div>

									<?php 	}?>

    			    		</div>

    			    		<div class="col-sm-4">

    			    			<div class="review_form new_feed">

    				    			<h4>Write a Review</h4>

    				    			<hr>

    				    			<div class="row review_post mt-1 my_star">

										<div class="clearfix"></div>

										<div id="reviewList"></div>

						                <input type="hidden" id="product_id" value="<?=$productDetails->id?>">



					                    <input id="input-21f" value="5" type="hidden" class="rating" data-min=0 data-max=5 data-step=0.2 data-size="lg"  required title="">

					                    <?php if($this->session->userdata('loginUser')){ ?>

					                    	    <input type="hidden" name="review_name" id="review_name"  value="<?=$this->session->userdata('loginUser')?>">

											   	<input type="hidden" name="review_email" id="review_email" value="<?=$this->session->userdata('email')?>">



											   	<div class="col-sm-6">

						    						<div class="mb-2 mt-0">

													    <label for="text" class="form-label">Enter Name</label>

													    <input type="Text" disabled class="form-control" placeholder="Enter name" value="<?=$this->session->userdata('loginUser')?>">

													</div>

						    					</div>

						    					<div class="col-sm-6">

						    						<div class="mb-2 mt-0">

						    							<label for="text" class="form-label">Enter Email</label>

							    						<input disabled type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">

							    					</div>

						    					</div>



					                    <?php }else{ ?>	

					                    	<div class="col-sm-6">

					    						<div class="mb-2 mt-0">

												    <label for="text" class="form-label">Enter Name</label>

												    <input type="Text" class="form-control" id="review_name" placeholder="Enter name" name="review_name" value="<?=$this->session->userdata('loginUser')?>">

												</div>

					    					</div>

					    					<div class="col-sm-6">

					    						<div class="mb-2 mt-0">

					    							<label for="text" class="form-label">Enter Email</label>

						    						<input name="email" id="review_email" type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">

						    					</div>

					    					</div>

					                    <?php } ?>	

					                    



				    					<div class="col-sm-12">

				    						<div class="mb-2 mt-1">

											    <label for="comment" class="mb-2">Comments</label>

												<textarea class="form-control" rows="5" id="review_comment" name="text"></textarea>

											  </div>

				    					</div>

					                     

					                    <div> 

					                   		<input name="submit" type="submit" value="Submit" id="send_product_review" class="btn btn-dark ls-n-15">

					                   	</div>

					                </div>

    				    			 

    				    		</div>

    			    		</div>

    			    	</div>

    			    </div>

    			</div>
    		</div>
		</div>
	</div>
</div>
<section class="prdt_new pt-0">
	<div class="container">
		<div class="row">

			<div class="col-sm-12 text-center mb-3">

				<h2>You May Also Like</h2>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="tab-container-one">
		          	<div class="row">
		          	    <?php if(!empty($relatedProducts)) { ?>
		          	    	<?php foreach($relatedProducts as $product) {  ?>
		          		 			<?php $gallary = $this->db->get_where('product_galary',['product_id'=> $product->id ])->result(); ?>
					          	  	<div class="col-6 col-sm-3">
					          	  		<?php $product->gallary = $gallary; ?>
					          	  		<?php $product->site_currency = $this->site->currency; ?>
					          			<?=product_div($product);?>
					          		</div>
		          			<?php } ?>
		          		<?php } ?>
		          	</div>
        		</div>
			</div>
		</div>
	</div>
</section>