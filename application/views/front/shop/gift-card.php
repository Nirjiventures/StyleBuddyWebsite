
 
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
							<p class="gc_name22">  <?=$value['name']?></p>
							<p> <?=$this->site->currency.''.$value['gift_code_price']?></p>
						</div>
					
					</div>
	        	<?php }?>
        	<?php }?>
	   	</div>
	</section>
<?php }?>