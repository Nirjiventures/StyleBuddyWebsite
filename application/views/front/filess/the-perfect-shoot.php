<?php $this->load->view('Page/template/header'); ?>
<!--========Banner Area ========-->

<!--========End Banner Area ========-->	


<div class="middle_part pt-0">

    <div class="s_banner">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-10">
					<div class="bg-light">
						<div class="row align-items-center">
				<div class="col-sm-4 col-5">
					<?php  if (file_exists($image_path = FCPATH . 'assets/images/services/' . $datas->image)) { ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/'.$datas->image) ?>"  class="img-fluid">
					<?php  } else { ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
					<?php  } ?>
					
					<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$datas->image ?>" class="img-fluid"> -->
				</div>
				<div class="col-sm-6 col-7">
					<h2><?= $datas->title ?></h2>
					<p><?= $datas->short_description ?></p>
					<!-- <a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn m-0">Explore Stylists</a> -->
					<a href="<?=base_url('select-service')?>" class="th_btn m-0">Explore Stylists</a>
					<!-- <a href="<?= base_url('services-develop');?>" class="back_btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> BACK</a> -->
					<a href="<?= base_url('services');?>" class="back_btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> BACK</a>
				</div>
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container service_d">
		<style>
		    .description_bottom li {
                background: linear-gradient(146deg, rgba(116,1,202,1) 0%, rgba(246,42,193,1) 51%, rgba(246,42,193,1) 100%);
                text-align: center;
                color: #fff;
                border-radius: 16px;
                height: 111px;
                width: 15.5%;
                padding: 1%;
                font-weight: bold;
                display: block;
                display: inline-block;
                font-size: 14px;
                margin: 5px;
                line-height: 21px;
                display: grid;
                place-items: center;
            }
    	    .description_bottom ul, .description_bottom ol {
                display: contents;
                justify-content: center;
            }
            @media(max-width:768px){
              .description_bottom li {
                width: 43.5%;
                margin: 12px;
              }  
              
            }
		</style>
	    
		<div class="row pt-0 justify-content-center">
			<div class="col-sm-10 mb-3" style="color: #000000;font-weight: bold;">
				<?= $datas->description_top ?>
			</div>
			<div class="col-sm-10 mt-2">
				<div class="row row-flex description_bottom">
				    <?= $datas->description_bottom ?>
			    </div>
			</div>
			<div class="col-sm-10 text-center">
			    <a href="<?=base_url('select-service')?>" class="pr_btn">Get styled today, look good, feel good.</a>
			    <!--<?php if(!empty($privious)) { ?>
				  <a href="<?= base_url('services/').$privious->slug ?>" class="pr_btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
				<?php }  ?>
				<?php if(!empty($next)) { ?>
				<a href="<?= base_url('services/').$next->slug ?>" class="n_btn"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				<?php } ?>-->
			</div>
			<!--<a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn m-0 mt-3">Book your initial consultation</a>-->
		</div>
	
	</div>
	
</div>


<?php $this->load->view('Page/template/footer'); ?>