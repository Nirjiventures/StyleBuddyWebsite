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
		<div class=" mt-2">
			    <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">

                  	<div class="row"> 
            
                   	  	<div class="col-sm-3">
                           <label class="control-label" for="sip_code">Whole Record Search</label>
                           <input type="text" placeholder="Name" name="search_text" class="form-control box3" value="<?=$_GET['search_text']?>">
                       	</div>
                       	<div class="col-sm-2">
                            <label class="control-label" for="sip_code">Status</label>
                            <select name="status" class="form-control">
                               	<option value="">Select Status</option>
                               	<?php $a  = array('1'=>'Published','0'=>'Unpublished');?>
                               	<?php foreach ($a as $key => $value) { if($_GET['status'] && $_GET['status'] == $key){$sel='selected';}else{$sel='';}?>
                               		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>
                               	<?php }?>
                            </select>
                       	</div>
                       	<div class="col-sm-2">
                            <label class="control-label" for="sip_code">Post Type</label>
                            <select name="media_type" class="form-control">
                               	<option value="">Select type</option>
                               	<?php $a  = array('video'=>'Video','image'=>'Image','text'=>'Text');?>
                               	<?php foreach ($a as $key => $value) { if($_GET['media_type'] && $_GET['media_type'] == $key){$sel='selected';}else{$sel='';}?>
                               		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>
                               	<?php }?>
                            </select>
                       	</div>
                       	<div class="col-sm-2">
                            <label class="control-label" for="sip_code">From Date</label>
                            <input type="date" placeholder="from date" name="from_date" class="form-control box3" value="<?=$_GET['from_date']?>"> 
                       	</div>
                       	<div class="col-sm-2">
                            <label class="control-label" for="sip_code">To Date</label>
                            <input type="date" placeholder="to date" name="to_date" class="form-control box3" value="<?=$_GET['to_date']?>"> 
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
		        <div class="table-responsive ">
    				<table class="table table-bordered table-hover shadow-lg" id="table">
    					<thead class="text-white bg-primary">
    
    						<tr>
    
    							<th class=''>Sr No.</th>
    
    							<th class=''>Title</th>
    							<th class=''>Post Admin</th>
    
                            	<th class=''>Category</th>
                            	<th class=''>Description</th>
    
                                <th class=''>Created Date</th>
                                <th class=''>Status</th>
    
                                <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission) || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                    <th class=''>Action</th>
                                <?php } ?>				
    
    						</tr>
    
    					</thead>
    					<tbody>
    
    						<?php  if(!empty($list)) { ?>
    
    								<?php $num=1; ?>
    
    								<?php  foreach($list as $row) { ?>
    
    									 
    
    									<tr style="<?=$style;?>">
    
    										<td class='text-primary'><?php echo $num; ?></td>						
    										<td class=''><?php echo ucwords($row->title); ?></td>
    										<td class=''><?php echo ucwords($row->post_admin_row->fname); ?></td>
                                            <td class=''><?php echo ucwords($row->post_category); ?></td>
                                            <td class=''><?php echo ucwords($row->description); ?></td>
                                            <td class=''><?php echo ucwords($row->created_at); ?></td>
                                            <?php $cls = '';if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ $cls='status_checks';}?>
                                            <td><button type="button" id="<?= $row->id; ?>" class="<?=$cls?> btn btn-sm mt-1 <?= ($row->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                                   <?= ($row->status == 1)?"Activated":"De-activated"; ?>
                                                   </button>
                                            </td>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission) || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                                <td class=''>
                                                    <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                                    <a class="btn btn-primary"  href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>
                                                   <?php } ?>
                                                   <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                                    <a class="btn btn-danger"  class="btn" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                </td>
                                            <?php } ?> 
     
    									</tr>
    
    							   	<?php $num++; ?>
    
    						   	<?php } ?>
    
    							<?php } else { ?>
    
        						   	<tr><td colspan="4" class="text-center">Result Not Available</td></tr>
    
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

<script>

    $(document).ready(function(){

        $('#example').DataTable();

    });



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



    function update_ui_order(key,id,type){

        var ui_order = $('#'+key).val();

            $.ajax({

                type: 'post',

                url : '<?= base_url('admin/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id,

                success:function(data){ 

                    console.log('<?= base_url('admin/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id);

                    console.log(data);

                    if(data>0){

                        alert('Status changed successfully');

                        window.location.reload();

                    }

                }   

            });

        

    }



    

</script>

<?php $this->load->view('admin/template/footer'); ?>