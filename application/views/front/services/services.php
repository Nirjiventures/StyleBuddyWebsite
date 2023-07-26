

<?php $section3  =  $seoData; ?>
<div class="middle_part pt-0 mt-5">
	<div class="container">
		<?php if ($our_services) { ?>
			<section class="servicess_slidee">	
				<div class="title_part text-center pinkDiv">
					<h2 class="font60"><?=$section3->sub_title;?></h2>
					<!-- <p class="pink">Because you deserve to look your best</p> -->
					<?=$section3->content;?>
				</div>
				<section class="my_all_services mt-5">

					<div class="row m-0">

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
						<div class="col-sm-4 mb-3">
						 	<?php  service_div($value,$k) ;?>
						</div>
					<?php $i++;}?>


				</div>

				</section>
			</section>
		<?php } ?>
	</div>
</div>