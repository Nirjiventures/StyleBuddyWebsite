<?php  $this->load->view('Page/template/header'); ?>
<?php //print_r($venders)?>
<div class="container mt-3">
	<div class="banner_inner banner_inner3">
		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/new/emp_banner.jpg" class="img-fluid">
		<div class="top_title3">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 offset-sm-1 top_search">
					    <h3 CLASS="text-center text-white">STYLIST SERACH RESULT</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="middle_part">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-sm-12 mgt_tab">
					 <ul class="nav nav-pills justify-content-center" role="tablist">
					    <!--<li class="nav-item">-->
					    <!--  <a class="nav-link active" data-bs-toggle="tab" href="#home">Services</a>-->
					    <!--</li>-->
					    <li class="nav-item">
					      <a class="nav-link active"  href="<?= base_url('styling-and-image-management-services'); ?>">Stylist</a>
					    </li>
					  </ul>


					    <div id="menu1" class="tab-pane active">
					        <?php 
					        
					        $location = array(); $newlocation = '';
					        foreach($states as $state) { $location[] = $state->id; }
					        
					        if(!empty($venders)) { foreach($venders as $vender) {
					               
	                            $query = $this->db->query("select * from cities where id = $vender->city")->row();    
                               
					               if(!empty($vender->expertise)) { $arrayVal = explode(',',$vender->expertise); } 
					        ?>  
					      	<div class="d-flex designer_list">
					      		<a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>" class="v_profile"><i class="fa fa-eye" aria-hidden="true"></i> View Profile</a>
							    <div class="flex-shrink-0">
							       <a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?><?= ($vender->image)?"assets/vandor/images/$vender->image":"assets/images/stylist/no-image.jpg" ?>" class="mr-3 rounded-circle img-thumbnail" width="90px"></a>
							    </div>
							    <div class="flex-grow-1 ms-3">
							        <div class="name_title"><a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>"><?= ucwords($vender->fname.' '.$vender->lname) ?></a></div>
							        <p><small><?= $vender->designation ?></small></p>
							        
							        <?php if(isset($query->city) && (!empty($query->city)) ) {  ?>
							        <p><small><i class='fa fa-map-marker' aria-hidden="true"></i> <?= $query->city ?></small></p>
							        <?php } ?>
							        
							        <p><?= $vender->about ?></p>
							        <ul>
							        	
							        	<?php $values = ""; foreach($expertises as $expertise)  {    ?>
							        	<?php if(isset($arrayVal)) { if(in_array($expertise->id, $arrayVal)) { $values .=  " | $expertise->name"; } } ?>
							        	<?php } ?>
							        	<li><span>Area Of Expertise :</span> <?= substr($values,2); ?></li>
							        </ul>
							    </div>
							</div>
						  <?php } }  else { ?>	
							    <div class="d-flex designer_list">
							        <h3>Search Lstlist Result Not Found</h3>
							    </div>
							<?php } ?>
					    </div>
					  </div>
				</div>
			</div>
			  <div class="row mt-5">
			   <div class="col-sm-12">
			   <div id="pagination_link"></div>
			   <?php //echo $p_links; ?>
			   </div>
		      </div>
	</div>
</div>

<?php $this->load->view('Page/template/footer'); ?>