<?php  $this->load->view('Page/template/header'); ?>
<?php
  header('Refresh:4; url= '. base_url().'/user/user-orders'); 
?>
<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Thanks For Shopping</h3></div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<!--<h3>Thanks</h3>-->
			</div>
			<div class="col-sm-12 mt-4">
			        <div class="card shadow-lg">
                        <div class="card-header">
                            Congratulate
                        </div>
                         <div class="card-body text-center">
                          <h5 class="card-title">Dear <?= ucwords($order->fname.' '.$order->lname) ?>,</h5>
                           <p class="card-text">Your order has been successfully placed.</p>
                           <a href="<?= base_url('user/user-orders') ?>" class="btn btn-primary text-white">Go to dashboard</a>
                         </div>
                    </div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('Page/template/footer'); ?>