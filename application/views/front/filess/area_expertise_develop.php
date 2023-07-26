<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
<?php $url4 = $this->uri->segment(4);?>
<?php  $this->load->view('Page/template/header'); ?>

<style type="text/css">
	.f-fliter{
		background: #333;
		padding:8px 10px;
		margin-top: 30px;
		border-radius: 0px;
		text-transform: uppercase;
		border: 2px solid #ccc;
		border-left: none;
		border-right: none;
		font-size:13px;
	}
	.nice-select-dropdown ul li{
		width: auto;
		display: block;
		color: #000;
	}
	.f-fliter span{
		color: #fff;
		margin-right: 14px;
   		margin-top: 8px;
	}
	.f-fliter a {
    color: #f62ac1;
    margin-top: 7px;
    display: block;
    font-size: 13.5px;
}	
.space{
	border-top: 1px solid #454545;
    margin-top: 10px;
    margin-left: 0px;
    margin-right:0px;
}
.f-fliter select{
	height: 33px;
    padding-left: 4px;
    width: 100%;
    text-transform: uppercase;
    background: #5d5d5d;
    border-radius: 0px;
    border: 1px solid #333;
    color: #fff;
}
.f-fliter .collapse{
	color: #fff;
    position: relative;
}
:focus-visible {
    outline: -webkit-focus-ring-color auto 0px;
}
.nform-check{
	background: #5d5d5d;
    border-radius: 0px;
    /* padding: 9px; */
    height: 33px;
    /* line-height: 23px; */
    padding-top: 6px;
    padding-left: 33px;
    color: #fff;
    font-size: 13px;
}
.col-xs-5-cols,
    .col-sm-5-cols,
    .col-md-5-cols,
    .col-lg-5-cols {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
    }

    .col-xs-5-cols {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    @media (min-width: 768px) {
        .col-sm-5-cols {
            -ms-flex: 0 0 20%;
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    @media (min-width: 992px) {
        .col-md-5-cols {
            -ms-flex: 0 0 20%;
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    @media (min-width: 1200px) {
        .col-lg-5-cols {
            -ms-flex: 0 0 20%;
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    .cate_block img {
	    width: 100%;
	    height: 200px;
	    object-fit: cover;
	    border-radius: 0px;
	    border-bottom-left-radius: 0px;
	    border-bottom-right-radius: 0px;
	}
	.new_s p {
    font-size: 16px;
    padding: 0px 10px;
    color: #000;
    /* text-transform: uppercase; */
    font-weight: bold;
    line-height: 24px;
    padding-bottom: 5px;
    text-align: center;
}
.cate_block {
    /* background: var(--bg-light-skin); */
    /* text-align: center; */
    /* padding: 5px; */
    border-radius: 0px;
    box-shadow: 0px 0px 10px 4px rgb(0 0 0 / 28%);
    margin-bottom: 24px;
    border: 1px solid #f0f0f5;
    box-shadow: 0 4px 8px rgb(0 0 0 / 12%);
    /* border-radius: 24px; */
    box-shadow: 0 2px 20px rgb(0 0 0 / 20%);
    margin-bottom: 40px;
    position: relative;
}
.cate_block:hover img {
    transform: scale(1.1);
}

.cate_block:after {
    content: '';
    position: absolute;
    width: 15%;
    height: 2px;
    background: #f62ac1;
    left: 40%;
    transition: all 0.5s;
}
.cate_block:hover:after {
    right: 0;
    width: 100%;
    left: 0;
}
</style>
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
