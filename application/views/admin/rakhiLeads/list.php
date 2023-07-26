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
<div class="container-fluid">



 

			<div>

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


                    
                    
                    
			
			

                  <div class="container">

    			<div class="row justify-content-center">
    			    <?php $this->load->view('admin/lead_management'); ?>
    			    <div class="clearfix"></div>

    			    	<div class="col-sm-12 p-0 mt-3">

                			<div class="table-responsive ">

                				<table class="table table-bordered text-center table-hover text-nowrap shadow-lg" id="example">

                					<thead class="text-white bg-primary">

                						<tr>

                							<th class=''>S. No.</th>

                							<th class=''>Name </th>

                							<th class=''>E-Mail ID</th>

                							<th class=''>Phone</th>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
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

                										<td class='text-left'><?php echo ucwords($row->name); ?></td>

                										<td class='text-left'><?php echo $row->email; ?></td>

                										<td class=''><?php echo $row->mobile; ?></td>
                                                        <?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
                    										<td class=''>

                    										   	<a class="btn  btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>

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

    				    </div>

				</div>

			

			</div>

		 

</div>

<?php $this->load->view('admin/template/footer'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> 

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>	 

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>	 

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>	 

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>	 

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>	

<script>

    $(document).ready(function () { 

        var table = $('#example').DataTable({ 

            select: true, 

            dom: 'Blfrtip', 

            lengthMenu: [ [10, 25, 50, -1], ['10', '25', '50', 'All'] ], 

            dom: 'Bfrtip', 

            //buttons: [ { extend: 'pdf', text: ' Exportar a PDF' }, { extend: 'csv', text: ' Exportar a CSV' }, { extend: 'excel', text: ' Exportar a EXCEL' }, 'pageLength' ],

            buttons: [{ extend: 'excel', text: ' Export EXCEL' }, 'pageLength' ],

        }); 

        table.buttons().container() .appendTo('#datatable_wrapper .col-md-6:eq(0)');

    });

    $(document).ready(function(){

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

