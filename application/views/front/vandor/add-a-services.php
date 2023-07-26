<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>
<style type="text/css">
	.cke_button__save{
		display: none!important;
	}
</style>
<div class="main">
	<div class="container">

		<div class="col-sm-12">
			<div class="rightbar">
				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>Services</h3></div>
							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/addownservice')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Add</a>
							</div>

					</div>
					<?php if($this->session->flashdata('servicesCount_message')) {  ?>
    					<div class="logo_p  mb-2 mt-2"><?= $this->session->flashdata('servicesCount_message'); ?></div>
    				<?php } ?>
					<hr>
				</div>
			</div>
			<div class="add_service_list">
				<div class="row m-0 justify-content-center">
					<?php foreach($services_list as $k=>$v){ if($v['flag']){$cls='hover';$icon='fa-trash';}else{$cls='';$icon='fa-undo';}?>
						<div class="col-sm-3 col-6">
							<div class="add_service_block <?=$cls?>">
								<p class="portfolio_total btn-danger" onClick="deleteService(<?=$v['deleted_id']?>,<?=$v['deleted_status']?>)"><i class="fa <?=$icon?>" aria-hidden="true"></i></p>
								<a href="#" data-bs-toggle="modal" data-bs-target="#service_package<?=$v['id']?>">
									<span><?=$v['area_expertise_name']?></span>
								</a>
							</div>
							<div class="modal" id="service_package<?=$v['id']?>">
							  	<div class="modal-dialog modal-xl modal-dialog-centered">
							    	<div class="modal-content content_22">
								      	<div class="modal-header">
								        	<h4 class="modal-title"><?=$v['area_expertise_name']?></h4>
								        	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								      	</div>
								      	<div class="modal-body pop_p">
								      		<form method="post" id="frm<?=$v['id']?>">
								      			<input type="hidden" name="hiddenValue" value="<?=$v['id']?>">
									       		<!-- <div class="row m-0">
									        		<div class="col-sm-12">
								                  		<br>
									        			<p><b>Package Feature</b></p>
									        			<table class="table table table-bordered"  id="list<?=$v['id']?>">
												 	  		<thead>
													 	  		<tr class="topp">
													 	  			<th style="width:50%;">Feature</th>
													 	  			<th>Classic</th>
													 	  			<th>Premium</th>
													 	  			<th>Luxury</th>
													 	  		</tr>
															</thead>
															<tbody id="TextBoxContainer">
																<?php $package_featureArray = $v['package_featureArray'];  ?>
																<?php 
																$i=0;
																foreach ($package_featureArray as $key1 => $value1) {  ?>
																	<tr  id="<?=$i?>">
																		<td><input type="text" name="first_col[]" value="<?=$value1['feature']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="second_col[]" value="<?=$value1['classic']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="third_col[]" value="<?=$value1['premium']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="fourth_col[]" value="<?=$value1['luxury']?>" class="form-control box_in3" required></td>
																	</tr>
																<?php $i++;}  ?>
															</tbody>
														</table>
													</div>
												</div> -->
												<div class="row m-0">
													<div class="col-sm-12">
									                    <div class="dx">
									                    	<div class="row">
									                           	<!--<div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
									                                 <textarea readonly id="package_title_1<?=$v['id']?>" name="package_title_1" rows="2" class="form-control box_in2"><?= $v['package_title_1'] ?></textarea>
									                                 <?php echo form_error('package_title_1','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_title_1<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                 </script>
									                            </div>-->

									                            <div class="col-sm-8">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
									                                 <textarea readonly id="package_description_1<?=$v['id']?>" name="package_description_1" rows="2" class="form-control box_in2"><?= $v['package_description_1'] ?></textarea>
									                                 <?php echo form_error('package_description_1','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_description_1<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
									                                 </script>
									                            </div>

									                            <div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
									                                 <input type="text" id="package_name_1<?=$v['id']?>" name="package_name_1" value="Classic" class="form-control box_in3 pack_name" readonly>
									                                 <div class="form-group boot_sp mt-4">
										                                 <input type="text" id="package_price_1<?=$v['id']?>" name="package_price_1" value="<?= $v['package_price_1'] ?>" class="form-control box_in3 onlyInteger">
										                                 <label class="form-control-placeholder2" for="package_price_1"><b>Add Your Pricing</b></label>
										                              </div>
									                              </div>
									                              
									                           </div>
									                        </div>

									                    <div class="dx">
									                    	<div class="row">
								                              <!--<div class="col-sm-4">
								                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
								                                 <textarea readonly id="package_title_2<?=$v['id']?>" name="package_title_2" rows="2" class="form-control box_in2"><?= $v['package_title_2'] ?></textarea>
								                                 <?php echo form_error('package_title_2','<span class="text-danger mt-1">','</span>') ;?>
								                                 <script> 
								                                    CKEDITOR.replace( 'package_title_2<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
								                                 </script>
								                              </div>-->

								                              <div class="col-sm-8">
								                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
								                                 <textarea readonly id="package_description_2<?=$v['id']?>" name="package_description_2" rows="2" class="form-control box_in2"><?= $v['package_description_2'] ?></textarea>
								                                 <?php echo form_error('package_description_2','<span class="text-danger mt-1">','</span>') ;?>
								                                 <script> 
								                                    CKEDITOR.replace( 'package_description_2<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
								                                 </script>
								                              </div>

								                              <div class="col-sm-4">
								                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
								                                 <input type="text" id="package_name_2<?=$v['id']?>" name="package_name_2" value="Premium" class="form-control box_in3 pack_name" readonly>
								                                 <div class="form-group boot_sp mt-4">
									                                 <input type="text" id="package_price_2<?=$v['id']?>" name="package_price_2" value="<?= $v['package_price_2'] ?>" class="form-control box_in3 onlyInteger">
									                                 <label class="form-control-placeholder2" for="package_price_2"><b>Add Your Pricing</b></label>
									                              </div>
								                              </div>
									                        </div>
									                    </div>
									                    
									                    <div class="dx">
									                    	<div class="row">
									                           	<!--<div class="col-sm-4">
									                                <label for="Image Alt Description" class=" col-form-label">Package Title</label>
									                                <textarea readonly id="package_title_3<?=$v['id']?>" name="package_title_3" rows="2" class="form-control box_in2"><?= $v['package_title_3'] ?></textarea>
									                                 <?php echo form_error('package_title_3','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_title_3<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                 </script>
									                            </div>-->

									                            <div class="col-sm-8">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
									                                 <textarea readonly id="package_description_3<?=$v['id']?>" name="package_description_3" rows="2" class="form-control box_in2"><?= $v['package_description_3'] ?></textarea>
									                                 <?php echo form_error('package_description_3','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_description_3<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                 </script>
									                            </div>

									                            <div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
									                                 <input type="text" id="package_name_3<?=$v['id']?>" name="package_name_3" value="Luxury" class="form-control box_in3 pack_name" readonly>
									                                 <div class="form-group boot_sp mt-4">
										                                 <input type="text" id="package_price_3<?=$v['id']?>" name="package_price_3" value="<?= $v['package_price_3'] ?>" class="form-control box_in3 onlyInteger">
										                                 <label class="form-control-placeholder2" for="package_price_3"><b>Add Your Pricing</b></label>
										                              </div>
									                            </div>
									                        </div>
									                    </div>

									                </div>
												</div>
												<div class="row mt-3 justify-content-center">
													<div class="add_my_btc col-sm-3 text-center">
														<input type="submit" value="SUBMIT" class="bkk">
													</div>
												</div>
											</form>
								      	</div>
							    	</div>
							  	</div>
							</div>
						</div>
					<?php } ?>
					<?php foreach($services_list_own as $k=>$v){ if($v['flag']){$cls='hover';$icon='fa-trash';}else{$cls='';$icon='fa-undo';}?>
						<div class="col-sm-3 col-6">
							<div class="add_service_block <?=$cls?>">
								<p class="portfolio_total btn-danger" onClick="deleteService(<?=$v['id']?>,<?=$v['deleted_status']?>)"><i class="fa <?=$icon?>" aria-hidden="true"></i></p>
								<a href="#" data-bs-toggle="modal" data-bs-target="#service_package_<?=$v['id']?>">
									<span><?=$v['area_expertise_name']?></span>
								</a>
							</div>
							<div class="modal" id="service_package_<?=$v['id']?>">
							  	<div class="modal-dialog modal-xl modal-dialog-centered">
							    	<div class="modal-content content_22">
								      	<div class="modal-header">
								        	<h4 class="modal-title"><?=$v['area_expertise_name']?></h4>
								        	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								      	</div>
								      	<div class="modal-body pop_p">
								      		<form method="post" id="frm_<?=$v['id']?>">
								      			<input type="hidden" name="hiddenValue_" value="<?=$v['id']?>">
									       		<!-- <div class="row m-0">
									       			<div class="col-md-12">
								                     	<label for="Image Alt Description" class="form-label">Service Name<span class="text-danger"></span></label>
								                     	<input type="text" id="area_expertise_name" name="area_expertise_name" value="<?= $v['area_expertise_name'] ?>" class="form-control box_in3 " >
								                  	</div>
								                  	<div class="col-sm-12">
								                  		<br>
									        			<p><b>Package Feature</b></p>
									        			<table class="table table table-bordered"  id="list_<?=$v['id']?>">
												 	  		<thead>
													 	  		<tr class="topp">
													 	  			<th style="width:50%;">Feature</th>
													 	  			<th>Classic</th>
													 	  			<th>Premium</th>
													 	  			<th>Luxury</th>
													 	  			<th>Action</th>
																</tr>
															</thead>
															<tbody id="TextBoxContainer">
																<?php $package_featureArray = $v['package_featureArray'];  ?>
																<?php 
																$i=0;
																foreach ($package_featureArray as $key1 => $value1) {  ?>
																	<tr  id="<?=$i?>">
																		<td><input type="text" name="first_col[]" value="<?=$value1['feature']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="second_col[]" value="<?=$value1['classic']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="third_col[]" value="<?=$value1['premium']?>" class="form-control box_in3" required></td>
																		<td><input type="text" name="fourth_col[]" value="<?=$value1['luxury']?>" class="form-control box_in3" required></td>
																		<td class="action"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute(<?=$i?>);return false;"><i class="fa fa-times red"></i></a></span></td>
																	</tr>
																<?php $i++;}  ?>
															</tbody>
														</table>
													</div>
													<div class="col-sm-12  text-end">
											        	<div class="re_up_video">
													        <a class="btn btn-danger" onclick="addRow()"> <i class="fa fa-plus"></i> Add</a>
													    </div>
												    </div>
												    <script type="text/javascript">
												    	function addRow(id=0){
															var id  = id;
													        var rowCount = $('#list_<?=$v['id']?> tr').length;
													        console.log(id);
													        console.log(rowCount);
													        data  = addSlots(id,rowCount);
													        $("#list_<?=$v['id']?>").append(data);
														}
													 	function addSlots(id,rowCount){
															html = '';
																html += '<tr id="'+rowCount+'">';
																	html += '<td>';
																 		html += '<input type="text" id="length" name="first_col[]" value="" required class="form-control box_in3 table_td length">';
																	html += '</td>';
																	html += '<td>';
																 		html += '<input type="text" id="width" name="second_col[]" value="" required class="form-control box_in3 table_td width">';
																	html += '</td>';
																	html += '<td>';
																 		html += '<input type="text" id="height" name="third_col[]" value="" required class="form-control box_in3 table_td height">';
																	html += '</td>';
																	html += '<td>';
																 		html += '<input type="text" id="pices" name="fourth_col[]" value="" required class="form-control box_in3 table_td pices">';
																	html += '</td>';
																	html  += '<td class="action"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute('+rowCount+');return false;"><i class="fa fa-times red"></i></a></span></td>';
																html += '</tr>';
															return html;
														}
														function deleteAttribute(id){
													        $("#"+id).css("display","none");
													       	$("#"+id).remove();
													    }
												    </script>
												</div> -->
												<div class="row m-0">
													<div class="col-sm-12">
									                    <div class="dx">
									                    	<div class="row">
									                            <!--<div class="col-sm-4">
									                                <label for="Image Alt Description" class=" col-form-label">Package Title</label>
									                                <textarea  id="package_title_1_<?=$v['id']?>" name="package_title_1" rows="2" class="form-control box_in2"><?= $v['package_title_1'] ?></textarea>
									                                 <?php echo form_error('package_title_1','<span class="text-danger mt-1">','</span>') ;?>
									                                <script> 
									                                    CKEDITOR.replace( 'package_title_1_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                </script>
									                            </div>-->

									                            <div class="col-sm-8">
									                                <label for="Image Alt Description" class=" col-form-label">Package Description</label>
									                                <textarea  id="package_description_1_<?=$v['id']?>" name="package_description_1" rows="2" class="form-control box_in2"><?= $v['package_description_1'] ?></textarea>
									                                <?php echo form_error('package_description_1','<span class="text-danger mt-1">','</span>') ;?>
									                                <script> 
									                                    CKEDITOR.replace( 'package_description_1_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
									                                 </script>
									                            </div>

									                            <div class="col-sm-4">
									                                <label for="Image Alt Description" class=" col-form-label">Package Name</label>
									                                <input type="text" id="package_name_1_<?=$v['id']?>" name="package_name_1" value="Classic" class="form-control box_in3 pack_name" >
									                                <div class="form-group boot_sp mt-4">
										                                 <input type="text" id="package_price_1_<?=$v['id']?>" name="package_price_1" value="<?= $v['package_price_1'] ?>" class="form-control box_in3 onlyInteger">
										                                 <label class="form-control-placeholder2" for="package_price_1"><b>Add Your Pricing</b></label>
										                            </div>
									                            </div>
									                        </div>   
									                    </div>
									                    
									                    <div class="dx">
									                    	<div class="row">
									                            <!--<div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
									                                 <textarea  id="package_title_2_<?=$v['id']?>" name="package_title_2" rows="2" class="form-control box_in2"><?= $v['package_title_2'] ?></textarea>
									                                 <?php echo form_error('package_title_2','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_title_2_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
									                                 </script>
									                            </div>-->
									                            <div class="col-sm-8">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
									                                 <textarea  id="package_description_2_<?=$v['id']?>" name="package_description_2" rows="2" class="form-control box_in2"><?= $v['package_description_2'] ?></textarea>
									                                 <?php echo form_error('package_description_2','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_description_2_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} ); 
									                                 </script>
									                            </div>
									                            <div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
									                                 <input type="text" id="package_name_2_<?=$v['id']?>" name="package_name_2" value="Premium" class="form-control box_in3 pack_name" >
									                                 <div class="form-group boot_sp mt-5">
										                                 <input type="text" id="package_price_2_<?=$v['id']?>" name="package_price_2" value="<?= $v['package_price_2'] ?>" class="form-control box_in3 onlyInteger">
										                                 <label class="form-control-placeholder2" for="package_price_2"><b>Add Your Pricing</b></label>
										                              </div>
									                            </div>
									                              
									                        </div>
									                    </div>
									                    
									                    <div class="dx">
									                    	<div class="row">
									                              <!--<div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
									                                 <textarea  id="package_title_3_<?=$v['id']?>" name="package_title_3" rows="2" class="form-control box_in2"><?= $v['package_title_3'] ?></textarea>
									                                 <?php echo form_error('package_title_3','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_title_3_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                 </script>
									                              </div>-->

									                              <div class="col-sm-8">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
									                                 <textarea  id="package_description_3_<?=$v['id']?>" name="package_description_3" rows="2" class="form-control box_in2"><?= $v['package_description_3'] ?></textarea>
									                                 <?php echo form_error('package_description_3','<span class="text-danger mt-1">','</span>') ;?>
									                                 <script> 
									                                    CKEDITOR.replace( 'package_description_3_<?=$v['id']?>',{'height':150,toolbarGroups: [{"groups": ["mode"]}]} );  
									                                 </script>
									                              </div>

									                              <div class="col-sm-4">
									                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
									                                 <input type="text" id="package_name_3_<?=$v['id']?>" name="package_name_3" value="Luxury" class="form-control box_in3 pack_name">
									                                 <div class="form-group boot_sp mt-5">
										                                 <input type="text" id="package_price_3_<?=$v['id']?>" name="package_price_3" value="<?= $v['package_price_3'] ?>" class="form-control box_in3 onlyInteger">
										                                 <label class="form-control-placeholder2" for="package_price_3"><b>Add Your Pricing</b></label>
										                              </div>
									                              </div>
									                            </div>  
									                        </div>
									                	</div>
													</div>
												<div class="row mt-4 justify-content-center">
													<div class="add_my_btc col-sm-3 text-center">
														<input type="submit" value="SUBMIT" class="bkk">
													</div>
												</div>
											</form>
								      	</div>
							    	</div>
							  	</div>
							</div>
						</div>
					<?php } ?>
					

				</div>
			</div>
		</div>
	</div>
</div>



<style type="text/css">
	.portfolio_total {
	    position: absolute;
	    z-index: 9;
	    top: 0px;
	    right: 0px;
	    font-size: 15px!important;
	    padding: 4px 8px;
	    border-radius: 4px;
            z-index:1;
	}
	.add_service_block{
		position: relative;
	}
</style>


<script type="text/javascript">
	

$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<div class='row clc'/>");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("div").remove();
    });
});

function GetDynamicTextBox(value) {

    return '<div class="col-sm-2"><div class="form-group boot_sp"><select type="text" id="fname" name="fname" value="Alemmenla" class="form-control box_in3"><option>Service name</option><option>Wedding Styling</option><option>Personal Styling</option><option>Photoshoot Styling</option><option>Corporate Styling</option><option>Event Styling</option><option>Wardrobe Management</option><option>Personal Shopper</option></select><label class="form-control-placeholder2" for="fname">Service name</label></div></div>' + '<div class="col-sm-3"><div class="form-group boot_sp"><input type="text" id="fname" name="fname" value="" class="form-control box_in3" disabled=""><label class="form-control-placeholder2" for="fname">Service Description</label></div></div>' + '<div class="col-sm-3"><div class="form-group boot_sp"><input type="text" id="fname" name="fname" value="" class="form-control box_in3"  disabled=""><label class="form-control-placeholder2" for="fname">Package Description</label></div></div>' + '<div class="col-sm-2"><div class="form-group boot_sp"><select type="text" id="fname" name="fname" value="" class="form-control box_in3"><option>Select Package</option><option>Classic</option><option>Premium</option><option>Luxury</option></select><label class="form-control-placeholder2" for="fname">Package Name</label></div></div>' + '<div class="col-sm-2"><div class="form-group boot_sp"><input type="text" id="fname" name="fname" value="" class="form-control box_in3"><label class="form-control-placeholder2" for="fname">Package Price</label></div></div><button type="button" class="btn btn-danger remove"><i class="fa fa-times-circle"></i></button>'
}


function deleteService(id,status) {
		var msg = (status=='0')? 'Delete':'Restore';
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Do you want to "+ msg+ ' this?')) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('vendor/deleteOwnService'); ?>", 
              data: {"status":newstatus, "id":id}, 
              success: function(data) {
              	console.log(data)
                location.reload();
              }         
           });
       } else {
           location.reload();
       }
    }
   $('.onlyInteger').on('keypress', function(e) {

      keys = ['0','1','2','3','4','5','6','7','8','9','.']

      return keys.indexOf(event.key) > -1

    }) 
</script>

</body>
</html>
