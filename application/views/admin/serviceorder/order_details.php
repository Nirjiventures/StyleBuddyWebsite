<?php 

$url1 = $this->uri->segment(1);

$url2 = $this->uri->segment(2);

$url3 = $this->uri->segment(3);





?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
  <main class="main-content">

    

    <!--== Start Contact Area ==-->

    <section class="user-area">



      <div class="container-fluid">

        <div class="">

          <h3 class="uk_title">Order Summary</h3>

		  

				  <div class="summery_order">

				            

							<div class="row">

								<div class="col-sm-9">

									<p><b>Order ID : #<?= (!empty($order->id))? $order->id:'' ?> | </b>Payment Status: <span class="approved"><?= (!empty($order->payment_status))? ucwords($order->payment_status):'' ?></span>  | Status: <span class="approved"><?= (!empty($order->order_status))? ucwords($order->order_status):'' ?></span>  |  Order Date : <?= date('d F Y',strtotime($order->created_at)); ?></p>

								</div>

								

								<div class="col-sm-3 text-center">

									<p><a href="<?= base_url($url1.'/'.$url2) ?>" class="btn btn-secondary"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a></p>

								</div>

							</div>

							<hr>

							<div class="row">		

								<div class="col-md-12 jk">	

								<span class="text-center mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

									<?=$result;?>

								</div>

							</div>

							<div class="">
								<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
								<form method="post">

									<div class="row">

										<div class="col-md-12 ">

											<?php echo $this->session->flashdata('success');?>

										</div>

									</div>

									<div class="row">

										<div class="col-md-6 ">

											<div class="form-group boot_sp">

											    <label class="form-control-placeholder2" for="payment_status">Payment Status</label>

										    	<?php if(('APPROVED' != strtoupper($order->payment_status))){?>

													<select id="payment_status" name="payment_status" class="form-control box_in3">

														<?php foreach($payment_status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order->payment_status)){$sel = 'selected';}else{$sel = '';}?>

															<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

														<?php } ?>

													</select>

												<?php }else{?>

													<input type="text" value="<?php if(set_value('payment_status')){echo set_value('payment_status');}else{echo (!empty($order->payment_status))?$order->payment_status:'';}?>" class="form-control box_in3" required>

												<?php }?>

											</div>

										</div>

										

										<div class="col-md-6">

										    <div class="form-group boot_sp">

											    <label class="form-control-placeholder2" for="order_status">Order Status</label>

										    	<?php if('COMPLETED' != strtoupper($order->order_status)){?>

													<select id="order_status" name="order_status" class="form-control box_in3">

														<?php foreach($status_list as $value){ if(strtoupper($value->status_name) == strtoupper($order->order_status)){$sel = 'selected';}else{$sel = '';}?>

															<?php if(strtoupper($value->status_name) != 'COMPLETED'){ ?>

																<option value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

															<?php }else{ ?>

																<?php if(('APPROVED' == strtoupper($order->payment_status))){ $style=""; }else{$style = 'display:none';}?>

																	<option id="<?=strtoupper($value->status_name)?>" style="<?=$style?>" value="<?=$value->status_name?>" <?=$sel?>><?=$value->status_name?></option>

																

															<?php } ?>

														<?php } ?>

													</select>

												<?php }else{?>

													<input type="text" value="<?php if(set_value('order_status')){echo set_value('order_status');}else{echo (!empty($order->order_status))?$order->order_status:'';}?>" class="form-control box_in3" required>

												<?php }?>

											</div>

										</div>

										<div class="col-md-12 text-center">	 

											<?php  if(strtoupper($order->order_status) != 'COMPLETED'){?>

												<button type="submit" class="btn btn-primary">Submit</button>

											<?php  }?>

										

										</div>

									</div>

								</form>
								<?php } ?>
							</div>

					

				  </div>

					

					

        </div>

	    </div>

	  </section>

    <!--== End Contact Area ==-->



  

  

  </main>



  <!--== Start Footer Area Wrapper ==-->

