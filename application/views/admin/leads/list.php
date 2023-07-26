<?php $this->load->view('admin/template/header'); ?>

<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>

<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>

<div class="container-fluid p-0">

   <div class="row">

      <div class="col-md-12">

         <nav aria-label="breadcrumb">

            <ol class="breadcrumb pl-3 mr-3 ">

               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>

               <li class="breadcrumb-item active" aria-current="page"> Leads</li>

            </ol>                                              

         </nav>

      </div>

   </div>

</div>



<div class="my_lead">

	<ul>

		<!-- <li><a href="<?php echo base_url('admin/leads');?>" class="active">New Stylist Leads </a></li> -->

		<!-- <li><a href="<?php echo base_url('admin/leads/allocate');?>">All Leads</a></li> -->



		<li><a href="#" class="btn btn-primary">All Leads</a></li>

		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/check_availability');?>" class="btn btn-dark">Leads from connect with stylist</a></li>
		<?php } ?>
		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/upload',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/leads/upload');?>" class="btn btn-info">Upload lead</a></li>
		<?php } ?>
	</ul>

</div>



<div class="container-fluid p-0">

	<div class="row">

		<div class="col-md-12 mt-3">

		   <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">



	      	<div class="row" style="display: none;"> 



	       	  	<div class="col-sm-3">



	               <div class="form-group">



	                   <label class="control-label" for="sip_code">Whole Record Search</label>



	                   <input type="text" placeholder="Name" name="search_text" class="form-control box3" value="<?=$_GET['search_text']?>">



	               </div>



	           	</div>



	           	<div class="col-sm-3">



	               <div class="form-group">



	                   <label class="control-label" for="sip_code">Status</label>



	                   <select name="status" class="form-control">



	                   	<option value="">Select Status</option>



	                   	<?php $a  = array('1'=>'Active','0'=>'Inactive');?>



	                   	<?php foreach ($a as $key => $value) { if($_GET['status'] && $_GET['status'] == $key){$sel='selected';}else{$sel='';}?>



	                   		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>



	                   	<?php }?>



	                   </select>



	               </div>



	           	</div>

	           	<!-- <div class="col-sm-3">



	               <div class="form-group">



	                   <label class="control-label" for="sip_code">Allocated</label>



	                   <select name="allocated_status" class="form-control">



	                   	<option value="">Select Status</option>



	                   	<?php $a  = array('1'=>'Allocated','0'=>'Unallocated');?>



	                   	<?php foreach ($a as $key => $value) { if($_GET['allocated_status'] && $_GET['allocated_status'] == $key){$sel='selected';}else{$sel='';}?>



	                   		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>



	                   	<?php }?>



	                   </select>



	               </div>



	           	</div> -->



	           	 



	           	<div class="col-sm-2">



	               <div class="form-group">



	                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>



	                   <input type="submit" class="color_white btn btn-md btn-danger" >



	                   <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>



	               </div>



	           	</div>



	         </div>



	      	</form>

	  

			<div class="table-responsive ">

			    <?php if($this->session->flashdata('success')){?>

    			    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>

    			    	<script>

                        /*var timeout = 3000; // in miliseconds (3*1000)

                        $('.flash_message').delay(timeout).fadeOut(300);*/

                  </script>

			    <?php }?>

			    <?php if($this->session->flashdata('error')){?>

                  <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>

                  <script>

                        /*var timeout = 3000; // in miliseconds (3*1000)

                        $('.flash_message').delay(timeout).fadeOut(300);*/

                  </script>

                <?php }?>

				<table class="table table-bordered text-center table-hover shadow-lg" id="example">

					<thead class="text-white bg-primary">

						<tr>

							<th class=''>S. No.</th>

							<th class=''>Stylist Name</th>

							<!-- <th class=''>Allocate Stylist</th> -->

							<th class=''>Client Name </th>

							<th class=''>E-Mail ID</th>

							<th class=''>Phone</th>

							<th class=''>City</th>

							<!-- <th class=''>Date</th> -->

							<!-- <th class=''>Time</th> -->
							
							<th class=''>Status</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/edit',$permission) || in_array('admin/leads/delete',$permission)){ ?>
								<th class=''>Action</th>					
							<?php } ?>
						</tr>

					</thead>

					<tbody class="text-center">

						<?php  if(!empty($list)) { ?>

								<?php $num=1; ?>

								<?php  foreach($list as $row) { ?>

									<?php 

										$style='';

										if($row->allocated_id){

											if($row->allocated_id == $row->stylist_id){

												$style='background:#89710c;color:#fff;';

											}else{

												$style='background:#423f2e;color:#fff;';

											}

										}

									?>

									<tr style="<?=$style;?>">

										<td><?php echo $num; ?></td>						

										<td class='text-left'><?php echo ucwords($row->stylist_name); ?></td>

										<!-- <td class=''><?php echo ucwords($row->allocated_name); ?></td> -->

										<td class='text-left'><?php echo ucwords($row->fname).' '.ucwords($row->lname); ?></td>

										<td class='text-left'><?php echo $row->email; ?></td>

										<td class=''><?php echo $row->mobile; ?></td>

										<td class=''><?php echo $row->city; ?></td>

										<!-- <td class=''><?php echo $row->availability_date; ?></td>

										<td class=''><?php echo $row->availability_start_time; ?> - <?php echo $row->availability_end_time; ?></td> -->

										<td>

											<?php  $source_from = array('0'=>'Not Contacted','1'=>'Contacted lead','2'=>'Lead Interested','3'=>'Lead Converted','4'=>'Junk Lead','5'=>'Lead not Interested','6'=>'Cancelled');?>

											<?php 	foreach ($source_from as $key => $value) {  ?>

												<?php 	if($key == $row->status){ ?>

														<button type="button" class="btn btn-sm  btn-success "><?=$value?></button>

												<?php 	}?>

											<?php 	}?>

				                                  

				                             

										</td>
										<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/edit',$permission) || in_array('admin/leads/delete',$permission)){ ?>
										<td class=''>
											<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/edit',$permission)){ ?>
									   		<a class="btn btn-primary"  href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
									   	<?php } ?>
											<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/delete',$permission)){ ?>
									   		<a class="btn btn-danger"  href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a>
									   	<?php } ?>
										</td>
										<?php } ?>
									</tr>

							   	<?php $num++; ?>

						   	<?php } ?>

							<?php } else { ?>

						   	<tr><td colspan="4" class="text-center">Result Not Available</td></tr>

						<?php } ?>

					</tbody>

				</table>

			</div>

		</div>

	</div>

</div>

<script>

    $(document).ready(function(){

        $('#example').DataTable();    

    $(document).on('click','.status_checks',function() {

        var id = (this.id);

        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 

        var msg = (status=='0')? 'Activate':'Deactivate';

        var newstatus = (status=='0')? '1':'0';

         if(confirm("Are you sure to "+ msg)) {

                  $.ajax({

                  type:"POST",

                  url: "<?= base_url('admin/looking-stylist_status'); ?>", 

                  data: {"status":newstatus, "id":id}, 

                  success: function(data) {

                  location.reload();

                  }         

             });

         }

      });    

    });

</script>

<?php $this->load->view('admin/template/footer'); ?>