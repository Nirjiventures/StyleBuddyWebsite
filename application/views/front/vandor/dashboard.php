<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		 
		 
		<div class="col-sm-12">
			<div class="rightbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h4>Hello <b><?= $profile->fname.' '.$profile->lname ?></b>, What would you like to do today?</h4>
						</div>
						<?php //$url =  base_url('stylists/').base64_encode($profile->id).'/'.strtolower($profile->fname.'-'.$profile->lname.'-'.str_replace(' ', '-', $profile->area_expertiseRow->name).'-in-'.$profile->city_name) ?>
						<?php $url =  base_url('stylists/').base64_encode($profile->id).'/'.strtolower($profile->fname.'-'.$profile->lname) ?>
		                    	

						<div class="col-sm-3 text-end p-0">
							<a target="_blank"  href="<?=$url?>" class="btn  add_pro">My Portfolio  </a> 
							<a target="_blank"  href="<?php echo base_url(); ?>page/browsejobs" class="btn  add_pro">Browse Jobs  </a>
						</div>
					</div>
					<hr/>
					<div class="row mbl d-flex justify-content-center">
						<div class="col-sm-5 mt-3">
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
				 
					<?php if($this->session->flashdata('success')) {  ?>
						<div class="logo_p text-center mb-2 mt-2 p-2" style="background: #ccc;"><?= $this->session->flashdata('success'); ?></div>
					<?php } ?>
					<?php if($this->session->flashdata('error')) {  ?>
						<div class="logo_p text-center mb-2 mt-2 p-2" style="background: #ccc;"><?= $this->session->flashdata('error'); ?></div>
					<?php } ?>
					
				

						
				 

					<div class="row align-items-center justify-content-center">


							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/videopage')?>" style="text-decoration: none;"><b>My Videos</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="<?=base_url('vendor/videopage')?>" class="animate"></a></p></div>
								</div>
							</div>

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/manage-portfolio')?>" style="text-decoration: none;"><b>My Projects</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>
							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/fashionboard')?>" style="text-decoration: none;"><b>Manage my Fashion Board</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/managemyorders')?>" style="text-decoration: none;"><b>My Order Book</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>
							
							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/serviceorder')?>" style="text-decoration: none;"><b>Service Orders</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>
							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/myserviceorder')?>" style="text-decoration: none;"><b>My Service Orders</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>
							
							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/consultorder')?>" style="text-decoration: none;"><b>Consultation order</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>  -->

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/manage-products')?>" style="text-decoration: none;"><b>Manage Shop</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/my-dashboard')?>" style="text-decoration: none;"><b>Dashboard </b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="<?=base_url('stylist-zone/my-dashboard')?>" class="animate"></a></p></div>
								</div>
							</div>

							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/available-dates')?>" style="text-decoration: none;"><b>Manage my Calendar</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/add-style-stories')?>" style="text-decoration: none;"><b>Write a Blog</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/manage-profile')?>" style="text-decoration: none;"><b>Update Profile</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>

							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('stylist-zone/leads')?>" style="text-decoration: none;"><b>Leads</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/addaservices')?>" style="text-decoration: none;"><b>Services</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/addownservice')?>" style="text-decoration: none;"><b>Add New Service</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->

							<div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/boutiques')?>" style="text-decoration: none;"><b>Boutiques</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div>
							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a target="_blank" href="<?=base_url('vendor/sendproposal')?>" style="text-decoration: none;"><b>Send Proposal</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->
							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a target="_blank" href="<?=base_url('vendor/stylingreport')?>" style="text-decoration: none;"><b>My Styling Reports </b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->

							<!-- <div class="col-sm-2 col-6 col-half-offset p-0">
								<div class="week_box">
									<a href="<?=base_url('vendor/managejobs')?>" style="text-decoration: none;"><b>Manage Jobs</b></a>
									<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate"></a></p></div>
								</div>
							</div> -->

	 
							


						</div>
					</div>
					<?php if($this->session->userdata('adminEmail')){ ?>
						<?php echo form_open_multipart('',['id'=>'catfrmm']);?>
						<div class="row mt-5" style="    border: 2px solid;display: none;">
							<div class="form-group row">
							   <div class="col-md-12 mt-4 mb-2">
							         <h4><b>SEO Section(Admin use only)</b></h4>
							   </div>
							   <hr/>
							</div>
							
							<div class="form-group row">
							   <div class="col-md-12">
							         <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
							         <textarea id="meta_title" name="meta_title" rows="2" class="form-control"><?= $profile->meta_title ?></textarea>
							   </div>
							</div>
							<div class="form-group row">
							   <div class="col-md-12  ">
							         <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
							         <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"><?= $profile->meta_keyword ?></textarea>
							   </div>
							</div>
							<div class="form-group row">
							      <div class="col-sm-12  ">
							           <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
							            <textarea id="meta_description" name="meta_description" rows="2" class="form-control"><?= $profile->meta_description ?></textarea>
							             
							      </div>
							</div>

							<div class="form-group row">
								<div class="col-sm-12 ">
							   		<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
								</div>
							</div>
						</div>
						<?php echo form_close();?>
					<?php }?>
				</div>
			</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>



<style>

	.col-half-offset{
		    margin-left:2.166666667%
	  }


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

.psize{font-weight: bold; font-size: 16px; text-align: left;}

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

</script>



<script type="text/javascript">
	/*$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})*/
</script>
</body>
</html>
