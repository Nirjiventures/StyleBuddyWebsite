<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">
		<!-- <div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
			<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div> -->

		<div class="col-sm-12">
			<div class="rightbar">
				
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage #Tags</h2>
						<?= $this->session->flashdata('success'); ?>
					</div>
					
					<div class="col-sm-6 text-end">
						<a href="<?= base_url('stylist-zone/dashboard') ?>" class="btn btn-success add_pro">Home </a>
						<a href="<?= base_url('stylist-zone/add-tags') ?>" class="btn btn-success add_pro"> Add #Tags</a>
						<a href="<?= base_url('stylist-zone/manage-portfolio') ?>" class="btn btn-success add_pro"> Manage Portfolio</a>
					</div>
				</div>
				
				<hr>
					
				        <div class="table-responsive">
						<table class="table table-bordered odc text-nowrap" id="example">
							<thead>
								<tr>
									<th class="no"> #Tags</th>
									<th class="date">Status</th>
									<th class="action">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($tags)) { foreach($tags as $product)  {  ?>
								<tr>
									<td><?= $product->tag ?></td>
									<td>
										<label class="switch switch-green">
										  <input type="checkbox" class="switch-input" onclick="productStatus(<?= $product->id ?>,<?= $product->status ?>)" id="<?= $product->status ?>" <?= ($product->status == 1)?'checked':'' ?> >
										  <span class="switch-label" data-on="On" data-off="Off"></span>
										  <span class="switch-handle"></span>
										</label>
									</td>
									<td>
									    <a href="<?= base_url('stylist-zone/edit-tags/').$product->id ?>" class="btn btn-primary">Edit</a>
									</td>
								</tr>
							<?php }} else {  ?>
							    <tr><td colspan="6" class="text-center">Tags not available.</td></tr>
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
    
    function productStatus(id,status) {
        
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('stylist-zone/tagStatus'); ?>", 
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