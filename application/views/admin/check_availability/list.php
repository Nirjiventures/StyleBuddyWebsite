<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>
<?php 
    $rrr = getUserPermission();
    //echo $this->db->last_query();
    $permission = unserialize($rrr['permission']);
    //var_dump($permission);
  ?>
<div class="my_lead">

	<ul>

		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/leads');?>" class="btn btn-primary">All Leads</a></li>
		<?php } ?>
		<li><a href="#" class="btn btn-dark">Leads from connect with stylist</a></li>
		<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads/upload',$permission)){ ?>
			<li><a href="<?php echo base_url('admin/leads/upload');?>" class="btn btn-info">Upload lead</a></li>
		<?php } ?>
		 

	</ul>

</div>

<div class="container-fluid p-0">
    <div class="container">
    
	<div class="row justify-content-center">
        <?php $this->load->view('admin/lead_management'); ?>
	    <div class="clearfix"></div>
		<!--<div class="col-md-12 mt-3">-->

			<!--<a href="<?//= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>-->
            <div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		    <!--<a href="<?//= base_url($url1.'/Dashboard/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white">Export Data</a>-->
			<div class="table-responsive ">
			<table id="example" class="table table-bordered text-center table-hover shadow-lg" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">

				<thead class="text-white bg-primary">

					<tr>

						<th>S.No.</th>	

						<th>Stylist Name</th>	

						<th>Name</th>	

						<th>Email</th>

						<th>Mobile</th>

						<th>City</th>

						<th>Service</th>

						<th>Message</th>

						<th>Created</th>

						<th>Status</th>
						<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability/edit',$permission)|| in_array('admin/check_availability/delete',$permission)){ ?>
							<th>Action</th>
						<?php } ?>
					</tr>

	            </thead>

	            <tbody>

	                <?php

	                if (!empty($list)) {

	                    $count = 1;

	                    foreach ($list as $row) {

	                        

	                        ?>

	                        <?php 

								$style='';

								if($row->allocated_id){

									if($row->allocated_id == $row->vendor_id){

										$style='background:#89710c;color:#fff;';

									}else{

										$style='background:#423f2e;color:#fff;';

									}

								}

							?>

							<tr style="<?=$style;?>"  class="even"  data-val="<?=$row->id?>">

	                            <td><?=$count;?></td>

	            				<td><?php echo !empty($row->vendor_name) ? $row->vendor_name : 'N/A' ?></td>

	            				<td><?php echo !empty($row->name) ? $row->name : 'N/A' ?></td>

	            				<td><?php echo !empty($row->email) ? $row->email : 'N/A' ?></td>

	            				<td><?php echo !empty($row->phone) ? $row->phone : 'N/A' ?></td>

	            				<td><?php echo !empty($row->city) ? $row->city : 'N/A' ?></td>

	            				<td><?php echo !empty($row->service_name) ? $row->service_name : 'N/A' ?></td>

	            				<td><?php echo !empty($row->message) ? $row->message : 'N/A' ?></td>

	            				<td><?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></td>

	            				<td>

									<?php  $source_from = array('0'=>'Not Contacted','1'=>'Contacted lead','2'=>'Lead Interested','3'=>'Lead Converted','4'=>'Junk Lead','5'=>'Lead not Interested','6'=>'Cancelled');?>

									<?php 	foreach ($source_from as $key => $value) {  ?>

										<?php 	if($key == $row->status){ ?>

												<button type="button" class="btn btn-sm  btn-success "><?=$value?></button>

										<?php 	}?>

									<?php 	}?>

								</td>
								<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability/edit',$permission)|| in_array('admin/check_availability/delete',$permission)){ ?>
	                            <td style="width: 100px;!important">
	                            	<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability/edit',$permission)){ ?>
	                            	<a class="btn  btn-success"  href="<?php echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning fa-lg" aria-hidden="true"></i></a>
	                            	<?php 	}?>
	                            	<?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability/delete',$permission)){ ?>
									<a class="btn  btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
									<?php 	}?>
								</td>
								<?php 	}?>
							</tr>

	                        <?php $count++;

	                    }

	                }

	                ?>

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

            buttons: [{ extend: 'excel', text: ' Export Data' }, 'pageLength' ],

        }); 

        table.buttons().container() .appendTo('#datatable_wrapper .col-md-6:eq(0)');

    });
</script>