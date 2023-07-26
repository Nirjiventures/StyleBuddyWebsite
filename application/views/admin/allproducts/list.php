



<?php $url1  =$this->uri->segment(1);?>







<?php $url2  =$this->uri->segment(2);?>







<?php $url3  =$this->uri->segment(3);?>




<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>


<div class="card-content collapse show">



	<div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">







	    <?php if($this->session->flashdata('success')){?>







		    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>







		    	 



	    <?php }?>







	    <?php if($this->session->flashdata('error')){?>







          <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>







          







        <?php }?>



        <div class="row">







      	    <div class="col-sm-6">







				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>







			</div>







			<div class="col-sm-6">







				 







	      	<a href="<?= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>







	      </div>







		</div>



         <div class="row">

					<?php 	if(count($parent_category)){ ?>

						<div class="col-sm-3">

							<form name="frm" action="<?= base_url($url1.'/'.$url2.'/index');?>">

							<label class="" for="sip_code">Main Category</label>

							<select class="form-control" onchange="frm.submit()" name="category">

								<option value="">Select All </option>

								<?php  foreach($parent_category as $k=>$v){  if($v['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

										<option value="<?=$v['id']?>" <?= $sel?>> <?=$v['name']?> </option>

										<?php foreach($v['child'] as $v1){ ?><?php if($v1['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

											<option value="<?=$v1['id']?>" <?= $sel?>>- <?=$v1['name']?> </option>

											<?php foreach($v1['child'] as $v2){ ?><?php if($v2['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

												<option value="<?=$v2['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;-- <?=$v2['name']?> </option>

												<?php foreach($v2['child'] as $v3){ ?><?php if($v3['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

													<option value="<?=$v3['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v3['name']?> </option>

													<?php foreach($v3['child'] as $v4){ ?><?php if($v4['id']==$_GET['category']){$sel = 'selected';}else{$sel = '';}?>

														<option value="<?=$v4['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v4['name']?> </option>

													<?php } ?>

												<?php } ?>

											<?php } ?>

										<?php } ?>

								<?php } ?>

							</select>

							</form>

						</div>

					<?php } ?>

					<?php 	if(count($parent_sub_category)){ ?>

						<div class="col-sm-3">

							<form name="frm1" action="<?= base_url($url1.'/'.$url2.'/index');?>">

							<input type="hidden" name="category" value="<?=$_GET['category']?>">

							<label class="" for="sip_code">Sub Category</label>

							<select class="form-control" onchange="frm1.submit()" name="sub_category">

								<option value="">Select All </option>

								<?php  foreach($parent_sub_category as $k=>$v){  if($v['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

										<option value="<?=$v['id']?>" <?= $sel?>> <?=$v['name']?> </option>

										<?php foreach($v['child'] as $v1){ ?><?php if($v1['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

											<option value="<?=$v1['id']?>" <?= $sel?>>- <?=$v1['name']?> </option>

											<?php foreach($v1['child'] as $v2){ ?><?php if($v2['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

												<option value="<?=$v2['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;-- <?=$v2['name']?> </option>

												<?php foreach($v2['child'] as $v3){ ?><?php if($v3['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

													<option value="<?=$v3['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v3['name']?> </option>

													<?php foreach($v3['child'] as $v4){ ?><?php if($v4['id']==$_GET['sub_category']){$sel = 'selected';}else{$sel = '';}?>

														<option value="<?=$v4['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v4['name']?> </option>

													<?php } ?>

												<?php } ?>

											<?php } ?>

										<?php } ?>

								<?php } ?>

							</select>

							</form>

						</div>

					<?php } ?>

				</div>



		<div class="row">



                



	    	<div class="col-sm-12">







    			<div class="table-responsive ">



    				<?php //var_dump($list);?>



    			    <table id="table" class="table table-striped table-bordered file-export" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">







    					<thead class="text-white bg-primary">







    						<tr>







        						<th class=''>S. No.</th>







        						<th class=''>Vendor Name</th>







        						<th class=''>Category</th>







        						<th class=''>Product Name</th>







        						 



        						<th class=''>Image</th>







        						<th class=''>Price</th>







        						<th class=''>Discount (%)</th>







        						<th class=''>Added On</th>







        						<th class=''>Size</th>







        						<th class=''>Status</th>







        						







        					</tr>







    					</thead>







    					<tbody>







    						<?php  if(!empty($list)) { ?>







    								<?php $num=$start_limit+1; ?>







    								<?php  foreach($list as $data) { ?>







    									<tr>







                    						<td class='text-primary'><?=  $num; ?></td>						







                    						<td class=''><?= ucwords($data->fname.' '.$data->lname); ?></td>







                    					    <td class=''><?= $data->category_name; ?></td>







                    					    <td class=''><p class="pc_name"><?= $data->product_name; ?></p></td>



                                            <td class=''>



												<?php  $img = image_exist($data->image,'assets/images/product/'); ?>



					                  			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>"  class="img-thumbnail" style="width:40px; height:40px;">







											</td>



                    					     







                    					     







                    					    <td class=''><i class="fa fa-inr"></i>  <?= $data->price; ?></td>







                    					    <td class=''><?= $data->discount; ?></td>







                    					    <td class=''><?= date('j F, Y',strtotime($data->created_at)); ?></td>







                    					    <td class=''>







                    					        <?php $values = ""; $arrayVal = explode(',',$data->size); foreach ($sizes as $size) {  ?>







                    					        <?php if( in_array($size->id , $arrayVal)) {  $values .= ", $size->size_name"; } ?>







                    					        <?php } ?>







                    					        <?= substr($values,1); ?>







                    					    </td>






                    					    <?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
							                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->admin_status == 1)?"btn-primary":"btn-danger"; ?> ">
							                          <?= ($data->admin_status == 1)?"Activated":"De-activated"; ?>
							                          </button>
							                  </td>

                    					      

                    					</tr>







    							   	<?php $num++; ?>







    						   	<?php } ?>







    							<?php } else { ?>







    						   	<tr><td colspan="10" class="text-center">Result Not Available</td></tr>







    						<?php } ?>







    					</tbody>







    				</table>



                    <div class="row">



                        <div class="col-sm-6">



            				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>



            			</div>



            			<div class="col-sm-6">



            				<div class="pagination" style="float:right">



            					<?=$links;?>



            				</div>



            			</div>



            		</div>



				</div>







		    </div>







		</div>



	</div>



</div>



 



<script>



     $(document).ready(function(){







        $(document).on('click','.status_checks',function() {







            var id = (this.id);







            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 







            var msg = (status=='0')? 'Activate':'Deactivate';







            var newstatus = (status=='0')? '1':'0';







            if(confirm("Are you sure to "+ msg)) {







                $.ajax({







                    type:"POST",







                    url: "<?= base_url('admin/vender/productStatusUpdate'); ?>", 







                    data: {"status":newstatus, "id":id}, 







                    success: function(data) {







                          console.log(data);







                          location.reload();







                    }         







                });







            }







        });   







    });



</script>