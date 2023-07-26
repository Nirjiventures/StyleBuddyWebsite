<?php  $this->load->view('Page/template/header'); ?>
<div class="what_would wedding color_2">
	<div class="container-fluid">
		 <?= form_open('stylist-search',['id'=>'FormStylist']) ?>  
		<div class="city_part">
			<input  name="expert" id="expert" type="text" class="my_city" placeholder="Search by name...">
			<button><i class="fa fa-search"></i></button>
			<!-- <div id="titleDisplay" class="dp_down"></div> -->
		</div>
		<?= form_close(); ?>	
		<!-- <h2>Great!! Here are out top Wedding Stylists  and Designers for You</h2> -->
		<div class="stylish_list">
			
			<div class="row m-0">
		        <?php  	$location = array(); $newlocation = ''; ?>
		        <?php 	foreach($states as $state) { $location[] = $state->id; }?>
		        
		        <?php 	if(!empty($venders)) {?>
		        	<?php  	foreach($venders as $vender) { ?>
		                    <?php $query = $this->db->query("select * from cities where id = $vender->city")->row(); ?>   
                            <?php  if(!empty($vender->expertise)) { $arrayVal = explode(',',$vender->expertise); }   ?>  
					      	<div class="col-sm-3">

					      		<div class="designer_list_1">
									<div class="pro_part">
										<a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?><?= ($vender->image)?"assets/vandor/images/$vender->image":"assets/images/stylist/no-image.jpg" ?>" class="img-fluid"></a>
									</div>
									<div class="all_data">
										<h4><span><a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>"><?= ucwords($vender->fname.' '.$vender->lname) ?></a></span></h4>
										<p><?= $vender->designation ?></p>
										<?php if(isset($query->city) && (!empty($query->city)) ) {  ?>
								        	<p><small><i class='fa fa-map-marker' aria-hidden="true"></i> <?= $query->city ?></small></p>
								        <?php } ?>
										<div class="star_s">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> (02 Reviews)
										</div>
										<div class="book_now_b">
											<a href="<?= base_url('stylist-profile/').base64_encode($vender->id) ?>">View Protfolio <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> | 
											<a href="<?=base_url('ask-for-quote')?>">Book Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>

					      		 
							</div>
			  		<?php } ?>
				<?php } ?>
			   
	      	</div>
			 
		</div>
		 
	    
	</div>
</div>


<?php $this->load->view('Page/template/footer'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
    $("#expert").removeAttr("title");
});

    $(function() {
 

		$( "#expert" ).autocomplete({
			minLength: 2,
			source: "<?=base_url('page/search_stylist_by_name')?>",
			select: function( event, ui ) {
				event.preventDefault();
				console.log(ui.item);
				$("#expert").val((ui.item.value));
				$('#FormStylist').attr('action','<?=base_url('stylist-profile/')?>'+ui.item.id);
			}
		});
	});

</script>
