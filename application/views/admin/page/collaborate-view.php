<?php 
     $rrr = getUserPermission();
     //echo $this->db->last_query();
     $permission = unserialize($rrr['permission']);
     //var_dump($permission);
?>
<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Collaborate-view Us Details</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row justify-content-center">
	    <?php $this->load->view('admin/lead_management'); ?>
        <div class="clearfix"></div>
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		    <!--<a href="<?//= base_url($url1.'/corporate_leads/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white">Export Data</a>-->
			<div class="table-responsive">
			
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
            <table class="table table-bordered text-center table-hover shadow-lg" id="example">				
				<thead class="text-white bg-primary">
					<tr>
						<th class=''>No.</th>
						<th class=''>Name</th>                                            
						<th class=''>Email</th>
						<th class=''>Subject</th>
						<th>Message</th>
						<th>Portfolio</th>
						<th>Date</th>
						<th class=''>Action</th>	
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($datas)) {
					 $num = 1 ; 
					foreach($datas as $data) { ?>
					<tr>
						<td class=''><?php echo $num; ?></td>						
						<td class='text-left'><?php echo ucwords($data->name); ?></td>
						<td class='text-left'><?php echo ucwords($data->email); ?></td>
						<td class='text-left'><p class="pc_name2"><?php echo ucwords($data->subject); ?></p></td>
						<td class=''><p class="pc_name2"><?php echo ucwords($data->message); ?></p></td>
						<td class=''><p class="pc_name3"><?php echo ucwords($data->portfolio_url); ?></p></td>
						<td class=''><?php echo date('j M Y',strtotime($data->created_at)); ?></td>
						
						<td class=''>
						    <a type="button" class="btn btn-success"  data-toggle="modal" data-target="#message_success_corporate_lead<?= $data->id; ?>"><i class="fa fa-eye text-warning fa-lg" aria-hidden="true"></i></a>
							        <div class="modal" id="message_success_corporate_lead<?= $data->id; ?>" aria-modal="true" >
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= ucwords($data->name); ?></h4>
                                                    <button type="button" class="btn-close" data-dismiss="modal">X</button>
                                                </div>
                                                <div class="modal-body c_lead">
                                                    <table class="table table-bordered text-left table-hover shadow-lg">
                                                        <tr><td>Name:</td><td><?php echo ucwords($data->name); ?></td></tr>
                                                        <tr><td>Email:</td><td> <?= $data->email; ?></td></tr>
                                                        <tr><td>Subject:</td><td> <?php echo ucwords($data->subject); ?></td></tr>
                                                         
                                                        <tr><td>Message:</td><td> <?= $data->message; ?></td></tr>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/Dashboard/collaborateUsDelete/',$permission)){ ?>        
    					   		<a href="<?php echo base_url('admin/Dashboard/collaborateUsDelete/').$data->id;?>" class="btn btn-danger"><i class="fa fa-trash  fa-lg" aria-hidden="true"></i></a>
    						<?php } ?>
						</td>
					</tr> 
				   <?php $num++;  } } else {?>
				   <tr><td colspan="6">Contact Us Data not available.</td></tr>
				   <?php }?>
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