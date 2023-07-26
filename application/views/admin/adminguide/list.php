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


<div class="container-fluid p-0">

   <div class="row">

      <div class="col-md-12">

         <nav aria-label="breadcrumb">

            <ol class="breadcrumb pl-3 mr-3 ">

               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>

               <li class="breadcrumb-item active" aria-current="page"> Admin Guide</li>

            </ol>                                              

         </nav>

      </div>

   </div>

</div>



<div class="my_lead">

	<ul>
		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/adminguide',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/adminguide');?>" class="btn btn-primary">All Documents</a></li>
		<?php } ?>
		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/adminguide/upload',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/adminguide/upload');?>" class="btn btn-dark">Upload a Document</a></li>
		<?php } ?>
	</ul>

</div>



<div class="container-fluid p-0">

	<div class="row">

		<div class="col-md-12 mt-3">

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

				<table class="table table-bordered text-center table-hover shadow-lg" id="example">

					<thead class="text-white bg-primary">

						<tr>

							<th class=''>S. No.</th>

							<th class=''>Title</th>

							<th class=''>Document URL</th>

							<th class=''>Date</th>
							<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/adminguide/delete',$permission)){ ?>
								<th class=''>Action</th>					
							<?php } ?>
						</tr>

					</thead>

					<tbody class="text-center">

						<?php  if(!empty($list)) { ?>

								<?php $num=1; ?>

								<?php  foreach($list as $row) { ?>

									 

									<tr>

										<td class='text-primary'><?php echo $num; ?></td>						

										<td class='text-left'><?php echo $row->title; ?></td>

										<td><a target="_blank" href="<?= base_url('assets/images/package_report/').$row->image ?>" class="btn btn-success">View</a></td>

										<td><?php echo $row->created_at; ?></td>

										<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/adminguide/delete',$permission)){ ?>
										   <td>
												<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger fa-lg" aria-hidden="true"></i></a>
										   </td>
										<?php } ?>
										
									</tr>

							   	<?php $num++; ?>

						   	<?php } ?>

							<?php } else { ?>

						   	<tr><td colspan="5" class="text-center">Result Not Available</td></tr>

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