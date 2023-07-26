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

    .rating-md .caption {

        font-size: 14px;

    }

    .portfolio_total {

        position: relative;

        z-index: 9;

        top: 0px;

        left: 0px;

        background:none;

        font-size: 12px!important;

        padding: 2px 0px;

        border-radius: 4px;

        color: var(--black)!important;

        margin-top: 5px!important;

        margin-bottom: 0px!important;

    }

    .designer_list_1 {padding: 15px;

        box-shadow: 0 2px 20px rgb(0 0 0 / 20%);

        margin-bottom: 30px;}

    .designer_list_1{

        position: relative;

        text-decoration: none;

        background: #ffffff;

        border: 2px solid #ffffff;

        transition: ease-out 0.5s;

        -webkit-transition: ease-out 0.5s;

        -moz-transition: ease-out 0.5s;

    }

    .designer_list_1::after,

    .designer_list_1::before {

        position: absolute;

        content: "";

        width: 0%;

        height: 0%;

        visibility: hidden;

    }

    .designer_list_1::after {

        bottom: -2px;

        right: -2px;

        border-left: 2px solid #f62ac1;

        border-bottom: 2px solid #f62ac1;

        transition: width .1s ease .1s, height .1s ease, visibility 0s .2s;

    }

    .designer_list_1::before {

        top: -2px;

        left: -2px;

        border-top: 2px solid #f62ac1;

        border-right: 2px solid #f62ac1;

        transition: width .1s ease .3s, height .1s ease .2s, visibility 0s .4s;

    }

    .designer_list_1:hover {

        animation: pulse 1s ease-out .4s;

        color: #222222;

    }

    .designer_list_1:hover::after,

    .designer_list_1:hover::before {

        width: calc(100% + 4px);

        height: calc(100% + 3px);

        visibility: visible;

        transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;

    }

    .designer_list_1:hover::after {

        transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;

    }

    .designer_list_1:hover::before {

        transition: width .1s ease, height .1s ease .1s;

    }

    .ratingss{

    	color: #000;

    }

    a.absc{

    	position: static;

    	z-index: 1;

    }

    button.v_quote{

    	margin-top: 15px;

        background: #742ea0;

        color: #fff;

        border-radius: 14px;

        padding: 2px 9px;

        position: relative;

        z-index: 9;

        border: 2px solid #742ea0;

    }

    a.absc:hover button.v_quote{

    	position: relative;

    	z-index: 9;

    }

    .d-mb{

    	display:none;

    }

    @media screen and (min-device-width: 200px) and (max-device-width: 767px){

    .ratingss{

    	margin-bottom: 12px;

    }

    .book_now_b a {

        width: 100%!important;

        margin: auto;

    }

    .f-fliter a {

        color: #f62ac1;

        margin-top: 7px;

        display: block;

        font-size: 14px;

            margin-top: 12px;

        margin-bottom: 5px;

    }

    .f-fliter span {

        color: #fff;

        margin-right: 14px;

        margin-top: 9px;

        font-size: 12px;

    }

    .book_now_b {

        margin-top: 10px;

    }

    button.v_quote {

        margin-top: 4px;

    }

    .d-dk{

    	display: none;

    }

    .d-mb{

    	display: block;

    }

    .space {

        padding-left: 0px!important;

        padding-right: 0px!important;

    }

    .f-fliter {

        padding-top: 15px;

    }

}


@media (max-width: 1400px){

.services_thum p {font-size: 12px!important;}

}

.services_thum a{color: #000;}

.services_thum img {
    width: 80px;
    height: 80px;
    border-radius: 100px;
    object-fit: cover;
    border: 2px solid #333;
    padding: 5px;
    object-position: top;
    display: inline;
}

.services_thum .slick-slide {
    margin: 0 5px;
}

.services_thum {
    padding-bottom: 10px;
    text-align: center;
    width: 80%;
    margin: 40px auto;
}
.services_thum p {
    line-height: 16px;
    padding-top: 7px;
    width: 100%;
    text-align: center;
    word-break: break-word;
}

.seo_content_data{margin: 50px 0px;}

.color_box1 {
    
    padding: 20px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.color_box1 ul li {
    color: #FFF;
    margin: 15px 0px;
    text-align: left;
    line-height: 16px;
}

.color_box1 ul {
}


.color_bg1{background: #f623be;}
.color_bg2{background: #7400ca;}

.services_thum button img {
    width: 30px;
    height: 30px;
}
.what_would_1{
	padding: 50px 0px;
}

a.actp p {
    color: #f62ac1;
}

a.actp img {
    border: 2px solid #f62ac1;
}
.ser_logo{
	display: flex;
}
.ser_logo .service_wala{
	margin: 10px;
	width: 12%;
}
@media(max-width: 768px){
	.ser_logo {
    display: -webkit-inline-box;
    overflow: scroll;
}
.ser_logo .service_wala{
	margin: 10px;
	width: auto;
}
}
</style>

<div class="what_would_1 wedding color_2">

	<div class="text-center container_full_2">

		<div class="row m-0 justify-content-center">

			<div class="col-sm-8">

				<h2><?php echo $expertises->sub_title;?></h2>
                <?php 
					$this->breadcrumb = new Breadcrumbcomponent();
					$this->breadcrumb->add('Home', '/');
					$this->breadcrumb->add('Services', '/select-service');
				?>
				<?php if(!empty($expertises_list)) { $i=0;?>
			        <?php   foreach($expertises_list as $list) {  ?>
	        					<?php 
									if ($list->slug == $url2) {
										$this->breadcrumb->add($list->title_develop, $url2);
									}
								?>
					<?php  $i++;} ?>
		        <?php } ?>
        		<?php echo $this->breadcrumb->output(); ?>
			</div>

		</div>

	</div>

	 


		<div class="services_thum" >
			
				<div class="ser_logo" id="myDIV">

				<?php if(!empty($expertises_list)) { $i=0;?>
			        <?php   foreach($expertises_list as $list) {  ?>
	        			
							<div class="service_wala">
								<?php 
									if ($list->slug == 'designer-dresses') {
										$url =  base_url('shop');
									}else{
										$url =  base_url($url1.'/'.$list->slug);
									}
								?>
								<?php 
									if ($list->slug == $url2) {
										$actp =  'actp';
									}else{
										$actp =  '';
									}
								?>
								
									<a href="<?= $url ?>" class="<?= $actp ?>">
										<div class="cat_photo_1">
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
						
		            <?php  $i++;} ?>
		        <?php } ?>
			</div>
		
		</div>




	<div class="f-fliter" style="display:none">

		<div class="container_full_2">

			<?= form_open(base_url($url1.'/'.$url2.'/'),['id'=>'FormStylist','name'=>'FormStylist','method'=>'get']) ?>

				<div class="row m-0 justify-content-center">

				  

					<div class="col-sm-2 col-6">

	                	<select class="wide selectize" id="expert_by_city" name="expert_by_city" onchange="locationBy(this.value)">

	                        <option value="">Location</option>

	                        <?php foreach ($cities as $key => $value) { if($_GET['expert_by_city'] && $_GET['expert_by_city']== html_entity_decode(base64_encode($value['id']))){$sel='selected';}else{$sel='';}?>

	                            <option value="<?=html_entity_decode(base64_encode($value['id']))?>" <?=$sel?>><?=$value['city']?></option>

	                        <?php } ?>

	    			    </select>

	                </div>

					

					<div class="col-sm-2 col-6">

						<select class="wide selectize"  id="experience" name="experience" onchange="experienceBy()">

							<option  value="">Select Experience</option>

							<?php $aaa = array('1-3'=>'1 To 3 Years','3-5'=>'3 To 5 Years','5-above'=>'5+ Years');?>

							<?php  foreach ($aaa as $key => $value) { ?>

								<?php if($_GET['experience'] && $_GET['experience']== $key){$sel='selected';}else{$sel='';}?>

								<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

							<?php } ?>

						</select>

					</div> 

				</div>

			<?= form_close() ?>  	

		</div>

	</div>


	



	<div class="container_full_2">



		 



		<div class="stylish_list">



			<div class="row m-0 justify-content-center">

		        <?php  	$location = array(); $newlocation = ''; ?>

		        <?php 	foreach($states as $state) { $location[] = $state->id; }?>

		        <?php 	if(!empty($venders)) {?>

		        	<?php  	foreach($venders as $vender) { ?>

		                    <div class="col-12 col-sm-6">

		                    	<?php $review = $vender->review;?>

		                    	<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-',$vender->city_name)) ?>
		                    	<?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>

		                    		<a href="<?= $url ?>" class="absc">

					      			<div class="designer_list_1">

					      				<span>

					      					

							      			<div class="row">

					                    		<div class="col-sm-3 col-5">

					                    			<div class="pro_part">

						                    			<?php  if (file_exists($image_path = FCPATH . 'assets/vandor/images/' . $vender->image)) { ?>
														    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/vandor/images/'.$vender->image) ?>"  class="img-fluid">
														<?php  } else { ?>
														    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
														<?php  } ?>
														
														

															<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?><?= ($vender->image)?"assets/vandor/images/$vender->image":"assets/images/stylist/no-image.jpg" ?>" class="img-fluid"> -->

														

													</div>

												</div>

					                    		<div class="col-sm-9 col-7">

					                    			<div class="all_data">

														<h4><span><?= ucwords($vender->fname.' '.$vender->lname) ?></span></h4>

														<div class="row">

															<div class="col-sm-6">

																 

																	<p class="mt-0"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>



																	<p style="display: none;"><?= $vender->designation ?></p>



																	<div class="hidden_star_pointer ratingss">



																		<input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Reviews <?=$vender->feedbackCount?>) 



																	</div>

																 

															</div>

															<div class="col-sm-6">

																

																	<?php if(isset($vender->city_name) && (!empty($vender->city_name)) ) {  ?>

												        			<p><small><i class='fa fa-map-marker' aria-hidden="true"></i> <?= $vender->city_name ?></small></p>

												        			<?php } ?>



																	<p class="portfolio_total"><i class="fa fa-eye"></i> <?=$vender->count_view;?> Views</p>

																

																<div class="book_now_b">

																	<?php if($this->session->userdata('loginUser')){ ?>

																		<button class="v_quote" onclick="redire('<?= base_url('ask-for-quote/uOiEa'.base64_encode($vender->id) ) ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

															        	 



															        <?php }else{ ?>	

															        	<button class="v_quote" onclick="redire('<?= base_url('login') ?>')">View Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>

															        	 



															        <?php } ?>

															    </div>

															</div>

														</div>

													</div>

					                    		</div>

				                    		</div>

				                    		

										</span>

									</div>

								</a> 

							</div>

			  		<?php } ?>



				<?php }else{ ?>



					<h1 class="text-center"><b>We are coming soon to your area. STAY TUNED! </b><br/><br/></h1>



					<br/>



					<hr/>



				<?php } ?>



			   



	      	</div>



			 



		</div>



		<div class="row m-0">



			<div class="col-sm-12">



		   		<div class="pagging-stylist ">



		   			<ul class="pagination justify-content-center ">



				   		<?php echo $p_links; ?>



				   	</ul>



		   		</div>



		   </div>



	   </div>







	 
	</div>
	
 
    <?php if($description_city->description){?>
        <div class="seo_content">
        	   <div class="bottom_description container">
    		        <?php echo $description_city->description;?>
    		   </div>
        </div>
    <?php }else if($expertises->description){?>
        <div class="seo_content">
        	   <div class="bottom_description container">
    		   <?php echo $expertises->description;?>
    		   <?php 
    		   if($url2 == 'styling-for-photo-shoots'){  
    		   		$readMore = 'photo-shoot-solutions';  
    		   }else if($url2 == 'corporate-style'){  
    		   		$readMore = 'corporate-styling-solutions';  
    		   }else if($url2 == 'styling-for-weddings'){  
    		   		$readMore = 'wedding-styling-solutions';  
    		   }else if($url2 == 'personal-shopper'){ 
    		   		$readMore = 'personal-shopper-solutions';  
    		   }else if($url2 == 'wardrobe-consulting'){  
    		   		$readMore = 'wardrobe-consulting-solutions';  
    		   }else if($url2 == 'image-makeover'){  
    		   		$readMore = 'image-makeover-solutions';  
    		   }else if($url2 == 'personal-styling'){  
    		   		$readMore = 'personal-styling-solutions';  
    		   }else if($url2 == 'business-styling'){  
    		   		$readMore = 'corporate-styling-solutions';  
    		   } else{
    		   		$readMore = '#';
    		   }
    		   
    		   ?>
    		   </div>
        </div>
    <?php } ?>


</div>



 



<!--<div class="seo_content">
	
	<div class="container">
		
		<h4>What is Lorem Ipsum?</h4>

		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

		<p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum</p>

	</div>

</div>-->


	<div class="services_thum">
			
				<div class="ser_logo">

				<?php if(!empty($expertises_list)) { $i=0;?>
			        <?php   foreach($expertises_list as $list) {  ?>
	        			
							<div class="service_wala">
								<?php 
									if ($list->slug == 'designer-dresses') {
										$url =  base_url('shop');
									}else{
										$url =  base_url($url1.'/'.$list->slug);
									}
								?>
								<?php 
									if ($list->slug == $url2) {
										$actp =  'actp';
									}else{
										$actp =  '';
									}
								?>
								
								<a href="<?= $url ?>" class="<?= $actp ?>">
										<div class="cat_photo_1">
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
						
		            <?php  $i++;} ?>
		        <?php } ?>
			</div>
		
		</div>









<?php $this->load->view('Page/template/footer'); ?>



<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">



<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>







<script>

	function redire(url){

		window.location.href=url;

	}

    $(document).ready(function() {



	    $("#expert").removeAttr("title");



	});







    /*$(function() {



		$( "#expert_by_state" ).autocomplete({



			minLength: 2,



			source: "<?=base_url('page/search_stylist_by_state')?>?expertise=<?=$url2?>",



			select: function( event, ui ) {



				event.preventDefault();



				console.log(ui.item);



				$("#expert_by_state").val((ui.item.value));



				$('#FormStylist').attr('action','<?=base_url($url1.'/'.$url2.'/')?>'+ui.item.id);



			}



		});



	});



	$(function() {



		$( "#expert_by_city" ).autocomplete({



			minLength: 2,



			source: "<?=base_url('page/search_stylist_by_city')?>?expertise=<?=$url2?>&state=<?=$url3?>",



			select: function( event, ui ) {



				event.preventDefault();



				console.log(ui.item);



				$("#expert_by_city").val((ui.item.value));



				$('#FormStylist').attr('action','<?=base_url($url1.'/'.$url2.'/'.$url3.'/')?>'+ui.item.id);



			}



		});



	});*/



	$(function() {



		$( "#expert_by_city" ).autocomplete({



			minLength: 2,



			source: "<?=base_url('page/search_stylist_by_city')?>?expertise=<?=$url2?>",



			select: function( event, ui ) {



				event.preventDefault();



				console.log(ui.item);



				$("#expert_by_city").val((ui.item.value));



				$('#FormStylist').attr('action','<?=base_url($url1.'/'.$url2.'/')?>'+ui.item.id);



			}



		});



	});



	/*$(function() {



 







		$( "#expert" ).autocomplete({



			minLength: 2,



			source: "<?=base_url('page/search_stylist_by_city')?>",



			select: function( event, ui ) {



				event.preventDefault();



				console.log(ui.item);



				$("#expert").val((ui.item.value));



				$('#FormStylist').attr('action','<?=base_url('stylist-search/')?>'+ui.item.id);



			}



		});



	});*/



    function locationBy(id){

        $('#FormStylist').attr('action','<?=base_url($url1.'/'.$url2.'/')?>'+id);

        $('#FormStylist').submit();

    }



    function experienceBy(){

    	id = $('#expert_by_city').val();

     	$('#FormStylist').attr('action','<?=base_url($url1.'/'.$url2.'/')?>'+id);

        $('#FormStylist').submit();

    }



</script>





<script>
// Add active class to the current button (highlight it)
// var header = document.getElementById("myDIV");
// var btns = header.getElementsByClassName("btn");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//   var current = document.getElementsByClassName("actp");
//   current[0].className = current[0].className.replace(" actp", "");
//   this.className += " actp";
//   });
// }
</script>