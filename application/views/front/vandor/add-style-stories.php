<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->


    <div class="manage_w">
		
		
		<div class="rightbar">

			<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<h3>Write on the Board</h3></div>

						<div class="col-sm-6 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/fashionboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
				</div>


			<div class="row">

				<div class="col-sm-8">
					<?= $this->session->flashdata('success'); ?>
					<?= $this->session->flashdata('error'); ?>
				</div>
				<div class="col-sm-4 text-end">
					
				</div>
			</div>
			    
			
		        <?= form_open_multipart('stylist-zone/add-style-stories') ?>	
			<div class="row mt-5 justify-content-center">
			

				 <div class="col-sm-6"> 
					     <div class="col-sm-12 col-12">
    						<div class="form-group boot_sp">
    						<select id="gendertype" name="category_id" class="form-control box_in3" required>
    								<option value="">Story Category</option>
                                    <?php if(!empty($category)) { foreach($category as $list) { ?>    								
    								<option class="Female" value="<?= $list->id ?>"><?= $list->blogCategoryName ?></option>
    								<?php } } ?>
    							</select> 
    							<label class="form-control-placeholder2" for="gendertype">Story Category<span class="text-danger">*</span></label>
    							<?php echo form_error('category_id','<span class="text-danger mt-1">','</span>');?>
    						</div>
						</div>
						
						<div class="col-sm-12 col-12">
						    <div class="form-group boot_sp">
    							<select id="tag_id"  name="tag_id[]" class="form-control box_in33 chosen-select" multiple size = "3">
    							
    							 <?php if(!empty($tags)) { foreach($tags as $list) { ?>    								
    								<option class="Female" value="<?= $list->id ?>"><?= $list->tagName ?></option>
    							 <?php } } ?>
    							</select> 
    							<label class="form-control-placeholder2" for="gendertype">Story Tags</label>
    							<?php echo form_error('tag_id','<span class="text-danger mt-1">','</span>');?>
							</div>
						</div>

						
                    </div> 

                     <div class="col-sm-6">

                     	<div class="col-sm-12">
							<div class="form-group boot_sp">
							    <input type="text" id="blogTitle" name="blogTitle" value="<?= set_value('blogTitle'); ?>" class="form-control box_in3">
	    						 <label class="form-control-placeholder2" for="fname">Story Title<span class="text-danger">*</span></label>
	    						 <?php echo form_error('blogTitle','<span class="text-danger mt-1">','</span>');?>
							</div>
						</div>


                     	<div class="col-sm-12">
                     		<div class="form-group boot_sp">
								<textarea class="form-control box_in2" name="shortData" row="5"><?= set_value('shortData') ?></textarea>
								<label class="form-control-placeholder2" for="Price">Short Description<span class="text-danger">*</span></label>
								<?php echo form_error('shortData','<span class="text-danger mt-1">','</span>');?>
							</div>
                     	</div>
					 </div>

					<div class="col-sm-12">
						<div class="form-group boot_sp">
								<textarea class="form-control box_in2" id="editor1" name="longData"><?= set_value('longData') ?></textarea>
								<label class="form-control-placeholder2" for="Price">Long Description<span class="text-danger">*</span></label>
								<?php echo form_error('longData','<span class="text-danger mt-1">','</span>');?>
								<script type="text/javascript"> CKEDITOR.replace("editor1"); </script>
							</div>
					</div>

					 <div class="col-sm-6 col-12">
						<div class="form-group boot_sp">
							<input type="file" id="blogImage" name="blogImage" accept=".jpg,.jpeg"  class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Price">Story Main Image<span class="text-danger">*</span></label>
							<?= $this->session->flashdata('imgBerror'); ?>
							<?= $this->session->flashdata('imgerror'); ?>
						</div>
				    </div>

				    <div class="col-sm-6 col-12">
						<div class="form-group boot_sp">
							<input type="file" id="detailImg" accept=".jpg,.jpeg" name="detailImg" class="form-control box_in3" >
							<label class="form-control-placeholder2" for="Price">Story Details Image<span class="text-danger">*</span></label>
						    <?= $this->session->flashdata('imgBerrorr'); ?>
							<?= $this->session->flashdata('imgerrorr'); ?>
						</div>
				    </div>


				
				<div class="col-sm-12 mt-2 text-center">
					<input type="submit" value="Add Style Stories"  class="btc">
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