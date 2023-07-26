<?php $this->load->view('front/boutiques/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		
		<div class="col-sm-12">
			<?php //$this->profileId = 10;?>
			<div class="rightbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-10">
							<h3>Hello <b><?= $profile->fname.' '.$profile->lname ?></b>, What would you like to do today?</h3>
						</div>
						<?php $url =  base_url('stylists/').base64_encode($profile->id).'/'.strtolower($profile->fname.'-'.$profile->lname.'-'.str_replace(' ', '-', $profile->area_expertiseRow->name).'-in-'.$profile->city_name) ?>
		                <div class="col-sm-2 text-end"><a target="_blank"  href="<?=base_url()?>" class="btn  add_pro">View Site  </a></div>

					</div>
				</div>
				<hr>
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-sm-3">
							<div class="week_box">
								<a href="<?=base_url('boutiques/managemyorders')?>" style="text-decoration: none;"><b>Manage Orders</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate">More</a></p></div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="week_box">
								<a href="<?=base_url('boutiques/manageProducts')?>" style="text-decoration: none;"><b>Manage Shop</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate">More</a></p></div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="week_box">
								<a href="<?=base_url('boutiques/mydashboard')?>" style="text-decoration: none;"><b>Dashboard</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="<?=base_url('stylist-zone/my-dashboard')?>" class="animate">More</a></p></div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="week_box">
								<a href="<?=base_url('boutiques/profile')?>" style="text-decoration: none;"><b>Update Profile</b></a>
								<div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate">More</a></p></div>
							</div>
						</div>

						<!--<div class="col-sm-3">
							<div class="week_box">
							    <a href="<?= base_url('boutiques/consultationorder') ?>" style="text-decoration: none;"> <b>Consultation order</b></a>
							    <div class="check_arrow"><p class="scroll-down"><a href="#complements" class="animate">More</a></p></div>
							</div>
						</div>-->
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

<script type="text/javascript">
	/*$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})*/



</script>
</body>
</html>
