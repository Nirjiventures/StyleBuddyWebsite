<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>

<?php $url4 = $this->uri->segment(4);?>



<?php  $this->load->view('Page/template/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css">



<!--========Banner Area ========-->

<style type="text/css">

	.stylish_feed{

		background: #fff;

	}

	.feed_pic a {

	    color: #000;

	    letter-spacing: 1px;

	}

	.stylish_feed #show-img {

	    width: 100%;

	    height: 170px;

	    object-fit: cover;

	}

	.feed_pic {

	    margin-bottom: 5px;

	}

	.title_fedd{

		color: #000;

    text-transform: uppercase;

    font-size: 14px;

    font-weight: 600;

    background: #e3e3e3;

    padding: 11px 14px;

    margin-top: 9px;

	}

	.dv_tabs .nav-tabs {

    border-bottom: none!important;

}

	.dv_tabs .nav-tabs .nav-link.active {

	    border-color: rgb(116 46 160);

	    border-bottom: 2px solid #742ea0;

	    color: #fff!important;

	    background-image: linear-gradient(#742ea0, #742ea0);

	    border-top: 0px;

	}

	.dv_tabs ul li:first-child a {    background: #dddddd;

    color: #000!important;}

	.dv_tabs ul li:nth-child(2) a {    background: #dddddd;

    color: #000!important;}

	.dv_tabs ul li:nth-child(3) a {    background: #dddddd;

    color: #000!important;}

	.dv_tabs ul li:nth-child(4) a {    background: #dddddd;

    color: #000!important;}

	.dv_tabs ul li:nth-child(5) a {    background: #dddddd;

    color: #000!important;}

	.dv_tabs ul li:nth-child(6) a {    background: #dddddd;

    color: #000!important;}

	.thumb-part{

		border-radius: 4px;

		border: 1px solid #fff;

		padding: 5px;

		position: relative;

	}

	.thumb-part .vw-btn{

		height: 50px;

		width: 50px;

		border-radius: 50%;

		line-height: 50px;

		text-align: center;

		color: #fff;

		background: rgb(0 0 0 / 59%);

		font-size: 18px;

		display: none;

		position: absolute;

		left: 50%;

    	transform: translate(-50%, 100%);

		z-index: 9;

	}

	.thumb-part:hover .vw-btn{

		display: block;

		transition: all 0.5s;

	}

	.thumb-part:hover{

		border-radius: 4px;

		border: 1px solid #000;

	}

	.dv_tabs .nav-tabs .nav-link{

		font-size: 16px;

	}

	.new_feed .dropdown-toggle {

    white-space: nowrap;

    color: #000!important;

    font-size: 16px;

    border: 1px solid #ccc;

    padding: 5px 20px;

    border-radius: 4px;

    text-transform: uppercase;

}

.new_feed .dropdown-menu-end{

	text-align: end;

}

.new_feed .dropdown .show{

	width: auto;

	background: #fff;

}

.new_feed .dropdown .show li a{

	font-size: 14px;

	font-weight: 400;

}

.new_feed .dropdown-toggle::after{

	display: none;

}

</style>

<div class="middle_part ffc" >

	<div class="container">

		<div class="row">

			<div class="col-sm-12 text-center mobile_sp">

				<h1 class="h1_title"><span>FASHIONGRAM VIDEO</span></h1>

				<p>Stylists showcasing their portfolio work on stylebuddy- Home to India's best styling & fashion professionals.</p>
                <?php 
            		$this->breadcrumb = new Breadcrumbcomponent();
            		$this->breadcrumb->add('Home', '/');
            		$this->breadcrumb->add('Fashiongram Video', '/fashiongram-video');
            	?>
             
            	<?php echo $this->breadcrumb->output(); ?>
			</div>

		</div>

		<div class="col-sm-12 dv_tabs new_feed mt-4">

			<div class="row">

				<div class="col-8 col-sm-6">

					<ul class="nav nav-tabs " role="tablist" style="border-bottom:none;">

				     <li class="nav-item">

				      <a class="nav-link active" data-bs-toggle="tab" href="#featured">Popular</a>

				    </li>

				    <li class="nav-item">

				      <a class="nav-link" data-bs-toggle="tab" href="#latest">Trending</a>

				    </li>

				  </ul>

				</div>

				<div class="col-4 col-sm-6">

					<div class="dropdown dropdown-menu-end">

					    <a class="dropdown-toggle" data-bs-toggle="dropdown">

					    	<i class="fa fa-filter" aria-hidden="true"></i> Filter

					    </a>

					    <ul class="dropdown-menu">

					      <li><a class="dropdown-item" href="<?=base_url('fashiongram')?>">Images</a></li>

					      <li><a class="dropdown-item" href="<?=base_url('fashiongram-video')?>">Videos</a></li>

					    </ul>

					  </div>

				</div>

			</div>

    			

		    <div class="tab-content mt-3">

		        <div id="featured" class="tab-pane active">

		            <div class="row m-0 justify-content-center">

        		        <?php 	if(!empty($venders)) {?>

        		        	<?php  	foreach($venders as $vender) { ?>

    		        	            <?php $review = $vender->review;?>

    		                    	<?php $url =  base_url('stylist-zone/fashiongram-video-detail/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-', $vender->city_name)) ?>

        		        	        <?php //if($vender->portfolioArray){ ?>  

        		        	        <div class="col-sm-4">

        				    			<div class="stylish_feed">

        				    				<div class="feed_pic">

        				    				    <a href="<?= $url ?>">
        				    				    	<?php  if (file_exists($image_path = FCPATH . 'assets/vandor/images/' . $vender->image)) { ?>
													    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/vandor/images/'.$vender->image) ?>"  class="img-fluid" alt="<?= ucwords($vender->fname.' '.$vender->lname) ?>" >
													<?php  } else { ?>
													    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid" alt="<?= ucwords($vender->fname.' '.$vender->lname) ?>" >
													<?php  } ?>
        				    				        <!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="<?= ucwords($vender->fname.' '.$vender->lname) ?>" src="<?= base_url() ?><?= ($vender->image)?"assets/vandor/images/$vender->image":"assets/images/stylist/no-image.jpg" ?>"> -->

        				    				        <?= ucwords($vender->fname.' '.$vender->lname) ?>

        				    				        </a> 

        				    					 

        				    				</div>

        				    				<div class="thumb-part">

        				    				    <a  href="<?= $url ?>" class="vw-btn"><i class="fa fa-eye" aria-hidden="true"></i><?=$vender->portfolioCount;?></a>       

        				    				    <?php $iimmg='';$i=0;$videoType = '';?>

        				    				    

        				    				    <div class="slider_part">

    				    				            <?php foreach($vender->portfolioArray as $k=>$video){ ?>

											      	    <?php   if($video->image && $i==0){ ?>

    											      	    <?php   $iimmg= base_url('assets/images/story/'.$video->image); ?>

    											      	    <?php   $videoType= $video->videoType; ?>

    											      	    <?php   $i++; ?>

											      	    <?php } ?>

										      	    <?php } ?>

    											    <?php if($iimmg){ ?>  

    											    

        											    <?php if($video->videoType == 'youtube') {  ?>

                    							    		<div class="col-sm-12 youtube">

                    							    			<div class="my_youtube">

                        							    		    <div class="my_video">

                        												<iframe width="100%" height="320" src="https://www.youtube.com/embed/<?=$video->image?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        							    			</div>

                        							    		</div>

                    							    		</div>

                    					    			<?php }else{  ?>

                    					    				<div class="col-sm-12">

                    					    					<div class="my_youtube">

                    						    				    <div class="my_video local">

                    								    				<video class="video-col-1 hiddenControls" width="100%" height="320" controls>

                    										                <source src="<?=base_url('assets/images/story/'.$video->image)?>#t=2,1" type="video/mp4">

                    										            </video>

                    								    			</div>

                    								    		</div>

                    								    	</div>

                    					    			<?php }  ?>

    											    <?php } ?>

									            </div>

        				    				    <div class="title_fedd"><?= ucwords($vender->fname.' '.$vender->lname) ?></div>

        				    				</div>

        				    			</div>

        							</div>

        							<?php //} ?>

        			  		<?php } ?>

        				<?php }else{ ?>

        					<h1 class="text-center"><b>We are coming soon to your area. STAY TUNED! </b><br/><br/></h1>

        					<br/>

        					<hr/>

        				<?php } ?>

        	      	</div>

			 		<div class="row">

            			<div class="col-sm-12">

            		   		<div class="pagging-stylist ">

            		   			<ul class="pagination justify-content-center ">

                    		   		<?php echo $p_links; ?>

                    		   	</ul>

                    		</div>

            		   </div>

            	   </div>

		        </div>

		        <div id="latest" class="tab-pane">

		            <div class="row m-0 justify-content-center">

        		        <?php 	if(!empty($venders)) {?>

        		        	<?php  	foreach($venders as $vender) { ?>

    		        	            <?php $review = $vender->review;?>

    		                    	<?php $url =  base_url('stylist-zone/fashiongram-video-detail/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-', $vender->city_name)) ?>

        		        	        <div class="col-sm-4">

        				    			<div class="stylish_feed">

        				    				<div class="feed_pic">

        				    				    <a href="<?= $url ?>">

        				    				        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  alt="<?= ucwords($vender->fname.' '.$vender->lname) ?>" src="<?= base_url() ?><?= ($vender->image)?"assets/vandor/images/$vender->image":"assets/images/stylist/no-image.jpg" ?>">

        				    				        <?= ucwords($vender->fname.' '.$vender->lname) ?>

        				    				        </a> 

        				    					 

        				    				</div>

        				    				<div class="thumb-part">

        				    				    <a  href="<?= $url ?>" class="vw-btn"><i class="fa fa-eye" aria-hidden="true"></i><?=$vender->portfolioCount;?></a>       

        				    				    <?php $iimmg='';$i=0;$videoType = '';?>

        				    				    

        				    				    <div class="slider_part">

    				    				            <?php foreach($vender->portfolioArray as $k=>$video){ ?>

											      	    <?php   if($video->image && $i==0){ ?>

    											      	    <?php   $iimmg= base_url('assets/images/story/'.$video->image); ?>

    											      	    <?php   $videoType= $video->videoType; ?>

    											      	    <?php   $i++; ?>

											      	    <?php } ?>

										      	    <?php } ?>

    											    <?php if($iimmg){ ?>  

    											    

        											    <?php if($video->videoType == 'youtube') {  ?>

                    							    		<div class="col-sm-12 youtube">

                    							    			<div class="my_youtube">

                        							    		    <div class="my_video">

                        												<iframe width="100%" height="320" src="https://www.youtube.com/embed/<?=$video->image?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        							    			</div>

                        							    		</div>

                    							    		</div>

                    					    			<?php }else{  ?>

                    					    				<div class="col-sm-12">

                    					    					<div class="my_youtube">

                    						    				    <div class="my_video local">

                    								    				<video class="video-col-1 hiddenControls" width="100%" height="320" controls>

                    										                <source src="<?=base_url('assets/images/story/'.$video->image)?>#t=2,1" type="video/mp4">

                    										            </video>

                    								    			</div>

                    								    		</div>

                    								    	</div>

                    					    			<?php }  ?>

                					    			

        										        <!--<div class="show" href="<?=$iimmg?>">

            										        <a  href="<?= $url ?>">

            										        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=$iimmg?>" id="show-img" class="idea-img">

            										        </a>

            											</div>-->

    											    <?php } ?>

									            </div>

        				    				    <div class="title_fedd"><?= ucwords($vender->fname.' '.$vender->lname) ?></div>

        				    				</div>

        				    			</div>

        							</div>

        			  		<?php } ?>

        				<?php }else{ ?>

        					<h1 class="text-center"><b>We are coming soon to your area. STAY TUNED! </b><br/><br/></h1>

        					<br/>

        					<hr/>

        				<?php } ?>

        	      	</div>

			 		<div class="row">

            			<div class="col-sm-12">

            		   		<div class="pagging-stylist ">

            		   			<ul class="pagination justify-content-center ">

                    		   		<?php echo $p_links; ?>

                    		   	</ul>

                    		</div>

            		   </div>

            	   </div>

		        </div>

		    </div>

		</div>

	</div>

</div>

<?php $this->load->view('Page/template/footer'); ?>

<script>

    





</script>

