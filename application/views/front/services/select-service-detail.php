<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<?php  $this->load->view('Page/template/header'); ?>

 
<div class="what_would color_1">
	<div class="text-center">
		<h2>What would you like to do today?</h2>
	</div>
	<div class="f-fliter">
		<div class="container_full_2">
	<div class="row">
			<div class="col-sm-12">
				
					<div class="row justify-content-center">
					<div class="col-sm-2">
						<div class="form-check nform-check">
					      <input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
					      <label class="form-check-label" for="check2">Video Consult</label>
					    </div>
					</div>
					<div class="col-sm-2">
						<select class="wide selectize">
				        <option data-display="Select">Availability</option>
				        <option value="1">Available Today</option>
				        <option value="2">Available Tomorrow</option>
				        <option value="3">Available in next 7 days</option>
				      </select>
					</div>
					<div class="col-sm-2">
						<a href="" data-bs-toggle="collapse" data-bs-target="#demo">All Filters <small><i class="fa fa-plus" aria-hidden="true"></i></small></a>
					</div>
					<div class="col-sm-3 d-flex">
						<span class="d-inline-block">Sort by</span>
						<div class="d-inline-block">
							<select class="wide selectize ">
					        <option data-display="Select">Nothing</option>
					        <option value="1">Some option</option>
					        <option value="2">Another option</option>
					      </select>
						</div>
					</div>
					<div class="col-sm-12">
						<div id="demo" class="collapse">
    						<div class="row p-3 space justify-content-center">
							      	<div class="col-sm-3">
							      		<div class="form-check">
										  <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Option 1
										  <label class="form-check-label" for="radio1"></label>
										</div>
										<div class="form-check">
										  <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Option 2
										  <label class="form-check-label" for="radio2"></label>
										</div>
							      	</div>
							      	<div class="col-sm-3">
							      		<div class="form-check">
									      <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
									      <label class="form-check-label" for="check1">Option 1</label>
									    </div>
									    <div class="form-check">
									      <input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
									      <label class="form-check-label" for="check2">Option 2</label>
									    </div>
							      	</div>
							      </div>
  								</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container_full_2">
		<div class="row pt-5 justify-content-center">
			<?php if(!empty($expertises)) { $i=0;?>
		        <?php   foreach($expertises as $list) {  ?>
        			<div class="col-6 col-sm-3">
						<div class="cate_block new_s">
							<?php 
								if ($list->slug == 'designer-dresses') {
									$url =  base_url('shop');
								}else{
									$url =  base_url($url1.'/'.$list->slug);
								}
							?>
							<a href="<?= $url ?>">
								<div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div>
									<p><?= $list->title_develop ?></p>
									
								<?php   if($i%2==0) {  ?>
									<!-- <div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div>
									<p><?= $list->title ?></p> -->
					        	<?php 	}else{ ?>
					        		<!-- <p><?= $list->title ?></p>
					        		<div class="cat_photo">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$list->image) ?>" class="img-fluid">
									</div> -->
								<?php 	} ?>
							</a>
						</div>
					</div>
	            <?php  $i++;} ?>
	        <?php } ?>
		</div>
	</div>
</div>
<?php $this->load->view('Page/template/footer'); ?>
