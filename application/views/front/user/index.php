
<?php $this->load->view('front/template/header'); ?>

<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/user/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1">
					 
					<div class="yellow_part">
						<p><b>Welcome to your Stylebuddy Dashboard, <?= $profile->fname.' '.$profile->lname ?></b></p>

						<p>We are Excited to help you on your Fashion Styling Journey. Track the products & styling services you purchased, view your wishlist and much more.. </p>

						<img src="<?php echo base_url(); ?>assets/images/sdk-men.png">
					</div>


					<div class="block_box">
						<div class="row m-0">
							
							<div class="col-sm-3 col-6">
								<div class="buy_new">
									<a target="_blank" href="<?=base_url('services')?>">
										<p>Buy a new Styling <br>Service</p>
										<span><img src="<?php echo base_url(); ?>assets/images/long_arrow.png"></span>
									</a>
								</div>
							</div>
 
							<div class="col-sm-3 col-6">
								<div class="buy_new">
									<a target="_blank" href="<?=base_url('shop')?>">
										<p>Shop Stylist <br>Curated Outfits</p>
										<span><img src="<?php echo base_url(); ?>assets/images/long_arrow.png"></span>
									</a>
								</div>
							</div>

							<div class="col-sm-3 col-6">
								<div class="buy_new">
									
										<p style="color:#fff">Download the <br>Stylebuddy App</p>
										<span><a target="_blank" href="https://play.google.com/store/apps/details?id=com.gmt.stylebuddy"><img src="<?php echo base_url(); ?>assets/images/paly-store.png" style="width: 25px;"></a></span>
										<span><a target="_blank" href="https://apps.apple.com/in/app/stylebuddy-india/id1619093846"><img src="<?php echo base_url(); ?>assets/images/paly-store-ios.png" style="width: 25px;"></a></span>
									
								</div>
							</div>

							 

							<div class="col-sm-3 col-6">
								<div class="buy_new">
									<a target="_blank" href="<?=base_url('style-stories')?>">
										<p>Browse Fashion <br>Styling tips</p>
										<span><img src="<?php echo base_url(); ?>assets/images/long_arrow.png"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="data_tottl">

						<div class="col-sm-6">
							<div class="row m-0">
								
								<div class="col-sm-6 col-6">
									<a href="<?=base_url('user/myshoporder')?>" style="    text-decoration: none;">
										<div class="total_itm">
											<?php 
											$table = 'user_order_details';
									        $condition = " WHERE user_id = '".$this->userID."' ";
									        $condition .= " AND cart_type != 'service'";
									        $condition .= " order by id DESC";

									        $list = $this->common_model->get_all_details_query($table,$condition)->num_rows();

											?>
											<h4><?=$list?></h4>

											<p>Total Products <br>Purchased</p>
										</div>
									</a>
								</div>

								<div class="col-sm-6 col-6">
									<a href="<?=base_url('user/myserviceorder')?>" style="text-decoration: none;">
										<div class="total_itm">
											<?php 
											$table = 'user_order_details';
									        $condition = " WHERE user_id = '".$this->userID."' ";
									        $condition .= " AND cart_type = 'service'";
									        $condition .= " order by id DESC";

									        $list = $this->common_model->get_all_details_query($table,$condition)->num_rows();

											?>
											<h4><?=$list?></h4>
											<p>Total Styling Services<br> Purchased</p>
										</div>
									</a>
								</div>

								<!--<div class="col-sm-6 col-6">
									<a href="#" style="text-decoration: none;">
										<div class="total_itm">
											<h4>50</h4>
											<p>Total Styling<br> Sessions </p>
										</div>
									</a>
								</div>-->

								<div class="col-sm-6 col-6">
									<a href="<?=base_url('user/user-wishlist')?>" style="    text-decoration: none;">
										<div class="total_itm">
											<h4><?php echo $this->db->where(['user_id'=> $this->userID ])->from("wishlist")->count_all_results(); ?></h4>
											<p>Total Products in<br> Wishlist</p>
										</div>
									</a>
								</div>


							</div>

						</div>
					</div>



					<div class="rightbar" style="display: none;">
						<h2>Welcome  </h2>
						<p><?= ucwords( $profile->fname.' '.$profile->lname ) ?></p>
						<hr>
						<div class="row">
							<div class="col-sm-4 col-6">
								<a href="<?=base_url('user/user-orders')?>" style="    text-decoration: none;">
									<div class="week bx-1">
										<p><b>Total Product Purchases </b></p>
										<h3 class=""><?php echo $this->db->where(['user_id'=> $this->userID ])->from("user_order")->count_all_results(); ?></h3>
									</div>
								</a>
							</div>
							
							<div class="col-sm-4 col-6">
								<a href="<?=base_url('user/user-wishlist')?>" style="    text-decoration: none;">
									<div class="week bx-2">
										<p><b>Total Value </b></p>
										<h3><?= $this->site->currency ?> <?php 
									$ss = $this->db->query('select sum(productPrice)  as productPrice from user_order_details where user_id = "'.$this->userID .'"')->row();
									if ($ss && !empty($ss->productPrice)) {
									 	echo $ss->productPrice;
									}else{
										echo 0;
									} 
								?></h3>
									</div>
								</a>
							</div>
							
							<div class="col-sm-4 col-6">
								<a href="<?=base_url('user/user-wishlist')?>" style="    text-decoration: none;">
									<div class="week bx-3">
										<p><b>Product in Wish List</b></p>
										<h3><?php echo $this->db->where(['user_id'=> $this->userID ])->from("wishlist")->count_all_results(); ?></h3>
									</div>
								</a>
							</div>
							
							<div class="col-sm-4 col-6">
								<a href="<?=base_url('user/user-orders')?>" style="    text-decoration: none;">
									<div class="week bx-1">
										<p><b>Total Services Purchases </b></p>
										<h3 class=""><?php echo $this->db->where(['user_id'=> $this->userID ])->from("services_booking")->count_all_results(); ?></h3>
									</div>
								</a>
							</div>
							
							<div class="col-sm-4 col-6">
								<a href="<?=base_url('user/user-wishlist')?>" style="    text-decoration: none;">
									<div class="week bx-2">
										<p><b>Total Services Value </b></p>
										<h3><?= $this->site->currency ?> <?php 
									$ss = $this->db->query('select sum(total_price)  as productPrice from services_booking where user_id = "'.$this->userID .'"')->row();
									if ($ss && !empty($ss->productPrice)) {
									 	echo $ss->productPrice;
									}else{
										echo 0;
									} 
								?></h3>
									</div>
								</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/template/footer'); ?>
