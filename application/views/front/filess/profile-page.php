<?php $this->load->view('Page/template/header'); ?>
<?php //print_r($vender->image); ?>

<style type="text/css">
	.d_detail img {
	    height: 190px;
	    width: 190px;
	    object-fit: cover;
	    border-radius: 4px;
	}
	.d_detail .profile_user {
	    text-transform: capitalize;
	}
	.d_detail .profile_user h1{
		font-size: 24px!important;
		margin-bottom: 4px;
		margin-top: 0px;
	}
	.d_detail img {
	    height: 190px;
	    width: 190px;
	    object-fit: cover;
	    border-radius: 4px;
	}
	.d_detail ul {
	    margin: 0;
	    padding: 0;
	    display: flex;
	    margin-top: 0px;
	    margin-bottom: 6px!important;
	}
	.d_detail a.v_quote {
	    right: 0px;
	    top: 0px;
	    background:#742ea0;
	    color: var(--white);
	    padding: 7px 12px;
	    border-radius: 4px;
	    text-transform: capitalize;
	    font-weight: 500;
	    float: left;
	    margin-top: 8px;
	}
	.dv_tabs .nav-tabs .nav-link.active {
	    border-color: rgb(116 46 160);
	    border-bottom: 0px solid #742ea0;
	    color: #fff!important;
	    background-image: linear-gradient(#742ea0, #742ea0);
	    border-top: 0px;
	}
.stylish_detailpage{margin-right:20px;}
	.nav-tabs {
    border-bottom: none!important;
}
	.dv_tabs ul li:first-child a {    background: #dddddd;
    color: #000!important;}
	.dv_tabs ul li:nth-child(2) a {    background: #dddddd;
    color: #000!important;}
	.dv_tabs ul li:nth-child(3) a {    background: #dddddd;
    color: #000!important;}
	.dv_tabs ul li:nth-child(4) a {    background: #dddddd;
    color: #000!important;}
	.dv_tabs ul li:nth-child(5) a {    background: #dddddd;
    color: #000!important;}
	.dv_tabs ul li:nth-child(6) a {    background: #dddddd;
    color: #000!important;}
    .pp_detail {
    box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
    padding: 20px!important;
    padding-top: 20px;
}
.i_box h4 {
    font-size: 16px!important;
    margin-top: 10px;
    margin-bottom: 5px;
}
.dv_tabs .tab-content{
	min-height: 300px;
}
.red-box{
    padding:20px;
    width:54.7%;
    background:rgb(199 193 194 / 30%);
}
.side_wala_tabs .nav-tabs .nav-link.active {
    background-color: rgb(255 255 255)!important;
    border-color: #fff!important;
    border-bottom: 0px solid #ff295d!important;
    border-radius: 0px;
    color: #000!important;
}
.nav-tabs .nav-link{
	border: none;
}
@media screen and (min-device-width: 200px) and (max-device-width: 767px){
.red-box{
    padding:20px;
    width:100%;
}
ul.nav.nav-tabs li {
    margin-right: 15px;
    width: 44%;
    text-align: center;
    margin-bottom: 5px;
    padding-top: 1px;
}
.dv_tabs .nav-tabs .nav-link {
    padding: 10px 0px;
    font-size: 18px;
    text-transform: capitalize;
    color: #495057;
    font-weight: 600;
    padding-top: 8px;
}
.d_detail p {
    margin-bottom: 19px;
}
.d_detail a.v_quote {
    float: none;
        background: #fff;
    color: #000;
}
.stylish_detailpage {
    margin-right: 10px;
}
.side_wala_tabs .nav li{
	width: 100%!important;
}
.more_personal_style h4 {
    text-align: center;
    margin-top: 8px;
    font-size: 22px!important;
}
}
</style>
<div class="middle_part pt-5 color_1">
	<div class="container">
    	<div class="row">
    	    <div class="col-sm-12 d_detail">
    	        <?php 
    				$this->breadcrumb = new Breadcrumbcomponent();
    				$this->breadcrumb->add('Home', '/');
    				$this->breadcrumb->add('Services', '/select-service');
    				if($last_activityRow){
    				   $this->breadcrumb->add($last_activityRow->title_develop, '/select-service/'.$last_activityRow->slug); 
    				}
    				$this->breadcrumb->add(ucwords($vender->fname.' '.$vender->lname), '/select-service');
    			?>
    		 
        		<?php echo $this->breadcrumb->output(); ?>
    			<div class="row">
    				<div class="col-sm-12">
    					<div class="  pp_detail">
    					<div class="d-flex">
						    <div class="flex-shrink-0 stylish_detailpage">
						    	<?php  if (file_exists($image_path = FCPATH . 'assets/vandor/images/' . $vender->image)) { ?>
								    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/vandor/images/'.$vender->image) ?>"  class="img-fluid">
								<?php  } else { ?>
								    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
								<?php  } ?>
						    </div>
						    <div class="flex-grow-1">
						    	<?php $review = $vender->review;?>
						    	<div class="profile_user"><h1><?= ucwords($vender->fname.' '.$vender->lname) ?></h1></div>
						        <div class="row">
						        	<div class="col-sm-3">
						        		<?php if(!empty($vender->city_name)) { ?>
								            <p class="mb-0 pb-0"><small><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $vender->city_name ?> (<?= $vender->state_name ?>)</small></p>
								        <?php } ?>
						        		<div class="hidden_star_pointer ratingss">
											<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Appreciations <?=$vender->feedbackCount?>)
										</div>
						        		<p class="mb-0"><small><?= $vender->designation ?></small></p>
						        	</div>
						        	<div class="col-sm-3">
						        		<p class="mb-0"><small>Experience: <?=$vender->experience?> Years</small></p>
						        		<p class="mb-0"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>
						        		
						        	</div>
						        	<div class="col-sm-12 d-dk">
				    					<ul>
				    					    <?php 
				    					        if(!empty($vender->expertise)) { $arrayVal = explode(',',$vender->expertise); } 
			    					            $values = ""; 
			    					            foreach($expertises as $expertise)  {    
										        	 if(isset($arrayVal)) { 
										        	     if(in_array($expertise->id, $arrayVal)) { $values .=  " | $expertise->name"; } 
										        	 } 
										        } 
				    					    ?>
								        	<!--<li><a href=""><?= substr($values,2); ?></a> </li> -->
								        </ul>
								        <p><?= $vender->about ?></p>
				    				</div>
				    				<div class="col-sm-12 d-dk">
				    					<!--<?php if($this->session->userdata('loginUser')){ ?>
								        	<a href="<?= base_url('ask-for-quote/uOiEa'.base64_encode($vender->id) ) ?>" class="v_quote"> Contact Me</a>
								        <?php }else{ ?>	
								        	<a href="<?= base_url('login') ?>" class="v_quote"> Contact Me</a>
								        <?php } ?>-->
								        
								        <a href="<?= base_url('buy-styling-packages') ?>" class="v_quote"> Buy a Plan</a>
				    				</div>
						        </div>
						    </div>

						</div>
						<div class="row d-mb">
				        	<div class="col-sm-12">
		    					<ul>
		    					    <?php 
		    					        if(!empty($vender->expertise)) { $arrayVal = explode(',',$vender->expertise); } 
	    					            $values = ""; 
	    					            foreach($expertises as $expertise)  {    
								        	 if(isset($arrayVal)) { 
								        	     if(in_array($expertise->id, $arrayVal)) { $values .=  " | $expertise->name"; } 
								        	 } 
								        } 
		    					    ?>
						        </ul>
						        <p><?= $vender->about ?></p>
		    				</div>
		    				<div class="col-sm-12">
		    					<?php if($this->session->userdata('loginUser')){ ?>
						        	<a href="<?= base_url('ask-for-quote/uOiEa'.base64_encode($vender->id) ) ?>" class="v_quote"> Contact Me</a>
						        <?php }else{ ?>	
						        	<a href="<?= base_url('login') ?>" class="v_quote"> Contact Me</a>
						        <?php } ?>
		    				</div>
				        </div>
						</div>
    				</div>
    				
    			</div>
    		</div>
    	</div> 

    	<div class="row mt-5">
    		<div class="col-sm-12 dv_tabs">
    		    <?php $tabFlagId =  'home';?>
    			<ul class="nav nav-tabs " role="tablist">
    			    <?php //$aaa = array('packages'=>'My Packages','home'=>'My Projects','video'=>'Videos','reviews_tb'=>'Appreciations','more-about-me'=>'More About Me');?>
    			    <?php $aaa = array('home'=>'My Projects','video'=>'Videos','reviews_tb'=>'Appreciations','more-about-me'=>'More About Me');?>
    			    <?php $i=0; ?>
    			    <?php foreach($aaa as $key=>$value){ ?>
    			        <?php if($_GET['show']){ ?>
    			            <?php if($_GET['show'] == $key){$active='active';$tabFlagId =  $key;}else{$active='';}?>
    			        <?php }else{ ?>
        			        <?php if($i==0){$active='active';}else{$active='';}?>
        			    <?php }?>
        			    <?php if($key == 'more-about-me'){ ?>
        			        <?php $tabKey = current_url().'?show='.$key;?>
        			        <li class="nav-item"> <a class="nav-link <?=$active?>" href="<?=$tabKey?>"><?=$value?></a></li>
        			    <?php }else if($key == 'packages'){ ?>
        			        <?php $tabKey = current_url().'?show='.$key;?>
        			        <li class="nav-item"> <a class="nav-link <?=$active?>" href="<?=$tabKey?>"><?=$value?></a></li>
        			    <?php }else{ ?>
        			        <li class="nav-item"> <a class="nav-link <?=$active?>" data-bs-toggle="tab" href="#<?=$key?>"><?=$value?></a></li>
        			    <?php }?>
        			    
    			        
    			        
    			        
    			        
    			        
				     
				    
				    
				    <?php $i++;} ?>
    			</ul>
				<div class="tab-content">
				    <div id="home" class="tab-pane <?php if($tabFlagId == 'home'){echo 'active';}?>">
				    	<div class="row">
				    	    
				    	   <?php if($ideas) { foreach($ideas as $idea) {   $imgArray =  explode(',',$idea->image);  ?>
				    	    
				    		<div class="col-sm-4 col-12">
				    			<div class="i_box">
				    				 
				    				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="<?= $idea->title ?>" src="<?= base_url('assets/images/story/').$imgArray[0] ?>" class="img-fluid">
				    				
				    				<h4><a href="<?= base_url('stylist-ideas/').base64_encode($idea->id); ?>"><?= $idea->title ?></a></h4>
				    				<div class="hashtag">
				    				    <?php $value = ''; if($idea->tag_id) { $array = explode(',',$idea->tag_id); }  
				    				        foreach($idea_tag as $tag)  {    
							        	 if(isset($array)) { if(in_array($tag->id, $array)) { $value .=  " #$tag->tag"; } } 
							        	 } 
				    				    ?>
										<a href="<?= base_url('stylist-ideas/').base64_encode($idea->id); ?>"><?= substr($value,1); ?></a> 
									</div>
				    			</div>
				    		</div> 
				    	<?php }} ?>	

				    	</div>
				    </div>
				    <div id="video" class="tab-pane <?php if($tabFlagId == 'video'){echo 'active';}?>"> 
				    	<div class="row">
				    		<?php $videos = $vender->videos; ?>
				    		<?php if(!empty($videos))  { ?>
				    		 	<?php foreach($videos as $video) {  ?>
				    		 	        <div class="col-sm-4">
        							    	<div class="my_youtube">
                                                    <div class="video_bio">
							    		                 <p><b><?=$video->title?></b></p>
        							    			     <?=  mb_strimwidth($video->content,0,80, '....'); ?>
        							    			     
        							    			      <div class="back_data">
                                                            <p><b><?=$video->title?></b></p>
                							    			    <?=$video->content?>
                                                          </div>
        							    			     
        							    			    </div>
        							    			    
                					    		 	<?php if($video->videoType == 'youtube') {  ?>
                							    			<div class="my_video">
                							    				<iframe width="100%" height="320" src="https://www.youtube.com/embed/<?=$video->image?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                							    			</div>
                					    			<?php }else{  ?>
                							    			<div class="my_video local">
                							    				<video class="video-col-1 hiddenControls" width="100%" height="320" controls>
                									                <source src="<?=base_url('assets/images/story/'.$video->image)?>#t=2,1" type="video/mp4">
                									            </video>
                							    			</div>
                					    			<?php }  ?>
                                                    
                                                
                                             </div>
                                        
							    		</div>
				    			<?php }  ?>
				    		<?php }  ?>
				    	</div>
				    </div> 
				    <div id="my_shop" class="tab-pane <?php if($tabFlagId == 'my_shop'){echo 'active';}?>"> 
				    	<div class="row">
				    		<?php $products = $vender->products; ?>
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
					            				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="img" <?= $product->title ?> src="<?= base_url('assets/images/product/').$product->image ?>" class="img-fluid">
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
					          			</div>
					          		</div>
					          		
					          	<?php } } else { ?>	
			                            	<div class="col-6 col-sm-4"><h3 class="text-center" >Coming Soon...</h3></div>
			                        <?php } ?>
				          	</div>
				    	</div>
				    </div> 
				    <div id="reviews_tb" class="tab-pane <?php if($tabFlagId == 'reviews_tb'){echo 'active';}?>"> 
				    	<div class="row pt-3">
					    		<div class="col-sm-12 r_list">
					    			<?php $reviews = $vender->reviews;?>
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
					    		<div class="col-sm-12">
					    			<div class="review_form">
						    			<h4>Write a Review</h4>
						    			<hr>
						    			<div class="row review_post mt-1">
											<div class="clearfix"></div>
											<div id="reviewList"></div>
							                <input type="hidden" id="user_id" value="<?=$vender->id?>">

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
                    <div id="more-about-me" class="tab-pane <?php if($tabFlagId == 'more-about-me'){echo 'active';}?>"> 
                            <div class="row">
                                <?php if($vender->more_about){ ?>
                                <div class="col-sm-12">
                                    <div class="mt-3 red-box"><?= $vender->more_about ?></div>
                                </div>
                                <?php } ?>
                            </div>
                    </div>
                    <div id="packages" class="tab-pane <?php if($tabFlagId == 'packages'){echo 'active';}?>">
						<div class="mt-3">
							<div class="row m-0">
								<div class="col-sm-12">
									<div class="side_wala_tabs">
										<?php if ($services_list) { ?>
											<div class="row align-items-center">
												<div class="col-sm-5 mbl">
													<div class="my_apck">
														<p>Select a Package: </p>
														<select onchange="getDiv(this.value)">
															<?php 	$i=0;  ?>
															<?php 	foreach($services_list as $k=>$v){ if($i==0){$act = 'active';}else{$act = '';} ?>
																<option value="#serviceTab<?=$v['id']?>"><?=$v['area_expertise_name']?></option>
															<?php 	$i++;} ?>
														</select>
													</div>
												</div>
												<div class="col-sm-7">
													<?php 	$i=0;  ?>
													<?php 	foreach($services_list as $k=>$v){ if($i==0){$act = 'display:block';}else{$act = 'display:none';} ?>
													<div id="serviceTab<?=$v['id']?>__" class="tab-pane tab-pane-javascript" style="<?=$act?>">
														<h4 class="text-start"><span><?=$v['area_expertise_name']?></span></h4>
													</div>
													<?php 	$i++;} ?>
												</div>	
												<div class="col-sm-5 dsk">
													<div class="my_apck">
														<p>Select a Package: </p>
														<select onchange="getDiv(this.value)">
															<?php 	$i=0;  ?>
															<?php 	foreach($services_list as $k=>$v){ if($i==0){$act = 'active';}else{$act = '';} ?>
																<option value="#serviceTab<?=$v['id']?>"><?=$v['area_expertise_name']?></option>
															<?php 	$i++;} ?>
														</select>
													</div>
												</div>
											</div>
									  <?php 	} ?>
									</div>
								</div>

								<div class="col-sm-12 ">
									<div class="tab-content more_personal_style" id="otherdetail">
									 	<?php 	$i=0;  ?>
										<?php 	foreach($services_list as $k=>$v){ if($i==0){$act = 'active';}else{$act = '';} ?>
											<div id="serviceTab<?=$v['id']?>" class="tab-pane tab-pane-javascript <?=$act?>">
												<!-- <h4 class="text-start"><span><?=$v['area_expertise_name']?></span></h4> -->
												
												<?php $package_featureArray = $v['package_featureArray']; ?>

												


										 	  	<div class="row mt-3 mb-3">
										 	  		
										 	  		<div class="col-sm-4">
										 	  		        <div class="plans-box">
										 	  				<h4 class="bt_black">CLASSIC PACKAGE</h4>
											 	  			<div class="cls">
											 	  				<div class="col-sm-12 text-center pasa"><b> Rs. <?=$v['package_price_1']?></b></div>
											 	  				<hr>
																<?= $v['package_description_1'] ?>
											 	  			</div>

										 	  				<div class="cls_1">
											 	  				<form method="post" action="<?=base_url('checkout-stylist-book')?>" id="frm_package_price_1_<?=$v['id']?>">
											 	  				<input type="hidden" name="vendor_id" id="vendor_id_1<?=$v['vendor_id']?>" value="<?=$v['vendor_id']?>">
											 	  				<input type="hidden" name="package_id" id="package_id_1<?=$v['id']?>" value="<?=$v['id']?>">
											 	  				<input type="hidden" name="package_price" id="package_price_1<?=$v['id']?>" value="package_price_1">
											 	  				<input type="hidden" name="lastPage" value="<?=$lastPage?>">
											 	  				<?php ?>

											 	  				<div class="col-md-12 text-center">
											 	  					<?php if($this->session->userdata('loginUser')){ ?>
															        	<!--<input type="submit" class="bt_black-2" name="submit" value="Buy Now">-->
															        	<?php if($this->session->userdata('userId') != $v['vendor_id'] ){ ?>
																        	<input type="submit" class="bt_black-2" name="submit" value="Buy Now">
																        <?php }else{ ?>	
																        	<a href="#" class="bt_black-2"> OWN Service</a>
																        <?php } ?>
															        <?php }else{ ?>	
															        	<a href="<?= base_url('login') ?>" class="bt_black-2"> Buy Now</a>
															        <?php } ?>	
												 	  			</div>
											 	  			</form>
										 	  			</div>
										 	  			</div>
													</div>

										 	  		<div class="col-sm-4">
										 	  		    <div class="plans-box">
										 	  			<h4 class="bt_purple">PREMIUM PACKAGE</h4>
										 	  			<div class="cls">
										 	  				<div class="col-sm-12 text-center pasa"><b> Rs. <?=$v['package_price_2']?></b></div>
										 	  				<hr>
										 	  				<?= $v['package_description_2'] ?>
										 	  			</div>
										 	  			<div class="cls_1">
											 	  			
											 	  			<form method="post" action="<?=base_url('checkout-stylist-book')?>" id="frm_package_price_2_<?=$v['id']?>">
											 	  				<input type="hidden" name="vendor_id" id="vendor_id_2<?=$v['vendor_id']?>" value="<?=$v['vendor_id']?>">
											 	  				<input type="hidden" name="package_id" id="package_id_2<?=$v['id']?>" value="<?=$v['id']?>">
											 	  				<input type="hidden" name="package_price" id="package_price_2<?=$v['id']?>" value="package_price_2">
											 	  				<input type="hidden" name="lastPage" value="<?=$lastPage?>">
											 	  				<div class="col-md-12 text-center ">
											 	  					<?php if($this->session->userdata('loginUser')){ ?>
															        	<!--<input type="submit" class="bt_purple-2" name="submit" value="Buy Now">-->
														        		<?php if($this->session->userdata('userId') != $v['vendor_id'] ){ ?>
																        	<input type="submit" class="bt_purple-2" name="submit" value="Buy Now">
																        <?php }else{ ?>	
																        	<a href="#" class="bt_purple-2"> OWN Service</a>
																        <?php } ?>
															        <?php }else{ ?>	
															        	<a href="<?= base_url('login') ?>" class="bt_purple-2"> Buy Now</a>
															        <?php } ?>	

												 	  				 
												 	  			</div>
											 	  			</form>
										 	  			</div>
										 	  			</div>
														<!-- <span class="pdc_aa"><a href="#">Buy Now</a></span> -->
										 	  		</div>

										 	  		<div class="col-sm-4">
										 	  		    <div class="plans-box">
										 	  				<h4 class="bt_pink">LUXURY PACKAGE</h4>
											 	  			<div class="cls">
											 	  				<div class="col-sm-12 text-center pasa"><b> Rs. <?=$v['package_price_3']?></b></div>
											 	  				<hr>
											 	  				<?= $v['package_description_3'] ?>
											 	  			</div>
											 	  			<div class="cls_1">
												 	  			
												 	  			<form method="post" action="<?=base_url('checkout-stylist-book')?>" id="frm_package_price_3_<?=$v['id']?>">
												 	  				<input type="hidden" name="vendor_id" id="vendor_id_3<?=$v['vendor_id']?>" value="<?=$v['vendor_id']?>">
												 	  				<input type="hidden" name="package_id" id="package_id_3<?=$v['id']?>" value="<?=$v['id']?>">
												 	  				<input type="hidden" name="package_price" id="package_price_3<?=$v['id']?>" value="package_price_3">
												 	  				<input type="hidden" name="lastPage" value="<?=$lastPage?>">
												 	  				<div class="col-md-12 text-center">
													 	  				<?php if($this->session->userdata('loginUser')){ ?>
																        	<?php if($this->session->userdata('userId') != $v['vendor_id'] ){ ?>
    																        	<input type="submit" class="bt_pink-2" name="submit" value="Buy Now">
    																        <?php }else{ ?>	
    																        	<a href="#" class="bt_pink-2"> OWN Service</a>
    																        <?php } ?>
    																        
																        <?php }else{ ?>	
																        	<a href="<?= base_url('login') ?>" class="bt_pink-2"> Buy Now</a>
																        <?php } ?>	
													 	  			</div>
												 	  			</form>
											 	  			</div>
										 	  		</div>
                                                </div>
										 	  	</div>
										 	  
											</div>
										<?php 	$i++;} ?>
									</div>
								 </div>
							</div>
						</div>
				    </div>
				</div>
    		</div>
    	</div>
        <div class="col-12 col-sm-3 footer_aboust">
        	<ul class="">
                <?php if($vender->instagram_nlink){ ?>
                    <!--<li><a target="_blank" href="<?= $vender->instagram_nlink  ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="instagram" src="<?= base_url() ?>assets/images/insta.png"></a></li>-->
            	<?php } ?>
            	<?php if($vender->linkedin_link){ ?>
        	        <!--<li><a target="_blank" href="<?= $vender->linkedin_link  ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="IMG" src="<?= base_url() ?>assets/images/linke.png"></a></li>-->
                <?php } ?>
            	<?php if($vender->facebook_link){ ?>
        	        <!--<li><a target="_blank" href="<?= $vender->facebook_link  ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="fb" src="<?= base_url() ?>assets/images/fb.png"></a></li>-->
        	    <?php } ?>
            	<?php if($vender->twitter_link){ ?>
        	       <!-- <li><a target="_blank" href="<?= $vender->twitter_link  ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="instagram" src="<?= base_url() ?>assets/images/tw.png"></a></li>-->
                <?php } ?>
            	<?php if($vender->behance_link){ ?>
        	        <!--<li><a target="_blank" href="<?= $vender->behance_link  ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="behance_link" src="<?= base_url() ?>assets/images/behance.png"></a></li>-->
                <?php } ?>
            </ul>
        </div>
    	<!--<iframe frameborder="0" sandbox="allow-same-origin allow-scripts allow-popups allow-forms" target="_blank" src="<?=$vender->instagram_nlink?>" width="100%" height="auto" style="min-height:380px;height: auto;" title="Iframe Example"></iframe>-->
    </div>
</div>

<?php $this->load->view('Page/template/footer'); ?>






<script>
    
    $(document).ready(function(){
		// set up hover panels
		// although this can be done without JavaScript, we've attached these events
		// because it causes the hover to be triggered when the element is tapped on a touch device
		$('.hover').hover(function(){
			$(this).addClass('flip');
		},function(){
			$(this).removeClass('flip');
		});
	});
</script>


<script>
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
        var id = $('#user_id').val();
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
            url: base_url + 'page/send_review',
            type: "POST",
            data: {id:id,name:name,email:email,title:title,comment:comment,rating:rating},
            success: function (res) {
            	console.log(res)
                $('#reviewList').html(res);
	            //$('#reviewList').fadeOut(4000);
                window.setTimeout(function(){location.reload()},2000)
            }
        })
    });
    function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
    function getDiv(id){
    	$('.tab-pane-javascript').hide()
    	$(''+id).show()
    	$(''+id+'__').show()
    	console.log(id)
    }
</script>