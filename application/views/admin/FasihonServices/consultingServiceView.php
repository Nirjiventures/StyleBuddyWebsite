<?php $this->load->view('admin/template/header');  ?>

<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>
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
               <li class="breadcrumb-item active" aria-current="page">Fashion Consulting Services Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		   <div id="message" class="text-primary text-center"></div>
		   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/add',$permission)){ ?>
				<a href="<?php echo base_url('admin/add-fashion-consulting-services') ;?>" class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Fashion Consulting Services</a>
			<?php } ?>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                
			<table class="table table-bordered text-center table-hover shadow-lg" id="example">
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>S.No.</th>
						<th class=''>Fashion Consulting services Name</th>
						<th class=''>Price</th>
						<th class=''>Time</th>
						<th class=''>Image</th>
						<th class=''>Status</th>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                    	<th class=''>Action</th>
                	<?php }?>				
					</tr>
				</thead>
				<tbody class="text-center">
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class='text-primary'><?php echo $num; ?></td>						
						<td class='text-left'><?php echo ucwords($data->title); ?></td>
					    <td><?= (is_numeric($data->price))?"&#x20B9; $data->price":"$data->price" ?></td>
					    <td><?= $data->time ?> Hour</td>
					    <td><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/services/').$data->image ?>" class="img-thumbnail" style="width:40px; height:40px;"></td>
						
						<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
                  <td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
                        <?= ($data->status == 1)?"Activated":"De-activated"; ?>
                        </button>
                  </td>
						 
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                    	<td>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                            <a  class="btn btn-primary"  href="<?php echo base_url('admin/edit-fashion-consulting-services/').$data->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
                       <?php }?>
                       <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                            <a class="btn btn-danger" href="<?php echo base_url('admin/delete-fashion-consulting-services/').$data->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a> 
                       <?php }?>
                    	</td>
                	<?php }?>

						 
					</tr>
				   <?php $num++;  } } else {?>
				   <tr><td colspan="6" class="text-center">Fashion Services details not available.</td></tr>
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
                  url: "<?= base_url('admin/update_fashion_consulting_services_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
<?php $this->load->view('admin/template/footer');  ?>