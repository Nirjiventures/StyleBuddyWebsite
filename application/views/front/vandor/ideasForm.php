<?php $this->load->view('front/vandor/header'); ?>
<?php  $url1 = $this->uri->segment(1);?>

<div class="main">
	<div class="container">
	    <div class="manage_w">
			<div class="rightbar">
				<div class="row">
					<div class="col-sm-8">
						<h2>ADD Portfolio</h2>
					</div>
					<div class="col-sm-4 text-end">
						<a href="<?= base_url('stylist-zone/manage-portfolio') ?>" class="btn btn-success add_pro"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
					</div>
					<div class="col-sm-12">
						
						<?= $this->session->flashdata('success'); ?>
						<?= $this->session->flashdata('error'); ?>
					</div>
				</div>
				<hr>
			    <?= form_open_multipart('stylist-zone/add-ideas',['name' => 'addPortfolio','id' => 'addPortfolio']) ?>	
				
					<div class="row mt-5">

						<div class="col-sm-12">
							<div class="add_pro1 row">
							  	<div class="col-sm-6">
								  	<div class="col-sm-12">
									  	<div class="form-group boot_sp">
										    <input type="text" id="title" name="title" value="<?= set_value('title'); ?>" class="form-control box_in3">
				    						 <label class="form-control-placeholder2" for="fname">Portfolio Title<span class="text-danger">*</span></label>
				    						 <?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
				    						 <div id="title_err"></div>
										 </div> 
									</div>
							   	 
								   	<div class="col-sm-12">
										<div class="form-group boot_sp">
				    							<input type="file" title="Browse file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp"  class="form-control box_in3" >
				    							<label class="form-control-placeholder2" for="Price">Portfolio Main Image  <span class="extenstion">(Extensions Supported JPEG, JPG, PNG, WEBP)</span><span class="text-danger">*</span></label>
				    							<?= $this->session->flashdata('imgBerror'); ?>
				    							<?= $this->session->flashdata('imgerror'); ?>
				    							<div id="image_err"></div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group boot_sp">
											<input type="file" title="Browse files" class="form-control box_in3" accept=".jpg,.jpeg,.png,.webp" id="multi_image" name="multi_image[]" multiple onchange="document.getElementById('append-big-btn-gallery').value = this.value;"> 
											<label class="form-control-placeholder2" for="Price">More Images <span class="extenstion">(Extensions Supported JPEG, JPG, PNG, WEBP)</span></label>
											<div class="clearfix"></div>
											<br/>
											<div id="multi_image_err"></div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-12">
									    <div class="form-group boot_sp">
									    	<label class="form-control-placeholder2" for="fname" style="z-index: 1;">#Tags<span class="text-danger">*</span></label>
											<select id="tag_id"  name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select"  data-placeholder="Begin typing a tag to filter..." multiple>
											
											 <?php if(!empty($tags)) { foreach($tags as $list) { ?>    								
												<option class="Female" value="<?= $list->id ?>"><?= $list->tag ?></option>
											 <?php } } ?>
											</select> 
											<?php echo form_error('tag_id','<span class="text-danger mt-1">','</span>');?>
										    <div id="tag_id_err"></div>
										</div>
									</div>
			                       	<div class="col-sm-12">
										<div class="form-group boot_sp">
											<textarea class="form-control box_in2" id="content" name="content" row="5"><?= set_value('content') ?></textarea>
											<label class="form-control-placeholder2" for="Price">Short Description<span class="text-danger">*</span></label>
											<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
											<div id="content_err"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 text-center">
							<input type="submit" value="Add"  class="btc">
						</div>
					</div>
				<?= form_close(); ?>				
			</div>
	    </div>
	</div>
</div><!--container-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

<script>
	$('#subcategory').find('optgroup').hide(); // initialize
	$('#category').change(function() {
	 var $cat = $(this).find('option:selected');
	 var $subCat = $('#subcategory').find('.' + $cat.attr('class'));
	 $('#subcategory').find('optgroup').not("'"+ '.' + $cat.attr('class') + "'").hide(); // hide other optgroup
	 $subCat.show();
	 $subCat.find('option').first().attr('selected', 'selected');
	});
</script>
<script type="text/javascript">
	$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>
<script>
   	$(document).ready(function(){
        $('#addPortfolio').on('submit',function(e){
	        e.preventDefault();
	        $('#title_err').html('');
	        $('#image_err').html('');
	        $('#multi_image_err').html('');
	        $('#tag_id_err').html('');
	        $('#content_err').html('');
	        
	                
	        if($('#title').val() == '' || $('#title').val().trim().length == '') {
	            $('#title_err').html('<span class="text-primary">Please enter Title</span>');
	            $('#title').focus();
	            return false; 
	        } else if ($('#image').val() == '' || $('#image').val().trim().length == '') { 
				$('#image_err').html('<span class="text-primary">Please upload image</span>') 
				$('#image').focus();
				return false; 
			}
			else if ($('#multi_image').val() == '' ) { 
				$('#multi_image_err').html('<span class="text-primary">Please upload multi image</span>') 
				$('#multi_image').focus();
				return false; 
			
	        }else if ($('#tag_id').val() == '') { 
				$('#tag_id_err').html('<span class="text-primary">Please add tag</span>') 
				$('#tag_id').focus();
				return false; 
			}else if ($('#content').val() == '') { 
				$('#content_err').html('<span class="text-primary">Please enter content data</span>') 
				$('#content').focus();
				return false; 
			}
			else{
				$('#addPortfolio').get(0).submit();
				return true;
			}
	    });
    });
</script>
<?php $this->load->view('front/vandor/footer'); ?>
