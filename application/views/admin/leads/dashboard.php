<?php $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>

<div class="container_1">
	<div class="row">
		<div class="col-md-12 mt-5">
		    
  			<ul class="nav nav-tabs new_action" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Stylist Leads </a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Stylist Allocate Leads </a>
			  </li>
			 
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div role="tabpanel" class="tab-pane  in active" id="profile">
			  	
			  	<div class="table-responsive mt-3">
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
							<th class=''>Sl No.</th>
							<th class=''>Stylist</th>
							<!-- <th class=''>Allocate Stylist</th> -->
							<th class=''>Name</th>
							<th class=''>Email</th>
							<th class=''>Phone</th>
							<th class=''>City</th>
							<th class=''>Date</th>
							<th class=''>Time</th>
							<th class=''>Status</th>
							<th class=''>Action</th>					
						</tr>
					</thead>
					<tbody class="text-left">
						<?php  if(!empty($list)) { ?>
								<?php $num=1; ?>
								<?php  foreach($list as $row) { ?>
									<?php 
										$style='';
										if($row->allocated_id){
											if($row->allocated_id == $row->stylist_id){
												$style='background:#89710c;color:#ffff;';
											}else{
												$style='background:#423f2e;color:#ffff;';
											}
										}
									?>
									<tr style="<?=$style;?>">
										<td class='text-primary'><?php echo $num; ?></td>						
										<td class=''><?php echo ucwords($row->stylist_name); ?></td>
										<!-- <td class=''><?php echo ucwords($row->allocated_name); ?></td> -->
										<td class=''><?php echo ucwords($row->fname).' '.ucwords($row->lname); ?></td>
										<td class=''><?php echo $row->email; ?></td>
										<td class=''><?php echo $row->mobile; ?></td>
										<td class=''><?php echo $row->city; ?></td>
										<td class=''><?php echo $row->availability_date; ?></td>
										<td class=''><?php echo $row->availability_start_time; ?> - <?php echo $row->availability_end_time; ?></td>
										<td>
											<?php if($row->status == 1){  ?>
												<button type="button" class="btn btn-sm mt-1 btn-success ">Completed</button>
											<?php }else{ ?>
												<button type="button" class="btn btn-sm mt-1 btn-primary ">Pending</button>
											<?php } ?>
										</td>
										<td class=''>
									   	<a href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
									   	<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
										</td>
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
				  <div role="tabpanel" class="tab-pane " id="buzz">
				  	

				  	<div class="col-md-12 mt-3">

			   			<form name="frm" action="<?=base_url($url1.'/'.$url2.'/'.$url3)?>">

	      					<div class="row"> 

					       	  	<div class="col-sm-3">

					               <div class="form-group">

					                   <label class="control-label" for="sip_code">Whole Record Search</label>

					                   <input type="text" placeholder="Stylist Name" name="search_text" class="form-control box3" value="<?=$_GET['search_text']?>">

					               </div>

					           	</div>

					           	<div class="col-sm-3">

					               <div class="form-group">

					                   <label class="control-label" for="sip_code">Status</label>

					                   <select name="status" class="form-control">

					                   	<option value="">Select Status</option>

					                   	<?php $a  = array('1'=>'Completed','0'=>'Pending');?>

					                   	<?php foreach ($a as $key => $value) { if($_GET['status'] && $_GET['status'] == $key){$sel='selected';}else{$sel='';}?>

					                   		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

					                   	<?php }?>

					                   </select>

					               </div>

					           	</div>
					           	 

					           	<div class="col-sm-3">

					               <div class="form-group">

					                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>

					                   <input type="submit" class="color_white btn btn-md btn-danger" >

					                   <a href="<?=base_url($url1.'/'.$url2.'/'.$url3)?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>

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
										<th class=''>Sl No.</th>
										<!-- <th class=''>Stylist</th> -->
										<th class=''>Allocate Stylist</th>
										<th class=''>Name</th>
										<th class=''>Email</th>
										<th class=''>Phone</th>
										<th class=''>City</th>
										<th class=''>Date</th>
										<th class=''>Time</th>
										<th class=''>Status</th>
										<th class=''>Action</th>					
									</tr>
								</thead>
								<tbody class="text-left">
									<?php  if(!empty($allocated_list)) { ?>
											<?php $num=1; ?>
											<?php  foreach($allocated_list as $row) { ?>
												<?php 
													$style='';
													if($row->allocated_id){
														if($row->allocated_id == $row->stylist_id){
															$style='background:#89710c;color:#ffff;';
														}else{
															$style='background:#423f2e;color:#ffff;';
														}
													}
												?>
												<tr style="<?=$style;?>">
													<td class='text-primary'><?php echo $num; ?></td>						
													<!-- <td class=''><?php echo ucwords($row->stylist_name); ?></td> -->
													<td class=''><?php echo ucwords($row->allocated_name); ?></td>
													<td class=''><?php echo ucwords($row->fname).' '.ucwords($row->lname); ?></td>
													<td class=''><?php echo $row->email; ?></td>
													<td class=''><?php echo $row->mobile; ?></td>
													<td class=''><?php echo $row->city; ?></td>
													<td class=''><?php echo $row->availability_date; ?></td>
													<td class=''><?php echo $row->availability_start_time; ?> - <?php echo $row->availability_end_time; ?></td>
													<td>
														<?php if($row->status == 1){  ?>
															<button type="button" class="btn btn-sm mt-1 btn-success ">Completed</button>
														<?php }else{ ?>
															<button type="button" class="btn btn-sm mt-1 btn-primary ">Pending</button>
														<?php } ?>
													</td>
													<td class=''>
												   		<a href="<?php echo base_url($url1.'/'.$url2.'/allocate_edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
												   		<a href="<?php echo base_url($url1.'/'.$url2.'/allocate_delete/').$row->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
													</td>
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
						 
		</div>
	</div>
</div> 
<?php $this->load->view('admin/template/footer'); ?>


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