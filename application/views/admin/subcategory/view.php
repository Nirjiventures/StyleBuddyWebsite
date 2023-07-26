<?php //echo "<pre>"; print_r($datas);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Subcategory Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('add-subcategory') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add Sub Category</a>
			<div class="table-responsive ">
			<table class="table table-bordered  text-center table-hover shadow-lg">
				<span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="">
					<tr class="bg-primary text-white">
						<th class=''>Sl No.</th>
						<th class=''>Category</th>
						<th class=''>Sub Category</th>
						<th class=''>Is Child</th>
						<th class=''>Image</th>
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
						<td class='text-primary'><?php echo $num; ?></td>						
						<td class=''><?php echo ucwords($data->category_name); ?></td>
						<td class=''><?php echo $data->subcategory; ?></td>
						<td class='<?= ($data->is_child == '1')?'text-primary':'text-danger' ?>'>
						    <?= ($data->is_child == '1')
						    ?'<a href="admin/child-subcategory"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>':
						    '<i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i>' ?>
						</td>
						<td class=''><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/images/cate/').$data->sub_cat_image ?>" style="width:60px; height:60px;"class="img-thumbnail"></td>
						<td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-3 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
						    </button>
						</td>
						<td class=''>
					   <a href="<?php echo base_url('edit-subcategory/').$data->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
					   <a href="<?php echo base_url('delete-subcategory/').$data->id;?>" ><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
						</td>
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Sub Category data not available.</td></tr>
				   <?php }?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        
    $(document).on('click','.status_checks',function() {
        var id = (this.id);
        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
        var msg = (status=='0')? 'Activate':'Deactivate';
        var newstatus = (status=='0')? '1':'0';
         if(confirm("Are you sure to "+ msg)) {
                  $.ajax({
                  type:"POST",
                  url: 'update_subcategory_status', 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>