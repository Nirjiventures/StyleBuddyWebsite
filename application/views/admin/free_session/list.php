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
    <!--<div class="row mt-3">

      	
        <div class="col-sm-6">
	      	<a href="<?php //echo base_url($url1."/".$url2.'/freesess_export');?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>
	    </div>
	</div>-->
	<div class="row justify-content-center">
	    <?php $this->load->view('admin/lead_management'); ?>
	    <div class="clearfix"></div>
		<div class="col-md-12 mt-3">
		    <div id="message" class="text-primary text-center"></div>
		    <!--<a href="<?//= base_url($url1.'/Dashboard/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white">Export Data</a>-->
			<div class="table-responsive ">
			
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
				<table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th class=''>Sr No.</th>
							<th class=''>Name</th>
                            <th class=''>Email</th>
                            <th class=''>Mobile</th>
                            <th class=''>Service</th>
                            <th class=''>Comment</th>
                            <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                <th class=''>Action</th>
                            <?php }?>					
						</tr>
					</thead>
					<tbody>
						<?php  if(!empty($list)) { ?>
								<?php $num=1; ?>
								<?php  foreach($list as $row) { ?>
									 
									<tr style="<?=$style;?>">
										<td class='text-primary'><?php echo $num; ?></td>						
										<td class=''><?php echo ucwords($row->full_name); ?></td>
                                        <td class=''><?php echo ucwords($row->email_id); ?></td>
                                        <td class=''><?php echo ucwords($row->mobile_no); ?></td>
                                        <td class=''><?php echo ucwords($row->services); ?></td>
                                        <td class=''><?php echo ucwords($row->sess_comments); ?></td>

                                        <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission) || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                            <td class=''>
                                                <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/edit',$permission)){ ?>
                                                    <!--<a  class="btn btn-primary"  href="<?php //echo base_url($url1.'/'.$url2.'/edit/').$row->id;?>"><i class="fa fa-pencil-square-o text-warning1 fa-lg" aria-hidden="true"></i></a>-->
                                               <?php }?>
                                               <?php if($this->session->userdata('admin_id') == 1 || in_array($url1."/".$url2.'/delete',$permission)){ ?>
                                                    <a class="btn btn-danger" href="<?php echo base_url($url1.'/'.$url2.'/delete/').$row->id;?>"><i class="fa fa-trash text-danger1 fa-lg" aria-hidden="true"></i></a> 
                                               <?php }?>
                                            </td>
                                        <?php }?>

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
<script>


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
