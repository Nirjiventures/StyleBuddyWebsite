<?php $this->load->view('front/vandor/header'); ?>

<div class="main">
	<div class="container">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
			<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->

		<div class="col-sm-12">
			<div class="rightbar">
				
				<div class="container p-0">
					<div class="row">
						<div class="col-sm-9">
							<h3>Manage Style Stories</h3></div>

						<div class="col-sm-3 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/fashionboard')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>

					</div>
					<hr>
				</div>

				<div class="row">
					<div class="col-sm-8">
						<?= $this->session->flashdata('success'); ?>
					    <?= $this->session->flashdata('error'); ?>
					</div>
					
					<div class="col-sm-4 text-end">
						
					</div>
				</div>
				
					<div class="table-responsive">
				
						<table class="table table-bordered odc text-nowrap" id="example">
							<thead>
								<tr>
									<th class="no">Style Stories Title</th>
									<th class="name">Image</th>
									<th class="date">Date</th>
									<th class="date">Status</th>
									<th class="action">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($blogs)) { foreach($blogs as $blog)  {  ?>
								<tr>
								    <td><?= $blog->blogTitle ?></td>
									<td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/').$blog->blogImage ?>" class="order_pic"></td>
									<td><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('F j, Y',strtotime($blog->created_at)) ?></td>
									<td>
										<label class="switch switch-green">
										  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
										  <span class="switch-label" data-on="On" data-off="Off"></span>
										  <span class="switch-handle"></span>
										</label>
									</td>
									<td><a href="<?= base_url('stylist-zone/edit-style-stories/').$blog->id ?>" class="btn btn-primary">Edit Story</a></td>
								</tr>
							<?php }} else {  ?>
							    <tr><td colspan="6" class="text-center">Style Stories not available.</td></tr>
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
     function blogStatus(id,status)
    {
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('stylist-zone/storyStatus'); ?>", 
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