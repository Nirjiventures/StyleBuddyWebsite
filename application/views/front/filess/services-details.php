<div class="banner_inner">
	<div class="container">
		<?php 
				$this->breadcrumb = new Breadcrumbcomponent();
				$this->breadcrumb->add('Home', '/');
				$this->breadcrumb->add('Services', '/services');
				$this->breadcrumb->add($datas->title, '/services');
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>

<div class="middle_part">
		<div class="container">
			<div class="row m-0 align-items-center">
				<div class="col-sm-7 p-0">
					<div class="pho_ser">
								<?php  if (file_exists($image_path = FCPATH . 'assets/images/services/' . $datas->image)) { ?>
								    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/'.$datas->image) ?>"  class="img-fluid">
								<?php  } else { ?>
								    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
								<?php  } ?>
							<div class="my_exp2"><?= $datas->title ?></div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="ser_data">
						<?= $datas->description_top; ?>
					</div>
					<?php if($datas->price){ ?>
						<div class="srv_plan">
							<div class="row m-0 align-items-center">
								<div class="col-sm-3 p-0 col-6">
									<div class="pk_price">
										<i class="fa fa-inr"></i> <?= $datas->price ?>
									</div>
								</div>
								<div class="col-sm-5 col-6">
									<div class="my_cat_qty2">
										<div class="num-block skin-2">
											<div class="num-in">
												<span class="minus"></span>
												<input type="text" class="in-num" name="qtybutton" value="1" readonly="">
												<span class="plus"></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-4 p-0 text-center">
									<div class="by_serv">
										<a href="cart.php" class="action_bt">Add to cart</a>
									</div>
								</div>
								
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="my_data">
					<?= $datas->short_description ?>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="other_content">
					
					<?= $datas->description_bottom ?>
					
				</div>
			</div>
			<?php if($datas->price){ ?>
				<div class="row m-0 justify-content-center">
					<div class="col-sm-6">
						<div class="bottom_catd">
							<div class="row m-0 justify-content-center align-items-center">
								<div class="col-sm-3 p-0 text-left col-6">
									<div class="pk_price">
										<i class="fa fa-inr"></i> <?=$datas->price?>
									</div>
								</div>
								
								<div class="col-sm-4 text-center col-6">
									<div class="my_cat_qty2">
										<div class="num-block skin-2">
											<div class="num-in">
												<span class="minus"></span>
												<input type="text" class="in-num" name="qtybutton" value="1" readonly="">
												<span class="plus"></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-4 p-0 text-right mmb">
									<a href="cart.php" class="action_bt">Add to cart</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
</div>
 