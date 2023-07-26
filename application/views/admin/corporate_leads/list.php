
<style>
    .c_lead .table tr td {
    padding: 6px!important;
    color: #000;
}

.c_lead .table tr td:first-child {
    font-weight: bold;
}
.modal-header {
    background: #000;
    border-radius: 0px!important;
    color: #fff;
}
.c_lead .table{margin-bottom: 0px;}
</style>

<?php $this->load->view('admin/template/header'); ?>
<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            
         </nav>
      </div>
   </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 mt-3">
			<div id="message" class="text-primary text-center"></div>
			<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
         <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
         <a href="<?= base_url($url1.'/'.$url2.'/export/?'.http_build_query($_GET, '', "&"));?>" class="btn float-right btn-primary text-white mb-3">Export Data</a>
			<div class="table-responsive ">
				<table class="table table-bordered text-center table-hover shadow-lg" id="example">
					<thead class="text-white bg-primary">
						<tr>
							<th>S.No.</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Country</th>
							<th>City</th>
							<th>Company Website</th>
							<th>No of employee</th>
							<th>Created_at</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php
						if(!empty($datas)) {
					 	$num = 1 ; 
						foreach($datas as $data) { ?>
							<tr>
							    <td><?=  $num; ?></td>
								<td><?= ucwords($data->fname.' '.$data->lname); ?></td>
							    <td><?= $data->email; ?></td>
							    <td><?= $data->country_name; ?></td>
							    <td><?= $data->city_name; ?></td>
							    <td><?= $data->company_website; ?></td>
							    <td><?= $data->no_of_employee; ?></td>
							    <td><?= date('F j, Y',strtotime($data->created_at)) ?></td>
							    <td>
							        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message_success_corporate_lead<?= $data->id; ?>">View</button>
							        <div class="modal" id="message_success_corporate_lead<?= $data->id; ?>" aria-modal="true" >
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= ucwords($data->fname.' '.$data->lname); ?></h4>
                                                    <button type="button" class="btn-close" data-dismiss="modal">X</button>
                                                </div>
                                                <div class="modal-body c_lead">
                                                    <table class="table table-bordered text-left table-hover shadow-lg">
                                                        <tr><td>Name:</td><td><?= ucwords($data->fname.' '.$data->lname); ?></td></tr>
                                                        <tr><td>Email:</td><td> <?= $data->email; ?></td></tr>
                                                        <tr><td>Country:</td><td> <?= $data->country_name; ?></td></tr>
                                                        <tr><td>State:</td><td> <?= $data->state_name; ?></td></tr>
                                                        <tr><td>City:</td><td> <?= $data->city_name; ?></td></tr>
                                                        <tr><td>Company Name:</td><td> <?= $data->company_name; ?></td></tr>
                                                        <tr><td>Company Website:</td><td> <?= $data->company_website; ?></td></tr>
                                                        <tr><td>Services:</td><td> <?= $data->services; ?></td></tr>
                                                        <tr><td>No of Employee:</td><td> <?= $data->no_of_employee; ?></td></tr>
                                                        <tr><td>Message:</td><td> <?= $data->message; ?></td></tr>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
							    </td>
							    
		                    </tr>
					   <?php $num++;  } } else {?>
					   	<tr><td colspan="6" class="text-center">Leads not available.</td></tr>
					   <?php }?>
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
         		var url = '<?= base_url($url1.'/'.$url2); ?>/statusUpdate';
                $.ajax({
                  	type:"POST",
                  	url: url, 
                  	data: {"status":newstatus,"id":id}, 
                  	success: function(data) {
                  		location.reload();
                  	}         
             	});
         	}
      	});
    });
    function update_ui_order_(key,id,table){
  		var ui_order = $('#'+key).val();
  		var url = '<?= base_url($url1.'/'.$url2); ?>/update_ui_order/'+ui_order+'/'+id;
    	$.ajax({
            type: 'post',
            url : url,
            success:function(data){ 
                console.log(url);
                console.log(data);
                if(data>0){
                    alert('Order changed successfully');
                    window.location.reload();
                }
            }   
        });
    } 
</script>
<?php $this->load->view('admin/template/footer'); ?>
