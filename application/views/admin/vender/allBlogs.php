<?php // print_r($expertises) ?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Style Story Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
			<!--<a href="<?php echo base_url('admin/add-fashion-services') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Fashion Service </a>-->
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover text-nowrap shadow-lg" id="example">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Vendor Name</th>
						<th class=''>Style Story Name</th>
						<th class=''>Image</th>
						<th class=''>Added On</th>
						<th class=''>Status</th>
						
					</tr>
				</thead>
				<tbody class="text-center">
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {     ?>
					<tr>
						<td class='text-primary'><?=  $num; ?></td>						
						<td class='text-left'><?= ucwords($data->fname.' '.$data->lname); ?></td>
					    <td class='text-left'><p class="pc_name"><?= $data->blogTitle; ?></p></td>
					    <td class=''><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('/assets/images/story/').$data->blogImage; ?>" style="width:40px; height:40px;" class="img-thumbnail border border-primary"></td>
					    <td class=''><?= date('j F, Y',strtotime($data->created_at)); ?></td>
					
					     <td><button type="button" id="<?= $data->id; ?>" class="status_checkss btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
						    </button>
						</td>
					    
					    
						
					</tr>
				   <?php $num++;   } } else {?>
				   <tr><td colspan="15" class="text-center">Vender Registration details not available.</td></tr>
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
                  $.ajax({
                  type:"POST",
                  url: "<?= base_url('admin/update_vender_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
