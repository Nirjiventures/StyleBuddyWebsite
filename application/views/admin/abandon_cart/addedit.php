<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<style>

    .my_cart .skin-2 .num-in {

    width: 100%!important;

}

</style>
<div class="container-fluid wc mt-2 p-0">
   <div class="row">
      <div class="col-md-12 ">
            <div class="  form-card p-3">
                <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
                <div id="success_message"></div>
                <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
                <table class="table">
                    <tbody>
                        <?php $cartArray = $record_detail->user_cart;?>
                        <?php foreach($cartArray as $k=>$v){?>
                            <?php
    						$tbl_name = 'products';
    						$str = " WHERE id = '".$v->product_id."' ";
    						$pageRowQuery =  $this->common_model->get_all_details_query($tbl_name,'  '.$str);
    						$cRow = $pageRowQuery->row();
    					?>
    					<?php 	$total = $v->display_total;?>
    					
    					<?php 	$display_mrp_price = $v->display_mrp_price;?>
    					<?php 	$display_price = $v->display_price;?>
    					<?php 	$name = $cRow->product_name;?>
    					<?php  	$imgSplit = $cRow->image; ?>
    					<?php 	$quantity = $v->quantity ?>
						<?php 

							if($v->cart_type == 'service'){
								$finalImageUrl = $v->product_image;
								$name = $v->name;
							}else{
								if($cRow->image_base_url){
									$finalImageUrl = $imgSplit;
								}else{ 
									$finalImageUrl = 'assets/images/product/'.$imgSplit;
								}	
							}
							
						?>
						<?php $img =  'assets/images/no-image.jpg';?>
				        <?php if(!empty($finalImageUrl))  {?>
				            <?php 
				                if (file_exists($finalImageUrl)) {
				                    $img = $finalImageUrl;
				                }
				            ?>
				        <?php } ?>
                                <td>
                                    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url($img);?>" class="mini_pro" style="width:60px;">
                                </td>
                                <td>    
                                    <?=$cRow->product_name?><br/>
                                    <?php if ($v->size) { ?>
                                        <div class="pro_size">Size: <?= ucwords($v->size) ?></div>
                                    <?php } ?>
                                    <?php if ($v->discount) { ?>
                                        <div class="pro_price">Discount: <?= ($v->discount)?$v->discount.'%':'' ?></div>
                                    <?php } ?>
                                </td>       
                                <td>
                                    Price : 
                                    <?php if($v->mrp_price > $v->price){ ?>
                                        <span style="text-decoration: line-through;" class="amount mrpprice<?= $v->id ?>"> <?= ($v->mrp_price)?$this->site->currency.' '.number_format($v->mrp_price):$this->site->currency.' '.number_format($v->mrp_price) ?></span>

                                        <span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.' '.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>

                                    <?php }else{?>

                                        <span class="amount price<?= $v->id ?>"> <?= ($v->price)?$this->site->currency.' '.number_format($v->price):$this->site->currency.' '.number_format($v->price) ?></span>

                                    <?php }?> 
                                </td>
                                <td class="qtyy">
                                    <?= $v->quantity ?>
                                </td>
                                <td  style="width:30%;text-align: right;">
                                    <?= '<i class="fa fa-inr"></i> '.number_format($v->total) ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4"></td>
                            <td style="width:30%;text-align: right;">
                                <?php  $sessionArray = json_decode($record_detail->cart_record); ?>

                                <p>Subtotal <span><i class="fa fa-inr"></i> <?=$sessionArray->bag_mrp_price_total;?></span></p>

                                <p>Discount <span>-<i class="fa fa-inr"></i> <?=$sessionArray->display_discount_total;?></span></p>
                                
                                <p id="p_discount_html" style="display: none">Coupon Discount <span>-<i class="fa fa-inr"></i> <span id="discount_html"><?=$sessionArray->display_discount_total;?></span></span></p>

                                <p>Estimated Total <span><i class="fa fa-inr"></i> <span id="price_html"><?=$sessionArray->display_total;?></span></span></p>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
      $('.onlyInteger').on('keypress', function(e) {

         keys = ['0','1','2','3','4','5','6','7','8','9','.']

         return keys.indexOf(event.key) > -1

      })
      
</script>
<script type="text/javascript">
   function delete_image(display,id,column,path,img,table,controller) {
      let text = "Do you want to delete this";
      if (confirm(text) == true) {
         $.ajax({
            type: 'GET',
            url: '<?=base_url()?>admin/'+controller+'/deleteImages',   
            data: {'id':id,'img':img,'column':column,'path':path,'table':table},
            success: function(response){
               console.log(response);
               $('#reviewMesage').html(response);
               $('#reviewMesage').show().delay('10000').fadeOut();
               $("#"+display).hide();

            }
         });

      } else {
         text = "You canceled!";
      }
   }
</script>