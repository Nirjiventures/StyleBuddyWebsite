<?php  $seg1 = $this->uri->segment(1); ?>
<?php  $seg2 = $this->uri->segment(2); ?>
<?php  $seg3 = $this->uri->segment(3); ?>
<?php 
	$catlist = array(); 
	foreach($products as $list) { 
	    $catlist[] = $list->cat_id;        
	}   
?>
<div class="banner_inner">
	<div class="container">
		<h1>Shop</h1>
		<?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Shop', base_url('shop'));
		?>
		<?php $aaaa = array(); ?>
		<?php foreach ($catRecords as $key => $value) { ?>

			<?php 

				$ab = array();

				$ab['id'] = $value['id'];

				$ab['slug'] = $value['slug'];

				$ab['name'] = $value['name'];

				$ab['label'] = 1;

				array_push($aaaa,$ab);

			?>

			<?php foreach ($value['child'] as $key1 => $value1) { ?>

				<?php 

					$ab = array();

					$ab['id'] = $value1['id'];

					$ab['slug'] = $value1['slug'];

					$ab['name'] = $value1['name'];

					$ab['label'] = 2;

					array_push($aaaa,$ab);

				?>

				<?php foreach ($value1['child'] as $key2 => $value2) { ?>

					<?php 

						$ab = array();

						$ab['id'] = $value2['id'];

						$ab['slug'] = $value2['slug'];

						$ab['name'] = $value2['name'];

						$ab['label'] = 3;

						array_push($aaaa,$ab);

					?>

				<?php } ?>

			<?php } ?>
		<?php } ?>
		<?php  array_multisort( array_column($aaaa, "label"), SORT_DESC, $aaaa ); ?>
		<?php 
			foreach ($aaaa as $key => $value) { 
				$this->breadcrumb->add($value['name'], base_url('shop/'.$value['slug'].'?catid='.$value['id']));
			}
		?>		
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div> 
<div class="body_contnet">
	<div class="container">
		<div class="filter_new">

			<p style="font-weight:700; margin-top:15px;">Showing result for: <?=$start_limit.'-'.$end_limit.' of '.$total_rows?></p>

			<?php $action_url = base_url().''.$seg1.'/'.$seg2.'?' . http_build_query($_GET, '', "&");?>

        	<?= form_open($action_url,['name'=>'shopFilterForm','method'=>'get']) ?>
        	<style type="text/css">
        		.common_selector{height: 18px;width: 18px;}

        	</style>

				<!-- <input type="hidden" name="catid" value="<?=$_GET['catid']?>"> -->

				<div class="row m-0">

					

					<div class="col-6 col-sm-8 p-0">

						<div class="filt_box">

							<a href="#" class="shop-filter-active">FILTERS <i class="fa fa-angle-down" aria-hidden="true"></i></a>

						</div>

					</div>

					<div class="col-6 col-sm-4 p-0">

						<div class="ppt">

							<select name="orderBy" onchange="shopFilterForm.submit()">

								<option value="">Popularity</option>

								<option value="ASC">Price : Low to High</option>

								<option value="DESC">Price : High to Low</option>

							</select>

						</div>

					</div>



				</div>

				<div class="product-filter-wrapper" style="display: none;">

					<div class="row m-0 justify-content-center">

						<div class="col-sm-6 p-0">

							<div class="fils_list">

								<h5>CATEGORY</h5>

								<ul>

									<?php 

					        			$catValArray = array();

					        			if ($this->input->get('catid')) {

					        			    if(is_array($this->input->get('catid'))){

					        			        $catValArray = $this->input->get('catid');

					        			    }else{

					        			        array_push($catValArray,$this->input->get('catid'));

					        			    }

					        				

					        			}

					        		?>

									<?php if($catLists) { foreach($catLists as $catList)  { ?> 

										<li> <input type="checkbox" <?php if (in_array($catList->id, $catValArray)) { echo "checked";} ?> class="common_selector cat_id" name="catid[]" value="<?= $catList->id ?>" > <label for="cat_id"> <?= $catList->name ?> </label> </li>

									<?php } } ?> 

								</ul>

							</div>

						</div>

						<div class="col-sm-1">

							<div class="pri_liats">

								<h5>SIZE</h5>

								<ul>

								    <?php 

					        			$catValArray = array();

					        			if ($this->input->get('size')) {

					        				$catValArray = $this->input->get('size');

					        			}

					        		?>

								    <?php if($sizes) { foreach($sizes as $size)  { ?> 

										<li> <input type="checkbox" <?php if (in_array($size->id, $catValArray)) { echo "checked";} ?>  class="common_selector size" name="size[]" value="<?= $size->id ?>" > <label for="size"> <?= $size->size_name ?> </label> </li>

									<?php } } ?> 

									

								 

								</ul>

							</div>



						</div>

						<div class="col-sm-1">

							<div class="pri_liats">

								<h5>Color</h5>

								<ul>

								    <?php 

					        			$catValArray = array();

					        			if ($this->input->get('color')) {

					        				$catValArray = $this->input->get('color');

					        			}

					        		?>

								    <?php if($colors) { foreach($colors as $size)  { ?> 

										<li class="checkbox_li">
											<input type="checkbox" <?php if (in_array($size->id, $catValArray)) { echo "checked";} ?> class="common_selector color_checkbox" name="color[]" value="<?= $size->id ?>"> 
											<label class="checkmark_span" for="color"  style="vertical-align: top;width:18px;height:18px;background-color: <?= $size->code ?>;">&nbsp;&nbsp;&nbsp;</label> 
										</li>

									<?php } } ?> 

									
								 

								</ul>

							</div>



						</div>

						<div class="col-sm-2">

							<div class="pri_liats">

								<h5>PRICE</h5>

								<ul>

									 
    								<?php

							 		    $priceList = $this->common_model->get_all_details('filter_price',array('status'=>1))->result_array();

					        			$priceValArray = array();

					        			if ($this->input->get('price')) {

					        				$priceValArray = $this->input->get('price');

					        			}

					        		?>

					        		<?php if($priceList) { foreach($priceList as $key=>$catList)  { ?> 

    									<li> <input type="checkbox" <?php if (in_array($catList['value'], $priceValArray)) { echo "checked";} ?> class="common_selector price" name="price[]"   value="<?= $catList['value'] ?>" > <label for="price"> <?= $catList['label'] ?> </label> </li>

    								<?php } } ?>

								</ul>

							</div>



						</div>

						<div class="col-sm-2">

							<div class="pri_liats">

								<h5>OFFERS</h5>

								<ul>

									 
    								<?php

                                    	    $priceList = $this->common_model->get_all_details('filter_discount',array('status'=>1))->result_array();

                                    	$priceValArray = array();

                                    	if ($this->input->get('discount')) {

                                    		$priceValArray = $this->input->get('discount');

                                    	}

                                    ?>

                                    <?php if($priceList) { foreach($priceList as $key=>$catList)  { ?> 

                                    	<li> <input type="checkbox" <?php if (in_array($catList['value'], $priceValArray)) { echo "checked";} ?> class="common_selector cat_id" name="discount[]"   value="<?= $catList['value'] ?>" > <label for="a1"> <?= $catList['label'] ?> </label> </li>

                                    <?php } } ?>

								</ul>

							</div>



						</div>
						<div class="col-sm-6 m-0 p-0">
							<a class="action_bt4" onclick="clearAllcheckbox('common_selector')" style="cursor: pointer;">Clear All</a>
						</div>
						<div class="col-sm-6 m-0 p-0 text-right">
							<a class="action_bt_2" onclick="shopFilterForm.submit()" style="cursor: pointer;">Search</a>
						</div>
						<div class="col-sm-12"><hr/></div>
						<script type="text/javascript">
							function clearAllcheckbox(className){
								$("."+className).prop('checked', false); 
								shopFilterForm.submit()
							}
							
						</script>
					</div>

				</div>

			<?php form_close() ?>

		</div>
		<div class="products_listing">
			<div class="row filter_dataa">
	          	 	<?php if(!empty($products))  { ?>
	          	 		<?php foreach($products as $product) {  	?>
			          	   	<?php $gallary = $this->db->get_where('product_galary',['product_id'=> $product->id ])->result(); ?>
			          	  	<div class="col-6 col-sm-3">
			          	  		<?php $product->gallary = $gallary; ?>
			          	  		<?php $product->site_currency = $this->site->currency; ?>
			          			<?=product_div($product);?>
			          		</div>
			          	<?php } ?>
	          	 	<?php } else { ?>	
                    	<div class="" style="margin-top: 40px;"><p class="text-center"><b>Something Great is Coming Soon! Stay Tuned.</b></p></div>
                    <?php } ?>
          	</div>



          	<div class="row mt-5">

          		<div class="col-sm-12">

          		    <div id="pagination_link"></div>

     				<?php echo $this->pagination->create_links(); ?>

          		</div>

          	</div>
		</div>
	</div>
</div>

