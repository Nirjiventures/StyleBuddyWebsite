<?php 
	$catlist = array(); 
	foreach($products as $list) { 
      	$catlist[] = $list->cat_id;        
	}   
?>
<?php  	$filter_discount = $this->common_model->get_all_details('filter_discount',array('featured'=>1))->row_array();?>
<?php  	$shop_slider = $this->common_model->get_all_details('shop_slider',array('status'=>1),array(array('status'=>1)))->result_array();?>
<?php 	$section8  =  $seoData; ?>

<div class="middle_part">
	<div class="container">
		<div class="welcome_shop">
				<h1 class="text-center fontstyle"><b><?=$section8->sub_title;?></b></h1>
		</div>
		<?php 	if($shop_slider){ ?>
			<div class="my_sho_slider">
				<div id="demo" class="carousel slide" data-bs-ride="carousel">
				  	<div class="carousel-indicators">
				  		<?php $i=0;foreach ($shop_slider as $key => $value) { if($i==0){$act='active';}else{$act='';}?>
					  		<button type="button" data-bs-target="#demo" data-bs-slide-to="<?=$i?>" class="<?=$act?>"></button>
						<?php $i++;}?>
				  	</div>
				  	<div class="carousel-inner">
					  	<?php $i=0;foreach ($shop_slider as $key => $value) { if($i==0){$act='active';}else{$act='';}?>
					    	<div class="carousel-item <?=$act?>">
					    		<?php $img =  'assets/images/slider/slider.jpg';?>
								<?php if(!empty($value['slider_image']))  {?>
							   		<?php 
							   			$img1 =  'assets/images/slider/'.$value['slider_image']; 
							   			if (file_exists($img1)) {
							   				$img = $img1;
							   			}
							   		?>
							   	<?php } ?>
								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url($img); ?>" alt="Stylebuddy" class="d-block" style="width:100%">
								<div class="ctp">
				    		      	<div class="row m-0 align-items-center">
				    		      		<div class="col-sm-6 text_cent">
				    		      		    <h3><?=$value['title']?></h3>
				    		      		    <p class="enj"><?=$value['sub_title']?></p>
				    		      	    	<div class="my_dis_new"> 
				    		      	    		<a href="<?php echo base_url('shop/outfits-for-vacation?catid=81'); ?>">DISCOVER 
				    		      	    			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/shopping-cart.png" class="shppi_icon">
				    		      	    		</a>
				    		      	    	</div>
				    					</div>
				    				</div>
			    		 	 	</div>
					      	</div>
					    <?php $i++;}?>
				  	</div>
				</div>
			<?php 	} ?>
		</div>
	</div>
</div>

<?php if ($featuredCategory) {?>
	<div class="container">
		<section class="my_cate">
			<div class="title_part text-center mb-4">
				<h2 class="fontstyle">Popular Categories</h2>
			</div>
			<div class="row m-0">
				<?php foreach ($featuredCategory as $key => $value) {?>
					<div class="col-md-5-cols col-6">
						<div class="my_exp_list2">
							<?php $img =  'assets/images/no-image.jpg';?>
							<?php if(!empty($value['cat_image']))  {?>
						   		<?php 
						   			$img1 =  $value['cat_image']; 
						   			if (file_exists($img1)) {
						   				$img = $img1;
						   			}
						   		?>
						   	<?php } ?>
						   <a href="<?php echo base_url('shop/'.$value['slug'].'?catid='.$value['id']); ?>">
  								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">
  							</a>
							<div class="hed_part_list"><p><?=$value['name']?></p></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	</div>
<?php } ?>
 
<?php 	if($filter_discount){ ?>
	<div class="title_part text-center mb-4">
		<div class="container"><h2 class="fontstyle">Limited Time Offer</h2></div>
	</div>
	<div class="container">
		<section class="limit_off off_banner">
			<?php $img =  'assets/images/filter-discount/discount.jpg';?>
			<?php if(!empty($filter_discount['image']))  {?>
		   		<?php 
		   			$img1 =  'assets/images/filter-discount/'.$filter_discount['image']; 
		   			if (file_exists($img1)) {
		   				$img = $img1;
		   			}
		   		?>
		   <?php } ?>
			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="img-fluid">
			<div class="offers_box">
				<h3>Sale</h3>
				<h5><?=$filter_discount['label']?></h5>
				<p><?=$filter_discount['description']?></p>
				<a href="<?php echo base_url(); ?>shop/all?discount[]=<?=$filter_discount['value']?>">Discover</a>
			</div>
		</section>
	</div>
<?php 	} ?>
 
<?php $giftCrad = $this->common_model->get_all_details_query('gift','WHERE status = 1')->result_array();?> 
<?php 	if($giftCrad){ ?>
	<section class="coupp">
		<div class="title_part text-center mb-4">
			<div class="container"><h2 class="fontstyle">Gift Cards</h2></div>
		</div>
		<div class="row m-0 justify-content-center">
	    	<?php foreach ($giftCrad as $key => $value) { ?>
	        	<?php if ($value['media']) { ?>
	        		<div class="col-sm-3">
						<div class="gtt">
							<?php $img =  'assets/images/no-image.jpg';?>
							<?php if(!empty($value['media']))  {?>
					            <?php 
					                $img1 =  $value['media']; 
					                if (file_exists($img1)) {
					                    $img = $img1;
					                }
					            ?>
					        <?php } ?>

							 
							<a href="<?=base_url('gift/giftcard/'.base64_encode(base64_encode(base64_encode($value['id']))))?>">
							<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=400&new_height=400&image='.$img);?>" class="img-fluid">
							</a>
							<p>  <?=$value['name']?></p>
							<p><i class="fa fa-inr"></i>  <?=$this->site->currency.''.$value['gift_code_price']?></p>
						</div>
					
					</div>
	        	<?php }?>
        	<?php }?>
	   	</div>
	</section>
<?php }?>