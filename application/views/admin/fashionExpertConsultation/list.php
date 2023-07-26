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
    <div class="container">
	<div class="row justify-content-center">
        <?php $this->load->view('admin/lead_management'); ?>
			
			<div class="clearfix"></div>
		<div class="col-md-12 mt-3">

		    <div id="message" class="text-primary text-center"></div>
            <!--<a href="<?//= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>-->
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

				<table class="table table-bordered table-hover shadow-lg" id="example">

					<thead class="text-white bg-primary">

						<tr>

							<th class=''>S. No.</th>

							<th class=''>Name </th>

							<th class=''>E-Mail ID</th>

							<th class=''>Phone</th>

							<th class=''>City</th>

							<th class=''>Consultation Topic</th>

							<th class=''>Consultation Fees</th>

							<th class=''>Message</th>

							<th class=''>Date</th>
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

										<td><?php echo $num; ?></td>						

										<td><?php echo ucwords($row->full_name); ?></td>

										<td><?php echo $row->email; ?></td>

										<td><?php echo $row->mobile; ?></td>

										<td><?php echo $row->city; ?></td>

										<td><?php echo $row->area_expertise; ?></td>

										<td><?php echo $row->currency; ?> <?php echo $row->total_price; ?></td>

										<td><?php echo $row->message; ?></td>

										<td><?php echo $row->created_at; ?></td>
										<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
											<td>
											   	<a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
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

            buttons: [{ extend: 'excel', text: ' Export Data' }, 'pageLength' ],

        }); 

        table.buttons().container() .appendTo('#datatable_wrapper .col-md-6:eq(0)');

    });
</script>
