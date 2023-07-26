<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		<div class="col-sm-12">
			<div class="rightbar">
			    
                <?php 
                    $url1 = $this->uri->segment(1);
                    $url2 = $this->uri->segment(2);
                    $url3 = $this->uri->segment(3);
                ?>
                
                <div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Order Summary</h3>
						</div>
						<div class="col-sm-3 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/myserviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
				 
                <div class="container">
                    <div class="summery_order">
			        	<div class="row">
							<div class="col-sm-9">
								<p><b>Order ID : #<?= (!empty($order->id))? $order->id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order->payment_status))? ucwords($order->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order->order_status))? ucwords($order->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>
							</div>
							
							 
						</div>
						<hr>
						<div class="row">		
							<div class="col-md-12">	
							<span class="text-center mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

								<?=$result;?>
							</div>
						</div>
						 
				
						 
				
			        </div>
				</div>
    	             
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>
</body>
</html>
