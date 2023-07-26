<?php $this->load->view('front/vandor/header'); ?>
<style type="text/css">
	.switch-handle {
	    top: 1px;
	}
	.switch {
	    width: 90px;
	    padding: 0px;
	    height: 20px;
	}
	.switch-input:checked ~ .switch-handle {
	    left: 70px;
	}
	.form-group {
   	margin-bottom: 2.5rem!important;
	}



.file-upload-wrapper {
  position: relative;
  width: 100%;
  height: 50px;
  background: #f62ac1;
  border-radius: 6px;
}
.file-upload-wrapper:after {
  content: attr(data-text);
  font-size: 18px;
  position: absolute;
  top: 0;
  left: 0;
  background: #f62ac1;
  padding: 10px 15px;
  display: block;
  width: calc(100% - 0px);
  pointer-events: none;
  z-index: 20;
  height: 50px;
  line-height: 30px;
  color: #ffffff;
  border-radius: 5px 10px 10px 5px;
  font-weight: 300;
}
.file-upload-wrapper:before {
  content: "Upload";
  position: absolute;
  top: 0;
  right: 0;
  display: inline-block;
  height: 50px;
  background: #4daf7c;
  color: #fff;
  font-weight: 700;
  z-index: 25;
  font-size: 16px;
  line-height: 50px;
  padding: 0 15px;
  text-transform: uppercase;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
}
.file-upload-wrapper:hover:before {
  background: #3d8c63;
}
.file-upload-wrapper input {
  opacity: 0;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 99;
  height: 50px;
  margin: 0;
  padding: 0;
  display: block;
  cursor: pointer;
  width: 100%;
}


</style>
<?php $row = $list[0]; ?>
<div class="main">
	<div class="container">
		<div class="manage_w">
			<div class="row m-0">
				<div class="col-sm-12">
					<?= form_open_multipart('',['id'=>'registration-form','name'=>'registration-form']) ?>
						<div class="rightbar">
							<div class="row">
								<div class="col-sm-8"><h2>My Lead Detail</h2></div>
								<div class="col-sm-4 text-end">
									<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
									&nbsp; - &nbsp; 
									<a href="<?=base_url('stylist-zone/leads')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
								</div>
								<div class="col-sm-12">
									<?php if($this->session->flashdata('success')){?>
					    			    	<span class="text-center text-info flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>
					    			    	<script>
					                        var timeout = 3000; 
					                        $('.flash_message').delay(timeout).fadeOut(300);
					                  </script>
								    <?php }?>
								    <?php if($this->session->flashdata('error')){?>
					                  <span class="text-center text-danger flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>
					                  <script>
					                        var timeout = 3000; // in miliseconds (3*1000)
					                        $('.flash_message').delay(timeout).fadeOut(300);
					                  </script>
					                <?php }?>

									 
								</div>
							</div>
							<hr>


							<div class="row pt-5 justify-content-center">

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<input type="text" id="fname" name="fname" value="<?php echo ucwords($profile->fname).' '.ucwords($profile->lname); ?>" class="form-control box_in3" disabled>
										<label class="form-control-placeholder2" for="fname">Stylist Name<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<input type="text" id="cname" name="cname" value="<?php echo ucwords($row->fname).' '.ucwords($row->lname); ?>" class="form-control box_in3" disabled>
										<label class="form-control-placeholder2" for="cname">Client Name<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<input type="text" id="email" name="email" value="<?php echo $row->email;?>" class="form-control box_in3" disabled>
										<label class="form-control-placeholder2" for="cname">Mail ID<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<input type="text" id="mobile" name="mobile" value="<?php echo $row->mobile;?>" class="form-control box_in3" disabled>
										<label class="form-control-placeholder2" for="cname">Client Mobile<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<input type="text" id="mobile" name="city" value="<?php echo $row->city;?>" class="form-control box_in3" disabled>
										<label class="form-control-placeholder2" for="cname">City<span class="text-danger">*</span></label>
									</div>
								</div>

							 
								<?php //var_dump($row);?>
								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="age" name="client_age_group" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Below 18'=>'Below 18',
													'18 to 24'=>'18 to 24',
													'25 to 30'=>'25 to 30',
													'31 to 36'=>'31 to 36',
													'37 to 45'=>'37 to 45',
													'Above 45'=>'Above 45',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_age_group){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
										</select>
										<label class="form-control-placeholder2" for="cname">Client Age Group<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="Colour" name="client_favorite_colour" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Red'=>'Red',
													'Blue'=>'Blue',
													'Green'=>'Green',
													'Black'=>'Black',
													'White'=>'White',
													'Yellow'=>'Yellow',
													'Orange'=>'Orange',
													'Purple'=>'Purple',
													'Grey'=>'Grey',
													'Pink'=>'Pink',
													'Brown'=>'Brown',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_favorite_colour){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">Favorite Colour Shades<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="Gender" name="client_gender" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Male'=>'Male',
													'Female'=>'Female',
													'Prefer not to say'=>'Prefer not to say',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_gender){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">Client Gender<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="Clientb" name="client_body_type" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Pear'=>'Pear',
													'Spoon'=>'Spoon',
													'Hourglass'=>'Hourglass',
													'Top Hourglass'=>'Top Hourglass',
													'Bottom Hourglass'=>'Bottom Hourglass',
													'Round or Oval'=>'Round or Oval',
													'Diamond'=>'Diamond',
													'Athletic'=>'Athletic',
													'Rectangle'=>'Rectangle',
													'Triangle'=>'Triangle',
													'Trapezoid'=>'Trapezoid',
													'Inverted Triangle'=>'Inverted Triangle',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_body_type){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">Client Body Type<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="Skint" name="client_skin_tone" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Light'=>'Light',
													'Fair'=>'Fair',
													'Medium'=>'Medium',
													'Dark'=>'Dark',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_skin_tone){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											 
										</select>
										<label class="form-control-placeholder2" for="cname">Client Skin Tone<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-8">
									<div class="form-group boot_sp">
										<select type="text" id="dress_type" name="client_address_type" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Street'=>'Street',
																						'Formal'=>'Formal',
																						'Vintage'=>'Vintage',
																						'Bohemia'=>'Bohemian',
																						'Ethnic'=>'Ethnic',
																						'Sporty'=>'Sporty',
																						'Artsy'=>'Artsy',
																						'Gothic'=>'Gothic',
																						'Casual'=>'Casual',
																						'Punk'=>'Punk',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_address_type){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">What type of dress do you generally prefer to wear?<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="frequently" name="client_shop_type" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Impulsive buyer'=>'Impulsive buyer',
													'Once a month'=>'Once a month',
													'Twice a month'=>'Twice a month',
													'Only for occasions'=>'Only for occasions',
													'Buys few times a year'=>'Buys few times a year',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_shop_type){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">How frequently do you shop?<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-8">
									<div class="form-group boot_sp">
										<select type="text" id="personality" name="client_personality" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'active and social'=>'Optimistic',
													'fast or irritable'=>'Short-tempered',
													'wise and quiet'=>'Analytical',
													'Relaxed and peaceful'=>'Relaxed and peaceful',
													'Extraverted Thinking'=>'Extraverted Thinking',
													'Introverted Thinking'=>'Introverted Thinking',
													'Extraverted Feeling'=>'Extraverted Feeling',
													'Introverted Feeling'=>'Introverted Feeling',
													'Extraverted Sensation'=>'Extraverted Sensation',
													'Introverted Sensation'=>'Introverted Sensation',
													'Extraverted Intuition'=>'Extraverted Intuition',
													'Introverted Intuition'=>'Introverted Intuition',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_personality){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">From the list below, what best suits your personality?<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="looking" name="client_looking_today" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'My Wedding'=>'My Wedding',
													'Attending a wedding'=>'Attending a wedding',
													'My Honeymoon'=>'My Honeymoon',
													'My Birthday'=>'My Birthday',
													'Attending a birthday party'=>'Attending a birthday party',
													'Going on a Date'=>'Going on a Date',
													'Attending a Corporate Event'=>'Attending a Corporate Event',
													'Looking for Formal Outfits'=>'Looking for Formal Outfits',
													'Attending a Private Party'=>'Attending a Private Party',
													'Going Clubbing'=>'Going Clubbing',
													'Going on a Vacation'=>'Going on a Vacation',
													'Fashion photoshoot'=>'Fashion photoshoot',
													'Portfolio photoshoot'=>'Portfolio photoshoot',
													'General Photoshoot'=>'General Photoshoot',
													'Attenting college party'=>'Attenting college party',
													'Going for a Casual Meeting'=>'Going for a Casual Meeting',
													'Attenting a Business Meeting'=>'Attenting a Business Meeting',
													'Looking for something new'=>'Looking for something new',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_looking_today){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
												

										</select>
										<label class="form-control-placeholder2" for="cname">What are you looking for today?<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="often" name="client_take_help" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Impulsive buyer'=>'Impulsive buyer',
													'Once a month'=>'Once a month',
													'Twice a month'=>'Twice a month',
													'Only for occasions'=>'Only for occasions',
													'Buys few times a year'=>'Buys few times a year',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_take_help){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">How often do you take help from stylists?<span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group boot_sp">
										<select type="text" id="occasion" name="client_spend_amount" value="" class="form-control box_in3">
											<?php 
												$a = array(
													'Rs.2000 to 5000'=>'Rs.2000 to 5000',
																						'Rs.5000 to 10000'=>'Rs.5000 to 10000',
																						'Rs.10000 to 15000'=>'Rs.10000 to 15000',
																						'Rs.15000 to 25000'=>'Rs.15000 to 25000',
																						'More than Rs.25000'=>'More than Rs.25000',
												);
											?>
											<?php  foreach ($a as $k => $v) { if($k == $row->client_spend_amount){$sel='selected';}else{$sel='';}?>
													<option value="<?=$k?>" <?=$sel?>><?=$v?></option>
											<?php 	} ?>
											
										</select>
										<label class="form-control-placeholder2" for="cname">How much are you looking to spend for this occasion? <span class="text-danger">*</span></label>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group boot_sp">
										<textarea class="form-control box_in3" name="client_comment" style="height: 100px!important;"><?=$row->client_comment?></textarea>
										<label class="form-control-placeholder2" for="pin">Comment</label>
									</div>
								</div>


								<div class="col-sm-5">
									 <div class="form_p">
									    <div class="file-upload-wrapper" data-text="+ Upload full length photo of client">
									      <input name="file-upload-field" type="file" class="file-upload-field" value="">
									    </div>
									 </div>
									 <?php if($row->client_picture){?>
									 	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('assets/images/ask-quote/'.$row->client_picture)?>" style="width:100%">
									 <?php } ?>
								</div>

								<div class="row m-0 justify-content-center pt-5">

								<div class="col-sm-12 text-center">
									<input type="submit" value="SUBMIT" class="btc">
								</div>

								</div>
							</div>
							<div class="" style="display:none;">
									<div class="table-responsive1 mt-5">
										
										<div class="row m-0 justify-content-center">
											<div class="col-sm-6">
												<div class="lock_nn">
													<div class="numb_lock">
														<span>01</span>
													</div>
													<div class="data_fild">
														<span>Name</span>
														<?php echo ucwords($row->fname).' '.ucwords($row->lname); ?>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="lock_nn">
													<div class="numb_lock">
														<span>02</span>
													</div>
													<div class="data_fild">
														<span>Email</span>
														<?php echo $row->email; ?>
													</div>
												</div>
											</div>

											<div class="col-sm-6">
												<div class="lock_nn">
													<div class="numb_lock">
														<span>03</span>
													</div>
													<div class="data_fild">
														<span>Mobile</span>
														<?php echo $row->mobile; ?>
													</div>
												</div>
											</div>

											<div class="col-sm-6">
												<div class="lock_nn">
													<div class="numb_lock">
														<span>04</span>
													</div>
													<div class="data_fild">
														<span>City</span>
														<?php echo $row->city; ?>
													</div>
												</div>
											</div>


											<div class="col-sm-6">
												<div class="lock_nn">
													<div class="numb_lock">
														<span>05</span>
													</div>
													<div class="data_fild">
														<span>Date Time</span>
														<?php echo $row->availability_date; ?>&nbsp;&nbsp;&nbsp;<?php echo $row->availability_start_time; ?> - <?php echo $row->availability_end_time; ?>
													</div>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="lock_nn">
													<div class="data_fild2">
														<span>Message</span>
														<?php echo $row->message; ?>
													</div>
												</div>
											</div>

										</div>

									</div>
									<div class="clearfix" style="clear:both"></div>
									<hr/>
									<h3><b>Client Requirement Details</b></h3>
									<?php if($row->requirment_status){  $readonly = 'disabled'; }else{$readonly = '';} ?>	
									<div class="sty_list">
										<ul class="row-flex">
											<?php foreach ($requirment as $key => $value): ?>
												<?php   $requirment_id = explode(',', $row->requirment_id);?>
												<?php   if (in_array($value->id,$requirment_id)) { $chk = 'checked';}else{$chk='';}?>
												<li><span><input type="checkbox"   <?=$readonly;?>  <?=$chk;?> class="requirment" name="requirment[]" value="<?=$value->id?>====<?=$value->amount?>" onclick="calculate()" > </span> <?=$value->title?> </li>
											<?php endforeach ?>
										</ul>
									</div>
									<div class="col-sm-12">
										<div class="row m-0">
											<div class="col-sm-4">
												<div class="form-group boot_sp">
													<input required="" type="text" id="final_total" name="final_total" value="<?php echo $row->requirment_total; ?>" class="form-control box_in3" readonly="">
													<label class="form-control-placeholder2" for="fname">Total </label>
												</div>
											</div>
											<?php if(!$row->requirment_status){ ?>
												<div class="col-sm-12 text-center">
													<input type="submit" class="btc">
												</div>
											<?php } ?>
										</div>
									</div>
							</div>
						</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	
	$(".form_p").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text",         $(this).val().replace(/.*(\/|\\)/, '') );
});
</script>


<script>
    function blogStatus(id,status){
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('vendor/leads_status'); ?>", 
              data: {"status":newstatus, "id":id}, 
              success: function(data) {
                location.reload();
              }         
           });
       } else {
           location.reload();
       }
    }

    function calculate(){
    	var  final_total = 0;
		var requirment = $("input.requirment:checkbox:checked").map(function(){
	    	return $(this).val();
	    }).get(); 
	    $.each(requirment, function( index, value ) {
	    	var myArray = value.split("====");
	    	final_total += parseFloat(myArray[1]);
		});
	    $("#final_total").val(final_total.toFixed(2));

    }
</script>
</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>