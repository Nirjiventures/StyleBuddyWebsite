<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">
 

		<div class="col-sm-12">
			<div class="rightbar">
				

				<div class="container p-0">
					<div class="row">
						<div class="col-sm-8">
							<h3>Manage Products</h3></div>

							<div class="col-sm-4 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

					</div>
					<hr>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<?= $this->session->flashdata('success'); ?>
					</div>
				</div>
				
				
					
				        <div class="table-responsive">
						<table class="table table-bordered odc text-nowrap" id="example">
							<thead>
								<tr>
									<th class="no">Product</th>
									<th class="name">Product Name</th>
									<th class="total">Price</th>
									<th class="date">Date</th>
									<th class="date">Status</th>
									<th class="action">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($products)) { foreach($products as $product)  {  ?>
								<tr>
									<td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/product/').$product->image ?>" class="order_pic"></td>
									<td><p><?= $product->product_name ?></p></td>
									<td><?= $this->site->currency ?> <?= number_format($product->price) ?></td>
									<td><?= date('F j, Y',strtotime($product->created_at)) ?></td>
									<td>
										<label class="switch switch-green">
										  <input type="checkbox" class="switch-input" onclick="productStatus(<?= $product->id ?>,<?= $product->vendor_status ?>)" id="<?= $product->vendor_status ?>" <?= ($product->vendor_status == 1)?'checked':'' ?> >
										  <span class="switch-label" data-on="On" data-off="Off"></span>
										  <span class="switch-handle"></span>
										</label>
									</td>
									<td>
									    <a href="<?= base_url('stylist-zone/edit-products/').$product->id ?>" class="btn btn-primary">Edit</a>
									    <!-- <a href="<?= base_url('stylist-zone/delete-products/').$product->id ?>" class="btn btn-danger">Delete</a> -->
									</td>
								</tr>
							<?php }} else {  ?>
							    <tr><td colspan="6" class="text-center">Products not available.</td></tr>
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
              url: "<?= base_url('vendor/productVendorStatus'); ?>", 
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