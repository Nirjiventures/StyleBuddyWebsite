<?php $segment1  = $this->uri->segment(1);?>
<?php $segment2  = $this->uri->segment(2);?>
<?php $segment3  = $this->uri->segment(3);?>
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
               <li class="breadcrumb-item active" aria-current="page">Review List</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		   <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive ">
			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg">
				<thead class="bg-primary text-white">
					<tr>
						<th class=''>S. No.</th>
						<th class=''>Name</th>
						<th class=''>Status</th>
						 
						<th class=''>Action</th>	
						 
						 			
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
						<tr>
							<td class='text-primary'><?php echo $num; ?></td>						
							<td class='text-left'><?php echo ucwords($data->name); ?></td>
							<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($segment1."/".$segment2.'/edit',$permission)){ $cls='status_checks';}?>

	                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
	                       <?= ($data->status == 1)?"Activated":"De-activated"; ?>
	                       </button>
	                  </td>

							
							<td class=''>
						   <a href="<?php echo base_url($segment1.'/'.$segment2.'/view/'.$data->id);?>"><i class="fa fa-eye text-warning fa-lg" aria-hidden="true"></i></a>
						   <!-- <a href="<?php echo base_url($segment1.'/'.$segment2.'/delete/'.$data->id);?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>  -->
							</td>
						</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Review data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
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
                  url: "<?= base_url('admin/review/changeStatus'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  	location.reload();
                  }         
             });
         }
      });    
   });
</script>
