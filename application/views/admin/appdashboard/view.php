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
			<div class="table-responsive ">
			<table class="table table-bordered text-center table-hover shadow-lg" id="example">
				<span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>Sl No.</th>
						<th class=''>Page Ttile</th>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
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
						<td><?php echo ucwords($data->title); ?></td>
						<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
							<td>
	    					   <a class="btn btn-primary" href="<?php echo base_url($url1.'/'.$url2.'/edit/').$data->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
	    					</td>
    					<?php } ?>
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
     
    });
    
</script>