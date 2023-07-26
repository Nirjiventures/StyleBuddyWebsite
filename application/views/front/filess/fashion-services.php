<?php  $this->load->view('Page/template/header'); ?>

<div class="middle_part mt-5 pt-0">
	<div class="container">
		<div class="row">
    		<div class="col-sm-12 text-center">
    			<h2>FASHION SERVICES</h2>
    			<p>If you have a query or an ask that has the word Fashion or style associated with it , then we will assist in connecting you to experts & brands who can provide a customized solution. From virtual styling to personal shopping , image management to gift curation , weddings to lookbook shoots we have you covered.</p>
    		</div>
    	</div>
    	<div class="row mt-5 f_services">
    		<div class="col-sm-10 offset-sm-1">
    		    
    		    <?php if(!empty($fashonService)) $count = 1; $dpt = 0; { foreach($fashonService as $list) { ?>
    			
    		 <?php  if($dpt % 2 == 0 ) { ?>
    			<div class="row align-items-center">
    				<div class="col-sm-5">
    					<div class="f_box">
    						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="IMG" src="<?= base_url('assets/images/services/').$list->details_image ?>" class="img-fluid">
    					</div>
    				</div>
    				<div class="col-sm-7">
    					<h2><span><?= $count; ?></span><?= $list->name ?></h2>
    					<?= $list->content ?>
    				</div>
    			</div>
    			<?php } else { ?>
    			<div class="row align-items-center mt-5">
    				<div class="col-sm-7">
    						<h2><span><?= $count; ?></span><?= $list->name ?></h2>
    						<?= $list->content ?>
    				</div>
    				<div class="col-sm-5">
    					<div class="f_box">
    						<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="IMG" src="<?= base_url('assets/images/services/').$list->details_image ?>" class="img-fluid">
    					</div>
    				</div>
    			</div>
    			<?php } ?>
            <?php  $dpt++; $count++; } } ?>
    		</div>
    	</div>
    </div>
</div>

<?php $this->load->view('Page/template/footer'); ?>