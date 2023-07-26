<?php  $this->load->view('front/template/header'); ?>

<style>
 @media screen and (min-width: 200px) and (max-width: 767px){
    a.shop-filter-active {
    color: #000;
    width: 100%;
   
    display: block;
    margin-bottom: 30px;
    font-weight: bold;
}
.middle_part {
    padding: 0px 0px;
    margin-top: 20px!important;
}

}
</style>

<div class="middle_part mt-5 pt-0">
	<div class="container">
		<?php if(isMobile()){ ?>
		<div class="cat_filter">
		    <a href="#" class="shop-filter-active">Category <i class="fa fa-angle-down" aria-hidden="true"></i></a>
			
			<div class="product-filter-wrapper" style="display: none;">
                  <?php $this->load->view('front/stories/right-sidebar'); ?> 
			</div>

		</div>
		<?php } ?>
		<div class="row mb-4">
    		<div class="col-sm-12 bg-list text-center">
    			<h2>Daily Styling tips for you</h2>
    		</div>
    	</div>
    	<div class="row m-0">
    	    
    		<div class="col-sm-9">
    			<div class="row blog-list m-0">
    			    
    			    <?php if(!empty($datas)) { ?>
    			    	<?php foreach($datas as $data) { ?>
	    			        <div class="col-md-12 col-lg-12 col-sm-12 ">
				    			<div class="stories_box">
				    				<div class="row align-items-center m-0">
				    					<div class="col-sm-3 p-0">
				    						<div class="stories_img">
				    							<a href="<?= base_url('style-stories/').$data->blogSlug ?>">
					    							<?php  $img = image_exist($data->blogImage,'assets/images/story/'); ?>
											    	<?php  if ($data->blogImage_type == 'video') { ?>
											    		<?php  $img = image_exist($data->blogImage_thumbnail,'assets/images/story/'); ?>
											    		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
											        <?php  }else{ ?>
												    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
												    <?php  } ?>

						    					</a>
						    					<div class="time"><?=  date('M j, Y',strtotime($data->created_at)); ?></div>
						    				</div>
				    					</div>
				    					<div class="col-sm-9">
				    						<h4><a href="<?= base_url('style-stories/').$data->blogSlug ?>"> <?=  mb_strimwidth($data->blogTitle,0,36, '....'); ?> </a></h4>
						    				<p class="mt-2"><?=  mb_strimwidth($data->shortData,0,136, '....'); ?></p>
						    				<a href="<?= base_url('style-stories/').$data->blogSlug ?>" class="action_bt_2">Read More</a>
				    					</div>
				    				</div>
				    			</div>
				    		</div>

	                    <?php }  ?>
	                    <div class="row mt-5 justify-content-center">
				      		<div class="col-sm-12">
				      		    <div id="pagination_link"></div>
				 				<?php echo $this->pagination->create_links(); ?>
				      		</div>
				      	</div>
		    		<?php }  else { ?>
                 		<div class="col-md-12 col-lg-12 col-sm-12 ">
                             <h3 class="h2 text-center mt-5 p2">Style Stories not found</h3> 
                  		</div>
              		<?php } ?>
	    		</div>
	    	</div>

    	    <?php if(!isMobile()){ ?>
    		<div class="col-sm-3">
    			<?php $this->load->view('front/stories/right-sidebar'); ?>
    			   
    		</div>
    		<?php } ?>
    	</div>
    </div>
</div>


<?php $this->load->view('front/template/footer'); ?>