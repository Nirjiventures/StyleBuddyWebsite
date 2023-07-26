<?php $this->load->view('front/boutiques/header'); ?>
<div class="main">
	<div class="container">
		 
		<div class="col-sm-12">
			<?php //$this->venderId = 10;?>
			<div class="rightbar">
				<div class="row">
					<div class="col-sm-9">
						<h2>My Dashboard</h2>
					</div>

					<div class="col-sm-3 text-end">
						<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
						&nbsp; - &nbsp; 
						<a href="<?=base_url('boutiques/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
					</div>

				</div>
				<hr>
				<div class="row">
					<div class="col-sm-4 ">
						<a href="<?=base_url('boutiques/manageProducts')?>" style="text-decoration: none;">
						<div class="week bx-1">
							<p><b>Total Products</b></p>
							<h3 class=""><?= $this->db->where(['user_id'=> $this->venderId ])->from("products")->count_all_results(); ?></h3>
						</div>
						</a>
					</div>
					
					<div class="col-sm-4  ">
						<a href="<?=base_url('boutiques/completedorderslist')?>" style="text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Sale</b></p>
								<h3><?= $this->site->currency ?> 
									<?php 
										$ss = $this->db->query('select sum(productPrice)  as productPrice from user_order_details where vendor_id = "'.$this->venderId .'" AND order_status = "COMPLETED"')->row();
										if ($ss && !empty($ss->productPrice)) {
										 	echo $ss->productPrice;
										}else{
											echo 0;
										} 
									?>
								</h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-4  ">
						<a href="<?=base_url('boutiques/allorders')?>" style="text-decoration: none;">
							<div class="week bx-3">
								<p><b>Total Orders</b></p>
								<h3>
									<?php 
										$ss = $this->db->query('select sum(productQty)  as productQty from user_order_details where vendor_id = "'.$this->venderId .'"')->row();
										if ($ss && !empty($ss->productQty)) {
										 	echo $ss->productQty;
										}else{
											echo 0;
										} 
									?>
									
								</h3>
							</div>
						</a>
					</div>
				</div>
				<hr>
				<div class="row" style="display: none;">
					<div class="col-sm-4  ">
						<a href="<?=base_url('boutiques/myorders')?>" style="    text-decoration: none;">
							<div class="week bx-1">
								<p><b>Total Product Purchases </b></p>
								<h3 class=""><?php echo $this->db->where(['user_id'=> $this->venderId ])->from("user_order")->count_all_results(); ?></h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-4  ">
						<a href="<?=base_url('boutiques/myorders')?>" style="    text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Value </b></p>
								<h3><?= $this->site->currency ?> <?php 
									$ss = $this->db->query('select sum(productPrice)  as productPrice from user_order_details where user_id = "'.$this->venderId .'"')->row();
									if ($ss && !empty($ss->productPrice)) {
									 	echo $ss->productPrice;
									}else{
										echo 0;
									} 
								?></h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-4  ">
						<a href="<?=base_url('boutiques/wishlist')?>" style="    text-decoration: none;">
							<div class="week bx-3">
								<p><b>Product in Wish List</b></p>
								<h3>
									<?php echo $this->db->where(['user_id'=> $this->userID ])->from("wishlist")->count_all_results(); ?>
								</h3>
							</div>
						</a>
					</div>
				</div>
				
				 
				<?php if($this->session->userdata('adminEmail')){ ?>
					<?php echo form_open_multipart('',['id'=>'catfrmm']);?>
					<div class="row mt-5" style="display: none;border: 2px solid;">
						<div class="form-group row">
						   <div class="col-md-12 mt-4 mb-2">
						         <h4><b>SEO Section(Admin use only)</b></h4>
						   </div>
						   <hr/>
						</div>
						
						<div class="form-group row">
						   <div class="col-md-12">
						         <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
						         <textarea id="meta_title" name="meta_title" rows="2" class="form-control"><?= $profile->meta_title ?></textarea>
						   </div>
						</div>
						<div class="form-group row">
						   <div class="col-md-12  ">
						         <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
						         <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"><?= $profile->meta_keyword ?></textarea>
						   </div>
						</div>
						<div class="form-group row">
						      <div class="col-sm-12  ">
						           <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
						            <textarea id="meta_description" name="meta_description" rows="2" class="form-control"><?= $profile->meta_description ?></textarea>
						             
						      </div>
						</div>

						<div class="form-group row">
							<div class="col-sm-12 ">
						   		<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/boutiques/footer'); ?>
 