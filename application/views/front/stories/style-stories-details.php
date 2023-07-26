<?php $this->load->view('front/template/header'); ?>
 

<style>
 @media screen and (min-width: 200px) and (max-width: 767px){
ol.breadcrumb {
   display: none;
}
.middle_part {
    padding: 0px 0px;
    margin-top: 20px!important;
}
 a.shop-filter-active {
    color: #000;
    width: 100%;
   
    display: block;
    margin-bottom: 30px;
    font-weight: bold;
}
.my_vidd {
    position: relative;
    margin-bottom: 20px!important;
}
.playbox {display: none;}
}
</style> 
 
<div class="middle_part mt-5 pt-0">
	<div class="container">
	    
	    <?php if(isMobile()){ ?>
		<div class="cat_filter">
		    <a href="#" class="shop-filter-active">Category <i class="fa fa-angle-down" aria-hidden="true"></i></a>
			
			<div class="product-filter-wrapper" style="display: none;">
                  <?php $this->load->view('front/stories/right-sidebar'); ?> 
			</div>

		</div>
		<?php } ?>
	    
		<div class="row m-0">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
				    <li class="breadcrumb-item"><a href="<?= base_url('style-stories') ?>">Style Stories</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><?= $datas->blogTitle ?></li>
				  </ol>
				</nav>
			</div>
		</div>
    	<div class="row m-0">
    		<div class="col-sm-9">
    			<div class="row m-0">
		    		<div class="col-sm-12 p-0">
		    			<div class="stories_box st_detail">
		    				<div class="my_vidd mb-2">
		    					<?php  $img = image_exist($datas->blogImage,'assets/images/story/'); ?>
						    	<?php  if ($datas->blogImage_type == 'video') { ?>
						    		<video class="video-col-1" id="myVideo" style="width:70%" controls autoplay>
						                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
						                <source src="<?= base_url($img) ?>" type="video/quicktime" playsinline>
						                <source src="<?= base_url($img) ?>" type="video/webm" playsinline>
						                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
						                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
						            </video>
						            <?php  $img = image_exist($datas->blogImage_thumbnail,'assets/images/story/'); ?>
						            <div class="playbox" id="playbox">
						            	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid video_thumbnail" onclick="playVid()">
						            	<div class="video_thumbnail_detaildiv"  onclick="playVid()"><a href="#"><i class="fa fa-play" aria-hidden="true"></i></a></div>
						       		</div>
						       		<script type="text/javascript">
						       			var vid = document.getElementById("myVideo"); 
						       			function playVid() { 
						       				$('#playbox').hide();
										  	vid.play(); 
										} 
						       		</script>
						    	<?php  }else{ ?>
							    	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
							    <?php  } ?>
							    
								<div class="time"><?= date('F j, Y',strtotime($datas->created_at)) ?></div>
		    				</div>
		    				<h1><?= $datas->blogTitle ?></h1>
		    				<?= $datas->longData ?>
		    			</div>

		    			<div class="stories_box st_detail">
		    				<div class="">
								<h4>Leave Your Comments</h4>
								<br>
								<?=$this->session->flashdata('success');?>
								<br>
								<?= form_open_multipart('',['id'=>'comment_form','name'=>'comment_form']) ?>
									<input type="hidden" id="blog_id" name="blog_id" value="<?= $datas->id ?>">

									<?php if($this->session->userdata('loginUser')){ ?>
					            	    <input type="hidden" name="comment_name" id="comment_name"  value="<?=$this->session->userdata('loginUser')?>">
									   	<input type="hidden" name="email" id="email" value="<?=$this->session->userdata('email')?>">
									   	<div class="form-group fm_gp">
										    <label>Your Name</label>
										    <input type="Text" disabled class="form-control" placeholder="Your name" value="<?=$this->session->userdata('loginUser')?>">

										</div>
										<div class="form-group fm_gp">
											<label>Your Email</label>
				    						<input disabled type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">
				    					</div>
					                <?php }else{ ?>	
										<div class="form-group fm_gp">
										    <label>Your Name</label>
										    <input type="Text" class="form-control" id="comment_name" placeholder="Your name" name="comment_name" value="<?=$this->session->userdata('loginUser')?>">
										    <div id="comment_name_err"></div>
										</div>
										<div class="form-group fm_gp">
											<label>Your Email</label>
				    						<input name="email" id="comment_email" type="text" class="form-control" placeholder="Your Email" value="<?=$this->session->userdata('email')?>">
				    						<div id="comment_email_err"></div>
				    					</div>
										 
					                <?php } ?>
									<div class="form-group fm_gp">
										<label>Enter Message</label>
										<textarea id="comment_message" name="comment_message" class="box2" rows="5"></textarea>
										<div id="comment_message_err"></div>
									</div>
									<div class="col-sm-12 text-center"><input type="submit" value="SUBMIT" id="comment_on_story" class="subscribe_bt"></div>
								<?= form_close() ?>
							</div>
		    			</div>
		    			    <?php  if ($comments) {?>
    		    		<div class="row mt-4">
		    				    <?php  foreach ($comments as $key => $value) {?>
        		    			    <div class="row comment">
                                        <div class="col-auto comment-name">
                                            <?=substr($value->name,0,1);?>
                                        </div>
                        
                                        <div class="col-md col-auto">
                                            <h4 class="comment-h4"><?=$value->name;?></h4>
                                            <div class="comment-email"><?=$value->email;?></div>
                                            <p class="comment-p"><?=$value->message;?></p>
                                         </div>
                                    </div>
                                
        		    			     
    		    			    <?php   } ?>
		    			</div>
		    			    <?php   } ?>
		    		</div>
	    		</div>
	    	</div>

    		 <?php if(!isMobile()){ ?>
    		<div class="col-sm-3">
    			<?php $this->load->view('front/stories/right-sidebar'); ?>
    			   
    		</div>
    		<?php } ?>
    		
    	</div>
    </div>
</div>
<?php $this->load->view('front/template/footer'); ?>
<script type="text/javascript">
	$('#comment_form').on('submit',function(e){
        e.preventDefault();
        $('#comment_name_err').html('');
        $('#comment_message_err').html('');
        $('#comment_email_err').html('');

        
        if($('#comment_name').val() == '' || $('#comment_name').val().trim().length == '') {
            $('#comment_name_err').html('<span class="text-red">Please enter Name</span>');
            $('#comment_name').focus();
            return false;
        } else if($('#comment_email').val() == '') {
            $('#comment_email_err').html('<span class="text-red">Please enter email</span>');
            $('#comment_email').focus();
            return false; 
        } else if(!IsEmail($('#comment_email').val())) {
            $('#comment_email_err').html('<span class="text-red">Please enter correct email</span>');
            $('#comment_email').focus();
            return false; 
        } else if($('#comment_message').val() == '' || $('#comment_message').val().trim().length == '') {
            $('#comment_message_err').html('<span class="text-red">Please enter Message</span>');
            $('#comment_message').focus();
            return false;
        }else{
			$('#comment_form').get(0).submit();
			return true;
		}
    });
    
</script>