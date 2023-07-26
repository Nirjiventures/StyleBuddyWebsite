<?php $this->load->view('front/vandor/header'); ?>
<?php $seg1 = $this->uri->segment(1); ?>
<?php $seg2 = $this->uri->segment(2); ?>
<?php $seg3 = $this->uri->segment(3); ?>

<div class="main">
	<div class="container">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
				<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
			 
		</div>-->


		<div class="manage_w">
			<div class="rightbar">


				<div class="container p-0">
					<div class="row">
						<div class="col-sm-6">
							<h3>Add a New Service</h3></div>

							<div class="col-sm-6 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/addaservices')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				<div class="add_service_list">
					<div id="success_message"></div>
		            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
		            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
		            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
		               <div class="row">
		                  <input type="hidden" name="id" value="<?= $record_detail->id; ?>">
		                  <!-- <div class="col-md-12"> <br/> </div> -->
		                  <div class="col-md-12 mb-4">
		                     <label for="Image Alt Description" class="form-label">Service Name<span class="text-danger"></span></label>
		                     <input required type="text" id="area_expertise_name" name="area_expertise_name" value="<?= $record_detail->area_expertise_name ?>" class="form-control box_in3 " >
		                  </div> 
		                  
		                  	<!-- <div class="col-sm-12">
		                  		<br>
			        			<p><b>Package Feature</b></p>
			        			<table class="table table table-bordered"  id="list">
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
										<?php for ($i=0; $i < 6 ; $i++) {  ?>
											<tr  id="<?=$i?>">
												<td><input type="text" name="first_col[]" value="" class="form-control box_in3" required></td>
												<td><input type="text" name="second_col[]" value="" class="form-control box_in3" required></td>
												<td><input type="text" name="third_col[]" value="" class="form-control box_in3" required></td>
												<td><input type="text" name="fourth_col[]" value="" class="form-control box_in3" required></td>
												<td class="action"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute(<?=$i?>);return false;"><i class="fa fa-times red"></i></a></span></td>
											</tr>
										<?php }  ?>
									</tbody>
								</table>

							</div>
							<div class="col-sm-12  text-end">
					        	<div class="re_up_video">
							        <a class="btn btn-danger" onclick="addRow()"> <i class="fa fa-plus"></i> Add</a>
							    </div>
						    </div> -->
		                  	<div class="col-sm-12">
		                  		<div class="dx">
			                     	<div class="row">
		                              	<!--<div class="col-sm-4">
			                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
			                                 <textarea id="package_title_1" name="package_title_1" rows="2" class="form-control"><?= $record_detail->package_title_1 ?></textarea>
			                                 <?php echo form_error('package_title_1','<span class="text-danger mt-1">','</span>') ;?>
			                                 <script> 
			                                    CKEDITOR.replace( 'package_title_1',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
			                                         },]} ); 
			                                 </script>
		                              	</div>-->

			                            <div class="col-sm-8">
			                                <label for="Image Alt Description" class=" col-form-label">Package Description</label>
			                                <textarea id="package_description_1" name="package_description_1" rows="2" class="form-control"><?= $record_detail->package_description_1 ?></textarea>
			                                 <?php echo form_error('package_description_1','<span class="text-danger mt-1">','</span>') ;?>
			                                <script> 
			                                    CKEDITOR.replace( 'package_description_1',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
			                                         },]} ); 
			                                </script>
			                            </div>

			                            <div class="col-sm-4">
			                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
			                                 <input type="text" id="package_name_1" name="package_name_1" value="Classic" class="form-control box_in3 pack_name" readonly>
			                              	<div class="form-group boot_sp mt-4">
				                                <input type="text" id="package_price_1" name="package_price_1" value="<?= $record_detail->package_price_1 ?>" class="form-control box_in3">
				                                <label class="form-control-placeholder2" for="package_price_1"><b>Add Your Pricing</b></label>
			                              	</div>
			                            </div>
			                       </div>
		                  		</div>
		                    	<div class="dx">
			                    	<div class="row">
		                              <!--<div class="col-sm-4">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
		                                 <textarea id="package_title_2" name="package_title_2" rows="2" class="form-control"><?= $record_detail->package_title_2 ?></textarea>
		                                 <?php echo form_error('package_title_2','<span class="text-danger mt-1">','</span>') ;?>
		                                 <script> 
		                                    CKEDITOR.replace( 'package_title_2',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
		                                         },]} ); 
		                                 </script>
		                              </div>-->
		                              <div class="col-sm-8">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
		                                 <textarea id="package_description_2" name="package_description_2" rows="2" class="form-control"><?= $record_detail->package_description_2 ?></textarea>
		                                 <?php echo form_error('package_description_2','<span class="text-danger mt-1">','</span>') ;?>
		                                 <script> 
		                                    CKEDITOR.replace( 'package_description_2',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
		                                         },]} ); 
		                                 </script>
		                              </div>

		                              <div class="col-sm-4">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
		                                 <input type="text" id="package_name_2" name="package_name_2" value="Premium" class="form-control box_in3 pack_name" readonly>
		                                 <div class="form-group boot_sp mt-4">
			                                 <input type="text" id="package_price_2" name="package_price_2" value="<?= $record_detail->package_price_2 ?>" class="form-control box_in3">
			                                 <label class="form-control-placeholder2" for="package_price_2"><b>Add Your Pricing</b></label>
			                              </div>
		                              </div>
		                              
		                        	</div>
		                        </div> 
		                        <div class="dx">
			                    	<div class="row">
		                              	<!--<div class="col-sm-4">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Title</label>
		                                 <textarea id="package_title_3" name="package_title_3" rows="2" class="form-control"><?= $record_detail->package_title_3 ?></textarea>
		                                 <?php echo form_error('package_title_3','<span class="text-danger mt-1">','</span>') ;?>
		                                 <script> 
		                                    CKEDITOR.replace( 'package_title_3',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
		                                         },]} ); 
		                                 </script>
		                              	</div>-->
		                              	<div class="col-sm-8">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
		                                 <textarea id="package_description_3" name="package_description_3" rows="2" class="form-control"><?= $record_detail->package_description_1 ?></textarea>
		                                 <?php echo form_error('package_description_3','<span class="text-danger mt-1">','</span>') ;?>
		                                 <script> 
		                                    CKEDITOR.replace( 'package_description_3',{'height':120,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
		                                         },]} ); 
		                                 </script>
		                              	</div>
		                              	<div class="col-sm-4">
		                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
		                                 <input type="text" id="package_name_3" name="package_name_3" value="Luxury" class="form-control box_in3 pack_name" readonly>
		                                 <div class="form-group boot_sp mt-4">
			                                 <input type="text" id="package_price_3" name="package_price_3" value="<?= $record_detail->package_price_3 ?>" class="form-control box_in3">
			                                 <label class="form-control-placeholder2" for="package_price_3"><b>Add Your Pricing</b></label>
			                              </div>
		                              	</div>
		                            </div>
		                        </div>  

		                  	</div>

		                   
		               	</div>
		                <div class="row m-0 justify-content-center mt-4">
							<div class="add_my_btc col-sm-12 text-center">
								<input type="submit" value="SUBMIT" class="btc">
							</div>
						</div>
		            <?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
		function addRow(id=0){
			var id  = id;
	        var rowCount = $('#list tr').length;
	        console.log(id);
	        console.log(rowCount);
	        data  = addSlots(id,rowCount);
	        $("#list").append(data);
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

$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<tr/>");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("tr").remove();
    });
});
function GetDynamicTextBox(value) {
    return '<td><input type="text" name="f1" value="" class="form-control box_in3"></td>' + '<td><input type="text" name="c1" value="" class="form-control box_in3"></td>' + '<td><input type="text" name="p1" value="" class="form-control box_in3"></td>' + '<td><input type="text" name="L1" value="" class="form-control box_in3"></td>' + '<td><button type="button" class="btn btn-danger remove"><i class="fa fa-times-circle"></i></button></td>'
}
$('.onlyInteger').on('keypress', function(e) {

      keys = ['0','1','2','3','4','5','6','7','8','9','.']

      return keys.indexOf(event.key) > -1

    })
</script>

</body>
</html>



