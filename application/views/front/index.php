<?php ?>

<style>
	#onSignup iframe {
    width: 77%!important;
    height: 48px!important;
    margin: auto!important;
    text-align: center;
    display: block!important;
}
</style>

<div class="new_banner">
    <div class="row m-0 align-items-center">
        <div class="col-sm-6 p-0">
        </div>
        <div class="col-sm-6 p-0 ">
            <div class="new_sk">
                <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php $i=0;foreach ($home_slides as $key => $value) { ?>
							<?php $img =  'assets/images/banner-new1.jpg';?>
							<?php if(!empty($value->slides_image))  { ?>
								<?php if ($i==0) {$active='active';}else{$active="";}?>
						   		<?php 
						   			$img1 =  'assets/images/slider/'.$value->slides_image; 
						   			if (file_exists($img1)) {
						   				$img = $img1;
						   			}
						   		?>
						   		<div class="carousel-item <?=$active?>" data-bs-interval="3000">
						   			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="d-block " alt="...">
								</div>
						   	<?php } ?>
						<?php $i++;} ?>
					</div>
				</div>
            </div>
        </div>
    </div>
    <div class="baner_info">
    	<div class="container">
    		<div class="enhance">
                <!-- <h1 class="quotes">Enhance your <br>Personal Style</h1>
                <h1 class="quotes">Tired of wearing same<br> old boring clothes?</h1>
                <h1 class="quotes">Unable to find the right<br> outfit when you shop?</h1>
                <h1 class="quotes">Low of confidence with<br> your body or looks?</h1>
                <h1 class="quotes">Feeling you have a<br> outdated wardrobe?</h1>
                <h1 class="quotes">Looking to shine in front of<br> your boss & employees?</h1>
                <h1 class="quotes">Don’t have the time but need a<br> strong image to work?</h1>
                <h1 class="quotes">We help you enhance your<br> Personal style</h1> -->
                <div class="hhds">
                <?php $i=0;foreach ($home_slides_text as $key => $value) { ?>
					<?php if(!empty($value->title))  { ?>
						<h1 class="quotes"><?=$value->title;?></h1>
				   	<?php } ?>
				<?php $i++;} ?>
				</div>
                <?=$home_slider->sub_title;?>
                <div class="my_stylish mt-5"><span><?php //$home_slider->sub_title2;?></span></div>
                <?php if(!$this->session->userdata('userId')){ ?> 
                    <!--<a href="<?php //echo base_url('user/registration'); ?>" class="mt23 black_bg">Book Free Session</a>-->
                    <!--<a href="<?php //echo base_url('services/free-introduction-to-styling'); ?>" class="mt23 black_bg">Book Free Session</a>-->
                    
                    <a href="" data-bs-toggle="modal" data-bs-target="#free_s_login"  class="mt23 black_bg">Login for a free session</a>
                    
                <?php }else{ ?>
                    <a href="" data-bs-toggle="modal" data-bs-target="#free_s_popup" class="mt23 black_bg">Book Free Session</a>
                    
                    
                    
                    
                <?php } ?>
                
            </div>
    	</div>
    </div>
    
</div>


<div class="banner" style="display: none;">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/banner-home.jpg" class="img-fluid">
	<div class="container">
		<div class="banner_data">
			 <?=$home_slider->sub_title;?>
			<div class="my_stylish"><span><?=$home_slider->sub_title2;?></span></div>
			<a href="#action_bt_2" class="action_bt mt23 black_bg">Hire Now!</a>
		</div>
	</div>
</div>
<section class="yellow_user">
	<div class="container">
		<ul>
			
			<li>500+ <br>Users</li>
			<li>2000+ <br> Stylists</li>
			<li>Customers from <br>3+ Countries  </li>
		</ul>
	</div>
</section>

<section class="what_is">
	<div class="container">
		<div class="what_data">
			<div class="row m-0 ">
				<div class="col-lg-6 p-0">
					<div class="title_part2">
						<!-- <h2 class="font70">Your <span>Life.</span><br> Your <span>Style.</span> </h2> -->
						<?=$section2->content;?>
					<?=$section2->content2;?>
					<div class="cta"><a href="<?=base_url('services')?>" class="action_bt_2">Learn More...</a></div>
					</div>
				</div>
			
				<div class="col-lg-6  video_padd">
					
					<div class="banner_video">
						 <video controls  playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
							<source src="<?php echo base_url(); ?>assets/images/stylebuddy.mp4" type="video/mp4">
						  </video>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<section class="ask_stylish">
	<div class="container">
		<div class="ask_bg">
			<div class="ask_content">
				<img src="<?php echo base_url(); ?>assets/images/ask.png" class="img-fluid">
			</div>
			<div class="row align-items-center">
				
				<div class="col-sm-6">
					
						<div class="title_part pinkDiv">
							<h2 class="font60">Ask a expert <br>fashion stylist</h2>
							<p>Get Accurate Styling Answers to any Fashion & styling problems From our Expert stylists</p>
						</div>
					
				</div>

				<div class="col-sm-6">
					<div class="form_data">
						<p class="subscription-status"></p>
						<div class="fm_group">
							<p>Phone Number:</p>
							<input name="phoneNumber" id="phoneNumber" type="text" maxlength="10" class="ask_sub_box_in onlyInteger">
						</div>
						<div class="fm_group">
							<p>Ask your Styling question</p>
							<textarea name="ask_question" id="ask_question" type="text" placeholder="(Min 20 words)" rows="5" class="ask_sub_box"></textarea>
						</div>
						<a type="submit" class="action_bt_2  mt-3" onclick="ask_quote_lead('subscription-status','phoneNumber','ask_question')">ASK NOW</a>
						 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container"  >
    <div class="row">
    	<?php if ($our_services) { ?>
    		<section class="servicess_slidee" id="action_bt_2">	
    			<div class="title_part pinkDiv">
    				<h2 class="font60"><?=$section3->sub_title;?></h2>
    				<!-- <p class="pink">Because you deserve to look your best</p> -->
    				<?=$section3->content;?>
    				<div class="col-sm-12 mb-3"><a href="<?php echo base_url(); ?>services" class="action_bt_2">View all </a></div>
    			</div>
    			<section class="servives_sld slider">
    				<?php $i=0;foreach ($our_services as $key => $value) { ?>
    						<?php 
    							$mode = 4;
    							if($i%$mode==0){
    								$k = 1;
    							}elseif($i%$mode==1){
    								$k = 2;
    							}elseif($i%$mode==2){
    								$k = 3;
    							}elseif($i%$mode==3){
    								$k = 2;
    							} 
    							
    						?>
    					<?php  service_div($value,$k) ;?>
    
    				<?php $i++;}?>
    			</section>
    		</section>
    	<?php } ?>
    </div>
</div>

<?php if($couponRows){  ?>
		<section class="offer_box">
			<div class="container">
				<h3>We are Offering </h3>
				<section class="add_offer_slidre slider">
					<?php $i=0;foreach ($couponRows as $key => $value) {  ?>
						<?php 
							if($i%4 == 1){
								$k = 1;
							}else if($i%4 == 2){
								$k = 2;
							}else if($i%4 == 3){
								$k = 3;
							}else if($i%4 == 0){
								$k = 4;
							}

						?>
						<div class="ads_boxx style<?=$k?>">
							<div  class="dsi_box">
								<div class="ribbon blue"><span>New</span></div>	
								<div class="row align-items-center">
									<div class="col-8 col-sm-8">
										<div class="off_data">
											<h4>Get <span><?=$value['name'];?> <small>off</small>  </span></h4>
												<small class="using_con">Using coupon code </small>
											<h3><?=$value['serviceRow']['title']?></h3>
											<a href="<?=base_url('services/'.$value['serviceRow']['slug'])?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
										</div>
									</div>
									<div class="col-4 col-sm-4 pl-0">
										<div class="off_photo">
											<?php $img =  'assets/images/services/image1687417032.jpg';?>
								            <?php if(!empty($value['media']))  {?>
								                <?php 
								                    $img1 =  $value['media']; 
								                    if (file_exists($img1)) {
								                        $img = $img1;
								                    }
								                ?>
								            <?php } ?>
								            <img src="<?=base_url($img);?>" class="img-fluid">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php $i++;}  ?>
					 
				</section>
			</div>
		</section>
<?php } ?>
<?php if($home_page_services){  ?>
		<section class="personal_styling">
			<div class="container">
				<div class="title_part ">
					<h2 class="font60">Personal styling services</h2>
				</div>
				<div class="block_main">
					<?php foreach ($home_page_services as $key => $value) {  ?>
						<div class="main_persson">
							<?php  $img = image_exist($value->image,'assets/images/home-page-services/'); ?>
							<img alt="Personal Styling | StyleBuddy"  src="<?= base_url($img) ?>" class="pic1">
							<div class="row">
								<div class="col-sm-4 per_none"></div>
								<div class="col-sm-8">
									<div class="person_deta">
										<h3><?=$value->title?></h3>
										<?=$value->description_top?>
										<p><a href="<?php echo base_url('services/'.$value->slug); ?>">Read more</a></p>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
   			</div>
		</section>
<?php } ?>


<section class="personal_styling" style="display:none">
	<div class="container">
		<div class="title_part ">
			<h2 class="font60">Personal styling services</h2>
		</div>
	
	<div class="block_main">

	<div class="main_persson">
		<img src="<?php echo base_url(); ?>assets/images/per1.png" class="pic1">
		<div class="row">
			<div class="col-sm-4 per_none"></div>
			<div class="col-sm-8">
				<div class="person_deta">
					<h3>Online styling consultation</h3>
					<ul>
					<li>Online Video consultation calls of 30 minutes each.</li>
					<li>The stylist will have three calls with you where you understand about your personality, body type, skin tone and etc. </li>
					<li>We help you understand things using a styling report and ensure you have used our styling suggestions. </li>
					</ul>
					<p><a href="<?php echo base_url(); ?>services/online-styling-consultation">Read more</a></p>
				</div>
			</div>
		</div>
	</div>

	<div class="main_persson">
		<img src="<?php echo base_url(); ?>assets/images/per2.png" class="pic1">
		<div class="row">
			<div class="col-sm-4 per_none"></div>
			<div class="col-sm-8">
				<div class="person_deta">
					<h3>Personal Shopper</h3>
					<ul>
					<li>Service begins with an online video call with our fashion stylist for a Discussion on your style preferences, your body type, personality and color preferences.</li>
					<li>After the initial Call, you will inform the Stylist on whether you would like online personal shopper support on onsite.</li>
					</ul>
					<p><a href="<?php echo base_url(); ?>services/personal-shopper">Read more</a></p>
				</div>
			</div>
		</div>
	</div>

	<div class="main_persson">
		<img src="<?php echo base_url(); ?>assets/images/per3.png" class="pic1">
		<div class="row">
			<div class="col-sm-4 per_none"></div>
			<div class="col-sm-8">
				<div class="person_deta">
					<h3>Wardrobe Transformation</h3>
					<ul>
					<li>The Service starts with an online video call.  The Stylist will analyze your personality, body type, skin tone along with a styling report. </li>
					<li>After the first video call, the Stylist will visit your Home to conduct your Wardrobe Analysis. </li> 
					<li>The Stylist will then provide you a detailed report with recommendations on your Wardrobe. </li>
					</ul>
					<p><a href="<?php echo base_url(); ?>services/styling-consultation-at-home">Read more</a></p>
				</div>
			</div>
		</div>
	</div>

	</div>

   </div>

</section>




<section class="talk_stylish" style="display: none;">
	<div class="container">
		
		<div class="title_part mb-3">
			<h2 class="font60">Talk to Stylish</h2>
			<div class="col-sm-12   mt-3"><a href="#" class="action_bt_2 new_pr" title="">View All</a></div>
		</div>

		<div class="row">

			<div class="col-lg-4">
				<div class="all_talk">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
								<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/image1677069774.jpeg" class="img-fluid">
								<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Priya Arora <span class="on_line"></span></h4>
								<span class="p_stylish">Fashion Designer</span>
								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 35/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class="c_green"><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class="c_green"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			<div class="col-lg-4">
				<div class="all_talk">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
								<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/20220707_160134.jpg" class="img-fluid">
								<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Pooja Gulrajani <span class="on_line"></span></h4>
								<span class="p_stylish">Personal Stylist</span>
								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 45/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class=""><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class="c_green"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="all_talk off_line">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
								<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/6CDF7B5E-F558-4AB7-BCB7-EA2B5BBE213A.jpeg" class="img-fluid">
								<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Khyati Kalia <span class="on_line"></span></h4>
								<span class="p_stylish">Fashion Designer</span>
								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 25/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class=""><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class=""><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="all_talk">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
								<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/image1677266494.jpeg" class="img-fluid">
								<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Niya Bapalawat <span class="on_line"></span></h4>
								<span class="p_stylish">Fashion Designer</span>
								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 15/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class="c_green"><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class=""><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="all_talk">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
								<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/image1682779258.jpeg" class="img-fluid">
								<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Aditi Gupta <span class="on_line"></span></h4>
								<span class="p_stylish">Personal Stylist</span>

								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 15/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class="c_green"><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class="c_green"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="all_talk">
					<div class="row m-0">
						<div class="col-4 col-lg-4">
							<div class="talk_s_photo">
								<a href="<?php echo base_url(); ?>stylists/NjY5/priyanka-bhatia">
									<img src="https://www.stylebuddy.in/resize_image.php?new_width=300&new_height=400&image=assets/images/vandor/image1658841440.jpg" class="img-fluid">
									<div class="statt2 text-center"><i class="fa fa-star" aria-hidden="true"></i> 4.7</div>
								</a>
							</div>
						</div>
						<div class="col-8 col-lg-8">
							<div class="talk_data">
								<h4>Aveek Mitra <span class="on_line"></span></h4>
								<span class="p_stylish">Personal Stylist</span>
								<p>Exp. 10 Years</p>
								<p><i class="fa fa-language" aria-hidden="true"></i> English, Hindi</p>
								<div class="price_talk">
									<i class="fa fa-inr"></i> 30/ min 
								</div>
								<div class="talk_phone">
									<a href="#" class="c_green"><i class="fa fa-phone" aria-hidden="true"></i></a>
									<a href="#" class="c_green"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>

	</div>
</section>



<section class="my_blogs" id="read_styling">
	<div class="full_blog">
		<div class="container">
		    <div class="row ">
			<div class="title_part pinkDiv">
				<h2 class="font60"><?=$section6->sub_title;?></h2>
				<?php //$section6->content;?>
				<div class="col-sm-12   mt-3"><a href="<?php echo base_url('style-stories'); ?>" class="action_bt_2 new_pr" title="">View All</a></div>
			</div>
			<div class="blog_skd slider">
				<?php if(!empty($style_stories)) { ?>
					<?php foreach($style_stories as $data) { ?>
						<?php $img =  'assets/images/no-image.jpg';?>
						<?php if(!empty($data->blogImage))  {?>
				            <?php 
				                $img1 =  'assets/images/story/'.$data->blogImage; 
				                if (file_exists($img1)) {
				                    $img = $img1;
				                }
				            ?>
				        <?php } ?>
				    	<div class="blogss">
							<a href="<?= base_url('style-stories/').$data->blogSlug ?>">
								<?php  $img = image_exist($data->blogImage,'assets/images/story/'); ?>

						    	<?php  if ($data->blogImage_type == 'video') { ?>
						    		<!-- <video class="video-col-1" style="width:100%" controls>
						                <source src="<?= base_url($img) ?>" type="video/mp4">
						            </video> -->
						            <?php  $img = image_exist($data->blogImage_thumbnail,'assets/images/story/'); ?>
						            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid video_thumbnail">
						            <div class="video_thumbnail_div"><i class="fa fa-play" aria-hidden="true"></i></div>
						    	<?php  }else{ ?>
							    	
							    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
							    <?php  } ?>
							</a>
							<div class="bg_data">
								<p><a href="<?= base_url('style-stories/').$data->blogSlug ?>"><?=  mb_strimwidth($data->blogTitle,0,50, '....'); ?></a></p>
							</div>
						</div>
					<?php } ?>
      			<?php }  ?>
			</div>
			
			
			
		</div>
		</div>
	</div>
</section>







<section class="style_category we_have" >
	<div class="container">
	   <div class="row ">
		<div class="title_part pinkDiv">
			<h2 class="font60"><?=$section4->sub_title;?></h2>
			<?=$section4->content;?>
		</div>
		<div class="col-sm-12"><a href="<?=base_url('services')?>" class="action_bt_2" >Book a session now!</a></div>
		<div class="tranding_style slider">
			<?php foreach ($occasion_stylist_category as $key => $value) { ?>
				<div class="my_stylish_t color_white">
					<?php $img =  'assets/images/no-image.jpg';?>
					<?php if(!empty($value->image)) { ?>
					    <?php 
				   			$img1 = 'assets/images/stylist-category/'.$value->image;; 
				   			if (file_exists($img1)) {
				   				$img = $img1;
				   			}
				   		?>
					<?php } ?> 
				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
					 
					<div class="trd_data">
						<h4><?=$value->name?></h4>
						<p><?=$value->sub_title?></p>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
	</div>
</section>

<section class="we_have1">
	<div class="container">
		<div class="row  align-items-center">
			
			<div class="title_part  pinkDiv">
				<h2 class="font60">Trending  Stylists</h2>
				<p>Find the best fashion stylists & designers with trusted reviews.</p>
				<div class="col-sm-12 mb-3"><a href="<?php echo base_url(); ?>connect-with-stylists/personal-shopper" class="action_bt_2">View all Stylists</a></div>
			</div>
			
			<div class="tranding_style slider">
				<?php foreach ($tranding_vendor as $key => $vender): ?>
					<?=stylist_div_home($vender);?>
				<?php endforeach ?>
				 
			
			</div>
		
			
			
		</div>
	</div>
</section>




<section class="textiim">
	<div class="container">
	    <div class="row ">
		<div class="title_part revDiv">
			<h2 class="font60"><?=$section5->sub_title;?></h2>
			<?=$section5->content;?>

			 
		</div>
		<style type="text/css">.caption{display: none!important;}</style>
		<div class="testimonial slider">
			<?php foreach ($featured_stylist as $key => $vender): ?>
				<?php echo stylist_review_div($vender)?>	
			<?php endforeach ?>
		</div>
	</div>
	</div>
</section>


<section class="qualified "style="display:none!important">
	<div class="container">
	   <div class="row m-0">
		<div class="ywllo_bg">
			<?=$section7->content;?>
			<a href="<?=base_url('services')?>" class="action_bt_2" >Book a session now!</a>
		</div>
	</div>
	</div>
</section>


<section class="outfits"  style="display:none!important">
	
	<div class="container">
		<div class="title_part">
			<h2 class="font60"><?=$section8->sub_title;?></h2>
		</div>
		
		<div class="m_space">
			<div class="row m-0 align-items-center">
				<div class="col-sm-12 col-12 p-0">
					<div class="men_women">
						<a id="m_shopping" class="men_women_active">Mens Shopping</a>
						<a id="w_shopping" >Womens Shopping</a>
						<a href="<?=base_url('shop')?>" class="action_bt_2">View All</a>
					</div>
				</div>

			
			
			
			</div>
		</div>
			
		<section class="outfits_slider_men">
			<div class="row m-0 monile_non">
				<?php if(!empty($products_men)) {  ?>
					<?php foreach($products_men as $product) {  ?>
						 <div class="col-sm-3 col-md-3 col-lg-3 col-6">
						 	<?=product_home_div($product);?>
						 </div>
					<?php }  ?>	
				<?php } ?>	
				
			</div>

			<div class="men_sdk">
				
				<section class="tranding_style slider">
					
					<?php if(!empty($products_men)) {  ?>
					<?php foreach($products_men as $product) {  ?>
						 <div class="col-sm-3 col-md-3 col-lg-3 col-6 p-0">
						 	<?=product_home_div($product);?>
						 </div>
					<?php }  ?>	
				<?php } ?>	

				</section>

				
			</div>


		</section>
		
		
		<section class="outfits_slider_women" style="display:none;">
			<div class="row m-0 monile_non">
				<?php if(!empty($products_women)) {  ?>
					<?php foreach($products_women as $product) {  ?>
						<div class="col-sm-3 col-md-3 col-lg-3 col-6">
						 	<?=product_home_div($product);?>
						</div>
					<?php }  ?>	
				<?php } ?>	
				
			</div>

			<div class="men_sdk">
				
				<section class="tranding_style slider">
					
					<?php if(!empty($products_women)) {  ?>
						<?php foreach($products_women as $product) {  ?>
							<div class="col-sm-3 col-md-3 col-lg-3 col-6 p-0">
							 	<?=product_home_div($product);?>
							</div>
						<?php }  ?>	
					<?php } ?>	

				</section>

				
			</div>

		</section>
</section>
 
<section class="partner">
	<div class="container">
	   <div class="row ">
		<div class="title_part">
			<h2 class="font60"><?=$section9->sub_title;?></h2>
			<?=$section9->content;?>
				<div class="col-12    mt-2 "><a href="<?=base_url('brand/all')?>" class="action_bt5 ">View All</a></div>
		</div>
		
		<section class="client_logo slider">
			<?php foreach ($brand as $key => $value) { ?>
				<li><a href="#">
						<?php $img =  'assets/images/no-image.jpg';?>
						<?php if(!empty($value->image)) { ?>
						    <?php 
    				   			$img1 = 'assets/images/brand/'.$value->image;; 
    				   			if (file_exists($img1)) {
    				   				$img = $img1;
    				   			}
    				   		?>
						<?php } ?> 
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
					</a>
				</li>
			<?php }?>	
		</section>
	
		
	</div>
	</div>
</section>
 	

<?php if (!$this->session->userdata('userType')) { ?>	
<section class="register_yellow" style="background: #FAFF00 url('<?=base_url('assets/images/skd.png')?>');">
	<div class="container">
	    <div class="row ">
		<div class="col-sm-9">
			<div class="yellow_title">
				<h3 class="font50 mb80">Register for attractive Styling deals</h3>
				
				<div class="row m-0 justify-content-between">
					
					<div class="col-lg-5 col-md-6 col-sm-6 p-0">
						<div class="log_bottom">
							<h4 class="mb80">Login</h4>
							<div id="response_msg"></div>
							<div class="fm_group">
								<p>Email Id</p>
								<input name="userEmail" id="userEmail" type="text" class="sub_box">
								<div id="email_err"></div>
							</div>
							
							<div class="fm_group">
								<p>Password: </p>
								<div class="fg_gp" style="margin-bottom:0px">
    								<input name="userPassword" id="userPassword" type="password" class="sub_box" style="margin-bottom: 16px;">
    								<i class="toggle-password fa fa-fw fa-eye-slash"></i>
    								<div id="password_err"></div>
    							</div>
							</div>
							<div class="fg_gp" style="margin-top:0px;">
							    <a href="<?= base_url('forgot-password') ?>">Forgot password?</a>
							</div>
							<div class="clearfix"></div>
							<div class="fm_group">
								<a type="submit" value="Login" class="action_bt4" onclick="login()">Login</a>
							</div>
							
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="new_red">
							<h4>New to Stylebuddy?</h4>
							<a href="<?=base_url('user/registration')?>">Register Now!</a>
							<br/><br/>
							<a href="<?=base_url('login/stylistlogin')?>">Login as Stylist!</a>
						</div>
						
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	</div>
</section> 
<?php } ?>


