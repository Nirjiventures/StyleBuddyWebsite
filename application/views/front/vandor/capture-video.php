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
        /*width: 420px;*/
        /*height: 368px;*/
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
        background: #000;
        color: #fff;
    }
    button:disabled {
        background:none!important;
        color:#000!important;
    }
    p {
    word-break: break-all;
    white-space: initial;
    width: 430px;
    min-width: 100%;
}
</style>
<div class="main">
	<div class="row m-0 row-flex">

		<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
			  <?php $this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="rightbar">
				<div class="row">
					<div class="col-sm-9"><h2>Recorded Video</h2></div>
					<div class="col-sm-3 text-end"><a href="<?=base_url('stylist-zone/capture-video-add')?>" class="btn btn-success add_pro">Add </a></div>
				</div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
				<div class="logo_p text-left mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
				<hr>
				<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered odc text-nowrap" id="table">
						<thead>
							<tr>
								<th class="date col-sm-2">Title</th>
								<th class="date col-sm-2">Video</th>
								<th class="date col-sm-2">Status</th>
								<th class="action col-sm-2">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if(!empty($portfolio_video)) {  $count = count($portfolio_video);?>
							<?php foreach($portfolio_video as $blog)  {  ?>
								<tr>
									<td><?= $blog->title ?></td>
									<td><p> 
										<?php if($blog->videoType == 'capture'){ ?>
											<?= base_url('assets/images/story/').$blog->image ?>
										<?php } ?>
										</p>
									</td>
									<td>
										<label class="switch switch-green">
										  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
										  <span class="switch-label" data-on="Available" data-off="Booked"></span>
										  <span class="switch-handle"></span>
										</label>
									</td>
									<td>
									    	<a href="<?= base_url('vendor/capture_video_delete/').$blog->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php }?>
						<?php } else {  ?>
						    <tr><td colspan="6" class="text-center">Dates not available.</td></tr>
						<?php  } ?>	
						</tbody>
					</table>
				</div>
				</div>
				<?php $dates = array();?>
				<?php foreach($portfolio_video as $k=>$v){ ?>
					<?php array_push($dates,$v->availability_date);?>
				<?php }?>
				<p>
					<?php 
							if(!empty($dates)){
								 /*echo implode(', ', $dates);*/
							} 
					?>
				</p>
				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
					<div class="record_pp popupClose mt-5" style="display:none">
                        <div class="recd_pannel kalvin_sidebar">
                        	<h4><b>Upload Record Video</b></h4>
                        	<div id="success_msg"></div>
    						<br/>
    						<div class="row mt-5">
    							<div class="col-md-6" style="padding-left: 0px;">
    								<div class="form-group boot_sp">
									    <input type="text" id="title" name="title" value="<?= set_value('title',$idea->title); ?>" class="form-control box_in3">
			    						<label class="form-control-placeholder2" for="fname">Portfolio Title<span class="text-danger">*</span></label>
			    						<?php echo form_error('title','<span class="text-danger mt-1">','</span>');?>
			    						<div id="title_err"></div>
									</div> 
									 
									<div class="form-group boot_sp">
										<textarea class="form-control box_in2" name="content" id="content" row="5"><?= set_value('content',$idea->content) ?></textarea>
										<label class="form-control-placeholder2" for="Price">Short Description<span class="text-danger">*</span></label>
										<?php echo form_error('content','<span class="text-danger mt-1">','</span>');?>
										<div id="content_err"></div>
									</div>
									<button type="button" class="stop-video" onclick="uploadToServer()">Submit</button>
									<div id="video_err"></div>
									

    							</div>
    							<div class="col-md-6 p-0">
    								<article>
    		        			        <section class="experiment recordrtc">
                                            <div class="display-none" id="vid-recorder">
                                            <div class="row">
                                                <div class="col-md-6">
	                                                <button type="button" class="start-video" id="start-vid-recording"
	                                                    onclick="startRecording(this,
	                                                    document.getElementById('stop-vid-recording'))">
	                                                    Start Recording
	                                                </button>
	                                            </div>
                                                <div class="col-md-6">
	                                                <button type="button" class="stop-video" id="stop-vid-recording"
	                                                    disabled onclick="stopRecording(this,
	                                                    document.getElementById('start-vid-recording'))">
	                                                    Stop Recording
	                                                </button>
	                                            </div>
                                            </div>
                                                <div class="recording" id="vid-record-status" style="display:none">
                                                    Click the "Start video Recording"
                                                    button to start recording
                                                </div>
                                                <video width="100%"  autoplay id="web-cam-container"
                                                    style="background-color: black;">
                                                    Your browser doesn't support
                                                    the video tag
                                                </video>
                                                <div>
                                                    <span id="errorMsg"></span>
                                                </div>
                                                <div id="recordVideo" style="width: 100%;">
                                                
                                                </div>
                                            </div>
    							        </section>
    							    </article>
    							</div>
    						</div>
                        </div>
                    </div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<style type="text/css">
	.text-green{
		font-weight: bold;
		color: green!important;
	}
</style>
<?php $this->load->view('front/vandor/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
                    recordVideoContainer.innerHTML = '<div class="row"><div class="col-md-12"><video controls src="'+recordedMedia.src+'"></video></div></div><div class="row"><div class="col-md-6"><a class="save-video" download="Recorded-Media" href="'+downloadButton+'">Download</a></div><div class="col-md-6"><a class="upload-video" download="Recorded-Media" onclick="uploadToServer()">Upload to server</a></div></div>';
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
    	 
    	if (document.querySelector('#title').value == '') { 
			$('#title_err').html('<span class="text-red">Please enter title</span>') 
			$('#title').focus();
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
                console.log(request.response);
                $('#success_msg').html('Video uploaded successfully!!');
                $('#success_msg').fadeOut(3000);
                setTimeout(function() {
				    location.reload();
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
