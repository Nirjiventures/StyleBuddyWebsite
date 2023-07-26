<?php $this->load->view('Page/template/header'); ?>
<!--========Banner Area ========-->

<!--========End Banner Area ========-->	

<style type="text/css">
.dv_tabs .nav-tabs .nav-link.active {
    border-color: rgb(116 46 160);
    border-bottom: 2px solid #742ea0;
    color: #fff!important;
    background-image: linear-gradient(#742ea0, #742ea0);
    border-top: 0px;
}
.nav-tabs {
    border-bottom: none!important;
}
.dv_tabs ul li:first-child a {background: #dddddd; color: #000!important;}
.dv_tabs ul li:nth-child(2) a {background: #dddddd; color: #000!important;}
.dv_tabs ul li:nth-child(3) a {background: #dddddd; color: #000!important;}
.dv_tabs ul li:nth-child(4) a {background: #dddddd; color: #000!important;}
.dv_tabs ul li:nth-child(5) a {background: #dddddd; color: #000!important;}
.dv_tabs ul li:nth-child(6) a {background: #dddddd; color: #000!important;}
.cls{
	text-align: center;
}
.cls ul li {
    line-height: 24px;
}
.th_btn {
    text-transform: capitalize;
    text-align: center;
    display: inline-block;
    background: var(--purple);
    width: auto;
    color: var(--white)!important;
    padding: 0px 21px;
    border-radius: 4px;
    z-index: 1;
    margin-left: 12px;
    font-weight: 500;
    line-height: 40px;
    margin-top: 20px;
    position: relative;
}
.dv_tabs .tab-content{
	margin-top: 10px;
}
.cls ul li {
    text-align: left;
}
.gr-box{
	background: rgb(116,1,202);
    background: linear-gradient(146deg, rgba(116,1,202,1) 0%, rgba(246,42,193,1) 51%, rgba(246,42,193,1) 100%);
    text-align: center;
    color: #fff;
    border-radius: 16px;
    height: 130px;
    padding: 20px 8px;
    font-weight: bold;
    display: block;
    align-items: center;
    display: grid;
    font-size: 15px;
}
@media screen and (min-device-width: 200px) and (max-device-width: 767px){
	ul.nav.nav-tabs li {
	    margin-right: 15px;
	    width: 44%;
	    text-align: center;
	    margin-bottom: 5px;
	    padding-top: 1px;
	}
	.dv_tabs .nav-tabs .nav-link {
	    padding: 10px 0px;
	    font-size: 18px;
	    text-transform: capitalize;
	    color: #495057;
	    font-weight: 600;
	    padding-top: 8px;
	}
	.dv_tabs .justify-content-center{
		justify-content: left!important;
	}
	.gr-box{
		height: auto;
	}
	.service_d{
		margin-top: -40px;
	}
}

</style>
<div class="middle_part pt-0">

	<div class="s_banner">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-10">
					<div class="bg-light">
						<div class="row align-items-center">
				<div class="col-sm-4 col-5">
					<?php  if (file_exists($image_path = FCPATH . 'assets/images/services/' . $datas->image)) { ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/'.$datas->image) ?>"  class="img-fluid">
					<?php  } else { ?>
					    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/stylist/no-image.jpg') ?>"  class="img-fluid">
					<?php  } ?>
					
					
					<!-- <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$datas->image ?>" class="img-fluid"> -->
				</div>
				<div class="col-sm-6 col-7">
					<h2><?= $datas->title ?></h2>
					<p><?= $datas->short_description ?></p>
					<!-- <a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn m-0">Explore Stylists</a> -->
					<a href="<?=base_url('select-service')?>" class="th_btn m-0">Explore Stylists</a>
					<!-- <a href="<?= base_url('services-develop');?>" class="back_btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> BACK</a> -->
					<a href="<?= base_url('services');?>" class="back_btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> BACK</a>
				</div>
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container service_d">
		
	
		<div class="row pt-3 justify-content-center">
			<!-- <div class="col-sm-10 text-center mb-3"><h3>Your Life. Your Style</h3></div> -->
			
			<div class="col-sm-10 text-center">
				<p><span style="font-size:12pt">Our Photoshoot styling is one of the most famous offering on the platform, where we provide extensive photoshoot support for celebs and other influencers. </span></p>
			</div>
<!-- 			<div class="col-sm-9">
				<table class="table table table-bordered table-striped">
					<thead>
			 	  		<tr class="topp">
			 	  			<th style="width:50%;">Features</th>
			 	  			<th>Classic</th>
			 	  			<th>Monthly</th>
			 	  			<th>Annual</th>
			 	  		</tr>
					</thead>
					<tbody>				                         
                        <tr id="0">
                          	<td>Subscription benefits</td>
                          	<td>None</td>
                          	<td>Yes</td>
                          	<td>Yes</td>
                       	</tr>
                    	<tr id="1">
                          	<td>Styling Events covered</td>
                          	<td>One</td>
                          	<td>Four</td>
                          	<td>Unlimited</td>
                       	</tr>
                    	<tr id="2">
                          	<td>Styling for additional one companion</td>
                          	<td>None</td>
                          	<td>None</td>
                          	<td>3 sessions included</td>
                       	</tr>
                    	<tr id="3">
                          	<td>Complimentary personal shopper sessions</td>
                          	<td>None</td>
                          	<td>One / Month</td>
                          	<td>Two / Month</td>
                       	</tr>
                    	<tr id="4">
                          	<td>Complimentary Photo Shoot</td>
                          	<td>None</td>
                          	<td>None</td>
                          	<td>Two</td>
                       	</tr>
                    	<tr id="5">
                          	<td>Dedicated Personal Stylist</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
                       	<tr id="5">
                          	<td>Online Consultation</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
                       	<tr id="5">
                          	<td>Onsite Consultation</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
                       	<tr id="5">
                          	<td>Wardrobe selection</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
                       	<tr id="5">
                          	<td>Advice on Colours, Designs, Patterns on Outfits</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
                       	<tr id="5">
                          	<td>Advice on Accessories</td>
                          	<td>Included</td>
                          	<td>Included</td>
                          	<td>Included</td>
                       	</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-9">
				<div class="dv_tabs mt-5 ">
	    			<ul class="nav nav-tabs text-center justify-content-center" role="tablist">
	    			    <li class="nav-item">
					      <a class="nav-link active" data-bs-toggle="tab" href="#plan1">Classic Package</a>
					    </li>
					     <li class="nav-item">
					      <a class="nav-link" data-bs-toggle="tab" href="#plan2">Monthly Package</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" data-bs-toggle="tab" href="#plan3">Annual Package</a> 
					    </li>
	                </ul>
 
				<div class="tab-content">
				    <div id="plan1" class="tab-pane active">
				    	<div class="row m-0 mb-3">			 	  		
				 	  		<div class="col-sm-12 p-0">
				 	  			<div class="cls p-3">
				 	  				<ul>
				 	  					<li>Styling you for one event which could be any workshop, seminar, meeting etc.</li>
				 	  					<li>Dedicated personal stylist</li>
				 	  					<li>Online or onsite consultation</li>
				 	  					<li>Helping you select right outfit from your existing wardrobe or help you shop for new outfits</li>
				 	  					<li>Advice on colors, patterns and design of your outfits</li>
				 	  					<li>Advice on what accessories will go well with your outfit</li>
				 	  					<li>Complete makeover after knowing your body type and keeping the current trends in mind</li>
				 	  					<li>Make you look professional yet stylish</li>
				 	  				</ul>
				 	  				<a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn">Book your initial consultation</a>
				 	  			</div>
							</div>
						</div>
				    </div>
				    <div id="plan2" class="tab-pane"> 
				    	<div class="row m-0 mb-3">			 	  		
				 	  		<div class="col-sm-12 p-0">
				 	  			<div class="cls p-3">
				 	  				<ul>
										<li>Monthly subscription service</li>
										<li>Styling you for ALL events in a month which could be any workshop, seminar, meeting etc.</li>
										<li>Dedicated personal stylist</li>
										<li>Online or onsite consultation</li>
										<li>Helping you select right outfit from your existing wardrobe or help you shop for new outfits</li>
										<li>Advice on colors, patterns and design of your outfits</li>
										<li>Advice on what accessories will go well with your outfit</li>
										<li>Complete makeover after knowing your body type and keeping the current trends in mind</li>
										<li>Make you look professional yet stylish</li>
									</ul>
									<a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn">Book your initial consultation</a>
				 	  			</div>
							</div>
						</div>
				    </div> 
				    <div id="plan3" class="tab-pane"> 
				    	<div class="row m-0 mb-3">			 	  		
				 	  		<div class="col-sm-12 p-0">
				 	  			<div class="cls p-3">
				 	  				<ul>
										<li>Annual subscription service</li>
										<li>Styling you for ALL events in a month which could be any workshop, seminar, meeting etc.</li>
										<li>Complimentary 3 styling sessions for your companion </li>
										<li>Dedicated personal stylist</li>
										<li>Online or onsite consultation</li>
										<li>Unlimited face to face meetings</li>
										<li>2 Shopping sessions in a month or as per requirement</li>
										<li>Includes the benefits of classic and monthly packages.</li>
										<li>One complimentary Photoshoot</li>
										<li>Helping you select right outfit from your existing wardrobe or help you shop for new outfits</li>
										<li>Advice on colors, patterns and design of your outfits</li>
										<li>Advice on what accessories will go well with your outfit</li>
										<li>Complete makeover after knowing your body type and keeping the current trends in mind</li>
										<li>Make you look professional yet stylish</li>
									</ul>
									<a href="<?= base_url('initial-booking-form/'.$datas->slug) ?>" class="th_btn">Book your initial consultation</a>
				 	  			</div>
							</div>
						</div>
				    </div> 
				</div>
    		</div>
			</div> -->
			<div class="col-sm-10 mt-2">
				<div class="row row-flex">
					<div class="col-sm-2">
						<div class="gr-box">
							DEDICATED PERSONAL STYLIST
						</div>
					</div>
					<div class="col-sm-2">
						<div class="gr-box">
							ONLINE AND OFFSITE CONSULTATION
						</div>
					</div>
					<div class="col-sm-2">
						<div class="gr-box">
							HELP YOU CHOOSE THE RIGHT OUTFIT
						</div>
					</div>
					<div class="col-sm-2">
						<div class="gr-box">
							ADVICE ON COLORS AND DESIGN
						</div>
					</div>
					<div class="col-sm-2">
						<div class="gr-box">
							COMPLETE MAKEOVER
						</div>
					</div>
					<div class="col-sm-2">
						<div class="gr-box">
							ADVICE ON ACCESSORIES
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-10 text-center">
				<a href="<?=base_url('select-service')?>" class="pr_btn">Get styled today, look good, feel good.</a>
			    <!-- <?php if(!empty($privious)) { ?>
				  <a href="<?= base_url('services/').$privious->slug ?>" class="pr_btn">Get styled today, look good, feel good.</a>
				<?php }  ?>
				<?php if(!empty($next)) { ?>
				<a href="<?= base_url('services/').$next->slug ?>" class="n_btn">Get styled today, look good, feel good.</a>
				<?php } ?> -->
			</div>
		</div>
	
	</div>
	
</div>


<?php $this->load->view('Page/template/footer'); ?>