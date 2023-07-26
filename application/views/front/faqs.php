<?php  $this->load->view('front/template/header'); ?>
<div class="banner_inner">
	<div class="container">
		<h1>Faq</h1>
		<a href="<?=base_url()?>">Home</a> > Faq
	</div>
</div>
	<div class="middle_part">
		<div class="container">
			<div class="row m-0 justify-content-between fqcc">
				<div class="col-sm-3">
					<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
						<?php $i=0;foreach ($list as $key => $value) { if($i==0){$act = 'active';}else{$act = '';} ?>
							<button class="nav-link <?=$act?>" id="nav-home-tab_<?=$value->id?>" data-bs-toggle="tab" data-bs-target="#nav-home_<?=$value->id?>" type="button" role="tab" aria-controls="nav-home_<?=$value->id?>" aria-selected="true"><?=$value->name?></button>
						<?php  $i++;}?>
					</div>
				</div>
				
				<div class="col-sm-8">
					<div class="tab-content " id="nav-tabContent">
						<?php $i=0;foreach ($list as $key => $value) { if($i==0){$act = 'active show';}else{$act = '';} ?>
							<div class="tab-pane fade <?=$act?>" id="nav-home_<?=$value->id?>" role="tabpanel" aria-labelledby="nav-home-tab_<?=$value->id?>">
								<div class="fq_head"><p><b><?=$value->name?></b></p></div>
								<div class="accordion" id="accordionExample_<?=$value->id?>">
									<?php $j=0;foreach ($value->rows as $key1 => $value1) { if($j==0){$expanded = 'true';$active = 'collapsed';}else{$expanded = 'false';$active = 'collapse';}?>
									  	
									  	<div class="accordion-item">
											<h2 class="accordion-header" id="headingOne_<?=$value1->id?>">
											  	<button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_<?=$value1->id?>" aria-expanded="<?=$expanded?>" aria-controls="collapseOne_<?=$value1->id?>"><?=$value1->name?></button>
											</h2>
											<div id="collapseOne_<?=$value1->id?>" class="accordion-collapse collapse <?=$active?>" aria-labelledby="headingOne_<?=$value1->id?>" data-bs-parent="#accordionExample_<?=$value->id?>">
											  	<div class="accordion-body">
												<?=$value1->description?>
											  	</div>
											</div>
									  	</div>
									<?php $j++; } ?>
								</div>
							</div>
						<?php  $i++;}?>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="covid">
					<h3><?=$seoData->sub_title?></h3>
					<?=$seoData->content?>
					<?php  if (file_exists($image_path = FCPATH . 'assets/images/' . $seoData->image)) { ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$seoData->image) ?>"  class="img-fluid">
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('front/template/footer'); ?>
