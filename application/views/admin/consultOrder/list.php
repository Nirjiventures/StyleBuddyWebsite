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

		<div class="col-md-12 mt-3">

		    

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

                   

                <?php }?>

				<table class="table table-bordered table-hover shadow-lg" id="example">

					<thead class="text-white bg-primary">

						<tr>

							<th class=''>S. No.</th>

							<th class=''>Name </th>

							<th class=''>E-Mail ID</th>

							<th class=''>Phone</th>

							<th class=''>Package Name</th>

							<th class=''>Package Fees</th>

							<th class=''>Date</th>

							<th class=''>Action</th>					

						</tr>

					</thead>

					<tbody>

						<?php  if(!empty($list)) { ?>

								<?php $num=1; ?>

								<?php  foreach($list as $row) { ?>

									<tr style="<?=$style;?>">

										<td><?php echo $num; ?></td>						

										<td><?php echo ucwords($row->full_name); ?></td>

										<td><?php echo $row->email; ?></td>

										<td><?php echo $row->mobile; ?></td>

										<td><?php echo $row->package_name; ?></td>

										<td><?php echo $row->currency; ?> <?php echo $row->total_price; ?></td>

										<td><?php echo $row->created_at; ?></td>

										<td>

											<a class="btn btn-success" href="<?= base_url('admin/consultOrder/view/').$row->id ?>"><i class="fa fa-eye text-success1 fa-lg" aria-hidden="true"></i></a> &nbsp;&nbsp;
											<?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
										   		<a class="btn btn-danger"  href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a>
										   	<?php } ?>
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