<?php $this->load->view('front/vandor/header'); ?>
<?php  $url1 = $this->uri->segment(1);?>

<div class="main">
	<div class="container">

		 

    <div class="col-sm-12">
		
		

		<div class="rightbar">
			<div class="row">
				<div class="col-sm-8">
					<h2>Edit Products</h2>
				</div>
				
				<div class="col-sm-4 text-end">
					<a href="<?= base_url('stylist-zone/manage-products') ?>" class="btn btn-success add_pro"> Manage Products</a>
				</div>
				<div class="col-sm-12">
					<?= $this->session->flashdata('success'); ?>
					<?= $this->session->flashdata('error'); ?>
				</div>
			</div>
			
			<hr>
			<?= form_open_multipart('',['name' => 'addPortfolio','id' => 'addPortfolio']) ?>	
			<input type="hidden" name="id" value="<?= $products->id ?>">
			<input type="hidden" name="old_image" id="old_image" value="<?= $products->image ?>">
			<div class="row mt-5">
				<div class="col-sm-6">
					<div class="form-group boot_sp">
						<input type="text" id="product_name" name="product_name" value="<?= set_value('product_name',$products->product_name ) ?>" class="form-control box_in3">
						<label class="form-control-placeholder2" for="fname">Product Name</label>
						<?php echo form_error('product_name','<span class="text-danger mt-1">','</span>');?>
						<div id="product_name_Err"></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group boot_sp">
						<input type="text" id="price" name="price" value="<?= set_value('price',$products->price); ?>" class="form-control box_in3 onlyInteger">
						<label class="form-control-placeholder2" for="price">Price (<?= $this->site->currency ?>)</label>
						<?php echo form_error('price','<span class="text-danger mt-1">','</span>');?>
						<div id="price_Err"></div>
					</div>
				</div>
			 	<div class="col-sm-6">	
					<div class="form-group boot_sp">
						<select id="gendertype" name="gender" class="form-control box_in3" >
							<!--<option value="">Gender Type</option>-->
							<option class="Male" value="1" <?= ($products->gender == 1)? 'selected = selected' :'' ?> >Male</option>
							<option class="Female" value="2" <?= ($products->gender == 2)? 'selected = selected' :'' ?> >Female</option>
							<option class="Female" value="3" <?= ($products->gender == 3)? 'selected = selected' :'' ?> >Kids</option>
						</select> 
						<label class="form-control-placeholder2" for="gendertype">Gender Type</label>
						<?php echo form_error('gender','<span class="text-danger mt-1">','</span>');?>
						<div id="gendertype_Err"></div>
					</div>
				</div>
				
				
			 	<div class="col-sm-6">	
					<div class="form-group boot_sp">
						<input type="text" id="discount" name="discount" value="<?= set_value('discount',$products->discount); ?>" class="form-control box_in3 onlyInteger">
						<label class="form-control-placeholder2" for="Price">Discount %</label>
					</div>
				</div>

				<div class="col-sm-6">	
					<div class="form-group boot_sp">
						<label class="" for="ptype">Select Product Type</label>
						<select id="ptype" name ="cat_id[]" class="form-control box_in33 chosen-select" multiple size="3">
							<option value="">Select Product type</option>
							<?php if(!empty($categorys)) { ?>
								<?php foreach($categorys as $category) { ?>
									<?php if(!empty($products->cat_id)) { if (in_array($category->id, explode(',', $products->cat_id))) { $sel = 'selected'; }else{$sel='';} }else{$sel='';} ?>
								    <option class="Shoes" <?= $sel ?> value="<?= $category->id ?>"> <?= $category->name ?> </option>
							 	<?php }  ?>
							<?php }  ?>
						</select> 
						<?php echo form_error('cat_id','<span class="text-danger mt-1">','</span>');?>
						<div id="ptype_Err"></div>
					</div>
				</div>
				<div class="col-sm-6">	
				</div>
				<div class="col-sm-6">	
					<div class="Shoes display_box size_chart">
						<p>Select Size</p>
						<hr>
                      	<ul>
						   	<?php 
						        $sizeArray = explode(',',$products->size);
						        if(!empty($sizes)) { foreach($sizes as $size) { 
						   	?> 
							<li>
							   <label>
								  <input type="checkbox" name="size[]" <?php if(in_array($size->id, $sizeArray)){ echo "checked"; } ?>  value="<?= $size->id; ?>">
								  <div class="icon-box"><?= $size->size_name; ?></div>
							   </label>
							</li>
						   <?php } } ?>	
						</ul>
						<?php echo form_error('size','<span class="text-danger mt-1">','</span>');?>
					</div>
				</div>
				<div class="col-sm-6">	
					<div class="Shoes display_box size_chart">
						<p>Select Color</p>
						<hr>
                      	<ul>
						   	<?php 
						        $sizeArray = explode(',',$products->color);
						        if(!empty($sizes)) { foreach($colors as $size) { 
						   	?> 
							<li>
							   <label>
								  <input type="checkbox" name="color[]" <?php if(in_array($size->id, $sizeArray)){ echo "checked"; } ?>  value="<?= $size->id; ?>">
								  <div class="icon-box" style="background: <?= $size->code; ?>;"><?= $size->name; ?></div>
							   </label>
							</li>
						   <?php } } ?>	
						</ul>
						<?php echo form_error('color','<span class="text-danger mt-1">','</span>');?>
					</div>
				</div>
			 	
			 	<div class="col-sm-6">
					<div class="form-group boot_sp">
						<input type="file" id="pic" title="Browse Image" name="image" accept=".jpg,.jpeg,.gif" class="form-control box_in3">
						<label class="form-control-placeholder2" for="Price">Main Pic (<span class="extenstion">Image Extensions Supported JPEG, JPG, PNG, WEBP </span>)</label>
						 
						<?= $this->session->flashdata('imgerror'); ?>
						<?php if(!empty($products->image)) { ?>
							<?php  if (file_exists($image_path = FCPATH . 'assets/images/product/' . $products->image)) { ?>
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/'.$products->image) ?>"  class="order_pic">
							<?php  } else { ?>
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>" class="order_pic">
							<?php  } ?>
						<?php } ?>
						<div id="pic_Err"></div>
					</div>
				</div>
			 	<div class="col-sm-6">	
					<div class="form-group boot_sp">
						<input type="file" id="gallery_pic" title="Browse Images" accept=".jpg,.jpeg,.gif" name="gallery_image[]" multiple class="form-control box_in3">
						<label class="form-control-placeholder2" for="Price">Gallery Pic (<span class="extenstion">Images Extensions Supported JPEG, JPG, PNG, WEBP </span>)</label>
						<?= $this->session->flashdata('imgMerror'); ?>
						<div id="gallery_pic_Err"></div>
						<div class="">	
							<?php   if(!empty($galleryes)){  ?> 
								<?php   $k = 0;foreach($galleryes as $gallery){ $k++; ?>
									<?php   if(!empty($gallery)){  ?> 
										<span class="" id="<?=$k.'__gal_image_s'?>">
											<a class="cross_image" onclick="delete_image('<?=$k.'__gal_image_s'?>',<?=$gallery->id?>,'<?=$gallery->gallery_image?>','uploads/','multi_image','cms_pages','<?=$url1?>')">X</a>

											<?php  if (file_exists($image_path = FCPATH . 'assets/images/gallery/' . $gallery->gallery_image)) { ?>
											    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/gallery/'.$gallery->gallery_image) ?>"  class="cross_img">
											<?php  } else { ?>
											    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>" class="cross_img">
											<?php  } ?>

										</span>	
									<?php   }   ?>
								<?php   }   ?>
							<?php   }   ?>
						</div>
					</div>
				</div>
			 	
				<div class="col-sm-12 mt-3">
					<div class="form-group boot_sp">
						<textarea type="text" id="editor1" name="description" value="" class="form-control box_in2"><?= set_value('description',$products->description); ?></textarea>
						<label class="form-control-placeholder2" for="Price">Product Description<span class="text-danger">*</span></label>
						<?php echo form_error('description','<span class="text-danger mt-1">','</span>');?>
						<script type="text/javascript"> CKEDITOR.replace("editor1",{'height':150}); </script>
						<div id="editor1_Err"></div>
					</div>
				</div>
				<div class="col-sm-10 mt-3">
					<input type="submit" value="Submit Product"  class="sub">
				</div>
			</div>
			<?= form_close(); ?>
		</div>
	  
    </div>
    
	


</div>
</div><!--container-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$('#subcategory').find('optgroup').hide(); // initialize
	$('#category').change(function() {
	 	var $cat = $(this).find('option:selected');
	 	var $subCat = $('#subcategory').find('.' + $cat.attr('class'));
	 	$('#subcategory').find('optgroup').not("'"+ '.' + $cat.attr('class') + "'").hide(); // hide other optgroup
	 	$subCat.show();
	 	$subCat.find('option').first().attr('selected', 'selected');
	});

	$(document).ready(function(){
        $('#addPortfolio').on('submit',function(e){
	        e.preventDefault();
	        $('#product_name_Err').html('');
	        $('#gendertype_Err').html('');
	        $('#ptype_Err').html('');
	        $('#price_Err').html('');
	        $('#pic_Err').html('');
	        $('#gallery_pic_Err').html('');
	        $('#size_Err').html('');
	        $('#editor1_Err').html('');
	        
	        var searchIDs = $("input.checkarray:checkbox:checked").map(function(){
		      return $(this).val();
		    }).get(); 


		     
		    
	        if (!$('#product_name').val()) { 
				$('#product_name_Err').html('<span class="text-primary">Please enter product name</span>') 
				$('#product_name').focus();
				return false; 
			}else if (!$('#gendertype').val()) { 
				$('#gendertype_Err').html('<span class="text-primary">Please select gender type</span>') 
				$('#gendertype').focus();
				return false; 
			}else if (!$('#ptype').val()) { 
				$('#ptype_Err').html('<span class="text-primary">Please select product type</span>') 
				$('#ptype').focus();
				return false; 
			}else if (!$('#price').val()) { 
				$('#price_Err').html('<span class="text-primary">Please enter price</span>') 
				$('#price').focus();
				return false; 
			}else if (!$('#old_image').val() && $('#pic').val() == '' ) { 
				if ($('#pic').val() == '' || $('#pic').val().trim().length == '') { 
					$('#pic_Err').html('<span class="text-primary">Please upload image</span>') 
					$('#pic').focus();
					return false; 
				}
			}else if (!CKEDITOR.instances['editor1'].getData()) { 
				$('#editor1_Err').html('<span class="text-primary">Please enter description</span>') 
				$('#editor1').focus();
				return false; 
			}else{
				$('#addPortfolio').get(0).submit();
				return true;
			}
	    });
    });
</script>


<!--<script>
  $(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".display_box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".display_box").hide();
            }
        });
    }).change();
});
</script>-->

<?php $this->load->view('front/vandor/footer'); ?>
<script type="text/javascript">
	function delete_image(display,id,img,path,column,table,controller) {
		let text = "Do you want to delete this";
		if (confirm(text) == true) {
			$.ajax({
				type: 'GET',
				url: '<?=base_url()?>Vendor/deleteProductImages',	
				data: {'id':id ,'img':img,'column':column,'path':path,'table':table},
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

<?php $this->load->view('front/vandor/footer'); ?>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<style type="text/css">
	.chosen-container-multi .chosen-choices {
	    height: auto!important;
	    border: none!important;
	    border-radius: 0px!important;
	    padding: 2px 14px!important;
	    border: 1px solid #ccc!important; 
	}
</style>

<script type="text/javascript">
	$(".chosen-select").chosen({
	  no_results_text: "Oops, nothing found!"
	})
</script>