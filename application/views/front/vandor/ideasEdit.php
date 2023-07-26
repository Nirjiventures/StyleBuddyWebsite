<?php $this->load->view('front/vandor/header'); ?>
<?php  $url1 = $this->uri->segment(1);?>

<?php //print_r($idea) ?>
<div class="main">
	<div class="container">

	 

    <div class="manage_w">
		
		
		<div class="rightbar">
			<div class="row">
				
				<div class="col-sm-8"><h2>UPDATE Portfolio</h2></div>
				<div class="col-sm-4 text-end">
					<a href="<?= base_url('stylist-zone/manage-portfolio') ?>" class="btn btn-success add_pro"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
				</div>
				<div class="col-sm-12">
					
					<?= $this->session->flashdata('success'); ?>
					<?= $this->session->flashdata('error'); ?>
				</div>
			</div>
			    
			<hr>
		        <?= form_open_multipart('') ?>	
			<div class="row mt-5">
			
				<div class="col-sm-12">
					<div class="add_pro1 row">
					    <input type="hidden" name="id" value="<?= $idea->id ?>">
					    <input type="hidden" name="old_img" value="<?= $idea->image ?>">
					  	
					  	
					    <div class="col-sm-6">
					    	<div class="col-sm-12">
					    			<div class="form-group boot_sp">
									    <input type="text" id="title" name="title" value="<?= set_value('title',$idea->title); ?>" class="form-control box_in3">
			    						<label class="form-control-placeholder2" for="fname">Portfolio Title<span class="text-danger">*</span></label>
			    						<?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
									</div>
					    	</div>
					    	<div class="col-sm-12">
	    						<div class="form-group boot_sp">
	        							<input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp"  class="form-control box_in3"  title="Browse Image" id="aa" onchange="pressed()"><label id="fileLabel"></label>
	        							<label class="form-control-placeholder2" for="Price">Portfolio Main Image (<span class="extenstion">Extensions Supported JPEG, JPG, PNG, WEBP </span>)<span class="text-danger">*</span></label>
	        							<?= $this->session->flashdata('imgBerror'); ?>
	        							<?= $this->session->flashdata('imgerror'); ?>

	        							<?php  if (file_exists($image_path = FCPATH . 'assets/images/story/' . $idea->image)) { ?>
										    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/'.$idea->image) ?>"  class="order_pic">
										<?php  } else { ?>
										    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>"  class="order_pic">
										<?php  } ?>
	    						</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<input type="file" class="form-control box_in3" accept=".jpg,.jpeg,.png,.webp"  title="Browse Images" name="multi_image[]" multiple onchange="document.getElementById('append-big-btn-gallery').value = this.value;">
									<label class="form-control-placeholder2" for="Price">More Images (<span class="extenstion">Extensions Supported JPEG, JPG, PNG, WEBP </span>)</label>
									 
									<?php   if(!empty($idea->multi_image)){  ?> 
										<?php   $imageArray = explode(',',$idea->multi_image); ?> 
										<?php   $k = 0;foreach($imageArray as $value){ $k++; ?>
											<?php   if(!empty($value)){  ?> 
												<span class="" id="<?=$k.'__gal_image_s'?>">
													<a class="cross_image" onclick="delete_image('<?=$k.'__gal_image_s'?>',<?=$idea->id?>,'<?=$value?>','uploads/','multi_image','ideas','vendor')">X</a>

													<?php  if (file_exists($image_path = FCPATH . 'assets/images/story/' . $value)) { ?>
													    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/'.$value) ?>"  class="cross_img">
													<?php  } else { ?>
													    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>" class="cross_img">
													<?php  } ?>
												</span>	
											<?php   }   ?>
										<?php   }   ?>
									<?php   }   ?>
									<div class="clearfix"></div>
									<br/>
								</div>
							</div>
					    </div>
					    <div class="col-sm-6">
					    	<div class="col-sm-12">
					    		<div class="form-group boot_sp">
									<label class="form-control-placeholder2" for="fname" style="z-index: 1;">#Tags </label>
	    							<select id="tag_id"  name="tag_id[]" class="form-control-lg form-control box_in33 chosen-select"  data-placeholder="Begin typing a tag to filter..." multiple  required>
	    							
	    							 <?php $select = ''; $tagArr = explode(',',$idea->tag_id); if(!empty($tags)) { foreach($tags as $list) { 
	    							 ?>    								
	    							 <option class="Female" <?php if (in_array($list->id, $tagArr)) { echo "selected"; } else {} ?> value="<?= $list->id ?>" ><?= $list->tag ?></option>
	    							 <?php } } ?>
	    							</select> 
	    							
							    	
	    							<?php echo form_error('tag_id','<span class="text-danger mt-1">','</span>');?>
									
								</div>
					    	</div>

					    	<div class="col-sm-12">
					    		<div class="form-group boot_sp">
									<textarea class="form-control box_in2" name="content" row="5"><?= set_value('content',$idea->content) ?></textarea>
									<label class="form-control-placeholder2" for="Price">Short Description<span class="text-danger">*</span></label>
									<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
								</div>
					    	</div>

					    </div>
						
					</div>
				</div>
				
				<div class="col-sm-12 text-center">
					<input type="submit" value="Update"  class="btc">
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
 

<?php $this->load->view('front/vandor/footer'); ?>
<script type="text/javascript">
	function delete_image(display,id,img,path,column,table,controller) {
		let text = "Do you want to delete this";
		if (confirm(text) == true) {
			$.ajax({
				type: 'GET',
				url: '<?=base_url()?>'+controller+'/deleteIdeaImages',	
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

	window.pressed = function(){
	    var a = document.getElementById('aa');
	    if(a.value == "")
	    {
	        fileLabel.innerHTML = "Choose file";
	    }
	    else
	    {
	        var theSplit = a.value.split('\\');
	        fileLabel.innerHTML = theSplit[theSplit.length-1];
	    }
	};


	/*$('input[type=file]').click(function() {
	    console.log(this.value);
	    if(this.value == ""){
	        $(this).css('color','transparent');
	    } else {
	        $(this).css('color','black');
	    }

	});*/

</script>