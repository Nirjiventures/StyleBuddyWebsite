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
							<a href="<?=base_url('vendor/serviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
				 
                <div class="container">
                    <div class="">
								<?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('success');?>
											<table>
												<tr>
													<td>Name : </td>
													<td><?= ucwords($order_detail->user_row->fname.' '.$order_detail->user_row->lname);?></td>
												</tr>
												<tr>
													<td>Email : </td>
													<td><?= ucwords($order_detail->user_row->email);?></td>
												</tr>
												<tr>
													<td>Mobile : </td>
													<td><?= ucwords($order_detail->user_row->mobile);?></td>
												</tr>
											</table>
											
										</div>
									</div>
									<input type="hidden" name="id" value="<?= $order->id ?>">
									 
								<?php echo form_close();?>

								 
							</div>
				</div>
    	             
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>
</body>
</html>
