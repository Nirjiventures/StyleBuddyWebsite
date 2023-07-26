<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->


    <div class="col-sm-12">
		
		
		<div class="rightbar">

			<div class="container p-0">
					<div class="row">
						<div class="col-sm-8">
							<h3>Add products</h3></div>

							<div class="col-sm-4 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/manage-products')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
								
							</div>

					</div>
					<hr>
				</div>

			<div class="row">
				<div class="col-sm-12">
					<?= $this->session->flashdata('success'); ?>
					<?= $this->session->flashdata('error'); ?>
				</div>
			</div>
			
			
			<?= form_open_multipart('stylist-zone/add-products',['name' => 'addPortfolio','id' => 'addPortfolio']) ?>	
		     	
			<div class="row mt-5 justify-content-center">
			
				<div class="col-sm-6">
					<div class="add_pro1">
						<div class="form-group boot_sp">
							<input type="text" id="product_name" name="product_name" value="<?= set_value('product_name'); ?>" class="form-control box_in3">
							<label class="form-control-placeholder2" for="fname">Product Name<span class="text-danger">*</span></label>
							 <?php echo form_error('product_name','<span class="text-danger mt-1">','</span>');?>
							 <div id="product_name_Err"></div>
						</div>
						
						<div class="form-group boot_sp">
							<select id="gendertype" name="gender" class="form-control box_in3" >
								<option value="">Gender Type</option>
								<option class="Male" value="1">Male</option>
								<option class="Female" value="2">Female</option>
								<option class="Female" value="3">Kids</option>
							</select> 
							<label class="form-control-placeholder2" for="gendertype">Gender Type<span class="text-danger">*</span></label>
							<?php echo form_error('gender','<span class="text-danger mt-1">','</span>');?>
							<div id="gendertype_Err"></div>
						</div>

						<div class="form-group boot_sp">
							<label class="" for="ptype">Select Product Type<span class="text-danger">*</span></label>
							<select id="ptype" name ="cat_id[]" class="form-control box_in33 chosen-select" multiple size="3">
								<option value="">Select Product type</option>
								<?php if(!empty($categorys)) { foreach($categorys as $category) { ?>
								    <option class="Shoes" value="<?= $category->id ?>"> <?= $category->name ?> </option>
								<?php } } ?>
							</select>  
							<?php echo form_error('cat_id','<span class="text-danger mt-1">','</span>');?>
							<div id="ptype_Err"></div>
						</div>

						<div class="Shoes display_box size_chart">
							<p>Select Size <span class="text-danger">*</span></p>
							<hr>
							<ul>
							   <?php if(!empty($sizes)) { foreach($sizes as $size) { ?> 
								<li>
								   <label>
									  <input type="checkbox" name="size[]" value="<?= $size->id; ?>" class="checkarray">
									  <div class="icon-box"><?= $size->size_name; ?></div>
								   </label>
								</li>
							   <?php } } ?>	
							</ul>
							<?php echo form_error('size','<span class="text-danger mt-1">','</span>');?>
							<div id="size_Err"></div>
						</div>

                        <!-- this is price section-->
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="add_pro1">
						<div class="form-group boot_sp">
							<input type="num" min="1000" id="price" name="price" value="<?= set_value('price'); ?>" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Price">Price (<?= $this->site->currency ?>)<span class="text-danger">*</span></label>
							<?php echo form_error('price','<span class="text-danger mt-1">','</span>');?>
							<div id="price_Err"></div>
						</div>
						
						<div class="form-group boot_sp">
							<input type="text" id="discount" name="discount" value="<?= set_value('discount'); ?>" class="form-control box_in3">
							<label class="form-control-placeholder2" for="Price">Discount %</label>
						</div>
					
						
						
						<div class="form-group boot_sp">
							<input type="file" id="pic" title="Browse Image" name="image" accept=".jpg,.jpeg,.webp"  class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Price">Main Pic (<span class="extenstion">Image Extensions Supported JPEG, JPG, PNG, WEBP </span>)<span class="text-danger">*</span></label>
							<?= $this->session->flashdata('imgberror'); ?>
							<?= $this->session->flashdata('imgerror'); ?>
							<div id="pic_Err"></div>
						</div>
						
						<div class="form-group boot_sp">
							<input type="file" id="gallery_pic" title="Browse Images" accept=".jpg,.jpeg,.webp" name="gallery_image[]"  multiple class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Price">Gallery Pic (<span class="extenstion">Images Extensions Supported JPEG, JPG, PNG, WEBP</span>)</label>
							<div id="gallery_pic_Err"></div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12 mt-3">
					<div class="form-group boot_sp">
						<textarea type="text" id="editor1" name="description"  class="form-control box_in2"><?= set_value('description'); ?></textarea>
						<label class="form-control-placeholder2" for="Price">Product Description<span class="text-danger">*</span></label>
						<?php echo form_error('description','<span class="text-danger mt-1">','</span>');?>
						<script type="text/javascript"> CKEDITOR.replace("editor1",{'height':150}); </script>
						<div id="editor1_Err"></div>
					</div>
				</div>
				
				<div class="col-sm-4 mt-3">
					<input type="submit" value="Add Product"  class="bkk">
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
			} else if ($('#pic').val() == '' || $('#pic').val().trim().length == '') { 
				$('#pic_Err').html('<span class="text-primary">Please upload image</span>') 
				$('#pic').focus();
				return false; 
			}
			else if ($('#gallery_pic').val() == '' ) { 
				$('#gallery_pic_Err').html('<span class="text-primary">Please upload multi image</span>') 
				$('#gallery_pic').focus();
				return false; 
			}else if(!searchIDs.length){
				$('#size_Err').html('<span class="text-primary">Please checked Size</span>') 
				return false; 
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



<?php $this->load->view('front/vandor/footer'); ?>


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