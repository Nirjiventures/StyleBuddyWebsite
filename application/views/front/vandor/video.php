<?php $this->load->view('front/vandor/header'); ?>

<style type="text/css">
	 p {
	    word-break: break-all;
	    white-space: initial;
	    width: 430px;
	    min-width: 100%;
	}
	table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px!important;
}
	.admin_tab .nav-tabs .nav-link:focus,.admin_tab .nav-tabs .nav-link:hover {
	    background: #fff!important;
	    color: #000!important;
	}
	.admin_tab .nav-tabs .nav-link.active{
		background: #000!important;
		color: #fff!important;
	}
	.admin_tab .nav-tabs .nav-item.show .nav-link, .admin_tab .nav-tabs .nav-link.active {
	    color: #fff!important;;
	   	background: #000!important;
	}
	.admin_tab .nav-link {
	    color: #000!important;
	    background: #fff!important;
	    border-color: #e9ecef #e9ecef #dee2e6;
	}
	.table.table-bordered.dataTable{
		margin-top: 20px!important;
	}
	@media(max-width: 768px){
		.dataTables_filter{
			text-align: center!important;
		}
		.dataTables_length label{
			text-align: center!important;
			display: block;
		}
		
	}
</style>

<div class="main">
	<div class="container">

		<!--<div class="col-sm-3 p-0 sdk">
			<div class="sidebar">
			<?php //$this->load->view('front/vandor/siderbar'); ?>
			</div>
		</div>-->

		<div class="col-sm-12">
			<div class="rightbar">
				
				<div class="row">

					<div class="container">
						<div class="row">
							<div class="col-sm-9">
								<h3>MANAGE VIDEO</h3></div>

							<div class="col-sm-3 text-end">
								<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								&nbsp; - &nbsp; 
								<a href="<?=base_url('vendor/videopage')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
							</div>

						</div>
						<hr>
					</div>


					<div class="col-sm-12">
						<?= $this->session->flashdata('success'); ?>
					    <?= $this->session->flashdata('error'); ?>
					</div>
					
				</div>
			
				<?php 	$a = array(
								array('id'=>'record-video','name'=>'Manage Recorded Videos'),
								array('id'=>'upload-video','name'=>'Manage Uploaded Videos')
						);
				?>
				<div class="admin_tab">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<?php	
							if($this->input->get('tab')){
								if($this->input->get('tab') == 'record-video'){
									$active='active';$selected='true'; 
								}else{
									$active='';$selected='false';
								}
							}else{
								$active='active';$selected='true';
							}
						?>

						<li class="nav-item" role="presentation">
							<button class="nav-link <?=$active;?>" id="record-video" data-bs-toggle="tab" data-bs-target="#record-video-pane" type="button" role="tab" aria-controls="record-video-pane" aria-selected="<?=$selected;?>">Manage Recorded Videos</button>
						</li>
						<?php	
							if($this->input->get('tab')){
								if($this->input->get('tab') == 'upload-video'){
									$active='active';$selected='true'; 
								}else{
									$active='';$selected='false';
								}
							}else{
								$active='';$selected='false';
							}
						?>
						<li class="nav-item" role="presentation">
							<button class="nav-link <?=$active;?>" id="upload-video" data-bs-toggle="tab" data-bs-target="#upload-video-pane" type="button" role="tab" aria-controls="upload-video-pane" aria-selected="<?=$selected;?>">Manage Uploaded Videos</button>
						</li>
					</ul>
				</div>
				<div class="tab-content" id="myTabContent">
					<?php	
						if($this->input->get('tab')){
							if($this->input->get('tab') == 'record-video'){
								$active='show active';$selected='true'; 
							}else{
								$active='';$selected='false';
							}
						}else{
							$active='show active';$selected='true';
						}
					?>

  					<div class="tab-pane fade <?=$active;?>" id="record-video-pane" role="tabpanel" aria-labelledby="record-video" tabindex="0">
  						<div class="mt-3">
  							<h3 class="mb-3">Manage Recorded Videos</h3>
							<div class="table-responsive">
								<table class="table table-bordered odc text-nowrap" id="table">
									<thead>
										<tr>
											<th class="date col-sm-2">Title</th>
											<th class="image col-sm-2">Video</th>
											<th class="status col-sm-2">Status</th>
											<th class="action col-sm-2">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(!empty($portfolio_video)) {  $count = count($portfolio_video);?>
										<?php foreach($portfolio_video as $blog)  {  ?>
											<tr>
												<td><?= $blog->title ?></td>
												<td><p> 
													<?php if($blog->videoType == 'capture'){ ?>
														<?= base_url('assets/images/story/').$blog->image ?>
													<?php } ?>
													</p>
												</td>
												<td>
													<label class="switch switch-green">
													  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
													  <span class="switch-label" data-on="Available" data-off="Booked"></span>
													  <span class="switch-handle"></span>
													</label>
												</td>
												<td>
												    	<a href="<?= base_url('vendor/capture_video_delete/').$blog->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php }?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">Dates not available.</td></tr>
									<?php  } ?>	
									</tbody>
								</table>
								<table class="table table-bordered odc text-nowrap" style="display: none;">
									<thead>
										<tr>
											<th class="no col-sm-4">Title</th>
											<th class="image col-sm-2">Video</th>
											<th class="date col-sm-2">Date</th>
											<th class="status col-sm-2">Status</th>
											<th class="action col-sm-2">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(!empty($blogs)) {  $count = count($blogs);?>
										<?php foreach($blogs as $blog)  {  ?>
											<tr>
											    <td><p><?= $blog->title ?></p></td>
												<td><p>  
														<?php if($blog->videoType == 'youtube'){ ?>
															<?= $blog->image ?>
														<?php }else { ?>
															<?= base_url('assets/images/story/').$blog->image ?>
														<?php } ?>
													</p>
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
												    <a href="<?= base_url('stylist-zone/edit-video/').$blog->id ?>" class="btn btn-primary">Edit</a>
												    <a href="<?= base_url('stylist-zone/delete-video/').$blog->id ?>" class="btn btn-danger">Delete</a>
												</td>
											</tr>
										<?php }?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">Video not available.</td></tr>
									<?php  } ?>	
									</tbody>
								</table>
							</div>
  						</div>
  					</div>
  					<?php	
						if($this->input->get('tab')){
							if($this->input->get('tab') == 'upload-video'){
								$active='show active';$selected='true'; 
							}else{
								$active='';$selected='false';
							}
						}else{
							$active='';$selected='false';
						}
					?>

  					<div class="tab-pane fade <?=$active;?>" id="upload-video-pane" role="tabpanel" aria-labelledby="upload-video" tabindex="0">
						<div class="mt-3">
							<h3 class="mb-3">Manage Uploaded Videos</h3>
							<div class="table-responsive">
								<table class="table table-bordered odc text-nowrap" id="table">
									<thead>
										<tr>
											<th class="date col-sm-2">Title</th>
											<th class="image col-sm-2">Video</th>
											<th class="status col-sm-2">Status</th>
											<th class="action col-sm-2">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(!empty($blogs)) {  $count = count($blogs);?>
										<?php foreach($blogs as $blog)  {  ?>
											<tr>
												<td><p><?= $blog->title ?></p></td>
												<td><p> 
													<?php if($blog->videoType == 'youtube'){ ?>
														<?= $blog->image ?>
													<?php }else { ?>
														<?= base_url('assets/images/story/').$blog->image ?>
													<?php } ?>

													</p>
												</td>
												<td>
													<label class="switch switch-green">
													  <input type="checkbox" class="switch-input" onclick="blogStatus(<?= $blog->id ?>,<?= $blog->status ?>)"  id="<?= $blog->status ?>" <?= ($blog->status == 1)?'checked':'' ?> >
													  <span class="switch-label" data-on="Available" data-off="Booked"></span>
													  <span class="switch-handle"></span>
													</label>
												</td>
												<td>	<a href="<?= base_url('stylist-zone/edit-video/').$blog->id ?>" class="btn btn-primary">Edit</a>
												    	<a href="<?= base_url('vendor/deleteVideo/').$blog->id ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php }?>
									<?php } else {  ?>
									    <tr><td colspan="6" class="text-center">Dates not available.</td></tr>
									<?php  } ?>	
									</tbody>
								</table>
							</div>
						</div>
  					</div>
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
         $('#table').DataTable();
    });
    
     function blogStatus(id,status)
    {
        var newstatus = (status=='0')? '1':'0';
        if(confirm("Are you sure to change status")) {
              $.ajax({
              type:"POST",
              url: "<?= base_url('vendor/videoStatus'); ?>", 
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