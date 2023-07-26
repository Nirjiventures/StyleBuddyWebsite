<?php

	$url1 = $this->uri->segment(1);

	$url2 = $this->uri->segment(2);

	$url3 = $this->uri->segment(3);

?>
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
               <li class="breadcrumb-item active" aria-current="page">CMS Pages</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-5">
		    <div id="message" class="text-primary text-center"></div>
			<a href="<?php echo base_url('admin/page/add') ;?>" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i>Add App CMS Pages</a>
			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover shadow-lg" id="example">
				<span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Page Ttile</th>
						<th class=''>Page Url</th>
						<th class=''>Image</th>
						<th class=''>Status</th>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission) || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
							<th class=''>Action</th>
						<?php } ?>				
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) {  ?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>						
						<td class='text-left'><?php echo ucwords($data->title); ?></td>
						<td class='text-left'><?php echo $data->slug; ?></td>
						<td class=''>
						    <?php if(!empty($data->image)) { ?>
						    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/').$data->image; ?>" class="img-thumbnail" style="width:40px; height:40px;">  
                            <?php } ?>						
						</td>
						<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>

                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
                       <?= ($data->status == 1)?"Activated":"De-activated"; ?>
                       </button>
                  </td>

						 

						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission) || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
                       <td class=''>
                           <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/edit',$permission)){ ?>
                           	<a class="btn btn-primary"  href="<?php echo base_url('admin/page/edit/').$data->id;?>"><i class="fa fa-pencil-square-o  fa-lg" aria-hidden="true"></i></a>
                          <?php }?>
                          <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
                           	<a class="btn btn-danger"  href="<?php echo base_url('admin/page/delete/').$data->id;?>" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a> 
                          <?php }?>
                       </td>
                  <?php }?>

						 
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="7">Data not available.</td></tr>
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
                  $.ajax({
                  type:"POST",
                  url: '<?= base_url('admin/page/statusUpdate'); ?>', 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
    
</script>