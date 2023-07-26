<?php $url1  =$this->uri->segment(1);?>

<?php $url2  =$this->uri->segment(2);?>

<?php $url3  =$this->uri->segment(3);?>

<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<div class="card-content collapse show">

	<div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">

		<?php if($this->session->flashdata('success')){?>

		    <span class="text-center text-info mb-2 flash_message" id="susid"> <?php echo $this->session->flashdata('success');?></span>

		<?php }?>

	    <?php if($this->session->flashdata('error')){?>

          	<span class="text-center text-danger mb-2 flash_message" id="errid"> <?php echo $this->session->flashdata('error');?></span>

        <?php }?>

        

         
<div class="container">
        <div class="row justify-content-center">

            <?php $this->load->view('admin/lead_management'); ?>
	    <div class="clearfix"></div>

        <div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		    <!--<a href="<?//= base_url($url1.'/Dashboard/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white">Export Data</a>-->
			<div class="table-responsive ">


			<!--<div class="col-sm-6">
	      	<a href="<?//= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>
	      </div>-->





		<table id="example" class="table table-bordered text-center table-hover shadow-lg" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">

			<thead>

				<tr>

					<th>S.No.</th>	

					<th>Name</th>	

					<th>Email</th>	

					<th>Phone</th>	

					<th>Created</th>
					<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
					 <th style="width: 100px;">Action</th>
					<?php } ?>
					 

				</tr>

            </thead>

            <tbody>
                
                <?php

                if (!empty($list)) {

                    $count = 1;

                    foreach ($list as $row) { ?>

                        <tr class="even"  data-val="<?=$row->id?>">

                            <td><?=$count;?></td>

            				<td><?php echo !empty($row->name) ? $row->name : 'N/A' ?></td>

            				<td><?php echo !empty($row->email) ? $row->email : 'N/A' ?></td>

            				<td><?php echo !empty($row->mobile) ? $row->mobile : 'N/A' ?></td>

            				<td><?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></td>
            				<?php if($this->session->userdata('admin_id') == 1 || in_array($url1.'/'.$url2.'/delete',$permission)){ ?>
                            <td style="width: 100px;!important">

                            	<!--<a  href="<?php echo base_url($url1.'/'.$url2.'/view/').$row->id;?>"  class="btn btn-success"><i class="fa fa-eye text-warning fa-lg" aria-hidden="true"></i></a>-->

								<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

							</td>
							<?php } ?>
            				 

						</tr>

                        <?php $count++;

                    }

                }

                ?>

            </tbody>

        </table>

        <!--<div class="row">

            <div class="col-sm-6">

				<p style="font-weight:700; margin-top:15px;">Showing result for: <?=($start_limit + 1).'-'.$end_limit.' of '.$numRows?></p>

			</div>

			<div class="col-sm-6">

				<div class="pagination" style="float:right">

					<?//=$links;?>

				</div>

			</div>

		</div>-->

			

         

		<div class="clearfix"></div>

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