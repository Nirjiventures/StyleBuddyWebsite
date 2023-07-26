<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<!--<div class="col-sm-3 p-0 sdk">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
		</div>-->

		<div class="col-sm-12">
			<?php //$this->venderId = 10;?>
			<div class="rightbar">
				<div class="row">
					<div class="col-sm-9">
						<h2>My Dashboard</h2>
					</div>

					<div class="col-sm-3 text-end">
						<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
						&nbsp; - &nbsp; 
						<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
					</div>

				</div>
				<hr>
				
				
				<div class="row mbl d-flex">
					<div class="col-sm-4 col-6">
						<a href="<?=base_url('stylist-zone/manage-products')?>" style="text-decoration: none;">
						<div class="week bx-1">
							<p><b>Total Products</b></p>
							<h3 class=""><?= $this->db->where(['vender_id'=> $this->venderId ])->from("products")->count_all_results(); ?></h3>
						</div>
						</a>
					</div>
					
					<div class="col-sm-4 col-6">
						<a href="<?=base_url('stylist-zone/manage-products')?>" style="text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Sale</b></p>
								<h3><?= $this->site->currency ?> 
									<?php 
										$ss = $this->db->query('select sum(productPrice)  as productPrice from user_order_details where venderId = "'.$this->venderId .'"')->row();
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
					
					<div class="col-sm-4 col-6">
						<a href="<?=base_url('stylist-zone/orders')?>" style="text-decoration: none;">
							<div class="week bx-1">
								<p><b>Total Orders</b></p>
								<h3>
									<?php 
										$ss = $this->db->query('select sum(productQty)  as productQty from user_order_details where venderId = "'.$this->venderId .'"')->row();
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

					<div class="col-sm-4 col-6">
						<a href="<?=base_url('vendor/managemyorders')?>" style="    text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Product Purchases </b></p>
								<h3 class=""><?php echo $this->db->where(['user_id'=> $this->venderId ])->from("user_order")->count_all_results(); ?></h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-4 col-6">
						<a href="<?=base_url('vendor/managemyorders')?>" style="    text-decoration: none;">
							<div class="week bx-1">
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
					
					<div class="col-sm-4 col-6">
						<a href="<?=base_url('stylist-zone/user-wishlist')?>" style="    text-decoration: none;">
							<div class="week bx-2">
								<p><b>Product in Wish List</b></p>
								<h3>
									<?php echo $this->db->where(['user_id'=> $this->userID ])->from("wishlist")->count_all_results(); ?>
								</h3>
							</div>
						</a>
					</div>
				</div>
				
				<div class="row ">
					 
					
					 

					<div class="col-sm-3   col-6">
						<a href="<?=base_url('vendor/serviceorder')?>" style="    text-decoration: none;">
							<div class="week bx-1">
								<p><b>Total Service Purchases </b></p>
								<h3 class=""><?php echo $this->db->where(['vendor_id'=> $this->venderId ])->from("services_booking")->count_all_results(); ?></h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-3   col-6">
						<a href="<?=base_url('vendor/serviceorder')?>" style="    text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Value </b></p>
								<h3><?= $this->site->currency ?> <?php 
									$ss = $this->db->query('select sum(total_price)  as productPrice from services_booking where vendor_id = "'.$this->venderId .'"')->row();
									if ($ss && !empty($ss->productPrice)) {
									 	echo $ss->productPrice;
									}else{
										echo 0;
									} 
								?></h3>
							</div>
						</a>
					</div>
					
					
					<div class="col-sm-3   col-6">
						<a href="<?=base_url('vendor/myserviceorder')?>" style="    text-decoration: none;">
							<div class="week bx-1">
								<p><b>Total My Service Purchases </b></p>
								<h3 class=""><?php echo $this->db->where(['user_id'=> $this->venderId ])->from("services_booking")->count_all_results(); ?></h3>
							</div>
						</a>
					</div>
					
					<div class="col-sm-3   col-6">
						<a href="<?=base_url('vendor/myserviceorder')?>" style="    text-decoration: none;">
							<div class="week bx-2">
								<p><b>Total Value </b></p>
								<h3><?= $this->site->currency ?> <?php 
									$ss = $this->db->query('select sum(total_price)  as productPrice from services_booking where user_id = "'.$this->venderId .'"')->row();
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
<?php $this->load->view('front/vandor/footer'); ?>



<style>

/* -----------------------------------------------------
	CSS Progress Bars
-------------------------------------------------------- */
.cssProgress {
  width: 100%;
  margin-bottom: 20px;
}
.cssProgress .progress1,
.cssProgress .progress2,
.cssProgress .progress3 {
  position: relative;
  overflow: hidden;
  width: 100%;
  font-family: "Roboto", sans-serif;
}
.cssProgress .cssProgress-bar {
  display: block;
  float: left;
  width: 0%;
  height: 100%;
  background: #3798d9;
  box-shadow: inset 0px -1px 2px rgba(0, 0, 0, 0.1);
  transition: width 0.8s ease-in-out;
}
.cssProgress .cssProgress-label {
  position: absolute;
  overflow: hidden;
  left: 0px;
  right: 0px;
  color: rgba(0, 0, 0, 0.6);
  font-size: 0.7em;
  text-align: center;
  text-shadow: 0px 1px rgba(0, 0, 0, 0.3);
}
.cssProgress .cssProgress-info {
  background-color: #9575cd !important;
}
.cssProgress .cssProgress-danger {
  background-color: #ef5350 !important;
}
.cssProgress .cssProgress-success {
  background-color: #66bb6a !important;
}
.cssProgress .cssProgress-warning {
  background-color: #ffb74d !important;
}
.cssProgress .cssProgress-right {
  float: right !important;
}
.cssProgress .cssProgress-label-left {
  margin-left: 10px;
  text-align: left !important;
}
.cssProgress .cssProgress-label-right {
  margin-right: 10px;
  text-align: right !important;
}
.cssProgress .cssProgress-label2 {
  display: block;
  margin: 2px 0;
  padding: 0 8px;
  font-size: 0.8em;
}
.cssProgress .cssProgress-label2.cssProgress-label2-right {
  text-align: right;
}
.cssProgress .cssProgress-label2.cssProgress-label2-center {
  text-align: center;
}
.cssProgress .cssProgress-stripes,
.cssProgress .cssProgress-active,
.cssProgress .cssProgress-active-right {
  background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.125) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.125) 50%, rgba(255, 255, 255, 0.125) 75%, transparent 75%, transparent);
  background-size: 35px 35px;
}
.cssProgress .cssProgress-active {
  -webkit-animation: cssProgressActive 2s linear infinite;
  animation: cssProgressActive 2s linear infinite;
}
.cssProgress .cssProgress-active-right {
  -webkit-animation: cssProgressActiveRight 2s linear infinite;
  animation: cssProgressActiveRight 2s linear infinite;
}
@-webkit-keyframes cssProgressActive {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 35px 35px;
  }
}
@keyframes cssProgressActive {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 35px 35px;
  }
}
@-webkit-keyframes cssProgressActiveRight {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -35px -35px;
  }
}
@keyframes cssProgressActiveRight {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -35px -35px;
  }
}


/* -----------------------------------------------------
	Progress Bar 2
-------------------------------------------------------- */
.progress2 {
  background-color: #EEE;
  border-radius: 9px;
  box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.2);
}
.progress2 .cssProgress-bar {
  height: 18px;
  border-radius: 9px;
}
.progress2 .cssProgress-label {
  line-height: 18px;
}

@-webkit-keyframes cssProgressGlowActive1 {
  0%, 100% {
    box-shadow: 5px 0px 15px 0px #3798D9;
  }
  45% {
    box-shadow: 1px 0px 4px 0px #3798D9;
  }
}
@keyframes cssProgressGlowActive1 {
  0%, 100% {
    box-shadow: 5px 0px 15px 0px #3798D9;
  }
  45% {
    box-shadow: 1px 0px 4px 0px #3798D9;
  }
}
@-webkit-keyframes cssProgressGlowActive2 {
  0%, 100% {
    box-shadow: 5px 0px 15px 0px #9575cd;
  }
  45% {
    box-shadow: 1px 0px 4px 0px #9575cd;
  }
}
@keyframes cssProgressGlowActive2 {
  0%, 100% {
    box-shadow: 5px 0px 15px 0px #9575cd;
  }
  45% {
    box-shadow: 1px 0px 4px 0px #9575cd;
  }
}


</style>

<script type="text/javascript">
	/*$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})*/
</script>


<script type="text/javascript">
	
	$(document).ready(function () {
  const show_percent = true;
  var progressBars = $(".progress-bar");
  for (i = 0; i < progressBars.length; i++) {
    var progress = $(progressBars[i]).attr("aria-valuenow");
    $(progressBars[i]).width(progress + "%");
    if (show_percent) {
      $(progressBars[i]).text(progress + "%");
    }
    if (progress >= "80") {
      //90 and above
      $(progressBars[i]).addClass("bg-success");
    } else if (progress >= "30" && progress < "45") {
      $(progressBars[i]).addClass("bg-warning"); //From 30 to 44
    } else if (progress >= "45" && progress < "90") {
      $(progressBars[i]).addClass("bg-info"); //From 45 to 89
    } else {
      //29 and under
      $(progressBars[i]).addClass("bg-danger");
    }
  }
});


</script>


</body>
</html>
