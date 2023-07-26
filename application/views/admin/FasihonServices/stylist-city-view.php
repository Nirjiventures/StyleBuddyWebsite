<?php $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>

<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Looking Stylist Expertise / Interests Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		        <a href="<?php echo base_url($url1.'/looking-stylist'); ?>" class="btn btn-primary float-left ">Back </a>
			    <a href="<?php echo base_url($url1.'/'.$url2.'/add'); ?>" class="btn btn-primary float-right "><i class="fa fa-plus" aria-hidden="true"></i> Add New </a>
			<div class="table-responsive ">
			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                <h2><?php  echo $experiseRow->title_develop;  ?></h2>
    			<table class="table table-bordered  table-hover shadow-lg" id="example">
    				<thead class="text-white bg-primary">
    					<tr>
    						<th class=''>Sr. No.</th>
    						<th class=''>Title</th>
    						<th class=''>City</th>
    						<th class=''>Status</th>
    						<th class=''>Action</th>					
    					</tr>
    				</thead>
    				<tbody class="">
    					<?php
    					if(!empty($datas)) {
    					 $num = 1 ; 
    					foreach($datas as $data) { ?>
    					<tr>
    						<td class='text-primary'><?php echo $num; ?></td>						
    						<td class='text-left'><?php echo ucwords($data->title); ?></td>
    						<td class='text-left'> 
    						    <?php foreach($cities as $k=>$v){?>
                                    <?php if($v->id == $data->city_id){?>
                                        <?=$v->city ?> 
                                    <?php }?>
                                <?php }?>
    						     
    						</td>
    					 
    						<td><button type="button" id="<?= $data->id; ?>" class="status_checks btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
    						    <?= ($data->status == 1)?"Activate":"Deactivate"; ?>
    						    </button>
    						</td>
    						<td class=''>
    					   <a href="<?php echo base_url($url1.'/'.$url2.'/edit/').$data->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
    					   <a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$data->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a> 
    						</td>
    					</tr>
    				   <?php $num++;  } } else { ?>
    				   <tr><td colspan="4" class="text-center">Expertise / Interests details not available.</td></tr>
    				   <?php } ?>
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
                  url: "<?= base_url('admin/looking-stylist_status'); ?>", 
                  data: {"status":newstatus, "id":id}, 
                  success: function(data) {
                  location.reload();
                  }         
             });
         }
      });    
    });
</script>
<?php $this->load->view('admin/template/footer'); ?>