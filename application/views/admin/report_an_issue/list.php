<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>


        
        <div class="container">
        <div class="row justify-content-center">
            <?php $this->load->view('admin/lead_management'); ?>
    	    <div class="clearfix"></div>
    	    <div class="col-md-12 mt-3">
		        <div id="message" class="text-primary text-center"></div>
		        <!--<a href="<?//= base_url($url1.'/Dashboard/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white">Export Data</a>-->
			    <div class="table-responsive ">
			
    				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                    <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>



		<table id="example" class="table table-bordered text-center table-hover shadow-lg" data-toggle="table" data-pagination="false" data-search="true" data-show-columns="true" data-key-events="true" data-show-toggle="true"  data-cookie="true" data-cookie-id-table="saveId" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">
			<thead>
				<tr>
					<th>S.No.</th>	
					<th>First Name</th>	
					<th>Last Name</th>	
					<th>Country</th>	
					<th>Email</th>	
					<th>Phone</th>	
					<th>Message</th>
					<th>Created</th>
					<th style="width: 100px;">Action</th>
				</tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    $count = 1;
                    foreach ($list as $row) { ?>
                        <tr class="even"  data-val="<?=$row->id?>">
                            <td><?=$count;?></td>
            				<td><?php echo !empty($row->fname) ? $row->fname : 'N/A' ?></td>
            				<td><?php echo !empty($row->lname) ? $row->lname : 'N/A' ?></td>
            				<td><?php echo !empty($row->country_name) ? $row->country_name : 'N/A' ?></td>
            				<td><?php echo !empty($row->email) ? $row->email : 'N/A' ?></td>
            				<td><?php echo !empty($row->mobile) ? $row->mobile : 'N/A' ?></td>
            				<td><?php echo !empty($row->message) ? $row->message : 'N/A' ?></td>
            				<td><?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></td>
                            <td style="width: 100px;!important">
                            	<a  href="<?php echo base_url($url1.'/'.$url2.'/view/').$row->id;?>"  class="btn btn-success"><i class="fa fa-eye text-warning fa-lg" aria-hidden="true"></i></a>
								<a href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
            				 
						</tr>
                        <?php $count++;
                    }
                }
                ?>
            </tbody>
        </table>
		<div class="clearfix"></div>
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