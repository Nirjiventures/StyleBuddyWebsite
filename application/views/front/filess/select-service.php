<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<?php  $this->load->view('Page/template/header'); ?>

<style type="text/css">
.cate_block img {
    width: 100%;
    height: 530px;
    object-fit: cover;
    border-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}
.new_s p {
    font-size: 16px;
    padding: 0px 10px;
    color: #000;
    /* text-transform: uppercase; */
    font-weight: bold;
    line-height: 24px;
    padding-bottom: 5px;
    text-align: center;
}
.cate_block {
    /* background: var(--bg-light-skin); */
    /* text-align: center; */
    /* padding: 5px; */
    border-radius: 0px;
    box-shadow: 0px 0px 10px 4px rgb(0 0 0 / 28%);
    margin-bottom: 24px;
    border: 1px solid #f0f0f5;
    box-shadow: 0 4px 8px rgb(0 0 0 / 12%);
    /* border-radius: 24px; */
    box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
    margin-bottom: 40px;
    position: relative;
    height: 100%;
}
.cate_block:hover img {
    transform: scale(1.1);
}
.cate_block:after {
    content: '';
    position: absolute;
    width: 15%;
    height: 2px;
    background: #f62ac1;
    left: 40%;
    transition: all 0.5s;
    bottom: -2px;
}
.cate_block:hover:after {
    right: 0;
    width: 100%;
    left: 0;
}
@media(max-width: 768px){
	.cate_block{margin-bottom:0px;}
}
</style>
<div class="what_would color_1 pt-5">
	<div class="text-center">
		<h2>What would you like to do today?</h2>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', '/');
			$this->breadcrumb->add('Services', '/select-service');
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
	
	<div class="container_full_2 mt-5">
		<div class="row m-0 row-flex">
			<?php if(!empty($expertises)) { $i=0;?>
		        <?php   foreach($expertises as $list) {  ?>
        			<div class="col-6 col-sm-3">
						<div class="cate_block new_s">
							<?php 
								if ($list->slug == 'designer-dresses') {
									$url =  base_url('shop');
								}else{
									$url =  base_url($url1.'/'.$list->slug);
								}
							?>
							<a href="<?= $url ?>">
								<div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div>
									<p><?= $list->title_develop ?></p>
									
								<?php   if($i%2==0) {  ?>
									<!-- <div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div>
									<p><?= $list->title ?></p> -->
					        	<?php 	}else{ ?>
					        		<!-- <p><?= $list->title ?></p>
					        		<div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div> -->
								<?php 	} ?>
							</a>
						</div>
					</div>
	            <?php  $i++;} ?>
	        <?php } ?>
		</div>
	</div>
</div>
<?php $this->load->view('Page/template/footer'); ?>
