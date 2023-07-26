<?php $url1 = $this->uri->segment(1);?>

<?php $url2 = $this->uri->segment(2);?>

<?php $url3 = $this->uri->segment(3);?>

<div class="container-fluid p-0">



   <div class="row">



      <div class="col-md-12">



         <nav aria-label="breadcrumb">



            <ol class="breadcrumb pl-3 mr-3 ">



               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>



               <li class="breadcrumb-item active" aria-current="page">User order</li>



            </ol>



         </nav>



      </div>



   </div>



</div>



<div class="container">



	<div class="row">



		<div class="col-md-12 mt-5">



		    <div id="message" class="text-primary text-center"></div>

            <div class="row p-0">

				<div class="col-md-10">

					<form  name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">

    			      	<div class="row">

    			      		<?php $aaa = array('2'=>'Stylist','3'=>'User','6'=>'Corporate User');?>

    							<div class="col-sm-3">

    								<label class="control-label" for="sip_code">Select User</label>

    								<select class="form-control" name="user_type" id="user_type" >

    									<option  value="">Select User</option>

    									<?php if($aaa) { foreach($aaa as $key=>$value) { ?>

    										<?php 

    										if($_GET['user_type'] && $_GET['user_type'] == $key){$sel='selected';}else{$sel='';}

    										?>

    										<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

    									<?php } } ?>

    								</select>

    								<?php echo form_error('user_type','<span class="text-primary mt-1">','</span>') ;?>

    								<div id="gender_err"></div>

    							</div>

    							<?php  if ($_GET['user_type']) { ?>

    				           	<?php  if (count($corporate_company)>1) { ?>

    				           	  	<div class="col-sm-4">

    					                  <label class="form-label">Corporate Company</label>

    						               <select class="form-control" name="corporate_company_id" id="corporate_company_id">

    						                  <option value="">Select Corporate Company</option>

    						                  <?php foreach ($corporate_company as $key => $value): ?>

    						                     <?php if($value->id == $_GET['corporate_company_id']){$sel='selected';}else{$sel='';} ?> 

    						                     <option value="<?=$value->id?>" <?=$sel?>><?=$value->name?></option>

    						                  <?php endforeach ?> 

    						               </select>

    					           	</div>

    				           	<?php  }?>

    				        	<?php  }?>

    				        	<?php  if ($_GET['corporate_company_id']) { ?>

    				           	<?php  if (count($corporate_domain)>1) { ?>

    				           	  	<div class="col-sm-3">

    					                  <label for="Image Alt Description" class="form-label">Domain Name <span class="text-danger">*</span></label>

    						               <select class="form-control" name="domain_id" id="domain_id">

    						                  <option value="">Select Domain</option>

    						                  <?php foreach ($corporate_domain as $key => $value): ?>

    						                     <?php if($value->corporate_company_id == $_GET['corporate_company_id']){  ?> 

    						                     <?php if($value->id == $_GET['domain_id']){$sel='selected';}else{$sel='';} ?> 

    						                         <option value="<?=$value->id?>" <?=$sel?>><?=$value->domain_name?></option>

    						                   	<?php } ?> 

    						                  <?php endforeach ?> 

    						               </select>

    					           	</div>

    				           	<?php  }?>

    			           	<?php  }?>

    			           	

    			           	<div class="col-sm-3">

			                  <label class="control-label" for="sip_code">Styling report status</label>

			                  <select name="report_status" class="form-control">

			                   	<option value="">Select Status</option>

			                   	<?php $a  = array('1'=>'Sent','0'=>'Not Sent');?>

			                   	<?php foreach ($a as $key => $value) { if($_GET['report_status'] == (string)$key){$sel='selected';}else{$sel='';}?>

			                   		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

			                   	<?php }?>

			                  </select>

			           		</div>

			           		<div class="col-sm-3">

			                  <label class="control-label" for="sip_code">Package Name</label>

			                  <select name="service_id" class="form-control">

			                   	<option value="">Select Package</option>

			                   	<?php foreach ($our_services as $key => $value) { ?>

			                   		<?php if($_GET['service_id'] == $value->title){$sel='selected';}else{$sel='';}?>

			                   		<option value="<?=$value->title?>" <?=$sel?>><?=$value->title?></option>

										<?php }?>

			                  </select>

			           		</div>

			           		

			           		<div class="col-sm-3">

			                  <label class="control-label" for="sip_code">Date</label>

			                  <input type="date" name="created_at" class="form-control" value="<?php if($_GET['created_at']){echo date('Y-m-d',strtotime($_GET['created_at']));} ?>">

			               </div>

    						<div class="col-sm-12"></div>

    		           	    <div class="col-sm-3">

    		                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>

    		                   <input type="submit" class="color_white btn btn-md btn-danger" >

    		                   <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>

    		            	</div>

    			         </div>

			        </form>

		        </div>

		        <div class="col-md-2">

		      	    <form id="per_page" name="per_page" action="<?=base_url($url1.'/'.$url2.'/')?>">

		      		    <div class="col-sm-12">

							<label class="control-label" for="sip_code">Leads Per page</label>

							<select class="form-control" name="per_page" id="per_page" onChange="form.submit()">

								<option  value="">Per page</option>

								<?php $aaa = array('5'=>'5','10'=>'10','20'=>'20','30'=>'30','50'=>'50');?>

								<?php if($aaa) { foreach($aaa as $key=>$value) { ?>

									<?php 

									if($_GET['per_page'] && $_GET['per_page'] == $key){$sel='selected';}else{$sel='';}

									?>

									<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

								<?php } } ?>

							</select>

							<?php echo form_error('user_type','<span class="text-primary mt-1">','</span>') ;?>

							<div id="gender_err"></div>

						</div>

		      	    </form>

		        </div>

	        </div>

    		<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		



			<div class="table-responsive" >

				<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">

						<thead>

							<tr>

								<th class="no">No</th>

								<th class="no">Order ID</th>

								<th class="name">Customer Name</th>

								<th class="name">Service Type</th>

								<th class="date">Date</th>

								<!--<th class="status">Transaction  ID</th>-->

								<th class="status">Styling Report Status</th>

								<th class="total">Total  Amount</th>

								<!--<th class="action">Status</th>-->

								<th class="action">Details</th>

								<!--<th class="action">Action</th>-->

							</tr>

						</thead>

						<tbody>

							<?php $num = $start_limit + 1; if(!empty($datas)) { foreach($datas as $value) { //var_dump($value); ?>

							<?php $date = strtotime($value->created_at); $fdate = date('d M, Y h:i:s A',$date);  ?>

								<tr>

								   <td><?= $num ?></td>

								   <td><?= ($value->order_id)?$value->order_id:$value->orderId ?></td>

                           <td><?= ucwords($value->user_row->fname.' '.$value->user_row->lname);?></td>

									<td><?= ($value->productName);  ?></td>

									<td><?= $fdate ?></td>

									<!--<td><?= $value->txn_id ?></td>-->

									<td class="hold"><?= ($value->report_status)?'Sent ':'Not Sent '; ?></td>

									<td>
										<?php if($value->totalMrpPrice > $value->totalPrice){ ?>
											<span style="text-decoration-line: line-through;">&#8377; <?= number_format($value->totalMrpPrice) ?></span> 
										<?php } ?>
										<?php 
           									if ($value->coupon_id) {
           										$totalPrice = $value->totalPrice - $value->coupon_value;
           									}else{
           										$totalPrice = $value->totalPrice;
           									}
           									echo '&#8377;'. number_format($totalPrice);
       								?>
									</td>

									<!--<td><?= $value->order_status ?></td>-->

									<td><a href="<?= base_url('admin/packagePurchasedUsers/userOrderDetails/').$value->id ?>" class="btn btn-success">View</a></td>

								</tr>

								<?php $num++; }} else {?>

								    <tr>

								        <td colspan="9" class="text-center"><h6>Order is not available</h6></td>

								    </tr>

								<?php }?>

						</tbody>

				</table>

				<?php 

					if($numRows){

						$start_limit = $start_limit + 1;

					}else{

						$start_limit = $start_limit;

					}

				?>

				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit) .'-'.$end_limit.' of '.$numRows?></p>



				<div class="pagination" style="float:right">



				    <?=$links;?>



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



                  url: "<?= base_url('admin/update_fashion_services_status'); ?>", 



                  data: {"status":newstatus, "id":id}, 



                  success: function(data) {



                  location.reload();



                  }         



             });



         }

   	});    

   });

</script>