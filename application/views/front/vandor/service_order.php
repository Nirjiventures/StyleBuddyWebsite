<?php $this->load->view('front/vandor/header'); ?>
<div class="main">
	<div class="row m-0 row-flex">
		<div class="col-sm-12">
			<div class="rightbar">
			    
                <?php 
                    $url1 = $this->uri->segment(1);
                    $url2 = $this->uri->segment(2);
                    $url3 = $this->uri->segment(3);
                ?>
                <div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h3>Service Orders</h3>
						</div>
						<div class="col-sm-3 text-end">
							<a href="<?=base_url('stylist-zone/dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
							&nbsp; - &nbsp; 
							<a href="<?=base_url('vendor/serviceorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
						</div>
					</div>
					<hr>
				</div>
				 
                <div class="container">
                	<div class="row">
                		<div class="col-md-12 mt-3">
                		    <div id="message" class="text-primary text-center"></div>
                			<div class="table-responsive ">
                			    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>		
                                
                    			<table class="table table-bordered text-center table-hover shadow-lg text-nowrap" id="example">
                					<thead>
                						<tr>
                							<th class="no">No</th>
                							<th class="no">Order ID</th>
                							<th class="name">Name</th>
                							<th class="date">Date</th>
                							<th class="status">Transaction  ID</th>
                							<th class="status">Payment Type</th>
                							<th class="total">Total  Amount</th>
                							<th class="action">Status</th>
                							<th class="action">Details</th>
                							<!--<th class="action">Action</th>-->
                						</tr>
                					</thead>
                    				<tbody>
                        				 <?php  $num = 1; if(!empty($list)) { foreach($list as $value) { 
                        				        $date = strtotime($value->created_at); $fdate = date('d M, Y',$date);
                        				 ?>
                						<tr>
                						    <td><?= $num ?></td>
                						    <td>#<?= $value->id ?></td>
                							<td><?= ucfirst($value->fname.' '.$value->lname);  ?></td>
                							<td><?= $fdate ?></td>
                							
                							<td><?= $value->order_id ?></td>
                							<td class="hold"><?= $value->pay_type ?></td>
                							<td> &#8377; <?= number_format($value->grand_total) ?></td>
                							<td><?= $value->order_status ?></td>
                							<td><a href="<?= base_url($url1.'/'.$url2.'detail/').$value->id ?>" class="btn btn-success">View</a></td>
                							 
                						</tr>
                						<?php $num++; }} else {?>
                						    <tr>
                						        <td colspan="9" class="text-center"><h6>Order is not available</h6></td>
                						    </tr>
                						<?php }?>
                    				</tbody>
                    			</table>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('front/vandor/footer'); ?>
</body>
</html>

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
                      url: "<?= base_url('admin/update_fashion_services_status'); ?>", 
                      data: {"status":newstatus, "id":id}, 
                      success: function(data) {
                      location.reload();
                      }         
                 });
            }
        });    
    });
</script>