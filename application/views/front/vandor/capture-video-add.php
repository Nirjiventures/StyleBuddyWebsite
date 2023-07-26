<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">
    .additional_search {
        background: #fffc00;
        padding: 6px 6px;
        text-transform: none;
        letter-spacing: 1px;
        font-weight: 900;
    }     
    .display-none {
        display: none;
    }

    .recording {
        color: red;
        background-color: rgb(241 211 211);
        padding: 5px;
        margin: 6px auto;
        width: fit-content;
    }

    video {
        background-color: black;
        display: block;
        margin: 6px auto;
        width: 100%;
    }

    audio {
        display: block;
        margin: 6px auto;
    }

    a {
        color: green;
    }

    .save-video,.upload-video,.start-video,.stop-video{
        width: 100%;
        display: inline-block;
        text-align: center;
        line-height: 38px;
        /*margin: 2px;*/
        cursor: pointer;
        text-decoration: none;
        background: #f62ac1;
        color: #fff;
    }
    button:disabled {
        background:none!important;
        color:#000!important;
    }
    

	.text-red{color: #bd1f1f!important;}
	
	.mere_video {
	    padding: 20px;
	    background: #fff;
	    box-shadow: 2px 6px 7px #9f9898;
	    border-radius: 8px;
	}

	.bkk{background: #f62ac1; border-color: #f62ac1; text-transform: uppercase;}
	.bdc{ border-color: #f62ac1; text-transform: uppercase;}
 
</style>
<div class="main">
	<div class="row m-0 row-flex">
 
		<div class="col-sm-12">
			<div class="rightbar">
				
				<div class="container">
					<div class="manage_w">
					<div class="row">
						<div class="col-sm-6">
							<h3>Record a Video</h3>
						</div>

						<div class="col-sm-6 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/videopage')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
					</div>
				</div>
				
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				<div class="container">
					<div class="manage_w">
					<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
					
					<div class="record_pp popupClose">
                        <div class="recd_pannel kalvin_sidebar">
                        	<div id="success_msg"></div>
    						
    						<div class="row">	 
								
								<div class="col-sm-6">
									
									<div class="col-sm-12">
										<div class="form-group boot_sp">
											<label class="" for="fname"> Video Title<span class="text-danger">*</span></label>
										    <input type="text" id="title" name="title" value="<?= set_value('title'); ?>" class="form-control box_in3">
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

								</div>
 
								
								<div class="col-sm-6">
									<div class="form-group boot_sp">
										<label class="" for="Price">Video Description<span class="text-danger">*</span></label>
										<textarea class="form-control box_in_02" name="content" id="content" row="8"><?= set_value('content',$idea->content) ?></textarea>
										<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
										<div id="content_err"></div>
									</div>
								</div>
								
								
								<div id="video_err"></div>
								

							 
								<article>
		        			        <section class="experiment recordrtc">
	                                    <div class="display-none" id="vid-recorder">
	                                     <div class="row justify-content-center">
	                                     <div class="col-sm-12">
		                                    <div class="row justify-content-center">
		                                        <div class="col-md-3 mb-3">
		                                            <button type="button" class="bkk start-video" id="start-vid-recording"
		                                                onclick="startRecording(this,
		                                                document.getElementById('stop-vid-recording'))">
		                                                <i class="fa fa-video-camera" aria-hidden="true"></i> Start Recording
		                                            </button>
		                                        </div>
		                                        <div class="col-md-3 mb-3">
		                                            <button type="button" class="bdc stop-video" id="stop-vid-recording"
		                                                disabled onclick="stopRecording(this,
		                                                document.getElementById('start-vid-recording'))">
		                                                <i class="fa fa-stop-circle-o" aria-hidden="true"></i> Stop Recording
		                                            </button>
		                                        </div>

		                                       
		                                    </div>
	                                    </div>
	                                    <div class="col-sm-12">
	                                    	<div class="mere_video">
	                                        <div class="recording" id="vid-record-status" style="display:none">
	                                            Click the "Start video Recording"
	                                            button to start recording
	                                        </div>
	                                        <video width="100%"  autoplay id="web-cam-container"style="background-color: black;">
	                                            Your browser doesn't support
	                                            the video tag
	                                        </video>
	                                        <div>
	                                            <span id="errorMsg"></span>
	                                        </div>
	                                        <div id="recordVideo" style="width: 100%;">
	                                        
	                                        </div>

	                                    </div>
	                                    </div>
	                                    <div class="col-md-12 mt-5 p-0 text-center">
                                        	<button type="button" class="btc" onclick="uploadToServer()"><i class="fa fa-upload" aria-hidden="true"></i> UPLOAD VIDEO</button>	 
                                        </div>
	                                    </div>
	                                </div>
							        </section>
							    </article>
						 				

	    						
    						</div>
                        </div>
                    </div>
					<?= form_close(); ?>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>
</body>
</html>
<style type="text/css">
	.text-red{

		color: #bd1f1f!important;

	}
</style>
<?php $this->load->view('front/vandor/footer'); ?>
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

<script type="text/javascript">
	$(document).ready(function(){
	 	$(".record").click(function(){
			$(".record_pp").show();
			$(".upload_pp").hide();
	  	});
	  
	  	$(".upload_v").click(function(){
			$(".upload_pp").show();
			$(".record_pp").hide();
	  	});
	  	$(".reveal-click").click(function(){
	  		$('.popupClose').css('display','none');
	  	});

	});
	

    const mediaSelector = document.getElementById("media");
    const webCamContainer = document.getElementById("web-cam-container");
    const recordVideoContainer = document.getElementById("recordVideo");
    const errorMsgElement = document.querySelector('span#errorMsg');

    let selectedMedia = 'vid';
    let blob = [];
    let mediaRecorder;
    let chunks = [];
    selectedMedia = 'vid';
    console.log(selectedMedia);
    document.getElementById(`${selectedMedia}-recorder`).style.display = "block";

    const audioMediaConstraints = {
        audio: true,
        video: false,
    };

    const videoMediaConstraints = {
        audio: true,
        video: true,
    };

    
    var listOfFilesUploaded = [];
    function startRecording(thisButton, otherButton) {
        recordVideoContainer.innerHTML = '';
        webCamContainer.style.display = "block";
        try{
            navigator.mediaDevices.getUserMedia(
                selectedMedia === "vid" ?
                videoMediaConstraints :
                audioMediaConstraints)
                .then((mediaStream) => {

                mediaRecorder =  new MediaRecorder(mediaStream);

                window.mediaStream = mediaStream;
                window.mediaRecorder = mediaRecorder;

                mediaRecorder.start();

                mediaRecorder.ondataavailable = (e) => {

                    chunks.push(e.data);
                };

                mediaRecorder.onstop = () => {
                    blob = new Blob(
                        chunks, {
                            type: selectedMedia === "vid" ?
                                "video/mp4" : "audio/mpeg"
                        });
                    chunks = [];

                    const recordedMedia = document.createElement(
                        selectedMedia === "vid" ? "video" : "audio");
                    recordedMedia.controls = true;

                    const recordedMediaURL = URL.createObjectURL(blob);

                    recordedMedia.src = recordedMediaURL;
                    const downloadButton = document.createElement("a");

                    downloadButton.download = "Recorded-Media";

                    downloadButton.href = recordedMediaURL;
                    downloadButton.innerText = "Download it!";

                    downloadButton.onclick = () => {
                        URL.revokeObjectURL(recordedMedia);
                    };
                    recordVideoContainer.innerHTML = '<div class="row"><div class="col-md-12"><video controls src="'+recordedMedia.src+'"></video></div></div><div class="row"><div class="col-md-12"><a class="save-video" download="Recorded-Media" href="'+downloadButton+'">Download</a></div></div>';

                    console.log(`${selectedMedia}-recorder`);
                    console.log(recordedMedia);
                    console.log(downloadButton);
                    console.log(recordedMedia.src);
                    //document.getElementById(`${selectedMedia}-recorder`).append(recordedMedia, downloadButton);
                };
                if (selectedMedia === "vid") {
                    webCamContainer.srcObject = mediaStream;
                    console.log(mediaStream);
                }
                document.getElementById(`${selectedMedia}-record-status`).innerText = "Recording";

                thisButton.disabled = true;
                otherButton.disabled = false;
            });
        } catch (e) {
            console.error('navigator.getUserMedia error:', e);
            errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
        }
    }
    function uploadToServer(){
    	$('#title_err').html('');
    	$('#content_err').html('');
    	$('#video_err').html('');
    	var searchIDs = $("#tag_id").map(function(){
	      return $(this).val();
	    }).get(); 
    	console.log(searchIDs);
    	if (document.querySelector('#title').value == '') { 
			$('#title_err').html('<span class="text-red">Please enter title</span>') 
			$('#title').focus();
			return false; 
		}else if(!searchIDs.length){
			$('#tag_id_err').html('<span class="text-red">Please select tag</span>') 
			return false; 
		}else if (document.querySelector('#content').value == '') { 
			$('#content_err').html('<span class="text-red">Please enter content</span>') 
			$('#content').focus();
			return false; 
		}else if (blob == '') { 
			$('#video_err').html('<span class="text-red">Please record video</span>') 
			return false; 
		}else{
	        console.log(blob);
	        var fileType = blob.type.split('/')[0] || 'audio';
	        var fileName = (Math.random() * 1000).toString().replace('.', '');
	        if (fileType === 'audio') {
	            fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
	        } else {
	            fileName += '.mp4';
	        }

	        console.log(fileType);
	        console.log(fileName);
	        
	        var formData = new FormData();
	        formData.append(fileType + '-filename', fileName);
	        formData.append(fileType + '-blob', blob);
	        formData.append('title', document.querySelector('#title').value);
	        formData.append('content', document.querySelector('#content').value);
	        formData.append('tag_id', searchIDs);
	        //var upload_url = 'save.php';
	        //var upload_directory = 'uploads/';
	        var upload_url = '<?=base_url('/vendor/uploadCaptureVideo');?>';;
	        var upload_directory = 'assets/images/story/';
	        makeXMLHttpRequest(upload_url, formData, function(progress) {
	            if (progress !== 'upload-ended') {
	                callback(progress);
	                return;
	            }
	            callback('ended', upload_directory + fileName);
	            listOfFilesUploaded.push(upload_directory + fileName);
	        });
	    }
    }
    function makeXMLHttpRequest(url, data ) {
        var request = new XMLHttpRequest();
        //console.log(request);
        //console.log(url);
        request.onreadystatechange = function() {
        	//console.log(request);
            if (request.readyState == 4 && request.status == 200) {
                //console.log(request.response);
                $('#success_msg').html('Video uploaded successfully!!');
                $('#success_msg').fadeOut(3000);
                setTimeout(function() {
				    location.href='<?=base_url('stylist-zone/manage-video')?>';
				}, 2000);

                $('#upload_successful').modal('show');
                //callback('upload-ended');
            }
        };

        request.upload.onloadstart = function() {
           // callback('Upload started...');
        };

        request.upload.onprogress = function(event) {
           // callback('Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
        };

        request.upload.onload = function() {
           // callback('progress-about-to-end');
        };

        request.upload.onload = function() {
           // callback('progress-ended');
        };

        request.upload.onerror = function(error) {
           // callback('Failed to upload to server');
            console.error('XMLHttpRequest failed', error);
        };

        request.upload.onabort = function(error) {
           // callback('Upload aborted.');
            console.error('XMLHttpRequest aborted', error);
        };

        request.open('POST', url);
        request.send(data);
    }
    function stopRecording(thisButton, otherButton) {
        window.mediaRecorder.stop();
        window.mediaStream.getTracks()
        .forEach((track) => {
            track.stop();
        });
        webCamContainer.style.display = "none";
        document.getElementById(`${selectedMedia}-record-status`).innerText = "Recording done!";
        thisButton.disabled = true;
        otherButton.disabled = false;
    }

</script>
