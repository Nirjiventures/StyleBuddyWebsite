<?php  $this->load->view('Page/template/header'); ?>

<?php  $seg1 = $this->uri->segment(1); ?>

<?php  $seg2 = $this->uri->segment(2); ?>

<?php  $seg3 = $this->uri->segment(3); ?>



<?php $catlist = array(); foreach($products as $list) { 

      $catlist[] = $list->cat_id;        

}   

?>


<div class="body_contnet">

	<div class="container">

		<div class="row m-0">

			<div class="col-sm-12">

				<div class="heading_part">

					<div class="my_bedcum">

						<ul>

							<li><a href="<?=base_url()?>">Home</a> </li>

							<li><a href="<?=base_url('shop')?>">Shop</a> </li>

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

							<?php foreach ($aaaa as $key => $value) { ?>

								<li><a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>"><?=$value['name'];?></a> </li>

							<?php } ?>		

						</ul>

					</div>

				</div>

			</div>

		</div>

		<div class="filter_new">

			<p style="font-weight:700; margin-top:15px;">Showing result for: <?=$start_limit.'-'.$end_limit.' of '.$total_rows?></p>

			<?php $action_url = base_url().'/'.$seg1.'/'.$seg2.'?' . http_build_query($_GET, '', "&");?>

        	<?= form_open($action_url,['name'=>'shopForm','method'=>'get']) ?>

				<input type="hidden" name="catid" value="<?=$_GET['catid']?>">

				<div class="row m-0">

					

					<div class="col-6 col-sm-8 p-0">

						<div class="filt_box">

							<a href="#" class="shop-filter-active">FILTERS <i class="fa fa-angle-down" aria-hidden="true"></i></a>

						</div>

					</div>

					<div class="col-6 col-sm-4 p-0">

						<div class="ppt">

							<select name="orderBy" onchange="shopForm.submit()">

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

										<li> <input type="checkbox" <?php if (in_array($catList->id, $catValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="catid[]" id="a1" value="<?= $catList->id ?>" > <label for="a1"> <?= $catList->name ?> </label> </li>

									<?php } } ?> 

								</ul>

							</div>

						</div>

						<div class="col-sm-2">

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

										<li> <input type="checkbox" <?php if (in_array($size->id, $catValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="size[]" value="<?= $size->id ?>" > <label for="a1"> <?= $size->size_name ?> </label> </li>

									<?php } } ?> 

									

								 

								</ul>

							</div>



						</div>

						<div class="col-sm-2">

							<div class="pri_liats">

								<h5>PRICE</h5>

								<ul>

									<?php $priceList =array('0-1000'=>'0-1000','1000-2000'=>'1000-2000','2000-5000'=>'2000-5000','5000-10000'=>'5000-10000','10000-20000'=>'10000-20000');?>

							 		<?php

							 		    $priceValArray = array();

					        			if ($this->input->get('price')) {

					        				$priceValArray = $this->input->get('price');

					        			}

					        		?>

					        		<?php if($priceList) { foreach($priceList as $key=>$catList)  { ?> 

    									<!--<li> <input type="checkbox" <?php if (in_array($key, $priceValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="price[]"   value="<?= $key ?>" > <label for="a1"> <?= $catList ?><?= $this->site->currency;?> </label> </li>-->

    								<?php } } ?>

    								

    								<?php

							 		    $priceList = $this->common_model->get_all_details('filter_price',array('status'=>1))->result_array();

					        			$priceValArray = array();

					        			if ($this->input->get('price')) {

					        				$priceValArray = $this->input->get('price');

					        			}

					        		?>

					        		<?php if($priceList) { foreach($priceList as $key=>$catList)  { ?> 

    									<li> <input type="checkbox" <?php if (in_array($catList['value'], $priceValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="price[]"   value="<?= $catList['value'] ?>" > <label for="a1"> <?= $catList['label'] ?> </label> </li>

    								<?php } } ?>

								</ul>

							</div>



						</div>

						<div class="col-sm-2">

							<div class="pri_liats">

								<h5>OFFERS</h5>

								<ul>

									<?php $offerList =array('10'=>'10%','25'=>'25%','30'=>'30%');?>

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

							 		<?php 

					        			$offerValArray = array();

					        			if ($this->input->get('discount')) {

					        			    if(is_array($this->input->get('discount'))){

					        			        $offerValArray = $this->input->get('discount');

					        			    }else{

					        			        array_push($offerValArray,$this->input->get('discount'));

					        			    }

					        			    

					        				 

					        			}

					        		?>

					        		<?php if($offerList) { foreach($offerList as $key=>$catList)  { ?> 

    								<!--	<li> <input type="checkbox" <?php if (in_array($key, $offerValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="discount[]"   value="<?= $key ?>" > <label for="a1"> <?= $catList ?> </label> </li>-->

    								<?php } } ?>

    								

    								<?php

                                    	    $priceList = $this->common_model->get_all_details('filter_discount',array('status'=>1))->result_array();

                                    	$priceValArray = array();

                                    	if ($this->input->get('discount')) {

                                    		$priceValArray = $this->input->get('discount');

                                    	}

                                    ?>

                                    <?php if($priceList) { foreach($priceList as $key=>$catList)  { ?> 

                                    	<li> <input type="checkbox" <?php if (in_array($catList['value'], $priceValArray)) { echo "checked";} ?> onclick="shopForm.submit()" class="common_selector cat_id" name="discount[]"   value="<?= $catList['value'] ?>" > <label for="a1"> <?= $catList['label'] ?> </label> </li>

                                    <?php } } ?>

								</ul>

							</div>



						</div>

						<div class="col-sm-12"><hr/></div>

					</div>

				</div>

			<?php form_close() ?>

		</div>





		<div class="products_listing">

			<?php if(!empty($products))  { 

				$main_image = $products[0]->image;

			 	$gallary = $this->db->get_where('product_galary',['product_id'=> $products[0]->id ])->result();

			}

	          	   ?>

							

          	<div class="row filter_dataa">

	          	 	<?php if(!empty($products))  { foreach($products as $product) { 

	          	 		$discount = '0'; 

						$discountAmt = '0'; 

						$saleAmt = $product->price; 

	          	       	if($product->discount) { 

	          	       		$discount = ($product->discount / 100) * $product->price; 

	          	       		$saleAmt = round($product->price - $discount); 

	          	       		$discountAmt = round($discount); 

	          	       	}

	          	       	$productUrl  =  base_url('shop/'.$product->category_slug.'/'.$product->slug);

	          	   	?>

	          	  	<div class="col-6 col-sm-3">

	          			<div class="new_pro_data">

	          				<div class="pro_photo_pp">

	          				    <?php if($product->discount) { ?>

	            				    <div class='ribbon-wrapper-3'>

      									<div class='ribbon-3'><?= ($product->discount)?"($product->discount% OFF)":"" ?></div>

   									</div>

	            				<?php } ?>

	            				<div class="my_wish_l"> 

            					<?php if($product->wishListStatus){$wishClass = 'fa-heart';}else{$wishClass = 'fa-heart-o';}?>

								<?php if($this->session->userdata('userId')){ ?>

										<a href="#"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

								<?php }else{ ?>

									

									<a href="<?php echo base_url('login')?>"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$this->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>

								<?php }?>




	            				</div>

        						<a  href="<?= $productUrl?>">
        							<?php $img =  'assets/images/cat/cat1.jpg';?>

        							<?php if(!empty($product->image))  {?>
								   		<?php 
								   			$img1 =  'assets/images/product/'.$product->image; 
								   			if (file_exists($img1)) {
								   				$img = $img1;
								   			}
								   		?>
								   	<?php } ?>
        						    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">
        						</a>

        						<?php $gallary = $this->db->get_where('product_galary',['product_id'=> $product->id ])->result();

        						?>

        						<?php $review = $product->review;?>

        						<div class="quick_shop"><a  class="link-cart sidenav_open" data-rating="<?=number_format($review->rating,1)?>" data-designby="<?= strtoupper($product->fname.' '.$product->lname) ?>" data-gallaryimage='<?= ($gallary)?json_encode($gallary):json_encode(array()) ?>' data-discountprice="<?= ($discountAmt)?$discountAmt:'0' ?>" data-discount="<?= ($product->discount)?$product->discount:'0' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $product->price ?>" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-image="<?= $product->image ?>" data-id="<?= $product->id ?>" data-name="<?= $product->product_name ?>" data-slug="<?= $product->slug ?>" data-seeFullUrl="<?= $productUrl ?>" data-sizes='<?= json_encode($product->sizesArray) ?>'><i class="fa fa-shopping-bag" aria-hidden="true"></i> Quick Shop</a></div>

            				</div>



            				<div class="prd_title_new">

            					<h4><a href="<?=$productUrl ?>"><?= mb_strimwidth($product->product_name,0,30, '....') ?></a></h4>

            				</div>



            				



        					<?php if(!empty($product->sizesArray)) { ?>

        					<div class="size_pp">Size : 

            					<?php foreach($product->sizesArray as $size)  { ?> 

    			                    <span for="swatch-0-<?= $size->size_name ?>">

    			                        

    			                      <?= $size->size_name ?>

    			                    </span>

    			                <?php } ?>

			                </div>

			                <?php } ?>



            				



          					<div class="prd_price">

          				        <?php if($product->discount) { ?>

          				            <span><?= $this->site->currency.' '.number_format($saleAmt) ?></span> <del><?= $this->site->currency.''.number_format($product->price) ?></del>

          				        <?php }else { ?>

          				            <span><?= $this->site->currency.' '.number_format($product->price) ?></span> 

          				        <?php } ?>

          					</div>



	          				

	          			</div>

	          		</div>

	          		

	          	<?php } } else { ?>	

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



<div id="mySidenav_shop" class="sidenav_shop">

    <div class="hello_sidebar">

  		<div class="row m-0">

  			<div class="col-sm-7 p-0">

  				<div class="pro_field" id="pro_field">

  					 

  				</div>

  			</div>

  			<div class="col-sm-5">

  				<div class="rtc">

  					<div class="pro_disi">

  					<div class="clcl">

  						<a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>

  					</div>



  					<small id="popUp_designby">Designer by: SHAGUN MEHTA</small>

  					<h4  id="popUp_productName">Baby Blue Co-Ord Set</h4>

  					<div class="price_side___"  id="popUp_producPrice">

  						<i class="fa fa-inr" aria-hidden="true"></i> <span></span>

  					</div>

  					<p>PRICE INCLUSIVE OF ALL TAXES</p>

  					<hr>

  					<div id="popUp_productSizeFull"  >

      					<p>Size </p>

    

      					<div class="swatches"  >

    					    <div id="size-err"></div>

    		                <div class="swatch clearfix" data-option-index="0" id="popUp_productSize">

    		                  	 

    		                </div>

    					</div>

					</div>









				    <div class="cebter">

						<small>Rating</small>

						<?php $review = $productDetails->review;?>

						<div class="hidden_star_pointer ratingss">

							<input value="<?php echo $review->rating?>" type="hidden" class="rating"  id="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>

						</div>

					</div>





					<div class="adc">

						<div class="num-block skin-2">

							<div class="num-in">

								<span class="minus dis"></span>

								<input type="text" class="in-num" name="qtybutton" value="1" readonly="">

								<span class="plus"></span>

							</div>

						</div>

					</div>



					<div class="add_to_bag" id="add_to_bag"><a href="#" id="cart1"class="cart1">Add to Bag</a></div>

					

					<p><a href="" class="see_full" id="see_full"><span>SEE FULL DETAILS</span></a></p>



  					</div>

  					<script type="text/javascript">

  					    function closeNav2() {

                    	    document.getElementById("mySidenav_shop").style.width = "0";

                    	}

  						 $('#cart1').on('click',function() {

  					 		console.log($(this).data("price"));

    						console.log($(this).data("discountprice"));

        			         let id = $(this).data("id");

					         let qty = $("input[name='qtybutton']").val();

					         let price = $(this).data("price");

					         let mrpprice = $(this).data("mrpprice");

					         let name = $(this).data("name");

					         let product_id = $(this).data("product_id");

					         

					         let image = $(this).data("image");

					         let catId = $(this).data("catid");

					         let discount = $(this).data("discount");

					         let discountPrice = $(this).data("discountprice");

					         let venderId = $(this).data("venderid");

					         

					         

					         let size = $("input[name='size']:checked").val();

					         let sizearray = $(this).data("sizearray");

					        console.log('sizearray');

                            if(sizearray == 'none'){

                                

                            }

                            

					        if (typeof size  === "undefined") {

                                $('#size-err').html('<span class="text-danger">Please choose size</span>');

                            } else {

                                $('#size-err').html('');

                                $('#size-err').delay(500).fadeOut('slow');

                            }

                            if (typeof size  !== "undefined" || sizearray == 'none') {

					              let url =  base_url+"cart-process";

					              $.ajax({

					                 url:url,

					                 type:"POST",

					                 dataType:"json",

					                 data:{id:id,product_id:product_id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size },

					                 success:function(data){

					                    console.log(data);

					                       if(data.success) {

					                          //  $('#cartModel').modal('show');

					                          window.location.href = base_url+"cart";

					                       }     

					                   }

					              });   

					         } else {

					            // window.location.reload();

					         }

					       // console.log(size);

						        

						  });



  						  

  					</script>

  				</div>

  			</div>

  		</div>

  	</div>

</div>

<?php $this->load->view('Page/template/footer'); ?>



<script type="text/javascript">

	$('.sidenav_open').on('click',function() {

	    document.getElementById("mySidenav_shop").style.width = "65%"; 

	    console.log('vijay');

		let product_id = $(this).data("id");

		let gallaryimage = $(this).data("gallaryimage");

		let discountprice = $(this).data("discountprice");

		let discount = $(this).data("discount");

		let price = $(this).data("price");

		let mrpprice = $(this).data("mrpprice");

		let venderid = $(this).data("venderid");

		let catid = $(this).data("catid");

		let image = $(this).data("image");

		let id = $(this).data("id");

		let name = $(this).data("name");

		let slug = $(this).data("slug");

		let seefullurl = $(this).data("seefullurl");

		let designby = $(this).data("designby");

		let sizes = $(this).data("sizes");

		let rating = $(this).data("rating");

		//console.log(id);

		//console.log(gallaryimages);

		console.log(sizes);

		

		console.log(image);

		

		var str = '';

		//str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('resize_image.php?new_width=300&new_height=400&image=assets/images/product/')?>'+image+' " class="img-fluid" alt=""></li>';

		str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/')?>'+image+' " class="img-fluid" alt=""></li>';

		

		gallaryimage.forEach((value, index) => {

		    console.log(value.gallery_image);

		    //str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('resize_image.php?new_width=300&new_height=400&image=assets/images/gallery/')?>'+value.gallery_image+' " class="img-fluid" alt=""></li>';

		    //str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/gallery/')?>'+value.gallery_image+' " class="img-fluid" alt=""></li>';

		});



		$('#pro_field').html(str);

		var str = '';

		sizes.forEach((value, index) => {

		    str += '<div data-value="'+value.size_name+'" class="swatch-element plain s available">';

		    	str += '<input id="swatch-0-'+value.size_name+'" type="radio" name="size" value="'+value.size_name+'">';

		    	str += '<label for="swatch-0-'+value.size_name+'"> '+value.size_name+' </label>';

		    str += '</div>';

		});

		if(str == ''){

		    $('#popUp_productSizeFull').css('display','none');

		}else{

		    $('#popUp_productSizeFull').css('display','block');

		    $('#popUp_productSize').html(str);

		}

	

		

		$('#see_full').attr('href',seefullurl);

		



		$('#popUp_designby').html('Designer by: '+designby);

		$('#popUp_productName').html(name);

		$('#rating').val(rating);

		$('.filled-stars').css('width',rating*20+'%');

		$('.rating-stars').attr('title','('+rating+')');

		$('.badge-secondary').html('('+rating+')');

		 



		

		if (discount!=0) {

			$('#popUp_producPrice').html('<del><?= $this->site->currency?> '+mrpprice+'</del><span><b><?= $this->site->currency?>'+price+' </b></span> <small>('+discount+'% OFF)</small>');

		}else{

			$('#popUp_producPrice').html('<span><?= $this->site->currency?>'+price+' </span>');

		}

		$('#cart1').attr('data-discountprice',discountprice);

		$('#cart1').attr('data-discount',discount);

		$('#cart1').attr('data-price',price);

		$('#cart1').attr('data-mrpprice',mrpprice);

		$('#cart1').attr('data-venderid',venderid);

		$('#cart1').attr('data-catid',catid);

		$('#cart1').attr('data-image',image);

		$('#cart1').attr('data-name',name);

		$('#cart1').attr('data-id',id);

		$('#cart1').attr('data-name',slug);

		if(str == ''){

		    $('#cart1').attr('data-sizearray','none');

		}else{

		     $('#cart1').removeAttr('data-sizearray');

		}

    });

	

</script>



<script>

    $( document ).ready(function() {

        $('.shop-filter-active , .filter-close').on('click', function(e) {

            e.preventDefault();

            $('.product-filter-wrapper').slideToggle();

        })

        

        var shopFiltericon = $('.shop-filter-active , .filter-close');

        shopFiltericon.on('click', function() {

            $('.shop-filter-active').toggleClass('active');

        })

    

        /*function openNav2() {

    	    document.getElementById("mySidenav_shop").style.width = "65%"; 

    	}*/

    	

    });

</script>



