<?php $url1 = $this->uri->segment(1);?>
<?php $url2 = $this->uri->segment(2);?>
<?php $url3 = $this->uri->segment(3);?>
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

	               <li class="breadcrumb-item active" aria-current="page">vendors Details</li>

	            </ol>

         	</nav>

      	</div>

   	</div>

</div>

<div class="container">

	<div class="mt-1">

		<div id="message" class="text-primary text-center"></div>

	 
		<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

        <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		

      

      <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">

      	<div class="row"> 

       	  	<div class="col-sm-3">
                   <label class="control-label" for="sip_code">Whole Record Search</label>
                   <input type="text" placeholder="Name or Email or Phone" name="search_text" class="form-control box3" value="<?=$_GET['search_text']?>">
           	</div>
           	<div class="col-sm-3">
                   <label class="control-label" for="sip_code">Status</label>

                   <select name="status" class="form-control">

                   	<option value="">Select Status</option>

                   	<?php $a  = array('1'=>'Published','0'=>'Unpublished');?>

                   	<?php foreach ($a as $key => $value) { if($_GET['status'] && $_GET['status'] == $key){$sel='selected';}else{$sel='';}?>

                   		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

                   	<?php }?>

                   </select>

                

           	</div>

           	  
			<?php $aaa = array('1'=>'Male','2'=>'Female');?>
			<div class="col-sm-3">
				<label class="control-label" for="sip_code">Gender</label>
				<select class="form-control" name="gender" id="gender" >
					<option  value="">Select Gender</option>
					<?php if($aaa) { foreach($aaa as $key=>$value) { ?>
						<?php 
						if($_GET['gender'] && $_GET['gender'] == $key){$sel='selected';}else{$sel='';}
						?>
						<option value="<?=$key?>" <?=$sel?>><?=$value?></option>
					<?php } } ?>
				</select>
				
				<?php echo form_error('gender','<span class="text-primary mt-1">','</span>') ;?>
				<div id="gender_err"></div>
			</div>
			<div class="clearfix"></div>
           	<div class="col-sm-12"></div>
           	<div class="col-sm-3">
                   <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>
                   <input type="submit" class="color_white btn btn-md btn-danger" >
                   <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>
           	</div>

         </div>

      </form>

      

      

      <div class="row">

      	<div class="col-sm-6">

				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>

			</div>

			<div class="col-sm-6">

				 

	      	<a href="<?=base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>

	      </div>

		</div>

		<div class="row">

	      	<div class="table-responsive ">

				<table class="table table-bordered text-center table-hover text-nowrap shadow-lg" id="table">

					<thead class="text-white bg-primary">

						<tr>

							<th class='' style="width: 40px;">S.No.</th>

							<th class=''>Image</th>

							<th class=''>Full Name</th>

							<th class=''>Email</th>

							<th class=''>Mobile</th>

							<th class=''>Registered Date</th>
							
							

							<th class=''>Activate Status</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/view',$permission)){ ?>
								 
							<?php } ?>
												

						</tr>

					</thead>

					<tbody class="text-left">

						<?php

						if(!empty($datas)) {

							$num = $start_limit + 1 ;

							/*if ($url3) {

								$num = $perpage *1 ;

							}*/

						  

						foreach($datas as $data) {     ?>

						<tr>

							<td class='text-primary'><?=  $num; ?></td>

							<td class=''>
							    <?php $img =  'assets/images/no-image.jpg';?>

	                            <?php if(!empty($data->image))  {?>
	                
	                                <?php 
	                
	                                    $img1 =  'assets/images/vandor/'.$data->image; 
	                
	                                    if (file_exists($img1)) {
	                
	                                        $img = $img1;
	                
	                                    }
	                
	                                ?>
	                
	                            <?php } ?>
	                            
							    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" style="width:40px; height:40px; " class="img-thumbnail">
							</td>

							<td class=''><?= ucwords($data->fname.' '.$data->lname); ?></td>

						    <td class=''><?= $data->email; ?></td>

						    <td class=''><?= $data->mobile; ?></td>
						    
						    <td><?= date('F j, Y',strtotime($data->created_at)) ?></td>
	                           
						 
							<?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>

	            			<td><button type="button" id="<?= $data->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($data->status == 1)?"btn-primary":"btn-danger"; ?> ">
							    <?= ($data->status == 1)?"Activated":"De-activated"; ?>
							    </button>
							</td>

	                        <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/view',$permission)){ ?>
							 
							<?php }?>
							

						</tr>

					   <?php $num++;   } } else {?>

					   <tr><td colspan="15" class="text-center">User Registration details not available.</td></tr>

					   <?php }?>

					</tbody>

				</table>

			</div>

		</div>

		<div class="row">

      	    <div class="col-sm-6">

				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>

			</div>

			<div class="col-sm-6">

				<div class="pagination" style="float:right">

					<?=$links;?>

				</div>

			</div>

		</div>

	</div>

</div>

 



<script>

    $(document).ready(function(){

        $('#example').DataTable();    

        $(document).on('click','.display_status',function() {
    
            var id = (this.id);
    
            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
    
            var msg = (status=='0')? 'Published':'Unpublished';
    
            var newstatus = (status=='0')? '1':'0';
    
             if(confirm("Are you sure to "+ msg)) {
    
                      $.ajax({
    
                      type:"POST",
    
                      url: "<?= base_url('admin/vender/display_statusUpdate'); ?>", 
    
                      data: {"display_status":newstatus, "id":id}, 
    
                      success: function(data) {
    
                      location.reload();
    
                      }         
    
                 });
    
             }
    
        });  
        $(document).on('click','.status_checks',function() {
    
            var id = (this.id);
    
            var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
    
            var msg = (status=='0')? 'Published':'Unpublished';
    
            var newstatus = (status=='0')? '1':'0';
    
             if(confirm("Are you sure to "+ msg)) {
    
                      $.ajax({
    
                      type:"POST",
    
                      url: "<?= base_url('admin/update_vender_status'); ?>", 
    
                      data: {"status":newstatus, "id":id}, 
    
                      success: function(data) {
    
                      location.reload();
    
                      }         
    
                 });
    
             }
    
        });  

    });

</script>

<style type="text/css">

    
</style>