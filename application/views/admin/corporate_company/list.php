<?php $this->load->view('admin/template/header'); ?>
<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Our Services Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		   <div id="message" class="text-primary text-center"></div>
		   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/add',$permission)){ ?>
				<a href="<?php echo base_url($url1.'/'.$url2.'/add') ;?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i> Add New Company </a>
			<?php } ?>
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
         <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>

			<div class="table-responsive ">
				<table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th class=''>S. No.</th>
							<th class=''>Name</th>
							<th class=''>UI Order</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
								<th class=''>Action</th>	
							<?php } ?>				
						</tr>
					</thead> 
					<tbody class="text-center">
						<?php
						if(!empty($datas)) {
						 $num = 1 ; 
						foreach($datas as $data) { ?>
						<tr>
							<td class='text-primary'><?php echo $num; ?></td>						
							<td class='text-left'><a href="<?=base_url('admin/domain/?corporate_company_id='.$data->id)?>"><?= ucwords($data->name); ?></td>
							<td>
			                  <input style="width:40px;padding:4px" type="text" disabled name="ui_order" id="ui_order<?= $data->id?>" value="<?php echo $data->ui_order; ?>">
			                  	<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
		                    		<a onclick="update_ui_order_('ui_order<?= $data->id?>',<?= $data->id?>,'<?= $url2?>')" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
		                    	<?php } ?>
	                		</td>
							<!-- <td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
							    <?= ($data->status == 1)?"active":"in-active"; ?>
							    </button>
							</td> -->
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
								<td class=''>
								   <a class="btn btn-primary 213213213"   href="<?php echo base_url($url1.'/'.$url2.'/edit/'.$data->id);?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
								</td>
							<?php } ?>
						</tr>
					   <?php $num++;  } } else {?>
					   <tr><td colspan="6" class="text-center">domain not available.</td></tr>
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
         		var url = '<?= base_url($url1.'/'.$url2); ?>/statusUpdate';
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
    function update_ui_order_(key,id,table){
  		var ui_order = $('#'+key).val();
  		var url = '<?= base_url($url1.'/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id;
    	$.ajax({
            type: 'post',
            url : url,
            success:function(data){ 
                console.log(url);
                console.log(data);
                if(data>0){
                    alert('Order changed successfully');
                    window.location.reload();
                }
            }   
        });
    } 
</script>
<?php $this->load->view('admin/template/footer'); ?>
