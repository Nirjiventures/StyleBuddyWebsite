<?php $this->load->view('admin/template/header'); ?>
<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
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
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Our Services Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
			<form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">
	      	<div class="row"> 

	       	  	<div class="col-sm-3">
	                  <label for="Image Alt Description" class="form-label">Company Name <span class="text-danger">*</span></label>
		               <select class="form-control" name="corporate_company_id" id="corporate_company_id">
		                   <option value="">---- Select Company ----</option>
		                   <?php foreach ($corporate_company as $key => $value): ?>
		                      <?php if($value->id == $_GET['corporate_company_id']){$sel='selected';}else{$sel='';} ?> 
		                         <option value="<?=$value->id?>" <?=$sel?>><?=$value->name?></option>
		                   <?php endforeach ?> 
		               </select>
	           	</div>
	           	<?php  if ($_GET['corporate_company_id']) { ?>
		           	<?php  if (count($corporate_domain)>1) { ?>
		           	  	<!-- <div class="col-sm-3">
			                  <label for="Image Alt Description" class="form-label">Domain Name <span class="text-danger">*</span></label>
				               <select class="form-control" name="domain_id" id="domain_id">
				                  <option value="">---- Select Domain ----</option>
				                  <?php foreach ($corporate_domain as $key => $value): ?>
				                     <?php if($value->corporate_company_id == $_GET['corporate_company_id']){  ?> 
				                     <?php if($value->id == $_GET['domain_id']){$sel='selected';}else{$sel='';} ?> 
				                         <option value="<?=$value->id?>" <?=$sel?>><?=$value->domain_name?></option>
				                   	<?php } ?> 
				                  <?php endforeach ?> 
				               </select>
			           	</div> -->
		           	<?php  }?>
	           	<?php  }?>
	           	<div class="col-sm-12"></div>
	           	<div class="col-sm-3">
	               <div class="form-group">
							<div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>
							<input type="submit" class="color_white btn btn-md btn-danger" >
							<a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>
	               </div>

	           	</div>
	         </div>
	      </form>
			<!-- <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">
	      	<div class="row"> 

	       	  	<div class="col-sm-3">

	               <div class="form-group">

	                  <label for="Image Alt Description" class="form-label">Domain Name <span class="text-danger">*</span></label>
		               <select class="form-control" name="domain_id" id="domain_id" required>
		                   <option value="">---- Select Domain ----</option>
		                   <?php foreach ($corporate_domain as $key => $value): ?>
		                      <?php if($value->id == $_GET['domain_id']){$sel='selected';}else{$sel='';} ?> 
		                         <option value="<?=$value->id?>" <?=$sel?>><?=$value->domain_name?></option>
		                   <?php endforeach ?> 
		               </select>

	               </div>

	           	</div>

	           	 
	           	 
	           	<div class="col-sm-3">

	               <div class="form-group">

	                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>

	                   <input type="submit" class="color_white btn btn-md btn-danger" >

	                   <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>

	               </div>

	           	</div>
	         </div>
	      </form> -->
		   <div id="message" class="text-primary text-center"></div>
		   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/add',$permission)){ ?>
				<a href="<?php echo base_url($url1.'/'.$url2.'/add'.'?' . http_build_query($_GET, '', "&")) ;?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i> Add New Service </a>
			<?php } ?>
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
         <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>

			<div class="table-responsive ">
				<table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th class=''>S. No.</th>
							<th class=''>Service Name</th>
							<th class=''>Page Url</th>
							<th class=''>Image</th>
							<th class=''>Main Price</th>
							<th class=''>Discount</th>
							<th class=''>Price</th>
							<th class=''>UI Order</th>
							<th class=''>Status</th>
							<th class=''>Updated At</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission) || in_array($url1.'/'.$url2.'/serviceDelete',$permission)){ ?>
							<th class=''>Action</th>
							<?php } ?>					
						</tr>
					</thead> 
					<tbody class="text-center">
						<?php
						if(!empty($datas)) {
						 $num = 1 ; 
						foreach($datas as $data) { ?>
						<tr>
							<td class='text-primary'><?php echo $num; ?></td>						
							<td class='text-left'><?= ucwords($data->title); ?></td>
							<td class='text-left'><?= $data->slug; ?></td>
							<td class=''>
								<?php  $img = image_exist($data->image,'assets/images/services/'); ?>
	                  			<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>"  class="img-thumbnail" style="width:40px; height:40px;">
							<td class='text-left'><?= $data->mrp_price; ?></td>
							<td class='text-left'><?= $data->discount; ?>%</td>
							<td class='text-left'><?= $data->price; ?></td>

							<td>
		                    	<input style="width:40px;padding:4px" type="text" name="ui_order" id="ui_order<?= $data->id?>" value="<?php echo $data->ui_order; ?>">
		                    	<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
		                    		<a onclick="update_ui_order_('ui_order<?= $data->id?>',<?= $data->id?>,'<?= $url2?>')" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
		                    	<?php } ?>

	                		</td>
	                		<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>

                			<td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
							    <?= ($data->status == 1)?"Activated":"De-activated"; ?>
							    </button>
							</td>
							<td>
    						    <?= ($data->updated_at)?$data->updated_at:$data->created_at; ?>
    						</td>
    						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission) || in_array($url1.'/'.$url2.'/serviceDelete',$permission)){ ?>
							<td class=''>
								<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
							   	<a class="btn btn-primary" href="<?php echo base_url($url1.'/'.$url2.'/edit/'.$data->id.'?' . http_build_query($_GET, '', "&"));?>"><i class="fa fa-pencil-square-o  fa-lg" aria-hidden="true"></i></a>
							   <?php }?>
							   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/serviceDelete',$permission)){ ?>
							   	<a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/serviceDelete/'.$data->id.'?' . http_build_query($_GET, '', "&"));?>"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a> 
							   <?php }?>
							</td>
							<?php }?>
						</tr>
					   <?php $num++;  } } else {?>
					   <tr><td colspan="10" class="text-center">Our Services not available.</td></tr>
					   <?php }?>
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
         		var url = '<?= base_url($url1.'/'.$url2); ?>/serviceStatusUpdate';
                $.ajax({
                  	type:"POST",
                  	url: url, 
                  	data: {"status":newstatus,"id":id}, 
                  	success: function(data) {
                  		location.reload();
                  	}         
             	});
         	}
      	});
         
    });
    function update_ui_order_(key,id,table){
  		var ui_order = $('#'+key).val();
  		var url = '<?= base_url($url1.'/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id;
    	$.ajax({
            type: 'post',
            url : url,
            success:function(data){ 
                console.log(url);
                console.log(data);
                if(data>0){
                    alert('Order changed successfully');
                    window.location.reload();
                }
            }   
        });
    } 
</script>
<?php $this->load->view('admin/template/footer'); ?>
