<?php $this->load->view('front/vandor/header'); ?>
<?php  $url1 = $this->uri->segment(1);?>

<?php //print_r($idea) ?>
<div class="main">
	<div class="row m-0">

		<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php $this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>

    <div class="col-sm-9">
		
		
		<div class="rightbar">
			<div class="row">
				
				<div class="col-sm-8"><h2>UPDATE Video</h2></div>
				<div class="col-sm-4 text-end">
					<a href="<?= base_url('stylist-zone/youtube-video') ?>" class="btn btn-success add_pro"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
					<div class="add_pro">
					    <input type="hidden" name="id" value="<?= $idea->id ?>">
					    <input type="hidden" name="old_img" value="<?= $idea->image ?>">
					  	<div class="form-group boot_sp">
						    <input type="text" id="title" name="title" value="<?= set_value('title',$idea->title); ?>" class="form-control box_in3">
    						<label class="form-control-placeholder2" for="fname">Portfolio Title<span class="text-danger">*</span></label>
    						<?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
						</div> 
						 

						 
						<div class="form-group boot_sp videoClass" id="localvideoDiv">
    							<input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp"  class="form-control box_in3"  title="Browse Image" id="aa" onchange="pressed()"><label id="fileLabel"></label>
    							<label class="form-control-placeholder2" for="Price">Story Main Image (<span class="extenstion">Video Extensions Supported MP4 </span>)<span class="text-danger">*</span></label>
    							<?= $this->session->flashdata('imgBerror'); ?>
    							<?= $this->session->flashdata('imgerror'); ?>
    							<?php if(!empty($idea->image)) { ?><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  class="order_pic" src='<?php echo base_url().'assets/images/story/'.$idea->image;?>'><?php } ?>
								<?php echo form_error('image') ? '<span class="error">'.form_error('image').'</span>' : ''?>
						</div>
						<div class="form-group boot_sp videoClass"  id="youtubeDiv">
						    <input type="text" id="image" name="image" value="<?= set_value('image',$idea->image); ?>" class="form-control box_in3">
    						 <label class="form-control-placeholder2" for="fname">Youtube Video ID only<span class="text-danger">*</span></label>
    						 <?php echo form_error('image','<span class="text-danger mt-1">','</span>');?>
    						 <div id="image_err"></div>
						 </div>	   
						<div class="form-group boot_sp">
							<textarea class="form-control box_in2" name="content" row="5"><?= set_value('content',$idea->content) ?></textarea>
							<label class="form-control-placeholder2" for="Price">Short Description<span class="text-danger">*</span></label>
							<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
						</div>
					</div>
				</div>
				
				<div class="col-sm-10 mt-3">
					<input type="submit" value="Update"  class="sub">
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


  <?php if($idea->videoType == 'localvideo'){ ?>
	<script type="text/javascript">
		$('#youtubeDiv').hide();
	</script>
<?php }else{ ?>
	<script type="text/javascript">
		$('#localvideoDiv').hide();
	</script>
<?php } ?>

<script>

	function checkVideo(val){
		$('.videoClass').hide();
		$('#'+val+'Div').show();
	}

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


	$('input[type=file]').click(function() {
	    console.log(this.value);
	    if(this.value == ""){
	        $(this).css('color','transparent');
	    } else {
	        $(this).css('color','black');
	    }

	});

</script>