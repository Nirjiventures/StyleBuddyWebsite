<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<!-- <div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url(); ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Cart</h3></div>
	</div>
	
</div> -->
<div class="ab-banner_inner">
		<div class="container text-center"><h1>Cart</h1></div>
</div>
<style>
    .my_cart .skin-2 .num-in {
    width: 100%!important;
}
</style>
<!--========End Banner Area ========-->	


<div class="middle_part pt-0">
	<div class="container">
	<div class="my_cart">

			<div class="row m-0">
			
				<div class="col-sm-12 p-0">
                <div class="card shopping-cart">
                    <div class="card-header bg-dark text-light row m-0">
                        <div class="col-6 p-0"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart Calculation (<?=  count($this->cart->contents()); ?>)</div>
                        <div class="col-6 text-end"><a href="<?= base_url('shop'); ?>" class="btn_c pull-right">Continue Shopping</a></div>
                        <div class="clearfix"></div>
                    </div>

                    <?php   $cart = $this->cart->contents(); 
				    //var_dump($cart);?>

                    <div class="card-body">
					
                    	 <?php      if(!empty($cart)) {  ?>
					    <?php      $total = 0;  ?>
					    <?php      $discountTotal = 0;  ?>
					    <?php      $grandTotal = 0;  ?>
					    
				    	<?php  foreach(array_reverse($cart) as $value) {   ?>
					    	<?php      $total += $value['mrpprice'] * $value['qty'];  ?>
						    <?php      $discountTotal += $value['discountPrice'] * $value['qty'];  ?>
						    <?php      $grandTotal += $value['price'] * $value['qty'];  ?>


                        <div class="row cart_list align-items-center">
                            <div class="col-4 col-sm-12 col-md-1 text-center">
                            	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/product/<?= $value['options']['image']; ?>" class="cart_img"> 
                                
                            </div>
                            <div class="col-8  col-sm-12 text-md-left col-md-4">
                                <div class="product-name"><strong><?= ucwords($value['name']) ?></strong></div>
                                <div class="ppc">
                                	<?php if($value['mrpprice'] > $value['price']){ ?>
									<span style="text-decoration: line-through;"> <?= ($value['mrpprice'])?$this->site->currency.' '.number_format($value['mrpprice']):$this->site->currency.' '.number_format($value['mrpprice']) ?></span>
									<br/>
									<span class="amount price<?= $value['rowid'] ?>"> <?= ($value['price'])?$this->site->currency.' '.number_format($value['price']):$this->site->currency.' '.number_format($value['price']) ?></span>
									<?php }else{?>
									<span class="amount price<?= $value['rowid'] ?>"> <?= ($value['price'])?$this->site->currency.' '.number_format($value['price']):$this->site->currency.' '.number_format($value['price']) ?></span>
									<?php }?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 text-sm-center col-md-7 align-items-center row m-0 bott_part_cl">
                                
                                <div class="col-6 col-sm-3 col-md-3 text-start">
                                    <h6>Discount: <?= ($value['options']['discount'])?$value['options']['discount'].'%':'' ?></h6>
                                </div>

                                <div class="col-6 col-sm-3 col-md-3">
                                    <div class="num-block skin-2">
										<div class="num-in">
											<span class="minus dis"></span>
											<input type="text" class="in-num qty<?= $value['rowid'] ?>"  name="qtybutton" value="<?= $value['qty'] ?>" readonly="">
											<span class="plus"></span>
										</div>
									</div>
                                </div>

                                <div class="col-3 col-sm-3 col-md-2">
                                   		 <span class="Update text-center"  role="button" onclick="javascript:updateproduct('<?= $value['rowid'] ?>')">
											<i class="fa fa-refresh" aria-hidden="true"></i>
									   </span>
                                </div>

                                <div class="col-6 col-sm-3 col-md-3 text-center">
                                      <?= $this->site->currency.' '.number_format($value['subtotal']) ?>
                                </div>
                                <div class="col-3 col-sm-2 col-md-1 text-center ">
                                    <a class="removecart" href="javascript:void(0)" id="<?= $value['rowid'] ?>" ><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>

                        <?php }?>
						<?php } ?>
						
                     </div>
                    
					
                </div>
            </div>

            	<div class="col-sm-12 p-0">
            		<div class="bott_details">
            			<b>Total</b>
            			<span><?= $this->site->currency.' '.number_format($total) ?></span>
            		</div>
            	</div>

            	<div class="col-sm-12 p-0">
            		<div class="bott_details">
            			<b>Discount</b>
            			<span>-<?= $this->site->currency.' '.number_format($discountTotal) ?></span>
            		</div>
            	</div>

            	<div class="col-sm-12 p-0">
            		<div class="bott_details">
            			<b>Grand Total</b>
            			<span><?= $this->site->currency.' '.number_format($grandTotal) ?></span>
            		</div>
            	</div>
						
				</div>

			<div class="clearfix"></div>

			<div class="price_details">
				<div class="row">
					<div class="col-sm-6">
						<a href="<?= base_url('shop'); ?>" class="c_shopping"> <i class="fa fa-angle-left" aria-hidden="true"></i> Continue Shopping</a>
					</div>
					<div class="col-sm-6 total_am">
						<h4>SUBTOTAL : <?=  $this->site->currency.' '.number_format($this->cart->total()); ?></h4>
						<p>Taxes,discount and shipping calculated at checkout</p>
						<a href="<?= ('checkout'); ?>">Check out</a>
					</div>
				</div>
				
			</div>

		</div>
	
</div>

</div>

<?php $this->load->view('Page/template/footer'); ?>