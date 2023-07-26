<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Career  Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
		    <a href="<?php echo base_url('admin/add-career') ;?>" class="btn btn-primary float-right mb-3 ml-3"><i class="fa fa-plus" aria-hidden="true"></i>Add Jobs</a>
			
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg" id="example">
				<thead>
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Job Title</th>
						<th class=''>Short Description</th>
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
						<td class=''><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->jobTitle); ?></td>
					    <td class=''><?php echo ucwords($data->shortDesc); ?></td>
					    <td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
						    </button>
						</td>
						<td class=''>
					   <a href="<?php echo base_url('admin/edit-career/').$data->id;?>"><i class="fa fa-pencil-square-o text-primary fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('admin/delete-career/').$data->id;?>" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Career data not available.</td></tr>
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
                  url: "<?= base_url('admin/update_careers_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>