<?php  $this->load->view('Page/template/header'); ?>

<!-- <div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3><?= ucwords($cmsData->title) ?></h3></div>
	</div>	
</div> -->
<div class="ab-banner_inner">
		<div class="container text-center">
		    <h1><?= ucwords($cmsData->title) ?></h1>
		    <?php 
        		$this->breadcrumb = new Breadcrumbcomponent();
        		$this->breadcrumb->add('Home', '/');
        		$this->breadcrumb->add(ucwords($cmsData->title), '/'.$this->uri->segment(1));
        	?>
         
        	<?php echo $this->breadcrumb->output(); ?>
		 </div>
</div>
<div class="middle_part pt-0">
	<div class="container plcy_content">
		<div class="row">
			<div class="col-sm-12 text-center">
				<!-- <h3><?= ucwords($cmsData->title) ?></h3> -->
			</div>
			<div class="col-sm-12 mt-4">
			    <?= $cmsData->content; ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Page/template/footer'); ?>