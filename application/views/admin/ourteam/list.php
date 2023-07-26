<?php $segment1  = $this->uri->segment(1);?>
<?php $segment2  = $this->uri->segment(2);?>
<?php $segment3  = $this->uri->segment(3);?>
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
               <li class="breadcrumb-item "><a href="<?php echo base_url($segment1."/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Team List</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		   <div id="message" class="text-primary"></div>
		   <?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/add',$permission)){ ?>
			   <div class="col-md-12"><a href="<?php echo base_url($segment1."/".$segment2."/add");?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New </a></div>
			<?php } ?>
			<div class="table-responsive ">
			    <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered table-hover shadow-lg">
				<thead class="bg-primary text-white">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Name</th>
						<th class=''>Email</th>
						<th class=''>Phone</th>
						<th class=''>UI Order</th>
						<th class=''>Status</th>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/edit',$permission) || in_array($segment1.'/'.$segment2.'/delete',$permission)){ ?>
						<th class=''>Action</th>	
						<?php } ?>				
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
						<tr>
							<td class='text-primary'><?php echo $num; ?></td>						
							<td class=''><?php echo ucwords($data->fname); ?> <?php echo ucwords($data->lname); ?></td>
							<td class=''><?php echo ucwords($data->email); ?></td>
							<td class=''><?php echo ucwords($data->mobile); ?></td>
							<td>
    	                  <input style="width:40px;padding:4px" type="text" name="ui_order" id="ui_order<?= $data->id?>" value="<?php echo $data->ui_order; ?>">
 								<?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/edit',$permission)){ ?>
 	                    		<a onclick="update_ui_order_('ui_order<?= $data->id?>',<?= $data->id?>,'<?= $segment1?>')" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
 								<?php } ?>
                    	</td>
                    	<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($segment1."/".$segment2.'/edit',$permission)){ $cls='status_checks';}?>

	                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
	                       <?= ($data->status == 1)?"Activated":"De-activated"; ?>
	                       </button>
	                  </td>

							 
							<?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/edit',$permission) || in_array($segment1.'/'.$segment2.'/delete',$permission)){ ?>
								<td class=''>
									<?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/edit',$permission)){ ?>
							   		<a class="btn btn-primary" href="<?php echo base_url($segment1.'/'.$segment2.'/edit/'.$data->id);?>"><i class="fa fa-pencil-square-o text- fa-lg" aria-hidden="true"></i></a>
							   	<?php } ?>
							   	<?php if($this->session->userdata('admin_id') == 1 || in_array($segment1.'/'.$segment2.'/delete',$permission)){ ?>
							   		<a class="btn btn-danger" href="<?php echo base_url($segment1.'/'.$segment2.'/delete/'.$data->id);?>"><i class="fa fa-trash text- fa-lg" aria-hidden="true"></i></a>
							   	<?php } ?>
								</td>
							<?php } ?>
						</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="5">Team data not available.</td></tr>
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
                  url: "<?= base_url($segment1.'/'.$segment2.'/changeStatus'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  	location.reload();
                  }         
             });
         }
      });    
   });
   function update_ui_order_(key,id,table){
  		var ui_order = $('#'+key).val();
    	$.ajax({
            type: 'post',
            url : '<?= base_url('admin/'.$segment2); ?>/update_ui_order/'+ui_order+'/'+id,
            success:function(data){ 
                console.log('<?= base_url('admin/'.$segment2); ?>/update_ui_order/'+ui_order+'/'+id);
                console.log(data);
                if(data>0){
                    alert('Order changed successfully');
                    window.location.reload();
                }
            }   
        });
    } 
</script>
