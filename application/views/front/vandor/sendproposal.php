<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">
	.inactive{
		display: none;
	}
	.active{
		display: block;
	}
	.auo input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus, textarea:-webkit-autofill, textarea:-webkit-autofill:hover, textarea:-webkit-autofill:focus, select:-webkit-autofill, select:-webkit-autofill:hover, select:-webkit-autofill:focus {
    border: 1px solid green;
    -webkit-text-fill-color: black;
    -webkit-box-shadow: 0 0 0px 1000px #f0f0f0 inset;
    transition: background-color 5000s ease-in-out 0s;
}

form input[type="text"], input[type="password"], input[type="date"], textarea, input[type="file"], input[type="select"] {
    border: 0px solid #dee2e6!important;
    border-radius: 0!important;
    padding: 0.275rem 0.35rem;
    background: #f3f3f4!important;
    font-size: 16px!important;
    height: auto!important;
}

</style>
<div class="main">
	<div class="row m-0 row-flex">
		<div class="col-sm-12">
			<div class="rightbar">
                <?php 
                    $url1 = $this->uri->segment(1);
                    $url2 = $this->uri->segment(2);
                    $url3 = $this->uri->segment(3);
                ?>
                <div class="container">
					<div class="row">
						<div class="col-sm-5">
							<h3>Proposal</h3>
						</div>
						<div class="col-sm-7 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/serviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
				<body style="margin:0px; font-family: 'Poppins', sans-serif;;">
					<div class="container">
						<form name="scriptForm" id="scriptForm" method="post">
						<div style="width: 100%;" id="printableArea">
							
							<div class="whole" style="">
								<!-- <div class="header" style="width: 100%; margin: 0px auto 0px; ">
									<div class="logg" style="background-color: #f0f0f0;  -webkit-print-color-adjust: exact; padding: 20px; text-align:center; ">
										

										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" style="">
										<p style="font-size: 40px;font-weight: bold; margin-bottom: 80px; margin-top: 28px;"><input type="text" name="quote_name" value="Proposal Quotation"></p>
									</div>
									<div style="text-align: center; background: #FFF; width: 50%; margin: -70px auto 60px; border-radius: 14px; padding: 20px; box-shadow: 0px 2px 2px #ccc; border: 2px dashed #f62ac1;">
										<?php if($profile->image) { ?>
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('/assets/vandor/images/').$profile->image ?>"  style="width: 100px;height: 100px;object-fit: cover;border-radius: 20px; margin-right: 10px; border: 2px solid #333; padding: 6px;">
										<?php } else { ?>
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/stylist/no-image.jpg"  style="width: 100px;height: 100px;object-fit: cover;border-radius: 20px; margin-right: 10px; border: 2px solid #333; padding: 6px;">
										<?php } ?>
										<h2 style="margin-bottom: 0px;"><?= strtoupper($profile->fname.' '.$profile->lname) ?></h2>
										<p style="margin-top: 10px;"><?= $profile->designation ?></p>
									</div>
									
								</div> -->
								<div class="middle_part" style="width: 100%; margin: 50px auto 0px;">
									

									<div class="row m-0">
										
										<div class="col-sm-4 p-0 mb-3">
												Date: <input type="date" min="<?php echo date("Y-m-d"); ?>"  required id="customer_date<?=$v['id']?>" name="customer_date" value="<?= $v['customer_date'] ?>" class="box_in3 "><?=$v['customer_date']?>
										</div>
										<div class="col-sm-3 p-0 auo">Dear : 
												<input type="text" required id="customer_name<?=$v['id']?>" name="customer_name" value="<?= $v['customer_name'] ?>" class="box_in3 " placeholder="Enter Customer Name"><?=$v['customer_name']?></div>
										<div class="col-sm-5 text-end p-0">
											Select Service
											<select name="service_name" id="service_name" onChange="changeService(this.value)" required> 
												<option value="">Select Service</option>
												<?php foreach ($services_list as $k => $va) { ?>
													<option value="<?=$va['id']?>"><?=$va['area_expertise_name']?></option>
												<?php }?>
											</select>
										</div>



									</div>


									
									
									

									<div style="font-weight: bold;"></div>
									

									<?php 	$i=0;  ?>
									 
										<div id="serviceTab<?=$v['id']?>" class="tabClass <?=$act?>">
											<?php $package_featureArray = $v['package_featureArray']; ?>
									 	  	<div class="pakcll" style="background-color: #f0f0f0;  -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">
												<input type="hidden" id="package_title_1<?=$v['id']?>" name="package_title_1" value="CLASSIC PACKAGE" class="box_in3"> 
												<input type="hidden" id="package_title_2<?=$v['id']?>" name="package_title_2" value="PREMIUM PACKAGE" class="box_in3"> 
												<input type="hidden" id="package_title_3<?=$v['id']?>" name="package_title_3" value="LUXURY PACKAGE" class="box_in3"> 
												<div class="you_p">
													<h4 style="background-color: #742ea0!important;  -webkit-print-color-adjust: exact; color: #fff; padding: 30px; font-size: 18px; outline: 2px solid #fff; outline-offset: -10px;">CLASSIC PACKAGE  <span style="float: right; color: #ffffff;">Rs. <input type="text" id="package_price_1<?=$v['id']?>" name="package_price_1" value="<?= $v['package_price_1'] ?>" class="box_in3 onlyInteger"><?=$v['']?></span></h4>
												</div>
												<div class="col-sm-12">
					                                 
					                                 <textarea id="package_description_1<?=$v['id']?>" name="package_description_1" rows="2" class="form-control box_in2"><?= $v['package_description_1'] ?></textarea>
					                                 <?php echo form_error('package_description_1','<span class="text-danger mt-1">','</span>') ;?>
					                                 <script> 
					                                    CKEDITOR.replace( 'package_description_1<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
					                                 </script>
					                            </div>

												 
											</div>
											<div class="pakcll" style="background-color: #f0f0f0; -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">
												<div class="you_p">
													<h4 style="background-color: #742ea0; -webkit-print-color-adjust: exact; color: #ffffff; padding: 30px; font-size: 18px; outline: 2px solid #fff; outline-offset: -10px;">PREMIUM PACKAGE <span style="float: right; color: #ffffff;"> Rs. <input type="text" id="package_price_2<?=$v['id']?>" name="package_price_2" value="<?= $v['package_price_2'] ?>" class="box_in3 onlyInteger"><?=$v['']?></span></h4>
												</div>
												<div class="col-sm-12">
					                                  
					                                 <textarea id="package_description_2<?=$v['id']?>" name="package_description_2" rows="2" class="form-control box_in2"><?= $v['package_description_2'] ?></textarea>
					                                 <?php echo form_error('package_description_2','<span class="text-danger mt-1">','</span>') ;?>
					                                 <script> 
					                                    CKEDITOR.replace( 'package_description_2<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
					                                 </script>
					                            </div>

											</div>
											<div class="pakcll" style="background-color: #f0f0f0; -webkit-print-color-adjust: exact; padding: 20px;margin-bottom: 20px;border-radius: 5px;">
												<div class="you_p">
													<h4 style="background-color: #742ea0; -webkit-print-color-adjust: exact; color: #FFFFFF; padding: 30px; font-size: 18px; outline: 2px solid #fff; outline-offset: -10px;">LUXURY PACKAGE <span style="float: right; color: #ffffff;"> Rs. <input type="text" id="package_price_3<?=$v['id']?>" name="package_price_3" value="<?= $v['package_price_3'] ?>" class="box_in3 onlyInteger"></span></h4>
												</div>
												<div class="col-sm-12">
					                                 
					                                 <textarea id="package_description_3<?=$v['id']?>" name="package_description_3" rows="2" class="form-control box_in2"><?= $v['package_description_3'] ?></textarea>
					                                 <?php echo form_error('package_description_3','<span class="text-danger mt-1">','</span>') ;?>
					                                 <script> 
					                                    CKEDITOR.replace( 'package_description_3<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
					                                 </script>
					                            </div>
												 
											</div>
										</div>
									 
									<?php 	$i++;  ?>
									<div class="col-sm-12 text-center">
										<input type="submit" name="submit" class="btn btn-success add_pro" value="Save And Generate PDF">
									</div>
								</div>
								<!-- <a class="btn btn-success add_pro" onclick="scriptForm.submit()">Save And Generate PDF</a> --> 

								<!-- <div class="footer" style="padding:80px 80px 80px;">
									<div style="text-align:center;">
										<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/logo_(2)1.png" style="width: 160px; padding-bottom: 5px;">
										<p style="font-size:14px;">Spaze Platinum, Sohna Road, Sector-47, Gurugram, Haryana-122001</p>
										<p style="font-size:14px;">+919898828200 | support@stylebuddy.in | www.stylebuddy.in</p>
										<div class="footer-social">
										    <a href="#"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/tw.png" style="width: 30px;"></a>
											<a href="https://www.facebook.com/pages/category/Fashion-Designer/Stylebuddy-114620016854650/">
											<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/fb.png" style="width: 30px;"></a>
											<a href="https://www.youtube.com/channel/UC69l91Wf_OigSUQ44WIpRSQ"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/youtube.png" style="width: 30px;"></a>
											<a href="https://www.instagram.com/stylebuddy_official/?hl=en"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/insta.png" style="width: 30px;"></a>
											<a href="https://www.linkedin.com/company/stylebuddy/"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/linke.png" style="width: 30px;"></a>
										</div>
									</div>
								</div> -->
							</div>
						</div>
						</form>
					<div class="clearfix"></div>
					</div>
				</body>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('front/vandor/footer'); ?>
<script type="text/javascript">
	function changeService(id){
		console.log(id);
		/*$('.tabClass').removeClass('active');
		$('.tabClass').removeClass('inactive');
		$('.tabClass').addClass('inactive');
		$('#serviceTab'+id).removeClass('inactive');
		$('#serviceTab'+id).addClass('active');*/

		$.ajax({                
            type: 'POST',               
            url: '<?=base_url()?>Vendor/sendproposal_ajax',                  
            data: {'id':id},
            success: function(response){ 
            	                 
                da = $.parseJSON(response);  
                console.log(da);  
                console.log(da.package_description_1);  
                console.log(da.package_description_2);  
                console.log(da.package_description_3);  


                $('#package_price_1').val(da.package_price_1);                
                $('#package_price_2').val(da.package_price_2);                
                $('#package_price_3').val(da.package_price_3); 
                CKEDITOR.instances['package_description_1'].setData(da.package_description_1);
                CKEDITOR.instances['package_description_2'].setData(da.package_description_2);
                CKEDITOR.instances['package_description_3'].setData(da.package_description_3);
                                
            }           
        });

	}
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;

	     document.body.innerHTML = printContents;

	     window.print();

	     document.body.innerHTML = originalContents;
	}
</script>
