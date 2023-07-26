<?php $this->load->view('admin/template/header'); ?>
<?php
	$url1 = $this->uri->segment(1);
	$url2 = $this->uri->segment(2);
	$url3 = $this->uri->segment(3);
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		    <a href="<?php  echo base_url('admin/'.$url2.'/add'); ?>" class="btn btn-primary float-right"><i class="fa fa-plus"></i> <?=$right_heading?></a>
			 
			<div class="table-responsive ">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
				<span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>	

				<table id="table" class="table table-striped table-bordered file-export" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
					<thead>
						<tr><th data-field="state" data-checkbox="true"></th>
							<th>S.No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>
							</tr>
					</thead>
					<tbody>
						<?php
							if (!empty($users)) {
								$count = 1;
								foreach ($users as $row) {
									?>
									<tr class="even"  data-val="<?=$row->id?>">
										<td></td>
										<td><?=$count;?></td>
										<td class="">
											<?php echo!empty($row->name) ? $row->name : '' ?>
										</td>
										<td class=""><?php echo!empty($row->email) ? $row->email : '-' ?></td>
										
										<td><button type="button" id="<?= $row->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($row->status == 1)?"btn-primary":"btn-danger"; ?> ">
										    <?= ($row->status == 1)?"Activated":"De-activated"; ?>
										    </button>
										</td>
										<td>
											<a class="btn btn-default" href="<?php echo base_url($url1.'/'.$url2.'/edit/' . $row->id) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
											<a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/' . $row->id) ?>"data-record-id="<?php echo $row->id ?>" data-record-title="<?php echo $row->name ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											 
										</td>  
									</tr>

									
									<?php
							 $count++;   }
							}
							?>
					</tbody>

				</table>
			 	<?php if($this->session->userdata('admin_id') ||  in_array($url2.'/edit',$permission) || in_array($url2.'/delete',$permission)){ ?>
		            <input type="hidden" value="<?=$url2?>" id="controllerName">
		            <?php if($this->session->userdata('admin_id') || in_array($url2.'/edit',$permission)){ ?>
		            	    <!--<input type="button" value="Active All" class="color_white btn btn-md btn-primary" id="activeAll">
							<input type="button" value="Deactive All" class="color_white btn btn-md btn-primary" id="deactiveAll">-->
					<?php } ?>
		            <?php if($this->session->userdata('admin_id') || in_array($url2.'/delete',$permission)){ ?>
		                <!--<input type="button" value="Delete All" class="color_white btn btn-md btn-danger" id="deleteAll">-->
		            <?php } ?>
		    	<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/template/footer'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
	      	$('#example').DataTable();    
	    	$(document).on('click','.status_checks',function() {
				var id = (this.id);
				var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
				var msg = (status=='0')? 'Activate':'Deactivate';
				var newstatus = (status=='0')? '1':'0';
	         	if(confirm("Are you sure to "+ msg)) {
	         		var url = '<?= base_url($url1.'/'.$url2); ?>/changeStatus';
	                $.ajax({
	                  	type:"POST",
	                  	url: url, 
	                  	data: {"status":newstatus,"id":id}, 
	                  	success: function(data) {
	                  		location.reload();
	                  	}         
	             	});
	         	}
	      	});
	         
	    });
	</script>