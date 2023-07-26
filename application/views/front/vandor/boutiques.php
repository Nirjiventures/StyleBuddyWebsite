<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="rightbar">
				<div class="container p-0">
					<div class="row">
						<div class="col-sm-8">
							<h3>My Boutiques</h3>
						</div>
						<div class="col-sm-4 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?= base_url('vendor/boutiques_add') ?>" class="btn btn-success add_pro"><i class="fa fa-plus" aria-hidden="true"></i> Add Boutiques</a>
						</div>
					</div>
					<hr/>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?= $this->session->flashdata('success'); ?>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped odc text-nowrap" id="example">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Image</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Status</th>
								<th>Go Dashboard</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($list)) { $num = $start_limit + 1 ;?>
								<?php foreach($list as $data)  {  ?>
									<tr>
										<td class='text-primary'><?=  $num; ?></td>
										<td class=''>
										    <?php $img =  'assets/images/no-image.jpg';?>
        							        <?php if(!empty($data->image))  {?>
        							            <?php 
        							                $img1 =  'assets/images/vandor/'.$data->image; 
        							                if (file_exists($img1)) {
        							                    $img = $img1;
        							                }
        							            ?>
        							        <?php } ?>
        									<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" style="width:40px; height:40px; " class="img-thumbnail">
										</td>
										<td ><p class='spc'><?= ucwords($data->fname.' '.$data->lname); ?></p></td>
									    <td class=''><?= $data->email; ?></td>
									    <td class=''><?= $data->mobile; ?></td>
									    <td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm  <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
										    <?= ($data->status == 1)?"Activated":"Deactivated"; ?>
										    </button>
										</td>
										<td>
											<a target="_blank" href="<?= base_url('boutiques/boutiquedashboard/').$data->id ?>" class="btn btn-sm btn-primary">Dashboard</a>
									    </td>
										<td>
									      	<a href="<?= base_url('vendor/boutiques_edit/').$data->id ?>" class="btn btn-sm btn-primary">Edit</a>
									    </td>
									</tr>
								<?php $num++; }?>
							<?php } else {  ?>
							    <tr><td colspan="8" class="text-center">Boutiques not available.</td></tr>
							<?php  } ?>	
						</tbody>
					</table>
				</div> 
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
         $('#example').DataTable();
    });
    $(document).on('click','.status_checks',function() {
        var id = (this.id);
        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
        var msg = (status=='0')? 'Activated':'Deactivated';
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
</script>
<script type="text/javascript">   
    function productStatus(id,status) {
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('stylist-zone/productStatus'); ?>", 
              data: {"status":newstatus, "id":id}, 
              success: function(data) {
                location.reload();
              }         
           });
       } else {
           location.reload();
       }
    }
</script>
</body>
</html>
<?php $this->load->view('front/vandor/footer'); ?>