<?php  $this->load->view('Page/template/header'); ?>



<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/lightbox.css">


<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<script src="<?= base_url() ?>assets/css/lightbox.js"></script>
 

<div class="body_contnet">

	

	<div class="container">

		<div class="row m-0">

			<div class="col-sm-12">

				<div class="heading_part">

					<div class="my_bedcum">

						<ul>

							<li><a href="<?=base_url()?>">Home</a> </li>

							<li><a href="<?=base_url('shop')?>">Shop</a> </li>

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

							<?php foreach ($aaaa as $key => $value) { ?>

								<li><a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>"><?=$value['name'];?></a> </li>

							<?php } ?>		

						</ul>

					</div>

					

				</div>

			</div>

		</div>

		<div class="row m-0">

		

			<div class="col-sm-8 p-0">

				

				<div class="my_pro_new">

					

					<section class="customer-logos5 slider">

					    <?php $img = 'assets/images/product/'.$productDetails->image ?>

					    <!--<a class="example-image-link" href="<?=base_url('resize_image.php?new_width=900&new_height=900&image='.$img);?>" data-lightbox="example-2">-->
					        
					    <!--<a class="example-image-link" href="<?=base_url('resize_image.php?new_width=900&new_height=900&image='.$img);?>">-->
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">
					   <!-- </a>
					    -->

                        <?php if(!empty($gallary)) { foreach($gallary as $gallari) { ?> 

				            <?php $img = 'assets/images/gallery/'.$gallari->gallery_image ?>

				           <!-- <a class="example-image-link" href="<?=base_url('resize_image.php?new_width=900&new_height=900&image='.$img);?>">-->
				            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">
				            <!--</a>-->

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

							<div class="hidden_star_pointer ratingss">

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

											<a href="#"  class="btn_wish" data-venderid="<?= $productDetails->vender_id ?>" data-catid="<?= $productDetails->cat_id ?>" data-id="<?= $productDetails->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $productDetails->id ?>"  class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

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

    								<div class="col-6 col-sm-6">Select Size</div>

    								<div class="col-6 col-sm-6"><div class="size_g"><a href="" data-bs-toggle="modal" data-bs-target="#size_guide" ><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/scale.jpg"> Size Guide</a></div></div>

    							</div>

    

    						     <div id="size-err"></div>

    			               	 <div class="swatch clearfix" data-option-index="0">

    			                  

       

    			                 <?php if(!empty($sizes)) { foreach($sizes as $size)  { ?> 

    			                  <div data-value="S" class="swatch-element plain s available">

    			                    <input id="swatch-0-<?= $size->size_name ?>" type="radio" name="size" value="<?= $size->size_name ?>" />

    			                    <label for="swatch-0-<?= $size->size_name ?>">

    			                      <?= $size->size_name ?>

    			                      <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />

    			                    </label>

    			                    

    			                  </div>

    			                  <?php }} ?>

    			             

    			              	</div>    

    			             </div>

						<?php } ?>

						<div class="row">

							<div class="adc">

								<div class="num-block skin-2">

									<div class="num-in">

										<span class="minus dis"></span>

										<input type="text" class="in-num" name="qtybutton" value="1" readonly="">

										<span class="plus"></span>

									</div>

								</div>

							</div>

						

							<div class="col-sm-12 full_b">

								<?php if($this->session->userdata('userId') && $this->session->userdata('userId')  == $productDetails->user_id){ ?>

									<a class="cart2 btn2 " id="cartDetail" href="#" title="You can not add this product into cart" data-discountprice="<?= ($discountAmt)?$discountAmt:'' ?>" data-discount="<?= ($productDetails->discount)?$productDetails->discount:'' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $productDetails->price ?>" data-venderid="<?= $productDetails->vender_id ?>" data-product_id="<?= $productDetails->id ?>"  data-catid="<?= $productDetails->cat_id ?>" data-image="<?= $productDetails->image ?>" data-id="<?= $productDetails->id ?>" data-name="<?= str_replace('-',' ',$productDetails->slug) ?>"  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Own Product</a>

								<?php }else{ ?>

								

									<a class="cart2 btn2 add_new_b" id="cartDetail" href="#" title="Add to cart"  data-sizearray="<?= ($sizes)?$sizes:'none' ?>" data-discountprice="<?= ($discountAmt)?$discountAmt:'' ?>" data-discount="<?= ($productDetails->discount)?$productDetails->discount:'' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $productDetails->price ?>" data-venderid="<?= $productDetails->vender_id ?>" data-catid="<?= $productDetails->cat_id ?>" data-image="<?= $productDetails->image ?>" data-id="<?= $productDetails->id ?>" data-name="<?= str_replace('-',' ',$productDetails->slug) ?>"  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Add to Bag</a>

								<?php } ?>



                                



									

									

							</div>



								



						</div>



						<!--<hr>-->

						<div class="row">

							<div class="col-sm-12">

								<p></p>

							</div>

						</div>

						

						<div class="social-links">

					        <p>Share At: </p>

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

					        <!--<a href="<?= current_url(); ?>">

					          <i class="fa fa-facebook"></i>

					        </a>

					        <a href="<?= current_url(); ?>">

					          <i class="fa fa-twitter"></i>

					        </a>

					        <a href="<?= current_url(); ?>">

					          <i class="fa fa-instagram"></i>

					        </a>

					        <a href="<?= current_url(); ?>">

					          <i class="fa fa-whatsapp"></i>

					        </a>

					        <a href="<?= current_url(); ?>">

					          <i class="fa fa-pinterest"></i>

					        </a>-->

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

    				    			<div class="row review_post mt-1">

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

					                   		<input name="submit" type="submit" value="Submit" id="send_review" class="btn btn-dark ls-n-15">

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

          	    

          	    <?php if(!empty($relatedProducts)) { foreach($relatedProducts as $product) { 

          	            $discount = '0'; 

						$discountAmt = '0'; 

						$saleAmt = $product->price; 

	          	       	if($product->discount) { 

	          	       		$discount = ($product->discount / 100) * $product->price; 

	          	       		$saleAmt = round($product->price - $discount); 

	          	       		$discountAmt = round($discount); 

	          	       	}

	          	       	$productUrl  =  base_url('shop/'.$product->category_slug.'/'.$product->slug);

          	    ?>

          		<div class="col-6 col-sm-3">

	          			<div class="new_pro_data">

	          				<div class="pro_photo_pp">

	          				    <?php if($product->discount) { ?>

	            				    <div class='ribbon-wrapper-3'>

      									<div class='ribbon-3'><?= ($product->discount)?"($product->discount% OFF)":"" ?></div>

   									</div>

	            				<?php } ?>

	            				<div class="my_wish_l"> 

            					<?php if($product->wishListStatus){$wishClass = 'fa-heart';}else{$wishClass = 'fa-heart-o';}?>

								<?php if($this->session->userdata('userId')){ ?>

										<a href="#"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

								<?php }else{ ?>

									

									<a href="<?php echo base_url('login')?>"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

								<?php }?>



	            				</div>

        						<a  href="<?= $productUrl?>">

        						    <?php $img = 'assets/images/product/'.$product->image ?>

            					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">

            					    

        						    

        						</a>

        						<?php $gallary = $this->db->get_where('product_galary',['product_id'=> $product->id ])->result();

        						?>

        						<?php $review = $product->review;?>

        						<div class="quick_shop"><a  onclick="openNav2()" class="link-cart sidenav_open" data-rating="<?=number_format($review->rating,1)?>" data-designby="<?= strtoupper($product->fname.' '.$product->lname) ?>" data-gallaryimage='<?= ($gallary)?json_encode($gallary):json_encode(array()) ?>' data-discountprice="<?= ($discountAmt)?$discountAmt:'0' ?>" data-discount="<?= ($product->discount)?$product->discount:'0' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $product->price ?>" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-image="<?= $product->image ?>" data-id="<?= $product->id ?>" data-name="<?= $product->product_name ?>" data-slug="<?= $product->slug ?>" data-seeFullUrl="<?= $productUrl ?>" data-sizes='<?= json_encode($product->sizesArray) ?>'><i class="fa fa-shopping-bag" aria-hidden="true"></i> Quick Shop</a></div>

            				</div>



            				<div class="prd_title_new">

            					<h4><a href="<?=$productUrl ?>"><?= mb_strimwidth($product->product_name,0,30, '....') ?></a></h4>

            				</div>



            				



        					<?php if(!empty($product->sizesArray)) { ?>

        					<div class="size_pp">Size : 

        					<?php foreach($product->sizesArray as $size)  { ?> 

			                    <span for="swatch-0-<?= $size->size_name ?>">

			                      <?= $size->size_name ?>

			                    </sapn>

			                <?php } ?>

			                </div>

			                <?php } ?>



            				



          					<div class="prd_price">

          				        <?php if($product->discount) { ?>

          				            <span><?= $this->site->currency.' '.number_format($saleAmt) ?></span> <del><?= $this->site->currency.''.number_format($product->price) ?></del>

          				        <?php }else { ?>

          				            <span><?= $this->site->currency.' '.number_format($product->price) ?></span> 

          				        <?php } ?>

          					</div>



	          				

	          			</div>

	          		</div>

          		<?php } } ?>

          	</div>



        </div>

			</div>

		</div>



	</div>

</section>



<!-- The Modal -->

<div class="modal" id="size_guide">

    <div class="modal-dialog modal-dialog-centered modal-lg">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title">Size Guide</h4>

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

          

        	<div class="chrt-box" id="style-3">

               <ul class="nav nav-pills" role="tablist">

                    <li class="nav-item">

                      <a class="nav-link active" data-bs-toggle="pill" href="#women_inch">Inch</a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-bs-toggle="pill" href="#women_cm">CM</a>

                    </li>

                </ul>

                <div class="tab-content">

                    <div id="women_inch" class="tab-pane active">

                      <p>We have provided the body measurement to help you decide which size to buy. For dresses, tops, uppers, kurtas etc.</p>

                      <div class="table-responsive">

                          <table class="table table-light border text-center table-striped">

                            <thead>

                              <tr>

                                <th>Size </th>

                                <th>Bust </th>

                                <th>Waist </th>

                                <th>Hip </th>

                                <th>US SIZE</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td>XS</td>

                                <td>30-32 </td>

                                <td>24-26</td>

                                <td>33-35</td>

                                <td>XS(0-2)</td>

                              </tr>

                              <tr>

                                <td>S</td>

                                <td>32-35</td>

                                <td>26-38</td>

                                <td>36-38</td>

                                <td>S(4-6)</td>

                              </tr>

                              <tr>

                                <td>M</td>

                                <td>35-37</td>

                                <td>28-31</td>

                                <td>38-40</td>

                                <td>M(8-10)</td>

                              </tr>

                              <tr>

                                <td>L</td>

                                <td>37-40</td>

                                <td>31-34</td>

                                <td>40-43</td>

                                <td>L(12-14)</td>

                              </tr>

                              <tr>

                                <td>XL</td>

                                <td>40-44</td>

                                <td>34-38</td>

                                <td>43-47</td>

                                <td>XL(16-18)</td>

                              </tr>

                              <tr>

                                <td>2XL</td>

                                <td>44-47</td>

                                <td>38-42</td>

                                <td>47-50</td>

                                <td>XXL(20-22)</td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                        <div class="text-center">

                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/size.png">

                        </div>

                        <div class="sp-box">

                            <h6>1. Bust</h6>

                            <p>Measure under your arms around the fullest and widest point of your bust. Stay horizontal, all around your body.</p>

                        </div>

                        <div class="sp-box">

                            <h6>2. Waist</h6>

                            <p>Make sure the measuring tape fits comfortably as you measure around the narrowest point of your body, higher than belly and below your ribcage.</p>

                        </div>

                        <div class="sp-box">

                            <h6>3. Hips</h6>

                            <p> Measure around the widest part of your hips, make sure to stay with your feet together with level of crotch area.</p>

                        </div>

                    </div>

                    <div id="women_cm" class="tab-pane fade">

                      <p>We have provided the body measurement to help you decide which size to buy. For dresses, tops, uppers, kurtas etc.</p>

                      <div class="table-responsive">

                          <table class="table table-light border text-center table-striped">

                            <thead>

                              <tr>

                                <th>Size </th>

                                <th>Bust </th>

                                <th>Waist </th>

                                <th>Hip </th>

                                <th>US SIZE</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td>XS</td>

                                <td>81.3</td>

                                <td>66</td>

                                <td>91.4</td>

                                <td>XS(0-2)</td>

                              </tr>

                              <tr>

                                <td>S</td>

                                <td>86.4</td>

                                <td>71.1</td>

                                <td>96.5</td>

                                <td>S(4-6)</td>

                              </tr>

                              <tr>

                                <td>M</td>

                                <td>91.4</td>

                                <td>76.2</td>

                                <td>101.6</td>

                                <td>M(8-10)</td>

                              </tr>

                              <tr>

                                <td>L</td>

                                <td>96.5</td>

                                <td>81.3</td>

                                <td>106.7</td>

                                <td>L(12-14)</td>

                              </tr>

                              <tr>

                                <td>XL</td>

                                <td>101.6</td>

                                <td>86.4</td>

                                <td>111.8</td>

                                <td>XL(16-18)</td>

                              </tr>

                              <tr>

                                <td>2XL</td>

                                <td>106.7</td>

                                <td>91.4</td>

                                <td>116.8</td>

                                <td>XXL(20-22)</td>

                              </tr>

                              <tr>

                                <td>3XL</td>

                                <td>111.8</td>

                                <td>96.5</td>

                                <td>121.9</td>

                                <td>&nbsp;</td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                        <div class="text-center">

                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/size.png">

                        </div>

                        <div class="sp-box">

                            <h6>1. Bust</h6>

                            <p>Measure under your arms around the fullest and widest point of your bust. Stay horizontal, all around your body.</p>

                        </div>

                        <div class="sp-box">

                            <h6>2. Waist</h6>

                            <p>Make sure the measuring tape fits comfortably as you measure around the narrowest point of your body, higher than belly and below your ribcage.</p>

                        </div>

                        <div class="sp-box">

                            <h6>3. Hips</h6>

                            <p> Measure around the widest part of your hips, make sure to stay with your feet together with level of crotch area.</p>

                        </div>

                    </div>

                </div> 

            </div>



        </div>

        

       

      </div>

    </div>

  </div>





<script>

    

    //$('.show').zoomImage();

    

    var base_url = '<?=base_url()?>';

    

    

    

    $('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})

    

    $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')

    

    

    

    

    

    

    

    var small_img_roll_1 = 5;

    

    var small_img_roll_2 = 4;

    

    var small_img_roll_3 = 3;

    

    var small_img_roll_4 = 5;

    

    

    

    $('.show-small-img').click(function () {

    

      $('#show-img').attr('src', $(this).attr('src'))

    

      $('#big-img').attr('src', $(this).attr('src'))

    

      $(this).attr('alt', 'now').siblings().removeAttr('alt')

    

      $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})

    

      if ($('#small-img-roll').children().length > small_img_roll_1) {

    

        if ($(this).index() >= small_img_roll_2 && $(this).index() < $('#small-img-roll').children().length - 1){

    

          $('#small-img-roll').css('left', -($(this).index() - small_img_roll_3) * 76 + 'px')

    

        } else if ($(this).index() == $('#small-img-roll').children().length - 1) {

    

          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')

    

        } else {

    

          $('#small-img-roll').css('left', '0')

    

        }

    

      }

    

    })

    

    

    

     

    

    $('#next-img').click(function (){

    

      $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))

    

      $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))

    

      $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})

    

      $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')

    

      if ($('#small-img-roll').children().length > small_img_roll_1) {

    

        if ($(".show-small-img[alt='now']").index() >= small_img_roll_2 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){

    

          $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - small_img_roll_3) * 76 + 'px')

    

        } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {

    

          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')

    

        } else {

    

          $('#small-img-roll').css('left', '0')

    

        }

    

      }

    

    })

    

    

    

     

    

    $('#prev-img').click(function (){

    

      $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))

    

      $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))

    

      $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})

    

      $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')

    

      if ($('#small-img-roll').children().length > small_img_roll_1) {

    

        if ($(".show-small-img[alt='now']").index() >= small_img_roll_2 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){

    

          $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - small_img_roll_3) * 76 + 'px')

    

        } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {

    

          $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')

    

        } else {

    

          $('#small-img-roll').css('left', '0')

    

        }

    

      }

    

    })



</script>







<script type="text/javascript">



 	$(document).ready(function() {



        $("[rel=tooltip]").tooltip();



        $('#showmenu').click(function() {



                $('.review_post').slideToggle("fast");



        });



        $("#input-21f").rating({



            starCaptions: function (val) {



                if (val < 3) {



                    return val;



                } else {



                    return 'high';



                }



            },



            starCaptionClasses: function (val) {



                if (val < 3) {



                    return 'label label-danger';



                } else {



                    return 'label label-success';



                }



            },



            hoverOnClear: false



        });



        var $inp = $('#rating-input');







        $inp.rating({



            min: 0,



            max: 5,



            step: 1,



            size: 'lg',



            showClear: false



        });







        $('#btn-rating-input').on('click', function () {



            $inp.rating('refresh', {



                showClear: true,



                disabled: !$inp.attr('disabled')



            });



        });











        $('.btn-danger').on('click', function () {



            $("#kartik").rating('destroy');



        });







        $('.btn-success').on('click', function () {



            $("#kartik").rating('create');



        });







        $inp.on('rating.change', function () {



            alert($('#rating-input').val());



        });











        $('.rb-rating').rating({



            'showCaption': true,



            'stars': '3',



            'min': '0',



            'max': '3',



            'step': '1',



            'size': 'xs',



            'starCaptions': {0: 'status:nix', 1: 'status:wackelt', 2: 'status:geht', 3: 'status:laeuft'}



        });



        $("#input-21c").rating({



            min: 0, max: 8, step: 0.5, size: "xl", stars: "8"



        });



    });







	$('#send_review').on('click', function (e) {



        var base_url = "<?php echo base_url(); ?>";







        var rating = $('#input-21f').val();



        var id = $('#product_id').val();



        var name = $('#review_name').val();



        var email = $('#review_email').val();



        var title = $('#review_title').val();



        var comment = $('#review_comment').val();



        







       



        



        if (name == '') {



            $('#review_name').focus();



            return;



        }else if (email == '') {



            $('#review_email').focus();



            return;



        }else if(!IsEmail(email)) {



            $('#review_email').focus();



            return;



        }else if (comment == '') {



            $('#review_comment').focus();



            return;



        }



        $.ajax({



            url: base_url + 'page/product_review',



            type: "POST",



            data: {id:id,name:name,email:email,title:title,comment:comment,rating:rating},



            success: function (res) {



            	console.log(res)



                $('#reviewList').html(res);



	            window.setTimeout(function(){location.reload()},2000)



            }



        })



    });



    function IsEmail(email) {     



        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       



        return regex.test(email);   



    }



    



    



    



    



    $(document).ready(function() {



    







    $('#state').on('change',function(){



      var state_id = $(this).val();



      if(state_id) {



          $.ajax({



                type:'POST',



                url:base_url+'city-data',



                data:'state_id='+state_id,



                success:function(html){



                    $('#city').html(html);



                }



            }); 



      } else {



          $('#city').html('<option value="">Select state first</option>');



      } 



    });



    



    



    



   $('#contact-form').on('submit',function(e){



       //alert('test');



       e.preventDefault();



     var formData = new FormData(this);                                           



     $.ajax({   



        url: base_url+"form-process",         



        cache: false,



        dataType: "json",



        contentType: false,



        processData: false,



        data: formData,



        type: 'post',



        success: function(data){



              if(data.error) {



                  if(data.name_err !== '') {



                    $('#name_err').html(data.name_err);



                    } else {



                    $('#name_err').html('');



                    }



                    if(data.email_err !== '') {



                    $('#email_err').html(data.email_err);



                    } else {



                    $('#email_err').html('');



                    }



              }



              if(data.success){



                     $('#success_msg').html(data.success);



                     $('#success_msg').fadeOut(4000);



                     $('#name_err,#email_err').html('');



                     $('#contact-form')[0].reset();



                    }



             }



     });  



   });



      



   $('.cart2').on('click',function() {

       //alert(1);

        console.log($(this).data("price"));

        console.log($(this).data("discountprice"));

        

        

        let id = $(this).data("id");

        let qty = $("input[name='qtybutton']").val();

        let price = $(this).data("price");

        let mrpprice = $(this).data("mrpprice");

        let name = $(this).data("name");

        

        let image = $(this).data("image");

        let catId = $(this).data("catid");

        let discount = $(this).data("discount");

        let discountPrice = $(this).data("discountprice");

        let venderId = $(this).data("venderid");

        let size = $("input[name='size']:checked").val();

        let sizearray = $(this).data("sizearray");

        

        console.log('sizearray');

        if(sizearray == 'none'){

            

        }

        if (typeof size  === "undefined") {

            $('#size-err').html('<span class="text-danger">Please choose size</span>');

        } else {

            $('#size-err').html('');

            $('#size-err').delay(500).fadeOut('slow');

        }

        if (typeof size  !== "undefined" || sizearray == 'none') {

            let url =  base_url+"cart-process";

            $.ajax({

                url:url,

                type:"POST",

                dataType:"json",

                data:{id:id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size },
                success:function(data){
                    if(data.success) {
                    	console.log(data.rowCount);
                    	$('#add_to_bag_pop_up').attr("src",data.src);
                    	$('#cart_qty_span').attr("data-qty",data.rowCount);
                    	$('#cart_qty_span').html(data.rowCount);
                    	$('#cartModel').modal('show');
                    	setTimeout(function(){
                            $('#cartModel').modal('hide')
                        }, 5000);

                    	//window.location.reload();
                        //window.location.href = base_url+"cart";
                    }     
                }
            });   

        } else {

            // window.location.reload();

        }

       // console.log(size);

    });

   



   $('.btn_wish111').click(function() {



        let id = $(this).data("id");



        let catId = $(this).data("catid");



        let venderId = $(this).data("venderid");



        let loggedid = $(this).data("loggedid");



        console.log(id);



        console.log(catId);



        console.log(venderId);



        console.log(loggedid);



        console.log(base_url+"user/wishlistadd");



            $.ajax({



                 url:base_url+"user/wishlistadd",



                 type:"POST", 



                 //dataType:"json",



                 data:{id:id,catId:catId,venderId:venderId,loggedid:loggedid},



                 success:function(data){



                        console.log(data);



                        ss = $.parseJSON(data);



                        if(ss.status == 1) {



                            $('.btn_wish i').removeClass('fa-heart-o');



                            $('.btn_wish i').addClass('fa-heart');



                            //window.location.reload();



                        }else{



                            $('.btn_wish i').removeClass('fa-heart');



                            $('.btn_wish i').addClass('fa-heart-o'); 



                        }     



                   }



           });   



   });



    $('.removecart').click(function() {



	      console.log('removecart');



	      var row_id = $(this).attr("id");



	      //console.log(row_id);



          if(row_id) {



              $.ajax({



                url:"Page/cartRemove",



                method:"POST",



                data:{row_id:row_id},



                success:function(data){



                    $('#'+row_id).hide();



                   window.location.reload();



                }



              });



          }  



	  });



   



 	$('#booking-form').on('submit',function(e){



     e.preventDefault();



     console.log('booking-form');



     var formData = new FormData(this);                                           



     $.ajax({   



        url: "booking-process",         



        cache: false,



        dataType: "json",



        contentType: false,



        processData: false,



        data: formData,



        type: 'post',



        success: function(data) {



             if(data.status == true) {



                 window.location.href = data.redirect;



             }



        }



     });  



     



 });  







$('#titleDisplay').hide();



 



$('#expert').on('keyup',function(){



     var stylist = $(this).val();



        //console.log(stylist);



        if(stylist) {



        $.ajax({



            type: "POST",



            url: base_url+'stylistSearch',



            data: {'stylist':stylist }, 



            dataType: "html",



            success: function(msg) {



               // console.log(msg)



             $('#titleDisplay').show();



             $('#titleDisplay').html(msg);



            }



        });



     } else { $('#titleDisplay').hide();  } 



    });



}); // jQuery End



function selectTitle(val) {



    $("#expert").val(val);



    $("#titleDisplay").hide();



    document.getElementById('FormStylist').submit();



}







function updateproduct(rowid) {



     var qty = $('.qty'+rowid).val();



     var price = $('.price'+rowid).text();



    



    // console.log(price);console.log(qty);



     price =   price.replace('₹','');



     price =   price.replace(',','');



    // price  = (price.trim());



    // alert(price);



        $.ajax({



             url:"Page/cartUpdate",



            type:'POST',



            data:{rowid:rowid, qty:qty, price:price},



            success:function(res){

            	console.log(res);

                  //window.location.reload();



                  // setTimeout(function(){$('.min_cart').show(); },500); 



                 // $("#min_cart_data").modal({backdrop: 'static', keyboard: false });



            }



        });



     



     



}















</script>



<div id="mySidenav_shop" class="sidenav_shop">

    <div class="hello_sidebar">

  		<div class="row m-0">

  			<div class="col-sm-7 p-0">

  				<div class="pro_field" id="pro_field">

  					<?php if(!empty($gallary)) { foreach($gallary as $gallari) { ?> 

			        	<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/gallery/').$gallari->gallery_image ?> " class="img-fluid" alt=""></li>

			        <?php } } ?>

  				</div>

  			</div>

  			<div class="col-sm-5">

  				<div class="rtc">

  					<div class="pro_disi">

  					<div class="clcl">

  						<a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>

  					</div>



  					<small id="popUp_designby">Designer by: SHAGUN MEHTA</small>

  					<h4  id="popUp_productName">Baby Blue Co-Ord Set</h4>

  					<div class="price_side___"  id="popUp_producPrice">

  						<i class="fa fa-inr" aria-hidden="true"></i> <span></span>

  					</div>

  					<p>PRICE INCLUSIVE OF ALL TAXES</p>

  					<hr>

  					<div id="popUp_productSizeFull"  >

      					<p>Size </p>

    

      					<div class="swatches"  >

    					    <div id="size-err1"></div>

    		                <div class="swatch clearfix" data-option-index="0" id="popUp_productSize">

    		                  	 

    		                </div>

    					</div>

					</div>









				    <div class="cebter">

						<small>Rating</small>

						<?php $review = $productDetails->review;?>

						<div class="hidden_star_pointer ratingss">

							<input value="<?php echo $review->rating?>" type="hidden" class="rating"  id="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>

						</div>

					</div>





					<div class="adc">

						<div class="num-block skin-2">

							<div class="num-in">

								<span class="minus dis"></span>

								<input type="text" class="in-num" name="qtybutton1" value="1" readonly="">

								<span class="plus"></span>

							</div>

						</div>

					</div>



					<div class="add_to_bag" id="add_to_bag"><a href="#" id="cart1"class="cart1">Add to Bag</a></div>

					

					<p><a href="" class="see_full" id="see_full"><span>SEE FULL DETAILS</span></a></p>



  					</div>

  					<script type="text/javascript">

  						 $('#cart1').on('click',function() {

  					 		 let id = $(this).data("id");

					         let qty = $("input[name='qtybutton1']").val();

					         let price = $(this).data("price");

					         let mrpprice = $(this).data("mrpprice");

					         let name = $(this).data("name");

					         let product_id = $(this).data("product_id");

					         

					         let image = $(this).data("image");

					         let catId = $(this).data("catid");

					         let discount = $(this).data("discount");

					         let discountPrice = $(this).data("discountprice");

					         let venderId = $(this).data("venderid");

					         

					         

					         let size = $("input[name='size1']:checked").val();

					         console.log(size);

					         let sizearray = $(this).data("sizearray");

					         console.log('sizearray');

                                if(sizearray == 'none'){

                                

                             }

                            

					        if (typeof size  === "undefined") {

                                $('#size-err1').html('<span class="text-danger">Please choose size</span>');

                            } else {

                                $('#size-err1').html('');

                                $('#size-err1').delay(500).fadeOut('slow');

                            }

                            if (typeof size  !== "undefined" || sizearray == 'none') {

					              let url =  base_url+"cart-process";

					              $.ajax({

					                 url:url,

					                 type:"POST",

					                 dataType:"json",

					                 data:{id:id,product_id:product_id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size },

					                 success:function(data){

					                    console.log(data);

					                       if(data.success) {

					                          //  $('#cartModel').modal('show');

					                          window.location.href = base_url+"cart";

					                       }     

					                   }

					              });   

					         } else {

					            // window.location.reload();

					         }

					       // console.log(size);

						        

						  });



  						  

  					</script>

  				</div>

  			</div>

  		</div>

  	</div>

</div>

<script type="text/javascript">

		$('.sidenav_open').on('click',function() {

			let product_id = $(this).data("id");

			let gallaryimage = $(this).data("gallaryimage");

			let discountprice = $(this).data("discountprice");

			let discount = $(this).data("discount");

			let price = $(this).data("price");

			let mrpprice = $(this).data("mrpprice");

			let venderid = $(this).data("venderid");

			let catid = $(this).data("catid");

			let image = $(this).data("image");

			let id = $(this).data("id");

			let name = $(this).data("name");

			let slug = $(this).data("slug");

			let seefullurl = $(this).data("seefullurl");

			let designby = $(this).data("designby");

			let sizes = $(this).data("sizes");

			let rating = $(this).data("rating");

			//console.log(id);

			//console.log(gallaryimages);

			console.log(sizes);

			

			var str = '';

			str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/')?>'+image+' " class="img-fluid" alt=""></li>';

			

			gallaryimage.forEach((value, index) => {

			    //console.log(value);

			    //console.log(value.gallery_image);

			    str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/gallery/')?>'+value.gallery_image+' " class="img-fluid" alt=""></li>';

			});



			$('#pro_field').html(str);

			var str = '';

			sizes.forEach((value, index) => {

			    str += '<div data-value="'+value.size_name+'" class="swatch-element plain s available">';

			    	str += '<input id="swatch-0-'+value.size_name+'" type="radio" name="size1" value="'+value.size_name+'">';

			    	str += '<label for="swatch-0-'+value.size_name+'"> '+value.size_name+' </label>';

			    str += '</div>';

			});

			if(str == ''){

			    $('#popUp_productSizeFull').css('display','none');

			}else{

			    $('#popUp_productSizeFull').css('display','block');

			    $('#popUp_productSize').html(str);

			}

		

			

			$('#see_full').attr('href',seefullurl);

			



			$('#popUp_designby').html('Designer by: '+designby);

			$('#popUp_productName').html(name);

			$('#rating').val(rating);

			$('.filled-stars').css('width',rating*20+'%');

			$('.rating-stars').attr('title','('+rating+')');

			$('.badge-secondary').html('('+rating+')');

			 



			

			if (discount!=0) {

				$('#popUp_producPrice').html('<del><?= $this->site->currency?> '+mrpprice+'</del><span><b><?= $this->site->currency?>'+price+' </b></span> <small>('+discount+'% OFF)</small>');

			}else{

				$('#popUp_producPrice').html('<span><?= $this->site->currency?>'+price+' </span>');

			}

			$('#cart1').attr('data-discountprice',discountprice);

			$('#cart1').attr('data-discount',discount);

			$('#cart1').attr('data-price',price);

			$('#cart1').attr('data-mrpprice',mrpprice);

			$('#cart1').attr('data-venderid',venderid);

			$('#cart1').attr('data-catid',catid);

			$('#cart1').attr('data-image',image);

			$('#cart1').attr('data-name',name);

			$('#cart1').attr('data-id',id);

			$('#cart1').attr('data-name',slug);

			if(str == ''){

			    $('#cart1').attr('data-sizearray','none');

			}else{

			     $('#cart1').removeAttr('data-sizearray');

			}

			

			



			

			//$('#add_to_bag').html('<a onClick="aa()" class="cart1 btn2 add_new_b" href="#" title="Add to cart" data-discountprice="'+discountprice+'" data-discount="'+discount+'" data-price="'+price+'" data-mrpprice="'+mrpprice+'" data-venderid="'+venderid+'" data-catid="'+catid+'" data-image="'+image+'" data-id="'+id+'" data-name="'+slug+'"  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Add to Bag</a>');



 

	    });

		function openNav2() {

		    document.getElementById("mySidenav_shop").style.width = "65%"; 

		}

		function closeNav2() {

		    document.getElementById("mySidenav_shop").style.width = "0";

		}

</script>
 
<?php $this->load->view('Page/template/footer'); ?>





