<?php  $this->load->view('Page/template/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

<!--========Banner Area ========-->
<style type="text/css">
	.photo_jjw img {
	    width: 100%;
	    height: 350px;
	    object-fit: contain;
	}
	.tz-gallery h3{
		font-size: 34px!important;
	}
	.photo_jjw a h4{
		    color: #000;
		    text-transform: uppercase;
		    font-size: 14px!important;
		    font-weight: 600;
		    background: #e3e3e3;
		    padding: 11px 14px;
		    margin-top: 9px;
	}
	#baguetteBox-overlay .full-image figcaption{
		font-size: 22px!important;
	}
	a.lightbox{
		position: relative;
	    display: block;
	    border-radius: 3px;
	    margin-bottom: 20px;
	    padding: 5px;
	    border: 1px solid #fff;
	}
	a.lightbox:hover{
		border: 1px solid #333;
	}
	a.lightbox .vi-btn{
		height: 50px;
		width: 50px;
		border-radius: 50%;
		line-height: 50px;
		text-align: center;
		color: #fff;
		background: rgb(0 0 0 / 59%);
		font-size: 18px;
		display: none;
		position: absolute;
		left: 50%;
		top: 40%;
    	transform: translate(-50%, -50%);
		z-index: 9;
	}
	a.lightbox .vb-btn{
		    height: auto;
	    width: auto;
	    line-height: 20px;
	    text-align: center;
	    color: #fff;
	    background: rgb(0 0 0 / 59%);
	    font-size: 15px;
	    position: absolute;
	    left: 5px;
	    top: 5px;
	    z-index: 9;
	    padding: 4px 11px
	}
	a.lightbox:hover .vi-btn{
		display: block;
	}
	.fancybox-caption__body {
	    font-size: 20px;
	}
	.fancybox-button--share{
		color: #f62ac1;
	}
	.tz-gallery .aaaa{
	    font-size: 18px;
        color: #f81cbf;
        font-weight: bold;
	}
</style>

<!--========End Banner Area ========-->	
<div class="middle_part ffc">
	<div class="container">
		<div class="gallery_wala tz-gallery ">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="h1_title"><span>Video Gallery</span></h1>
					<p>Stylists showcasing their portfolio work on stylebuddy- Home to India's best styling & fashion professionals.</p>
					<?php $vender = $seoData;?>
					<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-', $vender->city_name)) ?>
					<a href="<?= $url ?>" class="aaaa">View My Services</a>
					
					<?php 
                		$this->breadcrumb = new Breadcrumbcomponent();
                		$this->breadcrumb->add('Home', '/');
                		$this->breadcrumb->add('Fashiongram Video', '/fashiongram-video');
                		$this->breadcrumb->add('Video Gallery', '/fashiongram-video');
                	?>
                 
                	<?php echo $this->breadcrumb->output(); ?>
				</div>
			</div>
	        <div class="row mt-4">
    		    <?php foreach($portfolioArray as $k=>$video){ ?>
        		    <?php if($video->image){ ?>
        		        <?php if($video->videoType == 'youtube') {  ?>
				    		<div class="col-sm-4 youtube">
				    			<div class="my_youtube">
					    		    <div class="my_video">
										<iframe width="100%" height="320" src="https://www.youtube.com/embed/<?=$video->image?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					    			</div>
					    		</div>
				    		</div>
		    			<?php }else{  ?>
		    				<div class="col-sm-4">
		    					<div class="my_youtube">
			    				    <div class="my_video local">
					    				<video class="video-col-1 hiddenControls" width="100%" height="320" controls>
							                <source src="<?=base_url('assets/images/story/'.$video->image)?>#t=2,1" type="video/mp4">
							            </video>
					    			</div>
					    		</div>
					    	</div>
		    			<?php }  ?>
        			<?php } ?>
    			<?php } ?>
		    
			
			
	</div>
</div>

	</div>
</div>







<?php $this->load->view('Page/template/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    // Fancybox Config
$('[data-fancybox="gallery"]').fancybox({
  buttons: [
    "slideShow",
    "share",
    "close"
  ],
  loop: false,
  protect: true
});

</script>

