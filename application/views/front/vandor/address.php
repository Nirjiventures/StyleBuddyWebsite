<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>
<div class="main">
	<div class="row m-0">

		<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php $this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>


		<div class="col-sm-9">
			<div class="rightbar">
				<h2>Address</h2>
				<hr>
				 
				<?php if($user_shipping_address){ ?>
						<?php foreach($user_shipping_address as $k=>$v){ ?>
							<div class="col-sm-12">
									<div class="modal fade" id="update_<?=$v['id']?>" tabindex="-1" role="dialog"  aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-body add-cart-box">
												<div class="add_ship">
													<form id="updateAddressForm<?=$v['id']?>" name="updateAddressForm<?=$v['id']?>">
														<br/>
														<h4>Update Shipping Address</h4>
														<hr>
														<div class="row">
															<input type="hidden" name="user_shipping_address_id" value="<?=$v['id']?>">
															<div class="col-sm-6">
																<div class="form-group boot_sp">
																	<input name="bill_first_name" type="text" required class="form-control box_in3" placeholder="<?=$this->lang->line('MSG_39');?>" value="<?=$v['bill_first_name']?>">
																	<label class="form-control-placeholder2">First Name</label>
																</div>
															</div>
															
															<div class="col-sm-6">
																<div class="form-group boot_sp">
																	<input name="bill_last_name" type="text" required class="form-control box_in3" placeholder="<?=$this->lang->line('MSG_40');?>"  value="<?=$v['bill_last_name']?>">
																	<label class="form-control-placeholder2">Last name</label>
																</div>
															</div>
															
															<div class="col-sm-12">
																<div class="form-group boot_sp">
																	<input name="bill_address" type="text" required class="form-control box_in3" placeholder="<?=$this->lang->line('MSG_59');?>"  value="<?=$v['bill_address']?>">
																	<label class="form-control-placeholder2">Address</label>
																</div>
															</div>
															
															<div class="col-sm-4">
																<div class="form-group">
																	 
																	<div class="select-custom">
																		<select class="form-control box_in3 box_new"  name="bill_country" onchange="getState(this.value,'region<?=$v['id']?>')">
																			<?php foreach($country as $k=>$y){ if($v['bill_country'] == $y['default_name']){$el = 'selected';}else{$el = '';}?>
																				<option value="<?=$y['default_name']?>" <?=$el?>><?=$y['default_name']?></option>
																			<?php } ?>
																		</select>
																	</div>
																	<label class="form-control-placeholder2">Country</label>
																	
																</div>
															</div> 
															<div class="col-sm-4">
																<div class="form-group boot_sp">
																	<select id="region<?=$v['id']?>" name="bill_state" class="form-control box_in3" onchange="getCity(this.value,'city<?=$v['id']?>')">
																		<option  value="">----- <?=$this->lang->line('MSG_77')?> -----</option>
																		<?php foreach($region as $k=>$y){ ?>
																			<?php if($y['default_name'] == $v['bill_state']){$sel = 'selected';}else{$sel = '';}?>
																			<option value="<?=$y['default_name']?>" <?=$sel?>><?=$y['default_name']?></option>
																		<?php } ?>
																	</select>
																	<label class="form-control-placeholder2"><?=$this->lang->line('MSG_77')?></label>
																	
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group boot_sp">
																	
																	<select id="city<?=$v['id']?>" name="bill_city" class="form-control box_in3">
																		<option  value="">----- <?=$this->lang->line('MSG_60')?> -----</option>
																		<?php foreach($zip as $k=>$y){ ?>
																			<?php if($y['default_name'] == $v['bill_city']){$sel = 'selected';}else{$sel = '';}?>
																			<option value="<?=$y['default_name']?>" <?=$sel?>><?=$y['default_name']?></option>
																		<?php } ?>
																	</select>
																	<label class="form-control-placeholder2"><?=$this->lang->line('MSG_60')?></label>
																</div>
															</div>

															<div class="col-sm-6">
																<div class="form-group boot_sp">
																	<input name="bill_zipcode" type="text" required class="form-control box_in3  onlyInteger zipcode" placeholder="<?=$this->lang->line('MSG_61');?>" value="<?=$v['bill_zipcode']?>">
																	<label class="form-control-placeholder2" for="Pin">Pin / Postal code</label>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group boot_sp">
																	<input name="bill_phone" type="text" required class="form-control box_in3  onlyInteger phone" placeholder="<?=$this->lang->line('MSG_42');?>" value="<?=$v['bill_phone']?>">
																	<label class="form-control-placeholder2" for="bill_phone">Phone</label>
																</div>
															</div>
															
															 
															 
														</div>
														<div class="btn-actions text-center">

															<input type="submit" class="btn btn-sm btn-outline-secondary" onclick="ajax_address_update(<?=$v['id']?>)" name="<?=$this->lang->line('MSG_44');?>" id="Add_Address">
															<a href="#" class="btn btn-sm btn-outline-secondary" role="button" data-dismiss="modal">Close</a>
														</div>
														
													</form>
												</div>
												</div>
											</div>
										</div>
									</div>

									<table class="table table-bordered">
										<tr>
											<td>
												<address>
													<b>Name  : </b><?php echo ($v['bill_first_name']);?> <?php echo ($v['bill_last_name']);?>  
													<b>Phone : </b><?php echo ($v['bill_phone']);?> 
													<b>Address : </b><?php echo ($v['bill_address']);?> <?php echo ($v['bill_city']);?> , <?php echo ($v['bill_state']);?> <?php echo ($v['bill_zipcode']);?> <?php echo ($v['bill_country']);?>
												</address>
											</td>
											<td><a href="#" data-toggle="modal" data-target="#update_<?=$v['id']?>" class="btn btn-sm btn-outline-secondary btn-new-address">Edit</a></td>
										</tr>
									</table>
								</div>
						<?php } ?>
						<?php foreach($user_shipping_address as $k=>$v){ ?>
							<div class="col-sm-12">
								<div class="modal fade" id="update_<?=$v['id']?>" tabindex="-1" role="dialog" aria-labelledby="uploadLogoModal" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body add-cart-box">
											<div class="add_ship">
												<form id="updateAddressForm<?=$v['id']?>" name="updateAddressForm<?=$v['id']?>">
													<br/>
													<h4>Update Shipping Address</h4>
													<hr>
													<div class="row">
														<input type="hidden" name="user_shipping_address_id" value="<?=$v['id']?>">
														<div class="col-sm-6  form-group">
															<label>First Name </label>
															<input name="bill_first_name" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_39');?>" value="<?=$v['bill_first_name']?>">
														</div>
														
														<div class="col-sm-6  form-group">
															<label>Last Name </label>
															<input name="bill_last_name" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_40');?>"  value="<?=$v['bill_last_name']?>">
														</div>
														
														<div class="col-sm-12  form-group">
															<label>Address </label>
															<input name="bill_address" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_59');?>"  value="<?=$v['bill_address']?>">
														</div>
														
														<div class="col-sm-12  form-group">
															<label>Country </label>
															<input name="bill_country" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_80');?>" value="<?=$v['bill_country']?>">
														</div>
														
														<div class="col-sm-6  form-group">
															<label>State/Province</label>
															<input name="bill_state" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_77');?>"  value="<?=$v['bill_state']?>">
														</div>
														<div class="col-sm-6  form-group">
															<label>City</label>
															<input name="bill_city" type="text" required class="form-control" placeholder="<?=$this->lang->line('MSG_60');?>" value="<?=$v['bill_city']?>">
														</div>
														<div class="col-sm-6  form-group">
															<label>Zipcode</label>
															<input name="bill_zipcode" type="text" required class="form-control  onlyInteger zipcode" placeholder="<?=$this->lang->line('MSG_61');?>" value="<?=$v['bill_zipcode']?>">
														</div>
														<div class="col-sm-6  form-group">
															<label>Phone</label>
															<input name="bill_phone" type="text" required class="form-control  onlyInteger phone" placeholder="<?=$this->lang->line('MSG_42');?>" value="<?=$v['bill_phone']?>">
														</div>
													</div>
													<div class="address-box-action clearfix text-center">
														<input type="submit" class="btn btn-danger" onclick="ajax_address_update(<?=$v['id']?>)" name="<?=$this->lang->line('MSG_44');?>" id="Add_Address">
														<a href="#" class="btn" role="button" data-dismiss="modal">Close</a>
													</div>
													
												</form>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php }else{ ?>
					<?php } ?>
			</div>
		</div>
	</div>
</div>


</body>
</html>
