<?php $this->load->view('front/vandor/header'); ?>
 
<div class="main">
	<div class="container">

		 

		<div class="manage_w">
			<div class="rightbar">

				<div class="container p-0">
					<div class="row">
						<div class="col-sm-6">
							<h3>Profile</h3></div>

							<div class="col-sm-6 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
                    
					<div class="row mbl d-flex justify-content-center">
						<div class="col-sm-7 mt-3">
								<p class="psize">Profile Complete <?=$profile->profile_update_ratio;?>%</p>
							 
									<div class="main1">
										  <input type="range" min="0" max="100" value="<?=$profile->profile_update_ratio;?>" id="slider" disabled>
										  <div id="selector" style="left:<?=$profile->profile_update_ratio;?>%">
										    <div class="selectBtn"></div>
										    <div id="selectValue"></div>
										  </div>
										  <div id="progressBar" style="width:<?=$profile->profile_update_ratio;?>%"></div>
									</div>
							</div>
					</div>

					<hr>
					<?php  if($this->session->flashdata('aboutTotal_message')) {  ?>
    					<div class="logo_p mb-2 mt-2"><?= $this->session->flashdata('aboutTotal_message'); ?></div>
    				<?php } ?>
    				<?php if($this->session->flashdata('more_aboutTotal_message')) {  ?>
    					<div class="logo_p mb-2 mt-2"><?= $this->session->flashdata('more_aboutTotal_message'); ?></div>
    				<?php } ?>
    				<?php if($this->session->flashdata('success')) {  ?>
    					<div class="logo_p mb-2 mt-2"><?= $this->session->flashdata('success'); ?></div>
    				<?php } ?>
    				<?php if($this->session->flashdata('error')) {  ?>
    					<div class="logo_p  mb-2 mt-2"><?= $this->session->flashdata('error'); ?></div>
    				<?php } ?> 
				</div>



				
				
				
				

				<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
				 

				


				<div class="row mt-5">
					<div class="col-sm-12">
						<div class="row align-items-end mb-5">
						 	<div class="col-sm-2 ">
							    <div class="uskk2 mb-2">
							     	<?php  if (file_exists($image_path = FCPATH . 'assets/images/vandor/' . $profile->image)) { ?>
									    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/vandor/'.$profile->image) ?>"  class="img-fluid">
									<?php  } else { ?>
									    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>"  class="img-fluid">
									<?php  } ?>
	    						</div>
							</div>
						    <div class="col-sm-4">
    						<input type="file" class="box" name="image" accept=".jpg,.jpeg" >
    						<?php if($this->session->flashdata('imgerror')) {  ?>
    						<span class="bg-danger text-white p-2"><?= $this->session->flashdata('imgerror');  ?></span>
    						<?php } ?>
				  	      </div>
						  </div>
						  <div class="row">
						  <!--<div class="col-md-2 "></div>-->
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="fname" name="fname" value="<?= $profile->fname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">First name<span class="text-danger">*</span></label>
									<?php echo form_error('fname','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="lname" name="lname" value="<?= $profile->lname ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Last name<span class="text-danger">*</span></label>
									<?php echo form_error('lname','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="email" id="email" name="email" value="<?= $profile->email ?>" readonly class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Email<span class="text-danger">*</span></label>
									<?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="gender">
										<option value="1" <?= ($profile->gender == 1)?'selected':'' ?> >Male</option>
										<option value="2" <?= ($profile->gender == 2)?'selected':'' ?> >Female</option>
									</select>
									<label class="form-control-placeholder2" for="Password">Gender<span class="text-danger">*</span></label>
									<?php echo form_error('gender','<span class="text-danger mt-1">','</span>') ;?>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="mobile" value="<?= $profile->mobile ?>" name="mobile" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="mnumber">Mobile Number</label>
								</div>
							</div>
							<div class="col-sm-4">
								 
								<div class="form-group boot_sp">
										<select class="form-control box_in3"  id="experience" name="experience" >
		    								<option  disabled selected>Select Experience</option>
		    								<?php $aaa = array('< 1'=>'< 1 Years','1'=>'1+ Years','2'=>'2+ Years','3'=>'10-15 Years','15'=>'Above 15 Years');?>
		    								<?php 
		    								for ($i=1; $i < 17  ; $i++) { if($i == $profile->experience){$sel='selected';}else{$sel='';}  if($i == 16){ $text = 'Above 15 Year';}else{$text = '< '.$i.' Year';}?>
		    									<option value="<?=$i?>" <?=$sel?>><?=$text?></option>
		    								<?php } ?>
		    						</select>
									<label class="form-control-placeholder2" for="Password">Years of Experience<span class="text-danger">*</span></label>
									<?php echo form_error('experience','<span class="text-primary mt-1">','</span>') ;?>
									<div id="experience_err"></div>
								</div>
							</div>

							<!--<div class="col-sm-4">-->
							<!--	<div class="form-group boot_sp">-->
							<!--		<input type="date" id="dob" name="dob" value="<?= $profile->dob ?>" class="form-control box_in3">-->
							<!--		<label class="form-control-placeholder2" for="dob">Date Of Birth</label>-->
							<!--	</div>-->
							<!--</div>-->
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="designation" name="designation" value="<?= $profile->designation ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="fname">Designation<span class="text-danger">*</span></label>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="address" name="address" value="<?= $profile->address ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="address">Address</label>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="pin" name="pin" value="<?= $profile->pin ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="pin">Pincode</label>
								</div>
							</div>
							 

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="project_deliverd" name="project_deliverd" value="<?= $profile->project_deliverd ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" class="form-control box_in3">
									<label class="form-control-placeholder2" for="pin">project_deliverd</label>
								</div>
							</div>


							<!-- <div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="flink" name="facebook_link" value="<?= $profile->facebook_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="flink">Facebook Link</label>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group boot_sp">
									<input type="text" id="tlink" name="twitter_link" value="<?= $profile->twitter_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="tlink">Twitter Link</label>
								</div>
							</div> -->

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="instagram_nlink" value="<?= $profile->instagram_nlink ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">Instagram Link</label>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="linkedin_link" value="<?= $profile->linkedin_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">linkedin Link</label>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group boot_sp">
									<input type="text" id="inlink" name="behance_link" value="<?= $profile->behance_link ?>" class="form-control box_in3">
									<label class="form-control-placeholder2" for="inlink">Behance Link</label>
								</div>
							</div>
							


							 

							<!--<div class="col-sm-4">-->
							<!--	<div class="form-group boot_sp">-->
							<!--		<input type="text" id="prlink" name="portfolio_rlink" value="<?= $profile->portfolio_rlink ?>" class="form-control box_in3">-->
							<!--		<label class="form-control-placeholder2" for="prlink">Portfolio Link</label>-->
							<!--	</div>-->
							<!--</div>-->
                            
              <div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="country" id="country">
							            <option>Select Country</option>
							            <?php if($country) { foreach($country as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($profile->country == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="Password">country</label>
								</div>
							</div>
              <div class="col-sm-4">
								<div class="form-group boot_sp">
									<select class="form-control box_in3" name="state" id="state">
							            <option>Select State</option>
							            <?php if($states) { foreach($states as $state) { ?>
							            <option value="<?= $state->id ?>" <?= ($profile->state == $state->id)?"selected":'' ?> ><?= $state->name ?></option>
							            <?php }} ?>
							         </select>
							         <label class="form-control-placeholder2" for="Password">state</label>
								</div>
							</div>
							<div class="col-sm-4">
	    						<div class="form-group boot_sp">
	    							<select class="form-control box_in3" name="city" id="city">
	    							   	<option value="">Select City</option>
	    							   	<option value="<?=$profile->city?>" selected><?= $profile->city_name ?></option>
	    							    
	    							</select>
	    							<label class="form-control-placeholder2" for="dob">City<span class="text-danger">*</span></label>
	    						</div>
	    					</div>                 
							
							<div class="col-sm-12">
								<div class="form-group boot_sp">
									<textarea class="form-control box_in3" onkeyup="checkWord1('about',50)" id="about" name="about" style="height: 100px!important;"><?= $profile->about ?></textarea>
									<script type="text/javascript"> CKEDITOR.replace("about",{'height':150}); </script>
									<label class="form-control-placeholder2" for="pin">About Me short</label>
									<label id="about_err"></label>
									<p id="about_err_error" style="color:#f62ac1;font-weight:bold"></p>
									 
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group boot_sp">
								    
									<textarea class="form-control " rows="7" id="more_about" onkeyup="checkWord1('more_about',500)" name="more_about" style="height: auto"><?= $profile->more_about ?></textarea>
									<label class="form-control-placeholder2" for="ab">More About Me</label>
									<script type="text/javascript"> CKEDITOR.replace("more_about",{'height':150}); </script>
									<label id="more_about_err"></label>
									<p id="more_about_err_error" style="color:#f62ac1;font-weight:bold"></p>
								</div>
							</div>
						</div>
						<div class="row box_checkbox">
							<div class="col-sm-12 mt-2">
								<div class="form-group">
									<label><b>Area Of Expertise / Interests </b></label>
								</div>
							</div>
							<?php if(!empty($profile->expertise)) { $expertise = explode(',',$profile->expertise); } 
							      if(!empty($expertises)) { foreach($expertises as $expertiseList) {  if($expertiseList->name == 'Creating Lookbooks')  {continue;} ?>
		                        <div class="col-sm-6">
								<div class="form-check">
								  <input class="form-check-input checkarray" type="checkbox" name="expertise[]" value="<?= $expertiseList->id ?>"  <?php if(isset($expertise)) { if(in_array($expertiseList->id, $expertise)){ echo "checked"; } } ?> id="flexCheckDefault-<?= $expertiseList->id ?>">
								  <label class="form-check-label" for="flexCheckDefault-<?= $expertiseList->id ?>">
								   <?= $expertiseList->name ?></label>
								</div>
							</div>
		                    <?php }} ?>
		            <div id="expertise_err"></div>        	
						</div>
						<div class="row mb-4 mt-0 justify-content-center">
							<!--<div class="col-sm-12">-->
							<!--	<hr>-->
							<!--</div>-->
							<!--<div class="col-sm-6">-->
							<!--	  <div><label><b>Upload CV</b></label>-->
							<!--			Choose File...-->
							<!--			<input type="file" name="cv" accept=".xlsx,.xls,.doc, .docx,.pdf"  size="40">-->
								
							<!--		&nbsp;-->
							<!--		<span class="label label-info" id="upload-file-info"></span>-->
							<!--	</div>						-->
							<!--</div>-->
							<!--<div class="col-sm-6">-->
							<!--	<div class="cv">-->
							<!--	    <?php if(!empty($profile->cv)) { ?>-->
							<!--		<i class="fa fa-file-word-o" aria-hidden="true"></i> <?= $profile->cv; ?> <a href="<?= base_url('assets/images/cv/').$profile->cv ?>" class="btn btn-primary text-white text-dacoration-none" download>Download</a>-->
							<!--		<?php }?>-->
							<!--	</div>-->
							<!--</div>-->
							<div class="col-sm-12">
								<hr>
							</div>
							 

							<div class="col-sm-12 text-center mt-3">
								<input type="submit" value="UPDATE NOW" class="btc">
							</div>
						</div>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
        //alert('dfdsfdsfdsf');
    $('#state').on('change',function(){
      var state_id = $(this).val();
      if(state_id) {
          $.ajax({
                type:'POST',
                url:"<?= base_url('city-data')?>",
                data:'state_id='+state_id,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
      } else {
          $('#city').html('<option value="">Select state first</option>');
      } 
    });
}); 



$('#registration-form').on('submit',function(e){
        e.preventDefault();
         
        $('#expertise_err').html('');
         
        var searchIDs = $("input.checkarray:checkbox:checked").map(function(){
		      return $(this).val();
		    }).get(); 
	    	console.log(searchIDs.length);
				/*	var image = document.getElementById('image'); 
				var width = image.clientWidth;
				var height = image.clientHeight;
				console.log(searchIDs.length);*/
	 

				/*var img=$("#image")[0].files[0].size;
				var imgsize=img/1024; 
				console.log(imgsize);
				console.log(img);*/


        if(!searchIDs.length){
					$('#expertise_err').html('<span class="text-green">Please checked expertise</span>') 
					return false; 
				}else if(searchIDs.length>3){
					$('#expertise_err').html('<span class="text-green">Please checked expertise less than 4</span>') 
					return false; 
				}else{
					$('#registration-form').get(0).submit();
					return true;
				}
    });   
</script>

</body>
</html>
<style type="text/css">
	.text-green{
		font-weight: bold;
		color: green!important;
	}
</style>
<?php $this->load->view('front/vandor/footer'); ?>





<style>
	.main1 {
    position: relative;
    margin: 7% auto 18px;
    display: flex;
}

	#slider {
    -webkit-appearance: none;
    width: 100%;
    height: 33px;
    border-radius: 10px;
    background: #ccc;
    position: absolute;
    bottom: -6px;
}
/* Design slider button */
#slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 48px;
  height: 48px;
  cursor: pointer;
  position: relative;
  z-index: 3;
}

#selector {
    height: 92px;
    width: 40px;
    position: absolute;
    bottom: -12px;
    transform: translateX(-50%);
    z-index: 2;
}
.selectBtn:before {
    content: "\f102";
    font-family: 'FontAwesome';
    font-size: 25px;
}
.selectBtn {
    height: 40px;
    width: 40px;
    background: #f62ac1;
    background-size: cover;
    background-position: center;
    border-radius: 50%;
    position: absolute;
    bottom: 4px;
    text-align: center;
    line-height: 40px;
}
#selectValue {
  width: 40px;
  height: 34px;
  position: absolute;
  top: 0;
  background: #f62ac1;
  border-radius: 4px;
  text-align: center;
  line-height: 45px;
  font-size: 16px;
  font-weight: bold;
  color: #FFF;
}
#selectValue::after {
  content: '';
  border-top: 17px solid #f62ac1;
  border-left: 20px solid #fff;
  border-right: 20px solid #fff;
  position: absolute;
  bottom: -14px;
  left: 0;
}
#progressBar {
  /*width: 50%;*/
  height: 33px;
  background: #742ea0;
  border-radius: 10px;
  position: absolute;
  bottom: -6px;
  left: 0;
  -webkit-animation: cssProgressActive 2s linear infinite;
  animation: cssProgressActive 2s linear infinite;
  background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.125) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.125) 50%, rgba(255, 255, 255, 0.125) 75%, transparent 75%, transparent);
    background-size: 35px 35px;
}

.psize{font-weight: bold; font-size: 18px; text-align: left;}

.cssProgress .cssProgress-stripes,
.cssProgress .cssProgress-active,
.cssProgress .cssProgress-active-right {
  background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.125) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.125) 50%, rgba(255, 255, 255, 0.125) 75%, transparent 75%, transparent);
  background-size: 35px 35px;
}
.cssProgress .cssProgress-active {
  -webkit-animation: cssProgressActive 2s linear infinite;
  animation: cssProgressActive 2s linear infinite;
}
.cssProgress .cssProgress-active-right {
  -webkit-animation: cssProgressActiveRight 2s linear infinite;
  animation: cssProgressActiveRight 2s linear infinite;
}
@-webkit-keyframes cssProgressActive {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 35px 35px;
  }
}
@keyframes cssProgressActive {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 35px 35px;
  }
}
@-webkit-keyframes cssProgressActiveRight {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -35px -35px;
  }
}
@keyframes cssProgressActiveRight {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -35px -35px;
  }
}




</style>


<script type="text/javascript">
	
	let slider = document.getElementById('slider')
	let selector = document.getElementById('selector')
	let selectValue = document.getElementById('selectValue')
	let progressBar = document.getElementById('progressBar')

	selectValue.innerHTML = slider.value + '%'

	slider.oninput = function() {
	  selectValue.innerHTML = this.value + '%'
	  selector.style.left = this.value + '%'
	  progressBar.style.width = this.value + '%'
	}



/*
$("#short_area").on('keyup', function() {
    var words = 0;
    if ((this.value.match(/\S+/g)) != null) {
        words = this.value.match(/\S+/g).length;
    }
    if (words > 50) {
        var trimmed = $(this).val().split(/\s+/, 50).join(" ");
        $(this).val(trimmed + " ");
    }else {
        $('#short_message').text(words +" words out of 500 are complete. Complete your profile to start applying for the available jobs." + );
        $('#short_left').text(50-words);
    }
});*/

function checkWord1(id,max_limit){
        var content = $("#"+id).val(); 
        var words = content.split(/\s+/); 
        var num_words = words.length;  
        console.log(num_words);
         
        if(num_words > max_limit){
            /*var lastIndex = content.lastIndexOf(" ");
            $("#"+id).val(content.substring(0, lastIndex));*/
            $('#'+id+'_err').text("Total "+ (num_words) +" words");
            $('#'+id+'_err_error').text( "" );
        }
        else{
            $('#'+id+'_err').text( (num_words ) +" words out of " + max_limit + " are complete." );
            $('#'+id+'_err_error').text( "Complete your profile to start applying for the available jobs." );
        }
        
    }
</script>