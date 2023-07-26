



<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<div class="banner_inner">
	<div class="container">
		<h1><?php //echo $expertises->title_develop;?> Connect With Stylists</h1>
        <?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Services', base_url('connect-with-stylists'));
		?>
		<?php if(!empty($expertises_list)) { $i=0;?>
	        <?php   foreach($expertises_list as $list) {  ?>
    					<?php 
							if ($list->slug == $url2) {
								$this->breadcrumb->add($list->title_develop, $url2);
							}
						?>
			<?php  $i++;} ?>
        <?php } ?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>

<div class="middle_part">
	<div class="container">	
		<div class="all_loc text-center">
			<h1><?php echo $expertises->sub_title;?></h1>
			<hr/>
			<div class="select_stylish">
				<div class="row m-0 justify-content-center">
					<ul>
					<?php //var_dump($expertises_list);?>
					<?php if(!empty($expertises_list)) { $i=0;?>
				        <?php   foreach($expertises_list as $list) {  ?>
		        			
									<?php 
										if ($list->slug == 'designer-dresses') {
											$url =  base_url('shop');
										}else{
											$url =  base_url($url1.'/'.$list->slug);
										}
									?>
									<?php 
										if ($list->slug == $url2) {
											$actp =  'actp';
										}else{
											$actp =  '';
										}
									?>
									<li>
									<a href="<?= $url ?>" class="<?= $actp ?>">
										<?= $list->title_develop ?> 
									</a>
								</li>
					    <?php  $i++;} ?>
			        <?php } ?>
			    	</ul>
		        </div>
			</div>
		</div>
		<div class="stylist_list">
			<div class="row m-0">
		        <?php 	if(!empty($venders)) {?>
		        	<?php  	foreach($venders as $vender) { ?>
		        		<?=stylist_div($vender);?>
					<?php } ?>
				<?php }else{ ?>
					<h1 class="text-center"><b>We are coming soon to your area. STAY TUNED! </b><br/><br/></h1>
					<hr/>
				<?php } ?>
	      	</div>
		</div>
		<div class="row mt-5 justify-content-center">
      		<div class="col-sm-12">
      		    <div id="pagination_link"></div>
 				<?php echo $this->pagination->create_links(); ?>
      		</div>
      	</div>

		<?php if($expertises->description){?>
			<div class="seo_data">
				<div class="paper sharp-fold">
					<?php echo $expertises->description;?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
