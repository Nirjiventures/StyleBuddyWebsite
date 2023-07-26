<?php $section9  =  $seoData; ?>

<section class="partner_all">
	<div class="container">
		<div class="title_part text-center">
			<h2 class="font70"><?=$section9->sub_title;?></h2>
			<?=$section9->content;?>
		</div>
		<div class="cl_logo_b">
			<ul>
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
					    <img alt="Personal Styling | StyleBuddy" src="<?=base_url($img);?>" class="img-fluid">
					</a>
				</li>
			<?php }?>	
			</ul>
		</div>
	</div>
</section>