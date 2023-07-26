<?php $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>

<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> Requirement</li>
            </ol>                                              
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
			<a href="<?php echo base_url($url1."/".$url2.'/add');?>" class="btn btn-primary float-right mb-3"><i class="fa fa-bars" aria-hidden="true"></i> Add</a>
		    <form name="frm" action="<?=base_url($url1.'/'.$url2.'/')?>">
              	<div class="row" style="display: none;"> 

               	  	<div class="col-sm-3">

                       <div class="form-group">

                           <label class="control-label" for="sip_code">Whole Record Search</label>

                           <input type="text" placeholder="Name" name="search_text" class="form-control box3" value="<?=$_GET['search_text']?>">

                       </div>

                   	</div>

                   	<div class="col-sm-3">

                       <div class="form-group">

                           <label class="control-label" for="sip_code">Status</label>

                           <select name="status" class="form-control">

                           	<option value="">Select Status</option>

                           	<?php $a  = array('1'=>'Active','0'=>'Inactive');?>

                           	<?php foreach ($a as $key => $value) { if($_GET['status'] && $_GET['status'] == $key){$sel='selected';}else{$sel='';}?>

                           		<option value="<?=$key?>" <?=$sel?>><?=$value?></option>

                           	<?php }?>

                           </select>

                       </div>

                   	</div>
                   	<div class="col-sm-2">

                       <div class="form-group">

                           <div class="control-label" for="sip_code" style="margin-bottom: 4px;"><br/></div>

                           <input type="submit" class="color_white btn btn-md btn-danger" >

                           <a href="<?=base_url($url1.'/'.$url2.'')?>" type="submit" class="color_white btn btn-md btn-danger" >Clear</a>

                       </div>

                   	</div>

                 </div>
            </form>
			<div class="table-responsive ">
			    <?php if($this->session->flashdata('success')){?>
    			    	<span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>
    			    	<script>
                        var timeout = 3000; // in miliseconds (3*1000)
                        $('.flash_message').delay(timeout).fadeOut(300);
                  </script>
			    <?php }?>
			    <?php if($this->session->flashdata('error')){?>
                  <span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>
                  <script>
                        var timeout = 3000; // in miliseconds (3*1000)
                        $('.flash_message').delay(timeout).fadeOut(300);
                  </script>
                <?php }?>
				<table class="table table-bordered table-hover shadow-lg text-center" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th class=''>Sr No.</th>
							<th class='text-left'>Name</th>
                            <th class=''>Price</th>
							<th class=''>Status</th>
							<th class=''>Action</th>					
						</tr>
					</thead>
					<tbody class="text-center">
						<?php  if(!empty($list)) { ?>
								<?php $num=1; ?>
								<?php  foreach($list as $row) { ?>
									 
									<tr style="<?=$style;?>">
										<td class='text-primary'><?php echo $num; ?></td>						
										<td class='text-left'><?php echo ucwords($row->title); ?></td>
                                        <td class=''><?php echo ucwords($row->amount); ?></td>
										<td><button type="button" id="<?= $row->id; ?>" class="status_checks btn btn-sm <?= ($row->status == 1)?"btn-primary":"btn-danger"; ?> ">
                                            <?= ($row->status == 1)?"Activate":"Deactivate"; ?>
                                            </button>
                                        </td>
										<td class=''>
										   	<a class="btn"  href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
										   	<a class="btn" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
										</td>
									</tr>
							   	<?php $num++; ?>
						   	<?php } ?>
							<?php } else { ?>
						   	<tr><td colspan="4" class="text-center">Result Not Available</td></tr>
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
                  url: "<?= base_url('admin/requirment/change_status'); ?>", 
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