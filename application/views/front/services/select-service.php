<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<div class="banner_inner">
	<div class="container">
		<h2><?php echo $expertises->title_develop;?> </h2>
        <?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Services', base_url('select-service'));
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>


<div class="middle_part">
	<div class="container">
		<div class="all_loc text-center">
			<h1>Services</h1>
			<hr/>
			<div class="select_stylish">
				<div class="row m-0 justify-content-center">
					<?php if(!empty($expertises)) { $i=0;?>
				        <?php   foreach($expertises as $list) {  ?>
		        			<div class="col-sm-2">
								<div class="jogi">
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
									
									<a href="<?= $url ?>" class="<?= $actp ?>">
										<?= $list->title_develop ?> 
									</a>
								</div>
							</div>
					    <?php  $i++;} ?>
			        <?php } ?>
		        </div>
			</div>
		</div>
	</div>
</div>