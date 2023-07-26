<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="container">
		<div class="col-sm-12">
			<div class="rightbar">
				
				<div class="row">
					<div class="col-sm-8"><h2>Manage Portfolio</h2></div>
					
					<div class="col-sm-4 text-end">
						<a href="<?= base_url('stylist-zone/dashboard') ?>" class="btn btn-success add_pro">Home </a>
						<a href="<?= base_url('stylist-zone/add-ideas') ?>" class="btn btn-success add_pro">Add Portfolio </a>
						<a href="<?= base_url('stylist-zone/add-tags') ?>"  class="btn btn-success add_pro float-left"> Add #Tags</a>
					</div>
					<div class="col-sm-12">
						
						<?= $this->session->flashdata('success'); ?>
					    <?= $this->session->flashdata('error'); ?>
					</div>
					
				</div>
				<?php if($this->session->flashdata('projectCountTotal_message')) {  ?>
					<div class="logo_p  mb-2 mt-2"><?= $this->session->flashdata('projectCountTotal_message'); ?></div>
				<?php } ?>
				 
				<hr>
				<div class="table-responsive">
			
					<table class="table table-bordered odc text-nowrap" id="example">
							<thead>
								<tr>
									<th class="no col-sm-4">Title</th>
									<th class="name col-sm-2">Image</th>
									<th class="date col-sm-2">Date</th>
									<th class="date col-sm-2">Status</th>
									<th class="action col-sm-2">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(!empty($blogs)) {  $count = count($blogs);?>
								<?php foreach($blogs as $blog)  {  ?>
									<tr>
									    <td><p><?= $blog->title ?></p></td>
										<td>
											<?php  if (file_exists($image_path = FCPATH . 'assets/images/story/' . $blog->image)) { ?>
											    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/story/'.$blog->image) ?>"  class="order_pic">
											<?php  } else { ?>
											    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/no-image.jpg') ?>" class="order_pic">
											<?php  } ?>

										</td>
										<td><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('F j, Y',strtotime($blog->created_at)) ?></td>
										
										<td>
											<label class="switch switch-green">
											  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
											  <span class="switch-label" data-on="On" data-off="Off"></span>
											  <span class="switch-handle"></span>
											</label>
										</td>
										<td>
										    <a href="<?= base_url('stylist-zone/edit-ideas/').$blog->id ?>" class="btn btn-primary">Edit</a>
										    <a href="<?= base_url('stylist-zone/delete-ideas/').$blog->id ?>" class="btn btn-danger">Delete</a>
										</td>
									</tr>
								<?php }?>
							<?php } else {  ?>
							    <tr><td colspan="6" class="text-center">Portfolio not available.</td></tr>
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
    //$(document).ready(function(){
         //$('#example').DataTable();
    //});
    
    
     function blogStatus(id,status)
    {
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('stylist-zone/ideaStatus'); ?>", 
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