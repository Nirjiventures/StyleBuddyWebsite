<?php $this->load->view('front/template/header'); ?>

<div class="style_banner">
	<img src="<?php echo base_url(); ?>assets/images/stylish_bg.png" class="img-fluid">
</div>

<?php $review = $vender->review;?>
<div class="stylish_data">
	<div class="container">
		
		<div class="row">
			
			<div class="col-sm-3 ">
				<div class="style_info color-pink">
					<?php $img =  'assets/images/no-image.jpg';?>
					<?php if(!empty($vender->image))  {?>
				   		<?php 
				   			$img1 =  'assets/images/vandor/'.$vender->image; 
				   			if (file_exists($img1)) {
				   				$img = $img1;
				   			}
				   		?>
				   	<?php } ?>
				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=1800&image='.$img);?>" class="img-fluid">


				    <h1 class=""><?= ucwords($vender->fname.' '.$vender->lname) ?></h1>

			   	 	<div class="profile_all_data">
						<?php if(!empty($vender->city_name)) { ?>
				            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $vender->city_name ?> <?php //echo '('.$vender->state_name.')'; ?> </p>
				        <?php } ?>

						

						<p class="mobill_dis">Appreciations <?=$vender->feedbackCount?></p>
					</div>

					<div class="oth_info1">
						 <small>Experience: <?=$vender->experience?> Years</small>

						<div class="hidden_star_pointer ratingss my_star1">
							<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>
						</div>
						
						<p style="display: none;"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>
						
						<?php $url =  base_url('stylist/checkavailability/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>

						<a href="<?= $url ?>" class="action_bt_5">Book A Free Discussion</a>
					</div>

				</div>
			</div>
			<div class="col-sm-9">
				
				<div class="stylish_aboutme">
					<h3>About Me</h3>
					<p><?= $vender->about ?></p>
					<hr>

				<div class="help_c">
					<p><b>I can help you with:</b></p>
					
					<?php $expertiseArray = explode(',', $vender->expertise);?>
					<ul>
						<?php foreach ($expertises as $key => $value) { ?>
							<?php if (in_array($value->id, $expertiseArray)) { //var_dump($value);?>
								<?php  $img = 'assets/images/wordb_ic.png'; ?>
								<?php if(!empty($value->icon_image)) { ?>
		                        	<?php  
			                        	$path = 'assets/images/stylist/';
			                        	$img1 =  $path.$value->icon_image; 
							            if (file_exists($img1)) {
							                $img = $img1;
							            }
							        ?> 
		                        <?php } ?> 
								<li><img src="<?php echo base_url($img); ?>"> <?=$value->name;?></li>
							<?php } ?>
						<?php } ?>

						<!-- <li><img src="<?php echo base_url(); ?>assets/images/wordb_ic.png"> Wardrobe Management</li>
						<li><img src="<?php echo base_url(); ?>assets/images/color_ic.png"> Color Analysis</li>
						<li><img src="<?php echo base_url(); ?>assets/images/personal_ic.png"> Personal Shopping</li>
						<li><img src="<?php echo base_url(); ?>assets/images/quick_ic.png"> Quick Styling</li> -->
					</ul>

				</div>

				<div class="style_for2">
					<p><b>I Style for:</b></p>
					<?php 
					$occasion_stylist_category = $this->common_model->get_all_details('occasion_stylist_category',array())->result();
			         

					?>
					<div class="style_for">
						<ul>
							<?php foreach ($occasion_stylist_category as $key => $value) { ?>
								<!-- <li><?=$value->name?></li> -->
							<?php } ?>
							<li>Wedding</li>
							<li>Corporate</li>
							<li>Casual </li>
							<li>Festivals</li>
							<li>Events</li>
						</ul>

					</div>
				</div>
				<div class="mor_abu">
					<div class="accordion" id="accordionExample">
	 
				 		<div class="accordion-item">
					    		<h2 class="accordion-header" id="headingTwo">
					      		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					       		 <h3>More About Me</h3>
					     		 </button>
					    		</h2>
				    		<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
				     		 <div class="accordion-body">
				       				<?= $vender->more_about ?> 
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




<div class="middle_part_1 bg_style">
	<div class="container">
		
    	<div class="more_about" style="display:none;">
    		<p><b>More About Me</b></p>
    		<p><?= $vender->more_about ?></p>
    	</div> 

    	<div class="appreciations">
			<div class="app_heading1"><h3 class="">Reviews Of my Styling</h3></div>

			<section class="my_review_list slider">
				<?php $reviews = $vender->reviews;?>
    			<?php 	foreach ($reviews as $key => $value) { ?>
    				<div class="my_review_new">
    					<a href="" data-bs-toggle="modal" data-bs-target="#full_review_<?=$value['id']?>">
    						<div class="rev_top rev_star1">
								<!--<span><?php echo ucfirst(substr($value['name'],0,1));?></span>-->
								<h3><?php echo ucfirst( $value['name']);?></h3>
							</div>
					       	<div class="row m-0">
								<!-- <div class="col-sm-5 mb-3 p-0 font14"> <?php // date('M d, Y',strtotime($value['created_at']));?> </div> -->
								<div class="col-sm-12 mb-3">
									<div class="hidden_star_pointer ratingss rev_star ">
										<input value="<?=$value['rating']?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>
									</div>
								</div>
								<p><?php echo substr(strip_tags($value['comment']), 0,70);?>...</p>
							</div>
 						</a>

					</div>
				<?php 	}?>
			</section>
			<?php 	foreach ($reviews as $key => $value) { ?>
				<div class="modal" id="full_review_<?=$value['id']?>" data-bs-keyboard="false" data-bs-backdrop="static">
					<div class="modal-dialog modal-dialog-centered modal-lg">
					    <div class="modal-content">
					      	<div class="modal-header">
					        	<h4 class="modal-title">Appreciations</h4>
					        	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					      	</div>
					      	<div class="modal-body">
							  	<div class="full_reccc">
									<?php echo $value['comment'];?>
									<hr>
									<div class="ftt">
										<div class="row m-0 align-items-center">
											<div class="col-sm-6"><h4><?php echo ucfirst( $value['name']);?></h4></div>
											<div class="col-sm-6 text-center">
												<div class="hidden_star_pointer ratingss rev_star">
													<input value="<?=$value['rating']?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>
												</div>
											</div>
										</div>
									</div>
								
							  	</div>
					      	</div>
					    </div>
					</div>
				</div>
			<?php 	}?>
			 
		</div>
    	<div class="review_form">
    		<div class="row ">
				<div class="col-sm-12 mt-3 mb-1 my_star">
    				<h4>Write a Review</h4>
    				<hr>
					<div class="clearfix"></div>
					<div id="reviewList"></div>
	                <input type="hidden" id="user_id" value="<?=$vender->id?>">

                    <input id="input-21f" value="5" type="hidden" class="rating" data-min=0 data-max=5 data-step=0.2 data-size="lg"  required title="">
                </div>
                <?php if($this->session->userdata('loginUser')){ ?>
            	    <input type="hidden" name="review_name" id="review_name"  value="<?=$this->session->userdata('loginUser')?>">
				   	<input type="hidden" name="review_email" id="review_email" value="<?=$this->session->userdata('email')?>">

				   	<div class="col-sm-6">
						<div class="mb-2 mt-0">
						    <label for="text" class="form-label">Your Name</label>
						    <input type="Text" disabled class="form-control" placeholder="Your name" value="<?=$this->session->userdata('loginUser')?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mb-2 mt-0">
							<label for="text" class="form-label">Your Email</label>
    						<input disabled type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">
    					</div>
					</div>

                <?php }else{ ?>	
                	<div class="col-sm-6">
						<div class="mb-2 mt-0">
						    <label for="text" class="form-label">Your Name</label>
						    <input type="Text" class="form-control" id="review_name" placeholder="Your name" name="review_name" value="<?=$this->session->userdata('loginUser')?>">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mb-2 mt-0">
							<label for="text" class="form-label">Your Email</label>
    						<input name="email" id="review_email" type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">
    					</div>
					</div>
                <?php } ?>	
                    

				<div class="col-sm-12">
					<div class="mb-2 mt-1">
					    <label for="comment" class="mb-2">Comment</label>
						<textarea class="form-control" rows="5" id="review_comment" name="text"></textarea>
					  </div>
				</div>
                 
                <div class="col-sm-12 text-center">
               		<input name="submit" type="submit" value="Submit" id="send_stylist_review" class="action_bt_2 ">
               	</div>
                 
    		</div>
		</div>
    </div>
</div>

<?php $this->load->view('front/template/footer'); ?>
<script>
	var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function() {
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
    
</script>
 