<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Collaborate-view Us Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="row">
    <div id="message" class="text-primary text-center"></div>
	<div class="table-responsive shadow-lg">
		<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
        <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
        <table class="table table-bordered text-center table-hover shadow-lg" id="example">				
			<thead class="text-white bg-primary">
				<tr>
					<th class=''>No.</th>
					<th class=''>Name</th>                                            
					<th class=''>Email</th>
					<th>Message</th>
					<th class=''>Status</th>
					<th>Date</th>
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
					<td class='text-left'><?php echo ucwords($data->name); ?></td>
					<td class='text-left'><?php echo ucwords($data->email); ?></td>
					<td class=''><p class="pc_name2"><?php echo ucwords($data->message); ?></p></td>
					<td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
					    <?= ($data->status == 1)?"Activated":"Deactivated"; ?>
					    </button>
					</td>
					<td class=''><?php echo date('j M Y h:i:s',strtotime($data->created_at)); ?></td>
					<td class=''>
					    <a type="button" class="btn btn-success"  data-toggle="modal" data-target="#message_success_corporate_lead<?= $data->id; ?>"><i class="fa fa-eye text-warning fa-lg" aria-hidden="true"></i></a>
						        <div class="modal" id="message_success_corporate_lead<?= $data->id; ?>" aria-modal="true" >
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= ucwords($data->name); ?></h4>
                                                <button type="button" class="btn-close" data-dismiss="modal">X</button>
                                            </div>
                                            <div class="modal-body c_lead">
                                                <table class="table table-bordered text-left table-hover shadow-lg">
                                                    <tr><td>Name:</td><td><?php echo ucwords($data->name); ?></td></tr>
                                                    <tr><td>Email:</td><td> <?= $data->email; ?></td></tr>
                                                    <tr><td>Message:</td><td> <?= $data->message; ?></td></tr>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
					   <a href="<?php echo base_url('admin/Dashboard/blogDelete/').$data->id;?>" class="btn btn-danger"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
					</td>
				</tr> 
			   <?php $num++;  } } else {?>
			   <tr><td colspan="6">Contact Us Data not available.</td></tr>
			   <?php }?>
			</tbody>
		</table>
	</div>
	 
</div>
<script>
    $(document).ready(function(){
        $('#example').DataTable();    
        $(document).on('click','.status_checks',function() {
            var id = (this.id);
            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
            var msg = (status=='0')? 'Activated':'Deactivated';
            var newstatus = (status=='0')? '1':'0';
             if(confirm("Are you sure to "+ msg)) {
                      $.ajax({
                      type:"POST",
                      url: "<?= base_url('admin/Dashboard/blogStatusUpdate'); ?>", 
                      data: {"status":newstatus, "id":id}, 
                      success: function(data) {
                      location.reload();
                      }         
                 });
             }
        });    
    });
</script>