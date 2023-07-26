<?php $this->load->view('Page/template/header'); 
$imgArray =  explode(',',$ideas->image);
$multi_img = explode(',',$ideas->multi_image);
//print_r($multi_img);
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style>
 .idea-img{width:100%; height:500px; object-fit: cover;}
 .pr_view img{ height: 110px; object-fit: cover; }
    
    

</style>
<div class="middle_part mt-5 pt-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
			    <div class="show" href="<?= base_url('assets/images/story/').$imgArray[0] ?>">
				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$imgArray[0] ?>" id="show-img" class="img-thumbnail idea-img">
				</div>
				    <div class="small-img">
				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/online_icon_right@2x.png" class="icon-left" alt="" id="prev-img">
				    <div class="small-container">
				      <div id="small-img-roll">
				         
				         <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$imgArray[0] ?>" class="show-small-img">
				        <?php  for($i = 0;  $i<count($multi_img); $i++ ) {  ?>
				        <?php if(!empty($multi_img[$i])) { ?>
				        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$multi_img[$i] ?>" class="show-small-img">
				        <?php } ?>
				        <?php } ?>
				      </div>
				    </div>
				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/online_icon_right@2x.png" class="icon-right" alt="" id="next-img">
				  </div>
			</div>
			<div class="col-sm-8 pr_detail">
				<h4><?= $ideas->title ?></h4>
				<div class="d-flex pr_view align-items-center">
				    <div class="flex-shrink-0">
				       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/vandor/images/').$vender->image ?> " class="mr-3 rounded-circle img-thumbnail" width="110px">
				    </div>
				    <div class="flex-grow-1 ms-3">
				        <div class="name_title"><?= $vender->fname.' '.$vender->lname ?></div>
				        <p class="mb-0"><small><?= $vender->designation ?></small></p>
						    <p class="mb-0"><small>Experience: <?=$vender->experience?> Years</small></p>
						    <p class="mb-0"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>
								<p class="mb-0"><small>Total Review: <?=$vender->feedbackCount?></small></p>


				        <?php if(!empty($city->city)) { ?>
				            <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $city->city ?></small></p>
				        <?php } ?>
				        <!--<a href="<?= base_url('ask-for-quote') ?>" class="v_quote"> Ask For Quote</a>-->
				    </div>
				</div>
				<hr>
				<p><?= $ideas->content ?></p>
				<div class="hashtag">
					<?php  $value = ''; if($ideas->tag_id) { $array = explode(',',$ideas->tag_id); } 
				        foreach($idea_tag as $tag)  {    
					    if(isset($array)) { if(in_array($tag->id, $array)) { $value .=  " #$tag->tag"; } } 
					 } 	?>
					<a href=""><?= substr($value,1); ?></a>
				</div>
				<hr>
			</div>
		</div>

		<!--<div class="row mt-5">-->
		<!--	<div class="col-sm-12 dv_tabs">-->
  <!--  			<ul class="nav nav-tabs" role="tablist">-->
		<!--		    <li class="nav-item text-left">-->
		<!--		      <a class="nav-link active" data-bs-toggle="tab" href="#">Similar Styles</a>-->
		<!--		    </li>-->
		<!--		  </ul>-->
		<!--		  <div class="tab-content">-->
		<!--		    <div id="home" class="tab-pane active">-->
		<!--		    	<div class="row">-->
		<!--		    		<div class="col-sm-3">-->
		<!--		    			<div class="i_box">-->
		<!--		    				<div class="f_btn">Follow Us : <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a> </div>-->
		<!--		    				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/new/t3.jpg" class="img-fluid">-->
		<!--		    				<h4><a href="">The boss lady edit</a></h4>-->
		<!--		    				<div class="hashtag">-->
		<!--								<a href="">#rectangle</a>, -->
		<!--								<a href="">#pear</a>, -->
		<!--								<a href="">#hourglass</a>, -->
		<!--								<a href="">#edgy</a>, -->
		<!--								<a href="">#occasion</a> -->
		<!--							</div>-->
		<!--							<div class="i_box-footer ">-->
		<!--								<a href="" class="float-start"><i class="fa fa-heart-o" aria-hidden="true"></i> 0</a> <a href="" class="float-end"><i class="fa fa-eye" aria-hidden="true"></i> 138</a>-->
		<!--							</div>-->
		<!--		    			</div>-->
		<!--		    		</div>-->

		<!--		    		<div class="col-sm-3">-->
		<!--		    			<div class="i_box">-->
		<!--		    				<div class="f_btn">Follow Us : <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a> </div>-->
		<!--		    				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/new/t4.jpg" class="img-fluid">-->
		<!--		    				<h4><a href="">The boss lady edit</a></h4>-->
		<!--		    				<div class="hashtag">-->
		<!--								<a href="">#rectangle</a>, -->
		<!--								<a href="">#pear</a>, -->
		<!--								<a href="">#hourglass</a>, -->
		<!--								<a href="">#edgy</a>, -->
		<!--								<a href="">#occasion</a> -->
		<!--							</div>-->
		<!--							<div class="i_box-footer ">-->
		<!--								<a href="" class="float-start"><i class="fa fa-heart-o" aria-hidden="true"></i> 0</a> <a href="" class="float-end"><i class="fa fa-eye" aria-hidden="true"></i> 138</a>-->
		<!--							</div>-->
		<!--		    			</div>-->
		<!--		    		</div>-->

		<!--		    		<div class="col-sm-3">-->
		<!--		    			<div class="i_box">-->
		<!--		    				<div class="f_btn">Follow Us : <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a> </div>-->
		<!--		    				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/new/t5.jpg" class="img-fluid">-->
		<!--		    				<h4><a href="">The boss lady edit</a></h4>-->
		<!--		    				<div class="hashtag">-->
		<!--								<a href="">#rectangle</a>, -->
		<!--								<a href="">#pear</a>, -->
		<!--								<a href="">#hourglass</a>, -->
		<!--								<a href="">#edgy</a>, -->
		<!--								<a href="">#occasion</a> -->
		<!--							</div>-->
		<!--							<div class="i_box-footer ">-->
		<!--								<a href="" class="float-start"><i class="fa fa-heart-o" aria-hidden="true"></i> 0</a> <a href="" class="float-end"><i class="fa fa-eye" aria-hidden="true"></i> 138</a>-->
		<!--							</div>-->
		<!--		    			</div>-->
		<!--		    		</div>-->
		<!--		    		<div class="col-sm-3">-->
		<!--		    			<div class="i_box">-->
		<!--		    				<div class="f_btn">Follow Us : <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a> </div>-->
		<!--		    				<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="assets/images/new/t6.jpeg" class="img-fluid">-->
		<!--		    				<h4><a href="">The boss lady edit</a></h4>-->
		<!--		    				<div class="hashtag">-->
		<!--								<a href="">#rectangle</a>, -->
		<!--								<a href="">#pear</a>, -->
		<!--								<a href="">#hourglass</a>, -->
		<!--								<a href="">#edgy</a>, -->
		<!--								<a href="">#occasion</a> -->
		<!--							</div>-->
		<!--							<div class="i_box-footer ">-->
		<!--								<a href="" class="float-start"><i class="fa fa-heart-o" aria-hidden="true"></i> 0</a> <a href="" class="float-end"><i class="fa fa-eye" aria-hidden="true"></i> 138</a>-->
		<!--							</div>-->
		<!--		    			</div>-->
		<!--		    		</div>-->
		<!--		    	</div>-->
		<!--		    </div>-->
		<!--		</div>-->
  <!--  		</div>-->
		<!--</div>-->
    </div>
</div>

<?php $this->load->view('Page/template/footer'); ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
  <script src="assets/js/zoom-image.js"></script>
  <script src="assets/js/main.js"></script>