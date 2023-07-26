<?php $this->load->view('front/vandor/header'); ?>
<?php  $url1 = $this->uri->segment(1);?>

<div class="main">
	<div class="container">
 
	    <div class="col-s-12">
			<div class="rightbar">
				<div class="row">
					
					<div class="container">
						<div class="manage_w">
						<div class="row">
							<div class="col-sm-6">
								<h3>Upload a Video</h3></div>

							<div class="col-sm-6 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/videopage')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

						</div>
						<hr>
						</div>
					</div>
					<div class="col-sm-12">
						
						<?= $this->session->flashdata('success'); ?>
						<?= $this->session->flashdata('error'); ?>
					</div>
				</div>
				<?= form_open_multipart('stylist-zone/add-video',['name' => 'addPortfolio','id' => 'addPortfolio']) ?>	
					<div class=" mt-3 justify-content-center">
						<div class="manage_w">
							<div class="add_pro1 row">

								<div class="col-sm-6">

									<div class="col-sm-12">
										<div class="form-group boot_sp">
										    <input type="text" id="title" name="title" value="<?= set_value('title'); ?>" class="form-control box_in3">
				    						<label class="form-control-placeholder2" for="fname">Portfolio Video Title<span class="text-danger">*</span></label>
				    						<?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
				    						<div id="title_err"></div>
									 	</div> 
									</div>

									<div class="col-sm-12">
										 <div class="form-group boot_sp ">
										    <select id="tag_id"  name="tag_id[]" class="form-control box_in3 chosen-select"  data-placeholder="Begin typing a tag to filter..." multiple>
											<?php if(!empty($tags)) { foreach($tags as $list) { ?>    								
												<option class="Female" value="<?= $list->id ?>"><?= $list->tag ?></option>
											<?php } } ?>
											</select>
				    						<label class="form-control-placeholder2" for="fname">Tags <span class="text-danger">*</span></label>
				    						<?php echo form_error('tag_id','<span class="text-danger mt-1">','</span>');?>
											<div id="tag_id_err"></div>
										</div> 
									</div>

									<div class="col-sm-12">
										<div class="form-group boot_sp">
											<textarea class="form-control box_in_03" id="content" name="content" row="5"><?= set_value('content') ?></textarea>
											<label class="form-control-placeholder2" for="Price">Video  Description<span class="text-danger">*</span></label>
											<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
											<div id="content_err"></div>
										</div>
									</div>

								</div>

								<div class="col-sm-6">
									<div class="col-sm-12">
										<div class="form-group boot_sp ">
											<select id="videoType" name="videoType" class="form-control box_in3" onchange="checkVideo(this.value)">
												<?php $videoType = array('localvideo'=>'Local Video','youtube'=>'Youtube Video');?>
												<?php foreach ($videoType as $key => $value) { ?>
													<option class="Male" value="<?=$key ?>"><?=$value ?></option>
												<?php }?>
											</select> 
											<label class="form-control-placeholder2" for="fname">Video Type</label>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group boot_sp videoClass" id="localvideoDiv">
			    							<input type="file" title="Browse file" id="image" name="image" class="form-control box_in3" >
			    							<progress id="progressBar" value="0" max="100" style="width:100%;display: none;"></progress>
											<p id="status"></p>
											<p id="loaded_n_total"></p>
			    							<label class="form-control-placeholder2" for="Price">Portfolio Video  <span class="extenstion">(Video Extensions Supported MP4)</span></label>
			    							<?= $this->session->flashdata('imgBerror'); ?>
			    							<?= $this->session->flashdata('imgerror'); ?>
			    							<div id="image_err"></div>
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group boot_sp videoClass"  id="youtubeDiv">
										    <input type="text" id="image1" name="image1" value="<?= set_value('image'); ?>" class="form-control box_in3">
				    						 <label class="form-control-placeholder2" for="fname">Youtube Video ID only<span class="text-danger">*</span></label>
				    						 <?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
				    						 <div id="image_err"></div>
										 </div>
									</div>

									

								</div>

								<div class="col-sm-12 text-center">
									<input type="submit" value="Add Video"  class="btc">
								</div>

							</div>
						</div>
						
						
						
						
					</div>
				<?= form_close(); ?>				
			</div>
		</div>
	</div>
</div>
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
	$('#youtubeDiv').hide();
	
	function checkVideo(val){
		$('.videoClass').hide();
		$('#'+val+'Div').show();
	}
   	$(document).ready(function(){
   		//$('#loader').hide(); 
        $('#addPortfolio').on('submit',function(e){
	        e.preventDefault();
	        $('#title_err').html('');
	        $('#image_err').html('');
	        
	        $('#content_err').html('');
	        
	                
	        if($('#title').val() == '' || $('#title').val().trim().length == '') {
	            $('#title_err').html('<span class="text-primary">Please enter Title</span>');
	            $('#title').focus();
	            return false; 
	        }else if ($('#content').val() == '') { 
				$('#content_err').html('<span class="text-primary">Please enter content data</span>') 
				$('#content').focus();
				return false; 
			}
			else{
				var file = _("image").files[0];
				// alert(file.name+" | "+file.size+" | "+file.type);
				var formdata = new FormData();
				formdata.append("title", $('#title').val());
				formdata.append("content", $('#content').val());
				formdata.append("tag_id[]", $('#tag_id').val());
				formdata.append("videoType", $('#videoType').val());
				formdata.append("image1", $('#image1').val());
				formdata.append("image", file);

				var ajax = new XMLHttpRequest();
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", completeHandler, false);
				ajax.addEventListener("error", errorHandler, false);
				ajax.addEventListener("abort", abortHandler, false);
				ajax.open("POST", "<?=base_url('vendor/addVideo_by_ajax')?>");
				ajax.send(formdata);

				//$('#addPortfolio').get(0).submit();
				return true;
			}
	    });
    });
	function _(el) {
	  return document.getElementById(el);
	}

	function uploadFile() {
	  var file = _("image").files[0];
	  // alert(file.name+" | "+file.size+" | "+file.type);
	  var formdata = new FormData();
	  formdata.append("image", file);
	  var ajax = new XMLHttpRequest();
	  ajax.upload.addEventListener("progress", progressHandler, false);
	  ajax.addEventListener("load", completeHandler, false);
	  ajax.addEventListener("error", errorHandler, false);
	  ajax.addEventListener("abort", abortHandler, false);
	  ajax.open("POST", "file_upload_parser.php");
	  ajax.send(formdata);
	}

	function progressHandler(event) {
	  _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
	  var percent = (event.loaded / event.total) * 100;
	  _("progressBar").style.display = 'block';
	  _("progressBar").value = Math.round(percent);
	  _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
	}

	function completeHandler(event) {
	  _("status").innerHTML = event.target.responseText;
	  _("progressBar").value = 0; //wil clear progress bar after successful upload
	  setTimeout(function () {
        location.reload(true);
      }, 1000);
	}

	function errorHandler(event) {
	  _("status").innerHTML = "Upload Failed";
	}

	function abortHandler(event) {
	  _("status").innerHTML = "Upload Aborted";
	}
</script>

<?php $this->load->view('front/vandor/footer'); ?>
