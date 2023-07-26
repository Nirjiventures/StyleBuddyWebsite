<div class="banner_inner">
	<div class="container">
		    <h1><?= ucwords($cmsData->title) ?></h1>
		    <?php 
        		$this->breadcrumb = new Breadcrumbcomponent();
        		$this->breadcrumb->add('Home', base_url());
        		$this->breadcrumb->add(ucwords($cmsData->title), base_url($this->uri->segment(1)));
        	?>
        	<?php echo $this->breadcrumb->output(); ?>
		</div>
</div>
<div class="middle_part pt-0">
	<div class="container plcy_content">
		<div class="row">
			<div class="col-sm-12 mt-4">
			    <?= $cmsData->content; ?>
			</div>
		</div>
	</div>
</div>
