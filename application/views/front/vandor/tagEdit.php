<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">

		<!-- <div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div> -->


    <div class="manage_w">
		
		
		<div class="rightbar">
			<div class="row">
				<div class="col-sm-6">
					<h2>Update  #Tags</h2>
					<?= $this->session->flashdata('success'); ?>
					<?= $this->session->flashdata('error'); ?>
				</div>
				<div class="col-sm-6 text-end">
					<a href="<?= base_url('stylist-zone/manage-tags') ?>" class="btn btn-success add_pro float-right">Manage  #Tags</a>
					<a href="<?= base_url('stylist-zone/manage-ideas') ?>" class="btn btn-success add_pro float-left">Manage Portfolio</a>
				</div>
			</div>
			
			<hr>
		        <?= form_open('stylist-zone/update-tags') ?>	
			<div class="row mt-5">
			
				<div class="col-sm-12">
					<div class="add_pro1">
					<input type="hidden" name="id" value="<?= $tags->id ?>">	
				<div class="col-sm-12 mt-3">
				         <div class="form-group boot_sp">
							<input type="text" name="tag" id="tag" value="<?= set_value('tag',$tags->tag); ?>" placeholder="Enter Your Tags" class="form-control box_in3">
							<label class="form-control-placeholder2" for="Price"> #Tags<span class="text-danger">*</span></label>
							<?php echo form_error('tag','<span class="text-danger mt-1">','</span>');?>
						 </div>
				</div>
				
				<div class="col-sm-12 text-center">
					<input type="submit" value="Update Tag"  class="btc">
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
