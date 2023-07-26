<?php $this->load->view('admin/template/header'); ?>

<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>



<div class="container-fluid form-main">

    <div class="row">

	<div class="card  form-card mt-1">

   	<div id="message" class="text-primary text-center "></div>



    <div class="text-end">	<a href="<?php echo base_url($url1.'/'.$url2); ?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List </a></div>

	 

	    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

       	<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>	

       	<?= form_open_multipart('') ?>	

		<div class="row mt-2">

		 	<div class="col-sm-6 p-0"> 

			     <div class="col-sm-12">

					<div class="form-group boot_sp">

						<label class="col-form-label" for="gendertype">Story Category<span class="text-danger">*</span></label>

					<select id="gendertype" name="category_id" class="form-control box_in3" required>

							<option value="">Story Category</option>

                            <?php if(!empty($category)) { foreach($category as $list) { ?>    								

							<option class="Female" value="<?= $list->id ?>" <?=  ($list->id == $styleStory->category_id)?'selected':'' ?> ><?= $list->blogCategoryName ?></option>

							<?php } } ?>

						</select> 

					

						<?php echo form_error('category_id','<span class="text-danger mt-1">','</span>');?>

					</div>

				</div>

				

				<div class="col-sm-12">

					<div class="form-group boot_sp">

					    <label class="col-form-label" for="fname">Story Title<span class="text-danger">*</span></label>

					    <input type="text" id="blogTitle" name="blogTitle" value="<?= set_value("blogTitle",$styleStory->blogTitle); ?>" class="form-control box_in3">

						 

						 <?php echo form_error('blogTitle','<span class="text-danger mt-1">','</span>');?>

					</div>

				</div>

            </div>

            <div class="col-sm-6 p-0"> 

            	<div class="col-sm-12">

				    <div class="form-group boot_sp">

						<label class="col-form-label" for="gendertype">Story Tags </label>

						<select id="tag_id"  name="tag_id[]" class="form-control box_in33 chosen-select" size = "3">

						

						 <?php $tagArr = array();if($styleStory->tag_id) { $tagArr = explode(',',$styleStory->tag_id); }?>

						 <?php if(!empty($tags)) { ?>

    						 <?php foreach($tags as $list) { ?>    								

    							<option class="Female" value="<?= $list->id ?>" <?php if(in_array($list->id,$tagArr)) { echo "selected"; } ?>><?= $list->tagName ?></option>

    						 <?php } ?>

						 <?php } ?>

						</select> 

						

						<?php echo form_error('tag_id','<span class="text-danger mt-1">','</span>');?>

					</div>

				</div>

            </div>

			<div class="col-sm-12">

				<div class="add_pro1">

				    <div class="form-group boot_sp">

				       <label class="col-form-label" for="Price">Short Description<span class="text-danger">*</span></label>

						<textarea class="form-control box_in2" name="shortData" row="5"><?= set_value("shortData",$styleStory->shortData) ?></textarea>

						

						<?php echo form_error('shortData','<span class="text-danger mt-1">','</span>');?>

					</div>

					<div class="form-group boot_sp">

					    <label class="col-form-label" for="Price">Long Description<span class="text-danger">*</span></label>

						<textarea class="form-control box_in2" id="editor1" name="longData"><?= set_value("longData",$styleStory->longData) ?></textarea>

						

						<?php echo form_error('longData','<span class="text-danger mt-1">','</span>');?>

						

					    <input type="hidden" name="id" value="<?= $styleStory->id ?>">

					    <input type="hidden" name="old_blogImage" value="<?= $styleStory->blogImage ?>">

					    <input type="hidden" name="old_detailImg" value="<?= $styleStory->detailImg ?>">

					</div>

					

					<div class="row">

					    <div class="col-6">
    						<div class="form-group boot_sp">
    						   <label class="col-form-label" for="Price">Story Media</label>
    							<input type="file" id="blogImage" name="blogImage" accept="*"  class="form-control box_in3" >
    							<input type="text" name="screenshotbase64" id="screenshotbase64" value="" style="display: none;" />
    							<p id="uploadvidbutProcessing" style="color:#000"></p>
    							<video width="400" id="videoelem" style="display: none;" controls>
		                           <source src="" id="video_src">
		                           Your browser does not support HTML5 video.
		                       	</video>

    							<?= $this->session->flashdata('imgBerror'); ?>

    							<?= $this->session->flashdata('imgerror'); ?>

    						</div>

    						<?php  if ($this->uri->segment(3) == 'edit') { ?>
						    	<?php  if ($styleStory->blogImage) { ?>
						    		<?php  $img = image_exist($styleStory->blogImage,'assets/images/story/'); ?>
							    	<?php  if ($styleStory->blogImage_type == 'video') { ?>
							    		<video class="video-col-1" style="width:100%" controls>
							                <source src="<?= base_url($img) ?>" type="video/mp4">
							            </video>
							    	<?php  }else{ ?>
								    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="border border-info img-thumbnail"style="width:65px;height:65px;">
								    <?php  } ?>
							    <?php  } ?>
							<?php  } ?>
					    </div>
					    <?php  if ($this->uri->segment(3) == 'edit') { ?>
					    	<?php  if ($styleStory->blogImage) { ?>
					    		<?php  if ($styleStory->blogImage_type == 'video') { ?>
						    	<div class="col-6">
    								<div class="form-group boot_sp">
    						   			<label class="col-form-label" for="Price">Story Media Thumbnail</label>
    									<input type="file" id="blogImage_thumbnail" name="blogImage_thumbnail" accept="*"  class="form-control box_in3" >
    								</div>
    								<?php  if ($styleStory->blogImage_thumbnail) { ?>
							    		<?php  $img = image_exist($styleStory->blogImage_thumbnail,'assets/images/story/'); ?>
							    		<?php  if ($img) { ?>
									    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="border border-info img-thumbnail"style="width:65px;height:65px;">
										     
									    <?php  } ?>
								    <?php  } ?>
    							</div> 
						    	<?php  } ?>
						    <?php  } ?>
						<?php  } ?>
					    <!--<div class="col-6" style="display: none;">
    						<div class="form-group boot_sp">
    						    <label class="col-form-label" for="Price">Story Detail Page Media</label>
    							<input type="file" id="detailImg" accept="*" name="detailImg" class="form-control box_in3" >
    						    <?= $this->session->flashdata('imgBerrorr'); ?>
    							<?= $this->session->flashdata('imgerrorr'); ?>
    						</div>

    						<?php  if ($this->uri->segment(3) == 'edit') { ?>

						    	<?php  if ($styleStory->detailImg) { ?>
						    		<?php  $img = image_exist($styleStory->detailImg,'assets/images/story/'); ?>
							    	<?php  if ($styleStory->detailImg_type == 'video') { ?>
							    		<video class="video-col-1" style="width:100%" controls>
							                <source src="<?= base_url($img) ?>" type="video/mp4">
							            </video>
							    	<?php  }else{ ?>
								    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="border border-info img-thumbnail"style="width:65px;height:65px;">
								    <?php  } ?>
							    <?php  } ?>

							<?php  } ?>

					   </div>-->
				   </div>	
					<div class="form-group boot_sp">
				       <label class="col-form-label" for="Price">Meta Title</label>
						<textarea class="form-control box_in2" name="meta_title" row="5"><?= set_value("meta_title",$styleStory->meta_title) ?></textarea>
						<?php echo form_error('meta_title','<span class="text-danger mt-1">','</span>');?>
					</div>
					<div class="form-group boot_sp">
				       <label class="col-form-label" for="Price">Meta Keyword</label>
						<textarea class="form-control box_in2" name="meta_keyword" row="5"><?= set_value("meta_keyword",$styleStory->meta_keyword) ?></textarea>

						<?php echo form_error('meta_keyword','<span class="text-danger mt-1">','</span>');?>

					</div>

					<div class="form-group boot_sp">

				       <label class="col-form-label" for="Price">Meta Description</label>

						<textarea class="form-control box_in2" name="meta_description" row="5"><?= set_value("meta_description",$styleStory->meta_description) ?></textarea>

						<?php echo form_error('meta_description','<span class="text-danger mt-1">','</span>');?>

					</div>

				</div>

			</div>

			

		 

			<div class="col-sm-12 text-center mt-3">

				<input type="submit" value="Update Style Stories" id="uploadvidbut"  class="btn btn-primary">

			</div>

		</div>

	    <?= form_close(); ?>				

			 

	    

</div>

</div>

</div>

<?php $this->load->view('admin/template/footer'); ?>
 

<script>

	$('#subcategory').find('optgroup').hide();

	$('#category').change(function() {

		var $cat = $(this).find('option:selected');

		var $subCat = $('#subcategory').find('.' + $cat.attr('class'));

		$('#subcategory').find('optgroup').not("'"+ '.' + $cat.attr('class') + "'").hide(); 

		$subCat.show();

		$subCat.find('option').first().attr('selected', 'selected');

	});

</script>
<script type="text/javascript">
    var scalefac = 0.25; 
    var screenshots = []; 
    function capture(video, scalefac) {
        if(scalefac == null){
            scalefac = 1;
        }
        var w = video.videoWidth * scalefac;
        var h = video.videoHeight * scalefac;
        var canvas = document.createElement('canvas');
            canvas.width  = w;
            canvas.height = h;
        var ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, w, h);
        return canvas;
    }
    //$(document).ready(function(){
        $(document).on("change", "#blogImage", function(){
            if($('#blogImage').prop("files")[0].type.split('/')[0] !== 'image'){
                var lasource = $('#video_src');
                console.log(lasource);
                $("#uploadvidbutProcessing").html("Please wait...");
                //$("#uploadvidbut").attr("disabled", true);
                lasource[0].src = URL.createObjectURL($('#blogImage').prop("files")[0]);
                lasource.parent()[0].load();
                var video = document.getElementById("videoelem");
                setTimeout(function(){ 
                    // Video needs to load then we check the state.
                    if (video.readyState == "4"){
                        var videoduration = $("#videoelem").get(0).duration;
                        var timetogoto = videoduration / 2;
                        $("#videoelem").get(0).currentTime = timetogoto;
                        videodurationNum = Math.floor(videoduration);
                        if(videodurationNum < 301){
                            $('.five_min_upload').html('');
                            setTimeout(function(){
                                // Video needs to load again
                                var video  = document.getElementById("videoelem");
                                // function the screen grab.
                                var canvas = capture(video, scalefac);
                                screenshots.unshift(canvas);
                                for(var i=0; i<4; i++){
                                    $("#uploadvidbutProcessing").html("");
                                    $("#screenshotbase64").val(screenshots[i].toDataURL());
                                    $("#uploadvidbut").removeAttr("disabled");
                                } 
                            }, 500); 
                        }else{
                            //$('.five_min_upload').html('<b>The maximum video length allowed is 5 mins.</b>');
                            var myModal = new bootstrap.Modal(document.getElementById("uploadVideoCheckPopUp"), {});
                            myModal.show();
                        }
                    }      
                },3000);
            }
        });
         
    //});
</script>


 