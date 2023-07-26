<?php $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-2">
			<?php if($this->session->flashdata('success')){?>
		    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>
		    	<script>
                    /*var timeout = 3000; // in miliseconds (3*1000)
                    $('.flash_message').delay(timeout).fadeOut(300);*/
              	</script>
		    <?php }?>
		    <?php if($this->session->flashdata('error')){?>
              <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>
              <script>
                    /*var timeout = 3000; // in miliseconds (3*1000)
                    $('.flash_message').delay(timeout).fadeOut(300);*/
              </script>
            <?php }?>
            <form name="filterForm" action="<?=base_url($url1.'/'.$url2.'/index/')?>">
	        	<div class="row">
                	<div class="col-sm-3">
					 	<select class="form-control" id="vender_id" name="vender_id" onchange="filterForm.submit()">
					 		<option value="">Select Vender</option>
					 		<?php  foreach ($venders as $key => $value) { ?>
					 		<?php  $sel='';if ($this->input->get('vender_id') && $this->input->get('vender_id') == $value->id) {$sel='selected';}?>
					 			<option value="<?=$value->id?>" <?=$sel?>><?=ucwords($value->fname.' '.$value->lname)?></option>
					 		<?php  } ?>
					 	</select>
					</div>
					<div class="col-sm-9">
						 
					</div>
				</div>
			</form>
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
		    <div class="table-responsive ">
			    <table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th class="date col-sm-2">ID</th>
							<th class="date col-sm-2">Title</th>
							<th class="image col-sm-2">Video</th>
							<th class="image col-sm-2">Video Type</th>
							<th class="status col-sm-2">Status</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
								<th class="action col-sm-2">Action</th>	
							<?php } ?>			
						</tr>
					</thead>
					<tbody>
						<?php  if(!empty($list)) { ?>
								<?php $num=1; ?>
								<?php  foreach($list as $row) { ?>
									 
									<tr style="<?=$style;?>">
										<td class='text-primary'><?php echo $num; ?></td>						
										<td class=''><?php echo ($row->title); ?></td>

                                        <td class=''>
                                        	<?php  if ($row->videoType == 'youtube'){ ?>
	                                        		<div class="my_video">
        							    				<iframe width="100%" src="https://www.youtube.com/embed/<?=$row->image?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        							    			</div>

	                                        <?php }else{ ?>
                                        		<?php  $img = image_exist($row->image,'assets/images/story/'); ?>
									    		<video class="video-col-1" id="myVideo" style="width:100%" controls autoplay>
									                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
									                <source src="<?= base_url($img) ?>" type="video/quicktime" playsinline>
									                <source src="<?= base_url($img) ?>" type="video/webm" playsinline>
									                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
									                <source src="<?= base_url($img) ?>" type="video/mp4" playsinline>
									            </video>
	                                        <?php } ?>
                                        </td>
                                        <td class=''><?php echo ($row->videoType); ?></td>
                                        <?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
                                        <td><button type="button" id="<?= $row->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($row->admin_status == 1)?"btn-primary":"btn-danger"; ?> ">
                                             <?= ($row->admin_status == 1)?"Activated":"De-activated"; ?>
                                             </button>
                                        </td>

										<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
											<td class=''>
											   	<a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
											</td>
										<?php } ?>
									</tr>
							   	<?php $num++; ?>
						   	<?php } ?>
							<?php } else { ?>
						   	<tr><td colspan="13" class="text-center">Result Not Available</td></tr>
						<?php } ?>
					</tbody>
				</table>
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
</div>
<script>
     
    $(document).on('click','.status_checks',function() {
        var id = (this.id);
        var status = ($(this).hasClass("btn-primary")) ? '1' : '0'; 
        var msg = (status=='0')? 'Activate':'Deactivate';
        var newstatus = (status=='0')? '1':'0';

        console.log(newstatus);
        console.log(id);
        if(confirm("Are you sure to "+ msg)) {
            $.ajax({
                type:"POST",
                url: "<?= base_url('admin/'.$url2.'/changeStatus'); ?>", 
                data: {"status":newstatus, "id":id}, 
                success: function(data) {
                    console.log(data);
                    location.reload();
                }         
            });
         }
    }); 

     

    
</script>
<?php $this->load->view('admin/template/footer'); ?>