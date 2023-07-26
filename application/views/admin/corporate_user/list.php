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
		           	  	<div class="col-sm-3">
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
			           	</div>
		           	<?php  }?>
	           	<?php  }?>
	           	<div class="col-sm-3">

	               <div class="form-group">

	                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>

	                   <input type="submit" class="color_white btn btn-md btn-danger" >

	                   <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>

	               </div>

	           	</div>
	         </div>
	      </form>
		   <div id="message" class="text-primary text-center"></div>
			<!-- <a href="<?php echo base_url($url1.'/'.$url2.'/add') ;?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i>   </a> -->
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
         <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
         <a href="<?= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>
			<div class="table-responsive ">
				<table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">

						<tr>

							<th class='' style="width: 40px;">S.No.</th>
							<th class=''>Image</th>
							<th class=''>Full Name</th>
							<th class=''>Email</th>
							<th class=''>Mobile</th>
							<th class=''>Registered Date</th>
							<th class=''>Status</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
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

						<td class='text-primary'><?=  $num; ?></td>

						<td class=''><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?><?= ($data->image)?"assets/images/vandor/$data->image":"assets/images/no-image.jpg" ?> " style="width:40px; height:40px; " class="img-thumbnail"></td>

						<td class=''><?= ucwords($data->fname.' '.$data->lname); ?></td>

					   <td class=''><?= $data->email; ?></td>

					   <td class=''><?= $data->mobile; ?></td>
					    
					   	<td><?= date('F j, Y',strtotime($data->created_at)) ?></td>
                   		<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>

            			<td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activated":"De-activated"; ?>
						    </button>
						</td>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
						<td>
					      	<!-- <a href="<?php echo base_url($url1.'/'.$url2.'/edit/'.$data->id);?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a> -->
							   <a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/'.$data->id);?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a> 
						</td>
						<?php }?>
					</tr>
					   <?php $num++;  } } else {?>
					   <tr><td colspan="8" class="text-center">users not available.</td></tr>
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
         		var url = '<?= base_url($url1.'/'.$url2); ?>/statusUpdate';
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
